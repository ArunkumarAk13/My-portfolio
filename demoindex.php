<?php
    include "_config/_load.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arun Kumar S - Web Developer Portfolio</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <main class="page-container">
        <div id="loadingScreen" class="loading-screen active">
            <div class="loader-content">
                <div class="loader-brand">AK</div>
                <div class="loader-bar"></div>
            </div>
        </div>

        <section id="home" class="page active">
                <div class="page-content">
                    <div class="hero">
                        <div class="hero-image-wrapper">
                            <img src="data:image/png;base64,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" alt="Arun Kumar S" class="hero-image">
                            <div class="image-glow"></div>
                        </div>
                        <div class="hero-content">
                            <p class="hero-greeting">Hello, I'm</p>
                            <h1 class="hero-name">
                                <span class="name-first">Arun</span>
                                <span class="name-last">Kumar S</span>
                            </h1>
                            <h2 class="hero-title">Web Developer</h2>
                            <p class="hero-bio">
                                As a student, I'm passionate about coding and cybersecurity, and I've also excelled in sports, 
                                showcasing my leadership skills. I'm eager to apply my adaptability and technical abilities to 
                                real-world projects in the tech industry, while continuously learning and growing.
                            </p>
                            <div class="hero-actions">
                                <a href="#" class="btn-primary">Download Resume</a>
                                <div class="social-links">
                                    <a href="#" class="social-icon" aria-label="Instagram">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.057-1.645.069-4.849.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="social-icon" aria-label="LinkedIn">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="social-icon" aria-label="GitHub">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>

    <?php load_template('navbar'); ?>
    <?php load_template('about'); ?>
    <?php load_template('project'); ?>
    <?php load_template('contact'); ?>


    <script type="module" src="public/js/data.js"></script>
    <script type="module" src="public/js/script.js"></script>
</body>
</html>