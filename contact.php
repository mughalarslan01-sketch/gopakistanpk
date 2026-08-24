<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Contact Us | GoPakistan.PK';
$metaDescription = 'Get in touch with GoPakistan.PK for custom travel planning, tour booking, and Pakistan travel support.';

$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeText($_POST['name'] ?? '');
    $email = sanitizeText($_POST['email'] ?? '');
    $phone = sanitizeText($_POST['phone'] ?? '');
    $subject = sanitizeText($_POST['subject'] ?? '');
    $message = sanitizeText($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $subject === '' || $message === '') {
        $errors[] = 'Please complete all required fields.';
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (strlen($name) > 120 || strlen($subject) > 180 || strlen($message) > 5000) {
        $errors[] = 'One or more fields exceed the allowed length.';
    }

    if (empty($errors)) {
        $pdo = getDb();
        $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, phone, subject, message, status) VALUES (:name, :email, :phone, :subject, :message, :status)');
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message,
            ':status' => 'new',
        ]);

        $successMessage = 'Thank you! Your message has been sent successfully.';
        $_POST = [];
    }
}

include __DIR__ . '/includes/header.php';
?>
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>
        <h1>Contact Us</h1>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="page-card h-100">
                    <h3 class="fw-bold mb-4">Get in Touch</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fa-solid fa-location-dot text-success me-2"></i><?= e(CONTACT_ADDRESS); ?></li>
                        <li class="mb-3"><i class="fa-solid fa-phone text-success me-2"></i><?= e(CONTACT_PHONE); ?></li>
                        <li class="mb-3"><i class="fa-solid fa-envelope text-success me-2"></i><?= e(CONTACT_EMAIL); ?></li>
                        <li class="mb-3"><i class="fa-solid fa-clock text-success me-2"></i><?= e(CONTACT_HOURS); ?></li>
                    </ul>
                    <div class="rounded-4 overflow-hidden mt-4">
                        <iframe src="https://www.google.com/maps?q=Quetta%20Pakistan&output=embed" style="width:100%; min-height: 260px; border:0;" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="page-card">
                    <h3 class="fw-bold mb-4">Send Us a Message</h3>

                    <?php if ($successMessage !== ''): ?>
                        <div class="alert alert-success"><?= e($successMessage); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= e($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="post" id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="<?= e($_POST['name'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= e($_POST['email'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control" value="<?= e($_POST['phone'] ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" value="<?= e($_POST['subject'] ?? ''); ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="6" required><?= e($_POST['message'] ?? ''); ?></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-gold rounded-pill px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
