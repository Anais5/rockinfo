<?php
if(isset($_SESSION['email'])){
    require 'html/navigation/compte/compte.html';

    if(isset($_POST['new_email'])){
        if(!empty($_POST['new_email']))
        {
            $reponse = $bdd->prepare("SELECT email FROM users WHERE email = ?");
            $reponse->execute(array($_POST['new_email']));
        
            if(!isset($reponse->fetch()[0])) // vérifie que l'email n'est pas déjà pris
            {
                $req = $bdd->prepare('UPDATE users SET email = ? WHERE email = ?');
                $req->execute(array($_POST['new_email'],
                                    $_SESSION['email']));
                echo '<p>Email modifié.</p>';
            }else
                echo '<p>Erreur : Email déjà enregistrée.</p>';
        }
    }if(isset($_POST['new_password']))
    {
        if(!empty($_POST['new_password']))
        {
            $req = $bdd->prepare('UPDATE users SET motDePasse = ? WHERE email = ?');
            $req->execute(array(password_hash($_POST['new_password'], PASSWORD_ARGON2ID),
                                            $_SESSION['email']));
            echo '<p>Mot de passe modifié.</p>';
        }
    }
}
else if(isset($_POST['conn_email'], $_POST['conn_password']))
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

        if(!isset($reponse->fetch()[0])) // vérifie que l'utilisateur n'existe pas déjà
        {
            $req = $bdd->prepare('INSERT INTO users(nom, prenom, age, sexe, pays, email, newsletter, motDePasse, date_inscription, type_de_compte) VALUE (?, ?, ?, ?, ?, ?, ?, ?, NOW(), \'User\')');
            $req->execute(array($_POST['nom'],
                                $_POST['prenom'],
                                $_POST['age'],
                                $_POST['sexe'],
                                $_POST['pays'],
                                $_POST['email'],
                                !empty($_POST['newsletter']) ? 1 : 0,
                                password_hash($_POST['password'], PASSWORD_ARGON2ID))
            );
            echo '<p>Inscription réussi, veuillez vous connecter.</p>';
        }else
            echo '<p>Erreur : Email déjà enregistrée.</p>';
    }
}else
    mis_log();

function mis_log($msg = "")
{
    echo '
    <script src="js/interface.js"></script>

    <label style="margin-left: auto; margin-right: auto; margin-top: 2%;" class="switch">
        <input class="switch-input" type="checkbox" id="btn_switch_log" onclick="switch_log()"/>
        <span class="switch-label" data-on="Connexion" data-off="Inscription"></span> 
        <span class="switch-handle"></span> 
    </label>
    
    <div class="cadre">';

    require 'html/navigation/compte/connexion.html';
    require 'html/navigation/compte/inscription.html';

    echo '</div>' . $msg;
}
