<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2004 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
    -=[Base]=-
          Nuke Patched                           v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die ('Access Denied');
}

global $cid, $pid, $admin, $db, $prefix, $admin_file;
$module_name = 'Content';
if (!is_mod_admin($module_name)) { die ('Access Denied'); }
echo "<center><strong>$module_name Module Administration Panel</strong><br /><br />";
if (isset($cid)) {
    $row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_pages_categories WHERE cid='".$cid."'"));
    echo "Category: <strong>".$row['title']."</strong><br /><br />[ <a href='".$admin_file.".php?op=edit_category&amp;cid=".$cid."'>" . _EDIT . "</a> | <a href='".$admin_file.".php?op=del_content_cat&amp;cid=".$cid."&amp;ok=0'>" . _DELETE . "</a> ]";
}
if (isset($pid)) {
    $row = $db->sql_fetchrow($db->sql_query("SELECT title, active FROM ".$prefix."_pages WHERE pid='".$pid."'"));
    echo "Article: <strong>".$row["title"]."</strong><br /><br />[ <a href='".$admin_file.".php?op=content_edit&amp;pid=$pid'>" . _EDIT . "</a> | ";
    if ($row["active"] == 1) {
        echo "<a href='".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1'>" . _DEACTIVATE . "</a> | ";
    } elseif ($row["active"] == 0) {
        echo "<a href='".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=0'>"._ACTIVATE."</a> | ";
    }
    echo "<a href='".$admin_file.".php?op=content_delete&amp;pid=$pid&amp;ok=0'>" . _DELETE . "</a> ]";
}
echo "</center>";

?>