<?php 
require_once "../app/models/TaskModel.php";
require_once "PageHandler.php";

class TaskHandler{
    private $taskModel;

    public function __construct(){
        $this->taskModel=new TaskModel();
    }
}
?>