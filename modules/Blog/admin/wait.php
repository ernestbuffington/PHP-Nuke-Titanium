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
if(is_active('Submit_Blog')) {
    $content .= "<div align=\"left\"><strong><u><span class=\"content\">"._STORIES."</span>:</u></strong></div>";
    if(($numwaits = $cache->load('numwaits', 'submissions')) === false) {
        list($numwaits) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM ".$prefix."_queue"), SQL_NUM);
        $cache->save('numwaits', 'submissions', $numwaits);
    }
    if (is_array($numwaits)) {
        $numwaits = $numwaits['numrows'];
    }
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=submissions\">"._SUBMISSIONS."</a>:&nbsp;<strong>".$numwaits."</strong><br />";
}

?>