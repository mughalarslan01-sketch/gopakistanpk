<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$limit = 6;
$articles = getPublishedArticles($limit, $page);
$totalArticles = getTotalCount('articles');
$totalPages = (int) ceil($totalArticles / $limit);

$pageTitle = 'Pakistan Travel Blog | GoPakistan.PK';
$metaDescription = 'Read Pakistan travel guides, destination insights, and tour inspiration from GoPakistan.PK.';

include __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </nav>
        <h1>Pakistan Travel Blog</h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($articles as $article): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="article-card h-100">
                        <img src="<?= e(imageUrl($article['featured_image'], DEFAULT_ARTICLE_IMAGE)); ?>" alt="<?= e($article['title']); ?>" class="card-image">
                        <div class="card-body d-flex flex-column">
                            <div class="card-meta mb-2"><?= e(date('d M Y', strtotime($article['created_at']))); ?> • <?= e($article['author']); ?></div>
                            <h4 class="fw-bold mb-2"><?= e($article['title']); ?></h4>
                            <p class="text-muted mb-3"><?= e(substr($article['short_description'], 0, 130)); ?>...</p>
                            <a href="<?= BASE_URL; ?>/article-details.php?id=<?= (int) $article['id']; ?>" class="btn btn-outline-gold rounded-pill mt-auto">Read More</a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($totalPages > 1): ?>
            <nav class="mt-5 d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= BASE_URL; ?>/blog.php?page=<?= max(1, $page - 1); ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $page ? 'active' : ''; ?>">
                            <a class="page-link" href="<?= BASE_URL; ?>/blog.php?page=<?= $i; ?>"><?= e($i); ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= BASE_URL; ?>/blog.php?page=<?= min($totalPages, $page + 1); ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
