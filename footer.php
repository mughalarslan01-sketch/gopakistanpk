<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title">GoPakistan.PK</h5>
                <p class="footer-text">We help travelers experience the beauty, culture, and adventure of Pakistan through expertly designed domestic travel experiences.</p>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-subtitle">Quick Links</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= BASE_URL; ?>/index.php">Home</a></li>
                    <li><a href="<?= BASE_URL; ?>/about.php">About Us</a></li>
                    <li><a href="<?= BASE_URL; ?>/services.php">Services</a></li>
                    <li><a href="<?= BASE_URL; ?>/blog.php">Blog</a></li>
                    <li><a href="<?= BASE_URL; ?>/contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-subtitle">Popular Destinations</h6>
                <ul class="list-unstyled footer-links">
                    <li>Hunza</li>
                    <li>Skardu</li>
                    <li>Swat</li>
                    <li>Naran</li>
                    <li>Murree</li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-subtitle">Contact</h6>
                <ul class="list-unstyled footer-links">
                    <li><i class="fa-solid fa-phone me-2"></i><?= e(CONTACT_PHONE); ?></li>
                    <li><i class="fa-solid fa-envelope me-2"></i><?= e(CONTACT_EMAIL); ?></li>
                    <li><i class="fa-solid fa-location-dot me-2"></i><?= e(CONTACT_ADDRESS); ?></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom mt-4 pt-3">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-2">
                <p class="mb-0">© 2026 GoPakistan.PK. All Rights Reserved.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.12.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
