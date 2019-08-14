<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$lid = isset($lid) ? intval($lid) : 0;
$min = isset($min) ? intval($min) : 0;
$pagetitle = _DL_DOWNLOADSADMIN . ' - ' . _DL_MODDOWNLOAD;
include_once 'header.php';

OpenTable();
title('<h1>'.$pagetitle.'</h1>');
DLadminmain();
echo '<br />';
OpenTable4();
$lidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `lid` = ' . $lid));
if (preg_match('#^(http(s?))://#i', $lidinfo['url'])) {
	$checkURL = '&nbsp;[ <a href="' . $lidinfo['url'] . '" target="_blank">' . _DL_CHECK . '</a> ]';
} else {
	$checkURL = '';
}
if (preg_match('#^(http(s?))://#i', $lidinfo['homepage'])) {
	$checkHomePage = '&nbsp;[ <a href="' . $lidinfo['homepage'] . '" target="_blank">' . _DL_VISIT . '</a> ]';
} else {
	$checkHomePage = '';
}
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_DOWNLOADID . ':</td><td><strong>' . $lid . '</strong></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_TITLE . ':</td><td><input type="text" name="title" value="'
	. htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="100" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_URL . ':</td><td><input type="text" name="url" value="'
	. htmlspecialchars($lidinfo['url'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="100" />' . $checkURL . '</td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CATEGORY . ':</td><td><select name="cat"><option value="0"';
if ($lidinfo['cid'] == 0) {
	echo ' selected="selected"';
}
echo '>' . _DL_NONE . '</option>';
$result2 = $db->sql_query('SELECT `cid`, `parentid`, `title` FROM `' . $prefix . '_nsngd_categories` ORDER BY `parentid`, `title`');
while ($cidinfo = $db->sql_fetchrow($result2)) {
	if ($cidinfo['cid'] == $lidinfo['cid']) {
		$sel = ' selected="selected"';
	} else {
		$sel = '';
	}
	$cidtitle = htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET);
	if ($cidinfo['parentid'] != 0) $cidtitle = getparent($cidinfo['parentid'], $cidtitle);
	echo '<option value="' . $cidinfo['cid'] . '"' . $sel . '>' . $cidtitle . '</option>';
}
echo '</select></td></tr>';
$sel1 = $sel2 = $sel3 = '';
if ($lidinfo['sid'] == 0) {
	$sel1 = ' selected="selected"';
} elseif ($lidinfo['sid'] == 1) {
	$sel2 = ' selected="selected"';
} elseif ($lidinfo['sid'] == 2) {
	$sel3 = ' selected="selected"';
}
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_PERM . ':</td><td><select name="perm">';
echo '<option value="0"' . $sel1 . '>' . _DL_ALL . '</option>';
echo '<option value="1"' . $sel2 . '>' . _DL_USERS . '</option>';
echo '<option value="2"' . $sel3 . '>' . _DL_ADMIN . '</option>';
$gresult = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
while ($gidinfo = $db->sql_fetchrow($gresult)) {
	$gidinfo['gid'] = $gidinfo['gid']+2;
	if ($gidinfo['gid'] == $lidinfo['sid']) {
		$selected = ' selected="selected"';
	} else {
		$selected = '';
	}
	echo '<option value="' . $gidinfo['gid'] . '"' . $selected . '>' . $gidinfo['gname'] . ' ' . _DL_ONLY . '</option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td><div>';
if (NUKEWYSIWYG_ACTIVE) {
	wysiwyg_textarea('description', $lidinfo['description'], 'PHPNukeAdmin', '80', '20');
} else {
	Make_Textarea('description', $lidinfo['description'], 'PHPNukeAdmin', '', '');
	//echo '<textarea name="description" cols="80" rows="20">'. htmlspecialchars($lidinfo['description'], ENT_QUOTES, _CHARSET).'</textarea>';
}
echo '</div></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHORNAME . ':</td><td><input type="text" name="dlname" size="50" maxlength="100" value="'
	. htmlspecialchars($lidinfo['name'], ENT_QUOTES, _CHARSET) . '" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHOREMAIL . ':</td><td><input type="text" name="email" size="50" maxlength="100" value="'
	. htmlspecialchars($lidinfo['email'], ENT_QUOTES, _CHARSET) . '" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILESIZE . ':</td><td><input type="text" name="filesize" size="12" maxlength="20" value="' . $lidinfo['filesize'] . '" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_VERSION . ':</td><td><input type="text" name="version" size="11" maxlength="20" value="'
	. htmlspecialchars($lidinfo['version'], ENT_QUOTES, _CHARSET) . '" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_HOMEPAGE . ':</td><td><input type="text" name="homepage" size="50" maxlength="255" value="'
	. htmlspecialchars($lidinfo['homepage'], ENT_QUOTES, _CHARSET) . '" />' . $checkHomePage . '</td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_HITS . ':</td><td><input type="text" name="hits" value="' . $lidinfo['hits'] . '" size="12" maxlength="11" /></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_MODIFY . '" /></td></tr>';
echo '</table>';
echo '<input type="hidden" name="op" value="DownloadModifySave" />';
echo '<input type="hidden" name="lid" value="' . $lid . '" />';
echo '<input type="hidden" name="min" value="' . $min . '" />';
echo '</form>';
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_DELETE . '" /></td></tr>';
echo '</table>';
echo '<input type="hidden" name="op" value="DownloadDelete" />';
echo '<input type="hidden" name="lid" value="' . $lid . '" />';
echo '<input type="hidden" name="min" value="' . $min . '" />';
echo '</form>';
CloseTable4();
CloseTable();
include_once 'footer.php';

