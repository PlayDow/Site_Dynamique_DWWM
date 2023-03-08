<?php
	/**
	* Class d'une entité type
	* @author Dorian Cotteret
	*/
	class Type {
		/* Attributs */
		private $_id;
		private $_name;
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
		}
		
		
		/* Getters et Setters */
		
		/**
		* Getter de l'id
		* @return int Identifiant
		*/
		public function getId():int{
			return $this->_id;
		}
		/**
		* Setter de l'id
		* @param $intId Identifiant
		*/
		public function setId(int $intId){
			$this->_id = $intId;
		}

        
		/**
		* Getter du type de compte
		* @return string nom
		*/
		public function getName():string{
			return $this->_name;
		}
		/**
		* Setter du type de compte
		* @param $strName Type de compte
		*/
		public function setName(string $strName){
			$this->_name = $strName;
		}		
		
	}
?>