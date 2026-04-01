<?php
$eduData = $education['education'] ?? [];
?>
<section id="education" class="education-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">Academic Background</span>
      <h2 class="section-title">My <span class="gradient-text">Education</span></h2>
      <p class="section-desc">The foundation behind my technical knowledge.</p>
    </div>

    <div class="education-grid">
      <?php foreach ($eduData as $i => $edu): ?>
      <div class="edu-card glass-card reveal" style="--delay: <?= $i * 0.15 ?>s">

        <div class="edu-card-header">
          <div class="edu-icon-wrap">
            <i class="<?= e($edu['icon']) ?>"></i>
          </div>
          <div class="edu-status <?= strtolower(e($edu['status'])) ?>">
            <?= e($edu['status']) ?>
          </div>
        </div>

        <div class="edu-body">
          <h3 class="edu-degree"><?= e($edu['degree']) ?></h3>
          <p class="edu-field"><?= e($edu['field']) ?></p>
          <p class="edu-institution">
            <i class="fa-solid fa-university"></i>
            <?= e($edu['institution']) ?>
          </p>

          <div class="edu-meta">
            <span class="edu-period">
              <i class="fa-regular fa-calendar"></i>
              <?= e($edu['period']) ?>
            </span>
            <span class="edu-gpa">
              <i class="fa-solid fa-star"></i>
              <?= e($edu['gpa']) ?>
            </span>
          </div>

          <p class="edu-desc"><?= e($edu['description']) ?></p>

          <?php if (!empty($edu['courses'])): ?>
          <div class="edu-courses">
            <p class="edu-courses-label">Key Courses:</p>
            <div class="edu-course-tags">
              <?php foreach (array_slice($edu['courses'], 0, 6) as $course): ?>
              <span class="skill-tag"><?= e($course) ?></span>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
