<?php
	header("Content-type: text/css");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/db.php");
	$theme = new Theme();
?>
/*
	Phoenix Music Player
	Playlist stylesheet file
	
	This stylesheet houses all the css code with regards to the visual appearance of the playlist.
	
	KevoSoftworks 2016
*/

/* Playlist Wrapper */
#playlist_wrap{
	height: 100%;
	overflow: hidden;
	margin-left: 32px;
	white-space: nowrap;
	position: relative;
	background-color: <?php echo $theme->color->background; ?>;
}

/* Playlist Information Bar */
#playlist_info{
	background-color: <?php echo $theme->color->background; ?>;
	width: 100%;
	text-align: center;
	position: relative;
	z-index: 5;
	padding-top: 24px;
}

/* Playlist Information Bar Head Text */
#playlist_info h2{
	margin: 0px;
	color: <?php echo $theme->color->header; ?>;
}

/* Playlist Information Bar Subtext */
#playlist_info h4{
	margin-top: 0px;
	color: <?php echo $theme->color->subtext; ?>;
}

/* Actual Play List */
.playlist{
	padding: 0 0 0 0;
	margin: 0 0 0 0;
	width: 100%;
	position: relative;
	z-index: 3;
}

/* Song Item */
.playlist_song{
	border: 1px solid <?php echo $theme->color->border; ?>;
	border-collapse: collapse;
	background-color: <?php echo $theme->color->background; ?>;
	cursor: pointer;
	padding: 1px 5px;
	overflow-x: hidden;
}

/* Song Item Title */
.playlist_song_title{
	color: <?php echo $theme->color->text; ?>;
}

/* Song Item Artist */
.playlist_song_artist{
	color: <?php echo $theme->color->subtext; ?>;
}

/* Currently Playing Song Item */
.playlist_selected{
	background-color: <?php echo $theme->color->border; ?>;
}

/* Delete Current Playlist Button */
.playlist_clear{
	background-image: url("/assets/<?php echo $theme->color->dark; ?>/clear.png");
	background-size: 48px 48px;
	background-repeat: no-repeat;
}