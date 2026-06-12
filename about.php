<?php
$page  = 'about';
$title = "About — Dylan's Job Box";
include 'includes/header.php';
?>

  <section class="paper">
    <h2>Who's Dylan?</h2>
    <div class="rule"></div>
    <p class="about-text"><?= nl2br(htmlspecialchars($site['about_text'])) ?></p>
  </section>

  <section class="paper">
    <h2>Get In Touch</h2>
    <div class="rule"></div>
    <p class="about-text">
      📞 Call or text: <strong><?= htmlspecialchars($site['phone']) ?></strong><br>
      ✉️ Email: <strong><?= htmlspecialchars($site['email']) ?></strong><br><br>
      Or skip the small talk and <a href="quote.php">send a job straight to the box</a> — free quote, usually the same day.
    </p>
  </section>

<?php include 'includes/footer.php'; ?>
