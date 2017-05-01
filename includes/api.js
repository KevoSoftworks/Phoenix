$(document).ready(function(){
	window.currentSongNum = -2;
	window.currentFolder = "window.folders.global";
	window.dbUpdate = false;
	window.canShellCommand = true;
	window.hasLogo = true;
	window.errorCount = 0;
	window.noAction = 0;
	window.timebarIsDragging = false;
	window.overflowSecs = 0;
	window.secsRunning = 0;
	window.hamburger_right_is_running = false;
	window.hamburger_right_state = 0;
	window.hamburger_left_is_running = false;
	window.hamburger_left_state = 0;
	window.isGettingPlaylist = false;
	window.forceTitle = false;
	
	window.title = {
		queue: [],
		current: "",
		canAlter: true
	}
	
	$("#phoenix_logo_status").text("Readying code...");
	
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
		window.isMobile = true;
		$("#folder_wrap_2").css("padding", "2px 5px");
	} else {
		window.isMobile = false;
		$("#folder_wrap_2").css("padding", "20px 50px");
	}
	
	setInterval(function(){
		if(window.title.current === "" && window.title.queue.length > 0){
			window.title.canAlter = false;
			window.title.current = window.title.queue.shift();
		} else if(window.title.current !== ""){
			document.title = window.title.current;
			window.title.current = window.title.current.substring(1);
		} else {
			window.title.canAlter = true;
		}
		
		if(window.noAction == 60 && !window.rcm){
			$("#hamburger_left").trigger("mouseleave");
			$("#hamburger_right").trigger("mouseleave");
		}
		
		if(!window.hasLogo && window.errorCount > 5){
			(($(window).height() * 0.8) - 128) < 900 ? $(".logo_fullscreen").height(($(window).height() * 0.8) - 128) : $(".logo_fullscreen").height(900);
			$("#phoenix_logo_fullscreen").fadeIn();
			$("#phoenix_logo_fullscreen").height($(document).height());
			window.hasLogo = true;
			if(window.forceTitle) setTimeout(function(){window.forceTitle = false}, 2000);
		}
		
		$("#phoenix_info").text("time: " + window.secsRunning + "; of: " + window.overflowSecs + "; noA: " + window.noAction + "; ec: " + window.errorCount + "; cs: " + window.currentSongNum + "; tcl: " + window.title.queue.length + "; m: " + window.isMobile + ";");
		$("#content1").css('max-height',$(window).height() - $("#currently_playing").height());
	},250);
	
	$("#content1").css('max-height',$(window).height() - $("#currently_playing").height());
	
	$("#phoenix_logo_fullscreen").height($(document).height());
	(($(window).height() * 0.8) - 128) < 900 ? $(".logo_fullscreen").height(($(window).height() * 0.8) - 128) : $(".logo_fullscreen").height(900);
	
	$("#phoenix_logo_status").text("Checking for updates...");
	if(window.update.update) popup("update_avail", "ver=" + window.update["new-ver"]);
	
	
	$("#phoenix_logo_status").text("Connecting...");
	setInterval(function(){
		if(window.errorCount != 0 && (window.errorCount < 5 || window.errorCount > 15)){
			$("#phoenix_logo_status").text("Reconnecting...");
		}
		window.secsRunning++;
		window.noAction++;
		$.ajax({
			url: "/requests/mpd.php",
			type: "GET",
			data: {cmd: "current"},
			timeout: 1750,
			success: function(data){
				if(data.stat){
					if(!window.forceTitle) window.errorCount = 0;
					response = data.result;
					window.state = response[0];
					window.currentSong = response[1];
					
					$("#vol_vol").text(response[0].volume);
					
					if(response[0].state === "play"){
						$(".play").addClass("pause");
						$(".play .material-icons").text("pause_circle_filled");
						
						if(!window.timebarIsDragging) $("#timebar_current").text(toTimestamp(response[0].time.elapsed));
						$("#timebar_max").text(toTimestamp(response[0].time.length));
						if(!window.timebarIsDragging) $("#timebar").stop().animate({"width": response[0].time.elapsed_percent + "%"}, {"duration": window.settings.easing.seekbar.time, "easing": window.settings.easing.seekbar.type});
						$("#song").text(response[1][0].Title);
						if(window.title.canAlter) document.title = "Phoenix - " + response[1][0].Title;
						if(window.secsRunning % window.settings.title.wait == 0){
							titleQueueAdd("Phoenix - Currently playing: " + response[1][0].Title + " - " + response[1][0].Artist);
						}
						$("#artist").text(response[1][0].Artist);
						$("#audio_info").text("Bitrate: " + response[0].audio.bitrate + " kbps; Sample Rate: " + response[0].audio.sample_rate + " Hz");
						$("#playlist_current").text(parseInt(response[0].song) + 1);
						if(window.currentSongNum !== window.currentSong[0].Pos && !window.songIsChanging){
							changePlaylistSelected(window.currentSongNum, window.currentSong[0].Pos);
							window.currentSongNum = window.currentSong[0].Pos;
							getAlbumArt();
						}
					} else if(response[0].state === "pause"){
						$(".play").removeClass("pause");
						$(".play .material-icons").text("play_circle_filled");
						
						if($("#song").text().length < 2){
							$("#song").text("Paused");
						}
						$("#artist").text("Playback is currently paused");
						if(!window.timebarIsDragging) $("#timebar_current").text(toTimestamp(response[0].time.elapsed));
						$("#timebar_max").text(toTimestamp(response[0].time.length));
						if(!window.timebarIsDragging) $("#timebar").stop().animate({"width": response[0].time.elapsed_percent + "%"}, {"duration": window.settings.easing.seekbar.time, "easing": window.settings.easing.seekbar.type});
						$("#audio_info").text("Bitrate: " + response[0].audio.bitrate + " kbps; Sample Rate: " + response[0].audio.sample_rate + " Hz");
					} else {
						$(".play").removeClass("pause");
						$(".play .material-icons").text("play_circle_filled");
						
						if(!window.timebarIsDragging) $("#timebar_current").text(toTimestamp(0));
						$("#timebar_max").text(toTimestamp(0));
						if(!window.timebarIsDragging) $("#timebar").stop().animate({"width": 100 + "%"}, {"duration": window.settings.easing.seekbar.time, "easing": window.settings.easing.seekbar.type});
						$("#song").text("Nothing");
						$("#artist").text("No-one");
						$("#audio_info").text("");
						$("#playlist_current").text(0);
						if(window.currentSongNum > -1 && $(".playlist_song").length > 0){
							changePlaylistSelected(window.currentSongNum, 0);
							$("#playlist_song_0").removeClass("playlist_selected");
							window.currentSongNum = -1;
						}
					}
					
					if(typeof response[0]["updating_db"] != "undefined"){
						window.dbUpdate = true;
						$("#artist").text("-- Database is Updating --");
					}
					
					if(window.dbUpdate && typeof response[0]["updating_db"] == "undefined"){
						window.dbUpdate = false;
						fillFolders();
					}
					
					$("#playlist_max").text(response[0].playlistlength);
					
					if(response[0].playlistlength != $(".playlist_song").length && !window.isGettingPlaylist){
						fillPlaylist();
					}
					
					if(parseInt(response[0].random) == 1){
						$(".shuffle").removeClass("btn-non-active");
					} else {
						$(".shuffle").addClass("btn-non-active");
					}
					
					if(parseInt(response[0].repeat) == 1){
						$(".repeat").removeClass("btn-non-active");
					} else {
						$(".repeat").addClass("btn-non-active");
					}
					
					if(parseInt(response[0].single) == 0){
						$(".repeat").removeClass("repeat-one");
						$(".repeat .material-icons").text("repeat");
					} else {
						$(".repeat").addClass("repeat-one");
						$(".repeat .material-icons").text("repeat_one");
					}
					
					if(window.hasLogo && window.errorCount == 0){
						$("#phoenix_logo_fullscreen").fadeOut();
						window.hasLogo = false;
					}
					
					if($("#song").overflown() && window.overflowSecs >= window.settings.textual.song.overflow.wait){
						window.overflowSecs = 0;
						$("#song").stop().animate({scrollLeft: $("#song")[0].scrollWidth - $("#song").width()}, window.settings.textual.song.overflow.scrollspeed).delay(window.settings.textual.song.overflow.delay).animate({scrollLeft: 0}, window.settings.textual.song.overflow.scrollspeed);
					}
					$("#currently_playing").css("max-height", $("#currently_playing")[0].scrollHeight + "px");
					window.overflowSecs++;
				}
			},
			error: function(data){
				window.errorCount++;
			}
			
		});
	},1000);
	
	fillPlaylist();
	fillFolders();
	
	$("#lib_query").on("input propertychange paste", function(){
		value = $("#lib_query").val();
		if(value.length < 2) return;
		(function(value){
			setTimeout(function(){
				if(value != $("#lib_query").val()) return;
				$.ajax({
				url: "/requests/mpd.php",
				type: "GET",
				data: {cmd: "search any \"" + value + "\""},
				success: function(data){
					if(data.stat){
						window.query = JSON.parse(JSON.stringify(data.result).replace(/&/, "&amp;").replace(/'/g, "&apos;"));
						changeMusicFolderQuery();
					}
				},
				error: function(data){
					
				}
			});
			}, 500);
		})(value);
	});
	
	$("#timebar_wrapper").on("mousedown", function(e){
		if(window.state.state !== "stop") window.timebarIsDragging = true;
		if(window.timebarIsDragging){
			if(e.offsetX > $("#timebar_wrapper").width()) e.offsetX = $("#timebar_wrapper").width();
			$("#timebar").stop().css({"width": e.offsetX});
			percent = $("#timebar").width() / $("#timebar_wrapper").width();
			$("#timebar_current").text(toTimestamp(Math.round(window.state.time.length * percent)));
		}
	});
	
	$("#timebar_wrapper").on("mousemove", function(e){
		if(window.timebarIsDragging){
			if(e.offsetX > $("#timebar_wrapper").width()) e.offsetX = $("#timebar_wrapper").width();
			$("#timebar").stop().css({"width": e.offsetX});
			percent = $("#timebar").width() / $("#timebar_wrapper").width();
			$("#timebar_current").text(toTimestamp(Math.round(window.state.time.length * percent)));
		}
	});
	
	$("#hamburger_left").on("mouseenter", function(e){
		if(!window.hamburger_left_is_running){
			window.hamburger_left_is_running = true;
			window.hamburger_left_state = 1;
			wwidth = $(window).width();
			
			if(hamburgerFullscreen()){
				width = wwidth - 32;
			} else {
				width = wwidth * 0.5;
			}
			$("#hamburger_left").addClass("extended");
			$("#hamburger_left").stop().animate({"width": width + "px"}, function(){window.hamburger_left_is_running = false;});
		}
	});
	
	$("#hamburger_left").on("mouseleave", function(e){
		if(!window.hamburger_left_is_running && !window.rcm){
			window.hamburger_left_is_running = true;
			window.hamburger_left_state = 0;
			$("#hamburger_left").removeClass("extended");
			$("#hamburger_left").stop().animate({"width": "32px"}, function(){window.hamburger_left_is_running = false;});
		}
	});
	
	$("#hamburger_right").on("mouseenter", function(e){
		if(!window.hamburger_right_is_running){
			window.hamburger_right_is_running = true;
			window.hamburger_right_state = 1;
			wwidth = $(window).width();
			
			if(hamburgerFullscreen()){
				width = wwidth - 32;
			} else {
				width = wwidth * 0.3;
			}
			$("#hamburger_right").addClass("extended");
			$("#hamburger_right").stop().animate({"width": width + "px"}, function(){window.hamburger_right_is_running = false;});
		}
	});
	
	$("#hamburger_right").on("mouseleave", function(e){
		if(!window.hamburger_right_is_running && !window.rcm){
			window.hamburger_right_is_running = true;
			window.hamburger_right_state = 0;
			$("#hamburger_right").removeClass("extended");
			$("#hamburger_right").stop().animate({"width": "32px"}, function(){window.hamburger_right_is_running = false;});
		}
	});
	
	$(document).on("mouseup", function(){
		if(window.timebarIsDragging){
			percent = $("#timebar").width() / $("#timebar_wrapper").width();
			newtime = Math.round(window.state.time.length * percent);
			sendCmd("seek " + window.state.song + " " + newtime + "");
			window.timebarIsDragging = false;
		}
	});
	
	$(document).on("mousemove", function(e){
		window.mouseX = e.pageX;
		window.mouseY = e.pageY;
		window.noAction = 0;
	});
	
	$(document).on("keypress", function(e){
		if(e.keyCode === 0 || e.keyCode === 32){
			//If we are inputting, do not play/pause
			if($(e.target).is("input") || $(e.target).is("textarea")) return;
			e.preventDefault();
			if(window.state.state === "play"){
				sendCmd("pause");
			} else {
				sendCmd("play");
			}
			
		}
	});
});

function toggle_hamburger_left(){
	window.hamburger_left_state ? $("#hamburger_left").trigger("mouseleave") : $("#hamburger_left").trigger("mouseenter");
}

function toggle_hamburger_right(){
	window.hamburger_right_state ? $("#hamburger_right").trigger("mouseleave") : $("#hamburger_right").trigger("mouseenter");
}

function hamburgerFullscreen(){
	wwidth = $(window).width();
	if(window.isMobile||wwidth*0.5<500){
		return true;
	} else {
		return false;
	}
}

function sendShellCmd(cmd){
	if(window.canShellCommand){
		window.canShellCommand = false;
		$.ajax({
			url: "/requests/shell.php",
			type: "GET",
			data: {cmd: cmd},
			success: function(data){
				console.log(data);
				window.canShellCommand = true;
			},
			error: function(data){
				window.canShellCommand = true;
			}
		});
	} else {
		console.log("Shell not ready");
	}
}

function shellCmd(){
	if(window.canShellCommand){
		window.canShellCommand = false;
		$(document.body).append("<div id='shellStat' style='overflow: hidden; position: absolute; width: 20%; height: 100px; line-height: 100px; vertical-align: center; text-align: center; font-size: 20px; z-index: 2000; background-color: black; right: 0px; bottom: 0px;'>Executing Shell command</div>");
		$("#shellStat").toggle().fadeIn();
		tmpTimer = setInterval(function(){
			$("#shellStat").text($("#shellStat").text() + ".");
		}, 1000);
		$.ajax({
			url: "/requests/shell.php",
			type: "GET",
			data: {cmd: $("#shellcommand").val()},
			success: function(data){
				console.log(data);
				window.canShellCommand = true;
				clearInterval(tmpTimer);
				$("#shellStat").fadeOut(400, function(){
					$("#shellStat").remove();
				});
			},
			error: function(data){
				window.canShellCommand = true;
				clearInterval(tmpTimer);
				$("#shellStat").fadeOut(400, function(){
					$("#shellStat").remove();
				});
			}
			
		});
	} else {
		console.log("Shell not ready");
	}
}

function fillFolders(){
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "listall"},
		success: function(data){
			window.folders.global = {};
			if(data.stat){
				window.folders.global = JSON.parse(JSON.stringify(data.result).replace(/&/, "&amp;").replace(/'/g, "&apos;"));
			}
			window.folders.global.Radio = window.settings.streams;
			changeMusicFolder(window.currentFolder);
		},
		error: function(data){
			
		}
		
	});
}

function clearPlaylist(){
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "clear"},
		success: function(data){
			fillPlaylist();
		},
		error: function(data){
			
		}
		
	});
}

function fillPlaylist(){
	window.isGettingPlaylist = true;
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "playlistinfo"},
		success: function(data){
			if(data.stat){
				response = data.result;
				window.playList = response;
				$("#playlist").empty();
				for(i=0; i<window.playList.length; i++){
					if(window.playList[i].Title === undefined) window.playList[i].Title = ((window.playList[i].file).match(/.*\/(.*)\./))[1];
					if(window.playList[i].Artist === undefined) window.playList[i].Artist = "Unknown";
					$("#playlist").append("<div class='playlist_song' onClick='changePlaylistSong(\"" + i + "\")' id='playlist_song_" + i + "'><div class='playlist_song_title'>" + window.playList[i].Title + "</div><div class='playlist_song_artist'>" + window.playList[i].Artist + "</div></div>");
					if(i+1 == window.playList.length){
						$("#playlist_song_" + i).toggle().fadeIn();
					}
				}
				changePlaylistSelected(window.currentSongNum, window.currentSongNum);
				
			} else {
				return;
			}
			window.isGettingPlaylist = false;
		},
		error: function(data){
			window.isGettingPlaylist = false;
		}
		
	});
}

function addSong(arrayString, key, count_id){
	if(key > -2){
		array = eval(arrayString);
		songName = (key >-1 ? "/" + array[key] : "");
		uri = arrayString.replace("window.folders.global", "").replace(/\[\"/g, "").replace(/\"\]/g, "/");
		uri = uri.substr(0, uri.length - 1) + songName;
	} else {
		uri = arrayString;
	}
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "add \"" + uri + "\""},
		success: function(data){
			if(data.stat){
				if(!hamburgerFullscreen() && settings.hamburger.addToggle){
					$("#hamburger_right").trigger("mouseenter");
					setTimeout(function(){
						$("#hamburger_right").trigger("mouseleave");
					},2000);
				}
				off = $("#folder_" + count_id).offset();
				wid = $("#folder_" + count_id).width();
				$("<div class='folder folder_overlay'>Added to playlist</div>").appendTo($("#hamburger_left")).css({"top": off.top + "px", "left": off.left + "px", "width": wid + "px"}).toggle().fadeIn(150).delay(400).fadeOut(150, function(){$(this).remove();});
				
				setTimeout(function(){
					fillPlaylist();
				},400);
			}
		},
		error: function(data){
			
		}
		
	});
}

function addSongQuery(file, key, count_id){
	uri = file + "/" + key;
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "add \"" + uri + "\""},
		success: function(data){
			if(data.stat){
				if(!hamburgerFullscreen() && settings.hamburger.addToggle){
					$("#hamburger_right").trigger("mouseenter");
					setTimeout(function(){
						$("#hamburger_right").trigger("mouseleave");
					},2000);
				}
				off = $("#folder_" + count_id).offset();
				wid = $("#folder_" + count_id).width();
				$("<div class='folder folder_overlay'>Added to playlist</div>").appendTo($("#hamburger_left")).css({"top": off.top + "px", "left": off.left + "px", "width": wid + "px"}).toggle().fadeIn(150).delay(400).fadeOut(150, function(){$(this).remove();});
				
				setTimeout(function(){
					fillPlaylist();
				},400);
			}
		},
		error: function(data){
			
		}
		
	});
}

function changeMusicFolder(folder){
	window.currentFolder = folder;
	currentArray = eval(folder);
	$("#folders").empty();
	count = 0;
	for(key in currentArray){
		if(parseInt(Number(key)) == key){
			if(folder === "window.folders.global[\"Radio\"]"){
				$("#folders").append("<div class='folder folder_song' id='folder_song_" + count + "'>" + currentArray[key][0] + "</div>");
				$("#folder_song_" + count).click({param: currentArray[key][1]}, function(e){addSong(e.data.param, '-2')});
			} else {
				$("#folders").append("<div class='folder folder_song' id='folder_song_" + count + "'>" + currentArray[key] + "</div>");
				$("#folder_song_" + count).attr("onclick", "addSong('" + folder + "', '" + key + "', 'song_" + count + "')");
			}
		} else {
			newFolder = folder + "[\"" + key + "\"]";
			$("#folders").append("<div class='folder folder_inline_wrapper'><div class='folder_dir' id='folder_" + count + "'>" + key + "</div><div style='display: inline-block' class='folder_dir_playall' id='folder_playall_" + count + "'>&nbsp;</div></div>");
			$("#folder_" + count).attr("onclick", "changeMusicFolder('" + newFolder + "')");
			$("#folder_playall_" + count).attr("onclick", "rightClickMenuFolder('" + newFolder + "', '" + count + "')");
			//$("#folder_playall_" + count).attr("onclick", "addSong('" + newFolder + "', -1)");
		}
		count++;
	}
	$("#folders").append("<div class='folder folder_update' id='folder_update'>Update database</div>");
	$("#folder_update").attr("onclick", "sendCmd('update')");
	if(folder !== "window.folders.global"){
		$("#folders").append("<div class='folder folder_back' id='folder_back'>Back</div>");
		$("#folder_back").attr("onclick", "changeMusicFolder('" + folder.match(/(^.*)\[\".*?\"\]$/)[1] + "')");
	}
}

function changeMusicFolderQuery(){
	currentArray = window.query;
	$("#folders").empty();
	if(currentArray.length == 0){
		$("#folders").append("No results found in the song library!");
	}
	count = 0;
	for(key in currentArray){
		item = (currentArray[key]).split("/");
		name = item[item.length-1];
		item.pop();
		item_folder = item.join("/");
		$("#folders").append("<div class='folder_alt folder_song' id='folder_song_" + count + "'>" + name + "<div class='folder_song_extra'>" + item_folder + "</div></div>");
		$("#folder_song_" + count).attr("onclick", "addSongQuery('" + item_folder + "', '" + name + "', 'song_" + count + "')");
		count++;
	}
	$("#folders").append("<div class='folder folder_back' id='folder_back'>Back</div>");
	$("#folder_back").attr("onclick", "changeMusicFolder('" + window.currentFolder + "')");
}

function changePlaylistSelected(oldpos, newpos){
	newposreset = false;
	if(newpos < 0){
		newpos = 0;
		newposreset = true;
	}
	if($(".playlist_song").length > 0){
		$("#playlist_song_" + oldpos).removeClass("playlist_selected");
		if(!newposreset) $("#playlist_song_" + newpos).addClass("playlist_selected");
		pos = $("#playlist_song_" + newpos).position();
		npos = -1*(newpos * $("#playlist_song_" + newpos).outerHeight() - ($(window).height() / 5));
		$("#playlist").stop().animate({"margin-top": npos}, {"duration": window.settings.easing.playlist.time, "easing": window.settings.easing.playlist.type});
	}
}

function changePlaylistSong(sid){
	changePlaylistSelected(window.currentSongNum, sid);
	window.songIsChanging = true;
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "play " + sid},
		success: function(data){
			setTimeout(function(){getAlbumArt()},1250);
		},
		error: function(data){
			window.songIsChanging = false;
		}
		
	});
	window.currentSongNum = sid;
	window.songIsChanging = false;
}

function getAlbumArt(){
	$.ajax({
		url: "https://ws.audioscrobbler.com/2.0/",
		type: "GET",
		data: {
			method: "album.getinfo",
			api_key: "49770de2ce91d8036a5637de5a645acb",
			artist: response[1][0].Artist,
			album: response[1][0].Album,
			format: "json"
		},
		success: function(data){
			if(typeof data.album !== "undefined"){
				if(data.album.image[3]["#text"].length > 3){
					$("#albumart").html("<img src='" + data.album.image[3]["#text"] + "'/>");
				} else {
					$("#albumart").html("<i class='material-icons'>album</i>");
				}
			} else {
				$("#albumart").html("<i class='material-icons'>album</i>");
			}
		},
		error: function(data){
			$("#albumart").html("<i class='material-icons'>album</i>");
		}
		
	});
}

function sendCmd(cmd){
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: cmd},
		success: function(data){

		},
		error: function(data){

		}
		
	});
}

function shuffle(){
	if(parseInt(window.response[0].random) == 0){
		cmd = "random 1";
	} else {
		cmd = "random 0";
	}
	
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: cmd},
		success: function(data){
			
		},
		error: function(data){
			
		}
	});
}

function prev(){
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "previous"},
		success: function(data){
			
		},
		error: function(data){
			
		}
	});
}

function play(){
	if(window.response[0].state == "play"){
		cmd = "pause";
	} else {
		cmd = "play";
	}
	
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: cmd},
		success: function(data){
			
		},
		error: function(data){
			
		}
	});
}

function next(){
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "next"},
		success: function(data){
			
		},
		error: function(data){
			
		}
	});
}

function repeat(){
	if(parseInt(window.response[0].repeat) == 0){
		cmd1 = "repeat 1";
		cmd2 = false;
	} else {
		if(parseInt(window.response[0].single) == 0){
			cmd1 = false;
			cmd2 = "single 1";
		} else {
			cmd1 = "repeat 0";
			cmd2 = "single 0";
		}
	}
	
	if(cmd1){
		$.ajax({
			url: "/requests/mpd.php",
			type: "GET",
			data: {cmd: cmd1},
			success: function(data){
				
			},
			error: function(data){
				
			}
		});
	}
	
	if(cmd2){
		$.ajax({
			url: "/requests/mpd.php",
			type: "GET",
			data: {cmd: cmd2},
			success: function(data){
				
			},
			error: function(data){
				
			}
		});
	}
}

function vol(amount){
	$("#vol_vol").text(Number($("#vol_vol").text()) + amount);
	$.ajax({
		url: "/requests/mpd.php",
		type: "GET",
		data: {cmd: "volume " + amount},
		success: function(data){
			
		},
		error: function(data){
			
		}
	});
}

function toTimestamp(secs){
	seconds = secs % 60;
	minutes = (secs - seconds) / 60;
	if(seconds < 10) seconds = "0" + seconds;
	return minutes + ":" + seconds;
}

function titleQueueAdd(data){
	window.title.queue[window.title.queue.length] = data;
}

function getEq(){
	$.ajax({
		url: "/requests/shell.php",
		type: "GET",
		data: {cmd: "sudo -H -u mpd amixer -D equal"},
		success: function(data){
			res = data.result;
			for(i = 0; i < res.length; i++){
				$("#eq_" + (i+1)).val(Math.pow(res[i],1.9));
			}
		},
		error: function(data){
			
		}	
	});
}

function setEq(val, eq){
	$.ajax({
		url: "/requests/shell.php",
		type: "GET",
		data: {cmd: "sudo -H -u mpd amixer -D equal set '" + eq + "' " + val + "%"},
		success: function(data){
			
		},
		error: function(data){
			
		}	
	});
}



function formatBytes(bytes,decimals) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024; // or 1024 for binary
   var dm = decimals + 1 || 3;
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
   var i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
$.fn.overflown=function(){var e=this[0];return e.scrollHeight>e.clientHeight||e.scrollWidth>e.clientWidth;}