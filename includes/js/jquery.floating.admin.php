<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 - 2018 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	jQuery Floating Administration Menu
|	VERSION 			:	2.0
|----------------------------------------------------------------------
*/

if(!defined('NUKE_FILE')) 
    die('Access forbbiden');

# JQUERY FLOATING ADMIN MENU
if(is_admin())
{
	global $customlang;

	$admin_log = log_size('admin');
	$error_log = log_size('error');

	$admin_color = $admin_name = $error_color = $error_name = "";

	if($admin_log == -1 || $admin_log == -2 || $admin_log):
        $admin_color = " style=\'color: red; !important\'";
        $admin_name  = " ".$customlang['floating_admin']['has_changed'];     
    endif;

    if($error_log == -1 || $error_log == -2 || $error_log):
        $error_color .= " style=\'color: red; !important\'";
        $error_name  .= " ".$customlang['floating_admin']['has_changed'];    
    endif;

    # administration links, this will be getting moved into a json file in the future, so the link scan be updated via the administration panel.
	$floating_administration  = "<i class=\'fa fa-times fa-times-extend\'></i>";
	$floating_administration .= "<div class=\'boxed_item_center\'>";
	$floating_administration .= "  <h1 class=\'boxed_item\'>".$customlang['floating_admin']['admin']."</h1>";
	$floating_administration .= "</div>";
	$floating_administration .= "<ul class=\'navigation_section\' style=\'padding: 0;\'>";
	$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php\'>".$customlang['floating_admin']['main_admin']."</a></li>";
	if ( is_mod_admin('Forums') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=forums\'>".$customlang['floating_admin']['forum_admin']."</a></li>";

	if ( is_mod_admin('super') ):
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=viewadminlog&amp;log=admin\'".$admin_color.">".$customlang['floating_admin']['log_admin'].$admin_name."</a></li>";
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=viewadminlog&amp;log=error\'".$error_color.">".$customlang['floating_admin']['log_error'].$error_name."</a></li>";
	endif;

	$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=blocks\'>".$customlang['floating_admin']['blocks']."</a></li>";
	if ( is_mod_admin('super') ):
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=modules\'>".$customlang['floating_admin']['modules']."</a></li>";
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=modules&area=block\'>".$customlang['floating_admin']['modblock']."</a></li>";
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=Configure\'>".$customlang['floating_admin']['preferences']."</a></li>";
	endif;

	$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=themes\'>".$customlang['floating_admin']['themes']."</a></li>";

	if ( is_mod_admin('News') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=adminStory\'>".$customlang['floating_admin']['news']."</a></li>";

	if ( is_mod_admin('Your_Account') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'modules.php?name=Your_Account&file=admin\'>".$customlang['floating_admin']['users']."</a></li>";

	if ( is_mod_admin('super') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=who\'>".$customlang['floating_admin']['whois']."</a></li>";

	if ( is_mod_admin('News') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=Links\'>".$customlang['floating_admin']['weblinks']."</a></li>";
	
	if ( file_exists('admin/modules/honeypot.php') && is_mod_admin('super') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=honeypot\'>".$customlang['floating_admin']['honeypot']."</a></li>";

	if ( file_exists('modules/Clan_Manager/admin/index.php') && is_mod_admin('Clan_Manager') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=clanmanager\'>".$customlang['floating_admin']['roster']."</a></li>";

	if ( file_exists('modules/File_Repository/admin/index.php') && is_mod_admin('File_Repository') )
		$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=file_repository\'>".$customlang['floating_admin']['downloads']."</a></li>";

	$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=cache_clear\'>".$customlang['floating_admin']['cache']."</a></li>";
	$floating_administration .= "  <li class=\'navigation_item\'><a href=\'".$admin_file.".php?op=logout\'>".$customlang['floating_admin']['logout']."</a></li>";	
	$floating_administration .= "</ul>";

	$floating_admin_inline_css  = '<!-- Inline CSS for scroll to top v1.0 -->'.PHP_EOL;
	$floating_admin_inline_css .= '<style type="text/css">'.PHP_EOL;
	$floating_admin_inline_css .= '.toggle_menu{-webkit-box-shadow: 0px 0px 3px 2px '.$ThemeInfo['uitotophover'].';-moz-box-shadow: 0px 0px 3px 2px '.$ThemeInfo['uitotophover'].';box-shadow: 0px 0px 3px 2px '.$ThemeInfo['uitotophover'].';}';
	$floating_admin_inline_css .= '</style>'.PHP_EOL;
	addCSSToHead($floating_admin_inline_css,'inline');
	addCSSToHead(NUKE_CSS_DIR.'jquery.floating.admin.css','file');
	$floating_admin_inline_js  = '<!-- Inline CSS for scroll to top v1.0 -->'.PHP_EOL;
	$floating_admin_inline_js .= '<script type="text/javascript">'.PHP_EOL;
	$floating_admin_inline_js .= 'nuke_jq(function($)'.PHP_EOL;
	$floating_admin_inline_js .= '{'.PHP_EOL;
	$floating_admin_inline_js .= '  $("<i class=\'fa fa-bars toggle_menu opacity_one\'></i><div class=\'sidebar_menu hide_menu\'></div>").prependTo("body");'.PHP_EOL;
	$floating_admin_inline_js .= '  $(".sidebar_menu").prepend("'.$floating_administration.'")'.PHP_EOL;
	$floating_admin_inline_js .= '  $(".fa-times").click(function()'.PHP_EOL;
	$floating_admin_inline_js .= '  {'.PHP_EOL;
	$floating_admin_inline_js .= '      $(".sidebar_menu").addClass("hide_menu").css({"transition": "margin-left 0.2s", "border-right": ""});'.PHP_EOL;
	$floating_admin_inline_js .= '      $(".toggle_menu").css("opacity", 0.9);'.PHP_EOL;
	$floating_admin_inline_js .= '  });'.PHP_EOL;
	$floating_admin_inline_js .= '  $(".toggle_menu").click(function()'.PHP_EOL;
	$floating_admin_inline_js .= '  {'.PHP_EOL;
	$floating_admin_inline_js .= '      $(".sidebar_menu").removeClass("hide_menu").css({"transition": "margin-left 0.3s", "border-right": "2px solid '.$ThemeInfo['uitotophover'].'"});'.PHP_EOL;
	$floating_admin_inline_js .= '      $(".toggle_menu").css("opacity", 0);'.PHP_EOL;
	$floating_admin_inline_js .= '  });'.PHP_EOL;
	$floating_admin_inline_js .= '});'.PHP_EOL;
    $floating_admin_inline_js .= '</script>'.PHP_EOL;
    addJSToBody($floating_admin_inline_js,'inline');
    
}

?>