<?
/************************************************************************
   PHP-Nuke Titanuim
   ============================================
   Copyright (c) 2019 by The PHP-Nuke Titanium Team
   Version       : 1.0.0
   Date          : 07.20.2019 (mm.dd.yyyy)
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
	exit('Quit trying to hack my website!');

$current_theme = basename(dirname(__FILE__));

global $theme_options;
$theme_options   = array();

$theme_options[] = array( "name" => "Kinon Theme Options",
                    "type" => "heading");

$theme_options[] = array( "name" => "Upload your logo",
                    "desc" => "Upload your logo. We recommend keeping it within reasonable size. Max width 400px and minimum height of 110px.",
                    "id"   => "logo",
                    "std"  => "img/logo.png",
                    "type" => "upload");

$theme_options[] = array( "name" => "Theme Width",
                    "desc" => "Set the theme width",
                    "id"   => "themewidth",
                    "std"  => "1368",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 1",
                    "id"   => "bg_color_1",
                    "std"  => "#454545",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 2",
                    "id"   => "bg_color_2",
                    "std"  => "#383838",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 3",
                    "id"   => "bg_color_3",
                    "std"  => "#383838",
                    "type" => "text");

$theme_options[] = array( "name" => "BG Color 4",
                    "id"   => "bg_color_4",
                    "std"  => "#383838",
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
	'1368',
	'#454545',
	'#383838',
	'#383838',
	'#383838',
	'#ccc',
	'#ccc',
	'Go to Theme Options to Edit Footer Message Line 1',
	'Go to Theme Options to Edit Footer Message Line 2',
	'#D29A2B',
	'dark'
);

global $ThemeInfo;
$ThemeInfo = LoadThemeInfo($current_theme);
?>
