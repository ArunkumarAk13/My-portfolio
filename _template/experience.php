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

    <div class="timeline">
      <div class="timeline-line" id="timelineLine"></div>

      <?php foreach ($expData as $i => $exp): ?>
      <div class="timeline-item <?= $i % 2 === 0 ? 'timeline-left' : 'timeline-right' ?> reveal">
        <div class="timeline-dot">
          <i class="<?= e($exp['icon']) ?>"></i>
        </div>

        <div class="timeline-card glass-card">
          <div class="timeline-card-header">
            <div>
              <h3 class="timeline-role"><?= e($exp['role']) ?></h3>
              <div class="timeline-meta">
                <span class="timeline-company">
                  <i class="fa-solid fa-building"></i>
                  <?= e($exp['company']) ?>
                </span>
                <span class="timeline-type <?= strtolower(e($exp['type'])) ?>"><?= e($exp['type']) ?></span>
              </div>
            </div>
            <span class="timeline-period">
              <i class="fa-regular fa-calendar"></i>
              <?= e($exp['period']) ?>
            </span>
          </div>

          <p class="timeline-desc"><?= e($exp['description']) ?></p>

          <div class="timeline-skills">
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
