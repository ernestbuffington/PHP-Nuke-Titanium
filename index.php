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
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Functions                      v1.5.0       12/16/2005
-=[Other]=-
      Referers Fix                             v1.0.0       06/07/2005
-=[Mod]=-
      Lock Modules                             v1.0.0       08/04/2005
      Banner Ads                               v1.0.0       12/15/2005
      Advanced Security Code Control           v1.0.0       12/17/2005
	  Arcade                                   v3.0.2       05/29/2009
 ************************************************************************/

define('HOME_FILE', true);
define('MODULE_FILE', true);
$_SERVER['PHP_SELF'] = 'modules.php';

require_once(dirname(__FILE__).'/mainfile.php');


/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
//Arcade MOD - IBProSupport
// $arcade = $HTTP_GET_VARS['act'];
$arcade = get_query_var('act', 'get');
// $newscore = $HTTP_GET_VARS['do'];
$newscore = get_query_var('do', 'get');
if($arcade == 'Arcade' && $newscore='newscore')
{
$gamename = str_replace("\'","''",$HTTP_POST_VARS['gname']);
$gamename = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$gamename);
$gamescore = intval($HTTP_POST_VARS['gscore']);

//Get Game ID
$row = $db->sql_ufetchrow("SELECT game_id FROM ".$prefix."_bbgames WHERE game_scorevar='$gamename'");
$gid = intval($row['game_id']);

$ThemeSel = get_theme();

echo "<link rel=\"StyleSheet\" href=\"themes/".$ThemeSel."/style/style.css\" type=\"text/css\">\n\n\n";
############################################################################################################

############################################################################################################

echo "<form method='post' name='ibpro_score' action='modules.php?name=Forums&amp;file=proarcade&amp;valid=X&amp;gpaver=GFARV2'>";
echo "<input type=hidden name='vscore' value='".$gamescore."'>";
echo "<input type=hidden name='gid' value='".$gid."'>";
echo "</form>";

echo "<script type=\"text/javascript\">";
echo "window.onload = function(){document.forms[\"ibpro_score\"].submit()}";
echo "</script>";
exit;
}
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/





global $prefix, $db, $admin_file, $httpref, $httprefmax;

/*****[BEGIN]******************************************
 [ Mod:    Banner Ads                          v1.0.0 ]
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/
if (isset($_GET['op'])) {
    if($_GET['op'] == 'ad_click' && isset($_GET['bid'])) {
        $bid = intval($_GET['bid']);
        list($clickurl) = $db->sql_ufetchrow("SELECT `clickurl` FROM `".$prefix."_banner` WHERE `bid`='$bid'", SQL_NUM);
        if(!is_admin()) {
           $db->sql_query("UPDATE `".$prefix."_banner` SET `clicks`=clicks+1 WHERE `bid`='$bid'");
        }
        redirect($clickurl);
    } elseif($_GET['op'] == 'gfx') {
        include_once(NUKE_INCLUDE_DIR.'gfxchk.php');
    } else {
        exit('Illegal Operation');
    }
}
/*****[END]********************************************
 [ Mod:    Banner Ads                          v1.0.0 ]
 [ Mod:    Advanced Security Code Control      v1.0.0 ]
 ******************************************************/



if (isset($_GET['url']) && is_admin()) {
    redirect($_GET['url']);
}


$module_name = main_module();



/*****[BEGIN]******************************************
 [ Mod:     Lock Modules                       v1.0.0 ]
 ******************************************************/
global $lock_modules;
if(($lock_modules && $module_name != 'Your_Account') && !is_admin() && !is_user()) {
    include(NUKE_MODULES_DIR.'Your_Account/index.php');
}
/*****[END]********************************************
 [ Mod:     Lock Modules                       v1.0.0 ]
 ******************************************************/

$mop = (!isset($mop)) ? 'modload' : trim($mop);
$mod_file = (!isset($mod_file)) ? 'index' : trim($mod_file);
$file = (isset($_REQUEST['file'])) ? trim($_REQUEST['file']) : 'index';
if (!isset($modpath)) { $modpath = ''; }

if (stristr($file,"..") || stristr($mod_file,"..") || stristr($mop,"..")) 
{


/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
    log_write('error', 'Inappropriate module path was used', 'Hack Attempt');
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
    die("You are so cool...");
} 
else 
{
    $module = $db->sql_ufetchrow('SELECT `blocks` FROM `'.$prefix.'_modules` WHERE `title`="'.$module_name.'"');
	$modpath = NUKE_MODULES_DIR.$module_name."/$file.php";
	if (file_exists($modpath)) {
		$showblocks = $module['blocks'];
		unset($module, $error);
		require($modpath);
    } else {
        DisplayError((is_admin()) ? "<strong>"._HOMEPROBLEM."</strong><br /><br />[ <a href=\"".$admin_file.".php?op=modules\">"._ADDAHOME."</a> ]" : _HOMEPROBLEMUSER);
    }
}
?>
