<?php
require_once "../app/models/UserModel.php";
require_once "PageHandler.php";
// Include any other necessary files

class AdminController
{
    private $userModel;
    private $pageHandler;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->pageHandler = new PageHandler();
    }
}
