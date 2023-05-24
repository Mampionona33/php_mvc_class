<?php
require_once "../app/models/UserModel.php";
require_once "PageHandler.php";
// Include any other necessary files

class AdminController
{
    private $userModel;
    private $pageHandler;
    private $admin_dashboard;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->pageHandler = new PageHandler();
    }

    public function dashboard()
    {
        // Code for the admin dashboard interface
        $adminDashboardFile = "../app/views/Admin_dashboard.php";

        if (file_exists($adminDashboardFile)) {
            $adminDashboardContent = file_get_contents($adminDashboardFile);
            $this->pageHandler->setContent($adminDashboardContent);
            $this->pageHandler->render();
        } else {
            $errorMessage = "Le fichier Admin_dashboard.php n'existe pas.";
            $this->pageHandler->setErrorMessage($errorMessage);
            $this->pageHandler->render();
        }
    }
}
