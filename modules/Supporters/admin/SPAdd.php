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

$pagetitle = ": "._SP_ADMINMAIN." - "._SP_ADDSUPPORTER;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
echo "<br />";
$sip = $nsnst_const['remote_ip'];
title(_SP_ADMINMAIN." - "._SP_ADDSUPPORTER);
spmenu();
echo "<br />\n";
OpenTable();
echo "<center><br />"._SP_ALLREQ."<br />\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
if($supporter_config['image_type']==0) { $enctype = ""; } else { $enctype = "enctype='multipart/form-data'"; }
echo "<form action='".$admin_file.".php?op=SPAddSave' method='post'$enctype>\n";
echo "<input type='hidden' name='user_id' value='$suid'>\n";
echo "<tr><td><strong>"._SP_NAME.":</strong></td><td><input type='text' name='site_name' size='50'></td></tr>\n";
echo "<tr><td><strong>"._SP_URL.":</strong></td><td><input type='text' name='site_url' size='50' value='$surl'></td></tr>\n";
if($supporter_config['image_type']==0) { $type = "type='input'"; } else { $type = "type='file'"; }
echo "<tr><td valign='top'><strong>"._SP_IMAGE.":</strong></td><td><input $type name='site_image' size='50'><br />";
echo ""._SP_MUSTBE."</td></tr>\n";
echo "<tr><td valign='top'><strong>"._SP_DESCRIPTION.":</strong></td><td><textarea $textrowcol name='site_description'></textarea></td></tr>\n";
echo "<tr><td><strong>"._SP_YOURNAME.":</strong></td><td><input type='test' name='user_name' size='40'></td></tr>\n";
echo "<tr><td><strong>"._SP_YOUREMAIL.":</strong></td><td><input type='text' name='user_email' size='40'></td></tr>\n";
echo "<tr><td><strong>"._SP_YOURIP.":</strong></td><td><input type='text' name='user_ip' value='$sip' size='40'></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SP_SUBMITSITE."'></td></tr>\n";
echo "</form></table></center>\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>