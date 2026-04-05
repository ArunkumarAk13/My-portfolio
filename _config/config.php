<?php
/**
 * Global Configuration — Arun Kumar S Portfolio
 */

// Prevent direct access
if (!defined('PORTFOLIO_ROOT')) {
    define('PORTFOLIO_ROOT', dirname(__DIR__) . '/');
}

// Site Identity
define('SITE_NAME',        'Arun Kumar S');
define('SITE_TAGLINE',     'Web Developer & IoT Enthusiast');
define('SITE_DESCRIPTION', 'Portfolio of Arun Kumar S — Web Developer, IoT Enthusiast, and CS Student based in India.');
define('SITE_VERSION',     '2.0.0');
define('SITE_AUTHOR',      'Arun Kumar S');
define('SITE_EMAIL',       'arunkumar132004@gmail.com');
define('SITE_URL',         '');   // Leave empty for relative URLs

// Paths — use dirname(__DIR__) for reliable cross-platform absolute paths
define('DATA_PATH',     dirname(__DIR__) . DIRECTORY_SEPARATOR . '_data'     . DIRECTORY_SEPARATOR);
define('TEMPLATE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . '_template' . DIRECTORY_SEPARATOR);
define('PUBLIC_PATH',   'public/');
define('CSS_PATH',      PUBLIC_PATH . 'css/');
define('JS_PATH',       PUBLIC_PATH . 'js/');
define('IMAGES_PATH',   'images/');

// Feature Flags
define('ENABLE_PARTICLES',    true);
define('ENABLE_CURSOR_GLOW',  true);
define('ENABLE_LOADING_SCREEN', true);
define('DEFAULT_THEME',       'dark');   // 'dark' or 'light'

// Contact form endpoint (PHP mail handler)
define('FORMSPREE_ENDPOINT', 'send-mail.php');


// External CDN URLs
define('FONT_AWESOME_CDN', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
define('GOOGLE_FONTS_URL', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap');

// Error reporting — set display_errors to 0 in production
error_reporting(E_ALL);
ini_set('display_errors', 1);
