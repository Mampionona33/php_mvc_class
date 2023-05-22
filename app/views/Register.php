<?php

function Register()
{
    $title = "Register";
    $content = '<!-- Affichage du formulaire d\'inscription -->';
    $content .= '<form action="" method="POST">';
    $content .= '<input type="text" name="username" placeholder="Nom d\'utilisateur" >';
    $content .= '<input type="email" name="email" placeholder="email" >';
    $content .= '<input type="password" name="password" placeholder="Mot de passe" >';
    $content .= '<input type="password" name="password" placeholder="Confirme Mot de passe" >';
    $content .= '<input type="submit" value="S\'inscrire">';
    $content .= '</form>';
    $content .= '<a href="/login" >sign in</a>';
    return [$title, $content];
}
