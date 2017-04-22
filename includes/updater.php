<?php
	class Updater{		
		public $manifest;
		public $update_manifest;
		
		function __construct(){
			$man = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/manifest.json");
			$this->manifest = (Array)json_decode($man);
			
			$man = file_get_contents($this->manifest["update-manifest"]);
			$this->update_manifest = (Array)json_decode($man);
		}
		
		function getCurrentVersion(){
			return $this->manifest["version"];
		}
		
		function getCurrentDate(){
			return $this->manifest["version-date"];
		}
		
		function getNewVersion(){
			return $this->update_manifest["update_ver"];
		}
		
		function hasUpdate(){
			if(version_compare($this->getNewVersion(), $this->getCurrentVersion()) == 1){
				return true;
			} else {
				return false;
			}
		}
		
		function executeUpdate($force = false){
			if(!$force && !$this->hasUpdate()) return false;
			
			exec("sudo mkdir /var/www/tmp");
			exec("sudo chmod 777 /var/www/tmp");
			
			foreach($this->update_manifest["update_path"] as $version){
				if(version_compare($version, $this->getCurrentVersion()) == 1){
					$up_path[] = $version;
					file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/tmp/phoenix_" . $version . ".zip", fopen("http://kevosoftworks.com/update/phoenix/" . $this->update_manifest["update_location"] . "/phoenix_" . $version . ".zip", "r"));
					exec("sudo mkdir /var/www/tmp/" . $version);
					exec("sudo unzip /var/www/tmp/phoenix_" . $version . ".zip -d /var/www/tmp/" . $version);
					exec("sudo cp -a -u -R /var/www/tmp/" . $version . "/. /var/www");
				}
			}
			
			exec("sudo rm -rf /var/www/tmp");
			return true;
		}
	}
?>