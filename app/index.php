<?php
// Gestion des erreurs probables
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ----------------------------

// Inclure les fichiers nécessaires
// require_once "./app/models/UserModel.php";
require_once "controllers/UserController.php";


$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (!isset($_SESSION["user"])) {
    if ($uri !== '/login' && $uri !== '/register') {
        header("Location: /login");
        exit();
    }
}

// Créer une instance de UserController
$userController = new UserController();


switch ($uri) {
    case '/':
        if (isset($_GET)) {
            http_response_code(200);
            $content = "Hello word";
        }
    break;
    case '/login':
        $userController->login();
    break;
    case '/register':
        $userController->register();
    break;
    default:
        http_response_code(404);
        include_once "views/page_not_found.php";
        break;
}

