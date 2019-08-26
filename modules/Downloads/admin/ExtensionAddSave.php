<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

$xext = gdFilter(strtolower($xext), 'nohtml'); // Note the modification to lower!  Only need the pattern, not exact values.

/*
 * Check the file/image flag settings.  Do not allow both settings to be "No" or "Yes".
 */
$typeOK = true;
if ($xfile != 0 && $xfile != 1) $typeOK = false;
if ($ximage != 0 && $ximage != 1) $typeOK = false;
if ($xfile == $ximage) $typeOK = false;

if (!$typeOK) 
{
	$pagetitle = _DL_EXTENSIONSADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';
	
	OpenTable();
	title('<h1>'.$pagetitle.'</h1>');
	DLadminmain();
	echo '<br />';
	OpenTable2();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHEEXTENSIONTYP . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable2();
	CloseTable();
	
	include_once 'footer.php';
	die();
}

/*
 * Check for valid extension values
 */
if (!gdValidateExt($xext)) 
{
	$pagetitle = _DL_EXTENSIONSADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';

    OpenTable();
	title('<h1>'.$pagetitle.'<h1>');
	DLadminmain();
	echo '<br />';
	OpenTable2();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHEEXTENSIONVAL . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable2();
	CloseTable();
	include_once 'footer.php';
	die();
}

/*
 * Check to make sure the extension does not already exist
 */
$sql = 'SELECT * FROM `' . $prefix . '_nsngd_extensions` WHERE `ext` = \'' . addslashes($xext) . '\'';
$numrows = $db->sql_numrows($db->sql_query($sql));

if ($numrows > 0) 
{
	$pagetitle = _DL_EXTENSIONSADMIN . ': ' . _DL_ERROR;
	include_once 'header.php';
    OpenTable();
	title('<h1>'.$pagetitle.'<h1>');
	DLadminmain();
	echo '<br />';
	OpenTable2();
	echo '<div align="center"><p class="title">' . _DL_ERRORTHEEXTENSION . ' ' . htmlspecialchars($xext, ENT_QUOTES, _CHARSET) . ' '
		. _DL_ALREADYEXIST . '</p>';
	echo '<p class="title">' . _GOBACK . '</p></div>';
	CloseTable2();
	CloseTable();
	include_once 'footer.php';
	die();
}

/*
 * Finally add the extension
 */
$db->sql_query('INSERT INTO `' . $prefix . '_nsngd_extensions` VALUES (NULL, \'' . addslashes($xext) . '\', \''
	. $xfile . '\', \'' . $ximage . '\')');

Header('Location: ' . $admin_file . '.php?op=Extensions');

