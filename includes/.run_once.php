<?php
	require_once("db.php");
	$settings = new Settings();
	
	$settings->createNode("pref.name", "Phoenix", "This setting defines the WebUI's display name");
	$settings->createNode("pref.color", "red", "This setting defines the WebUI's display colour");
	$settings->createNode("pref.theme", "dark", "This setting defines the WebUI's theme lightness");
?>