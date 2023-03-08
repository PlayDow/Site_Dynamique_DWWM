<?php
/* Smarty version 4.3.0, created on 2023-03-08 10:29:09
  from 'C:\wamp64\www\Site_Dynamique_DWWM\Views\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_6408637544ef37_40974039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7400eca5e60d127a481810fb19aaf9257cde8692' => 
    array (
      0 => 'C:\\wamp64\\www\\Site_Dynamique_DWWM\\Views\\index.tpl',
      1 => 1678271138,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6408637544ef37_40974039 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9204464396408637544b859_88337246', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "Views/modele.tpl");
}
/* {block "content"} */
class Block_9204464396408637544b859_88337246 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_9204464396408637544b859_88337246',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

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
<?php
}
}
/* {/block "content"} */
}
