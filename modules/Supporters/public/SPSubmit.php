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

if($sp_config['require_user'] == 0 || is_user()) {
  $pagetitle = _SP_ADDSUPPORTER;
  $comefrom = $_SERVER['HTTP_REFERER'];
  $sip = $nsnst_const['remote_ip'];
  if(!is_array($user)) {
    $member = base64_decode($user);
    $member = explode(":", $member);
    $memname = $member[1];
  } else {
    $memname = $user[1];
  }
  list($suid, $sname, $semail, $surl) = $db->sql_fetchrow($db->sql_query("SELECT `user_id`, `username`, `user_email`, `user_website` FROM `".$user_prefix."_users` WHERE `username`='$memname'"));
  include_once(NUKE_BASE_DIR.'header.php');
  title(_SP_ADDSUPPORTER);
  OpenTable();
  echo "<center><strong>"._SP_ADDSUPPORTER."</strong><br />"._SP_ALLREQ."<br />\n";
  if(is_mod_admin($module_name)) {
    echo "<center>[ <a href='".$admin_file.".php?op=SPMain'>"._SP_GOTOADMIN."</a> ]\n";
  }
  echo "<table border='0'>\n";
  if($sp_config['image_type']==0) { $enctype = ""; } else { $enctype = " enctype='multipart/form-data'"; }
  echo "<form action='modules.php?name=$module_name' method='post'$enctype>\n";
  echo "<input type='hidden' name='op' value='SPSubmitSave'>\n";
  echo "<input type='hidden' name='user_id' value='$suid'>\n";
  echo "<tr><td><strong>"._SP_NAME.":</strong></td><td><input type='text' name='site_name' size='50'></td></tr>\n";
  echo "<tr><td><strong>"._SP_URL.":</strong></td><td><input type='text' name='site_url' size='50' value='$surl'></td></tr>\n";
  if($sp_config['image_type']==0) { $type = "type='input'"; } else { $type = "type='file'"; }
  echo "<tr><td valign='top'><strong>"._SP_IMAGE.":</strong></td><td><input $type name='site_image' size='50'>";
  echo "<br />"._SP_MUSTBE;
  if($sp_config['image_type']==0) { echo "<br />"._SP_IMAGETYPE0; } else { echo "<br />"._SP_IMAGETYPE1; }
  echo "</td></tr>\n";
  echo "<tr><td valign='top'><strong>"._SP_DESCRIPTION.":</strong></td><td><textarea $textrowcol name='site_description'></textarea></td></tr>\n";
  echo "<tr><td><strong>"._SP_YOURNAME.":</strong></td><td><input type='test' name='user_name' value='$sname' size='40'></td></tr>\n";
  echo "<tr><td><strong>"._SP_YOUREMAIL.":</strong></td><td><input type='text' name='user_email' value='$semail' size='40'></td></tr>\n";
  echo "<tr><td><strong>"._SP_YOURIP.":</strong></td><td>$sip</td></tr>\n";
  echo "<input type='hidden' name='user_ip' value='$sip'>\n";
  echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SP_SUBMITSITE."'></td></tr>\n";
  echo "</form></table></center>\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  redirect("modules.php?name=$module_name");
}

?>