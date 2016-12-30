window.rcm = false;

function rightClickMenuFolder(folder, folderElem){
	uri = folder.replace("window.folders.global", "").replace(/\[\"/g, "").replace(/\"\]/g, "/");
	uri = uri.substr(0, uri.length - 1);
	//uri = encodeURIComponent(uri);
	
	rcm_div = "<div class='rcm'>"+
			"<div id='rcm_item_1' class='rcm_item' onClick=\"addSong('" + uri + "', -2); closeRightClickMenu(); \">Play All</div>"+
			"<div id='rcm_item_2' class='rcm_item' onClick=\"sendCmd('update " + uri + "'); closeRightClickMenu(); \">Update</div>"+
			"<div id='rcm_item_3' class='rcm_item' onClick=\"popup('folder_prop','cmd=" + uri + "'); closeRightClickMenu(); \">Properties</div>"+
		"</div>";
	window.rcm = true;
	$(document.body).append(rcm_div);
	$(".rcm").css({
		"top": (window.mouseY - 10) + "px",
		"left": (window.mouseX - 10) + "px"
	});
	$(".rcm").on("mouseleave", function(){
		closeRightClickMenu();
	});
}

function rightClickMenu(type){
	rcm_div = "";
	switch(type){
		case "settings":
		rcm_div = "<div class='rcm'>"+
			//"<div id='rcm_item_1' class='rcm_item' onClick=\"popup('audio'); closeRightClickMenu();\"><img class='rcm_icon' src='/assets/" + window.themedark + "/play_2.png'/>Audio Settings</div>"+
			//"<div id='rcm_item_2' class='rcm_item' onClick=\"popup('player'); closeRightClickMenu();\"><img class='rcm_icon' src='/assets/" + window.themedark + "/wrench.png'/>Player Settings</div>"+
			//"<div id='rcm_item_3' class='rcm_item' onClick=\"popup('pers'); closeRightClickMenu();\"><img class='rcm_icon' src='/assets/" + window.themedark + "/customise.png'/>Personalise</div>"+
			"<div id='rcm_item_4' class='rcm_item' onClick=\"popup('about'); closeRightClickMenu();\"><img class='rcm_icon' src='/assets/" + window.themedark + "/about.png'/>About</div>"+
			"<div id='rcm_item_5' class='rcm_item' onClick=\"popup('change'); closeRightClickMenu();\"><img class='rcm_icon' src='/assets/" + window.themedark + "/about.png'/>Changelog</div>"+
			"<div id='rcm_item_6' class='rcm_item' onClick=\"popup('power'); closeRightClickMenu();\"><img class='rcm_icon' src='/assets/" + window.themedark + "/power.png'/>Power</div>"+
		"</div>";
			break;
	}
	window.rcm = true;
	$(document.body).append(rcm_div);
	$(".rcm").css({
		"top": (window.mouseY - 10) + "px",
		"left": (window.mouseX - 10) + "px"
	});
	$(".rcm").on("mouseleave", function(){
		window.rcm = false;
		$(".rcm").remove();
	});
}

function closeRightClickMenu(){
	//This could probably be done nicer, but it works.
	window.rcm = false;
	$(".rcm").remove();
}

function popup(context, data){
	window.popuptmpcount = 0;
	window.popupchecker = setInterval(function(){
		if(window.popuptmpcount >= 3){
			clearInterval(window.popupchecker);
			$(".popup_header").html($(".popup_header").html().replace(/%themedark%/g, window.themedark));
			$(".popup_content").html($(".popup_content").html().replace(/%themedark%/g, window.themedark));
			$(".popup_footer").html($(".popup_footer").html().replace(/%themedark%/g, window.themedark));
	
			$(".rcm").trigger("mouseleave");
			
			if($(".popup_content").height() > 0.9 * $(window).height() && $(".popup_content").height() >= ($('.popup').height() - $(".popup_header").height() - $(".popup_footer").height())){
				$('.popup').height($('.popup').height());
				$(".popup_content").height($('.popup').height() - $(".popup_header").height() - $(".popup_footer").height());
				$(".popup_content").css({
					"top": $(".popup_header").height() + "px",
					"bottom": $(".popup_footer").height() + "px"
				})
			} else {
				$('.popup').height($(".popup_header").height() + $(".popup_footer").height() + $(".popup_content").height())
			}
			
			toppos = ($(window).height() - $('.popup').height()) / 2;
			if(toppos < 0) toppos = 0;
			$(".popup").css({
				"top": toppos / 2 + "px",
				"left": ($(window).width() - $('.popup').width()) / 2 + "px"
			});
		}
	},50);
	$('.popup').remove();
	prop = "<div class='popup'><div class='popup_header'>Loading...</div><div class='popup_content'><img src='/assets/loading.gif' /></div><div class='popup_footer'></div>";
	$(document.body).append(prop);
	
	if(window.context.popup[context].header.match(/(\.html|\.php|\.txt)/)){
		$(".popup_header").load("/includes/context/" + window.context.popup[context].header + "?" + data, function(){window.popuptmpcount++});
	} else {
		$(".popup_header").text(window.context.popup[context].header);
		window.popuptmpcount++
	}
	
	if(window.context.popup[context].content.match(/(\.html|\.php|\.txt)/)){
		$(".popup_content").load("/includes/context/" + window.context.popup[context].content + "?" + data, function(){window.popuptmpcount++});
	} else {
		$(".popup_content").text(window.context.popup[context].content);
		window.popuptmpcount++
	}
	
	if(window.context.popup[context].footer.match(/(\.html|\.php|\.txt)/)){
		$(".popup_footer").load("/includes/context/" + window.context.popup[context].footer + "?" + data, function(){window.popuptmpcount++});
	} else {
		$(".popup_footer").text(window.context.popup[context].footer);
		window.popuptmpcount++
	}
}

function folderProperties(uri){
	prop = "<div class='popup'>"+
				"<div class='popup_header'>Properties</div>"+
				"<table>"+
				"<tr><td>Path: </td><td id='p_name'>Loading...</td></tr>"+
				"<tr><td>Type: </td><td id='p_type'>Loading...</td></tr>"+
				"<tr><td>&nbsp;</td><td>&nbsp;</td></tr>"+
				"<tr><td>Owner: </td><td id='p_owner'>Loading...</td></tr>"+
				"<tr><td>Permission: </td><td id='p_perm'>Loading...</td></tr>"+
				"<tr><td>Symlinks: </td><td id='p_syms'>Loading...</td></tr>"+
				"<tr><td>&nbsp;</td><td>&nbsp;</td></tr>"+
				"<tr><td>Size: </td><td id='p_size'>Loading...</td></tr>"+
				"<tr><td>Size on disk: </td><td id='p_size_disk'>Loading...</td></tr>"+
				"<tr><td>Last modified: </td><td id='p_date'>Loading...</td></tr>"+
				"</table>"+
				"<div class='popup_button' onClick=\"$('.popup').remove()\">Ok</div>"
			"</div>";
	$(document.body).append(prop);
	$(".rcm").trigger("mouseleave");
	toppos = ($(window).height() - $('.popup').height()) / 2;
	if(toppos < 0) toppos = 0;
	$(".popup").css({
		"top": toppos / 2 + "px",
		"left": ($(window).width() - $('.popup').width()) / 2 + "px"
	});
	$.ajax({
		url: "/requests/shell.php",
		type: "GET",
		data: {cmd: "folder_prop " + uri},
		success: function(data){
			if(data.stat){
				switch(data.result.type){
					case "d":
						data.result.type = "Directory";
						break;
					case "-":
						data.result.type = "File";
						break;
					case "l":
						data.result.type = "Symlink";
						break;
				}
				$("#p_name").text(data.result.folder);
				$("#p_type").text(data.result.type);
				$("#p_owner").text(data.result.owner);
				$("#p_perm").text(data.result.perm);
				$("#p_syms").text(data.result.syms);
				$("#p_size").text(formatBytes(data.result.size,1));
				$("#p_size_disk").text(formatBytes(data.result.size_disk,1));
				$("#p_date").text(data.result.date);
					$(".popup").css({
						"top": ($(window).height() - $('.popup').height()) / 2 + "px",
						"left": ($(window).width() - $('.popup').width()) / 2 + "px"
					});
			} else {
				$("#p_name").text("Could not obtain data: " + data.msg);
			}
		},
		error: function(data){
			$("#p_name").text("Could not obtain data");
		}	
	});
}