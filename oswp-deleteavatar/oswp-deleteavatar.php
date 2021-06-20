<?php
/**
 * WordPress Widget oswp-deleteavatar
 *
 * 
 *
 * @package   Widget_oswp-deleteavatar
 * @author    Manfred Aabye <openmanniland@gmx.de>
 * @license   GPL-2.0+
 * @link      http://openmanniland.de
 * @copyright 2016-2019 Manfred Aabye
 *
 * @wordpress-plugin
 * Plugin Name:       oswp-deleteavatar
 * Plugin URI:        https://github.com/BigManzai/oswp-deleteavatar
 * Description:       OpenSimulator WordPress Delete Avatar dashboard menu.
 * Version:           1.0.17
 * Author:            Manfred Aabye
 * Author URI:        http://openmanniland.de
 * Text Domain:       oswp-deleteavatar
 * License:           GPL-2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /lang
 * GitHub Plugin URI: https://github.com/BigManzai/oswp-deleteavatar
 */

// create oswp plugin settings menu
add_action('admin_menu', 'oswp_plugin_create_menu2');

// Our filter callback function
function example_callback2( $string, $arg1, $arg2 ) {
    // (maybe) modify $string
    return $string;
}

add_filter( 'example_filter2', 'example_callback2', 10, 3 );

// Gettext einfügen
load_plugin_textdomain( 'oswp-deleteavatar', false, basename( dirname( __FILE__ ) ) . '/lang' );

function oswp_plugin_create_menu2() {

	//create new top-level menu
	add_menu_page('oswp Plugin Settings', 'OS Delete Avatar', 'administrator', __FILE__, 'oswp_plugin_settings_page2' , plugins_url('/images/oswp20.png', __FILE__) );

	//call register settings function
	//add_action( 'admin_init', 'register_oswp_plugin_settings2' );
}

function register_oswp_plugin_settings2() {
	//register our settings
	register_setting( 'oswp-plugin-settings-group2', 'oswp_BaseURL' );
	register_setting( 'oswp-plugin-settings-group2', 'oswp_ConsolePass' );
	register_setting( 'oswp-plugin-settings-group2', 'oswp_ConsolePort' );
	register_setting( 'oswp-plugin-settings-group2', 'oswp_ConsoleName' );	
}

function oswp_plugin_settings_page2() { ?>


<img src="/wp-content/plugins/oswp-deleteavatar/images/oswp256.png" alt=" " name="oswp32.png" align="left" height="60" width="60"/>
<h1><font color="red"><?php echo esc_html__( '  Delete OpenSim User from MySQL Database', 'oswp-deleteavatar' ); ?></h1><font color="black"><br>
 
<!-- Post es klingelt - deleteavatar -->
<?php if (!isset($_POST['deleteavatar'])): ?>

<form action="" method="post">
    <input type="hidden" name="deleteavatar" value="1" />
		
<body dir="ltr">
<form name="Formular">
	<table width="590" cellpadding="6" cellspacing="0" style="page-break-before: always; page-break-inside: avoid">
		<col width="200"/>

		<col width="200"/>

		<tr valign="top">
			<td width="100" style="border-top: 1px double #808080; border-bottom: 1px double #808080; border-left: 1px double #808080; border-right: none; padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 0px"><p>
			<input type="checkbox" name="UserAccounts" value="UserAccounts" checked> UserAccounts<br>
			<input type="checkbox" name="auth" value="auth" checked> auth<br>
			<input type="checkbox" name="Avatars" value="Avatars" checked> Avatars<br>
			<input type="checkbox" name="Friends" value="Friends" checked> Friends<br>
			<input type="checkbox" name="tokens" value="tokens" checked> tokens<br>
			<input type="checkbox" name="GridUser" value="GridUser" checked> GridUser<br>
			<input type="checkbox" name="inventoryfolders" value="inventoryfolders" checked> inventoryfolders<br>
			<input type="checkbox" name="inventoryitems" value="inventoryitems" checked> inventoryitems<br>
			
			<input type="checkbox" name="AgentPrefs" value="AgentPrefs" checked> AgentPrefs<br>
			<input type="checkbox" name="classifieds" value="classifieds" checked> classifieds<br>
			<input type="checkbox" name="os_groups_groups" value="os_groups_groups" checked> os_groups_groups<br>
			<input type="checkbox" name="os_groups_invites" value="os_groups_invites" checked> os_groups_invites<br>
			<input type="checkbox" name="os_groups_membership" value="os_groups_membership" checked> os_groups_membership<br>
			<input type="checkbox" name="os_groups_principals" value="os_groups_principals" checked> os_groups_principals<br>
			<input type="checkbox" name="os_groups_rolemembership" value="os_groups_rolemembership" checked> os_groups_rolemembership<br>
			<input type="checkbox" name="userpicks" value="userpicks" checked> userpicks<br>
			<input type="checkbox" name="userprofile" value="userprofile" checked> userprofile<br>
			<input type="checkbox" name="usersettings" value="usersettings" checked> usersettings<br>
			
			<input type="checkbox" name="estate_managers" value="estate_managers" checked> estate_managers<br>
			<input type="checkbox" name="estate_users" value="estate_users" checked> estate_users<br>
			<input type="checkbox" name="estateban" value="estateban" checked> estateban<br>
			<input type="checkbox" name="landaccesslist" value="landaccesslist" checked> landaccesslist<br>
			<input type="checkbox" name="regionban" value="regionban" checked> regionban<br>
			</td>
			<td width="200" style="border: 1px double #808080; padding: 3px"><p>
			<?php echo esc_html__( 'Server :', 'oswp-deleteavatar' )."<br>"; ?>
			<input type="text" name="CONF_db_server" value="127.0.0.1" maxlength="40"><br><br>

			<?php echo esc_html__( 'Database name :', 'oswp-deleteavatar' )."<br>"; ?>
			<input type="text" name="CONF_db_database" placeholder="opensim" maxlength="40"><br><br>
			
			<?php echo esc_html__( 'Database User name :', 'oswp-deleteavatar' )."<br>"; ?>
			<input type="text" name="CONF_db_user" placeholder="JohnDoe" maxlength="40"><br><br>

			<?php echo esc_html__( 'Database User Passwd :', 'oswp-deleteavatar' )."<br>"; ?>
			<input type="password" name="CONF_db_pass" placeholder="paswd123" maxlength="40"><br><br>
			
			<?php echo esc_html__( 'Delete User UUID :', 'oswp-deleteavatar' )."<br>"; ?>
			<input type="text" name="CONF_db_uuid" placeholder="UUID" maxlength="40"><br><br>
			
			<button class="btn btn-danger" type="submit" name="submit" value="Download" ><?php echo esc_html__( 'Delete Avatar', 'oswp-deleteavatar' ); ?></button>
			<button class="btn btn-danger" type="reset" ><?php echo esc_html__( 'Reset', 'oswp-deleteavatar' ); ?></button>
				<p><br/>

				</p>
			</td>
		</tr>
	</table>
</form>
<p><br/>
<br/>

</p>
</body>	

</form>

<?php endif ?>	

<?php
// Daten Empfang
if (isset($_POST['deleteavatar']) AND $_POST['deleteavatar'] == 1){

	// wir schaffen unsere Variablen
	//$CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database 

	$CONF_db_server = $_POST['CONF_db_server']; //server http or IP, string value use: %s
	$CONF_db_user = $_POST['CONF_db_user']; //database user name, string value use: %s
	$CONF_db_pass = $_POST['CONF_db_pass']; //database password, string value use: %s
	$CONF_db_database = $_POST['CONF_db_database']; //database name, string value use: %s
	$CONF_db_uuid = $_POST['CONF_db_uuid']; //UUID, string value use: %s

// Verbindung zur Datenbank herstellen
$conn = mysqli_connect($CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database);

// Verbindung Pruefen
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Checkbox abfrage
// <input type="hidden" name="checkboxname" value="-1"><input type="checkbox" name="checkboxname" value="beliebiger value">
// if (isset($_POST['checkboxname']) AND $_POST['checkboxname'] != -1){  }
// oder
// if ($_POST["checkboxname"]) {  }

// ##### Delete Grid Avatar #####
if ($_POST["UserAccounts"])
	{
		$sql1 = "DELETE FROM UserAccounts WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql1)) {
			echo "Record UserAccounts deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["auth"])
	{
		$sql2 = "DELETE FROM auth WHERE UUID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql2)) {
			echo "Record auth deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["Avatars"])
	{
		$sql3 = "DELETE FROM Avatars WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql3)) {
			echo "Record Avatars deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["Friends"])
	{
		$sql4 = "DELETE FROM Friends WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql4)) {
			echo "Record Friends deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["tokens"])
	{
		$sql5 = "DELETE FROM tokens WHERE UUID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql5)) {
			echo "Record tokens deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["GridUser"])
	{
		$sql6 = "DELETE FROM GridUser WHERE UserID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql6)) {
			echo "Record GridUser deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["inventoryfolders"])
	{
		$sql7 = "DELETE FROM inventoryfolders WHERE agentID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql7)) {
			echo "Record inventoryfolders deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["inventoryitems"])
	{
		$sql8 = "DELETE FROM inventoryitems WHERE avatarID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql8)) {
			echo "Record inventoryitems deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
// ##### Robust Fehlende Einträge #####
if ($_POST["AgentPrefs"])
	{
		//AgentPrefs = PrincipalID
		$sql9 = "DELETE FROM AgentPrefs WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql9)) {
			echo "Record AgentPrefs deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["classifieds"])
	{
		//classifieds = creatoruuid
		$sql20 = "DELETE FROM classifieds WHERE creatoruuid='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql20)) {
			echo "Record classifieds deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["os_groups_groups"])
	{
		//os_groups_groups = FounderID
		$sql21 = "DELETE FROM os_groups_groups WHERE FounderID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql21)) {
			echo "Record os_groups_groups deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["os_groups_invites"])
	{
		//os_groups_invites = PrincipalID
		$sql22 = "DELETE FROM os_groups_invites WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql22)) {
			echo "Record os_groups_invites deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["os_groups_membership"])
	{
		//os_groups_membership = PrincipalID
		$sql23 = "DELETE FROM os_groups_membership WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql23)) {
		echo "Record os_groups_membership deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["os_groups_principals"])
	{
		//os_groups_principals = PrincipalID
		$sql24 = "DELETE FROM os_groups_principals WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql24)) {
			echo "Record os_groups_principals deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["os_groups_rolemembership"])
	{
		//os_groups_rolemembership = PrincipalID
		$sql25 = "DELETE FROM os_groups_rolemembership WHERE PrincipalID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql25)) {
			echo "Record os_groups_rolemembership deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
/* if ($_POST["regions"])
	{
		//regions = owner_uuid ##### loescht ganze regionen wenn user der owner ist auch wenn sie ihm nicht gehoert
		$sql26 = "DELETE FROM regions WHERE owner_uuid='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql26)) {
			echo "Record regions deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	} */
if ($_POST["userpicks"])
	{
		//userpicks = creatoruuid
		$sql27 = "DELETE FROM userpicks WHERE creatoruuid='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql27)) {
			echo "Record userpicks deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["userprofile"])
	{
		//userprofile = useruuid
		$sql28 = "DELETE FROM userprofile WHERE useruuid='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql28)) {
			echo "Record userprofile deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["usersettings"])
	{
		//usersettings = useruuid
		$sql29 = "DELETE FROM usersettings WHERE useruuid='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql29)) {
			echo "Record usersettings deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
// ##### Delete Simulator Avatar #####
if ($_POST["estate_managers"])
	{
		$sq30 = "DELETE FROM estate_managers WHERE uuid='$CONF_db_uuid'";
		if (mysqli_query($conn, $sq30)) {
			echo "Record estate_managers deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["estate_users"])
	{
		$sq31 = "DELETE FROM estate_users WHERE uuid='$CONF_db_uuid'";
		if (mysqli_query($conn, $sq31)) {
			echo "Record estate_users deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["estateban"])
	{
		$sq32 = "DELETE FROM estateban WHERE bannedUUID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sq32)) {
			echo "Record estateban deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["landaccesslist"])
	{
		$sql33 = "DELETE FROM landaccesslist WHERE AccessUUID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql33)) {
			echo "Record landaccesslist deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}
if ($_POST["regionban"])
	{
		$sql34 = "DELETE FROM regionban WHERE bannedUUID='$CONF_db_uuid'";
		if (mysqli_query($conn, $sql34)) {
			echo "Record regionban deleted successfully ";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}

mysqli_close($conn); // Datenbank schliessen
}

// Die Funktion senden aufrufen
senden();

?>

<?php } ?>