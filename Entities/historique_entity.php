<?php
	/**
	* Class d'une entité historique
	* @author Dorian Cotteret
	*/
	class History {
		/* Attributs */
		private $_id;
		private $_newModif;
        private $_oldValue;
        private $_users;
        private $_dateHour;
        private $_table;
        private $_champId;
        private $_champ;      
		
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
		* Getter de la nouvelle modification
		* @return string nom de la modification
		*/
		public function getNewModif():string{
			return $this->_newModif;
		}
		/**
		* Setter de la nouvelle modification
		* @param $strNewModif nouveau modification
		*/
		public function setNewModif(string $strNewModif){
			$this->_newModif = $strNewModif;
		}		
		

        /**
		* Getter de l'ancienne valeur
		* @return string nom de la valeur
		*/
		public function getOldValue():string{
			return $this->_oldValue;
		}
		/**
		* Setter de l'ancienne valeur
		* @param $strOldValue ancienne valeur
		*/
		public function setOldValue(string $strOldValue){
			$this->_oldValue = $strOldValue;
		}


        /**
		* Getter de la personne qui à fait la modification
		* @return string users
		*/
		public function getUsers():string{
			return $this->_users;
		}
		/**
		* Setter de la personne qui à fait la modification
		* @param $strUsers nom de la personne
		*/
		public function setUsers(string $strUsers){
			$this->_users = $strUsers;
		}


		/**
		* Getter de la date et heure de la modification
		* @return datetime date
		*/
		public function getDateHour():datetime{
			return $this->_dateHour;
		}
		/**
		* Setter de la date et heure de la modification
		* @param $dateHour date modification
		*/
		public function setDateHour(datetime $dateHour){
			$this->_dateHour = $dateHour;
		}


		/**
		* Getter de la table ou à eu lieu la modification
		* @return string table
		*/
		public function getTable():string{
			return $this->_table;
		}
		/**
		* Setter de la table ou à eu lieu la modification
		* @param $strTable table modification
		*/
		public function setTable(string $strTable){
			$this->_table = $strTable;
		}


        /**
		* Getter de l'id du champ modifié
		* @return int id champ
		*/
		public function getChampId():int{
			return $this->_champId;
		}
		/**
		* Setter de l'id du champ modifié
		* @param $intChampId id du champ modifié
		*/
		public function setChampId(int $intChampId){
			$this->_champId = $intChampId;
		}


		/**
		* Getter du nom du champ modifié
		* @return string champ
		*/
		public function getChamp():string{
			return $this->_champ;
		}
		/**
		* Setter du nom du champ modifié
		* @param $strChamp nom du champ modifié
		*/
		public function setChamp(string $strChamp){
			$this->_champ = $strChamp;
		}
	}
?>