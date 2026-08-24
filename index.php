<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../includes/functions.php';

if (!isAdminLoggedIn()) {
    redirect(BASE_URL . '/admin/login.php');
}

$pageTitle = 'Admins';
$pdo = getDb();
$admins = $pdo->query('SELECT * FROM admins ORDER BY created_at DESC')->fetchAll();

include __DIR__ . '/../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-0">Admin Users</h3>
    </div>
    <a href="<?= BASE_URL; ?>/admin/admins/create.php" class="btn btn-gold rounded-pill">Add Admin</a>
</div>

<div class="page-card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($admins)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No admin users found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($admins as $adminUser): ?>
                        <tr>
                            <td><?= e($adminUser['id']); ?></td>
                            <td><?= e($adminUser['name']); ?></td>
                            <td><?= e($adminUser['email']); ?></td>
                            <td><?= e(ucfirst($adminUser['role'])); ?></td>
                            <td>
                                <span class="badge-status <?= $adminUser['status'] === 'active' ? 'badge-published' : 'badge-draft'; ?>"><?= e(ucfirst($adminUser['status'])); ?></span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?= BASE_URL; ?>/admin/admins/edit.php?id=<?= (int) $adminUser['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="<?= BASE_URL; ?>/admin/admins/delete.php" method="post" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= e(generateCsrfToken()); ?>">
                                        <input type="hidden" name="id" value="<?= (int) $adminUser['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger delete-confirm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
