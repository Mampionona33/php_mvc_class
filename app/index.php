<?php
// Gestion des erreurs probables
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ----------------------------

// Inclure les fichiers nécessaires
require_once "controllers/AuthController.php";
require_once "controllers/UserController.php";
require_once "controllers/AdminController.php";

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
$adminController = new AdminController();

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
        $userId = $_GET['id'];

        ob_start(); // Démarrer la temporisation de sortie
        $userController->dashboard($userId); // Exécuter la méthode du contrôleur
        $title = "Dashboard";
        $content = ob_get_clean(); // Récupérer le contenu généré par la méthode du contrôleur
        include "template/template.php";
        break;
    case '/user/create_task':
        $userController->handle_form_create_task();
        break;
    case '/admin/dashboard':
    case "/admin/manage_users":
        $amdin_id = $_GET["id"];
        $adminController->dashboard($amdin_id);
        break;
    case "/admin/manage_task_type":
        $amdin_id = $_GET["id"];
        $adminController->manage_task_type($amdin_id);
        break;
    case "/admin/create_user":
        $amdin_id = $_GET["id"];
        $adminController->create_user($amdin_id);
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
        include "views/page_not_found.php";
        break;
}
