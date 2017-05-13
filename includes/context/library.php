<?php
	require_once("../db.php");
	$settings = new Settings();
	
	$query = $settings->db->query("SELECT * FROM streams ORDER BY name");
	while($res = $query->fetchArray(SQLITE3_ASSOC)){
		$streams[] = $res;
	}
?>

<!--<h2>Music folders</h2>
lalala
<br/>
<hr/>-->
<h2>Radio streams</h2>
<table>
	<tr><th>Name</th><th>URL</th><th>Actions</th></tr> <!-- actions like delete, edit etc. -->
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php
	foreach($streams as $stream){
		echo "<tr><td>" . $stream["name"] . "</td><td>" . $stream["url"] . "</td><td><i class='material-icons'>mode_edit</i><i class='material-icons'>delete_forever</i></td></tr>";
	}
?>
</table>
<button>Add stream</button>