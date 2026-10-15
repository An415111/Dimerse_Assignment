<?php
/**
 * Blog Listing Page View
 * Bombay Chai & Roast Co.
 */

$pageTitle = 'Mumbai Café Culture & Stories | Bombay Chai & Roast Co. Blog';
$metaDescription = 'Read articles on Mumbai cutting chai brewing rituals, authentic Irani bun maska history, and Indian single-origin coffee roasts from Bombay Chai & Roast Co.';
$currentPage = 'blog';
$canonicalUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000') . '/blog';

// Fetch all posts from MySQL
$posts = getAllPosts();

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Blog Header -->
<header class="post-header" aria-labelledby="blog-heading">
  <div class="container post-header-inner text-center">
    <nav class="post-breadcrumbs" aria-label="Breadcrumb">
      <a href="/">Home</a> &rsaquo; <span>Journal &amp; Blog</span>
    </nav>
    <span class="badge">The Mumbai Café Journal</span>
    <!-- Main Page Heading (H1) -->
    <h1 id="blog-heading" style="margin-top: 1rem;">Stories, Sips &amp; Mumbai Café Culture</h1>
    <p class="lead">
      Deep dives into whole spice brewing, historic Irani bakery heritage, and our single-origin roastery in Kala Ghoda.
    </p>
  </div>
</header>

<section class="section" aria-labelledby="articles-heading">
  <div class="container">
    <header class="section-header">
      <span class="badge">Stored in MySQL</span>
      <h2 id="articles-heading">All Journal Articles</h2>
      <p class="lead">
        Browse our latest essays and culinary dispatches from the heart of South Mumbai.
      </p>
    </header>

    <div class="blog-grid">
      <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
          <article class="blog-card">
            <div class="blog-card-media">
              <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" tabindex="-1" aria-hidden="true">
                <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="<?= htmlspecialchars($post['image_alt']) ?>" width="400" height="250" loading="lazy">
              </a>
            </div>
            <div class="blog-card-body">
              <div class="blog-meta">
                <span class="badge"><?= htmlspecialchars($post['category']) ?></span>
                <time datetime="<?= htmlspecialchars(date('Y-m-d', strtotime($post['published_at']))) ?>">
                  <?= htmlspecialchars(date('M d, Y', strtotime($post['published_at']))) ?>
                </time>
                <span>&bull;</span>
                <span><?= htmlspecialchars($post['reading_time']) ?></span>
              </div>
              <h3 class="blog-card-title">
                <a href="/blog/<?= htmlspecialchars($post['slug']) ?>">
                  <?= htmlspecialchars($post['title']) ?>
                </a>
              </h3>
              <p class="blog-card-excerpt">
                <?= htmlspecialchars($post['excerpt']) ?>
              </p>
              <div style="margin-top: auto;">
                <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="blog-read-more" aria-label="Read Article: <?= htmlspecialchars($post['title']) ?>">
                  Read Article &rarr;
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center" style="grid-column: 1/-1;">No articles currently available.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
