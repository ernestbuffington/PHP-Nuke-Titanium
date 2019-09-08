<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
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
      NukeSentinel                             v2.5.00      07/11/2006
      Evolution Functions                      v1.5.0       12/20/2005
-=[Mod]=-
      Forum Logout                             v1.0.0       07/27/2005
      YA Merge                                 v1.0.0       07/28/2005
      User IP Lock                             v1.0.0       11/30/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
require_once("modules/Your_Account/includes/constants.php");

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

// menelaos: removed because it is already called in /modules/Your_Account/includes/mainfileend.php
$ya_config = ya_get_configs();

get_lang($module_name);
$userpage = 1;
global $cookie;
$username = Fix_Quotes($_REQUEST['username']);
$redirect = $_REQUEST['redirect'];
$module = $_REQUEST['module'];
$user_password = $_REQUEST['user_password'];
$mode = $_REQUEST['mode'];
$t = $_REQUEST['t'];
$p = $_REQUEST['p'];
include(NUKE_MODULES_DIR.$module_name.'/navbar.php');
include(NUKE_MODULES_DIR.$module_name.'/includes/cookiecheck.php');

function ya_expire() {
    global $ya_config, $db, $user_prefix;
    if ($ya_config['expiring']!=0) {
        $past = time()-$ya_config['expiring'];
        $res = $db->sql_query("SELECT user_id FROM ".$user_prefix."_users_temp WHERE time < '$past'");
        while (list($uid) = $db->sql_fetchrow($res)) {
          $uid = intval($uid);
          $db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE user_id = $uid");
          $db->sql_query("DELETE FROM ".$user_prefix."_cnbya_value_temp WHERE uid = '$uid'");
        }
        
        $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_cnbya_value_temp");
        $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users_temp");
    }
}

switch($op) 
{
    case "username_check":
        include(NUKE_MODULES_DIR.$module_name.'/public/check.php');
        break;

    case "activate":
        include(NUKE_MODULES_DIR.$module_name.'/public/activate.php');
    break;

    case "avatarlist":
        if (is_user()) {
            include(NUKE_MODULES_DIR.$module_name.'/public/avatarlist.php');
        } else {
            notuser();
        }
    break;

    case "avatarsave":
        if (is_user()) {
            include(NUKE_MODULES_DIR.$module_name.'/public/avatarsave.php');
        } else {
            notuser();
        }
    break;

    case "avatarlinksave":
        if (is_user()) {
            include(NUKE_MODULES_DIR.$module_name.'/public/avatarlinksave.php');
        } else {
            notuser();
        }
    break;
    
    case "delete":
        if ($ya_config['allowuserdelete'] == 1) {
            include(NUKE_MODULES_DIR.$module_name.'/public/delete.php');
        } else {
            disabled();
        }
    break;

    case "deleteconfirm":
        if ($ya_config['allowuserdelete'] == 1) {
            include(NUKE_MODULES_DIR.$module_name.'/public/deleteconfirm.php');
        } else {
            disabled();
        }
    break;

    case "editcomm":
        include(NUKE_MODULES_DIR.$module_name.'/public/editcomm.php');
    break;

    case "edithome":
        include(NUKE_MODULES_DIR.$module_name.'/public/edithome.php');
    break;

    case "edittheme":
    break;

    case "changemail":
        include(NUKE_MODULES_DIR.$module_name.'/public/changemail.php');
        changemail();
    break;
    case "chgtheme":
        if ($ya_config['allowusertheme']==0) {
            include(NUKE_MODULES_DIR.$module_name.'/public/chngtheme.php');
        } else {
            disabled();
        }
    break;

    case "edituser":
        //include(NUKE_MODULES_DIR.$module_name.'/public/edituser.php');
/*****[BEGIN]******************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
        redirect("modules.php?name=Profile&mode=editprofile");
        exit;
/*****[END]********************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
    break;

    case "login":
/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
        global $nsnst_const, $user_prefix;
/*****[END]********************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/

    /**
     * Security Mod: IPHUB VPN & Proxy blocker
     * @since 2.0.9e
     */
    if (get_evo_option('iphub_status', 'int') == 1):  
        // include_once(NUKE_BASE_DIR.'header.php');  
		
        //block_vpn_proxy_user(); # Had to comment this out and I'm not sure why the 2.0.9e code was released with this bug!
		                          # Ernest Allen Buffington 09/07/2019
								  
        // include_once(NUKE_BASE_DIR.'footer.php');
    endif;

/*****[BEGIN]******************************************
 [ Mod:     User IP Lock                       v1.0.0 ]
 ******************************************************/
        if(!compare_ips($username)) {
            DisplayError('Your IP is not valid for this user');
            exit;
        }
/*****[END]********************************************
 [ Mod:     User IP Lock                       v1.0.0 ]
 ******************************************************/
        $result  = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE username='$username'");
        $setinfo = $db->sql_fetchrow($result);
        // menelaos: check of the member agreed with the TOS and update the database field
        if (($ya_config['tos'] == intval(1)) AND ($_POST['tos_yes'] == intval(1))) {
        $db->sql_query("UPDATE ".$user_prefix."_users SET agreedtos='1' WHERE username='$username'");
        }
        $forward = str_replace("redirect=", "", "$redirect");
        if (preg_match("#privmsg#", $forward)) { $pm_login = "active"; }
    if ($db->sql_numrows($result) == 0) {
        include_once(NUKE_BASE_DIR.'header.php');
        Show_CNBYA_menu();
        OpenTable();
        echo "<center><span class='title'>"._SORRYNOUSERINFO."</span></center>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } 
    elseif ($db->sql_numrows($result) == 1 AND $setinfo['user_id'] != 1 AND !empty($setinfo['user_password']) AND $setinfo['user_active'] >0 AND $setinfo['user_level'] >0) 
    {
        $dbpass     = $setinfo['user_password'];
        $non_crypt_pass = $user_password;
        $old_crypt_pass = crypt($user_password,substr($dbpass,0,2));
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $new_pass = EvoCrypt($user_password);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $new_pass = md5($user_password);
        $evo_crypt = EvoCrypt($user_password);
        //Reset to md5x1
        if (($dbpass == $evo_crypt) || (($dbpass == $non_crypt_pass) || ($dbpass == $old_crypt_pass))) {
            $db->sql_query("UPDATE ".$user_prefix."_users SET user_password='$new_pass' WHERE username='$username'");
            $result = $db->sql_query("SELECT user_password FROM ".$user_prefix."_users WHERE username='$username'");
            list($dbpass) = $db->sql_fetchrow($result);
        }
        if ($dbpass != $new_pass) {
            //Does it need another md5?
        	if (md5($dbpass) == $new_pass) {
                $db->sql_query("UPDATE ".$user_prefix."_users SET user_password='$new_pass' WHERE username='$username'");
                $result = $db->sql_query("SELECT user_password FROM ".$user_prefix."_users WHERE username='$username'");
                list($dbpass) = $db->sql_fetchrow($result);
                if ($dbpass != $new_pass) {
                    redirect("modules.php?name=$module_name&stop=1");
                    return;
                }
        	} else {
        	    redirect("modules.php?name=$module_name&stop=1");
                return;
        	}
        }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/
        $gfxchk = array(2,4,5,7);
        if (!security_code_check($_POST['g-recaptcha-response'], $gfxchk)) {
/*****[END]********************************************
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/
            redirect("modules.php?name=$module_name&stop=1");
            exit;
        } else {
            // menelaos: show a member the current TOS if he has not agreed yet
            if (($ya_config['tos'] == intval(1)) AND ($ya_config['tosall'] == intval(1)) AND ($setinfo['agreedtos'] != intval(1))) {
                if($_POST['tos_yes'] != intval(1)) {
                include(NUKE_MODULES_DIR.$module_name.'/public/ya_tos.php');
                exit;
                }
            }
            // menelaos: show a member the current TOS if he has not agreed yet

            yacookie($setinfo['user_id'], $setinfo['username'], $new_pass, $setinfo['storynum'], $setinfo['umode'], $setinfo['uorder'], $setinfo['thold'], $setinfo['noscore'], $setinfo['ublockon'], $setinfo['theme'], $setinfo['commentmax']);
/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
            $uname = $nsnst_const['remote_ip'];
/*****[END]********************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
            $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$uname' AND guest='1'");
            $db->sql_query("UPDATE ".$user_prefix."_users SET last_ip='$uname' WHERE username='$username'");
        }

        // menelaos: the cookiecheck is run here
        if ($ya_config['cookiecheck']==1) {
        $cookiecheck    = yacookiecheckresults();
        }
        if (!empty($pm_login)) {
            redirect("modules.php?name=Private_Messages&file=index&folder=inbox");
        } else if (!empty($t))  {
            redirect("modules.php?name=Forums&file=$forward&mode=$mode&t=$t");
        } else if (!empty($p))  {
            redirect("modules.php?name=Forums&file=$forward&mode=$mode&p=$p");
        } else if (empty($redirect)) {
        	if ($board_config['loginpage'] == 1) {
        		redirect("modules.php?name=Your_Account&op=userinfo&bypass=1&username=$username");
        	}
        	else
        	{
        		redirect("modules.php?name=Forums");
        	}
        } else if (!empty($module)) {
            redirect("modules.php?name=$module");
        } else if (empty($mode)) {
            if(!empty($f)) {
                redirect("modules.php?name=Forums&file=$forward&f=$f");
            } else {
                redirect("modules.php?name=Forums&file=$forward");
            }
        } else {
                redirect("modules.php?name=Forums&file=$forward&mode=$mode&f=$f");
        }
        } elseif ($db->sql_numrows($result) == 1 AND ($setinfo['user_level'] < 1 OR $setinfo['user_active'] < 1)) {
            include_once(NUKE_BASE_DIR.'header.php');
            Show_CNBYA_menu();
            OpenTable();
            if ($setinfo['user_level'] == 0) {
                echo "<br /><center><span class=\"title\"><strong>"._ACCSUSPENDED."</strong></span></center><br />\n";
            } elseif ($setinfo['user_level'] == -1) {
                echo "<br /><center><span class=\"title\"><strong>"._ACCDELETED."</strong></span></center><br />\n";
            } else {
                echo "<br /><center><span class=\"title\"><strong>"._SORRYNOUSERINFO."</strong></span></center><br />\n";
            }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        } else {
        redirect("modules.php?name=$module_name&stop=1");
        }
        break;

    case "logout":
        global $cookie, $db, $prefix;
        $r_uid = $cookie[0];
        $r_username = $cookie[1];
        setcookie("user");
        if (trim($ya_config['cookiepath']) != '') setcookie("user","expired",time()-604800,"$ya_config[cookiepath]"); //correct the problem of path change
        $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_username'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_session");
        $sql = "SELECT session_id FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'";
        $row = $db->sql_fetchrow($db->sql_query($sql));
        $db->sql_query("DELETE FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_bbsessions");
/*****[BEGIN]******************************************
 [ Mod:     Forum Logout                       v1.0.0 ]
 ******************************************************/
        global $board_config;
        $cookiename = $board_config['cookie_name'];
        $cookiepath = $board_config['cookie_path'];
        $cookiedomain = $board_config['cookie_domain'];
        $cookiesecure = $board_config['cookie_secure'];
        $current_time = time();
        setcookie($cookiename . '_data', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
        setcookie($cookiename . '_sid', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
/*****[END]********************************************
 [ Mod:     Forum Logout                       v1.0.0 ]
 ******************************************************/
        $user = "";
        //include_once(NUKE_BASE_DIR.'header.php');
        if (!empty($redirect)) {
            //echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=modules.php?name=$redirect\">";
            redirect("modules.php?name=$redirect");
            exit;
        } else {
            //echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=index.php\">";
            redirect("index.php");
            exit;
        }
        //title(_YOUARELOGGEDOUT);
        //include_once(NUKE_BASE_DIR.'footer.php');
    break;

    case "mailpasswd":
        include(NUKE_MODULES_DIR.$module_name.'/public/mailpass.php');
    break;

    case "new_user":
     if (is_user()) {
            mmain($user);
        } else {
if ($ya_config['allowuserreg']==0) {
     if ($ya_config['coppa'] == intval(1)) {
       if($_POST['coppa_yes']!= intval(1)) {
         include(NUKE_MODULES_DIR.$module_name.'/public/ya_coppa.php');
         exit;
     }
          }
     if ($ya_config['tos'] == intval(1)) {
       if($_POST['tos_yes'] != intval(1)) {
         include(NUKE_MODULES_DIR.$module_name.'/public/ya_tos.php');
         exit;
     }
          }
        if ($ya_config['coppa'] !== intval(1) OR $ya_config['coppa'] == intval(1) AND $_POST['coppa_yes'] = intval(1)){
        if ($ya_config['tos'] !== intval(1) OR $ya_config['tos'] == intval(1) AND $_POST['tos_yes']=intval(1)){
           if ($ya_config['requireadmin'] == 1) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_user1.php');
                } elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_user2.php');
                } elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_user3.php');
                }
             }
         }
       // redirect("modules.php?name=Profile");
           }else {
    disabled();
  }
}
    break;

    case "new_confirm":
        if (is_user()) {
            mmain($user);
        } else {
            if ($ya_config['allowuserreg']==0) {
                if ($ya_config['requireadmin'] == 1) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm1.php');
                } elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm2.php');
                } elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm3.php');
                }
            } else {
                disabled();
            }
        }
    break;

    case "new_finish":
        ya_expire();
        if (is_user()) {
            mmain($user);
        } else {
            if ($ya_config['allowuserreg']==0) {
                if ($ya_config['requireadmin'] == 1) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish1.php');
                } elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish2.php');
                } elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1) {
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish3.php');
                }
            } else {
                disabled();
            }
        }
    break;

    case "pass_lost":
        include(NUKE_MODULES_DIR.$module_name.'/public/passlost.php');
    break;

   case "saveactivate":
        include(NUKE_MODULES_DIR.$module_name.'/public/saveactivate.php');
    break;

    case "savecomm":
        if (is_user()) {
            include(NUKE_MODULES_DIR.$module_name.'/public/savecomm.php');
        } else {
            notuser();
        }
    break;

    case "savehome":
        if (is_user()) {
            include(NUKE_MODULES_DIR.$module_name.'/public/savehome.php');
        } else {
            notuser();
        }
    break;

    case "savetheme":
        if (is_user()) {
            if ($ya_config['allowusertheme']==0) {
                include(NUKE_MODULES_DIR.$module_name.'/public/savetheme.php');
            } else {
                disabled();
            }
        } else {
            notuser();
        }
    break;

    case "saveuser":
        if (is_user()) {
            include(NUKE_MODULES_DIR.$module_name.'/public/saveuser.php');
        } else {
            notuser();
        }
    break;

    case "userinfo":
/*****[BEGIN]******************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
        list($uid) = $db->sql_ufetchrow('SELECT user_id FROM '.$user_prefix.'_users WHERE username="'.$username.'"', SQL_NUM);
        redirect("modules.php?name=Profile&mode=viewprofile&u=".$uid);
        exit;
/*****[END]********************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
    break;

    case "ShowCookiesRedirect":
        ShowCookiesRedirect();
    break;

    case "ShowCookies":
        ShowCookies();
    break;

    case "DeleteCookies":
        DeleteCookies();
    break;

    default:
        mmain($user);
    break;

}

?>