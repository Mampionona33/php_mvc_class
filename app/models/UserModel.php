<?php
require_once "../lib/create_table.php";
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
    ];

    function __construct()
    {
        $this->create_users_table();
    }

    function create_users_table()
    {
        create_table("users", $this->col);
    }
}
