<?php
	$current_ver = "0.0.5";
	$manifest = file_get_contents("http://kevosoftworks.com/update/phoenix/manifest.json");
	$data = (Array)json_decode($manifest);
	
	if(version_compare($data["update_ver"], $current_ver) == 1){
		die(json_encode(["update" => true, "new_ver" => $data["update_ver"]]));
	} else {
		die(json_encode(["update" => false]));
	}
?>