<?php

/*
 *Plugin Name: Xposed Database
 *Plugin URI: http://crackoworld.com/wp-db_plugin.php/
 *Description: Create & Extract Data from Database
 *Version: 1
 *Author: A & R
 *License: GPL2
 *
*/

/*
 *	Assign global variables
 *
*/

$plugin_url = WP_PLUGIN_URL . '/wp_plugin';

/*
 *Add a link to our plugin in admin menu
 *under 'Settings > Database'
 *
*/

function wp_db_menu() {

/*
 *	Add a link to our plugin in the admin menu
 *	under 'Settings > DATABASE'
 *
*/

add_options_page(
'Officialdb plugin',
'DB',
'manage_options',
'wp_db',
'wpdb_options_page'
);

}

add_action('admin_menu','wp_db_menu');

/*
 *Provides ability to administrator to create, edit, 
 *delete or simply view a table from the plugin's 
 *settings page
*/
function wpdb_options_page() {

	// When current user lacks priviledges to access plugin's settings page
	if( !current_user_can( 'manage_options' ) ) {
		wp_die( 'You do not have suggicient permissions to access this page.' );
	}

	global $plugin_url;
	global $wpdb;

	if(isset($_POST['db_form_submitted'])) {	
		$hidden_field=esc_html($_POST['db_form_submitted']);	
		if($hidden_field == 'Y') {	
			$db_name=esc_html($_POST['db_name']);
			$col_num=esc_html($_POST['col_num']);
			$options['$db_name']=$db_name;
			$options['$col_num']=$col_num;
			update_option('wp_plugin',$options);
		}
	}

$options=get_option('wp_plugin');

if(isset($_POST['value'])){
	$sql = "INSERT INTO " . $_GET['table'] . " values( ";
	$index = 0;
	foreach($_POST['value'] as $val) {
		if(!isset($_POST['value'][$index+1]))
			$sql = $sql . '"' . $val . '"';
		else
			$sql = $sql . '"' . $val . '"' . ", ";
		$index++;
	}
	$sql = $sql . " );";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
	
if(isset($_POST['del'])) {
	$sql = "DROP TABLE " . $_POST['tbname'] . ";";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	$wpdb->query($sql);
}

if(isset($_POST['col_name'][0])) {	
	$hidden_table=esc_html($_POST['db_table_submitted']);	
	if($hidden_table == 'Y') {
		global $table_prefix;
		$table_name = $table_prefix . $options['$db_name'];
		$qryx='';
		$qryy='';
		for($i = 0; $i < $options['$col_num']; $i++) {
			if($i == ($options['$col_num'])-1)
				$qryx = $qryx . $_POST['col_name'][$i] . " " . $_POST['col_type'][$i] . "(" . $_POST['col_len'][$i] . ")" . $_POST['nullx'][$i] . $_POST['autoincr'][$i] . $_POST['primary'][$i];
			else
				$qryx = $qryx . $_POST['col_name'][$i] . " " . $_POST['col_type'][$i] . "(" . $_POST['col_len'][$i] . ")" . $_POST['nullx'][$i] . $_POST['autoincr'][$i] . $_POST['primary'][$i] . ", ";						}
			$sql = 'CREATE TABLE '. $table_name ." ( ".$qryx." );";						
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
	}
	require( "inc/options_page_wrapper.php" );
}

class Wpdb_Plugin_Widget extends WP_Widget {

	function wpdb_plugin_widget() {
		// Instantiate the parent object
		parent::__construct( false, 'Xposed Database' );
	}
	
	function widget( $args, $instance ) {
		// Widget output
		extract( $args );
		$title = apply_filters( 'widget_title' , $instance['title'] );
		require( 'inc/front-end.php' );
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		$title = esc_attr($instance['title']);
		require( 'inc/widget-fields.php' );
	}
}

function wpdb_plugin_register_widgets() {
	// Enable plugin to appear on widgets
	register_widget( 'Wpdb_Plugin_Widget' );
}
add_action( 'widgets_init', 'wpdb_plugin_register_widgets' );

function wpdb_plugin_shortcode( $atts, $content = null ) {
	// Enable shortcodes for Wordpress post or page
	global $post;
	ob_start();
	require( 'inc/front-end.php' );
	$content = ob_get_clean();
	return $content;
}

// Shortcode to make the tables appear on Wordpress post or page
add_shortcode( 'xposeddb', 'wpdb_plugin_shortcode' );
?>
