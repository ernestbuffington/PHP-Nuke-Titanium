<?php
/**
 * TegoNuke(tm)/NSN GR Downloads (NSNGD): Submit Downloads
 *
 * This module allows end-users, as configured by the admin by download category,
 * to submit new downloads for the admin to review and either accept or
 * ignore/delete.  If the download category configuration allows it, this will
 * also allow for the uploading of files along with the submitted download data.
 *
 * The original NSN GR Downloads was given to montego by Bob Marion back in 2006 to
 * take over on-going development and support.  It has undergone extensive bug
 * removal, including XHTML compliance and further security checking, among other
 * fine enhancements made over time.
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
global $sitename;
define('_DL_ADDADOWNLOAD', 'Add a New Download');
define('_DL_ADDTHISFILE', 'Add this file');
define('_DL_ALWEXT', 'Allowed Extensions');
define('_DL_BADEXT', 'Wrong extension!');
define('_DL_CANTADD', 'You do not have proper rights to submit to this category');
define('_DL_DOWNLOADNODESC', 'ERROR: You need to type a DESCRIPTION for your submission!');
define('_DL_DOWNLOADNOTITLE', 'ERROR: You need to type a TITLE for your submission!');
define('_DL_DOWNLOADNOURL', 'ERROR: You need to type a URL for your submission!');
define('_DL_DOWNLOADRECEIVED', 'We received your Download submission. Thanks!');
define('_DL_DOWSUB', 'Download Submission');
define('_DL_DOWSUBREC', 'Download Submission Recieved');
define('_DL_DPOSTPENDING', 'All downloads are posted pending verification.');
define('_DL_DUSAGE1', 'All submissions will be checked for membership requirements and content.');
define('_DL_DUSAGE2', 'If found to require membership the following WILL BE appended to the submission:');
define('_DL_DUSAGE3', '<span style="color:#ff0000;" class="thick">Site Note: This site requires membership to access this Link.</span>');
define('_DL_DUSAGE4', 'If found to have questionable content the following WILL BE appended to the submission:');
define('_DL_DUSAGE5', '<span style="color:#0000ff;" class="thick">Site Note: This site contains questionable content.</span>');
define('_DL_DUSAGEUP1', 'By submitting your upload you are agreeing:');
define('_DL_DUSAGEUP2', 'to allow <span class="thick">' . $sitename . '</span> to host the file for download for an undetermed length of time.');
define('_DL_DUSAGEUP3', 'that this agreement will serve as your "Written" consent for <span class="thick">' . $sitename . '</span> to host the download.');
define('_DL_DUSAGEUP4', 'that the owner(s) of <span class="thick">' . $sitename . '</span> is absolved of any liability claims resulting from the use of or hosting of your upload.');
define('_DL_DUSAGEUP5', 'that you have not used another developers script and claimed it as your own.');
define('_DL_DUSAGEUP6', 'if later found to be false then you agree to be held legally liable for any damages suffered from the use of or the hosting of your upload.');
define('_DL_EMAILWHENADD', 'You\'ll receive and E-mail when it\'s approved.');
define('_DL_FILEEXIST', '<span class="thick">ERROR:</span> This file already exists in our directory structure.');
define('_DL_GONEXT', 'GOTO NEXT STEP');
define('_DL_INSTRUCTIONS', 'Instructions');
define('_DL_NOCATEGORY', 'There are no categories open for submissions');
define('_DL_NOUPLOAD', '<span class="thick">ERROR:</span> File Not Uploaded.');
define('_DL_TOBIG', '<span class="thick">ERROR:</span> File Is To Large.');
define('_DL_TOU', 'Terms of Use');
define('_DL_TOUMUST', 'You <span class="thick">MUST</span> agree to the "Terms of Use"!');
define('_DL_USERANDIP', 'Username and IP are recorded, so please don\'t abuse the system.');
if (!defined('_DL_AUTHOREMAIL')) define('_DL_AUTHOREMAIL', 'Author\'s Email');
if (!defined('_DL_AUTHORNAME')) define('_DL_AUTHORNAME', 'Author\'s Name');
if (!defined('_DL_BYTES')) define('_DL_BYTES', 'bytes');
if (!defined('_DL_CATEGORY')) define('_DL_CATEGORY', 'Category');
if (!defined('_DL_CHECKFORIT')) define('_DL_CHECKFORIT', 'You didn\'t provide an Email address but we will check your link soon.');
if (!defined('_DL_DESCRIPTION')) define('_DL_DESCRIPTION', 'Description');
if (!defined('_DL_DOWNLOADS')) define('_DL_DOWNLOADS', 'Downloads');
if (!defined('_DL_DSUBMITONCE')) define('_DL_DSUBMITONCE', 'Submit a unique download only once.');
if (!defined('_DL_FILESIZE')) define('_DL_FILESIZE', 'Filesize');
if (!defined('_DL_HOMEPAGE')) define('_DL_HOMEPAGE', 'HomePage');
if (!defined('_DL_INBYTES')) define('_DL_INBYTES', 'in bytes');
if (!defined('_DL_SUBIP')) define('_DL_SUBIP', 'Submitter IP');
if (!defined('_DL_TITLE')) define('_DL_TITLE', 'Title');
if (!defined('_DL_URL')) define('_DL_URL', 'URL');
if (!defined('_DL_VERSION')) define('_DL_VERSION', 'Version');

