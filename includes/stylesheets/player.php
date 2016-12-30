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
		padding: 64px 32px 0px 32px;
		position: relative;
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
		
		/* Previous Song Button*/
		.prev{
			background-image: url("/assets/<?php echo $theme->color->dark; ?>/prev.png");
			background-size: 48px 48px;
			background-repeat: no-repeat;
		}
		
		/* Next Song Button*/
		.next{
			background-image: url("/assets/<?php echo $theme->color->dark; ?>/next.png");
			background-size: 48px 48px;
			background-repeat: no-repeat;
		}
		
		/* Play Button */
		.play{
			background-image: url("/assets/<?php echo $theme->color->dark; ?>/play.png");
			background-size: 48px 48px;
			background-repeat: no-repeat;
		}
		
		/* Pause Button */
		.pause{
			background-image: url("/assets/<?php echo $theme->color->dark; ?>/pause.png") !important;
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
		/* Holder div (wrapper wrap) */
		#eq_control{
			overflow-x: auto;
			overflow-y: hidden;
			height: 140px;
			white-space: nowrap;
			margin-top: 10px;
		}
		
		/* Wrapper div */
		.eq_control_wrap{
			margin-left: calc(-0.075*(720px - 100%));
		}

		/* Sliders */
		input[type="range"]{
			width: 120px;
			margin-top: 40px;
			-webkit-transform: rotate(-90deg);
			-moz-transform:rotate(-90deg);
			-o-transform:rotate(-90deg);
			-ms-transform:rotate(-90deg);
			transform:rotate(-90deg);
		}

		/* Slider Wrappers */
		.eq_range_wrap{
			margin: 0 0 0 0;
			padding: 0 0 0 0;
			max-width: calc((100% - 99px) / 10);
			margin: 10px -1px 0px;
			display: inline-block;
		}
		
		/* Slider Text */
		.eq_range_wrap span{
			margin-left: 55px;
			display: inline-block;
			margin-top: 45px;
		}