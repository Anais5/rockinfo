<?php require 'php/header.php';

require 'php/navigation.php';

if(isset($_GET['i']) && !empty($_GET['i']))
    require 'php/navigation/' . $_GET['i'] . '.php';
else
    require 'html/accueil.html';

require 'html/footer.html';
