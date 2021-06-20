<!-- Control-Fenster des Adminbereiches -->

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
	// Gettext einfügen
	load_plugin_textdomain( 'oswp-createavatar', false, basename( dirname( __FILE__ ) ) . '/lang' );
 ?>

<?php if (!isset($_POST['oskonfig'])): ?>

<!-- Start Abfrage Nutzer -->
<form class="w3-container" action="" method="post">
    <input type="hidden" name="oskonfig" value="1" />
		
<!-- OpenSim Datenbank Einstellungen --> 
	<div class="w3-row w3-section">


    <p><label for="base" class="w3-label control-label"><i class="fa fa-file-o" style="font-size:20px"></i><?php echo esc_html__( '  OpenSim Name:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" placeholder="My OpenSim" name="CONF_os_name"/></p>
        </div>
    </div>
	
	<div class="w3-row w3-section">	
    <p><label for="base" class="w3-label control-label"><i class="fa fa-database" style="font-size:20px"></i><?php echo esc_html__( '  MySQL Server IP:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" placeholder="127.0.0.1" name="CONF_db_server"/></p>
        </div>
    </div>
 
	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-database" style="font-size:20px"></i><?php echo esc_html__( '  MySQL Database:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" placeholder="opensim" name="CONF_db_database"/></p>
        </div>
    </div>

 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-database" style="font-size:20px"></i><?php echo esc_html__( '  MySQL User:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" placeholder="opensim" name="CONF_db_user"/></p>
        </div>
    </div>
	
 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-database" style="font-size:20px"></i><?php echo esc_html__( '  Password:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="password" placeholder="password" name="CONF_db_pass"/></p>
        </div>
    </div>
	
<!-- // OpenSim Avatar Asset Einstellungen -->

 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Form:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="66c41e39-38f9-f75a-024e-585989bfab73" name="CONF_os_SHAPE"/></p>
        </div>
    </div>
	
	 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Haut:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="77c41e39-38f9-f75a-024e-585989bbabbb" name="CONF_os_SKIN"/></p>
        </div>
    </div>
	
	 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Haar:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="d342e6c0-b9d2-11dc-95ff-0800200c9a66" name="CONF_os_HAIR"/></p>
        </div>
    </div>
	
	 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Augen:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="4bb6fa4d-1cd2-498a-a84c-95c1a0e745a7" name="CONF_os_EYES"/></p>
        </div>
    </div>
	
	 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Hemd:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="00000000-38f9-1111-024e-222222111110" name="CONF_os_SHIRT"/></p>
        </div>
    </div>
	
	 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Hose:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="00000000-38f9-1111-024e-222222111120" name="CONF_os_PANTS"/></p>
        </div>
    </div>
	
	 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Unterhose:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="16499ebb-3208-ec27-2def-481881728f47" name="CONF_os_USHIRT" /></p>
        </div>
    </div>
	
	 	<div class="w3-row w3-section">
    <p><label for="base" class="w3-label control-label"><i class="fa fa-street-view" style="font-size:20px"></i><?php echo esc_html__( '  Standard Unterhemd:', 'oswp-createavatar' ) ; ?></b></label></p>
        <div class="w3-row">
            <p><input class="w3-input w3-border" type="text" value="4ac2e9c7-3671-d229-316a-67717730841d" name="CONF_os_UPANTS"/></p>
        </div>
    </div>
	
<!-- // OpenSim Avatar Asset Einstellungen Ende -->
<?php endif ?>

<?php
//print_r($_POST);
	if (isset($_POST['oskonfig']) AND $_POST['oskonfig'] == 1)
	{
		// wir schaffen unsere Variablen
		//$CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database 
		$CONF_os_name  		= $_POST['CONF_os_name']; //variable name, string value use: %s
		$CONF_db_server  	= $_POST['CONF_db_server']; //server http or IP, string value use: %s
		$CONF_db_user  		= $_POST['CONF_db_user']; //database user name, string value use: %s
		$CONF_db_pass  		= $_POST['CONF_db_pass']; //database password, string value use: %s
		$CONF_db_database  	= $_POST['CONF_db_database']; //database name, string value use: %s
		
 		$CONF_os_SHAPE  	= $_POST['CONF_os_SHAPE']; //variable name, string value use: %s
		$CONF_os_SKIN  		= $_POST['CONF_os_SKIN']; //variable name, string value use: %s
		$CONF_os_HAIR  		= $_POST['CONF_os_HAIR']; //variable name, string value use: %s
		$CONF_os_EYES  		= $_POST['CONF_os_EYES']; //variable name, string value use: %s
		$CONF_os_SHIRT  	= $_POST['CONF_os_SHIRT']; //variable name, string value use: %s
		$CONF_os_PANTS  	= $_POST['CONF_os_PANTS']; //variable name, string value use: %s
		$CONF_os_USHIRT  	= $_POST['CONF_os_USHIRT']; //variable name, string value use: %s
		$CONF_os_UPANTS  	= $_POST['CONF_os_UPANTS']; //variable name, string value use: %s 
		
		global $wpdb;
		// Fehler anzeigen
		//$wpdb->show_errors();
		
		// Tabellen Name
		$tablename = $wpdb->prefix . "createavatar";
		
		//Tabelle erstellen
		$charset_collate = $wpdb->get_charset_collate();
		
		// Neue Tabelleneinträge eintragen NEU: os_id mediumint (9) NOT NULL,
		$sql = "CREATE TABLE $tablename (
		  os_id mediumint (9) NOT NULL,
		  CONF_os_name text NOT NULL,
		  CONF_db_server text NOT NULL,
		  CONF_db_user text NOT NULL,
		  CONF_db_pass text NOT NULL,
		  CONF_db_database text NOT NULL,
		  CONF_os_SHAPE text NOT NULL,
		  CONF_os_SKIN text NOT NULL,
		  CONF_os_HAIR text NOT NULL,
		  CONF_os_EYES text NOT NULL,
		  CONF_os_SHIRT text NOT NULL,
		  CONF_os_PANTS text NOT NULL,
		  CONF_os_USHIRT text NOT NULL,
		  CONF_os_UPANTS text NOT NULL,
		  PRIMARY KEY  (os_id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		
		// Erst alte Tabellen loeschen dann neue schreiben.
		$wpdb->delete( $tablename, array( 'os_id' => 0 ) );
		
		// Eigentliche Daten speichern
		$sql2 = $wpdb->prepare("INSERT INTO $tablename (
			CONF_os_name, 
			CONF_db_server, 
			CONF_db_user, 
			CONF_db_pass, 
			CONF_db_database, 
			CONF_os_SHAPE, 
			CONF_os_SKIN, 
			CONF_os_HAIR, 
			CONF_os_EYES, 
			CONF_os_SHIRT, 
			CONF_os_PANTS, 
			CONF_os_USHIRT, 
			CONF_os_UPANTS) 
			values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
			$CONF_os_name, 
			$CONF_db_server, 
			$CONF_db_user, 
			$CONF_db_pass, 
			$CONF_db_database, 
			$CONF_os_SHAPE, 
			$CONF_os_SKIN, 
			$CONF_os_HAIR, 
			$CONF_os_EYES, 
			$CONF_os_SHIRT, 
			$CONF_os_PANTS, 
			$CONF_os_USHIRT, 
			$CONF_os_UPANTS);
			
		dbDelta( $sql2 );
	}
?>