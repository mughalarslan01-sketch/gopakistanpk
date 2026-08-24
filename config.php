<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/database.php';

define('APP_ROOT', dirname(__DIR__));
define('SITE_NAME', 'GoPakistan.PK');
define('SITE_TAGLINE', 'Explore Pakistan. Experience the Extraordinary.');
$documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;
$appRoot = realpath(APP_ROOT);
$basePath = ($documentRoot && $appRoot && str_starts_with($appRoot, $documentRoot))
    ? str_replace('\\', '/', substr($appRoot, strlen($documentRoot)))
    : '/gopakistan';
define('BASE_URL', 'http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . rtrim($basePath, '/'));
define('UPLOAD_PATH', APP_ROOT . '/uploads');
define('UPLOAD_URL', BASE_URL . '/uploads');
define('DEFAULT_TOUR_IMAGE', BASE_URL . '/assets/images/default-tour.jpg');
define('DEFAULT_ARTICLE_IMAGE', BASE_URL . '/assets/images/default-article.jpg');
define('HERO_IMAGE', BASE_URL . '/assets/images/hero-pakistan.jpg');
define('ABOUT_IMAGE', BASE_URL . '/assets/images/about-valley.svg');

define('CONTACT_ADDRESS', 'Quetta, Pakistan');
define('CONTACT_PHONE', '+92 309 8804181');
define('CONTACT_EMAIL', 'hello@gopakistan.pk');
define('CONTACT_HOURS', 'Mon - Sat: 9:00 AM - 7:00 PM');

date_default_timezone_set('Asia/Karachi');

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function sanitizeText($value)
{
    return trim((string) $value);
}

function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrfToken($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string) $token);
}

function imageUrl($image, $fallback)
{
    if (empty($image)) {
        return $fallback;
    }

    $legacyBaseUrl = 'http://localhost/gopakistan';
    if (strpos($image, $legacyBaseUrl . '/uploads/') === 0) {
        return BASE_URL . substr($image, strlen($legacyBaseUrl));
    }

    if (strpos($image, '/uploads/') === 0) {
        return BASE_URL . $image;
    }

    if (strpos($image, 'uploads/') === 0) {
        return BASE_URL . '/' . $image;
    }

    return $image;
}

function flash($key, $message = null)
{
    if ($message === null) {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $message;
        }

        return null;
    }

    $_SESSION[$key] = $message;
}

function formatPrice($price)
{
    return 'PKR ' . number_format((float) $price, 0);
}

function getCurrentRoute()
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    return strtolower($currentPage);
}
