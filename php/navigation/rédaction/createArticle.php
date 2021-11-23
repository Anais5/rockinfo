<?php 

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
                            $_POST['article']
        ));

        file_put_contents('html/rédaction/articles/' . $_POST['titre'] . '.html', $_POST['article']);
        echo 'Article "' . $_POST['titre'] . ' " ajouté.';
    }
}

require 'html/rédaction/createArticle.html';?>
