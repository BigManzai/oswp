<?php
	global $wpdb;
	// Fehler anzeigen
	//$wpdb->show_errors();
	
	// Tabellenname erstellen
	$tablename = $wpdb->prefix . "ossplash";
	
	// Auslesen der wp datenbank
	$CONF_db_serversplash = $wpdb->get_var( "SELECT CONF_db_server FROM $tablename" );
	
	$CONF_os_namesplash = $wpdb->get_var( "SELECT CONF_os_name FROM $tablename" );
	
	$CONF_db_user_crypt = $wpdb->get_var( "SELECT CONF_db_user FROM $tablename" );
	$CONF_db_pass_crypt = $wpdb->get_var( "SELECT CONF_db_pass FROM $tablename" );
	$CONF_db_database_crypt = $wpdb->get_var( "SELECT CONF_db_database FROM $tablename" );
	
	// Schauen ob blowfish.class.php schon geladen ist.
	if (class_exists('Blowfish')) {
		echo""; // blowfish.class.php ist schon geladen.
	} else {
		include("blowfish.class.php");// blowfish.class.php nachladen.
	}
	
	$blowfish = new Blowfish("UKqZCnC7fyjN3PJ7YS73ETt9");
	
	$CONF_db_user_ut 		= $blowfish->Decrypt( $CONF_db_user_crypt );
	$CONF_db_usersplash = trim($CONF_db_user_ut);
	$CONF_db_pass_ut 		= $blowfish->Decrypt( $CONF_db_pass_crypt );
	$CONF_db_passsplash = trim($CONF_db_pass_ut);
	$CONF_db_database_ut 	= $blowfish->Decrypt( $CONF_db_database_crypt );
	$CONF_db_databasesplash = trim($CONF_db_database_ut);
	
	$CONF_os_totalUserssplash = $wpdb->get_var( "SELECT CONF_os_totalUsers FROM $tablename" );
	$CONF_os_activeUsersos = $wpdb->get_var( "SELECT CONF_os_activeUsers FROM $tablename" );
	$CONF_os_totalGridAccountsos = $wpdb->get_var( "SELECT CONF_os_totalGridAccounts FROM $tablename" );
	$CONF_os_totalAccountsos = $wpdb->get_var( "SELECT CONF_os_totalAccounts FROM $tablename" );
	$CONF_os_friendsos = $wpdb->get_var( "SELECT CONF_os_friends FROM $tablename" );
	
	$CONF_os_groupsos = $wpdb->get_var( "SELECT CONF_os_groups FROM $tablename" );
	$CONF_os_normalregionsos = $wpdb->get_var( "SELECT CONF_os_normalregions FROM $tablename" );
	$CONF_os_varregionsos = $wpdb->get_var( "SELECT CONF_os_varregions FROM $tablename" );
	$CONF_os_totalRegionsos = $wpdb->get_var( "SELECT CONF_os_totalRegions FROM $tablename" );
	$CONF_os_regionsergebnisos = $wpdb->get_var( "SELECT CONF_os_regionsergebnis FROM $tablename" );
	  
$con = mysqli_connect($CONF_db_serversplash,$CONF_db_usersplash,$CONF_db_passsplash,$CONF_db_databasesplash);

// Query the database and get the count

$resultoss1 = mysqli_query($con,"SELECT COUNT(*) FROM Presence") or die("Error: " . mysqli_error($con));
list($totalUsers) = mysqli_fetch_row($resultoss1);

$resultoss2 = mysqli_query($con,"SELECT COUNT(*) FROM regions") or die("Error: " . mysqli_error($con));
list($totalRegions) = mysqli_fetch_row($resultoss2);

$resultoss3 = mysqli_query($con,"SELECT COUNT(*) FROM UserAccounts") or die("Error: " . mysqli_error($con));
list($totalAccounts) = mysqli_fetch_row($resultoss3);

$resultoss4 = mysqli_query($con,"SELECT COUNT(*) FROM GridUser WHERE Login > (UNIX_TIMESTAMP() - (30*86400))") or die("Error: " . mysqli_error($con));
list($activeUsers) = mysqli_fetch_row($resultoss4);

$resultoss5 = mysqli_query($con,"SELECT COUNT(*) FROM GridUser") or die("Error: " . mysqli_error($con));
list($totalGridAccounts) = mysqli_fetch_row($resultoss5);


// NEU
$resultoss6 = mysqli_query($con," SELECT COUNT(*) FROM regions WHERE sizeX = 256 AND sizeY = 256") or die("Error: " . mysqli_error($con));
list($normalregions) = mysqli_fetch_row($resultoss6);

$resultoss7 = mysqli_query($con," SELECT COUNT(*) FROM regions WHERE sizeX <> 256 AND sizeY <> 256") or die("Error: " . mysqli_error($con));
list($varregions) = mysqli_fetch_row($resultoss7);

$resultoss8 = mysqli_query($con,"select sum(sizeX) as summe from regions") or die("Error: " . mysqli_error($con));
list($regions1) = mysqli_fetch_row($resultoss8);
$regionsergebnis = $regions1*$regions1;

$resultoss9 = mysqli_query($con,"SELECT COUNT(*) FROM Friends") or die("Error: " . mysqli_error($con));
list($friends) = mysqli_fetch_row($resultoss9);

$resultoss10 = mysqli_query($con,"SELECT COUNT(*) FROM os_groups_groups") or die("Error: " . mysqli_error($con));
list($groups) = mysqli_fetch_row($resultoss10);

// Gettext einfügen
/* Make theme available for translation */
	load_plugin_textdomain( 'oswp-splash', false, basename( dirname( __FILE__ ) ) . '/lang' );

// Display the results
echo "<h1>$CONF_os_namesplash</h1>";
// Hochstrich bei on angebracht testen ob die Einstellungen noch gehen.
if ($CONF_os_totalUserssplash ==  'on' ){ echo esc_html__( 'Users in the grid : ', 'oswp-splash' ). $totalUsers ."<br>"; }else{	echo ""; }
if ($CONF_os_activeUsersos ==  'on' ){ echo esc_html__( 'Active in the last 30 days : ', 'oswp-splash' ). $activeUsers ."<br>"; }else{	echo ""; } 
if ($CONF_os_totalGridAccountsos ==  'on' ){ echo esc_html__( 'Hypergrid users : ', 'oswp-splash' ). $totalGridAccounts ."<br>"; }else{	echo ""; } 
if ($CONF_os_totalAccountsos ==  'on' ){ echo esc_html__( 'Registrations : ', 'oswp-splash' ). $totalAccounts ."<br>"; }else{	echo ""; } 
if ($CONF_os_friendsos ==  'on' ){ echo esc_html__( 'Active friendships : ', 'oswp-splash' ). $friends ."<br>"; }else{	echo ""; } 

if ($CONF_os_groupsos ==  'on' ){ echo esc_html__( 'Active groups : ', 'oswp-splash' ). $groups ."<br>"; }else{	echo ""; } 
if ($CONF_os_normalregionsos ==  'on' ){ echo esc_html__( 'Normal regions : ', 'oswp-splash' ). $normalregions ."<br>"; }else{	echo ""; } 
if ($CONF_os_varregionsos ==  'on' ){ echo esc_html__( 'Var regions : ', 'oswp-splash' ). $varregions ."<br>"; }else{	echo ""; } 
if ($CONF_os_totalRegionsos ==  'on' ){ echo esc_html__( 'Total regions : ', 'oswp-splash' ). $totalRegions ."<br>"; }else{	echo ""; } 
if ($CONF_os_regionsergebnisos ==  'on' ){ echo esc_html__( 'Regions in m² : ', 'oswp-splash' ). $regionsergebnis ."<br>"; }else{	echo ""; } 

// Online? Offline?
//$check = mysqli_query($con,"SELECT * FROM regions LIMIT 0,1" );
	if ($regionsergebnis > 1){
	// Keine Region vorhanden.
		echo "<h1><font color=#00AA00>".esc_html__( 'Grid is ONLINE', 'oswp-splash' )."</font></h1></b><br>";
	}else{
	// Regionen sind da.		
		echo "<h1><font color=#AA0000>".esc_html__( 'Grid is OFFLINE', 'oswp-splash' )."</font></h1></b><br>";
	} 
	
// Alles schliessen
	mysqli_close($con);
	$wpdb->flush(); //Clearing the Cache
?>


