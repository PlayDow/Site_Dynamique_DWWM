{extends file="Views/modele.tpl"}

{block name="content"}

<main>
	<!--Bouton back to top-->
	<a href="#top" id="backToTop">Top</a>

	<h1>Pages</h1>
	<ul>
		<li><a href="index.php?ctrl=page&action=Index"> Accueil </a></li>

		<li><a href="index.php?ctrl=product&action=Vitrine"> Vitrine de Stickers </a></li>
		
		<li><a href="index.php?ctrl=product&action=Figurines"> Commande de figurines </a></li>
			
		<li><a href="index.php?ctrl=page&action=Contact"> Contacts </a></li>

		<li><a href="index.php?ctrl=page&action=Plan"> Plan du site </a></li>

		<li><a href="index.php?ctrl=page&action=Mentions"> Mentions légales </a></li>
	</ul>
</main>
{/block}