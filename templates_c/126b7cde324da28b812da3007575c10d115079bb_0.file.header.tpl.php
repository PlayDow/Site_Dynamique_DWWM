<?php
/* Smarty version 4.3.0, created on 2023-03-08 10:29:09
  from 'C:\wamp64\www\Site_Dynamique_DWWM\Views\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_6408637563fcc5_82661362',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '126b7cde324da28b812da3007575c10d115079bb' => 
    array (
      0 => 'C:\\wamp64\\www\\Site_Dynamique_DWWM\\Views\\header.tpl',
      1 => 1678271138,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6408637563fcc5_82661362 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!Doctype HTML>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Bienvenue sur le site SFprint. Nous proposons des stickers en vente direct ou personnalisés sur demande ainsi que des figurines 3D sur demande." />
        <meta name="robots" content="index, follow"/>
        <link href="Assets/bootstrap-css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="Assets/bootstrap-icons-1.10.2/bootstrap-icons.css">
        <?php echo '<script'; ?>
 src="Assets/js/bootstrap.bundle.min.js " async async><?php echo '</script'; ?>
>
        <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css" />
        <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
        <?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"><?php echo '</script'; ?>
>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4102636386408637559be91_07655622', "header");
?>

        <title><?php echo $_smarty_tpl->tpl_vars['strTitle']->value;?>
 - SFprint</title>
        
    </head>


    <body>
        <header class="container-fluid" id="top">
            <div class="row">   

            <!--logo-->  
                <div class="col-3 col-lg-2 col-xxl-2">

    
        <img src="Assets/Images/logo_web.png" alt="" class="img-fluid">
    
            
                </div>

            <!--Barre de recherche-->
                <div class="col-9 col-lg-10">
                    <div class="row pt-2 d-flex justify-content-start">
                        <div class="col-12 col-lg-12 col-xxl-6 p-0 me-0" id="barRec">
                            <form name="recherche" method="post" action="index.php?ctrl=product&action=Vitrine">
								<input type="search" name="recherche" id="recherche" placeholder="Rechercher un produit" autofocus="" value="<?php if ((isset($_smarty_tpl->tpl_vars['strSearch']->value))) {
echo $_smarty_tpl->tpl_vars['strSearch']->value;
}?>"> <br>
								<input type="submit" value="Recherche" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                            
						   </form>
							 
                        </div>
                        
            <!-- Zone de Connexion/Inscription-->
                        <?php if ((isset($_SESSION['user']['id'])) && $_SESSION['user']['id'] != '') {?> <!--Vérifier si un utilisateur est connecté-->
                            <div class="d-none d-xxl-inline-block col-xxl-6 d-flex justify-content-end">
                                Bienvenue <?php echo $_SESSION['user']['pseudo'];?>
!
                                <a href="index.php?ctrl=user&action=update_account" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                                    Modifier son compte
                                </a>
                                <a href="index.php?ctrl=user&action=logout" class="btn btnSec cacherBtnBase col-2 me-1 ps-1" >
                                    Se déconnecter
                                </a> 
                            <?php if ((isset($_SESSION['user']['id'])) && $_SESSION['user']['cp_type'] == 1) {?>
                                <a href="index.php?ctrl=user&action=AdminUpdateAccount" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                                    Modérer les comptes existants
                                </a>
                                <a href="index.php?ctrl=product&action=ticket" class="btn btnPrin"> Voir les tickets de création de figurine </a>
                            <?php }?>
                            </div>
                        <?php } else { ?>                    
                            <div class="d-none d-xxl-inline-block col-xxl-6 d-flex justify-content-end"> 
                                <a href="index.php?ctrl=user&action=login" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                                    Se connecter
                                </a>
                                <a href="index.php?ctrl=user&action=create_account" class="btn btnSec cacherBtnBase col-2 me-1 ps-1" >
                                    S'inscrire
                                </a>                       
                            </div>
                        <?php }?>
                        
                    </div>
                </div>    

            <!--Menu-->
                <div class="row">
                    <div class="col-5 col-xxl-12">
                <!--Menu hamburger-->
                    <!--Bouton du menu-->
                        <nav class="navbar navbar-dark cacherLaptop"> 
                            <div class="container-fluid p-0">
                                <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>                                
                            </div>                            
                        </nav>

                    <!--Contenu du menu hors hamburger-->
                        <nav class="nav navbar-expand-xl cacherBase" id="menu">
                            <ul class="navbar-nav d-flex">
                            
                                <li class="nav-item"><a href="index.php?ctrl=page&action=Index" class="accueil"> Accueil </a></li>            
                                <li class="nav-item"><a href="index.php?ctrl=product&action=Vitrine" class="vitrineStickers"> Vitrine </a></li>            
                                <li class="nav-item"><a href="index.php?ctrl=product&action=Figurines" class="commandeFigurines"> Figurines </a></li>            
                                <li class="nav-item"><a href="index.php?ctrl=page&action=Contact" class="contacts"> Contact </a></li>                                   
                           
                            </ul>
                        </nav>

                    <!--Contenu du menu hamburger-->
                        <div class="collapse" id="navbarToggleExternalContent">
                            <nav id="menuH">
                            <ul class="navbar-nav d-flex">
                                
                                    <li class="nav-item"><a href="index.php?ctrl=page&action=Index" class="accueil"> Accueil </a></li>            
                                    <li class="nav-item"><a href="index.php?ctrl=product&action=Vitrine" class="vitrineStickers"> Vitrine </a></li>            
                                    <li class="nav-item"><a href="index.php?ctrl=product&action=Figurines" class="commandeFigurines"> Figurines </a></li>            
                                    <li class="nav-item"><a href="index.php?ctrl=page&action=Contact" class="contacts"> Contact </a></li>                                     
                                
                                </ul>
                            </nav>
                        </div>     
                    </div>

                <!--bouton de connexion Mobile-->
                    <div class="d-xxl-none col-5 pt-2 ps-3 d-flex justify-content-end">
                    <?php if ((isset($_SESSION['user']['id'])) && $_SESSION['user']['id'] != '') {?> <!--Vérifier si un utilisateur est connecté-->
                        <div class="col-5 pt-2 ps-3 d-flex justify-content-end">
                            Bienvenue <?php echo $_SESSION['user']['pseudo'];?>
!
                            <a href="index.php?ctrl=user&action=update_account" class="btn btnPrin cacherLaptop btnMobile col-2 me-1 ps-1" >
                                Modifier son compte
                            </a>
                            <a href="index.php?ctrl=user&action=logout" class="btn btnSec cacherLaptop btnMobile col-2 me-1 ps-1" >
                                Se déconnecter
                            </a> 
                        <?php if ((isset($_SESSION['user']['id'])) && $_SESSION['user']['cp_type'] == 1) {?>
                            <a href="index.php?ctrl=user&action=AdminUpdateAccount" class="btn btnPrin cacherLaptop btnMobile col-2 me-1 ps-1" >
                                Modérer les comptes existants
                            </a>
                            <a href="index.php?ctrl=product&action=ticket" class="btn btnPrin cacherLaptop btnMobile"> Voir les tickets de création de figurine </a>
                        <?php }?>
                        </div>
                    <?php } else { ?>                    
                        <div class="col-5 pt-2 ps-3 d-flex justify-content-end">
                            <a href="index.php?ctrl=user&action=login" class="btn cacherLaptop btnMobile btnPrin w-50"><i class="bi bi-door-open-fill"></i></a>
                            <a href="index.php?ctrl=user&action=create_account" class="btn cacherLaptop btnMobile btnSec w-50 ms-2"><i class="bi bi-pencil-square" ></i></a>                      
                        </div>
                    <?php }?>
                        
                </div>
            </div>
        </div>          
    </header>
<main><?php }
/* {block "header"} */
class Block_4102636386408637559be91_07655622 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header' => 
  array (
    0 => 'Block_4102636386408637559be91_07655622',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        
        <?php
}
}
/* {/block "header"} */
}
