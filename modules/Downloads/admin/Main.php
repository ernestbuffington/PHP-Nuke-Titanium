<?php //done
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_DOWNLOADSADMIN;
include_once 'header.php';
OpenTable();
title('<H1>'.$pagetitle.'</H1>');
DLadminmain();
CloseTable();
include_once 'footer.php';

