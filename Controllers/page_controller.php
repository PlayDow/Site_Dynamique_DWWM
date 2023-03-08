<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	/**
	* Controller des pages
	* @author Dorian Cotteret
	*/
	class Page_controller extends Base_controller{
		
		/**
		* Page Mentions Légales
		*/
		public function Mentions(){
			$this->_arrData['strTitle']	= "Mentions Légales";
			$this->_arrData['strPage']	= "mentions";
			$this->display("mentions_legales");
		}
		
		/**
		* Page Plan du Site
		*/
		public function Plan(){
			$this->_arrData['strTitle']	= "Plan du site";
			$this->_arrData['strPage']	= "plan";
			$this->display("plan_du_site");
		}
		
		/**
		* Page Contact
		*/
		public function Contact(){
			$arrErrors= array();
			if(isset($_POST)&&(count($arrErrors)==0))
			{
				
				// Inclusion des fichiers de la librairie PHPMailer
				require 'libs\PHPMailer\src\Exception.php';
				require 'libs\PHPMailer\src\PHPMailer.php';
				require 'libs\PHPMailer\src\SMTP.php';
				
				$objMail = new PHPMailer(); // Création de l'objet Mail
				
				try {   
					$objMail->setFrom('dwwm_tp_2223@ce-formation.com', 'Renoult Marc');   
					$objMail->addAddress('dwwm_tp_2223@ce-formation.com', 'Renoult Marc');   
					$objMail->Subject = 'Prise de contact';   
					$objMail->Body = 'message';
					// Paramètres SMTP                    
					$objMail->isSMTP(); // Utilisation du SMTP                    
					$objMail->Host = 'ssl0.ovh.net'; // Adresse SMTP server                    
					$objMail->SMTPAuth = TRUE; // Utilisation de l'authentification SMTP                    
					$objMail->SMTPSecure = 'tls'; // encryption system                    
					$objMail->Username = 'dwwm_tp_2223@ce-formation.com'; // nom d'utilisateur                    
					$objMail->Password = 'pdw : j@m3rG7Ctx?5ND@Y'; // Mot de passe                    
					$objMail->Port = 465; // Port SMTP   
					}catch (Exception $e)   
					{
						echo $e->errorMessage();
					}
			}
			$this->_arrData['arrErrors']         = $arrErrors;
			$this->_arrData['strTitle']	= "Contact";
			$this->_arrData['strPage']	= "Contact";
			$this->display("contact");
		}

		/**
		* Page d'accueil du site
		*/
		public function Index(){
			$this->_arrData['strTitle']	= "Accueil";
			$this->_arrData['strPage']	= "Accueil";
			$this->display("index");
		}

	}