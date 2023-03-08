{extends file="Views/modele.tpl"}
{block name="header"}
<script>$(document).ready( function () {
    $('#userList').DataTable();
} );</script>
{/block}

{block name="content"}

<h2>{$strTitle}</h2>
<table id="userList" class="display">
    <thead>	<!-- Balise d'en-tête de tableau organisé -->
        <tr>
            <th> Pseudo</th>
            <th> Nom </th>
            <th> Prénom </th>
            <th> Téléphone </th>
            <th> Adresse mail </th>
            <th> Numéro de rue </th>
            <th> Nom de la rue </th>
            <th> Code Postal </th>
            <th> Ville </th>
            <th> Type </th>
            <th> Actions </th>
        </tr>	
    </thead>


    <tbody> 
{foreach from=$arrUsersToDisplay item=$objUsers}
        <tr>
            <td> {$objUsers->getPseudo()} </td> 
            <td> {$objUsers->getName()} </td>
            <td> {$objUsers->getFirstName()} </td>
            <td> {$objUsers->getPhone()} </td>
            <td> {$objUsers->getMail()} </td>
            <td> {$objUsers->getNumero()} </td>
            <td> {$objUsers->getAdress()} </td>
            <td> {$objUsers->getPostalCode()} </td>
            <td> {$objUsers->getCity()} </td>
            <td> {$objUsers->getType()} </td>
            <td>
                <a href="index.php?ctrl=user&action=update_account&id={$objUsers->getId()}" class="btn btnPrin cacherBtnBase">Modifier</a>
                <a href="index.php?ctrl=user&action=AdminDeleteAccount&id={$objUsers->getId()}" class="btn cacherBtnBase btnSec">Supprimer</i></a>
                {if $objUsers->getActivate()== 1}
                    <a href="index.php?ctrl=user&action=desactivate_account&id={$objUsers->getId()}" class="btn cacherBtnBase btnSec">Désactiver</i></a>
                {else}
                    <a href="index.php?ctrl=user&action=activate_account&id={$objUsers->getId()}" class="btn cacherBtnBase btnPrin">Activer</i></a>
                {/if}            
            </td>
        </tr>
{/foreach}
    </tbody>
</table>

{/block}

