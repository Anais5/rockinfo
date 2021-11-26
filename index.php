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
            require 'php/navigation/accueil.php';
            break;
    }
}
else
    require 'php/navigation/accueil.php';

require 'html/footer.html';
