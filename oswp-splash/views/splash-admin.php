<!-- This file is used to markup the administration form of the widget. -->

<!-- Ab hier die Ausgabe im Control-Fenster des Adminbereiches -->
<?php if (!isset($_POST['ossplashkonfig'])): ?>

<?php
// Gettext einfuegen
/* Make theme available for translation */
	load_plugin_textdomain( 'oswp-splash', false, basename( dirname( __FILE__ ) ) . '/lang' );
	
	$CONF_db_server = "127.0.0.1";
 ?>
 
<!-- Start Abfrage Nutzer -->
<form class="container" action="" method="post">
    <input type="hidden" name="ossplashkonfig" value="1" />
		
<!-- OpenSim Einstellungen --> 
<h1>OSWP-Splash</h1>
<!-- Scheckboxen noch ohne echte abfrage -->
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_totalUsers"/>
		<label for="base" class="validate"><?php esc_html_e( 'Users in the grid', 'oswp-splash' ); ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_activeUsers"/>
		<label for="base" class="validate"><?php esc_html_e( 'Active in the last 30 days', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_totalGridAccounts"/>
		<label for="base" class="validate"><?php esc_html_e( 'Hypergrid users', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_totalAccounts"/>
		<label for="base" class="validate"><?php esc_html_e( 'Registrations', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_friends"/>
		<label for="base" class="validate"><?php esc_html_e( 'Active friendships', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_groups"/>
		<label for="base" class="validate"><?php esc_html_e( 'Active groups', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_normalregions"/>
		<label for="base" class="validate"><?php esc_html_e( 'Normal regions', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_varregions"/>
		<label for="base" class="validate"><?php esc_html_e( 'Var regions', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_totalRegions"/>
		<label for="base" class="validate"><?php esc_html_e( 'Total regions', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
	<div class="row section">
        <div class="row"><p><input class="input border" type="checkbox"  checked="checked" name="CONF_os_regionsergebnis"/>
		<label for="base" class="validate" ><?php esc_html_e( 'Regions in m²', 'oswp-splash' ) ; ?></b></label>
        </div>
    </div>
<!-- Scheckboxen -->

	
<!-- Abfragen Zugang -->
	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:20px"></i><?php esc_html_e( '  Grid Name or Headline:', 'oswp-splash' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="My OpenSim" name="CONF_os_name"/></p>
        </div>
    </div>
	
	<div class="row section">	
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:20px"></i><?php esc_html_e( '  MySQL Server IP:', 'oswp-splash' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="127.0.0.1" name="CONF_db_server"/></p>
        </div>
    </div>
 
	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:20px"></i><?php esc_html_e( '  MySQL Database:', 'oswp-splash' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_database"/></p>
        </div>
    </div>

 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:20px"></i><?php esc_html_e( '  MySQL User:', 'oswp-splash' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_user"/></p>
        </div>
    </div>
	
 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:20px"></i><?php esc_html_e( '  Password:', 'oswp-splash' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="password" placeholder="password" name="CONF_db_pass"/></p>
        </div>
    </div>
<!-- Abfragen Zugang Ende -->
<?php endif ?>

<?php
//print_r($_POST);
	if (isset($_POST['ossplashkonfig']) AND $_POST['ossplashkonfig'] == 1)
	{
		// wir schaffen unsere Variablen
		$CONF_os_name  = Sanitize_text_field ($_POST['CONF_os_name']); //variable name, string value use: %s
		$CONF_db_server  = Sanitize_text_field ($_POST['CONF_db_server']); //server http or IP, string value use: %s

		$CONF_db_user_crypt  = Sanitize_text_field ($_POST['CONF_db_user']); //database user name, string value use: %s
		$CONF_db_pass_crypt  = Sanitize_text_field ($_POST['CONF_db_pass']); //database password, string value use: %s
		$CONF_db_database_crypt  = Sanitize_text_field ($_POST['CONF_db_database']); //database name, string value use: %s
		
		// Schauen ob blowfish.class.php schon geladen ist.
		if (class_exists('Blowfish')) {
			echo""; // blowfish.class.php ist schon geladen.
		} else {
			include("blowfish.class.php");// blowfish.class.php nachladen.
		}
		
		$blowfish = new Blowfish("UKqZCnC7fyjN3PJ7YS73ETt9");
		
		$CONF_db_user 		= $blowfish->Encrypt( $CONF_db_user_crypt );
		$CONF_db_pass 		= $blowfish->Encrypt( $CONF_db_pass_crypt );
		$CONF_db_database 	= $blowfish->Encrypt( $CONF_db_database_crypt );
		
		$CONF_os_totalUsers  = Sanitize_text_field ($_POST['CONF_os_totalUsers']);
		$CONF_os_activeUsers  = Sanitize_text_field ($_POST['CONF_os_activeUsers']);
		$CONF_os_totalGridAccounts  = Sanitize_text_field ($_POST['CONF_os_totalGridAccounts']);
		$CONF_os_totalAccounts  = Sanitize_text_field ($_POST['CONF_os_totalAccounts']);
		$CONF_os_friends  = Sanitize_text_field ($_POST['CONF_os_friends']);
		$CONF_os_groups  = Sanitize_text_field ($_POST['CONF_os_groups']);
		$CONF_os_normalregions  = Sanitize_text_field ($_POST['CONF_os_normalregions']);
		$CONF_os_varregions  = Sanitize_text_field ($_POST['CONF_os_varregions']);
		$CONF_os_totalRegions  = Sanitize_text_field ($_POST['CONF_os_totalRegions']);
		$CONF_os_regionsergebnis  = Sanitize_text_field ($_POST['CONF_os_regionsergebnis']);
		
		global $wpdb;
		// Fehler anzeigen
		//$wpdb->show_errors();
		
		// Tabellen Name
		$tablename = $wpdb->prefix . "ossplash";
		
		//Daten werden sortiert
		$charset_collate = $wpdb->get_charset_collate();

		// Neue Tabelleneintraege eintragen
		$sql = "CREATE TABLE $tablename (
		  os_id mediumint (9) NOT NULL,
		  CONF_os_name text NOT NULL,
		  CONF_db_server text NOT NULL,
		  CONF_db_user text NOT NULL,
		  CONF_db_pass text NOT NULL,
		  CONF_db_database text NOT NULL,
		  CONF_os_totalUsers text NOT NULL, 
		  CONF_os_activeUsers text NOT NULL, 
		  CONF_os_totalGridAccounts text NOT NULL, 
		  CONF_os_totalAccounts text NOT NULL, 
		  CONF_os_friends text NOT NULL, 
		  CONF_os_groups text NOT NULL, 
		  CONF_os_normalregions text NOT NULL, 
		  CONF_os_varregions text NOT NULL, 
		  CONF_os_totalRegions text NOT NULL, 
		  CONF_os_regionsergebnis text NOT NULL,
		  PRIMARY KEY  (os_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		
		// Erst Tabellen loeschen dann schreiben os_id nicht vergessen.
		//$wpdb->delete( $tablename, array( 'os_id' => 0 ) );
		
		// Sind die Variablen CONF_os_name, CONF_db_server, CONF_db_user, CONF_db_pass, CONF_db_database leer dann keine Datenspeicherung vornehmen.
		if (!empty($CONF_os_name) && !empty($CONF_db_server) && !empty($CONF_db_user) && !empty($CONF_db_pass) && !empty($CONF_db_database))
		{
			// Erst Tabellen loeschen dann schreiben os_id nicht vergessen.
			$wpdb->delete( $tablename, array( 'os_id' => 0 ) );
			//Eigentliche Daten speichern.
			$sql2 = $wpdb->prepare("INSERT INTO $tablename (
			CONF_os_name, CONF_db_server, CONF_db_user, CONF_db_pass, CONF_db_database, CONF_os_totalUsers, CONF_os_activeUsers, CONF_os_totalGridAccounts, CONF_os_totalAccounts, CONF_os_friends, CONF_os_groups, CONF_os_normalregions, CONF_os_varregions, CONF_os_totalRegions, CONF_os_regionsergebnis) 
			values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
			$CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database, $CONF_os_totalUsers, $CONF_os_activeUsers, $CONF_os_totalGridAccounts, $CONF_os_totalAccounts, $CONF_os_friends, $CONF_os_groups, $CONF_os_normalregions, $CONF_os_varregions, $CONF_os_totalRegions, $CONF_os_regionsergebnis);
			dbDelta( $sql2 );
		} 
		else 
		{
			// Datensatz leer nicht schreiben.
			echo ' ';
		}
			
		// Eigentliche Daten speichern
		/*
		$sql2 = $wpdb->prepare("INSERT INTO $tablename (
		CONF_os_name, CONF_db_server, CONF_db_user, CONF_db_pass, CONF_db_database, CONF_os_totalUsers, CONF_os_activeUsers, CONF_os_totalGridAccounts, CONF_os_totalAccounts, CONF_os_friends, CONF_os_groups, CONF_os_normalregions, CONF_os_varregions, CONF_os_totalRegions, CONF_os_regionsergebnis) 
		values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
		$CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database, $CONF_os_totalUsers, $CONF_os_activeUsers, $CONF_os_totalGridAccounts, $CONF_os_totalAccounts, $CONF_os_friends, $CONF_os_groups, $CONF_os_normalregions, $CONF_os_varregions, $CONF_os_totalRegions, $CONF_os_regionsergebnis);
		dbDelta( $sql2 );	
		*/	
	}

?>
