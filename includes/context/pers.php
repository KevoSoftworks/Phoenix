<?php
	require_once("../db.php");
	$settings = new Settings();
	
	$query = $settings->db->query("SELECT name, ref FROM theme");
	while($res = $query->fetchArray(SQLITE3_ASSOC)){
		$colours[] = $res;
	}
	$cur_colour = $settings->getNode('pref.theme');
	$cur_sidebar_hover = $settings->getNode('pref.sidebar.hover');
	$cur_albumart = $settings->getNode('pref.albumart');
	
	$truefalse = array("true", "false");
	$yesno = array("Yes", "No");
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
	<tr><td>Sidebar open on hover</td><td>
	<select id="pers-sidebar-hover" style='width: 100%'>
		<?php
			foreach($truefalse as $key=>$tf){
				$sel = "";
				if($tf == $cur_sidebar_hover["value"]) $sel = "selected";
				echo "<option value='" . $tf . "' " . $sel . ">" . $yesno[$key] . "</option>";
			}
		?>
	</select>
	</td></tr>
	<tr><td>Load album art</td><td>
	<select id="pers-albumart" style='width: 100%'>
		<?php
			foreach($truefalse as $key=>$tf){
				$sel = "";
				if($tf == $cur_albumart["value"]) $sel = "selected";
				echo "<option value='" . $tf . "' " . $sel . ">" . $yesno[$key] . "</option>";
			}
		?>
	</select>
	</td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>