
<!-- This file is used to markup the public-facing widget. -->


<?php
$PHP_SELF = &$_SERVER['PHP_SELF'];

echo "<h4>MD5-Hash-Generator</h4>";

echo '<form action="' . $PHP_SELF . '" method="post">
<h4>Passworteingabe:</h4>
<input name = "passwort">
<input type="submit" name="md5" value="Ermittle MD5-Hash">
</form>';

echo "<h4>MD5-Hash Ausgabe:</h4>";

echo "<h6>". md5($_POST["passwort"]) ."</h6>"; 
