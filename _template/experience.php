<?php
$expData = $data['experience']['experience'] ?? [];
?>
<section id="experience" class="experience-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">My Journey</span>
      <h2 class="section-title">Work <span class="gradient-text">Experience</span></h2>
      <p class="section-desc">The roles and projects that have shaped my skills.</p>
    </div>

    <div class="exp-list">
      <?php foreach ($expData as $exp): ?>
      <div class="exp-item reveal">

        <div class="exp-track">
          <div class="exp-dot">
            <i class="<?= e($exp['icon']) ?>"></i>
          </div>
        </div>

        <div class="exp-card glass-card">
          <div class="exp-top">
            <span class="exp-period">
              <i class="fa-regular fa-calendar"></i>
              <?= e($exp['period']) ?>
            </span>
            <span class="exp-type <?= strtolower(e($exp['type'])) ?>"><?= e($exp['type']) ?></span>
          </div>

          <h3 class="exp-role"><?= e($exp['role']) ?></h3>

          <div class="exp-company">
            <i class="fa-solid fa-building"></i>
            <?= e($exp['company']) ?>
          </div>

          <?php if (!empty($exp['location'])): ?>
          <div class="exp-location">
            <i class="fa-solid fa-location-dot"></i>
            <?= e($exp['location']) ?>
          </div>
          <?php endif; ?>

          <p class="exp-desc"><?= e($exp['description']) ?></p>

          <div class="exp-skills">
            <?php foreach ($exp['skills'] as $skill): ?>
            <span class="skill-tag"><?= e($skill) ?></span>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
