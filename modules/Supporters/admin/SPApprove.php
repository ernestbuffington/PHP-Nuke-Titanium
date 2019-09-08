<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

$site_id = intval($site_id);
$result = $db->sql_query("UPDATE `".$prefix."_nsnsp_sites` SET `site_status`='1' WHERE `site_id`='$site_id'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$cache->delete('numsuppen', 'submissions');
$cache->delete('numsupact', 'submissions');
$cache->delete('numsupdea', 'submissions');
$cache->delete('image_atts', 'nsnsp');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
redirect($admin_file.".php?op=SPPending");

?>