<?php

	/**
	* Class manager des villes
	* @author Dorian Cotteret
	*/
	class CityManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des villes
		* @return array Liste des villes
		*/
		public function findUsers(){
			$strRqCity = "SELECT v_id, v_cp, v_name FROM ville;";
							
			return $this->_db->query($strRqCity)->fetchAll();
		}
		
	}
?>