<?php
/**
 * Front Controller & URL Router
 * Bombay Chai & Roast Co.
 */

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once __DIR__ . '/config/db.php';

// Normalize the incoming request URI
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// Strip multiple slashes and trim trailing slash (except root)
$path = '/' . trim($requestPath, '/');
if ($path === '//') {
    $path = '/';
}

// Static asset bypass if requested through index.php directly
if (preg_match('#^/assets/(css|js|images)/.+#', $path)) {
    $staticFile = __DIR__ . '/public' . $path;
    if (file_exists($staticFile)) {
        $ext = pathinfo($staticFile, PATHINFO_EXTENSION);
        $mimes = [
            'css'  => 'text/css',
            'js'   => 'application/javascript',
            'svg'  => 'image/svg+xml',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'webp' => 'image/webp',
            'ico'  => 'image/x-icon',
        ];
        header('Content-Type: ' . ($mimes[$ext] ?? 'application/octet-stream'));
        readfile($staticFile);
        exit;
    }
}

// -----------------------------------------------------------------------------
// Route Matching
// -----------------------------------------------------------------------------

switch (true) {
    // Home Page
    case ($path === '/' || $path === '/home'):
        require __DIR__ . '/views/home.php';
        break;

    // About Us Page
    case ($path === '/about'):
        require __DIR__ . '/views/about.php';
        break;

    // Blog Listing Page
    case ($path === '/blog'):
        require __DIR__ . '/views/blog.php';
        break;

    // Single Blog Post (Clean slug URL: e.g. /blog/best-chai-in-mumbai)
    case (preg_match('#^/blog/([a-zA-Z0-9\-_]+)$#', $path, $matches)):
        $slug = $matches[1];
        $post = getPostBySlug($slug);
        if ($post) {
            require __DIR__ . '/views/post.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/404.php';
        }
        break;

    // XML Sitemap
    case ($path === '/sitemap.xml'):
        require __DIR__ . '/sitemap.php';
        break;

    // Robots.txt
    case ($path === '/robots.txt'):
        header('Content-Type: text/plain; charset=utf-8');
        echo "User-agent: *\nAllow: /\nDisallow: /config/\nDisallow: /database/\n\nSitemap: " . 
             ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000') . '/sitemap.xml') . "\n";
        break;

    // 404 Fallback
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
