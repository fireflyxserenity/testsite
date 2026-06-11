<?php
// QR-code landing redirect for Dylan's Job Box business cards.
// Lives on the server at /public_html/djb/index.php  →  https://www.meowbots.ca/djb
// The printed QR codes encode that short URL — NEVER change or delete it.
// When Dylan gets his own domain, change ONLY the URL on the line below.
header('Location: https://www.meowbots.ca/dylansjobbox/', true, 302);
exit;
