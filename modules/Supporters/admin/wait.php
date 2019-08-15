<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Submissions Block
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : wait.php
   Author        : Quake
   Version       : 2.0.0
   Date          : 09/02/2006 (dd-mm-yyyy)

   Notes         : Overview about submissions and other useful information
                   about your website.
************************************************************************/

if(!defined('NUKE_EVO')) {
    exit;
}

global $admin_file, $db, $prefix, $cache;

$module_name = basename(dirname(dirname(__FILE__)));

if(is_active($module_name)) {
    $content .= "<div align=\"left\"><strong><u><span class=\"content\">"._ASUP."</span>:</u></strong></div>";
    if(($numsuppen = $cache->load('numsuppen', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_nsnsp_sites WHERE site_status='0'");
        list($numsuppen) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numsuppen', 'submissions', $numsuppen);
    }
    if(($numsupact = $cache->load('numsupact', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_nsnsp_sites WHERE site_status='1'");
        list($numsupact) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numsupact', 'submissions', $numsupact);
    }
    if(($numsupdea = $cache->load('numsupdea', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_nsnsp_sites WHERE site_status='-1'");
        list($numsupdea) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numsupdea', 'submissions', $numsupdea);
    }
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=SPPending\">"._WSUPPORT."</a>:&nbsp;<strong>$numsuppen</strong><br />";
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=SPActive\">"._ASUPPORT."</a>:&nbsp;<strong>$numsupact</strong><br />";
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=SPInactive\">"._DSUPPORT."</a>:&nbsp;<strong>$numsupdea</strong><br />";
}

?>