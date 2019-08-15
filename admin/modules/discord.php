<?php
/************************************************************************/
/* Discord Block				                                        */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2003 - 2019 coRpSE	                                    */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
$module_name = basename(dirname(dirname(__FILE__)));
require_once('mainfile.php');
define('_force_fancybox_load',true);
global $admin_file, $currentlang;

$addJStoBody = '<script>'."\n";
$addJStoBody .= 'nuke_jq(function($){'."\n";
$addJStoBody .= '$(\'#cp1, #cp2, #cp3, #cp4, #cp5, #cp6, #cp7, #cp8\').ColorPicker({'."\n";
$addJStoBody .= '	onSubmit: function(hsb, hex, rgb, el) {'."\n";
$addJStoBody .= '		$(el).val(\'#\' + hex);'."\n";
$addJStoBody .= '		$(el).ColorPickerHide();'."\n";
$addJStoBody .= '       $( \'#\' + $(el).attr(\'id\')+\'_div\' ).css(\'background-color\',\'#\' + hex);';
$addJStoBody .= '	},'."\n";
$addJStoBody .= '	onBeforeShow: function () {'."\n";
$addJStoBody .= '		$(this).ColorPickerSetColor(this.value);'."\n";
$addJStoBody .= '	}'."\n";
$addJStoBody .= '})'."\n";
$addJStoBody .= '.bind(\'keyup\', function(){'."\n";
$addJStoBody .= '	$(this).ColorPickerSetColor(this.value);'."\n";
$addJStoBody .= '});'."\n";
$addJStoBody .= '});'."\n";
$addJStoBody .= '</script>'."\n";

	addJSToBody($addJStoBody,'inline');
	addCSSToHead('./includes/blocks/discord/css/discord-admin-style.css','file');
	addCSSToHead('./includes/blocks/discord/css/jquery.colorpicker.css','file');
	addJSToBody('./includes/blocks/discord/js/jquery.colorpicker.min.js','file');

global $prefix, $db, $admin_file;
$result = $db->sql_query("SHOW TABLES LIKE '".$prefix."_discord_config'");
$tableExists = $db->sql_numrows($result);
if ($tableExists != 0){
	function dis_config() {
		global $db, $prefix;
		static $disconfig;
		if(isset($disconfig) && is_array($disconfig))
			return $disconfig;
	$result = $db->sql_query("SELECT `config_value`, `config_name` FROM `".$prefix."_discord_config`");
	while ($row = $db->sql_fetchrow($result))
	$disconfig[$row['config_name']] = $row['config_value'];
	$db->sql_freeresult($result);
   	return $disconfig;
	}
  $disconfig = dis_config();
}

	if(is_mod_admin('discord'))
		{
			if (file_exists(NUKE_ADMIN_DIR.'/language/discord/lang-'.$currentlang.'.php'))
		{
			include_once(NUKE_ADMIN_DIR.'/language/discord/lang-'.$currentlang.'.php');
		} else {
			include_once(NUKE_ADMIN_DIR.'/language/discord/lang-english.php');
		}

//*************************************************************************
//  Start of Configuration
//*************************************************************************

function DisConfig(){
	global $admin_file, $currentlang, $disconfig, $db, $prefix;
	$result = $db->sql_query("SHOW TABLES LIKE '".$prefix."_discord_config'");
	$tableExists = $db->sql_numrows($result);
	if ($tableExists == 0){
		Header("Location: ".$admin_file.".php?op=discordinstall");
	}
		include_once(NUKE_BASE_DIR.'header.php');		
		OpenTable();
		echo '<div style="width:100%; text-align: center;"><img src="./includes/blocks/discord/images/discord-block.png" width="585px" height="66" alt=""><br><br>'."\n"
		,'[ <a href="'.$admin_file.'.php">'._DISCORD_MAINADMIN.'</a> ]</div>' , PHP_EOL;
		CloseTable();
		
		OpenTable();
			echo '<form action="' , $admin_file , '.php?op=discordsave" method="post">' , PHP_EOL
			, '<table style="width:75%; margin-left:auto; margin-right:auto;" border="1px" cellpadding="4" cellspacing="1" class="forumline">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_JSON.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row1"><input type="text" name="jsonurl" value="' , $disconfig['jsonurl'] , '" size="55" maxlength="255" placeholder="Ex: https://discordapp.com/api/guilds/11317999045570550/widget.json"/></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_ADMIN.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2"><input type="text" size="55" name="disadmin" value="' , $disconfig['disadmin'] , '" placeholder="Ex: 123456789, 987654321, 112233445"/>&nbsp;' , PHP_EOL
			, '<a data-fancybox data-type="inline" href="#disadminpopup" title="Add Admins to Discord Block"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_LOGO.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row1"><select name="discordlogo">' , PHP_EOL;
				for ($i=1; $i<=3; ++$i) {
					echo '<option value="' , $i , '"' , ($disconfig['discordlogo'] == $i ? ' selected="selected"' : '') , '>';
					if ($i == 1) {
						echo _DISCORD_LIGHT;
					} elseif ($i == 2) {
						echo _DISCORD_DARK;
					} elseif ($i == 3) {
						echo _DISCORD_DEFAULT;
					} 
					echo '</option>' , PHP_EOL;
				}
			echo '</select>' , PHP_EOL
			, '</td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_SHOWEMPTY.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row1"><select name="showempty">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($disconfig['showempty'] == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _DISCORD_YES : _DISCORD_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
			, '</td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_ICONS.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row1"><select name="discordicons">' , PHP_EOL;
			for ($i=0; $i<=1; ++$i) {
				echo '<option value="',$i,'"',($disconfig['discordicons'] == $i ? ' selected="selected"' : ''),'>',($i == 1 ? _DISCORD_DARK : _DISCORD_LIGHT),'</option>' , PHP_EOL;
			}
			echo '</select>' , PHP_EOL
			, '</td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------  Zone 1 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z1.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp1" type="text" size="10" maxlength="7" name="zone1" value="' , $disconfig['zone1'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp1_div" style="background-color:'.$disconfig['zone1'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z1popup" title="Zone1"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 1 End  ---------------
			// ---------------  Zone 2 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z2.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp2" type="text" size="10" maxlength="7"  name="zone2" value="' , $disconfig['zone2'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp2_div" style="background-color:'.$disconfig['zone2'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z2popup" title="Zone2"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 2 End  ---------------
			// ---------------  Zone 3 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z3.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp3" type="text" size="10" maxlength="7"  name="zone3" value="' , $disconfig['zone3'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp3_div" style="background-color:'.$disconfig['zone3'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z3popup" title="Zone3"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 3 End  ---------------
			// ---------------  Zone 4 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z4.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp4" type="text" size="10" maxlength="7"  name="zone4" value="' , $disconfig['zone4'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp4_div" style="background-color:'.$disconfig['zone4'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z4popup" title="Zone4"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 4 End  ---------------
			// ---------------  Zone 5 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z5.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp5" type="text" size="10" maxlength="7"  name="zone5" value="' , $disconfig['zone5'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp5_div" style="background-color:'.$disconfig['zone5'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z5popup" title="Zone5"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 5 End  ---------------
			// ---------------  Zone 6 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z6.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp6" type="text" size="10" maxlength="7"  name="zone6" value="' , $disconfig['zone6'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp6_div" style="background-color:'.$disconfig['zone6'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z6popup" title="Zone6"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 6 End  ---------------
			// ---------------  Zone 7 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z7.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp7" type="text" size="10" maxlength="7" name="zone7" value="' , $disconfig['zone7'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp7_div" style="background-color:'.$disconfig['zone7'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z7popup" title="Zone7"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 7 End  ---------------
			// ---------------  Zone 8 Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z8.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2">' , PHP_EOL
			, '<input class="inp" id="cp8" type="text" size="10" maxlength="7" name="zone8" value="' , $disconfig['zone8'] , '"/>&nbsp;' , PHP_EOL
			, '<div class="discord_color_ex" id="cp8_div" style="background-color:'.$disconfig['zone8'].'"></div>' , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z8popup" title="Zone8"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 8 End  ---------------
			// ---------------  Zone 8b Start ---------------
			, '<tr>' , PHP_EOL
			, '<td style="width:250px; border:1px solid;" class="row1"> '._DISCORD_Z8B.'</td>' , PHP_EOL
			, '<td style="border:1px solid;" class="row2" style="vertical-align:middle;">' , PHP_EOL
			, '<input class="inp" type="range" name="zone8b" id="borderWidthId" value="'.$disconfig['zone8b'].'" min="0" max="3" oninput="amount.value=borderWidthId.value">' , PHP_EOL
			, '&nbsp;<input class="inp" type="text" size="1" id="amount" for="borderWidthId" value="'.$disconfig['zone8b'].'" readonly>'._DISCORD_PX , PHP_EOL
			, '&nbsp;<a data-fancybox data-type="inline" href="#z8popup" title="Zone8"><img src="images/about.png" width="20px" height="20px" alt="Help"></a></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			// ---------------   Zone 8b End  ---------------
			, '<tr>' , PHP_EOL
			, '<td colspan="2" class="row2" style="vertical-align:middle;"><div style="width:100%; text-align: center;"><input type="submit" id="dissub" name="discordsave" value=" '._DISCORD_SUBMIT.'" /></div></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '</table>' , PHP_EOL
			, '</form>' , PHP_EOL;

			echo '<form action="' , $admin_file , '.php?op=discordreset" method="post">' , PHP_EOL
			, '<table style="width:75%; margin-left:auto; margin-right:auto;" border="1px" cellpadding="4" cellspacing="1" class="forumline">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td style="width:50%; border:1px solid;" class="row1"><div style="width:100%; text-align: center;">' , PHP_EOL
			, '<input type="checkbox" name="discordreset" id="discordreset" required> '._DISCORD_RESET_C , PHP_EOL
			, '</div></td>' , PHP_EOL
			, '<td style="width:50%; border:1px solid;" class="row1"><div style="width:100%; text-align: center;">' , PHP_EOL
			, '<input type="submit" name="discordreset" value="'._DISCORD_RESET.'" />' , PHP_EOL
			, '</div></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '</table>' , PHP_EOL
			, '</form>' , PHP_EOL;

			echo '<table style="width:75%; margin-left:auto; margin-right:auto;" border="1px" cellpadding="4" cellspacing="1" class="forumline">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td class="row2" style="vertical-align:middle;">' , PHP_EOL
			, _DISCORD_THANKS , PHP_EOL
			, '</td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '</table>' , PHP_EOL;

			echo '<div id="z1popup" class="discordhelp" style="display:none;">' , PHP_EOL
			, '<i class="discord_sprite discord_sprite-zone1" style="float:left;"></i> <H3>'._DISCORD_HIGHLIGHT.'</H3><br><strong>'._DISCORD_HELP_Z1.'</strong></div>' , PHP_EOL
			, '<div id="z2popup" class="discordhelp" style="display:none;">' , PHP_EOL
			, '<i class="discord_sprite discord_sprite-zone2" style="float:left;"></i><H3>'._DISCORD_HIGHLIGHT.'</H3><br><strong>'._DISCORD_HELP_Z2.'</strong></div>' , PHP_EOL
			, '<div id="z3popup" class="discordhelp" style="display:none;">' , PHP_EOL
			, '<i class="discord_sprite discord_sprite-zone4" style="float:left;"></i><H3>'._DISCORD_HIGHLIGHT.'</H3><br><strong>'._DISCORD_HELP_Z3.'</strong></div>' , PHP_EOL
			, '<div id="z4popup" class="discordhelp" style="display:none;">' , PHP_EOL
			, '<i class="discord_sprite discord_sprite-zone4" style="float:left;"></i><H3>'._DISCORD_HIGHLIGHT.'</H3><br><strong>'._DISCORD_HELP_Z4.'</strong></div>' , PHP_EOL
			, '<div id="z5popup" class="discordhelp" style="display:none;">' , PHP_EOL
			, '<i class="discord_sprite discord_sprite-zone3" style="float:left;"></i><H3>'._DISCORD_HIGHLIGHT.'</H3><br><strong>'._DISCORD_HELP_Z5.'</strong></div>' , PHP_EOL
			, '<div id="z6popup" class="discordhelp" style="display:none;">' , PHP_EOL
			, '<i class="discord_sprite discord_sprite-zone5" style="float:left;"></i><H3>'._DISCORD_HIGHLIGHT.'</H3><br><strong>'._DISCORD_HELP_Z6.'</strong></div>' , PHP_EOL
			, '<div id="z7popup" class="discordhelp" style="display:none;">' , PHP_EOL
			, '<i class="discord_sprite discord_sprite-zone6" style="float:left;"></i><H3>'._DISCORD_HIGHLIGHT.'</H3><br><strong>'._DISCORD_HELP_Z7.'</strong></div>' , PHP_EOL
			, '<div id="disadminpopup" class="discordhelp" style="display:none;">'._DISCORD_HELP_ADMIN.'</div>' , PHP_EOL
			, '<div id="z8popup" class="discordhelp" style="display:none;">'._DISCORD_HELP_Z8.'</div>' , PHP_EOL;
		CloseTable();
		OpenTable();
		echo '<p class="tiny" style="text-align:center;">Mod Created by coRpSE ' , PHP_EOL
			, '<a href="http://www.headshotdomain.net" title="HeadShotDomain" target="_blank">' , PHP_EOL
			, 'www.headshotdomain.net' , PHP_EOL
			, '</a></p>' , PHP_EOL
			, '<div align="center" style="text-align:center;">' , PHP_EOL
			, '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">' , PHP_EOL
			, '<input type="hidden" name="cmd" value="_s-xclick" />' , PHP_EOL
			, '<input type="hidden" name="hosted_button_id" value="FBDV9KVDGAN2E" />' , PHP_EOL
			, '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />' , PHP_EOL
			, '<img style="border:0; width:1px; height:1px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" />' , PHP_EOL
			, '<br><br>'._DISCORD_SUPPORT.'<br>' , PHP_EOL
			, '</form>' , PHP_EOL
			, '</div>' , PHP_EOL;
		CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');
	}

	//save config start
function DisSave() {
	global $prefix, $db, $module_name, $admin_file;
//---------------------------------------------------------------------
//	GENERAL SETTINGS
//---------------------------------------------------------------------
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['jsonurl']."' WHERE `config_name`='jsonurl'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['disadmin']."' WHERE `config_name`='disadmin'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['discordlogo']."' WHERE `config_name`='discordlogo'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['showempty']."' WHERE `config_name`='showempty'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['discordicons']."' WHERE `config_name`='discordicons'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone1']."' WHERE `config_name`='zone1'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone2']."' WHERE `config_name`='zone2'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone3']."' WHERE `config_name`='zone3'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone4']."' WHERE `config_name`='zone4'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone5']."' WHERE `config_name`='zone5'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone6']."' WHERE `config_name`='zone6'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone7']."' WHERE `config_name`='zone7'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone8']."' WHERE `config_name`='zone8'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='".$_POST['zone8b']."' WHERE `config_name`='zone8b'");
	Header("Location: ".$admin_file.".php?op=discord");
	}
	//save config end

	//reset config start
function DisReset() {
	global $prefix, $db, $module_name, $admin_file;
//---------------------------------------------------------------------
//	GENERAL SETTINGS
//---------------------------------------------------------------------
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='1' WHERE `config_name`='discordlogo'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='1' WHERE `config_name`='showempty'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='0' WHERE `config_name`='discordicons'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#a2a2a2' WHERE `config_name`='zone1'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#ffffff' WHERE `config_name`='zone2'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#222222' WHERE `config_name`='zone3'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#111111' WHERE `config_name`='zone4'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#9acd32' WHERE `config_name`='zone5'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#343434' WHERE `config_name`='zone6'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#2c2c2c' WHERE `config_name`='zone7'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='#808080' WHERE `config_name`='zone8'");
	$db->sql_query("UPDATE `".$prefix."_discord_config` SET `config_value`='1' WHERE `config_name`='zone8b'");
	Header("Location: ".$admin_file.".php?op=discord");
}
	//reset config end

function DisInstall() {
	global  $admin_file, $prefix, $db;
    $result = $db->sql_query("SHOW TABLES LIKE '".$prefix."_discord_config'");
    $tableExists = $db->sql_numrows($result);
	include("header.php");
    OpenTable();
			echo '<form action="' , $admin_file , '.php?op=discordinstall2" method="post">' , PHP_EOL
			, '<table style="width:80%; border 0px; margin-left: auto; margin-right: auto; font-size:18px" cellpadding="4" cellspacing="1" class="forumline">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td style="width:100%; border:1px solid;" class="row1" colspan="2">' , PHP_EOL
			, '<br>'._DISCORD_INSTALL.'<br><br>'._DISCORD_INSTALL2.'<br><br>'._DISCORD_INSTALL3.'<br>' , PHP_EOL
			, '<br>'._DISCORD_WARNING.'<br><br>' , PHP_EOL
			, '</td>' , PHP_EOL
			, '</tr>' , PHP_EOL;
			if ($tableExists != 0){
			echo '<tr>' , PHP_EOL
			, '<td style="width:100%; border:1px solid;" class="row1" colspan="2">' , PHP_EOL
			, _DISCORD_TABLE_FOUND , PHP_EOL
			, '</td>' , PHP_EOL
			, '</tr>' , PHP_EOL;
			}
			echo '<tr>' , PHP_EOL
			, '<td style="width:50%; border:1px solid;" class="row1"><div style="width:100%; text-align: center;">' , PHP_EOL
			, '<input type="checkbox" name="discordinstall2" id="discordinstall2" required> '._DISCORD_BAGREE , PHP_EOL
			, '</div></td>' , PHP_EOL
			, '<td style="width:50%; border:1px solid;" class="row1"><div style="width:100%; text-align: center;">' , PHP_EOL
			, '<input type="hidden" id="agree" name="agree" value="agree">' , PHP_EOL
			, '<input type="submit" name="discordinstall2" value="'._DISCORD_BINSTALL.'" />' , PHP_EOL
			, '</div></td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '</table>' , PHP_EOL
			, '</form>' , PHP_EOL;
   CloseTable();
   		OpenTable();
		echo '<p class="tiny" style="text-align:center;">Mod Created by coRpSE ' , PHP_EOL
			, '<a href="http://www.headshotdomain.net" title="HeadShotDomain" target="_blank">' , PHP_EOL
			, 'www.headshotdomain.net' , PHP_EOL
			, '</a></p>' , PHP_EOL
			, '<div align="center" style="text-align:center;">' , PHP_EOL
			, '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">' , PHP_EOL
			, '<input type="hidden" name="cmd" value="_s-xclick" />' , PHP_EOL
			, '<input type="hidden" name="hosted_button_id" value="FBDV9KVDGAN2E" />' , PHP_EOL
			, '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />' , PHP_EOL
			, '<img style="border:0; width:1px; height:1px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" />' , PHP_EOL
			, '<br><br>'._DISCORD_SUPPORT.'<br>' , PHP_EOL
			, '</form>' , PHP_EOL
			, '</div>' , PHP_EOL;
		CloseTable();
   include("footer.php");
}

function DisInstall2() {
    global $prefix, $db, $admin_file;
    !empty($_POST['agree']) ? header( "Refresh:10; url=".$admin_file.".php?op=discord", true, 303) : '';
	$textalign = empty($_POST['agree']) ? 'text-align:center; ' : '';
    include("header.php");
    OpenTable();
	echo '<table style="width:80%; '.$textalign.' border 0px; margin-left: auto; margin-right: auto; font-size:18px" cellpadding="4" cellspacing="1" class="forumline">' , PHP_EOL
	, '<tr>' , PHP_EOL
	, '<td style="width:100%; border:1px solid;" class="row1">' , PHP_EOL;
    if (empty($_POST['agree'])){
		echo '<strong><em>'._DISCORD_SKIPPED.'</em></strong><br><br>' , PHP_EOL
		, '<a href="'.$admin_file.'.php?op=discordinstall" target="_self"><strong>'._DISCORD_GOBACK.'</strong></a>' , PHP_EOL
		, '</td>' , PHP_EOL
		, '</tr>' , PHP_EOL
		, '</table>' , PHP_EOL;
		CloseTable();
      include("footer.php");
  }else{
	echo '<br>'._DISCORD_INSTALLING.'<br><br>' , PHP_EOL;
    if (is_mod_admin('admin')) {
	//Drop table if there is one there already to avoid errors.
	$db->sql_query("DROP TABLE IF EXISTS `".$prefix."_discord_config`");
	
	   echo _DISCORD_DROPTABLE , PHP_EOL
	   , '<br>' , PHP_EOL
	   , _DISCORD_INSERT_TABLE , PHP_EOL;
	   
	//Lets create the new table
    $result = $db->sql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_discord_config` (
    `config_name` varchar(255) NOT NULL DEFAULT '',
    `config_value` text NOT NULL,
    PRIMARY KEY (`config_name`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
	echo '<br>' , PHP_EOL
    , 'Create table '.$prefix.'_discord_config:' , PHP_EOL;
    if($result){
    	echo'<span style="color:#008000;"><i>Success</i></span><br>' , PHP_EOL;
    }else{
    	echo'<span style="color:#FF0000;"><i>Failed</i></span><br>' , PHP_EOL;
    }
	echo '<br>' , PHP_EOL
	, _DISCORD_INSERT_DATA , PHP_EOL;
    //Lets insert the information into the table
    $result = $db->sql_query("INSERT INTO `".$prefix."_discord_config` (`config_name`, `config_value`) VALUES
    ('jsonurl', ''),
    ('disadmin', ''),
    ('discordlogo', '1'),
    ('showempty', '1'),
    ('discordicons', '0'),
    ('zone1', '#a2a2a2'),
    ('zone2', '#ffffff'),
    ('zone3', '#222222'),
    ('zone4', '#111111'),
    ('zone5', '#9acd32'),
    ('zone6', '#343434'),
    ('zone7', '#2c2c2c'),
    ('zone8', '#808080'),
    ('zone8b', '1');");
	echo '<br>' , PHP_EOL
    , 'Insert data into '.$prefix.'_discord_config:' , PHP_EOL;
    if($result){
	   echo'<span style="color:#008000;"><i>Success</i></span><br>' , PHP_EOL;
    }else{
	   echo'<span style="color:#FF0000;"><i>Failed</i></span><br>' , PHP_EOL;
    }
     echo '<br>' , PHP_EOL
	 , '</td>' , PHP_EOL
	 , '</tr>' , PHP_EOL
     , '<tr>' , PHP_EOL
	 , '<td style="width:100%; border:1px solid;" class="row1">'._DISCORD_COMPLETE.'<br></td>' , PHP_EOL
	 , '</tr>' , PHP_EOL
	 , '</table>' , PHP_EOL;
  }
   CloseTable();
   include("footer.php");
  }
}	

	switch($op) {
		case "discord":
			DisConfig();
		break;
		case "discordsave":
			DisSave($id, $question, $answer);
		break;		
		case "discordreset":
			DisReset($id, $question, $answer);
		break;
		case "discordinstall":
			DisInstall();
		break;
		case "discordinstall2":
			DisInstall2();
		break;
		default:
		DisConfig();
		break;
	}
} else {
	DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module ".$module_name);
}

?>