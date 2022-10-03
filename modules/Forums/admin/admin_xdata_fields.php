<?php

/**
 * admin_xdata_fields.php
 *
 * @package xData
 * @author Noobarmy < noobarmy@phpbbmodders.net > (Anthony Chu)
 *
 */

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$titanium_module['XData']['Manage_Fields'] = $file;
	return;
}

//
// Load default header
//
$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include('../../../includes/functions_admin.'.$phpEx);

//
// include language file (borrowed mercilessly from CyberAlien's eXtreme Styles MOD)
//
if(!defined('XD_LANG_INCLUDED'))
{
	$xs_lang_file = $phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_xd.'.$phpEx;
	if( !@file_exists($xs_lang_file) )
	{	// load english version if there is no translation to current language
		$xs_lang_file = $phpbb2_root_path . 'language/lang_english/lang_xd.'.$phpEx;
	}
	@include($xs_lang_file);
	define('XD_LANG_INCLUDED', true);
}

/*
 Mode setting
*/
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
	$mode = "view";
}

//
// Get the metadata
//
$xd_meta = get_xd_metadata();

/*
 Main program
*/
switch ($mode)
{
	case 'up':
	case 'down':

		if ( ! isset($HTTP_GET_VARS['name']) )
		{
			message_die(GENERAL_ERROR, $titanium_lang['XData_no_field_selected']);
		}
		else
		{
			$name = htmlspecialchars($HTTP_GET_VARS['name']);

			if ( ! isset($xd_meta[$name]) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_field_non_existant']);
			}
		}

		$swap1 = $xd_meta[$name];

		$sql = "SELECT field_id, field_order
			FROM " . XDATA_FIELDS_TABLE ."
			WHERE field_order " . ( ($mode == 'up') ? '<' : '>' ) . $swap1['field_order'] . "
			ORDER BY field_order " . ( ($mode == 'up') ? 'DESC' : 'ASC' ) . "
			LIMIT 1";

		if ( !( $result = $titanium_db->sql_query($sql) ) )
		{
			message_die(GENERAL_ERROR, $titanium_lang['XData_unable_to_switch_fields'], '', __LINE__, __FILE__, $sql);
		}

		$swap2 = $titanium_db->sql_fetchrow($result);

		if ($swap1 && $swap2)
		{
			$sql = "UPDATE " . XDATA_FIELDS_TABLE . "
				SET field_order = " . $swap2['field_order'] . "
				WHERE field_id = " . $swap1['field_id'];

			if ( ! $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_unable_to_switch_fields'], '', __LINE__, __FILE__, $sql);
			}

		    $sql = "UPDATE " . XDATA_FIELDS_TABLE . "
				SET field_order = " . $swap1['field_order'] . "
				WHERE field_id = " . $swap2['field_id'];

			if ( ! $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_unable_to_switch_fields'], '', __LINE__, __FILE__, $sql);
			}
		}

		$mode = 'view';
		$xd_meta = get_xd_metadata(true);
		break;

	case 'edit':

    	if( isset($HTTP_POST_VARS['name']) || isset($HTTP_GET_VARS['name']) )
		{
			$name = ( isset($HTTP_POST_VARS['name']) ) ? htmlspecialchars($HTTP_POST_VARS['name']) : htmlspecialchars($HTTP_GET_VARS['name']);
		}
		else
		{
			message_die(GENERAL_ERROR, 'No field was specified.');
		}

		if ( ! isset($xd_meta[$name]) )
		{
			message_die(GENERAL_ERROR, 'That field does not exist.');
		}

		if ( ! isset($HTTP_POST_VARS['submit']) )
		{
			/*
			Show the edit form
			*/

			$meta = $xd_meta[$name];

			if ($meta['field_type'] != 'special')
			{
				$phpbb2_template->set_filenames( array('body' => 'admin/xd_edit_body.tpl') );
			}
			else
			{
				$phpbb2_template->set_filenames( array('body' => 'admin/xd_edit_body_limited.tpl') );
			}

			switch ( $meta['field_regexp'] )
			{
				case '':
										$regexp_none = true;
				break;
				case XD_REGEXP_NUMBERS:
										$regexp_numbers = true;
				break;
				case XD_REGEXP_LETTERS:
										$regexp_letters = true;
				break;
				default:
										$regexp_custom = true;
				break;
			}

			$manditory = (isset($meta['manditory'])) ? intval($meta['manditory']) : 0;

			$phpbb2_template->assign_vars(array(
				'NAME' => $meta['field_name'],
				'CODE_NAME' => $meta['code_name'],
				'DESCRIPTION' => $meta['field_desc'],
				'TYPE' => $meta['field_type'],
				'LENGTH' => $meta['field_length'],
				'VALUES' => $meta['field_values'],

				'MANDITORY_YES_CHECKED' => ($manditory == 1) ? ' checked="checked"' : '',
				'MANDITORY_NO_CHECKED' => ($manditory == 0) ? ' checked="checked"' : '',

				'REGEXP_NONE_CHECKED' => ($regexp_none) ? ' checked="checked"': '',
				'REGEXP_NUMBERS_CHECKED' => ( $regexp_numbers ) ? ' checked="checked"' : '',
				'REGEXP_LETTERS_CHECKED' => ( $regexp_letters ) ? ' checked="checked"' : '',
				'REGEXP_CUSTOM_CHECKED' => ( $regexp_custom ) ? ' checked="checked"' : '',
				'REGEXP_CUSTOM' => ( $regexp_custom ) ? $meta['field_regexp'] : '',

				'TEXT_SELECTED' => ( $meta['field_type'] == 'text' ) ? ' selected="selected"' : '',
				'TEXTAREA_SELECTED' => ( $meta['field_type'] == 'textarea' ) ? ' selected="selected"' : '',
				'RADIO_SELECTED' => ( $meta['field_type'] == 'radio' ) ? ' selected="selected"' : '',
				'SELECT_SELECTED' => ( $meta['field_type'] == 'select' ) ? ' selected="selected"' : '',
				'CHECKBOX_SELECTED' => ( $meta['field_type'] == 'checkbox' ) ? ' selected="selected"' : '',
				'CUSTOM_SELECTED' => ( $meta['field_type'] == 'custom' ) ? ' selected="selected"' : '',

'DATE_SELECTED' => ( $meta['field_type'] == 'date' ) ? ' selected="selected"' : '',
				'DEFAULT_AUTH_ALLOW_CHECKED' => ( $meta['default_auth'] == 1 ) ? ' checked="checked"' : '',
				'DEFAULT_AUTH_DENY_CHECKED' => ( $meta['default_auth'] == 0 ) ? ' checked="checked"' : '',

				'DISPLAY_REGISTER_NORMAL_CHECKED' => ( $meta['display_register'] == XD_DISPLAY_NORMAL ) ? ' checked="checked"' : '',
				'DISPLAY_REGISTER_NONE_CHECKED' => ( $meta['display_register'] == XD_DISPLAY_NONE ) ? ' checked="checked"' : '',
				'DISPLAY_REGISTER_ROOT_CHECKED' => ( $meta['display_register'] == XD_DISPLAY_ROOT ) ? ' checked="checked"' : '',

				'DISPLAY_POSTING_NORMAL_CHECKED' => ( $meta['display_posting'] == XD_DISPLAY_NORMAL ) ? ' checked="checked"' : '',
				'DISPLAY_POSTING_NONE_CHECKED' => ( $meta['display_posting'] == XD_DISPLAY_NONE ) ? ' checked="checked"' : '',
				'DISPLAY_POSTING_ROOT_CHECKED' => ( $meta['display_posting'] == XD_DISPLAY_ROOT ) ? ' checked="checked"' : '',

				'DISPLAY_PROFILE_NORMAL_CHECKED' => ( $meta['display_viewprofile'] == XD_DISPLAY_NORMAL ) ? ' checked="checked"' : '',
				'DISPLAY_PROFILE_NONE_CHECKED' => ( $meta['display_viewprofile'] == XD_DISPLAY_NONE ) ? ' checked="checked"' : '',
				'DISPLAY_PROFILE_ROOT_CHECKED' => ( $meta['display_viewprofile'] == XD_DISPLAY_ROOT ) ? ' checked="checked"' : '',

				'HANDLE_INPUT_YES_CHECKED' => ( $meta['handle_input'] == 1 ) ? ' checked="checked"' : '',
				'HANDLE_INPUT_NO_CHECKED' => ( $meta['handle_input'] == 0 ) ? ' checked="checked"' : '',

                		'ALLOW_BBCODE_YES_CHECKED' => ( $meta['allow_bbcode'] == 1 ) ? ' checked="checked"' : '',
				'ALLOW_BBCODE_NO_CHECKED' => ( $meta['allow_bbcode'] == 0 ) ? 'checked="checked"' : '',

                		'ALLOW_SMILIES_YES_CHECKED' => ( $meta['allow_smilies'] == 1 ) ? ' checked="checked"' : '',
				'ALLOW_SMILIES_NO_CHECKED' => ( $meta['allow_smilies'] == 0 ) ? ' checked="checked"' : '',

                		'ALLOW_HTML_YES_CHECKED' => ( $meta['allow_html'] == 1 ) ? ' checked="checked"' : '',
				'ALLOW_HTML_NO_CHECKED' => ( $meta['allow_html'] == 0 ) ? ' checked="checked"' : '',

                'VIEWTOPIC_YES_CHECKED' => ( $meta['viewtopic'] == 1 ) ? ' checked="checked"' : '',
                'VIEWTOPIC_NO_CHECKED' => ( $meta['viewtopic'] == 0 ) ? ' checked="checked"' : '',

                'SIGNUP_YES_CHECKED' => ( $meta['signup'] == 1 ) ? ' checked="checked"' : '',
                'SIGNUP_NO_CHECKED' => ( $meta['signup'] == 0 ) ? ' checked="checked"' : '',

                		'AUTH_ALLOW' => XD_AUTH_ALLOW,
        			'AUTH_DENY' => XD_AUTH_DENY,

				'S_HIDDEN_FIELDS' => '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="name" value="'.$name.'" />'
				)
			);

			$phpbb2_template->assign_vars(array(
				'L_BASIC_OPTIONS' => $titanium_lang['Basic_Options'],
				'L_ADVANCED_OPTIONS' => $titanium_lang['Advanced_Options'],
				'L_ADVANCED_NOTICE' => $titanium_lang['Advanced_warning'],
				'L_XDATA_ADMIN' => $titanium_lang['edit_xdata_field'],
				'L_NAME' => $titanium_lang['Name'],
				'L_DESCRIPTION' => $titanium_lang['xd_description'],
				'L_TYPE' => $titanium_lang['type'],
				'L_TEXT' => $titanium_lang['Text'],
				'L_TEXTAREA' => $titanium_lang['Text_area'],
				'L_SELECT' => $titanium_lang['Select'],
				'L_RADIO' => $titanium_lang['Radio'],
'L_DATE' => $titanium_lang['Date'],
				'L_CHECKBOX' => $titanium_lang['Checkbox'],
				'L_CUSTOM' => $titanium_lang['Custom'],
				'L_LENGTH' => $titanium_lang['Length'],
				'L_LENGTH_EXPLAIN' => $titanium_lang['Length_explain'],
				'L_VALUES' => $titanium_lang['Values'],
				'L_VALUES_EXPLAIN' => $titanium_lang['Values_explain'],
				'L_DEFAULT_AUTH' => $titanium_lang['Default_auth'],
				'L_DEFAULT_AUTH_EXPLAIN' => $titanium_lang['Default_auth_explain'],

				'L_ALLOW_BBCODE' => $titanium_lang['Allow_BBCode'],
				'L_ALLOW_SMILIES' => $titanium_lang['Allow_smilies'],
                		'L_ALLOW_HTML' => $titanium_lang['Allow_html'],

				'L_DISPLAY_TYPE' => $titanium_lang['Display_type'],
				'L_DISPLAY_REGISTER_EXPLAIN' => $titanium_lang['Display_register_explain'],
				'L_DISPLAY_PROFILE_EXPLAIN' => $titanium_lang['Display_viewprofile_explain'],
				'L_DISPLAY_POSTING_EXPLAIN' => $titanium_lang['Display_viewtopic_explain'],
                'L_SIGNUP' => $titanium_lang['Signup'],
                'L_VIEWTOPIC' => $titanium_lang['Viewtopic'],
				'L_NORMAL' => $titanium_lang['Display_normal'],
				'L_NONE' => $titanium_lang['Display_none'],
				'L_ROOT' => $titanium_lang['Display_root'],
				'L_CODE_NAME' => $titanium_lang['Code_name'],
				'L_CODE_NAME_EXPLAIN' => $titanium_lang['Code_name_explain'],
				'L_REGEXP' => $titanium_lang['Regexp'],
				'L_REGEXP_EXPLAIN' => $titanium_lang['Regexp_explain'],
				'L_HANDLE_INPUT' => $titanium_lang['handle_input'],
				'L_HANDLE_INPUT_EXPLAIN' => $titanium_lang['handle_input_explain'],
				'L_SUBMIT' => $titanium_lang['Submit'],
				'L_RESET' => $titanium_lang['Reset'],
				'L_ALLOW' => $titanium_lang['Allow'],
				'L_DENY' => $titanium_lang['Deny'],
				'L_YES' => $titanium_lang['Yes'],
				'L_NO' => $titanium_lang['No'],

				'L_NONE' => $titanium_lang['none'],
				'L_MANDITORY' => $titanium_lang['manditory'],
				'L_NUMBERS' => $titanium_lang['numbers'],
				'L_LETTERS' => $titanium_lang['letters'],
				'L_CUSTOM' => $titanium_lang['custom']
				)
			);

			$phpbb2_template->pparse('body');

		}
		else
		{
			/*
			 The data has been submitted, so update it in the DB
			*/

			$code_name = ( isset($HTTP_POST_VARS['name']) ) ? htmlspecialchars($HTTP_POST_VARS['name']) : '';
			$new_code_name = ( isset($HTTP_POST_VARS['new_code_name']) ) ? htmlspecialchars($HTTP_POST_VARS['new_code_name']) : '';
			$field_name = ( isset($HTTP_POST_VARS['field_name']) ) ? htmlspecialchars($HTTP_POST_VARS['field_name']) : '';
			$field_desc = ( isset($HTTP_POST_VARS['field_desc']) ) ? htmlspecialchars($HTTP_POST_VARS['field_desc']) : '';
			$type = ( isset($HTTP_POST_VARS['field_type']) ) ? htmlspecialchars($HTTP_POST_VARS['field_type']) : '';
			$field_length = intval(( isset($HTTP_POST_VARS['field_length']) ) ? intval($HTTP_POST_VARS['field_length'] ): '');
			$field_values = ( isset($HTTP_POST_VARS['field_values']) ) ? htmlspecialchars($HTTP_POST_VARS['field_values']) : '';

			switch ( $HTTP_POST_VARS['regexp'] )
			{
				case 'none':
						$field_regexp = '';
				break;
				case 'numbers':
						$field_regexp = XD_REGEXP_NUMBERS;
				break;
				case 'letters':
						$field_regexp = XD_REGEXP_LETTERS;
				break;
				case 'custom':
						$field_regexp = $HTTP_POST_VARS['regexp_custom'];
				break;
			}
            $signup = ( isset($HTTP_POST_VARS['signup']) ) ? intval($HTTP_POST_VARS['signup']) : 0;
            $viewtopic = ( isset($HTTP_POST_VARS['viewtopic']) ) ? intval($HTTP_POST_VARS['viewtopic']) : 0;
			$default_auth = ( isset($HTTP_POST_VARS['default_auth']) ) ? htmlspecialchars($HTTP_POST_VARS['default_auth']) : '';
			$display_register = ( isset($HTTP_POST_VARS['display_register']) ) ? intval($HTTP_POST_VARS['display_register']) : XD_DISPLAY_NORMAL;
			$display_viewprofile = ( isset($HTTP_POST_VARS['display_viewprofile']) ) ? intval($HTTP_POST_VARS['display_viewprofile']) : XD_DISPLAY_NORMAL;
			$display_posting = ( isset($HTTP_POST_VARS['display_posting']) ) ? intval($HTTP_POST_VARS['display_posting']) : XD_DISPLAY_NORMAL;
			$handle_input = ( isset($HTTP_POST_VARS['handle_input']) ) ? intval($HTTP_POST_VARS['handle_input']) : 1;
			$allow_bbcode =  (isset($HTTP_POST_VARS['allow_bbcode']) ) ? intval($HTTP_POST_VARS['allow_bbcode']) : 1;
			$allow_smilies =  ( isset($HTTP_POST_VARS['allow_smilies']) ) ? intval($HTTP_POST_VARS['allow_smilies']) : 1;
   			$allow_html =( isset($HTTP_POST_VARS['allow_html']) ) ? intval($HTTP_POST_VARS['allow_html']) : 1;

			$manditory = (isset($HTTP_POST_VARS['manditory'])) ? intval($HTTP_POST_VARS['manditory']) : 0;

			if ( $code_name == '' )
			{
            			message_die(GENERAL_ERROR, 'No field specified.');
			}
			elseif ( ! isset($xd_meta[$code_name]) )
			{
				message_die(GENERAL_ERROR, 'The field you were editing does not exist.');
			}

			if ( strlen($field_regexp) > 0 )
			{
				$check = create_function('$errno, $errstr, $errfile, $errline', 'message_die("GENERAL_ERROR", "You have an error in your regular expression syntax:<br /><br />$errstr");');
				set_error_handler($check);
				$test = preg_match($field_regexp, 'this is a test to see whether the regexp will compile properly');
				restore_error_handler();
			}

			$sql = "UPDATE " . XDATA_FIELDS_TABLE . "
				SET field_name = '" . $field_name . "',
				" . "field_desc = '" . $field_desc . "',
				" . "field_type = '" . $type . "',
				" . "manditory = '" . $manditory . "',
				" . "field_length = '" . $field_length . "',
				" . "field_values = '" . $field_values . "',
				" . "field_regexp = '" . $field_regexp . "',
				" . "default_auth = " . $default_auth . ",
				" . "display_register = " . $display_register . ",
				" . "display_viewprofile = " . $display_viewprofile . ",
				" . "display_posting = " . $display_posting . ",
				" . "handle_input = " . $handle_input . ",
				" . "allow_bbcode = " . $allow_bbcode . ",
				" . "allow_smilies = " . $allow_smilies . ",
				" . "allow_html = " . $allow_html . ",
				" . "viewtopic = " . $viewtopic . ",
                " . "signup = " . $signup . ",
				" . "code_name = '"
				. ( ( ( strlen($new_code_name) > 0 ) && ( $new_code_name != $code_name ) ) ? $new_code_name : $code_name )
				. "'
				WHERE code_name = '" . $code_name . "'";

			if ( ! $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_error_updating_fields'], '', __LINE__, __FILE__, $sql);
			}

           	 $message = $titanium_lang['Edit_success'] . "<br /><br />" . sprintf($titanium_lang['Click_return_fields'], "<a href=\"" . append_titanium_sid("admin_xdata_fields.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);
		}

		break;

	case 'add':

		if ( ! isset($HTTP_POST_VARS['submit']) )
		{
			/*
			Show the form
			*/

			$phpbb2_template->set_filenames( array( 'body' => 'admin/xd_edit_body.tpl' ) );

        	$phpbb2_template->assign_vars(array(
        			'DEFAULT_AUTH_ALLOW_CHECKED' => ' checked="checked"',
        			'AUTH_ALLOW' => XD_AUTH_ALLOW,
        			'AUTH_DENY' => XD_AUTH_DENY,
                		'DISPLAY_REGISTER_NORMAL_CHECKED' => ' checked="checked"',
				'DISPLAY_PROFILE_NORMAL_CHECKED' => ' checked="checked"',
				'DISPLAY_POSTING_NORMAL_CHECKED' => ' checked="checked"',
				'HANDLE_INPUT_YES_CHECKED' => ' checked="checked"',
				'ALLOW_BBCODE_YES_CHECKED' => ' checked="checked"',
				'ALLOW_SMILIES_YES_CHECKED' => ' checked="checked"',
				'ALLOW_HTML_NO_CHECKED' => ' checked="checked"',
				'MANDITORY_YES_CHECKED' => ' checked="checked"',
				'REGEXP_NONE_CHECKED' => ' checked="checked"',
				'VIEWTOPIC_NO_CHECKED' => ' checked="checked"',
                'SIGNUP_NO_CHECKED' => ' checked="checked"',
				'L_BASIC_OPTIONS' => $titanium_lang['Basic_Options'],
				'L_ADVANCED_OPTIONS' => $titanium_lang['Advanced_Options'],
				'L_ADVANCED_NOTICE' => $titanium_lang['Advanced_warning'],
				'L_XDATA_ADMIN' => $titanium_lang['add_xdata_field'],
				'L_NAME' => $titanium_lang['Name'],
				'L_DESCRIPTION' => $titanium_lang['xd_description'],
				'L_TYPE' => $titanium_lang['type'],
				'L_TEXT' => $titanium_lang['Text'],
				'L_TEXTAREA' => $titanium_lang['Text_area'],
				'L_SELECT' => $titanium_lang['Select'],
				'L_RADIO' => $titanium_lang['Radio'],
'L_DATE' => $titanium_lang['Date'],
				'L_CHECKBOX' => $titanium_lang['Checkbox'],
				'L_CUSTOM' => $titanium_lang['Custom'],
				'L_LENGTH' => $titanium_lang['Length'],
				'L_LENGTH_EXPLAIN' => $titanium_lang['Length_explain'],
				'L_VALUES' => $titanium_lang['Values'],
				'L_VALUES_EXPLAIN' => $titanium_lang['Values_explain'],
				'L_DEFAULT_AUTH' => $titanium_lang['Default_auth'],
				'L_DEFAULT_AUTH_EXPLAIN' => $titanium_lang['Default_auth_explain'],
				'L_ALLOW_BBCODE' => $titanium_lang['Allow_BBCode'],
				'L_ALLOW_SMILIES' => $titanium_lang['Allow_smilies'],
				'L_ALLOW_HTML' => $titanium_lang['Allow_html'],
				'L_DISPLAY_TYPE' => $titanium_lang['Display_type'],
				'L_DISPLAY_REGISTER_EXPLAIN' => $titanium_lang['Display_register_explain'],
				'L_DISPLAY_PROFILE_EXPLAIN' => $titanium_lang['Display_viewprofile_explain'],
				'L_DISPLAY_POSTING_EXPLAIN' => $titanium_lang['Display_viewtopic_explain'],
				'L_VIEWTOPIC' => $titanium_lang['Viewtopic'],
                'L_SIGNUP' => $titanium_lang['Signup'],
				'L_NORMAL' => $titanium_lang['Display_normal'],
				'L_NONE' => $titanium_lang['Display_none'],
				'L_ROOT' => $titanium_lang['Display_root'],
				'L_CODE_NAME' => $titanium_lang['Code_name'],
				'L_CODE_NAME_EXPLAIN' => $titanium_lang['Code_name_explain'],
				'L_REGEXP' => $titanium_lang['Regexp'],
				'L_REGEXP_EXPLAIN' => $titanium_lang['Regexp_explain'],
				'L_HANDLE_INPUT' => $titanium_lang['handle_input'],
				'L_HANDLE_INPUT_EXPLAIN' => $titanium_lang['handle_input_explain'],
				'L_SUBMIT' => $titanium_lang['Submit'],
				'L_RESET' => $titanium_lang['Reset'],
				'L_ALLOW' => $titanium_lang['Allow'],
				'L_DENY' => $titanium_lang['Deny'],
				'L_YES' => $titanium_lang['Yes'],
				'L_NO' => $titanium_lang['No'],

				'L_NONE' => $titanium_lang['none'],
				'L_MANDITORY' => $titanium_lang['manditory'],
				'L_NUMBERS' => $titanium_lang['numbers'],
				'L_LETTERS' => $titanium_lang['letters'],
				'L_CUSTOM' => $titanium_lang['custom']

				)
			);

			$phpbb2_template->pparse('body');
  		}
  		else
  		{
  			/*
			The data has been submitted, so add it to the DB
			*/

			$field_name = ( isset($HTTP_POST_VARS['field_name']) ) ? htmlspecialchars($HTTP_POST_VARS['field_name']) : '';
			$new_code_name = ( isset($HTTP_POST_VARS['new_code_name']) ) ? htmlspecialchars($HTTP_POST_VARS['new_code_name']) : '';
			$field_desc = ( isset($HTTP_POST_VARS['field_desc']) ) ? htmlspecialchars($HTTP_POST_VARS['field_desc']) : '';
			$field_type = ( isset($HTTP_POST_VARS['field_type']) ) ? htmlspecialchars($HTTP_POST_VARS['field_type']) : '';
			$field_length = intval(( isset($HTTP_POST_VARS['field_length']) ) ? intval($HTTP_POST_VARS['field_length']) : '');
			$field_values = ( isset($HTTP_POST_VARS['field_values']) ) ? htmlspecialchars($HTTP_POST_VARS['field_values']) : '';

			switch ( $HTTP_POST_VARS['regexp'] )
			{
				case 'none':
						$field_regexp = '';
				break;
				case 'numbers':
						$field_regexp = XD_REGEXP_NUMBERS;
				break;
				case 'letters':
						$field_regexp = XD_REGEXP_LETTERS;
				break;
				case 'custom':
						$field_regexp = $HTTP_POST_VARS['regexp_custom'];
				break;
			}
            $signup = ( isset($HTTP_POST_VARS['signup']) ) ? intval($HTTP_POST_VARS['signup']) : 0;
            $viewtopic = ( isset($HTTP_POST_VARS['viewtopic']) ) ? intval($HTTP_POST_VARS['viewtopic']) : 0;
			$default_auth = ( isset($HTTP_POST_VARS['default_auth']) ) ? htmlspecialchars($HTTP_POST_VARS['default_auth']) : '';
			$display_register = ( isset($HTTP_POST_VARS['display_register']) ) ? intval($HTTP_POST_VARS['display_register']) : XD_DISPLAY_NORMAL;
			$display_viewprofile = ( isset($HTTP_POST_VARS['display_viewprofile']) ) ? intval($HTTP_POST_VARS['display_viewprofile']) : XD_DISPLAY_NORMAL;
			$display_posting = ( isset($HTTP_POST_VARS['display_posting']) ) ? intval($HTTP_POST_VARS['display_posting']) : XD_DISPLAY_NORMAL;
         	$handle_input = ( isset($HTTP_POST_VARS['handle_input']) ) ? intval($HTTP_POST_VARS['handle_input']) : 1;
			$allow_bbcode = ( isset($HTTP_POST_VARS['allow_bbcode']) ) ? intval($HTTP_POST_VARS['allow_bbcode']) : 0;
			$allow_smilies = ( isset($HTTP_POST_VARS['allow_smilies']) ) ? intval($HTTP_POST_VARS['allow_smilies']) : 0;
            $allow_html =  ( isset($HTTP_POST_VARS['allow_html']) ) ? intval($HTTP_POST_VARS['allow_html']) : 1;

			$manditory = (isset($HTTP_POST_VARS['manditory'])) ? intval($HTTP_POST_VARS['manditory']) : 0;

			if ( strlen($field_regexp) > 0 )
			{
				$check = create_function('$errno, $errstr, $errfile, $errline', 'message_die("GENERAL_ERROR", $titanium_lang[\'Regexp_error\']."<br /><br />$errstr");');
				set_error_handler($check);
				$test = preg_match($field_regexp, 'this is a test to see whether the regexp will compile properly');
				restore_error_handler();
			}

			$sql = "SELECT MAX(field_id)+1 AS field_id, MAX(field_order)+1 AS field_order
			        FROM " . XDATA_FIELDS_TABLE;

			if ( !($result = $titanium_db->sql_query($sql)) )
			{
            			message_die(GENERAL_ERROR, $titanium_lang['XData_error_obtaining_new_field_info'], '', __LINE__, __FILE__, $sql);
			}

			$new_info = $titanium_db->sql_fetchrow($result);
			$field_id = $new_info['field_id'];
			$field_order = $new_info['field_order'];

			$code_name = ( $new_code_name == '' ) ? "xd_$field_id" : $new_code_name;

            		if ( isset($xd_meta[$new_code_name]) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XD_duplicate_name']);
			}

			$sql = "INSERT INTO " . XDATA_FIELDS_TABLE . "
				(field_id, field_name, field_desc, field_type, field_length, field_values, field_regexp, field_order, code_name, default_auth, display_register, display_viewprofile, display_posting, handle_input, allow_bbcode, allow_smilies, allow_html, manditory, viewtopic, signup)
				VALUES
				($field_id, '$field_name', '$field_desc', '$field_type', $field_length, '$field_values', '$field_regexp', $field_order, '$code_name', $default_auth, $display_register, $display_viewprofile, $display_posting, $handle_input, $allow_bbcode, $allow_smilies, $allow_html, $manditory, $viewtopic, $signup)";

			if ( ! $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_failure_inserting_data'], '', __LINE__, __FILE__, $sql);
			}

           		 $message = $titanium_lang['Add_success'] . "<br /><br />" . sprintf($titanium_lang['Click_return_fields'], "<a href=\"" . append_titanium_sid("admin_xdata_fields.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);
		}

		break;

	case 'delete':

		if ( ! isset($HTTP_POST_VARS['yes']) && ! isset($HTTP_POST_VARS['no']) )
		{

	        /*
	        Show the confirm message
	        */

			if( isset($HTTP_POST_VARS['name']) || isset($HTTP_GET_VARS['name']) )
			{
				$code_name = ( isset($HTTP_POST_VARS['name']) ) ? $HTTP_POST_VARS['name'] : $HTTP_GET_VARS['name'];
			}
			else
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_no_field_selected'] );
			}

            if ( ! isset($xd_meta[$code_name]) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_field_non_existant']);
			}

			$phpbb2_template->set_filenames( array( 'body' => 'admin/xd_confirm_delete.tpl' ) );

			$phpbb2_template->assign_vars( array(
				'S_HIDDEN_VARS' => '<input type="hidden" name="name" value="' . $code_name . '" /><input type="hidden" name="mode" value="delete" />',
				'U_FORM_ACTION' => append_titanium_sid("admin_xdata_fields.$phpEx?name=$name")
				)
			);

			$phpbb2_template->assign_vars( array(
				'L_CONFIRM' => $titanium_lang['Confirm'],
				'L_ARE_YOU_SURE' => sprintf($titanium_lang['Are_you_sure'], $xd_meta[$name]['field_name']),
				'L_YES' => $titanium_lang['Yes'],
				'L_NO' => $titanium_lang['No']
				)
			);

			$phpbb2_template->pparse('body');
		}
		elseif ( isset($HTTP_POST_VARS['yes'] ) )
		{
			//
			// Already confirmed, so do the delete
			//

			if( isset($HTTP_POST_VARS['name']) || isset($HTTP_GET_VARS['name']) )
			{
				$code_name = ( isset($HTTP_POST_VARS['name']) ) ? htmlspecialchars($HTTP_POST_VARS['name']) : htmlspecialchars($HTTP_GET_VARS['name']);
			}
			else
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_no_field_selected']);
			}

            		if ( ! isset($xd_meta[$code_name]) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_field_non_existant']);
			}

			$sql = "DELETE FROM " . XDATA_DATA_TABLE . "
				WHERE field_id = " . $xd_meta[$code_name]['field_id'];

			if ( ! $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_failure_removing_data'], "", __LINE__, __FILE__, $sql);
			}

          		  $sql = "DELETE FROM " . XDATA_AUTH_TABLE . "
				WHERE field_id = " . $xd_meta[$code_name]['field_id'];

			if ( ! $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_failure_removing_data'], "", __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . XDATA_FIELDS_TABLE . "
				WHERE code_name = '" . $code_name . "'";

			if ( ! $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $titanium_lang['XData_failure_removing_data'], "", __LINE__, __FILE__, $sql);
			}

			$message = $titanium_lang['Delete_success'] . "<br /><br />" . sprintf($titanium_lang['Click_return_fields'], "<a href=\"" . append_titanium_sid("admin_xdata_fields.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);

		}
		else
		{
			$mode = 'view';
		}

		break;
}

if ($mode == 'view')
{


	$phpbb2_template->set_filenames( array('body' => 'admin/xd_view_body.tpl') );

	if (count($xd_meta) == 0)
	{
		$phpbb2_template->assign_block_vars('switch_no_fields', array());
	}
	else
	{
		while ( list($code_name, $meta) = each($xd_meta) )
		{
        	$phpbb2_template->assign_block_vars('xd_field', array(
				'FIELD_NAME' => $meta['field_name'],
				'FIELD_TYPE' => $meta['field_type'],
				'U_MOVE_UP' => append_titanium_sid('admin_xdata_fields.'.$phpEx.'?mode=up&name='.$code_name),
				'U_MOVE_DOWN' => append_titanium_sid('admin_xdata_fields.'.$phpEx.'?mode=down&name='.$code_name),
				'U_EDIT' => append_titanium_sid('admin_xdata_fields.'.$phpEx.'?mode=edit&name='.$code_name),
				'U_DELETE' => append_titanium_sid('admin_xdata_fields.'.$phpEx.'?mode=delete&name='.$code_name),
        		)
        	);

        	if ($meta['field_type'] != 'special')
			{
				$phpbb2_template->assign_block_vars('xd_field.normal', array());
			}
  		}
	}

	$phpbb2_template->assign_vars(array(
		'L_XDATA_ADMIN' => $titanium_lang['Profile_admin'],
		'L_FORM_DESCRIPTION' => $titanium_lang['Xdata_view_description'],
		'L_FIELD_NAME' => $titanium_lang['Name'],
		'L_FIELD_TYPE' => $titanium_lang['type'],
		'L_MOVE' => $titanium_lang['xd_move'],
		'L_OPERATIONS' => $titanium_lang['xd_operations'],
		'L_MOVE_UP' => $titanium_lang['xd_move_up'],
		'L_MOVE_DOWN' => $titanium_lang['xd_move_down'],
		'L_EDIT' => $titanium_lang['Edit_field'],
		'L_DELETE' => $titanium_lang['Delete_field'],
		'L_NO_FIELDS' => $titanium_lang['No_fields'],
		'L_ADD_FIELD' => $titanium_lang['Add_field'],

		'U_ADD_FIELD' => append_titanium_sid("admin_xdata_fields.$phpEx?mode=add")
		)
	);

	$phpbb2_template->pparse('body');
}

include('./page_footer_admin.'.$phpEx);

?>