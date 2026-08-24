<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect(BASE_URL . '/index.php');
}

$tour = getTourById($id);
if (!$tour) {
    redirect(BASE_URL . '/index.php');
}

$pageTitle = $tour['title'] . ' | GoPakistan.PK';
$metaDescription = $tour['short_description'];

$latestTours = getPublishedTours(3);

include __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/index.php">Tours</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= e($tour['title']); ?></li>
            </ol>
        </nav>
        <h1><?= e($tour['title']); ?></h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <img src="<?= e(imageUrl($tour['image'], DEFAULT_TOUR_IMAGE)); ?>" alt="<?= e($tour['title']); ?>" class="rounded-4 shadow mb-4" style="width: 100%; height: 520px; object-fit: cover;">
                <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                    <span class="badge bg-success rounded-pill px-3 py-2"><?= e($tour['destination']); ?></span>
                    <span class="badge bg-light text-dark px-3 py-2"><?= e($tour['duration']); ?></span>
                    <span class="badge bg-warning text-dark px-3 py-2"><?= e(formatPrice($tour['price'])); ?></span>
                </div>
                <h3 class="fw-bold mb-3">Overview</h3>
                <p class="text-muted"><?= nl2br(e($tour['description'])); ?></p>
            </div>
            <div class="col-lg-4">
                <div class="page-card sticky-top" style="top: 100px;">
                    <h4 class="fw-bold mb-3">Tour Summary</h4>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3"><strong>Destination:</strong> <?= e($tour['destination']); ?></li>
                        <li class="mb-3"><strong>Duration:</strong> <?= e($tour['duration']); ?></li>
                        <li class="mb-3"><strong>Price:</strong> <?= e(formatPrice($tour['price'])); ?></li>
                    </ul>
                    <a href="<?= BASE_URL; ?>/contact.php" class="btn btn-gold w-100 rounded-pill mb-2">Book This Tour</a>
                    <a href="<?= BASE_URL; ?>/index.php" class="btn btn-outline-gold w-100 rounded-pill">Explore More Tours</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding light-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-tag">More Tours</span>
            <h2 class="section-title">Explore Other Popular Packages</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($latestTours as $relatedTour): ?>
                <?php if ((int) $relatedTour['id'] !== (int) $tour['id']): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="package-card h-100">
                            <img src="<?= e(imageUrl($relatedTour['image'], DEFAULT_TOUR_IMAGE)); ?>" alt="<?= e($relatedTour['title']); ?>" class="card-image">
                            <div class="card-body d-flex flex-column">
                                <div class="card-meta mb-2"><?= e($relatedTour['destination']); ?></div>
                                <h5 class="fw-bold mb-2"><?= e($relatedTour['title']); ?></h5>
                                <div class="d-flex justify-content-between text-muted small mb-3">
                                    <span><i class="fa-regular fa-clock me-1"></i><?= e($relatedTour['duration']); ?></span>
                                    <span class="card-price"><?= e(formatPrice($relatedTour['price'])); ?></span>
                                </div>
                                <a href="<?= BASE_URL; ?>/tour-details.php?id=<?= (int) $relatedTour['id']; ?>" class="btn btn-gold rounded-pill mt-auto">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
