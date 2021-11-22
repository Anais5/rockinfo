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
            if($_SESSION['type_de_compte'] === 'Administrator')
                require $path_include;
            break;
        case 'php/navigation/rédaction':
            if($_SESSION['type_de_compte'] === 'Redactor' || $_SESSION['type_de_compte'] === 'Administrator')
                require $path_include;
            break;
        default:
            require 'html/accueil.html';
            break;
    }
}
else
    require 'html/accueil.html';

require 'html/footer.html';
