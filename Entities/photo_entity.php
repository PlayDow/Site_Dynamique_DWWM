<?php
	/**
	* Class d'une entité photo
	* @author Dorian Cotteret
	*/
	class Photo {
		/* Attributs */
		private $_id;
		private $_name;
        private $_product;
        
		
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
				
				$strMethod = "set".ucfirst(str_replace("ph_", "", $key));
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
		public function getId():int|NULL{
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
		* Getter du nom de la photo
		* @return string photo
		*/
		public function getName():string|NULL{
			return $this->_name;
		}
		/**
		* Setter du nom de la photo
		* @param $strName nom de la photo
		*/
		public function setName(string $strName){
			$this->_name = filter_var(trim($strName),FILTER_SANITIZE_SPECIAL_CHARS);
		}		


        /**
		* Getter du produit
		* @return int id produit
		*/
		public function getProduct():int|NULL{
			return $this->_product;
		}
		/**
		* Setter du créateur
		* @param $intProduct id produit
		*/
		public function setProduct(int $intProduct){
			$this->_product = $intProduct;
		}
	}
?>