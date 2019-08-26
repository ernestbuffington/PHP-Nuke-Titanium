<?php // done
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
/*
 * Get the submitter's IP address if we can
 */
$sub_ip = gdGetIP();
/*
 * Ok, now insert the broken download request...
 */
$sql = 'INSERT INTO `' . $prefix . '_nsngd_mods` VALUES (NULL, ' . $lid . ', 0, 0, \'\', \'\', \'\', \''
	. addslashes($ratinguser) . '\', \'' . addslashes($sub_ip) . '\', 1, \'\', \'\', \'\', \'\', \'\')';
$db->sql_query($sql);
$pagetitle = '- ' . _DL_REPORTBROKEN;
include_once 'header.php';
menu(1);
echo '<br />';
OpenTable2();
echo '<div align="center">'; 
echo "<h1>Thanks for the information.</h1>";
echo "<h1>We'll look into your request shortly.</h1><br />";
echo '</div>';
CloseTable2();
CloseTable();
include_once 'footer.php';

