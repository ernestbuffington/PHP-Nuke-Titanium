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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/
global $file_mode, $cache;

$site_name = strip_tags($site_name);
$site_name = htmlspecialchars($site_name, ENT_QUOTES);
$site_name = stripslashes($site_name);
$site_description = strip_tags($site_description);
$site_description = htmlspecialchars($site_description, ENT_QUOTES);
$site_description = stripslashes($site_description);
if(($site_name=="")OR($site_url=="")OR($site_description=="")) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
  echo "<br /><br />";
  echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
  CloseTable();
  echo "<br />";
  OpenTable();
  echo "<center><strong>"._SP_MISSINGDATA."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
  exit;
}
if($supporter_config['image_type']==0) {
  $imgurl = $site_image;
} else {
  list($newest_oid) = $db->sql_fetchrow($db->sql_query("SELECT max(`site_id`) AS newest_oid FROM `".$prefix."_nsnsp_sites`"));
  if($newest_oid == "-1") { $new_oid = 1; } else { $new_oid = $newest_oid+1; }
  $oid = str_pad($new_oid, 6, "0", STR_PAD_LEFT);
  $imageurl_name = $_FILES['site_image']['name'];
  $imageurl_temp = $_FILES['site_image']['tmp_name'];
  $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
  if(move_uploaded_file($imageurl_temp, "modules/$module_name/images/supporters/$oid$ext")) {
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
    title(_SP_CONFBANN);
    OpenTable();
    echo "<center><strong>"._SP_NOUPLOAD."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
  }
}
list($user_id) = $db->sql_fetchrow($db->sql_query("SELECT `user_id` FROM `".$user_prefix."_users` WHERE `username`='$user_name'"));
$user_id = intval($user_id);
if(!get_magic_quotes_runtime()) {
  $site_name = addslashes($site_name);
  $site_url = addslashes($site_url);
  $site_description = addslashes($site_description);
  $user_name = addslashes($user_name);
  $user_email = addslashes($user_email);
  $imgurl = addslashes($imgurl);
}
$result = $db->sql_query("INSERT INTO `".$prefix."_nsnsp_sites` values (NULL, '$site_name', '$site_url', '$imgurl', '1', '0', now(), '$site_description', '$user_id', '$user_name', '$user_email', '$user_ip')");
if(!$result) {
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
  echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=SPMain\">" . _SP_ADMIN_HEADER . "</a></div>\n";
  echo "<br /><br />";
  echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SP_RETURNMAIN . "</a> ]</div>\n";
  CloseTable();
  echo "<br />";
  OpenTable();
  echo "<center><strong>"._SP_DBERROR1."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
  exit;
}
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
redirect($admin_file.".php?op=SPMain");

?>