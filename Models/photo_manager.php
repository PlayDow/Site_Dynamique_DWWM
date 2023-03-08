<?php

	/**
	* Class manager des photos
	* @author Dorian Cotteret
	*/
	class PhotoManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des photos
		* @return array Liste des photos
		*/
		public function findPhoto(int $ProductId){
			$strRqPhoto = "SELECT ph_id, ph_name, ph_product 
							FROM photo
							WHERE ph_product = ".$ProductId;
							
			return $this->_db->query($strRqPhoto)->fetchAll();
		}


		/**
		* Methode de récupération des photos
		* @return array Liste des photos
		*/
		public function findDeletePhoto(int $ProductId){
			$strRqPhoto = "SELECT ph_id, ph_name, ph_product 
							FROM photo
							WHERE ph_default = 0 AND ph_product = ".$ProductId;
							
			return $this->_db->query($strRqPhoto)->fetchAll();
		}


		/**
		* Methode de récupération du nombre de photo par produit
		* @return bool Liste des photos
		*/
		public function MaxPhoto(int $ProductId):bool {
			$strRqPhoto = "SELECT count(ph_id) AS nb
							FROM photo
							WHERE ph_product = ".$ProductId;
							
			$arrNbPhoto = $this->_db->query($strRqPhoto)->fetch();
			if ($arrNbPhoto['nb'] < 20) {
				return true;
			} else {
				return false;
			}
		}


		/**
		* Requête de rajout d'une photo dans la BDD
		*/
		public function CreatePhoto ($objPhoto, $PhotoDefault) {
			$strRqAddPhoto = "INSERT INTO photo (ph_name, ph_product, ph_default)
								VALUES (:name, :product, $PhotoDefault)";

				$prep		= $this->_db->prepare($strRqAddPhoto);

				$prep->bindValue(':name', $objPhoto->getName(), PDO::PARAM_STR);
				$prep->bindValue(':product', $objPhoto->getProduct(), PDO::PARAM_INT);

				return $prep->execute();
		} 


		/**
		* Requête de modification de la photo du produit
		*/
		public function EditPhoto ($objPhoto) {
			$strUpdateQuery 		= "UPDATE photo
										SET ph_name 	 = :name
										WHERE ph_product = ".$objPhoto->getProduct();
			
		 	$prep = $this->_db->prepare($strUpdateQuery);
			
		 	$strName 			= $objPhoto->getName();
			
			$prep->bindValue(':name', $strName , PDO::PARAM_STR);

			return $prep->execute();			
		} 


		/**
		* Méthode de suppression des photos liés à un produit
		* @param array $arrId Identifiant du produit à supprimer
		* @return bool La suppression s'est bien passée ou pas
		*/
		public function DeleteProductPhoto($intId):bool{
			$strRq	= "DELETE FROM photo
						WHERE ph_product = ".$intId;
			return $this->_db->exec($strRq);
		}
				

		/**
		* Méthode de suppression des photos
		* @param array $arrId Identifiant des photos
		* @return bool La suppression s'est bien passée ou pas
		*/
		public function DeletePhoto($arrId):bool{
			$str = implode(",",$arrId);
			$strRq	= "DELETE FROM photo
						WHERE ph_id IN (".$str.")";
			return $this->_db->exec($strRq);
		}
	}
?>