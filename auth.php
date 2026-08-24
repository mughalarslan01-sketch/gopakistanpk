<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isAdminLoggedIn()) {
    redirect(BASE_URL . '/admin/login.php');
}
