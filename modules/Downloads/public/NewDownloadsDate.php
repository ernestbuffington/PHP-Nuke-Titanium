<?php //done
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
 * Validate/cleanse incoming user data for 'selectdate':
 * Ensure the selectdate is within 0 - 30 days, otherwise it was tampered with.
 * Default to the current date if tampered with.
 */
$currentTime = time();
$newdownloaddayRaw = ($currentTime - (86400 * 30));
$selectdate = isset($_GET['selectdate']) ? intval($_GET['selectdate']) : $currentTime;
if ($selectdate >= $currentTime) $selectdate = $currentTime; // In case a future date was provided
if ($selectdate < $newdownloaddayRaw) $selectdate = $newdownloaddayRaw; // In case it is earlier than 30 days ago
/*
 * Prepare the various needed date formats and start of page
 */
$dateDB = (date('d-M-Y', $selectdate));
$dateView = (date('F d, Y', $selectdate));
$newdownloadDB = Date('Y-m-d', $selectdate);
$pagetitle = '- ' . $dateView . ' - ' . _DL_NEWDOWNLOADS;
/*
 * Get downloads and start displaying them
 */
$sql = 'SELECT `lid` FROM `' . $prefix . '_nsngd_downloads` WHERE `active` > 0 AND `date` LIKE \'%'.$newdownloadDB.'%\' ORDER BY `title` ASC';
$result = $db->sql_query($sql);
$totaldownloads = $db->sql_numrows($result);
include_once 'header.php';
menu(1);
echo '<br />';
title('<h1>'.$dateView.' - '.$totaldownloads.' '. _DL_NEWDOWNLOADS.'</h1>');
if ($totaldownloads > 0)
OpenTable4();
if ($totaldownloads > 0) 
{
	echo '<table border="0" cellpadding="0" cellspacing="4" width="100%">';
	$a = 0;

	while (list($lid) = $db->sql_fetchrow($result)) 
	{
		if ($a == 0) 
		{
			echo '<tr>';
		}
		echo '<td valign="top" width="50%">';
		
		showresulting($lid);
		
		echo '</td>';
		$a++;
		
		if ($a == 2) 
		{
			echo '</tr>';
			$a = 0;
		}
	}
	if ($a == 1) 
	{
		echo '<td width="50%">&nbsp;</td></tr>';
	}
	echo '</table>';
}
if ($totaldownloads > 0)
CloseTable4();
CloseTable();
include_once 'footer.php';

