<?php
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$cid = isset($cid) ? intval($cid) : 0;
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_FILESIZEVALIDATION;

include_once 'header.php';

OpenTable();
title('<h1>'.$pagetitle.'</h1>');
DLadminmain();
echo '<br />';
OpenTable2();
echo '<table align="center" cellpadding="2" cellspacing="2" border="0" width="80%">';
if ($cid == 0) {
	echo '<tr><td align="center" colspan="4"><strong>' . _DL_CHECKALLDOWNLOADS . '</strong><br />' . _DL_BEPATIENT . '</td></tr>';
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `active` > 0 ORDER BY `title`');
} else {
	$sql = 'SELECT `title` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $cid;
	list($cidtitle) = $db->sql_fetchrow($db->sql_query($sql));
	echo '<tr><td align="center" colspan="4" class="thick">' . _DL_VALIDATINGCAT . ': ' . $cidtitle . '<br />' . _DL_BEPATIENT . '</td></tr>';
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `cid` = ' . $cid . ' AND `active` > 0 ORDER BY `title`');
}
echo '<tr bgcolor="' . $bgcolor2 . '">';
echo '<td valign="bottom"><strong>' . _DL_FILENAME . '</strong></td>';
echo '<td valign="bottom"><strong>' . _DL_URL . '</strong></td>';
echo '<td align="right"><strong>' . _DL_OLDSIZE . '<br />' . _DL_INBYTES . '</strong></td>';
echo '<td align="right"><strong>' . _DL_NEWSIZE . '<br />' . _DL_INBYTES . '</strong></td></tr>';
/*
 * Get the submitter's IP address if we can
 */
$sub_ip = gdGetIP();
/*
 * Perform the download validation for the chosen category
 */
while ($dresult = $db->sql_fetchrow($result)) {
	echo '<tr bgcolor="' . $bgcolor1 . '">';
	echo '<td>' . htmlspecialchars($dresult['title'], ENT_QUOTES, _CHARSET) . '</td>';
	echo '<td>' . htmlspecialchars($dresult['url'], ENT_QUOTES, _CHARSET) . '</td>';
	echo '<td align="right">' . number_format($dresult['filesize']) . '</td>';
	if (preg_match('#^(http(s?))://#i', $dresult['url'])) {
		echo '<td align="right">' . _DL_NOTLOCAL . '</td>';
	} else {
		if (file_exists($dresult['url'])) {
			$newsize = filesize($dresult['url']);
			echo '<td align="right">' . number_format($newsize) . '</td>';
			$db->sql_query('UPDATE `' . $prefix . '_nsngd_downloads` SET `filesize` = \'' . $newsize . '\' WHERE `lid` = \'' . (int)$dresult['lid'] . '\'');
		} else {
			echo '<td align="right">' . _DL_FAILED . '</td>';
			$date = date('M d, Y g:i:a');
			$sql = 'INSERT INTO `' . $prefix . '_nsngd_mods` VALUES (NULL, ' . (int)$dresult['lid'] . ', 0, 0, \'\', \'\', \'\', \''
				. _DL_DSCRIPT . '<br />' . $date . '\', \'' . addslashes($sub_ip) . '\', 1, \'' . addslashes($dresult['name']) . '\', \''
				. addslashes($dresult['email']) . '\', \'' . addslashes($dresult['filesize']) . '\', \''
				. addslashes($dresult['version']) . '\', \'' . addslashes($dresult['homepage']) . '\')';
			$db->sql_query($sql);
		}
	}
	echo '</tr>';
}
echo '</table>';
echo '<br /><div class="text-center">' . _GOBACK . '</div>';
CloseTable2();
CloseTable();
include_once 'footer.php';

