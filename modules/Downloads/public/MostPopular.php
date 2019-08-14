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
if ($dl_config['mostpopulartrig'] == 1) {
	$pagetitle = '- '._DL_MOSTPOPULAR.' '.$dl_config['mostpopular'].'%';
} else {
	$pagetitle = '- '._DL_MOSTPOPULAR.' '.$dl_config['mostpopular'];
}
$ratenum = isset($ratenum) ? intval($ratenum) : '';
$ratetype = isset($ratetype) ? $ratetype : '';
include_once 'header.php';
menu(1);
echo '<br />';
OpenTable4();

if ($ratenum != '' && $ratetype != '') 
{
	$dl_config['mostpopular'] = $ratenum;
	
	if ($ratetype == 'percent') 
	$dl_config['mostpopulartrig'] = 1; else $dl_config['mostpopulartrig'] = 0;
}

if ($dl_config['mostpopulartrig'] == 1) 
{
	$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `active` > 0');
	$totalmostpopdownloads = $db->sql_numrows($result);
	$strRateNum = $dl_config['mostpopular'];
	$dl_config['mostpopular'] = $dl_config['mostpopular'] / 100;
	$dl_config['mostpopular'] = $totalmostpopdownloads * $dl_config['mostpopular'];
	$dl_config['mostpopular'] = ($dl_config['mostpopular'] > 1) ? round($dl_config['mostpopular']) : 1;
	
	echo '<p align="center" class="option">'._DL_MOSTPOPULAR.' '. $strRateNum . '% (' ._DL_OFALL. ' '.$totalmostpopdownloads.' '. _DL_DOWNLOADS.')</p>';
} 
else 
{
	echo '<p align="center" class="option">'._DL_MOSTPOPULAR.' '.$dl_config['mostpopular'].'</p>';
}
echo '<table border="0" width="100%">';
echo '<tr><td align="center">'._DL_SHOWTOP.': [ <a href="modules.php?name='.$module_name.'&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=num">10</a> - ';
echo '<a href="modules.php?name='.$module_name.'&amp;op=MostPopular&amp;ratenum=25&amp;ratetype=num">25</a> - ';
echo '<a href="modules.php?name='.$module_name.'&amp;op=MostPopular&amp;ratenum=50&amp;ratetype=num">50</a> | ';
echo '<a href="modules.php?name='.$module_name.'&amp;op=MostPopular&amp;ratenum=1&amp;ratetype=percent">1%</a> - ';
echo '<a href="modules.php?name='.$module_name.'&amp;op=MostPopular&amp;ratenum=5&amp;ratetype=percent">5%</a> - ';
echo '<a href="modules.php?name='.$module_name.'&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=percent">10%</a> ]</td></tr>';
echo '</table>';

$sql = 'SELECT `lid` FROM `'.$prefix.'_nsngd_downloads` WHERE `active` > 0 ORDER BY `hits` DESC LIMIT 0, '.$dl_config['mostpopular'];

$result = $db->sql_query($sql);

if ($db->sql_numrows($result) > 0) 
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
CloseTable4();
CloseTable();
include_once 'footer.php';

