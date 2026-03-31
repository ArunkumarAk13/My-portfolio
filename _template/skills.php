<?php
$skillData  = $data['skills']  ?? [];
$categories = $skillData['categories'] ?? [];
?>
<section id="skills" class="skills-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">My Expertise</span>
      <h2 class="section-title">Technical <span class="gradient-text">Skills</span></h2>
      <p class="section-desc">A snapshot of the technologies I work with daily.</p>
    </div>

    <!-- Tab Filters -->
    <div class="skill-tabs reveal">
      <button class="skill-tab active" data-tab="all">All</button>
      <?php foreach ($categories as $cat): ?>
      <button class="skill-tab" data-tab="<?= e($cat['id']) ?>"><?= e($cat['label']) ?></button>
      <?php endforeach; ?>
    </div>

    <!-- Skills Grid -->
    <?php foreach ($categories as $cat): ?>
    <div class="skills-group" data-group="<?= e($cat['id']) ?>">
      <div class="skills-grid">
        <?php foreach ($cat['skills'] as $skill): ?>
        <div class="skill-card glass-card reveal">
          <div class="skill-header">
            <div class="skill-icon-wrap">
              <i class="<?= e($skill['icon']) ?>"></i>
            </div>
            <div class="skill-info">
              <span class="skill-name"><?= e($skill['name']) ?></span>
              <span class="skill-percent"><?= (int)$skill['level'] ?>%</span>
            </div>
          </div>
          <div class="skill-bar-wrap">
            <div class="skill-bar" data-level="<?= (int)$skill['level'] ?>" style="width: 0%"></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</section>
