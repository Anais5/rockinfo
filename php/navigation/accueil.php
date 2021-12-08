<?php
if(isset($_GET['article_show']))
{
    echo '<h1>' . $_GET['article_show'] . '</h1>';
    require 'html/rédaction/articles/' . $_GET['article_show'] . '.html';
}else
{
    $reponse = $bdd->prepare("SELECT titre, email, date_parution FROM articles");
    $reponse->execute();

    require 'html/rédaction/articles.html';
    

    while($article = $reponse->fetch())
    {
        echo '<div class="box">
                <div id="titre"><a href="?article_show=' . $article['titre'] . '">' . $article['titre'] . '</a></div>
                <div id="info">Rédacteur : ' . $article['email'] . '</div>
                <div id="descrip">Date de parution : ' . $article['date_parution'] . '</div>
            <div class="box>';
    }

    echo '</conteneur>';
}
?>
