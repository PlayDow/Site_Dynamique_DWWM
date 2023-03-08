{extends file="Views/modele.tpl"}

    {block name="header"}
        <script>$(document).ready( function () {
            $('#category').DataTable();
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

    <h2>{if $strPage == 'CreateCategory'}Ajouter une catégorie{else}Modifier une catégorie{/if}</h2>
    <form name="formAdd" method="post" action="index.php?ctrl=product&action={$strPage}&category={$objCategory->getId()}">
        <fieldset>
            <p>
                <label for="commentaire">Catégorie</label>
				<input id="title" type="text" name="name" value="{$objCategory->getName()}"/>
			</p>
            </p>
            <p><input type="submit" value="Ajouter"/>
        </fieldset>
    </form>

    {if isset($smarty.session.user.id) && ($smarty.session.user.cp_type <= 2) && ($strPage == 'CreateCategory')}
        <form name ="form" method="post" action ="index.php?ctrl=product&action=ValidateCategory">
            <table id="category" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Valider</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>            
                    {foreach from=$arrCategoryToDisplay key=id item=objValCategory}
                        <tr>
                            <td>{$objValCategory->getName()|unescape}</td>
                            <td>
                                <input type="checkbox" id="cat_id" name="cat_id[]" value='{$objValCategory->getId()}'>
                                <label for="cat_id">Categorie à valider</label>
                            </td> 
                            <td><a href="index.php?ctrl=product&action=EditCategory&category={$objValCategory->getId()}" class="btn btnPrin col-6" title="Modifier la categorie">
                                Modifier la catégorie
                            </td> 
                        </a>   
                        </tr>									
                    {/foreach}
                </tbody>	
                <tfoot>
                <tr>
                    <th>Nom</th>
                    <th>Valider</th>
                    <th>Modifier</th>
                </tr>
                </tfoot>
            </table>
        <input type="submit" value="Valider"/> <input type="reset" value="Annuler" />
        </form>
    {/if}
 
{/block}