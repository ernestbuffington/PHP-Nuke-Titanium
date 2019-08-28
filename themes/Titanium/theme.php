<?php
/*----------------------------------------------------------------*/
/* THEME INFO                                                     */
/* Titanium Theme v1.0 (Fixed & Full Width)                       */
/*                                                                */
/* A Very Nice Titanium Theme                                     */
/* Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington       */
/* e-Mail : ernest.buffington@gmail.com                           */
/*----------------------------------------------------------------*/
/* CREATION INFO                                                  */
/* Created On: 1st August, 2019 (v1.0)                            */
/*                                                                */
/* Updated On: 1st August, 2019 (v3.0)                            */
/* HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)   */
/*                                                                */
/* Read CHANGELOG File for Updates & Upgrades Info                */
/*                                                                */
/* Designed By: TheGhost / The Mortal                             */
/* Web Site: https://hub.86it.us                                  */
/* Purpose: PHP-Nuke Titanium                                     */
/*----------------------------------------------------------------*/
/* CMS INFO                                                       */
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi phpnuke.org     */
/* PHP-Nuke Titanium (c) 2008                                     */
/*----------------------------------------------------------------*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) { exit('Access Denied'); }

$theme_name = basename(dirname(__FILE__));

/*--------------------------*/
/* Theme Management Section */
/*--------------------------*/
include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');

/*-------------------------*/
/* Theme Colors Definition */
/*-------------------------*/
global $table_spacer_left, 
      $table_spacer_right, 
	        $digits_color, 
   $fieldset_border_width, 
          $fieldset_color, 
$define_theme_xtreme_209e, 
     $avatar_overide_size, 
	           $ThemeInfo, 
	   $use_xtreme_voting, 
$make_xtreme_avatar_small;

# This is to tell the main portal menu to luook for the images
# in the theme dir "theme_name/images/menu"
global $use_theme_image_dir_for_portal_menu;

$use_theme_image_dir_for_portal_menu = false;


$table_spacer_left = '18';
$table_spacer_right = '18';

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

define('titanium_theme_dir', 'themes/'.$theme_name.'/');
define('titanium_images_dir', titanium_theme_dir.'images/');
define('titanium_style_dir', titanium_theme_dir.'style/');
define('titanium_js_dir', titanium_style_dir.'js/');
define('titanium_hdr_images', titanium_images_dir.'hdr/');
define('titanium_ftr_images', titanium_images_dir.'ftr/');

define('titanium_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));

define('titanium_copyright', 'Titanium Theme Designed By: TheGhost<br />Copyright &copy '.date('Y').' The 86it Developer Network<br />All Rights Reserved');
define('titanium_copyright_click', 'Click the Link to Display Copyrights');

addCSSToHead(titanium_style_dir.'style.css','file');
addCSSToHead(titanium_style_dir.'menu.css','file');

/*-------------------*/
/* OpenTable Section */
/*-------------------*/
include_once(titanium_theme_dir.'titanium_tables.php');

/*---------------------*/
/* FormatStory Section */
/*---------------------*/
include_once(titanium_theme_dir.'function_FormatStory.php');

/*----------------*/
/* Header Section */
/*----------------*/
function themeheader() { include_once(titanium_theme_dir.'HDRtitanium.php'); }

/*----------------*/
/* Footer Section */
/*----------------*/
function themefooter(){ include_once(titanium_theme_dir.'FTRtitanium.php'); }

/*---------------------*/
/* Blogs Index Section */
/*---------------------*/
include_once(titanium_theme_dir.'function_themeindex.php');

/*-----------------------*/
/* Blogs Article Section */
/*-----------------------*/
include_once(titanium_theme_dir.'function_themearticle.php');

/*-------------------*/
/* Centerbox Section */
/*-------------------*/
include_once(titanium_theme_dir.'function_themecenterbox.php');

/*-----------------*/
/* Preview Section */
/*-----------------*/
include_once(titanium_theme_dir.'function_themepreview.php');

/*-----------------*/
/* Sidebox Section */
/*-----------------*/
include_once(titanium_theme_dir.'function_themesidebox.php');
?>