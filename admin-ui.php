<?php // Admin dashboard — expects $csrf, $msg, $msgType, $site, $services, $jobs, $theme. ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dylan's Job Box — Control Panel</title>
<meta name="robots" content="noindex, nofollow">
<link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
<link rel="stylesheet" href="admin.css">
</head>
<body>
<header class="bar">
  <div class="ttl">🧰 DYLAN'S CONTROL PANEL</div>
  <nav>
    <a href="#text">Text</a><a href="#services">Services</a><a href="#jobs">Jobs</a>
    <a href="#colours">Colours</a><a href="#password">Password</a>
    <a href="index.php" target="_blank">View Site ↗</a>
  </nav>
  <form method="post"><input type="hidden" name="action" value="logout"><button class="logout">Log out</button></form>
</header>

<main>
<?php if ($msg): ?><div class="flash <?= $msgType ?>"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

<section class="card" id="text">
  <h2>📝 Site Text</h2>
  <form method="post">
    <input type="hidden" name="action" value="save_site"><input type="hidden" name="csrf" value="<?= $csrf ?>">
    <div class="two">
      <label>Phone (shown everywhere)<input name="phone" value="<?= htmlspecialchars($site['phone']) ?>"></label>
      <label>Email (quote requests go here!)<input name="email" value="<?= htmlspecialchars($site['email']) ?>"></label>
    </div>
    <label>Big headline on the sign (each line on its own row)<textarea name="hero_title" rows="2"><?= htmlspecialchars($site['hero_title']) ?></textarea></label>
    <label>Text under the headline<textarea name="hero_text" rows="2"><?= htmlspecialchars($site['hero_text']) ?></textarea></label>
    <label>"Who's Dylan?" paragraph<textarea name="about_text" rows="4"><?= htmlspecialchars($site['about_text']) ?></textarea></label>
    <div class="two">
      <label>Footer line<input name="footer_line" value="<?= htmlspecialchars($site['footer_line']) ?>"></label>
      <label>Note under the jobs board<input name="jobs_note" value="<?= htmlspecialchars($site['jobs_note']) ?>"></label>
    </div>
    <button class="save">Save Site Text</button>
  </form>
</section>

<section class="card" id="services">
  <h2>🪚 Services <span class="hint">— the planks on the home page</span></h2>
  <form method="post">
    <input type="hidden" name="action" value="save_services"><input type="hidden" name="csrf" value="<?= $csrf ?>">
    <div class="rows" id="service-rows">
      <?php foreach ($services as $s): ?>
      <div class="row">
        <input class="icon" name="s_icon[]" value="<?= htmlspecialchars($s['icon']) ?>" title="Emoji">
        <input class="name" name="s_title[]" value="<?= htmlspecialchars($s['title']) ?>" placeholder="Service name">
        <input class="desc" name="s_text[]" value="<?= htmlspecialchars($s['text']) ?>" placeholder="Short description">
        <button type="button" class="del" onclick="this.parentNode.remove()">✕</button>
      </div>
      <?php endforeach; ?>
    </div>
    <button type="button" class="add" onclick="addRow('service-rows')">+ Add a service</button>
    <button class="save">Save Services</button>
  </form>
</section>

<section class="card" id="jobs">
  <h2>📌 This Week's Jobs <span class="hint">— the corkboard</span></h2>
  <form method="post">
    <input type="hidden" name="action" value="save_jobs"><input type="hidden" name="csrf" value="<?= $csrf ?>">
    <div class="rows" id="job-rows">
      <?php foreach ($jobs as $j): ?>
      <div class="row">
        <input class="icon" name="j_icon[]" value="<?= htmlspecialchars($j['icon']) ?>" title="Emoji">
        <input class="name" name="j_what[]" value="<?= htmlspecialchars($j['what']) ?>" placeholder="What was the job?">
        <input class="where" name="j_where[]" value="<?= htmlspecialchars($j['where']) ?>" placeholder="Street / area">
        <select name="j_status[]">
          <option value="done" <?= $j['status'] === 'done' ? 'selected' : '' ?>>DONE ✔</option>
          <option value="booked" <?= $j['status'] === 'booked' ? 'selected' : '' ?>>BOOKED</option>
        </select>
        <button type="button" class="del" onclick="this.parentNode.remove()">✕</button>
      </div>
      <?php endforeach; ?>
    </div>
    <button type="button" class="add" onclick="addRow('job-rows')">+ Add a job</button>
    <button class="save">Save Jobs Board</button>
  </form>
</section>

<section class="card" id="colours">
  <h2>🎨 Colours</h2>
  <form method="post">
    <input type="hidden" name="action" value="save_theme"><input type="hidden" name="csrf" value="<?= $csrf ?>">
    <div class="swatches">
      <label>Accent (orange trim)<input type="color" name="accent" value="<?= $theme['accent'] ?>"></label>
      <label>Buttons (rust)<input type="color" name="button" value="<?= $theme['button'] ?>"></label>
      <label>Wood background<input type="color" name="wood" value="<?= $theme['wood'] ?>"></label>
      <label>Dark trim<input type="color" name="dark" value="<?= $theme['dark'] ?>"></label>
      <label>Paper panels<input type="color" name="paper" value="<?= $theme['paper'] ?>"></label>
      <label>Sign &amp; form board<input type="color" name="board" value="<?= $theme['board'] ?>"></label>
    </div>
    <button class="save">Save Colours</button>
    <button class="save reset" name="reset" value="1" onclick="return confirm('Put all colours back to the original look?')">↺ Reset to Original</button>
  </form>
</section>

<section class="card" id="password">
  <h2>🔑 Change Password</h2>
  <form method="post" autocomplete="off">
    <input type="hidden" name="action" value="change_pw"><input type="hidden" name="csrf" value="<?= $csrf ?>">
    <div class="two">
      <label>Current password<input type="password" name="old_pw" required></label>
      <label>New password (8+ characters)<input type="password" name="new_pw" required minlength="8"></label>
    </div>
    <button class="save">Change Password</button>
  </form>
</section>
</main>

<script>
function addRow(id) {
  const rows = document.getElementById(id);
  const r = rows.lastElementChild ? rows.lastElementChild.cloneNode(true) : null;
  if (!r) return;
  r.querySelectorAll('input').forEach(i => i.value = i.classList.contains('icon') ? '🔧' : '');
  const sel = r.querySelector('select'); if (sel) sel.value = 'booked';
  rows.appendChild(r);
}
</script>
</body>
</html>
