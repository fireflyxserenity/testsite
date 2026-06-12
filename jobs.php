<?php
$page  = 'jobs';
$title = "This Week's Jobs — Dylan's Job Box";
include 'includes/header.php';
// Job list is managed in the admin panel (admin.php → Jobs).
?>

  <section class="paper">
    <h2>This Week's Jobs</h2>
    <div class="rule"></div>
    <div class="cork">
      <?php foreach (djb_jobs() as $job): ?>
        <div class="pinned">
          <div class="pin"></div>
          <div class="job-icon"><?= $job['icon'] ?></div>
          <?= htmlspecialchars($job['what']) ?><br>— <?= htmlspecialchars($job['where']) ?><br>
          <?php if ($job['status'] === 'done'): ?>
            <span class="stamp done">DONE ✔</span>
          <?php else: ?>
            <span class="stamp booked">BOOKED</span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <p class="small-note">* <?= htmlspecialchars($site['jobs_note']) ?></p>
  </section>

<?php include 'includes/footer.php'; ?>
