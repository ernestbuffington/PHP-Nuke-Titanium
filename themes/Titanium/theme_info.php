<?
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

/******************************************************************
   PHP-Nuke Titanuim
   ============================================
   Copyright (c) 2019 by The PHP-Nuke Titanium Team
   Version       : 3.0.0
   Date          : 07.20.2019 (mm.dd.yyyy)
*******************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
	exit('Quit trying to hack my website!');

$current_theme = basename(dirname(__FILE__));

global $theme_options;
$theme_options   = array();

$theme_options[] = array( "name" => "Titanium Theme Options",
                    "type" => "heading");

$theme_options[] = array( "name" => "Upload your logo",
                    "desc" => "Upload your logo. We recommend keeping it within reasonable size. Max width 400px and minimum height of 110px.",
                    "id"   => "logo",
                    "std"  => "img/logo.png",
                    "type" => "upload");

$theme_options[] = array( "name" => "Theme Width",
                    "desc" => "Set the theme width",
                    "id"   => "themewidth",
                    "std"  => "95%",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 1",
                    "id"   => "bg_color_1",
                    "std"  => "#808080",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 2",
                    "id"   => "bg_color_2",
                    "std"  => "#a6a6a6",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 3",
                    "id"   => "bg_color_3",
                    "std"  => "#afafaf",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 4",
                    "id"   => "bg_color_4",
                    "std"  => "#808080",
                    "type" => "text");

$theme_options[] = array( 'name'      => 'Select single/category/archive page template',
					'desc'      => 'Choose template for your category/archive page.',
					'id'        => 'archive_template',
					'std'       => 'right',
					'type'      => 'select',
					'options'   => array(
						'full'  => 'Full width',
						'right' => 'Right Sidebar',
						'left'  => 'Left Sidebar'
					));


$param_names = array(
	'Theme Width<br /><span class="textmed">90% = 90% | 1280 = 1280px | 1368 = 1368px</span>',
	'BG Color 1',
	'BG Color 2',
	'BG Color 3',
	'BG Color 4',
	'Text Color 1',
	'Text Color 2',
	'Foot Message 1',
	'Foot Message 2',
	'Scroll to Top Hover Color',
	'reCaptcha Skin<br /><span class="textmed">white | dark</span>' 
);

$params = array(
	'themewidth',
	'bgcolor1',
	'bgcolor2',
	'bgcolor3',
	'bgcolor4',
	'textcolor1',
	'textcolor2',
	'fms1',
	'fms2',
	'uitotophover',
	'recaptcha_skin'
);

$default = array(
	'95%',
	'#808080',
	'#a6a6a6',
	'#afafaf',
	'#808080',
	'#000000',
	'#cc0000',
	'Titanium Footer Line 1',
	'Titanium Footer Line 2',
	'#D29A2B',
	'dark'
);

global $ThemeInfo;
$ThemeInfo = LoadThemeInfo($current_theme);
?>