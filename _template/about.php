<?php
$p      = $data['personal'] ?? [];
$name   = $p['name']   ?? 'Arun Kumar S';
$bio    = $p['bio']    ?? '';
$stats  = $p['stats']  ?? [];
$resume = $p['resume'] ?? '#';

$techChips = ['HTML/CSS', 'JavaScript', 'ReactJS', 'Python', 'NodeJS', 'MongoDB', 'Bootstrap', 'Git', 'Arduino', 'ESP32', 'PHP', 'REST APIs'];
?>
<section id="about" class="about-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">Get to Know Me</span>
      <h2 class="section-title">About <span class="gradient-text">Me</span></h2>
    </div>

    <div class="about-grid">

      <!-- Left: Image -->
      <div class="about-image-col reveal">
        <div class="about-img-frame">
          <div class="about-img-glow"></div>
          <img src="images/about.jpg" alt="About <?= e($name) ?>" class="about-img" loading="lazy">
          <div class="about-img-border"></div>
        </div>


      </div>

      <!-- Right: Content -->
      <div class="about-content-col reveal reveal-right">
        <h3 class="about-sub">
          A passionate <span class="gradient-text">Web Developer</span> &amp; IoT Enthusiast
        </h3>

        <p class="about-text"><?= e($bio) ?></p>

        <p class="about-text">
          I'm currently pursuing my BE in Computer Science at SNS Institutions (2022-2026),
          maintaining a GPA of 8.2. My passion lies at the intersection of software development
          and hardware, building solutions that bridge the digital and physical worlds.
        </p>

        <!-- Tech chips -->
        <div class="tech-chips">
          <?php foreach ($techChips as $chip): ?>
          <span class="tech-chip"><?= e($chip) ?></span>
          <?php endforeach; ?>
        </div>

        <div class="about-actions">
          <a href="<?= e($resume) ?>" class="btn btn-primary" download>
            <i class="fa-solid fa-download"></i> Download CV
          </a>
          <a href="#contact" class="btn btn-outline">
            <i class="fa-solid fa-envelope"></i> Get In Touch
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
