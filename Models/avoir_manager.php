<?php

	/**
	* Class manager de la relation entre un produit qui a une catégorie
	* @author Dorian Cotteret
	*/
	class HaveManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération de la catégorie d'un produit
		* @return int de la catégorie
		*/
		public function findHave(int $intProduct){
			$strRqHave = "SELECT av_category 
							FROM avoir
							WHERE av_product = ".$intProduct;			
			return $this->_db->query($strRqHave)->fetch();

		}

		/**
		* Requête de rajout d'une catégorie sur le produit
		*/
		public function CreateHave ($objHave) {
			
			$strRqAddHave = "INSERT INTO avoir (av_product, av_category)
								VALUES (:product, :category)";

				$prep		= $this->_db->prepare($strRqAddHave);

				$prep->bindValue(':product', $objHave->getProduct(), PDO::PARAM_INT);
				$prep->bindValue(':category', $objHave->getCategory(), PDO::PARAM_INT);

				return $prep->execute();
		} 
		
		
		/**
		* Requête de modification de l'appartenance d'un produit à une catégorie
		*/
		public function EditHave ($objHave) {
			$strUpdateQuery 		= "UPDATE avoir
										SET av_category  = :category
										WHERE av_product = ".$objHave->getProduct();
			
		 	$prep = $this->_db->prepare($strUpdateQuery);
			
		 	$intCategory 			= $objHave->getCategory();
			
			$prep->bindValue(':category', $intCategory , PDO::PARAM_INT);

			return $prep->execute();			
		} 


		/**
		* Méthode de suppression de l'association catégorie et produit
		* @param int $intId Identifiant de l'association à supprimer
		* @return bool La suppression s'est bien passée ou pas
		*/
		public function DeleteHave(int $intId):bool{
			
			$strRq	= "DELETE FROM avoir
						WHERE av_product = ".$intId;
			return $this->_db->exec($strRq);
		}
	}
?>