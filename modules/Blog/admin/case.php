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
/********************************************************/
/* Titanium Blogs                                       */
/* By: The 86it Developers Network                      */
/* http://hub.86it.us                                   */
/* Copyright (c) 2019 by The 86it Developers Network    */
/********************************************************/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

$modname = "Blog";
include_once(NUKE_MODULES_DIR.$modname.'/admin/language/lang-'.$currentlang.'.php');

switch($op) {

    case "NENewsConfig":
    case "NENewsConfigSave":
    case "YesDelCategory":
    case "subdelete":
    case "DelCategory":
    case "NoMoveCategory":
    case "EditCategory":
    case "SaveEditCategory":
    case "AddCategory":
    case "SaveCategory":
    case "DisplayStory":
    case "PreviewAgain":
    case "PostStory":
    case "EditStory":
    case "RemoveStory":
    case "ChangeStory":
    case "DeleteStory":
    case "adminStory":
    case "PreviewAdminStory":
    case "PostAdminStory":
    case "autoDelete":
    case "autoEdit":
    case "autoSaveEdit":
    case "submissions":
        include(NUKE_MODULES_DIR.$modname.'/admin/index.php');
    break;

}

?>