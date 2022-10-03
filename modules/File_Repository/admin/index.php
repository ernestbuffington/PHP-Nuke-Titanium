<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|	VERSION 			:	1.0.0
|----------------------------------------------------------------------
*/

define('IN_FILE_REPOSITORY',TRUE);
// define('INDEX_FILE',TRUE);

$titanium_module_name = basename(dirname(dirname(__FILE__)));
require_once('mainfile.php');

if(is_mod_admin($titanium_module_name)) 
{
	global $titanium_db, $admin_file, $currentlang, $userinfo;
//-------------------------------------------------------------------------
//  INCLUDE THE LANGUAGE FILE FOR THE MODULE.
//-------------------------------------------------------------------------
	include_once(NUKE_MODULES_DIR.$titanium_module_name.'/language/lang-english.php');
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	INCLUDE ALL THE FUNCTION WE NEED FOR THIS MODULE.
//-------------------------------------------------------------------------
	include_once(NUKE_MODULES_DIR.$titanium_module_name.'/includes/functions.php');
//-------------------------------------------------------------------------
	if(!$_SERVER['HTTP_X_REQUESTED_WITH']):
		include_once(NUKE_BASE_DIR.'header.php');
		OpenTable();
	endif;
//-------------------------------------------------------------------------
//	GLOBALISE THE SETTINGS THROUGHT THE ADMIN PANEL
//-------------------------------------------------------------------------
	// $settings = _settings();
//-------------------------------------------------------------------------
	switch($_GET['action'])
	{
		case 'categories':
		case 'deletecat':
		case 'editcat':
		case 'newcat':
		case 'savecat':
			include_once(_FILE_REPOSITORY_ADMIN.'categories.php');
			break;

		case 'files':
		case 'addfile':
		case 'attachfile':
		case 'brokenfiles':
		case 'clientuploads':
		case 'deletefile':
		case 'deleteitem':
		case 'deletescreen':
		case 'downloadfile':
		case 'editfile':
		case 'newfile':
		case 'savefile':
		case 'uploadfile':
		case 'uploadscreen':
			include_once(_FILE_REPOSITORY_ADMIN.'files.php');
			break;

		case 'settings':
		case 'settings_save':
			include_once(_FILE_REPOSITORY_ADMIN.'settings.php');
			break;

		default:
			_admin_navigation_menu();
			break;	
	}

	if (!$_SERVER['HTTP_X_REQUESTED_WITH']):
		CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');
	endif;

}
else
{
//---------------------------------------------------------------------
//	IF THE PERSON TRYING TO ACCESS THIS FILE IS NOT AN ADMIN,
//	REDIRECT THEM BACK THE MAIN INDEX, JUST GET RID OF THEM LOL.
//---------------------------------------------------------------------
	_redirect_titanium('modules.php?name='.$titanium_module_name);
//---------------------------------------------------------------------
}

?>