<?php
	/**
	* Class d'une entité contenir
	* @author Dorian Cotteret
	*/
	class Contain {
		/* Attributs */
		private $_id;
		private $_quantity;
        private $_order;
        private $_product;     
		
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
		* Getter de la quantité
		* @return int quantité
		*/
		public function getQuantity():int{
			return $this->_quantity;
		}
		/**
		* Setter de la quantité
		* @param $intQuantity quantité
		*/
		public function setQuantity(int $intQuantity){
			$this->_quantity = $intQuantity;
		}


        /**
		* Getter de l'id de la commande
		* @return int id de la commande
		*/
		public function getOrder():int{
			return $this->_order;
		}
		/**
		* Setter de l'id de la commande
		* @param $intOrder id de la commande
		*/
		public function setOrder(int $intOrder){
			$this->_order = $intOrder;
		}


        /**
		* Getter de l'id du produit
		* @return int Id du produit
		*/
		public function getProduct():int{
			return $this->_product;
		}
		/**
		* Setter de l'id du produit
		* @param $intProduct Id du produit
		*/
		public function setProduct(int $intProduct){
			$this->_product = $intProduct;
		}
    }
?>