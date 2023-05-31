<?php
require_once "../app/lib/create_table.php";
require_once "../app/lib/create_data.php";
require_once "../app/lib/get_data.php";
class TaskTypeModel
{
    public $col = [
        [
            "name" => "id_task_type",
            "type" => "INT",
            "required" => true,
            "auto_increment" => true,
        ],
        [
            "name" => "task_type_name",
            "type" => "VARCHAR(100)",
            "required" => true,
            "auto_increment" => false,
        ],
        [
            "name" => "task_goal",
            "type" => "INT(5) default 0",
            "required" => true,
            "auto_increment" => false,
        ]
    ];
    public $nom_table = "task_type";
    public function __construct()
    {
        $this->create_task_type_table();
    }

    public function create_task_type_table()
    {
        return create_table($this->nom_table, $this->col);
    }

    public function create_task_type(array $data = null)
    {
        return create_data($this->nom_table, $data);
    }

    public function get_all_task_type()
    {
        return get_data($this->nom_table, []);
    }
}
