<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                              admin_words.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_words.php,v 1.10.2.3 2004/03/25 15:57:20 acydburn Exp
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

if( !empty($setmodules) )
{
        $file = basename(__FILE__);
        $titanium_module['General']['Word_Censor'] = $file;
        return;
}

define('IN_PHPBB2', 1);

//
// Load default header
//
$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');
$cancel = (isset($HTTP_POST_VARS['cancel']) || isset($_POST['cancel'])) ? true : false;
$no_page_header = $cancel;
require('./pagestart.' . $phpEx);
if ($cancel)
{
	redirect_titanium(append_titanium_sid("admin_words.$phpEx", true));
}


if( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
        $mode = (isset($HTTP_GET_VARS['mode'])) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
        $mode = htmlspecialchars($mode);
}
else
{
        //
        // These could be entered via a form button
        //
        if( isset($HTTP_POST_VARS['add']) )
        {
                $mode = "add";
        }
        else if( isset($HTTP_POST_VARS['save']) )
        {
                $mode = "save";
        }
        else
        {
                $mode = "";
        }
}

// Restrict mode input to valid options
$mode = ( in_array($mode, array('add', 'edit', 'save', 'delete')) ) ? $mode : '';

if( $mode != "" )
{
        if( $mode == "edit" || $mode == "add" )
        {
                $word_id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : 0;

                $phpbb2_template->set_filenames(array(
                        "body" => "admin/words_edit_body.tpl")
                );

                $word_info = array('word' => '', 'replacement' => '');
                $s_hidden_fields = '';

                if( $mode == "edit" )
                {
                        if( $word_id )
                        {
                                $sql = "SELECT *
                                        FROM " . WORDS_TABLE . "
                                        WHERE word_id = $word_id";
                                if(!$result = $titanium_db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, "Could not query words table", "Error", __LINE__, __FILE__, $sql);
                                }

                                $word_info = $titanium_db->sql_fetchrow($result);
                                $s_hidden_fields .= '<input type="hidden" name="id" value="' . $word_id . '" />';
                        }
                        else
                        {
                                message_die(GENERAL_MESSAGE, $titanium_lang['No_word_selected']);
                        }
                }

                $phpbb2_template->assign_vars(array(
                        "WORD" => htmlspecialchars($word_info['word']),
			            "REPLACEMENT" => htmlspecialchars($word_info['replacement']),

                        "L_WORDS_TITLE" => $titanium_lang['Words_title'],
                        "L_WORDS_TEXT" => $titanium_lang['Words_explain'],
                        "L_WORD_CENSOR" => $titanium_lang['Edit_word_censor'],
                        "L_WORD" => $titanium_lang['Word'],
                        "L_REPLACEMENT" => $titanium_lang['Replacement'],
                        "L_SUBMIT" => $titanium_lang['Submit'],

                        "S_WORDS_ACTION" => append_titanium_sid("admin_words.$phpEx"),
                        "S_HIDDEN_FIELDS" => $s_hidden_fields)
                );

                $phpbb2_template->pparse("body");

                include('./page_footer_admin.'.$phpEx);
        }
        else if( $mode == "save" )
        {
                $word_id = ( isset($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : 0;
                $word = ( isset($HTTP_POST_VARS['word']) ) ? trim($HTTP_POST_VARS['word']) : "";
                $replacement = ( isset($HTTP_POST_VARS['replacement']) ) ? trim($HTTP_POST_VARS['replacement']) : "";

                if(empty($word) || empty($replacement))
                {
                        message_die(GENERAL_MESSAGE, $titanium_lang['Must_enter_word']);
                }

                if( $word_id )
                {
                        $sql = "UPDATE " . WORDS_TABLE . "
                                SET word = '" . str_replace("\'", "''", $word) . "', replacement = '" . str_replace("\'", "''", $replacement) . "'
                                WHERE word_id = $word_id";
                        $message = $titanium_lang['Word_updated'];
                }
                else
                {
                        $sql = "INSERT INTO " . WORDS_TABLE . " (word, replacement)
                                VALUES ('" . str_replace("\'", "''", $word) . "', '" . str_replace("\'", "''", $replacement) . "')";
                        $message = $titanium_lang['Word_added'];
                }

                if(!$result = $titanium_db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, "Could not insert data into words table", $titanium_lang['Error'], __LINE__, __FILE__, $sql);
                }

                $message .= "<br /><br />" . sprintf($titanium_lang['Click_return_wordadmin'], "<a href=\"" . append_titanium_sid("admin_words.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

                message_die(GENERAL_MESSAGE, $message);
        }
        else if( $mode == "delete" )
        {
                if( isset($HTTP_POST_VARS['id']) ||  isset($HTTP_GET_VARS['id']) )
                {
                        $word_id = ( isset($HTTP_POST_VARS['id']) ) ? $HTTP_POST_VARS['id'] : $HTTP_GET_VARS['id'];
                        $word_id = intval($word_id);
                }
                else
                {
                        $word_id = 0;
                }
                $confirm = isset($HTTP_POST_VARS['confirm']);
                if( $word_id && $confirm )
                {
                        $sql = "DELETE FROM " . WORDS_TABLE . "
                                WHERE word_id = $word_id";

                        if(!$result = $titanium_db->sql_query($sql))
                        {
                                message_die(GENERAL_ERROR, "Could not remove data from words table", $titanium_lang['Error'], __LINE__, __FILE__, $sql);
                        }

                        $message = $titanium_lang['Word_removed'] . "<br /><br />" . sprintf($titanium_lang['Click_return_wordadmin'], "<a href=\"" . append_titanium_sid("admin_words.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

                        message_die(GENERAL_MESSAGE, $message);
                }
                elseif( $word_id && !$confirm)
         		{
         			// Present the confirmation screen to the user
         			$phpbb2_template->set_filenames(array(
         				'body' => 'admin/confirm_body.tpl')
         			);

         			$hidden_fields = '<input type="hidden" name="mode" value="delete" /><input type="hidden" name="id" value="' . $word_id . '" />';

         			$phpbb2_template->assign_vars(array(
         				'MESSAGE_TITLE' => $titanium_lang['Confirm'],
         				'MESSAGE_TEXT' => $titanium_lang['Confirm_delete_word'],

         				'L_YES' => $titanium_lang['Yes'],
         				'L_NO' => $titanium_lang['No'],

         				'S_CONFIRM_ACTION' => append_titanium_sid("admin_words.$phpEx"),
         				'S_HIDDEN_FIELDS' => $hidden_fields)
         			);
         		}
                else
                {
                        message_die(GENERAL_MESSAGE, $titanium_lang['No_word_selected']);
                }
        }
}
else
{
        $phpbb2_template->set_filenames(array(
                "body" => "admin/words_list_body.tpl")
        );

        $sql = "SELECT *
                FROM " . WORDS_TABLE . "
                ORDER BY word";
        if( !$result = $titanium_db->sql_query($sql) )
        {
                message_die(GENERAL_ERROR, "Could not query words table", $titanium_lang['Error'], __LINE__, __FILE__, $sql);
        }

        $word_rows = $titanium_db->sql_fetchrowset($result);
        $titanium_db->sql_freeresult($result);
        $word_count = count($word_rows);

        $phpbb2_template->assign_vars(array(
                "L_WORDS_TITLE" => $titanium_lang['Words_title'],
                "L_WORDS_TEXT" => $titanium_lang['Words_explain'],
                "L_WORD" => $titanium_lang['Word'],
                "L_REPLACEMENT" => $titanium_lang['Replacement'],
                "L_EDIT" => $titanium_lang['Edit'],
                "L_DELETE" => $titanium_lang['Delete'],
                "L_ADD_WORD" => $titanium_lang['Add_new_word'],
                "L_ACTION" => $titanium_lang['Action'],

                "S_WORDS_ACTION" => append_titanium_sid("admin_words.$phpEx"),
                "S_HIDDEN_FIELDS" => '')
        );

        for($i = 0; $i < $word_count; $i++)
        {
                $word = $word_rows[$i]['word'];
                $replacement = $word_rows[$i]['replacement'];
                $word_id = $word_rows[$i]['word_id'];

                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                $phpbb2_template->assign_block_vars("words", array(
                        "ROW_COLOR" => "#" . $row_color,
                        "ROW_CLASS" => $row_class,
                        "WORD" => htmlspecialchars($word),
			            "REPLACEMENT" => htmlspecialchars($replacement),

                        "U_WORD_EDIT" => append_titanium_sid("admin_words.$phpEx?mode=edit&amp;id=$word_id"),
                        "U_WORD_DELETE" => append_titanium_sid("admin_words.$phpEx?mode=delete&amp;id=$word_id"))
                );
        }
}

$phpbb2_template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>