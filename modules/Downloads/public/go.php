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
$lid = isset($lid) ? intval($lid) : 0;
$lidinfo = $db->sql_fetchrow($db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_downloads` WHERE `lid` = ' . $lid));
$priv = $lidinfo['sid'] - 2;

/*
 * First make sure that anonymous or logged in user is allowed to download the file.  If not, do
 * not let them do it and give them a message.
 * Enhanced in 1.1.0 at the request of Palbin to allow an admin to always be able to download
 */
if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user)) 
                           || ($lidinfo['sid'] == 2 AND is_admin($admin)) 
						   || ($lidinfo['sid'] > 2 AND of_group($priv)) 
						   || is_admin($admin)) 
{
	if (!empty($lidinfo['url'])) 
	{
		/*
		 * Perform the appropriate security check code depending upon what CMS and graphical capabilities we are running
		 */
		$passedSecurityCheck = false;
		
		if (!security_code_check($_POST['g-recaptcha-response'], array(0,1,2,3,4,5,6,7)))
		{
		  $error_message[] = $lang_new[$module_name]['reCaptcha'];
		}
        else
		{
		  $passedSecurityCheck = true;
		}
		
		if ($passedSecurityCheck) 
		{
			$sub_ip = gdGetIP(); // Get the submitter's IP address if we can
			$uinfo = getusrinfo($user);
			$username = $uinfo['username'];
			
			if (empty($username)) 
			$username = $sub_ip;
			
			if (stristr($lidinfo['url'], 'http://') || stristr($lidinfo['url'], 'https://') 
			                                        || stristr($lidinfo['url'], 'ftp://') 
													|| stristr($lidinfo['url'], 'sftp://') 
													|| @file_exists($lidinfo['url'])) 
			{
				include_once 'includes/counter.php';
			
				$db->sql_query('UPDATE `'.$prefix.'_nsngd_downloads` SET `hits` = `hits` + 1 WHERE `lid` = '.$lid);
			
				if (!is_admin($admin)) 
				{
					$sql = 'SELECT * FROM `'.$prefix.'_nsngd_accesses` WHERE `username` = \''.addslashes($username).'\'';
					$result = $db->sql_numrows($db->sql_query($sql));
				
					if ($result < 1) 
					{
						$sql = 'INSERT INTO `'.$prefix.'_nsngd_accesses` VALUES (\''.addslashes($username).'\', 1, 0)';
						$db->sql_query($sql);
					} 
					else 
					{
						$sql = 'UPDATE `'.$prefix.'_nsngd_accesses` SET `downloads` = `downloads` + 1 WHERE `username` = \''. addslashes($username).'\'';
						$db->sql_query($sql);
					}
				}
				
				/*
				 * Anti-leaching approach starts here.  Rather than presenting a direct re-direct link to the browser (i.e., essentially
				 * allowing ANY GET link from any site to do the same and by-pass all download controls), we essentially stream the binary
				 * back to the browser.  NOTE: Anti-leaching will ONLY work where you host the file on your local web server beneath the
				 * same directory structure as your RavenNuke(tm)/PHP-Nuke site.
				 *
				 * HOW TO USE:
				 * 1.  Place a .htaccess file at the root directory of where you store your download files and have it have only
				 *     the following one line in it:
				 *
				 *     deny from all
				 *
				 * 2.  Next, each download you host must NOT have a URL of HTTP, HTTPS, FTP or FTPS.  You must use a direct
				 *     relative path to the file (i.e., starting from your root web - where your top level modules.php script is.
				 *
				 * @todo Down the road, will need to make this feature more configurable and flexible.
				 */
				if (stristr($lidinfo['url'], 'http://') 
				|| stristr($lidinfo['url'], 'https://') 
				|| stristr($lidinfo['url'], 'ftp://') 
				|| stristr($lidinfo['url'], 'sftp://')) 
				{
					// Download is hosted elsewhere, therefore, will not stream
					Header('Location: ' . $lidinfo['url']);
				} 
				else 
				{
					 // This part of the download code was non-functional on a HTTPS server
					 // so Ernest Buffington took the liberty of re-writing this so it works~!~ FIX 7/27/2019 by Ernest Allen Buffington
 					 // Download is hosted here, so go get it and stream it to the browser.
					 // @todo Should improve configurability and/or bullet-proofness over time
                     // Grab the file extension
                     $extension = strtolower( pathinfo( basename($lidinfo['url']), PATHINFO_EXTENSION ) );

                      // our list of mime types
                      $cType = array(

                      'txt' => 'text/plain',
                      'htm' => 'text/html',
                      'html' => 'text/html',
                      'php' => 'text/html',
                      'css' => 'text/css',
                      'js' => 'application/javascript',
                      'json' => 'application/json',
                      'xml' => 'application/xml',
                      'swf' => 'application/x-shockwave-flash',
                      'flv' => 'video/x-flv',

                      // images
                      'png' => 'image/png',
                      'jpe' => 'image/jpeg',
                      'jpeg' => 'image/jpeg',
                      'jpg' => 'image/jpeg',
                      'gif' => 'image/gif',
                      'bmp' => 'image/bmp',
                      'ico' => 'image/vnd.microsoft.icon',
                      'tiff' => 'image/tiff',
                      'tif' => 'image/tiff',
                      'svg' => 'image/svg+xml',
                      'svgz' => 'image/svg+xml',

                       // archives
                      'zip' => 'application/zip',
                      'rar' => 'application/x-rar-compressed',
                      'exe' => 'application/x-msdownload',
                      'msi' => 'application/x-msdownload',
                      'cab' => 'application/vnd.ms-cab-compressed',

                       // audio/video
                       'mp3' => 'audio/mpeg',
                       'qt' => 'video/quicktime',
                       'mov' => 'video/quicktime',

                        // adobe
                       'pdf' => 'application/pdf',
                       'psd' => 'image/vnd.adobe.photoshop',
                       'ai' => 'application/postscript',
                       'eps' => 'application/postscript',
                       'ps' => 'application/postscript',

                        // ms office
                       'doc' => 'application/msword',
                       'rtf' => 'application/rtf',
                       'xls' => 'application/vnd.ms-excel',
                       'ppt' => 'application/vnd.ms-powerpoint',

                        // open office
                        'odt' => 'application/vnd.oasis.opendocument.text',
                        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
                       );

                        // Set a default mime if we can't find it
                        if( !isset( $cType[$extension] ) )
                        {
                           $cType = 'application/octet-stream';
                        }
                        else
                        {
                           $cType = ( is_array( $cType[$extension] ) ) ? $cType[$extension][0] : $cType[$extension];
                        }
        
                        // Generate the server headers
                       if( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) )
                       {
                          header( 'Content-Type: "'.$cType.'"' );
                          header( 'Content-Disposition: attachment; filename="'.basename($lidinfo['url']).'"');
                          header( 'Expires: 0' );
                          header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
                          header( "Content-Transfer-Encoding: binary" );
                          header( 'Pragma: public' );
                          header( "Content-Length: ".filesize( basename($lidinfo['url']) ) );
                       }
                    else
                    {
                       header( "Pragma: public" );
                       header( "Expires: 0" );
                       header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
                       header( "Cache-Control: private", false );
                       header( "Content-Type: ".$cType, true, 200 );
                       header('Content-Length: ' . filesize($lidinfo['url']));
                       header( 'Content-Disposition: attachment; filename='. basename($lidinfo['url']));
                       header( "Content-Transfer-Encoding: binary" );
                    }
                    readfile($lidinfo['url']);
                    exit; // Who ever wrote original code did not exit after readfile! Fixed by Ernest Buffington
				}
				die();
			} 
			else 
			{
				$date = date('M d, Y g:i:a');
				$sql = 'INSERT INTO `'.$prefix.'_nsngd_mods` VALUES (NULL, '.$lid. ', 0, 0, \'\', \'\', \'\', \''._DL_DSCRIPT.'<br />'.$date.'\', \''. addslashes($sub_ip).'\', 1, \'\', \'\', \'\', \'\', \'\')';
				$db->sql_query($sql);
				include_once 'header.php';
				$lidinfo['title'] = htmlspecialchars($lidinfo['title'], ENT_QUOTES, _CHARSET);
				OpenTable();
				echo '<div align="center"><font color="#FF0000"><h1>'._DL_FNF . ' ' . $lidinfo['title'].'</h1></font></div>';
				echo '<div align="center"><p>' . _DL_SORRY . ' ' . $username . ', <strong>' . $lidinfo['title'] . '</strong> '
					. _DL_NOTFOUND . '</p><p>' . _DL_FNFREASON . '</p><p>';
				echo _DL_FLAGGED . '</p>';
				echo '<p>[ <a href="modules.php?name=' . $module_name . '">' . _DL_BACKTO . ' ' . $module_name . '</a> ]</p></div>';
				CloseTable();
				include_once 'footer.php';
			
			
			}
		} else {
			include_once 'header.php';
			OpenTable();
			echo '<div align="center"><font color="#FF0000"><h1>reCAPTCHA fAIL</h1></font></div>';
			echo '<div align="center"><p><h1>You have failed the reCAPTCHA Security Check!!</h1></p>';
			echo '<p><a class="carbonfiber" href="javascript:history.go(-1)">Go Back</a></p></div>';
			CloseTable();
			include_once 'footer.php';
			die();
		}
	} else {
		include_once 'header.php';
		OpenTable();
		echo '<div align="center"><font color="#FF0000"><h1>'._DL_URLERR.'</h1></font></div>';
		echo '<div align="center"><p>' . _DL_INVALIDURL . '</p>';
		echo '<p>a class="carbonfiber" href="javascript:history.go(-1)">Go Back</a></p></div>';
		CloseTable();
		include_once 'footer.php';
	}
} else {
	include_once 'header.php';
	OpenTable();
	echo '<div align="center"><font color="#FF0000"><h1>'._DL_RESTRICTED.'</h1></font></div>';
	restricted($lidinfo['sid']);
	CloseTable();
	include_once 'footer.php';
}

