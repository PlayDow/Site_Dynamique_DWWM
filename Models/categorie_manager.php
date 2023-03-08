<?php

	/**
	* Class manager des catégories de produit
	* @author Dorian Cotteret
	*/
	class CategoryManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des catégories
		* @return array Liste des catégories à afficher
		*/
		public function findCategory(){
			$strRqCategory = "SELECT * 
								FROM categorie
								WHERE cat_validate = 0;";
							
			return $this->_db->query($strRqCategory)->fetchAll();
		}


		/**
		* Methode de récupération des catégories
		* @return array Liste des catégories à valider
		*/
		public function ValidateCategory(){
			$strRqCategory = "SELECT * 
								FROM categorie
								WHERE cat_validate = 1;";
							
			return $this->_db->query($strRqCategory)->fetchAll();
		}


		/**
		* Méthode de validation des catégories
		* @param array $arrId Identifiant des catégories à valider
		* @return bool La validation s'est bien passée ou pas
		*/
		public function EditValidateCategory($arrId):bool{
			$str = implode(",",$arrId);
			$strUpdateQuery 		= "UPDATE categorie
		 		SET cat_validate 		= 0
		 		WHERE cat_id IN (".$str.")";

			return $this->_db->exec($strUpdateQuery);		
		}


		/**
		* Methode de récupération de la catégorie à modifier
		* @return int catégorie à modifier
		*/
		public function findEditCategory($intCategory){
			$strRqCategory = "SELECT * 
								FROM categorie
								WHERE cat_id = ".$intCategory;
							
			return $this->_db->query($strRqCategory)->fetch();
		}
		

		/**
		* Requête de création de produit
		*/
		public function CreateCategory ($objCategory) {
			$strRqAdd = "INSERT INTO categorie (cat_name, cat_validate)
							VALUES (:name, 1)";

			$prep		= $this->_db->prepare($strRqAdd);
			
			$prep->bindValue(':name', $objCategory->getName(), PDO::PARAM_STR);
			
			return $prep->execute();
		} 


		/**
		* Requête de modification d'une catégorie'
		*/
		public function EditCategory ($objCategory) {
			$intId					= $_GET['category'];
			$strUpdateQuery 		= "UPDATE categorie
		 		SET cat_name 	 		= :name,
					cat_validate 		= 0
		 		WHERE cat_id 	 		= ".$intId;
			
		 	$prep = $this->_db->prepare($strUpdateQuery);
			
		 	$strName 			= $objCategory->getName();
			
			$prep->bindValue(':name', $strName , PDO::PARAM_STR);

			return $prep->execute();			
		}
		
	}
?>