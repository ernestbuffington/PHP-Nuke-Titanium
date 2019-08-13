<?php
/*----------------------------------------------------------------*/
/* THEME INFO                                                     */
/* Kinon Theme v1.0 (Fixed & Full Width)                          */
/*                                                                */
/* A Very Nice Template                                           */
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
/* Web Site: https://theghost.86it.us                             */
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
global $table_spacer_left, $table_spacer_right, $digits_color, $fieldset_border_width, $fieldset_color, $define_theme_xtreme_209e, $avatar_overide_size, $ThemeInfo, $use_xtreme_voting, $make_xtreme_avatar_small;

$table_spacer_left = '18';
$table_spacer_right = '0';

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

define('kinon_theme_dir', 'themes/'.$theme_name.'/');
define('kinon_images_dir', kinon_theme_dir.'images/');
define('kinon_style_dir', kinon_theme_dir.'style/');
define('kinon_js_dir', kinon_style_dir.'js/');
define('kinon_hdr_images', kinon_images_dir.'hdr/');
define('kinon_ftr_images', kinon_images_dir.'ftr/');

define('kinon_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));

define('kinon_copyright', 'Kinon Designed By: TheGhost<br />Copyright &copy '.date('Y').' The 86it Developer Network<br />All Rights Reserved');
define('kinon_copyright_click', 'Click the Link to Display Copyrights');

addCSSToHead(kinon_style_dir.'style.css','file');
addCSSToHead(kinon_style_dir.'menu.css','file');

/*-------------------*/
/* OpenTable Section */
/*-------------------*/
include_once(kinon_theme_dir.'kinon_tables.php');

/*---------------------*/
/* FormatStory Section */
/*---------------------*/
include_once(kinon_theme_dir.'function_FormatStory.php');

/*----------------*/
/* Header Section */
/*----------------*/
function themeheader() { include_once(kinon_theme_dir.'HDRkinon.php'); }

/*----------------*/
/* Footer Section */
/*----------------*/
function themefooter(){ include_once(kinon_theme_dir.'FTRkinon.php'); }

/*---------------------*/
/* Blogs Index Section */
/*---------------------*/
include_once(kinon_theme_dir.'function_themeindex.php');

/*-----------------------*/
/* Blogs Article Section */
/*-----------------------*/
include_once(kinon_theme_dir.'function_themearticle.php');

/*-------------------*/
/* Centerbox Section */
/*-------------------*/
include_once(kinon_theme_dir.'function_themecenterbox.php');

/*-----------------*/
/* Preview Section */
/*-----------------*/
include_once(kinon_theme_dir.'function_themepreview.php');

/*-----------------*/
/* Sidebox Section */
/*-----------------*/
include_once(kinon_theme_dir.'function_themesidebox.php');
?>
