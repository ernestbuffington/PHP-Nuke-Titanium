<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
echo '<html>'."\n";
echo '<head>'."\n";
$pagetitle = _AB_NUKESENTINEL.": "._AB_AGENTTRACKING;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
$tid=intval($tid);
list($uname) = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `user_agent` FROM `".$titanium_prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$xname = wordwrap($uname, 50, "\n", true);
$xname = str_replace("&amp;amp;", "&amp;", htmlentities($xname, ENT_QUOTES));
$xname = str_replace("\n", "<br />\n", $xname);
echo '<center><strong>'.$xname.'</strong></center><br />'."\n";
echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
echo '<tr bgcolor="#ffffff">'."\n";
echo '<td><strong>'._AB_PAGEVIEWED.'</strong></td>'."\n";
echo '<td><strong>'._AB_DATE.'</strong></td>'."\n";
echo '</tr>'."\n";
$result = $titanium_db->sql_query("SELECT `page`, `date` FROM `".$titanium_prefix."_nsnst_tracked_ips` WHERE `user_agent`='$uname' ORDER BY `date` DESC");
while(list($page, $date_time) = $titanium_db->sql_fetchrow($result)){
  $page = wordwrap($page, 50, "\n", true);
  $page = str_replace("&amp;amp;", "&amp;", htmlentities($page, ENT_QUOTES));
  $page = str_replace("\n", "<br />\n", $page);
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td>'.$page.'</td>'."\n";
  echo '<td>'.date("Y-m-d \@ H:i:s",$date_time).'</td>'."\n";
  echo '</tr>'."\n";
}
echo '</table>'."\n";
echo '</body>'."\n";
echo '</html>';

?>