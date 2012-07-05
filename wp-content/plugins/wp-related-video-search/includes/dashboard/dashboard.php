<?php
	include('hack.php');		
	$data = get_option(NAME_PLUGIN_VAR);
	$data = get_option(NAME_PLUGIN_VAR);
	if (isset($_POST[NAME_PLUGIN_VAR.'_opcion1'])){
		$data['opcion1'] = attribute_escape($_POST[NAME_PLUGIN_VAR.'_opcion1']);
		update_option(NAME_PLUGIN_VAR, $data);
	}
	$data = get_option(NAME_PLUGIN_VAR);
	?>
	<form method="POST">
		<input type='text' value='<?php echo  $data['opcion1']; ?>' name='<?php echo NAME_PLUGIN_VAR; ?>_opcion1'>
		<input type="submit">
	</form>
	<?
	
?>
