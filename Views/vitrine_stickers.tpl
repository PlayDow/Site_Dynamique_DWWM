{extends file="Views/modele.tpl"}

{block name="content"}

	<main class="container">
        <!--Bouton back to top-->
            <a href="#top" id="backToTop">Top</a>

        <!--Partie liste-->
                <div class="row">    
                    <h1 class="col-12 p-0">
                    Retrouver ici les stickers réalisés par notre artiste. 
                    </h1>
					
					<a class="btn cacherBtnBase col-2 me-1 ps-1" >  
                    {if isset($smarty.session.user.id)}                         
                        <a href="index.php?ctrl=product&action=create" class="btn btnPrin"> Si tu veux créer un sticker, à toi de jouer ! </a>
                    {else}
                        <p><a href="index.php?ctrl=user&action=login" class="btn btnPrin col-6">Tu veux proposer un sticker ? Pense donc à te connecter.</a>
                        <p><a href="index.php?ctrl=user&action=create_account" class="btn btnPrin col-6">Ou alors inscrit toi.</a>
                    {/if}     
                        <a href="index.php?ctrl=page&action=Contact" class="btn btnPrin"> Sur mesure? Contactez-nous ! </a>
                    </a>
							
                    <div class="col-3">

                    <!--offcanvas des filtres en taille d'écran Mobile-->

                        <button class="btn btnCanvas w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-label="Filtres">
                            <i class="bi bi-filter-square-fill" ></i>
                        </button>
                        
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtres</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
							
							<form method="post" action="index.php?ctrl=product&action=VitrineFilter">
                                <ul>
									{foreach from=$arrCatToDisplay item=objCat}									
										<li>{$objCat->getName()|unescape} <input type="checkbox" name="cat[]"  id="filtre1" value="{$objCat->getId()}" {if (in_array($objCat->getId(), $arrSelected))} checked {/if}></li>
									{/foreach}
                                </ul>
								<input type='submit' value='Appliquer'/>
							</form>
                            </div>
                        </div>
                    </div>
                    
                </div>   
                
            <!--Liste Produits-->                
                <div class="row ms-1">

                <!--Articles-->
                {if count($arrErrors) > 0}
					<div>
					{foreach from=$arrErrors item=strError}
						<p>{$strError}</p>
					{/foreach}
					</div>
				{else}									
					{foreach from=$arrProductToDisplay item=objProduct}
						<article class="col d-flex flex-row border border-dark">
							<a href="index.php?ctrl=product&action=Stickers&product={$objProduct->getId()}&account={$objProduct->getAccount()}"><img src="Assets/Images/{$objProduct->getPhoto()}" class="img-fluid col-12" alt=""/></a> 
							<h2 class="offset-1">{$objProduct->getName()|unescape}</h2>
							<div class="prixListe offset-1">{$objProduct->getDisplayPrice()}</div>
							<div class="w-100 buttonAddBuy d-inline-block">
								<button class="buyBut" aria-label="Achat"><i class="bi bi-credit-card-2-front-fill w-100 offset-1"></i><span class="cacherBase">Acheter maintenant</span></button><br>
								<button class="cartBut" aria-label="ajoutPanier"><i class="bi bi-bag-plus offset-1"></i><span class="cacherBase">Ajouter au panier</span></button>
							</div>
                            {if isset($smarty.session.user.id) && ($smarty.session.user.cp_type == 1 || $smarty.session.user.id == $objProduct->getAccount())}
                                <p><a href="index.php?ctrl=product&action=DeleteProduct&account={$objProduct->getAccount()}&product={$objProduct->getId()}" class="delete btn btnPrin col-6" title="Supprimer le produit">
                                    Supprimer l'article
                                </a>
                            {/if}  
						</article> 										
					</div>
					{/foreach}
                {/if}     	
        </main>  
        
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