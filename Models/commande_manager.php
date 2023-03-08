<?php

	/**
	* Class manager des commandes
	* @author Dorian Cotteret
	*/
	class OrderManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		
		/**
		* Methode de récupération des commandes
		* @return array Liste des commandes
		*/
		public function findOrder(){
			$strRqOrder = "SELECT cmd_id, cmd_date, cmd_total, cmd_shipping, cmd_exp, cmd_account FROM commande;";
							
			return $this->_db->query($strRqOrder)->fetchAll();
		}
		
	}
?>