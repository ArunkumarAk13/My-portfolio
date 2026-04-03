<?php
$p       = $data['personal'] ?? [];
$socials = $p['socials'] ?? [];
?>
<header class="navbar" id="navbar">
  <nav class="nav-container">

    <!-- Logo -->
    <a href="#home" class="nav-logo" aria-label="Home">
      <span class="logo-badge">AK</span>
    </a>

    <!-- Desktop Nav Links (pill container) -->
    <div class="nav-pill-wrap">
      <ul class="nav-links" id="navLinks">
        <li><a href="#home"       class="nav-link active">Home</a></li>
        <li><a href="#about"      class="nav-link">About</a></li>
        <li><a href="#skills"     class="nav-link">Skills</a></li>
        <li><a href="#experience" class="nav-link">Experience</a></li>
        <li><a href="#education"  class="nav-link">Education</a></li>
        <li><a href="#projects"   class="nav-link">Projects</a></li>
        <li><a href="#contact"    class="nav-link">Contact</a></li>
      </ul>
    </div>

    <!-- Right Controls -->
    <div class="nav-actions">
      <!-- Theme Toggle -->
      <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme" title="Toggle dark/light mode">
        <span class="toggle-track">
          <i class="fa-solid fa-moon  toggle-icon toggle-moon"></i>
          <i class="fa-solid fa-sun   toggle-icon toggle-sun"></i>
        </span>
      </button>

      <!-- Hamburger -->
      <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>

  </nav>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <ul class="mobile-nav-links">
      <li><a href="#home"       class="mobile-nav-link">Home</a></li>
      <li><a href="#about"      class="mobile-nav-link">About</a></li>
      <li><a href="#skills"     class="mobile-nav-link">Skills</a></li>
      <li><a href="#experience" class="mobile-nav-link">Experience</a></li>
      <li><a href="#education"  class="mobile-nav-link">Education</a></li>
      <li><a href="#projects"   class="mobile-nav-link">Projects</a></li>
      <li><a href="#contact"    class="mobile-nav-link">Contact</a></li>
    </ul>
    <div class="mobile-socials">
      <?php foreach ($socials as $s): ?>
      <a href="<?= e($s['url']) ?>" class="mobile-social-icon" target="_blank" rel="noopener" aria-label="<?= e($s['platform']) ?>">
        <i class="<?= e($s['icon']) ?>"></i>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</header>
