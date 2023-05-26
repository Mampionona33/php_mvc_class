<?php
require_once "../app/models/TaskModel.php";
require_once "PageHandler.php";

class TaskHandler
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    function render_tasks_list($user_id)
    {
        echo "form render_tasks_list ";
        var_dump($this->taskModel->get_user_tasks($user_id));
    }

    function create_user_task($task)
    {
        $pathname = $_SERVER["REQUEST_URI"];
        // Supprimer les éventuels paramètres de requête de la fin du pathname
        $pathname = strtok($pathname, '?');
        if ($pathname == "/user/create_task") {
            $created_data = $this->taskModel->create_task($task);
            if (count($created_data) > 0) {
                return true;
            } else {
                return null;
            }
        }
    }
}
