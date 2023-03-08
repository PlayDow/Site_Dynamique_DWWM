<!Doctype HTML>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Bienvenue sur le site SFprint. Nous proposons des stickers en vente direct ou personnalisés sur demande ainsi que des figurines 3D sur demande." />
        <meta name="robots" content="index, follow"/>
        <link href="Assets/bootstrap-css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="Assets/bootstrap-icons-1.10.2/bootstrap-icons.css">
        <script src="Assets/js/bootstrap.bundle.min.js " async async></script>
        <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css" />
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
        {block name="header"}
        
        {/block}
        <title>{$strTitle} - SFprint</title>
        
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
								<input type="search" name="recherche" id="recherche" placeholder="Rechercher un produit" autofocus="" value="{if isset($strSearch)}{$strSearch}{/if}"> <br>
								<input type="submit" value="Recherche" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                            
						   </form>
							 
                        </div>
                        
            <!-- Zone de Connexion/Inscription-->
                        {if isset($smarty.session.user.id) && $smarty.session.user.id != ''} <!--Vérifier si un utilisateur est connecté-->
                            <div class="d-none d-xxl-inline-block col-xxl-6 d-flex justify-content-end">
                                Bienvenue {$smarty.session.user.pseudo}!
                                <a href="index.php?ctrl=user&action=update_account" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                                    Modifier son compte
                                </a>
                                <a href="index.php?ctrl=user&action=logout" class="btn btnSec cacherBtnBase col-2 me-1 ps-1" >
                                    Se déconnecter
                                </a> 
                            {if isset($smarty.session.user.id) && $smarty.session.user.cp_type == 1}
                                <a href="index.php?ctrl=user&action=AdminUpdateAccount" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                                    Modérer les comptes existants
                                </a>
                                <a href="index.php?ctrl=product&action=ticket" class="btn btnPrin"> Voir les tickets de création de figurine </a>
                            {/if}
                            </div>
                        {else}                    
                            <div class="d-none d-xxl-inline-block col-xxl-6 d-flex justify-content-end"> 
                                <a href="index.php?ctrl=user&action=login" class="btn btnPrin cacherBtnBase col-2 me-1 ps-1" >
                                    Se connecter
                                </a>
                                <a href="index.php?ctrl=user&action=create_account" class="btn btnSec cacherBtnBase col-2 me-1 ps-1" >
                                    S'inscrire
                                </a>                       
                            </div>
                        {/if}
                        
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
                    {if isset($smarty.session.user.id) && $smarty.session.user.id != ''} <!--Vérifier si un utilisateur est connecté-->
                        <div class="col-5 pt-2 ps-3 d-flex justify-content-end">
                            Bienvenue {$smarty.session.user.pseudo}!
                            <a href="index.php?ctrl=user&action=update_account" class="btn btnPrin cacherLaptop btnMobile col-2 me-1 ps-1" >
                                Modifier son compte
                            </a>
                            <a href="index.php?ctrl=user&action=logout" class="btn btnSec cacherLaptop btnMobile col-2 me-1 ps-1" >
                                Se déconnecter
                            </a> 
                        {if isset($smarty.session.user.id) && $smarty.session.user.cp_type == 1}
                            <a href="index.php?ctrl=user&action=AdminUpdateAccount" class="btn btnPrin cacherLaptop btnMobile col-2 me-1 ps-1" >
                                Modérer les comptes existants
                            </a>
                            <a href="index.php?ctrl=product&action=ticket" class="btn btnPrin cacherLaptop btnMobile"> Voir les tickets de création de figurine </a>
                        {/if}
                        </div>
                    {else}                    
                        <div class="col-5 pt-2 ps-3 d-flex justify-content-end">
                            <a href="index.php?ctrl=user&action=login" class="btn cacherLaptop btnMobile btnPrin w-50"><i class="bi bi-door-open-fill"></i></a>
                            <a href="index.php?ctrl=user&action=create_account" class="btn cacherLaptop btnMobile btnSec w-50 ms-2"><i class="bi bi-pencil-square" ></i></a>                      
                        </div>
                    {/if}
                        
                </div>
            </div>
        </div>          
    </header>
<main>