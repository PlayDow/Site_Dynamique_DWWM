{extends file="Views/modele.tpl"}

    {block name="header"}
        <script>$(document).ready( function () {
            $('#ticket').DataTable();
        } );</script>
    {/block}
    
    {block name="content"}

    {if count($arrError) > 0}
        <div>
        {foreach from=$arrError item=strError}
            <p>{$strError}</p>
        {/foreach}
        </div>
    {/if}

    <!--Ticket-->  
    <table id="ticket" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Fichier</th>
                <th>Nombres copies</th>
                <th>Message</th>
                <th>Archiver</th>
            </tr>
        </thead>
        <tbody>
        {foreach from=$arrTicketToDisplay key=id item=objTicket} 
            <tr>
                <td>{$objTicket->getName()|unescape}</td>
                <td>{$objTicket->getFirstName()|unescape}</td>
                <td>{$objTicket->getPhone()|unescape}</td>
                <td>{$objTicket->getMail()|unescape}</td>
                <td>{$objTicket->getNumAddress()} {$objTicket->getStreet()|unescape}</td>
                <td>{$objTicket->getPostCode()} {$objTicket->getTown()|unescape}</td>  
                <td>{$objTicket->getFiles()}</td>
                <td>{$objTicket->getNumber()}</td>
                <td>{$objTicket->getMessage()|unescape}</td>
                <td>
                    <form name ="form" method="post" action ="index.php?ctrl=product&action=ArchiveTicket">
                    <input type="checkbox" id="archiver" name="archive" value="1">
                    <label for="archive">Ticket à archiver</label>
                    <input type="hidden" name="f_id" value="{$objTicket->getId()}">
                    <input type="submit" name="confirmer" id="confirmer" value="Archiver" class="btnPrin"/>
                    </form>        
                </td>    
            </tr>									
        {/foreach}
        </tbody>	
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Fichier</th>
                <th>Nombres copies</th>
                <th>Message</th>
                <th>Archiver</th>
            </tr>
        </tfoot>
    </table>

{/block}