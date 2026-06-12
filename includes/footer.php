<?php // Shared footer — contact info comes from the admin panel (data/site.json). ?>
  <footer>
    <div class="phone">CALL OR TEXT: <?= htmlspecialchars($site['phone']) ?></div>
    <p>Dylan's Job Box · <?= htmlspecialchars($site['email']) ?> · <?= htmlspecialchars($site['footer_line']) ?></p>
  </footer>
</body>
</html>
