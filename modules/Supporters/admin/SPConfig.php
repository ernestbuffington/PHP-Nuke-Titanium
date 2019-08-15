<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._SP_CONFIGMAIN." ".$sp_config['version_number'];
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
echo "<br />";
title(_SP_CONFIGMAIN." ".$sp_config['version_number']);
spmenu();
echo "<br />\n";
OpenTable();
echo "<form action='".$admin_file.".php?op=SPConfigSave' method='post'>\n";
echo "<table style='margin: auto;' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td><strong>"._SP_REQUIREUSER.":</strong></td>\n<td>";
$chk1 = $chk2 = $chk3 = $chk4 ="";
if($sp_config['require_user']==0) { $chk1 = " checked"; } else { $chk2 = " checked"; }
echo "<input type='radio' name='require_user' value='0'$chk1>"._NO." &nbsp;";
echo "<input type='radio' name='require_user' value='1'$chk2>"._YES."</td></tr>\n";
echo "<tr><td><strong>"._SP_IMAGETYPE.":</strong></td>\n<td>";
if($sp_config['image_type']==0) {  $chk3 = " checked"; } else { $chk4 = " checked"; }
echo "<input type='radio' name='image_type' value='0'$chk3>"._SP_LINKED." &nbsp;";
echo "<input type='radio' name='image_type' value='1'$chk4>"._SP_UPLOAD."</td></tr>\n";
echo "<tr><td><strong>"._SP_MAXWIDTH.":</strong></td>\n";
echo "<td><input type='text' name='max_width' value='".$sp_config['max_width']."' size='5' maxlength='4'></td></tr>\n";
echo "<tr><td><strong>"._SP_MAXHEIGHT.":</strong></td>\n";
echo "<td><input type='text' name='max_height' value='".$sp_config['max_height']."' size='5' maxlength='4'></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SP_SAVECHANGES."'></td></tr>\n";
echo "</table></form>";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>