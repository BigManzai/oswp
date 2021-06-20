<?php
/**
 * WordPress Widget oswp-splash
 *
 * 
 *
 * @package   Widget_oswp-splash
 * @author    Manfred Aabye <openmanniland@gmx.de>
 * @license   GPL-2.0+
 * @link      http://openmanniland.de
 * @copyright 2016-2019 Manfred Aabye
 *
 * @wordpress-plugin
 * Plugin Name:       oswp-splash
 * Plugin URI:        https://github.com/BigManzai/oswp/tree/master/oswp-splash
 * Description:       Splash Show information about the OpenSimulator. Please activate in the widget area and enter the MySQL data. You can create an extra page in WordPress and name this splash. Then enter this link to the Splash page in the Grid.ini under welcome = your-splash-site.com.
 * Version:           1.2.3
 * Author:            Manfred Aabye
 * Author URI:        http://openmanniland.de
 * Text Domain:       oswp-splash
 * License:           GPL-2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /lang
 * GitHub Plugin URI: https://github.com/BigManzai/oswp/tree/master/oswp-splash
 */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gettext.
 */
load_plugin_textdomain( 'oswp-splash', false, basename( dirname( __FILE__ ) ) . '/lang' );

// TODO: change 'oswp_splash' to the name of your plugin
class oswp_splash extends WP_Widget {

    protected $widget_slug = 'oswp-splash';

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'widget_textdomain' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'oswp-splash', $this->get_widget_slug() ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'OpenSim Statistic.', $this->get_widget_slug() )
			)
		);

		// Refreshing the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

	} // end constructor


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
		include( plugin_dir_path( __FILE__ ) . 'views/splash-widget.php' );
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
		// Schauen ob der Benutzer Admin Rechte hat.
		if (current_user_can('edit_plugins')) {
			// Erst jetzt kann die Datei splash-admin.php aufgerufen werden.
			include( plugin_dir_path(__FILE__) . 'views/splash-admin.php' );
		}
		
	} // end form


	public function widget_textdomain() {

		// TODO be sure to change 'oswp-splash' to the name of *your* plugin
		load_plugin_textdomain( $this->get_widget_slug(), false, plugin_dir_path( __FILE__ ) . 'lang/' );

	} // end widget_textdomain


	public function activate( $network_wide ) {
		// TODO define activation functionality here
	} // end activate


	public function deactivate( $network_wide ) {
		// TODO define deactivation functionality here
	} // end deactivate

} // end class


function oswp_splash_register_widget() {
register_widget('oswp_splash');
}
add_action('widgets_init', 'oswp_splash_register_widget');
