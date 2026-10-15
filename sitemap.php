<?php
/**
 * XML Sitemap Generator
 * Bombay Chai & Roast Co.
 */

require_once __DIR__ . '/config/db.php';

header('Content-Type: application/xml; charset=utf-8');

$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000');

$posts = getAllPosts();

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <!-- Homepage -->
  <url>
    <loc><?= htmlspecialchars($baseUrl) ?>/</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>

  <!-- About Us -->
  <url>
    <loc><?= htmlspecialchars($baseUrl) ?>/about</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Blog Listing -->
  <url>
    <loc><?= htmlspecialchars($baseUrl) ?>/blog</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>

  <!-- Dynamic Blog Posts loaded from MySQL -->
  <?php foreach ($posts as $post): ?>
  <url>
    <loc><?= htmlspecialchars($baseUrl . '/blog/' . $post['slug']) ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($post['published_at'])) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <?php endforeach; ?>
</urlset>
