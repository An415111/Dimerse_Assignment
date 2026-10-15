<?php
/**
 * Global Site Header Template
 * Bombay Chai & Roast Co.
 *
 * Expected variables:
 * - $pageTitle (string): Unique title for the page
 * - $metaDescription (string): Unique meta description
 * - $currentPage (string): 'home' | 'about' | 'blog' | 'post' | '404'
 * - $canonicalUrl (string, optional): Canonical link
 * - $ogImage (string, optional): OpenGraph preview image
 * - $post (array, optional): Post data if on single post
 */

$siteName = 'Bombay Chai & Roast Co.';
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000');
$currentUrl = $canonicalUrl ?? ($baseUrl . ($_SERVER['REQUEST_URI'] ?? '/'));
$ogImage = $ogImage ?? ($baseUrl . '/assets/images/cutting-chai.svg');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= htmlspecialchars($currentUrl) ?>">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="<?= ($currentPage === 'post') ? 'article' : 'website' ?>">
  <meta property="og:url" content="<?= htmlspecialchars($currentUrl) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($metaDescription) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
  <meta property="og:site_name" content="<?= htmlspecialchars($siteName) ?>">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="/assets/css/style.css">

  <!-- Google Fonts: Playfair Display for elegant Mumbai heritage headlines -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&amp;display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&amp;display=swap" rel="stylesheet" media="print" onload="this.media='all'">
  <noscript>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&amp;display=swap" rel="stylesheet">
  </noscript>

  <?php if ($currentPage === 'home'): ?>
  <!-- BONUS: LocalBusiness (CafeOrCoffeeShop) JSON-LD Schema -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "CafeOrCoffeeShop",
    "@id": "<?= htmlspecialchars($baseUrl) ?>/#cafe",
    "name": "Bombay Chai & Roast Co.",
    "alternateName": "Bombay Chai Kala Ghoda",
    "description": "Artisanal Mumbai café serving authentic slow-simmered cutting chai, traditional Parsi bun maska, and single-origin Indian specialty coffee in historic South Mumbai.",
    "url": "<?= htmlspecialchars($baseUrl) ?>",
    "telephone": "+91-22-2284-9102",
    "priceRange": "₹₹",
    "servesCuisine": [
      "Indian",
      "Mumbai Street Chai",
      "Parsi Bakery",
      "Specialty Coffee"
    ],
    "image": [
      "<?= htmlspecialchars($baseUrl) ?>/assets/images/cafe-hero.svg",
      "<?= htmlspecialchars($baseUrl) ?>/assets/images/cutting-chai.svg",
      "<?= htmlspecialchars($baseUrl) ?>/assets/images/bun-maska.svg"
    ],
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "14 Ropewalk Lane, Kala Ghoda, Fort",
      "addressLocality": "Mumbai",
      "addressRegion": "Maharashtra",
      "postalCode": "400001",
      "addressCountry": "IN"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 18.9288,
      "longitude": 72.8331
    },
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
        "opens": "07:30",
        "closes": "22:30"
      },
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Saturday", "Sunday"],
        "opens": "08:00",
        "closes": "23:00"
      }
    ],
    "hasMenu": "<?= htmlspecialchars($baseUrl) ?>/#menu",
    "paymentAccepted": "Cash, Credit Card, UPI"
  }
  </script>
  <?php endif; ?>

  <?php if ($currentPage === 'post' && !empty($post)): ?>
  <!-- BlogPosting Schema for Rich Search Results -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": <?= json_encode($post['title']) ?>,
    "description": <?= json_encode($post['meta_description']) ?>,
    "image": "<?= htmlspecialchars($baseUrl . $post['image_url']) ?>",
    "author": {
      "@type": "Person",
      "name": <?= json_encode($post['author']) ?>
    },
    "publisher": {
      "@type": "Organization",
      "name": "Bombay Chai & Roast Co.",
      "logo": {
        "@type": "ImageObject",
        "url": "<?= htmlspecialchars($baseUrl) ?>/assets/images/logo.svg"
      }
    },
    "datePublished": "<?= date('c', strtotime($post['published_at'])) ?>",
    "dateModified": "<?= date('c', strtotime($post['published_at'])) ?>",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "<?= htmlspecialchars($currentUrl) ?>"
    }
  }
  </script>
  <?php endif; ?>
</head>
<body>
  <!-- Accessibility Skip Link -->
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <!-- Site Header -->
  <header class="site-header" role="banner">
    <div class="container header-inner">
      <a href="/" class="brand-logo" aria-label="Bombay Chai &amp; Roast Co. Home">
        <img src="/assets/images/logo.svg" alt="Bombay Chai &amp; Roast Co. Logo" width="220" height="42">
      </a>

      <!-- Mobile Hamburger Navigation Toggle -->
      <button class="nav-toggle" aria-expanded="false" aria-controls="primary-navigation" aria-label="Toggle navigation menu">
        <span class="nav-toggle-icon"></span>
      </button>

      <!-- Primary Navigation -->
      <nav id="primary-navigation" aria-label="Primary navigation">
        <ul class="nav-menu">
          <li><a href="/" class="nav-link <?= ($currentPage === 'home') ? 'active' : '' ?>">Home</a></li>
          <li><a href="/about" class="nav-link <?= ($currentPage === 'about') ? 'active' : '' ?>">About Us</a></li>
          <li><a href="/blog" class="nav-link <?= ($currentPage === 'blog' || $currentPage === 'post') ? 'active' : '' ?>">Stories &amp; Blog</a></li>
        </ul>
      </nav>

      <a href="/#visit" class="header-cta">Visit Kala Ghoda</a>
    </div>
  </header>

  <!-- Main Landmark -->
  <main id="main-content">
