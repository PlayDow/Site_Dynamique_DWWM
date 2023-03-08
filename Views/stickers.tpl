{extends file="Views/modele.tpl"}

    {block name="header"}
        <script>$(document).ready( function () {
            $('#comment').DataTable();
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

        {foreach from=$arrProductToDisplay item=objProduct}
            <article id="article_{$objProduct->getId()}" class="border border-dark">
            {foreach from=$arrPhotoToDisplay item=objPhoto}
                <img src="Assets/Images/{$objPhoto->getName()}" class="img-fluid" alt=""/></a>     
            {/foreach}
                <h2>{$objProduct->getName()|unescape}</h2>
                <div class="prixListe">{$objProduct->getDisplayPrice()}</div>
                <div class="Description">{$objProduct->getDescription()|unescape}</div>
                    <div class="w-100 buttonAddBuy d-inline-block">
                        <button class="buyBut" aria-label="Achat"><i class="bi bi-credit-card-2-front-fill w-100"></i><span class="cacherBase">Acheter maintenant</span></button>
                        <button class="cartBut" aria-label="ajoutPanier"><i class="bi bi-bag-plus "></i><span class="cacherBase">Ajouter au panier</span></button>
                    </div>  
                </div>
            </article>       
        {/foreach}

        <!--Ticket-->  
        <table id="comment" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Dates</th>
                <th>Modifier le commentaire</th>
                <th>Supprimer le commentaire</th>
            </tr>
        </thead>
        <tbody>
        {foreach from=$arrCommentToDisplay item=objComment}
                <tr>
                    <td>{$objComment->getPseudo()|unescape}</td>
                    <td>{$objComment->getValue()}/5</td>
                    <td>{$objComment->getComment()|unescape}</td> 
                    <td>{$objComment->getCreatedate()}</td> 
                    {if isset($smarty.session.user.id) && ($smarty.session.user.cp_type <= 2 || $smarty.session.user.id == $objComment->getAccount())}
                        <td><a href="index.php?ctrl=product&action=EditComment&account={$objComment->getAccount()}&product={$objProduct->getId()}&comment={$objComment->getId()}" class="btn btnPrin col-6" title="Modifier le produit">
                            Modifier le commentaire
                        </a>
                        <td><form name ="form" method="post" action ="index.php?ctrl=product&action=DeleteComment&account={$objComment->getAccount()}&comment={$objComment->getId()}&product={$objProduct->getId()}">
                            <input type="checkbox" id="delete" name="check" value="1">
                            <label for="check">Supprimer le commentaire</label>
                            <input type="hidden" name="f_id" value="{$objComment->getId()|unescape}">
                            <input type="submit" name="confirmer" id="confirmer" value="Supprimer" class="btnPrin"/>
                        </form> 
                    {else}
                        <td></td>
                        <td></td>
                    {/if} 
                     
                </tr>	
            {/foreach}								

        </tbody>	
        <tfoot>
            <tr>
                <th>Pseudo</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Dates</th>
                <th>Modifier le commentaire</th>
                <th>Supprimer le commentaire</th>
            </tr>
        </tfoot>
        </table>

        <div class="btn cacherBtnBase col-12" >
            {if isset($smarty.session.user.id)}                         
                <p><a href="index.php?ctrl=product&action=comment&product={$objProduct->getId()}" class="btn btnPrin col-6">Un truc à dire sur le produit ? Tu peux laisser un commentaire.</a>
            {else}
                <p><a href="index.php?ctrl=user&action=login" class="btn btnPrin col-6">Un truc à dire sur le produit ? Connecte toi pour laisser un commentaire.</a>
                <p><a href="index.php?ctrl=user&action=create_account" class="btn btnPrin col-6">Ou alors inscrit toi pour commander le produit.</a>
            {/if}
            {if isset($smarty.session.user.id) && ($smarty.session.user.cp_type == 1 || $smarty.session.user.id == $objProduct->getAccount())}
                <p><a href="index.php?ctrl=product&action=EditProduct&account={$objProduct->getAccount()}&product={$objProduct->getId()}" class="btn btnPrin col-6" title="Modifier le produit">
                    Modifier le produit
                </a>
                <p><a href="index.php?ctrl=product&action=DeleteProduct&account={$objProduct->getAccount()}&product={$objProduct->getId()}" class="delete btn btnPrin col-6" title="Supprimer le produit">
                    Supprimer le produit
                </a>
                <form name="formAdd" method="post" action="index.php?ctrl=product&action=AddPhoto&product={$objProduct->getId()}" enctype="multipart/form-data">
                    <fieldset>
                        <p>
                            <label for="photo">Rajouter une photo (20 maximum).</label>			
                            <br><input id="photo" type="file" name="img" />
                        </p>
                        <input type="submit" value="Rajouter"/> <input type="reset" value="Annuler" />
                    </fieldset>
                </form>	
                <p><a href="index.php?ctrl=product&action=DeletePhoto&account={$objProduct->getAccount()}&product={$objProduct->getId()}" class="btn btnPrin col-6" title="Supprimer des photos">
                    Supprimer des photos
                </a>
            {/if}
        </div>

        {literal}
            <script>
                $(document).ready(function(){
                    $('.delete').click(function(){
                        if(confirm("Etes-vous sûr de vouloir supprimer ce produit ?")){
                            //console.log();
                            $.ajax({
                                url : $(this).attr('href'),
                                type : 'GET',
                                dataType : 'html',
                                data : {ajax: 1},
                                success : function(code_html, statut){
                                    console.log(code_html);
                                    if(code_html > 0){
                                        $("#article_"+code_html).remove();
                                    }
                                }
                            });
                        }  
                        return false;                
                    })
                });
            </script>
        {/literal}


    {/block}