<?php
	/**
	* Class d'une entité city
	* @author Dorian Cotteret
	*/
	class City {
		/* Attributs */
		private $_id;
		private $_cp;
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
		* Getter du code postal
		* @return int Code postal
		*/
		public function getCp():int{
			return $this->_cp;
		}
		/**
		* Setter du code postal
		* @param $intCp Code postal
		*/
		public function setCp(int $intCp){
			$this->_cp = $intCp;
		}

        
		/**
		* Getter du nom de la ville
		* @return string nom
		*/
		public function getName():string{
			return $this->_name;
		}
		/**
		* Setter du nom de la ville
		* @param $strName Nom de la ville
		*/
		public function setName(string $strName){
			$this->_name = $strName;
		}		
		
	}
?>