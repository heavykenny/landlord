<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Require the Composer autoloader - ensure composer dependencies are installed
require __DIR__ . '/vendor/autoload.php';

// Load configuration (e.g., database settings)
$config = require __DIR__ . '/src/config/database.php';

// Get the path from the URL and the request method
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Simple routing mechanism (assuming URLs in the format /controller/method)
$segments = explode('/', trim($requestUri, '/'));

$controllerName = isset($segments[2]) ? ucfirst($segments[2]) . 'Controller' : 'HomeController';
$methodName = $segments[3] ?? 'index';
$parameters = $segments[4] ?? null;

// Build the fully-qualified class name
$controllerClass = "App\\Controllers\\$controllerName";

// Instantiate the controller and call the method
if (class_exists($controllerClass) && method_exists($controllerClass, $methodName)) {
    $controller = new $controllerClass($config);
    header("Content-Type: application/json");

    if ($parameters !== null) {
        echo json_encode($controller->$methodName($parameters));
        exit;
    }
    echo json_encode($controller->$methodName());
} else {
    header("Content-Type: application/json");
    http_response_code(404);

    echo json_encode([
        'status' => 'error',
        'message' => 'Not found'
    ]);
}
