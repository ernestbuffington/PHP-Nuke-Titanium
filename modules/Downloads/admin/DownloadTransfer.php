<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$cidto = isset($cidto) ? intval($cidto) : 0;
$cidfrom = isset($cidfrom) ? intval($cidfrom) : 0;
$db->sql_query('UPDATE `'.$prefix.'_nsngd_downloads` SET `cid` = '.$cidto.' WHERE `cid` = '.$cidfrom);

Header('Location: '.$admin_file.'.php?op=Categories');

