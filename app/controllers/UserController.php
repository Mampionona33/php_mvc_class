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

    private function renderNavbar()
    {
        require_once "../app/views/users/User_navbar.php";
        $navbarContent = User_navbar(); // Contenu de la barre de navigation
        return $navbarContent;
    }

    private function renderSidebar()
    {
        require_once "../app/views/users/User_sidebar.php";
        $sidebarContent = User_sidebar($_SESSION["user"]["id"]); // Contenu de la barre latérale
        return $sidebarContent;
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
                $userDashboardContent = $this->taskHandler->render_tasks_list($userId);
                $navbarContent = $this->renderNavbar();
                $sidebarContent = $this->renderSidebar();
                $content = $userDashboardContent;
            }
        } else {
            http_response_code(401);
            $errorMessage = "Accès non autorisé : l'utilisateur connecté ne correspond pas à l'utilisateur demandé.";
        }
        include "../app/template/template.php"; // Inclure le template
    }

    public function handle_form_create_task()
    {
        include_once "../app/views/users/task_formulaire.php";
        $title = "Create new task";
        $navbarContent = $this->renderNavbar();
        $sidebarContent = $this->renderSidebar();
        $content = task_formulaire();

        if (isset($_POST)) {
            if (
                isset($_POST["id"]) &&
                isset($_POST["task_name"]) &&
                isset($_POST["num_task"]) &&
                isset($_POST["id_type_task"]) &&
                isset($_POST["nbr_before"]) &&
                isset($_POST["nbr_after"])
            ) {
                $data = $_POST;
                $data["start_time"] = date('Y-m-d H:i:s');

                if ($this->taskHandler->create_user_task($data)) {
                    $message = "Task create successfully";
                } else {
                    $message = "Error occured when trying to create data";
                }
            }
        }
        include "../app/template/template.php";
    }
}
