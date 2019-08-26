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
 * Validate/Clease incoming user input
 */
$min = isset($min) ? intval($min) : 0;
$max = isset($max) ? intval($max) : $min + $dl_config['results'];
$orderby = isset($orderby) ? convertorderbyin($orderby) : '`title` ASC';
/*
 * Need to do a little more "work" on the search query string as if its coming in off a GET (i.e., sort/hits links),
 * it is specially encoded, for security and compliance purposes, and will need to be decoded first.
 */
if (isset($_POST['query']) && !isset($_GET['query'])) {
	$query = substr(gdFilter($_POST['query'], 'nohtml'), 0, 100); // Put limit on the size of query given title field is only 100 chars
} elseif (isset($_GET['query']) && !isset($_POST['query'])) {
	$query = substr(gdFilter(gdURLDecode($_GET['query']), 'nohtml'), 0, 100);
} else {
	$query = '';
}
if (empty($query)) $query = '';
$the_query = htmlspecialchars($query, ENT_QUOTES, _CHARSET); // Save off the original query for HTML display
$the_queryURL = gdURLEncode($query); // Save off a URLencoded version of the query string
$query = addslashes($query); // Since used a bunch in SQL calls, escape it since the original was saved off
/*
 * Get and present the search results
 */
$sql = 'SELECT COUNT(`lid`) FROM `' . $prefix . '_nsngd_downloads` WHERE (`title` LIKE \'%' . $query . '%\' OR `description` LIKE \'%'
	. $query . '%\') AND `active` > 0';
list($totalselected) = $db->sql_fetchrow($db->sql_query($sql));
$style = 'background-color:' . $bgcolor2 . ';text-align:center;width=100%;padding:5px;'; // Style for section titles -> should be in a CSS... eventually
$pagetitle = '- ' . _DL_SEARCHRESULTS4 . ': ' . $the_query;
include_once 'header.php';
menu(1);
echo '<br />';
if (!empty($query)) {
	title('<h1>'._DL_SEARCHRESULTS4.': '.$the_query.'</h1>'); 
	OpenTable2();
	echo '<div class="storytitle" style="', $style, '"><h1>Search Result Categories</h1></div>';
	$sql = 'SELECT `cid`, `title`, `parentid` FROM ' . $prefix . '_nsngd_categories WHERE `active` > 0 AND title LIKE \'%' . $query
		. '%\' ORDER BY title DESC';
	$result = $db->sql_query($sql);
	$crows = $db->sql_numrows($result);
	if ($crows > 0) {
		echo '<ul>';
		while (list($cid, $title, $parentid) = $db->sql_fetchrow($result)) {
			list($numrows) = $db->sql_fetchrow($db->sql_query('SELECT COUNT(`lid`) FROM `' . $prefix . '_nsngd_downloads` WHERE `cid` = ' . (int)$cid));
			$title = htmlspecialchars($title, ENT_QUOTES, _CHARSET);
			if ($parentid > 0) $title = getparent($parentid, $title);
			$pattern = '/(' . $the_query . ')/';
			$title = preg_replace($pattern, '<strong>\1</strong>', $title);
			echo '<li><a href="modules.php?name=' . $module_name . '&amp;cid=' . $cid . '">' . $title . '</a> (' . $numrows . ')</li>';
		}
		echo '</ul>';
	} else {
		echo '<div align="center" class="option"><h2>No Search Results Found For "'.$the_query.'"</h2></div>';
	}
	CloseTable2();
	echo '<br />';
	OpenTable2();
	echo '<div class="storytitle" style="', $style, '"><h1>Download Search Results</h1></div>';
	$sql = 'SELECT COUNT(`lid`) FROM `' . $prefix . '_nsngd_downloads` WHERE `active` > 0 AND (`title` LIKE \'%' . $query
		. '%\' OR `description` LIKE \'%' . $query . '%\')';
	list($nrows) = $db->sql_fetchrow($db->sql_query($sql));
	if ($nrows > 0) {
		$orderbyURL = convertorderbyout($orderby);
		$orderbyTrans = convertorderbytrans($orderby);
		echo '<div align="center"><p>Sort Downloads By : ';
		echo 'Title (<a href="modules.php?name=' . $module_name . '&amp;op=search&amp;query=' . $the_queryURL
			. '&amp;orderby=titleA">A</a>\<a href="modules.php?name=' . $module_name . '&amp;op=search&amp;query=' . $the_queryURL
			. '&amp;orderby=titleD">D</a>) ';
		echo 'Date (<a href="modules.php?name=' . $module_name . '&amp;op=search&amp;query=' . $the_queryURL
			. '&amp;orderby=dateA">A</a>\<a href="modules.php?name=' . $module_name . '&amp;op=search&amp;query=' . $the_queryURL
			. '&amp;orderby=dateD">D</a>) ';
		echo 'Popularity (<a href="modules.php?name=' . $module_name . '&amp;op=search&amp;query=' . $the_queryURL
			. '&amp;orderby=hitsA">A</a>\<a href="modules.php?name=' . $module_name . '&amp;op=search&amp;query=' . $the_queryURL
			. '&amp;orderby=hitsD">D</a>)';
		echo '<br /><strong>Downloads : ' . $orderbyTrans . '</strong></p></div>';
		pagenums($cid, $the_queryURL, $orderbyURL, $op, $totalselected, $dl_config['perpage'], $max);
		$x = 0;
		$a = 0;
		$sql = 'SELECT `lid` FROM `' . $prefix . '_nsngd_downloads` WHERE `active` > 0 AND (`title` LIKE \'%' . $query
			. '%\' OR `description` LIKE \'%' . $query . '%\') ORDER BY ' . $orderby . ' LIMIT ' . $min . ',' . $dl_config['results'];
		$result = $db->sql_query($sql);
		echo '<table border="0" cellpadding="0" cellspacing="4" width="100%">';
		while (list($lid) = $db->sql_fetchrow($result)) {
			if ($a == 0) {
				echo '<tr>';
			}
			echo '<td valign="top" width="50%">';
			showresulting($lid);
			echo '</td>';
			$a++;
			if ($a == 2) {
				echo '</tr>';
				$a = 0;
			}
			$x++;
		}
		if ($a == 1) {
			echo '<td width="50%">&nbsp;</td></tr>';
		}
		echo '</table>';
		pagenums($cid, $the_queryURL, $orderbyURL, $op, $totalselected, $dl_config['perpage'], $max);
	} else {
		echo '<p align="center" class="option">' . _DL_NOMATCHES . '</p>';
	}
	CloseTable2();
	CloseTable();
} else {
	//title(_DL_SEARCHRESULTS4 . ': ' . $the_query);
	OpenTable2();
	echo '<p align="center" class="option">' . _DL_NOMATCHES . '</p>';
	CloseTable2();
}
include_once 'footer.php';

