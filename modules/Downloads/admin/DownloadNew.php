<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_DOWNLOADSADMIN . ': ' . _DL_DOWNLOADSWAITINGVAL;
include_once 'header.php';
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_new` ORDER BY `lid`');
$numrows = $db->sql_numrows($result);

OpenTable();
title('<h1>'.$pagetitle . ' (' . $numrows . ')'.'</h1>');
DLadminmain();
echo '<br />';
OpenTable2();
/*
 * Go get all the submitted downloads and present them to the Admin for disposition.
 */
if ($numrows > 0) {
	while ($lidinfo = $db->sql_fetchrow($result)) {
		if ($lidinfo['submitter'] == '') {
			$lidinfo['submitter'] = $anonymous;
		}
		if ($lidinfo['homepage'] != '' && !preg_match('#^(http(s?))://#i', $lidinfo['homepage'])) {
			$lidinfo['homepage'] = 'http://' . $lidinfo['homepage'];
		}
		if (preg_match('#^(http(s?))://#i', $lidinfo['homepage'])) {
			$lidhomepage = '&nbsp;[ <a href="' . $lidinfo['homepage'] . '" target="_blank">' . _DL_VISIT . '</a> ]';
		} else {
			$lidhomepage = '';
		}
		$sub_ip = (empty($lidinfo['sub_ip'])) ? '&nbsp;' : '<strong>' . $lidinfo['sub_ip'] . '</strong>';
		/*
		 * Do some basic URL checking and only present a link around a truly valid external URL.
		 */
		if (preg_match('#^(http(s?))://#i', $lidinfo['url'])) {
			$lidurl = '&nbsp;[ <a href="' . $lidinfo['url'] . '" target="_blank">' . _DL_CHECK . '</a> ]';
		} else {
			$lidurl = '';
		}
		OpenTable2();
		echo '<form action="' . $admin_file . '.php" method="post">';
		echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_SUBMITTER . ':</td><td><strong>' . $lidinfo['submitter'] . '</strong></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_SUBIP . ':</td><td>' . $sub_ip . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_TITLE . ':</td><td><input type="text" name="title" value="' . htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="100" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_URL . ':</td><td><input type="text" name="url" value="' . htmlspecialchars($lidinfo['url'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="100" />' . $lidurl . '</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_CATEGORY . ':</td><td><select name="cat"><option value="0"';
		if ($lidinfo['cid'] == 0) {
			echo ' selected="selected"';
		}
		echo '>' . _DL_NONE . '</option>';
		$result2 = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` ORDER BY `parentid`, `title`');
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
		$gresult = $db->sql_query('SELECT `gid`, `gname` FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
		while ($gidinfo = $db->sql_fetchrow($gresult)) {
			$gidinfo['gid'] = $gidinfo['gid'] + 2;
			if ($gidinfo['gid'] == $lidinfo['sid']) {
				$selected = ' selected="selected"';
			} else {
				$selected = '';
			}
			echo '<option value="' . $gidinfo['gid'] . '"' . $selected . '>' . htmlspecialchars($gidinfo['gname'], ENT_QUOTES, _CHARSET) . ' ' . _DL_ONLY . '</option>';
		}
		echo '</select></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top">' . _DL_DESCRIPTION . ':</td><td><textarea name="description" cols="60" rows="10">' . htmlspecialchars($lidinfo['description'], ENT_QUOTES, _CHARSET) . '</textarea></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHORNAME . ':</td><td><input type="text" name="sname" size="20" maxlength="100" value="' . htmlspecialchars($lidinfo['name'], ENT_QUOTES, _CHARSET) . '" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_AUTHOREMAIL . ':</td><td><input type="text" name="email" size="20" maxlength="100" value="' . htmlspecialchars($lidinfo['email'], ENT_QUOTES, _CHARSET) . '" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILESIZE . ':</td><td><input type="text" name="filesize" size="12" maxlength="20" value="' . $lidinfo['filesize'] . '" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_VERSION . ':</td><td><input type="text" name="version" size="11" maxlength="20" value="' . htmlspecialchars($lidinfo['version'], ENT_QUOTES, _CHARSET) . '" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_HOMEPAGE . ':</td><td><input type="text" name="homepage" size="30" maxlength="255" value="' . htmlspecialchars($lidinfo['homepage'], ENT_QUOTES, _CHARSET) . '" />' . $lidhomepage . '</td></tr>';
		echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_ADDDOWNLOAD . '" /></td></tr>';
		echo '</table>';
		echo '<input type="hidden" name="sub_ip" value="' . $lidinfo['sub_ip'] . '" />';
		echo '<input type="hidden" name="new" value="1" />';
		echo '<input type="hidden" name="hits" value="0" />';
		echo '<input type="hidden" name="lid" value="' . $lidinfo['lid'] . '" />';
		echo '<input type="hidden" name="submitter" value="' . htmlspecialchars($lidinfo['submitter'], ENT_QUOTES, _CHARSET) . '" />';
		echo '<input type="hidden" name="op" value="DownloadAddSave" />';
		echo '<input type="hidden" name="xop" value="' . $op . '" />';
		echo '</form>';
		echo '<form action="' . $admin_file . '.php" method="post">';
		echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
		echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_DELETEDOWNLOAD . '" /></td></tr>';
		echo '</table>';
		echo '<input type="hidden" name="lid" value="' . $lidinfo['lid'] . '" />';
		echo '<input type="hidden" name="op" value="DownloadNewDelete" />';
		echo '</form>';
		CloseTable2();
		echo '<br />';
	}
} else {
	echo '<div align="center"><p class="title">' . _DL_DNODOWNLOADSWAITINGVAL . '</p></div>';
}
CloseTable2();
CloseTable();
include_once 'footer.php';

