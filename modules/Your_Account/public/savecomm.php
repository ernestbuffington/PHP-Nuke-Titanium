<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    global $cookie, $userinfo;
    $check = $cookie[1];
    $check2 = $cookie[2];
    $result = $titanium_db->sql_query("SELECT user_id, user_password FROM ".$titanium_user_prefix."_users WHERE username='$check'");
    $row = $titanium_db->sql_fetchrow($result);
    $vuid = $row['user_id'];
    $ccpass = $row['user_password'];
    if (($titanium_user_id == $vuid) AND ($check2 == $ccpass)) {
        if(isset($noscore)) $noscore=1; else $noscore=0;
        $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET umode='$umode', uorder='$uorder', thold='$thold', noscore='$noscore', commentmax='$commentmax' WHERE user_id='$titanium_user_id'");
        yacookie($userinfo[user_id],$userinfo[username],$userinfo[user_password],$userinfo[storynum],$userinfo[umode],$userinfo[uorder],$userinfo[thold],$userinfo[noscore],$userinfo[ublockon],$userinfo[theme],$userinfo[commentmax]);
        redirect_titanium("modules.php?name=$titanium_module_name");
    }

?>