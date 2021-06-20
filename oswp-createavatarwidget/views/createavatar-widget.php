<?php
	// Version 1.0.7 by Manfred Aabye

	global $wpdb;
	// Fehler anzeigen
	//$wpdb->show_errors();
	
	// Tabellenname erstellen
	$tablename = $wpdb->prefix . "createavatar";
	
	// Auslesen der wp datenbank
	$CONF_os_name = $wpdb->get_var( "SELECT CONF_os_name FROM $tablename" );
	$CONF_db_server = $wpdb->get_var( "SELECT CONF_db_server FROM $tablename" );
	$CONF_db_user = $wpdb->get_var( "SELECT CONF_db_user FROM $tablename" );
	$CONF_db_pass = $wpdb->get_var( "SELECT CONF_db_pass FROM $tablename" );
	$CONF_db_database = $wpdb->get_var( "SELECT CONF_db_database FROM $tablename" );
	
 	$CONF_os_SHAPE = $wpdb->get_var( "SELECT CONF_os_SHAPE FROM $tablename" );
	$CONF_os_SKIN = $wpdb->get_var( "SELECT CONF_os_SKIN FROM $tablename" );
	$CONF_os_HAIR = $wpdb->get_var( "SELECT CONF_os_HAIR FROM $tablename" );
	$CONF_os_EYES = $wpdb->get_var( "SELECT CONF_os_EYES FROM $tablename" );
	$CONF_os_SHIRT = $wpdb->get_var( "SELECT CONF_os_SHIRT FROM $tablename" );
	$CONF_os_PANTS = $wpdb->get_var( "SELECT CONF_os_PANTS FROM $tablename" );
	$CONF_os_USHIRT = $wpdb->get_var( "SELECT CONF_os_USHIRT FROM $tablename" );
	$CONF_os_UPANTS = $wpdb->get_var( "SELECT CONF_os_UPANTS FROM $tablename" ); 
	
	$con = mysqli_connect($CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database);
	$res = mysqli_query($con, "SELECT * FROM regions");
	
// Gettext einfügen
/* Make theme available for translation */
	load_plugin_textdomain( 'oswp-createavatar', false, basename( dirname( __FILE__ ) ) . '/lang' );
	
/* # Database OpenSimulator 0.9.1
UserAccounts
	PrincipalID
	ScopeID
	FirstName
	LastName
	Email
	ServiceURLs
	Created
	UserLevel
	UserFlags
	UserTitle
	active */

?>

<?php

// Default Avatar
define('DEFAULT_AVATAR_HEIGHT', '1.690999');
define('DEFAULT_AVATAR_PARAMS', '33,61,85,23,58,127,63,85,63,42,0,85,63,36,85,95,153,63,34,0,63,109,88,132,63,136,81,85,103,136,127,0,150,150,150,127,0,0,0,0,0,127,0,0,255,127,114,127,99,63,127,140,127,127,0,0,0,191,0,104,0,0,0,0,0,0,0,0,0,145,216,133,0,127,0,127,170,0,0,127,127,109,85,127,127,63,85,42,150,150,150,150,150,150,150,25,150,150,150,0,127,0,0,144,85,127,132,127,85,0,127,127,127,127,127,127,59,127,85,127,127,106,47,79,127,127,204,2,141,66,0,0,127,127,0,0,0,0,127,0,159,0,0,178,127,36,85,131,127,127,127,153,95,0,140,75,27,127,127,0,150,150,198,0,0,63,30,127,165,209,198,127,127,153,204,51,51,255,255,255,204,0,255,150,150,150,150,150,150,150,150,150,150,0,150,150,150,150,150,0,127,127,150,150,150,150,150,150,150,150,0,0,150,51,132,150,150,150');

// Zero UUID
define('UUID_ZERO',	'00000000-0000-0000-0000-000000000000');
$base_avatar = UUID_ZERO;
?>

<?php echo "<h1>".esc_html__( $CONF_os_name, 'oswp-createavatar' )."</h1><br>"; ?>


<?php if (!isset($_POST['etape'])): ?>

<form action="" method="post">
    <input type="hidden" name="etape" value="1" />
	
  <fieldset>
    <?php echo esc_html__( 'Vorname :', 'oswp-createavatar' )."<br>"; ?>
    <input type="text" name="osVorname" placeholder="John"><br>
	<?php
		$osVorname = sanitize_text_field($_POST['osVorname']);
		update_post_meta($post->ID, 'osVorname', $osVorname);
	?>
	
	<?php echo esc_html__( 'Nachname :', 'oswp-createavatar' )."<br>"; ?>
    <input type="text" name="osNachname" placeholder="Doe"><br>
	<?php
		$osNachname = sanitize_text_field($_POST['osNachname']);
		update_post_meta($post->ID, 'osNachname', $osNachname);
	?>
	<?php echo esc_html__( 'E-Mail :', 'oswp-createavatar' )."<br>"; ?>
    <input type="text" name="osEMail" placeholder="john@doe.com"><br>
	<?php
		$osEMail = sanitize_text_field($_POST['osEMail']);
		update_post_meta($post->ID, 'osEMail', $osEMail);
	?>
	<?php echo esc_html__( 'Password :', 'oswp-createavatar' )."<br>"; ?>
    <input type="password" name="osPasswd1" placeholder="********"><br>
	<?php
		$osPasswd1 = sanitize_text_field($_POST['osPasswd1']);
		update_post_meta($post->ID, 'osPasswd1', $osPasswd1);
	?>
	<?php echo esc_html__( 'Password wiederholung :', 'oswp-createavatar' )."<br>"; ?>
    <input type="password" name="osPasswd" placeholder="********"><br>
	<?php
		$osPasswd = sanitize_text_field($_POST['osPasswd']);
		update_post_meta($post->ID, 'osPasswd', $osPasswd);
	?>
    <?php echo esc_html__( 'Antispam ID :', 'oswp-createavatar' )."<br>"; ?>
	<?php echo esc_html__( 'e3542ff9-5fd6-4ed0-a1ac-bccc1f3aa1c6', 'oswp-createavatar' )."<br>"; ?>
    <input type="text" name="oscaptcha" placeholder="Antispam ID"><br><br>
	<?php
		$oscaptcha = sanitize_text_field($_POST['oscaptcha']);
		update_post_meta($post->ID, 'oscaptcha', $oscaptcha);
	?>
	
    <input type="submit" value="Submit">
	
  </fieldset>

</form>

<?php endif ?>
	


<?php
// UUID Generator Random UUID $benutzeruuid = uuidv4()

  function uuidv4() 
  {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

      // 32 bits
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

      // 16 bits
      mt_rand(0, 0xffff),

      // 16 bits
      mt_rand(0, 0x0fff) | 0x4000,

      // 16 bits - 8 bits
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }
?>


<?php
// Salt erstellen OK

	function ospswdsalt() {
		$randomuuid = $benutzeruuid;
		$strrep = str_replace("-", "", $randomuuid);
		return md5($strrep);
	}
?>


<?php
// Md5Hash(password) + ":" + passwordSalt

	function ospswdhash($osPasswd, $osSalt) {
		
		return md5(md5($osPasswd).":".$osSalt);
	}
?>



<?php
if (isset($_POST['etape']) AND $_POST['etape'] == 1)
{
    // wir schaffen unsere Variablen und alle Leerzeichen beiläufig entfernen	
	$benutzeruuid = uuidv4();
	$inventoryuuid = uuidv4();
	$neuparentFolderID = uuidv4();
    $neuHauptFolderID = uuidv4();
	$oscaptchaid = "e3542ff9-5fd6-4ed0-a1ac-bccc1f33a1c6";

	$osVorname   = trim($_POST['osVorname']);
	$osNachname   = trim($_POST['osNachname']);
    $osEMail  = trim($_POST['osEMail']);

    $osDatum = mktime();	
    $osPasswd   = trim($_POST['osPasswd']);
	$osPasswd1   = trim($_POST['osPasswd1']);
	
	$oscaptcha  = trim($_POST['oscaptcha']);

	$osSalt = ospswdsalt();
	$osHash = ospswdhash($osPasswd, $osSalt);

	// Programmabbruch bei fehlenden Angaben
    if (empty($osVorname)) 
	{
        echo esc_html__( 'Vorname nicht mit einem Wert belegt, oder nicht gesetzt', 'oswp-createavatar' )."<br>";
	    exit;
    }
	
	if (empty($osNachname)) 
	{
        echo esc_html__( 'Nachname nicht mit einem Wert belegt, oder nicht gesetzt', 'oswp-createavatar' )."<br>";
	    exit;
    }
	
	if (empty($osEMail)) 
	{
        echo esc_html__( 'E-Mail nicht mit einem Wert belegt, oder nicht gesetzt', 'oswp-createavatar' )."<br>";
	    exit;
    }
	
	if (empty($osPasswd)) 
	{
        echo esc_html__( 'Passwort oder Passwortwiederholung nicht mit einem Wert belegt, oder nicht gesetzt', 'oswp-createavatar' )."<br>";
	    exit;
    }
	
	if (empty($osPasswd1)) 
	{
        echo esc_html__( 'Passwort oder Passwortwiederholung nicht mit einem Wert belegt, oder nicht gesetzt', 'oswp-createavatar' )."<br>";
	    exit;
    }
	
    if($osPasswd != $osPasswd1) 
	{
       echo esc_html__( 'Die Passwörter müssen übereinstimmen', 'oswp-createavatar' )."<br>";
       exit;
    }
 
	if (empty($oscaptcha)) 
	{
        echo esc_html__( 'Captcha nicht mit einem Wert belegt, oder nicht gesetzt', 'oswp-createavatar' )."<br>";
	    exit;
    }
     // if($oscaptcha != $oscaptchaid) 
	// {
       // echo 'Captcha Fehler:  ' . $oscaptcha . '   Richtig wäre:  ' . $oscaptchaid;
       // exit;
    // }
	
	
// Datenbank öffnen
  $pdo = new PDO("mysql:host=$CONF_db_server;dbname=$CONF_db_database", $CONF_db_user, $CONF_db_pass);

// Avatar und Namen checken
 if(!$error) { 
 $statement = $pdo->prepare("SELECT * FROM UserAccounts WHERE FirstName = :FirstName AND LastName = :LastName");
 $result = $statement->execute(array('FirstName' => $osVorname, 'LastName' => $osNachname));
 $user = $statement->fetch();
 
 if($user !== false) {
 echo 'Der Name ist bereits vergeben<br>';
 exit;
 } 
 } 

// E-Mail checken
  if(!filter_var($osEMail, FILTER_VALIDATE_EMAIL)) {
 echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
 exit;
 } 

 //Überprüfe, ob die E-Mail-Adresse noch nicht registriert wurde
 if(!$error) { 
 $statement = $pdo->prepare("SELECT * FROM UserAccounts WHERE Email = :Email");
 $result = $statement->execute(array('Email' => $osEMail));
 $user = $statement->fetch();
 
 if($user !== false) {
 echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
 exit;
 } 
 }
 
// Avatar eintragen
$neuer_user = array();
$neuer_user['PrincipalID'] = $benutzeruuid;
$neuer_user['ScopeID'] = '00000000-0000-0000-0000-000000000000';
$neuer_user['FirstName'] = $osVorname;
$neuer_user['LastName'] = $osNachname;
$neuer_user['Email'] = $osEMail;
$neuer_user['ServiceURLs'] = 'HomeURI= InventoryServerURI= AssetServerURI=';
$neuer_user['Created'] = $osDatum;
$neuer_user['UserLevel'] = '0';
$neuer_user['UserFlags'] = '0';
$neuer_user['UserTitle'] = '';
$neuer_user['active'] = '1';
 

$statement = $pdo->prepare("INSERT INTO UserAccounts (PrincipalID, ScopeID, FirstName, LastName, Email, ServiceURLs, Created, UserLevel, UserFlags, UserTitle, active) VALUES (:PrincipalID, :ScopeID, :FirstName, :LastName, :Email, :ServiceURLs, :Created, :UserLevel, :UserFlags, :UserTitle, :active)");
$statement->execute($neuer_user);  
 
// UUID, passwordHash, passwordSalt, webLoginKey, accountType
$neues_passwd = array();
$neues_passwd['UUID']         = $benutzeruuid;
$neues_passwd['passwordHash'] = $osHash;
$neues_passwd['passwordSalt'] = $osSalt;
$neues_passwd['webLoginKey'] = '00000000-0000-0000-0000-000000000000';
$neues_passwd['accountType'] = 'UserAccount';
 
$statement = $pdo->prepare("INSERT INTO auth (UUID, passwordHash, passwordSalt, webLoginKey, accountType) VALUES (:UUID, :passwordHash, :passwordSalt, :webLoginKey, :accountType)");
$statement->execute($neues_passwd);

// Das nachfolgende eintragen in der GridUser Spalte
$neuer_GridUser = array();
$neuer_GridUser['UserID']         = $benutzeruuid;
$neuer_GridUser['HomeRegionID'] = '00000000-0000-0000-0000-000000000000';
$neuer_GridUser['HomePosition'] = '<0,0,0>';
$neuer_GridUser['LastRegionID'] = '00000000-0000-0000-0000-000000000000';
$neuer_GridUser['LastPosition'] = '<0,0,0>';
 
$statement = $pdo->prepare("INSERT INTO GridUser (UserID, HomeRegionID, HomePosition, LastRegionID, LastPosition) VALUES (:UserID, :HomeRegionID, :HomePosition, :LastRegionID, :LastPosition)");
$statement->execute($neuer_GridUser);

// Inventarverzeichnisse erstellen

// Ordner Textures
$Texturesuuid = uuidv4();

$verzeichnistextur = array();
$verzeichnistextur['folderName'] = 'Textures';
$verzeichnistextur['type'] = '0';
$verzeichnistextur['version'] = '1';
$verzeichnistextur['folderID'] = $Texturesuuid;
$verzeichnistextur['agentID'] = $benutzeruuid;
$verzeichnistextur['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnistextur);

// Ordner Sounds
$Soundsuuid = uuidv4();

$verzeichnisSounds = array();
$verzeichnisSounds['folderName'] = 'Sounds';
$verzeichnisSounds['type'] = '1';
$verzeichnisSounds['version'] = '1';
$verzeichnisSounds['folderID'] = $Soundsuuid;
$verzeichnisSounds['agentID'] = $benutzeruuid;
$verzeichnisSounds['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisSounds);

// Ordner Calling Cards
$CallingCardsuuid = uuidv4();

$verzeichnisCallingCards = array();
$verzeichnisCallingCards['folderName'] = 'Calling Cards';
$verzeichnisCallingCards['type'] = '2';
$verzeichnisCallingCards['version'] = '2';
$verzeichnisCallingCards['folderID'] = $CallingCardsuuid;
$verzeichnisCallingCards['agentID'] = $benutzeruuid;
$verzeichnisCallingCards['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisCallingCards);

// Ordner Landmarks
$Landmarksuuid = uuidv4();

$verzeichnisLandmarks = array();
$verzeichnisLandmarks['folderName'] = 'Landmarks';
$verzeichnisLandmarks['type'] = '3';
$verzeichnisLandmarks['version'] = '1';
$verzeichnisLandmarks['folderID'] = $Landmarksuuid;
$verzeichnisLandmarks['agentID'] = $benutzeruuid;
$verzeichnisLandmarks['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisLandmarks);

// Ordner My Inventory
$MyInventoryuuid = uuidv4();

$verzeichnisMyInventory = array();
$verzeichnisMyInventory['folderName'] = 'My Inventory';
$verzeichnisMyInventory['type'] = '8';
$verzeichnisMyInventory['version'] = '17';
$verzeichnisMyInventory['folderID'] = $neuHauptFolderID;
$verzeichnisMyInventory['agentID'] = $benutzeruuid;
$verzeichnisMyInventory['parentFolderID'] = '00000000-0000-0000-0000-000000000000';

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisMyInventory);

// Ordner Photo Album
$PhotoAlbumuuid = uuidv4();

$verzeichnisPhotoAlbum = array();
$verzeichnisPhotoAlbum['folderName'] = 'Photo Album';
$verzeichnisPhotoAlbum['type'] = '15';
$verzeichnisPhotoAlbum['version'] = '1';
$verzeichnisPhotoAlbum['folderID'] = $PhotoAlbumuuid;
$verzeichnisPhotoAlbum['agentID'] = $benutzeruuid;
$verzeichnisPhotoAlbum['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisPhotoAlbum);

// Ordner Clothing
$Clothinguuid = uuidv4();

$verzeichnisClothing = array();
$verzeichnisClothing['folderName'] = 'Clothing';
$verzeichnisClothing['type'] = '5';
$verzeichnisClothing['version'] = '3';
$verzeichnisClothing['folderID'] = $Clothinguuid;
$verzeichnisClothing['agentID'] = $benutzeruuid;
$verzeichnisClothing['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisClothing);

// Ordner Objects
$Objectsuuid = uuidv4();

$verzeichnisObjects = array();
$verzeichnisObjects['folderName'] = 'Objects';
$verzeichnisObjects['type'] = '6';
$verzeichnisObjects['version'] = '1';
$verzeichnisObjects['folderID'] = $Objectsuuid;
$verzeichnisObjects['agentID'] = $benutzeruuid;
$verzeichnisObjects['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisObjects);

// Ordner Notecards
$Notecardsuuid = uuidv4();

$verzeichnisNotecards = array();
$verzeichnisNotecards['folderName'] = 'Notecards';
$verzeichnisNotecards['type'] = '7';
$verzeichnisNotecards['version'] = '1';
$verzeichnisNotecards['folderID'] = $Notecardsuuid;
$verzeichnisNotecards['agentID'] = $benutzeruuid;
$verzeichnisNotecards['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisNotecards);

// Ordner Scripts
$Scriptsuuid = uuidv4();

$verzeichnisScripts = array();
$verzeichnisScripts['folderName'] = 'Scripts';
$verzeichnisScripts['type'] = '10';
$verzeichnisScripts['version'] = '1';
$verzeichnisScripts['folderID'] = $Scriptsuuid;
$verzeichnisScripts['agentID'] = $benutzeruuid;
$verzeichnisScripts['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisScripts);

// Ordner Body Parts
$BodyPartsuuid = uuidv4();

$verzeichnisBodyParts = array();
$verzeichnisBodyParts['folderName'] = 'Body Parts';
$verzeichnisBodyParts['type'] = '13';
$verzeichnisBodyParts['version'] = '5';
$verzeichnisBodyParts['folderID'] = $BodyPartsuuid;
$verzeichnisBodyParts['agentID'] = $benutzeruuid;
$verzeichnisBodyParts['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisBodyParts);

// Ordner Trash
$Trashuuid = uuidv4();

$verzeichnisTrash = array();
$verzeichnisTrash['folderName'] = 'Trash';
$verzeichnisTrash['type'] = '14';
$verzeichnisTrash['version'] = '1';
$verzeichnisTrash['folderID'] = $Trashuuid;
$verzeichnisTrash['agentID'] = $benutzeruuid;
$verzeichnisTrash['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisTrash);

// Ordner Lost And Found
$LostAndFounduuid = uuidv4();

$verzeichnisLostAndFound = array();
$verzeichnisLostAndFound['folderName'] = 'Lost And Found';
$verzeichnisLostAndFound['type'] = '16';
$verzeichnisLostAndFound['version'] = '1';
$verzeichnisLostAndFound['folderID'] = $LostAndFounduuid;
$verzeichnisLostAndFound['agentID'] = $benutzeruuid;
$verzeichnisLostAndFound['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisLostAndFound);

// Ordner Animations
$Animationsuuid = uuidv4();

$verzeichnisAnimations = array();
$verzeichnisAnimations['folderName'] = 'Animations';
$verzeichnisAnimations['type'] = '20';
$verzeichnisAnimations['version'] = '1';
$verzeichnisAnimations['folderID'] = $Animationsuuid;
$verzeichnisAnimations['agentID'] = $benutzeruuid;
$verzeichnisAnimations['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisAnimations);

// Ordner Gestures
$Gesturesuuid = uuidv4();

$verzeichnisGestures = array();
$verzeichnisGestures['folderName'] = 'Gestures';
$verzeichnisGestures['type'] = '21';
$verzeichnisGestures['version'] = '1';
$verzeichnisGestures['folderID'] = $Gesturesuuid;
$verzeichnisGestures['agentID'] = $benutzeruuid;
$verzeichnisGestures['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisGestures);


// Friends
$Friendsuuid = uuidv4();

$verzeichnisFriends = array();
$verzeichnisFriends['folderName'] = 'Friends';
$verzeichnisFriends['type'] = '2';
$verzeichnisFriends['version'] = '2';
$verzeichnisFriends['folderID'] = $Friendsuuid;
$verzeichnisFriends['agentID'] = $benutzeruuid;
$verzeichnisFriends['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisFriends);

// Favorites
$Favoritesuuid = uuidv4();

$verzeichnisFavorites = array();
$verzeichnisFavorites['folderName'] = 'Favorites';
$verzeichnisFavorites['type'] = '23';
$verzeichnisFavorites['version'] = '1';
$verzeichnisFavorites['folderID'] = $Favoritesuuid;
$verzeichnisFavorites['agentID'] = $benutzeruuid;
$verzeichnisFavorites['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisFavorites);

// Current Outfit
$CurrentOutfituuid = uuidv4();

$verzeichnisCurrentOutfit = array();
$verzeichnisCurrentOutfit['folderName'] = 'Current Outfit';
$verzeichnisCurrentOutfit['type'] = '46';
$verzeichnisCurrentOutfit['version'] = '1';
$verzeichnisCurrentOutfit['folderID'] = $CurrentOutfituuid;
$verzeichnisCurrentOutfit['agentID'] = $benutzeruuid;
$verzeichnisCurrentOutfit['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisCurrentOutfit);

// All
$Alluuid = uuidv4();

$verzeichnisAll = array();
$verzeichnisAll['folderName'] = 'All';
$verzeichnisAll['type'] = '2';
$verzeichnisAll['version'] = '1';
$verzeichnisAll['folderID'] = $Alluuid;
$verzeichnisAll['agentID'] = $benutzeruuid;
$verzeichnisAll['parentFolderID'] = $neuHauptFolderID;

$statement = $pdo->prepare("INSERT INTO inventoryfolders (folderName, type, version, folderID, agentID, parentFolderID) VALUES (:folderName, :type, :version, :folderID, :agentID, :parentFolderID)");
$statement->execute($verzeichnisAll);

//  ########################################  Avatar Anziehen

// AvatarHeight
$AvatarHeight = array();
$AvatarHeight['PrincipalID'] = $benutzeruuid;
$AvatarHeight['Name'] = 'AvatarHeight';
$AvatarHeight['Value'] = DEFAULT_AVATAR_HEIGHT;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($AvatarHeight);

// AvatarType
$AvatarType = array();
$AvatarType['PrincipalID'] = $benutzeruuid;
$AvatarType['Name'] = 'AvatarType';
$AvatarType['Value'] = '1';

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($AvatarType);

// Avatar Serial
$Serial = array();
$Serial['PrincipalID'] = $benutzeruuid;
$Serial['Name'] = 'Serial';
$Serial['Value'] = '0';

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($Serial);

// Avatar VisualParams
$VisualParams = array();
$VisualParams['PrincipalID'] = $benutzeruuid;
$VisualParams['Name'] = 'VisualParams';
$VisualParams['Value'] = DEFAULT_AVATAR_PARAMS;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($VisualParams);

// OK bis hier

 
// Avatar DEFAULT_ASSET_SHAPE
$DEFAULT_ASSET_SHAPE = array();
$DEFAULT_ASSET_SHAPE['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_SHAPE['Name'] = 'Wearable 4:0';
$DEFAULT_ASSET_SHAPE['Value'] = $CONF_os_SHAPE;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_SHAPE);

// Avatar DEFAULT_ASSET_SKIN
$DEFAULT_ASSET_SKIN = array();
$DEFAULT_ASSET_SKIN['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_SKIN['Name'] = 'Wearable 6:0';
$DEFAULT_ASSET_SKIN['Value'] = $CONF_os_SKIN;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_SKIN);

// Avatar DEFAULT_ASSET_HAIR
$DEFAULT_ASSET_HAIR = array();
$DEFAULT_ASSET_HAIR['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_HAIR['Name'] = 'Wearable 2:0';
$DEFAULT_ASSET_HAIR['Value'] = $CONF_os_HAIR;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_HAIR);

// Avatar DEFAULT_ASSET_EYES
$DEFAULT_ASSET_EYES = array();
$DEFAULT_ASSET_EYES['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_EYES['Name'] = 'Wearable 1:0';
$DEFAULT_ASSET_EYES['Value'] = $CONF_os_EYES;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_EYES);

// Avatar DEFAULT_ASSET_SHIRT
$DEFAULT_ASSET_SHIRT = array();
$DEFAULT_ASSET_SHIRT['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_SHIRT['Name'] = 'Wearable 5:0';
$DEFAULT_ASSET_SHIRT['Value'] = $CONF_os_SHIRT;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_SHIRT);

// Avatar DEFAULT_ASSET_PANTS
$DEFAULT_ASSET_PANTS = array();
$DEFAULT_ASSET_PANTS['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_PANTS['Name'] = 'Wearable 3:0';
$DEFAULT_ASSET_PANTS['Value'] = $CONF_os_PANTS;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_PANTS);

// Avatar DEFAULT_ASSET_USHIRT
$DEFAULT_ASSET_USHIRT = array();
$DEFAULT_ASSET_USHIRT['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_USHIRT['Name'] = 'Wearable 7:0';
$DEFAULT_ASSET_USHIRT['Value'] = $CONF_os_USHIRT;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_USHIRT);

// Avatar DDEFAULT_ASSET_UPANTS
$DEFAULT_ASSET_UPANTS = array();
$DEFAULT_ASSET_UPANTS['PrincipalID'] = $benutzeruuid;
$DEFAULT_ASSET_UPANTS['Name'] = 'Wearable 8:0';
$DEFAULT_ASSET_UPANTS['Value'] = $CONF_os_UPANTS;

$statement = $pdo->prepare("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES (:PrincipalID,:Name,:Value)");
$statement->execute($DEFAULT_ASSET_UPANTS);

//  ########################################  Avatar Anziehen Ende

// Avatar Fertig Verbindung schließen
$pdo = null;
}
?>

