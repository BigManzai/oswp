<!-- This file is used to markup the administration form of the widget. -->



<!-- Ab hier die Ausgabe im Control-Fenster des Adminbereiches -->

<?php
// Gettext einfügen
/* Make theme available for translation */
	load_plugin_textdomain( 'oswp-regionsliste', false, basename( dirname( __FILE__ ) ) . '/lang' );
 ?>
 
 <?php
	// Standardwerte setzen
	$CONF_os_name = "Sim List";
	$CONF_db_server = "127.0.0.1";
	$CONF_port = "8002";
	//$CONF_callparameter = "secondlife://http|!!";
?>

<?php if (!isset($_POST['oskonfig'])): ?>

<!-- Start Abfrage Nutzer -->
<form class="container" action="" method="post">
    <input type="hidden" name="oskonfig" value="1" />
		
<!-- OpenSim Einstellung --> 
<!-- $CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database -->
	<div class="row section">


    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  Heading Widget Name:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="Sim List" name="CONF_os_name"/></p>
        </div>
    </div>
	
	<?php echo esc_html__( '  Database setting', 'oswp-regionsliste' ) ; ?>
	
	<div class="row section">	
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Server IP:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="127.0.0.1" name="CONF_db_server"/></p>
        </div>
    </div>
 
	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Database:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_database"/></p>
        </div>
    </div>

 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL User:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_user"/></p>
        </div>
    </div>

	
 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Password:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="password" placeholder="password" name="CONF_db_pass"/></p>
        </div>
    </div>
	
	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  IP or adress HG Link:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="myGrid.com" name="CONF_adress"/></p>
        </div>
    </div>

 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  Port HG Link:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="8002" name="CONF_port"/></p>
        </div>
    </div>
	
<?php endif ?>

<?php
//print_r($_POST);
	if (isset($_POST['oskonfig']) AND $_POST['oskonfig'] == 1)
	{
		// wir schaffen unsere Variablen
		$CONF_os_name  = $_POST['CONF_os_name']; //variable name, string value use: %s
		$CONF_db_server  = $_POST['CONF_db_server']; //server http or IP, string value use: %s
		
/* 		$CONF_db_user  = $_POST['CONF_db_user']; //database user name, string value use: %s
		$CONF_db_pass  = $_POST['CONF_db_pass']; //database password, string value use: %s
		$CONF_db_database  = $_POST['CONF_db_database']; //database name, string value use: %s */
		
		$CONF_adress  = $_POST['CONF_adress']; //database name, string value use: %s
		$CONF_port  = $_POST['CONF_port']; //database name, string value use: %s
		$CONF_callparameter = "secondlife://http|!!";
		
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
		
		global $wpdb;
		// Fehler anzeigen
		//$wpdb->show_errors();
		
		// Tabellen Name
		$tablename = $wpdb->prefix . "osregionlist";
		
		//Tabelle erstellen
		$charset_collate = $wpdb->get_charset_collate();
		
		// Neue Tabelleneinträge eintragen NEU: os_id mediumint (9) NOT NULL,
		$sqlx = "CREATE TABLE $tablename (
		  os_id mediumint (9) NOT NULL,
		  CONF_os_name text NOT NULL,
		  CONF_db_server text NOT NULL,
		  CONF_db_user text NOT NULL,
		  CONF_db_pass text NOT NULL,
		  CONF_db_database text NOT NULL,
		  CONF_adress text NOT NULL,
		  CONF_port text NOT NULL,
		  CONF_callparameter text NOT NULL,
		  PRIMARY KEY  (os_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sqlx );

		// Sind die Variablen CONF_os_name, CONF_db_server, CONF_db_user, CONF_db_pass, CONF_db_database leer dann keine Datenspeicherung vornehmen.
		if (!empty($CONF_os_name) && !empty($CONF_db_server) && !empty($CONF_db_user) && !empty($CONF_db_pass) && !empty($CONF_db_database))
		{
			// Erst Tabellen loeschen dann schreiben os_id nicht vergessen.
			$wpdb->delete( $tablename, array( 'os_id' => 0 ) );
			//Eigentliche Daten speichern.
			$sqlx2 = $wpdb->prepare("INSERT INTO $tablename (CONF_os_name, CONF_db_server, CONF_db_user, CONF_db_pass, CONF_db_database, CONF_adress, CONF_port, CONF_callparameter) values (%s, %s, %s, %s, %s, %s, %s, %s)", $CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database, $CONF_adress, $CONF_port, $CONF_callparameter);
			dbDelta( $sqlx2 );
		} 
		else 
		{
			// Datensatz leer nicht schreiben.
			echo ' ';
		}
	}
?>