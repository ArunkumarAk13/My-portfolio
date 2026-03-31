<?php
/**
 * Template Loader & JSON Data Loader
 * Provides load_template(), load_json(), and load_all_data()
 */

if (!defined('PORTFOLIO_ROOT')) {
    define('PORTFOLIO_ROOT', dirname(__DIR__) . '/');
    require_once __DIR__ . '/config.php';
}

/**
 * Load a PHP template, injecting $data and capturing output.
 *
 * @param  string $name  Template name without .php extension (e.g. 'hero')
 * @param  array  $data  Variables to extract into the template scope
 * @return string        Rendered HTML
 */
function load_template(string $name, array $data = []): string
{
    $file = TEMPLATE_PATH . $name . '.php';

    if (!file_exists($file)) {
        return "<!-- Template '{$name}' not found -->";
    }

    // Make data variables available inside the template
    extract($data, EXTR_SKIP);

    ob_start();
    include $file;
    return ob_get_clean();
}

/**
 * Load and decode a JSON file from the _data directory.
 *
 * @param  string $file  Filename without .json extension (e.g. 'personal')
 * @return array         Decoded data array (empty on failure)
 */
function load_json(string $file): array
{
    $path = DATA_PATH . $file . '.json';

    if (!file_exists($path)) {
        return [];
    }

    $json = file_get_contents($path);
    $decoded = json_decode($json, true);

    return is_array($decoded) ? $decoded : [];
}

/**
 * Load ALL JSON data files and return as a unified $data array.
 *
 * @return array  ['personal' => [...], 'skills' => [...], ...]
 */
function load_all_data(): array
{
    return [
        'personal'   => load_json('personal'),
        'skills'     => load_json('skills'),
        'projects'   => load_json('projects'),
        'experience' => load_json('experience'),
        'education'  => load_json('education'),
        'services'   => load_json('services'),
    ];
}

/**
 * Helper: safely get a nested value from an array with a default.
 *
 * @param  array  $arr      Source array
 * @param  string $key      Dot-notation key, e.g. 'personal.name'
 * @param  mixed  $default  Fallback value
 * @return mixed
 */
function data_get(array $arr, string $key, $default = '')
{
    $keys = explode('.', $key);
    $val  = $arr;

    foreach ($keys as $k) {
        if (!is_array($val) || !array_key_exists($k, $val)) {
            return $default;
        }
        $val = $val[$k];
    }

    return $val;
}

/**
 * Helper: escape output for safe HTML display.
 */
function e(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
