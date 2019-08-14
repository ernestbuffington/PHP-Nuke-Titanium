<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_CATEGORIESADMIN . ': ' . _DL_CATTRANS;
include_once 'header.php';
OpenTable();
title('<H1>'.$pagetitle.'</H1>');
DLadminmain();
echo '<br />';
OpenTable4();
if ($db->sql_numrows($db->sql_query('SELECT `lid` FROM `' . $prefix . '_nsngd_downloads`')) > 0) {
	echo '<form method="post" action="' . $admin_file . '.php">';
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
	echo '<tr><td align="center" colspan="2" class="thick">' . _DL_EZTRANSFERDOWNLOADS . '</td></tr>';
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FROM . ':</td><td><select name="cidfrom">';
	echo '<option value="0">' . _DL_NONE . '</option>';
	$result2 = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `parentid` = 0 ORDER BY `title`');
	while ($cidinfo = $db->sql_fetchrow($result2)) {
		$crawled = array($cidinfo['cid']);
		CrawlLevel($cidinfo['cid']);
		$x = 0;
		while ($x <= (sizeof($crawled) - 1)) {
			$sql = 'SELECT `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $crawled[$x];
			list($title, $parentid) = $db->sql_fetchrow($db->sql_query($sql));
			$title = htmlspecialchars($title, ENT_QUOTES, _CHARSET);
			if ($x > 0) {
				$title = getparent($parentid, $title);
			}
			echo '<option value="' . $crawled[$x] . '">' . $title . '</option>';
			$x++;
		}
	}
	echo '</select></td></tr>';
	echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_TO . ':</td><td><select name="cidto">';
	echo '<option value="0">' . _DL_NONE . '</option>';
	$sql = 'SELECT `cid`, `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `parentid` = 0 ORDER BY `title`';
	$result2 = $db->sql_query($sql);
	while ($cidinfo = $db->sql_fetchrow($result2)) {
		$crawled = array($cidinfo['cid']);
		CrawlLevel($cidinfo['cid']);
		$x = 0;
		while ($x <= (sizeof($crawled) - 1)) {
			$sql = 'SELECT `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $crawled[$x];
			list($title, $parentid) = $db->sql_fetchrow($db->sql_query($sql));
			$title = htmlspecialchars($title, ENT_QUOTES, _CHARSET);
			if ($x > 0) {
				$title = getparent($parentid, $title);
			}
			echo '<option value="' . $crawled[$x] . '">' . $title . '</option>';
			$x++;
		}
	}
	echo '</select></td></tr>';
	echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_EZTRANSFER . '" /></td></tr>';
	echo '</table>';
	echo '<input type="hidden" name="op" value="DownloadTransfer" />';
	echo '</form>';
} else {
	echo '<div class="text-center" class="thick">' . _DL_NOCATTRANS . '</div>';
}
CloseTable4();
CloseTable();
include_once 'footer.php';

