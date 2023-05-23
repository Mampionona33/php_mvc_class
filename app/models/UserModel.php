<?php
require_once "../app/lib/create_table.php";
require_once "../app/lib/create_data.php";
require_once "../app/lib/get_data.php";

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
            'required' => true,
            'auto_increment' => false,
        ],
        [
            'name' => 'password',
            'type' => 'VARCHAR(255)',
            'required' => true,
            'auto_increment' => false,
        ],
        [
            'name' => 'role',
            'type' => 'ENUM',
            'values' => ['user','admin'],
            'required' => true,
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

    function get_user_by_name_email($new_user) {
        $conditions = "name='" . $new_user['name'] . "' AND email='" . $new_user['email'] . "'";
        $user_exist = get_data($this->nom_table, [], $conditions);
        return $user_exist;
    }
    
}
