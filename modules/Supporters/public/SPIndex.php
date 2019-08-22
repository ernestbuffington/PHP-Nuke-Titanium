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

$pagetitle = _SP_SUPPORTERS;
include_once(NUKE_BASE_DIR.'header.php');
title(_SP_SUPPORTERS);
OpenTable();
echo "<center>";
if(is_mod_admin($module_name)) { echo "[ <a href='".$admin_file.".php?op=SPMain'>"._SP_GOTOADMIN."</a> ]\n"; }
if($sp_config['require_user'] == 0 || is_user()) { echo "[ <a href='modules.php?name=$module_name&amp;op=SPSubmit'>"._SP_BESUPPORTER."</a> ]\n"; }
echo "</center>";
echo "<br />";
$a = 0;
$result = $db->sql_query("SELECT `site_id`, `site_name`, `site_url`, `site_image`, `site_date`, `site_description`, `site_hits` FROM `".$prefix."_nsnsp_sites` WHERE `site_status`='1' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
    global $cache;
    if ((($image_atts = $cache->load('image_atts', 'nsnsp')) === false) || empty($image_atts)) {
        $image_atts = array();
        while(list($site_id, $site_name, $site_url, $site_image, $site_date, $site_description, $site_hits) = $db->sql_fetchrow($result)) {
            if (substr($site_image, 0, 5) == 'http:') {
                if (titanium_site_up($site_image)) {
                    list($width, $height, $type, $attr) = @getimagesize($site_image);
                } else {
                    $width = $sp_config['max_width'];
                    $height = $sp_config['max_height'];
                    $type = '';
                    $attr = '';
                }
            } else {
               list($width, $height, $type, $attr) = @getimagesize($site_image);
            }
            $image_atts[] = array('site_id' => $site_id, 'site_name' => $site_name, 'site_url' => $site_url, 'site_image' => $site_image, 'site_date' => $site_date, 'site_description' => $site_description,
                                  'site_hits' => $site_hits, 'width' => $width, 'height' => $height, 'type' => $type, 'attr' => $attr);
        }
        $db->sql_freeresult($result);
        $cache->save('image_atts', 'nsnsp', $image_atts);
    }
  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  for ($i=0, $max=count($image_atts); $i<$max; $i++) {
    if($a == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    OpenTable();
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
    $site_id = $image_atts[$i]['site_id'];
    $site_name = $image_atts[$i]['site_name'];
    $site_url = $image_atts[$i]['site_url'];
    $site_image = $image_atts[$i]['site_image'];
    $site_date = $image_atts[$i]['site_date'];
    $site_description = $image_atts[$i]['site_description'];
    $site_hits = $image_atts[$i]['site_hits'];
    $width = $image_atts[$i]['width'];
    $height = $image_atts[$i]['height'];
    $type = $image_atts[$i]['type'];
    $attr = $image_atts[$i]['attr'];
    if($width > $sp_config['max_width']) { $width = $sp_config['max_width']; }
    if($height > $sp_config['max_height']) { $height = $sp_config['max_height']; }
    echo "<a href='modules.php?name=$module_name&amp;op=SPGo&amp;site_id=$site_id' target='_blank'><img src='$site_image' border='0' alt='$site_name' title='$site_name' height='$height' width='$width'></a><br /><br />";
    if(is_mod_admin($module_name)) {
      global $admin_file;
      echo " <a href='".$admin_file.".php?op=SPDeactivate&amp;site_id=$site_id'><img src='modules/$module_name/images/deactivate.png' border='0' alt='"._SP_DEACTIVATE."' title='"._SP_DEACTIVATE."'></a>";
      echo " <a href='".$admin_file.".php?op=SPEdit&amp;site_id=$site_id'><img src='modules/$module_name/images/edit.png' border='0' alt='"._EDIT."' title='"._EDIT."'></a>";
      echo " <a href='".$admin_file.".php?op=SPDelete&amp;site_id=$site_id'><img src='modules/$module_name/images/delete.png' border='0' alt='"._DELETE."' title='"._DELETE."'></a>";
    }
    echo "</td>\n<td width='75%' valign='top'><strong>"._SP_ADDED.":</strong> $site_date</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP_DESCRIPTION."</strong>: $site_description</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP_VISITS."</strong>: $site_hits</td></tr>";
    echo "</table>";
    CloseTable();
    echo "</td>";
    $a++;
    if($a == 2) { echo "</tr>"; $a = 0; }
  }
  $db->sql_freeresult($result);
  if($a ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>