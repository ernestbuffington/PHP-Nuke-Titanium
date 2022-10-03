<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                              admin_userlist.php
 *                            -------------------
 *   begin                : Tuesday, 09 Feburary 2004
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
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
      Nuke Patched                             v3.1.0       08/26/2005
-=[Mod]=-
      Remote Avatar Resize                     v2.0.0       11/19/2005
      Advanced Username Color                  v1.0.5       06/13/2005
      Group Colors                             v1.0.0       10/20/2005
	  Multiple Ranks And Staff View            v2.0.3
 ************************************************************************/

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
    $filename = basename(__FILE__);
    $titanium_module['Users']['Userlist'] = $filename;

    return;
}

$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Set mode
//
if( isset( $HTTP_POST_VARS['mode'] ) || isset( $HTTP_GET_VARS['mode'] ) )
{
    $mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
    $mode = '';
}

//
// confirm
//
if( isset( $HTTP_POST_VARS['confirm'] ) || isset( $HTTP_GET_VARS['confirm'] ) )
{
    $confirm = true;
}
else
{
    $confirm = false;
}

//
// cancel
//
if( isset( $HTTP_POST_VARS['cancel'] ) || isset( $HTTP_GET_VARS['cancel'] ) )
{
    $cancel = true;
    $mode = '';
}
else
{
    $cancel = false;
}

//
// get starting position
//
$phpbb2_start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

//
// get show amount
//
if ( isset($HTTP_GET_VARS['show']) || isset($HTTP_POST_VARS['show']) )
{
    $show = ( isset($HTTP_POST_VARS['show']) ) ? intval($HTTP_POST_VARS['show']) : intval($HTTP_GET_VARS['show']);
}
else
{
    $show = $phpbb2_board_config['posts_per_page'];
}

//
// sort method
//
if ( isset($HTTP_GET_VARS['sort']) || isset($HTTP_POST_VARS['sort']) )
{
    $sort = ( isset($HTTP_POST_VARS['sort']) ) ? htmlspecialchars($HTTP_POST_VARS['sort']) : htmlspecialchars($HTTP_GET_VARS['sort']);
    $sort = str_replace("\'", "''", $sort);
}
else
{
    $sort = 'user_regdate';
}

//
// sort order
//
if( isset($HTTP_POST_VARS['order']) )
{
    $sort_order = ( $HTTP_POST_VARS['order'] == 'ASC' ) ? 'ASC' : 'DESC';
}
else if( isset($HTTP_GET_VARS['order']) )
{
    $sort_order = ( $HTTP_GET_VARS['order'] == 'ASC' ) ? 'ASC' : 'DESC';
}
else
{
    $sort_order = 'ASC';
}

//
// alphanumeric stuff
//
if ( isset($HTTP_GET_VARS['alphanum']) || isset($HTTP_POST_VARS['alphanum']) )
{
    $alphanum = ( isset($HTTP_POST_VARS['alphanum']) ) ? htmlspecialchars($HTTP_POST_VARS['alphanum']) : htmlspecialchars($HTTP_GET_VARS['alphanum']);
    $alphanum = str_replace("\'", "''", $alphanum);
    switch( $titanium_dbms )
    {
        case 'postgres':
            $alpha_where = ( $alphanum == 'num' ) ? "AND username !~ '^[A-Z]+'" : "AND username ILIKE '$alphanum%'";
            break;

        default:
            $alpha_where = ( $alphanum == 'num' ) ? "AND username NOT RLIKE '^[A-Z]'" : "AND username LIKE '$alphanum%'";
            break;
    }
}
else
{
    $alpahnum = '';
    $alpha_where = '';
}
$titanium_user_ids = array();
$filter = '';
$filter_where = '';
$find_by = 'find_username';
if ( isset($HTTP_GET_VARS['filter']) || isset($HTTP_POST_VARS['filter']) )
{
	$filter = ( isset($HTTP_POST_VARS['filter']) ) ? htmlspecialchars($HTTP_POST_VARS['filter']) : htmlspecialchars($HTTP_GET_VARS['filter']);
	if (!empty($filter))
	{
		$filter = preg_replace('/\*/', '%', phpbb_clean_username($filter));

		if (isset($HTTP_POST_VARS['find_by']))
			$find_by = htmlspecialchars($HTTP_POST_VARS['find_by']);
		elseif (isset($HTTP_GET_VARS['find_by']))
			$find_by = htmlspecialchars($HTTP_GET_VARS['find_by']);

		switch($find_by)
		{
		case 'find_user_email':
			$filter_where =" AND user_email LIKE '" . str_replace("\'", "''", $filter) . "'";
			break;
		case 'find_user_website':
			$filter_where =" AND user_website LIKE '" . str_replace("\'", "''", $filter) . "'";
			break;
		default:
			$filter_where =" AND username LIKE '" . str_replace("\'", "''", $filter) . "'";
		}

		$alpahnum = '';
		$alpha_where = '';
	}
}
//
// users id
// because it is an array we will intval() it when we use it
//
if ( isset($HTTP_POST_VARS[POST_USERS_URL]) || isset($HTTP_GET_VARS[POST_USERS_URL]) )
{
    $titanium_user_ids = ( isset($HTTP_POST_VARS[POST_USERS_URL]) ) ? $HTTP_POST_VARS[POST_USERS_URL] : $HTTP_GET_VARS[POST_USERS_URL];
}
else
{
    unset($titanium_user_ids);
}
switch( $mode )
{
    case 'delete':

        //
        // see if cancel has been hit and redirect if it has
        // shouldn't get to this point if it has been hit but
        // do this just in case
        //
        if ( $cancel )
        {
            redirect_titanium($phpbb2_root_path . 'admin/admin_userlist.'.$phpEx);
        }

        //
        // check confirm and either delete or show confirm message
        //
        if ( !$confirm )
        {
            // show message
            $i = 0;
            $hidden_fields = '';
            while( $i < count($titanium_user_ids) )
            {
                $titanium_user_id = intval($titanium_user_ids[$i]);
                $hidden_fields .= '<input type="hidden" name="' . POST_USERS_URL . '[]" value="' . $titanium_user_id . '">';

                unset($titanium_user_id);
                $i++;
            }

            $phpbb2_template->set_filenames(array(
                'body' => 'confirm_body.tpl')
            );
            $phpbb2_template->assign_vars(array(
                'MESSAGE_TITLE' => $titanium_lang['Delete'],
                'MESSAGE_TEXT' => $titanium_lang['Confirm_user_deleted'],

                'U_INDEX' => '',
                'L_INDEX' => '',

                'L_YES' => $titanium_lang['Yes'],
                'L_NO' => $titanium_lang['No'],

                'S_CONFIRM_ACTION' => append_titanium_sid('admin_userlist.'.$phpEx.'?mode=delete'),
                'S_HIDDEN_FIELDS' => $hidden_fields)
            );
        }
        else
        {
            // delete users
            $i = 0;
            while( $i < count($titanium_user_ids) )
            {
                $titanium_user_id = intval($titanium_user_ids[$i]);

                $sql = "SELECT u.username, g.group_id
                    FROM " . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
                    WHERE ug.user_id = '$titanium_user_id'
                        AND g.group_id = ug.group_id
                        AND g.group_single_user = '1'";
                if( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
                }

                $row = $titanium_db->sql_fetchrow($result);

                $sql = "UPDATE " . POSTS_TABLE . "
                    SET poster_id = " . DELETED . ", post_username = '" . $row['username'] . "'
                    WHERE poster_id = '$titanium_user_id'";
                if( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "UPDATE " . TOPICS_TABLE . "
                    SET topic_poster = " . DELETED . "
                    WHERE topic_poster = '$titanium_user_id'";
                if( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "UPDATE " . VOTE_USERS_TABLE . "
                    SET vote_user_id = " . DELETED . "
                    WHERE vote_user_id = '$titanium_user_id'";
                if( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "SELECT group_id
                    FROM " . GROUPS_TABLE . "
                    WHERE group_moderator = '$titanium_user_id'";
                if( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Could not select groups where user was moderator', '', __LINE__, __FILE__, $sql);
                }

                while ( $row_group = $titanium_db->sql_fetchrow($result) )
                {
                    $group_moderator[] = $row_group['group_id'];
                }

                if ( count($group_moderator) )
                {
                    $update_moderator_id = implode(', ', $group_moderator);

                    $sql = "UPDATE " . GROUPS_TABLE . "
                        SET group_moderator = " . $userdata['user_id'] . "
                        WHERE group_moderator IN ($update_moderator_id)";
                    if( !$titanium_db->sql_query($sql) )
                    {
                        message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
                    }
                }

                $sql = "DELETE FROM " . USERS_TABLE . "
                    WHERE user_id = '$titanium_user_id'";
                if( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                    WHERE user_id = '$titanium_user_id'";
                if( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . GROUPS_TABLE . "
                    WHERE group_id = " . $row['group_id'];
                if( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                    WHERE group_id = " . $row['group_id'];
                if( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                    WHERE user_id = '$titanium_user_id'";
                if ( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . BANLIST_TABLE . "
                    WHERE ban_userid = '$titanium_user_id'";
                if ( !$titanium_db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
                }

                $sql = "SELECT privmsgs_id
                    FROM " . PRIVMSGS_TABLE . "
                    WHERE privmsgs_from_userid = '$titanium_user_id'
                        OR privmsgs_to_userid = '$titanium_user_id'";
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Could not select all users private messages', '', __LINE__, __FILE__, $sql);
                }

                // This little bit of code directly from the private messaging section.
                while ( $row_privmsgs = $titanium_db->sql_fetchrow($result) )
                {
                    $mark_list[] = $row_privmsgs['privmsgs_id'];
                }

                if ( count($mark_list) )
                {
                    $delete_sql_id = implode(', ', $mark_list);

                    $delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                        WHERE privmsgs_text_id IN ($delete_sql_id)";
                    $delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
                        WHERE privmsgs_id IN ($delete_sql_id)";

                    if ( !$titanium_db->sql_query($delete_sql) )
                    {
                        message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
                    }

                    if ( !$titanium_db->sql_query($delete_text_sql) )
                    {
                        message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
                    }
                }

                unset($titanium_user_id);
                $i++;
            }

            $message = $titanium_lang['User_deleted_successfully'] . "<br /><br />" . sprintf($titanium_lang['Click_return_userlist'], "<a href=\"" . append_titanium_sid("admin_userlist.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

            message_die(GENERAL_MESSAGE, $message);
        }
        break;

    case 'ban':

        //
        // see if cancel has been hit and redirect if it has
        // shouldn't get to this point if it has been hit but
        // do this just in case
        //
        if ( $cancel )
        {
            redirect_titanium($phpbb2_root_path . 'admin/admin_userlist.'.$phpEx);
        }

        //
        // check confirm and either ban or show confirm message
        //
        if ( !$confirm )
        {
            $i = 0;
            $hidden_fields = '';
            while( $i < count($titanium_user_ids) )
            {
                $titanium_user_id = intval($titanium_user_ids[$i]);
                $hidden_fields .= '<input type="hidden" name="' . POST_USERS_URL . '[]" value="' . $titanium_user_id . '">';

                unset($titanium_user_id);
                $i++;
            }

            $phpbb2_template->set_filenames(array(
                'body' => 'confirm_body.tpl')
            );
            $phpbb2_template->assign_vars(array(
                'MESSAGE_TITLE' => $titanium_lang['Ban'],
                'MESSAGE_TEXT' => $titanium_lang['Confirm_user_ban'],

                'U_INDEX' => '',
                'L_INDEX' => '',

                'L_YES' => $titanium_lang['Yes'],
                'L_NO' => $titanium_lang['No'],

                'S_CONFIRM_ACTION' => append_titanium_sid('admin_userlist.'.$phpEx.'?mode=ban'),
                'S_HIDDEN_FIELDS' => $hidden_fields)
            );
        }
        else
        {
            // ban users
            $i = 0;
            while( $i < count($titanium_user_ids) )
            {
                $titanium_user_id = intval($titanium_user_ids[$i]);

                $sql = "INSERT INTO " . BANLIST_TABLE . " ( ban_userid )
                    VALUES ( '$titanium_user_id' )";
                if( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Could not obtain ban user', '', __LINE__, __FILE__, $sql);
                }

                unset($titanium_user_id);
                $i++;
            }

            $message = $titanium_lang['User_banned_successfully'] . "<br /><br />" . sprintf($titanium_lang['Click_return_userlist'], "<a href=\"" . append_titanium_sid("admin_userlist.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

            message_die(GENERAL_MESSAGE, $message);
        }
        break;

    case 'activate':

        //
        // activate or deactive the seleted users
        //
        $i = 0;
        while( $i < count($titanium_user_ids) )
        {
            $titanium_user_id = intval($titanium_user_ids[$i]);
            $sql = "SELECT user_active FROM " . USERS_TABLE . "
                WHERE user_id = '$titanium_user_id'";
            if( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not obtain user information', '', __LINE__, __FILE__, $sql);
            }
            $row = $titanium_db->sql_fetchrow($result);
            $titanium_db->sql_freeresult($result);

            $new_status = ( $row['user_active'] ) ? 0 : 1;
            $new_level = ($new_status) ? 1 : -1;
            $name = ($new_status) ? '' : 'Member Deactivated' ;

            $sql = "UPDATE " .  USERS_TABLE . "
                SET user_active = '$new_status',
                user_level = '$new_level',
                name = '$name'
                WHERE user_id = '$titanium_user_id'";
            if( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not update user status', '', __LINE__, __FILE__, $sql);
            }

            unset($titanium_user_id);
            $i++;
        }

        $message = $titanium_lang['User_status_updated'] . "<br /><br />" . sprintf($titanium_lang['Click_return_userlist'], "<a href=\"" . append_titanium_sid("admin_userlist.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);
        break;

    case 'group':

        //
        // add users to a group
        //
        if ( !$confirm )
        {
            // show form to select which group to add users to
            $i = 0;
            $hidden_fields = '';
            while( $i < count($titanium_user_ids) )
            {
                $titanium_user_id = intval($titanium_user_ids[$i]);
                $hidden_fields .= '<input type="hidden" name="' . POST_USERS_URL . '[]" value="' . $titanium_user_id . '">';

                unset($titanium_user_id);
                $i++;
            }

            $phpbb2_template->set_filenames(array(
                'body' => 'admin/userlist_group.tpl')
            );

            $phpbb2_template->assign_vars(array(
                'MESSAGE_TITLE' => $titanium_lang['Add_group'],
                'MESSAGE_TEXT' => $titanium_lang['Add_group_explain'],

                'L_GROUP' => $titanium_lang['Group'],

                'S_GROUP_VARIABLE' => POST_GROUPS_URL,
                'S_ACTION' => append_titanium_sid($phpbb2_root_path . 'admin/admin_userlist.'.$phpEx.'?mode=group'),
                'L_GO' => $titanium_lang['Go'],
                'L_CANCEL' => $titanium_lang['Cancel'],
                'L_SELECT' => $titanium_lang['Select_one'],
                'S_HIDDEN_FIELDS' => $hidden_fields)
            );

            $sql = "SELECT group_id, group_name FROM " . GROUPS_TABLE . "
                WHERE group_single_user <> " . TRUE . "
                ORDER BY group_name";

            if( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not query groups', '', __LINE__, __FILE__, $sql);
            }

            // loop through groups
            while ( $row = $titanium_db->sql_fetchrow($result) )
            {
                $phpbb2_template->assign_block_vars('grouprow',array(
                    'GROUP_NAME' => $row['group_name'],
                    'GROUP_ID' => $row['group_id'])
                );
            }
        }
        else
        {
            // add the users to the selected group
            $group_id = intval($HTTP_POST_VARS[POST_GROUPS_URL]);

            include("../../../includes/emailer.php");
            $emailer = new emailer($phpbb2_board_config['smtp_delivery']);

            $i = 0;
            while( $i < count($titanium_user_ids) )
            {
                $titanium_user_id = intval($titanium_user_ids[$i]);

                //
                // For security, get the ID of the group moderator.
                //
                switch(SQL_LAYER)
                {
                    /*case 'postgresql':
                        $sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod
                            FROM " . GROUPS_TABLE . " g, " . AUTH_ACCESS_TABLE . " aa
                            WHERE g.group_id = '$group_id'
                                AND aa.group_id = g.group_id
                                UNION (
                                    SELECT g.group_moderator, g.group_type, NULL
                                    FROM " . GROUPS_TABLE . " g
                                    WHERE g.group_id = '$group_id'
                                        AND NOT EXISTS (
                                        SELECT aa.group_id
                                        FROM " . AUTH_ACCESS_TABLE . " aa
                                        WHERE aa.group_id = g.group_id
                                    )
                                )";
                        break;*/

                    case 'oracle':
                        $sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod
                            FROM " . GROUPS_TABLE . " g, " . AUTH_ACCESS_TABLE . " aa
                            WHERE g.group_id = '$group_id'
                                AND aa.group_id = g.group_id(+)";
                        break;

                    default:
                        $sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod
                            FROM ( " . GROUPS_TABLE . " g
                            LEFT JOIN " . AUTH_ACCESS_TABLE . " aa ON aa.group_id = g.group_id )
                            WHERE g.group_id = '$group_id'";
                        break;
                }
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Could not get moderator information', '', __LINE__, __FILE__, $sql);
                }

                $group_info = $titanium_db->sql_fetchrow($result);

                $sql = "SELECT user_id, user_email, user_lang, user_level
                    FROM " . USERS_TABLE . "
                    WHERE user_id = '$titanium_user_id'";
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, "Could not get user information", $titanium_lang['Error'], __LINE__, __FILE__, $sql);
                }
                $row = $titanium_db->sql_fetchrow($result);

                $sql = "SELECT ug.user_id, u.user_level
                    FROM " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u
                    WHERE u.user_id = " . $row['user_id'] . "
                        AND ug.user_id = u.user_id
                        AND ug.group_id = '$group_id'";
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Could not get user information', '', __LINE__, __FILE__, $sql);
                }

                if ( !($titanium_db->sql_fetchrow($result)) )
                {
                    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
                        VALUES (" . $row['user_id'] . ", $group_id, 0)";
                    if ( !$titanium_db->sql_query($sql) )
                    {
                        message_die(GENERAL_ERROR, 'Could not add user to group', '', __LINE__, __FILE__, $sql);
                    }

                    if ( $row['user_level'] != ADMIN && $row['user_level'] != MOD && $group_info['auth_mod'] )
                    {
                        $sql = "UPDATE " . USERS_TABLE . "
                            SET user_level = " . MOD . "
                            WHERE user_id = " . $row['user_id'];
                        if ( !$titanium_db->sql_query($sql) )
                        {
                            message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                        }
                    }

                    //
                    // Get the group name
                    // Email the user and tell them they're in the group
                    //
                    $group_sql = "SELECT group_name
                        FROM " . GROUPS_TABLE . "
                        WHERE group_id = '$group_id'";
                    if ( !($result = $titanium_db->sql_query($group_sql)) )
                    {
                        message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
                    }

                    $group_name_row = $titanium_db->sql_fetchrow($result);

                    $group_name = $group_name_row['group_name'];

                    $script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($phpbb2_board_config['script_path']));
                    $script_name = 'modules.php?name=Groups';
                    $server_name = trim($phpbb2_board_config['server_name']);
                    $server_protocol = ( $phpbb2_board_config['cookie_secure'] ) ? 'https://' : 'http://';
                    $server_port = ( $phpbb2_board_config['server_port'] <> 80 ) ? ':' . trim($phpbb2_board_config['server_port']) . '/' : '/';

                    $server_url = $server_protocol . $server_name . $server_port . $script_name;

                    $emailer->from($phpbb2_board_config['board_email']);
                    $emailer->replyto($phpbb2_board_config['board_email']);

                    $emailer->use_template('group_added', $row['user_lang']);
                    $emailer->email_address($row['user_email']);
                    $emailer->set_subject($titanium_lang['Group_added']);

                    $emailer->assign_vars(array(
                        'SITENAME' => $phpbb2_board_config['sitename'],
                        'GROUP_NAME' => $group_name,
                        'EMAIL_SIG' => (!empty($phpbb2_board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $phpbb2_board_config['board_email_sig']) : '',

                        'U_GROUPCP' => $server_url . '?' . POST_GROUPS_URL . "=$group_id")
                    );
                    $emailer->send();
                    $emailer->reset();

                }

                unset($titanium_user_id);
                $i++;
            }

            $message = $titanium_lang['User_add_group_successfully'] . "<br /><br />" . sprintf($titanium_lang['Click_return_userlist'], "<a href=\"" . append_titanium_sid("admin_userlist.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

            message_die(GENERAL_MESSAGE, $message);
        }
        break;

    default:

        //
        // get and display all of the users
        //
        $phpbb2_template->set_filenames(array(
          'body' => 'admin/userlist_body.tpl')
        );

        //
        // gets for alphanum
        //
        $alpha_range = array();
        $alpha_letters = array();
        $alpha_letters = range('A','Z');
        $alpha_start = array($titanium_lang['All'], '#');
        $alpha_range = array_merge($alpha_start, $alpha_letters);

        $i = 0;
        while( $i < count($alpha_range) )
        {

            if ( $alpha_range[$i] != $titanium_lang['All'] )
            {
                if ( $alpha_range[$i] != '#' )
                {
                    $temp = strtolower($alpha_range[$i]);
                }
                else
                {
                    $temp = 'num';
                }
                $alphanum_search_url = append_titanium_sid($phpbb2_root_path . "admin/admin_userlist.$phpEx?sort=$sort&amp;order=$sort_order&amp;show=$show&amp;alphanum=$temp");
            }
            else
            {
                $alphanum_search_url = append_titanium_sid($phpbb2_root_path . "admin/admin_userlist.$phpEx?sort=$sort&amp;order=$sort_order&amp;show=$show");
            }

            if ( ( $alphanum == $temp ) || ( $alpha_range[$i] == $titanium_lang['All'] && empty($alphanum) ) )
            {
                $alpha_range[$i] = '<strong>' . $alpha_range[$i] . '</strong>';
            }

            $phpbb2_template->assign_block_vars('alphanumsearch', array(
                'SEARCH_SIZE' => floor(100/count($alpha_range)) . '%',
                'SEARCH_TERM' => $alpha_range[$i],
                'SEARCH_LINK' => $alphanum_search_url)
            );

            $i++;
        }

        $hidden_fields = '<input type="hidden" name="start" value="' . $phpbb2_start . '">';
        $hidden_fields .= '<input type="hidden" name="alphanum" value="' . $alphanum . '">';

        //
        // set up template varibles
        //
        $phpbb2_template->assign_vars(array(
            'L_TITLE' => $titanium_lang['Userlist'],
            'L_DESCRIPTION' => $titanium_lang['Userlist_description'],

            'L_OPEN_CLOSE' => $titanium_lang['Open_close'],
            'L_ACTIVE' => $titanium_lang['Active'],
            'L_USERNAME' => $titanium_lang['Username'],
            'L_GROUP' => $titanium_lang['Group'],
            'L_RANK' => $titanium_lang['Rank'],
            'L_POSTS' => $titanium_lang['Posts'],
            'L_FIND_ALL_POSTS' => $titanium_lang['Find_all_posts'],
            'L_JOINED' => $titanium_lang['Joined'],
            'L_ACTIVTY' => $titanium_lang['Last_activity'],
            'L_MANAGE' => $titanium_lang['User_manage'],
            'L_PERMISSIONS' => $titanium_lang['Permissions'],
            'L_EMAIL' => $titanium_lang['Email'],
            'L_PM' => $titanium_lang['Private_Message'],
            'L_WEBSITE' => $titanium_lang['Website'],

            'S_USER_VARIABLE' => POST_USERS_URL,
            'S_ACTION' => append_titanium_sid($phpbb2_root_path . 'admin/admin_userlist.'.$phpEx),
            'L_GO' => $titanium_lang['Go'],
            'L_SELECT' => $titanium_lang['Select_one'],
            'L_DELETE' => $titanium_lang['Delete'],
            'L_BAN' => $titanium_lang['Ban'],
            'L_ACTIVATE_DEACTIVATE' => $titanium_lang['Activate_deactivate'],
            'L_ADD_GROUP' => $titanium_lang['Add_group'],

            'S_SHOW' => $show,
			'L_FILTER' => $titanium_lang['Filter'],
			'L_SORT_BY' => $titanium_lang['Select_sort_method'],
			'L_SORT_USER_ID' => $titanium_lang['Sort_User_id'],
			'L_SORT_ACTIVE' => $titanium_lang['Sort_Active'],
			'L_SORT_USERNAME' => $titanium_lang['Sort_Username'],
			'L_SORT_JOINED' => $titanium_lang['Sort_Joined'],
			'L_SORT_ACTIVTY' => $titanium_lang['Sort_Last_Activity'],
			'L_SORT_USER_LEVEL' => $titanium_lang['Sort_User_Level'],
			'L_SORT_POSTS' => $titanium_lang['Sort_Posts'],
			'L_SORT_RANK' => $titanium_lang['Sort_Rank'],
			'L_SORT_EMAIL' => $titanium_lang['Sort_Email'],
			'L_SORT_WEBSITE' => $titanium_lang['Sort_Website'],
			'L_ASCENDING' => $titanium_lang['Sort_Ascending'],
			'L_DESCENDING' => $titanium_lang['Sort_Descending'],
            'L_SORT_BY' => $titanium_lang['Sort_by'],
            'L_USER_ID' => $titanium_lang['User_id'],
            'L_USER_LEVEL' => $titanium_lang['User_level'],
            'L_SHOW' => $titanium_lang['Show'],
            'S_SORT' => $titanium_lang['Sort'],
			'S_HIDDEN_FIELDS' => $hidden_fields,
			'SELECTED_ASCENDING'  => ($sort_order=="ASC") ? " selected" : "",
			'SELECTED_DESCENDING' => ($sort_order=="DESC") ? " selected" : "",

			'S_FILTER' => preg_replace('/%/', '*', $filter),
			'SELECTED_FIND_USERNAME' => ($find_by=="find_username") ? "selected" : "",
			'SELECTED_FIND_EMAIL' => ($find_by=="find_user_email") ? "selected" : "",
			'SELECTED_FIND_WEBSITE' => ($find_by=="find_user_website") ? "selected" : "",

			'SELECTED_USER_ID' => ($sort=="user_id") ? " selected" : "",
			'SELECTED_ACTIVE' => ($sort=="user_active") ? " selected" : "",
			'SELECTED_USERNAME' => ($sort=="username") ? " selected" : "",
			'SELECTED_JOINED' => ($sort=="user_regdate") ? " selected" : "",
			'SELECTED_ACTIVTY' => ($sort=="user_session_time") ? " selected" : "",
			'SELECTED_USER_LEVEL' => ($sort=="user_level") ? " selected" : "",
			'SELECTED_POSTS' => ($sort=="user_posts") ? " selected" : "",
			'SELECTED_RANK' => ($sort=="user_rank") ? " selected" : "",
			'SELECTED_EMAIL' => ($sort=="user_email") ? " selected" : "",
			'SELECTED_WEBSITE' => ($sort=="user_website") ? " selected" : "",
            'S_HIDDEN_FIELDS' => $hidden_fields)
        );

        $order_by = "ORDER BY $sort $sort_order ";

        $sql = "SELECT *
            FROM " . USERS_TABLE . "
            WHERE user_id <> " . ANONYMOUS . "
                $alpha_where
            $order_by
            LIMIT $phpbb2_start, $show";

        if( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
        }

        // loop through users
        $i = 1;
        while ( $row = $titanium_db->sql_fetchrow($result) )
        {
            //
            // users avatar
            //
            $avatar_img = '';
            if ( $row['user_avatar_type'] && $row['user_allowavatar'] )
            {
                switch( $row['user_avatar_type'] )
                {
                    case USER_AVATAR_UPLOAD:
                        $avatar_img = ( $phpbb2_board_config['allow_avatar_upload'] ) ? '<img src="../../../' . $phpbb2_board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
                        break;
/*****[BEGIN]******************************************
 [ Mod:     Remote Avatar Resize               v2.0.0 ]
 ******************************************************/
                    case USER_AVATAR_REMOTE:
                        $avatar_img = resize_avatar($row['user_avatar']);
                        break;
/*****[END]********************************************
 [ Mod:     Remote Avatar Resize               v2.0.0 ]
 ******************************************************/
                    case USER_AVATAR_GALLERY:
                        $avatar_img = ( $phpbb2_board_config['allow_avatar_local'] ) ? '<img src="../../../' . $phpbb2_board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
                        break;
                }
            }

            //
            // users rank
            //
            $rank_sql = "SELECT *
                FROM " . RANKS_TABLE . "
                ORDER BY rank_special, rank_min";
            if ( !($rank_result = $titanium_db->sql_query($rank_sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
            }

            while ( $rank_row = $titanium_db->sql_fetchrow($rank_result) )
            {
                $ranksrow[] = $rank_row;
            }
            $titanium_db->sql_freeresult($rank_result);

            $poster_rank = '';
            $rank_image = '';
            if ( $row['user_rank'] )
            {
                for($ji = 0; $ji < count($ranksrow); $ji++)
                {
                    if ( $row['user_rank'] == $ranksrow[$ji]['rank_id'] && $ranksrow[$ji]['rank_special'] )
                    {
                        $poster_rank = $ranksrow[$ji]['rank_title'];
                        $rank_image = ( $ranksrow[$ji]['rank_image'] ) ? '<img src="../' . $ranksrow[$ji]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                    }
                }
            }
            else
            {
                for($ji = 0; $ji < count($ranksrow); $ji++)
                {
                    if ( $row['user_posts'] >= $ranksrow[$ji]['rank_min'] && !$ranksrow[$ji]['rank_special'] )
                    {
                        $poster_rank = $ranksrow[$ji]['rank_title'];
                        $rank_image = ( $ranksrow[$ji]['rank_image'] ) ? '<img src="../' . $ranksrow[$ji]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                    }
                }
            }

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            //
            // user's color depending on their level
            //
            /*$style_color = '';
            if ( $row['user_level'] == ADMIN )
            {
                $row['username'] = '<strong>' . UsernameColor($row['username']) . '</strong>';
                //$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
            }
            else if ( $row['user_level'] == MOD )
            {
                $row['username'] = '<strong>' . UsernameColor($row['username']) . '</strong>';
                //$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
            }*/
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

            //
            // setup user row template varibles
            //
            $phpbb2_template->assign_block_vars('user_row', array(
                'ROW_NUMBER' => $i + ( $HTTP_GET_VARS['start'] + 1 ),
                'ROW_CLASS' => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],

                'USER_ID' => $row['user_id'],
                'ACTIVE' => ( $row['user_active'] == TRUE ) ? $titanium_lang['Yes'] : $titanium_lang['No'],
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                //'STYLE_COLOR' => $style_color,
                'USERNAME' => UsernameColor($row['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                'U_PROFILE' => ("../../../modules.php?name=Profile&amp;mode=viewprofile&amp;u=$row[user_id]"),

                'RANK' => $poster_rank,
                'I_RANK' => $rank_image,
                'I_AVATAR' => $avatar_img,

                'JOINED' => $row['user_regdate'],
                'LAST_ACTIVITY' => ( !empty($row['user_session_time']) ) ? create_date('d M Y', $row['user_session_time'], $phpbb2_board_config['board_timezone']) : $titanium_lang['Never'],

                'POSTS' => ( $row['user_posts'] ) ? $row['user_posts'] : 0,
                'U_SEARCH' => ("../../../modules.php?name=Forums&amp;file=search&amp;search_author=" . urlencode(strip_tags($row['username'])) . ""),

                'U_WEBSITE' => ( $row['user_website'] ) ? $row['user_website'] : '',

                'EMAIL' => $row['user_email'],
                'U_PM' => ("../../../modules.php?name=Private_Messages&amp;file=index&amp;mode=post&amp;u=$row[user_id]"),
                'U_MANAGE' => append_titanium_sid($phpbb2_root_path . 'admin/admin_users.'.$phpEx.'?mode=edit&amp;' . POST_USERS_URL . '=' . $row['user_id']),
                'U_PERMISSIONS' => append_titanium_sid($phpbb2_root_path . 'admin/admin_ug_auth.'.$phpEx.'?mode=user&amp;' . POST_USERS_URL . '=' . $row['user_id']))
            );

            //
            // get the users group information
            //
            $group_sql = "SELECT * FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
                WHERE ug.user_id = " . $row['user_id'] . "
                 AND g.group_single_user <> 1
                 AND g.group_id = ug.group_id";

            if( !($group_result = $titanium_db->sql_query($group_sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not query groups', '', __LINE__, __FILE__, $group_sql);
            }
            $g = 0;
            while ( $group_row = $titanium_db->sql_fetchrow($group_result) )
            {
                //
                // assign the group varibles
                //
                if ( $group_row['group_moderator'] == $row['user_id'] )
                {
                    $group_status = $titanium_lang['Moderator'];
                }
                else if ( $group_row['user_pending'] == true )
                {
                    $group_status = $titanium_lang['Pending'];
                }
                else
                {
                    $group_status = $titanium_lang['Member'];
                }

                $phpbb2_template->assign_block_vars('user_row.group_row', array(
/*****[BEGIN]******************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/
                    'GROUP_NAME' => GroupColor($group_row['group_name']),
/*****[END]********************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/
                    'GROUP_STATUS' => $group_status,
                    'U_GROUP' => ("../../../modules.php?name=Groups&amp;g=$group_row[group_id]"))
                );
                $g++;
            }

            if ( $g == 0 )
            {
                $phpbb2_template->assign_block_vars('user_row.no_group_row', array(
                    'L_NONE' => $titanium_lang['None'])
                );
            }

            $i++;
        }
        $titanium_db->sql_freeresult($result);

        $count_sql = "SELECT count(user_id) AS total
            FROM " . USERS_TABLE . "
            WHERE user_id <> " . ANONYMOUS . " $alpha_where";

        if ( !($count_result = $titanium_db->sql_query($count_sql)) )
        {
            message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
        }

        if ( $total = $titanium_db->sql_fetchrow($count_result) )
        {
            $total_phpbb2_members = $total['total'];

            $pagination = generate_pagination($phpbb2_root_path . "admin/admin_userlist.$phpEx?sort=$sort&amp;order=$sort_order&amp;show=$show" . ( ( isset($alphanum) ) ? "&amp;alphanum=$alphanum" : '' ), $total_phpbb2_members, $show, $phpbb2_start);
        }

        $phpbb2_template->assign_vars(array(
            'PAGINATION' => $pagination,
            'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $show ) + 1 ), ceil( $total_phpbb2_members / $show )))
        );

        break;

} // switch()

$phpbb2_template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>