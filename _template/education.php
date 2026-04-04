<?php
$eduData  = $education['education'] ?? [];
$academic = array_values(array_filter($eduData, fn($e) => ($e['type'] ?? 'academic') === 'academic'));
$courses  = array_values(array_filter($eduData, fn($e) => ($e['type'] ?? 'academic') === 'course'));
?>
<section id="education" class="education-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">Academic Background</span>
      <h2 class="section-title">My <span class="gradient-text">Education</span></h2>
      <p class="section-desc">The foundation behind my technical knowledge.</p>
    </div>

    <div class="edu-split-grid">

      <!-- Left: Academic Education -->
      <div class="edu-split-col">
        <p class="edu-split-col-label"><i class="fa-solid fa-graduation-cap"></i> Academic</p>
        <?php foreach ($academic as $i => $edu): ?>
        <div class="edu-split-item reveal" style="--delay: <?= $i * 0.12 ?>s">
          <div class="edu-split-meta">
            <span class="edu-tl-period"><?= e($edu['period']) ?></span>
            <span class="edu-split-org"><?= e($edu['institution']) ?></span>
            <?php if (!empty($edu['location'])): ?>
            <span class="edu-split-location"><i class="fa-solid fa-location-dot"></i> <?= e($edu['location']) ?></span>
            <?php endif; ?>
          </div>
          <h3 class="edu-split-title"><?= e($edu['degree']) ?></h3>
          <p class="edu-split-field"><?= e($edu['field']) ?></p>
          <p class="edu-split-desc"><?= e($edu['description']) ?></p>
          <?php if (!empty($edu['gpa'])): ?>
          <span class="edu-split-gpa"><i class="fa-solid fa-star"></i> <?= e($edu['gpa']) ?></span>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Right: Courses & Certifications -->
      <div class="edu-split-col">
        <p class="edu-split-col-label"><i class="fa-solid fa-book-open"></i> Courses & Certifications</p>
        <?php foreach ($courses as $i => $edu): ?>
        <div class="edu-split-item reveal" style="--delay: <?= $i * 0.12 ?>s">
          <div class="edu-split-meta">
            <span class="edu-tl-period"><?= e($edu['period']) ?></span>
            <span class="edu-split-org"><?= e($edu['institution']) ?></span>
            <?php if (!empty($edu['location'])): ?>
            <span class="edu-split-location"><i class="fa-solid fa-location-dot"></i> <?= e($edu['location']) ?></span>
            <?php endif; ?>
          </div>
          <h3 class="edu-split-title"><?= e($edu['degree']) ?></h3>
          <p class="edu-split-field"><?= e($edu['field']) ?></p>
          <p class="edu-split-desc"><?= e($edu['description']) ?></p>
          <?php if (!empty($edu['courses'])): ?>
          <div class="edu-split-tags">
            <?php foreach (array_slice($edu['courses'], 0, 5) as $tag): ?>
            <span class="skill-tag"><?= e($tag) ?></span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>

    </div>

  </div>
</section>
