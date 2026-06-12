<?php
// Shared content loader — everything Dylan can edit lives in data/*.json.
// Pages call these helpers; if a JSON file doesn't exist yet, defaults apply.
define('DJB_DATA', __DIR__ . '/data/');

function djb_read(string $name, array $default): array {
  $p = DJB_DATA . $name . '.json';
  if (!file_exists($p)) return $default;
  $j = json_decode(file_get_contents($p), true);
  return is_array($j) ? array_replace($default, $j) : $default;
}

function djb_write(string $name, array $data): bool {
  if (!is_dir(DJB_DATA)) mkdir(DJB_DATA, 0775, true);
  return file_put_contents(DJB_DATA . $name . '.json',
    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}

function djb_site(): array {
  return djb_read('site', [
    'phone'       => '(407) 383-2301',
    'email'       => 'DylansJobBoxLLC@Yahoo.com',
    'hero_title'  => "Hard Work.\nHonest Rates.",
    'hero_text'   => 'Your neighbour for the in-between stuff — moving, hauling, yard work, repairs & odd jobs of every shape and size.',
    'about_text'  => "Just a local guy with a well-stocked toolbox, a strong back, and a habit of showing up on time. Born and raised in the neighbourhood — when you hire Dylan, you're hiring someone who'll wave at you in the grocery store afterward.",
    'footer_line' => 'Serving the neighbourhood, one job at a time',
    'jobs_note'   => 'Fresh off the workbench — updated every week.',
  ]);
}

function djb_services(): array {
  return djb_read('services', ['list' => [
    ['icon' => '📦', 'title' => 'Moving Aid', 'text' => 'Heavy lifting, truck loading, full apartment & house moves.'],
    ['icon' => '🚛', 'title' => 'Hauling',    'text' => 'Dump runs, junk removal, garage & basement cleanouts.'],
    ['icon' => '🌾', 'title' => 'Yard Work',  'text' => 'Mowing, raking, hedges, gutters & seasonal cleanups.'],
    ['icon' => '🔨', 'title' => 'Odd Jobs',   'text' => 'Fixing stuff, assembly, mounting & anything in between.'],
  ]])['list'];
}

function djb_jobs(): array {
  return djb_read('jobs', ['list' => [
    ['icon' => '🚚', 'what' => '2-bedroom move',    'where' => 'Elm St',   'status' => 'done'],
    ['icon' => '🌿', 'what' => 'Hedge trim + lawn', 'where' => 'Pine Rd',  'status' => 'done'],
    ['icon' => '🔨', 'what' => 'Deck board repair', 'where' => 'King Ave', 'status' => 'done'],
    ['icon' => '🧹', 'what' => 'Garage cleanout',   'where' => 'Lake Dr',  'status' => 'booked'],
  ]])['list'];
}

function djb_theme_defaults(): array {
  return [
    'accent' => '#f4a52e',  // stamp orange (headings, trim)
    'button' => '#c1652f',  // rust (buttons, rules)
    'wood'   => '#8b5e2f',  // background planks
    'dark'   => '#2e2012',  // borders, header, footer
    'paper'  => '#f5efe1',  // parchment panels
    'board'  => '#4a331b',  // hero sign & form board
  ];
}
function djb_theme(): array { return djb_read('theme', djb_theme_defaults()); }

function djb_theme_css(): string {
  $t = djb_theme();
  return ":root{--accent:{$t['accent']};--btn:{$t['button']};--wood:{$t['wood']};"
       . "--dark:{$t['dark']};--paper:{$t['paper']};--board:{$t['board']};}";
}
