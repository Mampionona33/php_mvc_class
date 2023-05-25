<?php 
require_once "../app/models/TaskModel.php";
require_once "PageHandler.php";

class TaskHandler{
    private $taskModel;

    public function __construct(){
        $this->taskModel=new TaskModel();
    }

    function render_tasks_list($user_id){
        var_dump ($this->taskModel->get_user_tasks($user_id));
    }
}
?>