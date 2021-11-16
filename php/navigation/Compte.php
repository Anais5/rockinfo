<?php
if(isset($_SESSION['email']))
{
    echo '<a href="php/logout.php">Déconnexion</p>';
}else if(isset($_POST['email'], $_POST['password']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {		
		$reponse = $bdd->prepare("SELECT motDePasse FROM users WHERE email = ?"); // va chercher le hash de l'utilisateur
		$reponse->execute(array($_POST['email']));
		$mdp = $reponse->fetch();

		if(isset($mdp[0])){ // vérifie que l'utilisateur existe
			if(password_verify($_POST['password'], $mdp[0]))
			{
				$_SESSION['email'] = $_POST['email'];

				echo '<a href="php/logout.php">Déconnexion</p>';
			}else
                mis_log("Erreur : mot de passe incorrect.");
		}else
            mis_log("Erreur : compte inconnu.");
    }
}else if(isset($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['sexe'], $_POST['pays'], $_POST['email'], $_POST['password']))
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
        echo '<p>Inscription réussi, veuillez vous connecter.</p>';
    }
}else
    mis_log();

function mis_log($msg = "")
{
    echo '
    <script src="js/interface.js"></script>

    <label class="switch">
        <input class="switch-input" type="checkbox" id="btn_switch_log" onclick="switch_log()"/>
        <span class="switch-label" data-on="Connexion" data-off="Inscription"></span> 
        <span class="switch-handle"></span> 
    </label>
    ';

    require 'html/connexion.html';
    require 'html/inscription.html';

    echo $msg;
}
