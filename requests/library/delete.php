<?php
	header("Content-Type: application/json");
	require_once("../../includes/db.php");
	require_once("../../includes/socket_api.php");
	if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local"]));
	
	$settings = new Settings();
	
	if(!is_numeric($_GET["id"])) die(json_encode(["stat" => false, "msg" => "Given ID not a number"]));
	$id = (int)$_GET["id"];
	
	$stmt = $settings->db->prepare("DELETE FROM streams WHERE id=:id");
	$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
	$stmt->execute();
	
	die(json_encode(["stat" => true]));
?>