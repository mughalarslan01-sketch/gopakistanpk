<?php

function getPublishedTours($limit = null)
{
    $pdo = getDb();
    $sql = 'SELECT * FROM tours WHERE status = :status ORDER BY created_at DESC';

    if ($limit !== null && is_numeric($limit)) {
        $sql .= ' LIMIT :limit';
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':status', 'published', PDO::PARAM_STR);

    if ($limit !== null && is_numeric($limit)) {
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll();
}

function getTourById($id)
{
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT * FROM tours WHERE id = :id LIMIT 1');
    $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function getPublishedArticles($limit = null, $page = 1)
{
    $pdo = getDb();
    $offset = ($page > 1) ? ($page - 1) * $limit : 0;

    $sql = 'SELECT * FROM articles WHERE status = :status ORDER BY created_at DESC';

    if ($limit !== null && is_numeric($limit)) {
        $sql .= ' LIMIT :limit OFFSET :offset';
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':status', 'published', PDO::PARAM_STR);

    if ($limit !== null && is_numeric($limit)) {
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll();
}

function getArticleById($id)
{
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT * FROM articles WHERE id = :id AND status = :status LIMIT 1');
    $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $stmt->bindValue(':status', 'published', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch();
}

function getLatestArticles($limit = 3)
{
    return getPublishedArticles($limit, 1);
}

function getRelatedArticles($excludeId, $limit = 3)
{
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT * FROM articles WHERE status = :status AND id != :excludeId ORDER BY created_at DESC LIMIT :limit');
    $stmt->bindValue(':status', 'published', PDO::PARAM_STR);
    $stmt->bindValue(':excludeId', (int) $excludeId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTotalCount($table)
{
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM ' . $table);
    $stmt->execute();
    return (int) $stmt->fetch()['total'];
}

function generateSlug($text)
{
    $slug = strtolower(trim($text));
    $slug = preg_replace('/[^a-z0-9-]+/i', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug ?: 'untitled';
}

function uploadImage($file, $folder)
{
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Image upload failed.'];
    }

    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    $maxFileSize = 2 * 1024 * 1024;

    $mime = mime_content_type($file['tmp_name']);
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($mime, $allowedTypes, true) || !in_array($extension, $allowedExtensions, true)) {
        return ['success' => false, 'message' => 'Only JPG, JPEG, PNG, and WebP images are allowed.'];
    }

    if ((int) $file['size'] > $maxFileSize) {
        return ['success' => false, 'message' => 'Image size must be less than 2MB.'];
    }

    $directory = APP_ROOT . '/uploads/' . $folder;
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $filename = uniqid('img_', true) . '.' . $extension;
    $destination = $directory . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => false, 'message' => 'Failed to move uploaded image.'];
    }

    return ['success' => true, 'filename' => $filename, 'path' => $destination];
}

function getAdminUserByEmail($email)
{
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch();
}

function isAdminLoggedIn()
{
    static $checked = false;
    static $authenticated = false;

    if ($checked) {
        return $authenticated;
    }

    $checked = true;
    if (empty($_SESSION['admin_id'])) {
        return false;
    }

    $stmt = getDb()->prepare('SELECT id FROM admins WHERE id = :id AND status = :status LIMIT 1');
    $stmt->execute([
        ':id' => (int) $_SESSION['admin_id'],
        ':status' => 'active',
    ]);
    $authenticated = (bool) $stmt->fetchColumn();

    if (!$authenticated) {
        unset($_SESSION['admin_id'], $_SESSION['admin_name'], $_SESSION['admin_role']);
    }

    return $authenticated;
}

function currentAdmin()
{
    if (!isAdminLoggedIn()) {
        return null;
    }

    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE id = :id LIMIT 1');
    $stmt->bindValue(':id', (int) $_SESSION['admin_id'], PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function renderAdminAlert($message, $type = 'success')
{
    echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' . e($message) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
