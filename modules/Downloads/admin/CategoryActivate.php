<?php //done
if(!defined('IN_NSN_GD')) 
{ 
  echo 'Access Denied'; die(); 
}

$cid = isset($cid) ? intval($cid) : 0;
$min = isset($min) ? intval($min) : 0;

if ($cid) 
{
	$crawler = array($cid);
	CrawlLevelR($cid);
	$x = 0;

	while ($x <= (sizeof($crawler) -1)) 
	{
		$db->sql_query('UPDATE `'.$prefix.'_nsngd_categories` SET `active` = 1 WHERE `cid` = \''.$crawler[$x].'\'');
		$db->sql_query('UPDATE `'.$prefix.'_nsngd_downloads` SET `active` = 1 WHERE `cid` = \''.$crawler[$x].'\'');
		$x++;
	}
}

Header('Location: ' . $admin_file . '.php?op=Categories&min=' . $min);

