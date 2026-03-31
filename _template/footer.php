<?php
$p       = $data['personal'] ?? [];
$socials = $p['socials']  ?? [];
$year    = date('Y');

$navLinks = [
  'home'       => 'Home',
  'about'      => 'About',
  'skills'     => 'Skills',
  'experience' => 'Experience',
  'projects'   => 'Projects',
  'education'  => 'Education',
  'contact'    => 'Contact',
];
?>
<footer class="footer">
  <div class="footer-glow" aria-hidden="true"></div>

  <div class="container footer-inner">

    <!-- Brand -->
    <div class="footer-brand">
      <a href="#home" class="nav-logo" aria-label="Home">
        <span class="logo-gradient">AK</span><span class="logo-text">run Kumar</span>
      </a>
      <p class="footer-tagline"><?= e($p['tagline'] ?? 'Building digital experiences with code & creativity') ?></p>
      <div class="footer-socials">
        <?php foreach ($socials as $s): ?>
        <a href="<?= e($s['url']) ?>"
           class="social-pill"
           target="_blank" rel="noopener noreferrer"
           aria-label="<?= e($s['platform']) ?>">
          <i class="<?= e($s['icon']) ?>"></i>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Nav -->
    <nav class="footer-nav" aria-label="Footer navigation">
      <p class="footer-nav-title">Quick Links</p>
      <ul>
        <?php foreach ($navLinks as $id => $label): ?>
        <li><a href="#<?= e($id) ?>" class="footer-link"><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <!-- Contact Info -->
    <div class="footer-contact">
      <p class="footer-nav-title">Contact</p>
      <ul class="footer-contact-list">
        <li>
          <i class="fa-regular fa-envelope"></i>
          <a href="mailto:<?= e($p['email'] ?? '') ?>"><?= e($p['email'] ?? '') ?></a>
        </li>
        <li>
          <i class="fa-solid fa-phone"></i>
          <a href="tel:<?= e(preg_replace('/\s+/', '', $p['phone'] ?? '')) ?>"><?= e($p['phone'] ?? '') ?></a>
        </li>
        <li>
          <i class="fa-solid fa-location-dot"></i>
          <span><?= e($p['location'] ?? '') ?></span>
        </li>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    <p class="footer-copy">
      &copy; <?= $year ?> <?= e($p['name'] ?? SITE_NAME) ?>. Crafted with
      <i class="fa-solid fa-heart" style="color: var(--accent-3)"></i> and lots of coffee.
    </p>
    <p class="footer-version">v<?= SITE_VERSION ?></p>
  </div>
</footer>
