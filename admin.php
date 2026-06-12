<?php
// Dylan's control panel — edit site text, services, jobs, colours, password.
// Same pattern as the gimboart admin: session login, CSRF, JSON files in data/.
session_start();
require_once __DIR__ . '/lib.php';

define('ADMIN_PASSWORD', 'JobBox2026!'); // fallback until Dylan sets his own below

$msg = ''; $msgType = 'ok';
$action = $_POST['action'] ?? '';

function verifyAdminPassword(string $input): bool {
  $stored = djb_read('admin', [])['pw_hash'] ?? null;
  if ($stored) return password_verify($input, $stored);
  return hash_equals(ADMIN_PASSWORD, $input);
}

if ($action === 'login') {
  if (verifyAdminPassword($_POST['password'] ?? '')) {
    $_SESSION['djb_admin'] = true;
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
  } else { $msg = 'Wrong password.'; $msgType = 'err'; }
}
if ($action === 'logout') { session_destroy(); header('Location: admin.php'); exit; }

if (empty($_SESSION['djb_admin'])) { include __DIR__ . '/admin-login.php'; exit; }

$csrf = $_SESSION['csrf'];
function csrfOK(): bool {
  return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}
function clean(string $s, int $max = 500): string { return substr(trim($s), 0, $max); }

// ── Save handlers ─────────────────────────────────
if ($action && $action !== 'login' && !csrfOK()) {
  $msg = 'Session expired — try again.'; $msgType = 'err';
} elseif ($action === 'save_site') {
  $site = djb_site();
  foreach (['phone','email','hero_title','hero_text','about_text','footer_line','jobs_note'] as $k) {
    if (isset($_POST[$k])) $site[$k] = clean($_POST[$k], $k === 'about_text' ? 2000 : 500);
  }
  $msg = djb_write('site', $site) ? 'Site text saved!' : 'Could not save.';
  if ($msg === 'Could not save.') $msgType = 'err';
} elseif ($action === 'save_services') {
  $list = [];
  foreach (($_POST['s_title'] ?? []) as $i => $title) {
    $title = clean($title, 60);
    if ($title === '') continue;
    $list[] = [
      'icon'  => clean($_POST['s_icon'][$i] ?? '🔧', 8),
      'title' => $title,
      'text'  => clean($_POST['s_text'][$i] ?? '', 200),
    ];
  }
  $msg = djb_write('services', ['list' => $list]) ? 'Services saved!' : 'Could not save.';
} elseif ($action === 'save_jobs') {
  $list = [];
  foreach (($_POST['j_what'] ?? []) as $i => $what) {
    $what = clean($what, 80);
    if ($what === '') continue;
    $list[] = [
      'icon'   => clean($_POST['j_icon'][$i] ?? '🔨', 8),
      'what'   => $what,
      'where'  => clean($_POST['j_where'][$i] ?? '', 60),
      'status' => ($_POST['j_status'][$i] ?? '') === 'booked' ? 'booked' : 'done',
    ];
  }
  $msg = djb_write('jobs', ['list' => $list]) ? 'Jobs board saved!' : 'Could not save.';
} elseif ($action === 'save_theme') {
  if (isset($_POST['reset'])) {
    djb_write('theme', djb_theme_defaults());
    $msg = 'Colours reset to the original look!';
  } else {
    $theme = djb_theme_defaults();
    foreach (array_keys($theme) as $k) {
      $v = $_POST[$k] ?? '';
      if (preg_match('/^#[0-9a-fA-F]{6}$/', $v)) $theme[$k] = strtolower($v);
    }
    $msg = djb_write('theme', $theme) ? 'Colours saved!' : 'Could not save.';
  }
} elseif ($action === 'change_pw') {
  $new = $_POST['new_pw'] ?? '';
  if (!verifyAdminPassword($_POST['old_pw'] ?? '')) { $msg = 'Current password is wrong.'; $msgType = 'err'; }
  elseif (strlen($new) < 8) { $msg = 'New password must be at least 8 characters.'; $msgType = 'err'; }
  else {
    djb_write('admin', ['pw_hash' => password_hash($new, PASSWORD_DEFAULT)]);
    $msg = 'Password changed!';
  }
}

$site = djb_site(); $services = djb_services(); $jobs = djb_jobs(); $theme = djb_theme();
include __DIR__ . '/admin-ui.php';
