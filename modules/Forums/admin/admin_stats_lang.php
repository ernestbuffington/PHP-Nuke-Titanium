<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                           admin_stats_lang.php
*                            -------------------
*   begin                : Sat, Jan 04, 2003
*   copyright            : (C) 2003 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: admin_stats_lang.php,v 1.8 2003/03/16 18:38:29 acydburn Exp $
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

//
// Let's set the root dir for phpBB
//
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
if (!empty($phpbb2_board_config))
{
    @include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
}

if( !empty($setmodules) )
{
    $filename = basename(__FILE__);
    $titanium_module['Statistics']['Stats_langcp'] = $filename . '?mode=select';
    return;
}
require('pagestart.' . $phpEx);

if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
    $mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
    $mode = '';
}

if( isset($HTTP_POST_VARS['m_mode']) || isset($HTTP_GET_VARS['m_mode']) )
{
    $m_mode = ( isset($HTTP_POST_VARS['m_mode']) ) ? $HTTP_POST_VARS['m_mode'] : $HTTP_GET_VARS['m_mode'];
}
else
{
    $m_mode = '';
}

$titanium_lang_decollapse = (isset($HTTP_GET_VARS['d_lang'])) ? trim($HTTP_GET_VARS['d_lang']) : '';
$submit = (isset($HTTP_POST_VARS['submit'])) ? TRUE : FALSE;
@include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
@include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_statistics.' . $phpEx);
include($phpbb2_root_path . 'stats_mod/includes/constants.'.$phpEx);

$sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
     
if ( !($result = $titanium_db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

$stats_config = array();

while ($row = $titanium_db->sql_fetchrow($result))
{
    $stats_config[$row['config_name']] = trim($row['config_value']);
}

include($phpbb2_root_path . 'stats_mod/includes/lang_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/stat_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/admin_functions.'.$phpEx);

$update_list = ( isset($HTTP_POST_VARS['update']) ) ? $HTTP_POST_VARS['update'] : array();
$delete_list = ( isset($HTTP_POST_VARS['delete']) ) ? $HTTP_POST_VARS['delete'] : array();
$titanium_lang_entry = ( isset($HTTP_POST_VARS['lang_entry']) ) ? $HTTP_POST_VARS['lang_entry'] : array();
$update_all_lang = ( isset($HTTP_POST_VARS['update_all_lang']) ) ? TRUE : FALSE;
$add_new_key = ( isset($HTTP_POST_VARS['add_new_key']) ) ? $HTTP_POST_VARS['add_new_key'] : array();
$add_key = ( isset($HTTP_POST_VARS['add_key']) ) ? trim(htmlspecialchars($HTTP_POST_VARS['add_key'])) : '';
$add_value = ( isset($HTTP_POST_VARS['add_value']) ) ? trim($HTTP_POST_VARS['add_value']) : '';

$new_lang_submit = ( isset($HTTP_POST_VARS['new_lang_submit']) ) ? TRUE : FALSE;
$new_language = ( isset($HTTP_POST_VARS['new_language']) ) ? trim($HTTP_POST_VARS['new_language']) : '';

$delete_complete_lang = ( isset($HTTP_POST_VARS['delete_complete_lang']) ) ? $HTTP_POST_VARS['delete_complete_lang'] : array();

if (($new_lang_submit) && ($new_language != ''))
{
    if (!strstr($new_language, 'lang_'))
    {
        message_die(GENERAL_MESSAGE, 'Please specify a valid Language to be created');
    }

    $installed_languages = get_all_installed_languages();

    if (count($installed_languages) > 0)
    {
        if (in_array($new_language, $installed_languages))
        {
            message_die(GENERAL_MESSAGE, 'The Language ' . $new_language . ' already exist.');
        }

        if (in_array('lang_english', $installed_languages))
        {
            $preset = 'lang_english';
        }
        else
        {
            $preset = $installed_languages[0];
        }
    }
    else
    {
        $preset = '';
    }

    if ($preset != '')
    {
        add_new_language($new_language, $preset);
    }
    else
    {
        add_empty_language($new_language);
    }
    
    $mode = 'select';
    $m_mode = 'edit';
    $HTTP_GET_VARS['lang'] = $new_language;
}
else if (count($delete_complete_lang) > 0)
{
    @reset($delete_complete_lang);
    list($titanium_language, $value) = each($delete_complete_lang);

    $titanium_language = trim($titanium_language);

    delete_complete_language($titanium_language);
    $m_mode = '';
}

if (count($update_list) > 0)
{
    @reset($update_list);
    list($titanium_language, $v_array) = each($update_list);
    list($titanium_module_id, $v2_array) = each($v_array);
    list($key, $value) = each($v2_array);

    set_lang_entry($titanium_language, $titanium_module_id, $key, $titanium_lang_entry[$titanium_language][$titanium_module_id][$key]);
}
else if ($update_all_lang)
{
    @reset($titanium_lang_entry);

    // Begin Language
    while (list($titanium_language, $v_array) = each($titanium_lang_entry))
    {
        // Begin Modules
        while (list($titanium_module_id, $v2_array) = each($v_array))
        {
            $titanium_lang_block = '';
            // Begin Language Entries
            while (list($key, $value) = each($v2_array))
            {
                $titanium_lang_block .= '$titanium_lang[\'' . trim($key) . '\'] = \'' . trim($value) . '\';';
                $titanium_lang_block .= "\n";
            }
            set_lang_block($titanium_language, $titanium_module_id, $titanium_lang_block);
        }
    }
}
else if (($add_key != '') && (count($add_new_key) > 0))
{
    @reset($add_new_key);
    list($titanium_language, $v_array) = each($add_new_key);
    list($titanium_module_id, $value) = each($v_array);
    
    lang_add_new_key($titanium_language, $titanium_module_id, $add_key, $add_value);
}
else if (count($delete_list) > 0)
{
    @reset($delete_list);
    list($titanium_language, $v_array) = each($delete_list);
    list($titanium_module_id, $v2_array) = each($v_array);
    list($key, $value) = each($v2_array);

    delete_lang_key($titanium_language, $titanium_module_id, $key);
}

if ($mode == 'select')
{
    $phpbb2_template->set_filenames(array(
        'body' => 'admin/stat_admin_lang.tpl',
        'lang_body' => 'admin/stat_edit_lang.tpl')
    );

    $phpbb2_template->assign_vars(array(
        'L_EDIT' => $titanium_lang['Edit'],
        'L_UPDATE' => $titanium_lang['Update'],
        'L_DELETE' => $titanium_lang['Delete'],
        'L_EXPORT_MODULE' => $titanium_lang['Export_lang_module'],
        'L_COMPLETE_LANG_EXPORT' => $titanium_lang['Export_language'],
        'L_COMPLETE_EXPORT' => $titanium_lang['Export_everything'],
        'L_LANG_CP_TITLE' => $titanium_lang['Language_cp_title'],
        'L_LANG_CP_EXPLAIN' => $titanium_lang['Language_cp_explain'],
        'L_LANGUAGE_KEY' => $titanium_lang['Language_key'],
        'L_LANGUAGE_VALUE' => $titanium_lang['Language_value'],
        'L_UPDATE_ALL' => $titanium_lang['Update_all_lang'],
        'L_ADD_NEW_KEY' => $titanium_lang['Add_new_key'],
        'L_CREATE_NEW_LANG' => $titanium_lang['Create_new_lang'],
        'L_DELETE_LANG' => $titanium_lang['Delete_language'],
        'L_IMPORT_NEW_LANGUAGE' => $titanium_lang['Import_new_language'],

        'U_NEW_LANG_IMPORT' => $phpbb2_root_path . 'admin/import_lang.php?mode=import_new_lang',
        'U_LANG_COMPLETE_EXPORT' => $phpbb2_root_path . 'admin/download_lang.php?mode=export_everything')
    );
    
    // Collect available Languages
    $provided_languages = get_all_installed_languages();

    $sql = "SELECT m.*, i.* FROM " . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i WHERE i.module_id = m.module_id";

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }

    $titanium_modules = $titanium_db->sql_fetchrowset($result);

    for ($i = 0; $i < count($provided_languages); $i++)
    {
        if ($titanium_lang_decollapse == $provided_languages[$i])
        {
            $col_decol = '-';
            $link_col_decol = $phpbb2_root_path . 'admin/admin_stats_lang.php?mode=select';
        }
        else
        {
            $col_decol = '+';
            $link_col_decol = $phpbb2_root_path . 'admin/admin_stats_lang.php?mode=select&amp;d_lang=' . $provided_languages[$i];
        }

        $phpbb2_template->assign_block_vars('langrow', array(
            'LANGUAGE' => $provided_languages[$i],
            'L_COLLAPSE_DECOLLAPSE' => $col_decol,
            'U_COLLAPSE_DECOLLAPSE' => $link_col_decol,
            'U_LANG_COMPLETE_EDIT' => $phpbb2_root_path . 'admin/admin_stats_lang.php?mode=select&amp;m_mode=edit&amp;lang=' . $provided_languages[$i] . '&amp;d_lang=' . $titanium_lang_decollapse,
            'U_LANG_COMPLETE_EXPORT' => $phpbb2_root_path . 'admin/download_lang.php?mode=export_lang&amp;lang=' . $provided_languages[$i])
        );

        if ($titanium_lang_decollapse == $provided_languages[$i])
        {
            for ($j = 0; $j < count($titanium_modules); $j++)
            {
                $informations = ( intval($titanium_modules[$j]['active']) == 1) ? 'Active' : 'Not Active';

                if (!module_is_in_lang($titanium_modules[$j]['short_name'], $provided_languages[$i]))
                {
                    $informations .= '<br />No Content';
                }
            
                $phpbb2_template->assign_block_vars('langrow.modulerow', array(
                    'MODULE_NAME' => $titanium_modules[$j]['long_name'],
                    'MODULE_DESC' => $titanium_modules[$j]['extra_info'],
                    'U_LANG_EDIT' => $phpbb2_root_path . 'admin/admin_stats_lang.php?mode=select&amp;m_mode=edit&amp;lang=' . $provided_languages[$i] . '&amp;module=' . $titanium_modules[$j]['module_id'] . '&amp;d_lang=' . $titanium_lang_decollapse,
                    'U_LANG_EXPORT' => $phpbb2_root_path . 'admin/download_lang.php?mode=export_module&amp;lang=' . $provided_languages[$i] . '&amp;module=' . $titanium_modules[$j]['module_id'],
                    'INFORMATIONS' => $informations)
                );
            }
        }
    }
    if ($m_mode == 'edit')
    {
        $titanium_module_id = (isset($HTTP_GET_VARS['module'])) ? intval($HTTP_GET_VARS['module']) : -1;
        $titanium_language = (isset($HTTP_GET_VARS['lang'])) ? trim($HTTP_GET_VARS['lang']) : '';
        
        if ($titanium_language == '')
        {
            message_die(GENERAL_MESSAGE, 'Invalid Call, Hacking Attempt ?');
        }
        
        $current_modules = array();

        if ($titanium_module_id != -1)
        {
            for ($i = 0; $i < count($titanium_modules); $i++)
            {
                if (intval($titanium_modules[$i]['module_id']) == $titanium_module_id)
                {
                    $current_modules[0] = $titanium_modules[$i];
                    break;
                }
            }
        }
        else
        {
            $current_modules = $titanium_modules;
        }

        $phpbb2_template->assign_vars(array(
            'LANGUAGE' => $titanium_language)
        );

        for ($i = 0; $i < count($current_modules); $i++)
        {
            $phpbb2_template->assign_block_vars('modules', array(
                'MODULE_NAME' => $current_modules[$i]['long_name'],
                'MODULE_ID' => $current_modules[$i]['module_id'])
            );

            $titanium_lang_entries = get_lang_entries($current_modules[$i]['short_name'], $titanium_language);
        
            for ($j = 0; $j < count($titanium_lang_entries); $j++)
            {
                $phpbb2_template->assign_block_vars('modules.language_entries', array(
                    'KEY' => $titanium_lang_entries[$j]['key'],
                    'MODULE_ID' => $current_modules[$i]['module_id'],
                    'VALUE' => $titanium_lang_entries[$j]['value'])
                );
            }
        }

        $phpbb2_template->assign_var_from_handle('EDIT_LANG_PANEL', 'lang_body');
    }
}

$phpbb2_template->pparse('body');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>