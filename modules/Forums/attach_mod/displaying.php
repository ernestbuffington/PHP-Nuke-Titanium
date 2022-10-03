<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/**
*
* @package attachment_mod
* @version $Id: displaying.php,v 1.4 2005/11/06 16:28:14 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

$allowed_extensions = array();
$phpbb2_display_categories = array();
$download_modes = array();
$upload_icons = array();
$attachments = array();

/**
* Clear the templates compile cache
*/
function display_compile_titanium_cache_clear($filename, $phpbb2_template_var)
{
    global $phpbb2_template;

    if (isset($phpbb2_template->cachedir))
    {
        $filename = str_replace($phpbb2_template->root, '', $filename);
        if (substr($filename, 0, 1) == '/')
        {
            $filename = substr($filename, 1, strlen($filename));
        }

        if (file_exists($phpbb2_template->cachedir . $filename . '.php'))
        {
            @unlink($phpbb2_template->cachedir . $filename . '.php');
        }
    }

    return;
}

/**
* Create needed arrays for Extension Assignments
*/
function init_complete_extensions_data()
{
    global $titanium_db, $allowed_extensions, $phpbb2_display_categories, $download_modes, $upload_icons;

    $extension_informations = get_extension_informations();
    $allowed_extensions = array();

    for ($i = 0, $size = count($extension_informations); $i < $size; $i++)
    {
        $extension = strtolower(trim($extension_informations[$i]['extension']));
        $allowed_extensions[] = $extension;
        $phpbb2_display_categories[$extension] = intval($extension_informations[$i]['cat_id']);
        $download_modes[$extension] = intval($extension_informations[$i]['download_mode']);
        $upload_icons[$extension] = trim($extension_informations[$i]['upload_icon']);
    }
}

/**
* Writing Data into plain Template Vars
*/
function init_display_template($phpbb2_template_var, $replacement, $filename = 'viewtopic_attach_body.tpl')
{
    global $phpbb2_template;

    // This function is adapted from the old template class
    // I wish i had the functions from the 3.x one. :D (This class rocks, can't await to use it in Mods)

    // Handle Attachment Informations
    if (!isset($phpbb2_template->uncompiled_code[$phpbb2_template_var]) && empty($phpbb2_template->uncompiled_code[$phpbb2_template_var]))
    {
        // If we don't have a file assigned to this handle, die.
        if (!isset($phpbb2_template->files[$phpbb2_template_var]))
        {
            die("Template->loadfile(): No file specified for handle $phpbb2_template_var");
        }

        $filename_2 = $phpbb2_template->files[$phpbb2_template_var];

        $str = implode('', @file($filename_2));
        if (empty($str))
        {
            die("Template->loadfile(): File $filename_2 for handle $phpbb2_template_var is empty");
        }

        $phpbb2_template->uncompiled_code[$phpbb2_template_var] = $str;
    }

    $complete_filename = $filename;
    if (substr($complete_filename, 0, 1) != '/')
    {
        $complete_filename = $phpbb2_template->root . '/' . $complete_filename;
    }

    if (!file_exists($complete_filename))
    {
        die("Template->make_filename(): Error - file $complete_filename does not exist");
    }

    $content = implode('', file($complete_filename));
    if (empty($content))
    {
        die('Template->loadfile(): File ' . $complete_filename . ' is empty');
    }

    // replace $replacement with uncompiled code in $filename
    $phpbb2_template->uncompiled_code[$phpbb2_template_var] = str_replace($replacement, $content, $phpbb2_template->uncompiled_code[$phpbb2_template_var]);

    // Force Reload on cached version
    display_compile_titanium_cache_clear($phpbb2_template->files[$phpbb2_template_var], $phpbb2_template_var);
}

/**
* BEGIN ATTACHMENT DISPLAY IN POSTS
*/

/**
* Returns the image-tag for the topic image icon
*/
function topic_attachment_image($switch_attachment)
{
    global $attach_config, $phpbb2_is_auth;

    if (intval($switch_attachment) == 0 || (!($phpbb2_is_auth['auth_download'] && $phpbb2_is_auth['auth_view'])) || intval($attach_config['disable_mod']) || $attach_config['topic_icon'] == '')
    {
        return '';
    }

    $image = '<img src="' . $attach_config['topic_icon'] . '" alt="" border="0" /> ';

    return $image;
}

/**
* Display Attachments in Posts
*/
function display_post_attachments($post_id, $switch_attachment)
{
    global $attach_config, $phpbb2_is_auth;

    if (intval($switch_attachment) == 0 || intval($attach_config['disable_mod']))
    {
        return;
    }

    if ($phpbb2_is_auth['auth_download'] && $phpbb2_is_auth['auth_view'])
    {
        display_attachments($post_id);
    }
    else
    {
        // Display Notice (attachment there but not having permissions to view it)
        // Not included because this would mean template and language file changes (at this stage this is not a wise step. ;))
    }
}

/*
//
// Generate the Display Assign File Link
//
function display_assign_link($post_id)
{
    global $attach_config, $phpbb2_is_auth, $phpEx;

    $image = 'templates/subSilver/images/icon_mini_message.gif';

    if ( (intval($attach_config['disable_mod'])) || (!( ($phpbb2_is_auth['auth_download']) && ($phpbb2_is_auth['auth_view']))) )
    {
        return ('');
    }

    $temp_url = append_titanium_sid("assign_file.$phpEx?p=" . $post_id);
    $link = '<a href="' . $temp_url . '" target="_blank"><img src="' . $image . '" alt="Add File" title="Add File" border="0" /></a>';

    return ($link);
}
*/

/**
* Initializes some templating variables for displaying Attachments in Posts
*/
function init_display_post_attachments($switch_attachment)
{
    global $attach_config, $titanium_db, $phpbb2_is_auth, $phpbb2_template, $titanium_lang, $postrow, $phpbb2_total_posts, $attachments, $forum_row, $forum_topic_data;

    if (empty($forum_topic_data) && !empty($forum_row))
    {
        $switch_attachment = $forum_row['topic_attachment'];
    }

    if (intval($switch_attachment) == 0 || intval($attach_config['disable_mod']) || (!($phpbb2_is_auth['auth_download'] && $phpbb2_is_auth['auth_view'])))
    {
        return;
    }

    $post_id_array = array();

    for ($i = 0; $i < $phpbb2_total_posts; $i++)
    {
        if ($postrow[$i]['post_attachment'] == 1)
        {
            $post_id_array[] = (int) $postrow[$i]['post_id'];
        }
    }

	if (sizeof($post_id_array) == 0)
    {
        return;
    }

    $rows = get_attachments_from_post($post_id_array);
	$num_rows = sizeof($rows);

    if ($num_rows == 0)
    {
        return;
    }

    @reset($attachments);

    for ($i = 0; $i < $num_rows; $i++)
    {
        $attachments['_' . $rows[$i]['post_id']][] = $rows[$i];
    }

    init_display_template('body', '{postrow.ATTACHMENTS}');

    init_complete_extensions_data();

    $phpbb2_template->assign_vars(array(
        'L_POSTED_ATTACHMENTS'        => $titanium_lang['Posted_attachments'],
        'L_KILOBYTE'                => $titanium_lang['KB'])
    );
}

/**
* END ATTACHMENT DISPLAY IN POSTS
*/

/**
* BEGIN ATTACHMENT DISPLAY IN PM's
*/

/**
* Returns the image-tag for the PM image icon
*/
function privmsgs_attachment_image($privmsg_id)
{
    global $attach_config, $userdata;

    $auth = ($userdata['user_level'] == ADMIN) ? 1 : intval($attach_config['allow_pm_attach']);

    if (!attachment_exists_db($privmsg_id, PAGE_PRIVMSGS) || !$auth || intval($attach_config['disable_mod']) || $attach_config['topic_icon'] == '')
    {
        return '';
    }

    $image = '<img src="' . $attach_config['topic_icon'] . '" alt="" border="0" /> ';

    return $image;
}

/**
* Display Attachments in PM's
*/
function display_pm_attachments($privmsgs_id, $switch_attachment)
{
    global $attach_config, $userdata, $phpbb2_template, $titanium_lang;

    if ($userdata['user_level'] == ADMIN)
    {
        $auth_download = 1;
    }
    else
    {
        $auth_download = intval($attach_config['allow_pm_attach']);
    }

    if (intval($switch_attachment) == 0 || intval($attach_config['disable_mod']) || !$auth_download)
    {
        return;
    }

    display_attachments($privmsgs_id);

    $phpbb2_template->assign_block_vars('switch_attachments', array());
    $phpbb2_template->assign_vars(array(
        'L_DELETE_ATTACHMENTS'    => $titanium_lang['Delete_attachments'])
    );
}

/**
* Initializes some templating variables for displaying Attachments in Private Messages
*/
function init_display_pm_attachments($switch_attachment)
{
    global $attach_config, $phpbb2_template, $userdata, $titanium_lang, $attachments, $privmsg;

    if ($userdata['user_level'] == ADMIN)
    {
        $auth_download = 1;
    }
    else
    {
        $auth_download = intval($attach_config['allow_pm_attach']);
    }

    if (intval($switch_attachment) == 0 || intval($attach_config['disable_mod']) || !$auth_download)
    {
        return;
    }

    $privmsgs_id = $privmsg['privmsgs_id'];

    @reset($attachments);
    $attachments['_' . $privmsgs_id] = get_attachments_from_pm($privmsgs_id);

	if (sizeof($attachments['_' . $privmsgs_id]) == 0)
    {
        return;
    }

    $phpbb2_template->assign_block_vars('postrow', array());

    init_display_template('body', '{ATTACHMENTS}');

    init_complete_extensions_data();

    $phpbb2_template->assign_vars(array(
        'L_POSTED_ATTACHMENTS'    => $titanium_lang['Posted_attachments'],
        'L_KILOBYTE'            => $titanium_lang['KB'])
    );

    display_pm_attachments($privmsgs_id, $switch_attachment);
}

/**
* END ATTACHMENT DISPLAY IN PM's
*/

/**
* BEGIN ATTACHMENT DISPLAY IN TOPIC REVIEW WINDOW
*/

/**
* Display Attachments in Review Window
*/
function display_review_attachments($post_id, $switch_attachment, $phpbb2_is_auth)
{
    global $attach_config, $attachments;

    if (intval($switch_attachment) == 0 || intval($attach_config['disable_mod']) || (!($phpbb2_is_auth['auth_download'] && $phpbb2_is_auth['auth_view'])) || intval($attach_config['attachment_topic_review']) == 0)
    {
        return;
    }

    @reset($attachments);
    $attachments['_' . $post_id] = get_attachments_from_post($post_id);

	if (sizeof($attachments['_' . $post_id]) == 0)
    {
        return;
    }

    display_attachments($post_id);
}

/**
* Initializes some templating variables for displaying Attachments in Review Topic Window
*/
function init_display_review_attachments($phpbb2_is_auth)
{
    global $attach_config;

    if (intval($attach_config['disable_mod']) || (!($phpbb2_is_auth['auth_download'] && $phpbb2_is_auth['auth_view'])) || intval($attach_config['attachment_topic_review']) == 0)
    {
        return;
    }

    init_display_template('reviewbody', '{postrow.ATTACHMENTS}');

    init_complete_extensions_data();

}

/**
* END ATTACHMENT DISPLAY IN TOPIC REVIEW WINDOW
*/

/**
* BEGIN DISPLAY ATTACHMENTS -> PREVIEW
*/
function display_attachments_preview($attachment_list, $attachment_filesize_list, $attachment_filename_list, $attachment_comment_list, $attachment_extension_list, $attachment_thumbnail_list)
{
    global $attach_config, $phpbb2_is_auth, $allowed_extensions, $titanium_lang, $userdata, $phpbb2_display_categories, $upload_dir, $upload_icons, $phpbb2_template, $titanium_db, $theme;

	if (sizeof($attachment_list) != 0)
    {
        init_display_template('preview', '{ATTACHMENTS}');

        init_complete_extensions_data();

        $phpbb2_template->assign_block_vars('postrow', array());
        $phpbb2_template->assign_block_vars('postrow.attach', array());

        $phpbb2_template->assign_vars(array(
            'T_BODY_TEXT' => '#'.$theme['body_text'],
            'T_TR_COLOR3' => '#'.$theme['tr_color3'])
        );

		for ($i = 0, $size = sizeof($attachment_list); $i < $size; $i++)
        {
            $filename = $upload_dir . '/' . basename($attachment_list[$i]);
            $thumb_filename = $upload_dir . '/' . THUMB_DIR . '/t_' . basename($attachment_list[$i]);

            $filesize = $attachment_filesize_list[$i];
            $size_lang = ($filesize >= 1048576) ? $titanium_lang['MB'] : ( ($filesize >= 1024) ? $titanium_lang['KB'] : $titanium_lang['Bytes'] );

            if ($filesize >= 1048576)
            {
                $filesize = (round((round($filesize / 1048576 * 100) / 100), 2));
            }
            else if ($filesize >= 1024)
            {
                $filesize = (round((round($filesize / 1024 * 100) / 100), 2));
            }

            $display_name = $attachment_filename_list[$i];
            $comment = $attachment_comment_list[$i];
            $comment = str_replace("\n", '<br />', $comment);

            $extension = $attachment_extension_list[$i];

            $denied = false;

            // Admin is allowed to view forbidden Attachments, but the error-message is displayed too to inform the Admin
            if (!in_array($extension, $allowed_extensions))
            {
                $denied = true;

                $phpbb2_template->assign_block_vars('postrow.attach.denyrow', array(
                    'L_DENIED'        => sprintf($titanium_lang['Extension_disabled_after_posting'], $extension))
                );
            }

            if (!$denied)
            {
                // Some basic Template Vars
                $phpbb2_template->assign_vars(array(
                    'L_DESCRIPTION'        => $titanium_lang['Description'],
                    'L_DOWNLOAD'        => $titanium_lang['Download'],
                    'L_FILENAME'        => $titanium_lang['File_name'],
                    'L_FILESIZE'        => $titanium_lang['Filesize'])
                );

                // define category
                $image = FALSE;
                $stream = FALSE;
                $swf = FALSE;
                $thumbnail = FALSE;
                $link = FALSE;

                if (intval($phpbb2_display_categories[$extension]) == STREAM_CAT)
                {
                    $stream = TRUE;
                }
                else if (intval($phpbb2_display_categories[$extension]) == SWF_CAT)
                {
                    $swf = TRUE;
                }
                else if (intval($phpbb2_display_categories[$extension]) == IMAGE_CAT && intval($attach_config['img_display_inlined']))
                {
                    if (intval($attach_config['img_link_width']) != 0 || intval($attach_config['img_link_height']) != 0)
                    {
                        list($width, $height) = image_getdimension($filename);

                        if ($width == 0 && $height == 0)
                        {
                            $image = TRUE;
                        }
                        else
                        {
                            if ($width <= intval($attach_config['img_link_width']) && $height <= intval($attach_config['img_link_height']))
                            {
                                $image = TRUE;
                            }
                        }
                    }
                    else
                    {
                        $image = TRUE;
                    }
                }

                if (intval($phpbb2_display_categories[$extension]) == IMAGE_CAT && intval($attachment_thumbnail_list[$i]) == 1)
                {
                    $thumbnail = TRUE;
                    $image = FALSE;
                }

                if (!$image && !$stream && !$swf && !$thumbnail)
                {
                    $link = TRUE;
                }

                if ($image)
                {
                    // Images
                    $phpbb2_template->assign_block_vars('postrow.attach.cat_images', array(
                        'DOWNLOAD_NAME'        => $display_name,
                        'IMG_SRC'            => $filename,
                        'FILESIZE'            => $filesize,
                        'SIZE_VAR'            => $size_lang,
                        'COMMENT'            => $comment,
                        'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'])
                    );
                }

                if ($thumbnail)
                {
                    // Images, but display Thumbnail
                    $phpbb2_template->assign_block_vars('postrow.attach.cat_thumb_images', array(
                        'DOWNLOAD_NAME'        => $display_name,
                        'IMG_SRC'            => $filename,
                        'IMG_THUMB_SRC'        => $thumb_filename,
                        'FILESIZE'            => $filesize,
                        'SIZE_VAR'            => $size_lang,
                        'COMMENT'            => $comment,
                        'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'])
                    );
                }

                if ($stream)
                {
                    // Streams
                    $phpbb2_template->assign_block_vars('postrow.attach.cat_stream', array(
                        'U_DOWNLOAD_LINK'    => $filename,
                        'DOWNLOAD_NAME'        => $display_name,
                        'FILESIZE'            => $filesize,
                        'SIZE_VAR'            => $size_lang,
                        'COMMENT'            => $comment,
                        'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'])
                    );
                }

                if ($swf)
                {
                    // Macromedia Flash Files
                    list($width, $height) = swf_getdimension($filename);

                    $phpbb2_template->assign_block_vars('postrow.attach.cat_swf', array(
                        'U_DOWNLOAD_LINK'        => $filename,
                        'DOWNLOAD_NAME'            => $display_name,
                        'FILESIZE'                => $filesize,
                        'SIZE_VAR'                => $size_lang,
                        'COMMENT'                => $comment,
                        'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'],
                        'WIDTH'                    => $width,
                        'HEIGHT'                => $height)
                    );
                }

                if ($link)
                {
                    $upload_image = '';

                    if ($attach_config['upload_img'] != '' && $upload_icons[$extension] == '')
                    {
                        $upload_image = '<img src="' . $attach_config['upload_img'] . '" alt="" border="0" />';
                    }
                    else if (trim($upload_icons[$extension]) != '')
                    {
                        $upload_image = '<img src="' . $upload_icons[$extension] . '" alt="" border="0" />';
                    }

                    $target_blank = 'target="_blank"';

                    // display attachment
                    $phpbb2_template->assign_block_vars('postrow.attach.attachrow', array(
                        'U_DOWNLOAD_LINK'        => $filename,
                        'S_UPLOAD_IMAGE'        => $upload_image,

                        'DOWNLOAD_NAME'            => $display_name,
                        'FILESIZE'                => $filesize,
                        'SIZE_VAR'                => $size_lang,
                        'COMMENT'                => $comment,
                        'L_DOWNLOADED_VIEWED'    => $titanium_lang['Downloaded'],
                        'TARGET_BLANK'            => $target_blank)
                    );
                }
            }
        }
    }
}

/**
* END DISPLAY ATTACHMENTS -> PREVIEW
*/

/**
* Assign Variables and Definitions based on the fetched Attachments - internal
* used by all displaying functions, the Data was collected before, it's only dependend on the template used. :)
* before this function is usable, init_display_attachments have to be called for specific pages (pm, posting, review etc...)
*/
function display_attachments($post_id)
{
    global $phpbb2_template, $upload_dir, $userdata, $allowed_extensions, $phpbb2_display_categories, $download_modes, $titanium_db, $titanium_lang, $phpEx, $attachments, $upload_icons, $attach_config;
    global $phpbb2_root_path;

	$num_attachments = sizeof($attachments['_' . $post_id]);

    if ($num_attachments == 0)
    {
        return;
    }

    $phpbb2_template->assign_block_vars('postrow.attach', array());

    for ($i = 0; $i < $num_attachments; $i++)
    {
        // Some basic things...
        $filename = $upload_dir . '/' . basename($attachments['_' . $post_id][$i]['physical_filename']);
        $thumbnail_filename = $upload_dir . '/' . THUMB_DIR . '/t_' . basename($attachments['_' . $post_id][$i]['physical_filename']);

        $upload_image = '';

        if ($attach_config['upload_img'] != '' && trim($upload_icons[$attachments['_' . $post_id][$i]['extension']]) == '')
        {
            $upload_image = '<img src="' . $attach_config['upload_img'] . '" alt="" border="0" />';
        }
        else if (trim($upload_icons[$attachments['_' . $post_id][$i]['extension']]) != '')
        {
            $upload_image = '<img src="' . $upload_icons[$attachments['_' . $post_id][$i]['extension']] . '" alt="" border="0" />';
        }

        $filesize = $attachments['_' . $post_id][$i]['filesize'];
        $size_lang = ($filesize >= 1048576) ? $titanium_lang['MB'] : ( ($filesize >= 1024) ? $titanium_lang['KB'] : $titanium_lang['Bytes'] );

        if ($filesize >= 1048576)
        {
            $filesize = (round((round($filesize / 1048576 * 100) / 100), 2));
        }
        else if ($filesize >= 1024)
        {
            $filesize = (round((round($filesize / 1024 * 100) / 100), 2));
        }

        $display_name = $attachments['_' . $post_id][$i]['real_filename'];
        $comment = $attachments['_' . $post_id][$i]['comment'];
        $comment = str_replace("\n", '<br />', $comment);

        $denied = false;

        // Admin is allowed to view forbidden Attachments, but the error-message is displayed too to inform the Admin
        if (!in_array($attachments['_' . $post_id][$i]['extension'], $allowed_extensions))
        {
            $denied = true;

            $phpbb2_template->assign_block_vars('postrow.attach.denyrow', array(
                'L_DENIED'    => sprintf($titanium_lang['Extension_disabled_after_posting'], $attachments['_' . $post_id][$i]['extension']))
            );
        }

        if (!$denied || $userdata['user_level'] == ADMIN)
        {
            // Some basic Template Vars
            $phpbb2_template->assign_vars(array(
                'L_DESCRIPTION'        => $titanium_lang['Description'],
                'L_DOWNLOAD'        => $titanium_lang['Download'],
                'L_FILENAME'        => $titanium_lang['File_name'],
                'L_FILESIZE'        => $titanium_lang['Filesize'])
            );

            // define category
            $image = FALSE;
            $stream = FALSE;
            $swf = FALSE;
            $thumbnail = FALSE;
            $link = FALSE;

            if (intval($phpbb2_display_categories[$attachments['_' . $post_id][$i]['extension']]) == STREAM_CAT)
            {
                $stream = TRUE;
            }
            else if (intval($phpbb2_display_categories[$attachments['_' . $post_id][$i]['extension']]) == SWF_CAT)
            {
                $swf = TRUE;
            }
            else if (intval($phpbb2_display_categories[$attachments['_' . $post_id][$i]['extension']]) == IMAGE_CAT && intval($attach_config['img_display_inlined']))
            {
                if (intval($attach_config['img_link_width']) != 0 || intval($attach_config['img_link_height']) != 0)
                {
                    list($width, $height) = image_getdimension($filename);

                    if ($width == 0 && $height == 0)
                    {
                        $image = TRUE;
                    }
                    else
                    {
                        if ($width <= intval($attach_config['img_link_width']) && $height <= intval($attach_config['img_link_height']))
                        {
                            $image = TRUE;
                        }
                    }
                }
                else
                {
                    $image = TRUE;
                }
            }

            if (intval($phpbb2_display_categories[$attachments['_' . $post_id][$i]['extension']]) == IMAGE_CAT && $attachments['_' . $post_id][$i]['thumbnail'] == 1)
            {
                $thumbnail = TRUE;
                $image = FALSE;
            }

            if (!$image && !$stream && !$swf && !$thumbnail)
            {
                $link = TRUE;
            }

            if ($image)
            {
                // Images
                // NOTE: If you want to use the download.php everytime an image is displayed inlined, replace the
                // Section between BEGIN and END with (Without the // of course):
                //    $img_source = append_titanium_sid($phpbb2_root_path . 'download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id']);
                //    $download_link = TRUE;
                //
                //
                if (intval($attach_config['allow_ftp_upload']) && trim($attach_config['download_path']) == '')
                {
                    $img_source = append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id']);
                    $download_link = TRUE;
                }
                else
                {
                    // Check if we can reach the file or if it is stored outside of the webroot
                    if ($attach_config['upload_dir'][0] == '/' || ( $attach_config['upload_dir'][0] != '/' && $attach_config['upload_dir'][1] == ':'))
                    {
                        $img_source = append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id']);
                        $download_link = TRUE;
                    }
                    else
                    {
                        // BEGIN
                        $img_source = $filename;
                        $download_link = FALSE;
                        // END
                    }
                }

                $phpbb2_template->assign_block_vars('postrow.attach.cat_images', array(
                    'DOWNLOAD_NAME'        => $display_name,
                    'S_UPLOAD_IMAGE'    => $upload_image,

                    'IMG_SRC'            => $img_source,
                    'FILESIZE'            => $filesize,
                    'SIZE_VAR'            => $size_lang,
                    'COMMENT'            => $comment,
                    'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'],
                    'L_DOWNLOAD_COUNT'        => sprintf($titanium_lang['Download_number'], $attachments['_' . $post_id][$i]['download_count']))
                );

                // Directly Viewed Image ... update the download count
                if (!$download_link)
                {
                    $sql = 'UPDATE ' . ATTACHMENTS_DESC_TABLE . '
                        SET download_count = download_count + 1
                        WHERE attach_id = ' . (int) $attachments['_' . $post_id][$i]['attach_id'];

                    if ( !($titanium_db->sql_query($sql)) )
                    {
                        message_die(GENERAL_ERROR, 'Couldn\'t update attachment download count.', '', __LINE__, __FILE__, $sql);
                    }
                }
            }

            if ($thumbnail)
            {
                // Images, but display Thumbnail
                // NOTE: If you want to use the download.php everytime an thumnmail is displayed inlined, replace the
                // Section between BEGIN and END with (Without the // of course):
                //    $thumb_source = append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id'] . '&amp;thumb=1');
                //
                if (intval($attach_config['allow_ftp_upload']) && trim($attach_config['download_path']) == '')
                {
                    $thumb_source = append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id'] . '&amp;thumb=1');
                }
                else
                {
                    // Check if we can reach the file or if it is stored outside of the webroot
                    if ($attach_config['upload_dir'][0] == '/' || ( $attach_config['upload_dir'][0] != '/' && $attach_config['upload_dir'][1] == ':'))
                    {
                        $thumb_source = append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id'] . '&amp;thumb=1');
                    }
                    else
                    {
                        // BEGIN
                        $thumb_source = $thumbnail_filename;
                        // END
                    }
                }

                $phpbb2_template->assign_block_vars('postrow.attach.cat_thumb_images', array(
                    'DOWNLOAD_NAME'            => $display_name,
                    'S_UPLOAD_IMAGE'        => $upload_image,

                    'IMG_SRC'                => append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id']),
                    'IMG_THUMB_SRC'            => $thumb_source,
                    'FILESIZE'                => $filesize,
                    'SIZE_VAR'                => $size_lang,
                    'COMMENT'                => $comment,
                    'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'],
                    'L_DOWNLOAD_COUNT'        => sprintf($titanium_lang['Download_number'], $attachments['_' . $post_id][$i]['download_count']))
                );
            }

            if ($stream)
            {
                // Streams
                $phpbb2_template->assign_block_vars('postrow.attach.cat_stream', array(
                    'U_DOWNLOAD_LINK'        => $filename,
                    'S_UPLOAD_IMAGE'        => $upload_image,

//                    'U_DOWNLOAD_LINK' => append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id']),
                    'DOWNLOAD_NAME'            => $display_name,
                    'FILESIZE'                => $filesize,
                    'SIZE_VAR'                => $size_lang,
                    'COMMENT'                => $comment,
                    'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'],
                    'L_DOWNLOAD_COUNT'        => sprintf($titanium_lang['Download_number'], $attachments['_' . $post_id][$i]['download_count']))
                );

                // Viewed/Heared File ... update the download count (download.php is not called here)
                $sql = 'UPDATE ' . ATTACHMENTS_DESC_TABLE . '
                    SET download_count = download_count + 1
                    WHERE attach_id = ' . (int) $attachments['_' . $post_id][$i]['attach_id'];

                if ( !($titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Couldn\'t update attachment download count', '', __LINE__, __FILE__, $sql);
                }
            }

            if ($swf)
            {
                // Macromedia Flash Files
                list($width, $height) = swf_getdimension($filename);

                $phpbb2_template->assign_block_vars('postrow.attach.cat_swf', array(
                    'U_DOWNLOAD_LINK'        => $filename,
                    'S_UPLOAD_IMAGE'        => $upload_image,

                    'DOWNLOAD_NAME'            => $display_name,
                    'FILESIZE'                => $filesize,
                    'SIZE_VAR'                => $size_lang,
                    'COMMENT'                => $comment,
                    'L_DOWNLOADED_VIEWED'    => $titanium_lang['Viewed'],
                    'L_DOWNLOAD_COUNT'        => sprintf($titanium_lang['Download_number'], $attachments['_' . $post_id][$i]['download_count']),
                    'WIDTH'                    => $width,
                    'HEIGHT'                => $height)
                );

                // Viewed/Heared File ... update the download count (download.php is not called here)
                $sql = 'UPDATE ' . ATTACHMENTS_DESC_TABLE . '
                    SET download_count = download_count + 1
                    WHERE attach_id = ' . (int) $attachments['_' . $post_id][$i]['attach_id'];

                if ( !($titanium_db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Couldn\'t update attachment download count', '', __LINE__, __FILE__, $sql);
                }
            }

            if ($link)
            {
                $target_blank = 'target="_blank"'; //( (intval($phpbb2_display_categories[$attachments['_' . $post_id][$i]['extension']]) == IMAGE_CAT) ) ? 'target="_blank"' : '';

                // display attachment
                $phpbb2_template->assign_block_vars('postrow.attach.attachrow', array(
                    'U_DOWNLOAD_LINK'    => append_titanium_sid('download.' . $phpEx . '?id=' . $attachments['_' . $post_id][$i]['attach_id']),
                    'S_UPLOAD_IMAGE'    => $upload_image,

                    'DOWNLOAD_NAME'        => $display_name,
                    'FILESIZE'            => $filesize,
                    'SIZE_VAR'            => $size_lang,
                    'COMMENT'            => $comment,
                    'TARGET_BLANK'        => $target_blank,

                    'L_DOWNLOADED_VIEWED'    => $titanium_lang['Downloaded'],
                    'L_DOWNLOAD_COUNT'        => sprintf($titanium_lang['Download_number'], $attachments['_' . $post_id][$i]['download_count']))
                );

            }
        }
    }
}

?>