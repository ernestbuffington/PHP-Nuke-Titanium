<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$eid = isset($eid) ? intval($eid) : 0;
$min = isset($min) ? intval($min) : 0;

$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_extensions` WHERE `eid` = '.$eid);
$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_extensions`');

Header('Location: '.$admin_file.'.php?op=Extensions&min='.$min);

