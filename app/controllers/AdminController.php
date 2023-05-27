<?php
require_once "../app/models/UserModel.php";
require_once "../app/lib/Custom_table.php";
require_once "PageHandler.php";
// Include any other necessary files

class AdminController
{
    private $userModel;
    private $pageHandler;
    private $admin_dashboard;
    private $custom_table;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->pageHandler = new PageHandler();
    }


    private function renderNavbar()
    {
        require_once "../app/views/users/User_navbar.php";
        $navbarContent = User_navbar(); // Contenu de la barre de navigation
        return $navbarContent;
    }

    private function renderSidebar()
    {
        require_once "../app/views/admin/Admin_sidebar.php";
        $sidebarContent = Admin_sidebar($_SESSION["user"]["id"]); // Contenu de la barre latérale
        return $sidebarContent;
    }

    public function dashboard($admin_id)
    {
        if ($_SESSION["user"]["id"] == $admin_id) {
            // Code for the admin dashboard interface
            $users = $this->userModel->getUsers();
            $table_header = ["name", "email", "role"];
            $title = "Dashboard";
            $navbarContent = $this->renderNavbar();
            $sidebarContent = $this->renderSidebar();

            $users = array_map(function ($user) {
                unset($user["password"]);
                unset($user["id"]);
                return $user;
            }, $users);

            $this->custom_table = new Custom_table($table_header, $users, true, true);
            $content = $this->custom_table->render();
        } else {
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
        }
        include "../app/template/template.php"; // Inclure le template
    }
}
