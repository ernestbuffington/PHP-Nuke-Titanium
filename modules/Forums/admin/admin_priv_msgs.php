<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                      $RCSfile: admin_priv_msgs.php,v $
*                            -------------------
*   begin                : Tue January 20 2002
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: admin_priv_msgs.php,v 1.3 2005/08/02 23:54:41 Nivisec Exp $
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

$aprvmUtil = new aprvmUtils();
$aprvmUtil->modVersion = '1.6.0';
$aprvmUtil->copyrightYear = '2001, 2005';

/****************************************************************************
/** Module Setup
/***************************************************************************/
define('PRIVMSGS_ALL_MAIL', -1);
$phpbb2_root_path = '../';
include($phpbb2_root_path . 'extension.inc');
include_once("pagestart.$phpEx");
include_once('./../../../includes/bbcode.' . $phpEx);
$aprvmUtil->find_lang_file('lang_admin_priv_msgs');
if (!empty($setmodules))
{
    $filename = basename(__FILE__);
    $titanium_module['Users']['Private_Messages'] = $filename;
    return;
}

/****************************************************************************
/** Module Actual Start
/***************************************************************************/
/*******************************************************************************************
/** Get parameters.  'var_name' => 'default_value'
/** This is outdated insecure, but I don't feel like rewriting the whole thing to be even more
/**    class structured.  Maybe some day when phpBB moves to php5 I will.
/******************************************************************************************/
//Normal sections.
$params = array('mode' => '', 'order' => 'DESC',
'sort' => 'privmsgs_date', 'pmaction' => 'none',
'filter_from' => '', 'filter_to' => '', 'filter_from_text' => '', 'filter_to_text' => '');
foreach($params as $var => $default)
{
    $$var = $default;
    if(isset($HTTP_POST_VARS[$var]) || isset($HTTP_GET_VARS[$var]))
    {
        $$var = (isset($HTTP_POST_VARS[$var])) ? $HTTP_POST_VARS[$var] : $HTTP_GET_VARS[$var];
    }
}

//Sections requiring intval assignments
$params = array('view_id' => '', 'start' => 0, 'pmtype' => PRIVMSGS_ALL_MAIL);
foreach($params as $var => $default)
{
    $$var = $default;
    if(isset($HTTP_POST_VARS[$var]) || isset($HTTP_GET_VARS[$var]))
    {
        $$var = intval((isset($HTTP_POST_VARS[$var])) ? $HTTP_POST_VARS[$var] : $HTTP_GET_VARS[$var]);
    }
}
/****************************************************************************
/** Main Vars.
/***************************************************************************/
$status_message = '';
$aprvmUtil->init();

$phpbb2_topics_per_pg = max(1, $phpbb2_board_config['aprvmRows']); //Just in case someone manually changes it to be some crazy number, we'll show 1 row always
$phpbb2_page_title = $titanium_lang['Private_Messages'];
$order_types = array('DESC', 'ASC');
$sort_types = array('privmsgs_date', 'privmsgs_subject', 'privmsgs_from_userid', 'privmsgs_to_userid', 'privmsgs_type');
$pmtypes = array(PRIVMSGS_ALL_MAIL, PRIVMSGS_READ_MAIL, PRIVMSGS_NEW_MAIL, PRIVMSGS_SENT_MAIL, PRIVMSGS_SAVED_IN_MAIL, PRIVMSGS_SAVED_OUT_MAIL, PRIVMSGS_UNREAD_MAIL);
/*
// Private messaging defintions from constants.php for reference
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);
*/

/*******************************************************************************************
/** Setup some options
/******************************************************************************************/
$archive_text = ($phpbb2_board_config['aprvmArchive'] && $mode == 'archive') ? '_archive' : '';
$pmtype_text = ($pmtype != PRIVMSGS_ALL_MAIL) ? "AND pm.privmsgs_type = $pmtype" : '';
// Assign text filters if specified
if ($filter_from != '')
{
    $filter_from_user = $aprvmUtil->id_2_name($filter_from, 'reverse');
    $filter_from_text = (!empty($filter_from_user)) ? "AND pm.privmsgs_from_userid = $filter_from_user" : '';
}
if ($filter_to != '')
{
    $filter_to_user = $aprvmUtil->id_2_name($filter_to, 'reverse');
    $filter_to_text = (!empty($filter_to_user)) ? "AND pm.privmsgs_to_userid = $filter_to_user" : '';
}

if (count($HTTP_POST_VARS))
{
    $aprvmMan = new aprvmManager();
    foreach($HTTP_POST_VARS as $key => $val)
    {
        /*******************************************************************************************
        /** Check for archive items
        /******************************************************************************************/
        if ($phpbb2_board_config['aprvmArchive'] && substr_count($key, 'archive_id_'))
        {
            $aprvmMan->addArchiveItem(substr($key, 11));
        }
        /*******************************************************************************************
        /** Check for deletion items
        /******************************************************************************************/
        elseif (substr_count($key, 'delete_id_'))
        {
            $aprvmMan->addDeleteItem(substr($key, 10));
        }
    }
    $aprvmMan->go();
}
/*******************************************************************************************
/** Switch our Mode to the right one
/******************************************************************************************/
switch($pmaction)
{
    case 'view_message':
    {
        if ($view_id == '')
        {
            message_die(GENERAL_ERROR, $titanium_lang['No_Message_ID'], '', __LINE__, __FILE__);
        }
        $sql = 'SELECT pm.*, pmt.*
           FROM ' . PRIVMSGS_TABLE . "$archive_text pm, " . PRIVMSGS_TEXT_TABLE . " pmt
           WHERE pm.privmsgs_id = pmt.privmsgs_text_id
           AND pmt.privmsgs_text_id = $view_id";
        if(!$result = $titanium_db->sql_query($sql))
        {
            message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__);
        }
        $privmsg = $titanium_db->sql_fetchrow($result);
        /************************/
        /* Just stole all the phpBB code for message processing :) And edited a ton of it out since we are all admins here */
        /**********************/
        $private_message = $privmsg['privmsgs_text'];
        $bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
        if ( $bbcode_uid != '' )
        {
            $private_message = bbencode_second_pass($private_message, $bbcode_uid);
        }
        $private_message = make_clickable($private_message);
        if ( $privmsg['privmsgs_enable_smilies'] )
        {
            $old_config = $phpbb2_board_config['smilies_path'];
            $phpbb2_board_config['smilies_path'] = '../../../' . $phpbb2_board_config['smilies_path'];
            $private_message = smilies_pass($private_message);
            $phpbb2_board_config['smilies_path'] = $old_config;
        }
        $private_message = str_replace("\n", '<br />', $private_message);
        
        $phpbb2_template->set_filenames(array(
        'viewmsg_body' => 'admin/admin_priv_msgs_view_body.tpl')
        );
        $phpbb2_template->assign_vars(array(
        'L_SUBJECT' => $titanium_lang['Subject'],
        'L_TO' => $titanium_lang['To'],
        'L_FROM' => $titanium_lang['From'],
        'L_SENT_DATE' => $titanium_lang['Sent_Date'],
        'L_PRIVATE_MESSAGES' => $aprvmUtil->modName)
        );
        $phpbb2_template->assign_vars(array(
        'SUBJECT' => $privmsg['privmsgs_subject'],
        'FROM' => $aprvmUtil->id_2_name($privmsg['privmsgs_from_userid']),
        'FROM_IP' => ($phpbb2_board_config['aprvmIP']) ? ' : ('.decode_ip($privmsg['privmsgs_ip']).')' : '',
        'TO' => $aprvmUtil->id_2_name($privmsg['privmsgs_to_userid']),
        'DATE' => create_date($titanium_lang['DATE_FORMAT'], $privmsg['privmsgs_date'], $phpbb2_board_config['board_timezone']),
        'MESSAGE' => $private_message)
        );
        
        if ($phpbb2_board_config['aprvmView'])
        {
            $phpbb2_template->assign_block_vars('popup_switch', array());
            $phpbb2_template->pparse('viewmsg_body');
            $aprvmUtil->copyright();
            break;
        }
        else
        {
            $phpbb2_template->assign_var_from_handle('PM_MESSAGE', 'viewmsg_body');
        }
    }
    case 'remove_old':
    {
        if ($pmaction == 'remove_old')
        {
            // Build user sql list
            $titanium_user_id_sql_list = '';
            $sql = 'SELECT user_id FROM '. USERS_TABLE .'
               WHERE user_id <> '. ANONYMOUS;
            if(!$result = $titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Other_Table'], '', __LINE__, __FILE__);
            }
            while($row = $titanium_db->sql_fetchrow($result))
            {
                $titanium_user_id_sql_list .= ($titanium_user_id_sql_list != '') ? ', '.$row['user_id'] : $row['user_id'];
            }
            
            // Get orphan PM ids
            $priv_msgs_id_sql_list = '';
            $sql = 'SELECT privmsgs_id FROM '. PRIVMSGS_TABLE ."$archive_text
                WHERE privmsgs_to_userid NOT IN ($titanium_user_id_sql_list)";
            //print $sql;
            if(!$result = $titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }
            while ($row = $titanium_db->sql_fetchrow($result))
            {
                $priv_msgs_id_sql_list .= ($priv_msgs_id_sql_list != '') ? ', '.$row['privmsgs_id'] : $row['privmsgs_id'];
            }
            if ($priv_msgs_id_sql_list != '')
            {
                $sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                      WHERE privmsgs_text_id IN ($priv_msgs_id_sql_list)";
                //print $sql;
                if(!$titanium_db->sql_query($sql))
                {
                    message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
                }
                
                $sql = "DELETE FROM " . PRIVMSGS_TABLE . "$archive_text
                      WHERE privmsgs_id  IN ($priv_msgs_id_sql_list)";
                //print $sql;
                if(!$titanium_db->sql_query($sql))
                {
                    message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
                }
            }
            
            $status_message .= $titanium_lang['Removed_Old'];
            $status_message .= (SQL_LAYER == 'db2' || SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli' || SQL_LAYER == 'mysql4') ? sprintf($titanium_lang['Affected_Rows'], $titanium_db->sql_affectedrows()) : '';
        }
    }
    case 'remove_sent':
    {
        if ($pmaction == 'remove_sent')
        {
            // Get sent PM ids
            $priv_msgs_id_sql_list = '';
            $sql = 'SELECT privmsgs_id FROM '. PRIVMSGS_TABLE ."$archive_text
                WHERE privmsgs_type = ". PRIVMSGS_SENT_MAIL;
            if(!$result = $titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }
            while ($row = $titanium_db->sql_fetchrow($result))
            {
                $priv_msgs_id_sql_list .= ($priv_msgs_id_sql_list != '') ? ', '.$row['privmsgs_id'] : $row['privmsgs_id'];
            }
            if ($priv_msgs_id_sql_list != '')
            {
                $sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                      WHERE privmsgs_text_id IN ($priv_msgs_id_sql_list)";
                //print $sql;
                if(!$titanium_db->sql_query($sql))
                {
                    message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
                }
                
                $sql = "DELETE FROM " . PRIVMSGS_TABLE . "$archive_text
                      WHERE privmsgs_id  IN ($priv_msgs_id_sql_list)";
                //print $sql;
                if(!$titanium_db->sql_query($sql))
                {
                    message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
                }
            }
            
            $status_message .= $titanium_lang['Removed_Sent'];
            $status_message .= (SQL_LAYER == 'db2' || SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli' || SQL_LAYER == 'mysql4') ? sprintf($titanium_lang['Affected_Rows'], $titanium_db->sql_affectedrows()) : '';
        }
    }
    case 'remove_all':
    {
        if ($pmaction == 'remove_all')
        {
            $sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE;
            if(!$titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }
            
            $sql = "DELETE FROM " . PRIVMSGS_TABLE;
            if(!$titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }
            
            $status_message .= $titanium_lang['Removed_All'];
            $status_message .= (SQL_LAYER == 'db2' || SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli' || SQL_LAYER == 'mysql4') ? sprintf($titanium_lang['Affected_Rows'], $titanium_db->sql_affectedrows()) : '';
        }
    }
    default:
    {
        $sql = 'SELECT pm.*, pmt.* FROM ' . PRIVMSGS_TABLE . "$archive_text pm, " . PRIVMSGS_TEXT_TABLE . " pmt
               WHERE pm.privmsgs_id = pmt.privmsgs_text_id
               $pmtype_text
               $filter_from_text
               $filter_to_text
               ORDER BY $sort $order
               LIMIT $phpbb2_start, $phpbb2_topics_per_pg";
        
        if(!$result = $titanium_db->sql_query($sql))
        {
            message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Archive_Table'], '', __LINE__, __FILE__);
        }
        
        $i = 0;
        while($row = $titanium_db->sql_fetchrow($result))
        {
            $view_url = (!$phpbb2_board_config['aprvmView']) ? append_titanium_sid($aprvmUtil->urlStart.'&pmaction=view_message&view_id='.$row['privmsgs_id']) : '#';
            $onclick_url = ($phpbb2_board_config['aprvmView']) ? "JavaScript:window.open('" . append_titanium_sid($aprvmUtil->urlStart.'&pmaction=view_message&view_id=' . $row['privmsgs_id']) . "', '_privmsg', 'HEIGHT=450,resizable=yes,WIDTH=550')" : '';
            $phpbb2_template->assign_block_vars('msgrow', array(
            'ROW_CLASS' => (!(++$i% 2)) ? $theme['td_class1'] : $theme['td_class2'],
            'ATTACHMENT_INFO' => (defined('ATTACH_VERSION')) ? 'Not Here Yet' : '',
            'PM_ID' => $row['privmsgs_id'],
            'PM_TYPE' => $titanium_lang['PM_' . $row['privmsgs_type']],
            'SUBJECT' => $row['privmsgs_subject'],
            'FROM' => UsernameColor($aprvmUtil->id_2_name($row['privmsgs_from_userid'])),
            'TO' => UsernameColor($aprvmUtil->id_2_name($row['privmsgs_to_userid'])),
            'FROM_IP' => ($phpbb2_board_config['aprvmIP']) ? '<br />('.decode_ip($row['privmsgs_ip']).')' : '',
            'U_VIEWMSG' => $onclick_url,
            'U_INLINE_VIEWMSG' => $view_url,
            'DATE' => create_date($titanium_lang['DATE_FORMAT'], $row['privmsgs_date'], $phpbb2_board_config['board_timezone']))
            );
            if ($mode != 'archive' && $phpbb2_board_config['aprvmArchive'])
            {
                $phpbb2_template->assign_block_vars('msgrow.archive_avail_switch_msg', array());
            }
        }
        
        if ($i == 0)
        {
            $phpbb2_template->assign_block_vars('empty_switch', array());
            $phpbb2_template->assign_var('L_NO_PMS', $titanium_lang['No_PMS']);
        }
        
        $aprvmUtil->do_pagination();
        
        if ($mode != 'archive' && $phpbb2_board_config['aprvmArchive'])
        {
            $phpbb2_template->assign_block_vars('archive_avail_switch', array());
        }
        else {
            /* Send the comment area to the archive only parts to prevent JS errors */
            $phpbb2_template->assign_vars(array(
            'JS_ARCHIVE_COMMENT_1' => '/* ',
            'JS_ARCHIVE_COMMENT_2' => ' */'));
        }
        
        $phpbb2_template->set_filenames(array(
        'body' => 'admin/admin_priv_msgs_body.tpl')
        );
        
        $phpbb2_template->assign_vars(array(
        "L_SELECT_SORT_METHOD" => $titanium_lang['Select_sort_method'],
        "L_SUBJECT" => $titanium_lang['Subject'],
        "L_TO" => $titanium_lang['To'],
        "L_FROM" => $titanium_lang['From'],
        "L_SENT_DATE" => $titanium_lang['Sent_Date'],
        'L_PAGE_NAME' => $aprvmUtil->modName,
        "L_ORDER" => $titanium_lang['Order'],
        "L_SORT" => $titanium_lang['Sort'],
        "L_SUBMIT" => $titanium_lang['Submit'],
        "L_DELETE" => $titanium_lang['Delete'],
        'L_PM_TYPE' => $titanium_lang['PM_Type'],
        'L_FILTER_BY' => $titanium_lang['Filter_By'],
        'L_RESET' => $titanium_lang['Reset'],
        'L_ARCHIVE' => $titanium_lang['Archive'],
        'L_PAGE_DESC' => ($mode == 'archive') ? $titanium_lang['Archive_Desc'] : $titanium_lang['Normal_Desc'],
        'L_VERSION' => $titanium_lang['Version'],
        'VERSION' => $aprvmUtil->modVersion,
        'L_CURRENT' => $titanium_lang['Current'],
        'CURRENT_ROWS' => $phpbb2_board_config['aprvmRows'],
        'L_REMOVE_OLD' => $titanium_lang['Remove_Old'],
        'L_REMOVE_SENT' => $titanium_lang['Remove_Sent'],
        'L_REMOVE_ALL' => $titanium_lang['Remove_All'],
        'L_UTILS' => $titanium_lang['Utilities'],
        'L_PM_VIEW_TYPE' =>$titanium_lang['PM_View_Type'],
        'L_SHOW_IP' =>$titanium_lang['Show_IP'],
        'L_ROWS_PER_PAGE' =>$titanium_lang['Rows_Per_Page'],
        'L_ARCHIVE_FEATURE' =>$titanium_lang['Archive_Feature'],
        'L_OPTIONS' => $titanium_lang['Options'],
        
        'URL_ORPHAN' => append_titanium_sid($aprvmUtil->urlStart . '&pmaction=remove_old'),
        'URL_SENT' => append_titanium_sid($aprvmUtil->urlStart . '&pmaction=remove_sent'),
        'URL_ALL' => append_titanium_sid($aprvmUtil->urlStart . '&pmaction=remove_all'),
        'URL_INLINE_MESSAGE_TYPE' => ($phpbb2_board_config['aprvmView'] == 1) ? '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmView&config_value=0') . "\">{$titanium_lang['Inline']}</a>" : $titanium_lang['Inline'],
        'URL_POPUP_MESSAGE_TYPE' => ($phpbb2_board_config['aprvmView'] == 0) ? '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmView&config_value=1') . "\">{$titanium_lang['Pop_up']}</a>" : $titanium_lang['Pop_up'],
        'URL_ROWS_PLUS_5' => '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmRows&config_value='.strval($phpbb2_board_config['aprvmRows']+5)) . "\">{$titanium_lang['Rows_Plus_5']}</a>",
        'URL_ROWS_MINUS_5' => ($phpbb2_board_config['aprvmRows'] > 5) ? '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmRows&config_value='.strval($phpbb2_board_config['aprvmRows']-5)) . "\">{$titanium_lang['Rows_Minus_5']}</a>" : $titanium_lang['Rows_Minus_5'],
        'URL_SHOW_IP_ON' => ($phpbb2_board_config['aprvmIP'] == 0) ? '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmIP&config_value=1') . "\">{$titanium_lang['Enable']}</a>" : $titanium_lang['Enable'],
        'URL_SHOW_IP_OFF' => ($phpbb2_board_config['aprvmIP'] == 1) ? '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmIP&config_value=0') . "\">{$titanium_lang['Disable']}</a>" : $titanium_lang['Disable'],
        'URL_ARCHIVE_ENABLE_LINK' => ($phpbb2_board_config['aprvmArchive'] == 0) ? '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmArchive&config_value=1') . "\">{$titanium_lang['Enable']}</a>" : $titanium_lang['Enable'],
        'URL_ARCHIVE_DISABLE_LINK' => ($phpbb2_board_config['aprvmArchive'] == 1) ? '<a href="' . append_titanium_sid($aprvmUtil->urlStart . '&config_name=aprvmArchive&config_value=0') . "\">{$titanium_lang['Disable']}</a>" : $titanium_lang['Disable'],
        'URL_SWITCH_MODE' => ($phpbb2_board_config['aprvmArchive'] == 1) ? ($mode == 'archive') ? '<strong><a class="gen" href="' . append_titanium_sid($aprvmUtil->urlBase . '&mode=normal') . "\">{$titanium_lang['Switch_Normal']}</a></strong>" :'<strong><a class="gen" href="' . append_titanium_sid($aprvmUtil->urlBase . '&mode=archive') . "\">{$titanium_lang['Switch_Archive']}</a></strong>" : '',
        
        'S_MODE' => $mode,
        'S_PMTYPE' => $pmtype,
        'S_FILTER_FROM' => $filter_from,
        'S_FILTER_TO' => $filter_to,
        'S_PMTYPE_SELECT' => $aprvmUtil->make_drop_box('pmtype'),
        'S_MODE_SELECT' => $aprvmUtil->make_drop_box('sort'),
        'S_ORDER_SELECT' => $aprvmUtil->make_drop_box('order'),
        'S_FILENAME' => basename(__FILE__),
        'S_MODE_ACTION' => append_titanium_sid(basename(__FILE__)))
        );
        
        
        if ($status_message != '')
        {
            $phpbb2_template->assign_block_vars('statusrow', array());
            $phpbb2_template->assign_vars(array(
            'L_STATUS' => $titanium_lang['Status'],
            'I_STATUS_MESSAGE' => $status_message)
            );
        }

        $phpbb2_template->pparse('body');
        $aprvmUtil->copyright($phpbb2_page_title, '2001-2003');
        include('page_footer_admin.'.$phpEx);
        break;
    }
}

class aprvmUtils
{
    var $modVersion;
    var $modName;
    var $copyrightYear;
    var $archiveText;
    var $inArchiveText;
    var $urlPage;
    var $urlStart;
    
    function __construct()
    {
        $this->archiveText = '_archive';
    }

    function aprvmUtils()
    {
        self::__construct();
    }
    
    function init()
    {
        global $titanium_lang, $mode, $phpbb2_board_config;
        
        $this->modName = ($phpbb2_board_config['aprvmArchive'] && $mode == 'archive') ? $titanium_lang['Private_Messages_Archive'] : $titanium_lang['Private_Messages'];
        $this->setupConfig();
        $this->makeURLStart();
        $this->inArchiveText = ($mode == 'archive') ? '_archive' : '';
    }
    
    function makeURLStart()
    {
        global $filter_from, $filter_to, $order;
        global $mode, $pmtype, $sort, $pmtype_text, $phpbb2_start, $phpEx;
        
        $this->urlBase = basename(__FILE__). "?order=$order&amp;sort=$sort&amp;pmtype=$pmtype&filter_from=$filter_from&filter_to=$filter_to";
        $this->urlPage = $this->urlBase. "&mode=$mode";
        $this->urlStart = $this->urlPage . '&start='.$phpbb2_start;
    }
    
    
    function setupConfig()
    {
        global $phpbb2_board_config, $titanium_db, $HTTP_GET_VARS, $status_message, $titanium_lang, $cache;

        $configList = array('aprvmArchive', 'aprvmVersion', 'aprvmView', 'aprvmRows', 'aprvmIP');
        $configLangs = array('aprvmArchive' => $titanium_lang['Archive_Feature'],
                            'aprvmVersion' => $titanium_lang['Version'],
                            'aprvmView' => $titanium_lang['PM_View_Type'],
                            'aprvmRows' => $titanium_lang['Rows_Per_Page'],
                            'aprvmIP' => $titanium_lang['Show_IP']);
        $configDefaults = array('0', $this->modVersion, '0', '25', '1');
                                //off, version, inline, 25, yes
        //Check for an update config command
        //Also do an array check to make sure our config is in our config list array to update
        if (isset($HTTP_GET_VARS['config_name']) && in_array($HTTP_GET_VARS['config_name'], $configList))
        {
            $sql = 'UPDATE '. CONFIG_TABLE . "
                    set config_value = '{$HTTP_GET_VARS['config_value']}'
                    WHERE config_name = '{$HTTP_GET_VARS['config_name']}'";
            $titanium_db->sql_query($sql);
            
            $phpbb2_board_config[$HTTP_GET_VARS['config_name']] = $HTTP_GET_VARS['config_value'];
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $cache->delete('board_config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $status_message .= sprintf($titanium_lang['Updated_Config'], $configLangs[$HTTP_GET_VARS['config_name']]);
        }            
        
        //Loop through and see if a config name is set, if not set up a default
        foreach($configList as $num => $val)
        {
            if (!isset($phpbb2_board_config[$val]))
            {
                $sql = 'INSERT INTO '. CONFIG_TABLE . "
                    (config_name, config_value)
                    VALUES
                    ('$val', '{$configDefaults[$num]}')";
                $titanium_db->sql_query($sql);
                $phpbb2_board_config[$val] = $configDefaults[$num];
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $cache->delete('board_config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $status_message .= sprintf($titanium_lang['Inserted_Default_Value'], $configLangs[$HTTP_GET_VARS['config_name']]);
            }

        }
        
        //If archive is enabled, check to see if the archive table exists
        if ($phpbb2_board_config['aprvmArchive'])
        {
            $sql = 'SELECT privmsgs_id FROM ' . PRIVMSGS_TABLE .$this->archiveText;
            if(!$result = $titanium_db->sql_query($sql))
            {
                //Cheap way for checking if the archive table exists
                $errorMessage = $titanium_db->sql_error();
                if (strpos($errorMessage['message'], 'exist') !== false)
                {
                    $this->doArchiveTable();
                }
            }
        }

        //Check to see if board_config has the right version we are running
        if ($phpbb2_board_config['aprvmVersion'] != $this->modVersion)
        {
            $sql = 'UPDATE '. CONFIG_TABLE . "
                    set config_value = '{$this->modVersion}'
                    WHERE config_name = 'aprvmVersion'";
            $titanium_db->sql_query($sql);
            $phpbb2_board_config['aprvmVersion'] = $this->modVersion;
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $cache->delete('board_config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $status_message .= sprintf($titanium_lang['Updated_Config'], $configLangs['aprvmVersion']);
        }
    }

    function resync($type, $titanium_user_id, $num = 1)
    {
        global $titanium_db;

        if (($type == PRIVMSGS_NEW_MAIL || $type == PRIVMSGS_UNREAD_MAIL))
        {
            // Update appropriate counter
            switch ($type)
            {
                case PRIVMSGS_NEW_MAIL:
                $sql = "user_new_privmsg = user_new_privmsg - $num";
                break;
                case PRIVMSGS_UNREAD_MAIL:
                $sql = "user_unread_privmsg = user_unread_privmsg - $num";
                break;
            }

            $sql = "UPDATE " . USERS_TABLE . "
                SET $sql 
                WHERE user_id = $titanium_user_id";
            if ( !$titanium_db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }
        }
    }

    function make_drop_box($titanium_prefix = 'sort')
    {
        global $sort_types, $order_types, $pmtypes, $titanium_lang, $sort, $order, $pmtype, $phpbb2_page_title;

        $rval = '<select name="'.$titanium_prefix.'">';

        switch($titanium_prefix)
        {
            case 'sort':
            foreach($sort_types as $val)
            {
                $selected = ($sort == $val) ? 'selected="selected"' : '';
                $rval .= "<option value=\"$val\" $selected>" . $titanium_lang[$val] . '</option>';
            }
            break;
            case 'order':
            foreach($order_types as $val)
            {
                $selected = ($order == $val) ? 'selected="selected"' : '';
                $rval .= "<option value=\"$val\" $selected>" . $titanium_lang[$val] . '</option>';
            }
            break;
            case 'pmtype':
            foreach($pmtypes as $val)
            {
                $selected = ($pmtype == $val) ? 'selected="selected"' : '';
                $rval .= "<option value=\"$val\" $selected>" . $titanium_lang['PM_' . $val] . '</option>';
            }
            break;
        }
        $rval .= '</select>';

        return $rval;
    }

    function id_2_name($id, $mode = 'user')
    {
        global $titanium_db;

        static $nameCache; //Stores names we've already sent a query for
                           //Has array sections ['user'] and ['reverse']
                           //['user']['user_id'] => ['username']
                           //['reverse']['username'] => ['user_id']
        
        if ($id == '')
        {
            return '?';
        }

        switch($mode)
        {
            case 'user':
            {
                if (isset($nameCache['user'][$id]))
                {
                    return $nameCache['user'][$id];
                }
                
                $sql = 'SELECT username FROM ' . USERS_TABLE . "
                   WHERE user_id = $id";

                if(!$result = $titanium_db->sql_query($sql))
                {
                    message_die(GENERAL_ERROR, $titanium_lang['Error_Other_Table'], '', __LINE__, __FILE__, $sql);
                }
                $row = $titanium_db->sql_fetchrow($result);
                //Setupcache
                $nameCache['user'][$row['user_id']] = $row['username'];
                $nameCache['reverse'][$row['username']] = $row['user_id'];
                return $row['username'];
                break;
            }
            case 'reverse':
            {
                if (isset($nameCache['reverse'][$id]))
                {
                    return $nameCache['reverse'][$id];
                }
                $sql = 'SELECT user_id FROM ' . USERS_TABLE . "
                   WHERE username = '$id'";

                if(!$result = $titanium_db->sql_query($sql))
                {
                    message_die(GENERAL_ERROR, $titanium_lang['Error_Other_Table'], '', __LINE__, __FILE__, $sql);
                }
                $row = $titanium_db->sql_fetchrow($result);
                if (empty($row['user_id']))
                {
                    return 0;
                }
                else
                {
                    //Setupcache
                    $nameCache['user'][$row['user_id']] = $row['username'];
                    $nameCache['reverse'][$row['username']] = $row['user_id'];
                    return $row['user_id'];
                }
                break;
            }
        }
    }
    
    function do_pagination($mode = 'normal')
    {
        global $titanium_db, $filter_from_text, $filter_to_text, $filter_from, $filter_to, $titanium_lang, $phpbb2_template, $order;
        global $mode, $pmtype, $sort, $pmtype_text, $archive_text, $phpbb2_start, $archive_start, $phpbb2_topics_per_pg, $phpEx;

        $sql = 'SELECT count(*) AS total FROM ' . PRIVMSGS_TABLE . $this->inArchiveText." pm
           WHERE 1
           $pmtype_text
           $filter_from_text
           $filter_to_text";

        if(!$result = $titanium_db->sql_query($sql))
        {
            message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
        }
        $total = $titanium_db->sql_fetchrow($result);
        $total_phpbb2_pms = ($total['total'] > 0) ? $total['total'] : 1;

        $pagination = generate_pagination($this->urlPage, $total_phpbb2_pms, $phpbb2_topics_per_pg, $phpbb2_start)."&nbsp;";

        $phpbb2_template->assign_vars(array(
            "PAGINATION" => $pagination,
            "PAGE_NUMBER" => sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $phpbb2_topics_per_pg ) + 1 ), ceil( $total_phpbb2_pms / $phpbb2_topics_per_pg )),

            "L_GOTO_PAGE" => $titanium_lang['Goto_page'])
        );
    }
    
    /**
    * @return boolean
    * @param filename string
    * @desc Tries to locate and include the specified language file.  Do not include the .php extension!
    */
    function find_lang_file($filename)
    {
        global $titanium_lang, $phpbb2_root_path, $phpbb2_board_config, $phpEx;
        
        if (file_exists($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . "/$filename.$phpEx"))
        {
            include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . "/$filename.$phpEx");
        }
        elseif (file_exists($phpbb2_root_path . "language/lang_english/$filename.$phpEx"))
        {
            include_once($phpbb2_root_path . "language/lang_english/$filename.$phpEx");
        }
        else
        {
            message_die(GENERAL_ERROR, "Unable to find a suitable language file for $filename!", '');
        }
        return true;
    }
    
    /**
    * @return void
    * @desc Prints a sytlized line of copyright for module
    */
    function copyright()
    {
        printf('<br /><center><span class="copyright">
                    %s 
                    &copy; %s 
                    <a href="http://www.nivisec.com" class="copyright" target="_blank">Nivisec.com</a>.
                    ', $this->modName, $this->copyrightYear);
        printf('</span></center>');
    }
    
    function doArchiveTable()
    {
        global $titanium_db, $status_message, $titanium_lang, $titanium_prefix;
        
        switch (SQL_LAYER)
        {
            case 'mysql':
            case 'mysql4':
            case 'mysqli':
            {
                $create[] = "CREATE TABLE `".$titanium_prefix."privmsgs_archive` (
                    `privmsgs_id` mediumint( 8 ) unsigned NOT NULL AUTO_INCREMENT ,
                    `privmsgs_type` tinyint( 4 ) NOT NULL default '0',
                    `privmsgs_subject` varchar( 255 ) NOT NULL default '0',
                    `privmsgs_from_userid` mediumint( 8 ) NOT NULL default '0',
                    `privmsgs_to_userid` mediumint( 8 ) NOT NULL default '0',
                    `privmsgs_date` int( 11 ) NOT NULL default '0',
                    `privmsgs_ip` varchar( 8 ) NOT NULL default '',
                    `privmsgs_enable_bbcode` tinyint( 1 ) NOT NULL default '1',
                    `privmsgs_enable_html` tinyint( 1 ) NOT NULL default '0',
                    `privmsgs_enable_smilies` tinyint( 1 ) NOT NULL default '1',
                    `privmsgs_attach_sig` tinyint( 1 ) NOT NULL default '1',
                    PRIMARY KEY ( `privmsgs_id` ) ,
                    KEY `privmsgs_from_userid` ( `privmsgs_from_userid` ) ,
                    KEY `privmsgs_to_userid` ( `privmsgs_to_userid` ) 
                    )";
                break;
            }
        }

        foreach($create as $sql)
        {
            if(!$result = $titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Archive_Table'], '', __LINE__, __FILE__);
            }
        }
        $status_message .= $titanium_lang['Archive_Table_Inserted'];
    }
}

class aprvmManager
{
    var $deleteQueue;
    var $archiveQueue;
    var $syncNums;
    
    function arpvmManager()
    {
    }
    
    function addArchiveItem($post_id)
    {
        $this->archiveQueue[] = $post_id;
    }
    
    function addDeleteItem($post_id)
    {
        $this->deleteQueue[] = $post_id;
    }

    function doArchive()
    {
        global $titanium_lang, $titanium_db, $status_message, $aprvmUtil;
        
        if (!count($this->archiveQueue)) return;
        
        $postList = '';
        foreach($this->archiveQueue as $post_id)
        {
            $postList .= ($postList != '') ? ', '.$post_id : $post_id;
        }
        
        $sql = 'SELECT * FROM ' . PRIVMSGS_TABLE . "
               WHERE privmsgs_id IN ($postList)";
        if(!$result = $titanium_db->sql_query($sql))
        {
            message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
        }
        while ($row = $titanium_db->sql_fetchrow($result))
        {
            $sql = 'INSERT INTO ' . PRIVMSGS_TABLE . $aprvmUtil->archiveText.' VALUES
               (' . $row['privmsgs_id'] . ', ' . $row['privmsgs_type'] . ", '" . addslashes($row['privmsgs_subject']) . "', " .
                $row['privmsgs_from_userid'] . ', ' . $row['privmsgs_to_userid'] . ', ' . $row['privmsgs_date'] . ", '" .
                $row['privmsgs_ip'] . "', " . $row['privmsgs_enable_bbcode'] . ', ' . $row['privmsgs_enable_html'] . ', ' .
                $row['privmsgs_enable_smilies'] . ', ' . $row['privmsgs_attach_sig'] . ')';
            if(!$titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Text_Table'], '', __LINE__, __FILE__, $sql);
            }
            else
            {
                $status_message .= sprintf($titanium_lang['Archived_Message'], $row['privmsgs_subject']);
                $this->syncNums[$row['privmsgs_to_userid']][$row['privmsgs_type']]++;
            }
        }
        $sql = 'DELETE FROM ' . PRIVMSGS_TABLE . "
                  WHERE privmsgs_id IN ($postList)";
        if(!$titanium_db->sql_query($sql))
        {
            message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Text_Table'], '', __LINE__, __FILE__, $sql);
        }

    }
    
    function doDelete()
    {
        global $phpbb2_board_config, $HTTP_POST_VARS, $titanium_db, $titanium_lang, $status_message, $aprvmUtil, $mode;
        
        if (!count($this->deleteQueue)) return;

        $postList = '';
        foreach($this->deleteQueue as $post_id)
        {
            if ($phpbb2_board_config['aprvmArchive'] && isset($HTTP_POST_VARS['archive_id_' . $post_id]))
            {
                /* This query isn't really needed, but makes the hey we deleted this title isntead of id show up */
                $sql = 'SELECT privmsgs_subject FROM ' . PRIVMSGS_TABLE . $aprvmUtil->archiveText . " 
                       WHERE privmsgs_id = $post_id";
                if(!$result = $titanium_db->sql_query($sql))
                {
                    message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Archive_Table'], '', __LINE__, __FILE__, $sql);
                }
                $row = $titanium_db->sql_fetchrow($result);
                $status_message .= sprintf($titanium_lang['Archived_Message_No_Delete'], $row['privmsgs_subject']);
            }
            else
            {
                $postList .= ($postList != '') ? ', '.$post_id : $post_id;
            }
        }

            $sql = 'SELECT privmsgs_subject, privmsgs_to_userid, privmsgs_type FROM ' . PRIVMSGS_TABLE . $aprvmUtil->inArchiveText."
               WHERE privmsgs_id IN ($postList)";
            if(!$result = $titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }
            while ($row = $titanium_db->sql_fetchrow($result))
            {
                $status_message .= sprintf($titanium_lang['Deleted_Message'], $row['privmsgs_subject']);

                if (!$phpbb2_board_config['aprvmArchive'] || $mode != 'archive')
                {
                    $this->syncNums[$row['privmsgs_to_userid']][$row['privmsgs_type']]++;
                }
            }

            $sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
                      WHERE privmsgs_text_id IN ($postList)";
            if(!$titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }

            $sql = "DELETE FROM " . PRIVMSGS_TABLE . $aprvmUtil->inArchiveText." 
                      WHERE privmsgs_id IN ($postList)";
            if(!$titanium_db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, $titanium_lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
            }
    }

    function go()
    {
        global $aprvmUtil;
        
        $this->doArchive();
        $this->doDelete();
        if (count($this->syncNums))
        {
            foreach($this->syncNums as $titanium_user_id => $type)
            {
                foreach($type as $pmType => $num)
                {
                    $aprvmUtil->resync($pmType, $titanium_user_id, $num);
                }
            }
        }
    }
}

?>