<?php
	/**
	* Class d'une entité catégorie
	* @author Dorian Cotteret
	*/
	class Category {
		/* Attributs */
		private $_id;
		private $_name;
        
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
		}
		
		/**
		* Remplissage de l'objet avec les données du tableau
		*/
		public function hydrate($arrData){
			foreach($arrData as $key=>$value){
				$strMethod = "set".ucfirst(str_replace("cat_", "", $key));
				if (method_exists($this, $strMethod)){
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
		* Getter du nom de la catégorie
		* @return string catégorie
		*/
		public function getName():string|NULL{
			return $this->_name;
		}
		/**
		* Setter du nom de la catégorie
		* @param $strName nom de la catégorie
		*/
		public function setName(string $strName){ 
			$this->_name = filter_var(trim($strName),FILTER_SANITIZE_SPECIAL_CHARS);
		}
    }
?>