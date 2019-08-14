<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : members.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Members Module
************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

global $evouserinfo_addons, $evouserinfo_members;

function evouserinfo_members () 
{
    global $userinfo, $db, $prefix, $user_prefix, $evouserinfo_members, $lang_evo_userblock;
    
    $evouserinfo_members = '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['MEMBERS']['MEMBERS'].'</div>';
    list($uid) = $db->sql_ufetchrow("select `user_id` from `".$user_prefix."_users` where `username`='".$userinfo['username']."'");
    $result = $db->sql_query("select `group_name` from ".$prefix."_bbgroups left join ".$prefix."_bbuser_group on ".$prefix."_bbuser_group.group_id=".$prefix."_bbgroups.group_id where ".$prefix."_bbuser_group.user_id='$uid' and ".$prefix."_bbgroups.group_description != 'Personal User'");

    if ($db->sql_numrows($result) == 0):
        $evouserinfo_members .= '<div style="padding-left: 10px;">';
        $evouserinfo_members .= '  <i class="fa fa-angle-double-right fa-right-arrows" aria-hidden="true"></i>&nbsp;'._GRNONE.'</span>';
        $evouserinfo_members .= '</div>';  
    else:
    
        while(list($group_name) = $db->sql_fetchrow($result)):
        
            $evouserinfo_members .= '<div style="padding-left: 10px;">';
            $evouserinfo_members .= '  <i class="fa fa-angle-double-right fa-right-arrows" aria-hidden="true"></i>&nbsp;'.GroupColor($group_name).'</span>';
            $evouserinfo_members .= '</div>';
        
        endwhile;

    endif;
}

if (is_user()):
    evouserinfo_members();
else:
    $evouserinfo_members = '';
endif;

?>