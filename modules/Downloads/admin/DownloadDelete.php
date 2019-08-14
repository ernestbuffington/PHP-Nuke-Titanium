<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$lid = isset($lid) ? intval($lid) : 0;
$min = isset($min) ? intval($min) : 0;

list($sname) = $db->sql_fetchrow($db->sql_query('SELECT `submitter` FROM `'.$prefix.'_nsngd_downloads` WHERE `lid` = '.$lid));

$db->sql_query('UPDATE `'.$prefix.'_nsngd_accesses` SET `uploads` = `uploads` - 1 WHERE `username` = \''.addslashes($sname).'\'');
$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_downloads` WHERE `lid` = '.$lid);
$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_mods` WHERE `lid` = '.$lid);
$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_downloads`');
$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_mods`');

Header('Location: '.$admin_file.'.php?op=Downloads&min='.$min);

