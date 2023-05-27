<?php
require_once "../app/models/TaskModel.php";
require_once "../app/lib/Custom_table.php";
require_once "PageHandler.php";

class TaskHandler
{
    private $taskModel;
    private $custom_table;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    function render_tasks_list($user_id)
    {
        include_once "../app/lib/Custom_table.php";
        $table_headers = ["Type de tâche", "Numéro de tâche", "Nombre avant", "Nombre après", "Durée du traitement"];
        $user_tasks = $this->taskModel->get_user_tasks($user_id);

        $user_tasks = array_map(function ($task) {
            unset($task["id_task"]);
            unset($task["id"]);
            unset($task["start_time"]);
            return $task;
        }, $user_tasks);

        $this->custom_table = new Custom_table($table_headers, $user_tasks, false, true, true);
        return $this->custom_table->render();
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
