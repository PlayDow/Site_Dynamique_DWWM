<?php

	/**
	* Class manager des commentaires
	* @author Dorian Cotteret
	*/
	class CommentManager extends Manager{
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Methode de récupération des commentaires d'un produit
		* @return array Liste des commentaires
		*/
		public function findComment($intComment){
			$strRqComment = "SELECT com_id, com_comment, com_value, com_createdate, com_account, com_product
								FROM commentaire
								WHERE com_product = ".$intComment;
					
			return $this->_db->query($strRqComment)->fetchAll();
		}


		/**
		* Methode de récupération des commentaires 
		* @return array Liste des commentaires
		*/
		public function findOneComment($intComment){
			$strRqComment = "SELECT *
								FROM commentaire
								WHERE com_id = ".$intComment;
							
			return $this->_db->query($strRqComment)->fetch();
		}


		/**
		* Methode de récupération des pseudos de commentaire 
		* @return string Pseudo
		*/
		public function findPseudoComment($intPseudo){
			$strRqComment = "SELECT compte.cp_pseudo AS com_pseudo
								FROM compte
									INNER JOIN commentaire ON compte.cp_id = commentaire.com_account
								WHERE com_account = ".$intPseudo;                  
							
			return $this->_db->query($strRqComment)->fetch();
		}



		/**
		* Methode de création des commentaires
		* @return array Liste des commentaires
		*/
		public function CreateComment ($objComment) {
			$strRqAdd = "INSERT INTO commentaire (com_comment, com_value, com_createdate, com_account, com_product)
							VALUES (:comment, :value, NOW(), :account, :product)";

			$prep		= $this->_db->prepare($strRqAdd);
			
			$prep->bindValue(':comment', $objComment->getComment(), PDO::PARAM_STR);
			$prep->bindValue(':value', $objComment->getValue(), PDO::PARAM_INT);
			$prep->bindValue(':account', $objComment->getAccount(), PDO::PARAM_INT);
			$prep->bindValue(':product', $objComment->getProduct(), PDO::PARAM_INT);
			
			return $prep->execute();
		} 


		/**
		* Requête de modification de produit
		*/
		public function EditComment ($objComment) {
			$objId					= $_GET['comment'];
			$strUpdateQuery 		= "UPDATE commentaire
		 		SET com_comment	 	= :comment,
				 	com_value 		= :value
		 		WHERE com_id 		= ".$objId;
			
		 	$prep = $this->_db->prepare($strUpdateQuery);
			
		 	$strComment 	= $objComment->getComment();
		 	$intValue		= $objComment->getValue();
			
			$prep->bindValue(':comment', $strComment , PDO::PARAM_STR);
			$prep->bindValue(':value', $intValue, PDO::PARAM_INT);

			return $prep->execute();			
		}


		/**
		* Requête de suppression des commentaires d'un produit
		* @param int $intComment Identifiant des commentaires du produit à supprimer
		* @return bool La suppression s'est bien passée ou pas
		*/
		public function DeleteComment ($intComment):bool {
			$strDelQuery 		= "DELETE FROM commentaire
		 		WHERE com_product 		= ".$intComment;
			$this->_db->exec($strDelQuery);
			return true;
		}


		/**
		* Requête de suppression d'un commentaire d'un produit
		* @param int $intComment Identifiant du commentaire à supprimer
		* @return bool La suppression s'est bien passée ou pas
		*/
		public function DeleteOneComment (int $intComment):bool {
			$strDelQuery 		= "DELETE FROM commentaire
		 		WHERE com_id 		= ".$intComment;			
			return $this->_db->exec($strDelQuery);
		}
		
	}
?>