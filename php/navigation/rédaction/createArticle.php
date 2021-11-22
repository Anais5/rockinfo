<?php 

if(isset($_POST['titre'], $_POST['article']))
{
    $req = $bdd->prepare('INSERT INTO articles(titre, email, date_parution) VALUE (?, ?, NOW())');
            $req->execute(array($_POST['titre'],
                                $_POST['article']
            ));

    file_put_contents('html/rédaction/articles/' . $_POST['titre'] . '.html', $_POST['article']);
    echo 'Article "' . $_POST['titre'] . ' " ajouté.';
}

require 'html/rédaction/createArticle.html';?>
