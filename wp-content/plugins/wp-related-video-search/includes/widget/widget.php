<?php
	include('../hack.php');		
	global $wpdb; // PARA PODER HACER SELECT O USAR EL OBJETO DE WORDPRESS
	$data = get_option(NAME_PLUGIN_VAR);
	echo $args['before_widget'];
	echo $args['before_title'] . $data['opcion1'] . $args['after_title'];
	echo $data['opcion1'];
	link_donaciones();
	echo $args['after_widget'];
?>
