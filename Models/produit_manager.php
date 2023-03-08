<?php

	/**
	* Class manager des produits
	* @author Dorian Cotteret
    *<ul>
    *   <li>FindProduct</li>
    *   <li>CreateProduct</li>
    *   <li></li>
    *   <li></li>
    *</ul>
	* @author Quentin Serpette
	*<ul>
	*	<li>FindOneProduct</li>
	*	<li>FindByFilter</li>
	*</ul>
	*/
	class ProductManager extends Manager{

		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des produits par la barre de recherche
		* @return array Liste des produits
		*/
		public function findProduct(){
			//Récup des informations dans la barre de recherche
			$strSearch  = $_POST['recherche']??'';
			
			$strRqProduct = "SELECT p_id, p_name, p_price, p_description, p_account, ph_name AS p_photo
							FROM produit
							INNER JOIN photo ON ph_product = p_id
							WHERE ph_default = 1";
			
			//Traitement des mots clés
			if ($strSearch != '') 
			{
				$strRqProduct .=" AND (lower(p_name) LIKE BINARY '%".strtolower($strSearch)."%' OR lower(p_description) LIKE BINARY '%".strtolower($strSearch)."%' OR lower(p_account) LIKE BINARY '%".strtolower($strSearch)."%')";
			}
			
			return $this->_db->query($strRqProduct)->fetchAll();
			
		}
		

		
		/**
		* Requête de création de produit
		*/
		public function CreateProduct ($objProduct) {
			$strRqAdd = "INSERT INTO produit (p_name, p_price, p_description, p_account)
							VALUES (:name, :price, :description, :account)";

			$prep		= $this->_db->prepare($strRqAdd);
			
			$prep->bindValue(':name', $objProduct->getName(), PDO::PARAM_STR);
			$prep->bindValue(':price', $objProduct->getPrice(), PDO::PARAM_INT);
			$prep->bindValue(':description', $objProduct->getDescription(), PDO::PARAM_STR);
			$prep->bindValue(':account', $objProduct->getAccount(), PDO::PARAM_INT);
			
			$prep->execute();
			
			return $this->_db->lastInsertId();
		} 


		/**
		* Requête de modification de produit
		*/
		public function EditProduct ($objProduct) {
			$objId					= $_GET['product'];
			$strUpdateQuery 		= "UPDATE produit
		 		SET p_name 	 		= :name,
		 			p_price 		= :price,
		 			p_description 	= :description,
		 			p_account 		= :account
		 		WHERE p_id 	 		= ".$objId;
			
		 	$prep = $this->_db->prepare($strUpdateQuery);
			
		 	$strName 			= $objProduct->getName();
		 	$floatPrice			= $objProduct->getPrice();
		 	$strdescription		= $objProduct->getDescription();
			$intAccount 		= $objProduct->getAccount();
			
			$prep->bindValue(':name', $strName , PDO::PARAM_STR);
			$prep->bindValue(':price', $floatPrice, PDO::PARAM_INT);
			$prep->bindValue(':description', $strdescription, PDO::PARAM_STR);
			$prep->bindValue(':account', $intAccount , PDO::PARAM_INT);

			return $prep->execute();			
		}


		/**
		* Methode de récupération d'un produit
		* @return array Liste d'un produit
		*/
		public function findOneProduct(){
			//Récup des informations dans la barre de recherche
			
			$strRqProduct = "SELECT p_id, p_name, p_price, p_description, p_account, ph_name AS p_photo
							FROM produit
							INNER JOIN photo ON ph_product = p_id
							WHERE ph_default = 1 AND p_id = ".$_SESSION['product'];
			
				
			return $this->_db->query($strRqProduct)->fetchAll();			
		}


		/**
		* Methode de récupération des produits
		* @return array Liste des produits
		*/
		public function findEditProduct($intProduct){
			//Récup des informations dans la barre de recherche
			
			$strRqProduct = "SELECT p_id, p_name, p_price, p_description, p_account, ph_name AS p_photo
							FROM produit
								INNER JOIN photo ON ph_product = p_id
							WHERE p_id = ".$intProduct;
			
				
			return $this->_db->query($strRqProduct)->fetch();			
		}


		/**
		* Méthode de suppression d'un produit
		* @param int $intId Identifiant du produit à supprimer
		* @return bool La suppression s'est bien passée ou pas
		*/
		public function DeleteProduct(int $intId):bool{
			
			$strRq	= "DELETE FROM produit 
						WHERE p_id = ".$intId;
			return $this->_db->exec($strRq);
		}

		/**
		* Méthode de récupération des produits par filtre de catégorie
		* @return array Liste de produits
		*/
		public function findByFilter(){
			//Récup des informations par les filtres

			$strCat = $_POST['cat']??'';

			$strRqProduct = "SELECT p_id, p_name, p_price, p_description, p_account, ph_name AS p_photo, av_category, cat_name
							 FROM produit
							 INNER JOIN avoir ON p_id = av_product
							 INNER JOIN categorie ON cat_id = av_category
							 INNER JOIN photo ON ph_product = p_id";
							 
			if ($strCat != '') {
				$strCat 	= implode(", ", $strCat);
				
				$strWhere = " WHERE ";
				if ($strCat !='') {
					$strRqProduct .= $strWhere." cat_id IN (".$strCat.")";
				}
			}							 
			return $this->_db->query($strRqProduct)->fetchAll();
		}
	}
	
?>