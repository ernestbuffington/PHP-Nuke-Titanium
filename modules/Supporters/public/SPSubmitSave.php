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

if($sp_config['require_user'] == 0 || is_user()) {
  $site_name = strip_tags($site_name);
  $site_name = htmlspecialchars($site_name, ENT_QUOTES);
  $site_description = strip_tags($site_description);
  $site_description = htmlspecialchars($site_description, ENT_QUOTES);
  global $file_mode, $module_name;
  Validate($site_url, 'url', $module_name, 0, 1);
  Validate($user_email, 'email', $module_name, 0, 1);
  if ((empty($site_name)) OR (empty($site_url)) OR (empty($site_description))) {
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
    echo "<center><strong>"._SP_MISSINGDATA."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
  }
  if($sp_config['image_type']==0) {
    $imgurl = $site_image;
  } else {
    list($newest_oid) = $db->sql_fetchrow($db->sql_query("SELECT max(`site_id`) AS newest_oid FROM `".$prefix."_nsnsp_sites`"));
    if($newest_oid == "-1") { $new_oid = 1; } else { $new_oid = $newest_oid+1; }
    $oid = str_pad($new_oid, 6, "0", STR_PAD_LEFT);
    $imageurl_name = $_FILES['site_image']['name'];
    if (!eregi('image/', get_mime_content_type($imageurl_name))) die(_SP_CONFBANN);
    $imageurl_temp = $_FILES['site_image']['tmp_name'];
    $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
    if(move_uploaded_file($imageurl_temp, "modules/$module_name/images/supporters/$oid$ext")) {
      list($width, $height, $type, $attr) = @getimagesize("modules/$module_name/images/supporters/$oid$ext");
      if (empty($width) || empty($height)) {
          unlink("modules/$module_name/images/supporters/$oid$ext");
          include_once(NUKE_BASE_DIR.'header.php');
    	  title(_SP_CONFBANN);
          OpenTable();
          echo "<center><strong>"._SP_NOUPLOAD."</strong></center><br />\n";
          echo "<center>"._GOBACK."</center>";
          CloseTable();
          include_once(NUKE_BASE_DIR.'footer.php');
          exit;
      }
      chmod ("modules/$module_name/images/supporters/$oid$ext", $file_mode);
      $imgurl = "modules/$module_name/images/supporters/$oid$ext";
    } else {
      include_once(NUKE_BASE_DIR.'header.php');
	  title(_SP_CONFBANN);
      OpenTable();
      echo "<center><strong>"._SP_NOUPLOAD."</strong></center><br />\n";
      echo "<center>"._GOBACK."</center>";
      CloseTable();
      include_once(NUKE_BASE_DIR.'footer.php');
      exit;
    }
  }
  $user_id = intval($user_id);

    $site_name = Fix_Quotes($site_name);
    $site_url = Fix_Quotes($site_url);
    $site_description = Fix_Quotes($site_description);
    $user_name = Fix_Quotes($user_name);
    $user_email = Fix_Quotes($user_email);
    $imgurl = Fix_Quotes($imgurl);
  $result = $db->sql_query("INSERT INTO `".$prefix."_nsnsp_sites` VALUES (NULL, '$site_name', '$site_url', '$imgurl', '0', '0', now(), '$site_description', '$user_id', '$user_name', '$user_email', '$user_ip')");
  if(!$result) {
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
    echo "<center><strong>"._SP_DBERROR1."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
  } else {
    $msg = "$sitename "._SP_ADDED."\n\n";
    $msg .= _SP_NAME.": ".Remove_Slashes($site_name)."\n";
    $msg .= _SP_URL.": ".Remove_Slashes($site_url)."\n";
    $msg .= _SP_IMAGE.": ".Remove_Slashes($imgurl)."\n";
    $msg .= _SP_DESCRIPTION.": ".Remove_Slashes($site_description)."\n";
    $msg .= _SP_USERID.": $user_id\n";
    $msg .= _SP_USERNAME.": ".Remove_Slashes($user_name)."\n";
    $msg .= _SP_USEREMAIL.": ".Remove_Slashes($user_email)."\n";
    $msg .= _SP_USERIP.": $user_ip\n";
    $to = $adminmail;
    $subject = "$sitename - "._SP_ADDED;
    $mailheaders = "From: $adminmail\r\n";
    $mailheaders .= "Reply-To: $adminmail\r\n";
    $mailheaders .= "Return-Path: $adminmail\r\n";
    evo_mail($to, $subject, $msg, $mailheaders);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numsuppen', 'submissions');
    $cache->delete('numsupact', 'submissions');
    $cache->delete('numsupdea', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
  }
  redirect("$comefrom");
} else {
  redirect("modules.php?name=$module_name");
}

?>