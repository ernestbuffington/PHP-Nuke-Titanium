<?php # JOHN 3:16 #
/***************************************************************************
 *                            viewtopic_whoview.php 
 *                            -------------------
 *   begin                : Staurday, May 15, 2021
 *   Author               : Ernest Allen Buffington
 *   email                : ernest.buffington@gmail.com
 *   copyright            : (C) 2021 The 86it Developers Network
 *
 *   $Id: viewtopic_whoview.php, v1.0.0 05/16/2021 04:17:00 TheGhost 
 *
 *   This mod is based on the Members List and a very incomplete version
 *   of viewtopic_whoview.php. This was the case of the version found in
 *   the UK 2.0.9e version of Nuke Evolution.
 *
 *   This version is very different in terms of the fact that we are 
 *   desperatly trying to keep this framework as close to the original
 *   beloved layout of the phpBB forums as possible.
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB2', true);
$phpbb2_root_path = 'modules/Forums/';
include($phpbb2_root_path.'extension.inc');
include($phpbb2_root_path.'common.'.$phpEx);
include('header.php');

date_default_timezone_set('America/New_York');
$info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];
$current_date = "<i class=\"bi bi-calendar3\"></i>&nbsp;&nbsp;$month/$date/$year&nbsp;&nbsp;&nbsp;<i class=\"bi bi-alarm\"></i>&nbsp;$hour:$min:$sec";
$actual_time = $current_date;

# Start session management
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_TOPIC_VIEW, $nukeuser);
titanium_init_userprefs($userdata);
# End session management


# Start add - Who viewed a topic MOD
if(isset($_GET[POST_TOPIC_URL]))
$topic_id = intval($_GET[POST_TOPIC_URL]);
elseif(isset($_POST[POST_TOPIC_URL]))
$topic_id = intval($_POST[POST_TOPIC_URL]);

if(!$userdata['session_logged_in']): 
	$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/",getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: "; 
	header($header_location . append_titanium_sid("login.$phpEx?redirect=topic_view_users.$phpEx&".POST_TOPIC_URL."=$topic_id", true));
	exit;
endif;

# find the forum, in which the topic are located
if(empty($topic_id))$topic_id = 0;
$sql = "SELECT f.forum_id FROM ".TOPICS_TABLE." t, ".FORUMS_TABLE." f WHERE f.forum_id = t.forum_id AND t.topic_id=$topic_id";
if(!($result = $titanium_db->sql_query($sql)))
message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
if(!($forum_topic_data = $titanium_db->sql_fetchrow($result)))
message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
$phpbb2_forum_id = $forum_topic_data['forum_id'];
list($topic_title) = $titanium_db->sql_ufetchrow("SELECT `topic_title` FROM `".TOPICS_TABLE."` WHERE `topic_id`=$topic_id", SQL_NUM);
$topic_link = '<a href="modules.php?name=Forums&file=viewtopic&t='.$topic_id.'" target="_self">'.$topic_title.'</a>';
# End add - Who viewed a topic MOD

$phpbb2_start = (isset($_GET['start'])) ? intval($_GET['start']) : 0;

if(isset($_GET['mode']) || isset($_POST['mode'])):
$mode = ( isset($_POST['mode']) ) ? htmlspecialchars($_POST['mode']) : htmlspecialchars($_GET['mode']);
else:
$mode = 'joined';
endif;

if(isset($_POST['order'])):
$sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
elseif(isset($_GET['order'])):
$sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
else:
$sort_order = 'ASC';
endif;

# Memberlist sorting
$mode_types_text = array($titanium_lang['Sort_User_ID'], $titanium_lang['Sort_Username'], $titanium_lang['Sort_Joined'], $titanium_lang['Topic_time'], $titanium_lang['Topic_count']);
$mode_types = array('user_id', 'username', 'joindate', 'topic_time', 'topic_count');
$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++):
$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
$select_sort_mode .= '<option value="'.$mode_types[$i].'"'.$selected.'>'.$mode_types_text[$i].'</option>';
endfor;
$select_sort_mode .= '</select>';
$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
$select_sort_order .= '<option value="ASC" selected="selected">'.$titanium_lang['Sort_Ascending'].'</option><option value="DESC">'.$titanium_lang['Sort_Descending'].'</option>';
else
$select_sort_order .= '<option value="ASC">'.$titanium_lang['Sort_Ascending'].'</option><option value="DESC" selected="selected">'.$titanium_lang['Sort_Descending'].'</option>';
$select_sort_order .= '</select>';
$select_sort_order .= '<input type="hidden" name="'.POST_TOPIC_URL.'" value="'.$topic_id.'"/>';

# Generate page
$phpbb2_page_title = $titanium_lang['Memberlist'];
include("includes/page_header.php");

$phpbb2_template->set_filenames(array(
	'body' => 'viewtopic_whoview.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$phpbb2_template->assign_vars(
	array(
	    'L_ACTUAL_TIME' => $actual_time,
	    'L_LAST_VIEWED_TOPIC_LINK_PREFIX' => $titanium_lang['WhoIsViewingThisTopic'],
	    'L_LAST_VIEWED_TOPIC_LINK' => $topic_link,
		'L_LAST_VIEWED_TITLE' => $titanium_lang['WhoViewedMemberlist'],
		'L_LAST_VIEWED' => $titanium_lang['Topic_time'],
		'L_TOPIC_COUNT' => $titanium_lang['Topic_count'],
		'L_AGE' => $titanium_lang['Sort_Age'], 
		'S_MODE_SELECT' => $select_sort_mode,
		'S_ORDER_SELECT' => $select_sort_order,
		'S_MODE_ACTION' => append_titanium_sid("viewtopic_whoview.$phpEx")
	)
);

switch($mode):
 case 'joined':
  $order_by = "u.user_regdate $sort_order LIMIT $phpbb2_start, ".$phpbb2_board_config['topics_per_page'];
	break;
  case 'username':
   $order_by = "u.username $sort_order LIMIT $phpbb2_start, ".$phpbb2_board_config['topics_per_page'];
	 break;
  case 'user_id':
   $order_by = "u.user_id $sort_order LIMIT $phpbb2_start, ".$phpbb2_board_config['topics_per_page'];
	break;
  case 'topic_count':
   $order_by = "tv.view_count $sort_order LIMIT $phpbb2_start, ".$phpbb2_board_config['topics_per_page'];
	break;
  case 'topic_time':
   $order_by = "tv.view_time $sort_order LIMIT $phpbb2_start, ".$phpbb2_board_config['topics_per_page'];
	break;
  default:
   $order_by = "u.user_id $sort_order LIMIT $phpbb2_start, ".$phpbb2_board_config['topics_per_page'];
	break;
endswitch;

$sql = "SELECT u.username, 
                u.user_id, 
		 u.user_viewemail, 
		     u.user_email, 
			  u.user_from, 
		 u.user_from_flag, 
		   u.user_website, 
		    u.user_avatar, 
	   u.user_avatar_type, 
	   u.user_allowavatar, 
  u.user_allow_viewonline, 
      u.user_session_time, 
	      u.user_facebook, 
		     tv.view_time, 
			tv.view_count
	
	FROM ".USERS_TABLE." u, ".TOPIC_VIEW_TABLE." tv WHERE u.user_id = tv.user_id AND tv.topic_id= ".$topic_id." ORDER BY $order_by";

if(!($result = $titanium_db->sql_query($sql)))
message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);

if($row = $titanium_db->sql_fetchrow($result)):

	$i = 0;
	do
	{
		$titanium_username = $row['username'];
		$titanium_user_id = $row['user_id'];
		$titanium_user_from = ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';
		$joined	= $row['user_regdate'];
		
        /*****[BEGIN]******************************************
        [ Mod:    Forum Index Avatar Mod                 v1.0]
        ******************************************************/
        switch($row['user_avatar_type'])
        {
           case USER_AVATAR_UPLOAD:
           $current_avatar = $phpbb2_board_config['avatar_path'] . '/' . $row['user_avatar'];
           break;
           case USER_AVATAR_REMOTE:
           $current_avatar = resize_avatar($row['user_avatar']);
           break;
           case USER_AVATAR_GALLERY:
           $current_avatar = $phpbb2_board_config['avatar_gallery_path'] . '/' . (($row['user_avatar'] 
			== 'blank.gif' || $row['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $row['user_avatar']);
           break;
		}
        /*****[END]********************************************
        [ Mod:    Forum Index Avatar Mod                 v1.0]
         ******************************************************/
		
		# Get the date and time the user last viewed the topic.
		$view_time = ($row['view_time']) ? create_date($phpbb2_board_config['default_dateformat'],$row['view_time'], $phpbb2_board_config['board_timezone']) : $titanium_lang['Never_last_logon'];
		
		# Get the amount of times the user has viewed.
		$view_count	= ($row['view_count']) ? $row['view_count'] : 0;
		
		# Get the users Facebook link.
		$facebook = (($row['user_facebook']) ? '<a href="https://www.facebook.com/'.$row['user_facebook'].'" 
		target="_blank">'.get_evo_icon('evo-sprite facebook tooltip', $titanium_lang['Visit_facebook']).'</a>&nbsp;' : '');
		
		# Display the users country of origin.
		$titanium_user_flag = (!empty($row['user_from_flag'])) ? 
		'&nbsp;'.get_evo_icon('countries '.str_replace('.png','',$row['user_from_flag'])).'&nbsp;' : '&nbsp;'.get_evo_icon('countries unknown').'&nbsp;';
		
		# Send user a private message.
		$pm	= '<a href="'.append_titanium_sid("privmsg.$phpEx?mode=post&amp;".POST_USERS_URL."=$titanium_user_id").'">'.get_evo_icon('evo-sprite 
		mail tooltip', sprintf($titanium_lang['Send_private_message'],$titanium_username)).'</a>';
		
		# Website URL
		$www = ($row['user_website']) ? '<a href="'.$row['user_website'].'" target="_userwww">'.get_evo_icon('evo-sprite globe tooltip', $titanium_lang['Visit_website']).'</a>&nbsp;' : '';

       # This is broken in UK version
	   # Mod: Online/Offline/Hidden v2.2.7 START
       if($row['user_session_time'] >= (time()-$phpbb2_board_config['online_time'])):
         $theme_name = get_theme();
		 if($row['user_allow_viewonline']):
         $online_status = '<a href="'.append_titanium_sid("viewonline.$phpEx").'" title="'.sprintf($titanium_lang['is_online'],$row['username']).'"'.$online_color.'><img alt="online" src="themes/'.$theme_name.'/forums/images/status/online_bgcolor_one.gif" /></a>';
         
		 elseif($userdata['user_level'] == ADMIN || $userdata['user_id'] == $row['user_id'] ):
         $online_status = '<em><a href="'.append_titanium_sid("viewonline.$phpEx").'" title="'.sprintf($titanium_lang['is_hidden'],$profiledata['username']).'"'.$hidden_color.'>'.$titanium_lang['Hidden'].'</a></em>';
         
		 else:
         $online_status = '<span title="'.sprintf($titanium_lang['is_offline'], $row['username']).'"'.$offline_color.'><strong>'.$titanium_lang['Offline'].'</strong></span>';
         endif;

       else:
       $online_status = '<span title="'.sprintf($titanium_lang['is_offline'], $row['username']) . '"' . $offline_color . '><img alt="online" src="themes/'.$theme_name.'/forums/images/status/offline_bgcolor_one.gif" /></span>';
       endif;
       # Mod: Online/Offline/Hidden v2.2.7 END
 		if(strlen($titanium_user_from) == 6)
		$titanium_user_from = 'The InterWebs';
		 
		if (!is_admin())
        # Nobody but the admin gives a shit about Anonymous people
		if($titanium_username == 'Anonymous') 
		continue;
		
		$phpbb2_template->assign_block_vars('memberrow', array(
			'ROW_NUMBER' 	=> $i + ($_GET['start'] + 1),
			'USERNAME' 		=> UsernameColor($titanium_username),
			'FROM' 			=> $titanium_user_from,
			'FLAG'			=> $titanium_user_flag,
			'FACEBOOK'		=> $facebook,
			'VIEW_TIME' 	=> '<i class="bi bi-calendar3"></i> '.$view_time,
			'VIEW_COUNT' 	=> $view_count,
			'PROFILE' 		=> $profile,
			'CURRENT_AVATAR' => '<img class="rounded-corners-header" height="auto" width="30" src="'.$current_avatar.'">&nbsp;',
			'PM' 			=> $pm,
			'WWW' 			=> $www,
			'ONLINE_STATUS' => $online_status,
			'TOPICTITLE'    => '<font size="3">'.$topic_title.'</font>',
			'TOPICLINK'     => '<font size="3"><i class="bi bi-card-heading"></i> '.$topic_link.'</font>',
			'U_VIEWPROFILE' => append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=$titanium_user_id"))
		);

		$i++;
	}
	while($row = $titanium_db->sql_fetchrow($result));
	
endif;

if($mode != 'topten' || $phpbb2_board_config['topics_per_page'] < 10):
    # Start replacement - Who viewed a topic MOD
	$sql = "SELECT count(*) AS total
		FROM ".TOPIC_VIEW_TABLE."
		WHERE topic_id = " . $topic_id;
    # End replacement - Who viewed a topic MOD
	if(!($result = $titanium_db->sql_query($sql))):
	message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
    endif;
	if($total = $titanium_db->sql_fetchrow($result)):
	   $total_phpbb2_members = $total['total'];
       # Start replacement - Who viewed a topic MOD
       $pagination = generate_pagination("topic_view_users.$phpEx?".POST_TOPIC_URL."=$topic_id&amp;
	   mode=$mode&amp;order=$sort_order", $total_phpbb2_members, $phpbb2_board_config['topics_per_page'], $phpbb2_start). '&nbsp;';
       # End replacement - Who viewed a topic MOD
	endif;
else:
	$pagination = '&nbsp;';
	$total_phpbb2_members = 10;
endif;

$phpbb2_template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], (floor($phpbb2_start / $phpbb2_board_config['topics_per_page']) + 1), ceil($total_phpbb2_members / $phpbb2_board_config['topics_per_page'])), 
	'L_GOTO_PAGE' => $titanium_lang['Goto_page'])
);
$phpbb2_template->pparse('body');
include("includes/page_tail.$phpEx");
?>
