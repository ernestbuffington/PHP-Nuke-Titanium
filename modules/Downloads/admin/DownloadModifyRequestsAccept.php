<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$rid = isset($rid) ? intval($rid) : 0;
$sql = 'SELECT `rid`, `lid`, `cid`, `sid`, `title`, `url`, `description`, `name`, `email`, `filesize`, `version`, `homepage` FROM `'.$prefix.'_nsngd_mods` WHERE `rid` = '.$rid;
$result = $db->sql_query($sql);

while(list($rid, $lid, $cid, $sid, $title, $url, $description, $aname, $email, $filesize, $version, $homepage) = $db->sql_fetchrow($result)) 
{
	/*
	 * Since the URL is not displayed, it is possible for someone to not enter anything into the URL field
	 * and therefore it ends up blanking out the original URL.  Therefore, check for this condition and just
	 * not update the url field.
	 */
	$sql = 'UPDATE `'.$prefix.'_nsngd_downloads` SET `cid` = '.(int)$cid.', `sid` = '.(int)$sid.', `title` = \''.addslashes($title).'\', `description` = \''.addslashes($description).'\', `name` = \''.addslashes($aname).'\', `email` = \''.addslashes($email).'\', `filesize` = \''.addslashes($filesize).'\', `version` = \''.addslashes($version).'\', `homepage` = \''. addslashes($homepage).'\'';
	
	if (!empty($url)) 
	{
		$sql .=  ', `url` = \'' . $url . '\'';
	}
	
	$sql .=  ' WHERE `lid` = ' . (int)$lid;
	$db->sql_query($sql);
	$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_mods` WHERE `rid` = '.$rid);
	$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_mods`');
}

Header('Location: '.$admin_file.'.php?op=DownloadModifyRequests');

