<?php
$page  = 'quote';
$title = "Get a Quote — Dylan's Job Box";
include 'includes/header.php';
?>

  <section class="paper">
    <h2>Request a Quote</h2>
    <div class="rule"></div>

    <?php if (isset($_GET['sent'])): ?>
      <div class="banner ok">✅ Job received! Dylan will get back to you shortly — usually the same day.</div>
    <?php elseif (isset($_GET['err'])): ?>
      <div class="banner err">⚠️ Something went wrong — please fill in all fields, or just call/text (407) 383-2301.</div>
    <?php endif; ?>

    <form class="board" method="post" action="send-quote.php">
      <div class="field">
        <label for="jobtype">What needs doing?</label>
        <select id="jobtype" name="jobtype">
          <option>Moving aid</option>
          <option>Hauling</option>
          <option>Yard work</option>
          <option>Repair / fix-it</option>
          <option>Odd job / other</option>
        </select>
      </div>
      <div class="field">
        <label for="details">Tell Dylan about the job</label>
        <textarea id="details" name="details" rows="4" required placeholder="e.g. Fence gate is sagging and won't latch..."></textarea>
      </div>
      <div class="field">
        <label for="name">Your name</label>
        <input id="name" name="name" type="text" required placeholder="Jane Smith">
      </div>
      <div class="field">
        <label for="contact">Phone or email</label>
        <input id="contact" name="contact" type="text" required placeholder="(407) 000-0000">
      </div>
      <div class="honeypot" aria-hidden="true">
        <label>Leave this field empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
      </div>
      <button class="send" type="submit">🔨 Request a Quote</button>
    </form>
    <p class="small-note">* Every job quoted up front before work starts. No surprises, ever.</p>
  </section>

<?php include 'includes/footer.php'; ?>
