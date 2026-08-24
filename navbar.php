<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL; ?>/index.php">GoPakistan.PK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link <?= getCurrentRoute() === 'index.php' ? 'active' : ''; ?>" href="<?= BASE_URL; ?>/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link <?= getCurrentRoute() === 'about.php' ? 'active' : ''; ?>" href="<?= BASE_URL; ?>/about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link <?= getCurrentRoute() === 'services.php' ? 'active' : ''; ?>" href="<?= BASE_URL; ?>/services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link <?= getCurrentRoute() === 'tour-details.php' || getCurrentRoute() === 'tours.php' ? 'active' : ''; ?>" href="<?= BASE_URL; ?>/tour-details.php?id=1">Tours</a></li>
                <li class="nav-item"><a class="nav-link <?= getCurrentRoute() === 'blog.php' || getCurrentRoute() === 'article-details.php' ? 'active' : ''; ?>" href="<?= BASE_URL; ?>/blog.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link <?= getCurrentRoute() === 'contact.php' ? 'active' : ''; ?>" href="<?= BASE_URL; ?>/contact.php">Contact</a></li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-gold btn-sm rounded-pill px-3" href="<?= BASE_URL; ?>/tour-details.php?id=1">Explore Tours</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
