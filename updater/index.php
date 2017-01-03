<?php
	include "../includes/socket_api.php";
	if(!clientInSameSubnet()) die("Updater not available, not a local client.");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Phoenix Updater</title>
		<script src='/includes/jquery.js'></script>
	</head>
	
	<body>
		<div id="main" style="font-family: Verdana; width: 500px;">
			<h3>Phoenix is updating!</h3>
			<h5 style="color:#f40000">Keep this window open!</h5>
			<p style="font-size: 14px">Welcome to the updating utility of the Phoenix music player. 
			As you are reading this, the update utility is working on downloading and installing all the update files. 
			To ensure that the update succeeds, you must keep this window open until the update is fully completed and you are taken back to the Phoenix player.</p>
			Please wait while the update is being installed...
		</div>
	</body>
</html>
<script type='text/javascript'>
	$(document).ready(function(){
		$.ajax({
			url: "/updater/update.php",
			success: function(data){
				d = JSON.parse(data);
				if(d.stat){
					window.location.replace("/");
				} else {
					alert("Something happened! Update aborted.");
					window.location.replace("/");
				}
			},
			error: function(){
				alert("Something happened! Update aborted.");
				window.location.replace("/");				
			}
		});
	});
</script>