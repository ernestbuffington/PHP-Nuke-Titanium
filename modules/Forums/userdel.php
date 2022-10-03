<?php
/***************************************************************************
 *                            userdel.php
 *   MOD: Admin delete user with all postings
 *                            -------------------
 *   begin                : Saturday, Feb 28, 2006
 *   copyright            : (C) 2006 Sergei Sekirin
 *   email                : sergei-vs@mail.ru
 *
 *   $Id: userdel.php, v 1.0.5  2006/08/18 sergei-vs Exp $
 *   NOTE: v.1.0.5 tested on phpBB 2.0.19
 ***************************************************************************/
//
// Inc. to phpBB
//
if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ((!(isset($popup)) OR ($popup != "1")) && !isset($HTTP_GET_VARS['printertopic']))
{
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
include("includes/functions_userdel.php");

//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_PROFILE);
titanium_init_userprefs($userdata);
//
// End session management
//


//
// Authorized ?
//

$if_admin = ($userdata['user_level'] == ADMIN );
if ( !$if_admin )
{
	message_die(GENERAL_MESSAGE, $titanium_lang['Not_Authorised']);
}
//
include($phpbb2_root_path.'language/lang_' . $userdata['user_lang'] . '/lang_user_delete.'.$phpEx);

//
// Set ID of deleted user
//
if( isset( $HTTP_POST_VARS['user_deleted_id'] ) || isset( $HTTP_GET_VARS['user_deleted_id'] ) )
{
	$titanium_user_deleted_id = ( isset( $HTTP_POST_VARS['user_deleted_id']) ) ? $HTTP_POST_VARS['user_deleted_id'] : $HTTP_GET_VARS['user_deleted_id'];
	$titanium_user_deleted_id = intval($titanium_user_deleted_id);
}
else
{
	message_die(GENERAL_MESSAGE, 'Poster is not specifyed');
}


$mode = (( isset($HTTP_POST_VARS['delete_mode'])) ? intval($HTTP_POST_VARS['delete_mode']) : '1');

switch( $mode )
{
	case 1:
		$mode_quest = '';
        $final_anno = $titanium_lang['user_is_deleted'];
		break;
	case 2:
		$mode_quest = $titanium_lang['with_all_topics'];
        $final_anno = $titanium_lang['user_with_topics_deleted'];
		break;
	case 3:
		$mode_quest = $titanium_lang['with_all_postings'];
        $final_anno = $titanium_lang['user_deleted_with_all_postings'];
		break;

        //<!---1
	case 4:
		$mode_quest = $titanium_lang['with_all_postings'];
        $final_anno = $titanium_lang['only_user_postings_deleted'];
		break;
        //--->

	default:
		message_die(GENERAL_MESSAGE, $titanium_lang['No_post_mode']);
		break;
}

//
// Set confirm
//
$confirm = isset($HTTP_POST_VARS['confirm']) ? true : false;


//
// Cancel? - Back to profile
//
if ( isset($HTTP_POST_VARS['cancel']) )
{
	if ( $titanium_user_deleted_id )
	{
		$redirect = "profile.$phpEx?mode=viewprofile&". POST_USERS_URL ."=$titanium_user_deleted_id";
	}
	else
	{
		$redirect = "index.$phpEx";
	}
	redirect_titanium(append_titanium_sid($redirect, true));
}


//
// Level check - not allowed deletion of Admins and Moders
//
$sql = "SELECT user_id, user_level, username
	FROM " . USERS_TABLE . "
	WHERE user_id = $titanium_user_deleted_id";
	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not get user information", "", __LINE__, __FILE__, $sql);
	$row = $titanium_db->sql_fetchrow($result);
	if ($row['user_id'] == '')
	{
	    message_die(GENERAL_MESSAGE, $titanium_lang['User_not_exist']);
	}
    $titanium_user_name = $row['username'];


//
// Count topics of User
//
$sql = "SELECT count(*) AS total
	FROM " . TOPICS_TABLE . "
    WHERE topic_poster = $titanium_user_deleted_id";
	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Error getting total topics", "", __LINE__, __FILE__, $sql);
 	  if ( $total = $titanium_db->sql_fetchrow($result) )
	  {
		  $total_phpbb2_topics = $total['total'];
      }
	  $titanium_db->sql_freeresult($result);

//
// Count posts of User
//
	$sql = "SELECT count(*) AS total2
	FROM " . POSTS_TABLE . "
    WHERE poster_id = $titanium_user_deleted_id";
	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Error getting total posts", "", __LINE__, __FILE__, $sql);
	  if ( $total2 = $titanium_db->sql_fetchrow($result) )
	  {
		  $phpbb2_total_posts = $total2['total2'];
      }
	  $titanium_db->sql_freeresult($result);

//
// Confirm
//
if ( ($titanium_user_deleted_id) && !$confirm )
{
	// Confirm deletion
	$s_hidden_fields = '<input type="hidden" name="user_deleted_id" value="' . $titanium_user_deleted_id . '" />';
	$s_hidden_fields .= '<input type="hidden" name="delete_mode" value="' . $mode . '" />';
    if ($mode != 4)
    {
	$l_confirm = ($titanium_user_deleted_id) ? sprintf($titanium_lang['You_sure'], $total_phpbb2_topics, $phpbb2_total_posts ) . ' '. $titanium_user_name . '</b> ' . $mode_quest . '?' : $titanium_lang['No_user_specified'];
    }
    else
    {
	$l_confirm = ($titanium_user_deleted_id) ? sprintf($titanium_lang['Sure_delete_only_postings'], $total_phpbb2_topics, $phpbb2_total_posts ) . ' '. $titanium_user_name . '</b>?' : $titanium_lang['No_user_specified'];
    }
	// Output confirmation page
include("includes/page_header.php");
	$phpbb2_template->set_filenames(array(
		'confirm_body' => 'confirm_body.tpl'));
	$phpbb2_template->assign_vars(array(
		'MESSAGE_TITLE' => $titanium_lang['Information'],
		'MESSAGE_TEXT' => $l_confirm,
		'L_YES' => $titanium_lang['Yes'],
		'L_NO' => $titanium_lang['No'],
		'S_CONFIRM_ACTION' => append_titanium_sid("userdel.$phpEx"),
		'S_HIDDEN_FIELDS' => $s_hidden_fields)
	);
  $phpbb2_template->pparse('confirm_body');
include("includes/page_tail.php");
}
//
// END Confirm
//

/*
����������������������������    Begin  delete   ��������������������������������
*/

include("includes/page_header.php");

$phpbb2_template->set_filenames(array(
'body' => 'user_delete_body.tpl'));
make_jumpbox('viewforum.'.$phpEx);

$titanium_user_id = $titanium_user_deleted_id;
if (!($deleted_userdata = get_userdata($titanium_user_id)))
{
	message_die(GENERAL_MESSAGE, 'User is unknown!');
}
$titanium_username=$deleted_userdata['username'];


/*##############################################################################
 		START - SECTION 1 -  DELETE USER STARTED TOPICS
//############################################################################# */

if ((($mode == 2) || ($mode == 3) || ($mode == 4)) && ($total_phpbb2_topics > 0))
{
  // Get User started topics
      $sql = "SELECT topic_id, forum_id, topic_title
	  FROM " . TOPICS_TABLE . "
      WHERE topic_poster = " . $titanium_user_id;
	  $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get USER topics!", "", __LINE__, __FILE__, $sql);
      if (($titanium_usertopic_ids_count = $titanium_db->sql_numrows($result)) > '0')
      {
         $top_ids = $titanium_db->sql_fetchrowset($result);
	     // Massive topic_id
	     $phpbb2_topics_sql = '';
         $titanium_user_topic_titles = '';
	     foreach($top_ids as $val)
	     {
              // Listing of topic titles
              $titanium_user_topic_titles .= '� ['. $val['topic_id']. '] '. $val['topic_title'] . '<br>';
              // Resync forums count
              forum_topics_count_minus_one($val['forum_id']);
              // List:
              $phpbb2_topics_sql .= (( !empty($phpbb2_topics_sql) ) ? ',' : '') . $val['topic_id'];
	     }

         $phpbb2_template->assign_block_vars('deleted_user_topics', array(
	  	 	'TOPIC_TITLES' => $titanium_user_topic_titles,
            'L_TOPIC_TITLES' => $titanium_lang['Deleted_u_topics']
         	));

         //
         // Get posts in User Topics
         //
         $sql = 'SELECT post_id, topic_id
         FROM ' . POSTS_TABLE . '
         WHERE topic_id IN (' . $phpbb2_topics_sql . ')
         ORDER BY topic_id';
	  	 $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not Get posts in User Topics", "", __LINE__, __FILE__, $sql);
         if (( $titanium_userposts_ids_count = $titanium_db->sql_numrows($result)) > '0' )
         {
            $post_ids = $titanium_db->sql_fetchrowset($result);
            // List of posts
            $phpbb2_posts_sql = '';
            $deleted_posts_in_u_topics_id = '';
      	    foreach($post_ids as $val)
      	    {
               $deleted_posts_in_u_topics_id .= (( !empty($deleted_posts_in_u_topics_id) ) ? ', ' : '') . $val['post_id'] . ' (' . $val['topic_id'] . ')';
               // Resync forum
               forum_postscount_decrease_by_post_id($val['post_id']);
     		   $phpbb2_posts_sql .= (( !empty($phpbb2_posts_sql) ) ? ',' : '') . $val['post_id'];
            }
            // Output
            $phpbb2_template->assign_block_vars('deleted_posts_in_user_topics', array(
	  	 		'DELETED_POSTS_IN_U_TOPICS' => $deleted_posts_in_u_topics_id,
            	'L_DELETED_POSTS_IN_U_TOPICS' => $titanium_lang['deleted_posts_in_user_topics']
         		));

            // Get IDs of users, whose posts are deleted in User Topics
            $sql = 'SELECT poster_id
            FROM ' . POSTS_TABLE . '
            WHERE poster_id != ' . $titanium_user_id. '
            AND post_id IN (' . $phpbb2_posts_sql . ')';
 	  	 	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get users of posts, deleted in this User topics!", "", __LINE__, __FILE__, $sql);
            if (($num_rows = $titanium_db->sql_numrows($result)) > '0'); //Resync will be later!!!
            {
            	$titanium_user_rows = $titanium_db->sql_fetchrowset($result);
            }

            //
            // ----------------  Begin delete  -----------------
            //

            $sql = 'DELETE FROM ' . POSTS_TEXT_TABLE . '
            WHERE post_id IN (' . $phpbb2_posts_sql . ')';
 	  	 	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete post texts!", "", __LINE__, __FILE__, $sql);

            $sql = 'DELETE FROM ' . POSTS_TABLE . '
            WHERE topic_id IN (' . $phpbb2_topics_sql . ')';
 	  	 	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete posts!", "", __LINE__, __FILE__, $sql);

            // Count deleted
            $deleted_posts_in_usertopics = $titanium_db->sql_affectedrows();

            $phpbb2_template->assign_block_vars('num_deleted_posts_in_usertopics', array(
                'NUM_DELETED_POSTS_IN_U_TOPICS' => $deleted_posts_in_usertopics,
                'L_NUM_DELETED_POSTS_IN_U_TOPICS' => $titanium_lang['num_deleted_posts_in_usertopics']
                ));

            $sql = 'DELETE FROM ' . TOPICS_TABLE . '
	        WHERE topic_poster = ' . $titanium_user_id;
 	  	 	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete topics!", "", __LINE__, __FILE__, $sql);
	        // Count deleted
	        $deleted_user_topics = $titanium_db->sql_affectedrows();

	        $phpbb2_template->assign_block_vars('num_of_deleted_user_topics', array(
	        	'NUM_OF_DELETED_TOPICS' => $deleted_user_topics,
	            'L_NUM_OF_DELETED_TOPICS' => $titanium_lang['num_of_deleted_user_topics']
	            ));

            //
            // Get forums where deleted last posts
            //
            $sql = 'SELECT forum_id, forum_name
            FROM ' . FORUMS_TABLE . '
            WHERE forum_last_post_id IN (' . $phpbb2_posts_sql . ')';
 	  	 	$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get forums last post info!", "", __LINE__, __FILE__, $sql);

            if (( $num_of_recync_forums = $titanium_db->sql_numrows($result)) > '0' )
            {
	        	$recync_forums = $titanium_db->sql_fetchrowset($result);
	              // Resync forums
	            $recynced_forums1 = '';
	            foreach($recync_forums as $val)
	            {
                  // set forums last post
                  set_forum_last_post($val['forum_id']);
                  //to output forums
                  $recynced_forums1 .= '� '. $val['forum_name'] . '<br>';
	            }

	            $phpbb2_template->assign_block_vars('forums_with_new_last_posts1', array(
	              'LIST_FORUMS_WHERE_SET_NEW_LASTPOST' => $recynced_forums1,
	              'L_FORUMS_WHERE_SET_NEW_LASTPOST' => $titanium_lang['forums_with_new_last_posts'],
	              'L_NUM_FORUMS_WHERE_SET_NEW_LASTPOST' => $titanium_lang['num_forums_where_deleted_lastpost'],
	              'NUM_FORUMS_WHERE_SET_NEW_LASTPOST' => $num_of_recync_forums
	              ));
            }

            //
            // Recync users, whose posts were deleted
            //
            // Get them
            if ( $num_rows > '0')
            {
                $titanium_user_rows_sql = '';
               	foreach($titanium_user_rows as $val)
                {
                    // List of IDs
                    $titanium_user_rows_sql .= (( !empty($titanium_user_rows_sql) ) ? ',' : '') . $val['poster_id'];
                }

                // Get their names
                $sql = 'SELECT user_id, username
                FROM ' . USERS_TABLE . '
                WHERE user_id IN (' . $titanium_user_rows_sql . ')';
 	  	 		$result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get users info!", "", __LINE__, __FILE__, $sql);
                $num_users = $titanium_db->sql_numrows($result);
                $titanium_users_recync = $titanium_db->sql_fetchrowset($result);

                $recynced_users1 = '';
                for( $i = 0; $i < $num_users; $i++ )
              	{
				  // get post count
                  $post_count = get_post_count($titanium_users_recync[$i]['user_id']);
                  // set it
                  set_post_count($titanium_users_recync[$i]['user_id'], $post_count);
                  // list them
                  $recynced_users1 .= (( !empty($recynced_users1) ) ? ', ' : '') . $titanium_users_recync[$i]['username'];
                }

                // Number of users
               	$phpbb2_template->assign_block_vars('recynced_users_in_usertopics', array(
                	'LIST_RECYNCED_USERS_IN_U_TOPICS' => $recynced_users1,
                	'L_RECYNCED_USERS_IN_U_TOPICS' => $titanium_lang['recynced_users_in_usertopics'],
                    'L_TOTAL_USERS_IN_U_TOPICS' => $titanium_lang['num_of_other_users_in_u_topics'],
                    'TOTAL_USERS_IN_U_TOPICS' => $num_users
                	));
            }
       }
   }
}


//##############################################################################
//   START - SECTION 2 - DELETE TOPICS WHERE POSTS OF THE USER AND NOTHING MORE
//##############################################################################

//Get topics
if (($mode == 3) || ($mode == 4))
{
	$sql = "SELECT topic_id
	FROM " . POSTS_TABLE . "
	WHERE poster_id = $titanium_user_id";
	  $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get posts of User!", "", __LINE__, __FILE__, $sql);
	  if ( ( $titanium_user_posts_in_other_topics = $titanium_db->sql_numrows($result)) > '0' )
	  {
	        $otheruserpost_ids = $titanium_db->sql_fetchrowset($result);
	        // List
	        $phpbb2_topics_with_u_posts_sql = '';
	        foreach($otheruserpost_ids as $val)
	        {
	            $phpbb2_topics_with_u_posts_sql .= (( !empty($phpbb2_topics_with_u_posts_sql) ) ? ',' : '') . $val['topic_id'];
	        }
	        //
	        // Get topics
	        //
	        $sql = "SELECT topic_id
	        FROM " . TOPICS_TABLE . "
	        WHERE topic_id IN (" . $phpbb2_topics_with_u_posts_sql . ")";
	        $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get topics whith user posts!", "", __LINE__, __FILE__, $sql);
	        $phpbb2_topics_with_user_posts = $titanium_db->sql_fetchrowset($result);

	        // Check if posts of one User - which deleted
	        $phpbb2_topics_with_posts_of_user_only_sql = '';
	        $phpbb2_posts_in_topics_with_posts_of_user_only_sql = '';
	        foreach($phpbb2_topics_with_user_posts as $val)
	        {
	            $sql = "SELECT post_id
	            FROM " . POSTS_TABLE . "
	            WHERE topic_id = " . $val['topic_id'];
	            $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not query posts in topic!", "", __LINE__, __FILE__, $sql);
	            $all_topic_posts_count = $titanium_db->sql_numrows($result);

	            $sql = "SELECT post_id
	            FROM " . POSTS_TABLE . "
	            WHERE topic_id = " . $val['topic_id'] . "
	            AND poster_id = " . $titanium_user_id;
	            $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not query user posts topic", "", __LINE__, __FILE__, $sql);
	            $titanium_user_topic_posts_count = $titanium_db->sql_numrows($result);

	            if ($all_topic_posts_count == $titanium_user_topic_posts_count)
	            {
	                // List topics where only User's posts
	                $phpbb2_topics_with_posts_of_user_only_sql .= (( !empty($phpbb2_topics_with_posts_of_user_only_sql) ) ? ',' : '') . $val['topic_id'];
	                $phpbb2_posts_in_topics_with_posts_of_user_only_sql .= (( !empty($phpbb2_posts_in_topics_with_posts_of_user_only_sql) ) ? ',' : '') . $val['post_id'];
	            }
	        }
	        //
	        // Get these topics
	        //
	        if (!empty($phpbb2_topics_with_posts_of_user_only_sql))
	        {
	          $sql = "SELECT topic_id, topic_title, forum_id
	            FROM " . TOPICS_TABLE . "
	            WHERE topic_id IN (" . $phpbb2_topics_with_posts_of_user_only_sql . ")";
	            $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get topics where only User posts!", "", __LINE__, __FILE__, $sql);
	            $phpbb2_topics_with_user_posts_num = $titanium_db->sql_numrows($result);
	            $phpbb2_topics_with_user_posts = $titanium_db->sql_fetchrowset($result);

                $deleted_topics2_titles = '';
                $phpbb2_topics2_del_sql = '';
                foreach($phpbb2_topics_with_user_posts as $val)
	        	{
	                // ����� ������ ���
	                $deleted_topics2_titles .= '� ['. $val['topic_id']. '] '. $val['topic_title'] . '<br>';
	                // �������� ������� ��� ������ �� ���� ����
	                forum_topics_count_minus_one($val['forum_id']);
                    // ��� ������� �� ��������
                    $phpbb2_topics2_del_sql .= (( !empty($phpbb2_topics2_del_sql) ) ? ',' : '') . $val['topic_id'];
                }

	          $sql = "SELECT post_id, topic_id
	            FROM " . POSTS_TABLE . "
	            WHERE topic_id IN (" . $phpbb2_topics2_del_sql . ")";
	            $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get posts of User in topics where they are only!", "", __LINE__, __FILE__, $sql);
	            $phpbb2_posts_in_topics_with_only_user_posts_num = $titanium_db->sql_numrows($result);
	            $phpbb2_posts_in_topics_with_only_user_posts = $titanium_db->sql_fetchrowset($result);

                $deleted_posts_in_u_topics2_id = '';
                $phpbb2_posts2_del_sql = '';
                foreach($phpbb2_posts_in_topics_with_only_user_posts as $val)
	        	{
                    //Resync forum
                    forum_postscount_decrease_by_post_id($val['post_id']);

                    // List topics
	       			$deleted_posts_in_u_topics2 .= (( !empty($deleted_posts_in_u_topics2) ) ? ', ' : '') . $val['post_id'] . ' ( <i>t.' . $val['topic_id'] . '</i> )';

                    // List for deletion
                    $phpbb2_posts2_del_sql .= (( !empty($phpbb2_posts2_del_sql) ) ? ',' : '') . $val['post_id'];
                }

                //
                //###################  Now delete ########################
                //
                $sql = 'DELETE FROM ' . POSTS_TEXT_TABLE . '
                WHERE post_id IN (' . $phpbb2_posts2_del_sql . ')';
                $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete posts!", "", __LINE__, __FILE__, $sql);

                $sql = 'DELETE FROM ' . POSTS_TABLE . '
                WHERE post_id IN (' . $phpbb2_posts2_del_sql . ')';
                $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete post!", "", __LINE__, __FILE__, $sql);
                // Count deleted
                $num_deleted_posts_in_usertopics2 = $titanium_db->sql_affectedrows();

                $sql = 'DELETE FROM ' . TOPICS_TABLE . '
                WHERE topic_id IN (' . $phpbb2_topics2_del_sql . ')';
                $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete topics where only User posts!", "", __LINE__, __FILE__, $sql);
                // Count deleted
                $deleted_user_topics2 = $titanium_db->sql_affectedrows();

                $phpbb2_template->assign_block_vars('topics_where_only_this_user_posts', array(
                    'L_DELETED_TOPICS2' => $titanium_lang['deleted_user_topics2'],
                    'LIST_DELETED_TOPICS2' => $deleted_topics2_titles,
                    'TOTAL_DELETED_TOPICS2' => $deleted_user_topics2,
                    'L_TOTAL' => $titanium_lang['Total'],

                    'LIST_DELETED_POSTS_IN_U_TOPICS2' => $deleted_posts_in_u_topics2,
                    'TOTAL_DELETED_POSTS_IN_U_TOPICS2' => $num_deleted_posts_in_usertopics2,
                    'L_DELETED_POSTS_IN_U_TOPICS2' => $titanium_lang['deleted_posts_in_usertopics2']
                    ));

                //
	            // Get forums to resync last posts
	            //
	            $sql = 'SELECT forum_id, forum_name
	            FROM ' . FORUMS_TABLE . '
	            WHERE forum_last_post_id IN (' . $phpbb2_posts2_del_sql . ')';
	            $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get forums last posts!", "", __LINE__, __FILE__, $sql);
	            if (( $num_of_recync_forums2 = $titanium_db->sql_numrows($result)) > '0' )
	            {
                    $recync_forums2 = $titanium_db->sql_fetchrowset($result);
                    // ��������������  ���������� ����� ������ (forum_last_post_id)
                    $recynced_forums2 = '';
                    foreach($recync_forums2 as $val)
                    {
                          // set forums last post
                          set_forum_last_post($val['forum_id']);
                          //to output forums
                          $recynced_forums2 .= '� '. $val['forum_name'] . '<br>';
                    }
                   $phpbb2_template->assign_block_vars('forums_with_new_last_posts2', array(
                        'L_FORUMS_WHERE_SET_NEW_LASTPOST2' => $titanium_lang['forums_with_new_last_posts'],
                        'L_NUM_FORUMS_WHERE_SET_NEW_LASTPOST2' => $titanium_lang['num_forums_where_deleted_lastpost'],
                        'NUM_FORUMS_WHERE_SET_NEW_LASTPOST2' => $num_of_recync_forums2,
	                    'LIST_FORUMS_WHERE_SET_NEW_LASTPOST2' => $recynced_forums2,
	                    ));
	            }
			}
    }

//##################################################################
//               END - SECTION 2
//##################################################################

    //
    // Get User posts from other topics
    //
    $sql = "SELECT post_id, topic_id
    FROM " . POSTS_TABLE . "
    WHERE poster_id = $titanium_user_id";
    $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get User posts in other topics!", "", __LINE__, __FILE__, $sql);
    if ( ( $titanium_user_posts_in_other_topics = $titanium_db->sql_numrows($result)) > '0' )
    {
	        $otheruserpost_ids = $titanium_db->sql_fetchrowset($result);
	        // List of posts
	        $otheruserpost_ids_sql = '';
	        foreach($otheruserpost_ids as $val)
	        {
	               $otheruserpost_ids_sql .= (( !empty($otheruserpost_ids_sql) ) ? ',' : '') . $val['post_id'];
                   // Listing
                   $deleted_posts_in_other_topics_list .= (( !empty($deleted_posts_in_other_topics_list) ) ? ', ' : '') . $val['post_id'] . ' ( t.' . $val['topic_id'] . ')';

	               // Resync topic replies count
	               topic_replyes_count_decrease($val['post_id']);

	               // Resync forums posts number
	               forum_postscount_decrease_by_post_id($val['post_id']);
	         }

	        $sql = 'DELETE FROM ' . POSTS_TABLE . '
	        WHERE post_id IN (' . $otheruserpost_ids_sql .')';
	        $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete post of User in other topic!", "", __LINE__, __FILE__, $sql);
	        //Count deleted
	        $deleted_userposts = $titanium_db->sql_affectedrows();


	        $sql = 'DELETE FROM ' . POSTS_TEXT_TABLE . '
	        WHERE post_id IN (' . $otheruserpost_ids_sql .')';
	        $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not delete post of User in other topic!", "", __LINE__, __FILE__, $sql);
	        $deleted_user_post�xts = $titanium_db->sql_affectedrows();

	        $phpbb2_template->assign_block_vars('all_other_user_posts_in_other_topics', array(
                'L_OTHER_POSTS' => $titanium_lang['all_other_uposts'],
                'LIST_DELETED_OTHER_POSTS' => $deleted_posts_in_other_topics_list,

                'L_TOTAL' => $titanium_lang['Total'],
	            'NUM_OF_OTHER_POSTS' => $deleted_userposts
	            ));

	        //
	        // Get topics where deleted posts were last posts ( to resync )
	        //
	        $sql = 'SELECT topic_id, topic_title
	        FROM ' . TOPICS_TABLE . '
	        WHERE topic_last_post_id IN (' . $otheruserpost_ids_sql . ')
	        OR topic_first_post_id IN (' . $otheruserpost_ids_sql . ')';
	        $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Get topics where deleted posts were last posts ( to resync )!", "", __LINE__, __FILE__, $sql);
	        if (( $num_topics_with_deleted_fl_posts = $titanium_db->sql_numrows($result)) > '0' )
	        {
	           $phpbb2_topicscync_ids = $titanium_db->sql_fetchrowset($result);
	           // Resync topics
               $phpbb2_topics_recynced_first_or_last_posts_list = '';
	           foreach($phpbb2_topicscync_ids as $val)
	           {
	               // List topics
	               $phpbb2_topics_recynced_first_or_last_posts_list .= '� [ '. $val['topic_id']. ' ] '. $val['topic_title'] . '<br>';
	               topic_max_post_recync($val['topic_id']);
	               topic_min_post_recync($val['topic_id']);
               }
	           $phpbb2_template->assign_block_vars('topics_to_recync_first_or_lastpost', array(
                    'L_TOPIC_TO_RECYNK_FIRST_LAST_POSTS' => $titanium_lang['topics_to_recync_first_or_lastpost'],
                    'LIST_TOPICS_TO_RECYNK_FIRST_LAST_POSTS' => $phpbb2_topics_recynced_first_or_last_posts_list,
	                'NUM_TOPICS_TO_RECYNK_FIRST_LAST_POSTS' => $num_topics_with_deleted_fl_posts,
	                'TOTAL' => $titanium_lang['Total']
	                ));
	        }

   	     	//
	        // Resync forums last post
	        //
	        $sql = 'SELECT forum_id, forum_name
	        FROM ' . FORUMS_TABLE . '
	        WHERE forum_last_post_id IN (' . $otheruserpost_ids_sql . ')';
	        $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Can not get forum last posts ( to resync )!", "", __LINE__, __FILE__, $sql);
	        if (( $num_of_recync_forums3 = $titanium_db->sql_numrows($result)) > '0' )
	        {
	            $recync_forums3 = $titanium_db->sql_fetchrowset($result);
	            // ��������������  ���������� ����� ������ (forum_last_post_id)
	            $recynced_forums3 = '';
	            foreach( $recync_forums3 as $val  )
	            {
	                  // set forums last post
	                  set_forum_last_post($val['forum_id']);
	                  //to output forums
	                  $recynced_forums3 .= '� '. $val['forum_name'] . '<br>';
	            }

	          $phpbb2_template->assign_block_vars('forums_where_deleted_lastpost3', array(
                'L_FORUMS_WHERE_SET_NEW_LASTPOST3' => $titanium_lang['forums_with_new_last_posts'],
	            'LIST_FORUMS_WHERE_SET_NEW_LASTPOST3' => $recynced_forums3,

	            'NUM_FORUMS_WHERE_SET_NEW_LASTPOST3' => $num_of_recync_forums3,
                'L_NUM_FORUMS_WHERE_SET_NEW_LASTPOST3' => $titanium_lang['num_forums_where_deleted_lastpost']
	            ));
	         }
   }
  else // no User posts in other topics
   {
        $phpbb2_template->assign_block_vars('no_other_uposts_in_other_topics', array(
            'L_NO_OTHER_UPOSTS_IN_OTHERTOPICS' => $titanium_lang['No_other_uposts_in_other_topics']
            ));
   }
}


/* #############################################################################
           START - SECTION 3 - DELETE ONLY USER without his (her) postings
###############################################################################*/

if ($mode == 1)
{
  	$sql = "UPDATE " . POSTS_TABLE . "
       	SET poster_id = " . DELETED . ", post_username = '$titanium_username'
       	WHERE poster_id = $titanium_user_id";
	    $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not update posts for this user!", "", __LINE__, __FILE__, $sql);

    $sql = "UPDATE " . TOPICS_TABLE . "
        SET topic_poster = " . DELETED . "
        WHERE topic_poster = $titanium_user_id";
	    $result = $titanium_db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not update topics for this user!", "", __LINE__, __FILE__, $sql);
}

/* #############################################################################

           START - SECTION 4 - DELETE THE USER
( this code taken directly from admin_users.php of phpBB 2.0.19 - no changes in code was made)

###############################################################################*/

if ($mode != 4)
	{
			$sql = "SELECT g.group_id
				FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
				WHERE ug.user_id = $titanium_user_id
					AND g.group_id = ug.group_id
					AND g.group_single_user = 1";
			if( !($result = $titanium_db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
			}

			$row = $titanium_db->sql_fetchrow($result);

			$sql = "UPDATE " . VOTE_USERS_TABLE . "
				SET vote_user_id = " . DELETED . "
				WHERE vote_user_id = $titanium_user_id";
			if( !$titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "SELECT group_id
				FROM " . GROUPS_TABLE . "
				WHERE group_moderator = $titanium_user_id";
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
				WHERE user_id = $titanium_user_id";
			if( !$titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . USER_GROUP_TABLE . "
				WHERE user_id = $titanium_user_id";
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
				WHERE user_id = $titanium_user_id";
			if ( !$titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . BANLIST_TABLE . "
				WHERE ban_userid = $titanium_user_id";
			if ( !$titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . SESSIONS_TABLE . "
				WHERE session_user_id = $titanium_user_id";
			if ( !$titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete sessions for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . SESSIONS_KEYS_TABLE . "
				WHERE user_id = $titanium_user_id";
			if ( !$titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete auto-login keys for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "SELECT privmsgs_id
				FROM " . PRIVMSGS_TABLE . "
				WHERE privmsgs_from_userid = $titanium_user_id
					OR privmsgs_to_userid = $titanium_user_id";
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
    }
    else
    {
     set_post_count($titanium_user_id, 0);
    }

//
//  Now output
//

$phpbb2_template->assign_vars(array(
	'L_DELETION_TITLE' => sprintf($final_anno, $titanium_user_name),

    'RETURN_TO_INDEX' => sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>'),
    'RETURN_TO_MEMBERLIST' => sprintf($titanium_lang['Click_return_to_authors'], '<a href="' . append_titanium_sid("memberlist.$phpEx") . '">', '</a>')
	));

if ($mode == 1)
{
   $phpbb2_template->assign_block_vars('resume_to_simple_deletion', array(
	 'RESUME_TO_SIMPLE_DELETION'=> sprintf($titanium_lang['Resume_to_simple_user_deletion'], $total_phpbb2_topics, $phpbb2_total_posts)
       ));
}


$phpbb2_template->pparse('body');

include("includes/page_tail.php");

?>