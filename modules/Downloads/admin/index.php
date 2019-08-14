<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Downloads
 *
 * This module allows admins and end users (if so configured - see Submit Downloads
 * module) to add/submit downloads to their site.  This module is NSN Groups aware
 * (Note: NSN Groups is already built into RavenNuke(tm)) and carries more features
 * than the stock *nuke system Downloads module.  Check out the admin screens for a
 * multitude of configuration options.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)/NSN
 * @subpackage  Downloads
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.3_47
 * @link        http://montegoscripts.com
 */
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmasternukescripts.net)   */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
/********************************************************/
/* Based on Journey Links Hack                          */
/* Copyright (c) 2000 by James Knickelbein              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)  */
/********************************************************/
global $admin_file;
if (!defined('ADMIN_FILE')) {
	Header('Location: ../../' . $admin_file . '.php');
	die();
}
define('IN_NSN_GD', true);
$module_name = basename(dirname(dirname(__FILE__)));
require_once 'mainfile.php';
/*
 * The following line is important and drives certain behaviour for that release (more secure).
 * The below RAVENNUKE_VERSION define was added by montego for the 2.20.00 release of RavenNuke(tm).
 * Do not try and fake your *nuke version to "act" like RavenNuke(tm) as you may end up lessening
 * your site's security in the process unless you REALLY KNOWN WHAT YOU ARE DOING.
 */
if (defined('RAVENNUKE_VERSION')) define('IN_RAVENNUKE', true); else define('IN_RAVENNUKE', false);
/*
 * Make sure only module admins and super admins can access this script.
 */
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT `title`, `admins` FROM `' . $prefix . '_modules` WHERE `title` = \'' . $module_name . '\''));
$row2 = $db->sql_fetchrow($db->sql_query('SELECT `name`, `radminsuper` FROM `' . $prefix . '_authors` WHERE `aid` = \'' . addslashes($aid) . '\''));
$admins = explode(',', $row['admins']);
$auth_user = 0;
for ($i = 0;$i < sizeof($admins);$i++) {
	if ($row2['name'] == $admins[$i] AND $row['admins'] != '') {
		$auth_user = 1;
	}
}
/*
 * Main processing starts here.  If the user has appropriate admin privileges,
 * continue with directing processing to the appropriate script.
 */
if ($row2['radminsuper'] == 1 || $auth_user == 1) {
	include_once 'modules/' . $module_name . '/includes/nsngd_func.php';
	$dl_config = gdget_configs();
	if (empty($dl_config)) {
		include_once 'header.php';
		title('<H1>'._DL_DBCONFIG.'</H1>');
		include_once 'footer.php';
		die();
	}
	if (!isset($op)) {
		$op = 'DLMain';
	}
	switch ($op) {
		case 'DLMain': //done
			include_once 'modules/' . $module_name . '/admin/Main.php';
			break;
		case 'DLConfig': //done
			include_once 'modules/' . $module_name . '/admin/Config.php';
			break;
		case 'DLConfigSave': //done
			csrf_check();
			include_once 'modules/' . $module_name . '/admin/ConfigSave.php';
			break;
		case 'Categories': //done
		case 'CategoryAdd': //done
		case 'CategoryTransfer': //done
		case 'Downloads': //done
		case 'DownloadAdd': //done
		case 'DownloadBroken': //done
		case 'DownloadCheck': //done
		case 'DownloadModifyRequests': //done
		case 'DownloadNew': //done
		case 'ExtensionAdd': //done
		case 'Extensions': //done
		case 'FilesizeCheck': //done
			include_once 'modules/' . $module_name . '/admin/' . $op . '.php'; //all done
			break;
		case 'CategoryActivate': //done
		case 'CategoryAddSave': //done
		case 'CategoryDeactivate': //done
		case 'CategoryDelete': //done
		case 'CategoryDeleteSave': //done
		case 'CategoryModify': //done
		case 'CategoryModifySave': //done
		case 'DownloadActivate': //done
		case 'DownloadAddSave': //done
		case 'DownloadBrokenDelete': //done
		case 'DownloadBrokenIgnore': //done
		case 'DownloadDeactivate': //done
		case 'DownloadDelete': //done
		case 'DownloadModify': //done
		case 'DownloadModifyRequestsAccept': //done
		case 'DownloadModifyRequestsIgnore': //done
		case 'DownloadModifySave': //done
		case 'DownloadNewDelete': //done
		case 'DownloadTransfer': //done
		case 'DownloadValidate': //done
		case 'ExtensionAddSave': //done
		case 'ExtensionDelete': //done
		case 'ExtensionModify': //done
		case 'ExtensionModifySave': //done
		case 'FilesizeValidate': //done
			csrf_check();
			include_once 'modules/' . $module_name . '/admin/' . $op . '.php';
			break;
	}
} else {
	Header('Location: ' . $admin_file . '.php');
}

