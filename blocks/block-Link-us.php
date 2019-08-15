<?php

/*=======================================================================
 Nuke-Evolution		: 	Enhanced Web Portal System
 ========================================================================
 
 Nuke-Evo Base          :		#$#BASE
 Nuke-Evo Version       :		#$#VER
 Nuke-Evo Build         :		#$#BUILD
 Nuke-Evo Patch         :		#$#PATCH
 Nuke-Evo Filename      :		#$#FILENAME
 Nuke-Evo Date          :		#$#DATE

 (c) 2007 - 2008 by DarkForgeGFX - http://www.darkforgegfx.com
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $prefix, $db, $sitename, $nukeurl;



$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us"));
$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us_config LIMIT 0,1"));
	
// if($config['fade_effect'] == 1){
// 	$settings = 'width="88" height="31" border="0" style="filter:alpha(opacity=60);-moz-opacity:0.6" onMouseOver="makevisible(this,0)" onMouseOut="makevisible(this,1)"';	
// } else {
// 	$settings = 'width="88" height="31" border="0"';	
// }

$settings = 'width="88" height="31" border="0"';
	
	if($config['marquee_direction'] == 1){ $direction = "up"; }
elseif($config['marquee_direction'] == 2){ $direction = "down"; }
elseif($config['marquee_direction'] == 3){ $direction = "left"; }
elseif($config['marquee_direction'] == 4){ $direction = "right"; }

	if ($config['button_seperate'] == 1){ $seperation ="<span style='width=100px; size=5;'><hr /></span>"; }
elseif ($config['button_seperate'] == 2){ $seperation ="<center>-------------------</center>"; }
elseif ($config['button_seperate'] == 0){ $seperation =""; }

	if($config['show_clicks'] == 1){ $clicks = "<br />(Visits ".$site_hits." )"; }
elseif($config['show_clicks'] == 0){ $clicks = ""; }

	if($config['block_height'] == 1){ $height = "100"; }
elseif($config['block_height'] == 2){ $height = "150"; }
elseif($config['block_height'] == 3){ $height = "200"; }
elseif($config['block_height'] == 4){ $height = "250"; }
elseif($config['block_height'] == 5){ $height = "300"; }

	if($config['marquee_scroll'] == 1){ $amount = 3; }
elseif($config['marquee_scroll'] == 2){ $amount = 2; }

/****[START]******************************
 [Block: Settings                        ]
******************************************/
$my_image = '<img src="'.$config['my_image'].'" alt="'.$sitename.'" title="'.$sitename.'" width="88" height="31"><br>';
$linkus_settings = '<a href="'.$nukeurl.'" target="_blank"><img src="'.$config['my_image'].'" alt="'.$sitename.'" title="'.$sitename.'" width="88" height="31"></a><br>';
/****[END]********************************
 [Block: Settings                        ]
******************************************/

$content .= '<center>'.$my_image.'</center><br />';
$content .= '<div class="acenter">';
$content .= '<span class="content"><textarea name="text" rows="3" cols="15">'.$linkus_settings.'</textarea></span>';
$content .= '<br /><br />';
$content .= '<a href="modules.php?name=Link_Us">View All Buttons</a><br />';

if($config['user_submit'] == 1){ $content .= '<a href="modules.php?name=Link_Us&op=submitbutton">Submit Button</a><br />'; }


$content .= '<hr noshade>';


if($config['marquee'] == 1){
$content .= "<marquee direction='".$direction."' scrollamount='".$amount."' height='".$height."' onMouseover='this.stop()' onMouseout='this.start()'>";
}

$result = $db->sql_query("SELECT `id`, `site_name`, `site_url`, `site_image`, `site_hits` FROM ".$prefix."_link_us WHERE `site_status` = '1' AND `button_type`='1' OR `button_type`='3' ORDER BY id DESC");
while (list($id, $site_name, $site_url, $site_image, $site_hits) = $db->sql_fetchrow($result)) {

$content .= "<br /><center><a href='modules.php?name=Link_Us&amp;op=visit&amp;id=$id' target='_blank'><img src='".$site_image."' ".$settings." title='".$site_name."' /></a>";

	if($config['show_clicks'] == 1){$clicks = "<br />(Clicks ".$site_hits." )";}
elseif($config['show_clicks'] == 0){$clicks = "";}

$content .= "".$clicks."";
$content .= "<br>".$seperation."</center>";}

if($config['marquee'] == 1){
$content .= "</marquee>";
}
$content .= '</div>';


?>
