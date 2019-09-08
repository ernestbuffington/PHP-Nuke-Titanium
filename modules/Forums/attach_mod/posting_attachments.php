<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/**
*
* @package attachment_mod
* @version $Id: posting_attachments.php,v 1.7 2005/11/15 20:20:43 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

/**
* @package attachment_mod
* Base Class for Attaching
*/
class attach_parent
{
    var $post_attach = false;
    var $attach_filename = '';
    var $filename = '';
    var $type = '';
    var $extension = '';
    var $file_comment = '';
    var $num_attachments = 0; // number of attachments in message
    var $filesize = 0;
    var $filetime = 0;
    var $thumbnail = 0;
    var $page = 0; // On which page we are on ? This should be filled by child classes.

    // Switches
    var $add_attachment_body = 0;
    var $posted_attachments_body = 0;

    /**
    * Constructor
    */
    function __construct()
    {
        global $HTTP_POST_VARS, $HTTP_POST_FILES;

        $this->add_attachment_body = get_var('add_attachment_body', 0);
        $this->posted_attachments_body = get_var('posted_attachments_body', 0);

        $this->file_comment                    = get_var('filecomment', '');
        $this->attachment_id_list            = get_var('attach_id_list', array(0));
        $this->attachment_comment_list        = get_var('comment_list', array(''), true);
        $this->attachment_filesize_list        = get_var('filesize_list', array(0));
        $this->attachment_filetime_list        = get_var('filetime_list', array(0));
        $this->attachment_filename_list        = get_var('filename_list', array(''));
        $this->attachment_extension_list    = get_var('extension_list', array(''));
        $this->attachment_mimetype_list        = get_var('mimetype_list', array(''));

        $this->filename = (isset($HTTP_POST_FILES['fileupload']) && isset($HTTP_POST_FILES['fileupload']['name']) && $HTTP_POST_FILES['fileupload']['name'] != 'none') ? trim(stripslashes($HTTP_POST_FILES['fileupload']['name'])) : '';

        $this->attachment_list = get_var('attachment_list', array(''));
        $this->attachment_thumbnail_list = get_var('attach_thumbnail_list', array(0));
    }

    function attach_parent()
    {
        self::__construct();
    }

    /**
    * Get Quota Limits
    */
    function get_quota_limits($userdata_quota, $user_id = 0)
    {
        global $attach_config, $db;

        //
        // Define Filesize Limits (Prepare Quota Settings)
        // Priority: User, Group, Management
        //
        // This method is somewhat query intensive, but i think because this one is only executed while attaching a file,
        // it does not make much sense to come up with an new db-entry.
        // Maybe i will change this in a future version, where you are able to disable the User Quota Feature at all (using
        // Default Limits for all Users/Groups)
        //

        // Change this to 'group;user' if you want to have first priority on group quota settings.
//        $priority = 'group;user';
        $priority = 'user;group';

        if ($userdata_quota['user_level'] == ADMIN)
        {
            $attach_config['pm_filesize_limit'] = 0; // Unlimited
            $attach_config['upload_filesize_limit'] = 0; // Unlimited
            return;
        }

        if ($this->page == PAGE_PRIVMSGS)
        {
            $quota_type = QUOTA_PM_LIMIT;
            $limit_type = 'pm_filesize_limit';
            $default = 'max_filesize_pm';
        }
        else
        {
            $quota_type = QUOTA_UPLOAD_LIMIT;
            $limit_type = 'upload_filesize_limit';
            $default = 'attachment_quota';
        }

        if (!$user_id)
        {
            $user_id = intval($userdata_quota['user_id']);
        }

        $priority = explode(';', $priority);
        $found = false;

		for ($i = 0; $i < sizeof($priority); $i++)
        {
            if (($priority[$i] == 'group') && (!$found))
            {
                // Get Group Quota, if we find one, we have our quota
                $sql = 'SELECT u.group_id
					FROM ' . USER_GROUP_TABLE . ' u, ' . GROUPS_TABLE . ' g 
                    WHERE g.group_single_user = 0
						AND u.user_pending = 0
                        AND u.group_id = g.group_id
                        AND u.user_id = ' . $user_id;

                if (!($result = $db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Could not get User Group', '', __LINE__, __FILE__, $sql);
                }

                $rows = $db->sql_fetchrowset($result);
                $num_rows = $db->sql_numrows($result);
                $db->sql_freeresult($result);

                if ($num_rows > 0)
                {
                    $group_id = array();

                    for ($j = 0; $j < $num_rows; $j++)
                    {
                        $group_id[] = (int) $rows[$j]['group_id'];
                    }

                    $sql = 'SELECT l.quota_limit
						FROM ' . QUOTA_TABLE . ' q, ' . QUOTA_LIMITS_TABLE . ' l
                        WHERE q.group_id IN (' . implode(', ', $group_id) . ')
                            AND q.group_id <> 0
                            AND q.quota_type = ' . $quota_type . '
                            AND q.quota_limit_id = l.quota_limit_id
                        ORDER BY l.quota_limit DESC
                        LIMIT 1';

                    if (!($result = $db->sql_query($sql)))
                    {
                        message_die(GENERAL_ERROR, 'Could not get Group Quota', '', __LINE__, __FILE__, $sql);
                    }

                    if ($db->sql_numrows($result) > 0)
                    {
                        $row = $db->sql_fetchrow($result);
                        $attach_config[$limit_type] = $row['quota_limit'];
                        $found = TRUE;
                    }
                    $db->sql_freeresult($result);
                }
            }

            if ($priority[$i] == 'user' && !$found)
            {
                // Get User Quota, if the user is not in a group or the group has no quotas
                $sql = 'SELECT l.quota_limit
					FROM ' . QUOTA_TABLE . ' q, ' . QUOTA_LIMITS_TABLE . ' l
                    WHERE q.user_id = ' . $user_id . '
                        AND q.user_id <> 0
                        AND q.quota_type = ' . $quota_type . '
                        AND q.quota_limit_id = l.quota_limit_id
                    LIMIT 1';

                if (!($result = $db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Could not get User Quota', '', __LINE__, __FILE__, $sql);
                }

                if ($db->sql_numrows($result) > 0)
                {
                    $row = $db->sql_fetchrow($result);
                    $attach_config[$limit_type] = $row['quota_limit'];
                    $found = TRUE;
                }
                $db->sql_freeresult($result);
            }
        }

        if (!$found)
        {
            // Set Default Quota Limit
            $quota_id = ($quota_type == QUOTA_UPLOAD_LIMIT) ? $attach_config['default_upload_quota'] : $attach_config['default_pm_quota'];

            if ($quota_id == 0)
            {
                $attach_config[$limit_type] = $attach_config[$default];
            }
            else
            {
                $sql = 'SELECT quota_limit
                    FROM ' . QUOTA_LIMITS_TABLE . '
                    WHERE quota_limit_id = ' . (int) $quota_id . '
                    LIMIT 1';

                if (!($result = $db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Could not get Default Quota Limit', '', __LINE__, __FILE__, $sql);
                }

                if ($db->sql_numrows($result) > 0)
                {
                    $row = $db->sql_fetchrow($result);
                    $attach_config[$limit_type] = $row['quota_limit'];
                }
                else
                {
                    $attach_config[$limit_type] = $attach_config[$default];
                }
                $db->sql_freeresult($result);
            }
        }

        // Never exceed the complete Attachment Upload Quota
        if ($quota_type == QUOTA_UPLOAD_LIMIT)
        {
            if ($attach_config[$limit_type] > $attach_config[$default])
            {
                $attach_config[$limit_type] = $attach_config[$default];
            }
        }
    }

    /**
    * Handle all modes... (intern)
    * @private
    */
    function handle_attachments($mode)
    {
        global $is_auth, $attach_config, $refresh, $HTTP_POST_VARS, $post_id, $submit, $preview, $error, $error_msg, $lang, $template, $userdata, $db;

        //
        // ok, what shall we do ;)
        //

        // Some adjustments for PM's
        if ($this->page == PAGE_PRIVMSGS)
        {
            global $privmsg_id;

            $post_id = $privmsg_id;

            if ($mode == 'post')
            {
                $mode = 'newtopic';
            }
            else if ($mode == 'edit')
            {
                $mode = 'editpost';
            }

            if ($userdata['user_level'] == ADMIN)
            {
                $is_auth['auth_attachments'] = 1;
                $max_attachments = ADMIN_MAX_ATTACHMENTS;
            }
            else
            {
                $is_auth['auth_attachments'] = intval($attach_config['allow_pm_attach']);
                $max_attachments = intval($attach_config['max_attachments_pm']);
            }
			$sql_id = 'privmsgs_id';
        }
        else
        {
            if ($userdata['user_level'] == ADMIN)
            {
                $max_attachments = ADMIN_MAX_ATTACHMENTS;
            }
            else
            {
                $max_attachments = intval($attach_config['max_attachments']);
            }
			$sql_id = 'post_id';
        }

        // nothing, if the user is not authorized or attachment mod disabled
        if (intval($attach_config['disable_mod']) || !$is_auth['auth_attachments'])
        {
            return false;
        }

        // Init Vars
		$allowed_attach_ids = array();
		if ($post_id)
		{
			$sql = 'SELECT attach_id
				FROM ' . ATTACHMENTS_TABLE . '
				WHERE ' . $sql_id . ' = ' . $post_id;
			$result = $db->sql_query($sql);

			if (!$result)
			{
				message_die(GENERAL_ERROR, 'Unable to get attachment information.', '', __LINE__, __FILE__, $sql);
			}

			while ($_row = $db->sql_fetchrow($result))
			{
				$allowed_attach_ids[] = $_row['attach_id'];
			}
			$db->sql_freeresult($result);
		}

		// Check the submitted variables - do not allow wrong values
		$actual_id_list				= get_var('attach_id_list', array(0));
		$actual_list				= get_var('attachment_list', array(''));

		for ($i = 0; $i < sizeof($actual_list); $i++)
		{
			if ($actual_id_list[$i] != 0)
			{
				if (!in_array($actual_id_list[$i], $allowed_attach_ids))
				{
					message_die(CRITICAL_ERROR, 'You tried to change an attachment you do not have access to', '');
				}
			}
			else
			{
				// Really new attachment? If so, the filename should be unique...
				if (physical_filename_already_stored($actual_list[$i]))
				{
					message_die(CRITICAL_ERROR, 'You tried to change an attachment you do not have access to', '');
				}
			}
		}
        $attachments = array();

        if (!$refresh)
        {
            $add = (isset($HTTP_POST_VARS['add_attachment'])) ? TRUE : FALSE;
            $delete = (isset($HTTP_POST_VARS['del_attachment'])) ? TRUE : FALSE;
            $edit = (isset($HTTP_POST_VARS['edit_comment'])) ? TRUE : FALSE;
            $update_attachment = (isset($HTTP_POST_VARS['update_attachment'])) ? TRUE : FALSE;
            $del_thumbnail = (isset($HTTP_POST_VARS['del_thumbnail'])) ? TRUE : FALSE;

            $add_attachment_box = (!empty($HTTP_POST_VARS['add_attachment_box'])) ? TRUE : FALSE;
            $posted_attachments_box = (!empty($HTTP_POST_VARS['posted_attachments_box'])) ? TRUE : FALSE;

            $refresh = $add || $delete || $edit || $del_thumbnail || $update_attachment || $add_attachment_box || $posted_attachments_box;
        }

        // Get Attachments
        if ($this->page == PAGE_PRIVMSGS)
        {
            $attachments = get_attachments_from_pm($post_id);
        }
        else
        {
            $attachments = get_attachments_from_post($post_id);
        }

        if ($this->page == PAGE_PRIVMSGS)
        {
            if ($userdata['user_level'] == ADMIN)
            {
                $auth = TRUE;
            }
            else
            {
                $auth = (intval($attach_config['allow_pm_attach'])) ? TRUE : FALSE;
            }

			if (sizeof($attachments) == 1)
            {
                $template->assign_block_vars('switch_attachments',array());

                $template->assign_vars(array(
                    'L_DELETE_ATTACHMENTS'        => $lang['Delete_attachment'])
                );
            }
			else if (sizeof($attachments) > 0)
            {
                $template->assign_block_vars('switch_attachments',array());

                $template->assign_vars(array(
                    'L_DELETE_ATTACHMENTS'        => $lang['Delete_attachments'])
                );
            }
        }
        else
        {
            $auth = ($is_auth['auth_edit'] || $is_auth['auth_mod']) ? TRUE : FALSE;
        }

        if (!$submit && $mode == 'editpost' && $auth)
        {
            if (!$refresh && !$preview && !$error && !isset($HTTP_POST_VARS['del_poll_option']))
            {
				for ($i = 0; $i < sizeof($attachments); $i++)
                {
                    $this->attachment_list[] = $attachments[$i]['physical_filename'];
                    $this->attachment_comment_list[] = $attachments[$i]['comment'];
                    $this->attachment_filename_list[] = $attachments[$i]['real_filename'];
                    $this->attachment_extension_list[] = $attachments[$i]['extension'];
                    $this->attachment_mimetype_list[] = $attachments[$i]['mimetype'];
                    $this->attachment_filesize_list[] = $attachments[$i]['filesize'];
                    $this->attachment_filetime_list[] = $attachments[$i]['filetime'];
                    $this->attachment_id_list[] = $attachments[$i]['attach_id'];
                    $this->attachment_thumbnail_list[] = $attachments[$i]['thumbnail'];
                }
            }
        }

		$this->num_attachments = sizeof($this->attachment_list);

        if ($submit && $mode != 'vote')
        {
            if ($mode == 'newtopic' || $mode == 'reply' || $mode == 'editpost')
            {
                if ($this->filename != '')
                {
                    if ($this->num_attachments < intval($max_attachments))
                    {
                        $this->upload_attachment($this->page);

                        if (!$error && $this->post_attach)
                        {
                            array_unshift($this->attachment_list, $this->attach_filename);
                            array_unshift($this->attachment_comment_list, $this->file_comment);
                            array_unshift($this->attachment_filename_list, $this->filename);
                            array_unshift($this->attachment_extension_list, $this->extension);
                            array_unshift($this->attachment_mimetype_list, $this->type);
                            array_unshift($this->attachment_filesize_list, $this->filesize);
                            array_unshift($this->attachment_filetime_list, $this->filetime);
                            array_unshift($this->attachment_id_list, '0');
                            array_unshift($this->attachment_thumbnail_list, $this->thumbnail);

                            $this->file_comment = '';

                            // This Variable is set to FALSE here, because the Attachment Mod enter Attachments into the
                            // Database in two modes, one if the id_list is 0 and the second one if post_attach is true
                            // Since post_attach is automatically switched to true if an Attachment got added to the filesystem,
                            // but we are assigning an id of 0 here, we have to reset the post_attach variable to FALSE.
                            //
                            // This is very relevant, because it could happen that the post got not submitted, but we do not
                            // know this circumstance here. We could be at the posting page or we could be redirected to the entered
                            // post. :)
                            $this->post_attach = FALSE;
                        }
                    }
                    else
                    {
                        $error = TRUE;
                        if (!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= sprintf($lang['Too_many_attachments'], intval($max_attachments));
                    }
                }
            }
        }

        if ($preview || $refresh || $error)
        {
            $delete_attachment = (isset($HTTP_POST_VARS['del_attachment'])) ? TRUE : FALSE;
            $delete_thumbnail = (isset($HTTP_POST_VARS['del_thumbnail'])) ? TRUE : FALSE;

            $add_attachment = (isset($HTTP_POST_VARS['add_attachment'])) ? TRUE : FALSE;
            $edit_attachment = (isset($HTTP_POST_VARS['edit_comment'])) ? TRUE : FALSE;
            $update_attachment = (isset($HTTP_POST_VARS['update_attachment']) ) ? TRUE : FALSE;

            // Perform actions on temporary attachments
            if ($delete_attachment || $delete_thumbnail)
            {
                // store old values
                $actual_id_list                = get_var('attach_id_list', array(0));
                $actual_comment_list        = get_var('comment_list', array(''), true);
                $actual_filename_list        = get_var('filename_list', array(''));
                $actual_extension_list        = get_var('extension_list', array(''));
                $actual_mimetype_list        = get_var('mimetype_list', array(''));
                $actual_filesize_list        = get_var('filesize_list', array(0));
                $actual_filetime_list        = get_var('filetime_list', array(0));

                $actual_list                = get_var('attachment_list', array(''));
                $actual_thumbnail_list        = get_var('attach_thumbnail_list', array(0));

                // clean values
                $this->attachment_list = array();
                $this->attachment_comment_list = array();
                $this->attachment_filename_list = array();
                $this->attachment_extension_list = array();
                $this->attachment_mimetype_list = array();
                $this->attachment_filesize_list = array();
                $this->attachment_filetime_list = array();
                $this->attachment_id_list = array();
                $this->attachment_thumbnail_list = array();

                // restore values :)
                if (isset($HTTP_POST_VARS['attachment_list']))
                {
					for ($i = 0; $i < sizeof($actual_list); $i++)
                    {
                        $restore = FALSE;
                        $del_thumb = FALSE;

                        if ($delete_thumbnail)
                        {
                            if (!isset($HTTP_POST_VARS['del_thumbnail'][$actual_list[$i]]))
                            {
                                $restore = TRUE;
                            }
                            else
                            {
                                $del_thumb = TRUE;
                            }
                        }

                        if ($delete_attachment)
                        {
                            if (!isset($HTTP_POST_VARS['del_attachment'][$actual_list[$i]]))
                            {
                                $restore = TRUE;
                            }
                        }

                        if ($restore)
                        {
                            $this->attachment_list[] = $actual_list[$i];
                            $this->attachment_comment_list[] = $actual_comment_list[$i];
                            $this->attachment_filename_list[] = $actual_filename_list[$i];
                            $this->attachment_extension_list[] = $actual_extension_list[$i];
                            $this->attachment_mimetype_list[] = $actual_mimetype_list[$i];
                            $this->attachment_filesize_list[] = $actual_filesize_list[$i];
                            $this->attachment_filetime_list[] = $actual_filetime_list[$i];
                            $this->attachment_id_list[] = $actual_id_list[$i];
                            $this->attachment_thumbnail_list[] = $actual_thumbnail_list[$i];
                        }
                        else if (!$del_thumb)
                        {
                            // delete selected attachment
                            if ($actual_id_list[$i] == '0' )
                            {
                                unlink_attach($actual_list[$i]);

                                if ($actual_thumbnail_list[$i] == 1)
                                {
                                    unlink_attach($actual_list[$i], MODE_THUMBNAIL);
                                }
                            }
                            else
                            {
                                delete_attachment($post_id, $actual_id_list[$i], $this->page);
                            }
                        }
                        else if ($del_thumb)
                        {
                            // delete selected thumbnail
                            $this->attachment_list[] = $actual_list[$i];
                            $this->attachment_comment_list[] = $actual_comment_list[$i];
                            $this->attachment_filename_list[] = $actual_filename_list[$i];
                            $this->attachment_extension_list[] = $actual_extension_list[$i];
                            $this->attachment_mimetype_list[] = $actual_mimetype_list[$i];
                            $this->attachment_filesize_list[] = $actual_filesize_list[$i];
                            $this->attachment_filetime_list[] = $actual_filetime_list[$i];
                            $this->attachment_id_list[] = $actual_id_list[$i];
                            $this->attachment_thumbnail_list[] = 0;

                            if ($actual_id_list[$i] == 0)
                            {
                                unlink_attach($actual_list[$i], MODE_THUMBNAIL);
                            }
                            else
                            {
                                $sql = 'UPDATE ' . ATTACHMENTS_DESC_TABLE . '
                                    SET thumbnail = 0
                                    WHERE attach_id = ' . (int) $actual_id_list[$i];

                                if (!($db->sql_query($sql)))
                                {
                                    message_die(GENERAL_ERROR, 'Unable to update ' . ATTACHMENTS_DESC_TABLE . ' Table.', '', __LINE__, __FILE__, $sql);
                                }
                            }
                        }
                    }
                }
            }
            else if ($edit_attachment || $update_attachment || $add_attachment || $preview)
            {
                if ($edit_attachment)
                {
                    $actual_comment_list = get_var('comment_list', array(''), true);

                    $this->attachment_comment_list = array();

					for ($i = 0; $i < sizeof($this->attachment_list); $i++)
                    {
                        $this->attachment_comment_list[$i] = $actual_comment_list[$i];
                    }
                }

                if ($update_attachment)
                {
                    if ($this->filename == '')
                    {
                        $error = TRUE;
                        if(!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= $lang['Error_empty_add_attachbox'];
                    }

                    $this->upload_attachment($this->page);

                    if (!$error)
                    {
                        $actual_list = get_var('attachment_list', array(''));
                        $actual_id_list = get_var('attach_id_list', array(0));

                        $attachment_id = 0;
                        $actual_element = 0;

						for ($i = 0; $i < sizeof($actual_id_list); $i++)
                        {
                            if (isset($HTTP_POST_VARS['update_attachment'][$actual_id_list[$i]]))
                            {
                                $attachment_id = intval($actual_id_list[$i]);
                                $actual_element = $i;
                            }
                        }

                        // Get current informations to delete the Old Attachment
                        $sql = 'SELECT physical_filename, comment, thumbnail
                            FROM ' . ATTACHMENTS_DESC_TABLE . '
                            WHERE attach_id = ' . (int) $attachment_id;

                        if (!($result = $db->sql_query($sql)))
                        {
                            message_die(GENERAL_ERROR, 'Unable to select old Attachment Entry.', '', __LINE__, __FILE__, $sql);
                        }

                        if ($db->sql_numrows($result) != 1)
                        {
                            $error = TRUE;
                            if(!empty($error_msg))
                            {
                                $error_msg .= '<br />';
                            }
                            $error_msg .= $lang['Error_missing_old_entry'];
                        }

                        $row = $db->sql_fetchrow($result);
                        $db->sql_freeresult($result);

                        $comment = (trim($this->file_comment) == '') ? trim($row['comment']) : trim($this->file_comment);

                        // Update Entry
                        $sql_ary = array(
                            'physical_filename'        => (string) basename($this->attach_filename),
                            'real_filename'            => (string) basename($this->filename),
                            'comment'                => (string) $comment,
                            'extension'                => (string) strtolower($this->extension),
                            'mimetype'                => (string) strtolower($this->type),
                            'filesize'                => (int) $this->filesize,
                            'filetime'                => (int) $this->filetime,
                            'thumbnail'                => (int) $this->thumbnail
                        );

                        $sql = 'UPDATE ' . ATTACHMENTS_DESC_TABLE . ' SET ' . attach_mod_sql_build_array('UPDATE', $sql_ary) . '
                            WHERE attach_id = ' . (int) $attachment_id;

                        if (!($db->sql_query($sql)))
                        {
                            message_die(GENERAL_ERROR, 'Unable to update the Attachment.', '', __LINE__, __FILE__, $sql);
                        }

                        // Delete the Old Attachment
                        unlink_attach($row['physical_filename']);

                        if (intval($row['thumbnail']) == 1)
                        {
                            unlink_attach($row['physical_filename'], MODE_THUMBNAIL);
                        }

                        // Make sure it is displayed
                        $this->attachment_list[$actual_element] = $this->attach_filename;
                        $this->attachment_comment_list[$actual_element] = $comment;
                        $this->attachment_filename_list[$actual_element] = $this->filename;
                        $this->attachment_extension_list[$actual_element] = $this->extension;
                        $this->attachment_mimetype_list[$actual_element] = $this->type;
                        $this->attachment_filesize_list[$actual_element] = $this->filesize;
                        $this->attachment_filetime_list[$actual_element] = $this->filetime;
                        $this->attachment_id_list[$actual_element] = $actual_id_list[$actual_element];
                        $this->attachment_thumbnail_list[$actual_element] = $this->thumbnail;
                        $this->file_comment = '';
                    }
                }

                if (($add_attachment || $preview) && $this->filename != '')
                {
                    if ($this->num_attachments < intval($max_attachments))
                    {
                        $this->upload_attachment($this->page);

                        if (!$error)
                        {
                            array_unshift($this->attachment_list, $this->attach_filename);
                            array_unshift($this->attachment_comment_list, $this->file_comment);
                            array_unshift($this->attachment_filename_list, $this->filename);
                            array_unshift($this->attachment_extension_list, $this->extension);
                            array_unshift($this->attachment_mimetype_list, $this->type);
                            array_unshift($this->attachment_filesize_list, $this->filesize);
                            array_unshift($this->attachment_filetime_list, $this->filetime);
                            array_unshift($this->attachment_id_list, '0');
                            array_unshift($this->attachment_thumbnail_list, $this->thumbnail);

                            $this->file_comment = '';
                        }
                    }
                    else
                    {
                        $error = TRUE;
                        if(!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= sprintf($lang['Too_many_attachments'], intval($max_attachments));
                    }
                }
            }
        }

        return TRUE;
    }

    /**
    * Basic Insert Attachment Handling for all Message Types
    */
    function do_insert_attachment($mode, $message_type, $message_id)
    {
        global $db, $upload_dir;

        if (intval($message_id) < 0)
        {
            return FALSE;
        }

        if ($message_type == 'pm')
        {
            global $userdata, $to_userdata;

            $post_id = 0;
            $privmsgs_id = (int) $message_id;
            $user_id_1 = (int) $userdata['user_id'];
            $user_id_2 = (int) $to_userdata['user_id'];
			$sql_id = 'privmsgs_id';
        }
        else if ($message_type = 'post')
        {
            global $post_info, $userdata;

            $post_id = (int) $message_id;
            $privmsgs_id = 0;
            $user_id_1 = (isset($post_info['poster_id'])) ? (int) $post_info['poster_id'] : 0;
            $user_id_2 = 0;
			$sql_id = 'post_id';

            if (!$user_id_1)
            {
                $user_id_1 = (int) $userdata['user_id'];
            }
        }

        if ($mode == 'attach_list')
        {
			for ($i = 0; $i < sizeof($this->attachment_list); $i++)
            {
                if ($this->attachment_id_list[$i])
                {
                    // update entry in db if attachment already stored in db and filespace
					$sql = 'SELECT attach_id
						FROM ' . ATTACHMENTS_TABLE . '
						WHERE ' . $sql_id . ' = ' . $$sql_id . '
							AND attach_id = ' . $this->attachment_id_list[$i];
					$result = $db->sql_query($sql);

					if (!$result)
					{
						message_die(GENERAL_ERROR, 'Unable to get attachment information.', '', __LINE__, __FILE__, $sql);
					}

					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if (!$row)
					{
						message_die(GENERAL_ERROR, 'Tried to update an attachment you are not allowed to access', '');
					}
                    $sql = 'UPDATE ' . ATTACHMENTS_DESC_TABLE . "
                        SET comment = '" . attach_mod_sql_escape($this->attachment_comment_list[$i]) . "'
                        WHERE attach_id = " . $this->attachment_id_list[$i];

                    if (!($db->sql_query($sql)))
                    {
                        message_die(GENERAL_ERROR, 'Unable to update the File Comment.', '', __LINE__, __FILE__, $sql);
                    }
                }
                else
                {
                    // insert attachment into db
                    $sql_ary = array(
                        'physical_filename'        => (string) basename($this->attachment_list[$i]),
                        'real_filename'            => (string) basename($this->attachment_filename_list[$i]),
                        'comment'                => (string) $this->attachment_comment_list[$i],
                        'extension'                => (string) strtolower($this->attachment_extension_list[$i]),
                        'mimetype'                => (string) strtolower($this->attachment_mimetype_list[$i]),
                        'filesize'                => (int) $this->attachment_filesize_list[$i],
                        'filetime'                => (int) $this->attachment_filetime_list[$i],
                        'thumbnail'                => (int) $this->attachment_thumbnail_list[$i]
                    );

                    $sql = 'INSERT INTO ' . ATTACHMENTS_DESC_TABLE . ' ' . attach_mod_sql_build_array('INSERT', $sql_ary);

                    if (!($db->sql_query($sql)))
                    {
                        message_die(GENERAL_ERROR, 'Couldn\'t store Attachment.<br />Your ' . $message_type . ' has been stored.', '', __LINE__, __FILE__, $sql);
                    }

                    $attach_id = $db->sql_nextid();

                    $sql_ary = array(
                        'attach_id'        => (int) $attach_id,
                        'post_id'        => (int) $post_id,
                        'privmsgs_id'    => (int) $privmsgs_id,
                        'user_id_1'        => (int) $user_id_1,
                        'user_id_2'        => (int) $user_id_2
                    );

                    $sql = 'INSERT INTO ' . ATTACHMENTS_TABLE . ' ' . attach_mod_sql_build_array('INSERT', $sql_ary);

                    if (!($db->sql_query($sql)))
                    {
                        message_die(GENERAL_ERROR, 'Couldn\'t store Attachment.<br />Your ' . $message_type . ' has been stored.', '', __LINE__, __FILE__, $sql);
                    }
                }
            }

            return TRUE;
        }

        if ($mode == 'last_attachment')
        {
            if ($this->post_attach && !isset($HTTP_POST_VARS['update_attachment']))
            {
                // insert attachment into db, here the user submited it directly
                $sql_ary = array(
                    'physical_filename'        => (string) basename($this->attach_filename),
                    'real_filename'            => (string) basename($this->filename),
                    'comment'                => (string) $this->file_comment,
                    'extension'                => (string) strtolower($this->extension),
                    'mimetype'                => (string) strtolower($this->type),
                    'filesize'                => (int) $this->filesize,
                    'filetime'                => (int) $this->filetime,
                    'thumbnail'                => (int) $this->thumbnail
                );

                $sql = 'INSERT INTO ' . ATTACHMENTS_DESC_TABLE . ' ' . attach_mod_sql_build_array('INSERT', $sql_ary);

                // Inform the user that his post has been created, but nothing is attached
                if (!($db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Couldn\'t store Attachment.<br />Your ' . $message_type . ' has been stored.', '', __LINE__, __FILE__, $sql);
                }

                $attach_id = $db->sql_nextid();

                $sql_ary = array(
                    'attach_id'        => (int) $attach_id,
                    'post_id'        => (int) $post_id,
                    'privmsgs_id'    => (int) $privmsgs_id,
                    'user_id_1'        => (int) $user_id_1,
                    'user_id_2'        => (int) $user_id_2
                );

                $sql = 'INSERT INTO ' . ATTACHMENTS_TABLE . ' ' . attach_mod_sql_build_array('INSERT', $sql_ary);

                if (!($db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Couldn\'t store Attachment.<br />Your ' . $message_type . ' has been stored.', '', __LINE__, __FILE__, $sql);
                }
            }
        }
    }

    /**
    * Attachment Mod entry switch/output (intern)
    * @private
    */
    function display_attachment_bodies()
    {
        global $attach_config, $db, $is_auth, $lang, $mode, $phpEx, $template, $upload_dir, $userdata, $HTTP_POST_VARS, $forum_id;
        global $phpbb_root_path;

        // Choose what to display
        $value_add = $value_posted = 0;

        if (intval($attach_config['show_apcp']))
        {
            if (!empty($HTTP_POST_VARS['add_attachment_box']))
            {
                $value_add = ($this->add_attachment_body == 0) ? 1 : 0;
                $this->add_attachment_body = $value_add;
            }
            else
            {
                $value_add = ($this->add_attachment_body == 0) ? 0 : 1;
            }

            if (!empty($HTTP_POST_VARS['posted_attachments_box']))
            {
                $value_posted = ($this->posted_attachments_body == 0) ? 1 : 0;
                $this->posted_attachments_body = $value_posted;
            }
            else
            {
                $value_posted = ($this->posted_attachments_body == 0) ? 0 : 1;
            }
            $template->assign_block_vars('show_apcp', array());
        }
        else
        {
            $this->add_attachment_body = 1;
            $this->posted_attachments_body = 1;
        }

        $template->set_filenames(array(
            'attachbody' => 'posting_attach_body.tpl')
        );

        display_compile_cache_clear($template->files['attachbody'], 'attachbody');

        $s_hidden = '<input type="hidden" name="add_attachment_body" value="' . $value_add . '" />';
        $s_hidden .= '<input type="hidden" name="posted_attachments_body" value="' . $value_posted . '" />';

        if ($this->page == PAGE_PRIVMSGS)
        {
            $u_rules_id = 0;
        }
        else
        {
            $u_rules_id = $forum_id;
        }

        $template->assign_vars(array(
            'L_ATTACH_POSTING_CP'           => $lang['Attach_posting_cp'],
            'L_ATTACH_POSTING_CP_EXPLAIN'   => $lang['Attach_posting_cp_explain'],
            'L_OPTIONS'                     => $lang['Options'],
            'L_ADD_ATTACHMENT_TITLE'        => $lang['Add_attachment_title'],
            'L_POSTED_ATTACHMENTS'          => $lang['Posted_attachments'],
            'L_FILE_NAME'                   => $lang['File_name'],
            'L_FILE_COMMENT'                => $lang['File_comment'],
            // 'RULES'                         => '<a href="' . append_sid($phpbb_root_path . "attach_rules.$phpEx?f=$u_rules_id") . '" target="_blank">' . $lang['Allowed_extensions_and_sizes'] . '</a>',
            'RULES'                         => '<a href="' . append_sid("attach_rules.$phpEx?f=$u_rules_id") . '" target="_blank">' . $lang['Allowed_extensions_and_sizes'] . '</a>',

            'S_HIDDEN' => $s_hidden)
        );

        $attachments = array();

		if (sizeof($this->attachment_list) > 0)
        {
            if (intval($attach_config['show_apcp']))
            {
                $template->assign_block_vars('switch_posted_attachments', array());
            }

			for ($i = 0; $i < sizeof($this->attachment_list); $i++)
            {
                $hidden =  '<input type="hidden" name="attachment_list[]" value="' . $this->attachment_list[$i] . '" />';
                $hidden .= '<input type="hidden" name="filename_list[]" value="' . $this->attachment_filename_list[$i] . '" />';
                $hidden .= '<input type="hidden" name="extension_list[]" value="' . $this->attachment_extension_list[$i] . '" />';
                $hidden .= '<input type="hidden" name="mimetype_list[]" value="' . $this->attachment_mimetype_list[$i] . '" />';
                $hidden .= '<input type="hidden" name="filesize_list[]" value="' . $this->attachment_filesize_list[$i] . '" />';
                $hidden .= '<input type="hidden" name="filetime_list[]" value="' . $this->attachment_filetime_list[$i] . '" />';
                $hidden .= '<input type="hidden" name="attach_id_list[]" value="' . $this->attachment_id_list[$i] . '" />';
                $hidden .= '<input type="hidden" name="attach_thumbnail_list[]" value="' . $this->attachment_thumbnail_list[$i] . '" />';

				if (!$this->posted_attachments_body || sizeof($this->attachment_list) == 0)
                {
                    $hidden .= '<input type="hidden" name="comment_list[]" value="' . $this->attachment_comment_list[$i] . '" />';
                }

                $template->assign_block_vars('hidden_row', array(
                    'S_HIDDEN' => $hidden)
                );
            }
        }

        if ($this->add_attachment_body)
        {
            init_display_template('attachbody', '{ADD_ATTACHMENT_BODY}', 'add_attachment_body.tpl');

            $form_enctype = 'enctype="multipart/form-data"';

            $template->assign_vars(array(
                'L_ADD_ATTACH_TITLE'    => $lang['Add_attachment_title'],
                'L_ADD_ATTACH_EXPLAIN'    => $lang['Add_attachment_explain'],
                'L_ADD_ATTACHMENT'        => $lang['Add_attachment'],

                'FILE_COMMENT'            => $this->file_comment,
                'FILESIZE'                => $attach_config['max_filesize'],
                'FILENAME'                => $this->filename,

                'S_FORM_ENCTYPE'        => $form_enctype)
            );
        }

		if ($this->posted_attachments_body && sizeof($this->attachment_list) > 0)
        {
            init_display_template('attachbody', '{POSTED_ATTACHMENTS_BODY}', 'posted_attachments_body.tpl');

            $template->assign_vars(array(
                'L_POSTED_ATTACHMENTS'    => $lang['Posted_attachments'],
                'L_UPDATE_COMMENT'        => $lang['Update_comment'],
                'L_UPLOAD_NEW_VERSION'    => $lang['Upload_new_version'],
                'L_DELETE_ATTACHMENT'    => $lang['Delete_attachment'],
                'L_DELETE_THUMBNAIL'    => $lang['Delete_thumbnail'],
                'L_OPTIONS'                => $lang['Options'])
            );

			for ($i = 0; $i < sizeof($this->attachment_list); $i++)
            {
                if ($this->attachment_id_list[$i] == 0)
                {
                    $download_link = $upload_dir . '/' . basename($this->attachment_list[$i]);
                }
                else
                {
                    $download_link = append_sid('download.' . $phpEx . '?id=' . $this->attachment_id_list[$i]);
                }

                $template->assign_block_vars('attach_row', array(
                    'FILE_NAME'            => $this->attachment_filename_list[$i],
                    'ATTACH_FILENAME'    => $this->attachment_list[$i],
                    'FILE_COMMENT'        => $this->attachment_comment_list[$i],
                    'ATTACH_ID'            => $this->attachment_id_list[$i],

                    'U_VIEW_ATTACHMENT'    => $download_link)
                );

                // Thumbnail there ? And is the User Admin or Mod ? Then present the 'Delete Thumbnail' Button
                if (intval($this->attachment_thumbnail_list[$i]) == 1 && ((isset($is_auth['auth_mod']) && $is_auth['auth_mod']) || $userdata['user_level'] == ADMIN))
                {
                    $template->assign_block_vars('attach_row.switch_thumbnail', array());
                }

                if ($this->attachment_id_list[$i])
                {
                    $template->assign_block_vars('attach_row.switch_update_attachment', array());
                }
            }
        }

        $template->assign_var_from_handle('ATTACHBOX', 'attachbody');
    }

    /**
    * Upload an Attachment to Filespace (intern)
    */
    function upload_attachment()
    {
        global $HTTP_POST_FILES, $db, $HTTP_POST_VARS, $error, $error_msg, $lang, $attach_config, $userdata, $upload_dir, $forum_id;

        $this->post_attach = ($this->filename != '') ? TRUE : FALSE;

        if ($this->post_attach)
        {
            $r_file = trim(basename(htmlspecialchars($this->filename)));
            $file = $HTTP_POST_FILES['fileupload']['tmp_name'];
            $this->type = $HTTP_POST_FILES['fileupload']['type'];

            if (isset($HTTP_POST_FILES['fileupload']['size']) && $HTTP_POST_FILES['fileupload']['size'] == 0)
            {
                message_die(GENERAL_ERROR, 'Tried to upload empty file');
            }

            // Opera add the name to the mime type
            $this->type = (strstr($this->type, '; name')) ? str_replace(strstr($this->type, '; name'), '', $this->type) : $this->type;
            $this->type = strtolower($this->type);
            $this->extension = strtolower(get_extension($this->filename));

            $this->filesize = @filesize($file);
            $this->filesize = intval($this->filesize);

            $sql = 'SELECT g.allow_group, g.max_filesize, g.cat_id, g.forum_permissions
				FROM ' . EXTENSION_GROUPS_TABLE . ' g, ' . EXTENSIONS_TABLE . " e
                WHERE g.group_id = e.group_id
                    AND e.extension = '" . attach_mod_sql_escape($this->extension) . "'
                LIMIT 1";

            if (!($result = $db->sql_query($sql)))
            {
                message_die(GENERAL_ERROR, 'Could not query Extensions.', '', __LINE__, __FILE__, $sql);
            }

            $row = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);

            $allowed_filesize = ($row['max_filesize']) ? $row['max_filesize'] : $attach_config['max_filesize'];
            $cat_id = intval($row['cat_id']);
            $auth_cache = trim($row['forum_permissions']);

            // check Filename
            if (preg_match("#[\\/:*?\"<>|]#i", $this->filename))
            {
                $error = TRUE;
                if(!empty($error_msg))
                {
                    $error_msg .= '<br />';
                }
				$error_msg .= sprintf($lang['Invalid_filename'], htmlspecialchars($this->filename));
            }

            // check php upload-size
            if (!$error && $file == 'none')
            {
                $error = TRUE;
                if(!empty($error_msg))
                {
                    $error_msg .= '<br />';
                }
                $ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

                $max_size = @$ini_val('upload_max_filesize');

                if ($max_size == '')
                {
                    $error_msg .= $lang['Attachment_php_size_na'];
                }
                else
                {
                    $error_msg .= sprintf($lang['Attachment_php_size_overrun'], $max_size);
                }
            }

            // Check Extension
            if (!$error && intval($row['allow_group']) == 0)
            {
                $error = TRUE;
                if(!empty($error_msg))
                {
                    $error_msg .= '<br />';
                }
				$error_msg .= sprintf($lang['Disallowed_extension'], htmlspecialchars($this->extension));
            }

            // Check Forum Permissions
            if (!$error && $this->page != PAGE_PRIVMSGS && $userdata['user_level'] != ADMIN && !is_forum_authed($auth_cache, $forum_id) && trim($auth_cache) != '')
            {
                $error = TRUE;
                if(!empty($error_msg))
                {
                    $error_msg .= '<br />';
                }
				$error_msg .= sprintf($lang['Disallowed_extension_within_forum'], htmlspecialchars($this->extension));
            }

            // Upload File
            $this->thumbnail = 0;

            if (!$error)
            {
                // Prepare Values
                $this->filetime = time();

                $this->filename = $r_file;

                // physical filename
                $this->attach_filename = strtolower($this->filename);

                // To re-add cryptic filenames, change this variable to true
                $cryptic = false;

                if (!$cryptic)
                {
                    $this->attach_filename = html_entity_decode(trim(stripslashes($this->attach_filename)));
                    $this->attach_filename = delete_extension($this->attach_filename);
                    $this->attach_filename = str_replace(array(' ','-'), array('_','_'), $this->attach_filename);
                    $this->attach_filename = str_replace('__', '_', $this->attach_filename);
                    $this->attach_filename = str_replace(array(',', '.', '!', '?', '�', '�', '�', '�', '�', '�', ';', ':', '@', "'", '"', '&'), array('', '', '', '', 'ue', 'ue', 'oe', 'oe', 'ae', 'ae', '', '', '', '', '', 'and'), $this->attach_filename);
                    $this->attach_filename = str_replace(array('$', '�', '>','<','�','%','=','/','(',')','#','*','+',"\\",'{','}','[',']'), array('dollar', 'ss','greater','lower','paragraph','percent','equal','','','','','','','','','','',''), $this->attach_filename);
                    // Remove non-latin characters
                    $this->attach_filename = preg_replace("/([\xC2\xC3])([\x80-\xBF])/", "chr(ord('\\1')<<6&0xC0|ord('\\2')&0x3F)", $this->attach_filename);
                    $this->attach_filename = rawurlencode($this->attach_filename);
                    $this->attach_filename = preg_replace("/(%[0-9A-F]{1,2})/i", '', $this->attach_filename);
                    $this->attach_filename = trim($this->attach_filename);

                    $new_filename = $this->attach_filename;

                    if (!$new_filename)
                    {
                        $u_id = (intval($userdata['user_id']) == ANONYMOUS) ? 0 : intval($userdata['user_id']);
                        $new_filename = $u_id . '_' . $this->filetime . '.' . $this->extension;
                    }

                    do
                    {
                        $this->attach_filename = $new_filename . '_' . substr(rand(), 0, 3) . '.' . $this->extension;
                    }
                    while (physical_filename_already_stored($this->attach_filename));

                    unset($new_filename);
                }
                else
                {
                    $u_id = (intval($userdata['user_id']) == ANONYMOUS) ? 0 : intval($userdata['user_id']);
                    $this->attach_filename = $u_id . '_' . $this->filetime . '.' . $this->extension;
                }

                // Do we have to create a thumbnail ?
                if ($cat_id == IMAGE_CAT && intval($attach_config['img_create_thumbnail']))
                {
                    $this->thumbnail = 1;
                }
            }

            if ($error)
            {
                $this->post_attach = FALSE;
                return;
            }

            // Upload Attachment
            if (!$error)
            {
                if (!(intval($attach_config['allow_ftp_upload'])))
                {
                    // Descide the Upload method
                    $ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

                    $safe_mode = @$ini_val('safe_mode');

                    if (@$ini_val('open_basedir'))
                    {
                        if (@phpversion() < '4.0.3')
                        {
                            $upload_mode = 'copy';
                        }
                        else
                        {
                            $upload_mode = 'move';
                        }
                    }
                    else if (@$ini_val('safe_mode'))
                    {
                        $upload_mode = 'move';
                    }
                    else
                    {
                        $upload_mode = 'copy';
                    }
                }
                else
                {
                    $upload_mode = 'ftp';
                }

                // Ok, upload the Attachment
                if (!$error)
                {
                    $this->move_uploaded_attachment($upload_mode, $file);
                }
            }

            // Now, check filesize parameters
            if (!$error)
            {
                if ($upload_mode != 'ftp' && !$this->filesize)
                {
                    $this->filesize = intval(@filesize($upload_dir . '/' . $this->attach_filename));
                }
            }

            // Check Image Size, if it's an image
			if ($cat_id == IMAGE_CAT || strpos($this->type, 'image/') === 0)
			{
				$img_info = @getimagesize($upload_dir . '/' . $this->attach_filename);

				// Do not display as image if we are not able to retrieve the info
				if ($img_info === false)
				{
					$error = TRUE;
					if(!empty($error_msg))
					{
						$error_msg .= '<br />';
					}
					$error_msg .= sprintf($lang['General_upload_error'], './' . $upload_dir . '/' . $this->attach_filename);
				}
				else
				{
					// check file type
					$types = array(
						1 => array('gif'),
						2 => array('jpg', 'jpeg'),
						3 => array('png'),
						4 => array('swf'),
						5 => array('psd'),
						6 => array('bmp'),
						7 => array('tif', 'tiff'),
						8 => array('tif', 'tiff'),
						9 => array('jpg', 'jpeg'),
						10 => array('jpg', 'jpeg'),
						11 => array('jpg', 'jpeg'),
						12 => array('jpg', 'jpeg'),
						13 => array('swc'),
						14 => array('iff'),
						15 => array('wbmp'),
						16 => array('xbm'),
					);

					if (!isset($types[$img_info[2]]))
					{
						$error = TRUE;
						if(!empty($error_msg))
						{
							$error_msg .= '<br />';
						}
						$error_msg .= sprintf($lang['General_upload_error'], './' . $upload_dir . '/' . $this->attach_filename);
					}
					else if (!in_array($this->extension, $types[$img_info[2]]))
					{
						$error = TRUE;
						if(!empty($error_msg))
						{
							$error_msg .= '<br />';
						}
						$error_msg .= sprintf($lang['General_upload_error'], './' . $upload_dir . '/' . $this->attach_filename);
						$error_msg .= "<br />Filetype mismatch: expected {$types[$img_info[2]][0]} but {$this->extension} given.";
					}
				}
			}
            if (!$error && $userdata['user_level'] != ADMIN && $cat_id == IMAGE_CAT)
            {
                list($width, $height) = image_getdimension($upload_dir . '/' . $this->attach_filename);

                if ($width != 0 && $height != 0 && intval($attach_config['img_max_width']) != 0 && intval($attach_config['img_max_height']) != 0)
                {
                    if ($width > intval($attach_config['img_max_width']) || $height > intval($attach_config['img_max_height']))
                    {
                        $error = TRUE;
                        if(!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= sprintf($lang['Error_imagesize'], intval($attach_config['img_max_width']), intval($attach_config['img_max_height']));
                    }
                }
            }

            // check Filesize
            if (!$error && $allowed_filesize != 0 && $this->filesize > $allowed_filesize && $userdata['user_level'] != ADMIN)
            {
                $size_lang = ($allowed_filesize >= 1048576) ? $lang['MB'] : ( ($allowed_filesize >= 1024) ? $lang['KB'] : $lang['Bytes'] );

                if ($allowed_filesize >= 1048576)
                {
                    $allowed_filesize = round($allowed_filesize / 1048576 * 100) / 100;
                }
                else if ($allowed_filesize >= 1024)
                {
                    $allowed_filesize = round($allowed_filesize / 1024 * 100) / 100;
                }

                $error = TRUE;
                if(!empty($error_msg))
                {
                    $error_msg .= '<br />';
                }
                $error_msg .= sprintf($lang['Attachment_too_big'], $allowed_filesize, $size_lang);
            }

            // Check our complete quota
            if ($attach_config['attachment_quota'])
            {
                $sql = 'SELECT sum(filesize) as total FROM ' . ATTACHMENTS_DESC_TABLE;

                if (!($result = $db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Could not query total filesize', '', __LINE__, __FILE__, $sql);
                }

                $row = $db->sql_fetchrow($result);
                $db->sql_freeresult($result);

                $total_filesize = $row['total'];

                if (($total_filesize + $this->filesize) > $attach_config['attachment_quota'])
                {
                    $error = TRUE;
                    if(!empty($error_msg))
                    {
                        $error_msg .= '<br />';
                    }
                    $error_msg .= $lang['Attach_quota_reached'];
                }

            }

            $this->get_quota_limits($userdata);

            // Check our user quota
            if ($this->page != PAGE_PRIVMSGS)
            {
                if ($attach_config['upload_filesize_limit'])
                {
                    $sql = 'SELECT attach_id
                        FROM ' . ATTACHMENTS_TABLE . '
                        WHERE user_id_1 = ' . (int) $userdata['user_id'] . '
                            AND privmsgs_id = 0
                        GROUP BY attach_id';

                    if (!($result = $db->sql_query($sql)))
                    {
                        message_die(GENERAL_ERROR, 'Couldn\'t query attachments', '', __LINE__, __FILE__, $sql);
                    }

                    $attach_ids = $db->sql_fetchrowset($result);
                    $num_attach_ids = $db->sql_numrows($result);
                    $db->sql_freeresult($result);

                    $attach_id = array();

                    for ($i = 0; $i < $num_attach_ids; $i++)
                    {
                        $attach_id[] = intval($attach_ids[$i]['attach_id']);
                    }

                    if ($num_attach_ids > 0)
                    {
                        // Now get the total filesize
                        $sql = 'SELECT sum(filesize) as total
                            FROM ' . ATTACHMENTS_DESC_TABLE . '
                            WHERE attach_id IN (' . implode(', ', $attach_id) . ')';

                        if (!($result = $db->sql_query($sql)))
                        {
                            message_die(GENERAL_ERROR, 'Could not query total filesize', '', __LINE__, __FILE__, $sql);
                        }

                        $row = $db->sql_fetchrow($result);
                        $db->sql_freeresult($result);
                        $total_filesize = $row['total'];
                    }
                    else
                    {
                        $total_filesize = 0;
                    }

                    if (($total_filesize + $this->filesize) > $attach_config['upload_filesize_limit'])
                    {
                        $upload_filesize_limit = $attach_config['upload_filesize_limit'];
                        $size_lang = ($upload_filesize_limit >= 1048576) ? $lang['MB'] : ( ($upload_filesize_limit >= 1024) ? $lang['KB'] : $lang['Bytes'] );

                        if ($upload_filesize_limit >= 1048576)
                        {
                            $upload_filesize_limit = round($upload_filesize_limit / 1048576 * 100) / 100;
                        }
                        else if ($upload_filesize_limit >= 1024)
                        {
                            $upload_filesize_limit = round($upload_filesize_limit / 1024 * 100) / 100;
                        }

                        $error = TRUE;
                        if(!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= sprintf($lang['User_upload_quota_reached'], $upload_filesize_limit, $size_lang);
                    }
                }
            }

            // If we are at Private Messaging, check our PM Quota
            if ($this->page == PAGE_PRIVMSGS)
            {
                if ($attach_config['pm_filesize_limit'])
                {
                    $total_filesize = get_total_attach_pm_filesize('from_user', $userdata['user_id']);

                    if (($total_filesize + $this->filesize) > $attach_config['pm_filesize_limit'])
                    {
                        $error = TRUE;
                        if(!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= $lang['Attach_quota_sender_pm_reached'];
                    }
                }

                $to_user = (isset($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : '';

                // Check Receivers PM Quota
                if (!empty($to_user) && $userdata['user_level'] != ADMIN)
                {
                    $u_data = get_userdata($to_user, true);

                    $user_id = (int) $u_data['user_id'];
                    $this->get_quota_limits($u_data, $user_id);

                    if ($attach_config['pm_filesize_limit'])
                    {
                        $total_filesize = get_total_attach_pm_filesize('to_user', $user_id);

                        if (($total_filesize + $this->filesize) > $attach_config['pm_filesize_limit'])
                        {
                            $error = TRUE;
                            if(!empty($error_msg))
                            {
                                $error_msg .= '<br />';
                            }
                            $error_msg .= sprintf($lang['Attach_quota_receiver_pm_reached'], $to_user);
                        }
                    }
                }
            }

            if ($error)
            {
                unlink_attach($this->attach_filename);
                unlink_attach($this->attach_filename, MODE_THUMBNAIL);
                $this->post_attach = FALSE;
            }
        }
    }

    // Copy the temporary attachment to the right location (copy, move_uploaded_file or ftp)
    function move_uploaded_attachment($upload_mode, $file)
    {
        global $file_mode, $error, $error_msg, $lang, $upload_dir;

        if (!is_uploaded_file($file))
        {
            message_die(GENERAL_ERROR, 'Unable to upload file. The given source has not been uploaded.', __LINE__, __FILE__);
        }

        switch ($upload_mode)
        {
            case 'copy':

                if (!@copy($file, $upload_dir . '/' . basename($this->attach_filename)))
                {
                    if (!@move_uploaded_file($file, $upload_dir . '/' . basename($this->attach_filename)))
                    {
                        $error = TRUE;
                        if(!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= sprintf($lang['General_upload_error'], './' . $upload_dir . '/' . $this->attach_filename);
                        return;
                    }
                }
                @chmod($upload_dir . '/' . basename($this->attach_filename), $file_mode);

            break;

            case 'move':

                if (!@move_uploaded_file($file, $upload_dir . '/' . basename($this->attach_filename)))
                {
                    if (!@copy($file, $upload_dir . '/' . basename($this->attach_filename)))
                    {
                        $error = TRUE;
                        if(!empty($error_msg))
                        {
                            $error_msg .= '<br />';
                        }
                        $error_msg .= sprintf($lang['General_upload_error'], './' . $upload_dir . '/' . $this->attach_filename);
                        return;
                    }
                }
                @chmod($upload_dir . '/' . $this->attach_filename, $file_mode);

            break;

            case 'ftp':
                ftp_file($file, basename($this->attach_filename), $this->type);
            break;
        }

        if (!$error && $this->thumbnail == 1)
        {
            if ($upload_mode == 'ftp')
            {
                $source = $file;
                $dest_file = THUMB_DIR . '/t_' . basename($this->attach_filename);
            }
            else
            {
                $source = $upload_dir . '/' . basename($this->attach_filename);
                $dest_file = amod_realpath($upload_dir);
                $dest_file .= '/' . THUMB_DIR . '/t_' . basename($this->attach_filename);
            }

            if (!create_thumbnail($source, $dest_file, $this->type))
            {
                if (!$file || !create_thumbnail($file, $dest_file, $this->type))
                {
                    $this->thumbnail = 0;
                }
            }
        }
    }
}

/**
* @package attachment_mod
* Attachment posting
*/
class attach_posting extends attach_parent
{
    /**
    * Constructor
    */
    function __construct()
    {
        $this->attach_parent();
        $this->page = 0;
    }

    function attach_posting()
    {
        self::__construct();
    }

    /**
    * Preview Attachments in Posts
    */
    function preview_attachments()
    {
        global $attach_config, $is_auth, $userdata;

        if (intval($attach_config['disable_mod']) || !$is_auth['auth_attachments'])
        {
            return FALSE;
        }

        display_attachments_preview($this->attachment_list, $this->attachment_filesize_list, $this->attachment_filename_list, $this->attachment_comment_list, $this->attachment_extension_list, $this->attachment_thumbnail_list);
    }

    /**
    * Insert an Attachment into a Post (this is the second function called from posting.php)
    */
    function insert_attachment($post_id)
    {
        global $db, $is_auth, $mode, $userdata, $error, $error_msg;

        // Insert Attachment ?
        if (!empty($post_id) && ($mode == 'newtopic' || $mode == 'reply' || $mode == 'editpost') && $is_auth['auth_attachments'])
        {
            $this->do_insert_attachment('attach_list', 'post', $post_id);
            $this->do_insert_attachment('last_attachment', 'post', $post_id);

			if ((sizeof($this->attachment_list) > 0 || $this->post_attach) && !isset($HTTP_POST_VARS['update_attachment']))
            {
                $sql = 'UPDATE ' . POSTS_TABLE . '
                    SET post_attachment = 1
                    WHERE post_id = ' . (int) $post_id;

                if (!($db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Unable to update Posts Table.', '', __LINE__, __FILE__, $sql);
                }

                $sql = 'SELECT topic_id
                    FROM ' . POSTS_TABLE . '
                    WHERE post_id = ' . (int) $post_id;

                if (!($result = $db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Unable to select Posts Table.', '', __LINE__, __FILE__, $sql);
                }

                $row = $db->sql_fetchrow($result);
                $db->sql_freeresult($result);

                $sql = 'UPDATE ' . TOPICS_TABLE . '
                    SET topic_attachment = 1
                    WHERE topic_id = ' . (int) $row['topic_id'];

                if (!($db->sql_query($sql)))
                {
                    message_die(GENERAL_ERROR, 'Unable to update Topics Table.', '', __LINE__, __FILE__, $sql);
                }
            }
        }
    }

    /**
    * Handle Attachments (Add/Delete/Edit/Show) - This is the first function called from every message handler
    */
    function posting_attachment_mod()
    {
        global $mode, $confirm, $is_auth, $post_id, $delete, $refresh, $HTTP_POST_VARS;

        if (!$refresh)
        {
            $add_attachment_box = (!empty($HTTP_POST_VARS['add_attachment_box'])) ? TRUE : FALSE;
            $posted_attachments_box = (!empty($HTTP_POST_VARS['posted_attachments_box'])) ? TRUE : FALSE;

            $refresh = $add_attachment_box || $posted_attachments_box;
        }

        // Choose what to display
        $result = $this->handle_attachments($mode);

        if ($result === false)
        {
            return;
        }

        if ($confirm && ($delete || $mode == 'delete' || $mode == 'editpost') && ($is_auth['auth_delete'] || $is_auth['auth_mod']))
        {
            if ($post_id)
            {
                delete_attachment($post_id);
            }
        }

        $this->display_attachment_bodies();
    }

}

/**
* Entry Point
*/
function execute_posting_attachment_handling()
{
    global $attachment_mod;

    $attachment_mod['posting'] = new attach_posting();
    $attachment_mod['posting']->posting_attachment_mod();
}

?>