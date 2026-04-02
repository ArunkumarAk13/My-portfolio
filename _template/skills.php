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

    <div class="skills-categories-grid">
      <?php foreach ($categories as $cat):
        $meta    = $catMeta[$cat['id']] ?? ['color' => '#6c63ff', 'icon' => 'fa-solid fa-code'];
        $color   = $meta['color'];
        $catIcon = $meta['icon'];
      ?>
      <div class="skill-category reveal" style="--cat-color:<?= $color ?>">

        <div class="cat-header">
          <span class="cat-icon-wrap"><i class="<?= $catIcon ?>"></i></span>
          <h3 class="cat-title"><?= e($cat['label']) ?></h3>
        </div>

        <div class="cat-skills">
          <?php foreach ($cat['skills'] as $skill): ?>
          <div class="skill-chip">
            <span class="skill-chip-icon"><i class="<?= e($skill['icon']) ?>"></i></span>
            <span class="skill-chip-name"><?= e($skill['name']) ?></span>
          </div>
          <?php endforeach; ?>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
