{extends file="Views/modele.tpl"}

{block name="content"}
	<main>
		<!--Bouton back to top-->
		<a href="#top" id="backToTop">Top</a>

		<h1 class="col-6 offset-3">Ce site est actuellement en version bêta. <br>Les fonctionnalités du site sont en cours débug.</h1>
		<div class="container" >
			
			<!--Présentation de l'entreprise-->
			<div class="row mt-5">
				<div class="col-12 col-lg-4 part">
					<h2>Présentation de l'entreprise</h2>
					<p>Nous sommes un groupe d’amis spécialisés 
					dans la création de stickers et l’impression 
					d’élément 3D. Notre objectif est de vous fournir 
					ce dont vous avez envie. N’hésitez pas à parcourir 
					notre sélection de stickers ou à faire des demandes 
					personnalisées de stickers ou d’impression 3D. </p>
				</div>
			<!--Présentation Stickers-->
				<div class='col-12 col-lg-4 part'>
					<h2>Stickers</h2>

					<p>Nos stickers sont majoritairement dessinés par notre artiste. 
						Nhésitez pas à regarder notre sélection.</p>

					<p>Vous pouvez demander ce que vous voulez au format 
						sticker : licorne, chien, ballon, chat, personnage et bien d’autres.</p>
						
					<p>Nous vous invitons à prendre contact par mail afin de définir 
						précisément le sticker de vos rêves pour vous satifaires.</p>
					<img src="Assets/Images/stickers.jpg" alt="" class="img-fluid">

				</div>

			<!--Présentation Figurines-->
				<div class='col-12 col-lg-4 part' id='Figurines'>
					<h2>Figurines</h2>

					<p>Pour toutes vos demandes de figurines, 
						vous pouvez contacter notre imprimeur via 
						le formulaire pour nous envoyer votre fichier 
						et définir les paramètre de votre commande.</p>

					<p>Que ce soit en résine ou en fil, nous pouvons 
						imprimer ce que vous désirez si la taille des 
						pièces ne dépassent pas la capacités de nos 
						imprimantes. Si cela est le cas nous pouvons 
						effectuer un travail de réajustement qui sera 
						également facturé à l’envoi.</p>
					<img src="Assets/Images/imprimante.jpg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</main>
{/block}