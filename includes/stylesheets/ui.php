<?php
	header("Content-type: text/css");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/db.php");
	$theme = new Theme();
?>
/*
	Phoenix Music Player
	User Interface stylesheet file
	
	This stylesheet houses all the css code with regards to the visual appearance of the user interface: Menus, Popups and the logo.
	
	KevoSoftworks 2016
*/

/*
	LOGO
*/
	/* Logo Wrapper */
	#phoenix_logo_fullscreen{
		width: 100%;
		height: 100%;
		padding: 0 0 0 0;
		margin: 0 0 0 0;
		position: absolute;
		background-color: <?php echo $theme->color->background; ?>;
		z-index: 100000;
		top: 0;
		left: 0;
		color: <?php echo $theme->color->header; ?>;
		text-align: center;
		font-family: Prototype;
	}

	/* Logo Image */
	.logo_fullscreen{
		width: auto;
		height: 30%;
		display: block;
		margin: 0 auto;
	}
	
	
	
/* 
	RIGHT CLICK MENU
*/
	/* Wrapper */
	.rcm{
		position: absolute;
		z-index: 100;
		background-color: #292323;
		border: 1px solid <?php echo $theme->color->border; ?>;
		color: white;
		width: 250px;
	}
	
	/* Item Wrapper */
	.rcm_item{
		cursor: pointer;
		padding: 3px 25px;
		height: 28px;
		white-space: nowrap;
		line-height: 24px;
		border-collapse: collapse;
	}
	
	/* Item Wrapper Hovering */
	.rcm_item:hover{
		background-color: <?php echo $theme->color->accent; ?>;
	}

	/* Icon */
	.rcm_icon{
		height: 16px;
		width: 16px;
		vertical-align: middle;
	}

	
	
/*
	POPUP
*/
	/* Wrapper */
	.popup{
		position: absolute;
		z-index: 99;
		background-color: #292323;
		border: 1px solid <?php echo $theme->color->border; ?>;
		color: white;
		max-width: 600px;
		max-height: 95%;
		font-size: 14px;
		padding: 0 0;
		margin: 0 0;
	}
	
	/* Header Wrapper */
	.popup_header{
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		background-color: <?php echo $theme->color->border; ?>;
		font-size: 24px;
		text-align: center;
		color: <?php echo $theme->color->header; ?>;
	}
	
	/* Content Area */
	.popup_content{
		top: 31px;
		text-align: center;
		position: relative;
		overflow-y: auto;
		padding: 5px 30px;
	}
	
	/* Footer Wrapper */
	.popup_footer{
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
	}
	
	/* Button */
	.popup_button{
		cursor: pointer;
		padding: 3px 25px;
		height: 28px;
		white-space: nowrap;
		line-height: 24px;
		border-collapse: collapse;
		text-align: center;
	}

	/* Button Hovering */
	.popup_button:hover{
		background-color: <?php echo $theme->color->accent; ?>;
	}

/*
	Content
*/
	/* Content button */
	.content-button{
		border: 0.5px solid <?php echo $theme->color->accent; ?>;
		background-color: <?php echo $theme->color->background; ?>;
		color: <?php echo $theme->color->text; ?>;
		padding: 10px 15px;
		display: inline-block;
	}
	
	.content-button:hover{
		background-color: <?php echo $theme->color->border; ?>;
	}