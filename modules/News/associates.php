<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
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
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$sid = intval($sid);
$query = $db->sql_query("SELECT associated FROM ".$prefix."_stories WHERE sid='$sid'");
list($associated) = $db->sql_fetchrow($query);
$db->sql_freeresult($query);

if (!empty($associated)) {
    OpenTable();
    echo "<center><strong>"._ASSOTOPIC."</strong><br /><br />";
     $asso_t = explode("-",$associated);
    for ($i=0; $i<count($asso_t); $i++) {
    if (!empty($asso_t[$i])) {
        $query = $db->sql_query("SELECT topicimage, topictext from ".$prefix."_topics WHERE topicid='".$asso_t[$i]."'");
        list($topicimage, $topictext) = $db->sql_fetchrow($query);
        $db->sql_freeresult($query);
        echo "<a href=\"modules.php?name=$module_name&new_topic=$asso_t[$i]\"><img src=\"".$tipath.$topicimage."\" border=\"0\" hspace=\"10\" alt=\"".$topictext."\" title=\"".$topictext."\"></a>";
    }
    }
    echo "</center>";
    CloseTable();
    echo "<br />";
}

?>