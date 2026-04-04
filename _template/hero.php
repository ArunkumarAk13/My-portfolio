<?php
$p       = $data['personal'] ?? [];
$name    = $p['name']    ?? 'Arun Kumar S';
$tagline = $p['tagline'] ?? '';
$bio     = $p['bio']     ?? '';
$roles   = $p['roles']   ?? ['Web Developer'];
$resume  = $p['resume']  ?? '#';
$socials = $p['socials'] ?? [];
$rolesJson = json_encode($roles);
?>
<section id="home" class="hero-section">
  <!-- Particle Canvas -->
  <canvas id="particleCanvas" class="particle-canvas" aria-hidden="true"></canvas>

  <div class="hero-inner container">

    <!-- Left Column -->
    <div class="hero-content reveal">
      <p class="hero-greeting">Hello, I'm</p>

      <h1 class="hero-name">
        <?php
        $parts = explode(' ', $name);
        $first = array_shift($parts);
        $rest  = implode(' ', $parts);
        ?>
        <span class="name-highlight"><?= e($first) ?></span>
        <?= $rest ? ' <span>' . e($rest) . '</span>' : '' ?>
      </h1>

      <div class="hero-typed-wrap">
        <span class="typed-prefix">I'm a </span>
        <span id="typedText" class="typed-text" data-roles='<?= $rolesJson ?>'></span>
        <span class="typed-cursor">|</span>
      </div>

      <p class="hero-bio"><?= e(substr($bio, 0, 180)) ?>…</p>

      <div class="hero-cta">
        <a href="#projects" class="btn btn-primary">
          <i class="fa-solid fa-rocket"></i> View Projects
        </a>
        <a href="<?= e($resume) ?>" class="btn btn-outline" download>
          <i class="fa-solid fa-download"></i> Download CV
        </a>
      </div>

      <div class="hero-socials">
        <?php foreach ($socials as $s): ?>
        <a href="<?= e($s['url']) ?>" class="social-pill"
           target="_blank" rel="noopener noreferrer"
           aria-label="<?= e($s['platform']) ?>">
          <i class="<?= e($s['icon']) ?>"></i>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Right Column: Profile Image -->
    <div class="hero-visual reveal reveal-right">
      <div class="profile-frame">
        <div class="profile-glow-ring"></div>
        <div class="profile-hex-wrap">
          <img src="images/profile.JPG" alt="<?= e($name) ?>" class="profile-img" loading="eager">
        </div>
    </div>
  </div>
</section>
