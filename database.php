<?php

$databaseConfig = [
    'host' => 'localhost',
    'dbname' => 'gopakistan',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];

try {
    $pdo = new PDO(
        'mysql:host=' . $databaseConfig['host'] . ';dbname=' . $databaseConfig['dbname'] . ';charset=' . $databaseConfig['charset'],
        $databaseConfig['username'],
        $databaseConfig['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    if (isset($_SERVER['HTTP_HOST'])) {
        error_log('GoPakistan database connection failed: ' . $e->getMessage());
        http_response_code(503);
        echo '<div class="container mt-5"><div class="alert alert-danger">We are currently unable to connect to the database. Please try again later.</div></div>';
        exit;
    }

    throw $e;
}

function getDb(): PDO
{
    global $pdo;
    return $pdo;
}
