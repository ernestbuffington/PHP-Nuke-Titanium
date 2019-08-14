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

if (!defined('MODULE_FILE')) 
{
	header('Location: ../../index.php');
	die();
}

define('IN_NSN_GD', true);
$module_name = basename(dirname(__FILE__));
require_once 'mainfile.php';

/*
 * The following line is important and drives certain behaviour for that release (more secure).
 * The below RAVENNUKE_VERSION define was added by montego for the 2.20.00 release of RavenNuke(tm).
 * Do not try and fake your *nuke version to "act" like RavenNuke(tm) as you may end up lessening
 * your site's security in the process unless you REALLY KNOWN WHAT YOU ARE DOING.
 */
if (defined('RAVENNUKE_VERSION'))
define('IN_RAVENNUKE', true); 
else 
define('IN_RAVENNUKE', false);
require_once 'modules/' . $module_name . '/includes/nsngd_func.php';
if (!defined('_DL_LANG_MODULE')) get_lang($module_name);
$pagetitle = _DL_DOWNLOADS;

/*
 * Get the module configuration settings from the database
 */
$dl_config = gdget_configs();
if (empty($dl_config)) {
	include_once 'header.php';
	title('<H1>'._DL_DBCONFIG.'</H1>');
	include_once 'footer.php';
	die();
}
/*
 * Settings for showing right blocks or not (default is to show)
 * In order to accomodate older legacy themes, both methods are used.
 * To not show right blocks do this:
 * 1. Change $index value to 0
 * 2. Remove or comment out the 'define' line (in newer RavenNuke(tm) themes
 *    you may also be able to just change from 'true' to 'false'.
 */
$index = 1;
define('INDEX_FILE', true);
/*
 * Start of main processing.
 * First do some refactoring between the oridinal PHP-Nuke Downloads module to
 * NSN GR Downloads in case these ops are still in use within links.  Also
 * do some cleansing of the $op variable.
 * NOTE: Do not ever remove this code as a bug was found within the HTML Newsletter that
 * had the old PHP-Nuke Downloads links rather than providing the new "op" based ones.
 */
if (isset($d_op)) {
	$op = $d_op;
	unset($d_op);
}
if (!isset($op)) $op = 'index';
if ($op == 'viewdownload') $op = 'getit';
if ($op == 'viewdownloaddetails') $op = 'getit';
/*
 * Now direct processing to the proper script.
 */
switch ($op) {
	case 'index':
	case 'NewDownloads':
	case 'NewDownloadsDate':
	case 'MostPopular':
	case 'brokendownload':
	case 'modifydownloadrequest':
	case 'getit':
	case 'gfx':
	case 'search':
		include_once 'modules/' . $module_name . '/public/' . $op . '.php';
		break;
	case 'brokendownloadS':
	case 'modifydownloadrequestS':
	case 'go':
		csrf_check();
		include_once 'modules/' . $module_name . '/public/' . $op . '.php';
		break;
	default:
		include_once 'modules/' . $module_name . '/public/index.php';
		break;
}

