<?php //fixed done
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
/*
 * Code vastly re-written by montego to reduce the number of SQL queries dramatically.
 */
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = '- ' . _DL_NEWDOWNLOADS;
include_once 'header.php';
menu(1);
echo '<br />';
title('<h1>'._DL_NEWDOWNLOADS.'</h1>');
OpenTable2();
/*
 * Get a count of the number of new downloads within the last 7 days.
 */
$dlDateLowerLimit = Date('Y-m-d', (time() - (86400 * 6)));
$sql = 'SELECT COUNT(`lid`) FROM `'.$prefix.'_nsngd_downloads` WHERE `date` > \''.$dlDateLowerLimit.'\' AND `active` > 0';
list($allweekdownloads) = $db->sql_fetchrow($db->sql_query($sql));
/*
 * Get a count of the number of new downloads within the last 30 days.
 */
$dlDateLowerLimit = Date('Y-m-d', (time() - (86400 * 29)));
$sql = 'SELECT COUNT(`lid`) FROM `'.$prefix.'_nsngd_downloads` WHERE `date` > \''. $dlDateLowerLimit.'\' AND `active` > 0';
list($allmonthdownloads) = $db->sql_fetchrow($db->sql_query($sql));
/*
 * Display the above summary totals.
 */
echo '<p align="center"><strong>'._DL_TOTALNEWDOWNLOADS.':</strong> '._DL_LASTWEEK.' - '.$allweekdownloads.' / '
	._DL_LAST30DAYS.' - '.$allmonthdownloads.'<br />';
echo _DL_SHOW.': <a href="modules.php?name='.$module_name.'&amp;op=NewDownloads&amp;newdownloadshowdays=7">'._DL_1WEEK
	.'</a> - <a href="modules.php?name='.$module_name.'&amp;op=NewDownloads&amp;newdownloadshowdays=14">'._DL_2WEEKS
	.'</a> - <a href="modules.php?name='.$module_name.'&amp;op=NewDownloads&amp;newdownloadshowdays=30">'._DL_30DAYS.'</a>';
echo '</p>';
/*
 * Check the GET variable for number of days... should not allow for less than 7 or greater than 30.
 */
if (!isset($_GET['newdownloadshowdays']) || ($_GET['newdownloadshowdays'] < 7 || $_GET['newdownloadshowdays'] > 30)) 
$newdownloadshowdays = 7;
else 
$newdownloadshowdays = $_GET['newdownloadshowdays'];

echo '<p align="center"><strong>'._DL_DTOTALFORLAST.' '. $newdownloadshowdays.' '. _DL_DAYS.':</strong></p>';
/*
 * Now get summary counts of downloads and display them.
 * @todo: IMO, this is a pretty lame presentation style.  Should actually list out the new downloads or at least make that an option.
 * @todo: Could potentially tighten up the SQL more as well, but the datetime field complicates matters slightly (because of the time element).
 */
//echo '<div align="center"><ul>';
$counter = 0;
$allweekdownloads = 0;
$newdownloadshowdaystmp = $newdownloadshowdays - 1;
while ($counter <= $newdownloadshowdaystmp) {
	$newdownloaddayRaw = (time() - (86400 * $counter));
	$newdownloadDB = Date('Y-m-d', $newdownloaddayRaw);
	$sql = 'SELECT COUNT(`lid`) FROM `' . $prefix . '_nsngd_downloads` WHERE `date` LIKE \'%' . $newdownloadDB
		. '%\' AND `active` > 0';
	list($totaldownloads) = $db->sql_fetchrow($db->sql_query($sql));
	$counter++;
	$allweekdownloads = $allweekdownloads + $totaldownloads;
	echo '<div align="center"><li><a href="modules.php?name=' . $module_name . '&amp;op=NewDownloadsDate&amp;selectdate=' . $newdownloaddayRaw
		. '">' . $newdownloadDB . '</a>&nbsp;(' . $totaldownloads . ')</li></div>';
}
//echo '</ul></div>';
CloseTable2();
CloseTable();
include_once 'footer.php';

