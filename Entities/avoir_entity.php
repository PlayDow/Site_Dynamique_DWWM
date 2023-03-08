<?php
	/**
	* Class d'une entité avoir
	* @author Dorian Cotteret
	*/
	class Have {
		/* Attributs */
		private $_id;
        private $_product; 
		private $_category;    
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
		}

		/**
		* Remplissage de l'objet avec les données du tableau
		*/
		public function hydrate($arrData) {
			// Remplir l'objet
			
			foreach($arrData as $key=>$value){
				
				$strMethod = "set".ucfirst(str_replace("p_", "", $key));
				if(method_exists($this, $strMethod)){
					$this->$strMethod($value);
				}			
			}
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
		* Getter de l'id du produit
		* @return int Id du produit
		*/
		public function getProduct():int|NULL{
			return $this->_product;
		}
		/**
		* Setter de l'id du produit
		* @param $intProduct Id du produit
		*/
		public function setProduct(int $intProduct){
			$this->_product = $intProduct;
		}

        
        /**
		* Getter de l'id de la catégorie
		* @return int Id de la catégorie
		*/
		public function getCategory():int|NULL{
			return $this->_category;
		}
		/**
		* Setter de l'id de la catégorie
		* @param $intCategory Id de la catégorie
		*/
		public function setCategory(int $intCategory){
			$this->_category = $intCategory;
		}
    }
?>