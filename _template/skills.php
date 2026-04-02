<?php
$skillData  = $data['skills']  ?? [];
$categories = $skillData['categories'] ?? [];

$catMeta = [
  'programming'   => ['color' => '#6c63ff', 'icon' => 'fa-solid fa-code'],
  'appdev'        => ['color' => '#a855f7', 'icon' => 'fa-solid fa-mobile-screen-button'],
  'database'      => ['color' => '#06b6d4', 'icon' => 'fa-solid fa-database'],
  'tools'         => ['color' => '#10b981', 'icon' => 'fa-solid fa-screwdriver-wrench'],
  'cybersecurity' => ['color' => '#f59e0b', 'icon' => 'fa-solid fa-shield-halved'],
];

$skillLevel = fn(int $p) => match(true) {
  $p >= 85 => 'Expert',
  $p >= 70 => 'Proficient',
  $p >= 55 => 'Familiar',
  default  => 'Beginner',
};

$total = count($categories);
?>
<section id="skills" class="skills-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">My Expertise</span>
      <h2 class="section-title">Technical <span class="gradient-text">Skills</span></h2>
      <p class="section-desc">A snapshot of the technologies I work with daily.</p>
    </div>

    <div class="skills-categories-grid">
      <?php foreach ($categories as $i => $cat):
        $meta = $catMeta[$cat['id']] ?? ['color' => '#6c63ff', 'icon' => 'fa-solid fa-star'];
        $wide = ($total % 2 !== 0) && ($i === $total - 1);
      ?>
      <div class="skill-category reveal<?= $wide ? ' skill-category--wide' : '' ?>"
           style="--cat-color:<?= $meta['color'] ?>">

        <div class="cat-header">
          <div class="cat-icon-wrap">
            <i class="<?= e($meta['icon']) ?>"></i>
          </div>
          <h3 class="cat-title"><?= e($cat['label']) ?></h3>
          <span class="cat-count"><?= count($cat['skills']) ?> skills</span>
        </div>

        <div class="cat-skills">
          <?php foreach ($cat['skills'] as $skill): ?>
          <div class="skill-row">
            <div class="skill-row-top">
              <div class="skill-row-left">
                <span class="skill-row-icon">
                  <i class="<?= e($skill['icon']) ?>"></i>
                </span>
                <span class="skill-row-name"><?= e($skill['name']) ?></span>
              </div>
              <div class="skill-row-right">
                <span class="skill-level-badge"><?= $skillLevel((int)$skill['level']) ?></span>
                <span class="skill-row-pct"><?= (int)$skill['level'] ?>%</span>
              </div>
            </div>
            <div class="skill-track">
              <div class="skill-fill" data-level="<?= (int)$skill['level'] ?>" style="width:0%"></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
