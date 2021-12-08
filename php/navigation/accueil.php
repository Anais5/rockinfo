<?php
echo "<div class='containeur'>
<div id='titre'>Présentation</div>
<div id='p'>Nous avons le plaisir de vous présenter le festival <b>RockInfo</b>.
<br>
Festival principalement dirigé vers les fans de rock.<br>
Sur les 4 jours  de la durée du festival, vous retrouverez des groupes de sous-genres de rock et d'époque différentes.<br>
Le site officiel de RockInfo (https//:rockinfo.duckdns.org/) vous permettra de trouver des articles avant chaque jour d'événements rédigés 
par les administrateurs et rédacteurs du site, un espace pour voir les groupes se produisant sur nos scènes et acheter des tickets, 
avoir des informations sur notre association, retrouver une boutique avec des produits variés et un système de création du compte pour acheter des tickets.</div>
";

if(isset($_GET['article_show']))
{
    echo '<h1>' . $_GET['article_show'] . '</h1>';
    require 'html/rédaction/articles/' . $_GET['article_show'] . '.html';
}else
{
    $reponse = $bdd->prepare("SELECT titre, email, date_parution FROM articles ORDER BY date_parution DESC");
    $reponse->execute();

    require 'html/rédaction/articles.html';
    

    while($article = $reponse->fetch())
    {
        echo '<div class="box">
                <div id="sous_titre"> '. $article['titre'] . '</div>
                <div id="bouton"><a href="?article_show=' . $article['titre'] . '">Voir en entier</a></div>
                <div id="info">Rédacteur : ' . $article['email'] . '</div>
                <div id="descrip">Date de parution : ' . $article['date_parution'] . '</div>
            </div>';
        
    }

    echo '</div>';
}
?>

<?php
    require 'html/accueil.html';
?>
