<?php
	$name = $_GET["name"];
	$id = $_GET["id"];
?>

Are you sure you want to delete "<?php echo $name; ?>"?
<input id="library-delete-stream-id" type='hidden' value='<?php echo $id; ?>' />
<br/>
<br/>