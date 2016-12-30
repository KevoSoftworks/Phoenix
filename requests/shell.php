<?php
	include "../includes/socket_api.php";
	
	if(!isset($_GET["cmd"]) || empty($_GET["cmd"])){
		die(json_encode(["stat" => false, "msg" => "No command"]));
	}
	
	$cmd = $_GET["cmd"];
	$cmd = str_replace("&apos;", "'", $cmd);
	$cmd = str_replace("&amp;", "&", $cmd);
	
	if($cmd === "sudo -H -u mpd amixer -D equal"){
		$result = _parseEq(systemCommand($cmd));
	} else if(strpos($cmd, "folder_prop") > -1){
		if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local"]));
		$uri = "\"/var/lib/mpd/music/" . str_replace("folder_prop ", "", $cmd) . "\"";
		$result = array();
		$result["folder"] = str_replace("folder_prop ", "", $cmd);
		
		preg_match('/(\d*)/', systemCommand("du -d 0 -c " . $uri)[1], $match);
		$result["size"] = $match[1] * 1000; //DU returns in KB
		
		$shellRes = systemCommand("ls -od " . $uri)[0];
		$shellAr = explode(" ", $shellRes);
		$result["syms"] = $shellAr[1];
		$result["owner"] = $shellAr[2];
		$result["size_disk"] = $shellAr[3];
		$result["perm"] = substr($shellAr[0],1);
		$result["date"] = $shellAr[5] . " " . $shellAr[4] . " " . $shellAr[6];
		$result["type"] = substr($shellRes, 0, 1);
	} else {
		if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local"]));
		$result = systemCommand($cmd);
	}
	
	header("Content-Type: application/json");
	die(json_encode(["stat" => true, "msg" => "success", "result" => $result]));
?>