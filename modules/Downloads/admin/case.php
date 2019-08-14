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
$module_name = 'Downloads';
if (!defined('_DL_LANG_MODULE')) get_lang($module_name); // Will get the base module's language file
switch ($op) {
	case 'DLMain':
	case 'DLConfig':
	case 'DLConfigSave':
	case 'Categories':
	case 'CategoryActivate':
	case 'CategoryAdd':
	case 'CategoryAddSave':
	case 'CategoryDeactivate':
	case 'CategoryDelete':
	case 'CategoryDeleteSave':
	case 'CategoryModify':
	case 'CategoryModifySave':
	case 'CategoryTransfer':
	case 'DownloadActivate':
	case 'DownloadAdd':
	case 'DownloadAddSave':
	case 'DownloadBroken':
	case 'DownloadBrokenDelete':
	case 'DownloadBrokenIgnore':
	case 'DownloadCheck':
	case 'DownloadDeactivate':
	case 'DownloadDelete':
	case 'DownloadModify':
	case 'DownloadModifyRequests':
	case 'DownloadModifyRequestsAccept':
	case 'DownloadModifyRequestsIgnore':
	case 'DownloadModifySave':
	case 'DownloadNew':
	case 'DownloadNewDelete':
	case 'Downloads':
	case 'DownloadTransfer':
	case 'DownloadValidate':
	case 'ExtensionAdd':
	case 'ExtensionAddSave':
	case 'ExtensionDelete':
	case 'ExtensionModify':
	case 'ExtensionModifySave':
	case 'Extensions':
	case 'FilesizeCheck':
	case 'FilesizeValidate':
		include_once 'modules/' . $module_name . '/admin/index.php';
		break;
}

