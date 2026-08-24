<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect(BASE_URL . '/blog.php');
}

$article = getArticleById($id);
if (!$article) {
    redirect(BASE_URL . '/blog.php');
}

$pageTitle = $article['title'] . ' | GoPakistan.PK';
$metaDescription = $article['short_description'];
$relatedArticles = getRelatedArticles((int) $article['id'], 3);

include __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/blog.php">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= e($article['title']); ?></li>
            </ol>
        </nav>
        <h1><?= e($article['title']); ?></h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <img src="<?= e(imageUrl($article['featured_image'], DEFAULT_ARTICLE_IMAGE)); ?>" alt="<?= e($article['title']); ?>" class="rounded-4 shadow mb-4" style="width: 100%; height: 480px; object-fit: cover;">
                <div class="text-muted mb-4">
                    <span><i class="fa-regular fa-user me-2"></i><?= e($article['author']); ?></span>
                    <span class="mx-3">•</span>
                    <span><i class="fa-regular fa-calendar me-2"></i><?= e(date('d M Y', strtotime($article['created_at']))); ?></span>
                </div>
                <div class="article-content text-muted">
                    <?= nl2br(e($article['content'])); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-card">
                    <h4 class="fw-bold mb-3">Related Articles</h4>
                    <div class="d-grid gap-3">
                        <?php foreach ($relatedArticles as $related): ?>
                            <div class="d-flex gap-3 align-items-start">
                                <img src="<?= e(imageUrl($related['featured_image'], DEFAULT_ARTICLE_IMAGE)); ?>" alt="<?= e($related['title']); ?>" style="width: 90px; height: 90px; object-fit: cover; border-radius: 12px;">
                                <div>
                                    <a href="<?= BASE_URL; ?>/article-details.php?id=<?= (int) $related['id']; ?>" class="fw-bold text-dark d-block mb-1"><?= e($related['title']); ?></a>
                                    <small class="text-muted"><?= e(date('d M Y', strtotime($related['created_at']))); ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
