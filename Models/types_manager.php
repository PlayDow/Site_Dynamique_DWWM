<?php

	/**
	* Class manager des types de compte
	* @author Dorian Cotteret
	*/
	class TypesManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des types
		* @return array Liste des types
		*/
		public function findTypes(){
			$strRqTypes = "SELECT ty_id, ty_name FROM types;";
							
			return $this->_db->query($strRqTypes)->fetchAll();
		}
		
	}
?>