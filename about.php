<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'About Us | GoPakistan.PK';
$metaDescription = 'Learn about GoPakistan.PK and our mission to make Pakistan travel unforgettable.';

include __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </nav>
        <h1>About GoPakistan.PK</h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <span class="section-tag">Who We Are</span>
                <h2 class="section-title">We make discovering Pakistan effortless and memorable.</h2>
                <p class="text-muted">GoPakistan.PK was founded to help travelers experience the beauty, culture, and adventure of Pakistan through carefully planned travel experiences. We combine local insight with professional planning to create journeys that feel personal, secure, and inspiring.</p>
                <p class="text-muted">From mountain excursions in the north to heritage tours in Lahore and Karachi, we create itineraries that reflect the diversity and magic of Pakistan.</p>
            </div>
            <div class="col-lg-6">
                <img src="<?= e(ABOUT_IMAGE); ?>" alt="Mountain landscape in Pakistan" class="rounded-4 shadow" style="height: 480px; object-fit: cover; width: 100%;">
            </div>
        </div>
    </div>
</section>

<section class="section-padding light-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="info-box h-100">
                    <span class="section-tag">Our Mission</span>
                    <h3 class="mt-3 fw-bold">To inspire meaningful travel across Pakistan.</h3>
                    <p class="text-muted mb-0">We aim to provide well-organized, trustworthy, and enjoyable travel experiences that help people connect with Pakistan’s landscapes, communities, and heritage.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box h-100">
                    <span class="section-tag">Our Vision</span>
                    <h3 class="mt-3 fw-bold">To become the preferred travel partner for domestic tourism.</h3>
                    <p class="text-muted mb-0">We envision a future where more travelers discover the beauty of Pakistan through safe, authentic, and expertly guided experiences.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Why Travel With Us</span>
            <h2 class="section-title">Trusted by travelers seeking unforgettable journeys</h2>
        </div>
        <div class="row g-4">
            <?php
            $reasons = [
                ['title' => 'Tailored Itineraries', 'text' => 'Every trip is built around your goals, interests, and travel style.'],
                ['title' => 'Local Knowledge', 'text' => 'Our team understands routes, destinations, local culture, and traveler expectations.'],
                ['title' => 'Transparent Service', 'text' => 'No hidden surprises — just honest pricing, clear planning, and attentive support.'],
                ['title' => 'Complete Support', 'text' => 'From booking to arrival, we guide you at every step of your journey.'],
            ];
            foreach ($reasons as $reason):
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="fa-solid fa-earth-asia"></i></div>
                    <h5 class="fw-bold"><?= e($reason['title']); ?></h5>
                    <p class="text-muted mb-0"><?= e($reason['text']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding light-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Our Values</span>
            <h2 class="section-title">What guides every experience we create</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="info-box h-100">
                    <h5 class="fw-bold">Integrity</h5>
                    <p class="text-muted mb-0">We believe in honest advice, transparent communication, and responsible tourism.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="info-box h-100">
                    <h5 class="fw-bold">Safety</h5>
                    <p class="text-muted mb-0">Tour plans prioritize traveler comfort, route safety, and well-managed logistics.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="info-box h-100">
                    <h5 class="fw-bold">Authenticity</h5>
                    <p class="text-muted mb-0">We value genuine experiences that connect visitors to the true spirit of Pakistan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">Impact</span>
            <h2 class="section-title">Numbers that reflect trust and growth</h2>
        </div>
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card h-100">
                    <div class="stat-number">500+</div>
                    <div class="text-muted">Happy Travelers</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card h-100">
                    <div class="stat-number">50+</div>
                    <div class="text-muted">Tour Packages</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card h-100">
                    <div class="stat-number">20+</div>
                    <div class="text-muted">Destinations</div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card h-100">
                    <div class="stat-number">24/7</div>
                    <div class="text-muted">Support</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
