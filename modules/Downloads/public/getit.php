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
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }

?>
<style>
.fieldsetfix {
    min-width: 0;
    max-width: 50%;
	
    width: 100%;
 }

.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #f29c93;
	-webkit-box-shadow:inset 0px 1px 0px 0px #f29c93;
	box-shadow:inset 0px 1px 0px 0px #f29c93;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fe1a00), color-stop(1, #ce0100));
	background:-moz-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:-webkit-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:-o-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:-ms-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:linear-gradient(to bottom, #fe1a00 5%, #ce0100 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100',GradientType=0);
	background-color:#fe1a00;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #d83526;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:16px;
	font-weight:bold;
	padding:6px 6px;
	text-decoration:none;
	text-shadow:0px 1px 0px #b23e35;

}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ce0100), color-stop(1, #fe1a00));
	background:-moz-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:-webkit-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:-o-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:-ms-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:linear-gradient(to bottom, #ce0100 5%, #fe1a00 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ce0100', endColorstr='#fe1a00',GradientType=0);
	background-color:#ce0100;

}
.myButton:active {
	position:relative;
	top:1px;
}



.download {
	-moz-box-shadow:inset 0px 1px 0px 0px #f29c93;
	-webkit-box-shadow:inset 0px 1px 0px 0px #f29c93;
	box-shadow:inset 0px 1px 0px 0px #f29c93;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fe1a00), color-stop(1, #ce0100));
	background:-moz-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:-webkit-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:-o-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:-ms-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
	background:linear-gradient(to bottom, #fe1a00 5%, #ce0100 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100',GradientType=0);
	background-color:#fe1a00;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #d83526;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #b23e35;
}
.download:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ce0100), color-stop(1, #fe1a00));
	background:-moz-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:-webkit-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:-o-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:-ms-linear-gradient(top, #ce0100 5%, #fe1a00 100%);
	background:linear-gradient(to bottom, #ce0100 5%, #fe1a00 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ce0100', endColorstr='#fe1a00',GradientType=0);
	background-color:#ce0100;
}
.download:active {
	position:relative;
	top:1px;
}

.carbonfiber {
  background-color: #c80101; /* Red */
  border: none;
  border-radius: 8px;
  color: white;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
 -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}

.carbonfiber:hover {
  background-color: #87538e; /* Purple */
  color: white;

.centered {
    text-align: center;
}
</style>
<?
/*
 * Get the download detail data.
 */
$lid = isset($lid) ? intval($lid) : 0;
$result = $db->sql_query('SELECT * FROM `'.$prefix.'_nsngd_downloads` WHERE `lid` = '.$lid.' AND `active` > 0');
$lidinfo = $db->sql_fetchrow($result);
$priv = $lidinfo['sid'] - 2;
$pagetitle = '- '._DL_DOWNLOADPROFILE.': '.htmlspecialchars($lidinfo['title'],ENT_QUOTES, _CHARSET);
include_once 'header.php';
/*
 * Make sure the download is allowed for this user.  Enhanced in 1.1.0 at the request of Palbin to allow an admin to always be able to download
 */
if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user)) 
                           || ($lidinfo['sid'] == 2 AND is_admin($admin)) 
						   || ($lidinfo['sid'] > 2 AND of_group($priv)) 
						   || is_admin($admin)) 
{
	$userAllowed = true;
} 
else 
{
	$userAllowed = false;
}
/*
 * Control who can see what.  A 'show_download' value of '1' means show to anonymous users too.
 */
if ($userAllowed || $dl_config['show_download'] == '1') 
{
	if ($lidinfo['lid'] == '' OR $lidinfo['active'] == 0) 
	{
		OpenTable();
		echo '<p align="center"><strong>'._DL_INVALIDDOWNLOAD.'</strong></p>';
	} 
	else 
	{
		$fetchid = base64_encode($lidinfo['url']);
		$title = htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET);  
	    global $theme_name;
		OpenTable();
		echo '<div align="center"><h1><img height="13" src='.img('invisible_pixel.gif','Downloads').'><br />'._DL_DOWNLOADPROFILE.': '. $title.'</h1></div>'; 
	    echo "<div align=\"center\"><strong>[ <a href=\"modules.php?name=Downloads\">"._DLMAIN."</a> ] </strong></div>";

		
		echo '<p class="title">';
		echo "<table style = \"width: 500px; margin:  0px auto;\"><td>";
		if (is_mod_admin('Super')) 
		echo '<a class="rn_csrf" href="'.$admin_file.'.php?op=DownloadModify&amp;lid='.$lid.'" target="_tab"><img align="middle" src="'.img('edit.png','Downloads').'" alt="'._DL_EDIT.'" /> </a>';
		echo '<img align="middle" src="'.img('show.png','Downloads').'" alt="" />';
		echo "<td></table>";
		
		echo "<fieldset style = \"width: 500px; margin:  0px auto;\"><legend><strong><font color=".$textcolor2.">".$title." Download</font></strong></legend>"; 
		echo '<hr /><div>', $lidinfo['description'], '</div><hr />';
		echo '<strong>' . _DL_VERSION . ':</strong> ' . $lidinfo['version'] . '<br />';
		echo '<strong>' . _DL_FILESIZE . ':</strong> ' . CoolSize($lidinfo['filesize']) . '<br />'; 
		echo '<strong>' . _DL_ADDEDON . ':</strong> ' . CoolDate($lidinfo['date']) . '<br />';
		echo '<strong>' . _DL_DOWNLOADS . ':</strong> ' . $lidinfo['hits'] . '<br />';
		
		if (preg_match('#^(http(s?))://#i', $lidinfo['homepage']))
		{
		echo '<strong>' . _DL_HOMEPAGE . ':</strong> ';
		echo '<a href="'.$lidinfo['homepage'].'" target="_tab">'.$lidinfo['homepage'].'</a><hr />';
		echo '</fieldset>';
		}
		else 
		echo '<hr /></fieldset>';
		
		if ($userAllowed) 
		{  // Was already determined up above
			echo '<form action="modules.php?name='.$module_name.'" method="post">';
			echo '<input type="hidden" name="op" value="go" />';
			echo '<input type="hidden" name="lid" value="'.$lidinfo['lid'].'" />';
			/*
			 * If it is desired to use a captcha to help protect against "bot" access to
			 * the downloads, then we need to determine whether RavenNuke(tm) is being used.
			 * If so, then we use it.  If not, then we use the base NSN GR Download version
			 * coded by its original author.
			 */
			  echo '<div align="center">';
	
	 	      echo "<br /><table>".security_code(array(0,1,2,3,4,5,6,7), 'normal')."</table><br />";
			  echo '<p><div align="center"><input class="download" type="submit" name="DOWNLOAD" value="DOWNLOAD" /></p></div>'; 
			  echo '</form>';
			  echo '<p align="center"><a class="myButton" href="modules.php?name='.$module_name.'&amp;op=modifydownloadrequest&amp;lid='.$lid.'" ><font color="#000000">'. _DL_MODIFY. '<color></a> <a class="myButton" href="modules.php?name='.$module_name.'&amp;op=brokendownload&amp;lid='.$lid.'" ><font color="#000000">'. _DL_REPORTBROKEN. '<color></a></p>';
			
		} 
		else 
		{
			restricted($lidinfo['sid']);
		}
	}
	//CloseTable4();
	CloseTable();
} else {
	OpenTable();
	restricted($lidinfo['sid']);
	CloseTable();
}
include_once 'footer.php';

