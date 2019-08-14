<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$eid = isset($eid) ? intval($eid) : 0;
$pagetitle = _DL_EXTENSIONSADMIN;

include_once 'header.php';

OpenTable();
title('<h1>'._DL_EXTENSIONSADMIN.'</h1>');
DLadminmain();
echo '<br />';
OpenTable4();
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_extensions` WHERE `eid` = ' . $eid);
if ($db->sql_numrows($result) > 0) {
	$eidinfo = $db->sql_fetchrow($result);
	echo '<form action="' . $admin_file . '.php" method="post">';
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr><td align="center" colspan="2"><strong>' . _DL_MODEXTENSION . '</strong></td></tr>';
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_EXT . ':</td><td><input type="text" name="xext" value="' . $eidinfo['ext'] . '" size="10" maxlength="6" /></td></tr>';
	$sel0 = $sel1 = '';
	if ($eidinfo['file'] == 0) {
		$sel0 = ' selected="selected"';
	} elseif ($eidinfo['file'] == 1) {
		$sel1 = ' selected="selected"';
	}
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILETYPE . ':</td><td><select name="xfile">';
	echo '<option value="0"' . $sel0 . '>' . _DL_NO . '</option>';
	echo '<option value="1"' . $sel1 . '>' . _DL_YES . '</option>';
	echo '</select></td></tr>';
	$sel0 = $sel1 = '';
	if ($eidinfo['image'] == 0) {
		$sel0 = ' selected="selected"';
	} elseif ($eidinfo['image'] == 1) {
		$sel1 = ' selected="selected"';
	}
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_IMAGETYPE . ':</td><td><select name="ximage">';
	echo '<option value="0"' . $sel0 . '>' . _DL_NO . '</option>';
	echo '<option value="1"' . $sel1 . '>' . _DL_YES . '</option>';
	echo '</select></td></tr>';
	echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_SAVECHANGES . '" /></td></tr></table>';
	echo '<input type="hidden" name="eid" value="' . $eid . '" />';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<input type="hidden" name="op" value="ExtensionModifySave" />';
	echo '</form>';
	echo '<form action="admins.php" method="post">';
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_DELETE . '" /></td></tr>';
	echo '</table>';
	echo '<input type="hidden" name="eid" value="' . $eid . '" />';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<input type="hidden" name="op" value="ExtensionDelete" />';
	echo '</form>';
} else {
	echo '<p>', _ACCESSDENIED, '</p>';
}
CloseTable4();
CloseTable();
include_once 'footer.php';

