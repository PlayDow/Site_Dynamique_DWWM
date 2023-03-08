<?php
	/**
	* Class d'une entité commande
	* @author Dorian Cotteret
	*/
	class Order {
		/* Attributs */
		private $_id;
        private $_date;
        private $_total;
		private $_shipping;
        private $_exp;
        private $_account;
        
		
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
		* Getter de la date et heure de la commande
		* @return datetime date et heure de la commande
		*/
		public function getDate():datetime{
			return $this->_date;
		}
		/**
		* Setter de la date et heure de la commande
		* @param $dateDate date et heure de la commande
		*/
		public function setDate(datetime $dateDate){
			$this->_date = $dateDate;
		}


        /**
		* Getter du prix total de la commande
		* @return float Prix total
		*/
		public function getTotal():float{
			return $this->_total;
		}
		/**
		* Setter du prix total de la commande
		* @param $floatTotal Prix total
		*/
		public function setTotal(int $floatTotal){
			$this->_total = $floatTotal;
		}


        /**
		* Getter du prix d'expédition de la commande
		* @return float prix d'expédition
		*/
		public function getShipping():float{
			return $this->_shipping;
		}
		/**
		* Setter du prix d'expédition de la commande
		* @param $floatTotal Prix total
		*/
		public function setShipping(int $floatShipping){
			$this->_shipping = $floatShipping;
		}


        /**
		* Getter de la date et heure de l'envoi de la commande
		* @return datetime date et heure de l'envoi de la commande
		*/
		public function getExp():datetime{
			return $this->_exp;
		}
		/**
		* Setter de la date et heure de l'envoi de la commande
		* @param $dateDate date et heure de l'envoi de la commande
		*/
		public function setExp(datetime $dateExp){
			$this->_exp = $dateExp;
		}


        /**
		* Getter de l'id du comtpe
		* @return int id compte
		*/
		public function getAccount():int{
			return $this->_account;
		}
		/**
		* Setter de l'id du compte
		* @param $intAccount id compte
		*/
		public function setAccount(int $intAccount){
			$this->_account = $intAccount;
		}
	}
?>