<?php
/**
 * About Page View
 * Bombay Chai & Roast Co.
 */

$pageTitle = 'Our Heritage & Story | Bombay Chai & Roast Co. Mumbai';
$metaDescription = 'Discover the heritage of Bombay Chai & Roast Co. Founded in Kala Ghoda, we blend Mumbai’s century-old Irani café culture with ethically sourced Indian specialty coffee.';
$currentPage = 'about';
$canonicalUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000') . '/about';

require_once __DIR__ . '/../includes/header.php';
?>

<!-- About Hero Header -->
<header class="post-header" aria-labelledby="about-heading">
  <div class="container post-header-inner text-center">
    <nav class="post-breadcrumbs" aria-label="Breadcrumb">
      <a href="/">Home</a> &rsaquo; <span>About Us</span>
    </nav>
    <span class="badge">Estd. 1928 &bull; Kala Ghoda, Mumbai</span>
    <!-- Main Page Heading (H1) -->
    <h1 id="about-heading" style="margin-top: 1rem;">The Story of Bombay Chai &amp; Roast Co.</h1>
    <p class="lead">
      A century of warmth, community, and the persistent pursuit of India's finest teas and specialty coffees.
    </p>
  </div>
</header>

<div class="post-hero-image">
  <img src="/assets/images/cafe-interior.svg" alt="Atmospheric interior view of Bombay Chai and Roast Co. cafe showing vintage wainscoting, marble tables, and espresso bar in Mumbai" width="860" height="420">
</div>

<!-- Story Article -->
<article class="container post-content">
  <h2>Born in the Historic Heart of Kala Ghoda</h2>
  <p>
    Tucked into Ropewalk Lane beneath the grand Gothic facades and heritage rain trees of South Mumbai, Bombay Chai &amp; Roast Co. was founded on a simple observation: Mumbai is a city of relentless velocity, yet its greatest ideas have always been born in moments of unhurried conversation over tea.
  </p>
  <p>
    Since our inception, we have welcomed generations of artists, legal minds from the Bombay High Court, university scholars, and neighborhood families. While the skyline of Mumbai has transformed, the essence of our wooden chairs and warm cups remains delightfully unchanged.
  </p>

  <h2>Honoring the Mumbai Irani Café Legacy</h2>
  <p>
    During the late 19th and early 20th centuries, Iranian and Parsi settlers established corner cafés that gave Mumbai its distinct culinary charm. These spaces pioneered an open, communal dining culture where a humble coin could buy you hot tea, shelter from torrential monsoon rain, and spirited debate.
  </p>
  <blockquote>
    "In Mumbai, chai is not merely hot water and leaves. It is camaraderie, compassion, and the shared rhythm of our days."
  </blockquote>
  <p>
    We honor this sacred heritage by keeping the traditional wood-fired baking style alive for our morning bun maska, mawa cakes, and crisp khari biscuits, pairing them with the uncompromising spice complexity of street-style cutting chai.
  </p>

  <h2>From Estate to Cup: Sourcing from the Western Ghats</h2>
  <p>
    While our roots lie in tea, our passion extends to the misty highlands of Karnataka and Kerala. We partner directly with regenerative coffee estates nestled at altitudes above 1,200 meters in Chikmagalur and Coorg.
  </p>
  <p>
    By roasting in small batches directly inside our Kala Ghoda space, we can showcase the delicate notes of Indian Arabica—citrus blossom, sugarcane, toasted cashew, and dark cocoa—that the world is finally recognizing as world-class.
  </p>

  <h2>Our Guiding Café Principles</h2>
  
  <h3>1. Direct Trade &amp; Ethical Estates</h3>
  <p>
    We pay above Fair Trade prices to smallholder farmers in the Western Ghats and Assam, ensuring sustainable land stewardship and dignity for plantation workers.
  </p>

  <h3>2. Slow Craft Over Shortcuts</h3>
  <p>
    We refuse powders, premixes, and automated chai dispensers. Every pot is steeped from raw crushed spices and whole CTC leaves, simmered until rich and golden.
  </p>

  <h3>3. A Democratic Gathering Space</h3>
  <p>
    Just like Mumbai's legendary Irani cafés, our doors are open to everyone. Whether you stop by for a rapid 10-rupee cutting chai or linger with a laptop over pour-overs, you are an essential part of our story.
  </p>

  <div class="text-center" style="margin-top: 3.5rem; padding-top: 2rem; border-top: 1px solid var(--color-border);">
    <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Experience It in Person</h3>
    <p style="color: var(--color-text-muted); margin-bottom: 1.75rem;">Join us for morning bun maska or evening cutting chai at our historic Kala Ghoda cafe.</p>
    <a href="/#visit" class="btn btn-primary">Find Our Location &amp; Hours</a>
  </div>
</article>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
