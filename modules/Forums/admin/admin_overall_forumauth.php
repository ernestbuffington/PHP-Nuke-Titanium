<?php
/***************************************************************************
 *                         admin_overall_forumauth.php
 *                            -------------------
 *   begin                : Friday, July 12, 2002
 *   copyright            : (C) 2002 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: admin_overall_forumauth.php,v 1.0.2 2002/8/08, 19:41:51 hnt Exp $
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

//$phpbb2_forum_id = 2; // You could change this value unless forum ID 3 did not exist in your board

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$titanium_module['Forums']['Overall Permissions']   = $filename . '?' . POST_FORUM_URL . "=$phpbb2_forum_id";

	return;
}

//
// Load default header
//
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Start program - define vars
//
//                View      Read      Post      Reply     Edit     Delete    Sticky   Announce    Vote      Poll     Global   Post Att  Download
$simple_auth_ary = array(
	0  => array(AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ALL),
	1  => array(AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ALL),
	2  => array(AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG),
	3  => array(AUTH_ALL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_MOD, AUTH_ACL),
	4  => array(AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_MOD, AUTH_ACL),
	5  => array(AUTH_ALL, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD),
	6  => array(AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD),
);

$simple_auth_types = array($titanium_lang['Public'], $titanium_lang['Registered'], $titanium_lang['Registered'] . ' [' . $titanium_lang['Hidden'] . ']', $titanium_lang['Private'], $titanium_lang['Private'] . ' [' . $titanium_lang['Hidden'] . ']', $titanium_lang['Moderators'], $titanium_lang['Moderators'] . ' [' . $titanium_lang['Hidden'] . ']');

$forum_auth_fields = array('auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_vote', 'auth_pollcreate', 'auth_globalannounce', 'auth_attachments', 'auth_download');

$field_names = array(
	'auth_view' => $titanium_lang['View'],
	'auth_read' => $titanium_lang['Read'],
	'auth_post' => $titanium_lang['Post'],
	'auth_reply' => $titanium_lang['Reply'],
	'auth_edit' => $titanium_lang['Edit'],
	'auth_delete' => $titanium_lang['Delete'],
	'auth_sticky' => $titanium_lang['Sticky'],
	'auth_announce' => $titanium_lang['Announce'], 
	'auth_vote' => $titanium_lang['Vote'], 
	'auth_pollcreate' => $titanium_lang['Pollcreate'],
	'auth_globalannounce' => $titanium_lang['Globalannounce'],
	'auth_attachments' => $titanium_lang['Auth_attach'],
	'auth_download' => $titanium_lang['Auth_download']
	);

$forum_auth_levels = array('ALL', 'REG', 'PRIVATE', 'MOD', 'ADMIN');
$forum_auth_const = array(AUTH_ALL, AUTH_REG, AUTH_ACL, AUTH_MOD, AUTH_ADMIN);
$forum_auth_images = array(
	AUTH_ALL => 'ALL', 
	AUTH_REG => 'REG', 
	AUTH_ACL => 'PRIVATE', 
	AUTH_MOD => 'MOD', 
	AUTH_ADMIN => 'ADMIN',
);
$forum_auth_cats = array(
	'VIEW' => 'auth_view', 
	'READ' => 'auth_read', 
	'POST' => 'auth_post', 
	'REPLY' => 'auth_reply', 
	'EDIT' => 'auth_edit', 
	'DELETE' => 'auth_delete', 
	'STICKY' => 'auth_sticky', 
	'ANNOUNCE' => 'auth_announce', 
	'VOTE' => 'auth_vote', 
	'POLLCREATE' => 'auth_pollcreate',
	'GLOBALANNOUNCE' => 'auth_globalannounce',
	'ATTACHMENTS' => 'auth_attachments',
	'DOWNLOAD' => 'auth_download'
);

for($i=0; $i<count($forum_auth_const); $i++) {
	$auth_key .= '<img src="../../../images/spacer.gif" width=10 height=10 class="' . $forum_auth_classes[$forum_auth_const[$i]] . '">&nbsp;' . $forum_auth_levels[$i] . '&nbsp;&nbsp;';		
	$phpbb2_template->assign_block_vars("authedit",	array(
		'CLASS' => $forum_auth_classes[$forum_auth_const[$i]],
		'NAME' => $forum_auth_levels[$i],
		'VALUE' => $forum_auth_const[$i],
	));
}

if( isset($HTTP_GET_VARS['adv']) )
{
	$adv = intval($HTTP_GET_VARS['adv']);
}
else
{
	unset($adv);
}

$phpbb2_template->set_filenames(array(
	"body" => "admin/auth_overall_forum_body.tpl")
);
//
// Start program proper
//
if( isset($HTTP_POST_VARS['submit']) ) 
{
	foreach($_POST['auth'] as $phpbb2_forum_id => $forum) {
		$phpbb2_forum_id = intval($phpbb2_forum_id);
		$sql = '';
		foreach($forum as $a => $newval) {
			if ($newval && in_array($newval, $forum_auth_levels) && array_key_exists($a, $forum_auth_cats)) { // Changed and is valid
				$sql .= ( ( $sql != '' ) ? ', ' : '' ) . $forum_auth_cats[$a] . '=' . array_search($newval, $forum_auth_images);
			}
		}
		if ($sql != '') {
			$sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $phpbb2_forum_id;";
			if ( !$titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update auth table', '', __LINE__, __FILE__, $sql);
			}
		}
	}
} // End of submit

//
$sql = "SELECT cat_id, cat_title, cat_order
	FROM " . CATEGORIES_TABLE . "
	ORDER BY cat_order";
if( !$q_categories = $titanium_db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);
}

if( $total_phpbb2_categories = $titanium_db->sql_numrows($q_categories) ) 
{
	$category_rows = $titanium_db->sql_fetchrowset($q_categories);

	$sql = "SELECT *
		FROM " . FORUMS_TABLE . "
		ORDER BY cat_id, forum_order";
	if(!$q_forums = $titanium_db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);
	}

	if( $total_phpbb2_forums = $titanium_db->sql_numrows($q_forums) )
	{
		$forum_rows = $titanium_db->sql_fetchrowset($q_forums);
	}

	//
	// Okay, let's build the index
	//
	$gen_cat = array();

	for($i = 0; $i < $total_phpbb2_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		$phpbb2_template->assign_block_vars("catrow", array( 
			'CAT_ID' => $cat_id,
			'CAT_DESC' => $category_rows[$i]['cat_title'],
		));

		for($j = 0; $j < $total_phpbb2_forums; $j++)
		{
			$phpbb2_forum_id = $forum_rows[$j]['forum_id'];
			
			if ($forum_rows[$j]['cat_id'] == $cat_id)
			{

				$phpbb2_template->assign_block_vars("catrow.forumrow",	array(
					'FORUM_NAME' => $forum_rows[$j]['forum_name'],
					'FORUM_ID' => $forum_rows[$j]['forum_id'],
					'ROW_COLOR' => $row_color,
					'AUTH_VIEW_IMG' => $forum_auth_images[$forum_rows[$j]['auth_view']],
					'AUTH_READ_IMG' => $forum_auth_images[$forum_rows[$j]['auth_read']],
					'AUTH_POST_IMG' => $forum_auth_images[$forum_rows[$j]['auth_post']],
					'AUTH_REPLY_IMG' => $forum_auth_images[$forum_rows[$j]['auth_reply']],
					'AUTH_EDIT_IMG' => $forum_auth_images[$forum_rows[$j]['auth_edit']],
					'AUTH_DELETE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_delete']],
					'AUTH_STICKY_IMG' => $forum_auth_images[$forum_rows[$j]['auth_sticky']],
					'AUTH_ANNOUNCE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_announce']],
					'AUTH_VOTE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_vote']],
					'AUTH_POLLCREATE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_pollcreate']],
					'AUTH_GLOBALANNOUNCE_IMG' => $forum_auth_images[$forum_rows[$j]['auth_announce']],
					'AUTH_ATTACHMENTS_IMG' => $forum_auth_images[$forum_rows[$j]['auth_attachments']],
					'AUTH_DOWNLOAD_IMG' => $forum_auth_images[$forum_rows[$j]['auth_download']],
				));
			}// if ... forumid == catid
			
		} // for ... forums

	} // for ... categories

}// if ... total_categories

$phpbb2_template->assign_vars(array(
	'L_FORUM_TITLE' => $titanium_lang['Auth_Control_Forum'],
	'L_FORUM_EXPLAIN' => $titanium_lang['Forum_auth_explain_overall'],
	'L_FORUM_EXPLAIN_EDIT' => $titanium_lang['Forum_auth_explain_overall_edit'],
	'L_FORUM_OVERALL_RESTORE' => $titanium_lang['Forum_auth_overall_restore'],
	'L_FORUM_OVERALL_STOP' => $titanium_lang['Forum_auth_overall_stop'],
	'L_SUBMIT' => $titanium_lang['Submit'],
	'AUTH_KEY' => $auth_key,
));

$phpbb2_template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>