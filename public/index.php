<?php
session_start();

require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/ace_practical/public/dashboard') {
    $controller = new UserController();
    $controller->dashboard();
} elseif ($uri === '/ace_practical/public/register') {
    $controller = new UserController();
    $controller->register();
} elseif ($uri === '/ace_practical/public/login') {
    $controller = new UserController();
    $controller->login();
} elseif ($uri === '/ace_practical/public/logout') {
    $controller = new UserController();
    $controller->logout();
} elseif ($uri === '/ace_practical/public/forgot-password') {
    $controller = new UserController();
    $controller->forgotPassword();
} elseif ($uri === '/ace_practical/public/create-product') {
    $controller = new ProductController();
    $controller->create();
} elseif ($uri === '/ace_practical/public/edit-product' && isset($_GET['id'])) {
    $controller = new ProductController();
    $controller->edit($_GET['id']);
} elseif ($uri === '/ace_practical/public/update-product' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProductController();
    $controller->update($_POST);
} elseif ($uri === '/ace_practical/public/delete-product' && isset($_GET['id'])) {
    $controller = new ProductController();
    $controller->delete($_GET['id']);
} elseif ($uri === '/ace_practical/public/list-products') {
    $controller = new ProductController();
    $controller->list();
} elseif ($uri === '/ace_practical/public/create-category') {
    $controller = new CategoryController();
    $controller->create();
} elseif ($uri === '/ace_practical/public/edit-category' && isset($_GET['id'])) {
    $controller = new CategoryController();
    $controller->edit($_GET['id']);
} elseif ($uri === '/ace_practical/public/update-category' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new CategoryController();
    $controller->update($_POST);
} elseif ($uri === '/ace_practical/public/list-categories') {
    $controller = new CategoryController();
    $controller->list();
} else {
    echo "404 Not Found";
}
