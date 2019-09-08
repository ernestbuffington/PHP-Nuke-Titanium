<?php

/*
	Author: phpbb.com
	Author Email: support@phpbb.com
	Copyright Header: Module Copyright © Information
	Module Description: Display's all registered user's.
	Module Name: Members List	
	Module Version: 1.36.2.10
	Modifications: Lonestar (http://lonestar-modules.com)	
*/

/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              memberlist.php
 *                            -------------------
 *   begin                : Friday, May 11, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: memberlist.php,v 1.36.2.10 2004/07/11 16:46:15 acydburn Exp $
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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/11/2005
      Memberlist Find User                     v1.0.0       07/06/2005
      Online/Offline/Hidden (Selection Order)  v1.0.0       08/21/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
	  Member Country Flags                     v2.0.7
	  Birthdays                                v3.0.0
 ************************************************************************/



if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
require(NUKE_FORUMS_DIR.'/nukebb.php');

define('IN_PHPBB', true);
include($phpbb_root_path.'extension.inc');
include($phpbb_root_path.'common.'.$phpEx);

# Start session management
$userdata = session_pagestart($user_ip, PAGE_VIEWMEMBERS);
init_userprefs($userdata);

$pageroot       = (!empty($HTTP_GET_VARS['page'])) ? $HTTP_GET_VARS['page'] : 1;
$page           = (isset($pageroot)) ? intval($pageroot) : 1;	
$calc           = $board_config['topics_per_page'] * $page;
$start          = $calc - $board_config['topics_per_page'];

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
else
	$mode = 'joined';

if(isset($HTTP_POST_VARS['order']))
	$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
else if(isset($HTTP_GET_VARS['order']))
	$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
else
	$sort_order = 'ASC';

$page_title = $lang['Memberlist'];
include(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(array(
	'body' => 'memberlist_body.tpl')
);

$template->assign_vars(array(
	'L_PAGE_TITLE' 			=> $lang['Memberlist'],
	'L_SELECT_SORT_METHOD' 	=> $lang['Select_sort_method'],
	'L_EMAIL' 				=> $lang['Email'],
	'L_WEBSITE' 			=> $lang['Website'],
	'L_FROM' 				=> $lang['Location'],
	'L_ORDER' 				=> $lang['Order'],
	'L_LOOK_UP' 			=> $lang['Look_up_User'],
	'L_FIND_USERNAME' 		=> $lang['Find_username'],
	'U_SEARCH_USER' 		=> "modules.php?name=Forums&amp;file=search&amp;mode=searchuser&amp;popup=1", // modules.php?name=Forums&file=search&search_author=Lonestar
	'U_SEARCH_EXPLAIN'		=> $lang['Search_author_explain'],
	'L_GO'					=> $lang['Sort_Go'],
	'L_JOINED' 				=> $lang['Joined'],
	'L_AGE' 				=> $lang['Sort_Age'],
	'L_POSTS' 				=> $lang['Posts'],
	'L_ONLINE_STATUS' 		=> $lang['Online_status'],
	'L_LAST_VISIT' 			=> $lang['User_last_visit'],
/*****[BEGIN]******************************************
 [ Mod:    Selection Order                     v1.0.0 ]
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
	'S_MODE_SELECT' 		=> select_box('mode',$mode,array('joined' => $lang['Sort_Joined'], 'username' => $lang['Sort_Username'], 'location' => $lang['Sort_Location'], 'posts' => $lang['Sort_Posts'], 'age' => $lang['Sort_Age'], 'email' => $lang['Sort_Email'], 'website' => $lang['Sort_Website'], 'topten' => $lang['Sort_Top_Ten'], 'online' => $lang['Current_status'])),
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 [ Mod:    Selection Order                     v1.0.0 ]
 ******************************************************/
	'S_ORDER_SELECT' 		=> select_box('order',$sort_order,array('ASC' => $lang['Sort_Ascending'], 'DESC' => $lang['Sort_Descending'])),
	'S_MODE_ACTION' 		=> append_sid("memberlist.$phpEx"))
	// 'L_PM' 					=> $lang['Private_Message'])
);

//---------------------------------------------------------------------
//	SEARCH FOR USERS VIA THE ALPHABET LISTING
//---------------------------------------------------------------------
$alpha_range = array();
$alpha_letters = array();
$alpha_letters = range('A','Z');
$alpha_start = array('All','#');
$alpha_range = array_merge($alpha_start, $alpha_letters);
$i = 0;
while( $i < count($alpha_range) )
{
	if ($alpha_range[$i] != 'All') {
		$temp = ($alpha_range[$i] != '#') ? strtolower($alpha_range[$i]) : 'num';
		$alphanum_search_url = 'modules.php?name='.basename(dirname(__FILE__)).'&amp;mode=letter&amp;alphanum='.$temp;
	} else {
		$alphanum_search_url = 'modules.php?name='.basename(dirname(__FILE__));
	}

	$template->assign_block_vars('alphanumsearch', array(
		'SEARCH_SIZE' 	=> floor(100/count($alpha_range)) . '%',
		'SEARCH_TERM' 	=> $alpha_range[$i],
		'SEARCH_LINK' 	=> $alphanum_search_url)
	);
	$i++;
}
//---------------------------------------------------------------------

switch( $mode )
{
	case 'letter':
		$alphanum 	= ( isset($HTTP_POST_VARS['alphanum']) ) ? htmlspecialchars($HTTP_POST_VARS['alphanum']) : htmlspecialchars($HTTP_GET_VARS['alphanum']);
		$alphanum 	= str_replace("\'", "''", $alphanum);
		$where 		= ( $alphanum == 'num' ) ? " AND `username` NOT RLIKE '^[A-Z]' " : " AND `username` LIKE '".$alphanum."%' ";
		$order_by 	= 'user_id '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
		break;
	case 'age':
		$age_order 	= $sort_order == 'ASC' ? 'DESC' : 'ASC';
		$order_by  	= 'coalesce(user_birthday2,';
		$order_by  .= ($age_order == 'ASC') ? '99999999' : '0';
		$order_by  .= ") $age_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'joined': 		$order_by = 'user_id '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	case 'username': 	$order_by = 'username '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	case 'location': 	$order_by = 'user_from '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	case 'posts': 		$order_by = 'user_posts '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	case 'email': 		$order_by = 'user_email '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	case 'website': 	$order_by = 'user_website '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	case 'topten': 		$order_by = 'user_posts '.$sort_order.' LIMIT 10'; break;
	case 'online': 		$order_by = 'user_session_time '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	default: 			$order_by = 'user_id '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
}

$username = ( !empty($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : '';
if ( $username && isset($HTTP_POST_VARS['submituser']) )
{
//---------------------------------------------------------------------
//	SEARCH FOR A USER, USING A WILDCARD
//---------------------------------------------------------------------
	$search_author = str_replace('*', '%', trim($username));
	if( ( strpos($search_author, '%') !== false ) && ( strlen(str_replace('%', '', $search_author)) < $board_config['search_min_chars'] ) )
		$search_author = '';
//---------------------------------------------------------------------
	$sql = "SELECT username, user_id, user_posts, user_gender, user_facebook, user_birthday, birthday_display, user_regdate, user_from, user_from_flag, user_website, user_allow_viewonline, user_session_time, user_lastvisit FROM " . USERS_TABLE . " WHERE username LIKE '" . str_replace("\'", "''", $search_author) . "' AND user_id <> " . ANONYMOUS . " LIMIT 1";
    // $sql = "SELECT username, user_id, user_posts, user_gender, user_facebook, user_birthday, birthday_display, user_regdate, user_from, user_from_flag, user_website, user_allow_viewonline, user_session_time, user_lastvisit FROM " . USERS_TABLE . " WHERE username = '$username' AND user_id <> " . ANONYMOUS . " LIMIT 1";
}
else
	$sql = "SELECT username, user_id, user_posts, user_gender, user_facebook, user_birthday, birthday_display, user_regdate, user_from, user_from_flag, user_website, user_allow_viewonline, user_session_time, user_lastvisit FROM " . USERS_TABLE . " WHERE user_id <> ".ANONYMOUS."".$where." ORDER BY $order_by";

if( !($result = $db->sql_query($sql)) )
	message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);

if ( $row = $db->sql_fetchrow($result) )
{
	$i = 0;
	do
	{
		$username 			= $row['username'];
		$user_id 			= intval($row['user_id']);
		# Get the users location and flag
		$user_from 			= ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';

		// $user_flag 			= ( !empty($row['user_from_flag']) ) ? "&nbsp;<img src=\"images/flags/". $row['user_from_flag'] ."\" alt=\"". $row['user_from_flag'] ."\">&nbsp;" : '&nbsp;<img src="images/flags/blank.png" alt="">&nbsp;';
		// $user_flag 			= ( !empty($row['user_from_flag']) ) ? "&nbsp;<span class=\"countries ".str_replace('.png','',$row['user_from_flag'])."\"></span>&nbsp;" : '&nbsp;<span class="countries unknown"></span>&nbsp;';
		$user_flag 			= ( !empty($row['user_from_flag']) ) ? '&nbsp;'.get_evo_icon('countries '.str_replace('.png','',$row['user_from_flag'])).'&nbsp;' : '&nbsp;'.get_evo_icon('countries unknown').'&nbsp;';

		# Calculate the users age.
		$bday_month_day 	= floor($row['user_birthday'] / 10000);
		$bday_year_age 		= ( $row['birthday_display'] != BIRTHDAY_NONE && $row['birthday_display'] != BIRTHDAY_DATE ) ? $row['user_birthday'] - 10000*$bday_month_day : 0;
		$fudge 				= ( gmdate('md') < $bday_month_day ) ? 1 : 0;
		$age 				= ( $bday_year_age ) ? gmdate('Y')-$bday_year_age-$fudge : false;
		# Website URL
		$www 				= ( $row['user_website'] ) ? '<a href="'.$row['user_website'].'" target="_userwww">'.get_evo_icon('evo-sprite globe tooltip', $lang['Visit_website']).'</a>&nbsp;' : '';
		$joined 			= $row['user_regdate'];
		$posts 				= ( $row['user_posts'] ) ? '<a href="modules.php?name=Forums&file=search&search_author='.$username.'">'.$row['user_posts'].'</a>' : 0;
		$pm 				= '<a href="'.append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$user_id").'">'.get_evo_icon('evo-sprite mail tooltip', sprintf($lang['Send_private_message'],$username)).'</a>';
		$gender 			= (($row['user_gender'] == 0) ? '' : (($row['user_gender'] == 1) ? get_evo_icon('evo-sprite male').'&nbsp;' : get_evo_icon('evo-sprite female').'&nbsp;'));
		$facebook 			= (($row['user_facebook']) ? '<a href="https://www.facebook.com/'.$row['user_facebook'].'" target="_blank">'.get_evo_icon('evo-sprite facebook tooltip', $lang['Visit_facebook']).'</a>&nbsp;' : '');
		$last_visit 		= ($row['user_lastvisit'] == 0) ? '' : formatTimestamp($row['user_lastvisit'],'M d, Y');

		# The users current status
        if ($row['user_session_time'] >= (time()-$board_config['online_time']))
        {
            if ($row['user_allow_viewonline'])
                $online_status = '<a href="' . append_sid("viewonline.$phpEx") . '" class="tooltip" title="' . sprintf($lang['is_online'], $username) . '"' . $online_color . '>' . $lang['Online'] . '</a>';
            else if ($userdata['user_level'] == ADMIN || $userdata['user_id'] == $user_id)
                $online_status = '<em><a class="tooltip" href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_hidden'], $username) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></em>';
            else
                $online_status = '<span class="tooltip" title="'.sprintf($lang['is_offline'], $username).'"'.$offline_color.'>'.$lang['Offline'].'</span>';
        }
        else
            $online_status = '<span class="tooltip" title="'.sprintf($lang['is_offline'], $username).'"'.$offline_color.'>'.$lang['Offline'].'</span>';

        # Alternate the row class
        $row_class = ( !($i % 2) ) ? 'row2' : 'row3';
		$template->assign_block_vars('memberrow', array(
			'ROW_NUMBER' 			=> $i + ( $start + 1 ),
			'ROW_CLASS' 			=> $row_class,
			'USERNAME' 				=> UsernameColor($row['username']),
			'FROM' 					=> $user_from,
			'FLAG' 					=> $user_flag,
			'JOINED' 				=> $joined,
			'AGE' 					=> $age,
			'POSTS' 				=> $posts,
			'PM' 					=> $pm,
			'WWW' 					=> $www,
			'GENDER' 				=> $gender,
			'LAST_ACTIVE'			=> $last_visit,
			'FACEBOOK'				=> $facebook,
			'STATUS'				=> $online_status,
			'U_VIEWPROFILE' 		=> "modules.php?name=Profile&mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id")
		);
		$i++;
	} 
	while ( $row = $db->sql_fetchrow($result) );
	$db->sql_freeresult($result);
}
else
{
	$template->assign_block_vars('no_username', array(
		'NO_USER_ID_SPECIFIED' => $lang['No_user_id_specified'])
	);
}

$total_found = $db->sql_unumrows($sql);

# Generate the page numbers
$alphanum 	= ( isset($HTTP_POST_VARS['alphanum']) ) ? htmlspecialchars($HTTP_POST_VARS['alphanum']) : htmlspecialchars($HTTP_GET_VARS['alphanum']);
$where 		= ( $alphanum == 'num' ) ? " AND `username` NOT RLIKE '^[A-Z]' " : " AND `username` LIKE '".$alphanum."%' ";
$sql1 		= "SELECT count(*) AS total FROM " . USERS_TABLE . " WHERE user_id <> " . ANONYMOUS.$where;
$result1 	= $db->sql_query($sql1);
$total 		= $db->sql_fetchrow($result1);

if($total['total'] > $board_config['topics_per_page'] && $mode != 'topten' || $board_config['topics_per_page'] < 10)
{
	if(isset($pageroot))
		$page = intval($pageroot);
	else
		$page = 1;
		
	$pagination = '';
		
	$redirect = 'modules.php?name=Members_List'.(($HTTP_GET_VARS['mode']) ? '&mode=letter&alphanum='.$HTTP_GET_VARS['alphanum'] : '');
	if(isset($page))
	{			
		$totalPages = ceil($total['total'] / $board_config['topics_per_page']);
		
		if ( $totalPages == 1 )
			return '';
		
		$on_page = floor($start / $board_config['topics_per_page']) + 1;
		
		if ($totalPages > 10)
		{
			$init_page_max = ( $totalPages > 3 ) ? 3 : $totalPages;
			
			for($i = 1; $i < $init_page_max + 1; $i++)
			{
				$pagination .= ( $i == $on_page ) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>' : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
				if ( $i <  $init_page_max )
				{
					$pagination .= "&nbsp;";
				}
			}
			if ( $totalPages > 3 )
			{
				if ( $on_page > 1  && $on_page < $totalPages )
				{
					$pagination .= ( $on_page > 5 ) ? ' ... ' : '&nbsp;';
					$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
					$init_page_max = ( $on_page < $totalPages - 4 ) ? $on_page : $totalPages - 4;

					for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
					{
						$pagination .= ($i == $on_page) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>' : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
						if ( $i <  $init_page_max + 1 )
						{
							$pagination .= '&nbsp;';
						}
					}

					$pagination .= ( $on_page < $totalPages - 4 ) ? ' ... ' : '&nbsp;';
				}
				else
				{
					$pagination .= ' ... ';
				}
				for($i = $totalPages - 2; $i < $totalPages + 1; $i++)
				{
					$pagination .= ( $i == $on_page ) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>'  : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
					if( $i <  $totalPages )
					{
						$pagination .= "&nbsp;";
					}
				}		
			}
		}
		else
		{
			for($i = 1; $i < $totalPages + 1; $i++)
			{
				$pagination .= ( $i == $on_page ) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>' : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
				if ( $i <  $totalPages )
				{
					$pagination .= '&nbsp;';
				}
			}
		}

		if($page <= 1)
		{
			$pagination = '<span>'.$lang['Goto_page_prev'].'</span>&nbsp;'.$pagination.'&nbsp';
		}
		else
		{
			$j = $page - 1;
			$pagination = '<span><a href="'.$redirect.'&amp;page='.$j.'">'.$lang['Goto_page_prev'].'</a></span>&nbsp;'.$pagination.'&nbsp;';
		}
		
		if($page == $totalPages )
		{
			$pagination .= '<span>'.$lang['Goto_page_next'].'</span>';
		}
			else
		{
			$j = $page + 1;
			$pagination .= '<a href="'.$redirect.'&amp;page='.$j.'">'.$lang['Goto_page_next'].'</a>';
		}
	}

	$template->assign_block_vars('pagination', array(
		'PAGINATION'	=> $pagination,
		'TOTAL' 		=> $total_found,
		'PERPAGE'		=> $board_config['topics_per_page'])
	);
}
//---------------------------------------------------------------------

$template->pparse('body');
echo '<span style="float:right; padding-right:5px;"><a class="font-family" href="#module-copyright-popup" rel="modal:open">'.str_replace('_',' ',$name).' &#169;</a></span><br />';
include(NUKE_INCLUDE_DIR.'page_tail.php');

?>