<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_DOWNLOADVALIDATION;
include_once 'header.php';

OpenTable();
title('<h1>'._DL_DOWNLOADSADMIN . ': ' . _DL_DOWNLOADVALIDATION.'</h1>');
DLadminmain();
echo '<br />';
OpenTable4();
echo '<div align="center">';
echo '<p><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadValidate&amp;cid=0">' . _DL_CHECKALLDOWNLOADS . '</a></p>';
echo '<p><strong>' . _DL_CHECKCATEGORIES . '</strong><br />' . _DL_INCLUDESUBCATEGORIES . '</p>';
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` ORDER BY `parentid`, `title`');
if ($db->sql_numrows($result) > 0) {
	echo '<ul style="list-style-type:none;padding-left:0;">';
	while ($cidinfo = $db->sql_fetchrow($result)) {
		$cidtitle = htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET);
		if ($cidinfo['parentid'] != 0) {
			$cidtitle = getparent($cidinfo['parentid'], $cidtitle);
		}
		echo '<li><a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadValidate&amp;cid=' . $cidinfo['cid'] . '">'
			. $cidtitle . '</a></li>';
	}
	echo '</ul>';
}
echo '</div>';
CloseTable4();
CloseTable();
include_once 'footer.php';

