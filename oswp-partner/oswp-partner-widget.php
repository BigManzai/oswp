<?php
 /**
  * Mit dieser Datei können übermittelte Formulardaten abgefangen werden.  Bei Verwendung einer Nichtkonfiguration
  * Um Formulardaten zu speichern, denken Sie daran, ein Identifikationsfeld in Ihrem Formular zu verwenden.
  */
?>
<?php
// Variablen
$leerempty = "00000000-0000-0000-0000-000000000000";

$CONF_db_server = "127.0.0.1";
$osavataruuid = "00000000-0000-0000-0000-000000000000";
$osneuerPartner = "00000000-0000-0000-0000-000000000000";
?>

<?php
	// Gettext einfügen
	load_plugin_textdomain( 'oswp-partner', false, basename( dirname( __FILE__ ) ) . '/lang' );
 ?>

<?php if (!isset($_POST['partnertelefon'])): ?>


		<form class="container" name="partnertelefon" action="" method="post">
		<input type="hidden" name="partnertelefon" value="1" />
		
			<input type="checkbox" name="bidirectional" value="bidirectional" checked><?php echo esc_html__( 'bidirectional', 'oswp-partner' )."<br>"; ?><br>
		
			<?php echo esc_html__( 'Avatar UUID eingeben:', 'oswp-partner' )."<br>"; ?>
			<input type="text" name="osavataruuid" size="33" value="00000000-0000-0000-0000-000000000000"><br><br>
			
			<?php echo esc_html__( 'Partner UUID des Avatar eingeben:', 'oswp-partner' )."<br>"; ?>
			<input type="text" name="osneuerPartner" size="33" value="00000000-0000-0000-0000-000000000000"><br><br>
			
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
function anzeige() 
{
	$avataruuid = $_POST['osavataruuid'];
	$neuerPartner = $_POST['osneuerPartner'];
	echo "Fertig"."<br>";
	echo $neuerPartner . "<br>" . " in " . "<br>" . $avataruuid . "<br>" . " eingetragen!";
}

// Eingaben auswerten und Senden
function partner() 
{
	if (isset($_POST['partnertelefon']) AND $_POST['partnertelefon'] == 1)
		{
			// wir schaffen unsere Variablen
			$CONF_db_serverpartner = $_POST['CONF_db_server']; //server http or IP, string value use: %s
			$CONF_db_userpartner = $_POST['CONF_db_user']; //database user name, string value use: %s
			$CONF_db_passpartner = $_POST['CONF_db_pass']; //database password, string value use: %s
			$CONF_db_databasepartner = $_POST['CONF_db_database']; //database name, string value use: %s
			
			$avataruuid = $_POST['osavataruuid'];
			$neuerPartner = $_POST['osneuerPartner'];
			
			// Verbindung zur Datenbank herstellen
			$conn = mysqli_connect($CONF_db_serverpartner, $CONF_db_userpartner, $CONF_db_passpartner, $CONF_db_databasepartner);
			$sqlpartner = "UPDATE userprofile SET profilePartner = '$neuerPartner' WHERE userprofile.useruuid = '$avataruuid'";	
			mysqli_query($conn, $sqlpartner); // Avatar bekommt neuen Partner eingetragen.
			mysqli_close($conn); // Datenbank schliessen
			anzeige();
		}
}

function bidirectionalpartner() 
{
	if (isset($_POST['partnertelefon']) AND $_POST['partnertelefon'] == 1)
		{
			// wir schaffen unsere Variablen
			$CONF_db_serverpartner = $_POST['CONF_db_server']; //server http or IP, string value use: %s
			$CONF_db_userpartner = $_POST['CONF_db_user']; //database user name, string value use: %s
			$CONF_db_passpartner = $_POST['CONF_db_pass']; //database password, string value use: %s
			$CONF_db_databasepartner = $_POST['CONF_db_database']; //database name, string value use: %s
			
			$avataruuid = $_POST['osavataruuid'];
			$neuerPartner = $_POST['osneuerPartner'];
			
			// Verbindung zur Datenbank herstellen
			$conn = mysqli_connect($CONF_db_serverpartner, $CONF_db_userpartner, $CONF_db_passpartner, $CONF_db_databasepartner);
			$sqlpartner = "UPDATE userprofile SET profilePartner = '$neuerPartner' WHERE userprofile.useruuid = '$avataruuid'";	
			mysqli_query($conn, $sqlpartner); // Avatar bekommt neuen Partner eingetragen.
			$sqlbipartner = "UPDATE userprofile SET profilePartner = '$avataruuid' WHERE userprofile.useruuid = '$neuerPartner'";	
			mysqli_query($conn, $sqlbipartner); // Partner bekommt neuen Partner eingetragen.
			mysqli_close($conn); // Datenbank schliessen
			anzeige();
		}
}

//Funktionsauswahl Partner eintragen starten.
if (isset($_POST['bidirectional']) AND $_POST['bidirectional'] != -1){ 
bidirectionalpartner(); 
} 
else { 
partner();
}



?>