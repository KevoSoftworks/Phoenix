<?php
	include "../socket_api.php";
	
	if(!isset($_GET["cmd"]) || empty($_GET["cmd"])){
		die(json_encode(["stat" => false, "msg" => "No command"]));
	}
	
	$cmd = $_GET["cmd"];
	$cmd = str_replace("&apos;", "'", $cmd);
	$cmd = str_replace("&amp;", "&", $cmd);
	
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
	
	switch($result["type"]){
		case "d":
			$result["type"] = "Directory";
			break;
		case "-":
			$result["type"] = "File";
			break;
		case "l":
			$result["type"] = "Symlink";
			break;
	}
	
	function format($num){
		if($num == 0) return '0 Bytes';
		$k = 1024; // or 1024 for binary
		$dm = 3;
		$sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
		$i = floor(log($num) / log($k));
		return floatval(number_format($num / pow($k, $i),$dm)) . ' ' . $sizes[$i];
	}
?>
<table>
	<tr><td>Path: </td><td id='p_name'><?php echo $result["folder"] ?></td></tr>
	<tr><td>Type: </td><td id='p_type'><?php echo $result["type"] ?></td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr><td>Owner: </td><td id='p_owner'><?php echo $result["owner"] ?></td></tr>
	<tr><td>Permission: </td><td id='p_perm'><?php echo $result["perm"] ?></td></tr>
	<tr><td>Symlinks: </td><td id='p_syms'><?php echo $result["syms"] ?></td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr><td>Size: </td><td id='p_size'><?php echo format($result["size"]) ?></td></tr>
	<tr><td>Size on disk: </td><td id='p_size_disk'><?php echo format($result["size_disk"]) ?></td></tr>
	<tr><td>Last modified: </td><td id='p_date'><?php echo $result["date"] ?></td></tr>
</table>