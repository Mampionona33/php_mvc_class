<?php 
require_once "../app/lib/create_table.php";
require_once "../app/lib/create_data.php";
require_once "../app/lib/get_data.php";

class TaskModel
{
    public $col =[
        [
            'name' => 'id_task',
            'type' => 'INT',
            'required' => true,
            'auto_increment' => true,
        ],
        [
            'name' => 'task_name',
            'type' => 'VARCHAR(255)',
            'required' => true,
            'auto_increment' => false,
        ],
        [
            'name' => 'num_task',
            'type' => 'VARCHAR(255)',
            'required' => false,
            'auto_increment' => false,
        ],
        [
            'name' => 'id_type_task',
            'type' => 'INT',
            'required' => true,
            'auto_increment' => false,
        ],
        [
            'name' => 'nbr_before',
            'type' => 'INT default 0',
            'required' => false,
            'auto_increment' => false,
        ],
        [
            'name' => 'nbr_after',
            'type' => 'INT default 0',
            'required' => false,
            'auto_increment' => false,
        ],
        [
            'name' => 'id', // user Id
            'type' => 'INT',
            'required' => true,
            'auto_increment' => false,
        ],
    ];

    public $nom_table = "tasks";

    public function __construct(){
        $this->create_task_table();
    }

    function create_task_table(){
        return create_table($this->nom_table,$this->col);
    }


}

?>