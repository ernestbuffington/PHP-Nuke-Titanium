<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

$site_id = intval($site_id);
$pagetitle = ": ".$module_name." - "._SP_DELETESITE;
$comefrom = $_SERVER['HTTP_REFERER'];
$result = $db->sql_query("SELECT `site_name`, `site_url` FROM `".$prefix."_nsnsp_sites` WHERE `site_id`='$site_id'");
list($site_name, $site_url) = $db->sql_fetchrow($result);
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title($module_name." - "._SP_DELETESITE);
spmenu();
echo "<br />\n";
OpenTable();
echo "<center>"._SP_YOUDELETE." <a href='$site_url' target='_blank'><strong>$site_name</strong></a><br /><br />";
echo ""._SP_SURE2DELETE."<br /><br /></center>";
echo "<center><table><tr>\n";
echo "<form action='".$admin_file.".php?op=SPDeleteConfirm' method='post'>\n";
echo "<input type='hidden' name='site_id' value='$site_id'>\n";
echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
echo "<td align='center'><input type='submit' value=' "._YES." '><br />\n";
echo ""._GOBACK."</td>\n";
echo "</form>\n";
echo "</tr></table></center>\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>