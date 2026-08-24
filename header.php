<?php
if (!isset($pageTitle)) {
    $pageTitle = SITE_NAME;
}
if (!isset($metaDescription)) {
    $metaDescription = 'Discover Pakistan with GoPakistan.PK. Explore tours, destinations, travel services, and travel inspiration across the country.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($metaDescription); ?>">
    <meta name="keywords" content="Pakistan tourism, travel packages, Hunza, Skardu, Swat, Naran, tours, GoPakistan PK">
    <meta name="author" content="GoPakistan.PK">
    <title><?= e($pageTitle); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/navbar.php'; ?>
