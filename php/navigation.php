<nav class="navbar">                  <!-- Barre de navigation + contenue  -->
    <a href="index.php">Accueil</a>
    <a href="?i=FAQ">FAQ</a>
    <a href="?i=Store">Boutique</a>
    <a href="?i=Event">Futurs événements</a>
    <a href="?i=Compte">Compte</a>
    <?php
    if(isset($_SESSION['type_de_compte']))
    {
        switch($_SESSION)
        {
            case 'Administrator':
                echo '
                    <a href="?i=admin/admin">Administration</a>
                    <a href="?i=">
                    ';
                break;
            case 'Redactor':
                echo '<a href="?i=">';
                break;
            default:
                break;
        }
    }
    ?>
</nav>
