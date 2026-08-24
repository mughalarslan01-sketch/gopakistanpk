<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../includes/functions.php';

if (!isAdminLoggedIn()) {
    redirect(BASE_URL . '/admin/login.php');
}

$pageTitle = 'Add Admin';
$errors = [];
$inputs = [
    'name' => '',
    'email' => '',
    'password' => '',
    'role' => 'admin',
    'status' => 'active',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Invalid security token.';
    } else {
        $inputs = [
            'name' => sanitizeText($_POST['name'] ?? ''),
            'email' => sanitizeText($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'role' => in_array($_POST['role'] ?? 'admin', ['admin', 'super_admin'], true) ? $_POST['role'] : 'admin',
            'status' => in_array($_POST['status'] ?? 'active', ['active', 'inactive'], true) ? $_POST['status'] : 'active',
        ];

        if ($inputs['name'] === '' || $inputs['email'] === '' || $inputs['password'] === '') {
            $errors[] = 'Name, email, and password are required.';
        }

        if (!filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        $existing = getAdminUserByEmail($inputs['email']);
        if ($existing) {
            $errors[] = 'An admin with this email already exists.';
        }

        if (empty($errors)) {
            $pdo = getDb();
            $stmt = $pdo->prepare('INSERT INTO admins (name, email, password, role, status) VALUES (:name, :email, :password, :role, :status)');
            $stmt->execute([
                ':name' => $inputs['name'],
                ':email' => $inputs['email'],
                ':password' => password_hash($inputs['password'], PASSWORD_DEFAULT),
                ':role' => $inputs['role'],
                ':status' => $inputs['status'],
            ]);

            redirect(BASE_URL . '/admin/admins/index.php');
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Add Admin</h3>
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
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-gold">Save Admin</button>
            </div>
        </div>
    </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
