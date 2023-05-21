<?php

function Register()
{
    $title = "Register";
    $content = '<!-- Affichage du formulaire d\'inscription -->';
    $content .= '<form action="login.php" method="POST">';
    $content .= '<input type="text" name="username" placeholder="Nom d\'utilisateur" required>';
    $content .= '<input type="email" name="username" placeholder="email" required>';
    $content .= '<input type="password" name="password" placeholder="Mot de passe" required>';
    $content .= '<input type="password" name="password" placeholder="Confirme Mot de passe" required>';
    $content .= '<input type="submit" value="S\'inscrire">';
    $content .= '</form>';
    $content .= '<a href="/login" >sign in</a>';
    return [$title, $content];
}
