<?php
	include "../includes/socket_api.php";
	if(!clientInSameSubnet()) die(json_encode(["stat" => false, "msg" => "Not Local"]));
	
	$force_update = $_GET["force"];
	
	$current_ver = "0.0.8";
	$manifest = file_get_contents("http://kevosoftworks.com/update/phoenix/manifest.json");
	$data = (Array)json_decode($manifest);
	
	if(version_compare($data["update_ver"], $current_ver) == 1){
		//Continue
	} else {
		if($force_update == 1){
			die(json_encode(["stat" => false, "msg" => "No new version available"]));
		} else {
			//continue
		}
	}
	
	exec("sudo mkdir /var/www/tmp");
	exec("sudo chmod 777 /var/www/tmp");
	
	foreach($data["update_path"] as $version){
		if(version_compare($version, $current_ver) == 1){
			$up_path[] = $version;
			file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/tmp/phoenix_" . $version . ".zip", fopen("http://kevosoftworks.com/update/phoenix/" . $data["update_location"] . "/phoenix_" . $version . ".zip", "r"));
			exec("sudo mkdir /var/www/tmp/" . $version);
			exec("sudo unzip /var/www/tmp/phoenix_" . $version . ".zip -d /var/www/tmp/" . $version);
			exec("sudo cp -a -u /var/www/tmp/" . $version . "/. /var/www");
		}
	}
	
	exec("sudo rm -rf /var/www/tmp");
	die(json_encode(["stat" => true]));
?>