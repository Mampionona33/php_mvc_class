<?php
require_once "../app/models/TaskTypeModel.php";
class TaskTypeController
{
    private $taskTypeModel;
    public function __construct()
    {
        $this->taskTypeModel = new TaskTypeModel();
    }

    public function Show_list_taskType()
    {
        $this->taskTypeModel->get_all_task_type();
    }
}
