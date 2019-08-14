<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

@set_time_limit(600);

$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_DOWNLOADVALIDATION;
include_once 'header.php';

OpenTable();
title('<h1>'._DL_DOWNLOADSADMIN . ': ' . _DL_DOWNLOADVALIDATION.'</h1>');
DLadminmain();
echo '<br />';
OpenTable4();
$cid = isset($cid) ? intval($cid) : 0;
echo '<table align="center" cellpadding="2" cellspacing="2" border="0" width="80%">';

if ($cid == 0) 
{
	echo '<tr><td align="center" colspan="4"><strong>' . _DL_CHECKALLDOWNLOADS . '</strong><br />' . _DL_BEPATIENT . '</td></tr>';
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` ORDER BY `title`');
} 
else 
{
	$sql = 'SELECT `title` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $cid;
	list($cidtitle) = $db->sql_fetchrow($db->sql_query($sql));
	echo '<tr><td align="center" colspan="4"><strong>' . _DL_VALIDATINGCAT . ': ' . $cidtitle . '</strong><br />' . _DL_BEPATIENT . '</td></tr>';
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `cid` = \'' . $cid . '\' ORDER BY `title`');
}
echo '<tr><td bgcolor="' . $bgcolor2 . '" align="center"><strong>' . _DL_STATUS . '</strong></td><td bgcolor="' . $bgcolor2
	. '"><strong>' . _DL_TITLE . '</strong></td><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_URL
	. '</strong></td><td bgcolor="' . $bgcolor2 . '" align="center"><strong>' . _DL_FUNCTIONS . '</strong></td></tr>';

/*
 * Get the submitter's IP address if we can
 */
$sub_ip = gdGetIP();

/*
 * Perform the download validation for the chosen category.
 * Also differentiate between an off-site download vs. one hosted locally, especially now that
 * direct access download links from the browser are not allowed per the included leach protection.
 */
while ($lidinfo = $db->sql_fetchrow($result)) 
{
	$fileSuccess = true;
	if (preg_match('#^(http(s?)|(s?)ftp)://#i', $lidinfo['url'])) 
	{
		if (!@file($lidinfo['url'])) $fileSuccess = false;
	} 
	else 
	{
		if (!@file('./' . $lidinfo['url'])) $fileSuccess = false;
	}
	
	if ($fileSuccess) 
	{
		echo '<tr><td align="center">&nbsp;&nbsp;' . _DL_OK . '&nbsp;&nbsp;</td>';
		echo '<td>&nbsp;&nbsp;' . htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET) . '&nbsp;&nbsp;</td>';
		echo '<td>&nbsp;&nbsp;' . htmlspecialchars($lidinfo['url'], ENT_QUOTES, _CHARSET) . '&nbsp;&nbsp;</td>';
		echo '<td align="center">&nbsp;&nbsp;' . _DL_NONE . '&nbsp;&nbsp;</td></tr>';
	} 
	else 
	{
		echo '<tr><td align="center" bgcolor="' . $bgcolor2 . '"><strong>&nbsp;&nbsp;' . _DL_FAILED . '&nbsp;&nbsp;</strong></td>';
		echo '<td>&nbsp;&nbsp;' . htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET) . '&nbsp;&nbsp;</td>';
		echo '<td>&nbsp;&nbsp;' . htmlspecialchars($lidinfo['url'], ENT_QUOTES, _CHARSET) . '&nbsp;&nbsp;</td>';
		echo '<td align="center">&nbsp;&nbsp;[ <a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadModify&amp;lid=' . $lidinfo['lid']
			. '">' . _DL_EDIT . '</a>';
		echo ' | <a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadDelete&amp;lid=' . $lidinfo['lid'] . '">' . _DL_DELETE
			. '</a> ]&nbsp;&nbsp;</td></tr>';
		$date = date('M d, Y g:i:a');
		$sql = 'INSERT INTO `' . $prefix . '_nsngd_mods` VALUES (NULL, ' . $lidinfo['lid'] . ', 0, 0, \'\', \'\', \'\', \'' . _DL_DSCRIPT
			. '<br />' . $date . '\', \'' . addslashes($sub_ip) . '\', 1, \'' . addslashes($lidinfo['name']) . '\', \'' . addslashes($lidinfo['email'])
			. '\', \'' . addslashes($lidinfo['filesize']) . '\', \'' . addslashes($lidinfo['version']) . '\', \''
			. addslashes($lidinfo['homepage']) . '\')';
		$db->sql_query($sql);
	}
}

echo '<tr><td align="center" colspan="3">' . _GOBACK . '</td></tr>';
echo '</table>';
CloseTable4();
CloseTable();
include_once 'footer.php';

