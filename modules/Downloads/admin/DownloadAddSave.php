<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$pagetitle = _DL_DOWNLOADSADMIN;

/*
 * Validate / Cleanse user input
 */
$cat = (isset($cat)) ? intval($cat) : 0;
$perm = (isset($perm)) ? intval($perm) : 2; // Just in case, default to Administrator only permissions
$title = (isset($title)) ? substr(gdFilter($title, 'nohtml'), 0, 100) : '';
$url = (isset($url)) ? substr(gdFilter($url, 'nohtml'), 0, 255) : null;
$description = (isset($description)) ? gdFilter($description, '') : '';
$sname = (isset($sname)) ? substr(gdFilter($sname, 'nohtml'), 0, 100) : '';
$hits = (isset($hits)) ? intval($hits) : 0;
$submitter = (isset($submitter) || !empty($submitter)) ? substr(gdFilter($submitter, 'nohtml'), 0, 40) : substr($sname, 0, 40);
$version = (isset($version)) ? substr(gdFilter($version, 'nohtml'), 0, 20) : '';
$homepage = (isset($homepage)) ? substr(gdFilter($homepage, 'nohtml'), 0, 255) : '';

/*
 * @todo Following code to ensure only an integer filesize survives needs to be locale aware due to differences in 1000's separators
 */
$filesize = (isset($filesize)) ? gdFilter($filesize, 'nohtml') : 0;
$filesize = preg_replace('/[,]/', '', $filesize);
$filesize = intval($filesize);

/*
 * If we're in RavenNuke(tm), we can validate the email address (simple form, not fully RFC compliant)
 * Also get the submitter's IP
 */
$email = (isset($email)) ? substr(gdFilter($email, 'nohtml'), 0, 100) : '';
if (function_exists('validate_email') && false === validate_email($email)) $email = '';
$sub_ip = gdGetIP();

/*
 * Validate that required fields were entered: title, url, and description
 */
if (empty($title) || empty($url) || empty($description)) 
{
	include_once 'header.php';
	OpenTable();
	title('<h1>'.$pagetitle.'</h1>');
	DLadminmain();
	echo '<br />';
	OpenTable4();
	echo '<div align="center" class="title">';
	if (empty($title)) echo '<p>', _DL_ERRORNOTITLE, '</p>';
	if (empty($url)) echo '<p>', _DL_ERRORNOURL, '</p>';
	if (empty($description)) echo '<p>', _DL_ERRORNODESCRIPTION, '</p>';
	echo '<p>', _GOBACK, '</p></div>';
	CloseTable4();
	CloseTable();
	include_once 'footer.php';
	die();
}
/*
 * Validate a fully qualified URL that was passed is valid (note: does not validate local files are present)
 */
if (strstr($url, '://')) {
	if (!preg_match('#^(http(s?))://#i', $url)) {
		include_once 'header.php';
		title($pagetitle);
		DLadminmain();
		echo '<br />';
		OpenTable();
		echo '<div align="center"><p><strong>', _DL_INVALIDURL, '</strong></p>';
		echo '<p>', _GOBACK, '</p></div>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
}
/*
 * Validate that URL does not already exist within the database
 */
$sql = 'SELECT `url` FROM `' . $prefix . '_nsngd_downloads` WHERE `url` = \'' . addslashes($url) . '\'';
$numrows = $db->sql_numrows($db->sql_query($sql));
if ($numrows > 0) {
	include_once 'header.php';
	title($pagetitle);
	DLadminmain();
	echo '<br />';
	OpenTable();
	echo '<div align="center"><p><strong>', _DL_ERRORURLEXIST, '</strong></p>';
	echo '<p>', _GOBACK, '</p></div>';
	CloseTable();
	include_once 'footer.php';
	die();
}
/*
 * Time to add the download to the database.
 */
$sql = 'INSERT INTO `' . $prefix . '_nsngd_downloads` VALUES (NULL, \'' . $cat . '\', \'' . $perm . '\', \'' . addslashes($title)
	. '\', \'' . addslashes($url) . '\', \'' . addslashes($description) . '\', now(), \'' . addslashes($sname) . '\', \''
	. addslashes($email) . '\', \'' . $hits . '\', \'' . addslashes($submitter) . '\', \'' . addslashes($sub_ip) . '\', \'' . $filesize
	. '\', \'' . addslashes($version) . '\', \'' . addslashes($homepage) . '\', \'1\')';
$db->sql_query($sql);
/*
 * If we came from "Waiting Downloads" where a download was accepted as-is, we need to give the submitter credit for their
 * upload and remove the download from the waiting queue.
 */
if (isset($new) && 1 == $new) {
	$lid = isset($lid) ? intval($lid) : 0;
	$sql = 'SELECT COUNT(`username`) FROM `' . $prefix . '_nsngd_accesses` WHERE `username` = \'' . addslashes($sname) . '\'';
	list($numrows) = $db->sql_fetchrow($db->sql_query($sql));
	if ($numrows < 1) {
		$db->sql_query('INSERT INTO `' . $prefix . '_nsngd_accesses` VALUES (\'' . addslashes($sname) . '\', 0, 1)');
	} else {
		$db->sql_query('UPDATE `' . $prefix . '_nsngd_accesses` SET `uploads` = `uploads` + 1 WHERE `username` = \'' . addslashes($submitter) . '\'');
	}
	$db->sql_query('DELETE FROM `' . $prefix . '_nsngd_new` WHERE `lid` = ' . $lid);
	if (!empty($email)) {
		$subject = _DL_YOURDOWNLOADAT . ' ' . $sitename;
		$message = _DL_HELLO . ' ' . htmlspecialchars($sname, ENT_QUOTES, _CHARSET) . ":\n\n" . _DL_APPROVEDMSG . "\n\n"
			. _DL_TITLE . ': ' . htmlspecialchars($title, ENT_QUOTES, _CHARSET) . "\n" . _DL_URL . ': '
			. htmlspecialchars($url, ENT_QUOTES, _CHARSET) . "\n" . _DL_DESCRIPTION . ': '
			. htmlspecialchars($description, ENT_QUOTES, _CHARSET) . "\n\n\n" . _DL_YOUCANBROWSEUS
			. " $nukeurl/modules.php?name=$module_name\n\n" . _DL_THANKS4YOURSUBMISSION . "\n\n$sitename " . _DL_TEAM;
		$mailheaders = "From: $adminmail\r\n";
		$mailheaders .= "Reply-To: $adminmail\r\n";
		$mailheaders .= "X-Mailer: NSNGD\r\n";
		$from = $sitename;
		/*
		 * Incorporate TegoNuke(tm) Mailer - although $mailsuccess isn't checked, it is here in case its needed in the future
		 */
		$mailsuccess = false;
		if (TNML_IS_ACTIVE) {
			$mailsuccess = tnml_fMailer($email, $subject, $message, $adminmail, $sitename);
		} else {
			$mailsuccess = mail($email, $subject, $message, $mailheaders);
		}
	}
}
/*
 * Ok, we're done with all the database work, now time to let the admin know the add was successful/done
 */
include_once 'header.php';
title($pagetitle);
DLadminmain();
echo '<br />';
OpenTable();
echo '<div align="center"><p class="option">' . _DL_NEWDOWNLOADADDED . '</p>';
if (isset($new) && 1 == $new) {
	echo '<p class="option">' . _GOBACK . '</p></div>';
} else {
	echo '<p class="option">[ <a href="' . $admin_file . '.php?op=Downloads">' . _DL_DOWNLOADSADMIN . '</a> ]</p></div>';
}
CloseTable();
include_once 'footer.php';

