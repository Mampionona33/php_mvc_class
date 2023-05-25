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
                $errorMessage = "Utilisateur introuvable.";
                $this->setErrorMessage($errorMessage);
            } elseif (!array_key_exists('role', $user[0])) {
                $errorMessage = "Accès non autorisé : la clé 'role' est manquante dans les données de l'utilisateur.";
                $this->setErrorMessage($errorMessage);
            } elseif ($user[0]['role'] != 'user') {
                $errorMessage = "Accès non autorisé : l'utilisateur n'est pas un utilisateur régulier.";
                $this->setErrorMessage($errorMessage);
            } else {
                $userDashboardFile = "../app/views/User_dashboard.php";

                if (file_exists($userDashboardFile)) {
                    $userDashboardContent = file_get_contents($userDashboardFile);
                    $title = "Dashboard";
                    $navbarContent = "test"; // Contenu de la barre de navigation
                    $sidebarContent = ""; // Contenu de la barre latérale
                    $content = $userDashboardContent;

                    ob_start(); // Démarrer la temporisation de la sortie
                    include "../app/template/template.php"; // Inclure le template
                    ob_end_flush(); // Envoyer la sortie mise en tampon vers le navigateur
                } else {
                    $errorMessage = "Le fichier User_dashboard.php n'existe pas.";
                    $this->setErrorMessage($errorMessage);
                }
            }
        } else {
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
            $this->setErrorMessage($errorMessage);
        }
    }

    private function setErrorMessage($errorMessage)
    {
        $_SESSION["errorMessage"] = $errorMessage;
    }
}
