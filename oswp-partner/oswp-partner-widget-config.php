<?php
// Variablen
$CONF_db_server = "127.0.0.1";
?>

<?php
	// Gettext einfügen
	load_plugin_textdomain( 'oswp-partner', false, basename( dirname( __FILE__ ) ) . '/lang' );
 ?>

<?php if (!isset($_POST['partnertelefon'])): ?>


		<form class="container" name="partnertelefon" action="" method="post">
		<input type="hidden" name="partnertelefon" value="1" />
		
			<?php echo esc_html__( 'Server :', 'oswp-partnerwidget' )."<br>"; ?>
			<input type="text" name="CONF_db_server" size="33" value="127.0.0.1" maxlength="40"><br><br>

			<?php echo esc_html__( 'Database name :', 'oswp-partnerwidget' )."<br>"; ?>
			<input type="text" name="CONF_db_database" size="33" placeholder="opensim" maxlength="40"><br><br>
			
			<?php echo esc_html__( 'Database User name :', 'oswp-partnerwidget' )."<br>"; ?>
			<input type="text" name="CONF_db_user" size="33" placeholder="JohnDoe" maxlength="40"><br><br>

			<?php echo esc_html__( 'Database User Passwd :', 'oswp-partnerwidget' )."<br>"; ?>
			<input type="password" name="CONF_db_pass" size="33" placeholder="paswd123" maxlength="40"><br><br>

			<button class="btn btn-danger" type="submit" name="submit" ><?php echo esc_html__( 'Eintragen', 'oswp-partnerwidget' ); ?></button>
			<button class="btn btn-danger" type="reset" ><?php echo esc_html__( 'Reset', 'oswp-partnerwidget' ); ?></button>

		</form>

<?php endif ?>


<?php
//print_r($_POST);
	if (isset($_POST['partnertelefon']) AND $_POST['partnertelefon'] == 1)
	{
		// wir schaffen unsere Variablen
		//$CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database 
		$CONF_db_server  	= $_POST['CONF_db_server']; //server http or IP, string value use: %s
		$CONF_db_user  		= $_POST['CONF_db_user']; //database user name, string value use: %s
		$CONF_db_pass  		= $_POST['CONF_db_pass']; //database password, string value use: %s
		$CONF_db_database  	= $_POST['CONF_db_database']; //database name, string value use: %s
		
		global $wpdb;
		
		// Tabellen Name
		$tablename = $wpdb->prefix . "ospartner";
		
		//Tabelle erstellen
		$charset_collate = $wpdb->get_charset_collate();
		
		// Neue Tabelleneinträge eintragen NEU: os_id mediumint (9) NOT NULL,
		$sqlpartner1 = "CREATE TABLE $tablename (
		  os_id mediumint (9) NOT NULL,
		  CONF_db_server text NOT NULL,
		  CONF_db_user text NOT NULL,
		  CONF_db_pass text NOT NULL,
		  CONF_db_database text NOT NULL,
		  PRIMARY KEY  (os_id)
		) $charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sqlpartner1 );
		
		// Erst alte Tabellen loeschen dann neue schreiben.
		$wpdb->delete( $tablename, array( 'os_id' => 0 ) );
		
		// Eigentliche Daten speichern
		$sqlpartner2 = $wpdb->prepare("INSERT INTO $tablename (CONF_db_server, CONF_db_user, CONF_db_pass, CONF_db_database) values (%s, %s, %s, %s)", $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database);
		dbDelta( $sqlpartner2 );
	}
?>	