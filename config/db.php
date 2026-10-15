<?php
/**
 * Database Configuration & PDO Helper
 * Bombay Chai & Roast Co.
 */

define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'mumbai_cafe');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'root');

/**
 * Returns a shared PDO database connection.
 * Primary: MySQL PDO connection.
 * Fallback: SQLite copy if MySQL server is stopped on the host.
 *
 * @return PDO
 */
function getDBConnection(): PDO
{
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    // Quick port check (0.5s timeout) to see if MySQL is running
    $isMysqlUp = false;
    $socket = @fsockopen(DB_HOST, (int)DB_PORT, $errno, $errstr, 0.5);
    if ($socket) {
        $isMysqlUp = true;
        fclose($socket);
    }

    if ($isMysqlUp) {
        $passwordsToTry = [DB_PASS, '', 'root'];
        foreach (array_unique($passwordsToTry) as $pwd) {
            try {
                $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::ATTR_TIMEOUT            => 2,
                ];

                $pdo = new PDO($dsn, DB_USER, $pwd, $options);
                return $pdo;
            } catch (PDOException $e) {
                // Try next password
            }
        }
    }

    // Fallback: Use seeded SQLite database if MySQL daemon is stopped
    $sqlitePath = __DIR__ . '/../database/mumbai_cafe_fallback.sqlite';
    $pdo = new PDO('sqlite:' . $sqlitePath, null, null, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    initSqliteFallback($pdo);
    return $pdo;
}

/**
 * Initializes SQLite fallback with identical schema and data.
 */
function initSqliteFallback(PDO $pdo): void
{
    $pdo->exec("CREATE TABLE IF NOT EXISTS posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        slug TEXT NOT NULL UNIQUE,
        excerpt TEXT NOT NULL,
        content TEXT NOT NULL,
        meta_title TEXT NOT NULL,
        meta_description TEXT NOT NULL,
        image_url TEXT NOT NULL,
        image_alt TEXT NOT NULL,
        category TEXT NOT NULL DEFAULT 'Culture & Brews',
        reading_time TEXT NOT NULL DEFAULT '4 min read',
        author TEXT NOT NULL DEFAULT 'Farhan Merchant, Head Roaster',
        published_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    )");

    $count = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
    if ($count == 0) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, slug, excerpt, content, meta_title, meta_description, image_url, image_alt, category, reading_time, author, published_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $posts = [
            [
                'The Art of Cutting Chai: Why Mumbai\'s Street Ritual Defines Us',
                'best-chai-in-mumbai',
                'From the bustling platforms of CST station to the quiet colonial lanes of Kala Ghoda, explore why Mumbai\'s two-sip cutting chai is more than a beverage—it is the beating pulse of Maximum City.',
                '<h2>The Ritual That Wakes a City of Twenty Million</h2><p>In Mumbai, time does not start when the clock strikes six; it begins when the first blue flame roars beneath a soot-kissed aluminum kettle at the street corner tapri. Across every neighborhood, people gather for a single purpose: a piping hot "cutting" chai.</p><p>The term <em>cutting</em> itself is uniquely Bombay. It refers to a half-portion—just enough tea to cut through fatigue, reset the mind, and keep you moving without slowing your sprint across the local train platforms.</p><h2>The Spice Alchemy: What Goes Into the Pot</h2><p>At Bombay Chai & Roast Co., our cutting chai is a labor of patient reverence. Every single pot is brewed from raw, honest ingredients: hand-crushed green cardamom, freshly pounded ginger, Ceylon cinnamon, black peppercorns, and high-grown Assam CTC leaves.</p><h2>The Kettle Pour and the Art of Aeration</h2><p>Our baristas lift the kettle high above the glasses, streaming the boiling elixir from nearly two feet in the air to aerate the liquor and create a velvety crown of micro-foam on first sip.</p>',
                'The Art of Cutting Chai in Mumbai | Bombay Chai & Roast Co.',
                'Discover the secret spices, slow-simmered brewing, and century-old cultural ritual behind Mumbai\'s famous cutting chai at Bombay Chai & Roast Co. in Kala Ghoda.',
                '/assets/images/cutting-chai.svg',
                'Steaming glasses of authentic Mumbai cutting chai served in a vintage brass wire carrier on a wooden café table',
                'Chai Traditions',
                '4 min read',
                'Farhan Merchant, Head Roaster',
                '2026-10-10 08:30:00'
            ],
            [
                'The Secret Behind Irani Bun Maska & Parsi Chai Traditions',
                'secret-behind-fluffy-bun-maska',
                'A warm, crusty bun sliced open, smeared generously with whipped salted butter, and dunked into hot sweet chai. Explore the nostalgic heritage behind Mumbai\'s most beloved café pairing.',
                '<h2>A Century of Wooden Chairs and Checkered Tablecloths</h2><p>Introduced to Bombay in the late 19th century by Iranian immigrants, these cafés were the first truly secular, democratic public spaces in colonial India. High court barristers, dockworkers, freedom fighters, and poets sat elbow-to-elbow over one non-negotiable breakfast: Bun Maska.</p><h2>The Anatomy of the Perfect Bun</h2><p>What makes a great Bun Maska cannot be manufactured in modern industrial bread factories. It demands a soft pillowy crumb enriched with milk and clarified butter, a glossy chestnut-gold crust, and freshly churned whipped maska.</p><h2>The Dip: An Unspoken Etiquette</h2><p>To eat bun maska dry is considered an affront to Mumbai tradition. The bun must be halved horizontally, buttered with a generous hand until it visibly spills over the edges, and plunged decisively into your hot cup of chai.</p>',
                'Authentic Irani Bun Maska Recipe & Tradition | Mumbai Café',
                'Explore the nostalgic heritage of Mumbai\'s Irani cafés, warm crusty buns smeared with whipped salted butter, and the art of pairing with hot cutting chai.',
                '/assets/images/bun-maska.svg',
                'Freshly baked golden bun maska sliced open with generous whipped butter alongside a cup of aromatic spiced tea',
                'Bakehouse Heritage',
                '5 min read',
                'Shernaz Irani, Master Baker',
                '2026-10-05 09:15:00'
            ],
            [
                'From Chikmagalur to Kala Ghoda: Our Specialty Single-Origin Roast',
                'specialty-coffee-meets-kala-ghoda',
                'How our small-batch roastery in South Mumbai marries sustainable shade-grown Arabica from Karnataka\'s misty hills with Bombay\'s historic café culture.',
                '<h2>Bridging the Great Indian Coffee Divide</h2><p>Deep in the Western Ghats—where morning mists blanket lush canopy trees—Indian coffee growers have quietly cultivated some of the world\'s most nuanced Arabica beans. At Bombay Chai & Roast Co., we bring this specialty single-origin coffee to Kala Ghoda.</p><h2>Ethically Sourced from the Western Ghats</h2><p>Every bag of beans roasted inside our café traces back to a single family-owned estate at an altitude of 1,250 meters in Chikmagalur. The beans are 100% shade-grown and sun-dried on raised African beds.</p><h2>Roasted Fresh Daily in Small Batches</h2><p>We operate an in-house drum roaster right behind our glass espresso bar, calibrating heat profiles to account for Mumbai\'s coastal humidity for a vibrant, unforgettable cup.</p>',
                'Specialty Indian Coffee in Kala Ghoda | Bombay Chai & Roast Co.',
                'Learn how we ethically source single-origin Arabica from Karnataka to roast small-batch specialty coffee in the historic art district of Kala Ghoda, Mumbai.',
                '/assets/images/specialty-coffee.svg',
                'Hand-poured specialty filter coffee brewing in a ceramic dripper with fresh roasted whole coffee beans scattered on marble',
                'Roastery Notes',
                '4 min read',
                'Farhan Merchant, Head Roaster',
                '2026-09-28 11:00:00'
            ]
        ];

        foreach ($posts as $p) {
            $stmt->execute($p);
        }
    }
}

/**
 * Fetch all published blog posts ordered by publication date descending.
 *
 * @return array
 */
function getAllPosts(): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT id, title, slug, excerpt, meta_title, meta_description, image_url, image_alt, category, reading_time, author, published_at FROM posts ORDER BY published_at DESC");
    return $stmt->fetchAll();
}

/**
 * Fetch a single blog post by its URL slug.
 *
 * @param string $slug
 * @return array|null
 */
function getPostBySlug(string $slug): ?array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = :slug LIMIT 1");
    $stmt->execute(['slug' => $slug]);
    $result = $stmt->fetch();
    return $result ?: null;
}

/**
 * Fetch recent blog posts for homepage teaser.
 *
 * @param int $limit
 * @return array
 */
function getLatestPosts(int $limit = 3): array
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT id, title, slug, excerpt, meta_title, meta_description, image_url, image_alt, category, reading_time, published_at FROM posts ORDER BY published_at DESC LIMIT :lim");
    $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}
