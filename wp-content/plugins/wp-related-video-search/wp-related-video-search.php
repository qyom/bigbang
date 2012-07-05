<?php
/*
Plugin Name: Wordpress Related Video Search
Plugin URI: http://nexxuz.com/wp-related-video-search-plugin.html
Description: Show related video in your post
Author: Jodacame
Version: 1.1
Author URI: http://nexxuz.com/

*/

/* Archivo de Configuracion */
 include(ABSPATH . 'wp-content/plugins/wp-related-video-search/config.php');

/* FUNCION DASHBOARD */
function wp_realted_video_search_widget_admin_function() {
		include(INCLUDES_FOLDER.'/dashboard/dashboard.php');
} 


/* FUNCION PARA AGREGAR A DASHBOARD */
function wp_realted_video_search_add_dashboard_widgets() {
	//wp_add_dashboard_widget(NAME_PLUGIN_VAR.'_dashboard_widget', TITLE_PLUGIN, NAME_PLUGIN_VAR.'_widget_admin_function');	
} 



/* FUNCION ESCRIBE CSS */
function wp_realted_video_search_css() {
  echo ("<link rel='stylesheet'  href='".CSS_FILE."' type='text/css' media='all' />"); 
  
}
/* FUNCION ESCRIBE CSS */
function wp_realted_video_search_css2() {
	$data = get_option(NAME_PLUGIN_VAR);
	echo ('<script src="http://www.google.com/uds/api?file=uds.js&v=1.0&source=uds-vsw&key=ABQIAAAA6f5Achoodo5s2Q2049vn6BSIkO30j4gnxwlOBxQkFXOonq3PsBQ0hUYBhAxwx8DYL03zbFQWDSv_nA"
    type="text/javascript"></script>
  <style type="text/css">
    @import url("http://www.google.com/uds/css/gsearch.css");
  </style>

  <!-- Video Search Control and Stylesheet -->
  <script type="text/javascript">
    window._uds_vsw_donotrepair = true;
  </script>'); 
	  echo ("<link rel='stylesheet'  href='".CSS_FILE2."' type='text/css' media='all' />"); 
	  echo ("<script type='text/javascript' src='".JS_FILE."'></script>"); 
	  
	    
	  $queryBusqueda ='';
	  
	  		  // Buscamos por Titulo
	  if($data['buscarPor']==2 || $data['buscarPor']==3)
	  {
		 
				 $queryBusqueda.='{ query : "'.str_replace(" ","+",the_title('','',false)) .'"},';
		
		
	}
	
	  // Buscamos por Etiquetas
	  if($data['buscarPor']==1 || $data['buscarPor']==3)
	  {
		 
		$posttags = get_the_tags();
			if ($posttags) {
			  foreach($posttags as $tag) {
				
				 $queryBusqueda.='{ query : "'.str_replace(" ","+",$tag->name) .'"},';
			  }
			}
		}
	$large='true';
	if($data['tipoBusqueda']=='small')
		$large='false';
	$linkCerrar=$data["textoboton"];	
	if($data['tipoBtn']==2)	
		$linkCerrar="<input type='button' value='".$data["textoboton"]."'>";
	 if(is_single()) 
	 {
	  echo ('<script>
		function LoadVideoSearchControl() {
			
			var options = {
				largeResultSet : '.$large.',
				string_allDone : "'.$linkCerrar.'",
			};
			var videoSearch = new GSvideoSearchControl(
								  document.getElementById("videoControl"),
								  ['. $queryBusqueda.'], null, null, options);
		}
		GSearch.setOnLoadCallback(LoadVideoSearchControl);
		jQuery(document).ready(function() {
			LoadVideoSearchControl();
		});
		
		
	  </script>');
  }
  
  
}


 
class wp_realted_video_search_widget extends WP_Widget {
 
	function wp_realted_video_search_widget() {
		//Clase CSS que usara el widghet y la descripción que se mostrará en la selección de widget en el Panel de Control
		$widget_ops = array( 'classname' => 'widget','description' => __(DESCRIPCION_WIDGET));
 
		//Configuración del widget en el panel de control.
		$control_ops = array( 'width' => 200, 'height' => 350);
 
		// Creamos el widget. El idbase que se usa en el formulario de configuración, Titulo del Widget en el panel de control,
		// y las opciones del widget y en control
		$this->WP_Widget( NAME_PLUGIN_VAR, __(TITLE_PLUGIN), $widget_ops, $control_ops );
	}
 
	/**
	 * Como se mostrara el widget en la web
	 */
	function widget( $args,$instance ) {
		include(INCLUDES_FOLDER.'/widget/widget.php');
	}
 
	 /**
	 * Funcion para guardar la configuración del widget en el panel de control
	 */
	function update( $new_instance, $old_instance ) {

		return ;
	}
 
	/**
	 * Muestra el formulario del widget en el panel de control
	 */
	function form( $instance ) {
 
			include(INCLUDES_FOLDER.'/widget/control.php');
	}
	
	
}

 
function register() {
	//register_widget( NAME_PLUGIN_VAR.'_widget' );
}




/* OTRAS FUNCIONES */

/* FUNCION  GENERA LINK PARA DONACIONES */
function link_donaciones(){
	echo '<span style="width:90%;text-align:center;display:block"><a target="_Blank" href="http://nexxuz.com/donate.php"><img src="'.IMAGES_FOLDER.'/donate.png" border="0" align="top" style="padding-right:2px"> Donate</a></span><br>';
}
	
function logo(){
	echo'<div id="logo_jodacame">
	<span class="titulo_plugin">'.TITLE_PLUGIN.'</span>
	<span class="creditos">POWERED BY <a href="http://nexxuz.com">JODACAME</a></span>
	</div>';
}
function icono_menu($icono){
return '<img src="'.IMAGES_FOLDER.'/'.$icono.'.png" valing="absmiddle" border="0"> ';
}
function titulo($titulo,$a=null,$b=null,$c=null){
	echo '<h2 id="h2_titulo">'. __( $titulo).' '. __( $a).' '. __( $b).' '. __( $c).'</h2>';
}


/* AGREGA NUEVA PAGINA */
function wp_realted_video_search_add_pages() {
    
    /* CABECERA MENU PRINCIPAL */  
    add_menu_page(TITLE_PLUGIN, __(TITLE_PLUGIN_CORTO), 'manage_options', NAME_PLUGIN_VAR.'_pagina_principal', NAME_PLUGIN_VAR.'_pagina_principal',IMAGES_FOLDER.'/icono.png');
    //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); 
    
    /* SUBMENUS */
   // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page(NAME_PLUGIN_VAR.'_pagina_principal', __('Settings'),icono_menu('settings') . __('Settings'), 'manage_options',  NAME_PLUGIN_VAR.'_pagina_principal', NAME_PLUGIN_VAR.'_pagina_principal');
	//add_submenu_page(NAME_PLUGIN_VAR.'_pagina_principal', __('Widget'), icono_menu('widget') .__('Widget'), 'manage_options',  NAME_PLUGIN_VAR.'_widgets', NAME_PLUGIN_VAR.'_widgets');
	//add_submenu_page(NAME_PLUGIN_VAR.'_pagina_principal',__('Settings'). ' '. __('Dashboard'),icono_menu('dashboard') .__('Settings'). ' '. __('Dashboard'), 'manage_options', NAME_PLUGIN_VAR.'_dashboard', NAME_PLUGIN_VAR.'_dashboard');
	//add_submenu_page(NAME_PLUGIN_VAR.'_pagina_principal', __('FAQ'), icono_menu('faq') .__('FAQ'), 'manage_options',  NAME_PLUGIN_VAR.'_faq', NAME_PLUGIN_VAR.'_faq');
	add_submenu_page(NAME_PLUGIN_VAR.'_pagina_principal', __('About'), icono_menu('about') .'<b>'.__('About').'</b>', 'manage_options',  NAME_PLUGIN_VAR.'_about', NAME_PLUGIN_VAR.'_about');
	
	
}

/* MENU PRINCIPAL */
function wp_realted_video_search_pagina_principal() {
     include(INCLUDES_FOLDER.'/menu_principal.php');
}

/* CONFIGURACION WIDGET */
function wp_realted_video_search_widgets() {
      include(INCLUDES_FOLDER.'/menu_widget.php');
}

/* CONFIGURACION DASHBOARD */
function wp_realted_video_search_dashboard() {
    include(INCLUDES_FOLDER.'/menu_dashboard.php');

    
}

/* MENU ACERCA DE */
function wp_realted_video_search_about() {
     include(INCLUDES_FOLDER.'/menu_about.php');
}
/* MENU ACERCA DE */
function wp_realted_video_search_faq() {
     include(INCLUDES_FOLDER.'/menu_faq.php');
}

function add_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
	if ($file == $this_plugin){
		$settings_link = '<a href="admin.php?page='.NAME_PLUGIN_VAR.'_pagina_principal">'.__('Settings').'</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
 }
 
function div_video($content){
	if(is_single())
	{
		$data = get_option(NAME_PLUGIN_VAR);
	$content .= '<h3>'.$data['tituloPost'].'</h3>  <div id="videoControl" style="width:500px">
    <span style="color:#676767;font-size:11px;margin:10px;padding:4px;">Loading...</span>
  </div><a href="http://nexxuz.com/wp-related-video-search-plugin.html"><small>Related Video Search</small></a>
    ';
	}	
	
	return $content;
}

 include(INCLUDES_FOLDER.'/core/register.php');
add_action('the_content', 'div_video');
