<?php

	/**
	* Class manager des comptes utilisateurs
	* @creator Dorian Cotteret
	*/
	class AccountManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des comptes
		* @return array Liste des comptes
		*/
		public function findAccount(){
			$strRqAccount = "SELECT cp_id, cp_pseudo, cp_password, cp_name, cp_firstName, cp_phone, cp_mail, cp_adress, cp_ip, cp_city, cp_type, cp_activate FROM compte;";
							
			return $this->_db->query($strRqAccount)->fetchAll();
		}
		
		
		/**
		* Methode de récupération du pseudo pour commentaire stickers
		*/
		public function findPseudoComment($intProduct){
			$strPseudoQuery="SELECT cp_pseudo								
                             FROM compte
							 	INNER JOIN produit ON produit.p_account = compte.cp_id
							 WHERE produit.p_id = ".$intProduct;
            return $this->_db->query($strPseudoQuery)->fetch();
		}


		/**
		* Methode de récupération des pseudos
		* @return array Liste des pseudos
		*/
		public function findPseudo(){
			$strPseudoQuery="SELECT cp_pseudo
                             FROM compte";
            return $this->_db->query($strPseudoQuery)->fetchAll();
		}
		
		/**
		* Methode de connection
		* @return array information utilisateur
		*/
		public function verifUser($strPseudo, $strPwd)
		{
			$strLoginQuery = "SELECT cp_id AS 'id',
								cp_pseudo AS 'pseudo',
								cp_password,
								cp_type
			FROM compte 
			WHERE cp_pseudo = '".$strPseudo."'";

			$arrUser 	= $this->_db->query($strLoginQuery)->fetch();

			if ($arrUser !== false)
			{	if(password_verify($strPwd,$arrUser['cp_password']))
				{
					unset ($arrUser['cp_password']);
					return $arrUser;
				}
							
			}
			
			return false;			
		}
			
		/**
		* Methode de récupération des informations du compte
		* @return array Liste des informations du compte
		*/
		public function findAccountToModify(){
			if (count($_SESSION)>0)
			{	$sessionID = $_GET['id']??$_SESSION['user']['id'];
				$strAccountModifyQuery = "SELECT cp_id, cp_pseudo, cp_password, cp_name, cp_firstName, cp_phone, cp_mail, cp_adress, cp_ip, cp_city, cp_type
                             		 	FROM compte
									 	INNER JOIN type ON ty_id = cp_type
									 WHERE cp_id = $sessionID";
            	$arrUser 	= $this->_db->query($strAccountModifyQuery)->fetch();
					unset ($arrUser['cp_password']);
					return $arrUser;				
			}else
			{
				echo "Vous n'êtes pas connecté";
			}
		}

		/**
		* Requête de modification de compte
		*/

		public function UpdateQuery($objUser)
		{
			//$sessionID = $_SESSION['user']['id'];
			
			$strUpdateQuery = "UPDATE compte
				SET cp_pseudo 	 = :pseudo,";
				if ($objUser->getPassword() != '')
				{
					$strUpdateQuery	.=	" cp_password = :password,";
				}
				$strUpdateQuery	.=" 
					cp_name 	 = :name,
					cp_firstName = :firstname,
					cp_phone	 = :phone,
					cp_mail		 = :mail,
					cp_numero 	 = :numero,
					cp_adress 	 = :adress,
					cp_type		 = :type
				WHERE cp_id 	 = ".$objUser->getId();
			
			$prep = $this->_db->prepare($strUpdateQuery);
			
			$strPseudo 		= $objUser->getPseudo();
			if ($objUser->getPassword() != '')
			{
				$strPwd 		= $objUser->getPassword();
			}
			$strName 		= $objUser->getName();
			$strFirstname 	= $objUser->getFirstName();
			$strPhone 		= $objUser->getPhone();
			$strMail 		= $objUser->getMail();
			$strNumAdress 	= $objUser->getNumero();
			$strStreet 		= $objUser->getAdress();
			$intType 		= $objUser->getType();

			
			$prep->bindValue(':pseudo', $strPseudo, PDO::PARAM_STR);
			if ($objUser->getPassword() != '')
			{
				$prep->bindValue(':password', $strPwd, PDO::PARAM_STR);
			}
			$prep->bindValue(':name', $strName, PDO::PARAM_STR);
			$prep->bindValue(':firstname', $strFirstname, PDO::PARAM_STR);
			$prep->bindValue(':phone', $strPhone, PDO::PARAM_STR);
			$prep->bindValue(':mail', $strMail, PDO::PARAM_STR);
			$prep->bindValue(':numero', $strNumAdress, PDO::PARAM_STR);
			$prep->bindValue(':adress', $strStreet, PDO::PARAM_STR);
			$prep->bindValue(':type', $intType, PDO::PARAM_STR);

			return $prep->execute();
			
		}



		/**
		* Requête de création de compte
		*/
		public function SigninQuery($objUser)
		{
			$strSigninQuery = 
						"INSERT INTO compte (
							cp_pseudo,
							cp_password,
							cp_name,
							cp_firstName,
							cp_phone,
							cp_mail,
							cp_numero,
							cp_adress)							
						VALUES (:pseudo,
								:password,
								:name,
								:firstname,
								:phone,
								:mail,
								:numero,
								:adress)";

					$prep = $this->_db->prepare($strSigninQuery);
					

					$strPseudo 		= $objUser->getPseudo();
					$strPwd 		= $objUser->getPassword();
					$strName 		= $objUser->getName();
					$strFirstname 	= $objUser->getFirstName();
					$strPhone 		= $objUser->getPhone();
					$strMail 		= $objUser->getMail();
					$strNumAdress 	= $objUser->getNumero();
					$strStreet 		= $objUser->getAdress();

					
					$prep->bindValue(':pseudo', $strPseudo, PDO::PARAM_STR);
					$prep->bindValue(':password', $strPwd, PDO::PARAM_STR);
					$prep->bindValue(':name', $strName, PDO::PARAM_STR);
					$prep->bindValue(':firstname', $strFirstname, PDO::PARAM_STR);
					$prep->bindValue(':phone', $strPhone, PDO::PARAM_STR);
					$prep->bindValue(':mail', $strMail, PDO::PARAM_STR);
					$prep->bindValue(':numero', $strNumAdress, PDO::PARAM_STR);
					$prep->bindValue(':adress', $strStreet, PDO::PARAM_STR);

					return $prep->execute();
			
		} 
		

		/**
		 * Méthode de suppression des comptes
		 */

		public function deleteAccount()
		{
			$intId = $_GET['id']??$_SESSION['user']['id'];
			$strDelAccountQuery = "DELETE FROM compte WHERE cp_id = $intId";
			return $this->_db->exec($strDelAccountQuery);
		}

		/**
		 * Méthode de désactivation des comptes
		 */
		public function desactivate_account($objUser)
		{
			$intId = $_GET['id']??$_SESSION['user']['id'];
			$strDeactAccountQuery = "UPDATE compte
									SET cp_activate = false
									WHERE cp_id = $intId";
			
			return $this->_db->exec($strDeactAccountQuery);
			

		}

		/**                     
		 * Méthode d'activation des comptes
		 */
		public function activate_account($objUser)
		{
			$intId = $_GET['id']??$_SESSION['user']['id'];
			$strDeactAccountQuery = "UPDATE compte
									SET cp_activate = true
									WHERE cp_id = $intId";
			
			return $this->_db->exec($strDeactAccountQuery);
			

		}
		
	}
?>


			

