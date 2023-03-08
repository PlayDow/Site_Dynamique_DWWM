<?php

	/**
	* Class manager des historiques
	* @author Dorian Cotteret
	*/
	class HistoryManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des historiques
		* @return array Liste des historiques
		*/
		public function findHistory(){
			$strRqHistory = "SELECT his_id, his_newModif, his_oldValue, his_users, his_dateHour, his_table, his_champId, his_champ FROM historique;";
							
			return $this->_db->query($strRqHistory)->fetchAll();
		}
		
	}
?>