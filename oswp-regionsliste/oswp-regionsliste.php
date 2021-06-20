<?php
/**
 * WordPress Widget oswp-regionsliste
 *
 * 
 *
 * @package   Widget_oswp-regionsliste
 * @author    Manfred Aabye <openmanniland@gmx.de>
 * @license   GPL-2.0+
 * @link      http://openmanniland.de
 * @copyright 2016-2019 Manfred Aabye
 *
 * @wordpress-plugin
 * Plugin Name:       oswp-regionsliste
 * Plugin URI:        https://github.com/BigManzai/oswp-regionsliste
 * Description:       The OpenSim plugin/widget displays the current region list. Please activate in the widget area and enter the MySQL data of the database.
 * Version:           1.2.0
 * Author:            Manfred Aabye
 * Author URI:        http://openmanniland.de
 * Text Domain:       oswp-regionsliste
 * License:           GPL-2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /lang
 * GitHub Plugin URI: https://github.com/BigManzai/oswp-regionsliste
 */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gettext.
 */
load_plugin_textdomain( 'oswp-regionsliste', false, basename( dirname( __FILE__ ) ) . '/lang' );

// TODO: change 'oswp_regionsliste' to the name of your plugin
class oswp_regionsliste extends WP_Widget {

    protected $widget_slug = 'oswp-regionsliste';

	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'widget_textdomain' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'oswp-regionsliste', $this->get_widget_slug() ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'OpenSim Statistic.', $this->get_widget_slug() )
			)
		);

		// Refreshing the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

	} 
	
    public function get_widget_slug() {
        return $this->widget_slug;
    }

	public function widget( $args, $instance ) {

		
		// Check if there is a cached output
		$cache = wp_cache_get( $this->get_widget_slug(), 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset ( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset ( $cache[ $args['widget_id'] ] ) )
			return print $cache[ $args['widget_id'] ];
		
		// go on with your widget logic, put everything into a string and …


		extract( $args, EXTR_SKIP );

		$widget_string = $before_widget;

		// TODO: Here is where you manipulate your widget's values based on their input fields
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'views/regionsliste-widget.php' );
		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;


		$cache[ $args['widget_id'] ] = $widget_string;

		wp_cache_set( $this->get_widget_slug(), $cache, 'widget' );

		print $widget_string;

	} // end widget
	
	public function flush_widget_cache() 
	{
    	wp_cache_delete( $this->get_widget_slug(), 'widget' );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		// TODO: Here is where you update your widget's old values with the new, incoming values

		return $instance;

	} // end widget

	public function form( $instance ) {

		// TODO: Define default values for your variables
		$instance = wp_parse_args(
			(array) $instance
		);

		// Display the admin form
		// Das Admin-Formular anzeigen
		include( plugin_dir_path(__FILE__) . 'views/regionsliste-admin.php' );

	} 
	
	public function widget_textdomain() {

		// TODO be sure to change 'oswp-regionsliste' to the name of *your* plugin
		load_plugin_textdomain( $this->get_widget_slug(), false, plugin_dir_path( __FILE__ ) . 'lang/' );

	} 
	
	public function activate( $network_wide ) {
		// TODO define activation functionality here
	} 
	
	public function deactivate( $network_wide ) {
		// TODO define deactivation functionality here
	} // end deactivate

	public function register_widget_scripts() {

		wp_enqueue_script( $this->get_widget_slug().'-script', plugins_url( 'js/widget.js', __FILE__ ), array('jquery') );

	} // end register_widget_scripts
	
} // end class

function oswp_regionsliste_register_widget() {
register_widget('oswp_regionsliste');
}
add_action('widgets_init', 'oswp_regionsliste_register_widget');