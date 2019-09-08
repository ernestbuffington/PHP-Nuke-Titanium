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
$pagetitle = ": "._SP_ADMINMAIN." - "._SP_EDITSITE;
$comefrom = $_SERVER['HTTP_REFERER'];
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnsp_sites` WHERE `site_id`='$site_id'");
$site_row = $db->sql_fetchrow($result);
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title(_SP_ADMINMAIN." - "._SP_EDITSITE);
spmenu();
echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form action='".$admin_file.".php?op=SPEditSave' method='post' enctype='multipart/form-data'>";
echo "<input type='hidden' name='site_id' value='".$site_row['site_id']."'>";
echo "<input type='hidden' name='old_image' value='".$site_row['site_image']."'>";
echo "<input type='hidden' name='user_id' value='".$site_row['user_id']."'>";
echo "<tr><td><strong>"._SP_SITEID.":</strong></td><td><strong>".$site_row['site_id']."</strong></tr></td>";
echo "<tr><td><strong>"._SP_NAME.":</strong></td><td><input type='text' name='site_name' size='30' value='".$site_row['site_name']."'></tr></td>";
echo "<tr><td><strong>"._SP_URL.":</strong></td><td><input type='text' name='site_url' size='60' value='".$site_row['site_url']."'></tr></td>";
echo "<tr><td valign='top'><strong>"._SP_IMAGE.":</strong></td><td><input type='file' name='new_image' size='30'><br />".$site_row['site_image']."</tr></td>";
echo "<tr><td><strong>"._SP_ADDED.":</strong></td><td><input type='text' name='site_date' size='30' value='".$site_row['site_date']."'></tr></td>";
echo "<tr><td valign='top'><strong>"._SP_DESCRIPTION.":</strong></td><td><textarea $textrowcol name='site_description'>".$site_row['site_description']."</textarea></tr></td>";
echo "<tr><td><strong>"._SP_USERNAME.":</strong></td><td><input type='text' name='user_name' size='30' value='".$site_row['user_name']."'></tr></td>";
echo "<tr><td><strong>"._SP_USEREMAIL.":</strong></td><td><input type='text' name='user_email' size='30' value='".$site_row['user_email']."'></tr></td>";
echo "<tr><td><strong>"._SP_USERIP."</strong></td><td>".$site_row['user_ip']."</tr></td>";
echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._EDIT."'></td></tr>";
echo "</form></table>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>