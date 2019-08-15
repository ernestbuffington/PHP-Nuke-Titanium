<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-Nuke Block: Total Hits v0.1                                      */
/*                                                                      */
/* Copyright (c) 2001 by C. Verhoef (cverhoef@gmx.net)                  */
/*                                                                      */
/************************************************************************/
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
global $prefix, $startdate, $db;

list($hits) = $db->sql_fetchrow($db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total' AND var='hits'"));
$content = "<center><span class=\"tiny\">"._WERECEIVED."<br /><strong><a href=\"modules.php?name=Statistics\">$hits</a></strong><br />"._PAGESVIEWS." $startdate</span></center>";

?>