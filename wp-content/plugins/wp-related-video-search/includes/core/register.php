<?php	
	/* FUNCION REGISTRA WIDGET EN DASHBOARD */
	//add_action('wp_dashboard_setup', NAME_PLUGIN_VAR.'_add_dashboard_widgets' );

	/* FUNCION EJECUTA LA FUNCION REGISTER DEL WIDGET */
	//add_action('widgets_init', array(NAME_PLUGIN_VAR, 'register'));
	//add_action( 'widgets_init', 'register' );
	
	/* FUNCION AGREGA CSS EN EL HEAD DEL ADMIN (ESTO SE PUEDE CAMBIAR) */
	add_action('admin_head', NAME_PLUGIN_VAR.'_css');
	add_action('wp_head', NAME_PLUGIN_VAR.'_css2');
	
	/* FUNCION QUE CONTROLA CUANDO SE ACTIVA O DESACTIVA EL PLUGIN */
	/*register_activation_hook( __FILE__, 'activate');
	register_deactivation_hook( __FILE__, 'deactivate');*/
	
	/* FUNCION CREA MENU DE ADMINISTRACION */
	add_action('admin_menu', NAME_PLUGIN_VAR.'_add_pages');
	
	/* AGREMAOS LINK DE CONFIGURACION EN EL PLUGIN*/
	add_filter('plugin_action_links', 'add_settings_link', 10, 2 );
	
	/* CARGAMOS LA ULTIMA VERSION DE JQUERY */
	function cargar_jquery() {		
			wp_enqueue_script('jquery');		
	}
	add_action('init', 'cargar_jquery');
?>
