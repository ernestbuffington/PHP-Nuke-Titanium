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
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
global $admin_file;
if (empty($admin_file)) $admin_file = 'admin';
/*
 * For TegoNuke(tm) Mailer integration, need to stub this out in case the latest Mailer is not
 * installed.  Need to force the installation of the latest Mailer for if you're not using it
 * you will be unable to use it with this version of the TegoNuke(tm) Downloads module.
 */
if (!defined('TNML_IS_ACTIVE')) define('TNML_IS_ACTIVE', false);
/**
 * csrf_check
 * This is simply a stub function for CSRF checking to be consistent across the module.
 * RavenNuke(tm) version 2.4 and above have this as a feature that we wish to take full
 * advantage of, but need the stub for compatibility with other *nuke variants.
 */
if (!function_exists('csrf_check')) {
	function csrf_check() {
		return true;
	}
}
/*
 * If nukeWYSIWYG is installed and enabled, we'll use it.  The following constant is for that purpose
 */
if (!defined('NUKEWYSIWYG_ACTIVE')) {
	if (function_exists('wysiwyg_textarea') && isset($advanced_editor) && 1 == $advanced_editor) {
		define('NUKEWYSIWYG_ACTIVE', true);
	} else {
		define('NUKEWYSIWYG_ACTIVE', false);
	}
}
/**
 * gdFilter *
 * This function was added to bridge a temporary gap between PHP-Nuke and the newer and much
 * more secure RavenNuke(tm) systems.  The old PHP-Nuke check_html() function, even with
 * patches from Chatserv, do not sufficiently handle magic quotes being turned on.
 *
 * @param  string  $value string value to validate
 * @param  string  $strip either 'nohtml' to strip all HTML, or '' to apply the AllowableHTML[] array checks
 * @returns string cleansed input string
 */
function gdFilter($value = '', $strip = '') 
{
	if (empty($value) || ('' != $strip && 'nohtml' != $strip)) return '';

	static $doStrip;

	if (!isset($doStrip)) 
	{
		if (IN_RAVENNUKE) 
		{
			$doStrip = false; // RavenNuke(tm)'s check_html() function will take care of stripping if needed so avoid doing it twice
		} 
		else 
		{
			$doStrip = (get_magic_quotes_gpc() == 1) ? true : false; // If not in RavenNuke(tm) and magic quotes are on, definitely need to strip.
		}
	}

	if ($doStrip) $value = stripslashes($value);
	if (IN_RAVENNUKE) {
		// RavenNuke(tm)'s check_html() function uses kses, which normalizes certain entities.  We
		// don't want these to be saved to the database.  We'll handle them properly upon output.
		return htmlspecialchars_decode(check_html($value, $strip));
	} else {
		// Regular PHP-Nuke with Chatserv patches does not normalize entities, so we don't have to decode.
		return check_html($value, $strip);
	}
}
/**
 * gdGetIP
 * Returns back as best a remote client IP address as possible and sanitized (at least to IP4)
 *
 * @return string the IP or '' if one could not be properly returned and sanitized
 * @todo Really need to have a more flexible IP4/IP6 function... will look for next release (RN needs one too!)
 */
function gdGetIP() {
	if (defined('NUKESENTINEL_IS_LOADED')) {
		global $nsnst_const;
		$sub_ip = (isset($nsnst_const['remote_ip'])) ? $nsnst_const['remote_ip'] : 'none';
	} else {
		if (getenv('HTTP_CLIENT_IP')) $sub_ip = getenv('HTTP_CLIENT_IP');
		elseif (getenv('HTTP_X_FORWARDED_FOR')) $sub_ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_X_FORWARDED')) $sub_ip = getenv('HTTP_X_FORWARDED');
		elseif (getenv('HTTP_FORWARDED_FOR')) $sub_ip = getenv('HTTP_FORWARDED_FOR');
		elseif (getenv('HTTP_FORWARDED')) $sub_ip = getenv('HTTP_FORWARDED');
		else $sub_ip = getenv('REMOTE_ADDR');
	}
	if (function_exists('validIP')) {
		if (!validIP($sub_ip)) $sub_ip = '';
	} else {
		$regex = '/^(1?\d{1,2}|2([0-4]\d|5[0-5]))(\.(1?\d{1,2}|2([0-4]\d|5[0-5]))){3}$/'; // IP4 only!
		$sub_ip = (preg_match($regex, $ip)) ? $sub_ip : '';
	}
	return $sub_ip;
}
/**
 * of_group
 * Determines if the logged in user is a member of the group that is passed in.
 *
 * @param   integer $gid the ID of the group to check the user against
 * @returns boolean where "true" = the user is an active member of the group and "false" otherwise
 */
function of_group($gid) {
    global $prefix, $db, $userinfo, $module_name;
    if (is_mod_admin($module_name)) {
        return 1;
    } elseif (is_user()) {
        $guid = (int)$cookie[0];
        $currdate = time();
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_bbuser_group WHERE group_id='".$gid."' AND user_id='$guid' AND user_pending != '1'");
        list($ingroup) = $db->sql_fetchrow($result);
        if ($ingroup > 0) { return 1; }
    }
    return 0;
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
/**
 * myimage
 * Used to allow for most Downloads module images to be made theme-specific.
 * Just create a theme specific equivalent for each of the module images and they should show.
 *
 * @param string $imgfile the image file name to show
 */
function myimage($imgfile) {
	global $module_name;
	$ThemeSel = get_theme();
	if (file_exists('themes/' . $ThemeSel . '/images/downloads/' . $imgfile)) {
		$myimage = 'themes/' . $ThemeSel . '/images/downloads/' . $imgfile;
	} else {
		$myimage = 'modules/' . $module_name . '/images/' . $imgfile;
	}
	return ($myimage);
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
/**
 * gdget_configs()
 * Gets an array of all the module configuration settings
 *
 * @returns array of module configuration settings from the database
 */
function gdget_configs() {
	global $prefix, $db;
	$config = array();
	$configresult = $db->sql_query('SELECT `config_name`, `config_value` FROM `' . $prefix . '_nsngd_config`');
	while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
		$config[$config_name] = $config_value;
	}
	return $config;
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
/**
 * gdsave_config
 * Used to save an individual configuration setting to the database.
 *
 * @param string $config_name  the name of the configuration setting
 * @param string $config_value the value to set the configuration setting to
 */
function gdsave_config($config_name, $config_value) {
	global $prefix, $db;
	$db->sql_query('UPDATE `' . $prefix . '_nsngd_config` SET `config_value` = \'' . $config_value . '\' WHERE `config_name` = \'' . $config_name . '\'');
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
function CrawlLevelR($parentid) {
	global $prefix, $db, $crawler;
	$bresult = $db->sql_query('SELECT `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = \'' . $parentid . '\' ORDER BY `title`');
	while (list($parentid2) = $db->sql_fetchrow($bresult)) {
		array_push($crawler, $parentid2);
		CrawlLevelR($parentid2);
	}
	return $crawler;
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
/**
 * CrawLevel
 * Searches down the category "tree" looking for children to add to its crawl list.
 *
 * @param   integer $cid is the category ID to go look for more children from
 * @returns array        of more categories to retrieve.
 */
function CrawlLevel($cid) {
	global $prefix, $db, $crawled;
	$bresult = $db->sql_query('SELECT cid FROM ' . $prefix . '_nsngd_categories WHERE parentid=\'' . $cid . '\' ORDER BY title');
	while (list($cid2) = $db->sql_fetchrow($bresult)) {
		array_push($crawled, $cid2);
		CrawlLevel($cid2);
	}
	return $crawled;
}
/**
 * CoolSize
 * For display of the download file size into a nice Kb, Mb or Gb format
 *
 * @param integer $size filesize value for the download
 */
function CoolSize($size) {
	$mb = 1024*1024;
	$gb = $mb*1024;
	if ($size > $gb) {
		$mysize = sprintf('%01.2f', $size/$gb) . ' ' . _DL_GB;
	} elseif ($size > $mb) {
		$mysize = sprintf('%01.2f', $size/$mb) . ' ' . _DL_MB;
	} elseif ($size >= 1024) {
		$mysize = sprintf('%01.2f', $size/1024) . ' ' . _DL_KB;
	} else {
		$mysize = $size . ' ' . _DL_BYTES;
	}
	return $mysize;
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
/**
 * Produce nicely formatted date
 * Formats the date according to what is set within the configuration options
 *
 * @param   timestamp $date
 * @returns string
 */
function CoolDate($date) {
	global $dl_config;
	$mydate = date($dl_config['dateformat'], strtotime($date));
	return $mydate;
}
// Copyright (c) 2003 --- Michael K. Squires ---
// Can not be reproduced in whole or in part without
// written consent from Michael K. Squires
function getcategoryinfo($catID) {
	global $prefix, $db, $user;
	$category = array($catID);
	$cats_detected = 0;
	$downloads_detected = 0;
	while (count($category) != 0) {
		sort($category, SORT_STRING);
		reset($category);
		$curr_category = end($category);
		$dresult = $db->sql_query('SELECT `lid` FROM `' . $prefix . '_nsngd_downloads` WHERE `cid` = \'' . $curr_category . '\'');
		$catdownloads = $db->sql_numrows($dresult);
		$downloads_detected += $catdownloads;
		$cresult = $db->sql_query('SELECT `cid` FROM `' . $prefix . '_nsngd_categories` WHERE `parentid` = \'' . $curr_category . '\'');
		while (list($cid) = $db->sql_fetchrow($cresult)) {
			array_unshift($category, $cid);
			$cats_detected++;
		}
		array_pop($category);
	}
	$categoryinfo['categories'] = $cats_detected;
	$categoryinfo['downloads'] = $downloads_detected;
	return $categoryinfo;
}
/**
 * getparent
 * Obtains the category title of the parent of a given category.
 *
 * @param   integer $parentid category id of the parent that is used to retrieve its title
 * @param   string  $title    category title for the current "child"
 * @returns string          parent title appended with the current passed in title
 */
function getparent($parentid, $title) {
	global $prefix, $db;
	$result = $db->sql_query('SELECT `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . (int)$parentid);
	$cidinfo = $db->sql_fetchrow($result);
	if ($cidinfo['title'] != '') $title = htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET) . ' -&gt; ' . $title;
	if ($cidinfo['parentid'] != 0) {
		$title = getparent($cidinfo['parentid'], $title);
	}
	return $title;
}
function getparentlink($parentid, $title) {
	global $prefix, $db, $module_name;
	$parentid = intval($parentid);
	$sql = 'SELECT `cid`, `title`, `parentid` FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $parentid;
	if ($cidinfo = $db->sql_fetchrow($db->sql_query($sql))) {
		if ($cidinfo['title'] != '') {
			$title = '<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cidinfo['cid'] . '">'
				. htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET) . '</a> -&gt; ' . $title;
		}
		if ($cidinfo['parentid'] != 0) {
			$title = getparentlink($cidinfo['parentid'], $title);
		}
	}
	return $title;
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
function restricted($perm) 
{
	global $db, $prefix, $module_name;

	if ($perm == 1) 
	{
		$who_view = _DL_USERS;
	} 
	else
	if ($perm == 2) 
	{
		$who_view = _DL_ADMIN;
	} 
	else
	if ($perm > 2) 
	{
		$newView = $perm-2;
		$sql = 'SELECT `group_name` FROM `' . $prefix . '_bbgroups` WHERE `group_id` = ' . $newView;
		list($who_view) = $db->sql_fetchrow($db->sql_query($sql));
		$who_view = $who_view . ' ' . _DL_ONLY;
	}

	echo '<div align="center"><p><img src="'.img('restricted.png','Downloads').'" alt="" /></p>';
	echo '<p>' . _DL_DENIED . '!</p>';
	echo '<p>' . _DL_CANBEDOWN . ' ' . $who_view . '</p>';
	echo '<p>' . _GOBACK . '</p></div>';
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
function restricted2($perm) {
	global $db, $prefix, $module_name;
	if ($perm == 1) {
		$who_view = _DL_USERS;
	} elseif ($perm == 2) {
		$who_view = _DL_ADMIN;
	} elseif ($perm > 2) {
		$newView = $perm-2;
		list($who_view) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid` = ' . $newView));
		$who_view = $who_view . ' ' . _DL_ONLY;
	}
	echo '<div align="center"><p>' . _DL_DENIED . '!<p><p>';
	echo _DL_CANBEVIEW . '</p><p><strong>' . $who_view . '</strong></p></div>';
}
/**
 * newdownloadgraphic
 * Checks to see if the provided string time is with NN days of being new.
 * If so, it will display the appropriate New graphic.
 * @param string $datetime Not used?
 * @param string $time the date string to check to see if new in NN days
 */
function newdownloadgraphic($datetime, $time) {
	global $module_name, $locale;
	echo '&nbsp;';
	setlocale(LC_TIME, $locale);
	preg_match('%([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})%', $time, $datetime);
	$datetime = strftime(_DL_LINKSDATESTRING, mktime($datetime[4], $datetime[5], $datetime[6], $datetime[2], $datetime[3], $datetime[1]));
	$datetime = ucfirst($datetime);
	$startdate = time();
	$count = 0;
	
	while ($count <= 14) 
	{
		$daysold = date('d-M-Y', $startdate);
		if ($daysold == $datetime) 
		{
			if ($count <= 1)
			echo '<img src="'.img('new_01.png','Downloads').'" alt="'._DL_NEWTODAY.'" title="'._DL_NEWTODAY.'" />';
			if ($count <= 3 && $count > 1)
			echo '<img src="'.img('new_03.png','Downloads').'" alt="'._DL_NEWLAST3DAYS.'" title="'._DL_NEWLAST3DAYS.'" />';
			if ($count <= 7 && $count > 3)
			echo '<img src="'.img('new_07.png','Downloads').'" alt="' . _DL_NEWTHISWEEK . '" title="' . _DL_NEWTHISWEEK . '" />';
			if ($count <= 14 && $count > 7)
			echo '<img src="'.img('new_14.png','Downloads').'" alt="' . _DL_NEWLAST2WEEKS . '" title="' . _DL_NEWLAST2WEEKS . '" />';
			
		}
		$count++;
		$startdate = (time() -(86400*$count));
	}
	return;
}
/**
 * newcategorygraphic
 * Checks for downloads within a given category to see if any are New in NN days.
 * If so, displays the appropriate New graphic.
 * @param integer $cat the category ID to check for new downloads in
 */
function newcategorygraphic($cat) {
	global $prefix, $db, $module_name,$locale;
	$cat = intval($cat);
	$newresult = $db->sql_query('SELECT `date` FROM `' . $prefix . '_nsngd_downloads` WHERE `cid` = ' . $cat . ' ORDER BY `date` DESC LIMIT 1');
	if (list($time) = $db->sql_fetchrow($newresult)) {
		echo '&nbsp;';
		setlocale(LC_TIME, $locale);
		preg_match('%([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})%', $time, $datetime);
		$datetime = strftime(_DL_LINKSDATESTRING, mktime($datetime[4], $datetime[5], $datetime[6], $datetime[2], $datetime[3], $datetime[1]));
		$datetime = ucfirst($datetime);
		$startdate = time();
		$count = 0;
		while ($count <= 14) {
			$daysold = date('d-M-Y', $startdate);
			if ($daysold == $datetime) 
			{
				if ($count <= 1)
				echo '<img align="middle" src="'.img('new_01.png','Downloads').'" alt="' . _DL_DCATNEWTODAY . '" title="' . _DL_DCATNEWTODAY . '" />';
				if ($count <= 3 && $count > 1)
				echo '<img align="middle" src="'.img('new_03.png','Downloads').'" alt="' . _DL_DCATLAST3DAYS . '" title="' . _DL_DCATLAST3DAYS . '" />';
				if ($count <= 7 && $count > 3)
				echo '<img align="middle" src="'.img('new_07.png','Downloads').'" alt="' . _DL_DCATTHISWEEK . '" title="' . _DL_DCATTHISWEEK . '" />';
				if ($count <= 14 && $count > 7)
				echo '<img align="middle" src="'.img('new_14.png','Downloads').'" alt="' . _DL_DCATLAST2WEEKS . '" title="' . _DL_DCATLAST2WEEKS . '" />';
			}
			$count++;
			$startdate = (time() -(86400*$count));
		}
	}
	return;
}

function popgraphic($hits) 
{
	global $module_name, $dl_config;
	$hits = intval($hits);
	if ($hits >= $dl_config['popular']) 
	echo '&nbsp;<img align="middle" src="'.img('popular.png','Downloads').'" alt="' . _DL_POPULAR . '" title="' . _DL_POPULAR . '" />';
}

function DLadminmain() {
	global $admin_file, $module_name, $prefix, $db, $textcolor1, $bgcolor1, $bgcolor2;
	$brokendownloads = $db->sql_numrows($db->sql_query('SELECT `rid` FROM `' . $prefix . '_nsngd_mods` WHERE `brokendownload` = \'1\''));
	$modrequests = $db->sql_numrows($db->sql_query('SELECT `rid` FROM `' . $prefix . '_nsngd_mods` WHERE `brokendownload` = \'0\''));
	$newdownloads = $db->sql_numrows($db->sql_query('SELECT `lid` FROM `' . $prefix . '_nsngd_new`'));
	OpenTable2();
	echo '<table align="center" border="0" cellpadding="2" cellspacing="2" width="100%">';
	echo '<tr>';
	echo '<td align="center" width="25%"><strong>'._DL_DOWNLOADS.'</strong></td>';
	echo '<td align="center" width="25%"><strong>'._DL_CATEGORIES.'</strong></td>';
	echo '<td align="center" width="25%"><strong>'._DL_EXTENSIONS.'</strong></td>';
	echo '<td align="center" width="25%"><strong>'._DL_OTHERS.'</strong></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=DownloadAdd">'._DL_ADDDOWNLOAD.'</a></td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=CategoryAdd">'._DL_ADDCATEGORY.'</a></td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=ExtensionAdd">'._DL_ADDEXTENSION.'</a></td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=DLConfig">'._DL_DOWNCONFIG.'</a></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=Downloads">'._DL_DOWNLOADSLIST.'</a></td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=Categories">'._DL_CATEGORIESLIST.'</a></td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=Extensions">'._DL_EXTENSIONSLIST.'</a></td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php">'._DL_MAINADMIN.'</a></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=DownloadCheck">'._DL_VALIDATEDOWNLOADS.'</a></td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=CategoryTransfer">'._DL_CATTRANS.'</a></td>';
	echo '<td align="center" width="25%">&nbsp;</td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=DownloadBroken">'._DL_BROKENREP.'</a> ('.$brokendownloads.')</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=FilesizeCheck">'._DL_VALIDATESIZES.'</a></td>';
	echo '<td align="center" width="25%">&nbsp;</td>';
	echo '<td align="center" width="25%">&nbsp;</td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=DownloadModifyRequests">'._DL_MODREQUEST.'</a> ('.$modrequests.')</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td align="center" width="25%">&nbsp;</td>';
	echo '<td align="center" width="25%">&nbsp;</td>';
	echo '<td align="center" width="25%">&nbsp;</td>';
	echo '<td align="center" width="25%"><a href="'.$admin_file.'.php?op=DownloadNew">'._DL_WAITINGDOWNLOADS.'</a> ('.$newdownloads.')</td>';
	echo '</tr>';
	echo '</table>';
	CloseTable2();
}
function convertorderbyin($orderby) {
	if ($orderby == 'titleA') {
		$orderby = '`title` ASC';
	} elseif ($orderby == 'dateA') {
		$orderby = '`date` ASC';
	} elseif ($orderby == 'hitsA') {
		$orderby = '`hits` ASC';
	} elseif ($orderby == 'titleD') {
		$orderby = '`title` DESC';
	} elseif ($orderby == 'dateD') {
		$orderby = '`date` DESC';
	} else {
		$orderby = '`hits` DESC';
	}
	return $orderby;
}
function convertorderbytrans($orderby) {
	if ($orderby == '`hits` ASC') {
		$orderbyTrans = _DL_POPULARITY1;
	} elseif ($orderby == '`hits` DESC') {
		$orderbyTrans = _DL_POPULARITY2;
	} elseif ($orderby == '`title` ASC') {
		$orderbyTrans = _DL_TITLEAZ;
	} elseif ($orderby == '`title` DESC') {
		$orderbyTrans = _DL_TITLEZA;
	} elseif ($orderby == '`date` ASC') {
		$orderbyTrans = _DL_DDATE1;
	} else {
		$orderbyTrans = _DL_DDATE2;
	}
	return $orderbyTrans;
}
function convertorderbyout($orderby) {
	if ($orderby == '`title` ASC') {
		$orderby = 'titleA';
	} elseif ($orderby == '`date` ASC') {
		$orderby = 'dateA';
	} elseif ($orderby == '`hits` ASC') {
		$orderby = 'hitsA';
	} elseif ($orderby == '`title` DESC') {
		$orderby = 'titleD';
	} elseif ($orderby == '`date` DESC') {
		$orderby = 'dateD';
	} elseif ($orderby == '`hits` DESC') {
		$orderby = 'hitsD';
	} else {
		$orderby = '';
	}
	return $orderby;
}

function menu($maindownload) {
	global $theme_name, $module_name;

	OpenTable();
	OpenTable2();
	
	echo '<div align="center" class="content"><p><a href="modules.php?name='.$module_name.'"><img src="'.img('down-logo.png','Downloads').'" border="0" alt="" title="" /></a></p>';
	echo '<h1>DOWNLOADS</h1>';
	SearchForm();
	echo '<p>[ ';
	if ($maindownload > 0)
	echo '<a href="modules.php?name=' . $module_name . '">'._DL_DOWNLOADSMAIN.'</a> | ';

	echo '<a href="modules.php?name=Submit_Downloads">'._DL_ADD.'</a>';
	echo ' | <a href="modules.php?name='.$module_name.'&amp;op=NewDownloads">'._DL_NEW.'</a>';
	echo ' | <a href="modules.php?name='.$module_name.'&amp;op=MostPopular">'._DL_POPULAR.'</a>';
	echo ' ]</p></div>';
	CloseTable2();
	
	echo '<br />';
	
	OpenTable2(); 
	echo '<table align="center" cellpadding="2" cellspacing="2" border="0" width="100%">';
	echo '<tr><td align="center" colspan="3"><strong>Legend of Symbols</strong></td></tr>';
	echo '<tr>';
	echo '<td align="center" width="33%"><img src="'.img('new_01.png','Downloads').'" alt="" title="" /> '._DL_NEWTODAY.'</td>';
	echo '<td align="center" width="34%"><img src="'.img('new_03.png','Downloads').'" alt="" title="" /> '._DL_NEWLAST3DAYS.'</td>';
	echo '<td align="center" width="33%"><img src="'.img('new_07.png','Downloads').'" alt="" title="" /> '._DL_NEWTHISWEEK.'</td>';
	echo '</tr>'; 
	echo '<tr>';
	echo '<td align="center" width="33%"><img src="'.img('new_14.png','Downloads').'" alt="" title="" /> '._DL_NEWLAST2WEEKS.'</td>';
	echo '<td align="center" width="34%"><small>Please Enjoy Our Downloads Area...</small></td>';
	echo '<td align="center" width="33%"><img src="'.img('popular.png','Downloads').'" alt="" title="" /> '._DL_POPULAR.'</td>';
	echo '</tr>';
	echo '</table>';
	CloseTable2();
}

function SearchForm() {
	global $module_name, $the_query;
	// TegoNuke(tm) ShortLinks:BEGIN - Comment out the original line and replace with the new one
	// as we wan't to avoid including the query string on the action - instead it should be a post variable.
	//    echo "<form action='modules.php?name=$module_name&amp;op=search&amp;query=$query' method='post'>";
	echo '<form action="modules.php?name='.$module_name.'&amp;op=search" method="post">';
	//TegoNuke(tm) ShortLinks:END
	echo '<p><input type="text" size="25" name="query" value="'.$the_query.'" /> <input type="submit" value="'._DL_SEARCH.'" /></p>';
	echo '</form>';
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
//@todo Should really consider passing in an array of most/all of the values since a query was already done with the calling code
function showlisting($lid) 
{
	global $admin_file, $module_name, $admin, $db, $prefix, $user, $dl_config, $datetime, $locale;
	$lid = intval($lid);
	$result = $db->sql_query('SELECT * FROM `'.$prefix.'_nsngd_downloads` WHERE `lid` = '.$lid);
	$lidinfo = $db->sql_fetchrow($result);
	$priv = $lidinfo['sid'] - 2;

	if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user)) 
	                           || ($lidinfo['sid'] == 2 AND is_admin($admin)) 
							   || ($lidinfo['sid'] > 2 AND of_group($priv)) 
							   || $dl_config['show_download'] == '1') 
	{
		if (is_mod_admin('super')) 
		echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=DownloadModify&amp;lid='.$lid.'"><img align="middle" src="'.img('edit.png','Downloads').'" border="0" alt="Admin Download Editor" /> </a>';

		if (is_mod_admin('super')) 
		echo '<img align="middle" src="'.img('show.png','Downloads').'" border="0" alt="" />';

        $download = "Download"; 
		$fieldtitle = '<a href="modules.php?name='.$module_name.'&amp;op=getit&amp;lid='.$lid.'"><strong>'.htmlspecialchars($lidinfo['title'],ENT_QUOTES, _CHARSET).'</strong></a>';
	
		echo "<fieldset><legend align='center'><strong><font color=\"$textcolor1\">$fieldtitle</font></strong></legend>";
		echo '<h1>'.htmlspecialchars($lidinfo['title']).'</h1> '; 
		echo '<a href="modules.php?name=' . $module_name . '&amp;op=getit&amp;lid=' . $lid . '"><strong>'.'[ '.htmlspecialchars($download.' ]', ENT_QUOTES, _CHARSET).'</strong></a>';
		
		newdownloadgraphic($datetime, $lidinfo['date']);
		
		popgraphic($lidinfo['hits']);
		
		echo '<br />';
		
		if ($lidinfo['sid'] == 0)
		{ $who_view = _DL_ALL; 
		} elseif ($lidinfo['sid'] == 1)
		{ $who_view = _DL_USERS; 
		} else if ($lidinfo['sid'] == 2)
		{ $who_view = _DL_ADMIN;
		}elseif ($lidinfo['sid'] > 2) 
		{
			$newView = $lidinfo['sid']-2;
			list($who_view) = $db->sql_fetchrow($db->sql_query('SELECT gname FROM '.$prefix.'_nsngr_groups WHERE gid='.$newView));
			$who_view = $who_view.' '._DL_ONLY;
		}
		echo '<br />';
		echo '<strong>'._DL_PERM.' : </strong>'.$who_view.'<br />';
		echo '<strong>'._DL_VERSION.' : </strong>'.htmlspecialchars($lidinfo['version'],ENT_QUOTES, _CHARSET).'<br />';
		echo '<strong>'._DL_FILESIZE.' : </strong>'.CoolSize($lidinfo['filesize']).'<br />';
		echo '<strong>'._DL_ADDEDON.' : </strong>'.CoolDate($lidinfo['date']).'<br />';
		echo '<strong>'._DL_DOWNLOADS.' : </strong>'.(int)$lidinfo['hits'].'<br />'; 
		
		if (preg_match('#^(http(s?))://#i', $lidinfo['homepage'])) 
		{
		    echo '<strong>'._DL_HOMEPAGE.':</strong> ';
			echo '<a href="'.$lidinfo['homepage'].'" target="_tab">'.htmlspecialchars($lidinfo['homepage'],ENT_QUOTES, _CHARSET).'</a>';
	        echo "</fieldset>";
		} 
		else 
		echo "<br /></fieldset>";
		
	} 
	else 
	{
		restricted2($lidinfo['sid']);
	}
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
//@todo Should really consider passing in an array of most/all of the values since a query was already done with the calling code
function showresulting($lid) {
	global $admin_file, $module_name, $admin, $db, $prefix, $user, $dl_config, $datetime;
	$lid = intval($lid);
	$lidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `lid` = ' . $lid));

	$priv = $lidinfo['sid'] - 2;
	if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user)) 
	                           || ($lidinfo['sid'] == 2 AND is_mod_admin('super')) 
							   || ($lidinfo['sid'] > 2 AND of_group($priv)) 
							   || $dl_config['show_download'] == '1') 
	{
	
		if (is_mod_admin('super')) 
		echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=DownloadModify&amp;lid='.$lid.'"><img align="middle" src="'.img('edit.png','Downloads').'" border="0" alt="Admin Download Editor" /> </a>';

		if (is_mod_admin('super')) 
		echo '<img align="middle" src="'.img('show.png','Downloads').'" border="0" alt="" />';

		
		$download = "Download"; 
		$fieldlisttitle = '<a href="modules.php?name='.$module_name.'&amp;op=getit&amp;lid='.$lid.'"><strong>'.htmlspecialchars($lidinfo['title'],ENT_QUOTES, _CHARSET).'</strong></a>';
	
		echo "<fieldset><legend align='center'><strong><font color=\"$textcolor1\">$fieldlisttitle</font></strong></legend>";
		echo '<h1>'.htmlspecialchars($lidinfo['title']).'</h1> ';   
		echo '<a href="modules.php?name=' . $module_name . '&amp;op=getit&amp;lid=' . $lid . '"><strong>'.'[ '.htmlspecialchars($download.' ]', ENT_QUOTES, _CHARSET).'</strong></a>';
		
		newdownloadgraphic($datetime, $lidinfo['date']);
		
		popgraphic($lidinfo['hits']);
		
		echo '<br />';
		
		if ($lidinfo['sid'] == 0) 
		{
			$who_view = _DL_ALL;
		} 
		else
		if ($lidinfo['sid'] == 1) 
		{
			$who_view = _DL_USERS;
		} 
		else
		if ($lidinfo['sid'] == 2) 
		{
			$who_view = _DL_ADMIN;
		} 
		else
		if ($lidinfo['sid'] > 2) 
		{
			$newView = $lidinfo['sid']-2;
			list($who_view) = $db->sql_fetchrow($db->sql_query('SELECT `gname` FROM `' . $prefix . '_nsngr_groups` WHERE `gid` = ' . $newView));
			$who_view = $who_view . ' ' . _DL_ONLY;
		}
		
		echo '<br />';
		echo '<strong>' . _DL_PERM . ':</strong> ' . $who_view . '<br />';
		echo '<strong>' . _DL_VERSION . ':</strong> ' . htmlspecialchars($lidinfo['version'], ENT_QUOTES, _CHARSET) . '<br />';
		echo '<strong>' . _DL_FILESIZE . ':</strong> ' . CoolSize($lidinfo['filesize']) . '<br />';
		echo '<strong>' . _DL_ADDEDON . ':</strong> ' . CoolDate($lidinfo['date']) . '<br />';
		echo '<strong>' . _DL_DOWNLOADS . ':</strong> ' . (int)$lidinfo['hits'] . '<br />';
		
		if (preg_match('#^(http(s?))://#i', $lidinfo['homepage'])) {
		echo '<strong>' . _DL_HOMEPAGE . ':</strong> ';
		echo '<a href="' . $lidinfo['homepage'] . '" target="_tab">' . htmlspecialchars($lidinfo['homepage'], ENT_QUOTES, _CHARSET) . '</a>';
		} 
		
		$result2 = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $lidinfo['cid']);
		$numrows = $db->sql_numrows($result2);
		
		if ($numrows == 1) 
		{
			$cidinfo = $db->sql_fetchrow($result2);
			$cidinfo['title'] = '<a href="modules.php?name=' . $module_name . '&amp;cid=' . $lidinfo['cid'] . '">'
				. htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET) . '</a>';
			$cidinfo['title'] = getparentlink($cidinfo['parentid'], $cidinfo['title']);
		}
		
		echo '<br /><strong>' . _DL_CATEGORY . ':</strong> ' . ($numrows == 1 ? $cidinfo['title'] : _DL_NONE);
	} 
	else {
		restricted2($lidinfo['sid']);
	}
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
function pagenums_admin($op, $totalselected, $perpage, $max) {
	global $admin_file, $query, $cid;
	$pagesint = ($totalselected / $perpage);
	$pageremainder = ($totalselected % $perpage);
	if ($pageremainder != 0) {
		$pages = ceil($pagesint);
		if ($totalselected < $perpage) {
			$pageremainder = 0;
		}
	} else {
		$pages = $pagesint;
	}
	if ($pages != 1 && $pages != 0) {
		$counter = 1;
		$currentpage = ($max / $perpage);
		echo '<form action="' . $admin_file . '.php" method="post">';
		echo '<table border="0" cellpadding="2" cellspacing="2" width="100%">';
		echo '<tr>';
		echo '<td align="right"><strong>' . _DL_SELECTPAGE . ': </strong><select name="min" onchange="top.location.href=this.options[this.selectedIndex].value">';
		while ($counter <= $pages) {
			$cpage = $counter;
			$mintemp = ($perpage * $counter) -$perpage;
			if ($counter == $currentpage) {
				echo '<option selected="selected">' . $counter . '</option>';
			} else {
				echo '<option value="' . $admin_file . '.php?op=' . $op . '&amp;min=' . $mintemp;
				if ($op > '') {
					echo '&amp;op=' . $op;
				}
				if ($query > '') {
					echo '&amp;query=' . $query;
				}
				if (isset($cid)) {
					echo '&amp;cid=' . $cid;
				}
				echo '">' . $counter . '</option>';
			}
			$counter++;
		}
		echo '</select><strong> ' . _DL_OF . ' ' . $pages . ' ' . _DL_PAGES . '</strong></td></tr>';
		echo '</table></form>';
	}
}
// Copyright (c) 2003 --- NukeScripts Network ---
// Can not be reproduced in whole or in part without
// written consent from NukeScripts Network CEO
function pagenums($cid, $query, $orderby, $op, $totalselected, $perpage, $max) {
	global $module_name;
	$pagesint = ($totalselected/$perpage);
	$pageremainder = ($totalselected%$perpage);
	if ($pageremainder != 0) {
		$pages = ceil($pagesint);
		if ($totalselected < $perpage) {
			$pageremainder = 0;
		}
	} else {
		$pages = $pagesint;
	}
	if ($pages != 1 && $pages != 0) {
		$counter = 1;
		$currentpage = ($max/$perpage);
		echo '<form action="modules.php?name=' . $module_name . '" method="post">';
		echo '<table border="0" cellpadding="2" cellspacing="2" width="100%">';
		echo '<tr><td align="right"><strong>' . _DL_SELECTPAGE . ': </strong><select name="min" onchange="top.location.href=this.options[this.selectedIndex].value">';
		while ($counter <= $pages) {
			$cpage = $counter;
			$mintemp = ($perpage*$counter) -$perpage;
			if ($counter == $currentpage) {
				echo '<option selected="selected">' . $counter . '</option>';
			} else {
				echo '<option value="modules.php?name=' . $module_name . '&amp;min=' . $mintemp;
				if ($op > '') {
					echo '&amp;op=' . $op;
				}
				if ($query > '') {
					echo '&amp;query=' . $query;
				}
				if (isset($cid)) {
					echo '&amp;cid=' . $cid;
				}
				if ($orderby != '') {
					echo '&amp;orderby=' . $orderby;
				}
				echo '">' . $counter . '</option>';
			}
			$counter++;
		}
		echo '</select><strong> ' . _DL_OF . ' ' . $pages . ' ' . _DL_PAGES . '</strong></td></tr>';
		echo '</table></form>';
	}
}
/**
 * gdValidateExt
 * Performs a simple validation on the extension of a file/image.
 * Must started with a "dot" followed by 1 to 5 alphanumeric characters.
 * Modify the preg_match here once and it will be used throughout.
 *
 * @param  string $ext is the file/image extension to validate
 * @return boolean "true" if valid extension, "false" otherwise
 */
function gdValidateExt($ext = '') {
	if (preg_match('#^\.[a-zA-Z0-9]{1,5}$#', $ext)) return true; else return false;
}
/**
 * gdURLEncode
 * Safely encodes a URL for passing back-and-force in a GET fashion.  Use this to encode
 * a query string parameter value.
 *
 * @author pablo at compuar dot com 30-Dec-2008 11:46
 * @link http://us.php.net/manual/en/function.base64-encode.php#87925
 * @param  string $encode the URL string to encode
 * @return string the encoded string
 */
function gdURLEncode($encode='') {
	$str = @strtr(base64_encode(addslashes(gzcompress(serialize($encode),9))), '+/=', '-_,');
	if (empty($str)) return ''; else return $str;
}
/**
 * gdURLEncode
 * Safely decodes a URL paramter value that was previously formatted by gdURLEncode and that was passed
 * in a GET fashion.  Use this to decode a query string parameter value.
 *
 * @author pablo at compuar dot com 30-Dec-2008 11:46
 * @link http://us.php.net/manual/en/function.base64-encode.php#87925
 * @param  string $decode the URL string to decode
 * @return string the decoded string
 */
function gdURLDecode($decode='') {
	// Have to use "@" in front to surpress anyone from forcing an error, such as with gzuncompress, by changing the encoded
	// value on the GET string.
	$str = @unserialize(gzuncompress(stripslashes(base64_decode(strtr($decode, '-_,', '+/=')))));
	if (empty($str)) return ''; else return $str;
}
/**
 * gdEmpty
 * Since an empty value between some HTML tages will throw a compliance error, why not
 * put in a non-breaking space character.
 *
 * @param  string $value the string to check if empty
 * @return string either the string passed in through $value or '&nbsp;' if $value is empty
 */
function gdEmpty($value) {
	if (empty($value)) return '&nbsp;'; else return $value;
}

