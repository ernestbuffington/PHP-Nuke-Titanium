<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_CATEGORIESADMIN . ': ' . _DL_ADDCATEGORY;
include_once 'header.php';
OpenTable();
title('<h1>'.$pagetitle.'</h1>');
DLadminmain();
echo '<br />';
OpenTable4();
echo '<form method="post" action="' . $admin_file . '.php">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_NAME . ':</td><td><input type="text" name="title" size="50" maxlength="50" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_PARENT . '</td><td><select name="cid"><option value="0" selected="selected">' . _DL_NONE . '</option>';
$result = $db->sql_query('SELECT `cid`, `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `parentid` = 0 ORDER BY `title`');
while ($cidinfo = $db->sql_fetchrow($result)) {
	$crawled = array($cidinfo['cid']);
	CrawlLevel($cidinfo['cid']);
	$x = 0;
	while ($x <= (sizeof($crawled) -1)) {
		list($title, $parentid) = $db->sql_fetchrow($db->sql_query('SELECT `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = \'' . $crawled[$x] . '\''));
		if ($x > 0) {
			$title = getparent($parentid, $title);
		}
		echo '<option value="' . $crawled[$x] . '">' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</option>';
		$x++;
	}
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td><textarea name="cdescription" cols="50" rows="5"></textarea></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_WHOADD . ':</td><td><select name="whoadd">';
echo '<option value="-1">' . _DL_NONE . '</option>';
echo '<option value="0" selected="selected">' . _DL_ALL . '</option>';
echo '<option value="1">' . _DL_USERS . '</option>';
echo '<option value="2">' . _DL_ADMIN . '</option>';

$gresult = $db->sql_query('SELECT * FROM `' . $prefix . '_bbgroups` ORDER BY `group_name`');

while ($gidinfo = $db->sql_fetchrow($gresult)) 
{
	$gidinfo['group_id'] = $gidinfo['group_id']+2;
	echo '<option value="' . $gidinfo['group_id'] . '">' . htmlspecialchars($gidinfo['group_name'], ENT_QUOTES, _CHARSET) . ' ' . _DL_ONLY . '</option>';
}

echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_UPDIRECTORY . ':</td><td><input type="text" name="uploaddir" size="50" maxlength="255" /><br />(' . _DL_USEUPLOAD . ')</td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CANUPLOAD . ':</td><td><select name="canupload">';
echo '<option value="0">' . _DL_NO . '</option>';
echo '<option value="1">' . _DL_YES . '</option>';
echo '</select></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_ADDCATEGORY . '" /></td></tr></table>';
echo '<input type="hidden" name="op" value="CategoryAddSave" />';
echo '</form>';
CloseTable4();
CloseTable();
include_once 'footer.php';

