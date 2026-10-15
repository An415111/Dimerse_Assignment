<?php
/**
 * 404 Not Found View
 * Bombay Chai & Roast Co.
 */

$pageTitle = 'Page Not Found (404) | Bombay Chai & Roast Co. Mumbai';
$metaDescription = 'The page you requested could not be found. Explore our Mumbai cafe home, heritage story, or blog articles.';
$currentPage = '404';

http_response_code(404);

require_once __DIR__ . '/../includes/header.php';
?>

<section class="section" style="padding: 6rem 0;">
  <div class="container text-center" style="max-width: 600px;">
    <span class="badge">Error 404</span>
    <!-- Main Page Heading (H1) -->
    <h1 style="margin: 1.5rem 0 1rem;">Lost in the Lanes of Mumbai?</h1>
    <p class="lead">
      We couldn’t find the page you were looking for. The kettle is boiling, however, so let’s get you back on track.
    </p>
    <div style="margin-top: 2.5rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
      <a href="/" class="btn btn-primary">Return to Home</a>
      <a href="/blog" class="btn btn-outline">Read Mumbai Stories</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
