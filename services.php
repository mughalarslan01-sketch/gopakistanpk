<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Travel Services | GoPakistan.PK';
$metaDescription = 'Explore travel packages, hotel assistance, transport services, family tours, and personalized tours in Pakistan.';

include __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Services</li>
            </ol>
        </nav>
        <h1>Travel Services</h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Our Services</span>
            <h2 class="section-title">Everything you need for a seamless travel experience</h2>
        </div>
        <div class="row g-4">
            <?php
            $services = [
                ['title' => 'Tour Packages', 'icon' => 'fa-map-location-dot', 'description' => 'Customized domestic tour packages across Pakistan, designed for adventure, heritage, and family travel.'],
                ['title' => 'Hotel Booking', 'icon' => 'fa-hotel', 'description' => 'Accommodation support for comfortable stays in mountains, cities, and tourist destinations.'],
                ['title' => 'Transport Services', 'icon' => 'fa-bus', 'description' => 'Cars, vans, and reliable transport arrangements to keep your itinerary smooth.'],
                ['title' => 'Adventure Tours', 'icon' => 'fa-mountain-sun', 'description' => 'Trekking, hiking, camping, and high-altitude adventures for thrill seekers.'],
                ['title' => 'Family Tours', 'icon' => 'fa-people-roof', 'description' => 'Safe and comfortable packages that balance fun, relaxation, and convenience.'],
                ['title' => 'Customized Tours', 'icon' => 'fa-route', 'description' => 'Personalized itineraries built around your time, budget, and travel vision.'],
            ];
            foreach ($services as $service):
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 text-center">
                    <div class="feature-icon"><i class="fa-solid <?= e($service['icon']); ?>"></i></div>
                    <h4 class="fw-bold"><?= e($service['title']); ?></h4>
                    <p class="text-muted mb-0"><?= e($service['description']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
