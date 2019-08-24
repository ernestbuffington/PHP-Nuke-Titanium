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
/*
 * Do not remove the following defined statement.  Make sure this is here
 * also within EVERY translation of this English file.
 */
define('_DL_LANG_MODULE', true);
/*
 * End of key language file define.  You may modify any text in the below
 * lines, but do not change the name of the constant that is being defined!
 */
define('_DLMAIN', 'Main Downloads');
define('_DL_1WEEK', '1 Week');
define('_DL_2WEEKS', '2 Weeks');
define('_DL_30DAYS', '30 Days');
define('_DL_ACCEPT', 'Accept');
define('_DL_ACTIVATE', 'Activate');
define('_DL_ACTIVE_N', 'Inactive');
define('_DL_ACTIVE_Y', 'Active');
define('_DL_ADD', 'Add');
define('_DL_ADDCATEGORY', 'Add Category');
define('_DL_ADDDOWNLOAD', 'Add Download');
define('_DL_ADDED', 'Added');
define('_DL_ADDEDON', 'Added on');
define('_DL_ADDEXTENSION', 'Add Extension');
define('_DL_ADMADMPERPAGE', '# of items on each admin list');
define('_DL_ADMBLOCKUNREGMODIFY', 'Unregistered users can suggest changes');
define('_DL_ADMIN', 'Administrators Only');
define('_DL_ADMMOSTPOPULAR', 'Most Popular items to show');
define('_DL_ADMMOSTPOPULARTRIG', 'Show Most Popular as');
define('_DL_ADMPERPAGE', '# of items on each page');
define('_DL_ADMPOPULAR', '# of hits to be POPULAR');
define('_DL_ADMRESULTS', '# of items on each search page');
define('_DL_ADMSHOWDOWNLOAD', 'Show Downloads to everyone');
define('_DL_ADMSHOWNUM', 'Show # of items for each category');
define('_DL_ADMUSEGFX', 'Use Security Code');
define('_DL_ALL', 'All Visitors');
define('_DL_ALREADYEXIST', 'already exist!');
define('_DL_ANON', 'Anonymous Users Only');
define('_DL_APPROVEDMSG', 'Your submitted download has been approved!');
define('_DL_AUTHOR', 'Author');
define('_DL_BACKTO', 'Back To');
define('_DL_BEPATIENT', '(please be patient)');
define('_DL_BROKENREP', 'Broken Reports');
define('_DL_CANBEDOWN', 'This file can be downloaded by');
define('_DL_CANBEVIEW', 'This file can be viewed by');
define('_DL_CANUPLOAD', 'Allow Uploads');
define('_DL_CATEGORIES', 'Categories');
define('_DL_CATEGORIESADMIN', 'Categories Administration');
define('_DL_CATEGORIESLIST', 'Categories List');
define('_DL_CATTRANS', 'Category Transfer');
define('_DL_CHECK', 'Check');
define('_DL_CHECKALLDOWNLOADS', 'Check ALL Downloads');
define('_DL_CHECKCATEGORIES', 'Check Categories');
define('_DL_DATE', 'Date');
define('_DL_DATEADD', 'Added on');
define('_DL_DATEFORMAT', 'Date Format');
define('_DL_DATEMSG', 'The syntax used is identical to the PHP <a href="http://www.php.net/date" target="_blank">date()</a> function');
define('_DL_DAYS', 'days');
define('_DL_DBCONFIG', 'Database Error. Please notify the webmaster to run their downloads configuration!');
define('_DL_DCATLAST2WEEKS', 'New Downloads in this Category Added in the Last 2 Weeks');
define('_DL_DCATLAST3DAYS', 'New Downloads in this Category Added in the Last 3 Days');
define('_DL_DCATNEWTODAY', 'New Downloads in this Category Added Today');
define('_DL_DCATTHISWEEK', 'New Downloads in this Category Added This Week');
define('_DL_DDATE1', 'Date (Old Downloads Listed First)');
define('_DL_DDATE2', 'Date (New Downloads Listed First)');
define('_DL_DDELETEINFO', 'Delete (Deletes <span class="thick"><span class="italic">broken download</span></span> and <span class="thick"><span class="italic">requests</span></span> for a given download)');
define('_DL_DEACTIVATE', 'Deactivate');
define('_DL_DELETE', 'Delete');
define('_DL_DELETEDOWNLOAD', 'Delete Download');
define('_DL_DELEZDOWNLOADSCATWARNING', '!!!!WARNING!!!!<br />Are you sure you want to delete this category?<br />You will delete all sub-categories and attached downloads as well!');
define('_DL_DENIED', 'File Access Denied');
define('_DL_DIGNOREINFO', 'Ignore (Deletes all <span class="thick"><span class="italic">requests</span></span> for a given download)');
define('_DL_DIRECTIONS', 'DIRECTIONS:');
define('_DL_DLNOTES1', 'To download the file "');
define('_DL_DLNOTES2', '", you need to retype the displayed passcode, and click the button below.');
define('_DL_DLNOTES3', '", click the button below.');
define('_DL_DLNOTES4', ' In a few moments you will receive the download dialog or you will be directed to the appropriate site.');
define('_DL_DN', 'Downloads');
define('_DL_DNODOWNLOADSWAITINGVAL', 'There are no downloads waiting for validation');
define('_DL_DNOREPORTEDBROKEN', 'No reported broken downloads.');
define('_DL_DONLYREGUSERSMODIFY', 'Only registered users can suggest downloads modifications. Please <a href="modules.php?name=Your_Account">register or login</a>.');
define('_DL_DOWNCONFIG', 'Downloads Configuration');
define('_DL_DOWNLOAD', 'Download');
define('_DL_DOWNLOADALREADYEXT', 'ERROR: This URL is already listed in the Database!');
define('_DL_DOWNLOADAPPROVEDMSG', 'We approved your download submission for our search engine.');
define('_DL_DOWNLOADID', 'File Number');
define('_DL_DOWNLOADMODREQUEST', 'Download Modification Requests');
define('_DL_DOWNLOADNOW', 'Download this file Now!');
define('_DL_DOWNLOADOWNER', 'Download Owner');
define('_DL_DOWNLOADPROFILE', 'Download Profile');
define('_DL_DOWNLOADSADMIN', 'Downloads Administration');
define('_DL_DOWNLOADSINDB', 'Downloads in our Database');
define('_DL_DOWNLOADSLIST', 'Downloads List');
define('_DL_DOWNLOADSMAIN', 'Downloads Main');
define('_DL_DOWNLOADSMAINCAT', 'Downloads Main Categories');
define('_DL_DOWNLOADSMAINTAIN', 'Downloads Maintainance');
define('_DL_DOWNLOADSWAITINGVAL', 'Downloads Waiting for Validation');
define('_DL_DOWNLOADVALIDATION', 'Download Validation');
define('_DL_DSCRIPT', 'Download Script');
define('_DL_DTOTALFORLAST', 'Total new downloads for last');
define('_DL_DUSERMODREQUEST', 'User Download Modification Requests');
define('_DL_DUSERREPBROKEN', 'User Reported Broken Downloads');
define('_DL_EDIT', 'Edit');
define('_DL_ERROR', 'Error');
define('_DL_ERRORNODESCRIPTION', 'ERROR: You need to type a DESCRIPTION for your URL!');
define('_DL_ERRORNOTITLE', 'ERROR: You need to type a TITLE for your URL!');
define('_DL_ERRORNOURL', 'ERROR: You need to type a URL for your URL!');
define('_DL_ERRORTHEEXTENSION', 'ERROR: Extension already in use');
define('_DL_ERRORTHEEXTENSIONTYP', 'ERROR: Extension types cannot be the same');
define('_DL_ERRORTHEEXTENSIONVAL', 'ERROR: Extension has invalid format');
define('_DL_ERRORTHESUBCATEGORY', 'ERROR: The Sub-Category');
define('_DL_ERRORURLEXIST', 'ERROR: This URL is already listed in the Database!');
define('_DL_EXT', 'Extension');
define('_DL_EXTENSION', 'Extension');
define('_DL_EXTENSIONS', 'Extensions');
define('_DL_EXTENSIONSADMIN', 'Extensions Administration');
define('_DL_EXTENSIONSLIST', 'Extensions List');
define('_DL_EZATTACHEDTOCAT', 'under this category');
define('_DL_EZSUBCAT', 'sub-categories');
define('_DL_EZTHEREIS', 'There is/are');
define('_DL_EZTRANSFER', 'Transfer');
define('_DL_EZTRANSFERDOWNLOADS', 'Transfer all downloads from category');
define('_DL_FAILED', 'Failed!');
define('_DL_FILE', 'file');
define('_DL_FILENAME', 'Filename');
define('_DL_FILES', 'files');
define('_DL_FILESDL', 'files downloaded');
define('_DL_FILESIZEVALIDATION', 'Filesize Validation');
define('_DL_FILETYPE', 'File Type');
define('_DL_FLAGGED', 'This download has been automatically flagged for review by the webmaster.');
define('_DL_FNF', 'File Not Found:');
define('_DL_FNFREASON', 'It could be because the person hosting the download removed or renamed the file.');
define('_DL_FROM', 'From');
define('_DL_FUNCTIONS', 'Functions');
define('_DL_GB', 'Gb');
define('_DL_GOGET', 'Go Get It');
define('_DL_HELLO', 'Hello');
define('_DL_HITS', 'Hits');
define('_DL_ID', 'ID');
define('_DL_IGNORE', 'Ignore');
define('_DL_IMAGETYPE', 'Image Type');
define('_DL_INCLUDESUBCATEGORIES', '(include Sub-Categories)');
define('_DL_INVALIDDOWNLOAD', 'This download id is invalid.');
define('_DL_INVALIDPASS', 'You have entered an invalid Passcode.');
define('_DL_INVALIDURL', 'An invalid url has been passed to the script.');
define('_DL_KB', 'Kb');
define('_DL_LAST30DAYS', 'Last 30 Days');
define('_DL_LASTWEEK', 'Last Week');
define('_DL_LEGEND', 'Legend of Symbols');
define('_DL_LINKSDATESTRING', '%d-%b-%Y');
define('_DL_LOOKTOREQUEST', 'We\'ll look into your request shortly.');
define('_DL_MAIN', 'Main');
define('_DL_MAINADMIN', 'Site Administration');
define('_DL_MB', 'Mb');
define('_DL_MODCATEGORY', 'Modify a Category');
define('_DL_MODDOWNLOAD', 'Modify a Download');
define('_DL_MODEXTENSION', 'Modify Extension');
define('_DL_MODIFY', 'Modify');
define('_DL_MODREQUEST', 'Modification Requests');
define('_DL_MOSTPOPULAR', 'Most Popular - Top');
define('_DL_NAME', 'Name');
define('_DL_NEW', 'New');
define('_DL_NEWDOWNLOADADDED', 'New Download added to the Database');
define('_DL_NEWDOWNLOADS', 'New Downloads');
define('_DL_NEWLAST2WEEKS', 'New Last 2 Weeks');
define('_DL_NEWLAST3DAYS', 'New Last 3 Days');
define('_DL_NEWSIZE', 'New Size');
define('_DL_NEWTHISWEEK', 'New This Week');
define('_DL_NEWTODAY', 'New Today');
define('_DL_NEXT', 'Next Page');
define('_DL_NO', 'No');
define('_DL_NOCATTRANS', 'There are no Categories in the database.');
define('_DL_NOMATCHES', 'No matches found to your query');
define('_DL_NOMODREQUESTS', 'There are no modification requests right now');
define('_DL_NONE', 'None');
define('_DL_NONEXT', 'No Next Page');
define('_DL_NOPREVIOUS', 'No Previous Page');
define('_DL_NOTFOUND', 'was not found.');
define('_DL_NOTLIST', 'Not Listed');
define('_DL_NOTLOCAL', 'Not Local');
define('_DL_NUMBER', 'Number');
define('_DL_OF', 'of');
define('_DL_OFALL', 'of all');
define('_DL_OK', 'OK');
define('_DL_OLDSIZE', 'Old Size');
define('_DL_ONLY', 'Only');
define('_DL_ORIGINAL', 'Original');
define('_DL_OTHERS', 'Others');
define('_DL_OWNER', 'Owner');
define('_DL_PAGE', 'Page');
define('_DL_PAGES', 'Pages');
define('_DL_PARENT', 'Parent');
define('_DL_PASSERR', 'Passcode Error');
define('_DL_PATHHIDE', 'Path remains hidden');
define('_DL_PERCENT', 'Percent');
define('_DL_PERM', 'Permissions');
define('_DL_POPULAR', 'Popular');
define('_DL_POPULARDLS', 'Popular Downloads');
define('_DL_POPULARITY', 'Popularity');
define('_DL_POPULARITY1', 'Popularity (Least to Most Hits)');
define('_DL_POPULARITY2', 'Popularity (Most to Least Hits)');
define('_DL_PREVIOUS', 'Previous Page');
define('_DL_PURPOSED', 'Purposed');
define('_DL_REPORTBROKEN', 'Report Broken Link');
define('_DL_REQUESTDOWNLOADMOD', 'Request Download Modification');
define('_DL_RESSORTED', 'Resources currently sorted by');
define('_DL_RESTRICTED', 'File Access Restricted');
define('_DL_SAVECHANGES', 'SAVE CHANGES');
define('_DL_SEARCH', 'Search');
define('_DL_SEARCHRESULTS4', 'Search Results for');
define('_DL_SECURITYBROKEN', 'For security reasons your username and IP address will be recorded.');
define('_DL_SELECTPAGE', 'Select Page');
define('_DL_SENDREQUEST', 'Send Request');
define('_DL_SHOW', 'Show');
define('_DL_SHOWTOP', 'Show Top');
define('_DL_SORRY', 'Sorry');
define('_DL_SORTDOWNLOADSBY', 'Sort Downloads by');
define('_DL_STATUS', 'Status');
define('_DL_SUBMITTER', 'Submitter');
define('_DL_TDN', 'Total Downloads');
define('_DL_TEAM', 'Team.');
define('_DL_THANKS4YOURSUBMISSION', 'Thanks for your submission!');
define('_DL_THANKSBROKEN', 'Thank you for helping to maintain this directory\'s integrity.');
define('_DL_THANKSFORINFO', 'Thanks for the information.');
define('_DL_TIMES', 'times');
define('_DL_TITLEAZ', 'Title (A to Z)');
define('_DL_TITLEZA', 'Title (Z to A)');
define('_DL_TO', 'To');
define('_DL_TOTALDLCATEGORIES', 'Total Categories');
define('_DL_TOTALDLFILES', 'Total Files');
define('_DL_TOTALDLSERVED', 'Total Served');
define('_DL_TOTALNEWDOWNLOADS', 'Total New Downloads');
define('_DL_TYPEPASS', 'Type Passcode');
define('_DL_UADD', 'Users can add');
define('_DL_UP', 'Uploads');
define('_DL_UPDIRECTORY', 'Relative Path');
define('_DL_URLERR', 'URL Error');
define('_DL_USERS', 'Registered Users Only');
define('_DL_USEUPLOAD', 'used for file uploads');
define('_DL_USUBCATEGORIES', 'Sub-Categories');
define('_DL_VALIDATEDOWNLOADS', 'Validate Downloads');
define('_DL_VALIDATESIZES', 'Validate Filesizes');
define('_DL_VALIDATINGCAT', 'Validating Category');
define('_DL_VISIT', 'Visit');
define('_DL_WAITINGDOWNLOADS', 'Waiting Downloads');
define('_DL_WHOADD', 'Submission Permissions');
define('_DL_YES', 'Yes');
define('_DL_YOUCANBROWSEUS', 'You can browse our downloads engine at:');
define('_DL_YOURDOWNLOADAT', 'Your Download at');
define('_DL_YOURPASS', 'Your Passcode');
if (!defined('_DL_AUTHOREMAIL')) define('_DL_AUTHOREMAIL', 'Author\'s Email');
if (!defined('_DL_AUTHORNAME')) define('_DL_AUTHORNAME', 'Author\'s Name');
if (!defined('_DL_BYTES')) define('_DL_BYTES', 'bytes');
if (!defined('_DL_CATEGORY')) define('_DL_CATEGORY', 'Category');
if (!defined('_DL_CHECKFORIT')) define('_DL_CHECKFORIT', 'You didn\'t provide an Email address but we will check your link soon.');
if (!defined('_DL_DESCRIPTION')) define('_DL_DESCRIPTION', 'Description');
if (!defined('_DL_DOWNLOADS')) define('_DL_DOWNLOADS', 'Downloads');
if (!defined('_DL_DSUBMITONCE')) define('_DL_DSUBMITONCE', 'Submit a unique download only once.');
if (!defined('_DL_FILESIZE')) define('_DL_FILESIZE', 'Filesize');
if (!defined('_DL_HOMEPAGE')) define('_DL_HOMEPAGE', 'Home Page');
if (!defined('_DL_INBYTES')) define('_DL_INBYTES', 'in bytes');
if (!defined('_DL_SUBIP')) define('_DL_SUBIP', 'Submitter IP');
if (!defined('_DL_TITLE')) define('_DL_TITLE', 'Title');
if (!defined('_DL_URL')) define('_DL_URL', 'URL');
if (!defined('_DL_VERSION')) define('_DL_VERSION', 'Version');

