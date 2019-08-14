<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads
 *
 * This module allows admins and end users (if so configured - see Submit Downloads
 * module) to add/submit downloads to their site.  This module is NSN Groups aware
 * (Note: NSN Groups is already built into RavenNuke(tm)) and carries more features
 * than the stock *nuke system Downloads module.  Check out the admin screens for a
 * multitude of configuration options.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$lid = isset($lid) ? intval($lid) : 0;
$pagetitle = '- ' . _DL_REQUESTDOWNLOADMOD;
include_once 'header.php';
menu(1);
echo '<br />';
title('<h1>'._DL_REQUESTDOWNLOADMOD.'</h1>');
OpenTable4();
if ($dl_config['blockunregmodify'] == 1 && !is_user($user)) {
	echo '<div align="center"><p class="title">' . _DL_DONLYREGUSERSMODIFY . '</p></div>';
} else {
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `lid` = ' . $lid . ' AND `active` > 0');
	$lidinfo = $db->sql_fetchrow($result);
	if ($lidinfo['lid'] == '') {
		echo '<div align="center"><p class="title">' . _DL_INVALIDDOWNLOAD . '</p></div>';
	} else {
		echo '<form action="modules.php?name=' . $module_name . '" method="post">';
		echo '<table align="center" border="0" cellpadding="2" cellspacing="2">';
		echo '<tr><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_TITLE . ':</strong></td><td><input type="text" name="title" value="'
			. htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="100" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><strong>' . _DL_URL
			. ':</strong></td><td><input type="text" name="url" value="" size="50" maxlength="255" /><br />('
			. _DL_PATHHIDE . ')</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '" valign="top"><strong>' . _DL_DESCRIPTION . ':</strong></td><td><div>';

		if (NUKEWYSIWYG_ACTIVE) {
			wysiwyg_textarea('description', $lidinfo['description'], 'NukeUser', '60', '12');
		} else {
			Make_Textarea('description', $lidinfo['description'], 'NukeUser', '', '');
			//echo '<textarea name="description" cols="60" rows="10">'.htmlspecialchars($lidinfo['description'],ENT_QUOTES,_CHARSET).'</textarea>';
		}
		echo '</div></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_CATEGORY . ':</strong></td><td><select name="cat">';
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
		echo '<tr><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_AUTHORNAME . ':</strong></td><td><input type="text" name="auth_name" value="'
			. htmlspecialchars($lidinfo['name'], ENT_QUOTES, _CHARSET) . '" size="30" maxlength="100" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_AUTHOREMAIL . ':</strong></td><td><input type="text" name="email" value="'
			. htmlspecialchars($lidinfo['email'], ENT_QUOTES, _CHARSET) . '" size="30" maxlength="100" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_FILESIZE . ':</strong></td><td><input type="text" name="filesize" value="'
			. $lidinfo['filesize'] . '" size="20" maxlength="20" /> (' . _DL_INBYTES . ')</td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_VERSION . ':</strong></td><td><input type="text" name="version" value="'
			. htmlspecialchars($lidinfo['version'], ENT_QUOTES, _CHARSET) . '" size="20" maxlength="20" /></td></tr>';
		echo '<tr><td bgcolor="' . $bgcolor2 . '"><strong>' . _DL_HOMEPAGE . ':</strong></td><td><input type="text" name="homepage" value="'
			. htmlspecialchars($lidinfo['homepage'], ENT_QUOTES, _CHARSET) . '" size="50" maxlength="255" /></td></tr>';
		echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_SENDREQUEST . '" /></td></tr>';
		echo '</table>';
		echo '<input type="hidden" name="lid" value="' . $lid . '" />';
		echo '<input type="hidden" name="op" value="modifydownloadrequestS" />';
		echo '</form>';
	}
}
CloseTable4();
CloseTable();
include_once 'footer.php';

