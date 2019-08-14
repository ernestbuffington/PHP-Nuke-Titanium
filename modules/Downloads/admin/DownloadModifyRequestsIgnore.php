<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$rid = isset($rid) ? intval($rid) : 0;
$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_mods` WHERE `rid` = '.$rid);
$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_mods`');

Header('Location: '.$admin_file.'.php?op=DownloadModifyRequests');

