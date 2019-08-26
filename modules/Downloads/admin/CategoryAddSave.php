<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
/*
 * Do some basic data cleansing/validation first
 */
$cid = isset($cid) ? intval($cid) : 0;

$title = (isset($title)) ? substr(gdFilter($title, 'nohtml'), 0, 50) : '';

$cdescription = (isset($cdescription)) ? addslashes(gdFilter($cdescription, '')) : '';

$whoadd = (isset($whoadd)) ? intval($whoadd) : 0;

// @todo: should we really allow uploads outside a user account? (can you trust your admins?)
$uploaddir = (isset($uploaddir)) ? addslashes(substr(gdFilter($uploaddir, 'nohtml'), 0, 255)) : '';

$canupload = (isset($canupload)) ? intval($canupload) : 0;

/*
 * Then check if the particular sub-category already exists under the parent category.
 */
$sql = 'SELECT * FROM `'.$prefix.'_nsngd_categories` WHERE `title` = \''.addslashes($title).'\' AND `parentid` = '.$cid;

$numrows = $db->sql_numrows($db->sql_query($sql));

if ($numrows > 0) 
{
	$pagetitle = _DL_CATEGORIESADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';
    OpenTable();
	title('<h1>'.$pagetitle.'</h1>');
	DLadminmain();
	echo '<br />';
	OpenTable2();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHESUBCATEGORY . ' ' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . ' '
		. _DL_ALREADYEXIST . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable2();
	CloseTable();

	include_once 'footer.php';
}

$sql = 'INSERT INTO `'.$prefix.'_nsngd_categories` VALUES (NULL, \''.addslashes($title).'\', \''.$cdescription.'\', \''.$cid.'\', \''.$whoadd.'\', \''.$uploaddir.'\', \''.$canupload.'\', 1)';

$db->sql_query($sql);

Header('Location: '.$admin_file.'.php?op=Categories');

