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
/* Based on Journey Links Hack                          */
/* Copyright (c) 2000 by James Knickelbein              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)  */
/********************************************************/
if (!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
$module_name = basename(dirname(__FILE__));
require_once 'mainfile.php';
get_lang($module_name);
/*
 * The following line is important and drives certain behaviour for that release (more secure).
 * The below RAVENNUKE_VERSION define was added by montego for the 2.20.00 release of RavenNuke(tm).
 * Do not try and fake your *nuke version to "act" like RavenNuke(tm) as you may end up lessening
 * your site's security in the process unless you REALLY KNOWN WHAT YOU ARE DOING.
 */
if (defined('RAVENNUKE_VERSION')) define('IN_RAVENNUKE', true); else define('IN_RAVENNUKE', false);
/*
 * For TegoNuke(tm) Mailer integration, need to stub this out in case the latest Mailer is not
 * installed.  Need to force the installation of the latest Mailer for if you're not using it
 * you will be unable to use it with this version of the TegoNuke(tm) Downloads module.
 */
if (!defined('TNML_IS_ACTIVE')) define('TNML_IS_ACTIVE', false);
/*
 * If nukeWYSIWYG is installed and enabled, we'll use it.  The following constant is for that purpose
 */
if (!defined('NUKEWYSIWYG_ACTIVE')) {
	if (function_exists('wysiwyg_textarea') && isset($advanced_editor) && 1 == $advanced_editor) {
		define('NUKEWYSIWYG_ACTIVE', true);
	} else {
		define('NUKEWYSIWYG_ACTIVE', false);
	}
}
/*
 * Settings for showing right blocks or not (default is to show)
 * In order to accomodate older legacy themes, both methods are used.
 * To not show right blocks do this:
 * 1. Change $index value to 0
 * 2. Remove or comment out the 'define' line (in newer RavenNuke(tm) themes)
 *    you may also be able to just change from 'true' to 'false'.
 */
$index = 1;
define('INDEX_FILE', true);
/*
 * Start of main processing
 */
if (!isset($op)) $op = '';
switch ($op) {
	/*
	 * This is the main/default code which displays the initial category selection form.
	 */
	default:
		$pagetitle = _DL_DOWNLOADS . ': ' . _DL_ADDADOWNLOAD;
		include_once 'header.php';
		OpenTable();
		title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
		OpenTable2();
		echo '<p class="option">' . _DL_INSTRUCTIONS . ':</p><ul>';
		echo '<li> ' . _DL_DSUBMITONCE . '</li>';
		echo '<li> ' . _DL_DPOSTPENDING . '</li>';
		echo '<li> ' . _DL_USERANDIP . '</li>';
		echo '</ul>';
		CloseTable2();
        echo '<br />';
		OpenTable2();
		echo '<form method="post" action="modules.php?name=' . $module_name . '">';
		echo '<input type="hidden" name="op" value="Input" />';
		echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
		$sql = 'SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `active` > 0 AND `parentid` = 0 ORDER BY `title`';
		$result2 = $db->sql_query($sql);
		$numrow = $db->sql_numrows($result2);

		if ($numrow == 0) {
			echo '<tr><td align="center" colspan="2"><strong>' . _DL_NOCATEGORY . ':</strong></td></tr>';
		} else {
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_CATEGORY . ':</strong></td><td><select name="cat">';
			while ($cidinfo = $db->sql_fetchrow($result2)) {
				$crawled = array($cidinfo['cid']);
				CrawlLevel($cidinfo['cid']);
				$x = 0;
				while ($x <= (sizeof($crawled) - 1)) {
					$sql = 'SELECT `title`, `parentid`, `whoadd` FROM `' . $prefix
						. '_nsngd_categories` WHERE `cid` = \'' . $crawled[$x] . '\'';
					list($title, $parentid, $whoadd) = $db->sql_fetchrow($db->sql_query($sql));
					if ($x > 0) {
						$title = getparent($parentid, $title);
					}
					$priv = $whoadd - 2;
					if ($whoadd == 0 OR ($whoadd == 1 AND (is_user($user) OR is_admin($admin))) OR ($whoadd == 2 AND is_admin($admin)) OR ($whoadd > 2 AND of_group($priv))) {
						echo '<option value="' . $crawled[$x] . '">' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</option>';
					}
					$x++;
				}
			}
			echo '</select></td></tr>';
			echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_GONEXT . '" /></td></tr>';
		}
		echo '</table>';
		echo '</form>';
		CloseTable2();

		CloseTable();
		include_once 'footer.php';
		break;
	/*
	 * Now get all the relevant Download information and file to upload if so configured.
	 */
	case 'Input':
		$pagetitle = _DL_DOWNLOADS . ': ' . _DL_ADDADOWNLOAD;
		include_once 'header.php';
		OpenTable();
		title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
		$cat = (isset($cat)) ? intval($cat) : 0;
		$cidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $cat));
		OpenTable2();
		if (isset($cidinfo['whoadd'])) $priv = $cidinfo['whoadd'] - 2;
		/*
		 * Check if for the permissions to the category
		 * -1 = No permissions
		 *  0 = Anonymous
		 *  1 = Registered User
		 *  2 = Administrator only
		 * >2 = Various NSN Groups if so configured
		 */
		if (isset($cidinfo['whoadd']) AND ($cidinfo['whoadd'] == 0 OR ($cidinfo['whoadd'] == 1 AND (is_user($user) OR is_admin($admin))) OR ($cidinfo['whoadd'] == 2 AND is_admin($admin)) OR ($cidinfo['whoadd'] > 2 AND of_group($priv)))) {
			/*
			 * Check to see that uploads are allowed for the selected category.
			 * If so, the form enctype must be set to "multipart".  Otherwise, just
			 * a standard form is used to collect the download details.
			 */
			if ($cidinfo['canupload'] > 0) {
				echo '<form method="post" action="modules.php?name=' . $module_name . '" enctype="multipart/form-data">';
			} else {
				echo '<form method="post" action="modules.php?name=' . $module_name . '">';
			}
			echo '<input type="hidden" name="op" value="Add" />';
			echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_TITLE . ':</strong></td><td><input type="text" name="title" size="50" maxlength="100" /></td></tr>';
			$limitedext = '';
			if ($cidinfo['canupload'] == 1) {
				/*
				 * Since can upload, let us display the configured list of acceptable extensions.
				 */
				$result = $db->sql_query('SELECT `ext` FROM `' . $prefix . '_nsngd_extensions`');
				while (list($exten) = $db->sql_fetchrow($result)) {
					if ($limitedext == '') {
						$limitedext = $exten;
					} else {
						$limitedext = $limitedext . ', ' . $exten;
					}
				}
				echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_ALWEXT . ':</strong></td><td>' . $limitedext . '</td></tr>';
				echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_URL . ':</strong></td><td><input type="file" name="url" size="50" /></td></tr>';
				echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong><a href="modules.php?name=' . $module_name
					. '&amp;op=TermsUseUp" onclick="window.open(this.href,\'TermsofUseUp\');return false;">' . _DL_TOU . '</a>:</strong></td>';
				echo '<td><input type="radio" name="tou" value="1" />' . _YES . ' &nbsp; <input type="radio" name="tou" value="0" checked="checked" />' . _NO . '</td></tr>';
			} else {
				echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_URL . ':</strong></td><td><input type="text" name="url" size="50" /></td></tr>';
				echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong><a href="modules.php?name=' . $module_name
					. '&amp;op=TermsUse" onclick="window.open(this.href,\'TermsofUse\');return false;">' . _DL_TOU . '</a>:</strong></td>';
				echo '<td><input type="radio" name="tou" value="1" />' . _YES . ' &nbsp; <input type="radio" name="tou" value="0" checked="checked" />' . _NO . '</td></tr>';
			}
			$title = getparent($cidinfo['parentid'], $cidinfo['title']);
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_CATEGORY . ':</strong></td><td>' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . '</td></tr>';
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '" valign="top"><strong>' . _DL_DESCRIPTION . ':</strong></td><td><div>';
			if (NUKEWYSIWYG_ACTIVE) {
				wysiwyg_textarea('description', '', 'NukeUser', '50', '12');
			} else {
				Make_Textarea('description', '', 'NukeUser', '', '');
				//echo '<textarea name="description" cols="50" rows="12"></textarea>';
			}
			echo '</div></td></tr>';
			$usrinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $user_prefix . '_users` WHERE `user_id` = \'' . $cookie[0] . '\''));
			if ($usrinfo['user_website'] == 'http://') {
				$usrinfo['user_website'] = '';
			}
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_AUTHORNAME . ':</strong></td><td><input type="text" name="auth_name" size="50" maxlength="60" value="' . $usrinfo['username'] . '" /></td></tr>';
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_AUTHOREMAIL . ':</strong></td><td><input type="text" name="email" size="50" maxlength="100" value="' . $usrinfo['user_email'] . '" /></td></tr>';
			if ($cidinfo['canupload'] == 0) {
				echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_FILESIZE . ':</strong></td><td><input type="text" name="filesize" size="20" maxlength="20" /> (' . _DL_INBYTES . ')</td></tr>';
			}
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_VERSION . ':</strong></td><td><input type="text" name="version" size="20" maxlength="20" /></td></tr>';
			echo '<tr><td align="right" bgcolor="' . $bgcolor2 . '"><strong>' . _DL_HOMEPAGE . ':</strong></td><td><input type="text" name="homepage" size="50" maxlength="255" value="' . $usrinfo['user_website'] . '" /></td></tr>';
			echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_ADDTHISFILE . '" /></td></tr>';
			echo '</table>';
			echo '<input type="hidden" name="cat" value="' . $cat . '" />';
			echo '<input type="hidden" name="submitter" value="' . $usrinfo['username'] . '" />';
			echo '</form>';
		} else {
			echo '<div align="center"><p class="title">' . _DL_CANTADD . '</p></div>';
		}
		CloseTable2();
		CloseTable();
		include_once 'footer.php';
		break;
	/*
	 * Now actually add the new download to the New downloads table for review by an admin.
	 */
	case 'Add':
		csrf_check();
		$pagetitle = _DL_DOWNLOADS . ': ' . _DL_ADDADOWNLOAD;
		$tou = (isset($tou)) ? intval($tou) : 0;
		if (empty($title)) {
			include_once 'header.php';
			OpenTable();
			title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
			OpenTable2();
			echo '<div align="center"><p class="title">' . _DL_DOWNLOADNOTITLE . '</p>';
			echo '<p>' . _GOBACK . '</p></div>';
			CloseTable2();
			CloseTable();
			include_once 'footer.php';
			die();
		}
		if (empty($description)) {
			include_once 'header.php';
			OpenTable();
			title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
			OpenTable2();
			echo '<div align="center"><p class="title">' . _DL_DOWNLOADNODESC . '</p>';
			echo '<p>' . _GOBACK . '</p></div>';
			CloseTable2();
			CloseTable();
			include_once 'footer.php';
			die();
		}
		if ($tou > 0) {
			$cat = (isset($cat)) ? intval($cat) : 0;
			$cidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . $cat));
			if (isset($cidinfo['whoadd'])) $priv = $cidinfo['whoadd'] - 2;
			// Make sure the "user" is allowed to submit a download for the chosen category
			if (isset($cidinfo['whoadd']) AND ($cidinfo['whoadd'] == 0 OR ($cidinfo['whoadd'] == 1 AND (is_user($user) OR is_admin($admin))) OR ($cidinfo['whoadd'] == 2 AND is_admin($admin)) OR ($cidinfo['whoadd'] > 2 AND of_group($priv)))) {
				/*
				 * Upfront data cleansing in preparation for field validation
				 */
				$title = (isset($title)) ? substr(gdFilter($title, 'nohtml'), 0, 100) : '';
				$description = (isset($description)) ? gdFilter($description, '') : '';
				$auth_name = (isset($auth_name)) ? substr(gdFilter($auth_name, 'nohtml'), 0, 100) : '';
				$submitter = (isset($submitter) || !empty($submitter)) ? substr(gdFilter($submitter, 'nohtml'), 0, 40) : substr($auth_name, 0, 40);
				$email = (isset($email)) ? substr(gdFilter($email, 'nohtml'), 0, 100) : '';
				$filesize = (isset($filesize)) ? gdFilter($filesize, 'nohtml') : 0;
				$version = (isset($version)) ? substr(gdFilter($version, 'nohtml'), 0, 20) : '';
				$homepage = (isset($homepage)) ? substr(gdFilter($homepage, 'nohtml'), 0, 255) : '';
				/*
				 * Perform validations
				 */
				if ($cidinfo['canupload'] > 0) {
					// Got rid of a bunch of unnecessary SQL calls here...
					// Check to make sure only 1 file was selected for upload
					if (count($_FILES) == 1) {
						$url_name = substr(gdFilter($_FILES['url']['name'], 'nohtml'), 0, 255);
						$url_temp = substr(gdFilter($_FILES['url']['tmp_name'], 'nohtml'), 0, 255);
					} else {
						$url_name = '';
					}
					/*
					 * Do some name/path and extension validation that wasn't here originally.
					 * First grab out the extension and make sure it is of a valid format and then
					 * go test it against the database of valid configured extensions.
					 */
					$urlmatches = array();
					if (preg_match('/\.([^\.]+)$/', $url_name, $urlmatches)) {
						$ext = strtolower($urlmatches[1]); // Force extension to lower-case per issue# 0000057
						if (preg_match('/[a-z0-9]/', $ext)) {
							// Valid extension format so now check against the database
							$sql = 'SELECT `ext` FROM `' . $prefix . '_nsngd_extensions` WHERE `ext` = \'.' . addslashes($ext) . '\'';
							if ($db->sql_numrows($db->sql_query($sql)) < 1) $ext = null; // Not found? Null out the extension so will fail the check
						} else {
							// Not valid so null it out so will fail the valid extension check
							$ext = null;
						}
					} else {
						$ext = null;
					}
					if (null === $ext) {
						include_once 'header.php';
						OpenTable();
						title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
						OpenTable2();
						echo '<div align="center"><p class="title">' . _DL_BADEXT . '</p>';
						echo '<p>' . _GOBACK . '</p></div>';
						CloseTable2();
						CloseTable();
						include_once 'footer.php';
						die();
					} elseif (file_exists($cidinfo['uploaddir'] . '/' . $url_name)) {
						include_once 'header.php';
						OpenTable();
						title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
						OpenTable2();
						echo '<div align="center"><p class="title">' . _DL_FILEEXIST . '</p>';
						echo '<p>' . _GOBACK . '</p></div>';
						CloseTable2();
						CloseTable();
						include_once 'footer.php';
						die();
					} elseif (move_uploaded_file($url_temp, $cidinfo['uploaddir'] . '/' . $url_name)) {
						chmod($cidinfo['uploaddir'] . '/' . $url_name, 0644);
						$url = $cidinfo['uploaddir'] . '/' . $url_name;
						$filesize = sprintf('%u', filesize($url));
					} else {
						include_once 'header.php';
						OpenTable();
						title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
						OpenTable2();
						echo '<div align="center"><p class="title">' . _DL_NOUPLOAD . '</p>';
						echo '<p>' . _GOBACK . '</p></div>';
						CloseTable2();
						CloseTable();
						include_once 'footer.php';
						die();
					}
				} else {
					$url = (isset($url)) ? substr(gdFilter($url, 'nohtml'), 0, 255) : null;
					if (empty($url) || !preg_match('#^(http(s?))://#i', $url)) {
						include_once 'header.php';
						OpenTable();
						title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
						OpenTable2();
						echo '<div align="center"><p class="title">' . _DL_DOWNLOADNOURL . '</p>';
						echo '<p>' . _GOBACK . '</p></div>';
						CloseTable2();
						CloseTable();
						include_once 'footer.php';
						die();
					}
				}
				/*
				 * Have passed all the required validations so continue with the submittal
				 */
				$filesize = preg_replace('/[,]/', '', $filesize);
				$filesize = intval($filesize);
				/*
				 * Get the submitter's IP address if we can
				 */
				$sub_ip = gdGetIP();
				/*
				 * If we're in RavenNuke(tm), we can validate the email address (simple form, not fully RFC compliant)
				 */
				$email = (isset($email)) ? substr(gdFilter($email, 'nohtml'), 0, 100) : '';
				if (function_exists('validate_email') && false === validate_email($email)) $email = '';
				/*
				 * Ready to insert the new submission.
				 */
				$sql = 'INSERT INTO `' . $prefix . '_nsngd_new` VALUES (NULL, ' . $cat . ', 0, \'' . addslashes($title)
					. '\', \'' . addslashes($url) . '\', \'' . addslashes($description) . '\', now(), \''
					. addslashes($auth_name) . '\', \'' . addslashes($email) . '\', \'' . addslashes($submitter)
					. '\', \'' . addslashes($sub_ip) . '\', ' . addslashes($filesize) . ', \'' . addslashes($version)
					. '\', \'' . addslashes($homepage) . '\')';
				$db->sql_query($sql);
				include_once 'header.php';
				OpenTable();
				title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
				OpenTable2();
				echo '<div align="center"><p class="title">' . _DL_DOWNLOADRECEIVED . '</p>';
				if ($email != '') {
					echo '<p>' . _DL_EMAILWHENADD . '</p></div>';
				} else {
					echo '<p>' . _DL_CHECKFORIT . '</p></div>';
				}
				CloseTable2();
				CloseTable();
				$msg = $sitename . ' ' . _DL_DOWSUB . "\n\n";
				$msg .= _DL_TITLE . ': ' . $title . "\n\n";
				$msg .= _DL_URL . ': ' . $url . "\n\n";
				$msg .= _DL_DESCRIPTION . ': ' . $description . "\n\n";
				$msg .= _DL_HOMEPAGE . ': ' . $homepage . "\n\n";
				$msg .= _DL_SUBIP . ': ' . $sub_ip . "\n\n";
				$to = $adminmail;
				$subject = $sitename . ' - ' . _DL_DOWSUBREC;
				if ($email == '') {
					$email = $adminmail;
					$auth_name = $sitename;
					$mailheaders = "From: $email <$auth_name>\r\n";
				}
				$mailheaders = 'Content-Type: text/plain; charset=' . _CHARSET . "\r\n";
				$mailheaders .= "From: $email <$auth_name>\r\nReply-To: $email\r\nReturn-Path: $email\r\n";
				/*
				 * Incorporate TegoNuke(tm) Mailer - although $mailsuccess isn't checked, it is here in case its needed in the future
				 */
				$mailsuccess = false;
				if (TNML_IS_ACTIVE) {
					$mailsuccess = tnml_fMailer($to, $subject, $msg, $email, $auth_name);
				} else {
					$mailsuccess = mail($to, $subject, $msg, $mailheaders);
				}
				include_once 'footer.php';
			} else {
				include_once 'header.php';
				OpenTable();
				title('<h1>'._DL_ADDADOWNLOAD.'</h1>');
				OpenTable2();
				echo '<div align="center"><p class="title">' . _DL_CANTADD . '</p></div>';
				CloseTable2();
				CloseTable();
				include_once 'footer.php';
			}
		} else {
			include_once 'header.php';
			OpenTable();
			title('<h1>'._DL_ADDADOWNLOAD.'<h1>');
			OpenTable2();
			echo '<div align="center"><p class="title">' . _DL_TOUMUST . '</p>';
			echo '<p>' . _GOBACK . '</p></div>';
			CloseTable2();
			CloseTable();
			include_once 'footer.php';
		}
		break;
	/*
	 * Present the Terms of Use for uploading a file.
	 */
	case 'TermsUseUp':
		echo '<html>';
		echo '<head><title>' . _DL_TOU . '</title></head>';
		echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">';
		echo '<span class="underline">' . _DL_DUSAGEUP1 . '</span><br /><br />';
		echo 'i) ' . _DL_DUSAGEUP2 . '<br /><br />';
		echo 'ii) ' . _DL_DUSAGEUP3 . '<br /><br />';
		echo 'iii) ' . _DL_DUSAGEUP4 . '<br /><br />';
		echo 'iv) ' . _DL_DUSAGEUP5 . '<br /><br />';
		echo 'v) ' . _DL_DUSAGEUP6 . '<br /><br />';
		echo '</body>';
		echo '</html>';
		break;
	/*
	 * Present the Terms of Use for just a submittal of a new download.
	 */
	case 'TermsUse':
		echo '<html>';
		echo '<head><title>' . _DL_TOU . '</title></head>';
		echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">';
		echo '<span class="underline">' . _DL_DUSAGE1 . '</span><br /><br />';
		echo 'i) ' . _DL_DUSAGE2 . '<br /><br />';
		echo 'ii) ' . _DL_DUSAGE3 . '<br /><br />';
		echo 'iii) ' . _DL_DUSAGE4 . '<br /><br />';
		echo 'iv) ' . _DL_DUSAGE5 . '<br /><br />';
		echo '</body>';
		echo '</html>';
		break;
}
die();
/*
 * @todo: Would be much cleaner to replace all this Crawlevel/parent code with some form of TreeStore class.
 * @todo: This class could also be re-used in MANY places with *nuke and add-ons.
 * @todo: All the crawl code is extremely inefficient from a DB access/query standpoint.
 */
/**
 * Function: getparent
 *
 * Obtains the category title of the parent of a given category.
 *
 * @param integer $parentid is the category id of the parent that is used to retrieve its title
 * @param string $title is the category title for the current "child"
 * @returns string of the parent title appended with the current passed in title
 */
function getparent($parentid, $title) {
	global $prefix, $db;
	$cidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_categories` WHERE `cid` = ' . (int)$parentid));
	if ($cidinfo['title'] != '') $title = $cidinfo['title'] . ' -> ' . $title;
	if ($cidinfo['parentid'] != 0) {
		$title = getparent($cidinfo['parentid'], $title);
	}
	return $title;
}
/**
 * Function: CrawLevel
 *
 * Searches down the category "tree" looking for children to add to its crawl list.
 *
 * @param integer $cid is the category ID to go look for more children from
 * @returns array of more categories to retrieve.
 */
function CrawlLevel($cid) {
	global $prefix, $db, $crawled;
	$bresult = $db->sql_query('SELECT `cid` FROM `' . $prefix . '_nsngd_categories` WHERE `active` > 0 AND `parentid` = ' . (int)$cid . ' ORDER BY `title`');
	while (list($cid2) = $db->sql_fetchrow($bresult)) {
		array_push($crawled, $cid2);
		CrawlLevel($cid2);
	}
	return $crawled;
}
/**
 * Function: of_group
 *
 * Determines if the logged in user is a member of the group that is passed in.
 *
 * @param integer $gid is the ID of the group to check the user against
 * @returns boolean where "true" = the user is an active member of the group and "false" otherwise
 */
function of_group($gid) {
    global $prefix, $db, $userinfo, $module_name;
    if (is_mod_admin($module_name)) {
        return 1;
    } elseif (is_user()) {
        $guid = (int)$cookie[0];
        $currdate = time();
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_bbuser_group WHERE group_id='".$gid."' AND user_id='$guid' AND user_pending != '1'");
        list($ingroup) = $db->sql_fetchrow($result);
        if ($ingroup > 0) { return 1; }
    }
    return 0;
}
/**
 * Function: gdFilter
 *
 * This function was added to bridge a temporary gap between PHP-Nuke and the newer and much
 * more secure RavenNuke(tm) systems.  The old PHP-Nuke check_html() function, even with
 * patches from Chatserv, do not sufficiently handle magic quotes being turned on.
 *
 * @param string $value is the string value to validate
 * @param string $strip is either 'nohtml' to strip all HTML, or '' to apply the AllowableHTML[] array checks
 * @returns string cleansed input string
 */
function gdFilter($value = '', $strip = '') {
	if (empty($value) || ('' != $strip && 'nohtml' != $strip)) return '';
	static $doStrip;
	if (!isset($doStrip)) {
		$doStrip = (IN_RAVENNUKE && get_magic_quotes_gpc() == 1) ? true : false;
	}
	if ($doStrip) $value = stripslashes($value);
	if (IN_RAVENNUKE) {
		// RavenNuke(tm)'s check_html() function uses kses, which normalizes certain entities.  We
		// don't want these to be saved to the database.  We'll handle them properly upon output.
		return htmlspecialchars_decode(check_html($value, $strip));
	} else {
		// Regular PHP-Nuke with Chatserv patches does not normalize entities, so we don't have to decode.
		return check_html($value, $strip);
	}
}
/**
 * csrf_check
 * This is simply a stub function for CSRF checking to be consistent across the module.
 * RavenNuke(tm) version 2.4 and above have this as a feature that we wish to take full
 * advantage of, but need the stub for compatibility with other *nuke variants.
 */
if (!function_exists('csrf_check')) {
	function csrf_check() {
		return true;
	}
}
/**
 * gdGetIP
 * Returns back as best a remote client IP address as possible and sanitized (at least to IP4)
 *
 * @return string the IP or '' if one could not be properly returned and sanitized
 * @todo Really need to have a more flexible IP4/IP6 function... will look for next release (RN needs one too!)
 */
function gdGetIP() {
	if (defined('NUKESENTINEL_IS_LOADED')) {
		global $nsnst_const;
		$sub_ip = (isset($nsnst_const['remote_ip'])) ? $nsnst_const['remote_ip'] : 'none';
	} else {
		if (getenv('HTTP_CLIENT_IP')) $sub_ip = getenv('HTTP_CLIENT_IP');
		elseif (getenv('HTTP_X_FORWARDED_FOR')) $sub_ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_X_FORWARDED')) $sub_ip = getenv('HTTP_X_FORWARDED');
		elseif (getenv('HTTP_FORWARDED_FOR')) $sub_ip = getenv('HTTP_FORWARDED_FOR');
		elseif (getenv('HTTP_FORWARDED')) $sub_ip = getenv('HTTP_FORWARDED');
		else $sub_ip = getenv('REMOTE_ADDR');
	}
	if (function_exists('validIP')) {
		if (!validIP($sub_ip)) $sub_ip = '';
	} else {
		$regex = '/^(1?\d{1,2}|2([0-4]\d|5[0-5]))(\.(1?\d{1,2}|2([0-4]\d|5[0-5]))){3}$/'; // IP4 only!
		$sub_ip = (preg_match($regex, $ip)) ? $sub_ip : '';
	}
	return $sub_ip;
}


