<!-- 
	# OpenSim Regions Generator V1.08 by Manfred Aabye
	# Copyright (c) Manfred Aabye
	#
	# THIS SOFTWARE IS PROVIDED BY THE DEVELOPERS ``AS IS'' AND ANY
	# EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
	# WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
	# DISCLAIMED. IN NO EVENT SHALL THE CONTRIBUTORS BE LIABLE FOR ANY
	# DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
	# (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
	# LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
	# ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
	# (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
	# SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 -->

<h1>Regionsgenerator</h1>
<?php
	// Standardwerte setzen
	$osRegionsname = "Welcome";
	$osLocationx = 5000;
	$osLocationy = 5000;
	$osInternalPort = 9050;
	$osExternalHostName = "SYSTEMIP";
	$osSize = 256;
	$osDefaultLanding = "128,128,30";
	$osNonPhysicalPrimMax = 1024;
	$osMaxPrims = 15000;
	$osMaxAgents = 40;
	$osMasterAvatarFirstName = "Test";
	$osMasterAvatarLastName = "User";
	$osMaxPrimsPerUser = "-1";
	
	// Gettext einfügen
	// Make theme available for translation
	load_plugin_textdomain( 'oswp-regionsgenerator', false, basename( dirname( __FILE__ ) ) . '/lang' );
?>

<!-- Werte abfragen -->
<?php if (!isset($_POST['Regionsgenerator'])): ?>

<form class="container" action="" method="post">
    <input type="hidden" name="Regionsgenerator" value="1" />
	
	<?php echo esc_html__( 'Regionsname:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="Welcome" name="osRegionsname" maxlength="40" /><br>
	<?php echo esc_html__( 'Lokalisation X:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="5000" name="osLocationx" maxlength="40" /><br>
	<?php echo esc_html__( 'Lokalisation Y:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="5000" name="osLocationy" maxlength="40" /><br>
	<?php echo esc_html__( 'Port:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="9050" name="osInternalPort" maxlength="40" /><br>
	<?php echo esc_html__( 'Externe IP Adresse:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="SYSTEMIP" name="osExternalHostName" maxlength="40" /><br>
	<?php echo esc_html__( 'Regionsgröße Meter:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="256" name="osSize" maxlength="40" /><br>
	<?php echo esc_html__( 'Landepunkt x,y,z:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="128,128,30" name="osDefaultLanding" maxlength="40" /><br>
	<?php echo esc_html__( 'Prim Größe Meter:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="1024" name="osNonPhysicalPrimMax" maxlength="40" /><br>
	<?php echo esc_html__( 'Maximum an Prims:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="15000" name="osMaxPrims" maxlength="40" /><br>
	<?php echo esc_html__( 'Maximum Besucher:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="40" name="osMaxAgents" maxlength="40" /><br>
	<?php echo esc_html__( 'Besitzer Vorname:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="Test" name="osMasterAvatarFirstName" maxlength="40" /><br>
	<?php echo esc_html__( 'Besitzer Nachname:', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="User" name="osMasterAvatarLastName" maxlength="40" /><br>
	<?php echo esc_html__( 'Max Prims Pro Benutzer (Unbegrenzt = -1):', 'oswp-regionsgenerator' ) ; ?><br>
		<input type="text" value="-1" name="osMaxPrimsPerUser" maxlength="40" /><br><br>
	<button class="btn btn-danger" type="submit" name="submit" value="Download" >Weiter</button>
	<button class="btn btn-danger" type="reset" >Zurücksetzen</button>
</form>

<?php endif ?>
<!-- Werte abfragen Ende -->

<!-- UUID Generator -->
<?php
  function v4() 
  {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

      // 32 bits for "time_low"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

      // 16 bits for "time_mid"
      mt_rand(0, 0xffff),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand(0, 0x0fff) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits for "node"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }
  
// Pseudo-random UUID
// $v4uuid = UUID::v4();
?>

<!-- Datei löschen -->
<?php if (isset($_POST['delete']))
{
    unlink('Regions.ini');
    header('Location: ./');
}
?>	

<?php
if (isset($_POST['Regionsgenerator']) AND $_POST['Regionsgenerator'] == 1)
{
    // eine Konstante erzeugen, die später verwendet wird
    define('RETOUR', '<input class="btn btn-primary" type="button" value="Return of form" onclick="history.back()">');
	
	$osRegionsname   = trim($_POST['osRegionsname']);
	
    $datei = './' . $osRegionsname . '.ini';
	$dir = './';
	$type = 'application/ini';
	$file = $osRegionsname . '.ini';
	unlink($datei);

    if (file_exists($datei) AND filesize($datei ) > 0)
    {
        // wenn die Datei existiert und nicht leer ist, dann
        exit('Datei Existiert oder ist nicht leer.'. RETOUR);
    }

    // wir schaffen unsere Variablen und alle Leerzeichen beiläufig entfernen
	
	$v4uuid = v4();
	$osLocationx   = trim($_POST['osLocationx']);
	$osLocationy   = trim($_POST['osLocationy']);
    $osInternalPort  = trim($_POST['osInternalPort']);
    $osExternalHostName   = trim($_POST['osExternalHostName']);
    $osSize   = trim($_POST['osSize']);
	$osDefaultLanding   = trim($_POST['osDefaultLanding']);
	$osNonPhysicalPrimMax   = trim($_POST['osNonPhysicalPrimMax']);
	$osMaxPrims   = trim($_POST['osMaxPrims']);
	$osMaxAgents   = trim($_POST['osMaxAgents']);
	$osMasterAvatarFirstName   = trim($_POST['osMasterAvatarFirstName']);
	$osMasterAvatarLastName   = trim($_POST['osMasterAvatarLastName']);
	$osMaxPrimsPerUser   = trim($_POST['osMaxPrimsPerUser']);
	
    // der Text, der in der Regions.ini gesetzt wird
    $texte = '

; Datei '.$osRegionsname.'.ini 
; erstellt mit dem oswp Regions Generator v1.2

['.$osRegionsname.']

RegionUUID = '.$v4uuid.'

Location = '.$osLocationx.','.$osLocationy.'
InternalAddress = 0.0.0.0
InternalPort = '.$osInternalPort.'
AllowAlternatePorts = False
ExternalHostName = '.$osExternalHostName.'

SizeX = '.$osSize.'
SizeY = '.$osSize.'
SizeZ = '.$osSize.'

DefaultLanding = <'.$osDefaultLanding.'>

NonPhysicalPrimMax = '.$osNonPhysicalPrimMax.'
PhysicalPrimMax = 64
ClampPrimSize = False
MaxPrims = '.$osMaxPrims.'
MaxAgents = '.$osMaxAgents.'

MaxPrimsPerUser = '.$osMaxPrimsPerUser.'

MasterAvatarFirstName = '.$osMasterAvatarFirstName.'
MasterAvatarLastName = '.$osMasterAvatarLastName.'

; Ende '.$osRegionsname.'.ini

   ';

 // ini Datei schreiben 
   
    if (!$offen = fopen($datei, 'w'))
    {
        exit('<div class="alert alert-danger">Öffnen fehlgeschlagen Datei : <strong>'. $datei .'</strong>, Dateifehler (' . $osRegionsname . '.ini) Verzeichnis nicht beschreibbar.</div>'. RETOUR);
    }

    if (fwrite($offen, $texte) == FALSE)
    {
        exit('<div class="alert alert-danger">Kann Datei nicht schreiben. : <strong>'. $datei .'</strong>, Dateifehler (' . $osRegionsname . '.ini) Verzeichnis nicht beschreibbar.</div>'. RETOUR);
    }

    //echo '<div class="alert alert-success">Datei erstellt.</div>';
    fclose($offen);

    echo '<div class="alert alert-success">Kopieren sie die Datei ' . $osRegionsname . '.ini in ihr Regionsverzeichnis, oder fügen sie es so in einer bestehenden Datei ein.</div>';
	?>
	
	<iframe src='<?php echo $datei; ?>' height="560"></iframe> 
	<h1><a href= '<?php echo $datei; ?>' download> Kopieren </a></h1>
	
	<?php

    echo '<form class="form-group" action="" method="post">';
    echo '<input type="hidden" name="delete" value="1" />';
    echo '<div class="form-group">';
    echo '<button class="btn btn-danger" type="submit" name="submit" >Zurück</button>';

    echo '</div>';
    echo '</form>';

// Datei löschen
    //unlink($datei);
}
?>