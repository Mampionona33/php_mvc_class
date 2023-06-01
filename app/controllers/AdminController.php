<?php
require_once "../app/models/UserModel.php";
require_once "../app/lib/Custom_table.php";
require_once "../app/models/TaskTypeModel.php";
require_once "TaskTypeController.php";
require_once "../app/lib/Custom_create_btn.php";

require_once "PageHandler.php";
// Include any other necessary files

class AdminController
{
    private $userModel;
    private $pageHandler;
    private $admin_dashboard;
    private $custom_table;
    private $taskTypeModel;
    private $taskTypeController;
    private $custom_create_btn;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->pageHandler = new PageHandler();
        $this->taskTypeModel = new TaskTypeModel();
        $this->taskTypeController = new TaskTypeController();
        
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
            $table_header = ["id", "name", "email", "role"];
            $title = "Dashboard";
            $navbarContent = $this->renderNavbar();
            $sidebarContent = $this->renderSidebar();

            $users = array_map(function ($user) {
                unset($user["password"]);
                // unset($user["id"]);
                return $user;
            }, $users);

            $this->custom_table = new Custom_table($table_header, $users, true, true);
            $this->custom_create_btn = new Custom_create_btn("create_user","create user");
            $content = "";
            $content .= $this->custom_create_btn->render();
            $content .=  $this->custom_table->render();
        } else {
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
        }
        include "../app/template/template.php"; // Inclure le template
    }

    public function manage_task_type($admin_id)
    {
        if ($_SESSION['user']["id"] = $admin_id) {
            $title = "Manage task type";
            $navbarContent = $this->renderNavbar();
            $sidebarContent = $this->renderSidebar();
            $content =  $this->taskTypeController->Show_list_taskType();
        } else {
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
        }
        include "../app/template/template.php"; // Inclure le template
    }
}
