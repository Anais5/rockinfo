<?php
//Edite infos

if(isset($_POST['del']) && !empty($_POST['del']))
{
    $reponse = $bdd->prepare("DELETE FROM users WHERE email = ?");
    $reponse->execute(array($_POST['del']));

    echo '<p>Utilisateur supprimé.</p>';
}

$reponse = $bdd->prepare("SELECT id, nom, prenom, email, age, sexe, pays, date_inscription, type_de_compte FROM users"); // va chercher les infos de utilisateur
$reponse->execute(array($_SESSION['email']));

require 'html/admin/manageUsers_header.html';

while($userInfos = $reponse->fetch()){
    echo '<tr>
            <td>' . $userInfos['nom'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['prenom'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['email'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['age'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['sexe'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['pays'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['date_inscription'] . '</td>
            <td>' . $userInfos['type_de_compte'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>';
    
        if($_SESSION['email'] !== $userInfos['email'])
        {
            echo '<form action="?i=admin/manageUsers" method=POST>
                        <input name="del" type="hidden" value=' . $userInfos['email'] . '>
                        <input type="submit" value="X">
                    </form>';
        }
                
    echo '</td>
            <tr>';
}

echo '</tbody></table>';

?>