<?php

//require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../config/database.php';
//require_once __DIR__ . '/../controllers/bookController.php';
//require_once __DIR__ . '/../routes/routes.php';
//
//use Dotenv\Dotenv\Dotenv;
//
//// Enable error reporting
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//
//
//$config = require_once __DIR__ . '/../config/database.php';
//
//try {
//    $pdo = new PDO(
//        "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}",
//        $config['username'],
//        $config['password']
//    );
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//    echo 'Database connected successfully.';
//} catch (PDOException $e) {
//    die("Database connection failed: " . $e->getMessage());
//}


//require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../config/database.php';
//require_once __DIR__ . '/../controllers/bookController.php';
//require_once __DIR__ . '/../routes/routes.php';
//
//use Dotenv\Dotenv;
//
//// Load environment variables
//$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
//$dotenv->load();
//
//// Set up the database connection
//$config = require_once __DIR__ . '/../config/database.php';
//$pdo = new PDO(
//    "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}",
//    $config['username'],
//    $config['password']
//);
//
//// Instantiate the controller
//$bookController = new BookController($pdo);
//
//// Parse the request URI
//$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//
//// Route the request
//if ($_SERVER['REQUEST_METHOD'] === 'POST' && $requestUri === '/books') {
//    $bookController->createBook();
//} else {
//    http_response_code(404);
//    echo json_encode(['message' => 'Not Found']);
//}


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/bookController.php';

use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Database configuration
$config = [
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'database' => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8mb4'
];

// Set up the database connection with error handling
try {
    $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Instantiate the controller
$bookController = new BookController($pdo);

// Include routes
require_once __DIR__ . '/../routes/routes.php';