window.settings = {
	easing: {
		seekbar: {
			time: 1000, //time in milliseconds
			type: "linear"
		},
		playlist: {
			time: 2000, //time in milliseconds
			type: "swing"
		},
		screensaver: {
			time: 1000 //time in milliseconds
		}
	},
	
	streams: [
		["Radio 2", "http://icecast.omroep.nl/radio2-bb-mp3"],
		["3FM", "http://icecast.omroep.nl/3fm-bb-mp3"],
		["Radio 10", "http://stream.radio10.nl/radio10"],
		["SkyRadio", "http://8593.live.streamtheworld.com/SKYRADIO_SC"],
		["Radio Veronica", "http://8503.live.streamtheworld.com:80/VERONICA.mp3"],
		["Slam FM", "http://vip-icecast.538.lw.triple-it.nl:80/SLAMFM_MP3"],
		["Arrow Classic Rock", "http://91.221.151.155:80/"]
	],
	
	textual: {
		song: {
			overflow: {
				wait: 20, //Wait in seconds
				scrollspeed: 4000, //Scrollspeed in milliseconds
				delay: 4000 //delay in milliseconds
			}
		}
	},
	
	title: {
		wait: 60 //Wait in seconds
	}, 
	
	hamburger: {
		addToggle: false
	}
};