<table class='eq_control_wrap'>
	<tr><th style='width: 50px'>Freq.</th><th>Percent (0-100)</th></tr>
	<tr><td>31 Hz</td><td><input type='range' id='eq_1' data-eq='01. 31 Hz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>63 Hz</td><td><input type='range' id='eq_2' data-eq='02. 63 Hz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>125 Hz</td><td><input type='range' id='eq_3' data-eq='03. 125 Hz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>250 Hz</td><td><input type='range' id='eq_4' data-eq='04. 250 Hz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>500 Hz</td><td><input type='range' id='eq_5' data-eq='05. 500 Hz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>1 kHz</td><td><input type='range' id='eq_6' data-eq='06. 1 kHz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>2 kHz</td><td><input type='range' id='eq_7' data-eq='07. 2 kHz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>4 kHz</td><td><input type='range' id='eq_8' data-eq='08. 4 kHz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>8 kHz</td><td><input type='range' id='eq_9' data-eq='09. 8 kHz' min='0' max='4750' step='47.5'/></td></tr>
	<tr><td>16 kHz</td><td><input type='range' id='eq_10' data-eq='10. 16 kHz' min='0' max='4750' step='47.5'/></td></tr>
</table>

<script type='text/javascript'>
	getEq();
	$("input[type='range']").change(function(){
		setEq(Math.pow($(this).val(), 1/1.9), $(this).data("eq"));
	});
</script>