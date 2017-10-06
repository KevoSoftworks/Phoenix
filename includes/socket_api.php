<?php
	//Socket API
	//Phoenix Player for Raspberry Pi
	//KevoSoftworks, 2015
	
	function systemCommand($cmd){
		exec($cmd . ">&1", $output);
		return $output;
	}
	
	function openSocket($host = "localhost", $port = "6600"){
		$socket = stream_socket_client("tcp://" . $host . ":" . $port, $errorno, $errorstr, 30);
		$response = readSocket($socket);
		if($response !== "") return $socket;
		return false;
	}
	
	function closeSocket($socket){
		sendSocket($socket, "close");
		fclose($socket);
	}
	
	function sendSocket($socket, $cmd){
		$cmd .= "\n";
		fputs($socket, $cmd);
	}
	
	function readSocket($socket){
		$output = "";
		if(!$socket) return;
		while(!feof($socket)){
			$response = fgets($socket, 1024);
			$output .= $response;
			if(strncmp("OK", $response, strlen("OK")) == 0){
				break;
			} else if(strncmp("ACK", $response, strlen("ACK")) == 0){
				$output = "readSocket: " . $response;
				break;
			}
		}
		return $output;
	}
	
	function _parsePlaylistResponse($data){
		$count = -1;
		$elements = explode("\n", $data);
		$result = array();
		foreach($elements as $elem){
			if(strpos($elem, ":") === false) continue;
			$key = explode(": ", $elem);
			if($key[0] === "file") $count++;
			$result[$count][$key[0]] = $key[1];
		}
		return $result;
	}
	
	function _parseStatusResponse($data){
		$elements = explode("\n", $data);
		foreach($elements as $elem){
			if(strpos($elem, ":") === false) continue;
			$key = explode(": ", $elem);
			$result[$key[0]] = $key[1];
		}
		if($result["state"] !== "stop"){
			$time = explode(":", $result["time"]);
			$result["time"] = array();
			
			if($time[1] > 0){
				$result["time"]["elapsed_percent"] = ($time[0] != 0 ? $percent = round((($time[0] * 100)/$time[1])*10000) / 10000 : 0);
				$result["time"]["elapsed"] = $time[0];
				$result["time"]["length"] = $time[1];
			} else {
				$result["time"]["elapsed_percent"] = 100;
				$result["time"]["elapsed"] = 0;
				$result["time"]["length"] = 0;
			}
			
			$audio = explode(":", $result["audio"]);
			$result["audio"] = array();
			$result["audio"]["sample_rate"] = $audio[0];
			$result["audio"]["depth"] = $audio[1];
			$result["audio"]["channels"] = $audio[2];
			$result["audio"]["bitrate"] = $result["bitrate"];
			
			unset($result["bitrate"]);
			unset($result["elapsed"]);
		}
		return $result;
	}
	
	function _parseListallResponse($data){
		$elements = explode("\n", $data);
		$result = array();
		foreach($elements as $elem){
			if(strpos($elem, ":") === false) continue;
			$key = explode(": ", $elem);
			$path = explode("/", $key[1]);
			
			if($key[0] === "file"){
				$myFile = $path[count($path) - 1];
				unset($path[count($path) - 1]);
			
				$root = &$result;

				while(count($path) > 1) {
					$branch = array_shift($path);
					if (!isset($root[$branch])) {
						$root[$branch] = array();
					}

					$root = &$root[$branch];
				}
				
				$root[$path[0]][] = $myFile;
			}
		}
		return $result;
	}
	
	function _parseSearchResponse($data){
		$elements = explode("\n", $data);
		$result = array();
		foreach($elements as $elem){
			if(strpos($elem, ":") === false) continue;
			$key = explode(": ", $elem);
			
			if($key[0] === "file"){
				$result[] = $key[1];
			}
		}
		return $result;
	}
	
	function _parseEq($data){
		$result = array();
		for($i = 0; $i < 10; $i++){
			preg_match('/([0-9]{2})/', $data[($i * 7)+5], $tmp);
			$result[$i] = $tmp[0];
		}
		return $result;
	}
	
	function clientInSameSubnet($client_ip=false,$server_ip=false) {
		if (!$client_ip)
			$client_ip = $_SERVER['REMOTE_ADDR'];
		if (!$server_ip)
			$server_ip = $_SERVER['SERVER_ADDR'];
		// Extract broadcast and netmask from ifconfig
		if (!($p = popen("ifconfig","r"))) return false;
		$out = "";
		while(!feof($p))
			$out .= fread($p,1024);
		fclose($p);
		// This is because the php.net comment function does not
		// allow long lines.
		$match  = "/^.*".str_replace(".", "\.", $server_ip);
		$match .= ".*Bcast:(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}).*?Mask:(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}).*$/im";
		if (!preg_match($match,$out,$regs))
			return false;
		$bcast = ip2long($regs[1]);
		$smask = ip2long($regs[2]);
		$ipadr = ip2long($client_ip);
		$nmask = $bcast & $smask;
		return (($ipadr & $smask) == ($nmask & $smask));
	}	
?>