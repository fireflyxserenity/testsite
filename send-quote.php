<?php
// Quote form handler — validates, emails Dylan, redirects back to quote.php.
// Recipient address is managed in the admin panel (admin.php → Site Text → Email).
require_once __DIR__ . '/lib.php';
const FROM_EMAIL = 'quotes@meowbots.ca'; // must be on this server's domain for deliverability

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: quote.php');
  exit;
}

// Honeypot: real visitors never fill this hidden field. Pretend success for bots.
if (!empty($_POST['website'])) {
  header('Location: quote.php?sent=1');
  exit;
}

$jobtype = substr(trim($_POST['jobtype'] ?? ''), 0, 100);
$details = substr(trim($_POST['details'] ?? ''), 0, 2000);
$name    = substr(trim($_POST['name']    ?? ''), 0, 100);
$contact = substr(trim($_POST['contact'] ?? ''), 0, 200);

if ($details === '' || $name === '' || $contact === '') {
  header('Location: quote.php?err=1');
  exit;
}

$body = "New quote request from the website!\n\n"
      . "Job type: $jobtype\n"
      . "Name:     $name\n"
      . "Contact:  $contact\n\n"
      . "Details:\n$details\n";

$headers = "From: Dylan's Job Box Website <" . FROM_EMAIL . ">\r\n";
if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
  $headers .= "Reply-To: $contact\r\n";
}

$ok = mail(djb_site()['email'], "🧰 New job request: $jobtype — $name", $body, $headers);

header('Location: quote.php?' . ($ok ? 'sent=1' : 'err=2'));
exit;
