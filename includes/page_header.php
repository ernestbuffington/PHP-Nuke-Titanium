<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
/***************************************************************************
 *                              page_header.php
 *                            -------------------
 *   update               : Tuesday, Jun 1, 2021
 *   copyright            : (C) 2021 The 86it Developers Network
 *   email                : support@86it.us
 *
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: page_header.php,v 1.106.2.24 2005/03/26 14:15:59 acydburn Exp
 ***************************************************************************/
/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/
/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       11/07/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/11/2005
      Recent Topics                            v1.2.4       06/11/2005
      Resize Posted Images                     v2.4.5       06/15/2005
      Quick Search                             v3.0.1       08/23/2005
      Ranks summarize                          v1.0.4       06/24/2005
      Staff Site                               v2.0.3       06/24/2005
      Forum Statistics                         v3.0.0       06/25/2005
      CNBYA Modifications                      v1.0.0       07/05/2005
      Disable Board Admin Override             v0.1.1       07/06/2005
      Theme Simplifications                    v1.0.0       07/19/2005
      Advanced Time Management                 v2.2.0       09/12/2005
      Hidden Status Viewing                    v1.0.0       08/21/2005
      Online Time                              v1.0.0       08/21/2005
      Suppress Popup                           v1.0.0       09/13/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
	  Multiple Ranks And Staff View            v2.0.3
	  Users of the day                         v2.1.0
	  Birthdays                                v3.0.0
	  Users Reputations Systems                v1.0.0       05/24/2009
	  Theme Simplifications (Arcade)           v1.0.0       05/29/2009
 ************************************************************************/
if (!defined('IN_PHPBB2'))
exit('ACCESS DENIED');

define('HEADER_INC', TRUE);

global $name, $sitename, $is_inline_review, $titanium_prefix, $titanium_db, $cache, $ThemeSel;

OpenTable();

# Mod: Advanced Time Management v2.2.0 START
if(!file_exists(@phpbb_realpath($phpbb2_root_path.'language/lang_'.$phpbb2_board_config['default_lang'].'/lang_adv_time.'.$phpEx)))
include_once($phpbb2_root_path . 'language/lang_english/lang_adv_time.' . $phpEx);
else
include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_adv_time.' . $phpEx);
if(($userdata['user_id'] != ANONYMOUS && $userdata['user_time_mode'] >= 4)
|| ($userdata['user_id'] == ANONYMOUS && $phpbb2_board_config['default_time_mode'] >= 4)):
    global $titanium_pc_dateTime, $HTTP_SESSION_VARS, $HTTP_GET_VARS;
    if(!isset($titanium_pc_dateTime['pc_timezoneOffset']) && !isset($HTTP_GET_VARS['pc_tzo'])):
        $phpbb2_template->assign_block_vars('switch_send_pc_dateTime', array());
		if($userdata['user_pc_timeOffsets'] != '0'):
        $phpbb2_template->assign_block_vars('switch_valid_time', array());
		endif;
	else:
        $phpbb2_template->assign_block_vars('switch_valid_time', array());
    endif;
else:
    $phpbb2_template->assign_block_vars('switch_valid_time', array());
endif;
# Mod: Advanced Time Management v2.2.0 END


# Parse and show the overall header.
$phpbb2_template->set_filenames(array(
  'overall_header' => ( empty($gen_simple_header) ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

# Generate logged in/logged out status
if($userdata['session_logged_in']):
  $u_login_logout = 'modules.php?name=Your_Account&amp;op=logout&amp;redirect=Forums';
  # Mod: Advanced Username Color v1.0.5 START
  $l_login_logout = $titanium_lang['Logout'];
  # Mod: Advanced Username Color v1.0.5 END
else:
  $u_login_logout = 'modules.php?name=Your_Account&amp;redirect=index';
  $l_login_logout = $titanium_lang['Login'];
endif;

$s_last_visit = ( $userdata['session_logged_in'] ) ? create_date($phpbb2_board_config['default_dateformat'], $userdata['user_lastvisit'], $phpbb2_board_config['board_timezone']) : '';

# Get basic (usernames + totals) online
# situation
$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';
$l_online_users = '';
if(defined('SHOW_ONLINE'))
{
   # Mod: Online Time v1.0.0 START
   $titanium_user_forum_sql = (!empty($phpbb2_forum_id)) ? "AND s.session_page = ".intval($phpbb2_forum_id) : '';
   $sql = "SELECT u.username, 
                   u.user_id, 
	 u.user_allow_viewonline, 
	            u.user_level, 
		 s.session_logged_in, 
		        s.session_ip
           
		   FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
           WHERE u.user_id = s.session_user_id
           AND s.session_time >= ".(time() - $phpbb2_board_config['online_time'])."
           AND u.user_allow_viewonline = 1
		   $titanium_user_forum_sql
           ORDER BY u.username ASC, s.session_ip ASC";
   # Mod: Online Time v1.0.0 END

   if(!($result = $titanium_db->sql_query($sql)))
   message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);

   $titanium_userlist_ary = array();
   $titanium_userlist_visible = array();

   $prev_user_id = 0;
   $prev_user_ip = $prev_session_ip = '';

   while( $row = $titanium_db->sql_fetchrow($result)):
     # User is logged in and therefor not a guest
     if($row['session_logged_in']):
       # Skip multiple sessions for one user
       if($row['user_id'] != $prev_user_id):
          # Mod: Advanced Username Color v1.0.5 START
          $row['username'] = UsernameColor($row['username']);
          # Mod: Advanced Username Color v1.0.5 END
          if($row['user_allow_viewonline']):
            $titanium_user_online_link = '<a href="'.append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=".$row['user_id']).'">'.$row['username'].'</a>';
            $logged_visible_online++;
          else:
            $titanium_user_online_link = '<a href="'.append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=".$row['user_id']).'"><i>'.$row['username'].'</i></a>';
            $logged_hidden_online++;
          endif;
          # Mod: Hidden Status Viewing v1.0.0 START
          if($row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN || $userdata['user_id'] == $row['user_id'])
          $online_userlist .= ( $online_userlist != '' ) ? ', ' . $titanium_user_online_link : $titanium_user_online_link;
          # Mod: Hidden Status Viewing v1.0.0 END
       endif;
       $prev_user_id = $row['user_id'];
     else:
       # Skip multiple sessions for one user
       if($row['session_ip'] != $prev_session_ip)
       $guests_online++;
     endif;
       $prev_session_ip = $row['session_ip'];
   endwhile;
        $titanium_db->sql_freeresult($result);

        if(empty($online_userlist))
        $online_userlist = $titanium_lang['None'];
        
        $online_userlist = ((isset($phpbb2_forum_id)) ? $titanium_lang['Browsing_forum'] : $titanium_lang['Registered_users']).' '.$online_userlist;
        $total_phpbb2_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

        if($total_phpbb2_online_users > $phpbb2_board_config['record_online_users']):
           $phpbb2_board_config['record_online_users'] = $total_phpbb2_online_users;
           $phpbb2_board_config['record_online_date'] = time();
           $sql = "UPDATE " . CONFIG_TABLE . "
                   SET config_value = '$total_phpbb2_online_users'
                   WHERE config_name = 'record_online_users'";
		   if(!$titanium_db->sql_query($sql))
           message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);

           $sql = "UPDATE ".CONFIG_TABLE."
                   SET config_value = '".$phpbb2_board_config['record_online_date']."'
                   WHERE config_name = 'record_online_date'";
           if(!$titanium_db->sql_query($sql))
           message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
           # Base: Caching System v3.0.0 START
           $cache->delete('board_config', 'config');
           # Base: Caching System v3.0.0 END
        endif;

        if($total_phpbb2_online_users == 0)
        $l_t_user_s = $titanium_lang['Online_users_zero_total'];
        elseif($total_phpbb2_online_users == 1)
        $l_t_user_s = $titanium_lang['Online_user_total'];
        else
        $l_t_user_s = $titanium_lang['Online_users_total'];

        if($logged_visible_online == 0)
        $l_r_user_s = $titanium_lang['Reg_users_zero_total'];
        elseif ( $logged_visible_online == 1 )
        $l_r_user_s = $titanium_lang['Reg_user_total'];
        else
        $l_r_user_s = $titanium_lang['Reg_users_total'];

        if($logged_hidden_online == 0)
        $l_h_user_s = $titanium_lang['Hidden_users_zero_total'];
        elseif($logged_hidden_online == 1)
        $l_h_user_s = $titanium_lang['Hidden_user_total'];
        else
        $l_h_user_s = $titanium_lang['Hidden_users_total'];

        if($guests_online == 0)
        $l_g_user_s = $titanium_lang['Guest_users_zero_total'];
        elseif( $guests_online == 1)
        $l_g_user_s = $titanium_lang['Guest_user_total'];
        else
        $l_g_user_s = $titanium_lang['Guest_users_total'];

        $l_online_users = sprintf($l_t_user_s, $total_phpbb2_online_users);
        $l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
        $l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
        $l_online_users .= sprintf($l_g_user_s, $guests_online);
}



# Mod: Users of the day v2.1.0 START
$titanium_users_list_delay = 24;

$sql = "SELECT user_id, 
              username, 
 user_allow_viewonline, 
            user_level, 
	 user_session_time
     
	    FROM ".USERS_TABLE."
        WHERE user_id > 0
        ORDER BY IF(user_level=1,3,user_level) DESC, username ASC";

if(!($result = $titanium_db->sql_query($sql)))
message_die(GENERAL_ERROR, 'Could not obtain user/day information', '', __LINE__, __FILE__, $sql);

$day_userlist = '';

$day_users = 0;

while($row = $titanium_db->sql_fetchrow($result)):
	if($row['user_allow_viewonline']):
      # Mod: Advanced Username Color v1.0.5 START
	  $titanium_user_day_link = '<a href="'.append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=".$row['user_id']).'">'.UsernameColor($row['username']).'</a>';
      # Mod: Advanced Username Color v1.0.5 END
	else:
      # Mod: Advanced Username Color v1.0.5 START
	  $titanium_user_day_link = '<a href="'.append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=".$row['user_id']).'"><i>'.UsernameColor($row['username']).'</i></a>';
      # Mod: Advanced Username Color v1.0.5 END
	endif;
	
	if($row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN):
		if($row['user_session_time'] >= (time() - $titanium_users_list_delay * 3600 )):
			$day_userlist .= ( $day_userlist <> '' ) ? ', ' . $titanium_user_day_link : $titanium_user_day_link;
			$day_users++;
		endif;
	endif;
endwhile;

$day_userlist = sprintf($titanium_lang['day_userlist_users'], $day_users, $titanium_users_list_delay) . ' ' . $day_userlist;
# Mod: Users of the day v2.1.0 END

# Obtain number of new private messages
# if user is logged in
if(($userdata['session_logged_in']) && (empty($gen_simple_header))):
   if($userdata['user_new_privmsg']):
      $l_message_new = ( $userdata['user_new_privmsg'] == 1 ) ? $titanium_lang['New_pm'] : $titanium_lang['New_pms'];
      $l_privmsgs_text = sprintf($l_message_new, $userdata['user_new_privmsg']);
      if($userdata['user_last_privmsg'] > $userdata['user_lastvisit']):
         $sql = "UPDATE ".USERS_TABLE."
                 SET user_last_privmsg = ".$userdata['user_lastvisit']."
                 WHERE user_id = ".$userdata['user_id'];
         if(!$titanium_db->sql_query($sql))
         message_die(GENERAL_ERROR, 'Could not update private message new/read time for user', '', __LINE__, __FILE__, $sql);
         # Mod: Suppress Popup v1.0.0 START
         if(isset($_REQUEST["suppress"]))
         $suppress = 1;
         else
         $suppress = '';
         if(empty($suppress)): 
           $s_privmsg_new = 1;
           $phpbb2_icon_pm = $images['pm_new_msg'];
		 else: 
           $s_privmsg_new = 0;
           $phpbb2_icon_pm = $images['pm_new_msg'];
         endif;
         # Mod: Suppress Popup v1.0.0 END
      else:
        $s_privmsg_new = 0;
        $phpbb2_icon_pm = $images['pm_new_msg'];
      endif;
    else:
      $l_privmsgs_text = $titanium_lang['No_new_pm'];
      $s_privmsg_new = 0;
      $phpbb2_icon_pm = $images['pm_no_new_msg'];
    endif;

   if($userdata['user_unread_privmsg']):
     $l_message_unread = ( $userdata['user_unread_privmsg'] == 1 ) ? $titanium_lang['Unread_pm'] : $titanium_lang['Unread_pms'];
     $l_privmsgs_text_unread = sprintf($l_message_unread, $userdata['user_unread_privmsg']);
   else:
     $l_privmsgs_text_unread = $titanium_lang['No_unread_pm'];
   endif;

else:
  $phpbb2_icon_pm = $images['pm_no_new_msg'];
  $l_privmsgs_text = $titanium_lang['Login_check_pm'];
  $l_privmsgs_text_unread = '';
  $s_privmsg_new = 0;
endif;

# Generate HTML required for Mozilla Navigation bar
if(!isset($titanium_nav_links))
$titanium_nav_links = array();

$titanium_nav_links_html = '';

$nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";

  while(list($nav_item, $nav_array) = @each($titanium_nav_links)):
    if(!empty($nav_array['url'])):
      $titanium_nav_links_html .= sprintf($nav_link_proto, $nav_item, append_titanium_sid($nav_array['url']), $nav_array['title']);
    else:
     # We have a nested array, used for items like <link rel='chapter'> that can occur more than once.
     while( list(,$nested_array) = each($nav_array)):
       $titanium_nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
     endwhile;
    endif;
  endwhile;

# Mod: Online/Offline/Hidden v2.2.7 START
$online_color = ' style="color: #' . $theme['online_color'] . '"';
$offline_color = ' style="color: #' . $theme['offline_color'] . '"';
$hidden_color = ' style="color: #' . $theme['hidden_color'] . '"';
# Mod: Online/Offline/Hidden v2.2.7 END

# Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $phpbb2_board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) 
? $titanium_lang[sprintf('%.1f', $phpbb2_board_config['board_timezone'])] : $titanium_lang[number_format($phpbb2_board_config['board_timezone'])];

# Mod: Advanced Username Color v1.0.5 START
$phpbb2_template->assign_block_vars('colors',array(
    'GROUPS'    => substr(trim(GetColorGroups()), 0, -1))
);
# Mod: Advanced Username Color v1.0.5 END

# Mod: Quick Search v3.0.1 START
$sql = "SELECT * FROM ".QUICKSEARCH_TABLE."
        ORDER BY search_name";

if(!$result = $titanium_db->sql_query($sql))
message_die(GENERAL_ERROR, "Couldn't obtain quick search data", "", __LINE__, __FILE__, $sql);

$search_count = $titanium_db->sql_numrows($result);
$search_rows = array();
$search_rows = $titanium_db->sql_fetchrowset($result);
$titanium_db->sql_freeresult($result);
$search_list = '<option value="forum_search" selected="selected">'.$phpbb2_board_config['sitename'].'</option>';
$checkSearch = '';

# First Search Entry
if($search_count != ''):
    $search_name = $search_rows[0]['search_name'];
    $search_url1 = $search_rows[0]['search_url1'];
    $search_url2 = $search_rows[0]['search_url2'];
    $search_list .= '<option value="' . $search_name . '">' . $search_name . '</option>';
    # checkSearch() function, adapted from Smartor's ezPortal
    $checkSearch .= "if (document.search_block.site_search.value == '$search_name')
         {
            window.open('$search_url1' + document.search_block.search_keywords.value + '$search_url2', '_$search_name', '');
            return false;
         }\n";
endif;

# Start from Second Entry
for($i = 1; $i < $search_count; $i++):
    $search_name = $search_rows[$i]['search_name'];
    $search_url1 = $search_rows[$i]['search_url1'];
    $search_url2 = $search_rows[$i]['search_url2'];
    $search_list .= '<option value="' . $search_name . '">' . $search_name . '</option>';
    # checkSearch() function, adapated from Smartor's ezPortal
    $checkSearch .= "else if (document.search_block.site_search.value == '$search_name')
         {
            window.open('$search_url1' + document.search_block.search_keywords.value + '$search_url2', '_$search_name', '');
            return false;
         }\n";
endfor;

# Set $l_advanced_forum_search variable
$l_advanced_forum_search = sprintf($titanium_lang['Forum_advanced_search'], $phpbb2_board_config['sitename']);

# Is Quick Search enabled? If so, assign our vars for the template.
if($phpbb2_board_config['quick_search_enable'] == 1):
    $phpbb2_template->assign_block_vars('switch_quick_search', array(
        'L_QUICK_SEARCH_FOR' => $titanium_lang['Quick_search_for'],
        'L_QUICK_SEARCH_AT' => $titanium_lang['Quick_search_at'],
        'L_ADVANCED_FORUM_SEARCH' => $l_advanced_forum_search,
        'CHECKSEARCH' => $checkSearch,
        'SEARCHLIST' => $search_list)
    );
endif;
# Mod: Quick Search v3.0.1 END

# Mod: Advanced Security Code Control v1.0.0 START
$gfxchk = array(2,4,5,7);
$gfx = "<br />".security_code($gfxchk, 'small')."<br />";
# Mod: Advanced Security Code Control v1.0.0 END

# Mod: Advanced Time Management v2.2.0 START
if($userdata['user_id'] != ANONYMOUS):
  switch($userdata['user_time_mode']):
     case MANUAL_DST:
     $time_message = sprintf($titanium_lang['All_times'], $l_timezone) . $titanium_lang['dst_enabled_mode'];
     break;
     case SERVER_SWITCH:
     $time_message = sprintf($titanium_lang['All_times'], $l_timezone);
     if(date('I',time()))
     $time_message = $time_message.$titanium_lang['dst_enabled_mode'];
     break;
     case FULL_SERVER:
     $time_message = $titanium_lang['full_server_mode'];
     break;
     case SERVER_PC:
     $time_message = $titanium_lang['server_pc_mode'];
     break;
     case FULL_PC:
     $time_message = $titanium_lang['full_pc_mode'];
     break;
     default:
     $time_message = sprintf($titanium_lang['All_times'], $l_timezone);
     break;
  endswitch;
else:
    switch($phpbb2_board_config['default_time_mode']):
        case MANUAL_DST:
        $time_message = sprintf($titanium_lang['All_times'], $l_timezone) . $titanium_lang['dst_enabled_mode'];
        break;
        case SERVER_SWITCH:
        $time_message = sprintf($titanium_lang['All_times'], $l_timezone);
        if(date('I', time()))
        $time_message = $time_message.$titanium_lang['dst_enabled_mode'];
        break;
        case FULL_SERVER:
        $time_message = $titanium_lang['full_server_mode'];
        break;
        case SERVER_PC:
        $time_message = $titanium_lang['server_pc_mode'];
        break;
        case FULL_PC:
        $time_message = $titanium_lang['full_pc_mode'];
        break;
        default:
        $time_message = sprintf($titanium_lang['All_times'], $l_timezone);
        break;
    endswitch;
endif;

$time_message = str_replace('GMT', 'UTC', $time_message);
$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($phpbb2_board_config['script_path']));
$server_name = trim($phpbb2_board_config['server_name']);
$server_protocol = ($phpbb2_board_config['cookie_secure']) ? 'https://' : 'http://';
$server_port = ($phpbb2_board_config['server_port'] <> 80) ? ':'.trim($phpbb2_board_config['server_port']).'/' : '/';
$server_url = $server_protocol.$server_name.$server_port."modules.php?name=Forums";
# Mod: Advanced Time Management v2.2.0 END

# The following assigns all _common_ variables that may be used at any point
# in a template.
if(!isset($phpbb2_page_title)) 
$phpbb2_page_title = basename(dirname(__FILE__));

if(!isset($day_userlist)) 
$day_userlist = '';

$phpbb2_template->assign_vars(array(
        'THEME_NAME' => $ThemeSel,
        'SITENAME' => $phpbb2_board_config['sitename'],
        'SITE_DESCRIPTION' => $phpbb2_board_config['site_desc'],
        'PAGE_TITLE' => $phpbb2_page_title,
        'LAST_VISIT_DATE' => sprintf($titanium_lang['You_last_visit'], $s_last_visit),
        'CURRENT_TIME' => sprintf($titanium_lang['Current_time'], create_date($phpbb2_board_config['default_dateformat'], time(), $phpbb2_board_config['board_timezone'])),
        'TOTAL_USERS_ONLINE' => $l_online_users,
        'LOGGED_IN_USER_LIST' => $online_userlist,
        
		# Mod: Users of the day v2.1.0 START
	    'USERS_OF_THE_DAY_LIST' => $day_userlist,
		# Mod: Users of the day v2.1.0 END

        'RECORD_USERS' => sprintf($titanium_lang['Record_online_users'], 
		                  $phpbb2_board_config['record_online_users'], 
			   create_date($phpbb2_board_config['default_dateformat'], 
			               $phpbb2_board_config['record_online_date'], 
						     $phpbb2_board_config['board_timezone'])),
        
		'PRIVATE_MESSAGE_INFO' => $l_privmsgs_text,
        'PRIVATE_MESSAGE_INFO_UNREAD' => $l_privmsgs_text_unread,
        'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,
        'PRIVMSG_IMG' => $phpbb2_icon_pm,
        
		# Mod: Disable Board Admin Override v0.1.1 START
        'L_Board_Currently_Disabled' => $titanium_lang['Board_Currently_Disabled'],
		# Mod: Disable Board Admin Override v0.1.1 END

        'L_USERNAME' => $titanium_lang['Username'],
        'L_PASSWORD' => $titanium_lang['Password'],
        'L_LOGIN_LOGOUT' => $l_login_logout,
        'L_LOGIN' => $titanium_lang['Login'],
        'L_LOG_ME_IN' => $titanium_lang['Log_me_in'],
        'L_AUTO_LOGIN' => $titanium_lang['Log_me_in'],

		'L_INDEX' => sprintf($titanium_lang['Forum_Index'], $phpbb2_board_config['sitename']),
	    'L_INDEXHOME' => $titanium_lang['Home_Index'],'index.php',

        'L_REGISTER' => $titanium_lang['Register'],
        'L_PROFILE' => $titanium_lang['Edit_profile'],
        'L_SEARCH' => $titanium_lang['Search'],
        'L_PRIVATEMSGS' => $titanium_lang['Private_Messages'],
        'L_WHO_IS_ONLINE' => $titanium_lang['Who_is_Online'],
        'L_MEMBERLIST' => $titanium_lang['Memberlist'],
        'L_FAQ' => $titanium_lang['FAQ'],
        'L_LEGEND' => $titanium_lang['Legend'],
        
		# Mod: Forum Statistics v3.0.0 START
        'L_STATISTICS' => $titanium_lang ['Statistics'],
		# Mod: Forum Statistics v3.0.0 END

        'L_USERGROUPS' => $titanium_lang['Usergroups'],
        'L_SEARCH_NEW' => $titanium_lang['Search_new'],
        'L_SEARCH_UNANSWERED' => $titanium_lang['Search_unanswered'],
        'L_SEARCH_SELF' => $titanium_lang['Search_your_posts'],
        'L_WHOSONLINE_ADMIN' => sprintf($titanium_lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
        'L_WHOSONLINE_MOD' => sprintf($titanium_lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),
        
		# Mod: Resize Posted Images v2.4.5 START
        'IMAGE_RESIZE_WIDTH' => $phpbb2_board_config['image_resize_width'],
        'IMAGE_RESIZE_HEIGHT' => $phpbb2_board_config['image_resize_height'],
		# Mod: Resize Posted Images v2.4.5 END

        # Base: Recent Topics v1.2.4 START
        'U_RECENT' => append_titanium_sid("recent.$phpEx"),
        'L_RECENT' => $titanium_lang['Recent_topics'],
        # Base: Recent Topics v1.2.4 END

        'U_SEARCH_UNANSWERED' => append_titanium_sid('search.'.$phpEx.'?search_id=unanswered'),
        'U_SEARCH_SELF' => append_titanium_sid('search.'.$phpEx.'?search_id=egosearch'),
        'U_SEARCH_NEW' => append_titanium_sid('search.'.$phpEx.'?search_id=newposts'),
		'U_INDEX' => append_titanium_sid('index.'.$phpEx),

        # Home Index Mod START
		'U_HINDEX' => titanium_home_sid('index.'.$phpEx),
        # Home Index Mod END
	
		'U_REGISTER' => append_titanium_sid('profile.'.$phpEx.'?mode=register'),
        'U_PROFILE' => append_titanium_sid('profile.'.$phpEx.'?mode=editprofile'),
        'U_PRIVATEMSGS' => append_titanium_sid('privmsg.'.$phpEx.'?folder=inbox'),
        'U_PRIVATEMSGS_POPUP' => append_titanium_sid('privmsg.'.$phpEx.'?mode=newpm&popup=1',true),
        
		# Mod: Birthdays v3.0.0 START
		'U_BIRTHDAYS_POPUP' => append_titanium_sid('profile.'.$phpEx.'?mode=birthday_popup=1',true),
		# Mod: Birthdays v3.0.0 END
		
        'U_SEARCH' => append_titanium_sid('search.'.$phpEx),
        'U_MEMBERLIST' => append_titanium_sid('memberlist.'.$phpEx),
        'U_MODCP' => append_titanium_sid('modcp.'.$phpEx),
        'U_FAQ' => append_titanium_sid('faq.'.$phpEx),
        
		# Mod: Forum Statistics v3.0.0 START
        'U_STATISTICS' => append_titanium_sid('statistics.'.$phpEx),
		# Mod: Forum Statistics v3.0.0 END

        'U_VIEWONLINE' => append_titanium_sid('viewonline.'.$phpEx),
        'U_LOGIN_LOGOUT' => append_titanium_sid($u_login_logout),
        'U_MEMBERSLIST' => append_titanium_sid('memberlist.'.$phpEx),
        'U_GROUP_CP' => append_titanium_sid('groupcp.'.$phpEx),
        
		# Mod: Users Reputations Systems v1.0.0 START
        'L_REPUTATION' => $titanium_lang['Reputation'],
        'U_REPUTATION' => append_titanium_sid('reputation.'.$phpEx),
		# Mod: Users Reputations Systems v1.0.0 END

        # Mod: Multiple Ranks And Staff View v2.0.3 START
		'L_RANKS' => $titanium_lang['Rank_Header'],
		'L_STAFF' => $titanium_lang['Staff'],
		'U_RANKS' => append_titanium_sid('ranks.' . $phpEx),
		'U_STAFF' => append_titanium_sid('memberlist.' . $phpEx . '?mode=staff'),
        # Mod: Multiple Ranks And Staff View v2.0.3 END

        # Mod: Advanced Time Management v2.2.0 START
        'U_SELF' => $server_url,
        # Mod: Advanced Time Management v2.2.0 END

        # Mod: Staff Site v2.0.3 START
        'U_STAFF' => append_titanium_sid('staff.'.$phpEx),
        'L_STAFF' => $titanium_lang['Staff'],
        # Mod: Staff Site v2.0.3 END

        'S_CONTENT_DIRECTION' => $titanium_lang['DIRECTION'],
        'S_CONTENT_ENCODING' => $titanium_lang['ENCODING'],
        'S_CONTENT_DIR_LEFT' => $titanium_lang['LEFT'],
        'S_CONTENT_DIR_RIGHT' => $titanium_lang['RIGHT'],

        # Mod: Advanced Time Management v2.2.0 START
        'S_TIMEZONE' => $time_message,
        # Mod: Advanced Time Management v2.2.0 END

        # Mod: CNBYA Modifications v1.0.0 START
        'S_LOGIN_ACTION' => 'modules.php?name=Your_Account',
        'GFX' => $gfx,
        # Mod: CNBYA Modifications v1.0.0 END

        'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
        'T_BODY_BACKGROUND' => $theme['body_background'],
        'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
        'T_BODY_TEXT' => '#'.$theme['body_text'],
        'T_BODY_LINK' => '#'.$theme['body_link'],
        'T_BODY_VLINK' => '#'.$theme['body_vlink'],
        'T_BODY_ALINK' => '#'.$theme['body_alink'],
        'T_BODY_HLINK' => '#'.$theme['body_hlink'],
        'T_TR_COLOR1' => '#'.$theme['tr_color1'],
        'T_TR_COLOR2' => '#'.$theme['tr_color2'],
        'T_TR_COLOR3' => '#'.$theme['tr_color3'],
        'T_TR_CLASS1' => $theme['tr_class1'],
        'T_TR_CLASS2' => $theme['tr_class2'],
        'T_TR_CLASS3' => $theme['tr_class3'],
        'T_TH_COLOR1' => '#'.$theme['th_color1'],
        'T_TH_COLOR2' => '#'.$theme['th_color2'],
        'T_TH_COLOR3' => '#'.$theme['th_color3'],
        'T_TH_CLASS1' => $theme['th_class1'],
        'T_TH_CLASS2' => $theme['th_class2'],
        'T_TH_CLASS3' => $theme['th_class3'],
        'T_TD_COLOR1' => '#'.$theme['td_color1'],
        'T_TD_COLOR2' => '#'.$theme['td_color2'],
        'T_TD_COLOR3' => '#'.$theme['td_color3'],
        'T_TD_CLASS1' => $theme['td_class1'],
        'T_TD_CLASS2' => $theme['td_class2'],
        'T_TD_CLASS3' => $theme['td_class3'],
        'T_FONTFACE1' => $theme['fontface1'],
        'T_FONTFACE2' => $theme['fontface2'],
        'T_FONTFACE3' => $theme['fontface3'],
        'T_FONTSIZE1' => $theme['fontsize1'],
        'T_FONTSIZE2' => $theme['fontsize2'],
        'T_FONTSIZE3' => $theme['fontsize3'],
        'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
        'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
        'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
        'T_SPAN_CLASS1' => $theme['span_class1'],
        'T_SPAN_CLASS2' => $theme['span_class2'],
        'T_SPAN_CLASS3' => $theme['span_class3'],

        # Mod: Online/Offline/Hidden v2.2.7 START
        # Not used, but can help you...
        'T_ONLINE_COLOR' => '#' . $theme['online_color'],
        'T_OFFLINE_COLOR' => '#' . $theme['offline_color'],
        'T_HIDDEN_COLOR' => '#' . $theme['hidden_color'],
        # Mod: Online/Offline/Hidden v2.2.7 END

        'NAV_LINKS' => $titanium_nav_links_html)
);

# Mod: Disable Board Admin Override v0.1.1 START
if($userdata['user_level'] == ADMIN): 
  if($phpbb2_board_config['board_disable'] == 1) 
  $phpbb2_template->assign_block_vars('boarddisabled', array());
endif;
# Mod: Disable Board Admin Override v0.1.1 END

# Login box?
if(!$userdata['session_logged_in']):
    $phpbb2_template->assign_block_vars('switch_user_logged_out', array());
    # Allow autologin?
    if(!isset($phpbb2_board_config['allow_autologin']) || $phpbb2_board_config['allow_autologin']):
        $phpbb2_template->assign_block_vars('switch_allow_autologin', array());
        $phpbb2_template->assign_block_vars('switch_user_logged_out.switch_allow_autologin', array());
    endif;
else:
    $phpbb2_template->assign_block_vars('switch_user_logged_in', array());
    if(!empty($userdata['user_popup_pm']))
    $phpbb2_template->assign_block_vars('switch_enable_pm_popup', array());
endif;

# Mod: Birthdays v3.0.0 START
$current_time = time() + (3600 * $phpbb2_board_config['board_timezone']);
$phpbb2_starttime = ( $phpbb2_board_config['bday_lookahead'] > 0 ) ? strtotime('-'.$phpbb2_board_config['bday_lookahead'].' day') : $current_time;
# the greeting will be sent up to seven days after the birthday
if($userdata['birthday_greeting'] != 0 && ($userdata['user_next_birthday'] < gmdate('Y',$current_time)+1) 
&& $userdata['user_birthday'] >= gmdate('md0000',$phpbb2_starttime) && $userdata['user_birthday'] <= gmdate('md9999',$current_time)):
   $sql = "UPDATE ".USERS_TABLE. "
		   SET user_next_birthday = ".(gmdate('Y',$current_time)+1)."
		   WHERE user_id = ".$userdata['user_id'];
   if(!$titanium_db->sql_query($sql))
   message_die(GENERAL_ERROR, 'Could not update birthday information', '', __LINE__, __FILE__, $sql);
   switch($userdata['birthday_greeting']):
	  case BIRTHDAY_EMAIL:
	  include('includes/emailer.'.$phpEx);
	  $emailer = new emailer($phpbb2_board_config['smtp_delivery']);
  	  $emailer->from($phpbb2_board_config['board_email']);
	  $emailer->replyto($phpbb2_board_config['board_email']);
 	  $emailer->use_template('user_birthday',stripslashes($userdata['user_lang']));
	  $emailer->set_subject($titanium_lang['View_Birthdays']);
	  $emailer->email_address($userdata['user_email']);
	  $emailer->assign_vars(array(
	  'SITENAME' => $phpbb2_board_config['sitename'],
	  'EMAIL_SIG' => (!empty($phpbb2_board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $phpbb2_board_config['board_email_sig']) : '')
	  );
	  $emailer->send();
	  $emailer->reset();
	  break;
	  case BIRTHDAY_PM:
	  # PM support is not currently enabled.
	  break;
	  case BIRTHDAY_POPUP:
	  $phpbb2_template->assign_block_vars('switch_birthday_popup',array());
	endswitch;
endif;
# Mod: Birthdays v3.0.0 END

# Add no-cache control for cookies if they are set
# $c_no_cache = (isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'].'_sid']) || isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'].'_data'])) ? 'no-cache="set-cookie", ' : '';

# Work around for "current" Apache 2 + PHP module which seems to not
# cope with private cache control setting
if (!empty($HTTP_SERVER_VARS['SERVER_SOFTWARE']) && strstr($HTTP_SERVER_VARS['SERVER_SOFTWARE'], 'Apache/2'))
header ('Cache-Control: no-cache, pre-check=0, post-check=0');
else
header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');

header ('Expires: 0');
header ('Pragma: no-cache');

# Mod: Ranks summarize v1.0.4 START
    $phpbb2_template->assign_vars(array(
        'I_RANKS' => '<img src="' . $images['Ranks'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Ranks'] . '" hspace="3" />',
        'U_RANKS' => append_titanium_sid("ranks.$phpEx"),
        'L_RANKS' => $titanium_lang['Ranks'],

        # Mod: Theme Simplifications v1.0.0 START
        'I_MINI_INDEX' => '<img src="' . $images['Mini_Index'] . '" width="12" height="13" border="0" alt="' . $phpbb2_board_config['sitename'] . ' Forum Index" hspace="3" />',
        'L_MINI_INDEX' => $titanium_lang['Mini_Index'],
        'I_MINI_FAQ' => '<img src="' . $images['Mini_Faq'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['FAQ'] . '" hspace="3" />',
        'I_MINI_SEARCH' => '<img src="' . $images['Mini_Search'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Search'] . '" hspace="3" />',
        'I_MINI_USERGROUPS' => '<img src="' . $images['Mini_Usergroups'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Usergroups'] . '" hspace="3" />',
        'I_MINI_PROFILE' => '<img src="' . $images['Mini_Profile'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Profile'] . '" hspace="3" />',
        'I_MINI_MEMBERLIST' => '<img src="' . $images['Mini_Memberlist'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Memberlist'] . '" hspace="3" />',
        'I_MINI_PRIVATEMSGS' => '<img src="' . $images['Mini_Private_Messages'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Private_Messages'] . '" hspace="3" />',
        'I_STAFF' => '<img src="' . $images['Staff'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Staff'] . '" hspace="3" />',
        'I_RULES' => '<img src="' . $images['Rules'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Rules'] . '" hspace="3" />',
        'U_RULES' => append_titanium_sid("rules.$phpEx"),
        'L_RULES' => $titanium_lang['Rules'],
        'I_STATISTICS' => '<img src="' . $images['Statistics'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Statistics'] . '" hspace="3" />',
        'I_MINI_LOGIN_LOGOUT' => '<img src="' . $images['Mini_Login_Logout'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['Login_Logout'] . '" hspace="3" />',
        
		# Mod: Theme Simplifications (Arcade) v1.0.0 START
        'I_MINI_ARCADE' => '<img src="' . $images['Mini_Arcade'] . '" width="12" height="13" border="0" alt="' . $titanium_lang['lib_arcade'] . '" hspace="3" />',
        'U_ARCADE' => append_titanium_sid("arcade.$phpEx"),
        'L_ARCADE' => $titanium_lang['lib_arcade'],
		# Mod: Theme Simplifications (Arcade) v1.0.0 END
        # Mod: Theme Simplifications v1.0.0 END

        )

    );
# Mod: Ranks summarize v1.0.4 END

$phpbb2_template->pparse('overall_header');

# Mod: Disable Board Admin Override v0.1.1 START
# Mod: Disable Board Message v1.0.0 START
if($userdata['user_level'] != ADMIN && $phpbb2_board_config['board_disable'] && !defined("IN_ADMIN") && !defined("IN_LOGIN")):
    if($phpbb2_board_config['board_disable_msg'] != "")
    message_die(GENERAL_MESSAGE, $phpbb2_board_config['board_disable_msg'], 'Information');
    else
    message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
else:
    if($userdata['user_level'] == ADMIN && $phpbb2_board_config['board_disable_adminview'] != '1' && $phpbb2_board_config['board_disable'] && !defined("IN_ADMIN") && !defined("IN_LOGIN")):
      if($phpbb2_board_config['board_disable_msg'] != "")
      message_die(GENERAL_MESSAGE, $phpbb2_board_config['board_disable_msg'], 'Information');
      else
      message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
    endif;
endif;
# Mod: Disable Board Admin Override v0.1.1 END
# Mod: Disable Board Message v1.0.0 END
?>
