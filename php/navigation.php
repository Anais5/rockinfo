<nav class="navbar">                  <!-- Barre de navigation + contenue  -->
    <a href="index.php">Accueil</a>
    <a href="?i=FAQ">FAQ</a>
    <a href="?i=Store">Boutique</a>
    <a href="?i=Event">Futurs événements</a>
    <a href="?i=Compte">Compte</a>
    <?php
    if(isset($_SESSION['type_de_compte']))
    {
        switch($_SESSION['type_de_compte'])
        {
            case 'Administrator':
                echo '
                    <a href="?i=admin/admin">Administration</a>
                    <a href="?i=rédaction/createArticle">Rédaction</a>
                    ';
                break;
            case 'Redactor':
                echo '<a href="?i=rédaction/createArticle">Rédaction</a>';
                break;
            default:
                break;
        }
    }
    ?>
</nav>
