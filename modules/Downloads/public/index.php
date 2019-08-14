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
 * Cleanse/validate input.
 */
$cid = isset($cid) ? intval($cid) : 0;
$min = isset($min) ? intval($min) : 0;
$max = isset($max) ? intval($max) : $min + $dl_config['perpage'];
$orderby = isset($orderby) ? convertorderbyin($orderby) : '`title` ASC';
include_once 'header.php';
/*
 * Build the top Category menu/title links (breadcrumb)
 */
if ($cid == 0) 
{
	menu(0);
	$title = _DL_MAIN;
} 
else 
{
	menu(1);
	$sql = 'SELECT `title`, `parentid` FROM `'.$prefix.'_nsngd_categories` WHERE `cid` = '.$cid.' AND `active` > 0';
	$cidinfo = $db->sql_fetchrow($db->sql_query($sql));
	$title = getparentlink($cidinfo['parentid'], htmlspecialchars($cidinfo['title'], ENT_QUOTES, _CHARSET));
	$title = '<a href="modules.php?name='.$module_name.'">'._DL_MAIN.'</a> -&gt; '.$title;
}
echo '<br />';
OpenTable4();

echo '<table align="center"><tr><td>Downloads '.$title.'</td></tr></table>';
/*
 * List the children download categories first after the breadcrumbs
 */
$sql = 'SELECT * FROM `'.$prefix.'_nsngd_categories` WHERE `parentid` = '.$cid.' AND `active` > 0 ORDER BY `title`';
$result2 = $db->sql_query($sql);
$numrows2 = $db->sql_numrows($result2);

if ($numrows2 > 0) 
{
	echo '<table align="center" border="0" cellpadding="10" cellspacing="1" width="100%">';
	$count = 0;
	
	while ($cidinfo2 = $db->sql_fetchrow($result2)) 
	{
		if ($count == 0) 
		{
			echo '<tr>';
		}
		
		if ($dl_config['show_links_num'] == 1) 
		{
			$sql = 'SELECT * FROM `'.$prefix.'_nsngd_downloads` WHERE `cid` = '.$cidinfo2['cid'].' AND `active` > 0';
			$cnumrows = $db->sql_numrows($db->sql_query($sql));
			$categoryinfo = getcategoryinfo($cidinfo2['cid']);
			$cnumm = ' ('.$cnumrows.'/'.$categoryinfo['downloads'].')';
		} 
		else 
		{
			$cnumm = '';
		}
		echo '<td valign="top" width="33%"><span class="option">';
		
		echo '<img align="absmiddle" src="'.img('icon-folder.png','Downloads').'" border="0" height="20" alt="" /> ';
		
		echo '<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cidinfo2['cid'] . '">'
			. htmlspecialchars($cidinfo2['title'], ENT_QUOTES, _CHARSET) . '</a>'
			. $cnumm . '</span>';
		
		newcategorygraphic($cidinfo2['cid']);
		
		if ($cidinfo2['cdescription']) 
		{
			echo '<br />'.$cidinfo2['cdescription'].'<br />';
		} 
		else 
		{
			echo '<br />';
		}
		
		$space = 0;
		$sql = 'SELECT `cid`, `title` FROM `'.$prefix.'_nsngd_categories` WHERE `parentid` = '.$cidinfo2['cid'].' AND `active` > 0 ORDER BY `title`';
		$result3 = $db->sql_query($sql);
		while ($cidinfo3 = $db->sql_fetchrow($result3)) 
		{
			if ($dl_config['show_links_num'] == 1) 
			{
				$sql = 'SELECT * FROM `'.$prefix.'_nsngd_downloads` WHERE `cid` = '.$cidinfo3['cid'].' AND `active` > 0';
				$snumrows = $db->sql_numrows($db->sql_query($sql));
				$categoryinfosub = getcategoryinfo($cidinfo3['cid']);
				$cnum = ' (' . $snumrows . '/' . $categoryinfosub['downloads'] . ')';
			} 
			else 
			{
				$cnum = '';
			}
			
			echo ' <img align="absmiddle" src="'.img('icon-folder.png','Downloads').'" border="0" height="20" alt="" /> '; 
			
			echo '<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cidinfo3['cid'] . '">'
				. htmlspecialchars($cidinfo3['title'], ENT_QUOTES, _CHARSET) . '</a>' . $cnum;
			
			newcategorygraphic($cidinfo3['cid']); 
			echo '<br />';
			$space++;
		}
		echo '</td>';
		if ($count < 2) {
			$dum = 1;
		}
		$count++;
		if ($count == 3) {
			echo '</tr>';
			$count = 0;
			$dum = 0;
		}
	}
	if ($dum == 1 && $count == 2) {
		echo '<td>&nbsp;</td></tr></table>';
	} elseif ($dum == 1 && $count == 1) {
		echo '<td>&nbsp;</td><td>&nbsp;</td></tr></table>';
	} elseif ($dum == 0) {
		echo '</table>';
	}
}
/*
 * Now time to go get the downloads from the selected category and list them out (with paging control)
 */
$listrows = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `active` > 0 AND `cid` = ' . $cid));
if ($listrows > 0) {
	$op = $query = '';
	$orderbyTrans = convertorderbytrans($orderby);
	echo '<table border="0" cellpadding="0" cellspacing="4" width="100%">';
	echo '<tr><td colspan="2"><hr size="1" /></td></tr>';
	echo '<tr><td align="center" colspan="2">' . _DL_SORTDOWNLOADSBY . ': ';
	echo _DL_TITLE . ' (<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cid
		. '&amp;orderby=titleA">A</a>\<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cid
		. '&amp;orderby=titleD">D</a>) ';
	echo _DL_DATE . ' (<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cid
		. '&amp;orderby=dateA">A</a>\<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cid
		. '&amp;orderby=dateD">D</a>) ';
	echo _DL_POPULARITY . ' (<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cid
		. '&amp;orderby=hitsA">A</a>\<a href="modules.php?name=' . $module_name . '&amp;cid=' . $cid
		. '&amp;orderby=hitsD">D</a>)';
	echo '<br /><strong>' . _DL_RESSORTED . ': ' . $orderbyTrans . '</strong></td></tr>';
	echo '</table>';
	$sql = 'SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `active` = 1 AND `cid` = ' . $cid;
	$totalselected = $db->sql_numrows($db->sql_query($sql));
	$orderbyURL = convertorderbyout($orderby);
	pagenums($cid, $query, $orderbyURL, $op, $totalselected, $dl_config['perpage'], $max);
	echo '<table border="0" cellpadding="0" cellspacing="4" width="100%">';
	// START LISTING
	$x = 0;
	$a = 0;
	$sql = 'SELECT lid FROM `' . $prefix . '_nsngd_downloads` WHERE `active` > 0 AND `cid` = ' . $cid . ' ORDER BY '
		. $orderby . ' LIMIT ' . $min . ',' . $dl_config['perpage'];
	$result = $db->sql_query($sql);
	while (list($lid) = $db->sql_fetchrow($result)) {
		if ($a == 0) {
			echo '<tr>';
		}
		echo '<td valign="top" width="50%">';
		showlisting($lid);
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
	// END LISTING
	pagenums($cid, $query, $orderbyURL, $op, $totalselected, $dl_config['perpage'], $max);
}
CloseTable4();
CloseTable();
include_once 'footer.php';

