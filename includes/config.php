<?php
// db connection settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'laptop_shop');

// base path for links and stuff
define('BASE_PATH', '/gaming-laptop-store');

// upload folder for product images
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('UPLOAD_URL', BASE_PATH . '/uploads/');

// start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>