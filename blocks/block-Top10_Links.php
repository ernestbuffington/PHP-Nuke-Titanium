<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
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

if(!defined('NUKE_EVO')) exit;

global $titanium_prefix, $titanium_db;

$a = 1;
$result = $titanium_db->sql_query("SELECT lid, title FROM ".$titanium_prefix."_links_links ORDER BY hits DESC LIMIT 0,10");
while (list($lid, $title) = $titanium_db->sql_fetchrow($result)) {
    $lid = intval($lid);
    $title = stripslashes($title);
    $title2 = str_replace("_", " ", $title);
    $content .= "<strong><i class=\"bi bi-link-45deg\"></i></strong>&nbsp;<font size=\"-2\">$a: <a href=\"modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$title\">$title2</a></font><br />";
    $a++;
}
$titanium_db->sql_freeresult($result);

?>