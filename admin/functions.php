<?php

/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      NukeSentinel                             v2.5.00      07/11/2006
      Caching System                           v1.0.0       10/31/2005
      Module Simplifications                   v1.0.0       11/17/2005
      Evolution Functions                      v1.5.0       12/14/2005
-=[Other]=-
      Admin Field Size                         v1.0.0       06/02/2005
      Need To Delete                           v1.0.0       06/03/2005
      Date Fix                                 v1.0.0       06/20/2005
-=[Mod]=-
      Admin Icon/Link Pos                      v1.0.0       06/02/2005
      Admin Tracker                            v1.0.1       06/08/2005
      Advanced Username Color                  v1.0.6       06/13/2005
      Advanced Security Code Control           v1.0.0       12/17/2005
      Password Strength Meter                  v1.0.0       07/12/2005
      Auto Admin Protector                     v2.0.0       08/18/2005
      Evolution Version Checker                v1.1.0       08/21/2005
      Auto Admin Login                         v2.0.1       08/27/2005
      Auto First User Login                    v1.0.0       08/27/2005
      Persistent Admin Login                   v2.0.0       12/10/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
function need_delete($file, $dir=false) 
{
  // will be uncommented for release
  if (!$dir) {
    if(!is_file($file)) {
        return;
    }
    DisplayError("<span style='color: red; font-size: 24pt'>"._NEED_DELETE." ".$file."</span>");
  } else {
    if(!is_dir($file)) {
        return;
    }
    DisplayError("<span style='color: red; font-size: 24pt'>"._NEED_DELETE." the folder \"".$file."\"</span>");
  }
}
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

function login() 
{
    global $admin_file, $db, $prefix, $admin_fc_status, $admin_fc_attempts, $admin_fc_timeout, $admlang;
    get_header();
    the_pagetitle();

    echo '<form method="post" action="'.$admin_file.'.php">';
    echo '<table style="margin: auto" border="0" cellpadding="2" cellspacing="1">';
    echo '  <tr>';
    echo '    <td colspan="2" style="text-align: center;">'.$admlang['admin_login_header'].'</td>';
    echo '  </tr>';

/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    $ip = $_SERVER['REMOTE_ADDR'];
    $fcdate = date("mdYHi");
    $fc = $db->sql_ufetchrow("SELECT * FROM `". $prefix ."_admin_fc` WHERE fc_ip = '$ip'");
    $fc_datetime = $fcdate - $fc['fc_datetime'];
    $fc_lefttime = $admin_fc_timeout - $fc_datetime;

    //Delete old attempts:
    if ($fc['fc_attempts'] >= "1" && $fc_datetime >= $admin_fc_timeout)
    {
        $db->sql_query("DELETE FROM ".$prefix."_admin_fc WHERE fc_ip = '$ip'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_admin_fc");
    }
            
    if ($admin_fc_status == "1" && ($fc['fc_attempts'] >= $admin_fc_attempts) && ($fc_datetime <= $admin_fc_timeout))
    {
        echo '<tr><td colspan="2" style="text-align: center;">'.$admlang['adminfail']['cooldown'].'&nbsp;'.($fc_lefttime == "0" ? $admlang['adminfail']['less_than'] : $fc_lefttime).'&nbsp;'.$admlang['adminfail']['min'].'</td></tr>';
    }
    else
    {        
        if ($admin_fc_status == "1" && $fc['fc_attempts'] <= $admin_fc_attempts  && $fc['fc_attempts'] != "0" && $fc_datetime <= $admin_fc_timeout) 
        {
            $fctotal = $admin_fc_attempts - $fc['fc_attempts'];
            echo '<tr><td colspan="2" style="text-align: center;">'.$admlang['adminfail']['you_have'].'&nbsp;'.$fctotal.'&nbsp;'.$admlang['adminfail']['attempts'].'&nbsp;'.$admin_fc_timeout.'&nbsp;'.$admlang['adminfail']['min'].'</td></tr>';
        }
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
        echo '  <tr>';
        echo '    <td>'.$admlang['admin_id'].'</td>';
        echo '    <td><input type="text" name="aid" style="width: 250px" maxlength="25" /></td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td>'.$admlang['global']['password'].'</td>';
        echo '    <td><input type="password" name="pwd" style="width: 250px" maxlength="40" /></td>';
        echo '  </tr>';
 /*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
        echo '  <tr>';
        echo '    <td colspan="2">';
   	    echo security_code(array(1,5,6,7), 'normal'); 
		echo '    </td>';
        echo '  </tr>';
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
        echo '  <tr>';
        echo '    <td colspan="2">'.$admlang['admin_login_persistent'].' <input type="checkbox" name="persistent" value="1" checked="checked"></td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td style="text-align: center;" colspan="2"><input type="submit" value="'.$admlang['global']['login'].'"></td>';
        echo '  </tr>';
    }

    echo '</table>';
    echo '<input type="hidden" name="op" value="login">';
    echo "</form>";
    get_footer();
}

function deleteNotice($id) 
{
    global $prefix, $db, $admin_file, $cache;
    $id = intval($id);
    $db->sql_query("DELETE FROM `".$prefix."_reviews_add` WHERE `id` = '$id'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaitreviews', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    redirect($admin_file.".php?op=reviews");
}

function adminmenu($url, $title, $image) 
{
    global $counter, $admingraphic, $admin, $module_folder_name;

    if ( file_exists('modules/'.$module_folder_name.'/images/admin/'.$image) ):
        $image = 'modules/'.$module_folder_name.'/images/admin/'.$image;
    elseif ( file_exists('modules/'.$module_folder_name.'/images/'.$image) ):
        $image = 'modules/'.$module_folder_name.'/images/'.$image;
    else:
        $image = 'images/admin/'.$image;
    endif;

    if ( $admingraphic ):
        // $image = '<img src="'.$image.'" border="0" alt="'.$title.'" title="'.$title.'" width="32" height="32" />';
		//My Monitor Icons
		//$image = '<img src="'.$image.'" border="0" alt="'.$title.'" title="'.$title.'" width="100" height="85" />';
        $image = '<img src="'.$image.'" border="0" alt="'.$title.'" title="'.$title.'" width="40" height="40" />';
    else:
        $image = '';
    endif;

    if (!is_god($admin) && ($title == 'Edit Admins' || $title == 'Nuke Sentinel(tm)'))
    {
        echo '    <td style="width: 16.6%;">';
        echo '      <a href="'.$url.'">';
        echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">';           
        echo '        <tr>';
        echo '          <td class="row1">'.(($admingraphic) ? $image.'<br />' : '').'<em style="text-decoration: line-through; letter-spacing:1px;">'.$title.'</span></td>';
        echo '        </tr>';
        echo '      </table>';
        echo '      </a>';
        echo '    </td>';
    }
    else
    {
        echo '    <td style="width: 16.6%;">';
        echo '      <a href="'.$url.'">';
        echo '      <table style="height: 75px; text-align: center; width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">';       	
		echo '        <tr>';
		echo '          <td class="row1">'.(($admingraphic) ? $image.'<br />' : '').$title.'</td>';
		echo '        </tr>';
		echo '      </table>';
		echo '      </a>';
		echo '    </td>';
	}

    if ($counter == 5) 
    {
        if($end == FALSE)
        {
            echo '</tr>'."\n".'<tr>'."\n";
        }
    }
    $counter = ($counter == 5) ? 0 : (int) $counter+1;
}

function track_admin_intrusion()
{
	global $admin_file, $admlang;
	$ret_log = log_size('admin');
    if($ret_log == -1)
        $admin_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['error'].'</span>';
    elseif($ret_log == -2)
        $admin_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['admin_chmod'].'</span>';
    elseif($ret_log)
        $admin_msg = '<span style="color:red; font-weight: bold;">'.sprintf($admlang['logs']['admin_changed'],'<span style="color: red">','</span>').'</span>';
    else
        $admin_msg = '<span style="color:green; font-weight: bold;">'.$admlang['logs']['admin_fine'].'</span>';

    $return .= '  <tr>'."\n";
    $return .= '    <td style="height:15px; font-size: 13px; width:65%;">'.$admin_msg.'</td>'."\n";
    $return .= '    <td style="height:15px; font-size: 13px; width:25%; text-align:center;"><a href="'.$admin_file.'.php?op=viewadminlog&amp;log=admin">'.$admlang['logs']['view'].'</a></td>'."\n";
    $return .= '  </tr>'."\n";
    return $return;
}

function track_sql_errors()
{
	global $admin_file, $admlang;
	$ret_log = log_size('error');
    if($ret_log == -1)
        $error_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['error'].'</span>';
    elseif($ret_log == -2)
        $error_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['eerror_chmod'].'</span>';
    elseif($ret_log)
        $error_msg = '<span style="color:red; font-weight: bold;">'.sprintf($admlang['logs']['error_changed'],'<span style="color: red">','</span>').'</span>';
    else
        $error_msg = '<span style="color:green; font-weight: bold;">'.$admlang['logs']['error_fine'].'</span>';

    $return .= '  <tr>'."\n";
    $return .= '    <td style="height:15px; font-size: 13px; width:65%;">'.$error_msg.'</td>'."\n";
    $return .= '    <td style="height:15px; font-size: 13px; width:25%; text-align:center;"><a href="'.$admin_file.'.php?op=viewadminlog&amp;log=error">'.$admlang['logs']['view'].'</a></td>'."\n";
    $return .= '  </tr>'."\n";
    return $return;
}
 
/*****[BEGIN]******************************************
 [ Mod:    Admin Icon/Link Pos                 v1.0.0 ]
 ******************************************************/
function GraphicAdmin($pos=1)
{
    global $aid, $admingraphic, $cache, $language, $admin, $prefix, $user_prefix, $db, $counter, $admin_file, $admin_pos, $radminsuper, $admlang;	
    if ($pos != $admin_pos)
        return;

    $radminsuper = is_mod_admin();

    list($waiting_users) = $db->sql_ufetchrow("select count(user_id) from `".USERS_TEMP_TABLE."`");

    OpenTable();
    echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1">';
    echo '  <tr>';
    /*
    | START | LIVE NEWS FEED DIRECTLY FROM The 86it Developers Network
    */
    echo '    <td style="vertical-align: top; width: 64%;">';
    echo '      <table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">';
    echo '        <tr>';
    echo '          <td class="catHead" style="height:30px; letter-spacing: 1px;" class="catHead">'.$admlang['livefeed']['header'].'</td>';
    echo '        </tr>';
    echo '        <tr>';
    echo '          <td class="row1">';
    echo '            <div style="height: 14.8em; overflow: auto;">';
    
	echo '<table style="font-family: monospace !important; width: 100%;" border="0" cellpadding="3" cellspacing="1" class="livefeed">';
    
	global $domain;
	$agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36';
    $curl=curl_init('https://hub.86it.us/versions/feed.php');
    curl_setopt($curl, CURLOPT_USERAGENT, $agent);
	
    curl_setopt($curl, CURLOPT_USERAGENT, $agent);
    curl_setopt($curl, CURLOPT_REFERER, 'https://'.$domain.'/');
	
    $dir = NUKE_BASE_DIR.'includes/log';
    $config['cookie_file'] = $dir . '/' . md5($_SERVER['REMOTE_ADDR']) . '.txt';
    curl_setopt($curl, CURLOPT_COOKIEFILE, $config['cookie_file']);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $config['cookie_file']);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $page = curl_exec($curl);	
	echo $page;
	
	echo '</table>';
	echo '            </div>';
    echo '          </td>';
    echo '        </tr>';
    echo '      </table>';
    echo '    </td>';
    /*
    | END | LIVE NEWS FEED DIRECTLY FROM The 86it Developers Network
    */
    echo '    <td style="vertical-align: top; width: 36%;">';
    echo '      <table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">';
    echo '        <tr>';
    echo '          <td class="catHead" style="height:30px; letter-spacing: 1px;" class="catHead">'.$admlang['admin']['important'].'</td>';
    echo '        </tr>';
    echo '        <tr>';
    echo '          <td class="row1">';
    echo '            <div style="height: 14.8em;">';
    echo '            <table style="width: 100%;" border="0" cellpadding="4" cellspacing="1">';
    echo track_admin_intrusion();
    echo track_sql_errors();
    echo '              <tr>';
    echo '                <td style="height: 15px; font-size: 13px;">'.$admlang['admin']['version_check'].'</td>';
    echo '                <td style="height: 15px; font-size: 13px; text-align: center;"><a href="'.$admin_file.'.php?op=version">'.$admlang['admin']['version_check_run'].'</a></td>';
    echo '              </tr>';
    echo '              <tr>';
    echo '                <td style="height: 15px; font-size: 13px;">'.$admlang['admin']['ip_lock'].'</td>';
    echo '                <td style="height: 15px; font-size: 13px; text-align: center;">'.((defined('ADMIN_IP_LOCK')) ? $admlang['global']['enabled'] : $admlang['global']['disabled']).'</a></td>';
    echo '              </tr>';
    echo '              <tr>';
    echo '                <td style="height: 15px; font-size: 13px;">'.$admlang['admin']['filter'].'</td>';
    echo '                <td style="height: 15px; font-size: 13px; text-align: center;">'.$admlang['global']['enabled'].'</td>';
    echo '              </tr>';
    echo '              <tr>';
    echo '                <td style="height: 15px; font-size: 13px;">'._AB_NUKESENTINEL.'</td>';
    echo '                <td style="height: 15px; font-size: 13px; text-align: center;">'.((defined('NUKESENTINEL_IS_LOADED')) ? $admlang['global']['enabled'] : $admlang['global']['disabled']).'</td>';
    echo '              </tr>';

    echo '              <tr>';
    echo '                <td style="height: 15px; font-size: 13px;">'.$admlang['admin']['waiting_users'].'</td>';
    echo '                <td style="height: 15px; font-size: 13px; text-align: center;"><a href="modules.php?name=Your_Account&file=admin&op=listpending">'.$waiting_users.'</a></td>';
    echo '              </tr>';

    echo '            </table>';
    echo '            </div>';
    echo '          </td>';
    echo '        </tr>';
    echo '      </table>';
    echo '    </td>';
    echo '  </tr>';
    echo '</table>';

    echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1">'; // remove this to go back to normal
    if (is_mod_admin('super'))
    {
        echo '  <tr>';
        echo '    <td colspan="6">';
        echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">';
        echo '        <tr>';
        echo '          <td class="catHead">'.$admlang['admin']['administration_header'].'</td>';
        echo '        </tr>';
        echo '      </table>';
        echo '    </td>';
        echo '  </tr>';
        echo '  <tr>'."\n";
        $linksdir = opendir(NUKE_ADMIN_DIR.'links');
        $menulist = '';
        while(false !== ($func = readdir($linksdir))) 
        {
            if(substr($func, 0, 6) == 'links.')
                $menulist .= $func.' ';
        }
        closedir($linksdir);
        $menulist = explode(' ', $menulist);
        sort($menulist);
        for ($i=0, $maxi = count($menulist); $i < $maxi; $i++) 
        {
            if(!empty($menulist[$i]))
                include(NUKE_ADMIN_DIR.'links/'.$menulist[$i]);
        }
        $counter = "";
        echo '        </tr>'."\n";
    }
    echo '  <tr>';
    echo '    <td colspan="6">';
    echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">';
    echo '        <tr>';
    echo '          <td class="catHead">'.$admlang['admin']['modules_header'].'</td>';
    echo '        </tr>';
    echo '      </table>';
    echo '    </td>';
    echo '  </tr>';
    echo '  <tr>'."\n";
    update_modules();
    $result = $db->sql_query("SELECT `title` FROM `".$prefix."_modules` ORDER BY `title` ASC");
    $count = 0;
    while($row = $db->sql_fetchrow($result)) 
    {
        if (is_mod_admin($row['title'])) 
        {
            if (file_exists(NUKE_MODULES_DIR.$row['title']."/admin/index.php") AND file_exists(NUKE_MODULES_DIR.$row['title']."/admin/links.php") AND file_exists(NUKE_MODULES_DIR.$row['title']."/admin/case.php")) 
            {
            	global $module_folder_name;
            	$module_folder_name = $row['title'];
                include(NUKE_MODULES_DIR.$row['title'].'/admin/links.php');
            }
            $count++;
        }
    }
    $db->sql_freeresult($result);
    if ($count == 0)
    {
        echo '    <td class="row1" style="text-align:center;">';
        echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">';
        echo '        <tr>';
        echo '          <td class="row1">'.sprintf($admlang['admin']['no_rights'], UsernameColor($userinfo['username'])).'</td>';
        echo '        </tr>';
        echo '      </table>';
        echo '    </td>'."\n";
    }
    echo '  </tr>'."\n";    
    echo '</table>';
/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    global $admin_fc_status, $admin_fc_attempts, $admin_fc_timeout;
    $ip = $_SERVER['REMOTE_ADDR'];
    $fc = $db->sql_ufetchrow("SELECT * FROM `". $prefix ."_admin_fc` WHERE fc_ip = '$ip'");
    if (!empty($fc['fc_ip']))
    {
        $db->sql_query("DELETE FROM ".$prefix."_admin_fc WHERE fc_ip = '$ip'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_admin_fc");
    }
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    CloseTable();
}

?>