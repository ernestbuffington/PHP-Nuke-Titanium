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

$sql = "SELECT id, title FROM ".$titanium_prefix."_reviews ORDER BY id DESC LIMIT 0,10";
$result = $titanium_db->sql_query($sql);
while (list($id, $title) = $titanium_db->sql_fetchrow($result)) {
    $id = intval($id);
    $title = stripslashes($title);
    $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Reviews&amp;rop=showcontent&amp;id=$id\">$title</a><br />";
}
$titanium_db->sql_freeresult($result);

?>