<?php
	/**
	* Controller des erreurs
	* @author Marc Renoult
	*/
	class Error_controller extends Base_controller{
		
		public function error_404(){
			//Affichage
			$this->_arrData['strTitle']	= "Page non trouvée";
			$this->_arrData['strPage']	= "error_404";
			$this->display("error_404");
		}
		
		public function error_403(){
			//Affichage
			$this->_arrData['strTitle']	= "Accès interdit";
			$this->_arrData['strPage']	= "error_403";
			$this->display("error_403");
		}		
	}