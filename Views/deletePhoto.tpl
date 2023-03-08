{extends file="Views/modele.tpl"}

    {block name="header"}
        <script>$(document).ready( function () {
            $('#photo').DataTable();
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

    <form name ="form" method="post" action ="index.php?ctrl=product&action=DeletePhoto">
        <table id="photo" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Photo</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>            
                {foreach from=$arrPhotoToDisplay key=id item=objPhoto}
                    <tr>
                        <td>{$objPhoto->getName()|unescape}</td>
                        <td><img src="Assets/Images/{$objPhoto->getName()}" class="img-fluid col-2" alt=""/></a></td>
                        <td>
                            <input type="checkbox" id="ph_id" name="ph_id[]" value="{$objPhoto->getId()}">
                            <label for="ph_id">Photo à supprimer</label>
                        </td>    
                    </tr>									
                {/foreach}
            </tbody>	
            <tfoot>
            <tr>
                <th>Nom</th>
                <th>Photo</th>
                <th>Supprimer</th>
            </tr>
            </tfoot>
        </table>
    <input type="submit" value="Supprimer"/> <input type="reset" value="Annuler" />
    </form>
 
{/block}