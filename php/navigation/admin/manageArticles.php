<?php

if(isset($_POST['del']) && !empty($_POST['del']))
{
    $reponse = $bdd->prepare("DELETE FROM articles WHERE id = ?");
    $reponse->execute(array($_POST['del']));

    echo '<p>Article supprimé.</p>';
}

$reponse = $bdd->prepare("SELECT id, titre, email, date_parution FROM articles");
$reponse->execute();

require 'html/admin/manageEvents_header.html';

while($article = $reponse->fetch()){
    echo '<tr>
            <td><a href="?i=Event&article_show="' . $article['titre'] . '>' . $article['titre'] . '</a><img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $article['email'] . '</td>
            <td>' . $article['date_parution'] . '</td>
            <td>
                <form action="?i=admin/manageArticles" method=POST>
                    <input name="del" type="hidden" value=' . $article['id'] . '>
                    <input type="submit" value="X">
                </form>
            </td>
            <tr>';
}

echo '</tbody></table>';

?>