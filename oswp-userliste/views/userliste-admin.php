<?php if (!isset($_POST['userlistekonfig'])): ?>

<?php
	// Standardwerte setzen
	$CONF_os_name = "User List";
	$CONF_db_server = "127.0.0.1";
	$CONF_db_userlevel = 200;
	
	
// Gettext einfügen
/* Make theme available for translation */
	load_plugin_textdomain( 'oswp-userlist', false, basename( dirname( __FILE__ ) ) . '/lang' );
 ?>

<!-- Start Abfrage Nutzer -->
<form class="container" action="" method="post">
    <input type="hidden" name="userlistekonfig" value="1" />
		
<!-- OpenSim Einstellung --> 
<!-- $CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database -->
	<div class="row section">


    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  OpenSim Name:', 'oswp-userlist' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="User List" name="CONF_os_name"/></p>
        </div>
    </div>
	
	<div class="row section">	
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Server IP:', 'oswp-userlist' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="127.0.0.1" name="CONF_db_server"/></p>
        </div>
    </div>
 
	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Database:', 'oswp-userlist' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_database"/></p>
        </div>
    </div>

 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL User:', 'oswp-userlist' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_user"/></p>
        </div>
    </div>
	
 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  Password:', 'oswp-userlist' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="password" placeholder="password" name="CONF_db_pass"/></p>
        </div>
    </div>
	
	 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  User Level:', 'oswp-userlist' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="200" name="CONF_db_userlevel"/></p>
        </div>
    </div>

<?php endif ?>

<?php
//print_r($_POST);
	if (isset($_POST['userlistekonfig']) AND $_POST['userlistekonfig'] == 1)
	{
		// wir schaffen unsere Variablen
		$CONF_os_name  = $_POST['CONF_os_name']; //variable name, string value use: %s
		$CONF_db_server  = $_POST['CONF_db_server']; //server http or IP, string value use: %s
		
/* 		$CONF_db_user  = $_POST['CONF_db_user']; //database user name, string value use: %s
		$CONF_db_pass  = $_POST['CONF_db_pass']; //database password, string value use: %s
		$CONF_db_database  = $_POST['CONF_db_database']; //database name, string value use: %s */
		
//Neu mit einer einfachen Verschlüsselngsmethode
		$CONF_db_user_crypt_ul  = $_POST['CONF_db_user']; //database user name, string value use: %s
		$CONF_db_pass_crypt_ul  = $_POST['CONF_db_pass']; //database password, string value use: %s
		$CONF_db_database_crypt_ul  = $_POST['CONF_db_database']; //database name, string value use: %s
		
		// Schauen ob blowfish.class.php schon geladen ist.
		if (class_exists('Blowfish')) {
			echo""; // blowfish.class.php ist schon geladen.
		} else {
			include("blowfish.class.php");// blowfish.class.php nachladen.
		}
		
		$blowfish = new Blowfish("BY29K6CUaV5ixsNgA5URMH2s");
		
		$CONF_db_user 		= $blowfish->Encrypt( $CONF_db_user_crypt_ul );
		$CONF_db_pass 		= $blowfish->Encrypt( $CONF_db_pass_crypt_ul );
		$CONF_db_database 	= $blowfish->Encrypt( $CONF_db_database_crypt_ul );
//Neu mit einer einfachen Verschlüsselngsmethode
		
		$CONF_db_userlevel  = $_POST['CONF_db_userlevel']; //database name, string value use: %d
		
		global $wpdb;
		// Fehler anzeigen
		//$wpdb->show_errors();
		
		// Tabellen Name
		$tablename = $wpdb->prefix . "osuserlist";
		
		//Tabelle erstellen
		$charset_collate = $wpdb->get_charset_collate();

		// Diese Tabellenerstellung ist ein einfaches hinzufügen einer Tabelle.
		$sql = "CREATE TABLE $tablename (
		  os_id mediumint (1) NOT NULL,
		  CONF_os_name text NOT NULL,
		  CONF_db_server text NOT NULL,
		  CONF_db_user text NOT NULL,
		  CONF_db_pass text NOT NULL,
		  CONF_db_database text NOT NULL,
		  CONF_db_userlevel int NOT NULL,
		  PRIMARY KEY  (os_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta( $sql );
		
		// NEU: Erst Tabellen löschen dann schreiben os_id nicht vergessen.
		$wpdb->delete( $tablename, array( 'os_id' => 0 ) );
		
		// Eigentliche Daten speichern
		$sql2 = $wpdb->prepare("INSERT INTO $tablename (CONF_os_name, CONF_db_server, CONF_db_user, CONF_db_pass, CONF_db_database, CONF_db_userlevel) values (%s, %s, %s, %s, %s, %d)", $CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database, $CONF_db_userlevel);
		dbDelta( $sql2 );
	}
?>