<?php

function Login()
{
    $title = "Login";
    $content = "<!-- Affichage du formulaire de connexion -->";
    $content .= '<form action="/login" method="POST">';
    $content .= '<!-- Champs pour le nom d\'utilisateur et le mot de passe -->';
    $content .= '<input type="text" name="username" placeholder="Nom d\'utilisateur" required>';
    $content .= '<input type="password" name="password" placeholder="Mot de passe" required>';
    $content .= '<input type="submit" value="Se connecter">';
    $content .= '</form>';
    $content .= '<div>';
    $content .= '<a href="/register" >create account</a>';
    $content .= '</div>';
    return [$title, $content];
}
