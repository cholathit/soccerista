<?php

define('THEME_FRAMEWORK','vergothemes');

/*-----------------------------------------------------------------------------------*/
/* Add default options and show Options Panel after activate  */
/*-----------------------------------------------------------------------------------*/
$pagenow = '';
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

	//Call action that sets
	add_action('admin_head','vergo_option_setup');
	
	//Do redirect
	header( 'Location: '.admin_url().'admin.php?page=vergothemes' ) ;
	
}

function vergo_option_setup(){

	//Update EMPTY options
	$vergo_array = array();
	add_option('vergo_options',$vergo_array);

	$template = get_option('vergo_template');
	$saved_options = get_option('vergo_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$vergo_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$vergo_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$vergo_array[$id] = $db_option;
			}
		}
	}
	update_option('vergo_options',$vergo_array);
}

/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/
function vergothemes_admin_head() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
    	
        var message = '<p>This <strong>Vergo</strong> comes with a <a href="<?php echo admin_url('admin.php?page=vergothemes'); ?>">comprehensive options panel</a>. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
    
    //Setup Custom Navigation Menu
	if (function_exists('vergo_custom_navigation_setup')) {
		vergo_custom_navigation_setup();
	}
	
}

add_action('admin_head', 'vergothemes_admin_head'); 




?>