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
  $content .= "<div align=\"left\"><strong><u><span class=\"content\">"._UDOWNLOADS."</span>:</u></strong></div>";
  if(($numbrokend = $cache->load('numbrokend', 'submissions')) === false) {
      $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_nsngd_mods WHERE brokendownload='1'");
      list($numbrokend) = $db->sql_fetchrow($result, SQL_NUM);
      $db->sql_freeresult($result);
      $cache->save('numbrokend', 'submissions', $numbrokend);
  }
  if(($numwaitd = $cache->load('numwaitd', 'submissions')) === false) {
      $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_nsngd_new");
      list($numwaitd) = $db->sql_fetchrow($result, SQL_NUM);
      $db->sql_freeresult($result);
      $cache->save('numwaitd', 'submissions', $numwaitd);
  }
  if(($nummodreqd = $cache->load('nummodreqd', 'submissions')) === false) {
      $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_nsngd_mods WHERE brokendownload='0'");
      list($nummodreqd) = $db->sql_fetchrow($result, SQL_NUM);
      $db->sql_freeresult($result);
      $cache->save('nummodreqd', 'submissions', $nummodreqd);
  }
  $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=DownloadBroken\">"._BROKENDOWN."</a>:&nbsp;<strong>$numbrokend</strong><br />";
  $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=DownloadNew\">"._UDOWNLOADS."</a>:&nbsp;<strong>$numwaitd</strong><br />";
  $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=DownloadModifyRequests\">"._MODREQDOWN."</a>:&nbsp;<strong>$nummodreqd</strong><br />";
}

?>