<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                admin_voting.php
 *                -------------------
 *   begin                : Saturday, August 24, 2002
 *   copyright            : (C) 2002 ErDrRon
 *   email                : ErDrRon@aol.com
 *
 *   $Id: admin_voting.php,v 1.1.8 12/04/2003, 13:35:00 erdrron Exp $
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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/24/2005
 ************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
    {
        $filename = basename(__FILE__);
        $module['Poll Admin']['Poll Results'] = $filename;
        return;
    }

  $root_path = './../../../';

// Set root dir for phpBB
//
    $phpbb_root_path = './../';

// Set includes
//
    include($phpbb_root_path . 'extension.inc');
    include('./pagestart.' . $phpEx);
    include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_voting.' . $phpEx);

// Initialize variables
//
    // Determine current starting row
        $start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

    // Determine current sort field
        if(isset($HTTP_GET_VARS['field']) || isset($HTTP_POST_VARS['field']))
            {
                $sort_field = (isset($HTTP_POST_VARS['field'])) ? $HTTP_POST_VARS['field'] : $HTTP_GET_VARS['field'];
            }
        else
            {
                $sort_field = 'vote_id';
            }

    // Determine current sort order
        if(isset($HTTP_POST_VARS['order']))
            {
                $sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
            }
        else if(isset($HTTP_GET_VARS['order']))
            {
                $sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
            }
        else
            {
                $sort_order = 'ASC';
            }

    // Assign sort fields
        $sort_fields_text = array(
                        $lang['Sort_vote_id'],
                        $lang['Sort_poll_topic'],
                        $lang['Sort_vote_start']
                        );

        $sort_fields = array(
                        'vote_id',
                        'poll_topic',
                        'vote_start'
                        );

        if (empty($sort_field))
            {
                $sort_field = 'vote_id';
                $sort_order = 'ASC';
            }

    // Set select fields
        if (count($sort_fields_text) > 0)
            {
                $select_sort_field = '<select name="field">';

                for($i = 0; $i < count($sort_fields_text); $i++)
                    {
                        $selected = ($sort_field == $sort_fields[$i]) ? ' selected="selected"' : '';
                        $select_sort_field .= '<option value="' . $sort_fields[$i] . '"' . $selected . '>' . $sort_fields_text[$i] . '</option>';
                    }
                        $select_sort_field .= '</select>';
            }

        if (!empty($sort_order))
            {
                $select_sort_order = '<select name="order">';
                if($sort_order == 'ASC')
                    {
                        $select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_ascending'] . '</option><option value="DESC">' . $lang['Sort_descending'] . '</option>';
                    }
                else
                    {
                        $select_sort_order .= '<option value="ASC">' . $lang['Sort_ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_descending'] . '</option>';
                    }
                        $select_sort_order .= '</select>';
            }

    // Select query sort criteria
        $order_by = '';

        switch($sort_field)
            {
                case 'vote_id':
                    $order_by = 'vote_id ' . $sort_order .
                                ' LIMIT ' . $start . ", " . $board_config['topics_per_page'];
                    break;
                case 'poll_topic':
                    $order_by = 'vote_text ' . $sort_order .
                                ' LIMIT ' . $start . ", " . $board_config['topics_per_page'];
                    break;
                case 'vote_start':
                    $order_by = 'vote_start ' . $sort_order .
                                ' LIMIT ' . $start . ", " . $board_config['topics_per_page'];
                    break;
                default:
                    $sort_field = 'vote_id';
                    $sort_order = 'ASC';
                    $order_by = 'vote_id ' . $sort_order .
                                ' LIMIT ' . $start . ", " . $board_config['topics_per_page'];
                    break;
            }

// Build arrays
//
    // Assign page template
        $template->set_filenames(array('pollbody' => 'admin/admin_voting_body.tpl'
            ));

    // Assign labels
        $template->assign_vars(array(
            'L_ADMIN_VOTE_EXPLAIN' => $lang['Admin_Vote_Explain'],
            'L_ADMIN_VOTE_TITLE' => $lang['Admin_Vote_Title'],
            'L_VOTE_ID' => $lang['Vote_id'], 
            'L_POLL_TOPIC' => $lang['Poll_topic'],
            'L_VOTE_USERNAME' => $lang['Vote_username'],
            'L_VOTE_END_DATE' => $lang['Vote_end_date'],
            'L_SUBMIT' => $lang['Submit'],
            'L_SELECT_SORT_FIELD' => $lang['Select_sort_field'],
            'L_SORT_ORDER' => $lang['Sort_order'],

            'S_FIELD_SELECT' => $select_sort_field,
            'S_ORDER_SELECT' => $select_sort_order,

            'ADMIN_VOTING_ICON' => '<img src="' . $phpbb_root_path . 'templates/subSilver/images/admin_voting_icon.gif" alt="" />',
            ));

    // Assign Username array
        $sql = "SELECT DISTINCT u.user_id, u.username" .
                " FROM " . USERS_TABLE . " AS u , " . VOTE_USERS_TABLE . " AS vv" .
                " WHERE u.user_id = vv.vote_user_id";

        if( !($result = $db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not query users.', '', __LINE__, __FILE__, $sql);
            }

        while ( $row = $db->sql_fetchrow($result) )
            {
                    $user_id = $row['user_id'];
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    $username = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    $user_arr[$user_id] = $username;
            }

    // Assign poll options array
        $sql = "SELECT *" .
                 " FROM ". VOTE_RESULTS_TABLE .
                " ORDER BY vote_id";

        if( !($result = $db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not query poll options.', '', __LINE__, __FILE__, $sql);
            }

        while ( $row = $db->sql_fetchrow($result) )
            { 
                $vote_id = $row['vote_id']; 
                $vote_option_id = $row['vote_option_id']; 
                $vote_option_text = $row['vote_option_text']; 
                $vote_result = $row['vote_result']; 
                $option_arr[$vote_id][$vote_option_id]["text"] = $vote_option_text; 
                $option_arr[$vote_id][$vote_option_id]["result"] = $vote_result; 
            }

    // Assign individual vote results
        $sql = "SELECT vote_id, vote_user_id, vote_cast" .
                " FROM ". VOTE_USERS_TABLE .
                " ORDER BY vote_id"; 

        if( !($result = $db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not query vote results.', '', __LINE__, __FILE__, $sql);
            }

        while ( $row = $db->sql_fetchrow($result) )
            { 
                $vote_id = $row['vote_id']; 
                $vote_user_id = $row['vote_user_id']; 
                $vote_cast = $row['vote_cast']; 
                $voter_arr[$vote_id][$vote_user_id] = $vote_cast; 
            }
        $sql ="SELECT *" .
                " FROM ". VOTE_DESC_TABLE .
                " ORDER BY " . $order_by;

        if( !($result = $db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not query poll description.', '', __LINE__, __FILE__, $sql);
            }

        $num_polls = $db->sql_numrows($result);

        $i = 0;

        while ( $row = $db->sql_fetchrow($result) )
            { 
                $topic_row_color = (($i % 2) == 0) ? "row1" : "row2";
                $vote_id = $row['vote_id']; 
                $vote_text = $row['vote_text']; 
                $topic_id = $row['topic_id'];
                $vote_start = $row['vote_start'];
                $vote_length = $row['vote_length']; 
                $vote_end = $vote_start + $vote_length;
 
                if (time() < $vote_end)
                    {
                        $vote_duration = (date ("m/d/y",$vote_start)) . " - " . (date ("m/d/y",$vote_end)) . "(ongoing)";
                    } 
                else if ($vote_length == 0)
                    {
                        $vote_duration = (date ("m/d/y",$vote_start)) . " - " . "Infinite .." ;
                    } 
                else
                    {
                        $vote_duration = (date ("m/d/y",$vote_start)) . " - " . (date ("m/d/y",$vote_end)) . "(completed)" ;
                    } 

            $user = ""; 
            $users = ""; 
            $user_option_arr = array();
 
            if (count($voter_arr[$vote_id]) > 0 )
                { 
                    foreach($voter_arr[$vote_id] as $user_id => $option_id)
                    { 
                        $user .= $user_arr[$user_id].", "; 
                        $user_option_arr[$option_id] .= $user_arr[$user_id].", "; 
                    } 
                        $user = substr($user, "0", strrpos($user, ", ")); 
                }
 
            $template->assign_block_vars("votes", array( 
                'COLOR' => $topic_row_color,
                'LINK' => $root_path . "modules.php?name=Forums&amp;file=viewtopic&amp;t=$topic_id", 
                'DESCRIPTION' => $vote_text, 
                'USER' => $user, 
                'ENDDATE' => $vote_end,
                'VOTE_DURATION' => $vote_duration, 
                'VOTE_ID' => $vote_id
                ));
 
            if (count($voter_arr[$vote_id]) > 0 )
                { 
                    foreach($option_arr[$vote_id] as $vote_option_id => $elem)
                        { 
                            $option_text = $elem["text"]; 
                            $option_result = $elem["result"]; 
                            $user = $user_option_arr[$vote_option_id]; 
                            $user = substr($user, "0", strrpos($user, ", "));
 
            $template->assign_block_vars("votes.detail", array( 
                'OPTION' => $option_text, 
                'RESULT' => $option_result, 
                'USER' => $user
                )); 
                        } 
                }

            $i++;

            }

// Pagination routine
//
    $sql = "SELECT count(*) AS total" .
            " FROM " . VOTE_DESC_TABLE .
            " WHERE vote_id > 0";

    if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
        }

    if ( $total = $db->sql_fetchrow($result) )
        {
            $total_polls = $total['total'];
            $pagination = generate_pagination("admin_voting.$phpEx?mode=$sort_field&amp;order=$sort_order", $total_polls, $board_config['topics_per_page'], $start). '&nbsp;';
        }

    $template->assign_vars(array(
        'PAGINATION' => $pagination,
        'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_polls / $board_config['topics_per_page'] )), 

        'L_GOTO_PAGE' => $lang['Goto_page'])
        );

// I'm the boss...need the info...
//
    $template->pparse('pollbody');
    include('./page_footer_admin.'.$phpEx);

?>