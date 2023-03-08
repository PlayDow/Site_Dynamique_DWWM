{extends file="Views/modele.tpl"}

{block name="content"}

    {if count($arrError) > 0}
        <div>
        {foreach from=$arrError item=strError}
            <p>{$strError}</p>
        {/foreach}
        </div>
    {/if}

    <h2>{if $strPage == 'comment'}Ajouter un commentaire{else}Modifie ton commentaire{/if}</h2>
    <form name="formAdd" method="post" action="index.php?ctrl=product&action={$strPage}&product={$product}&comment={$objComment->getId()}" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for="commentaire">Commentaire</label>
                <textarea id="commentaire" name="comment" >{$objComment->getComment()}</textarea>
            </p>
            <ul class="notes-echelle">
                <p>Note du produit</p>
                <li>
                    <label for="note01" title="Note&nbsp;: 1 sur 5">1</label>
                    <input type="radio" name="value" {if ($objComment->getValue() == 1)} checked {/if} id="note01" value="1" />
                </li>
                <li>
                    <label for="note02" title="Note&nbsp;: 2 sur 5">2</label>
                    <input type="radio" name="value" {if ($objComment->getValue() == 2)} checked {/if} id="note02" value="2" />
                </li>
                <li>
                    <label for="note03" title="Note&nbsp;: 3 sur 5">3</label>
                    <input type="radio" name="value" {if ($objComment->getValue() == 3)} checked {/if} id="note03" value="3" />
                </li>
                <li>
                    <label for="note04" title="Note&nbsp;: 4 sur 5">4</label>
                    <input type="radio" name="value" {if ($objComment->getValue() == 4)} checked {/if} id="note04" value="4" />
                </li>
                <li>
                    <label for="note03" title="Note&nbsp;: 5 sur 5">5</label>
                    <input type="radio" name="value" {if ($objComment->getValue() == 5)} checked {/if} id="note03" value="5" />
                </li>
            </ul>
            <p><input type="submit" value="{if $strPage == 'comment'}Ajouter{else}Modifier{/if}" />
        </fieldset>
    </form>


{/block}