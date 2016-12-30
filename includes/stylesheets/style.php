<?php
	header("Content-type: text/css");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/db.php");
	$theme = new Theme();
?>
/*
	Phoenix Music Player
	General stylesheet file
	
	This stylesheet houses all the general css code.
	Colors: http://www.color-hex.com/color-palette/11569 
	
	KevoSoftworks 2016
*/

/*
	FONTS
*/
	/* Cabin */
	@font-face{
		font-family: Cabin;
		src: url('/includes/fonts/cabin-regular-webfont.eot');
		src: url('/includes/fonts/cabin-regular-webfont.eot?#iefix') format('embedded-opentype'),
			 url('/includes/fonts/cabin-regular-webfont.woff2') format('woff2'),
			 url('/includes/fonts/cabin-regular-webfont.woff') format('woff'),
			 url('/includes/fonts/cabin-regular-webfont.ttf') format('truetype'),
			 url('/includes/fonts/cabin-regular-webfont.svg#cabinregular') format('svg');
		font-weight: normal;
		font-style: normal;
	}
	
	/* CaviarDreams */
	@font-face{
		font-family: CaviarDreams;
		src: url('/includes/fonts/CaviarDreams.ttf') format('truetype');
		font-weight: normal;
		font-style: normal;
	}

	/* Prototype */
	@font-face{
		font-family: Prototype;
		src: url('/includes/fonts/Prototype.ttf') format('truetype');
		font-weight: normal;
		font-style: normal;
	}
	
	
	
/*
	GENERAL PAGE DECLERATIONS
*/
	/* Html */
	html{
		background: url('/assets/background<?php echo $theme->color->dark; ?>.jpg') no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

	/* Body */
	body{
		font-family: Cabin;
		color: <?php echo $theme->color->text; ?>;
		margin: 0px 0px;
		padding: 0px 3%;
		overflow: hidden;
		cursor: default;
	}
	
	/* H1 Font */
	h1{
		color: <?php echo $theme->color->header; ?>;
		text-align: center;
		font-family: Prototype;
		font-weight: normal;
		margin: 0px 0px;
		overflow: hidden;
		white-space: nowrap;
	}
	
	/* H3 Font */
	h3{
		color: <?php echo $theme->color->text; ?>;
		text-align: center;
		font-weight: normal;
		margin: 0px 0px
	}
	
	/* H5 Font */
	h5{
		color: <?php echo $theme->color->subtext; ?>;
		text-align: center;
		font-weight: normal;
		margin: 0px 0px;
	}
	
	/* Unselectable Object */
	.unselectable {
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		-o-user-select: none;
		user-select: none;
		cursor: default;
		pointer-events: none;
	}
	
	/* Button */
	button{
		width: 48px;
		height: 48px;
		border: none;
		background-color: inherit;
		padding: 0 0 0 0;
		margin: 0 0 0 0;
		outline: none;
		cursor: pointer;
	}

	button::-moz-focus-inner{
		border: none;
	}
	
	/* Top Screen Title */
		#header{
			text-align: center;
		}
		
		.title{
			display: inline-block;
		}
		
		.settings{
			background-image: url("/assets/<?php echo $theme->color->dark; ?>/settings.png");
			background-size: 24px 24px;
			background-repeat: no-repeat;
			width: 24px;
			height: 24px;
		}


		
/*
	SCREENSAVER
*/
	/* Wrapper */
	#screensaver{
		width: 100%;
		height: 100%;
		position: absolute;
		z-index: 10000;
		top: 0;
		left: 0;
		background: inherit;
		overflow: hidden;
	}
	
	/* Image */
	.screensaver_img{
		width: 100%;
		height: auto;
		position: absolute;
	}
	


/*
	HAMBURGER MENUS
*/
	/* Left Hamburger */
		#hamburger_left{
			position: absolute;
			top: 0px;
			left: 0px;
			z-index: 49;
			width: 32px;
			height: 100%;
			background-image: url('/assets/hamburger_left_retracted.png');
			background-repeat: no-repeat;
			background-position: top right;
		}

		#hamburger_left.extended{
			background-image: url('/assets/hamburger_left_extended.png');
		}
	
	/* Right Hamburger */
		#hamburger_right{
			position: absolute;
			top: 0px;
			right: 0px;
			z-index: 50;
			width: 32px;
			height: 100%;
			background-image: url('/assets/hamburger_right_retracted.png');
			background-repeat: no-repeat;
			background-position: top left;
		}

		#hamburger_right.extended{
			background-image: url('/assets/hamburger_right_extended.png');
		}
	
	/* Hamburger Wrapper */
	.hamburger_wrap{
		height: 100%;
	}