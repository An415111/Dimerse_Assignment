<?php
/**
 * Single Blog Post View
 * Bombay Chai & Roast Co.
 *
 * Expected variable: $post (array loaded from MySQL)
 */

if (empty($post)) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

// SEO values loaded directly from MySQL as required
$pageTitle = $post['meta_title'];
$metaDescription = $post['meta_description'];
$currentPage = 'post';
$canonicalUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000') . '/blog/' . $post['slug'];
$ogImage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000') . $post['image_url'];

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Article Header -->
<header class="post-header" aria-labelledby="post-title">
  <div class="container post-header-inner text-center">
    <nav class="post-breadcrumbs" aria-label="Breadcrumbs">
      <a href="/">Home</a> &rsaquo;
      <a href="/blog">Journal</a> &rsaquo;
      <span><?= htmlspecialchars($post['category']) ?></span>
    </nav>
    <span class="badge"><?= htmlspecialchars($post['category']) ?></span>
    
    <!-- Main Page Heading (H1) -->
    <h1 id="post-title" style="margin-top: 1rem;"><?= htmlspecialchars($post['title']) ?></h1>
    
    <div class="post-header-meta" style="justify-content: center;">
      <span>By <strong><?= htmlspecialchars($post['author']) ?></strong></span>
      <span>&bull;</span>
      <time datetime="<?= htmlspecialchars(date('Y-m-d', strtotime($post['published_at']))) ?>">
        <?= htmlspecialchars(date('F j, Y', strtotime($post['published_at']))) ?>
      </time>
      <span>&bull;</span>
      <span><?= htmlspecialchars($post['reading_time']) ?></span>
    </div>
  </div>
</header>

<!-- Featured Image with Alt Text -->
<div class="post-hero-image">
  <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="<?= htmlspecialchars($post['image_alt']) ?>" width="860" height="480">
</div>

<!-- Main Article Body -->
<article class="container post-content">
  <!-- Dynamic article body from MySQL database -->
  <?= $post['content'] ?>
</article>

<!-- Post Navigation / Footer Backlink -->
<div class="container">
  <div class="post-footer-nav">
    <a href="/blog" class="btn btn-outline">&larr; Back to All Articles</a>
    <a href="/#visit" class="btn btn-primary">Visit Our Café in Mumbai &rarr;</a>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
