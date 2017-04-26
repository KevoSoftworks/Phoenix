<?php
	if($_GET["force"] == 1) finaliseUpdate($_GET["version"]);
	
	function finaliseUpdate($curver = "0.0.1"){
		require_once("../includes/db.php");
		$settings = new Settings();
		
		if(version_compare("0.0.11", $curver) == 1){
			$query = $settings->db->query("SELECT EXISTS(SELECT * FROM settings WHERE node='pref.albumart' LIMIT 1)");
			$result = $query->fetchArray(SQLITE3_NUM);
			if($result[0] == 0){
				$settings->createNode("pref.albumart", "true", "Defines whether or not albumart should be loaded. 'True' loads albumart, 'False' does not");
			}
			
			$query = $settings->db->query("SELECT EXISTS(SELECT * FROM settings WHERE node='pref.sidebar.hover' LIMIT 1)");
			$result = $query->fetchArray(SQLITE3_NUM);
			if($result[0] == 0){
				$settings->createNode("pref.sidebar.hover", "true", "Defines whether or not the sidebar should open when the cursor hovers over it. 'True' opens sidebars, 'False' does not");
			}
		}
	}
?>