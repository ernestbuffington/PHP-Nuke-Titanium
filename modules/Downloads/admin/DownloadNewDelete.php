<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

if (isset($lid) && !is_array($lid)) 
{
	$lid = intval($lid);
	$result = $db->sql_query('SELECT `url` FROM `'.$prefix.'_nsngd_new` WHERE `lid` = '.$lid);

	if (1 == $db->sql_numrows($result)) 
	{
		list($url) = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_new` WHERE `lid` = '.(int)$lid);
		$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_new`');
		@unlink($url); // RN doesn't have ability to throw error exceptions, so we just need to hide errors for file system issue in this case
	}
}
Header('Location: '.$admin_file.'.php?op=DownloadNew');

