<?php
	/**
	* Class d'une entité commentaire
	* @author Dorian Cotteret
	*/
	class Comment {
		/* Attributs */
		private $_id;
        private $_comment;
        private $_value;
		private $_createdate;
        private $_account;
        private $_product;
		private $_pseudo;
        
		
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
				$strMethod = "set".ucfirst(str_replace("com_", "", $key));
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
		* Getter du texte du commentaire
		* @return string Commentaire
		*/
		public function getComment():string|NULL{
			return $this->_comment;
		}
		/**
		* Setter du texte du commentaire
		* @param $strComment Commentaire
		*/
		public function setComment(string $strComment){
			$this->_comment = filter_var(trim($strComment),FILTER_SANITIZE_SPECIAL_CHARS);
		}


        /**
		* Getter de la valeur de la note
		* @return int Note
		*/
		public function getValue():int|NULL{
			return $this->_value;
		}
		/**
		* Setter de la valeur de la note
		* @param $intValue Note
		*/
		public function setValue(int $intValue){
			$this->_value = $intValue;
		}


        /**
		* Getter de la date et heure du commentaire
		* @return datetime date et heure du commentaire
		*/
		public function getCreatedate():string{
			$date = new DateTime($this->_createdate);
			return $date->format('d/m/Y H:i:s');
		}
		/**
		* Setter de la date et heure du commentaire
		* @param $dateDate date et heure du commentaire
		*/
		public function setCreateDate(string $dateCreate){
			$this->_createdate = $dateCreate;
		}


        /**
		* Getter de l'id du comtpe
		* @return int id compte
		*/
		public function getAccount():int|NULL{
			return $this->_account;
		}
		/**
		* Setter de l'id du compte
		* @param $intAccount id compte
		*/
		public function setAccount(int $intAccount){
			$this->_account = $intAccount;
		}


        /**
		* Getter de l'id du produit
		* @return int id produit
		*/
		public function getProduct():int{
			return $this->_product;
		}
		/**
		* Setter de l'id du type de compte
		* @param $intProduct id produit
		*/
		public function setProduct(int $intProduct){
			$this->_product = $intProduct;
		}


		/**
		* Getter du texte du pseudo
		* @return string Pseudo
		*/
		public function getPseudo():string|NULL{
			return $this->_pseudo;
		}
		/**
		* Setter du texte du commentaire
		* @param $strPseudo Commentaire
		*/
		public function setPseudo(string $strPseudo){
			$this->_pseudo = $strPseudo;
		}
	}
?>