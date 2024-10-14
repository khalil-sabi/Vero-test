<?php
$request = $_SERVER['REQUEST_URI'];

$request = strtok($request, '?');

// Define routes
$base_path = "/Vero-test";
$routes = [
    $base_path.'/' => 'home',
    $base_path.'/data' => 'dataTasks',
];

// Check if the requested route exists
if (array_key_exists($request, $routes)) {
    call_user_func($routes[$request]);
} else {
    http_response_code(404);
}

function home() {
    require_once('app/controller/taskController.php');

    $controller = new \App\Controller\TaskController();
    $controller->table();
}

function dataTasks(){
    require_once('app/controller/taskController.php');

    $controller = new \App\Controller\TaskController();
    $controller->data();
}
