<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$cid = isset($cid) ? intval($cid) : 0;

if ($cid) 
{
	$title = (isset($title)) ? substr(gdFilter($title, 'nohtml'), 0, 50) : '';
	$cdescription = (isset($cdescription)) ? addslashes(gdFilter($cdescription, '')) : '';
	$whoadd = (isset($whoadd)) ? intval($whoadd) : 0;

	// @todo: should we really allow uploads outside a user account? (can you trust your admins?)
	$uploaddir = (isset($uploaddir)) ? addslashes(substr(gdFilter($uploaddir, 'nohtml'), 0, 255)) : '';
	$canupload = (isset($canupload)) ? intval($canupload) : 0;

	/*
	 * Need to also make sure not trying to modify to an already existing sub-category
	 */
	$sql = 'SELECT `parentid` FROM `'.$prefix.'_nsngd_categories` WHERE `cid` = '.$cid;

	if (list($parentid) = $db->sql_fetchrow($db->sql_query($sql))) 
	{
		$sql = 'SELECT `cid` FROM `'.$prefix.'_nsngd_categories` WHERE `title` = \''.addslashes($title).'\' AND `parentid` = '.$parentid.' AND `cid` != '.$cid;
	
		$numrows = $db->sql_numrows($db->sql_query($sql));
	
		if ($numrows > 0) 
		{
			$pagetitle = _DL_CATEGORIESADMIN.': '._DL_ERROR;
			include_once 'header.php';
			
			OpenTable();
			title('<h1>'.$pagetitle.'</h1>');
			DLadminmain();
			echo '<br />';
			OpenTable4();
			echo '<div align="center"><p class="title">'._DL_ERRORTHESUBCATEGORY.' '.htmlspecialchars($title, ENT_QUOTES, _CHARSET).' '. _DL_ALREADYEXIST.'</p>';
			echo '<p class="title">'._GOBACK.'</p></div>';
			CloseTable4();
			CloseTable();
			include_once 'footer.php';
			die();
		}
		
		/*
		 * Passed everything so UPDATE
		 */
		$sql = 'UPDATE `'.$prefix.'_nsngd_categories` SET `title` = \''.addslashes($title).'\', `cdescription` = \''.$cdescription.'\', `whoadd` = \''.$whoadd.'\', `uploaddir` = \''. $uploaddir.'\', `canupload` = \''.$canupload.'\' WHERE `cid` = '.$cid;
		$db->sql_query($sql);
	}
}

Header('Location: '.$admin_file.'.php?op=Categories');

