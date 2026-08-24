<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../includes/functions.php';

if (!isAdminLoggedIn()) {
    redirect(BASE_URL . '/admin/login.php');
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect(BASE_URL . '/admin/admins/index.php');
}

$pdo = getDb();
$stmt = $pdo->prepare('SELECT * FROM admins WHERE id = :id LIMIT 1');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$adminUser = $stmt->fetch();

if (!$adminUser) {
    redirect(BASE_URL . '/admin/admins/index.php');
}

$pageTitle = 'Edit Admin';
$errors = [];
$inputs = [
    'name' => $adminUser['name'],
    'email' => $adminUser['email'],
    'role' => $adminUser['role'],
    'status' => $adminUser['status'],
    'password' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Invalid security token.';
    } else {
        $inputs = [
            'name' => sanitizeText($_POST['name'] ?? ''),
            'email' => sanitizeText($_POST['email'] ?? ''),
            'role' => in_array($_POST['role'] ?? 'admin', ['admin', 'super_admin'], true) ? $_POST['role'] : 'admin',
            'status' => in_array($_POST['status'] ?? 'active', ['active', 'inactive'], true) ? $_POST['status'] : 'active',
            'password' => $_POST['password'] ?? '',
        ];

        if ($inputs['name'] === '' || $inputs['email'] === '') {
            $errors[] = 'Name and email are required.';
        }

        if (!filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        if (!empty($inputs['password']) && strlen($inputs['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters.';
        }

        $existing = getAdminUserByEmail($inputs['email']);
        if ($existing && (int) $existing['id'] !== (int) $id) {
            $errors[] = 'An admin with this email already exists.';
        }

        if (empty($errors)) {
            $query = 'UPDATE admins SET name = :name, email = :email, role = :role, status = :status, updated_at = NOW()';
            $params = [
                ':name' => $inputs['name'],
                ':email' => $inputs['email'],
                ':role' => $inputs['role'],
                ':status' => $inputs['status'],
                ':id' => $id,
            ];

            if ($inputs['password'] !== '') {
                $query .= ', password = :password';
                $params[':password'] = password_hash($inputs['password'], PASSWORD_DEFAULT);
            }

            $query .= ' WHERE id = :id';
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);

            redirect(BASE_URL . '/admin/admins/index.php');
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Edit Admin</h3>
    <a href="<?= BASE_URL; ?>/admin/admins/index.php" class="btn btn-outline-secondary">Back</a>
</div>

<div class="page-card">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(generateCsrfToken()); ?>">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?= e($inputs['name']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= e($inputs['email']); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="admin" <?= $inputs['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="super_admin" <?= $inputs['role'] === 'super_admin' ? 'selected' : ''; ?>>Super Admin</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" <?= $inputs['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?= $inputs['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">New Password (optional)</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-gold">Update Admin</button>
            </div>
        </div>
    </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
