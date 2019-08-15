<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

$expiretime = time();
$clearresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE (`expires`<'$expiretime' AND `expires`!='0')");
while($clearblock = $db->sql_fetchrow($clearresult)) {
  $old_masscidr = ABGetCIDRs($clearblock['ip_lo'], $clearblock['ip_hi']);
  if($ab_config['htaccess_path'] != "") {
    $old_masscidr = explode("||", $old_masscidr);
    for($i=0; $i < sizeof($old_masscidr); $i++) {
      if($old_masscidr[$i]!="") {
        $old_masscidr[$i] = "deny from ".$old_masscidr[$i]."\n";
      }
    }
    $ipfile = file($ab_config['htaccess_path']);
    $ipfile = implode("", $ipfile);
    $ipfile = str_replace($old_masscidr, "", $ipfile);
    $ipfile = $ipfile;
    $doit = fopen($ab_config['htaccess_path'], "w");
    fwrite($doit, $ipfile);
    fclose($doit);
  }
  $db->sql_query("DELETE FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`='".$clearblock['ip_lo']."' AND `ip_hi`='".$clearblock['ip_hi']."'");
  $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_blocked_ranges`");
}
header("Location: ".$admin_file.".php?op=ABBlockedRangeList");

?>