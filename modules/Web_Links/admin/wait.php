<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

/*****[CHANGES]**********************************************************
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Patched                         v3.0.0       08/14/2019
      Caching System                           v1.0.0       10/31/2005
      Admin Web Links Dropdown                 v1.0.0       06/11/2005
 ************************************************************************/

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
    $content .= "<div align=\"left\"><strong><u><span class=\"content\">"._AWL."</span>:</u></strong></div>";
    if(($numbrokenl = $cache->load('numbrokenl', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_links_modrequest WHERE brokenlink='1'");
        list($numbrokenl) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numbrokenl', 'submissions', $numbrokenl);
    }
    if(($nummodreql = $cache->load('nummodreql', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_links_modrequest WHERE brokenlink='0'");
        list($nummodreql) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('nummodreql', 'submissions', $nummodreql);
    }
    if(($numwaitl = $cache->load('numwaitl', 'submissions')) === false) {
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_links_newlink");
        list($numwaitl) = $db->sql_fetchrow($result, SQL_NUM);
        $db->sql_freeresult($result);
        $cache->save('numwaitl', 'submissions', $numwaitl);
    }
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">"._BROKENLINKS."</a>:&nbsp;<strong>$numbrokenl</strong><br />";
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=LinksListModRequests\">"._MODREQLINKS."</a>:&nbsp;<strong>$nummodreql</strong><br />";
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=Links\">"._WLINKS."</a>:&nbsp;<strong>$numwaitl</strong><br />";
}
?>
