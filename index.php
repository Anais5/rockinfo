<?php require 'php/header.php';

require 'php/navigation.php';

if(isset($_GET['i']) && !empty($_GET['i']))
{
    $path_include = 'php/navigation/' . $_GET['i'] . '.php';

    if(dirname($path_include) === 'php/navigation')
        require $path_include;
    else
        require 'html/accueil.html';
}
else
    require 'html/accueil.html';

require 'html/footer.html';
