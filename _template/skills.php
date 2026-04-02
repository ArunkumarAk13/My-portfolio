<?php
$skillData  = $data['skills']  ?? [];
$categories = $skillData['categories'] ?? [];

$catMeta = [
  'programming'   => '#6c63ff',
  'appdev'        => '#a855f7',
  'database'      => '#06b6d4',
  'tools'         => '#10b981',
  'cybersecurity' => '#f59e0b',
];

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
        $color = $catMeta[$cat['id']] ?? '#6c63ff';
        $wide  = ($total % 2 !== 0) && ($i === $total - 1);
      ?>
      <div class="skill-category reveal<?= $wide ? ' skill-category--wide' : '' ?>"
           style="--cat-color:<?= $color ?>">

        <div class="cat-header">
          <h3 class="cat-title"><?= e($cat['label']) ?></h3>
        </div>

        <div class="cat-skills">
          <?php foreach ($cat['skills'] as $skill): ?>
          <div class="skill-row">
            <div class="skill-row-top">
              <span class="skill-row-name"><?= e($skill['name']) ?></span>
              <span class="skill-row-pct"><?= (int)$skill['level'] ?>%</span>
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
