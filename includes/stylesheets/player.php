<?php
	header("Content-type: text/css");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/db.php");
	$theme = new Theme();
?>
/*
	Phoenix Music Player
	Player controls stylesheet file
	
	This stylesheet houses all the css code with regards to the visual appearance of the music player controls like the seeker timebar, play and volume buttons and graphic equaliser.
	
	KevoSoftworks 2016
*/

/*
	GENERAL INFORMATION
*/
	/* Content wrapper */
	#currently_playing{
		max-width: 720px;
		margin-top: 0px;
		margin-left: auto;
		margin-right: auto;
		padding: 16px 32px 0px 32px;
		position: relative;
	}
	
	/* Album Art */
	#albumart{
		height: 25vh;
		width: 25vh;
		margin: auto;
	}
	
	#albumart img, #albumart i{
		height: 25vh;
		width: 25vh;
		display: block;
		margin: auto;
		font-size: 25vh !important;
		background-color: <?php echo $theme->color->background; ?>;
		border: 2px solid <?php echo $theme->color->accent; ?>;
	}
	
	/* Song information */
	#song{
		margin-bottom: 7px;
	}

	/* Artist information */
	#artist{
		margin-bottom: 15px;
	}


	
/*
	TIMEBAR/SEEKER
*/
	/* Timebar wrapper */
	#timebar_wrapper{
		width: 100%;
		height: 30px;
		background-color: <?php echo $theme->color->background; ?>;
		position: relative;
		cursor: default;
	}

	/* Moving timebar */
	#timebar{
		background-color: <?php echo $theme->color->accent; ?>;
		height: 100%;
	}
	
	/* Text styling */
	.timebar_time{
		position: absolute;
		line-height: 30px;
		vertical-align: middle;
	}
	
	/* Current time */
	#timebar_current{
		left: 0;
		margin-left: 5px;
	}

	/* Song length */
	#timebar_max{
		right: 0;
		margin-right: 5px;
	}

	
	
/*
	CONTROL SURFACES
*/
	/* 
		SELECTION
	*/
		/* Button wrapper */
		#song_control{
			text-align: center;
			margin-top: 8px;
		}
		
		/* Button not active */
		.btn-non-active{
			color: rgba(calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(0.26 + 0.04 * <?php echo $theme->color->dark;?>)) !important;
		}
		
		.btn-non-active i{
			color: rgba(calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(0.26 + 0.04 * <?php echo $theme->color->dark;?>)) !important;
		}
		
		/* Previous, Next, Play, Pause, Shuffle and Repeat Buttons*/
		.prev, .next, .play, .pause, .shuffle, .repeat, .repeat-one{
			color: rgba(calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(255 * <?php echo $theme->color->dark; ?>), calc(0.54 + 0.46 * <?php echo $theme->color->dark;?>));
		}
	
	/*
		VOLUME
	*/
		/* Button Wrapper */
		#volume_control{
			display: flex;
			align-items: center;
			justify-content: center;
			height: 48px;
		}
		
		/* Volume Indicator */
		#vol_vol{
			display: inline-block;
			font-size: 25px;
		}
		
		/* Decrease Volume Button */
		.vol_min{
			background-image: url("/assets/<?php echo $theme->color->dark; ?>/minus.png");
			background-size: 48px 48px;
			background-repeat: no-repeat;
			vertical-align: text-bottom;
		}
		
		/* Increase Volume Button */
		.vol_plus{
			background-image: url("/assets/<?php echo $theme->color->dark; ?>/plus.png");
			background-size:48px 48px;
			background-repeat: no-repeat;
			vertical-align: text-bottom;
		}
	
	/*
		GRAPHIC EQUALISER
	*/
		
		/* Wrapper div */
		.eq_control_wrap{
			width: 100%;
		}
		
		.eq_control_wrap td, .eq_control_wrap th{
			padding: 0 0 0 0;
			height: 40px;
		}

		/* Sliders */
		input[type="range"]{
			width: 100%;
			margin: 0 0 0 0;
		}