<?php
require_once "../app/models/TaskTypeModel.php";
require_once "../app/lib/Custom_table.php";
require_once "../app/lib/Custom_create_btn.php";
class TaskTypeController
{
    private $taskTypeModel;
    private $custom_table;
    private $custom_create_btn;
    public function __construct()
    {
        $this->taskTypeModel = new TaskTypeModel();
    }

    public function Show_list_taskType()
    {
        $table_header = ["id", "name", "email", "role"];
        $task_type_list = $this->taskTypeModel->get_all_task_type();
        $this->custom_table = new Custom_table($table_header, $task_type_list, true, true);
        $this->custom_create_btn = new Custom_create_btn("create_task_type", "create task type");
        $output = "";
        $output .= $this->custom_create_btn->render();
        $output .= $this->custom_table->render();
        return $output;
    }
}
