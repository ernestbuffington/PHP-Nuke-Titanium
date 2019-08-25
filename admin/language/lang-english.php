<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to my website and send to me      */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/

global $admin_file, $sitename, $nukeurl, $admlang;

define("_DOWNLOAD","Downloads");
/**
 * Language Defines: Live Feed
 * @since 2.0.9d
 */
$admlang['livefeed']['anouncement']          = 'Announcement';
$admlang['livefeed']['bugfix']               = 'Bugfix';
$admlang['livefeed']['new_release']          = 'New Release';
$admlang['livefeed']['security']             = 'Security';
$admlang['livefeed']['update']               = 'Update Announcement';
$admlang['livefeed']['header']               = 'Live News Feed';
$admlang['livefeed']['type']                 = 'News type';
$admlang['livefeed']['message']              = 'Message';
$admlang['livefeed']['save']                 = 'Save Live Feed Data';
$admlang['livefeed']['title']				 = 'Title';

// define("_ADMPOLLS","Survey / Polls");
// define("_REQUIRED","(required)");
// define("_OK","Ok!");
// define("_SAVE","Save");
// define("_WHOSONLINE","Who's Online");
// define("_ARTICLES","Articles");
// define("_EXTRAINFO","Extra Info");
/*****[BEGIN]******************************************
 [ Base:    Modules                            v.1.0.0]
 ******************************************************/
// define('_MOD_CAT_TITLE','Category Title');
// define('_MOD_CAT_IMG','Category Image Filename');
// define('_MOD_CAT_IMG_NOTE','<strong>NOTE:</strong> Category Images must be placed in <i>images/blocks/modules/</i> folder.');
// define('_MOD_CAT_LINK_TITLE','Link Title');
// define('_MOD_CAT_EDIT','Edit category');
// define('_MOD_INACTIVE','Module is not active<br />(Double click to activate/deactivate)');
// define('_MOD_LINK','Is a link');
// define('_MOD_LINK_DELETE','Delete a link');
// define('_MOD_CAT_DELETE','Delete a category');
// define('_MOD_CAT_ORDER','Change category order');
// define('_MOD_TITLE','TITLE');

// define('_MOD_EXPLAIN','Please note that when you activate or deactivate a module here<br />that it will be instant to users but not to you, until you refresh your screen!');
// define('_MOD_EXPLAIN2','Also you <strong>MUST</strong> hit submit before the category order changes are saved.<br />The changes are not automatically saved!');
// define('_MOD_NF_VALUES','Could Not Get Values');
// define('_MOD_ERROR_TITLE','You must provide a title and link');
// define('_MOD_ERROR_GROUPS','You must select at least 1 group');
// define('_MOD_ERROR_CAT_NF','Category not found');


$admlang['modblock']['delete'] = 'Delete category';
$admlang['modblock']['edit'] = 'Edit category';
$admlang['modblock']['is_inactive'] = 'Module is not active<br />(Double click to activate/deactivate)'; 
$admlang['modblock']['is_link'] = 'Is a link';
$admlang['modblock']['link_delete'] = 'Delete a link';
$admlang['modblock']['link_title'] = 'Link Title';
$admlang['modblock']['link_title_error'] = 'You must provide a title and link';
$admlang['modblock']['not_found'] = 'Category not found';
$admlang['modblock']['no_values'] = 'Could Not Get Values';
$admlang['modblock']['order'] = 'Change category order';

$admlang['modblock']['image'] = 'Category Image Filename';
$admlang['modblock']['image_note'] = '<strong>NOTE:</strong> Category Images must be placed in <i>images/blocks/modules/</i> folder.';
$admlang['modblock']['explain1'] = 'Please note that when you activate or deactivate a module here<br />that it will be instant to users but not to you, until you refresh your screen!';
$admlang['modblock']['explain2'] = 'Also you <strong>MUST</strong> hit submit before the category order changes are saved.<br />The changes are not automatically saved!';


$admlang['modblock']['modedit'] = 'Modules Edit';
$admlang['modblock']['sort_up'] = 'Move Category Up';
$admlang['modblock']['sort_down'] = 'Move Category Down';
/*****[END]********************************************
 [ Base:    Modules                            v.1.0.0]
 ******************************************************/


$admlang['logged_out'] = 'You are now logged out!';
// define("_YOUARELOGGEDOUT","You are now logged out!");
// define("_HOMECONFIG","Home Configuration");
// define("_DESCRIPTION","Description");
// define("_HOMEPAGE","Home Page");
// define("_NAME","Name");
// define("_FROM","From");
// define("_TO","To");



// define("_STAFF","Staff");

$admlang['admin_id'] = 'Admin ID';
// define("_ADMINID","Admin ID");

$admlang['admin_login_header'] = 'Administration System Login';
// define("_ADMINLOGIN","Administration System Login");

$admlang['admin_login_persistent'] = 'Log me on automatically each visit';

$admlang['edit_admins'] = 'Edit Admins';

// define("_ADMINLOGOUT","Logout / Exit");


// define("_CURRENTPOLL","Current Poll");

// define("_TYPE","Type");

$admlang['blocks']['link'] 				= 'Blocks';
$admlang['blocks']['header'] = 'Blocks Administration';
// define("_BLOCKSADMIN","Blocks Administration");

$admlang['blocks']['new'] 				= 'Add a New Block';
// define("_ADDNEWBLOCK","Add a New Block");

$admlang['blocks']['visible'] 			= 'Visible Blocks';
// define("_BLOCKSSHOW","Visible Blocks");
$admlang['blocks']['centerup'] 			= 'Center Up';
$admlang['blocks']['centerdown'] 		= 'Center Down';
$admlang['blocks']['left_block'] 		= 'Left Block';
$admlang['blocks']['right_block'] 		= 'Right Block';
$admlang['blocks']['edit'] 				= 'Edit Block';
$admlang['blocks']['include']			= '(Select a custom Block to be included. All other fields will be ignored)';
$admlang['blocks']['headlines'] 		= '(Only for Headlines)';
$admlang['blocks']['rss_warn'] 			= 'If you fill the URL the content you write will not be displayed!';
$admlang['blocks']['refresh'] 			= 'Refresh Time';
$admlang['blocks']['headlines_setup'] 	= '(Select Custom and write the URL or just select a Site from the list to grab news headlines)';
$admlang['blocks']['create'] 			= 'Create Block';
$admlang['blocks']['save'] 				= 'Save Block';

// //define("_HOUR","Hour");
// define("_UGROUPS", "User Groups");



// define("_BLOCKACTIVATION","Block Activation");
// define("_BLOCKPREVIEW","This is the preview for Block");
// define("_WANT2ACTIVATE","Do you want to Activate this block?");
// define("_ARESUREDELBLOCK","Are you sure you want to remove Block");
// define("_RSSFAIL","There is a problem with the RSS file URL");
// define("_RSSTRYAGAIN","Please check the URL and RSS file name, then try again.");
// define("_RSSCONTENT","(RSS/RDF Content)");

// define("_BLOCKUP","Block UP");
// define("_BLOCKDOWN","Block DOWN");

$admlang['headlines']['header'] = 'Headlines Administration';
// define("_HEADLINESADMIN","Headlines Administration");

$admlang['headlines']['add'] = 'Add Headline';
// define("_ADDHEADLINE","Add Headline");

$admlang['headlines']['edit'] = 'Edit Headlines';
// define("_EDITHEADLINE","Edit Headlines");

$admlang['headlines']['delete_warn'] = 'WARNING: Are you sure you want to delete this Headline?';
// define("_SURE2DELHEADLINE","WARNING: Are you sure you want to delete this Headline?");

// define("_AUTHORSADMIN","Author's Administration");
// define("_AUTHORS_ADMIN_HEADER", "PHP-Nuke Titanium Edit Admins :: Admin Panel");
// define("_AUTHORS_RETURNMAIN", "Return to Main Administration");
// define("_MODIFYINFO","Modify Info");
// define("_DELAUTHOR","Delete Author");
// define("_ADDAUTHOR","Add a New Administrator");
// define("_PERMISSIONS","Permissions");
// define("_USERS","Users");

// define("_SUPERWARNING","WARNING: If Super Admin is checked, the user will get full access! (excludes Edit Admins and Nuke Sentinel)");
// define("_ADDAUTHOR2","Add Author");


// define("_COMPLETEFIELDS","You must complete all compulsory fields");
// define("_CREATIONERROR","Author's Creation Error");
// define("_AUTHORDELSURE","Are you sure you want to delete");

// define("_AUTHORS_EDITINFO","Edit Info");
// define("_AUTHORS_GODADMIN","God Admin?");
// define("_AUTHORS_CHOOSEUSER","Please choose a user");
// define("_AUTHORS_PREVIOUS","<< Previous");
// define("_AUTHORS_NEXT","Next >>");

// define("_AUTHORS_DENIED","Unauthorized editing of authors detected<br /><br />");
// define("_AUTHORS_NOADMINS","No more users left to add as an administrator!");
// define("_AUTHORS_NOTADMIN","The selected user is NOT an administrator. Access denied for editing!<br /><br />");
// define("_AUTHORS_GODACCESS","You do not have permission to edit god admin accounts!<br /><br />");
// define("_AUTHORS_GODEDIT","You cannot edit your own god admin account due to security reasons!<br /><br />");

// define("_PUBLISHEDSTORIES","This administrator has published stories");
// define("_SELECTNEWADMIN","Please select a new admin to re-assign them");




$admlang['authors']['header'] 			= 'Author\'s Administration';
$admlang['authors']['author'] 			= 'Author';
$admlang['authors']['add'] 				= 'Add a New Administrator';
$admlang['authors']['delete'] 			= 'Delete Author';
$admlang['authors']['delete_sure'] 		= 'Are you sure you want to delete';
$admlang['authors']['changes'] 			= '(For Changes Only)';
$admlang['authors']['god'] 				= '* (GOD account can\'t be deleted)';
$admlang['authors']['main'] 			= 'God Admin *';
$admlang['authors']['modify']			= 'Modify Info';
$admlang['authors']['can_not'] 			= 'Can not be changed later.';
$admlang['authors']['option1'] 			= 'Option';
$admlang['authors']['required'] 		= 'Required field';
$admlang['authors']['submit'] 			= 'Add new Author';
$admlang['authors']['superadmin']		= 'Super Admin';
$admlang['authors']['superwarn']		= 'WARNING: If Super Admin is checked, the user will get full access! (excludes Edit Admins and Nuke Sentinel)';


// define("_NOFUNCTIONS","---------");
// define("_PASSWDNOMATCH","Sorry, the new passwords doesn't match. Go Back and Try Again");

$admlang['referers']['header']			= 'PHP-Nuke Titanium HTTP Referers :: Admin Panel';
$admlang['referers']['linking']			= 'Who\'s linking our site?';
$admlang['referers']['delete']			= 'Delete Referers';
$admlang['referers']['date']			= 'Visited Date';
$admlang['referers']['link']			= 'URL of Referer';
$admlang['referers']['none']			= 'There are no %s to display';


$admlang['preferences']['link'] 		= 'Preferences';
$admlang['preferences']['header']		= 'PHP-Nuke Titanium Preferences :: Admin Panel';

$admlang['preferences']['plugins'] 		= 'Plugins';
$admlang['plugins']['header'] 			= 'Custom Plugin Administration';

$admlang['pm_alert']['title'] 			= 'Private Message Popup Alert';
$admlang['pm_alert']['status'] 			= 'Do you wish to activate the Private Message Alert?';
$admlang['pm_alert']['cookie'] 			= 'Cookie Name';
$admlang['pm_alert']['refresh'] 		= 'Minutes between alerts';
$admlang['pm_alert']['refresh_explain']	= '0 = No time between alerts on page refresh<br />5 = Default Setting';
$admlang['pm_alert']['alert'] 			= 'Seconds the user has to wait before been alerted';
$admlang['pm_alert']['alert_explain']	= '0 = Instantly';
$admlang['pm_alert']['sound']			= 'Play Sound';
$admlang['pm_alert']['background']		= 'Background Color Overlay';
$admlang['pm_alert']['color']			= 'Button Color';
$admlang['pm_alert']['hover']			= 'Button Hover Color';


$admlang['viewer']['title']				= 'Image Viewing Script';
$admlang['viewer']['select']			= 'Select the Image Viewer';
$admlang['viewer']['colorbox']			= 'Colorbox';
$admlang['viewer']['fancybox']			= 'Fancybox';
$admlang['viewer']['lightbox']			= 'Lightbox';
$admlang['viewer']['lightboxevo']		= 'Lightbox Evolution';
$admlang['viewer']['lightboxlite']		= 'Lightbox Lite';


$admlang['preferences']['config'] 			= 'Web Site Configuration';
$admlang['preferences']['general'] 			= 'General Site Info';
$admlang['preferences']['language_opts']	= 'Language Options';
$admlang['preferences']['site_logo']		= 'Site Logo';
$admlang['preferences']['site_slogon']		= 'Site Slogan';
$admlang['preferences']['admin_email']		= 'Administrator Email';
$admlang['preferences']['items']			= 'Number of Items in Top Page';
$admlang['preferences']['stories']			= 'Stories Number in Home';
$admlang['preferences']['stories_old']		= 'Stories in Old Articles Box';
$admlang['preferences']['ultra_mode']		= 'Activate Ultramode';
$admlang['preferences']['guests_post'] 		= 'Allow Anonymous to Post';
$admlang['preferences']['locale_format'] 	= 'Locale Time Format';
// define("_LOCALEFORMAT","Locale Time Format");

// define("_DEFAULTTHEME","Default Theme for your site");


// define("_BANNERSOPT","Banners Options");

$admlang['preferences']['start_date']	= 'Site Start Date';
// define("_STARTDATE","Site Start Date");


$admlang['preferences']['footer'] 		= 'Footer Messages';

$admlang['footer']['title'] 			= 'Footer Messages';
$admlang['footer']['line1'] 			= 'Footer Line 1';
$admlang['footer']['line2'] 			= 'Footer Line 2';
$admlang['footer']['line3'] 			= 'Footer Line 3';

$admlang['preferences']['backend'] 		= 'Backend Configuration';
// define("_BACKENDCONF","Backend Configuration");
// define("_BACKENDTITLE","Backend Title");
// define("_BACKENDLANG","Backend Language");
$admlang['backend']['config'] 			= 'Backend Configuration';
$admlang['backend']['title'] 			= 'Backend Title';
$admlang['backend']['language'] 		= 'Backend Language';

$admlang['preferences']['security'] 	= 'Security Options';

$admlang['preferences']['submissions'] 	= 'Submissions';
$admlang['submissions']['notify'] 		= 'Notify new submissions by email?';
$admlang['submissions']['email'] 		= 'Email to send the message';
$admlang['submissions']['subject'] 		= 'Email Subject';
$admlang['submissions']['message'] 		= 'Email Message';
$admlang['submissions']['from'] 		= 'Email Account (From)';

$admlang['preferences']['comment_opts'] = 'Comments Option';
$admlang['comments']['limit'] 			= 'Comments Limit in Bytes';
$admlang['comments']['guest_default'] 	= 'Anonymous Default Name';
$admlang['comments']['no_moderation'] 	= 'No Moderation';
$admlang['comments']['admins'] 			= 'Moderation by Admin';
$admlang['comments']['users'] 			= 'Moderation by Users';

// define("_COMMENTSMOD","Comments Moderation");
// define("_MODTYPE","Type of Moderation");

$admlang['preferences']['graphics'] 	= 'Graphics Options';
$admlang['graphics']['show'] 			= 'Graphics in Administration Menu?';
$admlang['graphics']['position'] 		= 'Admin Position';
$admlang['graphics']['position_opt'] 	= 'Have the admin icons/links';


$admlang['preferences']['misc'] 		= 'Miscellaneous Options';
$admlang['misc']['referers'] 			= 'Activate HTTP Referers?';
$admlang['misc']['referers_max'] 		= 'How Many Referers you want as Maximum?';
$admlang['misc']['poll_comments'] 		= 'Activate Comments in Polls?';
$admlang['misc']['poll_comments_active'] = 'Activate Comments in Articles?';
$admlang['misc']['myheadlines'] 		= 'Activate Headlines Reader?';
$admlang['misc']['ssl_admin'] 			= 'Activate SSL mode for admin?';
$admlang['misc']['ssl_admin_warn'] 		= 'You must have SSL installed on your server';
$admlang['misc']['queries'] 			= 'Count Queries?';
$admlang['misc']['colors'] 				= 'Activate Username and Group Colors';
$admlang['misc']['lock_modules'] 		= 'Force users to login before they can do anything';
$admlang['misc']['banners'] 			= 'Activate Banners in your site?';
$admlang['misc']['textarea'] 			= 'Textarea';
$admlang['misc']['html_bypass'] 		= 'Should God admins be allowed to bypass the HTMLPurifier';
$admlang['misc']['lazy_tap'] 			= 'Lazy Google Tap';
$admlang['misc']['lazy_tap_bots'] 		= 'Bots Only';
$admlang['misc']['lazy_tap_everyone'] 	= 'Everyone';
$admlang['misc']['lazy_tap_admin'] 		= 'Admins and Bots';
// define('_LAZY_TAP_NF','You must have a .htaccess file to use Lazy Google Tap <br />Please see the Lazy Google Tap help file');
// define('_LAZY_TAP_ERROR_OPEN','Could not open .htaccess ');
// define('_LAZY_TAP_ERROR','Your .htaccess is not setup correctly <br />Please see the Lazy Google Tap help file');
$admlang['misc']['image_resize'] 		= 'Image Resize';
$admlang['misc']['image_resize_width'] 	= 'Max Image Width';
$admlang['misc']['image_resize_height'] = 'Max Image Height';
$admlang['misc']['collapse'] 			= 'Collapsible categories?';
$admlang['misc']['analytics'] 			= 'Google Analytics';

// define("_LOCK_MODULES_TITLE","Force Users to Login");
// define("_SIZE","Size");

$admlang['language']['select'] 			= 'Select the Language for your Site';
$admlang['language']['multi'] 			= 'Activate Multilingual features?';
$admlang['language']['use_flags'] 		= 'Display flags instead of a dropdown box?';

$admlang['preferences']['censor'] 		= 'Censor Options';
$admlang['censor']['title'] 			= 'Censor';
$admlang['censor']['words'] 			= 'Words to censor';
$admlang['censor']['settings'] 			= 'Censor settings?';
$admlang['censor']['off'] 				= 'Off';
$admlang['censor']['whole'] 			= 'Whole words';
$admlang['censor']['partial'] 			= 'Partial words';

$admlang['preferences']['meta'] 		= 'Meta Tags';
$admlang['meta']['title'] 				= 'Meta Tags Administration';

$admlang['messages']['link'] 			= 'Messages';
$admlang['messages']['header'] 			= 'PHP-Nuke Titanium Messages :: Admin Panel';
$admlang['messages']['change_date']		= 'Change start date to today';
$admlang['messages']['active']			= '(If you Active this Message now, the start date will be today)';
$admlang['messages']['edit'] 			= 'Edit message';
$admlang['messages']['add'] 			= 'Add message';
$admlang['messages']['all'] 			= 'Overview messages';
$admlang['messages']['view'] 			= 'Visible to';
$admlang['messages']['remove'] 			= 'Are you sure you want to remove this message?';


$admlang['newsletter']['header'] 		= 'PHP-Nuke Titanium Newsletter :: Admin Panel';
$admlang['newsletter']['regards'] 		= 'Best Regards';
$admlang['newsletter']['subscribed'] 	= 'Subscribed Users';
$admlang['newsletter']['nousers'] 		= 'The group selected to receive this newsletter has zero users<br />Please go back and select a different group';
$admlang['newsletter']['will_recieve'] 	= 'Users will receive this Newsletter.';
$admlang['newsletter']['recieved_by'] 	= 'This newsletter will be sent to ';
$admlang['newsletter']['many_users_warn'] = 'WARNING! There are many users that will receive this text. Please wait until the script finishes the operation. This can take several minutes to complete!';
$admlang['newsletter']['unsubscribe'] 	= '=========================================================<br />You\'re receiving this Newsletter because you selected to receive it from your user page at $sitename.<br />You can unsubscribe from this service by clicking in the following URL:<br /><br /><a href=\"$nukeurl/modules.php?name=Your_Account&op=edituser\">$nukeurl/modules.php?name=Your_Account&op=edituser</a><br /><br />then select \"No\" from the option to Receive Newsletter by Email and save your changes, if you need more assistance please contact $sitename administrator.';
$admlang['newsletter']['sent'] 			= 'The Newsletter has been sent.';


$admlang['modules']['link'] 			= 'Modules';
$admlang['modules']['header'] 			= 'PHP-Nuke Titanium Messages :: Admin Panel';
$admlang['modules']['warn'] 			= 'Bold module\'s title represents the module you have in the Homepage.<br />You can\'t Deactivate or Restrict this module while it\'s the default one!<br />If you delete the module\'s directory you\'ll see an error in the Homepage.<br />Also, this module has been replaced with <i>Home</i> link in the modules block.<br /><br />[ <big><strong>&middot;</strong></big> ] means a module which name and link will not be visible in Modules Block';
$admlang['modules']['block'] 			= 'Modules Block EDIT';
$admlang['modules']['inhome'] 			= 'In Home';
$admlang['modules']['inmenu'] 			= 'Visible in Modules Block?';

// define("_MASSMAIL","A Mass e-mail to ALL users");
// define("_ANEWSLETTER","A Newsletter to subscribed users only");
// define("_WHATTODO","What do you want to send?");


// define("_CENSOROPTIONS","Censor Options");
// define("_CENSORMODE","Censor Mode");
// define("_NOFILTERING","No filtering");
// define("_EXACTMATCH","Exact match");
// define("_MATCHBEG","Match word at the beginning");
// define("_MATCHANY","Match anywhere in the text");
// define("_CENSORREPLACE","Replace Censored Words with:");

// define("_PASSWDLEN","Minimum users password length");

// define("_NYOUAREABOUTTOSEND","You're about to send a Newsletter to subscribed users.");


// define("_ADMIN_ACCESS_DENIED", "<h3>Access Denied</h3><br />You do not have administrator rights there for you cannot access this area!");

// define("_BLOCKFILE","(Block File)");


// define("_REVIEWTEXT","Please review and check your text:");
// define("_NAREYOUSURE2SEND","Are you sure to send this Newsletter now?");
// define("_MYOUAREABOUTTOSEND","You're about to send a Mass e-mail to ALL registered users.");
// define("_MUSERWILLRECEIVE","Users will receive this Mail.");



// define("_MAREYOUSURE2SEND","Are you sure to send this Mass Email now?");
// define("_POSSIBLESPAM","Please note that some users may feel disturbed by mass email and may consider this as Spam!");
// define("_MASSEMAIL","Mass Email");


// define("_NEWSLETTERSENT","The Newsletter has been sent.");
// define("_MASSEMAILSENT","Mass Email to all registered users has been sent.");
// define("_MASSEMAILMSG","=========================================================<br />You're receiving this email because you're a registered user of $sitename. We hope that this email didn't disturbed you and in some manner contributes to improve our services.");
// define("_FIXBLOCKS","Fix Block's Weight Conflicts");

// define("_CHANGEMODNAME","Change Module Name");
// define("_CUSTOMMODNAME","Custom Module Name:");

// define("_BLOCKFILE2","FILE");
// define("_BLOCKSYSTEM","SYSTEM");
// define("_DEFHOMEMODULE","Default Homepage Module");
// define("_MODULEINHOME","Module Loaded in the Homepage:");
// define("_CHANGE","Change");

// define("_MODULEHOMENOTE","<strong>-= WARNING =-</strong><br />Bold module's title represents the module you have in the Homepage.<br />You can't Deactivate or Restrict this module while it's the default one!<br />If you delete the module's directory you'll see an error in the Homepage.<br />Also, this module has been replaced with <i>Home</i> link in the modules block.");
// define("_PUTINHOME","Put in Home");
// define("_SURETOCHANGEMOD","Are you sure you want to change your Homepage from");
// define("_CENTERBLOCK","Center Block");
// define("_ADMINISTRATION","Administration");
// define("_NOADMINYET","There are no Administrators Accounts yet, proceed to create the Super User:");
// define("_CREATEUSERDATA","Do you want to create a normal user with the same data?");
// define("_NORMAL","Normal");


// define("_NOTINMENU","[ <big><strong>&middot;</strong></big> ] means a module which name and link will not be visible in Modules Block");


// define("_ALTTEXT","Alternate Text");
// define("_MUSTBEINIMG","must be in /images/ directory. Valid only for AvantGo module");
// define("_USERSOPTIONS","Users Options");
// define("_BROADCASTMSG","Activate Broadcast Messages?");

// define("_USERSHOMENUM","Let users change News number in Home?");


// define("_SECURITYCODE","Security Code");
// define("_TYPESECCODE","Type Security Code Here");
// define("_VALIDIFREG","Valid only if Registered Users are selected above");
// define("_AFTEREXPIRATION","After Expiration");
// define("_SUBUSERS","Subscribed Users");
// define("_SUBVISIBLE","Visible to Subscribers?");
// define("_IMAGESWFURL","Image URL");

$admlang['donations'] 					= 'Donations';
// define("_DONATORS","Donations");
// define("_DEFAULT","Default");

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
// define("_PSM_NOTRATED","Not Rated");
// define("_PSM_CLICK","Click");
// define("_PSM_HERE","here");
// define("_PSM_HELP","for help creating a strong password");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

$admlang['logs']['header'] 				= 'Security Tracker';
$admlang['logs']['not_found'] 			= 'The log could not be found';
$admlang['logs']['is_clear'] 			= 'No Error\'s have been found.';
$admlang['logs']['clear'] 				= 'Clear Log';
$admlang['logs']['cleared'] 			= 'Your Security Tracker has been cleared!';

$admlang['logs']['admin_changed'] 		= 'Admin log %sHAS%s changed';
// define('_ADMIN_LOG_CHANGED','Admin log <strong>HAS</strong> changed');
$admlang['logs']['admin_chmod'] 		= 'Your file is not writeable. Did you do the CHMOD?';
// define('_ADMIN_LOG_CHMOD','Your file is not writeable. Did you do the CHMOD?');
// define('_ADMIN_LOG_ERR','There was a problem checking your log');
$admlang['logs']['admin_fine'] 			= 'Admin log has not changed';
// define('_ADMIN_LOG_FINE','Admin log has not changed');

$admlang['logs']['error_chmod'] 				= 'Your file is not writeable. Did you do the CHMOD?';
// define('_ERROR_LOG_CHMOD','Your file is not writeable. Did you do the CHMOD?');
$admlang['logs']['error_changed'] 			= 'Error log %sHAS%s changed';
// define('_ERROR_LOG_CHANGED','Error log <strong>HAS</strong> changed');
$admlang['logs']['error_fine'] 			= 'Error log has not changed';
// define('_ERROR_LOG_FINE','Error log has not changed');

$admlang['logs']['error'] 				= 'here was a problem checking your log';
// define('_ERROR_LOG_ERR','There was a problem checking your log');
$admlang['logs']['view'] 				= 'View Log';
// define('_VIEWLOG','View Log');

$admlang['global']['active']			= 'Active';
$admlang['global']['activate']			= 'Activate';
$admlang['global']['administrators'] 	= 'Administrators';
$admlang['global']['all'] 				= 'All';
$admlang['global']['all_members'] 		= 'All Members';
$admlang['global']['back']				= 'Go back';
$admlang['global']['both']	 			= 'Both';
$admlang['global']['content']			= 'Content';
$admlang['global']['custom']			= 'Custom';
$admlang['global']['day']				= 'Day';
$admlang['global']['days']				= 'Days';
$admlang['global']['deactivate']		= 'Deactivate';
$admlang['global']['delete']			= 'Delete';
$admlang['global']['disabled']			= 'Disabled';
$admlang['global']['discard']			= 'Discard';
$admlang['global']['down'] 				= 'Down';
$admlang['global']['edit']				= 'Edit';
$admlang['global']['email']				= 'Email';
$admlang['global']['enabled']			= 'Enabled';
$admlang['global']['expiration']		= 'Expiration';
$admlang['global']['filename']			= 'Filename';
$admlang['global']['functions']			= 'Functions';
$admlang['global']['go']				= 'Go';
$admlang['global']['goback']			= 'Go Back';
$admlang['global']['header_return']		= 'Return to Main Administration';
$admlang['global']['header_top_return'] = 'PHP-Nuke Titanium %s :: Modules Admin Panel';
$admlang['global']['home'] 				= 'Home';
$admlang['global']['hour'] 				= 'Hour';
$admlang['global']['hours'] 			= 'Hours';
$admlang['global']['ID'] 				= 'ID';
$admlang['global']['inactive']			= 'Inactive';
$admlang['global']['language'] 			= 'Language';
$admlang['global']['left'] 				= 'Left';
$admlang['global']['login'] 			= 'Login';
$admlang['global']['name']				= 'Name';
$admlang['global']['nickname']			= 'Nickname';
$admlang['global']['no']				= 'No';
$admlang['global']['none'] 				= 'None';
$admlang['global']['not_set'] 			= '%s was not set';
$admlang['global']['password'] 			= 'Password';
$admlang['global']['password_retype']	= 'Retype Password';
$admlang['global']['permissions'] 		= 'Permissions';
$admlang['global']['position'] 			= 'Position';
$admlang['global']['preview'] 			= 'Preview';
$admlang['global']['recipients']		= 'Recipients';
$admlang['global']['right'] 			= 'Right';
$admlang['global']['rss'] 				= 'RSS/RDF file URL';
$admlang['global']['save_changes'] 		= 'Save Changes';
$admlang['global']['send'] 				= 'Send';
$admlang['global']['show'] 				= 'Show';
$admlang['global']['sitename'] 			= 'Site Name';
$admlang['global']['siteurl'] 			= 'Site Url';
$admlang['global']['staff'] 			= 'Staff';
$admlang['global']['subject'] 			= 'Subject';
$admlang['global']['submit'] 			= 'Submit';
$admlang['global']['title'] 			= 'Title';
$admlang['global']['title_custom'] 		= 'Custom Title';
$admlang['global']['unlimited']			= 'Unlimited';
$admlang['global']['up'] 				= 'Up';
$admlang['global']['url'] 				= 'Url';
$admlang['global']['view'] 				= 'View';
$admlang['global']['warning'] 			= 'Warning';
$admlang['global']['yes'] 				= 'Yes';

# Groups selection defines (I grouped these together to make them easier to find in the future)
$admlang['global']['who_view'] 			= 'Who can View This';
$admlang['global']['admins_only']		= 'Administrators Only';
$admlang['global']['users_only'] 		= 'Registered Users Only';
$admlang['global']['guests_only'] 		= 'Anonymous Users Only';
$admlang['global']['all_visitors'] 		= 'All Visitors';
$admlang['global']['groups_only'] 		= 'Groups Only';

$admlang['admin']['administration_header'] 	= '<strong>Administration Menu</strong>';
$admlang['admin']['modules_header'] 	= '<strong>Modules Administration</strong>';

$admlang['admin']['important'] 			= '<strong>Important Information</strong>';
// define('_IMPORTANT_INFO','Important Information');
$admlang['admin']['ip_lock'] 			= 'Admin IP Lock';
// define('_IP_LOCK','Admin IP Lock');
$admlang['admin']['filter'] 			= 'Input Filter';
// define('_INPUT_FILTER','Input Filter');
$admlang['admin']['waiting_users'] 		= 'Waiting Users';

# VERSION CHECKER
$admlang['admin']['version_check_run'] 	= 'Run Now';
// define('_RUNNOW','Run Now');
$admlang['admin']['version_check'] 		= 'PHP-Nuke Titanium Version Checker';
// define('_VERSION_CHECK','Evolution Xtreme Version Checker');
$admlang['admin']['no_rights'] 	= 'Sorry %s but you have been given no administration rights. Please contact the site administrator if you feel this is a mistake!';
// define("_NO_ADMIN_RIGHTS","Sorry %s but you have been given no administration rights. Please contact the site administrator if you feel this is a mistake!");

$admlang['authors']['header'] 			= 'Author\'s Administration';
$admlang['authors']['author'] 			= 'Author';
$admlang['authors']['add'] 				= 'Add a New Administrator';
$admlang['authors']['delete'] 			= 'Delete Author';
$admlang['authors']['changes'] 			= '(For Changes Only)';
$admlang['authors']['god'] 				= '* (GOD account can\'t be deleted)';
$admlang['authors']['main'] 			= 'God Admin *';
$admlang['authors']['modify']			= 'Modify Info';
$admlang['authors']['can_not'] 			= 'Can not be changed later.';
$admlang['authors']['option1'] 			= 'Option';
$admlang['authors']['required'] 		= 'Required field';
$admlang['authors']['submit'] 			= 'Add new Author';
$admlang['authors']['superadmin']		= 'Super Admin';
$admlang['authors']['superwarn']		= 'WARNING: If Super Admin is checked, the user will get full access! (excludes Edit Admins and Nuke Sentinel)';

/**
 * Mod: Live feed (Live news directly from Evolution Xtreme project site.)
 * @since 2.0.9e
 */
$admlang['livefeed']['header'] 				= '<strong>Live Feed from The 86it Developers Hub</strong>';

/**
 * Mod: reCaptcha (Complete replacement for the GD2 captcha system.)
 * @since 2.0.9e
 */
$admlang['reCaptcha']['options'] 				= 'reCaptcha Options';
$admlang['reCaptcha']['check'] 					= 'Use reCaptcha';
$admlang['reCaptcha']['no_checking'] 			= 'No Checking';
$admlang['reCaptcha']['admin_login_only'] 		= 'Administrator login only';
$admlang['reCaptcha']['user_login_only'] 		= 'Users login Only';
$admlang['reCaptcha']['user_reg_only'] 			= 'New Users registration Only';
$admlang['reCaptcha']['both'] 					= 'Both, users login and new users registration only';
$admlang['reCaptcha']['admin_and_user_login'] 	= 'Administrators and users login only';
$admlang['reCaptcha']['admin_and_new_users'] 	= 'Administrators and new users registration only';
$admlang['reCaptcha']['everywhere'] 			= 'Everywhere on all login options (Admins and Users)';
$admlang['reCaptcha']['api_warn'] 				= 'The API must be submitted before you can configure the options for reCaptcha';

$admlang['reCaptcha']['reCaptcha'] 				= 'Recaptcha Security Check';
$admlang['reCaptcha']['whiteskin'] 				= 'White';
$admlang['reCaptcha']['darkskin'] 				= 'Dark';
$admlang['reCaptcha']['language'] 				= 'Recaptcha Language:';
$admlang['reCaptcha']['language_explain'] 		= '<strong>*</strong> <a href=\'https://developers.google.com/recaptcha/docs/language\' target=\'_blank\'>CLICK HERE</a> to find the proper valuse for the language you want to be used.';
$admlang['reCaptcha']['site_key_explain'] 		= '<strong>INFO:</strong> <a href=\'http://www.google.com/recaptcha/admin\' target=\'_blank\'>CLICK HERE</a> to signup and get your key needed for recaptcha.';
$admlang['reCaptcha']['site_key'] 				= 'Recaptcha Site Key:';
$admlang['reCaptcha']['secret_key'] 			= 'Recaptcha Secret Key:';

/**
 * Mod: IPHUB (Allows the blocking of VPN/PROXY Servers.)
 * @since 2.0.9e
 */
$admlang['iphub']['title'] 					= 'IpHub VPN/PROXY/SERVER Block';
$admlang['iphub']['status'] 				= 'User IpHub Blocking:';
$admlang['iphub']['status_explain'] 		= 'This system will block users from coming to your site using a VPN/Proxy/Server. False positives do happen and if your user is blocked, then need to contact IpHub to have them unblocked.';
$admlang['iphub']['key'] 					= 'IpHub API Key';
$admlang['iphub']['key_explain'] 			= '<strong>INFO:</strong> <a href=\'https://iphub.info\' target=\'_blank\'>CLICK HERE</a> to signup and get your key.';
$admlang['iphub']['api_warn'] 				= 'The API must be submitted before you can configure the options for '.$admlang['iphub']['title'].'';

// $lang['Date_format_explain'] = 'The syntax used is identical to the PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a> function.';

// $admlang['iphub']['add_explain'] 			= '<strong>Additional Note:</strong> There are paid and a free plan available.<br />If your site is high traffic, you may need ot look into a paid plan.';
$admlang['iphub']['add_explain'] 			= '<strong>Additional Note:</strong> There are paid and a free plan available.<br />If you use the free API key, You will be restricted to 1000 queries a day.<br />If your site is high traffic, you may need to look into a paid plan.';
$admlang['iphub']['cookie'] 				= 'IpHub Cookie Time: (in min)';
$admlang['iphub']['cookie_explain'] 		= 'This here is how long the cookie will last before the system will recheck their IP. (Designed to reduce calls to IPHUB, especially if your using the free plan.';

/**
 * Mod: Admin failed login checker. (Tracks the amount of times an admin fails to login.)
 * @since 2.0.9e
 */
$admlang['adminfail']['you_have'] 				= 'You have';
$admlang['adminfail']['attempts'] 				= 'attempt(s) left until you will have a cooldown for';
$admlang['adminfail']['less_than'] 				= 'less than 1';
$admlang['adminfail']['min'] 					= 'min(s).';
$admlang['adminfail']['cooldown'] 				= 'You can attempt to login once again in';
$admlang['adminfail']['title'] 					= 'Admin Login Fail Checker';
$admlang['adminfail']['status'] 				= 'Use Admin Login Fail Checker';
$admlang['adminfail']['status_explain'] 		= 'This system will limit how many time they can fail at logging in as admin beofre they need to take a cooldown break';
$admlang['adminfail']['max_attempts'] 			= 'Max Fail Attempts';
$admlang['adminfail']['max_attempts_explain'] 	= 'How many times can they fail before being blocked.';
$admlang['adminfail']['timeout'] 				= 'Cooldown Time, (min)';
$admlang['adminfail']['timeout_explain'] 		= 'How long should they be blocked for.';


?>