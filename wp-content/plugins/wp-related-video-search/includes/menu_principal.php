<?php
/* SIEMPRE AGREGAR PARA PREVENIR HACK */
include('hack.php');
logo();
titulo('Settings');

	$data = get_option(NAME_PLUGIN_VAR);
	if (isset($_POST[NAME_PLUGIN_VAR.'_save'])){
		$data['textoboton'] = attribute_escape($_POST[NAME_PLUGIN_VAR.'_textoboton']);
		$data['buscarPor'] = attribute_escape($_POST[NAME_PLUGIN_VAR.'_buscarPor']);
		$data['tipoBusqueda'] = attribute_escape($_POST[NAME_PLUGIN_VAR.'_tipoBusqueda']);
		$data['tipoBtn'] = attribute_escape($_POST[NAME_PLUGIN_VAR.'_tipoBtn']);
		$data['tituloPost'] = attribute_escape($_POST[NAME_PLUGIN_VAR.'_tituloPost']);
		update_option(NAME_PLUGIN_VAR, $data);
		echo "<div style='width:90%;background-color:#FFFFA7;text-align:center;display:none' id='msgSave'><strong>". __('Saved') ."</strong></div><script>jQuery('#msgSave').show(500);</script>";
	}

?>

<form method="POST">

	<table width="90%" CELLPADDING=6 CELLSPACING=15>
		<tr>
			<td><strong><?php  echo __('Search'); ?> <?php  echo __('By'); ?> </strong></td>
			<td>
			<select name="<?php echo NAME_PLUGIN_VAR; ?>_buscarPor">
			<?php 	if($data['buscarPor']==1) { ?>
				<option SELECTED value="1"><?php  echo __('Tags'); ?></option>
			<?php }else{ ?>
				<option value="1"><?php  echo __('Tags'); ?></option>
			<?php } ?>
			
			<?php 	if($data['buscarPor']==2) { ?>
				<option SELECTED value="2"><?php  echo __('Titles'); ?></option>
			<?php }else{ ?>
				<option value="2"><?php  echo __('Titles'); ?></option>
			<?php } ?>
			
			<?php 	if($data['buscarPor']==3) { ?>
				<option SELECTED value="3"><?php  echo __('Tags') . ' '. __('and') . ' '. __('Titles') ; ?></option>
			<?php }else{ ?>
				<option value="3"><?php echo __('Tags') . ' '. __('and') . ' '. __('Titles') ; ?></option>
			<?php } ?>
		
			</select>
			</td>
			
		<td><strong><?php  echo __('Type'); ?></strong> </td>
			<td>
			<select  name="<?php echo NAME_PLUGIN_VAR; ?>_tipoBusqueda">
			<?php 	if($data['tipoBusqueda']=='small') { ?>
				<option SELECTED value="small"><?php  echo __('Small'); ?> (4 Videos)</option>
			<?php }else{ ?>
				<option value="small"><?php  echo __('Small'); ?> (4 Videos)</option>
			<?php }?>
			
			<?php 	if($data['tipoBusqueda']=='large') { ?>
				<option SELECTED value="large"><?php  echo __('Large'); ?> (8 Videos)</option>
			<?php }else{ ?>
				<option value="large"><?php  echo __('Large'); ?> (8 Videos)</option>
			<?php }?>
			
				
			</select>
			</td>
			
		</tr>
		
		<tr>
			<td><strong><?php  echo __('Text'); ?> <?php  echo __('Close'); ?> </strong></td>
			<td>
			<input type="text" name="<?php echo NAME_PLUGIN_VAR; ?>_textoboton" value="<?php echo $data['textoboton']; ?>">
			</td>
			<td><strong><?php  echo __('Type'); ?> </strong></td>
			<td>
				<select name="<?php echo NAME_PLUGIN_VAR; ?>_tipoBtn">
				<?php 	if($data['tipoBtn']==1) { ?>
					<option SELECTED value="1"><?php  echo __('Link'); ?></option>
				<?php }else{ ?>
					<option value="1"><?php  echo __('Link'); ?></option>
				<?php } ?>
				
				<?php 	if($data['tipoBtn']==2) { ?>
					<option SELECTED value="2"><?php  echo __('Button'); ?></option>
				<?php }else{ ?>
					<option value="2"><?php  echo __('Button'); ?></option>
				<?php } ?>
		
			</select>
			</td>
			
		<td></td>
			
		</tr>
		<tr>
		<td><strong><?php  echo __('Title'); ?></strong></td>
		<td>
			<input type="text" name="<?php echo NAME_PLUGIN_VAR; ?>_tituloPost" value="<?php echo $data['tituloPost']; ?>">
		</td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td colspan="4" align="center"><input type="submit" name="<?php echo NAME_PLUGIN_VAR; ?>_save" value="<?php  echo __('Save'); ?>"></td>
		</tr>
		
	</table>
	
</form>
<?php
link_donaciones();
?>

<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fnexxuz.com%2Fwp-related-video-search-plugin.html&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>

