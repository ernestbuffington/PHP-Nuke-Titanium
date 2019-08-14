<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$cid = isset($cid) ? intval($cid) : 0;
$min = isset($min) ? intval($min) : 0;

if ($cid) 
{
	$crawled = array($cid);

	CrawlLevel($cid);

	$x = 0;

	while ($x <= (sizeof($crawled) - 1)) 
	{
		// Remove the category and sub-categories
		$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_categories` WHERE `cid` = '.$crawled[$x]);
		// Remove any downloads sitting in the mods tab;e for the given category and subcategory
		$sql = 'DELETE FROM `'.$prefix.'_nsngd_mods` WHERE `lid` IN (SELECT `lid` FROM `'.$prefix.'_nsngd_downloads` WHERE `cid` = '.$crawled[$x].')';
		$db->sql_query($sql);
		
		// Remove the downloads now from the category and sub-categories
		$db->sql_query('DELETE FROM `'.$prefix.'_nsngd_downloads` WHERE `cid` = '.$crawled[$x]);
		$x++;
	}
	$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_categories`');
	$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_mods`');
	$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_nsngd_downloads`');
}

Header('Location: ' . $admin_file . '.php?op=Categories&min=' . $min);

