<?php
http_response_code(404);
define('PORTFOLIO_ROOT', __DIR__ . '/');
require_once '_config/config.php';
require_once '_config/_load.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?= DEFAULT_THEME ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 — Page Not Found | <?= e(SITE_NAME) ?></title>
  <meta name="robots" content="noindex, nofollow">

  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%236C63FF'/><text y='.9em' font-size='60' x='50%' text-anchor='middle' fill='white' font-family='sans-serif'>AK</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="<?= GOOGLE_FONTS_URL ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= FONT_AWESOME_CDN ?>">
  <link rel="stylesheet" href="<?= CSS_PATH ?>main.css">

  <style>
    html[data-theme="dark"]  { color-scheme: dark; }
    html[data-theme="light"] { color-scheme: light; }

    .page-404 {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 2rem;
      padding: 2rem;
      background: var(--bg-primary);
      text-align: center;
    }

    .gif-wrap {
      width: 60vw;
      max-width: 800px;
      border-radius: var(--radius-lg);
      overflow: hidden;
      box-shadow: var(--shadow-lg), var(--shadow-glow);
      border: 1px solid var(--glass-border);
    }

    .gif-wrap .tenor-gif-embed {
      border-radius: var(--radius-lg);
    }

    .error-code {
      font-family: var(--font-display);
      font-size: clamp(4rem, 10vw, 8rem);
      font-weight: 900;
      background: var(--gradient-primary);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      line-height: 1;
      margin: 0;
    }

    .error-msg {
      font-family: var(--font-body);
      font-size: clamp(1rem, 2.5vw, 1.4rem);
      color: var(--text-secondary);
      max-width: 480px;
      margin: 0;
    }

    .back-home {
      display: inline-flex;
      align-items: center;
      gap: .6rem;
      padding: .85rem 2rem;
      background: var(--gradient-primary);
      color: #fff;
      font-family: var(--font-body);
      font-weight: 600;
      font-size: 1rem;
      border-radius: var(--radius-xl);
      text-decoration: none;
      box-shadow: var(--shadow-glow);
      transition: var(--transition-bounce);
    }

    .back-home:hover {
      transform: translateY(-3px) scale(1.04);
      box-shadow: 0 0 50px rgba(108,99,255,.50);
    }

    @media (max-width: 640px) {
      .gif-wrap { width: 90vw; }
    }
  </style>
</head>
<body>
  <main class="page-404">
    <div class="gif-wrap">
      <div class="tenor-gif-embed" data-postid="9589596" data-share-method="host" data-aspect-ratio="2.09677" data-width="100%">
        <a href="https://tenor.com/view/riz-vadivel-gaali-gif-9589596">Riz Vadivel GIF</a>
      </div>
      <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
    </div>

    <h1 class="error-code">404</h1>
    <p class="error-msg">Oops! The page you're looking for doesn't exist or has been moved.</p>

    <a href="/" class="back-home">
      <i class="fa-solid fa-house"></i>
      Back to Home
    </a>
  </main>
</body>
</html>
