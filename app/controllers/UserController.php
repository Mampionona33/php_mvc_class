<?php
require_once "../app/models/UserModel.php";

class UserController
{
    private $userModel;


    public function __construct()
    {
        $this->userModel = new UserModel;
    }

    function show_register_form()
    {
        include_once "../app/views/Register.php";
        $title = Register()[0];
        $content = Register()[1];
        include_once "../app/template/template.php";
    }
    
    function show_login_form()
    {
        include_once "../app/views/Login.php";
        $title = Login()[0];
        $content = Login()[1];
        include_once "../app/template/template.php";
    }
}
