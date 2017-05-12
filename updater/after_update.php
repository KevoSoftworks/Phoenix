<?php
	if(isset($_GET["force"]) && $_GET["force"] == 1) finaliseUpdate($_GET["version"]);
	
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
			
			$query = $settings->db->query("SELECT EXISTS(SELECT name FROM sqlite_master WHERE type='table' AND name='streams')");
			$result = $query->fetchArray(SQLITE3_NUM);
			if($result[0] == 0){
				$settings->db->query("CREATE TABLE streams(id INTEGER PRIMARY KEY, name TEXT, url TEXT)");
				
				$settings->db->query("INSERT INTO streams(name, url) VALUES ('Radio 2', 'http://icecast.omroep.nl/radio2-bb-mp3')");
				$settings->db->query("INSERT INTO streams(name, url) VALUES ('3FM', 'http://icecast.omroep.nl/3fm-bb-mp3')");
				$settings->db->query("INSERT INTO streams(name, url) VALUES ('Radio 10', 'http://stream.radio10.nl/radio10')");
				$settings->db->query("INSERT INTO streams(name, url) VALUES ('SkyRadio', 'http://8593.live.streamtheworld.com/SKYRADIO_SC')");
				$settings->db->query("INSERT INTO streams(name, url) VALUES ('Radio Veronica', 'http://8503.live.streamtheworld.com:80/VERONICA.mp3')");
				$settings->db->query("INSERT INTO streams(name, url) VALUES ('Slam FM', 'http://vip-icecast.538.lw.triple-it.nl:80/SLAMFM_MP3')");
				$settings->db->query("INSERT INTO streams(name, url) VALUES ('Arrow Classic Rock', 'http://91.221.151.155:80/')");
			}
		}
	}
?>