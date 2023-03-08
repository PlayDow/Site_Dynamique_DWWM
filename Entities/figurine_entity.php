<?php
	/**
	* Class d'une entité figurine
	* @author Quentin Serpette & Dorian Cotteret
	*/
	class Figurine {
		/* Attributs */
		private $_id;
		private $_name;
        private $_firstName;
        private $_phone;
        private $_mail;
		private $_numAddress;
        private $_street;
		private $_postcode;
		private $_town;
		private $_files;
		private $_number;
		private $_message;
		private $_archive;

        
		
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

				$strMethod = "set".ucfirst(str_replace("f_", "", $key));
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
		* Getter du nom
		* @return string Nom
		*/
		public function getName():string|NULL{
			return $this->_name;
		}
		/**
		* Setter du nom
		* @param $strName Nom
		*/
		public function setName(string $strName){
			$this->_name = filter_var(trim($strName),FILTER_SANITIZE_SPECIAL_CHARS);
		}		


        /**
		* Getter du prénom
		* @return string Prénom
		*/
		public function getFirstName():string|NULL{
			return $this->_firstName;
		}
		/**
		* Setter du prénom
		* @param $strFirstName Prénom
		*/
		public function setFirstName(string $strFirstName){
			$this->_firstName = filter_var(trim($strFirstName),FILTER_SANITIZE_SPECIAL_CHARS);
		}		


        
        /**
		* Getter du téléphone
		* @return string numéro de téléphone
		*/
		public function getPhone():string|NULL{
			return $this->_phone;
		}
		/**
		* Setter du téléphone
		* @param $strPhone numéro de téléphone
		*/
		public function setPhone(string $strPhone){
			$this->_phone = filter_var(trim($strPhone),FILTER_SANITIZE_SPECIAL_CHARS);
		}


        /**
		* Getter de l'adresse mail
		* @return string Mail
		*/
		public function getMail():string|NULL{
			return $this->_mail;
		}
		/**
		* Setter de l'adresse mail
		* @param $strMail Mail
		*/
		public function setMail(string $strMail){
			$this->_mail = filter_var(trim($strMail),FILTER_SANITIZE_SPECIAL_CHARS);
		}

		/**
		* Getter du numéro de rue
		* @return string Adresse
		*/
		public function getNumAddress():string|NULL{
			return $this->_numAddress;
		}
		/**
		* Setter du numéro de rue
		* @param $strNumAdress Adresse
		*/
		public function setNumAddress(string $strNumAdress){
			$this->_numAddress = $strNumAdress;
		}


        /**
		* Getter de l'adresse
		* @return string street
		*/
		public function getStreet():string|NULL{
			return $this->_street;
		}
		/**
		* Setter de l'adresse
		* @param $strstreet Adresse
		*/
		public function setStreet(string $strStreet){
			$this->_street = filter_var(trim($strStreet),FILTER_SANITIZE_SPECIAL_CHARS);
		}


		/**
		* Getter du code postal
		* @return string postcode
		*/
		public function getPostcode():string|NULL{
			return $this->_postcode;
		}
		/**
		* Setter du code postal
		* @param $strpostcode Code Postal
		*/
		public function setPostcode(string $strPostcode){
			$this->_postcode = filter_var(trim($strPostcode),FILTER_SANITIZE_SPECIAL_CHARS);
		}


        /**
		* Getter de l'id de la ville
		* @return int id ville
		*/
		public function getTown():string|NULL{
			return $this->_town;
		}
		/**
		* Setter de l'id de la ville
		* @param $strTown id ville
		*/
		public function setTown(string $strTown){
			$this->_town= filter_var(trim($strTown),FILTER_SANITIZE_SPECIAL_CHARS);
		}
		
		
		
		/**
		* Getter du nombre d'exemplaires
		* @return int nombre exemplaire
		*/
		public function getNumber():int|NULL{
			return $this->_number;
		}
		/**
		* Setter du nombre d'exemplaires
		* @param $intnumber
		*/
		public function setNumber(string $intNumber){
			$this->_number = intval($intNumber);
		}

		/**
		* Getter du fichier
		* @return string fichier
		*/
		public function getFiles():string|NULL{
			return $this->_files;
		}
		/**
		* Setter du fichier
		* @param $strFile files
		*/
		public function setFiles(string $strFiles){
			$this->_files = $strFiles;
		}	
		
		
		/**
		* Getter du message
		* @return string message
		*/
		public function getMessage():string|NULL{
			return $this->_message;
		}
		/**
		* Setter du message
		* @param $strMessage message
		*/
		public function setMessage(string $strMessage){
			$this->_message = filter_var(trim($strMessage),FILTER_SANITIZE_SPECIAL_CHARS);
		}


		/**
		* Getter vérification si ticket archivé
		* @return boolean si ticket archivé
		*/
		public function getCheck():bool|NULL{
			return $this->_archive;
		}
		/**
		* Setter vérification si ticket archivé
		* @param $boolCheck files
		*/
		public function setCheck(bool $boolCheck){
			$this->_archive = $boolCheck;
		}
		
	}
					
					
					
?>