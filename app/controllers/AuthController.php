<?php
require_once "../app/models/UserModel.php";
require_once "PageHandler.php";
include_once "../app/views/Register.php";
include_once "../app/views/Login.php";

class AuthController
{
    private $userModel;
    private $pageHandler;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->pageHandler = new PageHandler();
    }

    function login()
    {
        $title = Login()[0];
        $content = Login()[1];
        $this->pageHandler->setTitle($title);
        $this->pageHandler->setContent($content);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["username"]) && isset($_POST["password"])) {
                $name = $_POST["username"];
                $password = $_POST["password"];
                $user = $this->userModel->get_user_by_name_email(['name' => $name]);
                if (count($user) > 0) {
                    $storedPasswordHash = $user[0]['password'];

                    // Vérifier si le mot de passe soumis correspond au hachage stocké
                    if (password_verify($password, $storedPasswordHash)) {
                        // Enregistrer les informations utilisateur dans la session
                        $_SESSION['user'] = [
                            'id' => $user[0]['id'],
                            'name' => $user[0]['name'],
                            'role' => $user[0]['role'],
                        ];
                        // Rediriger l'utilisateur en fonction de son rôle
                        if ($user[0]['role'] === 'admin') {
                            header("Location: /admin/dashboard?id=" . $user[0]['id']);
                        } else {
                            header("Location: /user/dashboard?id=" . $user[0]['id']);
                        }
                        exit();
                    } else {
                        // $this->pageHandler->setErrorMessage("Nom d'utilisateur ou mot de passe incorrect.");
                        $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect.";
                    }
                } else {
                    // Utilisateur non trouvé
                    // $this->pageHandler->setErrorMessage("Utilisateur non trouvé.");
                    $_SESSION['error_message'] = "Utilisateur non trouvé.";
                }
            }
        }

        if (isset($_SESSION['error_message'])) {
            $this->pageHandler->setErrorMessage($_SESSION['error_message']);
            unset($_SESSION['error_message']);
        }

        $this->pageHandler->render();
    }


    function register()
    {
        $title = Register()[0];
        $content = Register()[1];
        $this->pageHandler->setTitle($title);
        $this->pageHandler->setContent($content);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['username']) && isset($_POST['email'])
                && isset($_POST['password']) && $_POST['email'] != ""
                && $_POST['password'] != "" && $_POST['email'] != ""
            ) {
                $name = $_POST['username'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



                // Créer un tableau avec les données
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ];

                // Verifier si l'utilisateur exist dans la base de donnée
                $user_exist = $this->userModel->get_user_by_name_email($data);

                if (count($user_exist) > 0) {
                    $this->pageHandler->setErrorMessage("User alredy exist");
                } else {
                    // Appeler la méthode create_user du modèle
                    $user = $this->userModel->create_user($data);
                    if (count($user) > 0) {
                        $this->pageHandler->setMessage("User created successfully");
                        header("Refresh:2; login");
                    } else {
                        $this->pageHandler->setErrorMessage("Error on creating user");
                    }
                }

                $title = Register()[0];
                $content = Register()[1];
                $this->pageHandler->setTitle($title);
                $this->pageHandler->setContent($content);
            } else {
                $this->pageHandler->setErrorMessage("Insufficient information. Please fill in all required fields.");
            }
        }
        $this->pageHandler->render();
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit();
    }
}
