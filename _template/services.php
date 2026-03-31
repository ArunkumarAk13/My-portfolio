<?php
$services = $data['services']['services'] ?? [];
?>
<section id="services" class="services-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">What I Offer</span>
      <h2 class="section-title">My <span class="gradient-text">Services</span></h2>
      <p class="section-desc">I bring ideas to life with clean code and creative solutions.</p>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $i => $service): ?>
      <div class="service-card glass-card reveal" style="--delay: <?= $i * 0.15 ?>s">
        <div class="service-icon-wrap">
          <div class="service-icon-bg"></div>
          <i class="<?= e($service['icon']) ?> service-icon"></i>
        </div>
        <h3 class="service-title"><?= e($service['title']) ?></h3>
        <p class="service-desc"><?= e($service['description']) ?></p>
        <ul class="service-features">
          <?php foreach ($service['features'] as $feat): ?>
          <li class="service-feature">
            <i class="fa-solid fa-circle-check feature-check"></i>
            <span><?= e($feat) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
