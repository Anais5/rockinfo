<?php require 'php/header.php';
ini_set('display_errors', 1);
require 'php/navigation.php';

if(isset($_GET['i']) && !empty($_GET['i']))
{
    $path_include = 'php/navigation/' . $_GET['i'] . '.php';

    switch(dirname($path_include))
    {
        case 'php/navigation':
            require $path_include;
            break;
        case 'php/navigation/admin':
            if(isset($_SESSION['type_de_compte']) && $_SESSION['type_de_compte'] === 'Administrator')
                require $path_include;
            break;
        case 'php/navigation/rédaction':
            if(isset($_SESSION['type_de_compte']) && ($_SESSION['type_de_compte'] === 'Redactor' || $_SESSION['type_de_compte'] === 'Administrator'))
                require $path_include;
            break;
        default:
            require 'html/accueil.html';
            break;
    }
}
else{
    if(isset($_GET['article_show']))
    {
        echo '<h1>' . $_GET['article_show'] . '</h1>';
        require 'html/rédaction/articles/' . $_GET['article_show'] . '.html';
    }else
    {
        $reponse = $bdd->prepare("SELECT titre, email, date_parution FROM articles");
        $reponse->execute();

        require 'html/rédaction/Events.html';

        while($article = $reponse->fetch())
        {
            echo '<tr>
                    <td><a href="?i=Event&article_show=' . $article['titre'] . '">' . $article['titre'] . '</a></td>
                    <td>Rédacteur : ' . $article['email'] . '</td>
                    <td>Date de parution : ' . $article['date_parution'] . '</td>
                <tr>';
        }

        echo '</tbody></table>';
    }
}

require 'html/footer.html';
