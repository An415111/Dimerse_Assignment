<?php
/**
 * Home Page View
 * Bombay Chai & Roast Co.
 */

$pageTitle = 'Bombay Chai & Roast Co. | Artisanal Mumbai Café & Bakery in Kala Ghoda';
$metaDescription = 'Experience authentic Mumbai cutting chai, fresh-baked Irani bun maska, and single-origin Indian specialty coffee at Bombay Chai & Roast Co. in Kala Ghoda, Mumbai.';
$currentPage = 'home';
$canonicalUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000') . '/';

// Fetch recent posts from MySQL
$recentPosts = getLatestPosts(3);

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" aria-labelledby="hero-heading">
  <div class="container hero-grid">
    <div class="hero-content">
      <div class="hero-tag">
        <span class="badge">Artisanal Café &amp; Roastery</span>
        <span style="color: var(--color-text-muted); font-size: 0.9rem;">📍 Kala Ghoda, South Mumbai</span>
      </div>
      <!-- Main Page Heading (H1) -->
      <h1 id="hero-heading">Brewing Mumbai’s Heritage with Modern Soul</h1>
      <p class="lead">
        From the spiced simmer of two-sip cutting chai to the buttery nostalgia of fresh-baked Irani bun maska and small-batch roasted Chikmagalur Arabica. Welcome to South Mumbai’s warmest corner.
      </p>
      <div class="hero-actions">
        <a href="/blog/best-chai-in-mumbai" class="btn btn-primary">Discover Our Chai Ritual</a>
        <a href="/about" class="btn btn-outline">Our Heritage Story</a>
      </div>
    </div>
    <div class="hero-visual">
      <img src="/assets/images/cafe-hero.svg" alt="Victorian colonial heritage facade of Bombay Chai and Roast Co. cafe in Kala Ghoda Mumbai illuminated by warm evening lanterns" width="600" height="380">
    </div>
  </div>
</section>

<!-- Signature Offerings Section -->
<section class="section" id="menu" aria-labelledby="signatures-heading">
  <div class="container">
    <header class="section-header">
      <span class="badge">Crafted Daily</span>
      <h2 id="signatures-heading">Signature Offerings Born on Mumbai Streets</h2>
      <p class="lead">
        Every cup and bake celebrates the culinary history of Bombay—refined for the modern palate without losing an ounce of street authenticity.
      </p>
    </header>

    <div class="specialties-grid">
      <!-- Feature 1: Chai -->
      <article class="feature-card">
        <div class="feature-icon" aria-hidden="true">☕</div>
        <h3>Mumbai Cutting Chai</h3>
        <p>
          Slow-simmered whole leaf Assam CTC, hand-pounded hill ginger, and green cardamom pods from Kerala, aerated with a dramatic kettle pour.
        </p>
        <div style="margin-top: auto; padding-top: 1rem;">
          <a href="/blog/best-chai-in-mumbai" class="blog-read-more" aria-label="Explore Recipe: Mumbai Cutting Chai">Explore Recipe &rarr;</a>
        </div>
      </article>

      <!-- Feature 2: Bun Maska -->
      <article class="feature-card">
        <div class="feature-icon" aria-hidden="true">🥖</div>
        <h3>Artisanal Bun Maska</h3>
        <p>
          Fluffy golden buns baked fresh at sunrise, generously stuffed with whipped salted butter and sweetened cream—made for hot chai dipping.
        </p>
        <div style="margin-top: auto; padding-top: 1rem;">
          <a href="/blog/secret-behind-fluffy-bun-maska" class="blog-read-more" aria-label="Irani Tradition: Artisanal Bun Maska">Irani Tradition &rarr;</a>
        </div>
      </article>

      <!-- Feature 3: Specialty Coffee -->
      <article class="feature-card">
        <div class="feature-icon" aria-hidden="true">🌱</div>
        <h3>Specialty Indian Coffee</h3>
        <p>
          100% shade-grown single-origin Arabica from Karnataka's Western Ghats, roasted in-house in small 5kg batches for pour-overs and espresso.
        </p>
        <div style="margin-top: auto; padding-top: 1rem;">
          <a href="/blog/specialty-coffee-meets-kala-ghoda" class="blog-read-more" aria-label="The Roastery: Specialty Indian Coffee">The Roastery &rarr;</a>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- Kala Ghoda Story Highlight -->
<section class="section section-alt" aria-labelledby="experience-heading">
  <div class="container story-grid">
    <div class="story-image">
      <img src="/assets/images/cafe-interior.svg" alt="Cozy cafe interior with heritage checkered floor, marble top tables, brass lamps, and espresso bar in South Mumbai" width="550" height="360" loading="lazy">
    </div>
    <div class="story-content">
      <span class="badge">Historic Ambiance</span>
      <h2 id="experience-heading">The Kala Ghoda Café Experience</h2>
      <p>
        Nestled among colonial archways, art galleries, and banyan trees in South Mumbai’s historic art precinct, our café provides an oasis of contemplative calm in a city that never pauses.
      </p>
      <p>
        Pull up a bentwood chair by our sun-drenched arched windows, listen to the hiss of the steam wand, and soak in conversations between artists, writers, and curious travelers.
      </p>
      <div style="margin-top: 1.5rem;">
        <a href="/about" class="btn btn-primary">Read Our Full Story</a>
      </div>
    </div>
  </div>
</section>

<!-- Latest From Blog (Loaded from MySQL) -->
<section class="section" id="stories" aria-labelledby="journal-heading">
  <div class="container">
    <header class="section-header">
      <span class="badge">From MySQL Database</span>
      <h2 id="journal-heading">Latest Stories from Our Mumbai Journal</h2>
      <p class="lead">
        Explore deep dives on spice profiles, baker’s techniques, and South Mumbai coffee culture.
      </p>
    </header>

    <div class="blog-grid">
      <?php if (!empty($recentPosts)): ?>
        <?php foreach ($recentPosts as $post): ?>
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
        <p class="text-center" style="grid-column: 1/-1;">No blog posts found in database.</p>
      <?php endif; ?>
    </div>

    <div class="text-center" style="margin-top: 3.5rem;">
      <a href="/blog" class="btn btn-outline">View All Mumbai Café Stories</a>
    </div>
  </div>
</section>

<!-- Location & Hours Section -->
<section class="section section-alt" id="visit" aria-labelledby="location-heading">
  <div class="container">
    <div class="location-card">
      <div class="location-info">
        <span class="badge">Visit Kala Ghoda</span>
        <h2 id="location-heading">Find Us in South Mumbai</h2>
        <p>
          We are located just off Rampart Row, steps away from the Jehangir Art Gallery and the iconic David Sassoon Library in the heritage heart of Kala Ghoda.
        </p>

        <div class="location-contact">
          <p><strong>Address:</strong> 14 Ropewalk Lane, Kala Ghoda, Fort, Mumbai, Maharashtra 400001</p>
          <p><strong>Direct Telephone:</strong> <a href="tel:+912222849102">+91 (022) 2284-9102</a></p>
          <p><strong>Cuisine:</strong> Mumbai Street Chai, Specialty Coffee, Parsi Bakes</p>
        </div>
      </div>

      <div class="location-hours" style="background-color: var(--color-surface-alt); padding: 2rem; border-radius: var(--radius-md); border: 1px solid var(--color-border);">
        <h3 style="font-size: 1.25rem; margin-bottom: 0.75rem;">Opening Hours</h3>
        <p style="font-size: 0.95rem; color: var(--color-text-muted);">Open 7 days a week for breakfast, evening tea, and late night conversations.</p>
        <ul class="hours-list">
          <li><span>Monday &ndash; Friday</span> <strong>7:30 AM &ndash; 10:30 PM</strong></li>
          <li><span>Saturday &ndash; Sunday</span> <strong>8:00 AM &ndash; 11:00 PM</strong></li>
          <li><span>Monsoon Hours</span> <strong>All Day Chai Service</strong></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
