<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../includes/functions.php';

if (!isAdminLoggedIn()) {
    redirect(BASE_URL . '/admin/login.php');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . '/admin/admins/index.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
    redirect(BASE_URL . '/admin/admins/index.php');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect(BASE_URL . '/admin/admins/index.php');
}

$pdo = getDb();
$stmt = $pdo->prepare('DELETE FROM admins WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

flash('admin_message', $stmt->rowCount() ? 'Admin deleted successfully.' : 'Admin was not found.');

redirect(BASE_URL . '/admin/admins/index.php');
