<?php
	include "../includes/socket_api.php";
	
	if(!isset($_GET["cmd"]) || empty($_GET["cmd"])){
		die(json_encode(["stat" => false, "msg" => "No command"]));
	}
	
	$cmd = $_GET["cmd"];
	$cmd = str_replace("&apos;", "'", $cmd);
	$cmd = str_replace("&amp;", "&", $cmd);
	
	if($cmd === "current"){
		$sock = openSocket();
		sendSocket($sock, "status");
		$result1 = _parseStatusResponse(readSocket($sock));
		
		if($result1["state"] == "play"){
			sendSocket($sock, "playlistinfo " . $result1["song"]);
			$result2 = _parsePlaylistResponse(readSocket($sock));
			if(!isset($result2[0]["Artist"])){
				$result2[0]["Artist"] = "Unknown";
			}
			if(!isset($result2[0]["Title"])){
				preg_match('/\/([^\/]*)\..*$/', $result2[0]["file"], $matches);
				$result2[0]["Title"] = $matches[1];
			}
		} else {
			$result2 = array();
		}
		
		$data[0] = $result1;
		$data[1] = $result2;
		header("Content-Type: application/json");
		die(json_encode(["stat" => true, "result" => $data, "command" => $cmd]));
	} else{	
		if($cmd !== "playlistinfo" && $cmd !== "status"){
			if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local", "command" => $cmd]));
		}
		$sock = openSocket();
		sendSocket($sock, $cmd);
		$result = readSocket($sock);
		if($cmd === "playlistinfo") $result = _parsePlaylistResponse($result);
		if($cmd === "status") $result = _parseStatusResponse($result);
		if($cmd === "listall") $result = _parseListallResponse($result);
		if(strpos($cmd, "search") !== false) $result = _parseSearchResponse($result);
		closeSocket($sock);
		header("Content-Type: application/json");
		die(json_encode(["stat" => true, "result" => $result, "command" => $cmd]));
	}
?>