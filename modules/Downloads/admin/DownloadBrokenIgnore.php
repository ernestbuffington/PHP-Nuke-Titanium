<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$lid = isset($lid) ? intval($lid) : 0;

$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_mods` WHERE `lid` = '.$lid.' AND `brokendownload` = 1');
$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_mods`');

Header('Location: '.$admin_file.'.php?op=DownloadBroken');

