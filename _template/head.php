<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- SEO -->
  <title><?= e(SITE_NAME) ?> — <?= e(SITE_TAGLINE) ?></title>
  <meta name="description" content="<?= e(SITE_DESCRIPTION) ?>">
  <meta name="author"      content="<?= e(SITE_AUTHOR) ?>">
  <meta name="keywords"    content="Arun Kumar, Web Developer, IoT, Portfolio, PHP, ReactJS, Python, India">
  <meta name="robots"      content="index, follow">

  <!-- Open Graph / Social -->
  <meta property="og:type"        content="website">
  <meta property="og:title"       content="<?= e(SITE_NAME) ?> — Portfolio">
  <meta property="og:description" content="<?= e(SITE_DESCRIPTION) ?>">
  <meta property="og:image"       content="images/profile.JPG">
  <meta name="twitter:card"       content="summary_large_image">
  <meta name="twitter:title"      content="<?= e(SITE_NAME) ?> — Portfolio">
  <meta name="twitter:description" content="<?= e(SITE_DESCRIPTION) ?>">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%236C63FF'/><text y='.9em' font-size='60' x='50%' text-anchor='middle' fill='white' font-family='sans-serif'>AK</text></svg>">

  <!-- Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">

  <!-- Google Fonts -->
  <link href="<?= GOOGLE_FONTS_URL ?>" rel="stylesheet">

  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="<?= FONT_AWESOME_CDN ?>">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?= CSS_PATH ?>main.css">

  <!-- Critical inline CSS: prevent flash of wrong theme -->
  <style>
    html[data-theme="dark"]  { color-scheme: dark; }
    html[data-theme="light"] { color-scheme: light; }
    .loading-screen {
      position: fixed; inset: 0; z-index: 9999;
      background: #060614;
      display: flex; align-items: center; justify-content: center;
      transition: opacity .5s ease, visibility .5s ease;
    }
    .loading-screen.hidden { opacity: 0; visibility: hidden; pointer-events: none; }
  </style>
</head>
