<?php
// Gestion des erreurs probables
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ----------------------------

// Inclure les fichiers nécessaires
require_once "controllers/AuthController.php";

// Démarrer la session
session_start();

$pathname = $_SERVER["REQUEST_URI"];

// Supprimer les éventuels paramètres de requête de la fin du pathname
$pathname = strtok($pathname, '?');

if (!isset($_SESSION["user"])) {
    if ($pathname !== '/login' && $pathname !== '/register') {
        header("Location: /login");
        exit();
    }
}

// Créer une instance de AuthController
$authController = new AuthController();

switch ($pathname) {
    case '/':
        if (isset($_GET)) {
            http_response_code(200);
            echo "Hello word";
        }
        break;
    case '/user/':
        echo "user dashboard";
        break;
    case '/admin/':
        echo "admin dashboard";
        break;
    case '/login':
        $authController->login();
        break;
    case '/register':
        $authController->register();
        break;
    default:
        http_response_code(404);
        include_once "views/page_not_found.php";
        break;
}
