<?php
	require_once("../includes/db.php");
	require_once("../includes/socket_api.php");
	if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local"]));
	
	$settings = new Settings();
	$settings->setNode("pref.name", $_GET["name"]);
	$settings->setNode("pref.theme", $_GET["colour"]);
	
	die(json_encode(["stat" => true]));
?>