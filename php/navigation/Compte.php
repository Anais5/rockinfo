<?php
if(isset($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['sexe'], $_POST['pays'], $_POST['email'], $_POST['password']))
{
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['age']) && !empty($_POST['sexe']) && !empty($_POST['pays']) && !empty($_POST['email']))
    {
        $req = $bdd->prepare('INSERT INTO users(nom, prenom, age, sexe, pays, email, motDePasse, date_inscription) VALUE (?, ?, ?, ?, ?, ?, ?, NOW())');
        $req->execute(array($_POST['nom'],
                            $_POST['prenom'],
                            $_POST['age'],
                            $_POST['sexe'],
                            $_POST['pays'],
                            $_POST['email'],
                            password_hash($_POST['password'], PASSWORD_ARGON2ID))
        );
        echo '<p>Utilisateur inséré.</p>';
    }
}else
    require 'html/inscription.html';
