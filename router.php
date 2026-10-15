<?php
/**
 * Router script for PHP Built-in Development Server
 * Usage: php -S localhost:8000 router.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Explicit routes for dynamic sitemap and robots
if ($uri === '/sitemap.xml') {
    require __DIR__ . '/sitemap.php';
    exit;
}

if ($uri === '/robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    if (file_exists(__DIR__ . '/public/robots.txt')) {
        readfile(__DIR__ . '/public/robots.txt');
    } else {
        readfile(__DIR__ . '/robots.txt');
    }
    exit;
}

// Serve static assets if they exist in /public
$publicFile = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($publicFile) && !is_dir($publicFile)) {
    $ext = pathinfo($publicFile, PATHINFO_EXTENSION);
    $mimes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'svg'  => 'image/svg+xml',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        'xml'  => 'application/xml',
        'txt'  => 'text/plain',
        'ico'  => 'image/x-icon',
    ];
    if (isset($mimes[$ext])) {
        header('Content-Type: ' . $mimes[$ext]);
    }
    header('Cache-Control: public, max-age=86400');
    readfile($publicFile);
    exit;
}

// If file exists in root (e.g. assets)
$rootFile = __DIR__ . $uri;
if ($uri !== '/' && file_exists($rootFile) && !is_dir($rootFile)) {
    return false;
}

// Forward all other requests to index.php
require_once __DIR__ . '/index.php';
