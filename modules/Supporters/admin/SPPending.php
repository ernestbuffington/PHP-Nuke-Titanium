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

$pagetitle = ": "._SP_ADMINMAIN." - "._SP_SUBMITTEDSITES;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title(_SP_ADMINMAIN." - "._SP_SUBMITTEDSITES);
spmenu();
echo "<br />\n";
OpenTable();
$a = 0;
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnsp_sites` WHERE `site_status`='0' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  while($site_row = $db->sql_fetchrow($result)) {
    if($a == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    OpenTable();
    list($width, $height, $type, $attr) = @getimagesize($site_row['site_image']);
    if($width > $sp_config['max_width']) { $width = $sp_config['max_width']; }
    if($height > $sp_config['max_height']) { $height = $sp_config['max_height']; }
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
    echo "<a href='modules.php?name=$module_name&op=SPGo&site_id=".$site_row['site_id']."' target='_blank'><img src='".$site_row['site_image']."' border='0' alt='".$site_row['site_name']."' title='".$site_row['site_name']."' height='$height' width='$width'></a><br /><br />";
    echo " <a href='".$admin_file.".php?op=SPApprove&amp;site_id=".$site_row['site_id']."'><img src='modules/$module_name/images/approve.png' border='0' alt='"._SP_APPROVE."' title='"._SP_APPROVE."'></a>";
    echo " <a href='".$admin_file.".php?op=SPEdit&amp;site_id=".$site_row['site_id']."'><img src='modules/$module_name/images/edit.png' border='0' alt='"._EDIT."' title='"._EDIT."'></a>";
    echo " <a href='".$admin_file.".php?op=SPDelete&amp;site_id=".$site_row['site_id']."'><img src='modules/$module_name/images/delete.png' border='0' alt='"._DELETE."' title='"._DELETE."'></a>";
    echo "</td>\n<td width='75%' valign='top'><strong>"._SP_ADDED.":</strong> ".$site_row['site_date']."</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP_DESCRIPTION."</strong>: ".$site_row['site_description']."</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP_VISITS."</strong>: ".$site_row['site_hits']."</td></tr>";
    echo "</table>";
    CloseTable();
    echo "</td>";
    $a++;
    if($a == 2) { echo "</tr>"; $a = 0; }
  }
  if($a ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
} else {
  echo "<center class='title'>"._SP_NOSUBMITTEDSITES."</center>\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>