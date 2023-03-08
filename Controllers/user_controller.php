<?php
    /**
	* Controller des utilisateurs
	* @autor Renoult Marc
	*/
	class User_controller extends Base_controller{

        /**
		* Constructeur de la classe
		*/
        public function __construct()
        {
            require 'Entities/compte_entity.php'; 
            require 'Models/compte_manager.php';
        }
		
		/**
		* Méthode de connexion
		*/
		public function login(){
            if(count($_POST) > 0)
            {
			    $strPseudo 	= $_POST['identifiant'];
			    $strPwd 	= $_POST['mdp'];
                    $objUserManager = new AccountManager();
                    $arrUser = $objUserManager->verifUser($strPseudo,$strPwd);

                    // Vérifier l'utilisateur / mdp en base de données (Attention aux infos vides)
                    if($arrUser === false)
                    {
                        $this->_arrData['strError'] = "Erreur de connexion";
                    }else
                    {
                        // Stocker les informations utiles de l'utilisateur en session
                        // Exemple : $_SESSION['id'] = 15; ou $_SESSION['user']['id'] = 15;
                        $_SESSION['user']= $arrUser;
                        //$_SESSION['token_csrf']= bin2hex(random_bytes(64));
                        header("Location:index.php");
                };
			    
            }
            
			//Affichage
			$this->_arrData['strTitle']	= "Se connecter";
			$this->_arrData['strPage']	= "login";
			$this->display("login");
		}

		/**
		* Méthode de création d'un compte
		*/

		public function create_account()
        {
            $objAccountManager = new AccountManager();
            $objAccountPseudo  = $objAccountManager->findPseudo();
            $objUser = new Account();

        /*Traitement des erreurs*/
            $arrErrors 	= array();
            if (count($_POST) > 0){
                
                // Mise en objet des information par hydratation
				$_POST['id'] = intval($_POST['id']);

                $objUser->hydrate($_POST);
               
                
                // Tests erreurs
                if ($objUser->getPseudo() == ''){
                    $arrErrors['pseudo'] = "Merci de renseigner un identifiant";
                }else{
                    foreach($objAccountPseudo AS $pseudoList){
                        foreach($pseudoList AS $pseudoExist){
                            if($objUser->getPseudo() == $pseudoExist){
                            $arrErrors['exist'] = "L'identifiant est déjà pris";
                        }
                        }
                        
                    }        
                }
                if ($objUser->getPassword() == '') {
                    $arrErrors['password']  = "Merci de renseigner un mot de passe";
                }
                
                if(!password_verify($_POST['confirmPassword'], $objUser->getPassword()))
                {
                    $arrErrors['confirmPassword'] = "Les mots de passe ne sont pas identiques";
                }
                if ($objUser->getFirstName() == ''){
                    $arrErrors['firstName'] = "Merci de renseigner votre prénom";
                }
                if ($objUser->getName() == ''){
                    $arrErrors['name']      = "Merci de renseigner votre nom";
                }
                if ($objUser->getPhone() == ''){
                    $arrErrors['phone']     = "Merci de renseigner votre numéro de téléphone";
                }
                if ($objUser->getMail() == ''){
                    $arrErrors['mail']    = "Merci de renseigner votre adresse mail";
                }
            
        
            //affichage des erreurs
            if (count($arrErrors) == 0){ // Affichage des erreurs, s'il y en a
                $objAccountManager = new AccountManager();
                if($objAccountManager->SigninQuery($objUser))
                {
                    header("Location:index.php");
                }else
                {
                    $arrError[] = "Erreur lors de l'ajout";
                }
            }
        }
			//Affichage
            $this->_arrData['objUser']          = $objUser;
            $this->_arrData['arrErrors']         = $arrErrors;
			$this->_arrData['strTitle']	        = "S'inscrire";
			$this->_arrData['strPage']	        = "create_account";
			$this->display("inscription");
            
    }

        /**
		* Méthode de modification d'un compte
		*/

		public function update_account()
        {
            if (!isset($_SESSION['user'])||(isset ($_GET['id']) && $_SESSION['user']['cp_type'] != 1)){
				header("Location:index.php?ctrl=error&action=error_403");
			}

            $objAccountManager = new AccountManager();       
            $objUser           = new Account();
            
        /*Traitement des erreurs*/
            $arrErrors 	= array();
            if (count($_POST) > 0){
                // Mise en objet des information par hydratation
                
                $objAccountPseudo  = $objAccountManager->findPseudo();
                $objUser->hydrate($_POST);
                // Tests erreurs

                if ($objUser->getPseudo() == '')
                {
                    $arrErrors['pseudo'] = "Merci de renseigner un identifiant";
                }elseif(isset ($_GET['id']) && $objUser->getPseudo() == $_POST['pseudo'])
                    {
                        foreach($objAccountPseudo AS $pseudoList)
                        {
                            foreach($pseudoList AS $pseudoExist)
                            {
                                if($objUser->getPseudo() == $pseudoExist)
                                {
                                    $arrErrors['exist'] = "L'identifiant est déjà pris";
                                }
                            }
                            
                        }        
                    }
                if ($objUser->getPassword() == ''){
                    $arrErrors['password']  = "Merci de renseigner un mot de passe";
                }
                if(!password_verify($_POST['confirmPassword'], $objUser->getPassword()))
                {
                    $arrErrors['confirmPassword'] = "Les mots de passe ne sont pas identiques";
                }
                if ($objUser->getFirstName() == ''){
                    $arrErrors['firstName'] = "Merci de renseigner votre prénom";
                }
                if ($objUser->getName() == ''){
                    $arrErrors['name']      = "Merci de renseigner votre nom";
                }
                if ($objUser->getPhone() == ''){
                    $arrErrors['phone']     = "Merci de renseigner votre numéro de téléphone";
                }
                if ($objUser->getMail() == ''){
                    $arrErrors['mail']    = "Merci de renseigner votre adresse mail";
                }
            
        
            //affichage des erreurs
            if (count($arrErrors) == 0){ // Affichage des erreurs, s'il y en a
                if($objAccountManager->UpdateQuery($objUser))
                {   //mettre à jour la session si compte de l'utilisateur connecté
                    if($_SESSION['user']['id']== $objUser->getId())
                    {
                        $_SESSION['user']['pseudo'] = $objUser->getFirstName();
                    }
                    header("Location:index.php");
                }else
                {
                    $arrError[] = "Erreur lors de la modification du compte";
                }
            }
        }else
        {
            $arrAccountInfo    = $objAccountManager->findAccountToModify();          
            $objUser->hydrate($arrAccountInfo);
            
        }
            
			//Affichage
            $this->_arrData['objUser']          = $objUser;
            $this->_arrData['arrErrors']        = $arrErrors;
			$this->_arrData['strTitle']	        = "Modifier mon compte";
			$this->_arrData['strPage']	        = "update_account";
			$this->display("inscription");
		}

        /**
         * Méthode de suppression d'un compte
         */

         public function deleteAccount()
         {
            if (!isset($_SESSION['user'])||(isset ($_GET['id']) && $_SESSION['user']['cp_type'] != 1)){
				header("Location:index.php?ctrl=error&action=error_403");
			}
            
                $objAccountManager = new AccountManager();
                $objAccountInfo  = $objAccountManager->findAccountToModify();
                $objUser = new Account();
                $objUser->hydrate($objAccountInfo);
            
                //supprimer le compte dans la base de données
                $objAccountManager->deleteAccount($objUser); 

                //affichage de la page
                $this->_arrData['objUser']           = $objUser;
                $this->_arrData['strTitle']	         = "Compte supprimer";
                $this->_arrData['strPage']	         = "deleteAccount";
                $this->logout();
                $this->display("index");
        }

		/**
		* Page Se déconnecter
		*/
		public function logout(){
			session_destroy();
            header("Location:index.php");
		}


        /**
         * Partie Admin
         */

        /**
         * Page de modification des comptes existants
         */

         public function AdminUpdateAccount()
         {
            if (!isset($_SESSION['user'])){
				header("Location:index.php?ctrl=error&action=error_403");
			}
            $objAccountManager = new AccountManager();
            $objAccountInfo  = $objAccountManager->findAccountToModify();
            $objUser = new Account();
            $objUser->hydrate($objAccountInfo);
            
            if($objUser->getType()!=1)
            {
                header("Location:index.php?ctrl=error&action=error_403");
            }else
            {
                //rechercher tous les comptes dans la base de données
                $objAccountManager = new AccountManager();
                $arrAccountList = $objAccountManager->findAccount();
                //mise en objet des éléments sous forme de tableau
                $arrUsersToDisplay = array();
                foreach($arrAccountList as $arrAccount)
                {
                    $objUsers = new Account();
                    $objUsers->hydrate($arrAccount);
                    $arrUsersToDisplay[] = $objUsers;
                    
                }

                //afficher la liste
                $this->_arrData['objUser']           = $objUser;
                $this->_arrData['arrUsersToDisplay'] = $arrUsersToDisplay;
                $this->_arrData['strTitle']	         = "Liste des comptes";
                $this->_arrData['strPage']	         = "AdminUpdateAccount";
                $this->display("AdminCompteModif");
            }
        }

        /**
         * Supprimer les comptes existants
         */

         public function AdminDeleteAccount()
         {
            if (!isset($_SESSION['user'])){
				header("Location:index.php?ctrl=error&action=error_403");
			}
            
            $objAccountManager = new AccountManager();
            $objAccountInfo  = $objAccountManager->findAccountToModify();
            $objUser = new Account();
            $objUser->hydrate($objAccountInfo);
            
            if($_SESSION['user']['cp_type']!=1)
            {
                header("Location:index.php?ctrl=error&action=error_403");
            }else
            {   
                //rechercher tous les comptes dans la base de données
                $objAccountManager = new AccountManager();
                $objAccountManager->deleteAccount($objUser);
                $arrAccountList = $objAccountManager->findAccount();
                //mise en objet des éléments sous forme de tableau
                $arrUsersToDisplay = array();
                foreach($arrAccountList as $arrAccount)
                {
                    $objUsers = new Account();
                    $objUsers->hydrate($arrAccount);
                    $arrUsersToDisplay[] = $objUsers;
                    
                }
                
                
                //afficher la liste
                $this->_arrData['objUser']           = $objUser;
                $this->_arrData['arrUsersToDisplay'] = $arrUsersToDisplay;
                $this->_arrData['strTitle']	         = "Liste des comptes";
                $this->_arrData['strPage']	         = "AdminUpdateAccount";
                $this->display("AdminCompteModif");
            }
        }

        /**
         * Désactiver les comptes existants
         */

        public function desactivate_account()
        {
            if (!isset($_SESSION['user'])){
				header("Location:index.php?ctrl=error&action=error_403");
			}
            
            $objAccountManager = new AccountManager();
            $objAccountInfo  = $objAccountManager->findAccountToModify();
            $objUser = new Account();
            $objUser->hydrate($objAccountInfo);
            
            if($_SESSION['user']['cp_type']!=1)
            {
                header("Location:index.php?ctrl=error&action=error_403");
            }else
            {   
                //rechercher tous les comptes dans la base de données
                $objAccountManager = new AccountManager();
                $objAccountManager->desactivate_account($objUser);
                $arrAccountList = $objAccountManager->findAccount();
                //mise en objet des éléments sous forme de tableau
                $arrUsersToDisplay = array();
                foreach($arrAccountList as $arrAccount)
                {
                    $objUsers = new Account();
                    $objUsers->hydrate($arrAccount);
                    $arrUsersToDisplay[] = $objUsers;
                    
                }
                
                
                //afficher la liste
                $this->_arrData['objUser']           = $objUser;
                $this->_arrData['arrUsersToDisplay'] = $arrUsersToDisplay;
                $this->_arrData['strTitle']	         = "Liste des comptes";
                $this->_arrData['strPage']	         = "AdminUpdateAccount";
                $this->display("AdminCompteModif");
            }
        }

        /**
         * Activer les comptes existants
         */

         public function activate_account()
         {
             if (!isset($_SESSION['user'])){
                 header("Location:index.php?ctrl=error&action=error_403");
             }
             
             $objAccountManager = new AccountManager();
             $objAccountInfo  = $objAccountManager->findAccountToModify();
             $objUser = new Account();
             $objUser->hydrate($objAccountInfo);
             
             if($_SESSION['user']['cp_type']!=1)
             {
                 header("Location:index.php?ctrl=error&action=error_403");
             }else
             {   
                 //rechercher tous les comptes dans la base de données
                 $objAccountManager = new AccountManager();
                 $objAccountManager->activate_account($objUser);
                 $arrAccountList = $objAccountManager->findAccount();
                 //mise en objet des éléments sous forme de tableau
                 $arrUsersToDisplay = array();
                 foreach($arrAccountList as $arrAccount)
                 {
                     $objUsers = new Account();
                     $objUsers->hydrate($arrAccount);
                     $arrUsersToDisplay[] = $objUsers;
                     
                 }
                 
                 
                 //afficher la liste
                 $this->_arrData['objUser']           = $objUser;
                 $this->_arrData['arrUsersToDisplay'] = $arrUsersToDisplay;
                 $this->_arrData['strTitle']	         = "Liste des comptes";
                 $this->_arrData['strPage']	         = "AdminUpdateAccount";
                 $this->display("AdminCompteModif");
             }
         }
	}