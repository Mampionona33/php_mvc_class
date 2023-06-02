<?php
class UserForm
{
    public $data;
    public $action;
    public $isAdmin;

    public function __construct($isAdmin = false, $data = [])
    {
        $this->isAdmin = $isAdmin;
        $this->data = $data;
    }

    public function renderForm()
    {
        $username = isset($this->data['username']) ? htmlspecialchars($this->data['username']) : '';
        $email = isset($this->data['email']) ? htmlspecialchars($this->data['email']) : '';
        $passwordField = empty($this->data) ? '<input type="password" name="password" placeholder="Mot de passe">' : '';
        $submitButtonLabel = $this->isAdmin ? "Create" : (empty($this->data) ? "S'inscrire" : "Enregistrer");

        $formAction = empty($this->data) ? 'register.php' : ($this->isAdmin ? 'edit_user_admin.php' : 'edit_user.php');
        $formMethod = empty($this->data) ? 'POST' : 'PUT';

        $loginLink = (!$this->isAdmin && empty($this->data)) ? '<a href="/login">Se connecter</a>' : '';

        return <<<HTML
        <form action="{$formAction}" method="{$formMethod}">
            <input type="text" name="username" placeholder="Nom d'utilisateur" value="{$username}">
            <input type="email" name="email" placeholder="Email" value="{$email}">
            {$passwordField}
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe">
            <input type="submit" value="{$submitButtonLabel}">
        </form>
        HTML . $loginLink;
    }
}
?>
