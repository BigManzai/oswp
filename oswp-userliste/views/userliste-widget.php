<?php
	global $wpdb;
	
	// Tabellenname erstellen
	$tablename = $wpdb->prefix . "osuserlist";
	
	// Auslesen der wp datenbank
	$CONF_os_name = $wpdb->get_var( "SELECT CONF_os_name FROM $tablename" );	
	$CONF_db_server = $wpdb->get_var( "SELECT CONF_db_server FROM $tablename" );
	
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
	
	$CONF_db_userlevel = $wpdb->get_var( "SELECT CONF_db_userlevel FROM $tablename" );
	
	$con = mysqli_connect($CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database);
	$ergebnis = mysqli_query($con, "SELECT * FROM UserAccounts WHERE  UserLevel <= $CONF_db_userlevel");
	$userprofil = mysqli_query($con, "SELECT * FROM userprofile");

	// Informationen als Card anzeigen.
	function personalcard($name, $cardtext){
		?>
			<div class="container">
			  <div class="card">
				<img class="card-img-top" src="/wp-content/plugins/oswp-userliste/views/images/leutecard.png" alt="Card image" style="width:15%">
				<div class="card-body">
				  <h4 class="card-title"><?php echo $name;?></h4>
				  <p class="card-text"><?php echo $cardtext;?></p>
				  <!-- <a href="#" class="btn btn-primary">See Profile</a> -->
				</div>
			  </div>
			  <br>
			</div>
		<?php
	}

   // Überschrift
   echo "<h1>$CONF_os_name</h1><br>";
	
   // Tabellenbeginn
   echo "<table border='0' style='border-collapse:collapse'>";

   while ($dsatz = mysqli_fetch_assoc($ergebnis))
   {
      echo "<tr>";
	  $namen = $dsatz["FirstName"] . "  " . $dsatz["LastName"];
	  
	  $tsatz = mysqli_fetch_assoc($userprofil);
	  $profiltext = $tsatz["profileAboutText"];
	  
	  $anzeige = personalcard($namen, $profiltext);
	  echo "<a personalcard($anzeige)</a>";
      echo "</tr>";
   }
   
   // Tabellenende
   echo "</table>";

	mysqli_close($con);
	$wpdb->flush(); //Clearing the Cache
?>