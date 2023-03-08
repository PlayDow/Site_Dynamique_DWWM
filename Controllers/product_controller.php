<?php

	/**
	* Controller des produits
	* @author Dorian Cotteret
    *<ul>
    *   <li>Figurines</li>
    *   <li>Ticket</li>
    *   <li>ArchiveTicket</li>
    *   <li>Create</li>
    *   <li>EditProduct</li>
    *   <li>DeleteProduct</li>
    *   <li>Stickers</li>
    *   <li>Comment</li>
    *   <li>EditComment</li>
    *   <li>DeleteComment</li>
    *   <li>AddPhoto</li>
    *   <li>DeletePhoto</li>
    *   <li>CreateCategory</li>
    *   <li>EditCategory</li>
    *   <li>ValidateCategory</li>
    *</ul>
    * @author Quentin Serpette
    *<ul>
    *   <li>Vitrine</li>
    *   <li>Stickers</li>
    *   <li>VitrineFilter</li>
    *</ul>
	*/
	class Product_controller extends Base_controller{

        /**
		* Constructeur de la classe
		*/ 
		public function __construct(){
			require ("Entities/produit_entity.php");
			require ("Models/produit_manager.php");

            require ('Entities/photo_entity.php');
            require ('Models/photo_manager.php');

            require ("entities/figurine_entity.php");
            require ("models/figurine_manager.php");

            require ('Models/categorie_manager.php');
            require ('Entities/categorie_entity.php');

            require ('Models/commentaire_manager.php');
            require ('Entities/commentaire_entity.php');

            require ('Models/avoir_manager.php');
            require ('Entities/avoir_entity.php');

            require ('Entities/compte_entity.php'); 
            require ('Models/compte_manager.php');
		}


		/**
		* Page de commande des figurines
		*/
		public function Figurines(){

            // Initialisation du tableau d'erreurs
            $arrError 	        = array(); 

            // Initialisation des objets entities & manager
			$objFigurine        = new Figurine;			 
			$objFigurineManager = new FigurineManager;

            // Vérification de l'envoie du formulaire
            if (count($_POST) > 0){
                $objFigurine->hydrate($_POST);
                $arrFilesInfos = $_FILES['file']??array();  
                $boolTest = $_FILES['file']['name'];
                
                // Tests des erreurs
                if ($objFigurine->getFirstname() == ''){
                    $arrError[] = "Merci de mettre votre prénom";
                }
                if ($objFigurine->getName() == ''){
                    $arrError[] = "Merci de mettre votre nom";
                }
                if ($objFigurine->getPhone() == ''){
                    $arrError[] = "Merci de mettre votre numéro de téléphone";
                }
                if ($objFigurine->getMail() == ''){
                    $arrError[] = "Merci de mettre votre adresse mail";
                }
                if ($objFigurine->getNumAddress() == ''){
                    $arrError[] = "Merci de renseigner le numéro de rue";
                }
                if ($objFigurine->getStreet() == ''){
                    $arrError[] = "Merci de renseigner un nom de rue";
                }
                if ($objFigurine->getPostCode() == ''){
                    $arrError[] = "Merci de renseigner votre code postal";
                }
                if ($objFigurine->getTown() == ''){
                    $arrError[] = "Merci de renseigner votre ville";
                }
                if ($objFigurine->getNumber() == ''){
                    $arrError[] = "Merci de renseigner le nombre de copies souhaités";
                }

                // Vérification si le fichier est présent et aux formats .stl
                if ($arrFilesInfos['size'] == 0){
                    $arrError[] = "Merci d'ajouter un fichier .stl"; 
                } else if(!preg_match('/\.(stl|)$/', $boolTest)) {
                    $arrError[] = "Mettre un fichier au format .stl";
                } else {
                    if (count($arrError) == 0){

                        // Sauvegarde de l'image sur le serveur
                        $strFileName 	= $arrFilesInfos['tmp_name'];
                        $objDate 		= new DateTime();
                        $arrFiles 		= explode(".", $arrFilesInfos['name']);
                        $strNewName 	= $objDate->format('YmdHis').".".$arrFiles[count($arrFiles)-1];
                        $strFileDest 	= $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/DWWM-2022-2023-Groupe-2-Projet-2-SFprint/Assets/figurine/'.$strNewName;

                        // Insertion en BDD, si fichier envoyé au serveur
                        if (move_uploaded_file($strFileName, $strFileDest)){
                            $objFigurine->setFiles($strNewName);					
                            if($objFigurineManager->addFigurine($objFigurine)){
                                header("Location:index.php");
                            }else{
                                $arrError[]	= "Erreur d'envoie dr la demande";
                            }
                        }
                    }
                }
            }

            // Affichage dans le template
            $this->_arrData['arrError']		    = $arrError;
            $this->_arrData['objFigurine']		= $objFigurine;
            $this->_arrData['strTitle'] 	    = "Commande Figurines";
            $this->_arrData['strPage']	        = "commande_figurines";
            $this->display("commande_figurines");
        }


		
        /**
		* Page de la liste des tickets pour impression figurines
		*/
		public function Ticket(){

            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Initialisation du tableau d'erreurs
            $arrError 	        = array(); 

            // Initialisation des objets entities & manager
            $objAccountManager = new AccountManager();
            $objUser = new Account();

            // Récupération des informations utilisateurs pour vérification permission
            $objAccountInfo  = $objAccountManager->findAccountToModify();
            $objUser->hydrate($objAccountInfo);
            
            // Contrôle que l'utilisateur soit admin ou modérateur
            if(($objUser->getType()!=1) && ($objUser->getType()!=2)) {
                header("Location:index.php?ctrl=error&action=error_403");
            } else {
                // Instancier la classe et récupération des infos figurines
                $ticketManager = new FigurineManager(); 
                $arrTicket = $ticketManager->findTicket(); 

                // Affichage de tout les tickets non archiver
                $arrTicketToDisplay = array();
                foreach ($arrTicket as $arrTickets){
                    $objTicket = new Figurine;
                    $objTicket->hydrate($arrTickets);	
                    $arrTicketToDisplay[] = $objTicket;
                }

                // Affichage de l'erreur de la fonction "ArchiveTicket"
                if (isset($_GET['error']) && $_GET['error'] == '1'){
                    $arrError[] = "Merci de choisir un ticket à archiver.";
                } else if (isset($_GET['error']) && $_GET['error'] == '2'){                    
                    $arrError[]	= "Erreur d'envoie de la demande";
                }          		
            }

            // Affichage dans le template
            $this->_arrData['arrTicketToDisplay']	= $arrTicketToDisplay;
            $this->_arrData['arrError']		        = $arrError;
            $this->_arrData['strTitle']	            = "Liste des tickets";
            $this->_arrData['strPage']	            = "ticket";
            $this->display("ticket");
        }


        /**
		* Méthode pour archiver les tickets
		*/
		public function ArchiveTicket(){
            
            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Initialisation du tableau d'erreurs
            $arrError 	        = array(); 

            // Initialisation des objets entities & manager
            $objUser            = new Account();
            $objAccountManager  = new AccountManager();
            $objFigurine        = new Figurine;			 
            $objFigurineManager = new FigurineManager;

            // Récupération des informations utilisateurs pour vérification permission
            $objAccountInfo  = $objAccountManager->findAccountToModify();
            $objUser->hydrate($objAccountInfo);
            
            // Contrôle que l'utilisateur soit admin ou modérateur
            if(($objUser->getType()!=1) && ($objUser->getType()!=2)) {
                header("Location:index.php?ctrl=error&action=error_403");
            }else{

                /* Vérification de l'envoie du formulaire et que le bouton est sélectionné
                    sinon renvoie vers la page ticket avec l'erreur 1 */
                if (!isset($_POST['archive'])){
                    header("Location:index.php?ctrl=product&action=ticket&error=1");
                }else{   
                    
                    /* Hydratation et envoie la demande d'archivage vers la BDD
                        ou renvoie vers la page ticket avec l'erreur 2 */
                    $objFigurine->hydrate($_POST);
                    $objFigurineManager->archiveTicket($objFigurine);
                    if ($objFigurine != false){
                        header("Location:index.php?ctrl=product&action=ticket");
                    }else{
                        header("Location:index.php?ctrl=product&action=ticket&error=2");
                    }
                }
            }
        }    


		/**
		* Page de création de produit
		*/
		public function Create(){

            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=error&action=error_403");
			}
            
            // Liste des catégories dans le formulaire
            $objCategoryManager               = new CategoryManager(); 
			$arrCategory		              = $objCategoryManager->findCategory(); 	
			$arrCategoryToDisplay             = array();
            $arrSelected                      = array();
            $intCategory                      = $_POST['category']??'';
            $this->_arrData['intCategory ']   = $intCategory;
			foreach ($arrCategory as $arrDetCategory){
                $objCategory = new Category;
                $objCategory->hydrate($arrDetCategory);
                if ($intCategory == $objCategory->getId()) {
                    $arrSelected[] = $objCategory->getId();
                }
                $arrCategoryToDisplay[] = $objCategory;
            }
            $this->_arrData['arrSelected']	             = $arrSelected;
            $this->_arrData['arrCategoryToDisplay']	     = $arrCategoryToDisplay;

            // Initialisation du tableau des erreurs
            $arrError 	= array(); 

            // Initialisation des objets entities & manager
            $objProduct = new Product;
            $objProductManager 	= new ProductManager;
            $objPhoto = new Photo;
            $objPhotoManager = new PhotoManager;            
            $objHave = new Have;
            $objHaveManager = new HaveManager;

            // Vérification de l'envoie du formulaire
            if (count($_POST) > 0){

                // Fonction d'hydratation
                $arrPhotoInfos      = $_FILES['img']??array();
                $_POST['price']     = floatval($_POST['price']);
                $_POST['category']  = intval($_POST['category']);             
                $objProduct->hydrate ($_POST); 
                $objProduct->setAccount(($_SESSION['user']['id']));         
                $objHave->hydrate ($_POST);

                // Tests des erreurs
                if ($objProduct->getName() == '') {
                    $arrError[] = "Merci de renseigner un nom de produit";
                }
                if ($objProduct->getPrice() == 0) {
                    $arrError[] = "Merci de renseigner un prix";
                }
                if ($objProduct->getDescription() == '') {
                    $arrError[] = "Merci de renseigner une description de produit";
                }
                if ($arrPhotoInfos['size'] == 0) {
                    $arrError[] = "Merci de rajouter une photo";
                }
                if ($objHave->getCategory() == 0) {
                    $arrError[] = "Merci de sélectionner une categorie";
                }

                // Sauvegarde de l'image sur le serveur si aucune erreur
                if (count($arrError)==0){ 					
					$strNewName = $this->_photoName($arrPhotoInfos['name']);
					$boolOk 	= $this->_photoTraitement($arrPhotoInfos, $strNewName);

                    // Insertion en BDD du produit si traitement de la photo est bon
					if($boolOk){                        
                        $strNewId = $objProductManager->CreateProduct($objProduct);

                        /* Insertion des données de la photo et de l'appartenance du produit à une catégorie 
                            si récupération de l'ID produit lors de son enregistrement */
                        if ($strNewId != false){
                            $strNewId = intval($strNewId);
                            $objPhoto->setName($strNewName);
                            $objPhoto->setProduct($strNewId);
                            $returnPhoto    = $objPhotoManager->CreatePhoto($objPhoto, 1);
                            $objHave->setProduct($strNewId);
                            $returnHave     = $objHaveManager->CreateHave($objHave);
                        }

                        // Vérification des insertions
                        if($strNewId !== false && $returnPhoto!== false && $returnHave!== false){
                            header("Location:index.php?ctrl=product&action=vitrine");
                        }else{
                            $arrError[]	= "Erreur d'envoie de la demande";
                        }
                    }
                }
            }

            // Affichage sur le template            
            $this->_arrData['objProduct']	             = $objProduct;
            $this->_arrData['arrError']	                 = $arrError;
            $this->_arrData['strTitle']	                 = "Création de produit";
            $this->_arrData['strPage']	                 = "create";
            $this->display("create");
        }


        /**
		* Page Modifier un produit
		*/
		public function EditProduct() {

            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=error&action=error_403");
			}

            // Variable pour redirection vers le stickers du produit actuel
            $intCreator = $_SESSION['creator'];
            $intProduct = $_SESSION['product'];

            // Initialisation du tableau des erreurs
            $arrError 	= array(); 

            // Initialisation des objets entities & manager
            $objProduct = new Product;
            $objProductManager 	= new ProductManager;
            $objPhoto = new Photo;
            $objPhotoManager = new PhotoManager;
            $objHave = new Have;
            $objHaveManager = new HaveManager;

            // Vérification de l'envoie du formulaire
            if (count($_POST) > 0){

                //Fonction d'hydratation
                $arrPhotoInfos      = $_FILES['img']??array();
                $_POST['price']     = floatval($_POST['price']);
                $_POST['category']  = intval($_POST['category']); 
                $objProduct->hydrate ($_POST);            
                $objHave->hydrate ($_POST);

                // Tests des erreurs
                if ($objProduct->getName() == '') {
                    $arrError[] = "Merci de renseigner un nom de produit";
                }
                if ($objProduct->getPrice() == 0) {
                    $arrError[] = "Merci de renseigner un prix";
                }
                if ($objProduct->getDescription() == '') {
                    $arrError[] = "Merci de renseigner une description de produit";
                }
                if ($objHave->getCategory() == 0) {
                    $arrError[] = "Merci de sélectionner une categorie";
                }
                if ($arrPhotoInfos['name'] != '' && $arrPhotoInfos['size'] == 0){
					$arrError['image'] = "Merci de renseigner une image";
				}

                // Sauvegarde de l'image sur le serveur si aucune erreur
                if (count($arrError)==0){ 
                    $boolOk 	= true;
                    $strNewName = $objProduct->getPhoto();
                    if ($arrPhotoInfos['name'] != '') {
                        $strNewName = $this->_photoName($arrPhotoInfos['name']);
                        $boolOk 	= $this->_photoTraitement($arrPhotoInfos, $strNewName); 
                    }

                    // Insertion en BDD du produit si traitement de la photo est bon
					if ($boolOk) {
                        $strId = $objProductManager->EditProduct($objProduct);
                        if ($strId != false){

                            // Insertion des données de la photo
                            $objPhoto->setName($strNewName);
                            $objPhoto->setProduct($_GET['product']);
                            $returnPhoto    = $objPhotoManager->EditPhoto($objPhoto);

                            // Insertion de l'appartenance du produit à une catégorie
                            $objHave->setProduct($_GET['product']);
                            $returnHave     = $objHaveManager->EditHave($objHave);
                        }
                        // Vérification des insertions
                        if($strId !== false && $returnPhoto!== false && $returnHave!== false){
                            header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator");
                        }else{
                            $arrError[]	= "Erreur d'envoie de la demande";
                        }
                    }
                } 
            } else {
                $intProduct = $_GET["product"];

                // Liste des catégories dans le formulaire
// Modification à prévoir
                $objCategoryManager               = new CategoryManager(); 
                $arrCategory		              = $objCategoryManager->findCategory();
                $intHave = 	$objHaveManager->findHave($intProduct);
                $arrCategoryToDisplay             = array();
                $arrSelected                      = array();
                $intCategory                      = $_POST['category']??'';
                $this->_arrData['intCategory ']   = $intCategory;
                foreach ($arrCategory as $arrDetCategory){
                    $objCategory = new Category;
                    $objCategory->hydrate($arrDetCategory);
                    if ($intCategory == $objCategory->getId()) {
                        $arrSelected[] = $objCategory->getId();
                    }
                    $arrCategoryToDisplay[] = $objCategory;
                }
                $this->_arrData['arrSelected']	             = $arrSelected;
                $this->_arrData['arrCategoryToDisplay']	     = $arrCategoryToDisplay;

                // Rechercher le produit                
                $arrProduct = $objProductManager->findEditProduct($intProduct);

                 // Vérification que le produit existe, l'utilisateur est admin ou modérateur ou créateur du produit
                $_GET['account'] = intval($_GET['account']);
                if ($intProduct === false 
				|| 	($_GET['account']) != $_SESSION['user']['id']
				&& 	$_SESSION['user']['cp_type'] != 1){
					header("Location:index.php?ctrl=error&action=error_403");
				}else{
                    // hydratation de l'article
                    $objProduct->hydrate($arrProduct);                    
                }
            }
            // Affichage sur le template            
            $this->_arrData['objProduct']	             = $objProduct;
            $this->_arrData['arrError']	                 = $arrError;
            $this->_arrData['strTitle']	                 = "Modification de produit";
            $this->_arrData['strPage']	                 = "EditProduct";
            $this->display("create");
        }


		/** 
		* Page de suppresion des produits
		*/
        public function DeleteProduct(){

			// Vérification que l'utilisateur soit connecté
			if ( (!isset($_SESSION['user'])) ){
				header("Location:index.php?ctrl=error&action=error_403");
			}
            
			$boolAjax	= isset($_GET['ajax']);
			$intId 		= $_GET['product'];

            // Initialisation des objets managers
            $objHaveManager     = new HaveManager;
            $objPhotoManager    = new PhotoManager;
			$objProductManager 	= new ProductManager;
            $objCommentManager  = new CommentManager;

			$arrProduct = $objProductManager->findEditProduct($intId);

            // Vérification que le produit existe, l'utilisateur est admin ou modérateur ou créateur du produit
            $_GET['account'] = intval($_GET['account']);
            if ($arrProduct === false 
                || 	($_GET['account']) != $_SESSION['user']['id']
                && 	$_SESSION['user']['cp_type'] != 1)
            {	
                if ($boolAjax){
                    echo 0;
                }else{
                    header("Location:index.php?ctrl=error&action=error_403");
                }
            }else{	

                // Suppresion des commentaires, liaisons catégories, photos et produit et renvoi un Bool pour vérification que la requête soit effectué
                $boolCommentOk  = $objCommentManager->DeleteComment($intId);		
                $boolHavedOk    = $objHaveManager->DeleteHave($intId);
                $boolPhotoOk    = $objPhotoManager->DeleteProductPhoto($intId);	
                $boolProductOk  = $objProductManager->DeleteProduct($intId);
                  
                if ($boolProductOk && $boolHavedOk && $boolPhotoOk && $boolCommentOk){
                    if ($boolAjax){
                        header("Location:index.php?ctrl=error&action=error_403");
                    }else{
                        echo 1;
                    }
                }else{
                    if ($boolAjax){
                        echo 2;
                    }else{
                        header("Location:index.php?ctrl=error&action=error_403");
                    }
                }
            }
        }
        //             header("Location:index.php?ctrl=product&action=vitrine");
        //         } else {
        //             header("Location:index.php?ctrl=error&action=error_403");
        //         }
        //     }
		// }

		
		/**
		* Page vitrine des stickers
		*/
		public function Vitrine(){

			$objManager = new ProductManager(); // Instancier la classe//
			$arrProduct = $objManager->findProduct(); // Utiliser la classe //

			$arrErrors 	= array();
			
			$arrProductToDisplay = array();
			foreach ($arrProduct as $arrProducts){
				$objProduct = new Product;
				$objProduct->hydrate($arrProducts);	
				$arrProductToDisplay[] = $objProduct;
			}
			if (count($arrProduct) == 0  ){
				$arrErrors['noProduct'] = "Aucun produit ne correspond à votre recherche";
			}else{
					// On envoie la liste des objets à la vue
				$this->_arrData['arrProductToDisplay']= $arrProductToDisplay;

				$arrSelCategory = $_POST['category']??array();
				
				// Liste des catégories
				
				$objCatManager = new CategoryManager(); 
				$arrCats		= $objCatManager->findCategory(); 	

				$arrCatToDisplay = array();
				$arrSelected		= array();
				foreach ($arrCats as $arrCat){
						$objCat = new Category;
						$objCat->hydrate($arrCat);
						
						if (in_array($objCat->getId(), $arrSelCategory)){
						//if ($arrSelCategory == $objCat->getId()){
							$arrSelected[] = $objCat->getId();
						}
						$arrCatToDisplay[] = $objCat;
				}
				$this->_arrData['arrSelected']		= $arrSelected;
				$this->_arrData['arrCatToDisplay']	= $arrCatToDisplay;	
			}
            $this->_arrData['arrErrors']	= $arrErrors;
			$this->_arrData['strTitle']	= "Vitrine des stickers";
			$this->_arrData['strPage']	= "vitrine";
			$this->display("vitrine_stickers");			
		}
		
		
		/**
		* Page vitrine des stickers
		*/
		public function VitrineFilter(){

			$objManager = new ProductManager(); // Instancier la classe//
			$arrProduct = $objManager->findByFilter(); // Utiliser la classe //
			$arrErrors 	= array();

            if (count($arrProduct) == 0  ){
				$arrErrors['noProduct'] = "Aucun produit ne correspond à votre recherche";
			}

			$arrProductToDisplay = array();
			foreach ($arrProduct as $arrProducts){
				$objProduct = new Product;
				$objProduct->hydrate($arrProducts);	
				$arrProductToDisplay[] = $objProduct;
            }
            
            $arrSelCategory = $_POST['cat']??array();
			
            $objCatManager = new CategoryManager(); 
			$arrCats		= $objCatManager->findCategory(); 	

			$arrCatToDisplay    = array();
			$arrSelected		= array();
			foreach ($arrCats as $arrCat){
					$objCat = new Category;
					$objCat->hydrate($arrCat);
					
					if (in_array($objCat->getId(), $arrSelCategory)){
					//if ($arrSelCategory == $objCat->getId()){
						$arrSelected[] = $objCat->getId();
					}
					$arrCatToDisplay[] = $objCat;
			
			$this->_arrData['boolCat'] 	= $_POST['cat']??0;	
			
			// On envoie la liste des objets à la vue
            $this->_arrData['arrSelected']		= $arrSelected; 	
			$this->_arrData['arrCatToDisplay']	= $arrCatToDisplay;		
			$this->_arrData['arrProductToDisplay']= $arrProductToDisplay;
        }
            $this->_arrData['arrErrors']	= $arrErrors;
			$this->_arrData['strTitle']	= "Vitrine des stickers";
			$this->_arrData['strPage']	= "vitrinefilter";
			$this->display("vitrine_stickers");			
		}		
		
	
		/**
		* Page des stickers
		*/
		public function Stickers(){

            // Si le GET produit existe et qu'il n'est pas vide, met en SESSION le produit et le créateur
            if (isset($_GET['product']) != '') {
                $_SESSION['product'] = $_GET['product'];
                $_SESSION['creator'] = $_GET['account'];
            }

            // Initialisation du tableau des erreurs
            $arrError 	= array(); 

            // Tableau des erreurs lié à la fonction de rajout de photo
            if (isset($_GET['error']) && $_GET['error'] == '1'){
                $arrError[] = "Nombre maximum de photos atteint.";
            }  
            if (isset($_GET['error']) && $_GET['error'] == '2'){
                $arrError[] = "Merci de sélectionner une photo.";
            }  
            if (isset($_GET['error']) && $_GET['error'] == '3'){
                $arrError[] = "Erreur lors de l'enregistrement de la photo.";
            } 

            // Tableau des erreurs lié à la fonction pour supprimer un commentaire
            if (isset($_GET['error']) && $_GET['error'] == '4'){
                $arrError[] = 'Cocher la case "Supprimer le commentaire"';
            }  
            if (isset($_GET['error']) && $_GET['error'] == '5'){
                $arrError[] = "Erreur d'envoie de la demande";
            }  

            // Instancier les classes Manager
			$objManager          = new ProductManager(); 
            $objCommentManager   = new CommentManager();
            $objAccountManager   = new AccountManager();
            $objPhotoManager     = new PhotoManager();

            // Utiliser les classes
			$arrProduct      = $objManager->findOneProduct(); 
            $arrComment      = $objCommentManager->findComment($_SESSION['product']); 
            $arrPhoto        = $objPhotoManager->findPhoto($_SESSION['product']);
            
            // Récupération des infos produits
			$arrProductToDisplay = array();
			foreach ($arrProduct as $arrProducts){
				$objProduct = new Product;
				$objProduct->hydrate($arrProducts);	
				$arrProductToDisplay[] = $objProduct;
			}

            // Récupération des infos commentaires
			$arrCommentToDisplay = array();
			foreach ($arrComment as $arrComments){ 
                $strPseudo  = $objCommentManager->findPseudoComment($arrComments['com_account']);               
				$objComment = new Comment;
                $objComment->setPseudo($strPseudo['com_pseudo']);
				$objComment->hydrate($arrComments);          
				$arrCommentToDisplay[] = $objComment;
			}

            // Récupération des infos photos
            $arrPhotoToDisplay = array();
			foreach ($arrPhoto as $arrPhotos){              
				$objPhoto = new Photo;
				$objPhoto->hydrate($arrPhotos);             
				$arrPhotoToDisplay[] = $objPhoto;
			}

			// Affichage sur le template  
            $this->_arrData['objPhoto']	                = $objPhoto;	
            $this->_arrData['arrError']	                = $arrError;
			$this->_arrData['arrProductToDisplay']		= $arrProductToDisplay;
            $this->_arrData['arrCommentToDisplay']		= $arrCommentToDisplay;
            $this->_arrData['arrPhotoToDisplay']		= $arrPhotoToDisplay;
			$this->_arrData['strTitle']	= "Sélection des stickers";
			$this->_arrData['strPage']	= "stickers";
			$this->display("stickers");
		}

		
        /**
		* Page de création d'un commentaire
		*/
        public function Comment(){ 
            
            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=error&action=error_403");
			}

            // Variable pour redirection vers le stickers du produit actuel
            $intCreator = $_SESSION['creator'];
            $intProduct = $_SESSION['product'];

            // Initialisation des objets entities & manager
            $objComment         = new Comment;
            $objCommentManager 	= new CommentManager;

            // Initialisation du tableau des erreurs
            $arrError = array(); 
            
            // Vérification de l'envoie du formulaire
			if (count($_POST) > 0){

                // Fonction d'hydratation
                $objComment->hydrate($_POST);
                $objComment->setAccount($_SESSION['user']['id']);
                $objComment->setProduct($_GET["product"]);

				// Tests erreurs
				if ($objComment->getComment() == ''){
					$arrError['commentaire'] = "Merci de mettre un commentaire";
				}
				if ($objComment->getValue() == 0){
					$arrError['value'] = "Merci de mettre une note";
				}	
                
                // Insertion en BDD du commentaire si aucune erreur
				if (count($arrError) == 0){
                    $objCommentManager 	= new CommentManager;
                    if($objCommentManager->CreateComment($objComment)) {
                        header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator");
                    }else{
                        $arrError[]	= "Erreur lors de l'ajout";
                    }
                }					
			}

            // Affichage sur le template  
            $this->_arrData['product']      = $_GET["product"];
            $this->_arrData['objComment']   = $objComment;
            $this->_arrData['arrError']	    = $arrError;
            $this->_arrData['strTitle']	    = "Page commentaire";
			$this->_arrData['strPage']	    = "comment";
			$this->display("comment");
        }  


        /**
		* Page de modification d'un commentaire
		*/
        public function EditComment(){ 
            
            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=error&action=error_403");
			}

            // Variable pour redirection vers le stickers du produit actuel
            $intCreator = $_SESSION['creator'];
            $intProduct = $_SESSION['product'];

            // Initialisation des objets entities & manager
            $objComment         = new Comment;
            $objCommentManager 	= new CommentManager;

            // Initialisation du tableau des erreurs
            $arrError = array(); 
            
			// Vérification de l'envoie du formulaire
            if (count($_POST) > 0){

                // Fonction d'hydratation
                $objComment->hydrate($_POST);
                $objComment->setAccount($_SESSION['user']['id']);
                $objComment->setProduct($_GET["product"]);

				// Tests erreurs
				if ($objComment->getComment() == ''){
					$arrError['commentaire'] = "Merci de mettre un commentaire";
				}
				if ($objComment->getValue() == 0){
					$arrError['value'] = "Merci de mettre une note";
				}		

				// Insertion en BDD du commentaire si aucune erreur
				if (count($arrError) == 0){
                    $objCommentManager 	= new CommentManager;
                    if($objCommentManager->EditComment($objComment)) {
                        header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator");
                    }else{
                        $arrError[]	= "Erreur lors de la modification";
                    }
                }					
			} else {

                // Rechercher le commentaire pour afficha sur la page
                $intComment = $_GET["comment"];
                $arrComment = $objCommentManager->findOneComment($intComment);

                // Vérification que le commentaire existe, l'utilisateur est admin ou modérateur ou créateur du commentaire
                $_GET['account'] = intval($_GET['account']);
                if ($intComment === false 
                || 	($_GET['account']) != $_SESSION['user']['id']
                && 	$_SESSION['user']['cp_type'] != 1
                && 	$_SESSION['user']['cp_type'] != 2){
                    header("Location:index.php?ctrl=error&action=error_403");
                }else{

                    // hydratation de l'objet
                    $objComment->hydrate($arrComment);
                }
            }

            // Affichage sur le template  
            $this->_arrData['product']      = $_GET["product"];
            $this->_arrData['objComment']   = $objComment;
            $this->_arrData['arrError']	    = $arrError;
            $this->_arrData['strTitle']	    = "Page commentaire";
            $this->_arrData['strPage']	    = "editcomment";
            $this->display("comment");
        }


        /**
		* Méthode pour archiver les tickets
		*/
		public function DeleteComment(){
            
            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Variable pour redirection vers le stickers du produit actuel
            $intCreator = $_SESSION['creator'];
            $intProduct = $_SESSION['product'];

            // Initialisation des objets managers et appelle de leur requête
            $objCommentManager  = new CommentManager;
            $intComment         = intval($_GET["comment"]);
            $arrComment         = $objCommentManager->findOneComment($intComment);

             // Vérification que le commentaire existe, l'utilisateur est admin ou modérateur ou créateur du commentaire
            if ($arrComment === false 
            || 	($_GET['account']) != $_SESSION['user']['id']
            && 	$_SESSION['user']['cp_type'] != 1){
                header("Location:index.php?ctrl=error&action=error_403");
            }else{

                // Vérification que le bouton Checkbox est coché
                if (!isset($_POST['check'])){
                    header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator&error=4");
                }else{

                    // Supprime le commentaire et renvoi un Bool pour vérification que la requête soit effectué
                    $boolOk = $objCommentManager->DeleteOneComment($intComment);
                    if ($boolOk) {
                        header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator");
                    } else {
                        header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator&error=5");
                    }
                }
            }
        } 


        /**
		* Page de rajout de photo
		*/
        public function AddPhoto(){ 
            
            //Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=error&action=error_403");
			}

            // Variable pour redirection vers le stickers du produit actuel
            $intCreator = $_SESSION['creator'];
            $intProduct = $_SESSION['product'];

            //Création des objets utiles à la fonction
            $objPhoto           = new Photo;
            $objPhotoManager 	= new PhotoManager;

            // Vérification de l'envoie du formulaire
            if (count($_FILES) > 0){

                // Récupération des informations de la photo
                $arrPhotoInfos      = $_FILES['img']??array(); 

                // Requête de vérification qu'il n'y a pas plus de 20 photos sur le produit
                $boolPhoto  = $objPhotoManager->MaxPhoto($_GET['product']);
                if ($boolPhoto == false) {
                    header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator&error=1");
                }  else {     

                    // Tests des erreurs
                    if ($arrPhotoInfos['size'] == 0) {
                        header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator&error=2");
                    }  else {   

                        // Sauvegarde de l'image sur le serveur et renvoi un Bool de vérification de la requête
                        $strNewName = $this->_photoName($arrPhotoInfos['name']);
                        $boolOk 	= $this->_photoTraitement($arrPhotoInfos, $strNewName);
                        
                        // Si la sauvegarde de la photo est ok
                        if($boolOk){
                            $objPhoto->setName($strNewName);
                            $objPhoto->setProduct($_GET['product']);
                            $returnPhoto    = $objPhotoManager->CreatePhoto($objPhoto, 0);

                            // Vérification des insertions
                            if($returnPhoto !== false){
                                header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator");
                            }else{
                                header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator&error=3");
                            }
                        }
                    }
                }
            }
        }


        /**
		* Méthode pour supprimer des photos
		*/
		public function DeletePhoto(){
            
            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Variable pour redirection vers le stickers du produit actuel
            $intCreator = $_SESSION['creator'];
            $intProduct = $_SESSION['product'];

            // Initialisation des objets entities & manager
            $objPhotoManager     = new PhotoManager();
            $objPhoto            = new Photo();

            // Utilisation des objets
            $arrPhoto = $objPhotoManager->findDeletePhoto($_SESSION['product']);
            $arrPhotoToDisplay = array();
            foreach ($arrPhoto as $arrPhotos){              
                $objPhoto = new Photo;
                $objPhoto->hydrate($arrPhotos);             
                $arrPhotoToDisplay[] = $objPhoto;
            }

            // Initialisation du tableau des erreurs
            $arrError = array(); 

            // Vérification que les photos existes, l'utilisateur est admin ou modérateur ou créateur du commentaire
            if ($arrPhoto === false 
            || 	($_SESSION['creator']) != $_SESSION['user']['id']
            && 	$_SESSION['user']['cp_type'] != 1
            && 	$_SESSION['user']['cp_type'] != 2){
                header("Location:index.php?ctrl=error&action=error_403");
            } else {

                 // Vérification de l'envoie du formulaire
                if (count($_FILES) > 0){

                    // Vérification de l'envoie du formulaire et que le bouton est sélectionné
                    if (!isset($_POST['ph_id'])){
                        $arrError[] = 'Merci de sélectionner les photos à supprimer';
                    } else {

                        // Requête de suppression des photos avec vérification par boolean
                        $arrId = array();
                        $arrId = $_POST['ph_id'];
                        $boolOk = $objPhotoManager->DeletePhoto($arrId);
                        if ($boolOk) {
                            header("Location:index.php?ctrl=product&action=Stickers&product=$intProduct&account=$intCreator");
                        } else {
                            $arrError[] = "Erreur d'envoie de la demande";
                        }
                    }
                }
            }

            // Affichage sur le template  
            $this->_arrData['objPhoto']	                = $objPhoto;	
            $this->_arrData['arrError']	                = $arrError;
            $this->_arrData['arrPhotoToDisplay']		= $arrPhotoToDisplay;
            $this->_arrData['strTitle']	= "Supprimer les photos";
            $this->_arrData['strPage']	= "deletePhoto";
            $this->display("deletePhoto");
        } 


        /**
		* Page de création d'une catégorie
		*/
        public function CreateCategory(){ 
            
            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=error&action=error_403");
			}

            // Initialisation du tableau des erreurs
            $arrError 	= array(); 

            // Initialisation des objets entities & manager
            $objCategory            = new Category;
            $objCategoryManager 	= new CategoryManager;

            // Affichage des catégories à valider
            $arrCategory		= $objCategoryManager->ValidateCategory(); 
            $arrCategoryToDisplay = array();
			foreach ($arrCategory as $arrCategorys){              
				$objValCategory = new Category;
				$objValCategory->hydrate($arrCategorys);             
				$arrCategoryToDisplay[] = $objValCategory;
			}
            
			// Vérification de l'envoie du formulaire
            if (count($_POST) > 0){

                //Fonction d'hydratation
                $objCategory->hydrate($_POST);

				// Tests erreurs
				if ($objCategory->getName() == ''){
					$arrError['name'] = "Merci de mettre un nom de catégorie";
				}		

				// Insertion en BDD de la catégorie si aucune erreur
				if (count($arrError) == 0){
                    if($objCategoryManager->CreateCategory($objCategory)) {
                        header("Location:index.php?ctrl=product&action=Vitrine");
                    }else{
                        $arrError[]	= "Erreur lors de l'ajout";
                    }
                }					
			}

            // Affichage sur le template 
            if ($arrCategory === null) {
                $this->_arrData['objValCategory']    = $objValCategory;
            } 
            $this->_arrData['arrCategoryToDisplay']  = $arrCategoryToDisplay;             
            $this->_arrData['objCategory']	         = $objCategory;           
            $this->_arrData['arrError']	             = $arrError;
            $this->_arrData['strTitle']	             = "Page catégorie";
			$this->_arrData['strPage']	             = "CreateCategory";
			$this->display("category");
        }  


        /**
		* Page Modifier une catégorie
		*/
		public function EditCategory() {

            //Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])) {
                header("Location:index.php?ctrl=error&action=error_403");
			}

            // Initialisation des objets entities & manager
            $objCategory            = new Category;
            $objCategoryManager 	= new CategoryManager;

            // Initialisation du tableau des erreurs
            $arrError 	= array(); 
            
			// Vérification de l'envoie du formulaire
            if (count($_POST) > 0){

                // Fonction d'hydratation
                $objCategory->hydrate($_POST);

				// Tests erreurs
				if ($objCategory->getName() == ''){
					$arrError['name'] = "Merci de mettre un nom de catégorie";
				}		

				// Insertion en BDD de la catégorie si aucune erreur
				if (count($arrError) == 0){
                    if($objCategoryManager->EditCategory($objCategory)) {
                        header("Location:index.php?ctrl=product&action=Vitrine");
                    }else{
                        $arrError[]	= "Erreur lors de l'ajout";
                    }
                }					
			} else {

                //Rechercher la catégorie à valider
                $intCategory = $_GET["category"];
                $arrProduct = $objCategoryManager->findEditCategory($intCategory);

                // Vérification que les catégories à valider existes et que l'utilisateur est admin ou modérateur
                if ($intCategory === false 
				|| 	$_SESSION['user']['cp_type'] > 2){
					header("Location:index.php?ctrl=error&action=error_403");
				}else{

                    // hydratation de l'article
                    $objCategory->hydrate($arrProduct);
                }
            }

            // Affichage sur le template            
            $this->_arrData['objCategory']	             = $objCategory;
            $this->_arrData['arrError']	                 = $arrError;
            $this->_arrData['strTitle']	                 = "Modification de categorie";
            $this->_arrData['strPage']	                 = "EditCategory";
            $this->display("category");
        }


        /**
		* Méthode pour valider les catégories
		*/
		public function ValidateCategory(){
            
            // Vérification que l'utilisateur soit connecté
            if (!isset($_SESSION['user'])){
                header("Location:index.php?ctrl=error&action=error_403");
            }

            // Initialisation des objets entities & manager
            $objCategoryManager     = new CategoryManager();

            // Initialisation du tableau des erreurs
            $arrError = array(); 

            // Vérification que les photos existes, l'utilisateur est admin ou modérateur ou créateur du commentaire
            if ($_SESSION['user']['cp_type'] != 1
            && 	$_SESSION['user']['cp_type'] != 2){
                header("Location:index.php?ctrl=error&action=error_403");
            } else {

                // Vérification de l'envoie du formulaire
                if (count($_POST) > 0){

                    // Vérification de l'envoie du formulaire et que le bouton est sélectionné
                    if (!isset($_POST['cat_id'])){
                        $arrError[] = 'Merci de sélectionner les catégories à valider';
                    } else {

                        // Requête de suppression des photos avec vérification par boolean
                        $arrId = array();
                        $arrId = $_POST['cat_id'];
                        $boolOk = $objCategoryManager->EditValidateCategory($arrId);
                        if ($boolOk) {
                            header("Location:index.php?ctrl=product&action=Vitrine");
                        } else {
                            $arrError[] = "Erreur d'envoie de la demande";
                        }
                    }
                }
            }
        } 
    }