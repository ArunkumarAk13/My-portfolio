<?php
define('PORTFOLIO_ROOT', __DIR__ . '/');
require_once '_config/config.php';
require_once '_config/_load.php';

$data = load_all_data();
$p    = $data['personal'];
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?= DEFAULT_THEME ?>">
<?= load_template('head', ['data' => $data]) ?>
<body>

  <!-- Loading Screen -->
  <div id="loadingScreen" class="loading-screen">
    <div class="loader-content">
      <div class="loader-brand"><?= e($p['shortName'] ?? 'AK') ?></div>
      <div class="loader-bar-wrap"><div class="loader-bar"></div></div>
      <p class="loader-text">Loading portfolio…</p>
    </div>
  </div>

  <!-- Cursor Glow -->
  <div id="cursorGlow" class="cursor-glow"></div>

  <!-- Back to Top -->
  <button id="backToTop" class="back-to-top" aria-label="Back to top">
    <i class="fa-solid fa-chevron-up"></i>
  </button>

  <?= load_template('navbar',     ['data' => $data]) ?>

  <main>
    <?= load_template('hero', $data) ?>
    <?= load_template('about', $data) ?>
    <?= load_template('skills', $data) ?>
    <?= load_template('experience', $data) ?>
    <?= load_template('projects', $data) ?>
    <?= load_template('education', $data); ?>
    <?= load_template('contact', $data) ?>
  </main>

  <?= load_template('footer',     ['data' => $data]) ?>

  <script src="<?= JS_PATH ?>main.js" defer></script>
</body>
</html>
