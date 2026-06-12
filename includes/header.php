<?php
// Shared header — edit nav here once, every page updates.
// Pages set $page (for the active nav link) and optionally $title before including.
require_once __DIR__ . '/../lib.php';
$site  = djb_site();
$title = $title ?? "Dylan's Job Box — Moving, Yard Work, Repairs & Odd Jobs";
$page  = $page ?? '';
function nav_link($href, $label, $key, $page) {
  $active = $key === $page ? ' class="active"' : '';
  echo "<a href=\"$href\"$active>$label</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title) ?></title>
<meta name="description" content="Dylan's Job Box — your neighbor for the in-between stuff. Moving help, hauling, yard work, repairs & odd jobs. Honest work, fair prices.">
<link href="https://fonts.googleapis.com/css2?family=Special+Elite&family=Caveat:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style><?= djb_theme_css() ?></style>
</head>
<body>
  <header>
    <a class="logo" href="index.php">🧰 DYLAN'S JOB BOX</a>
    <nav>
      <?php
        nav_link('index.php',  'HOME',        'home',  $page);
        nav_link('quote.php',  'GET A QUOTE', 'quote', $page);
        nav_link('jobs.php',   'JOBS',        'jobs',  $page);
        nav_link('about.php',  'ABOUT',       'about', $page);
      ?>
    </nav>
  </header>
