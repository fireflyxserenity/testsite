<?php // Login screen for admin.php — expects $msg / $msgType. ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dylan's Job Box — Admin Login</title>
<meta name="robots" content="noindex, nofollow">
<link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: "Special Elite", "Courier New", monospace; min-height: 100vh; display: flex; align-items: center; justify-content: center;
    background: repeating-linear-gradient(0deg, #8b5e2f 0 90px, #7d5429 90px 92px, #835830 92px 180px, #76502a 180px 182px); }
  .box { background: #f5efe1; border: 4px solid #2e2012; box-shadow: 8px 8px 0 rgba(46,32,18,.55); padding: 40px 44px; text-align: center; max-width: 380px; width: 92%; }
  h1 { font-family: "Arial Black", sans-serif; font-size: 20px; letter-spacing: 2px; color: #2e2012; text-transform: uppercase; margin-bottom: 6px; }
  p { font-size: 13px; color: #6e5a3d; margin-bottom: 22px; }
  input { width: 100%; padding: 12px 14px; border: 3px solid #2e2012; background: #fff; font-family: inherit; font-size: 15px; margin-bottom: 14px; }
  input:focus { outline: none; border-color: #f4a52e; }
  button { width: 100%; background: #c1652f; color: #fff; border: 3px solid #2e2012; box-shadow: 4px 4px 0 #2e2012; padding: 13px; font-family: "Arial Black", sans-serif; font-size: 14px; letter-spacing: 2px; text-transform: uppercase; cursor: pointer; }
  button:hover { background: #a85423; }
  .err { background: #f7e3dc; border: 3px solid #8a3324; color: #8a3324; padding: 10px; font-size: 13px; margin-bottom: 16px; }
</style>
</head>
<body>
  <form class="box" method="post" autocomplete="off">
    <h1>🧰 Dylan's Control Panel</h1>
    <p>Workshop staff only.</p>
    <?php if ($msg): ?><div class="err"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
    <input type="hidden" name="action" value="login">
    <input type="password" name="password" placeholder="Password" autofocus required>
    <button type="submit">Unlock</button>
  </form>
</body>
</html>
