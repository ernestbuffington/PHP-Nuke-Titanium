<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_DUSERREPBROKEN;
include_once 'header.php';
$sql = 'SELECT a.`lid` AS lid, `modifier`, a.`name` AS name, a.`sub_ip` AS sub_ip, b.`url` AS url, b.`title` AS title FROM `'
	. $prefix . '_nsngd_mods` a, `' . $prefix . '_nsngd_downloads` b WHERE `brokendownload` = 1 AND a.`lid` = b.`lid` ORDER BY `rid`';
$result = $db->sql_query($sql);
$totalbroken = $db->sql_numrows($result);

OpenTable();
title('<h1>'.$pagetitle . ' (' . $totalbroken . ')'.'</h1>');
DLadminmain();
echo '<br />';
OpenTable2();
echo '<p align="center">' . _DL_DIGNOREINFO . '<br />' . _DL_DDELETEINFO . '</p>';
echo '<table align="center" width="80%" cellpadding="2" cellspacing="0">';
if ($totalbroken == 0) {
	echo '<tr><td align="center"><strong>' . _DL_DNOREPORTEDBROKEN . '</strong></td></tr>';
} else {
	$colorswitch = $bgcolor2;
	echo '<tr>';
	echo '<td><strong>' . _DL_DOWNLOAD . '</strong></td>';
	echo '<td><strong>' . _DL_URL . '</strong></td>';
	echo '<td><strong>' . _DL_SUBMITTER . '</strong></td>';
	echo '<td><strong>' . _DL_DOWNLOADOWNER . '</strong></td>';
	echo '<td><strong>' . _DL_SUBIP . '</strong></td>';
	echo '<td><strong>' . _DL_IGNORE . '</strong></td>';
	echo '<td><strong>' . _DL_DELETE . '</strong></td>';
	echo '<td><strong>' . _DL_EDIT . '</strong></td>';
	echo '</tr>';
	while ($ridinfo = $db->sql_fetchrow($result)) {
		list($memail) = $db->sql_fetchrow($db->sql_query('SELECT `user_email` FROM `' . $user_prefix . '_users` WHERE `username` = \'' . addslashes($ridinfo['modifier']) . '\''));
		list($oemail) = $db->sql_fetchrow($db->sql_query('SELECT `user_email` FROM `' . $user_prefix . '_users` WHERE `username` = \'' . addslashes($ridinfo['name']) . '\''));
		echo '<tr><td bgcolor="' . $colorswitch . '">' . htmlspecialchars($ridinfo['title'], ENT_QUOTES, _CHARSET)
			. '</td><td bgcolor="' . $colorswitch . '">';
		/*
		 * Do some basic URL checking and only present a link around a truly valid external URL.
		 */
		if (preg_match('#^(http(s?))://#i', $ridinfo['url'])) {
			echo '<a href="' . $ridinfo['url'] . '">' . htmlspecialchars($ridinfo['title'], ENT_QUOTES, _CHARSET) . '</a>';
		} else {
			echo htmlspecialchars($ridinfo['url'], ENT_QUOTES, _CHARSET);
		}
		echo '</td><td bgcolor="' . $colorswitch . '">';
		if (empty($memail)) {
			echo $ridinfo['modifier'];
		} else {
			echo '<a href="mailto:' . $memail . '">' . $ridinfo['modifier'] . '</a>';
		}
		echo '</td>';
		echo '<td bgcolor="' . $colorswitch . '">';
		if (empty($oemail)) {
			echo $ridinfo['name'];
		} else {
			echo '<a href="mailto:' . $oemail . '">' . $ridinfo['name'] . '</a>';
		}
		echo '</td>';
		echo '<td bgcolor="' . $colorswitch . '">';
		echo $ridinfo['sub_ip'];
		echo '</td>';
		echo '<td bgcolor="' . $colorswitch . '" align="center"><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadBrokenIgnore&amp;lid=' . $ridinfo['lid'] . '">X</a></td>';
		echo '<td bgcolor="' . $colorswitch . '" align="center"><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadBrokenDelete&amp;lid=' . $ridinfo['lid'] . '">X</a></td>';
		echo '<td bgcolor="' . $colorswitch . '" align="center"><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadModify&amp;lid=' . $ridinfo['lid'] . '">X</a></td>';
		echo '</tr>';
		if ($colorswitch == $bgcolor2) {
			$colorswitch = $bgcolor1;
		} else {
			$colorswitch = $bgcolor2;
		}
	}
}
echo '</table>';
CloseTable2();
CloseTable();
include_once 'footer.php';

