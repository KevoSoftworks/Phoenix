<?php
	require_once("includes/db.php");
	require_once("includes/socket_api.php");
	header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	$debug_hidden = "display:none;";
	
	$settings = new Settings();
	
	$name = $settings->getNode("pref.name")["value"];
	$theme = new Theme();
	
	if(isset($_GET["debug"])){
		$debug_hidden = "";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<script src='includes/settings.js'></script>
		<script src='includes/jquery.js'></script>
		<script src='includes/jquery-ui.js'></script>
		<script src='includes/api.js'></script>
		
		<script src='includes/scripts/ui.js'></script>
		
		<script type="text/javascript">
			window.themedark = "<?php echo $theme->color->dark; ?>";
			window.context = JSON.parse('<?php echo trim(preg_replace('/\s+/', ' ', file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/includes/context/context.json")));?>');
		</script>
		
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/style.php' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/player.php' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/ui.php' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/folder.php' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/playlist.php' />
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
		<link rel="shortcut icon" type="image/png" href="assets/logo.png"/>
		<title><?php echo $name ?> Music Player</title>
	</head>
	
	<body>
		<div id="main">
			<div id="phoenix_logo_fullscreen">
				<img class='logo_fullscreen' src='assets/logo.png'/><br/>
				<h1>Music Player</h1>
				<h3 id="phoenix_logo_status">Loading assets...</h3>
				<img src='assets/loading.gif' />
			</div>
			
			<div id="hamburger_left">
				<button style="height: 115px; position: absolute; right: 0" onClick="toggle_hamburger_left()"></button>
				<div class='hamburger_wrap'>
					<div id="folders_wrap">
						<div id="folder_wrap_2">
							<?php if(isset($_GET["debug"])){?>Command: <input type="text" id="shellcommand" /><button onClick="shellCmd()">Send Command</button><?php }?>
							<h3>Library:</h3>
							<input type='text' id='lib_query' placeholder='Enter a search query' style='width: 100%; height: 24px; font-size: 18px'/><br/><br/>
							<div id="folders">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="hamburger_right">
				<button style='height: 135px; position: absolute; left: 0' onClick="toggle_hamburger_right()"></button>
				<div id="playlist_wrap">
					<div id="playlist_info">
						<h2>Current Playlist</h2>
						<h4><span id="playlist_current"></span>/<span id="playlist_max"></span></h4>
						<button class='playlist_clear' onClick="clearPlaylist()"></button>
					</div>
					<div id='playlist' class="playlist">
						
					</div>
				</div>
			</div>
			
			<div id="header">
				<h1 class='title'><?php echo $name ?><button class='settings' onclick='rightClickMenu("settings")'></button></h1>
			</div>
			
			<div id="currently_playing">
				<br/>
				<h5>Currently Playing:</h5>
				<h1 id="song"></h1>
				<h5>By:</h5>
				<h3 id="artist"></h3>
				<h5 id="audio_info"></h5>
				<h5 style="<?php echo $debug_hidden; ?>" id='phoenix_info'>Data</h5>
				<div id="timebar_wrapper">
					<div class='timebar_time unselectable' id="timebar_current"></div>
					<div class='timebar_time unselectable' id="timebar_max"></div>
					<div id="timebar" style="width: 0px"></div>
				</div>
				<div id="song_control">
					<button class='prev' onClick="prev()"></button>
					<button class='play' onClick="play()"></button>
					<button class='next' onClick="next()"></button>
				</div>
				<div id="volume_control">
					<button class='vol_min' onClick="vol(-1)"></button>
					<div class='vol_vol' id="vol_vol"></div>
					<button class='vol_plus' onClick="vol(1)"></button>
				</div>
				<div id='eq_control'>
					<div class='eq_control_wrap'>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_1' data-eq='01. 31 Hz' min='0' max='100'/><br/>
							<span>31</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_2' data-eq='02. 63 Hz' min='0' max='100'/><br/>
							<span>63</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_3' data-eq='03. 125 Hz' min='0' max='100'/><br/>
							<span>125</span>							
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_4' data-eq='04. 250 Hz' min='0' max='100'/><br/>
							<span>250</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_5' data-eq='05. 500 Hz' min='0' max='100'/><br/>
							<span>500</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_6' data-eq='06. 1 kHz' min='0' max='100'/><br/>
							<span>1k</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_7' data-eq='07. 2 kHz' min='0' max='100'/><br/>
							<span>2k</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_8' data-eq='08. 4 kHz' min='0' max='100'/><br/>
							<span>4k</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_9' data-eq='09. 8 kHz' min='0' max='100'/><br/>
							<span>8k</span>
						</div>
						<div class='eq_range_wrap'>
							<input type='range' id='eq_10' data-eq='10. 16 kHz' min='0' max='100'/><br/>
							<span>16k</span>
						</div>
					</div>
				</div>
			</div>
			
			<div id="content1">
				
			</div>
		</section>
	</body>
</html>