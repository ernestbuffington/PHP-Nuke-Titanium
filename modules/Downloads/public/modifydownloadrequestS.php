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
/*
 * montego - tightened up the user cookie code a bit with 1.1.0
 */
if(is_user($user)) {
	$user2 = base64_decode($user);
	$user2 = addslashes($user2);
	$cookie = explode(':', $user2);
	cookiedecode($user);
	$ratinguser = $cookie[1];
} else {
	$ratinguser = $anonymous;
}
if ($dl_config['blockunregmodify'] == 1 && !is_user($user)) {
	include_once 'header.php';
	menu(1);
	echo '<br />';
	OpenTable();
	echo '<div align="center"><p class="title">' . _DL_DONLYREGUSERSMODIFY . '</p></div>';
	CloseTable();
	include_once 'footer.php';
} else {
	/*
	 * Validate / Cleanse user input
	 */
	$lid = (isset($lid)) ? intval($lid) : 0;
	$cat = (isset($cat)) ? intval($cat) : 0;
	$title = (isset($title)) ? addslashes(check_words(substr(gdFilter($title, 'nohtml'), 0, 100))) : '';
	$url = (isset($url)) ? addslashes(substr(gdFilter($url, 'nohtml'), 0, 255)) : '';
	$description = (isset($description)) ? addslashes(check_words(gdFilter($description, ''))) : '';
	$auth_name = (isset($auth_name)) ? addslashes(substr(gdFilter($auth_name, 'nohtml'), 0, 100)) : '';
	$version = (isset($version)) ? addslashes(substr(gdFilter($version, 'nohtml'), 0, 20)) : '';
	$homepage = (isset($homepage)) ? addslashes(substr(gdFilter($homepage, 'nohtml'), 0, 255)) : '';
	$ratinguser = addslashes($ratinguser );
	/*
	 * @todo Following code to ensure only an integer filesize survives needs to be locale aware due to differences in 1000's separators
	 */
	$filesize = (isset($filesize)) ? gdFilter($filesize, 'nohtml') : 0;
	$filesize = preg_replace('/[,]/', '', $filesize);
	$filesize = intval($filesize);
	/*
	 * If we're in RavenNuke(tm), we can validate the email address (simple form, not fully RFC compliant)
	 */
	$email = (isset($email)) ? substr(gdFilter($email, 'nohtml'), 0, 100) : '';
	if (function_exists('validate_email') && false === validate_email($email)) $email = '';
	$email = addslashes($email);
	/*
	 * Get the submitter's IP address if we can
	 */
	$sub_ip = gdGetIP();
	/*
	 * Time to write the modification request to the database
	 */
	$sql = 'INSERT INTO `' . $prefix . '_nsngd_mods` VALUES (NULL, ' . $lid . ', ' . $cat . ', 0, \'' . $title . '\', \'' . $url
		. '\', \'' . $description . '\', \'' . $ratinguser . '\', \'' . addslashes($sub_ip) . '\', 0, \'' . $auth_name . '\', \'' . $email
		. '\', \'' . $filesize . '\', \'' . $version . '\', \'' . $homepage . '\')';
	$db->sql_query($sql);
	include_once 'header.php';
	menu(1);
	echo '<br />';
	//OpenTable();
	echo '<div align="center"><p>' . _DL_THANKSFORINFO . ' ' . _DL_LOOKTOREQUEST . '</p></div>';
	CloseTable();
	include_once 'footer.php';
}

