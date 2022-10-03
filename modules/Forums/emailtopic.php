<?php

/***************************************************************************
 *                               emailtopic.php
 *                            --------------------
 *  Hack:   Email topic to friend 1.0.1
 *  Copyright:  �2003 Freakin' Booty ;-P
 *  Website:  http://freakingbooty.no-ip.com
 *  Support:  http://www.phpbbhacks.com/forums
 *
 *  $Id: emailtopic.php,v 1.1.2.7.4.2 2004/09/12 16:26:54 vincentg Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *  This hack is released under the GPL License.
 *  This hack can be freely used, but not distributed, without permission.
 *  Intellectual Property is retained by the hack author(s) listed above.
 ***************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ($popup != "1")
{
    $titanium_module_name = basename(dirname(__FILE__));
    require("modules/".$titanium_module_name."/nukebb.php");
}
else
{
    $phpbb2_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB2', TRUE);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);


//
// Parameters
//
$post_id = (isset($HTTP_GET_VARS[POST_POST_URL])) ? intval($HTTP_GET_VARS[POST_POST_URL]) : ((isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : 0);
$topic_id = (isset($HTTP_GET_VARS[POST_TOPIC_URL])) ? intval($HTTP_GET_VARS[POST_TOPIC_URL]) : ((isset($HTTP_POST_VARS[POST_TOPIC_URL])) ? intval($HTTP_POST_VARS[POST_TOPIC_URL]) : 0);
$phpbb2_start = (isset($HTTP_GET_VARS['start'])) ? intval($HTTP_GET_VARS['start']) : ((isset($HTTP_POST_VARS['start'])) ? intval($HTTP_POST_VARS['start']) : 0);


//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_PROFILE);
titanium_init_userprefs($userdata);
//
// End session management
//


if(!$userdata['session_logged_in'])
{
  $redirect = ($post_id) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id&start=$phpbb2_start";
  redirect_titanium(append_titanium_sid("login.$phpEx?redirect=emailtopic.$phpEx&$redirect", true));
}


// Check if the specified ID('s) exist
$sql = ($post_id) ? 'SELECT t.topic_id, t.topic_title, t.forum_id, p.post_id FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p WHERE p.post_id = ' . $post_id . ' AND t.topic_id = p.topic_id' : 'SELECT topic_id, topic_title, forum_id FROM ' . TOPICS_TABLE . ' WHERE topic_id = ' . $topic_id;
if(!$result = $titanium_db->sql_query($sql))
{
  message_die(GENERAL_ERROR, 'Could not obtain topic information', __LINE__, __FILE__, $sql);
}
$row = $titanium_db->sql_fetchrow($result);
$titanium_db->sql_freeresult($result);

$topic_title = $row['topic_title'];
$topic_id = $row['topic_id'];
$phpbb2_forum_id = $row['forum_id'];
$post_id = $row['post_id'];


// If neither a topic nor post are specified, DIE!
if(!$topic_id && !$post_id)
{
  message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}


//
// Uncomment the following lines to make a limit for the users.
// $email_limit sets the maximum number of emails.
// $email_time sets the time window for the limit (in hours).
//
/*
$email_limit = 5;
$email_time = 24;
$current_time = time();
$sql = 'SELECT COUNT(user_id) AS total
    FROM ' . TOPICS_EMAIL_TABLE . '
    WHERE user_id = ' . $userdata['user_id'] . '
    AND time >= ' . ($current_time - ($email_time * 3600));
if(!$result = $titanium_db->sql_query($sql))
{
  message_die(GENERAL_ERROR, 'Could not obtain user\'s email informaton', __LINE__, __FILE__, $sql);
}

$row = $titanium_db->sql_fetchrow($result);
$titanium_db->sql_freeresult($result);
if($row['total'] >= $email_limit)
{
  message_die(GENERAL_MESSAGE, sprintf($titanium_lang['Email_max_exceeded'], $email_limit, $email_time));
}
*/


// If the form was submitted we have got work to do
if(isset($_POST['submit']))
{
  $friend_name = (isset($HTTP_POST_VARS['friend_name'])) ? strip_tags(trim($HTTP_POST_VARS['friend_name'])) : '';
  $friend_email = (isset($HTTP_POST_VARS['friend_email'])) ? strip_tags(trim($HTTP_POST_VARS['friend_email'])) : '';
  $message = (isset($HTTP_POST_VARS['message'])) ? strip_tags(trim($HTTP_POST_VARS['message'])) : '';

  if(strlen($friend_name) < 3 || strlen($friend_email) < 3)
  {
    message_die(GENERAL_MESSAGE, $titanium_lang['No_friend_specified']);
  }

  if(strlen($friend_name) > 100)
  {
    message_die(GENERAL_MESSAGE, $titanium_lang['Friend_name_too_long']);
  }

  if(strlen($message) > 255)
  {
    message_die(GENERAL_MESSAGE, $titanium_lang['Message_too_long']);
  }


  // Send the email, but only after we prepared the board URL
  $server_protocol = ($phpbb2_board_config['cookie_secure']) ? 'https://' : 'http://';
  $server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($phpbb2_board_config['server_name']));
  $server_port = ($phpbb2_board_config['server_port'] <> 80) ? ':' . trim($phpbb2_board_config['server_port']) . '/' : '/';
  $script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($phpbb2_board_config['script_path']));
  $script_name = ($script_name != '') ? 'modules.php?name=Forums&file=viewtopic&' : 'modules.php?name=Forums&file=viewtopic&';
  $u_viewtopic = $server_protocol . $server_name . $server_port . $script_name . POST_TOPIC_URL . "=$topic_id";

  include('includes/emailer.'.$phpEx);
  $emailer = new emailer($phpbb2_board_config['smtp_delivery']);
  $emailer->use_template('email_topic', $userdata['user_lang']);
  $emailer->email_address($friend_email);
  $emailer->set_subject($titanium_lang['Email_topic']);
  $emailer->assign_vars(array(
    'SITENAME'    => $phpbb2_board_config['sitename'],
    'USERNAME'    => $userdata['username'],
    'FRIEND_NAME' => stripslashes($friend_name),
    'MESSAGE'   => stripslashes($message),
    'TOPIC'     => $topic_title,

    'BOARD_EMAIL' => $phpbb2_board_config['board_email'],
    'EMAIL_SIG'   => (!empty($phpbb2_board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $phpbb2_board_config['board_email_sig']) : '',

    'U_TOPIC'   => $u_viewtopic
  ));
  $emailer->send();
  $emailer->reset();


  // Add record to database
  $current_time = time();
  $sql = "INSERT INTO " . TOPICS_EMAIL_TABLE . " (user_id, friend_name, friend_email, message, topic_id, time) VALUES (" . $userdata['user_id'] . ", '" . str_replace("\'", "''", $friend_name) . "', '" . str_replace ("\'", "''", $friend_email) . "', '" . str_replace ("\'", "''", $message) . "', $topic_id, $current_time)";
  if(!$result = $titanium_db->sql_query($sql))
  {
    message_die(GENERAL_ERROR, 'Could not insert topic email data', __LINE__, __FILE__, $sql);
  }


  // All done - add the post anchor if a post ID was specified, and redirect to the original topic
  $redirect = ($post_id) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id&amp;start=$phpbb2_start";
  $phpbb2_template->assign_var('META', '<meta http-equiv="refresh" content="3; url=' . append_titanium_sid("viewtopic.$phpEx?$redirect") . (($post_id) ? "#$post_id" : '') . '" />');

  $msg = $titanium_lang['Email_sent'] . '<br /><br />' . sprintf($titanium_lang['Click_return_topic'], '<a href="' . append_titanium_sid("viewtopic.$phpEx?$redirect") . (($post_id) ? "#$post_id" : '') . '">', '</a>') . '<br /><br />' . sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>');
  message_die(GENERAL_MESSAGE, $msg);
}


//
// Default page
//
$s_hidden_fields = '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
$s_hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
$s_hidden_fields .= '<input type="hidden" name="start" value="' . $phpbb2_start . '" />';


// Output page to template
$phpbb2_page_title = $titanium_lang['Email_topic'];
include('includes/page_header.'.$phpEx);

$phpbb2_template->set_filenames(array('body' => 'email_topic_body.tpl'));

make_jumpbox('viewforum.'.$phpEx, $phpbb2_forum_id);

$phpbb2_template->assign_vars(array(
  'L_TITLE'     => $titanium_lang['Email_topic_settings'],

  'L_FRIEND_NAME'   => $titanium_lang['Friend_name'],
  'L_FRIEND_EMAIL'  => $titanium_lang['Friend_email'],
  'L_MESSAGE'     => $titanium_lang['Message'],
  'L_MESSAGE_EXPLAIN' => $titanium_lang['Message_explain'],
  'L_SUBJECT'     => $titanium_lang['Subject'],
  'L_SUBMIT'      => $titanium_lang['Submit'],

  'TOPIC_TITLE'   => $topic_title,

  'S_EMAIL_ACTION'  => append_titanium_sid("emailtopic.$phpEx"),
  'S_HIDDEN_FIELDS' => $s_hidden_fields
));

$phpbb2_template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>