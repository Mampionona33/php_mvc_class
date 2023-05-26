<?php
require_once "../app/models/UserModel.php";
require_once "TaskHandler.php";

class UserController
{
    private $userModel;
    private $taskHandler;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->taskHandler = new TaskHandler();
    }

    public function dashboard($userId)
    {
        $this->taskHandler->render_tasks_list($userId);
        if ($_SESSION["user"]["id"] == $userId) {
            $user = $this->userModel->getUserById($userId);
            
            if (!$user) {
                http_response_code(401);
                $errorMessage = "Utilisateur introuvable.";
            } elseif (!array_key_exists('role', $user[0])) {
                http_response_code(401);
                $errorMessage = "Accès non autorisé : la clé 'role' est manquante dans les données de l'utilisateur.";
            } elseif ($user[0]['role'] != 'user') {
                http_response_code(401);
                $errorMessage = "Accès non autorisé : l'utilisateur n'est pas un utilisateur régulier.";
            } else {
                require_once "../app/views/users/User_dashboard.php";
                require_once "../app/views/users/User_navbar.php";
                require_once "../app/views/users/User_sidebar.php";
                $userDashboardContent = User_dashboard();
                $navbarContent = User_navbar(); // Contenu de la barre de navigation
                $sidebarContent = User_sidebar($userId);  // Contenu de la barre latérale
                $content = $userDashboardContent;
            }
        } else {
            http_response_code(401);
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
        }
        include "../app/template/template.php"; // Inclure le template
    }
    
}
