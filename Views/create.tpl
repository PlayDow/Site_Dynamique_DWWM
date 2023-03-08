{extends file="Views/modele.tpl"}

{block name="content"}

	{if count($arrError) > 0}
        <div>
        {foreach from=$arrError item=strError}
            <p>{$strError}</p>
        {/foreach}
        </div>
    {/if}

	<h2>{if $strPage == 'create'}Ajouter un produit{else}Modifier un produit{/if}</h2>
	<form name="formAdd" method="post" action="index.php?ctrl=product&action={$strPage}&product={$objProduct->getId()}" enctype="multipart/form-data">
		<fieldset>
			<p>
				<label for="title">Nom du produit</label>
				<input id="title" type="text" name="name" value="{$objProduct->getName()}"/>
			</p>
			<p>
				<label for="price">Prix du produit</label>
				<input id="price" type="number" step="0.01" name="price" value="{$objProduct->getPrice()}" />
			</p>
			<p>
				<label for="description">Description du produit</label>
				<textarea id="description" name="description" >{$objProduct->getDescription()}</textarea>
			</p>
			<p>
				<label for="category">Catégorie</label>
				<select id="category" name="category">
					<option value=''>--</option>
					{foreach from=$arrCategoryToDisplay item=objCategory}
						<option {if (in_array($objCategory->getId(), $arrSelected))} selected {/if} value='{$objCategory->getId()}'>{$objCategory->getName()}</option>
					{/foreach}
				</select>
			</p>
			<p>
				<label for="photo">Photo du produit</label>
				{if $objProduct->getPhoto() != ''}
					<img src="Assets/Images/{$objProduct->getPhoto()}" />
					<input type="hidden" name="photo" value="{$objProduct->getPhoto()}" />
				{/if}				
				<input id="photo" type="file" name="img" />
			</p>
			<input type="hidden" name="account" value="{$objProduct->getAccount()}"/>
			<input type="submit" value="{if $strPage == 'create'}Créer{else}Modifier{/if}"/> <input type="reset" value="Annuler" />
		</fieldset>
	</form>	

	{if $strPage == 'create'}
		<p><a href="index.php?ctrl=product&action=Createcategory" class="btn btnPrin col-6 mt-5" title="créer une catégorie">
			La catégorie de ton stickers n'existe pas ? N'hésite pas à la créer.
		</a>
		<p>PS : Elle sera soumise à la validation d'un modérateur.</p>
	{/if}

{/block}