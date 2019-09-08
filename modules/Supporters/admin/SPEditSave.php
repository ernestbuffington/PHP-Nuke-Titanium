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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

global $file_mode;

$site_name = strip_tags($site_name);
$site_name = htmlspecialchars($site_name, ENT_QUOTES);
$site_name = stripslashes($site_name);
$site_description = strip_tags($site_description);
$site_description = htmlspecialchars($site_description, ENT_QUOTES);
$site_description = stripslashes($site_description);
$site_id = intval($site_id);
$oid = str_pad($site_id, 6, "0", STR_PAD_LEFT);
$newimage_name = $_FILES['new_image']['name'];
$newimage_temp = $_FILES['new_image']['tmp_name'];
if($newimage_name != "") {
  $ext = substr($newimage_name, strrpos($newimage_name,'.'), 5);
  if(move_uploaded_file($newimage_temp, "modules/$module_name/images/supporters/$oid$ext")) {
    chmod ("modules/$module_name/images/supporters/$oid$ext", $file_mode);
    $imgurl = "modules/$module_name/images/supporters/$oid$ext";
  } else {
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><strong>"._SP_NOUPLOAD."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
  }
} else {
  $imgurl = $old_image;
}
$user_id = intval($user_id);
if(!get_magic_quotes_runtime()) {
  $site_name = addslashes($site_name);
  $site_url = addslashes($site_url);
  $site_description = addslashes($site_description);
  $user_name = addslashes($user_name);
  $user_email = addslashes($user_email);
  $imgurl = addslashes($imgurl);
}
$result = $db->sql_query("UPDATE `".$prefix."_nsnsp_sites` SET `site_name`='$site_name', `site_url`='$site_url', `site_image`='$imgurl', `site_date`='$site_date', `site_description`='$site_description', `user_name`='$user_name', `user_email`='$user_email' WHERE `site_id`='$site_id'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$cache->delete('numsuppen', 'submissions');
$cache->delete('numsupact', 'submissions');
$cache->delete('numsupdea', 'submissions');
$cache->delete('image_atts', 'nsnsp');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
redirect("$comefrom");

?>