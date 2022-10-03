<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/11/2005
      Remote Avatar Resize                     v2.0.0       19/11/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ($popup != "1"){
    $titanium_module_name = basename(dirname(__FILE__));
    require("modules/".$titanium_module_name."/nukebb.php");
}
else
{
    $phpbb2_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB2', true);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);

$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_STAFF, $session_length);
titanium_init_userprefs($userdata);

$phpbb2_page_title = $titanium_lang['Staff'];
include('includes/page_header.'.$phpEx);

        $phpbb2_template->set_filenames(array(
                'body' => 'staff_body.tpl')
        );
$uid = (isset($userdata['user_id']) && !empty($userdata['user_id'])) ? $userdata['user_id'] : '1';

// forums
 $sql = "SELECT ug.user_id, f.forum_id, f.forum_name
           FROM (" . USER_GROUP_TABLE . " ug
           LEFT JOIN  " . USER_GROUP_TABLE . " ug2  ON ug2.user_id = " . $uid . "
           LEFT JOIN  " . AUTH_ACCESS_TABLE . " aa2 ON aa2.group_id = ug2.group_id AND aa2.auth_view = " . TRUE . ",
           " . FORUMS_TABLE . " f, " . AUTH_ACCESS_TABLE . " aa)
           WHERE aa.auth_mod = " . TRUE . "
                      AND ug.group_id = aa.group_id
                      AND f.forum_id = aa.forum_id
                      AND ( f.auth_view <= '.$auth.'
                      OR aa2.auth_view = " . TRUE . ")
           ";
/*$sql = "SELECT ug.user_id, f.forum_id, f.forum_name
           FROM ".AUTH_ACCESS_TABLE." aa, ".USER_GROUP_TABLE." ug, ".FORUMS_TABLE." f
           WHERE aa.auth_mod = " . TRUE . "
                    AND ug.group_id = aa.group_id
                      AND f.forum_id = aa.forum_id";*/
if ( !$result = $titanium_db->sql_query($sql) )
{
        message_die(GENERAL_ERROR, 'Could not query forums.', '', __LINE__, __FILE__, $sql);
}
while( $row = $titanium_db->sql_fetchrow($result) )
{
        $phpbb2_forum_id = $row['forum_id'];
        $staff2[$row['user_id']][$row['forum_id']] = '<a href='.append_titanium_sid("viewforum.$phpEx?f=$phpbb2_forum_id").' class=genmed>'.$row['forum_name'].'</a><br />';
}

//main
$sql = "SELECT * FROM ".USERS_TABLE."
           WHERE user_level >= 2
           AND user_active = ".TRUE."
           ORDER BY user_level = 3, user_level = 4";
if ( !($results = $titanium_db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not obtain user information.', '', __LINE__, __FILE__, $sql);
}
while($staff = $titanium_db->sql_fetchrow($results))
{
        if ( $staff['user_avatar'] )
        {
                switch( $staff['user_avatar_type'] )
                {
                     case USER_AVATAR_UPLOAD:
                     $avatar = ( $phpbb2_board_config['allow_avatar_upload'] ) ? '<img class="rounded-corners-forum" width="200" src="' . $phpbb2_board_config['avatar_path'] . '/' . $staff['user_avatar'] . '" border="0" />' : '';
                     break;
                    /*****[BEGIN]******************************************
                     [ Mod:     Remote Avatar Resize               v2.0.0 ]
                     ******************************************************/
                     case USER_AVATAR_REMOTE:
                     $avatar = resize_avatar($staff['user_avatar']);
                     break;
                    /*****[END]********************************************
                     [ Mod:     Remote Avatar Resize               v2.0.0 ]
                     ******************************************************/
                     case USER_AVATAR_GALLERY:
                     $avatar = ( $phpbb2_board_config['allow_avatar_local'] ) 
					 ? '<img class="rounded-corners-forum" width="200" src="' . $phpbb2_board_config['avatar_gallery_path'] . '/' . $staff['user_avatar'] . '" alt="" border="0" />' : '';
                     break;
                }
        }
        else
        {
           $avatar = '';
        }

        $lvl = $staff['user_level']-1;
        $result = $titanium_db->sql_query('SELECT group_name FROM '. AUC_TABLE .' WHERE group_id='.$lvl);
        list($group_name) = $titanium_db->sql_fetchrow($result);
        $level = GroupColor($group_name);
        $titanium_db->sql_freeresult($result);

        $level .= "<br />\n<hr>\n";

        //Groups
        $result = $titanium_db->sql_query("SELECT group_name FROM " . GROUPS_TABLE . " g LEFT JOIN " . USER_GROUP_TABLE . " ug on ug.group_id=g.group_id WHERE ug.user_id='".$staff['user_id']."' and g.group_description != 'Personal User'");
	    if ($titanium_db->sql_numrows($result) != 0) {
	        while(list($group_name) = $titanium_db->sql_fetchrow($result)) {
	            $level .= GroupColor($group_name). "<br />";
	        }
	        $titanium_db->sql_freeresult($result);
	    }


        $forums = '';
        if ( !empty($staff2[$staff['user_id']]) )
        {
                asort($staff2[$staff['user_id']]);
                $forums = implode(' ',$staff2[$staff['user_id']]);
        }
        $regdate = $staff['user_regdate'];
        $nukedate = strtotime($regdate);
        $memberdays = max(1, round( ( time() - $nukedate ) / 86400 ));
        $phpbb2_posts_per_day = $staff['user_posts'] / $memberdays;
        if ( $staff['user_posts'] != 0 )
        {
                $phpbb2_total_posts = get_db_stat('postcount');
                $percentage = ( $phpbb2_total_posts ) ? min(100, ($staff['user_posts'] / $phpbb2_total_posts) * 100) : 0;
        }
        else
        {
                $percentage = 0;
        }
        $titanium_user_id = $staff['user_id'];
        $sql = "SELECT post_time, post_id FROM ".POSTS_TABLE." WHERE poster_id = " . $titanium_user_id . " ORDER BY post_time DESC LIMIT 1";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Error getting user last post time', '', __LINE__, __FILE__, $post_time_sql);
        }
        $row = $titanium_db->sql_fetchrow($result);
        $phpbb2_last_post = ( isset($row['post_time']) ) ? '<a href="'.append_titanium_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$row[post_id]#$row[post_id]").'" class=gensmall>'.create_date($phpbb2_board_config['default_dateformat'], $row['post_time'], $phpbb2_board_config['board_timezone']).'</a>' : $titanium_lang['None'];

        $mailto = ( $phpbb2_board_config['board_email_form'] ) ? "modules.php?name=Profile&mode=email&amp;" . POST_USERS_URL .'=' . $staff['user_id'] : 'mailto:' . $staff['user_email'];
        $mail = ( $staff['user_email'] ) ? '<a href="' . $mailto . '"><img src="' . $images['icon_email'] . '" alt="' . $titanium_lang['Send_email'] . '" title="' . $titanium_lang['Send_email'] . '" border="0" /></a>' : '';

        $pmto = append_titanium_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$staff[user_id]");
        $pm = '<a href="' . $pmto . '"><img src="' . $images['icon_pm'] . '" alt="' . $titanium_lang['Send_private_message'] . '" title="' . $titanium_lang['Send_private_message'] . '" border="0" /></a>';

        $msn = ( $staff['user_msnm'] ) ? '<a href="mailto: '.$staff['user_msnm'].'"><img src="' . $images['icon_msnm'] . '" alt="' . $titanium_lang['MSNM'] . '" title="' . $titanium_lang['MSNM'] . '" border="0" /></a>' : '';
        $yim = ( $staff['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $staff['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $titanium_lang['YIM'] . '" title="' . $titanium_lang['YIM'] . '" border="0" /></a>' : '';
        $aim = ( $staff['user_aim'] ) ? '<a href="aim:goim?screenname=' . $staff['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $titanium_lang['AIM'] . '" title="' . $titanium_lang['AIM'] . '" border="0" /></a>' : '';
        $icq = ( $staff['user_icq'] ) ? '<a href="http://wwp.icq.com/scripts/contact.dll?msgto=' . $staff['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $titanium_lang['ICQ'] . '" title="' . $titanium_lang['ICQ'] . '" border="0" /></a>' : '';

        $www = ( $staff['user_website'] ) ? '<a href="' . $staff['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $titanium_lang['Visit_website'] . '" title="' . $titanium_lang['Visit_website'] . '" border="0" /></a>' : '';

        $sql = "SELECT * FROM " . RANKS_TABLE . " ORDER BY rank_special, rank_min";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
        }
        $ranksrow = array();
        while ( $row = $titanium_db->sql_fetchrow($result) )
        {
                $ranksrow[] = $row;
        }
        $titanium_db->sql_freeresult($result);

        $rank = '';
        $rank_image = '';
        if ( $staff['user_rank'] )
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $staff['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
                        {
                                $rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
                        }
                }
        }
        else
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $staff['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
                        {
                                $rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
                        }
                }
        }

        $phpbb2_template->assign_block_vars('staff', array(
                'AVATAR' => $avatar,
                'RANK' => $rank,
                'RANK_IMAGE' => $rank_image,
                'U_NAME' => "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=$staff[user_id]",
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                'NAME' => UsernameColor($staff['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                'LEVEL' => $level,
                'FORUMS' => $forums,
                'JOINED' => $staff['user_regdate'],
                'PERIOD' => sprintf($titanium_lang['Period'], $memberdays),
                'POSTS' => $staff['user_posts'],
                'POST_DAY' => sprintf($titanium_lang['User_post_day_stats'], $phpbb2_posts_per_day),
                'POST_PERCENT' => sprintf($titanium_lang['User_post_pct_stats'], $percentage),
                'LAST_POST' => $phpbb2_last_post,
                'MAIL' => $mail,
                'PM' => $pm,
                'MSN' => $msn,
                'YIM' => $yim,
                'AIM' => $aim,
                'ICQ' => $icq,
                'WWW' => $www)
        );
}
        $phpbb2_template->assign_vars(array(
                'L_AVATAR' => $titanium_lang['Avatar'],
                'L_USERNAME' => $titanium_lang['Username'],
                'L_FORUMS' => $titanium_lang['Forums'],
                'L_POSTS' => $titanium_lang['Posts'],
                'L_JOINED' => $titanium_lang['Joined'],
                'L_EMAIL' => $titanium_lang['Email'],
                'L_PM' => $titanium_lang['Private_Message'],
                'L_MESSENGER' => $titanium_lang['Messenger'],
                'L_WWW' => $titanium_lang['Website'])
        );

        $phpbb2_template->pparse('body');

include('includes/page_tail.'.$phpEx);

?>