<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : online.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Online Administration
************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$titanium_lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$titanium_lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
CloseTable();
echo "<br />";
title(_EVO_USERINFO. "&nbsp;-&nbsp;" .$titanium_lang_evo_userblock['ONLINE']['ONLINE']);
OpenTable();
if(!empty($_POST)) 
{
  
    $values = array('show_members' => Fix_Quotes($_POST['show_members']),'show_hv' => Fix_Quotes($_POST['show_hv']), 'scroll' => Fix_Quotes($_POST['scroll']), 'tooltip' => Fix_Quotes($_POST['tooltip']), 'country_flag' => Fix_Quotes($_POST['country_flag']), 'user_level_image' => Fix_Quotes($_POST['user_level_image']));
    evouserinfo_write_addon('online', $values);
    echo "<div align=\"center\">\n";
    echo $titanium_lang_evo_userblock['ADMIN']['SAVED'];
    echo "</div>";
    global $admin_file;
    echo "<meta http-equiv=\"refresh\" content=\"3;url=$admin_file.php?op=evo-userinfo\">";

} 
else 
{

    echo "<div align=\"center\">\n";
    echo "<form name=\"good_afternoon\" method=\"post\" action=\"".$admin_file.".php?op=evo-userinfo&amp;file=online\">";
    $radio[] = array('value' => 'yes', 'text' => $titanium_lang_evo_userblock['YES'], 'name' => 'show_members', 'checked' => ($evouserinfo_addons['online_show_members'] == 'yes') ? 'CHECKED' : '');
    $radio[] = array('value' => 'no', 'text' => $titanium_lang_evo_userblock['NO'], 'name' => 'show_members', 'checked' => ($evouserinfo_addons['online_show_members'] == 'yes') ? '' : 'CHECKED');
    echo $titanium_lang_evo_userblock['ONLINE']['SHOW_MEMBERS']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $titanium_lang_evo_userblock['YES'], 'name' => 'show_hv', 'checked' => ($evouserinfo_addons['online_show_hv'] == 'yes') ? 'CHECKED' : '');
    $radio[] = array('value' => 'no', 'text' => $titanium_lang_evo_userblock['NO'], 'name' => 'show_hv', 'checked' => ($evouserinfo_addons['online_show_hv'] == 'yes') ? '' : 'CHECKED');
    echo $titanium_lang_evo_userblock['ONLINE']['SHOW_HV']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $titanium_lang_evo_userblock['YES'], 'name' => 'scroll', 'checked' => ($evouserinfo_addons['online_scroll'] == 'yes') ? 'CHECKED' : '');
    $radio[] = array('value' => 'no', 'text' => $titanium_lang_evo_userblock['NO'], 'name' => 'scroll', 'checked' => ($evouserinfo_addons['online_scroll'] == 'yes') ? '' : 'CHECKED');
    echo $titanium_lang_evo_userblock['ONLINE']['SCROLL']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $titanium_lang_evo_userblock['YES'], 'name' => 'tooltip', 'checked' => ($evouserinfo_addons['online_tooltip'] == 'yes') ? 'CHECKED' : '');
    $radio[] = array('value' => 'no', 'text' => $titanium_lang_evo_userblock['NO'], 'name' => 'tooltip', 'checked' => ($evouserinfo_addons['online_tooltip'] == 'yes') ? '' : 'CHECKED');
    echo $titanium_lang_evo_userblock['ONLINE']['TOOLTIP']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $titanium_lang_evo_userblock['YES'], 'name' => 'country_flag', 'checked' => ($evouserinfo_addons['online_country_flag'] == 'yes') ? 'CHECKED' : '');
    $radio[] = array('value' => 'no', 'text' => $titanium_lang_evo_userblock['NO'], 'name' => 'country_flag', 'checked' => ($evouserinfo_addons['online_country_flag'] == 'yes') ? '' : 'CHECKED');
    echo $titanium_lang_evo_userblock['ONLINE']['COUNTRY']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";


    
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $titanium_lang_evo_userblock['YES'], 'name' => 'user_level_image', 'checked' => ($evouserinfo_addons['online_user_level_image'] == 'yes') ? 'CHECKED' : '');
    $radio[] = array('value' => 'no', 'text' => $titanium_lang_evo_userblock['NO'], 'name' => 'user_level_image', 'checked' => ($evouserinfo_addons['online_user_level_image'] == 'yes') ? '' : 'CHECKED');
    echo $titanium_lang_evo_userblock['ONLINE']['USER_LEVEL_IMAGE']."<br />";
    echo evouserinfo_radio($radio);
    echo "<br />";
    echo "<input type=\"submit\" value=\"".$titanium_lang_evo_userblock['ADMIN']['SAVE']."\">";
    echo "</form>";
    echo "</div>";

}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
?>