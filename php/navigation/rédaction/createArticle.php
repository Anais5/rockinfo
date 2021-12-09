<?php
echo '<div style="margin-left: auto; margin-right: auto;" class="cadreArticle">';

if(isset($_POST['titre'], $_POST['article']))
{
    $reponse = $bdd->prepare("SELECT titre FROM articles WHERE titre = ?");
    $reponse->execute(array($_POST['titre']));

    if(isset($reponse->fetch()[0]))
        echo '<p>Erreur : Un article avec le même titre existe déjà.</p>';
    else
    {
        $req = $bdd->prepare('INSERT INTO articles(titre, email, date_parution) VALUE (?, ?, NOW())');
        $req->execute(array($_POST['titre'],
                            $_SESSION['email']
        ));

        file_put_contents('html/rédaction/articles/' . $_POST['titre'] . '.html', '<article id="p">' . $_POST['article'] . '</article>');

        if(isset($_POST['notif']))
        {
            foreach ($bdd->query("SELECT email FROM users WHERE newsletter=1") as $email) {
                mail($email[0], "Un nouvel article vous attend : " . $_POST['titre'], $_POST['article'], "From: newsletter@rockinfo.duckdns.org");
            }
        }

        echo 'Article "' . $_POST['titre'] . ' " ajouté.';
    }
}

require 'html/rédaction/createArticle.html';
echo '</div>';
?>
