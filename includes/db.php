<?php
	class Settings{
		public $db = NULL;
		function __construct(){
			$this->db = new SQLite3($_SERVER["DOCUMENT_ROOT"] . "/database/phoenix.db");
		}
		
		function getNode($node){
			$stmt = $this->db->prepare("SELECT * FROM settings WHERE node=:node");
			$stmt->bindValue(':node', $node, SQLITE3_TEXT);
			$result = $stmt->execute();
			return $result->fetchArray(SQLITE3_ASSOC);
		}
		
		function setNode($node, $value){
			$stmt = $this->db->prepare("UPDATE settings SET value=:val WHERE node=:node");
			$stmt->bindValue(':val', $value, SQLITE3_TEXT);
			$stmt->bindValue(':node', $node, SQLITE3_TEXT);
			$stmt->execute();
		}
		
		function createNode($node, $value, $info){
			$stmt = $this->db->prepare("INSERT INTO settings(node, value, info) VALUES (:node, :val, :info)");
			$stmt->bindValue(':val', $value, SQLITE3_TEXT);
			$stmt->bindValue(':node', $node, SQLITE3_TEXT);
			$stmt->bindValue(':info', $info, SQLITE3_TEXT);
			$stmt->execute();
		}
	}
	
	class Theme{
		public $db = NULL;
		public $theme = "red";
		public $color = array();
		function __construct(){
			$this->db = new SQLite3($_SERVER["DOCUMENT_ROOT"] . "/database/phoenix.db");
			$tmpset = new Settings();
			$this->theme = $tmpset->getNode("pref.theme")["value"];
			
			$stmt = $this->db->prepare("SELECT * FROM theme WHERE ref=:ref");
			$stmt->bindValue(':ref', $this->theme, SQLITE3_TEXT);
			$result = $stmt->execute();
			
			$this->color = (object) $result->fetchArray(SQLITE3_ASSOC);
		}
	}
?>