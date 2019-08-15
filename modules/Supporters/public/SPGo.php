<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

$site_id = intval($site_id);
$result = $db->sql_query("SELECT `site_url`, `site_status` FROM `".$prefix."_nsnsp_sites` WHERE `site_id`='$site_id'");
list($url, $status) = $db->sql_fetchrow($result);
if($status==1) {
  $db->sql_query("UPDATE `".$prefix."_nsnsp_sites` SET `site_hits`=site_hits+1 WHERE `site_id`='$site_id'");
}
redirect("$url");

?>