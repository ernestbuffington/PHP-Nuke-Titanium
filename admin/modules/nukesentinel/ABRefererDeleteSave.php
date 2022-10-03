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

$getIPs = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_referers` WHERE `rid`='".$rid."' LIMIT 0,1"));
$titanium_db->sql_query("DELETE FROM `".$titanium_prefix."_nsnst_referers` WHERE `rid`='".$rid."'");
$titanium_db->sql_query("ALTER TABLE `".$titanium_prefix."_nsnst_referers` ORDER BY `referer`");
$titanium_db->sql_query("OPTIMIZE TABLE `".$titanium_prefix."_nsnst_referers`");
$list_referer = explode("\r\n", $ab_config['list_referer']);
$list_referer = str_replace($getIPs['referer'], "", $list_referer);
rsort($list_referer);
$phpbb2_endlist = count($list_referer)-1;
if(empty($list_referer[$phpbb2_endlist])) { array_pop($list_referer); }
sort($list_referer);
$list_referer = implode("\r\n", $list_referer);
absave_config("list_referer", $list_referer);
header("Location: ".$admin_file.".php?op=$xop&min=$min&direction=$direction");

?>