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

    function register_user()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['username']) && isset($_POST['email']) 
            && isset($_POST['password']) && $_POST['email'] !="" 
            && $_POST['password'] != "" && $_POST['email']!= "" ){
                // Récupérer les données du formulaire
                $name = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                // Valider les données ici si nécessaire
                
                // Créer un tableau avec les données
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ];
                
                // Appeler la méthode create_user du modèle
                $user = $this->userModel->create_user($data);
                if(count($user) > 0){
                    echo "User created successfully";
                }else{
                    echo "Error on creating user";
                }
            }else{
                echo "Information insufisant";
            }
        }
    }

}
