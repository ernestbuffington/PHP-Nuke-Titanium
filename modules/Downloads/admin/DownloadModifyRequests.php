<?php //done 
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_DUSERMODREQUEST;
include_once 'header.php';
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_mods` WHERE `brokendownload` = 0 ORDER BY `rid`');
$totalmods = $db->sql_numrows($result);

OpenTable();
title('<h1>'.$pagetitle . ' (' . $totalmods . ')'.'</h1>');
DLadminmain();
echo '<br />';
OpenTable4();
echo '<table width="95%" align="center"><tr><td>';
if ($totalmods != 0) {
	$ridinfo = array();
	while ($ridinfo = $db->sql_fetchrow($result)) {
		$lidinfo = array();
		$lidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `lid` = ' . (int)$ridinfo['lid']));
		list($cidtitle) = $db->sql_fetchrow($db->sql_query('SELECT `title` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = \'' . (int)$ridinfo['cid'] . '\''));
		list($origcidtitle) = $db->sql_fetchrow($db->sql_query('SELECT `title` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = \'' . (int)$lidinfo['cid'] . '\''));
		list($memail) = $db->sql_fetchrow($db->sql_query('SELECT `user_email` FROM `' . $user_prefix . '_users` WHERE `username` = \'' . addslashes($ridinfo['modifier']) . '\''));
		list($oemail) = $db->sql_fetchrow($db->sql_query('SELECT `user_email` FROM `' . $user_prefix . '_users` WHERE `username` = \'' . addslashes($lidinfo['submitter']) . '\''));
		$ridurl = (empty($ridinfo['url'])) ? $lidinfo['url'] : $ridinfo['url'];
		// At least some basic checking to see if a valid URL for the replacement URL
		// Plus need to only allow it to be clickable if looks "valid"
		// Yes, I know, full validation on the URL is not being done...
		if (preg_match('#^(http(s?))://#i', $ridurl)) {
			$ridurl = '<a href="' . $ridurl . '" target="_blank">' . $ridurl . '</a>';
		} else {
			$ridurl = htmlspecialchars($ridurl, ENT_QUOTES, _CHARSET);
		}
		// Do the same as above on the original URL as it might not be http/s either
		if (preg_match('#^(http(s?))://#i', $lidinfo['url'])) {
			$lidurl = '<a href="' . $lidinfo['url'] . '" target="_blank">' . $lidinfo['url'] . '</a>';
		} else {
			$lidurl = htmlspecialchars($lidinfo['url'], ENT_QUOTES, _CHARSET);
		}
		/*
		 * Do the same URL checking for the HomePage field
		 */
		if (preg_match('#^(http(s?))://#i', $ridinfo['homepage'])) {
			$ridhome = '<a href="' . $ridinfo['homepage'] . '" target="_blank">' . $ridinfo['homepage'] . '</a>';
		} else {
			$ridhome = htmlspecialchars($ridinfo['homepage'], ENT_QUOTES, _CHARSET);
		}
		// Do the same as above on the original URL as it might not be http/s either
		if (preg_match('#^(http(s?))://#i', $lidinfo['homepage'])) {
			$lidhome = '<a href="' . $lidinfo['homepage'] . '" target="_blank">' . $lidinfo['homepage'] . '</a>';
		} else {
			$lidhome = htmlspecialchars($lidinfo['homepage'], ENT_QUOTES, _CHARSET);
		}
		$ridinfo['description'] = gdFilter($ridinfo['description'], '');
		if (empty($lidinfo['submitter'])) $lidinfo['submitter'] = 'admin';
		$cidtitle = empty($cidtitle) ? _DL_NONE : htmlspecialchars($cidtitle, ENT_QUOTES, _CHARSET);
		$origcidtitle = empty($origcidtitle) ? _DL_NONE : htmlspecialchars($origcidtitle, ENT_QUOTES, _CHARSET);
		$lidtitle = htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET);
		$ridtitle = htmlspecialchars($ridinfo['title'], ENT_QUOTES, _CHARSET);
		/*
		 * Ok, ready to display the modification request output
		 */
		echo '<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%">';
		echo '<tr><td><table width="100%">';
		echo '<tr><td align="center" bgcolor="' . $bgcolor2 . '" class="title" colspan="2">' . _DL_ORIGINAL . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '" width="15%">' . _DL_TITLE . ':</td><td width="85%">' . $lidtitle . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_URL . ':</td><td>' . $lidurl . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CATEGORY . ':</td><td>' . $origcidtitle . '</td></tr>';
		$ridinfo['sid'] = intval($ridinfo['sid']);
		if ($ridinfo['sid'] == 0) {
			$who_view = _DL_ALL;
		} elseif ($ridinfo['sid'] == 1) {
			$who_view = _DL_USERS;
		} elseif ($ridinfo['sid'] == 2) {
			$who_view = _DL_ADMIN;
		} elseif ($ridinfo['sid'] > 2) {
			$newView = $ridinfo['sid'] - 2;
			list($who_view) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid` = ' . $newView));
			$who_view = $who_view . ' ' . _DL_ONLY;
		}
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_PERM . ':</td><td>' . $who_view . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHORNAME . ':</td><td>' . htmlspecialchars($lidinfo['name'], ENT_QUOTES, _CHARSET) . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHOREMAIL . ':</td><td>' . htmlspecialchars($lidinfo['email'], ENT_QUOTES, _CHARSET) . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILESIZE . ':</td><td>' . number_format($lidinfo['filesize']) . ' ' . _DL_BYTES . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_VERSION . ':</td><td>' . htmlspecialchars($lidinfo['version'], ENT_QUOTES, _CHARSET) . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_HOMEPAGE . ':</td><td>' . $lidhome . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td><div>' . $lidinfo['description'] . '</div></td></tr>';
		echo '</table></td></tr>';
		echo '<tr><td><table width="100%">';
		echo '<tr><td align="center" bgcolor="' . $bgcolor2 . '" class="title" colspan="2">' . _DL_PURPOSED . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '" width="15%">' . _DL_TITLE . ':</td><td width="85%">' . $ridtitle . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_URL . ':</td><td>' . $ridurl . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CATEGORY . ':</td><td>' . $cidtitle . '</td></tr>';
		$lidinfo['sid'] = intval($lidinfo['sid']);
		if ($lidinfo['sid'] == 0) {
			$who_view = _DL_ALL;
		} elseif ($lidinfo['sid'] == 1) {
			$who_view = _DL_USERS;
		} elseif ($lidinfo['sid'] == 2) {
			$who_view = _DL_ADMIN;
		} elseif ($lidinfo['sid'] > 2) {
			$newView = $lidinfo['sid']-2;
			list($who_view) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid` = ' . $newView));
			$who_view = $who_view . ' ' . _DL_ONLY;
		}
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_PERM . ':</td><td>' . $who_view . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHORNAME . ':</td><td>' . htmlspecialchars($ridinfo['name'], ENT_QUOTES, _CHARSET) . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHOREMAIL . ':</td><td>' . htmlspecialchars($ridinfo['email'], ENT_QUOTES, _CHARSET) . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILESIZE . ':</td><td>' . number_format($ridinfo['filesize']) . ' ' . _DL_BYTES . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_VERSION . ':</td><td>' . htmlspecialchars($ridinfo['version'], ENT_QUOTES, _CHARSET) . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_HOMEPAGE . ':</td><td>' . $ridhome . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td>' . $ridinfo['description'] . '</td></tr>';
		echo '</table></td></tr>';
		echo '</table>';
		echo '<table align="center" width="100%">';
		echo '<tr>';
		echo '<td align="left">' . _DL_SUBMITTER . ': ';
		if (empty($memail)) {
			echo htmlspecialchars($ridinfo['modifier'], ENT_QUOTES, _CHARSET);
		} else {
			echo '<a href="mailto:' . $memail . '">' . $ridinfo['modifier'] . '</a>';
		}
		echo '</td>';
		echo '<td align="center">( <a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadModifyRequestsAccept&amp;rid=' . $ridinfo['rid'] . '">' . _DL_ACCEPT . '</a> / ';
		echo '<a class="rn_csrf" href="' . $admin_file . '.php?op=DownloadModifyRequestsIgnore&amp;rid=' . $ridinfo['rid'] . '">' . _DL_IGNORE . '</a> )</td>';
		echo '<td align="right">' . _DL_OWNER . ': ';
		if (empty($oemail)) {
			echo htmlspecialchars($lidinfo['submitter'], ENT_QUOTES, _CHARSET);
		} else {
			echo '<a href="mailto:' . $oemail . '">' . $lidinfo['submitter'] . '</a>';
		}
		echo '</td>';
		echo '</tr><tr>';
		echo '<td align="left" colspan="3">', _DL_SUBIP, ': ', $ridinfo['sub_ip'], '</td></tr>';
		echo '</table>' . '<br /><br />';
	}
} else {
	echo '<div align="center"><p>' . _DL_NOMODREQUESTS . '</p>';
	echo '<p>' . _GOBACK . '</p></div>';
}
echo '</td></tr></table>';
CloseTable4();
CloseTable();
include_once 'footer.php';

