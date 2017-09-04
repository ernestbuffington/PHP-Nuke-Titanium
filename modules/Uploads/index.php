<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/index.php
 PHP-Nuke Titanium Module              :   Uploads
 PHP-Nuke Titanium File Release Date   :   September 4th, 2017  
 PHP-Nuke Tianium File Author          :   Ernest Allen Buffington

 PHP-Nuke Titanium web address         :   https://titanium.86it.network
 
 PHP-Nuke Titanium is licensed under GNU General Public License v3.0

 PHP-Nuke Titanium is Copyright(c) 2002 to 2017 by Ernest Allen Buffington
 of Sebastian Enterprises. 
 
 ernest.buffington@gmail.com
 Att: Sebastian Enterprises
 1071 Emerald Dr,
 Brandon, Florida 33511
 ========================================================================
 GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
 Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 Everyone is permitted to copy and distribute verbatim copies
 of this license document, but changing it is not allowed.       
 ========================================================================
 
 /*****[CHANGES]**********************************************************
  The Nuke-Evo Base Engine : v2.1.0 RC3 dated May 4th, 2009 is what we
  used to build our new content management system. To find out more
  about the starting core engine before we modified it please refer to 
  the Nuke Evolution website. http://www.nuke-evolution.com
   
  This file was re-written for PHP-Nuke Titanium and all modifications
  were done by Ernest Allen Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is written for Social Networking and uses a centralized 
  database that is chained to The Scorpion Network & The 86it Social Network

  It is not intended for single user platforms and has the requirement of
  remote database access to https://the.scorpion.network and 
  https://www.86it.us which is a new Social Networking System designed by 
  Ernest Buffington that requires a FEDERATED MySQL engine in order to 
  function at all.
  
  The federated database concept was created in the 1980's and has been
  available a very long time. In fact it was a part of MySQL before they
  ever started to document it. There is not much information available
  about using a FEDERATED engine and a lot of the documention is not very
  complete with regard to every detail; it is superficial and partial to
  say thge least. 
  
  The core engine from Nuke Evolution was used to create 
  PHP-Nuke Titanium. Almost all versions of PHP-Nuke were unstable and not 
  very secure. We have made it so that it is enhanced and advanced!
  
  PHP-Nuke Titanium is now a secure custom FORK of the ORIGINAL PHP-Nuke
  that was purchased by Ernest Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is not backward compatible to any of the prior versions of
  PHP-Nuke, Nuke-Evoltion or Nuke-Evo.
  
  The module framework of PHP-Nuke is the only thing that still functions 
  in the same way that Francis Burzi had intended and even that had to be
  safer and more secure to be a reliable form of internet communications.
  
 ************************************************************************
 * PHP-NUKE: Advanced Content Management System                         *
 * ============================================                         *
 * Copyright (c) 2002 by Francisco Burzi                                *
 * http://phpnuke.org                                                   *
 *                                                                      *
 * This program is free software. You can redistribute it and/or modify *
 * it under the terms of the GNU General Public License as published by *
 * the Free Software Foundation; either version 2 of the License.       *
 ************************************************************************/
 
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$subject = $sitename." PHFTP File Storage v4.2.1";
include_once(NUKE_BASE_DIR.'header.php');

/* **************************************************************************
 Don't edit this file! Customizable configuration is located in config/config.php
 Copyright (c) by Andreas Mehrrath (http://www.mindcatch.com)
 ************************************************************************** */ 
include_once(NUKE_MODULES_DIR.'Uploads/config/config.php');
include_once(NUKE_MODULES_DIR.'Uploads/inc/globals.php');
include_once(NUKE_MODULES_DIR.'Uploads/inc/phftp_tools.php');
include_once(NUKE_MODULES_DIR.'Uploads/inc/ftp_tools.php');

if (((isset($function))&&($function!="help"))||(!isset($function)))       // MAIN FORM DRAW FUNCTION
include_once(NUKE_MODULES_DIR.'Uploads/inc/frm_interface.php');

OpenTableModule();
// FILE TO BROWSER
if ($function != "get")
include_once(NUKE_MODULES_DIR.'Uploads/inc/header.php');

// AFTER LOGIN
if ((isset($action))&&($action=="login")) 
$phpftp_passwd = enc_pwd($phpftp_passwd);

// CURRENT FUNCTION
switch($function)
{
	case "dir":
		phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
		$site_msg = $al['refreshed'];
		break;

	case "cd":
		phpftp_cd($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_directory);
		$site_msg = $al['dirchanged'];
		break;

	case "get":
		phpftp_get($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file); 
		// DOWNLOAD IS SILENT - NO RELOAD
		break;

	case "put":
		if (phpftp_put($phpftp_user,$phpftp_passwd,$phpftp_dir,$userfile))
			 $site_msg = $al['fileputted'];
		else $site_msg = $al['fileputtedfail'];
		break;

	case "mkdir":
		if (phpftp_mkdir($phpftp_user,$phpftp_passwd,$phpftp_dir,$new_dir))
			 $site_msg = $al['dircreated'];
		else $site_msg = $al['dircreatedfail'];
		break;

	case "drop":
	    if (phpftp_drop($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file))
	    	 $site_msg = $al['filedropped'];
	    else $site_msg = $al['filedroppedfail'];
	    break;

	case "dropdir":
	    if (phpftp_dropdir($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_directory))
	    	 $site_msg = $al['dirdropped'];
	    else $site_msg = $al['dirdroppedfail'];
	    break;

	case "chmod":
	    if (phpftp_chmod($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file,$chmode))
	    	 $site_msg = sts($al['chmodsuccess'],array($chmode,$select_file));
	    else $site_msg = $al['chmodfail'];
	    break;

	case "help":
		include_once(NUKE_MODULES_DIR.'Uploads/inc/frm_help.php');
	    break;

	default:
		include_once(NUKE_MODULES_DIR.'Uploads/inc/frm_login.php');
		include_once(NUKE_MODULES_DIR.'Uploads/inc/config_test.php');
		break;
}

if (!is_dir($phpftp_tmpdir)) 
show_error(sts($al['error6'],$phpftp_tmpdir)."\n<br><br>\n");

if ($function != "get") 
include_once(NUKE_MODULES_DIR.'Uploads/inc/footer.php');

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
?>