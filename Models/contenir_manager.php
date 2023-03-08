<?php

	/**
	* Class manager du contenu lors d'une commande
	* @author Dorian Cotteret
	*/
	class ContentManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des contenus
		* @return array Liste des contenus
		*/
		public function findContent(){
			$strRqContent = "SELECT cont_id, cont_quantity, cont_order, cont_product FROM contenir;";
							
			return $this->_db->query($strRqContent)->fetchAll();
		}
		
	}
?>