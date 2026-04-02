<?php
$skillData  = $data['skills']  ?? [];
$categories = $skillData['categories'] ?? [];

$catMeta = [
  'programming'   => ['color' => '#6c63ff', 'icon' => 'fa-solid fa-code'],
  'appdev'        => ['color' => '#a855f7', 'icon' => 'fa-solid fa-layer-group'],
  'database'      => ['color' => '#06b6d4', 'icon' => 'fa-solid fa-database'],
  'tools'         => ['color' => '#10b981', 'icon' => 'fa-solid fa-wrench'],
  'cybersecurity' => ['color' => '#f59e0b', 'icon' => 'fa-solid fa-shield-halved'],
];
?>
<section id="skills" class="skills-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">My Expertise</span>
      <h2 class="section-title">Technical <span class="gradient-text">Skills</span></h2>
      <p class="section-desc">A snapshot of the technologies I work with daily.</p>
    </div>

    <!-- Category tabs -->
    <div class="skills-tabs reveal">
      <?php foreach ($categories as $i => $cat):
        $meta = $catMeta[$cat['id']] ?? ['color' => '#6c63ff', 'icon' => 'fa-solid fa-code'];
      ?>
      <button class="skills-tab<?= $i === 0 ? ' active' : '' ?>"
              data-tab="<?= $cat['id'] ?>"
              style="--tab-color:<?= $meta['color'] ?>">
        <i class="<?= $meta['icon'] ?>"></i>
        <span><?= e($cat['label']) ?></span>
      </button>
      <?php endforeach; ?>
    </div>

    <!-- Skill panels -->
    <div class="skills-panels">
      <?php foreach ($categories as $i => $cat):
        $meta  = $catMeta[$cat['id']] ?? ['color' => '#6c63ff', 'icon' => 'fa-solid fa-code'];
        $color = $meta['color'];
      ?>
      <div class="skills-panel<?= $i === 0 ? ' active' : '' ?>"
           id="panel-<?= $cat['id'] ?>"
           style="--cat-color:<?= $color ?>">
        <?php foreach ($cat['skills'] as $skill): ?>
        <div class="skill-tile">
          <div class="skill-tile-glow"></div>
          <div class="skill-tile-icon">
            <i class="<?= e($skill['icon']) ?>"></i>
          </div>
          <span class="skill-tile-name"><?= e($skill['name']) ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
