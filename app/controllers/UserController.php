<?php
require_once "../app/models/UserModel.php";
require_once "PageHandler.php";
include_once "../app/views/Register.php";
include_once "../app/views/Login.php";

class UserController
{
    private $userModel;
    private $pageHandler;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->pageHandler = new PageHandler();
    }

    function show_register_form()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $title = Register()[0];
            $content = Register()[1];
            $this->pageHandler->setTitle($title);
            $this->pageHandler->setContent($content);
            $this->pageHandler->render();
        }
    }

    function show_login_form()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $title = Login()[0];
            $content = Login()[1];
            $this->pageHandler->setTitle($title);
            $this->pageHandler->setContent($content);
            $this->pageHandler->render();
        }
    }

    function register_user()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (
                isset($_POST['username']) && isset($_POST['email'])
                && isset($_POST['password']) && $_POST['email'] != ""
                && $_POST['password'] != "" && $_POST['email'] != ""
            ) {
                // Récupérer les données du formulaire
                $name = $_POST['username'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                // Valider les données ici si nécessaire

                // Créer un tableau avec les données
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ];

                // Appeler la méthode create_user du modèle
                $user = $this->userModel->create_user($data);
                $title = Register()[0];
                $content = Register()[1];
                $this->pageHandler->setTitle($title);
                $this->pageHandler->setContent($content);

                if (count($user) > 0) {
                    $this->pageHandler->setMessage("User created successfully");
                } else {
                    $this->pageHandler->setErrorMessage("Error on creating user");
                }

                $this->pageHandler->render();
            } else {
                $title = Register()[0];
                $content = Register()[1];
                $this->pageHandler->setTitle($title);
                $this->pageHandler->setErrorMessage("Insufficient information");
                $this->pageHandler->render();
            }
        }
    }

    function login()
    {
        // TODO: Implementation du login
    }
}
