<?php
// Gestion des erreurs probables
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ----------------------------

// Inclure les fichiers nécessaires
require_once "controllers/AuthController.php";
require_once "controllers/UserController.php";

// Démarrer la session
session_start();

$pathname = $_SERVER["REQUEST_URI"];

// Supprimer les éventuels paramètres de requête de la fin du pathname
$pathname = strtok($pathname, '?');

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION["user"])) {
    // Rediriger vers la page de connexion
    if ($pathname !== '/login' && $pathname !== '/register') {
        header("Location: /login");
        exit();
    }
}

// Créer une instance de AuthController
$authController = new AuthController();
$userController = new UserController();

// Redirection en fonction du rôle de l'utilisateur
if (isset($_SESSION["user"])) {
    $role = $_SESSION["user"]["role"];
    $id = $_SESSION["user"]["id"];
    if ($role === "user") {
        if ($pathname === '/') {
            header("Location: /user/dashboard?id=$id");
            exit();
        }
    } elseif ($role === "admin") {
        if ($pathname === '/') {
            header("Location: /admin/dashboard?id=$id");
            exit();
        }
    }
}

switch ($pathname) {
    case '/':
        if (isset($_GET)) {
            http_response_code(200);
            echo "Hello word";
        }
        break;
    case '/user/dashboard':
        // Extraire l'ID de l'utilisateur à partir de l'URL
        $userId = $_GET['id'];
        $userController->dashboard($userId);
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
    case '/logout':
        $authController->logout();
        break;
    default:
        http_response_code(404);
        include_once "views/page_not_found.php";
        break;
}
