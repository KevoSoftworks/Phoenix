<?php
	require_once("includes/db.php");
	require_once("includes/socket_api.php");
	require_once("includes/updater.php");
	header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	$debug_hidden = "display:none;";
	
	$settings = new Settings();
	$updater = new Updater();
	
	$name = $settings->getNode("pref.name")["value"];
	$theme = new Theme();
	
	if(isset($_GET["debug"])){
		$debug_hidden = "";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<script src='includes/settings.js.php?<?php echo $updater->getCurrentVersion() ?>'></script>
		<script src='includes/jquery.js?<?php echo $updater->getCurrentVersion() ?>'></script>
		<script src='includes/jquery-ui.js?<?php echo $updater->getCurrentVersion() ?>'></script>
		<script src='includes/api.js?<?php echo $updater->getCurrentVersion() ?>'></script>
		
		<script src='includes/scripts/ui.js?<?php echo $updater->getCurrentVersion() ?>'></script>
		
		<!-- This should be moved to the settings.js.php file -->
		<script type="text/javascript">
			window.themedark = "<?php echo $theme->color->dark; ?>";
			window.context = JSON.parse('<?php echo trim(preg_replace('/\s+/', ' ', file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/includes/context/context.json")));?>');
			window.update = {"update": <?php echo ($updater->hasUpdate() ? 'true' : 'false') ?>, "new-ver": "<?php echo $updater->getNewVersion()?>"};
			<?php
				if(isset($_GET["changelog"])){
					echo "$(document).ready(function(){popup('change'); window.history.pushState(null, 'Phoenix', '/')});";
				}
			?>
		</script>
		
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/style.php?<?php echo $updater->getCurrentVersion() ?>' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/player.php?<?php echo $updater->getCurrentVersion() ?>' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/ui.php?<?php echo $updater->getCurrentVersion() ?>' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/folder.php?<?php echo $updater->getCurrentVersion() ?>' />
		<link rel='stylesheet' type='text/css' href='includes/stylesheets/playlist.php?<?php echo $updater->getCurrentVersion() ?>' />
		
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
				<button class='hamburger_button' onClick="toggle_hamburger_left()"><span class='hamburger_text'><h5 class='inline font24'>Library</h5><i class="material-icons inline font32 hamburger_icon_left">arrow_downward</i></span></button>
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
				<button class='hamburger_button' onClick="toggle_hamburger_right()"><span class='hamburger_text'><i class="material-icons inline font32 hamburger_icon_right">arrow_downward</i><h5 class='inline font24'>Playlist</h5></span></button>
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
				<div id='albumart'>
					
				</div>
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
					<button class='shuffle' onClick="shuffle()"><i class='material-icons font48'>shuffle</i></button>
					<button class='prev' onClick="prev()"><i class="material-icons font48">skip_previous</i></button>
					<button class='play' onClick="play()"><i class="material-icons font48">play_circle_filled</i></button>
					<button class='next' onClick="next()"><i class="material-icons font48">skip_next</i></button>
					<button class='repeat' onClick="repeat()"><i class="material-icons font48">repeat</i></button>
				</div>
				<div id="volume_control">
					<button class='vol_min' onClick="vol(-1)"></button>
					<div class='vol_vol' id="vol_vol"></div>
					<button class='vol_plus' onClick="vol(1)"></button>
				</div>
			</div>
			
			<div id="content1">
				
			</div>
		</section>
	</body>
</html>