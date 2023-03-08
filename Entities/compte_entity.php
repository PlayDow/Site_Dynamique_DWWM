<?php
	/**
	* Class d'une entité compte
	* @author Dorian Cotteret
	*/
	class Account {
		/* Attributs */
		private $_id;
        private $_pseudo;
        private $_password;
		private $_name;
        private $_firstName;
        private $_phone;
        private $_mail;
		private $_numero;
        private $_adress;
        private $_lastCo;
		private $_ip;
		private $_postalcode;
        private $_city;
        private $_type=4;
		private $_activate;
        
		
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

				$strMethod = "set".ucfirst(str_replace("cp_", "", $key));
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
		public function setId(int|NULL $intId){
			$this->_id = $intId;
		}
        
        /**
		* Getter du pseudo
		* @return string Pseudo
		*/
		public function getPseudo():string|NULL{
			return $this->_pseudo;
		}
		/**
		* Setter du pseudo
		* @param $strPseudo pseudo
		*/
		public function setPseudo(string $strPseudo){
			$this->_pseudo = FILTER_VAR(trim($strPseudo),FILTER_SANITIZE_SPECIAL_CHARS);
		}


        
        /**
		* Getter du mot de passe
		* @return string mot de passe
		*/
		public function getPassword():string|NULL{
			return $this->_password;
		}
		/**
		* Setter du mot de passe
		* @param $strPassword mot de passe
		*/
		public function setPassword(string $strPassword){
			$this->_password = password_hash($strPassword, PASSWORD_DEFAULT);
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
			$this->_name = FILTER_VAR($strName,FILTER_SANITIZE_SPECIAL_CHARS);
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
			$this->_firstName = FILTER_VAR($strFirstName,FILTER_SANITIZE_SPECIAL_CHARS);
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
			$this->_phone = FILTER_VAR($strPhone,FILTER_SANITIZE_SPECIAL_CHARS);
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
			$this->_mail = FILTER_VAR(trim(strtolower($strMail)),FILTER_SANITIZE_SPECIAL_CHARS);
		}

		/**
		* Getter du numéro de rue
		* @return string numéro de rue
		*/
		public function getNumero():string|NULL{
			return $this->_numero;
		}
		/**
		* Setter du numéro de rue
		* @param $strAdress Adresse
		*/
		public function setNumero(string $strNumAdress){
			$this->_numero = FILTER_VAR($strNumAdress,FILTER_SANITIZE_SPECIAL_CHARS);
		}

        /**
		* Getter de l'adresse
		* @return string Adresse
		*/
		public function getAdress():string|NULL{
			return $this->_adress;
		}
		/**
		* Setter de l'adresse
		* @param $strAdress Adresse
		*/
		public function setAdress(string $strAdress){
			$this->_adress = FILTER_VAR($strAdress,FILTER_SANITIZE_SPECIAL_CHARS);
		}


        /**
		* Getter de la date et heure de la dernière connexion
		* @return datetime dernière connexion
		*/
		public function getLastCo():datetime|NULL{
			
			return $this->_lastCo;
		}
		/**
		* Setter de la date et heure de la dernière connexion
		* @param $dateLastCo dernière connexion
		*/
		public function setLastCo(datetime|NULL $dateLastCo){
			$this->_lastCo = $dateLastCo;
		}


        /**
		* Getter de l'IP utilisateur
		* @return string IP utilisateur
		*/
		public function getIp():string|NULL{
			return $this->_ip;
		}
		/**
		* Setter de l'IP utilisateur
		* @param $strIp IP utilisateur
		*/
		public function setIp(string|NULL $strIp){
			$this->_ip = $strIp;
		}


        /**
		* Getter du code postal de la ville
		* @return string code postal  ville
		*/
		public function getPostalCode():string|NULL{
			return $this->_postalcode;
		}
		/**
		* Setter du code postal de la ville
		* @param $strPostalCode code postal ville
		*/
		public function setPostalCode(string|NULL $strPostalCode){
			$this->_postalcode = FILTER_VAR(trim($strPostalCode),FILTER_SANITIZE_SPECIAL_CHARS);
		}

		        /**
		* Getter de l'id de la ville
		* @return int id ville
		*/
		public function getCity():int|NULL{
			return $this->_city;
		}
		/**
		* Setter de l'id de la ville
		* @param $intCity id ville
		*/
		public function setCity(int|NULL $intCity){
			$this->_city = $intCity;
		}


        /**
		* Getter de l'id du type de compte
		* @return int id type
		*/
		public function getType():int|NULL{
			return $this->_type;
		}

		/**
		* Setter de l'id du type de compte
		* @param $intType id type
		*/
		public function setType(int $intType){
			$this->_type = $intType;
		}

		/**
		* Getter du compte actif
		* @return bool actif ou non actif
		*/
		public function getActivate():bool|null{
			return $this->_activate;
		}

		/**
		* Setter du compte actif
		* @param $boolActivate actif ou non actif
		*/
		public function setActivate(bool|null $boolActivate){
			$this->_activate = $boolActivate;
		}
	}
?>