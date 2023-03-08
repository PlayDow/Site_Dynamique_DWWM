<?php
	/**
	* Class d'une entité produit
	* @author Dorian Cotteret & Quentin Serpette
	*/
	class Product {
		/* Attributs */
		private $_id;
		private $_name;
		private $_category;
        private $_price;		
        private $_description;
        private $_account;
		private $_photo;
        
		
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
		* Getter du nom de produit
		* @return string nom
		*/
		public function getName():string|NULL{
			return $this->_name;
		}
		/**
		* Setter du nom de produit
		* @param $strName nom du produit
		*/
		public function setName(string $strName){
			$this->_name = filter_var(trim($strName),FILTER_SANITIZE_SPECIAL_CHARS);
		}		
		

		/**
		* Getter de la catégorie du produit
		* @return int category
		*/
		public function getCategory():int{
			return $this->_category;
		}
		
		/**
		* Setter de la catégorie du produit
		* @param $intCategory catégorie du produit
		*/
		public function setCategory(int $intCategory) {
			$this->_category = $intCategory;
		}

		/**
		* Getter de la catégorie du produit
		* @return int category
		*/
		public function getPrice():float|NULL{
			return $this->_price;
		}


		/**
		* Getter du prix du produit
		* @return string prix
		*/
		public function getDisplayPrice():string|NULL{
			if(!is_null($this->_price)) {
				$_price = new NumberFormatter("fr_FR", NumberFormatter::CURRENCY );
				$_price->setTextAttribute( $_price::CURRENCY_CODE, 'EUR' );
				$_price->setAttribute( $_price::FRACTION_DIGITS, 2 );
				return $_price->formatCurrency($this->_price, "EUR")."\n";
			} else {
				return $this->_price;
			}
		}
		/**
		* Setter du prix du produit
		* @param $floatPrice prix du produit
		*/
		public function setPrice(float $floatPrice){
			$this->_price = floatval($floatPrice);
		}


        /**
		* Getter de la description du produit
		* @return string description
		*/
		public function getDescription():string|NULL{
			return $this->_description;
		}
		/**
		* Setter de la description du produit
		* @param $strDescription description du produit
		*/
		public function setDescription(string $strDescription){
			$this->_description = filter_var(trim($strDescription),FILTER_SANITIZE_SPECIAL_CHARS);
		}


        /**
		* Getter du créateur
		* @return int id créateur
		*/
		public function getAccount():int|NULL{
			return $this->_account;
		}
		/**
		* Setter du créateur
		* @param $intAccount id créateur
		*/
		public function setAccount(string $intAccount){
			$this->_account = $intAccount;
		}
		
		
		 /**
		* Getter de la photo
		* @return string nom de la photo
		*/
		public function getPhoto():string|NULL{
			return $this->_photo;
		}
		/**
		* Setter de la photo
		* @param $strPhoto nom de la photo
		*/
		public function setPhoto(string $strPhoto){
			$this->_photo = $strPhoto;
		}
	}
?>