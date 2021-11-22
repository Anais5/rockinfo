<?php
//Edite infos
$reponse = $bdd->prepare("SELECT id, nom, prenom, email, age, sexe, pays, date_inscription, type_de_compte FROM users WHERE email = ?"); // va chercher les infos de l'utilisateur
$reponse->execute(array($_SESSION['email']));

while($userInfos = $reponse->fetch()){
    $table .= '<tr>
            <td>' . $userInfos['nom'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['prenom'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['email'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['age'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['sexe'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['pays'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>' . $userInfos['date_inscription'] . '</td>
            <td>' . $userInfos['type_de_compte'] . '<img src="pics/edit.png" onclick=edit(this.parentElement) width=25></td>
            <td>X</td>
            <tr>';
}

require 'html/admin/manageUsers_header.html';

echo $table . '</tbody></table></form>';

?>