<?php
if(isset($_SESSION['email']))
{
    echo '<a href="logout.php">Déconnexion</p>';
}else if(isset($_POST['conn_email'], $_POST['conn_password']))
{
    if(!empty($_POST['conn_email']) && !empty($_POST['conn_password']))
    {
		$reponse = $bdd->prepare("SELECT motDePasse, type_de_compte FROM users WHERE email = ?"); // va chercher le hash de l'utilisateur
		$reponse->execute(array($_POST['conn_email']));
		$userInfos = $reponse->fetch();

		if(isset($userInfos[0])){ // vérifie que l'utilisateur existe
			if(password_verify($_POST['conn_password'], $userInfos[0]))
			{
				$_SESSION['email'] = $_POST['conn_email'];
                $_SESSION['type_de_compte'] = $userInfos[1];

				header('location: index.php?i=Compte');
			}else
                mis_log("Erreur : mot de passe incorrect.");
		}else
            mis_log("Erreur : compte inconnu.");
    }
}else if(isset($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['sexe'], $_POST['pays'], $_POST['email'], $_POST['password']))
{
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['age']) && !empty($_POST['sexe']) && !empty($_POST['pays']) && !empty($_POST['email']))
    {
        $reponse = $bdd->prepare("SELECT email FROM users WHERE email = ?");
        $reponse->execute(array($_POST['email']));

        if(!$reponse->fetch()[0]) // vérifie que l'utilisateur n'existe pas déjà
        {
            $req = $bdd->prepare('INSERT INTO users(nom, prenom, age, sexe, pays, email, motDePasse, date_inscription, type_de_compte) VALUE (?, ?, ?, ?, ?, ?, ?, NOW(), \'User\')');
            $req->execute(array($_POST['nom'],
                                $_POST['prenom'],
                                $_POST['age'],
                                $_POST['sexe'],
                                $_POST['pays'],
                                $_POST['email'],
                                password_hash($_POST['password'], PASSWORD_ARGON2ID))
            );
            echo '<p>Inscription réussi, veuillez vous connecter.</p>';
        }else
            echo '<p>Email déjà enregistrée.</p>';
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
