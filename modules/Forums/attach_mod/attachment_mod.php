<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/**
*
* @package attachment_mod
* @version $Id: attachment_mod.php,v 1.6 2005/11/06 18:35:43 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* Minimum Requirement: PHP 4.2.0
*/

global $file_mode;

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

include($phpbb2_root_path . 'attach_mod/includes/constants.' . $phpEx);
include($phpbb2_root_path . 'attach_mod/includes/functions_includes.' . $phpEx);
include($phpbb2_root_path . 'attach_mod/includes/functions_attach.' . $phpEx);
include($phpbb2_root_path . 'attach_mod/includes/functions_delete.' . $phpEx);
include($phpbb2_root_path . 'attach_mod/includes/functions_thumbs.' . $phpEx);
include($phpbb2_root_path . 'attach_mod/includes/functions_filetypes.' . $phpEx);

if (defined('ATTACH_INSTALL'))
{
    return;
}

/**
* wrapper function for determining the correct language directory
*/
function attach_mod_get_lang($titanium_language_file)
{
    global $phpbb2_root_path, $phpEx, $attach_config, $phpbb2_board_config;

    $titanium_language = $phpbb2_board_config['default_lang'];

    if (!file_exists($phpbb2_root_path . 'language/lang_' . $titanium_language . '/' . $titanium_language_file . '.' . $phpEx))
    {
        $titanium_language = $attach_config['board_lang'];
        
        if (!file_exists($phpbb2_root_path . 'language/lang_' . $titanium_language . '/' . $titanium_language_file . '.' . $phpEx))
        {
            message_die(GENERAL_MESSAGE, 'Attachment Mod language file does not exist: language/lang_' . $titanium_language . '/' . $titanium_language_file . '.' . $phpEx);
        }
        else
        {
            return $titanium_language;
        }
    }
    else
    {
        return $titanium_language;
    }
}

/**
* Include attachment mod language entries
*/
function include_attach_lang()
{
    global $phpbb2_root_path, $phpEx, $titanium_lang, $phpbb2_board_config, $attach_config;
    
    // Include Language
    $titanium_language = attach_mod_get_lang('lang_main_attach');
    include_once($phpbb2_root_path . 'language/lang_' . $titanium_language . '/lang_main_attach.' . $phpEx);

    if (defined('IN_ADMIN'))
    {
        $titanium_language = attach_mod_get_lang('lang_admin_attach');
        include_once($phpbb2_root_path . 'language/lang_' . $titanium_language . '/lang_admin_attach.' . $phpEx);
    }
}

/**
* Get attachment mod configuration
*/
function get_config()
{
    global $titanium_db, $phpbb2_board_config;

    $attach_config = array();

    $sql = 'SELECT *
        FROM ' . ATTACH_CONFIG_TABLE;
    if (!($result = $titanium_db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Could not query attachment information', '', __LINE__, __FILE__, $sql);
    }

    while ($row = $titanium_db->sql_fetchrow($result))
    {
        $attach_config[$row['config_name']] = trim($row['config_value']);
    }

    // We assign the original default board language here, because it gets overwritten later with the users default language
    $attach_config['board_lang'] = trim($phpbb2_board_config['default_lang']);

    return $attach_config;
}

// Get Attachment Config
$cache_dir = $phpbb2_root_path . '/cache';
$cache_file = $cache_dir . '/attach_config.php';
$attach_config = array();

if (file_exists($cache_dir) && is_dir($cache_dir) && is_writable($cache_dir))
{
    if (file_exists($cache_file))
    {
        include($cache_file);
    }
    else
    {
        $attach_config = get_config();
        $fp = @fopen($cache_file, 'wt+');
        if ($fp)
        {
            $lines = array();
            foreach ($attach_config as $k => $v)
            {
                if (is_int($v))
                {
                    $lines[] = "'$k'=>$v";
                }
                else if (is_bool($v))
                {
                    $lines[] = "'$k'=>" . (($v) ? 'TRUE' : 'FALSE');
                }
                else
                {
                    $lines[] = "'$k'=>'" . str_replace("'", "\\'", str_replace('\\', '\\\\', $v)) . "'";
                }
            }
            fwrite($fp, '<?php $attach_config = array(' . implode(',', $lines) . '); ?>');
            fclose($fp);

            @chmod($cache_file, $file_mode);
        }
    }
}
else
{
    $attach_config = get_config();
}

// Please do not change the include-order, it is valuable for proper execution.
// Functions for displaying Attachment Things
include($phpbb2_root_path . 'attach_mod/displaying.' . $phpEx);

// Posting Attachments Class (HAVE TO BE BEFORE PM)
include($phpbb2_root_path . 'attach_mod/posting_attachments.' . $phpEx);

// PM Attachments Class
include($phpbb2_root_path . 'attach_mod/pm_attachments.' . $phpEx);

if (!intval($attach_config['allow_ftp_upload']))
{
    $upload_dir = $attach_config['upload_dir'];
}
else
{
    $upload_dir = $attach_config['download_path'];
}

if (!function_exists('attach_mod_sql_escape'))
{
    message_die(GENERAL_MESSAGE, 'You haven\'t correctly updated/installed the Attachment Mod.<br />You seem to forgot uploading a new file. Please refer to the update instructions for help and make sure you have uploaded every file correctly.');
}

?>