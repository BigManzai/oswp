<?php

//
// Entfernt Avatar-Informationen aus der Datenbank.
//
function  opensim_delete_avatar($uuid, &$db=null)
{
	if (!isGUID($uuid)) return false;
	if (!is_object($db)) $db = opensim_new_db();

	$db->query("DELETE FROM UserAccounts WHERE PrincipalID='$uuid'");
	$db->query("DELETE FROM auth		 WHERE UUID='$uuid'");
	$db->query("DELETE FROM Avatars	     WHERE PrincipalID='$uuid'");
	$db->query("DELETE FROM Friends	     WHERE PrincipalID='$uuid'");
	$db->query("DELETE FROM tokens	     WHERE UUID='$uuid'");
	$db->query("DELETE FROM GridUser     WHERE UserID='$uuid'");
	if ($db->exist_table('Presence')) $db->query("DELETE FROM Presence WHERE UserID='$uuid'");
	if ($db->exist_table('Avatars'))  $db->query("DELETE FROM Avatars  WHERE PrincipalID='$uuid'");

	$db->query("DELETE FROM estate_managers	 WHERE uuid='$uuid'");
	$db->query("DELETE FROM estate_users	 WHERE uuid='$uuid'");
	$db->query("DELETE FROM estateban		 WHERE bannedUUID='$uuid'");
	$db->query("DELETE FROM inventoryfolders WHERE agentID='$uuid'");
	$db->query("DELETE FROM inventoryitems	 WHERE avatarID='$uuid'");
	$db->query("DELETE FROM landaccesslist   WHERE AccessUUID='$uuid'");
	$db->query("DELETE FROM regionban		 WHERE bannedUUID='$uuid'");

	// for DTL Money Server
	if ($db->exist_table('balances')) {
		$db->query("DELETE FROM balances WHERE user='$uuid'");
		$db->query("DELETE FROM userinfo WHERE user='$uuid'");
	}

	return true;
}

