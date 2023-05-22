<?php
require_once "../app/lib/create_table.php";
require_once "../app/lib/create_data.php";

class UserModel
{

    public $col = [
        [
            'name' => 'id',
            'type' => 'INT',
            'required' => true,
            'auto_increment' => true,
        ],
        [
            'name' => 'name',
            'type' => 'VARCHAR(255)',
            'required' => true,
            'auto_increment' => false,
        ],
        [
            'name' => 'email',
            'type' => 'VARCHAR(255)',
            'required' => false,
            'auto_increment' => false,
        ],
        [
            'name' => 'password',
            'type' => 'VARCHAR(255)',
            'required' => false,
            'auto_increment' => false,
        ],
        [
            'name' => 'role',
            'type' => 'ENUM',
            'values' => ['user','admin'],
            'required' => false,
            'auto_increment' => false,
        ],
    ];
    public $nom_table = "users";
    
    function __construct()
    {   
        $this->create_users_table();
    }

    function create_users_table()
    {
       return create_table($this->nom_table, $this->col);
    }

    function create_user($data){
       return create_data($this->nom_table,$data);
    }
}
