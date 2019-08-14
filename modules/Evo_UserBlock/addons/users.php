<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : users.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Users Module
************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

global $evouserinfo_addons, $evouserinfo_users;

function evouserinfo_newest_user () 
{
    global $db, $user_prefix;

    $sql = "SELECT user_id, username FROM ".$user_prefix."_users WHERE user_active = 1 AND user_level > 0 ORDER BY user_id DESC LIMIT 1";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    // return (isset($row[0])) ? $row[0] : '?';
    return (isset($row)) ? $row : '?';
}

function evouserinfo_new_today () {
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_regdate='".date("M d, Y")."'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_new_yesterday () {
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_regdate='".date("M d, Y", time()-86400)."'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_waiting () {
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users_temp";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_total () {
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_id > 1";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_users () 
{
    global $evouserinfo_users, $lang_evo_userblock;

    $today = evouserinfo_new_today();
    $yesterday = evouserinfo_new_yesterday();
    $new_user_id = evouserinfo_newest_user()[0];
    $new_user = UsernameColor(evouserinfo_newest_user()[1]);
    $waiting = evouserinfo_waiting();
    $total = evouserinfo_total();

    $evouserinfo_users = '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['USERS']['MEMBERSHIPS'].'</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '  <i class="fa fa-angle-double-right fa-right-arrows" aria-hidden="true"></i>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['NEW_TODAY'].'<span style="float:right">'.number_format($today).'</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '  <i class="fa fa-angle-double-right fa-right-arrows" aria-hidden="true"></i>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['NEW_YESTERDAY'].'<span style="float:right">'.number_format($yesterday).'</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '  <i class="fa fa-angle-double-right fa-right-arrows" aria-hidden="true"></i>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['WAITING'].'<span style="float:right">'.number_format($waiting).'</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '  <i class="fa fa-angle-double-right fa-right-arrows" aria-hidden="true"></i>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['TOTAL'].'<span style="float:right">'.number_format($total).'</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '  <i class="fa fa-angle-double-right fa-right-arrows" aria-hidden="true"></i>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['LATEST'].'<span style="float:right"><a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$new_user_id.'">'.$new_user.'</a></span>';
    $evouserinfo_users .= '</div>';
}

if (is_user()):
    evouserinfo_users();
endif;

?>