<?php
	global $wpdb;
	// Fehler anzeigen
	//$wpdb->show_errors();
	
	// Tabellenname erstellen
	$tablename = $wpdb->prefix . "osregionlist";
	
	// Auslesen der wp datenbank
	$CONF_os_name = $wpdb->get_var( "SELECT CONF_os_name FROM $tablename" );
	$CONF_db_server = $wpdb->get_var( "SELECT CONF_db_server FROM $tablename" );
/* 	$CONF_db_user = $wpdb->get_var( "SELECT CONF_db_user FROM $tablename" );
	$CONF_db_pass = $wpdb->get_var( "SELECT CONF_db_pass FROM $tablename" );
	$CONF_db_database = $wpdb->get_var( "SELECT CONF_db_database FROM $tablename" ); */
	
	$CONF_adress = $wpdb->get_var( "SELECT CONF_adress FROM $tablename" );
	$CONF_port = $wpdb->get_var( "SELECT CONF_port FROM $tablename" );
	
//Neu mit einer einfachen Entschlüsselngsmethode	
	$CONF_db_user_crypt = $wpdb->get_var( "SELECT CONF_db_user FROM $tablename" );
	$CONF_db_pass_crypt = $wpdb->get_var( "SELECT CONF_db_pass FROM $tablename" );
	$CONF_db_database_crypt = $wpdb->get_var( "SELECT CONF_db_database FROM $tablename" );
	
	// Schauen ob blowfish.class.php schon geladen ist.
	if (class_exists('Blowfish')) {
		echo""; // blowfish.class.php ist schon geladen.
	} else {
		include("blowfish.class.php");// blowfish.class.php nachladen.
	}
	
	$blowfish = new Blowfish("BY29K6CUaV5ixsNgA5URMH2s");
	
	$CONF_db_user_ut = $blowfish->Decrypt( $CONF_db_user_crypt );
	$CONF_db_user = trim($CONF_db_user_ut);
	$CONF_db_pass_ut = $blowfish->Decrypt( $CONF_db_pass_crypt );
	$CONF_db_pass = trim($CONF_db_pass_ut);
	$CONF_db_database_ut = $blowfish->Decrypt( $CONF_db_database_crypt );
	$CONF_db_database = trim($CONF_db_database_ut);
//Neu mit einer einfachen Entschlüsselngsmethode

	$con = mysqli_connect($CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database);
	$res = mysqli_query($con, "SELECT * FROM regions");
	
   // Überschrift
   echo "<h1>$CONF_os_name</h1>";
	
   // Tabellenbeginn
   echo "<table border='0' style='border-collapse:collapse'>";

	// geht:
	// V3HG = secondlife://http|!!openmanniland.de|8002+Begin
	// geht nicht:
	// Hop = hop://openmanniland.de:8002/Begin/92/164/23
	// HG = secondlife://openmanniland.de:8002/Begin/92/164/23
	// Local Grid = secondlife://Begin/92/164/23

   $lf = 1;
   while ($dsatz = mysqli_fetch_assoc($res))
   {
	  $regionslink = "secondlife://http|!!" .  $CONF_adress . "|" . $CONF_port . "+" . $dsatz["regionName"];
	  $regionen = $dsatz["regionName"];
	  echo "<a href='$regionslink' target='linkliste'>$regionen</a><br>";
   }
   
   // Tabellenende
   echo "</table>";

	mysqli_close($con);
	$wpdb->flush(); //Clearing the Cache
?>
