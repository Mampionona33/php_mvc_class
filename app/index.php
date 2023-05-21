<?php
// Gestion des erreurs probables
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ----------------------------

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (!isset($_SESSION["user"])) {
    if ($uri !== '/login' && $uri !== '/register') {
        header("Location: /login");
        exit();
    }
}

switch ($uri) {
    case '/':
        if (isset($_GET)) {
            http_response_code(200);
            $content = "Hello word";
        }
        break;
    case '/login':
        if (isset($_SESSION["user"])) {
            // Utilisateur déjà connecté, rediriger vers Dashboard
            header("Location: /dashboard");
            exit();
        } else {
            // Afficher la page de connexion
            include_once "./views/Login.php";
            $title = Login()[0];
            $content = Login()[1];
        }
        break;
    case '/register':
        include_once "./views/Register.php";
        $title = Register()[0];
        $content = Register()[1];
        break;
    default:
        http_response_code(404);
        include_once "views/page_not_found.php";
        break;
}

require_once "template/template.php";
