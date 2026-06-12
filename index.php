<?php $page = 'home'; include 'includes/header.php'; ?>

  <section class="hero">
    <div class="sign">
      <h1><?= nl2br(htmlspecialchars($site['hero_title'])) ?></h1>
      <p><?= htmlspecialchars($site['hero_text']) ?></p>
      <a class="btn" href="quote.php">Request a Quote</a>
    </div>
  </section>

  <section class="paper">
    <h2>On the Workbench</h2>
    <div class="rule"></div>
    <div class="grid">
      <?php foreach (djb_services() as $s): ?>
        <div class="plank">
          <div class="icon"><?= $s['icon'] ?></div>
          <h3><?= htmlspecialchars($s['title']) ?></h3>
          <p><?= htmlspecialchars($s['text']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="paper">
    <h2>Got Something That Needs Doing?</h2>
    <div class="rule"></div>
    <p class="about-text">Tell Dylan about the job and get an honest, up-front quote before any work starts — usually the same day. No surprises, ever.</p>
    <p style="text-align:center; margin-top: 28px;"><a class="btn" href="quote.php">🔨 Get Your Free Quote</a></p>
  </section>

<?php include 'includes/footer.php'; ?>
