<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_ADDDOWNLOAD;
include_once 'header.php';
OpenTable();
title('<h1>'.$pagetitle.'</h1>');
DLadminmain();
echo '<br />';
OpenTable2();
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_TITLE . ':</td><td><input type="text" name="title" size="50" maxlength="100" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_URL . ':</td><td><input type="text" name="url" size="50" maxlength="255" value="" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CATEGORY . ':</td><td><select name="cat"><option value="0">' . _DL_NONE . '</option>';
$result2 = $db->sql_query('SELECT `cid`, `parentid`, `title` FROM `' . $prefix . '_nsngd_categories` ORDER BY `parentid`, `title`');
while ($cidinfo = $db->sql_fetchrow($result2)) {
	$cidtitle = htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET);
	if ($cidinfo['parentid'] != 0) $cidtitle = getparent($cidinfo['parentid'], $cidtitle);
	echo '<option value="' . $cidinfo['cid'] . '">' . $cidtitle . '</option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_PERM . ':</td><td><select name="perm">';
echo '<option value="0">' . _DL_ALL . '</option>';
echo '<option value="1">' . _DL_USERS . '</option>';
echo '<option value="2">' . _DL_ADMIN . '</option>';

$gresult = $db->sql_query('SELECT `group_id`, `group_name` FROM `' . $prefix . '_bbgroups` ORDER BY `group_name`');
while ($gidinfo = $db->sql_fetchrow($gresult)) 
{
	$gidinfo['group_id'] = $gidinfo['group_id'] + 2;
	echo '<option value="' . $gidinfo['group_id'] . '">' . htmlspecialchars($gidinfo['group_name'], ENT_QUOTES, _CHARSET) . ' ' . _DL_ONLY . '</option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . '</td><td><div>';
if (NUKEWYSIWYG_ACTIVE) {
	wysiwyg_textarea('description', '', 'PHPNukeAdmin', '80', '20');
} else {
	Make_Textarea('description', '', 'PHPNukeAdmin', '', '');
	//echo '<textarea name="description" cols="80" rows="20"></textarea>';
}
echo '</div></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHORNAME . ':</td><td><input type="text" name="sname" size="30" maxlength="60" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHOREMAIL . ':</td><td><input type="text" name="email" size="30" maxlength="60" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILESIZE . ':</td><td><input type="text" name="filesize" size="12" maxlength="20" /> (' . _DL_INBYTES . ')</td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_VERSION . ':</td><td><input type="text" name="version" size="11" maxlength="20" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_HOMEPAGE . ':</td><td><input type="text" name="homepage" size="50" maxlength="255" value="http://" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_HITS . ':</td><td><input type="text" name="hits" size="12" maxlength="11" /></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_ADDDOWNLOAD . '" /></td></tr>';
echo '</table>';
echo '<input type="hidden" name="op" value="DownloadAddSave" />';
echo '<input type="hidden" name="new" value="0" />';
echo '<input type="hidden" name="lid" value="0" />';
echo '</form>';
CloseTable2();
CloseTable();
include_once 'footer.php';

