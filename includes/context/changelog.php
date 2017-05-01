<?php
	require_once("../updater.php");
	$updater = new Updater();
?>

==Phoenix Music Player Changelog==<br/>
+Current Version: <?php echo $updater->getCurrentVersion(); ?>+<br/>
-Build Date: <?php echo $updater->getCurrentDate(); ?>-<br/>
<br/>
+ are additions<br/>
= are fixes<br/>
- are removals<br/>
..........................<br/>
Version 0.0.11, unknown:<br/>
+Update finalisation for i.e. database management<br/>
+Pref.albumart and pref.sidebar.hover settings<br/>
+Generic album art image<br/>
=Some album art not being handled properly<br/>
<br/>
Version 0.0.10, 22-04-2017:<br/>
+Reintroduced the Personalisation settings<br/>
+Album art for compatible songs via Last.fm<br/>
=RCM persisting on touch devices<br/>
=RCM falling off-screen when the cursor is too close to a screen edge<br/>
=Moved the graphic EQ to the settings menu<br/>
=Proper user groups being set after update<br/>
<br/>
Version 0.0.9, 22-04-2017:<br/>
+Better updater API<br/>
=Hardcoded version numbers<br/>
=Caching problems after updates<br/>
<br/>
Version 0.0.8, 21-04-2017:<br/>
+Added shuffle and repeat/repeat-one buttons<br/>
=Graphic EQ now scales differently, allowing more precision in higher boosts<br/>
<br/>
Version 0.0.7, 03-01-2017:<br/>
=Redirects after updates<br/>
=Playlist still opening after adding song on mobile devices<br/>
=No confirmation of adding song when searching<br/>
<br/>
Version 0.0.6, 02-01-2017:<br/>
+Confirmation after adding a song or folder<br/>
=Disabled playlist opening after adding a song or folder (toggable in the future)<br/>
=RCMs close when a button has been pressed<br/>
=Spaces were always parsed as play/pause, instead of text inputs<br/>
-Screensaver<br/>
<br/>
Version 0.0.5, 10-09-2016:<br/>
+Space to toggle play/pause<br/>
=Wrong URI conversion breaking Play All command<br/>
<br/>
Version 0.0.4, 06-09-2016:<br/>
+Updater<br/>
<br/>
Version 0.0.3, 20-08-2016:<br/>
=Folder properties now use the new popup system<br/>
=Fixed title issue in playlist where everything after a dot got filtered, instead of the last dot<br/>
=Fixed artist issue in playlist where it was undefined instead of Unknown<br/>
=When playback is stopped, the title and artist now say Nothing and No-one<br/>
-Temporarily removed the Audio, Player and Personalisation settings due to not being properly implemented<br/>
<br/>
Version 0.0.2, 19-08-2016:<br/>
=Better support for popup boxes<br/>
<br/>
Version 0.0.1, 09-06-2016:<br/>
+Initial release<br/>