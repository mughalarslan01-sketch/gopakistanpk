<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'GoPakistan.PK | Explore Pakistan With Us';
$metaDescription = 'Explore Pakistan with GoPakistan.PK. Discover tour packages, destinations, travel services, and expert-guided trips across Pakistan.';

$featuredTours = getPublishedTours(3);
$latestArticles = getLatestArticles(3);

include __DIR__ . '/includes/header.php';
?>
<section class="hero-section">
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="section-tag">Pakistan Travel & Tours</span>
                <h1>Explore Pakistan With GoPakistan.PK</h1>
                <p>Discover breathtaking mountains, historic cities, beautiful valleys, deserts, beaches, and unforgettable experiences.</p>
                <div class="hero-actions">
                    <a href="<?= BASE_URL; ?>/tour-details.php?id=1" class="btn btn-gold btn-lg rounded-pill px-4">Explore Tours</a>
                    <a href="<?= BASE_URL; ?>/contact.php" class="btn btn-outline-gold btn-lg rounded-pill px-4">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Popular Destinations</span>
            <h2 class="section-title">Travel Pakistan’s Most Loved Places</h2>
        </div>
        <div class="row g-4">
            <?php
            $destinations = [
                ['name' => 'Hunza Valley', 'image' => 'https://images.unsplash.com/photo-1521295121783-8a321d551ad2?auto=format&fit=crop&w=900&q=80', 'description' => 'Majestic peaks, apricot orchards, and ancient forts.'],
                ['name' => 'Skardu', 'image' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=900&q=80', 'description' => 'A high-altitude wonderland of lakes and glaciers.'],
                ['name' => 'Swat Valley', 'image' => 'https://images.unsplash.com/photo-1516483638261-f4dbaf036963?auto=format&fit=crop&w=900&q=80', 'description' => 'Lush green valleys and rich cultural heritage.'],
                ['name' => 'Naran Kaghan', 'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=900&q=80', 'description' => 'Alpine meadows and the majestic Kaghan Valley.'],
                ['name' => 'Murree', 'image' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?auto=format&fit=crop&w=900&q=80', 'description' => 'Cool hills and scenic drives close to the capital.'],
                ['name' => 'Fairy Meadows', 'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80', 'description' => 'A magical meadow with views of Nanga Parbat.'],
                ['name' => 'Neelum Valley', 'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80', 'description' => 'Beautiful valley scenery and peaceful mountain vibes.'],
                ['name' => 'Lahore', 'image' => 'https://images.unsplash.com/photo-1582550945154-66ea8fff25e1?auto=format&fit=crop&w=900&q=80', 'description' => 'Historic streets, heritage, and vibrant food culture.'],
                ['name' => 'Islamabad', 'image' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=900&q=80', 'description' => 'Modern elegance blended with natural beauty.'],
                ['name' => 'Karachi', 'image' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=900&q=80', 'description' => 'Sea views, city life, and rich coastal charm.'],
            ];
            foreach ($destinations as $destination):
            ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="destination-card h-100">
                    <img src="<?= e($destination['image']); ?>" alt="<?= e($destination['name']); ?>" class="card-image">
                    <div class="card-body">
                        <h5 class="fw-bold mb-2"><?= e($destination['name']); ?></h5>
                        <p class="text-muted mb-3"><?= e($destination['description']); ?></p>
                        <a href="<?= BASE_URL; ?>/tour-details.php?id=1" class="btn btn-outline-gold rounded-pill">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding light-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Featured Packages</span>
            <h2 class="section-title">Handpicked Tour Packages</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($featuredTours as $tour): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="package-card h-100">
                        <img src="<?= e(imageUrl($tour['image'], DEFAULT_TOUR_IMAGE)); ?>" alt="<?= e($tour['title']); ?>" class="card-image">
                        <div class="card-body d-flex flex-column">
                            <div class="card-meta mb-2"><?= e($tour['destination']); ?></div>
                            <h4 class="fw-bold mb-2"><?= e($tour['title']); ?></h4>
                            <div class="d-flex justify-content-between text-muted small mb-3">
                                <span><i class="fa-regular fa-clock me-1"></i><?= e($tour['duration']); ?></span>
                                <span class="card-price"><?= e(formatPrice($tour['price'])); ?></span>
                            </div>
                            <p class="text-muted mb-3"><?= e(substr($tour['short_description'], 0, 120)); ?>...</p>
                            <a href="<?= BASE_URL; ?>/tour-details.php?id=<?= (int) $tour['id']; ?>" class="btn btn-gold rounded-pill mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Why Choose Us</span>
            <h2 class="section-title">Your Journey, Our Expertise</h2>
        </div>
        <div class="row g-4">
            <?php
            $features = [
                ['title' => 'Experienced Tour Guides', 'icon' => 'fa-user-check', 'description' => 'Local experts who know every route, route, and hidden gem.'],
                ['title' => 'Affordable Packages', 'icon' => 'fa-wallet', 'description' => 'Value-driven packages designed for all budgets.'],
                ['title' => 'Safe & Comfortable Travel', 'icon' => 'fa-shield-heart', 'description' => 'Secure tour planning with smooth transport and comfort.'],
                ['title' => '24/7 Customer Support', 'icon' => 'fa-headset', 'description' => 'Friendly assistance whenever you need help before or during travel.'],
            ];
            foreach ($features as $feature):
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="fa-solid <?= e($feature['icon']); ?>"></i></div>
                    <h5 class="fw-bold mb-2"><?= e($feature['title']); ?></h5>
                    <p class="text-muted mb-0"><?= e($feature['description']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding light-section">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <span class="section-tag">About Pakistan Tourism</span>
                <h2 class="section-title">Pakistan Is One of the World’s Most Beautiful Travel Frontiers</h2>
                <p class="text-muted">From the snow-capped peaks of the north to the historic beauty of Lahore, Pakistan offers a broad range of experiences for adventurous travelers, families, and culture lovers. Whether you want serene valleys, rugged treks, or vibrant urban exploration, Pakistan delivers unforgettable stories.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>World-class mountain landscapes and trekking routes</li>
                    <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Historic cities, forts, mosques, and heritage sites</li>
                    <li class="mb-2"><i class="fa-solid fa-circle-check text-success me-2"></i>Welcoming local culture and diverse cuisine</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img src="<?= e(HERO_IMAGE); ?>" alt="Pakistan mountain landscape" class="rounded-4 shadow" style="height: 500px; object-fit: cover; width: 100%;">
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Ready to Explore Pakistan?</h2>
        <p class="mb-4 mx-auto" style="max-width: 700px; color: rgba(255,255,255,0.82);">Let us help you plan a journey filled with unforgettable scenery, culture, and memories.</p>
        <a href="<?= BASE_URL; ?>/contact.php" class="btn btn-gold btn-lg rounded-pill px-4">Plan Your Trip</a>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Latest Blog</span>
            <h2 class="section-title">Travel Inspiration & Guides</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($latestArticles as $article): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="article-card h-100">
                        <img src="<?= e(imageUrl($article['featured_image'], DEFAULT_ARTICLE_IMAGE)); ?>" class="card-image" alt="<?= e($article['title']); ?>">
                        <div class="card-body d-flex flex-column">
                            <div class="card-meta mb-2"><?= e(date('d M Y', strtotime($article['created_at']))); ?> • <?= e($article['author']); ?></div>
                            <h4 class="fw-bold mb-2"><?= e($article['title']); ?></h4>
                            <p class="text-muted mb-3"><?= e(substr($article['short_description'], 0, 120)); ?>...</p>
                            <a href="<?= BASE_URL; ?>/article-details.php?id=<?= (int) $article['id']; ?>" class="btn btn-outline-gold rounded-pill mt-auto">Read More</a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
