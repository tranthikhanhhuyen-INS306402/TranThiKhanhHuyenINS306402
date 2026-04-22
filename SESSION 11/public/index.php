<?php
// public/index.php
require_once __DIR__ . '/../controllers/EntityController.php';

$controller = new EntityController();
$action = $_GET['action'] ?? 'index';

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
}