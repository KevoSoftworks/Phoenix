<?php
	include_once("db.php");
	$settings = new Settings();
?>

window.settings = {
	easing: {
		seekbar: {
			time: 1000, //time in milliseconds
			type: "linear"
		},
		playlist: {
			time: 2000, //time in milliseconds
			type: "swing"
		},
		screensaver: {
			time: 1000 //time in milliseconds
		}
	},
	
	streams: [
		<?php
			$query = $settings->db->query("SELECT id, name, url FROM streams ORDER BY name");
			while($res = $query->fetchArray(SQLITE3_ASSOC)){
				echo "['" . $res["name"] . "', '" . $res["url"] . "', " . $res["id"] . "],";
			}
			echo "['', '', '']";
		?>
	],
	
	textual: {
		song: {
			overflow: {
				wait: 20, //Wait in seconds
				scrollspeed: 4000, //Scrollspeed in milliseconds
				delay: 4000 //delay in milliseconds
			}
		}
	},
	
	title: {
		wait: 60 //Wait in seconds
	}, 
	
	hamburger: {
		addToggle: false,
		openOnHover: <?php echo $settings->getNode("pref.sidebar.hover")["value"]; ?>
	},
	
	albumart: {
		doLoad: <?php echo $settings->getNode("pref.albumart")["value"]; ?>
	}
};