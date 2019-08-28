<?php

/*----------------------------------------------------------------*/
/* THEME INFO                                                     */
/* XtremeV3 Theme v3.0 (Fixed & Full Width)                       */
/*                                                                */
/* A Very Nice Clean Grey Styled Design.                          */
/* Copyright © 2019 By: RealmDesignz.com | All Rights Reserved    */
/*----------------------------------------------------------------*/
/* CREATION INFO                                                  */
/* Created On: 24th December, 2018 (v3.0)                         */
/*                                                                */
/* Updated On: 6th Jan, 2019 (v3.0)                               */
/* HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)   */
/*                                                                */
/* Read CHANGELOG File for Updates & Upgrades Info                */
/*                                                                */
/* Designed By: The Mortal                                        */
/* Web Site: www.realmdesignz.com                                 */
/* Purpose: Xtreme v3 CMS                                         */
/*----------------------------------------------------------------*/
/* CMS INFO                                                       */
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi phpnuke.org     */
/* Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System      */
/*----------------------------------------------------------------*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));

/*--------------------------*/
/* Theme Management Section */
/*--------------------------*/
include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');

/*-------------------------*/
/* Theme Colors Definition */
/*-------------------------*/
global $digits_color, $fieldset_border_width, $fieldset_color, $define_theme_xtreme_209e, $avatar_overide_size, $ThemeInfo, $use_xtreme_voting, $make_xtreme_avatar_small;

# This is to tell the main portal menu to luook for the images
# in the theme dir "theme_name/images/menu"
global $use_theme_image_dir_for_portal_menu;

$use_theme_image_dir_for_portal_menu = false;


$digits_color ='#ffb825';
$fieldset_border_width = '1px'; 
$fieldset_color = '#4e4e4e';
$define_theme_xtreme_209e = false;
$avatar_overide_size = '150';
$make_xtreme_avatar_small = true;
$use_xtreme_voting = false;


$bgcolor1   = $ThemeInfo['bgcolor1'];
$bgcolor2   = $ThemeInfo['bgcolor2'];
$bgcolor3   = $ThemeInfo['bgcolor3'];
$bgcolor4   = $ThemeInfo['bgcolor4'];
$textcolor1 = $ThemeInfo['textcolor1'];
$textcolor2 = $ThemeInfo['textcolor2'];

define('xtremev3_theme_dir', 'themes/'.$theme_name.'/');
define('xtremev3_images_dir', xtremev3_theme_dir.'images/');
define('xtremev3_style_dir', xtremev3_theme_dir.'style/');
define('xtremev3_js_dir', xtremev3_style_dir.'js/');
define('xtremev3_hdr_images', xtremev3_images_dir.'hdr/');
define('xtremev3_ftr_images', xtremev3_images_dir.'ftr/');

define('xtremev3_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));

define('xtremev3_copyright', 'XtremeV3 Theme Designed By: The Mortal<br />Copyright &copy '.date('Y').' RealmDesignz.com<br />All Rights Reserved');
define('xtremev3_copyright_click', 'Click the Link to Display Copyrights');

addCSSToHead(xtremev3_style_dir.'style.css','file');
addCSSToHead(xtremev3_style_dir.'menu.css','file');

/*-------------------*/
/* OpenTable Section */
/*-------------------*/
/*-------------------*/
/* OpenTable Section */
/*-------------------*/
//include_once(xtremev3_theme_dir.'xtremev3_tables.php');

include_once(xtremev3_theme_dir.'function_OpenTable.php');
include_once(xtremev3_theme_dir.'function_CloseTable.php');

include_once(xtremev3_theme_dir.'function_OpenTable2.php');
include_once(xtremev3_theme_dir.'function_CloseTable2.php');

/*---------------------*/
/* FormatStory Section */
/*---------------------*/
function FormatStory($thetext, $notes, $aid, $informant) 
{
global $anonymous;

$notes = !empty($notes) ? '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>' : '';	
if ($aid == $informant) 
{
   echo '<span class="content" color="#505050">'.$thetext.$notes.'</span>';
} 
else 
{
   if (defined('WRITES')) 
   {
      if (!empty($informant)) 
      {
         if ( is_array($informant) ):
            $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a>';
         else:
            $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>';
         endif;
} 
else 
{
            $boxstuff = $anonymous.' ';
      }
            $boxstuff .= _WRITES.' <em>'.$thetext.'</em>'.$notes;
} 
else 
{
            $boxstuff .= $thetext . $notes;
      }
      echo '<span class="content" color="#505050">' . $boxstuff . '</span>';
   }
}

/*----------------*/
/* Header Section */
/*----------------*/
function themeheader() 
{
	include_once(xtremev3_theme_dir.'HDRxtremev3.php');
}

/*----------------*/
/* Footer Section */
/*----------------*/
function themefooter() 
{
	include_once(xtremev3_theme_dir.'FTRxtremev3.php');
}

/*--------------------*/
/* News Index Section */
/*--------------------*/
include_once(xtremev3_theme_dir.'function_themeindex.php');

/*----------------------*/
/* News Article Section */
/*----------------------*/
include_once(xtremev3_theme_dir.'function_themearticle.php');

/*-------------------*/
/* Centerbox Section */
/*-------------------*/
function themecenterbox($title, $content) 
{
OpenTable();
  echo '<center><span class="option"><strong>'.$title.'</strong></span></center>'.$content;
CloseTable();
}

/*-----------------*/
/* Preview Section */
/*-----------------*/
function themepreview($title, $hometext, $bodytext='', $notes='') 
{
echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
echo (!empty($bodytext)) ? '<br /><br />'.$bodytext : '';
echo (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>' : '';
}

/*-----------------*/
/* Sidebox Section */
/*-----------------*/
include_once(xtremev3_theme_dir.'function_themesidebox.php');
function themesideboxOLD($title, $content, $bid = 0) 
{
echo '<aside>'
    .'  <div class="bl1"><div style="padding-top: 15px; text-align:center;"><span class="blocktitle" >'.$title.'</span></div></div>'
    .'  <div class="bl2">'
    .'    <div class="bl5-content" style="margin: auto;">'.$content.'</div>'
    .'  </div>'
    .'  <div class="bl3"></div>'
    .'</aside>'
    .'<br />';
}

?>