<?php
require_once "../app/models/UserModel.php";
require_once "PageHandler.php";
// Include any other necessary files

class UserController
{
    private $userModel;
    private $pageHandler;

    public function __construct()
    {
        $this->userModel = new UserModel(); // Ajout de parenthèses pour instancier la classe
        $this->pageHandler = new PageHandler();
    }

    public function dashboard($userId)
    {
        // Vérifier si l'id correspond a l'id de l'utilisateur connecté
        if($_SESSION["user"]["id"] == $userId){
            $user = $this->userModel->getUserById($userId);
            if ($user) {
                if (array_key_exists('role', $user[0])) {
                    if ($user[0]['role'] == 'user') {
                        $userDashboardFile = "../app/views/User_dashboard.php";
        
                        if (file_exists($userDashboardFile)) {
                            $userDashboardContent = file_get_contents($userDashboardFile);
                            $this->pageHandler->setContent($userDashboardContent);
                            $this->pageHandler->render();
                        } else {
                            $errorMessage = "Le fichier User_dashboard.php n'existe pas.";
                            $this->pageHandler->setErrorMessage($errorMessage);
                            $this->pageHandler->render();
                        }
                    } else {
                        $errorMessage = "Accès non autorisé : l'utilisateur n'est pas un utilisateur régulier.";
                        $this->pageHandler->setErrorMessage($errorMessage);
                        $this->pageHandler->render();
                    }
                } else {
                    $errorMessage = "Accès non autorisé : la clé 'role' est manquante dans les données de l'utilisateur.";
                    $this->pageHandler->setErrorMessage($errorMessage);
                    $this->pageHandler->render();
                }
            } else {
                $errorMessage = "Utilisateur introuvable.";
                $this->pageHandler->setErrorMessage($errorMessage);
                $this->pageHandler->render();
            }
        }else{
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
            $this->pageHandler->setErrorMessage($errorMessage);
            $this->pageHandler->render();
        }
    }
    
}

