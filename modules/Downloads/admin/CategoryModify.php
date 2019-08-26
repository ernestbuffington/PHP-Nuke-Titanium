<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_CATEGORIESADMIN;

/*
 * Just do some simple initial sanity checks:
 * 1. Check for valid category id.
 * 2. Does that ID exist in the database.
 * If not, out-of-here.  I know, I know, if you can't trust your admins...
 */
$cid = isset($cid) ? intval($cid) : 0;
$sql = 'SELECT * FROM `'.$prefix.'_nsngd_categories` WHERE `cid` = '.$cid;

if ($cid == 0 || !($cidinfo = $db->sql_fetchrow($db->sql_query($sql)))) 
{
	$min = isset($min) ? intval($min) : 0;
	Header('Location: '.$admin_file.'.php?op=Categories&min='.$min);
}

/*
 * Ok, all set to continue
 */
include_once 'header.php';

OpenTable();
title('<h1>'._DL_CATEGORIESADMIN.'</h1>');
DLadminmain();
echo '<br />';
OpenTable2();
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td align="center" colspan="2"><strong>' . _DL_MODCATEGORY . '</strong></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_NAME . ':</td><td><input type="text" name="title" value="' . htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="50" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td><textarea name="cdescription" cols="50" rows="10">' . htmlspecialchars($cidinfo['cdescription'], ENT_QUOTES, _CHARSET) . '</textarea></td></tr>';
$sel0 = $sel1 = $sel2 = $sel3 = '';
if ($cidinfo['whoadd'] == -1) {
	$sel0 = ' selected="selected"';
} elseif ($cidinfo['whoadd'] == 0) {
	$sel1 = ' selected="selected"';
} elseif ($cidinfo['whoadd'] == 1) {
	$sel2 = ' selected="selected"';
} elseif ($cidinfo['whoadd'] == 2) {
	$sel3 = ' selected="selected"';
}
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_WHOADD . ':</td><td><select name="whoadd">';
echo '<option value="-1"' . $sel0 . '>' . _DL_NONE . '</option>';
echo '<option value="0"' . $sel1 . '>' . _DL_ALL . '</option>';
echo '<option value="1"' . $sel2 . '>' . _DL_USERS . '</option>';
echo '<option value="2"' . $sel3 . '>' . _DL_ADMIN . '</option>';

$gresult = $db->sql_query('SELECT * FROM `'.$prefix.'_bbgroups` ORDER BY `group_name`');

while ($gidinfo = $db->sql_fetchrow($gresult)) 
{
	$gidinfo['group_id'] = $gidinfo['group_id'] + 2;
	if ($gidinfo['group_id'] == $cidinfo['whoadd']) {
		$selected = ' selected="selected"';
	} else {
		$selected = '';
	}
	echo '<option value="' . $gidinfo['group_id'] . '"' . $selected . '>' . htmlspecialchars($gidinfo['group_name'], ENT_QUOTES, _CHARSET)
		. ' ' . _DL_ONLY . '</option>';
}
echo '</select></td></tr>';


echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_UPDIRECTORY . ':</td><td><input type="text" name="uploaddir" value="'
	. htmlspecialchars($cidinfo['uploaddir'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="255" /></td></tr>';
$sel0 = $sel1 = '';
if ($cidinfo['canupload'] == 0) {
	$sel0 = ' selected="selected"';
} elseif ($cidinfo['canupload'] == 1) {
	$sel1 = ' selected="selected"';
}
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CANUPLOAD . ':</td><td><select name="canupload">';
echo '<option value="0"' . $sel0 . '>' . _DL_NO . '</option>';
echo '<option value="1"' . $sel1 . '>' . _DL_YES . '</option>';
echo '</select></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_SAVECHANGES . '" /></td></tr></table>';
echo '<input type="hidden" name="cid" value="' . $cid . '" />';
echo '<input type="hidden" name="op" value="CategoryModifySave" /></form>';
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_DELETE . '" /></td></tr></table>';
echo '<input type="hidden" name="cid" value="' . $cid . '" />';
echo '<input type="hidden" name="op" value="CategoryDelete" /></form>';
CloseTable2();
CloseTable();
include_once 'footer.php';

