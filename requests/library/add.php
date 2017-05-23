<?php
	require_once("../../includes/db.php");
	require_once("../../includes/socket_api.php");
	if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local"]));
	
	$settings = new Settings();
	
	$stmt = $settings->db->prepare("INSERT INTO streams(name, url) VALUES (:name, :url)");
	
	$stmt->bindValue(':name', $_GET["name"], SQLITE3_TEXT);
	$stmt->bindValue(':url', $_GET["url"], SQLITE3_TEXT);
	$stmt->execute();
	
	die(json_encode(["stat" => true]));
?>