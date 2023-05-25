<?php
require_once "../app/models/UserModel.php";
require_once "PageHandler.php";
require_once "TaskHandler.php";

class UserController
{
    private $userModel;
    private $pageHandler;
    private $taskHandler;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->pageHandler = new PageHandler();
        $this->taskHandler = new TaskHandler();
    }

    public function dashboard($userId)
    {
        $this->taskHandler->render_tasks_list($userId);
        if ($_SESSION["user"]["id"] == $userId) {
            $user = $this->userModel->getUserById($userId);

            if (!$user) {
                $errorMessage = "Utilisateur introuvable.";
                $this->pageHandler->setErrorMessage($errorMessage);
            } elseif (!array_key_exists('role', $user[0])) {
                $errorMessage = "Accès non autorisé : la clé 'role' est manquante dans les données de l'utilisateur.";
                $this->pageHandler->setErrorMessage($errorMessage);
            } elseif ($user[0]['role'] != 'user') {
                $errorMessage = "Accès non autorisé : l'utilisateur n'est pas un utilisateur régulier.";
                $this->pageHandler->setErrorMessage($errorMessage);
            } else {
                $userDashboardFile = "../app/views/User_dashboard.php";
    
                if (file_exists($userDashboardFile)) {
                    $userDashboardContent = file_get_contents($userDashboardFile);
                    $this->pageHandler->setTitle("Dashboard");
                    $this->pageHandler->setContent($userDashboardContent);
                } else {
                    $errorMessage = "Le fichier User_dashboard.php n'existe pas.";
                    $this->pageHandler->setErrorMessage($errorMessage);
                }
            }
        } else {
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
            $this->pageHandler->setErrorMessage($errorMessage);
        }

        $this->pageHandler->render();
    }
}
