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
	
	.material-icons{
		color: rgba(calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(0.54 + 0.46 * <?php echo $theme->color->dark;?>));
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
		max-width: 100vw;
	}

	/* Body */
	body{
		font-family: Cabin;
		color: <?php echo $theme->color->text; ?>;
		margin: 0px 0px;
		padding: 0px 3%;
		overflow: hidden;
		cursor: default;
		height: 100vh;
		max-width: 100vw;
	}
	
	/* Force inline */
	.inline{
		display: inline !important;
	}
	
	/* Force font-size 24px */
	.font24{
		font-size: 24px !important;
	}
	
	/* Force font-size 32px */
	.font32{
		font-size: 32px !important;
	}
	
	/* Force font-size 48px */
	.font48{
		font-size: 48px !important;
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
		}
	
	/* Right Hamburger */
		#hamburger_right{
			position: absolute;
			top: 0px;
			right: 0px;
			z-index: 50;
			width: 32px;
			height: 100%;
		}
	
	/* Hamburger Wrapper */
	.hamburger_wrap{
		height: 100%;
	}
	
	/* Hamburger Buttons */
	.hamburger_button{
		position: absolute;
		width: 32px;
		height: 0px;
	}
	
	.hamburger_button i{
		vertical-align: middle;
		position: relative;
		top: -5px;
	}
	
	.hamburger_text{
		display: block;
	}
	
	#hamburger_left .hamburger_button{
		right: 0;
		margin-top: 105.35px;
	}
	
	#hamburger_right .hamburger_button{
		left: 0;
	}
	
	#hamburger_left .hamburger_text{
		transform: rotate(-90deg);
		transform-origin: 0% 0%;
		-ms-transform: rotate(-90deg);
		-ms-transform-origin: 0% 0%;
		-webkit-transform: rotate(-90deg);
		-webkit-transform-origin: 0% 0%;
	}
	
	#hamburger_right .hamburger_text{
		transform: rotate(90deg);
		-ms-transform: rotate(90deg);
		-webkit-transform: rotate(90deg);
	}