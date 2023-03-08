<?php

	/**
	* Class manager de la commande figurine
	* @author Dorian COTTERET
	*/
	class FigurineManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}


		/**
		* Requête de rajout d'un ticket de création de figurine
		*/
		public function addFigurine ($objFigurine) {
			
			$strRqAddFigurine = "INSERT INTO figurine (f_name, f_firstName, f_phone, f_mail, f_numAddress, f_street, f_postCode, f_town, f_files, f_number, f_message, f_archive)
								VALUES (:name, :firstName, :phone, :mail, :numAddress, :street, :postCode, :town, :files, :number, :message, 0);";
								
			$prep		= $this->_db->prepare($strRqAddFigurine);

			$prep->bindValue(':name', $objFigurine->getName(), PDO::PARAM_STR);
			$prep->bindValue(':firstName', $objFigurine->getFirstName(), PDO::PARAM_STR);
			$prep->bindValue(':phone', $objFigurine->getPhone(), PDO::PARAM_STR);
			$prep->bindValue(':mail', $objFigurine->getMail(), PDO::PARAM_STR);
			$prep->bindValue(':numAddress', $objFigurine->getNumAddress(), PDO::PARAM_STR);
			$prep->bindValue(':street', $objFigurine->getStreet(), PDO::PARAM_STR);
			$prep->bindValue(':postCode', $objFigurine->getPostCode(), PDO::PARAM_STR);
			$prep->bindValue(':town', $objFigurine->getTown(), PDO::PARAM_STR);
			$prep->bindValue(':files', $objFigurine->getFiles(), PDO::PARAM_STR);
			$prep->bindValue(':number', $objFigurine->getNumber(), PDO::PARAM_STR);
			$prep->bindValue(':message', $objFigurine->getMessage(), PDO::PARAM_STR);
			
			return $prep->execute();

		} 


		/**
		* Requête de visualisation des tickets
		* @return array Affichage des tickets non archivés
		*/
		public function findTicket(){
			$strRqFigurine = "SELECT *
						FROM figurine
						WHERE f_archive = 0";						
							
			return $this->_db->query($strRqFigurine)->fetchAll();
		}


		/**
		* Requête d'archivage des tickets
		*/
		public function archiveTicket($objTicket){
			
			$strArchive = "UPDATE figurine
							SET f_archive 	 = 1
							WHERE f_id 	 = ".$objTicket->getId();
			
			$prep = $this->_db->prepare($strArchive);

			return $prep->execute();			
		}
	}		
?>