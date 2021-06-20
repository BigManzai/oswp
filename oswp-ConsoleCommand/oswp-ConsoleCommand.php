<!DOCTYPE html>
<?php
/**
 * WordPress Widget oswp-consolecommand
 *
 * 
 *
 * @package   Widget_oswp-consolecommand
 * @author    Manfred Aabye <openmanniland@gmx.de>
 * @license   GPL-2.0+
 * @link      http://openmanniland.de
 * @copyright 2016-2019 Manfred Aabye
 *
 * @wordpress-plugin
 * Plugin Name:       oswp-consolecommand
 * Plugin URI:        https://github.com/BigManzai/oswp-consolecommand
 * Description:       OpenSimulator WordPress Console Command only appears in the Admin menu. The plugin will be added to the left side of your dashboard menu. The plugin sends a freely selectable command to the OpenSimulator.
 * Version:           1.0.11
 * Author:            Manfred Aabye
 * Author URI:        http://openmanniland.de
 * Text Domain:       oswp-consolecommand
 * License:           GPL-2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /lang
 * GitHub Plugin URI: https://github.com/BigManzai/oswp-consolecommand
 */
// create oswp plugin settings menu
add_action('admin_menu', 'oswp_plugin_create_menu');

// Our filter callback function
function example_callback( $string, $arg1, $arg2 ) {
    // (maybe) modify $string
    return $string;
}
add_filter( 'example_filter', 'example_callback', 10, 3 );

// Gettext
/* Make theme available for translation */
	load_plugin_textdomain( 'oswp-consolecommand', false, basename( dirname( __FILE__ ) ) . '/lang' );

function oswp_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('oswp Plugin Settings', 'OS Commands', 'administrator', __FILE__, 'oswp_plugin_settings_page' , plugins_url('/images/oswp20.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_oswp_plugin_settings' );
}


function register_oswp_plugin_settings() {
	//register our settings
	register_setting( 'oswp-plugin-settings-group', 'oswp_BaseURL' );
	register_setting( 'oswp-plugin-settings-group', 'oswp_ConsolePass' );
	register_setting( 'oswp-plugin-settings-group', 'oswp_ConsolePort' );
	register_setting( 'oswp-plugin-settings-group', 'oswp_ConsoleName' );	
}

function oswp_plugin_settings_page() { ?>
	
<!-- 
	OpenSim Console Commands V1.0.11 by Manfred Aabye
 -->
<title>OS Console</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body class="w3-theme-l4">

<a id="start"></a>
	
<div style="min-width:400px">

<!-- Kopfzeile -->
	<div class="w3-bar w3-third w3-large w3-theme-d4" onclick="w3_open()"><a href="#" class="w3-bar-item"></a></button>
		<span class="w3-bar-item"><?php echo esc_html__( 'OpenSimulator Console Commands', 'oswp-consolecommand' ) ; ?></span>
	</div>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-card w3-half w3-sand " style="right:0">
	<ul class="w3-ul w3-sand">
		<b>
			<?php echo '<li>' . esc_html__( '-------------------------------------------------------', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'OpenSim Console', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( '-------------------------------------------------------', 'oswp-consolecommand' ) . '</li>'; ?>
			
			<?php echo '<li>' . esc_html__( 'alert - Send an alert to everyone', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'alert-user firstname lastname message - Send an alert to a user', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'appearance find uuid-or-start-of-uuid - Find out which avatar uses the given asset as a baked texture, if any.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'appearance rebake first-name last-name - Send a request to the users viewer for it to rebake and reupload its appearance textures.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'appearance send first-name last-name - Send appearance data for each avatar in the simulator to other viewers.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'appearance show first-name last-name - Show appearance information for avatars.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'attachments show first-name last-name - Show attachment information for avatars in this simulator.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'backup - Persist currently unsaved object changes immediately instead of waiting for the normal persistence call.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'bypass permissions true / false - Bypass permission checks', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'change region region name - Change current console region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'clear image queues first-name last-name - Clear the image queues textures downloaded via UDP for a particular client.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'command-script script - Run a command script from file', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config get section key - Synonym for config show', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config save path - Save current configuration to a file at the given path', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config set section key value - Set a config option.  In most cases this is not useful since changed parameters are not dynamically reloaded.  Neither do changed parameters persist - you will have to change a config file manually and restart.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config show section key - Show config information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'create region region name region_file.ini - Create a new region.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug attachments log 0|1 - Turn on attachments debug logging', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug attachments status - Show current attachments debug status', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug eq 0|1|2 - Turn on event queue debugging = 0 - turns off all event queue logging = 1 - turns on event queue setup and outgoing event logging = 2 - turns on poll notification', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug groups messaging verbose true|false - This setting turns on very verbose groups messaging debugging', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug groups verbose true|false - This setting turns on very verbose groups debugging', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug http in|out|all level - Turn on http request logging.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug jobengine start|stop|status|log - Start, stop, get status or set logging level of the job engine.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug permissions true / false - Turn on permissions debugging', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug scene get - List current scene options.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug scene set param value - Turn on scene debugging options.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug scripts log item-id log-level - Extra debug logging for a particular script.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug threadpool level 0..3 - Turn on logging of activity in the main thread pool.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug threadpool set worker|iocp min|max n - Set threadpool parameters.  For debug purposes.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug threadpool status - Show current debug threadpool parameters.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug xengine log level - Turn on detailed xengine debugging.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete object creator UUID - Delete scene objects by creator', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete object id UUID-or-localID - Delete a scene object by uuid or localID', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete object name --regex name - Delete a scene object by name.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete object outside - Löscht alle Szenenobjekte außerhalb der Regionsgrenzen', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete object owner UUID - Delete scene objects by owner', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete object pos start x, start y , start z end x, end y, end z - Delete scene objects within the given volume.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete-region name - Delete a region from disk', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'dump asset id - Dump an asset', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'dump object id UUID-or-localID - Dump the formatted serialization of the given object to the file UUID.xml', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'edit scale name x y z - Change the scale of a named prim', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'estate create owner UUID estate name - Creates a new estate with the specified name, owned by the specified user. Estate name must be unique.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'estate link region estate ID region ID - Attaches the specified region to the specified estate.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'estate set name estate-id new name - Sets the name of the specified estate to the specified value. New name must be unique.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'estate set owner estate-id UUID | Firstname Lastname  - Sets the owner of the specified estate to the specified UUID or user.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'estate show - Shows all estates on the simulator.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'export-map path - Save an image of the world map', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'fcache assets - Attempt a deep scan and cache of all assets in all scenes', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'fcache clear file memory - Remove all assets in the cache.  If file or memory is specified then only this cache is cleared.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'fcache expire datetime - Purge cached assets older then the specified date/time', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'fcache status - Display cache status', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'force gc - Manually invoke runtime garbage collection.  For debugging purposes', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'force permissions true / false - Force permissions on or off', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'force update - Force the update of all objects on clients', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'friends show --cache first-name last-name - Show the friends for the given user if they exist.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'generate map - Generates and stores a new maptile.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'get log level - Get the current console logging level', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'help item - Display help on a particular command or on a list of commands in a category', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'help Terrain - Get help on plugin command terrain', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'help Tree - Get help on plugin command tree', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'help Windlight - Get help on plugin command windlight', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'j2k decode ID - Do JPEG2000 decoding of an asset.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'kick user first last --force message - Kick a user off the simulator', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'land clear - Clear all the parcels from the region.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'land show local-land-id - Show information about the parcels on the region.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'link-mapping x y - Set local coordinate to map HG regions to', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'link-region Xloc Yloc ServerURI RemoteRegionName - Link a HyperGrid Region. Examples for ServerURI: http://grid.net:8002/ or http://example.org/path/foo.php', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'load iar -m|--merge first last inventory path password IAR path - Load user inventory archive IAR.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'load oar -m|--merge -s|--skip-assets --default-user User Name --force-terrain --force-parcels --no-objects --rotation degrees --bounding-origin x,y,z --bounding-size x,y,z --displacement x,y,z -d|--debug OAR path - Load a regions data from an OAR archive.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'load xml file name -newUID x y z - Load a regions data from XML format', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'load xml2 file name - Load a regions data from XML2 format', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'login disable - Disable simulator logins', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'login enable - Enable simulator logins', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'login status - Show login status', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'monitor report - Returns a variety of statistics about the current region and/or simulator', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'physics get param|ALL - Get physics parameter from currently selected region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'physics list - List settable physics parameters', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'physics set param value|TRUE|FALSE localID|ALL - Set physics parameter from currently selected region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'quit - Quit the application', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'region get - Show control information for the currently selected region host name, max physical prim size, etc.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'region restart abort message - Abort a region restart', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'region restart bluebox message delta seconds+ - Schedule a region restart', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'region restart notice message delta seconds+ - Schedule a region restart', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'region set - Set control information for the currently selected region.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'remove-region name - Remove a region from this simulator', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'reset user cache - reset user cache to allow changed settings to be applied', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'restart - Restart the currently selected regions in this instance', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'rotate scene degrees centerX, centerY - Rotates all scene objects around centerX, centerY default 128, 128 please back up your region before using.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'save iar -h|--home=url --noassets first last inventory path password IAR path -c|--creators -e|--exclude=name/uuid -f|--excludefolder=foldername/uuid -v|--verbose - Save user inventory archive IAR.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'save oar -h|--home=url --noassets --publish --perm=permissions --all OAR path - Save a regions data to an OAR archive.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'save prims xml2 prim name file name - Save named prim to XML2', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'save xml file name - Save a regions data in XML format', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'save xml2 file name - Save a regions data in XML2 format', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'scale scene factor - Scales the scene objects please back up your region before using', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'scripts resume script-item-uuid+ - Resumes all suspended scripts', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'scripts show script-item-uuid+ - Show script information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'scripts start script-item-uuid+ - Starts all stopped scripts', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'scripts stop script-item-uuid+ - Stops all running scripts', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'scripts suspend script-item-uuid+ - Suspends all running scripts', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'set log level level - Set the console logging level for this session.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'set terrain heights corner min max x y - Sets the terrain texture heights on corner #corner to min/max, if x or y are specified, it will only set it on regions with a matching coordinate. Specify -1 in x or y to wildcard that coordinate. Corner # SW = 0, NW = 1, SE = 2, NE = 3, all corners = -1.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'set terrain texture number uuid x y - Sets the terrain number to uuid, if x or y are specified, it will only set it on regions with a matching coordinate. Specify -1 in x or y to wildcard that coordinate.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'set water height height x y - Sets the water height in meters.  If x and y are specified, it will only set it on regions with a matching coordinate. Specify -1 in x or y to wildcard that coordinate.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show animations first-name last-name - Show animation information for avatars in this simulator.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show appearance first-name last-name - Synonym for appearance show', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show asset ID - Show asset information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show caps list - Shows list of registered capabilities for users.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show caps stats by cap cap-name - Shows statistics on capabilities use by capability.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show caps stats by user first-name last-name - Shows statistics on capabilities use by user.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show checks - Show checks configured for this server', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show circuits - Show agent circuit data', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show connections - Show connection data', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show eq - Show contents of event queues for logged in avatars.  Used for debugging.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show http-handlers - Show all registered http handlers', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show hyperlinks - List the HG regions', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show image queues first-name last-name - Show the image queues textures downloaded via UDP for a particular client.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show info - Show general information about the server', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show modules - Show module data', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show name uuid - Show the bindings between a single user UUID and a user name', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show names - Show the bindings between user UUIDs and user names', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show neighbors - Shows the local region neighbors', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show object id --full UUID-or-localID - Show details of a scene object with the given UUID or localID', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show object name --full --regex name - Show details of scene objects with the given name.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show object owner --full OwnerID - Show details of scene objects with given owner.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show object pos --full start x, start y , start z end x, end y, end z - Show details of scene objects within give volume', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show part id UUID-or-localID - Show details of a scene object part with the given UUID or localID', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show part name --regex name - Show details of scene object parts with the given name.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show part pos start x, start y , start z end x, end y, end z - Show details of scene object parts within the given volume.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show pending-objects - Show # of objects on the pending queues of all scene viewers', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show pqueues full - Show priority queue data for each client', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show queues full - Show queue data for each client', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show ratings - Show rating data', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show region - Show control information for the currently selected region host name, max physical prim size, etc.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show regions - Show region data', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show regionsinview - Shows regions that can be seen from a region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show scene - Show live information for the currently selected scene fps, prims, etc.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show script sensors - Show script sensors information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show script timers - Show script sensors information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show scripts script-item-uuid+ - Show script information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show stats - show useful statistical information for this server. See Frame Statistics Values below for more information.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show threadpool calls complete - Show details about threadpool calls that have been completed.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show threads - Show thread status', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show throttles full - Show throttle settings for each client and for the server overall', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show uptime - Show server uptime', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show users full - Show user data for users currently on the region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show version - Show server version', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'shutdown - Quit the application', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sit user name --regex first-name last-name - Sit the named user on an unoccupied object with a sit target.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'stand user name --regex first-name last-name - Stand the named user.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'stats record start|stop - Control whether stats are being regularly recorded to a separate file.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'stats save path - Save stats snapshot to a file.  If the file already exists, then the report is appended.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'stats show - a synonym for show stats - Show statistical information for this server', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun current_time value - time in seconds of the simulator', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun day_length value - number of hours to a day', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun day_night_offset value - induces a horizon shift', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun day_time_sun_hour_scale value - scales day light vs nite hours to change day/night ratio', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun help - list parameters that can be changed', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun list - list parameters that can be changed', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun update_interval value - how often to update the suns position in frames', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'sun year_length value - number of days to a year', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'teleport user first-name last-name destination - Teleport a user in this simulator to the given destination', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain bake - Saves the current terrain into the regions baked map.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain effect - Runs a specified plugin effect.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain elevate - Raises the current heightmap by the specified amount.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain fill - Fills the current heightmap with a specified value.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain flip - Flips the current terrain about the X or Y axis.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain load - Loads a terrain from a specified file.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain load-tile - Loads a terrain from a section of a larger file.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain lower - Lowers the current heightmap by the specified amount.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain max - Sets the maximum terrain height to the specified value.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain min - Sets the minimum terrain height to the specified value.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain modify operation value area taper - Modifies the terrain as instructed.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain multiply - Multiplies the heightmap by the value specified.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain newbrushes - Enables experimental brushes which replace the standard terrain brushes.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain rescale - Rescales the current terrain to fit between the given min and max heights.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain revert - Loads the baked map terrain into the regions heightmap.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain save - Saves the current heightmap to a specified file.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain save-tile - Saves the current heightmap to the larger file.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain show - Shows terrain height at a given co-ordinate.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'terrain stats - Shows some information about the regions heightmap for debugging purposes.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'threads abort thread-id - Abort a managed thread.  Use show threads to find possible threads.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'threads show - Show thread status.  Synonym for show threads', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'translate scene xOffset yOffset zOffset - translates the scene objects please back up your region before using', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree active - Change activity state for the trees module.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree freeze - Freeze/Unfreeze activity for a defined copse.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree load - Load a copse definition from an xml file.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree plant - Start the planting on a copse.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree rate - Reset the tree update rate mSec.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree reload - Reload copse definitions from the in-scene trees.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree remove - Remove a copse definition and all its in-scene trees.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'tree statistics - Log statistics about the trees.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'unlink-region local name - Unlink a hypergrid region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'vivox debug on|off - Set vivox debugging', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wearables check first-name last-name - Check that the wearables of a given avatar in the scene are valid.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wearables show first-name last-name - Show information about wearables for avatars.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wind base wind_update_rate value - Get or set the wind update rate.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wind ConfigurableWind avgDirection value - average wind direction in degrees', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wind ConfigurableWind avgStrength value - average wind strength', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wind ConfigurableWind rateChange value - rate of change', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wind ConfigurableWind varDirection value - allowable variance in wind direction in +/- degrees', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wind ConfigurableWind varStrength value - allowable variance in wind strength', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'wind SimpleRandomWind strength value - wind strength', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'windlight disable - Disable the windlight plugin.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'windlight enable - Enable the windlight plugin.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'windlight load - Load windlight profile from the database and broadcast.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'xengine status - Show status information', 'oswp-consolecommand' ) . '</li>'; ?>
			
			<?php echo '<li>' . esc_html__( '-------------------------------------------------------', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'Robust Console', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( '-------------------------------------------------------', 'oswp-consolecommand' ) . '</li>'; ?>
			
			<?php echo '<li>' . esc_html__( 'delete asset -ID- - Delete asset from database', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'dump asset -ID- - Dump asset to a file', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show asset -ID- - Show asset information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show http-handlers - Show all registered http handlers', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug http -in|out|all- --level-- - Turn on http request logging.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug jobengine -start|stop|status|log- - Start, stop, get status or set logging level of the job engine.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug threadpool level 0..3 - Turn on logging of activity in the main thread pool.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug threadpool set worker|iocp min|max -n- - Set threadpool parameters.  For debug purposes.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'debug threadpool status - Show current debug threadpool parameters.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'force gc - Manually invoke runtime garbage collection.  For debugging purposes', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show threadpool calls complete - Show details about threadpool calls that have been completed.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'threads abort -thread-id- - Abort a managed thread.  Use "show threads" to find possible threads.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'delete bakes -ID- - Delete agents baked textures from server', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'command-script -script- - Run a command script from file', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config get --section-- --key-- - Synonym for config show', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config save -path- - Save current configuration to a file at the given path', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config set -section- -key- -value- - Set a config option.  ', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'config show --section-- --key-- - Show config information', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'get log level - Get the current console logging level', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'quit - Quit the application', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'set log level -level- - Set the console logging level for this session.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show checks - Show checks configured for this server', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show grid size - Show the current grid size (excluding hyperlink references)', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show info - Show general information about the server', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show stats -list|all|(-category--.-container--)+ - Alias for stats show command', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show threads - Show thread status', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show uptime - Show server uptime', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show version - Show server version', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'shutdown - Quit the application', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'stats record start|stop - Control whether stats are being regularly recorded to a separate file.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'stats save -path- - Save stats snapshot to a file.  If the file already exists, then the report is appended.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'stats show -list|all|(-category--.-container--)+ - Show statistical information for this server', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'threads show - Show thread status.  Synonym for "show threads"', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'link-mapping --x- -y-- - Set local coordinate to map HG regions to', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'link-region -Xloc- -Yloc- -ServerURI- --RemoteRegionName-- - Link a HyperGrid Region. ', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show hyperlinks - List the HG regions', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'unlink-region -local name- - Unlink a hypergrid region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin add "plugin index" - Install plugin from repository.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin disable "plugin index" - Disable a plugin', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin enable "plugin index" - Enable the selected plugin plugin', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin info "plugin index" - Show detailed information for plugin', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin list available - List available plugins', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin list installed - List install plugins', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin remove "plugin index" - Remove plugin from repository', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin update "plugin index" - Update the plugin', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'plugin updates - List available updates', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'deregister region id -region-id-+ - Deregister a region manually.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'set region flags -Region name- -flags- - Set database flags for region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show region at -x-coord- -y-coord- - Show details on a region at the given co-ordinate.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show region name -Region name- - Show details on a region', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show regions - Show details on all regions', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'repo add "url" - Add repository', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'repo disable"-url | index-" - Disable registered repository', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'repo enable "-url | index-" - Enable registered repository', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'repo list - List registered repositories', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'repo refresh "url" - Sync with a registered repository', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'repo remove "-url | index-" - Remove repository from registry', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'create user --first- --last- --pass- --email- --user id- --model-- - Create a new user', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'login level -level- - Set the minimum user level to log in', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'login reset - Reset the login level to allow all users', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'login text -text- - Set the text users will see on login', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'reset user email --first- --last- --email-- - Reset a user email address', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'reset user password --first- --last- --password-- - Reset a user password', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'set user level --first- --last- --level-- - Set user level. ', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show account -first- -last- - Show account details for the given user', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show grid user -ID- - Show grid user entry.', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'show grid users online - Show number of grid users registered as online.', 'oswp-consolecommand' ) . '</li>'; ?>
	
			<?php echo '<li>' . esc_html__( '-------------------------------------------------------', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( 'End of Commands', 'oswp-consolecommand' ) . '</li>'; ?>
			<?php echo '<li>' . esc_html__( '-------------------------------------------------------', 'oswp-consolecommand' ) . '</li>'; ?>
		</b>
	</ul>
</div>

<!-- Post es klingelt das Telefon -->
<?php if (!isset($_POST['telefon'])): ?>

<!-- Start Abfrage Nutzer -->
<form class="w3-container w3-card-4 w3-light-gray" style="width:40%" action="" method="post">
    <input type="hidden" name="telefon" value="1" />
	
<!-- OpenSim Einstellung --> 
	<div class="w3-row w3-section">
	<p><label class="w3-text"><i class="fa fa-cogs" style="font-size:48px;color:grey"></i></label></p>
    <p><label for="base" class="w3-label control-label"><i class="fa fa-pencil" style="font-size:24px"></i>   OpenSim or Robust IP:</b></label></p>
        <div class="w3-half">
            <p><input class="w3-input w3-border w3-pale-green w3-bottombar" type="text" placeholder="127.0.0.1" name="OpenSim_IP"/></p>
        </div>
    </div>
 
	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-pencil" style="font-size:24px"></i>   OpenSim or Robust Port:</b></label></p>
        <div class="w3-third">
            <p><input class="w3-input w3-border w3-pale-green w3-bottombar" type="text" placeholder="9000" name="OpenSim_Port"/></p>
        </div>
    </div>

 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-pencil" style="font-size:24px"></i>   OpenSim or Robust Password:</b></label></p>
        <div class="w3-threequarter">
            <p><input class="w3-input w3-border w3-pale-green w3-bottombar" type="password" placeholder="secret" name="OpenSim_Password"/></p>
        </div>
    </div>
	
 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-pencil" style="font-size:24px"></i>   Robust Name:</b></label></p>
        <div class="w3-threequarter">
            <p><input class="w3-input w3-border w3-pale-green w3-bottombar" type="text" placeholder="Robust Console Name (empty for OpenSim)" name="OpenSim_Name"/></p>
        </div>
    </div>

<br>

<!-- Command Eingabe --> 
 	<div class="w3-row w3-section">
	<p><label class="w3-text"><i class="glyphicon glyphicon-file" style="font-size:48px;color:grey"></i></label></p>
    <p><label for="base" class="w3-label control-label"><i class="fa fa-pencil" style="font-size:24px"></i>   OpenSim or Robust Command:</b></label></p>
        <div class="">
            <input class="w3-input w3-border w3-sand w3-bottombar" type="text" placeholder="shutdown" name="OpenSim_Command"/>
        </div>
    </div> 
<br>
 

<!-- Command Button -->
    <div class="w3-row w3-section">
	<div class="w3-third">
        <button class="w3-btn w3-green w3-border w3-bottombar" type="submit" name="submit"><i class="fa fa-mail-forward" style="font-size:24px"></i>     OK send</button>
		<!-- <input type="submit" name="senden" value="senden" onclick="senden()" /> -->
		<!-- <button class="w3-btn w3-red w3-border w3-bottombar" type="reset" name="Reset"><i class="fa fa-mail-reply" style="font-size:24px"></i>  Reset</button> -->
	</div>
    </div>
<br>

</form>
<?php endif ?>	
</div>



<?php
// Eingaben auswerten und Senden
function senden() 
{
	if (isset($_POST['telefon']) AND $_POST['telefon'] == 1)
		{
			// wir schaffen unsere Variablen und alle Leerzeichen beiläufig entfernen	

			$OpenSim_IP   = trim($_POST['OpenSim_IP']);
			$OpenSim_Port   = trim($_POST['OpenSim_Port']);
			$OpenSim_Password  = $_POST['OpenSim_Password'];
			$OpenSim_Name  = $_POST['OpenSim_Name'];
			$OpenSim_Command   = trim($_POST['OpenSim_Command']);
			
			// Einlesen der RemoteAdmin Datei.
			include('RemoteAdmin.php');
			 
			// Mit OpenSim verbinden
			//$myRemoteAdmin = new RemoteAdmin($OpenSim_IP, $OpenSim_Port, $OpenSim_Password);
			$myRemoteAdmin = new RemoteAdmin($OpenSim_IP, $OpenSim_Port, $OpenSim_Password, $OpenSim_Name);
			 
			// OpenSim Konsolenbefehl samt parameter senden
			$parameters = array('command' => $OpenSim_Command);
			$myRemoteAdmin->SendCommand('admin_console_command', $parameters);
			// Jetzt die Seite neu starten auffrischen oder sowas aber die Eingaben verschwindet leider
			?>
			<!-- <meta http-equiv="refresh" content="0; URL=#Top"> --> 
			<meta http-equiv="refresh" content="0; URL=#start">
			<?php
		}
}

// Die Funktion senden aufrufen
senden();
?>

</div></body></html>	

<?php } ?>