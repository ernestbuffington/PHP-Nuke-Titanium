<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$pagetitle = _DL_CATEGORIESADMIN;
$cid = isset($cid) ? intval($cid) : 0;

if ($cid) 
{
	$categoryinfo = getcategoryinfo($cid); 
	include_once 'header.php';
	OpenTable();
	title('<h1>'._DL_CATEGORIESADMIN.'</h1>');
	DLadminmain();
	echo '<br />';
	OpenTable4();
	echo '<div align="center">';
	echo '<p class="title">'._DL_EZTHEREIS.' '.$categoryinfo['categories'].' '._DL_EZSUBCAT.' '._DL_EZATTACHEDTOCAT.'<br />';
	echo _DL_EZTHEREIS.' '.$categoryinfo['downloads'].' '._DL_DOWNLOADS.' '._DL_EZATTACHEDTOCAT.'</p>';
	echo '<p class="title">'._DL_DELEZDOWNLOADSCATWARNING.'</p>';
	echo '<p>[ <a class="rn_csrf" href="'.$admin_file.'.php?op=CategoryDeleteSave&amp;cid='.$cid.'">'._YES.'</a> | <a href="'.$admin_file.'.php?op=Categories">'._NO.'</a> ]</p>';
	echo '</div>';
	CloseTable4();
	CloseTable();
	include_once 'footer.php';
} 
else 
{
	$min = isset($min) ? intval($min) : 0;
	Header('Location: ' . $admin_file . '.php?op=Categories&min=' . $min);
}

