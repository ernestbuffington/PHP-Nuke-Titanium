<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$lid = isset($lid) ? intval($lid) : 0;
$min = isset($min) ? intval($min) : 0;

$db->sql_query('UPDATE `'.$prefix.'_nsngd_downloads` SET active = 1 WHERE `lid` = '.$lid);

Header('Location: '.$admin_file.'.php?op=Downloads&min='.$min);

