<?php
	header("Content-type: text/css");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/db.php");
	$theme = new Theme();
?>

/*
	Phoenix Music Player
	Folder stylesheet file
	
	This stylesheet houses all the css code with regards to the visual appearance of the folder sidebar.
	
	KevoSoftworks 2016
*/

/* Wrapper */
#folders_wrap{
	height: 100%;
	overflow-x: hidden;
	overflow-y: auto;
	margin-right: 32px;
	white-space: nowrap;
	position: relative;
	background-color: <?php echo $theme->color->background; ?>;
}

/* Folder List */
#folders{
	
}

/* Folder Item for regular view */
.folder{
	min-height: 32px;
	border: 1px solid <?php echo $theme->color->border; ?>;
	padding-left: 35px;
	line-height: 32px;
	vertical-align: center;
	cursor: pointer;
	overflow-x: hidden;
}

/* Folder Item for search query */
.folder_alt{
	min-height: 32px;
	border: 1px solid <?php echo $theme->color->border; ?>;
	padding-left: 35px;
	vertical-align: center;
	cursor: pointer;
	overflow-x: hidden;
}

/* Folder Item Hovering */
.folder:hover,.folder_alt:hover{
	background-color: <?php echo $theme->color->accent; ?>;
}

/* Folder Song Specification */
.folder_song{
	background-image: url("/assets/<?php echo $theme->color->dark; ?>/music.png");
	background-size: 32px 32px;
	background-repeat: no-repeat;
}

/* Folder Song Extra Information (for search query) */
.folder_song_extra{
	margin: 0 0 0 0;
	padding: 0 0 0 0;
	font-size: 8px;
	color: <?php echo $theme->color->border; ?>;
}

/* Folder Directory Specification */
.folder_dir{
	background-image: url("/assets/<?php echo $theme->color->dark; ?>/dir.png");
	background-size: 32px 32px;
	background-repeat: no-repeat;
	width: calc(100% - 35px);
	display: inline-block;
	margin-left: -35px;
	padding-left: 35px;
}

/* Folder Directory Hamburger Icon */
.folder_dir_playall{
	width: 32px;
	display: inline-block;
	background-image: url("/assets/<?php echo $theme->color->dark; ?>/hamburger.png");
	background-size: 32px 32px;
	background-repeat: no-repeat;
}

/* Folder Update Item */
.folder_update{
	margin-top: 10px;
	background-image: url("/assets/<?php echo $theme->color->dark; ?>/refresh.png");
	background-size: 32px 32px;
	background-repeat: no-repeat;
}

/* Folder Back Item */
.folder_back{
	background-image: url("/assets/<?php echo $theme->color->dark; ?>/back.png");
	background-size: 32px 32px;
	background-repeat: no-repeat;
}