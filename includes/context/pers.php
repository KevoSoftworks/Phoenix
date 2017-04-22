<?php
	require_once("../db.php");
	$settings = new Settings();
	
	$query = $settings->db->query("SELECT name, ref FROM theme");
	while($res = $query->fetchArray(SQLITE3_ASSOC)){
		$colours[] = $res;
	}
	$cur_colour = $settings->getNode('pref.theme');
?>

<table style='width: 100%'>
	<tr><td>Player name: </td><td><input id="pers-name" style='width: 100%' type='text' value='<?php echo $settings->getNode('pref.name')["value"]?>'/></td></tr>
	<tr><td>Colour: </td><td>
	<select id="pers-colour" style='width: 100%'>
		<?php
			foreach($colours as $colour){
				$sel = "";
				if($colour["ref"] == $cur_colour["value"]) $sel = "selected";
				echo "<option value='" . $colour["ref"] . "' " . $sel . ">" . $colour["name"] . "</option>";
			}
		?>
	</select>
	</td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>