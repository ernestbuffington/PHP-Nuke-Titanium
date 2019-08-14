<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
 
/************************************************************************
   PHP-Nuke Titanium v3.0.0
   ======================================================================
   Copyright (c) 2019 by The PHP-Nuke Titanium Team
  
   Filename      : block-Titanium_Last_Seen.php
   Author        : Ernest Buffington / lonestar 
   Websites      : (hub.86it,us)     /(lonestar-modules.com)
   Version       : 3.0.0
   Date          : 08.13.2019 (mm.dd.yyyy)
                                                                        
   Notes         : Simple block to allow people to see who was last seen 
                 : on the website.
************************************************************************/
defined('NUKE_TITANIUM') or die('Just go away, Shit Head!');

global $db, $prefix, $userinfo;
global $evouserinfo_avatar, $board_config, $userinfo; 

$max_height = '38';
$max_width = '';

$result = $db->sql_query("SELECT * FROM `".$prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 10");

$content  = '<table border="0" cellpadding="0" cellspacing="1" class="col-12">';
while($whosbeen = $db->sql_fetchrow($result)):

	if($whosbeen['user_from_flag'] ):
	$whosbeen['user_from_flag'] = str_replace('.png','',$whosbeen['user_from_flag']);
	else:
	$whosbeen['user_from_flag'] = 'unknown';
	endif;

	if($whosbeen['user_avatar_type']):
	$whosbeen['user_avatar_type'] = str_replace('.png','',$whosbeen['user_avatar_type']);
	else:
	$whosbeen['user_avatar_type'] = '3';
	endif;

    $content .= '<td></td>';
	$content .= '<tr>';
	//$content .= '<td><span class="countries '.$whosbeen['user_from_flag'].'"></span>&nbsp;<a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.UsernameColor($whosbeen['username']).'</a></td>';
	$content .= '</tr>';
	$content .= '<tr>';
	
    if($whosbeen['user_avatar'])
    {
	   switch($whosbeen['user_avatar_type'])
	   {
		# user_allowavatar = 1
		case USER_AVATAR_UPLOAD:
			$avatar = '<td width="45px">'.( $board_config['allow_avatar_upload'] ) ? '<img style="max-height: '.$max_height.'px;" src="' . $board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" border="0" /></td>' : '</td>';
			break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
			$avatar = '<td width="45px">'.'<img style="max-height: '.$max_height.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" border="0" /></td>';
			break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
			$avatar = '<td width="45px">'. ( $board_config['allow_avatar_local'] ) ? '<img style="max-height: '.$max_height.'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.gif' || $whosbeen['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" border="0" /></td>' : '</td>';
			break;

	   }
	}
	$content .= '<td width="45px"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
        $content .= '<td><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'"><strong>'.UsernameColor($whosbeen['username']).'</strong></a></td>';
	$content .= '<td><div align="top" style="padding-left:10px;"><br />'.get_titanium_timeago($whosbeen['last_visit']).'</div></td>';
	$content .= '</tr>'; 

endwhile;
$content .= '</table>';
?>
