<?php
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Blue Skulls Theme v1.0 (Fixed & Full Width)                                           #
#                                                                                       #
# Final Build Date 08/17/2019 Saturday 7:40pm                                           #
#                                                                                       #
# A Very Nice Black Carbin Fiber Styled Design.                                         #
# Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington                              #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 1st August, 2019 (v1.0)                                                   #
#                                                                                       #
# Updated On: 1st August, 2019 (v3.0)                                                   #
# HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)                          #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost                                                                 #
# Web Site: https://theghost.86it.us                                                    #
# Purpose: PHP-Nuke Titanium | Xtreme Evo                                               #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# PHP-Nuke Titanium (c) 2019 : Enhanced PHP-Nuke Web Portal System                      #
#---------------------------------------------------------------------------------------#

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) { exit('Access Denied'); }

$theme_name = basename(dirname(__FILE__));

#--------------------------#
# Theme Management Section #
#--------------------------#
include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');

#-------------------------#
# Theme Colors Definition #
#-------------------------#
global $digits_color, $fieldset_border_width, $fieldset_color, $define_theme_xtreme_209e, $avatar_overide_size, $ThemeInfo, $use_xtreme_voting, $make_xtreme_avatar_small;

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

define('blue_skulls_theme_dir', 'themes/'.$theme_name.'/');
define('blue_skulls_images_dir', blue_skulls_theme_dir.'images/');
define('blue_skulls_style_dir', blue_skulls_theme_dir.'style/');
define('blue_skulls_js_dir', blue_skulls_style_dir.'js/');
define('blue_skulls_hdr_images', blue_skulls_images_dir.'hdr/');
define('blue_skulls_ftr_images', blue_skulls_images_dir.'ftr/');

define('blue_skulls_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));

define('blue_skulls_copyright', 'CarbinFiber Blue Skulls Designed By: TheGhost<br />Copyright &copy '.date('Y').' The 86it Developer Network<br />All Rights Reserved');
define('blue_skulls_copyright_click', 'Click the Link to Display Copyrights');

addCSSToHead(blue_skulls_style_dir.'style.css','file');
addCSSToHead(blue_skulls_style_dir.'menu.css','file');

#-------------------#
# OpenTable Section #
#-------------------#
include_once(blue_skulls_theme_dir.'function_OpenTable.php');
include_once(blue_skulls_theme_dir.'function_CloseTable.php');
include_once(blue_skulls_theme_dir.'function_OpenTable2.php');
include_once(blue_skulls_theme_dir.'function_CloseTable2.php');
include_once(blue_skulls_theme_dir.'function_OpenTable3.php');
include_once(blue_skulls_theme_dir.'function_CloseTable3.php');
include_once(blue_skulls_theme_dir.'function_OpenTable4.php');
include_once(blue_skulls_theme_dir.'function_CloseTable4.php');

#---------------------#
# FormatStory Section #
#---------------------#
include_once(blue_skulls_theme_dir.'function_FormatStory.php');

#----------------#
# Header Section #
#----------------#
function themeheader(){	include_once(blue_skulls_theme_dir.'HDRcarbinfiber.php'); }

#----------------#
# Footer Section #
#----------------#
function themefooter(){ include_once(blue_skulls_theme_dir.'FTRcarbinfiber.php'); }

#--------------------#
# News Index Section #
#--------------------#
include_once(blue_skulls_theme_dir.'function_themeindex.php');

#----------------------#
# News Article Section #
#----------------------#
include_once(blue_skulls_theme_dir.'function_themearticle.php');

#-------------------#
# Centerbox Section #
#-------------------#
include_once(blue_skulls_theme_dir.'function_themecenterbox.php');

#-----------------#
# Preview Section #
#-----------------#
include_once(blue_skulls_theme_dir.'function_themepreview.php');

#-----------------#
# Sidebox Section #
#-----------------#
include_once(blue_skulls_theme_dir.'function_themesidebox.php');
?>
