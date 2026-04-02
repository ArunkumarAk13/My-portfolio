<?php
$projData = $data['projects']['projects'] ?? [];

// Gather unique categories
$cats = ['All'];
foreach ($projData as $proj) {
    $cat = $proj['category'] ?? '';
    if ($cat && !in_array($cat, $cats)) {
        $cats[] = $cat;
    }
}
?>
<section id="projects" class="projects-section section">
  <div class="container">

    <div class="section-header reveal">
      <span class="section-label">Portfolio</span>
      <h2 class="section-title">Featured <span class="gradient-text">Projects</span></h2>
      <p class="section-desc">Real-world solutions built with modern technology.</p>
    </div>

    <!-- Filter Tabs -->
    <div class="project-filters reveal">
      <?php foreach ($cats as $cat): ?>
      <button class="filter-btn <?= $cat === 'All' ? 'active' : '' ?>"
              data-filter="<?= e(strtolower($cat)) ?>">
        <?= e($cat) ?>
      </button>
      <?php endforeach; ?>
    </div>

    <!-- Project Grid -->
    <div class="projects-grid" id="projectsGrid">
      <?php foreach ($projData as $proj): ?>
      <?php
        $catLower  = strtolower($proj['category'] ?? 'other');
        $isFeat    = !empty($proj['featured']);
        $isHighlight = !empty($proj['highlight']);
        $hasGithub = !empty($proj['github']) && $proj['github'] !== '#';
        $hasDemo   = !empty($proj['demo']) && $proj['demo'] !== '#';
        $hasWebsite  = !empty($proj['website']);
        $hasPlaystore = !empty($proj['playstore']);
        $hasPdf    = !empty($proj['pdf']);
        $hasReport = !empty($proj['report']);
      ?>
      <div class="project-card glass-card reveal <?= $isHighlight ? 'project-highlight' : '' ?>"
           data-category="<?= e($catLower) ?>">

        <?php if ($isHighlight): ?>
        <div class="highlight-border-anim"></div>
        <?php endif; ?>

        <!-- Image -->
        <div class="project-img-wrap">
          <img src="<?= e($proj['image']) ?>"
               alt="<?= e($proj['title']) ?>"
               class="project-img"
               loading="lazy">

          <!-- Hover Overlay -->
          <div class="project-overlay">
            <div class="project-overlay-content">
              <h3 class="project-overlay-title"><?= e($proj['title']) ?></h3>
              <div class="project-overlay-btns">
                <?php if ($hasGithub): ?>
                <a href="<?= e($proj['github']) ?>" class="btn-icon" target="_blank" rel="noopener" aria-label="GitHub">
                  <i class="fa-brands fa-github"></i>
                </a>
                <?php endif; ?>
                <?php if ($hasWebsite): ?>
                <a href="<?= e($proj['website']) ?>" class="btn-icon" target="_blank" rel="noopener" aria-label="Website">
                  <i class="fa-solid fa-globe"></i>
                </a>
                <?php endif; ?>
                <?php if ($hasPlaystore): ?>
                <a href="<?= e($proj['playstore']) ?>" class="btn-icon" target="_blank" rel="noopener" aria-label="Play Store">
                  <i class="fa-brands fa-google-play"></i>
                </a>
                <?php endif; ?>
                <?php if ($hasDemo): ?>
                <a href="<?= e($proj['demo']) ?>" class="btn-icon" target="_blank" rel="noopener" aria-label="Live Demo">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
                <?php endif; ?>
                <?php if ($hasPdf): ?>
                <a href="<?= e($proj['pdf']) ?>" class="btn-icon" target="_blank" rel="noopener" aria-label="Research Paper">
                  <i class="fa-solid fa-file-pdf"></i>
                </a>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <?php if ($isFeat): ?>
          <span class="project-featured-badge">
            <i class="fa-solid fa-star"></i> Featured
          </span>
          <?php endif; ?>

          <?php if ($isHighlight): ?>
          <span class="project-main-badge">
            <i class="fa-solid fa-crown"></i> Main Project
          </span>
          <?php endif; ?>
        </div>

        <!-- Card Body -->
        <div class="project-body">
          <div class="project-meta">
            <span class="project-category-badge"><?= e($proj['category'] ?? '') ?></span>
            <span class="project-year"><?= e($proj['year'] ?? '') ?></span>
          </div>
          <h3 class="project-title"><?= e($proj['title']) ?></h3>
          <p class="project-desc"><?= e($proj['description']) ?></p>

          <div class="project-tags">
            <?php foreach (array_slice($proj['tags'], 0, 4) as $tag): ?>
            <span class="skill-tag"><?= e($tag) ?></span>
            <?php endforeach; ?>
          </div>

          <!-- Action Buttons -->
          <div class="project-links">
            <?php if ($hasGithub): ?>
            <a href="<?= e($proj['github']) ?>" class="btn btn-sm btn-outline" target="_blank" rel="noopener">
              <i class="fa-brands fa-github"></i> Code
            </a>
            <?php endif; ?>

            <?php if ($hasWebsite): ?>
            <a href="<?= e($proj['website']) ?>" class="btn btn-sm btn-primary" target="_blank" rel="noopener">
              <i class="fa-solid fa-globe"></i> Website
            </a>
            <?php endif; ?>

            <?php if ($hasPlaystore): ?>
            <a href="<?= e($proj['playstore']) ?>" class="btn btn-sm btn-playstore" target="_blank" rel="noopener">
              <i class="fa-brands fa-google-play"></i> Play Store
            </a>
            <?php endif; ?>

            <?php if ($hasDemo): ?>
            <a href="<?= e($proj['demo']) ?>" class="btn btn-sm btn-primary" target="_blank" rel="noopener">
              <i class="fa-solid fa-eye"></i> Demo
            </a>
            <?php endif; ?>

            <?php if ($hasPdf): ?>
            <a href="<?= e($proj['pdf']) ?>" class="btn btn-sm btn-pdf" target="_blank" rel="noopener">
              <i class="fa-solid fa-file-pdf"></i> Paper
            </a>
            <?php endif; ?>

            <?php if ($hasReport): ?>
            <a href="<?= e($proj['report']) ?>" class="btn btn-sm btn-report" target="_blank" rel="noopener">
              <i class="fa-solid fa-file-lines"></i> Report
            </a>
            <?php endif; ?>

            <?php if (!$hasGithub && !$hasWebsite && !$hasPlaystore && !$hasDemo && !$hasPdf && !$hasReport): ?>
            <span class="btn btn-sm btn-outline btn-disabled">
              <i class="fa-solid fa-lock"></i> Private
            </span>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
