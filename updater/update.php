<?php
	include "../includes/socket_api.php";
	include "../includes/updater.php";
	if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local"]));
	
	$force_update = $_GET["force"];
	
	$update = new Updater();
	if($force_update == true){
		$status = $update->executeUpdate(true);
	} else {
		$status = $update->executeUpdate();
	}
	
	
	die(json_encode(["stat" => $status]));
?>