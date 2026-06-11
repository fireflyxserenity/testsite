<?php
$page  = 'jobs';
$title = "This Week's Jobs — Dylan's Job Box";

// 👇 Dylan's weekly job list — edit this array, nothing else.
// status: 'done' or 'booked'
$jobs = [
  ['icon' => '🚚', 'what' => '2-bedroom move',    'where' => 'Elm St',   'status' => 'done'],
  ['icon' => '🌿', 'what' => 'Hedge trim + lawn', 'where' => 'Pine Rd',  'status' => 'done'],
  ['icon' => '🔨', 'what' => 'Deck board repair', 'where' => 'King Ave', 'status' => 'done'],
  ['icon' => '🧹', 'what' => 'Garage cleanout',   'where' => 'Lake Dr',  'status' => 'booked'],
];

include 'includes/header.php';
?>

  <section class="paper">
    <h2>This Week's Jobs</h2>
    <div class="rule"></div>
    <div class="cork">
      <?php foreach ($jobs as $job): ?>
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
    <p class="small-note">* Fresh off the workbench — updated every week.</p>
  </section>

<?php include 'includes/footer.php'; ?>
