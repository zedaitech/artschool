<?php

/**
 * Router script for PHP's built-in web server so clean URLs work. The `-t public`
 * document root is REQUIRED — without it, static assets (CSS/JS) resolve against
 * the project root and 404:
 *
 *   php -S 127.0.0.1:8091 -t public server.php
 *
 * (Equivalent to `php artisan serve`; provided because some Windows setups
 * trip up Symfony's serve pre-flight check / reserve port 8000. In production
 * use Nginx/Apache with the document root pointed at public/.)
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve existing static files (CSS, JS, images, storage) directly.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require_once __DIR__.'/public/index.php';
