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
$datekey = date('F j');
$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
$code = substr($rcode, 2, 8);
$ThemeSel = get_theme();
if (file_exists('themes/' . $ThemeSel . '/images/code_bg.png')) {
	$codeimg = 'themes/' . $ThemeSel . '/images/code_bg.png';
	include_once 'themes/' . $ThemeSel . '/theme.php';
	$tcolor = str_replace('#', '', $textcolor1);
	$tc_r = hexdec(substr($tcolor, 0, 2));
	$tc_g = hexdec(substr($tcolor, 2, 2));
	$tc_b = hexdec(substr($tcolor, 4, 2));
} else {
	$codeimg = 'images/code_bg.png';
	$tc_r = $tc_g = $tc_b = 0;
}
$image = ImageCreateFromPNG($codeimg);
$text_color = ImageColorAllocate($image, $tc_r, $tc_g, $tc_b);
header('Content-type: image/png');
ImageString($image, 5, 5, 2, $code, $text_color);
ImagePNG($image, null, 7);
ImageDestroy($image);
die();

