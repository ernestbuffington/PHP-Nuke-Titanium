<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/inc/globals.php
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

// ***************************************
// ** FILE:    GLOBALS.PHP              **
// ** PURPOSE: PHFTP                    **
// ** DATE:    18.03.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// *** TEST/DEBUG OR PRODUCTION MODE ***
// ini_set('display_errors', 		1);
// ini_set('error_reporting', 		E_ALL);

//ini_set('display_errors',0);                   //disabled by Ernest Allen Buffington on Sunday 9/3/2017
//ini_set('error_reporting',E_ALL & ~E_NOTICE);  //disabled by Ernest Allen Buffington on Sunday 9/3/2017
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

if (!isset($function))
{	
  $function = "";
}

if (!get_cfg_var("register_globals"))
{
 extract($_REQUEST);
 
 if ($function=="put")
 { 
   extract($_FILES);
 }
}

// SYSTEM LANGUAGE
if ((!isset($conf_phpftp_lang))||(strlen($conf_phpftp_lang)!=2)||(!file_exists("lang/".$conf_phpftp_lang.".php")))
{
  $conf_phpftp_lang="en";
}

// SETS THE $al LANGUAGE ARRAY
include_once(NUKE_MODULES_DIR.'Uploads/lang/'.$conf_phpftp_lang.'.php');

// IMPORTANT TERMS
define("_SYSTEM",		"modules.php?name=Uploads");
define("_APP_NAME",     "PHFTP");
define("_APP_VEND",     "mindCatch(tm) Software Solutions");
define("_APP_VEND_URL", "http://www.mindcatch.com");
define("_APP_VERSION",  "4.2");
define("_APP_AUTHOR",   "Andreas Mehrrath - &copy; ".date("Y")." "._APP_VEND);
define("_APP_SHORT",    _APP_NAME." "._APP_VERSION);
define("_APP_LONG",     "Free "._APP_NAME." "._APP_VERSION." by "._APP_AUTHOR);
define("_ERR",          "<b>".$al['error']."</b>");
define("_ERR_RETRY",    "<br>\n<a href=\"modules.php?name=Uploads\">".$al['retry']."</a><br>\n");

// CUSTOM ENCRYPTION SALT
if (!isset($conf_enc_salt))
{ 
  $conf_enc_salt = "Gd71ec9472ALi171ecL61eC3872L";
}

define("_ENC_SALT",$conf_enc_salt);

// FINAL CONFIGURE ERROR TOLERANTS
if (!isset($phpftp_host))
{           
  $phpftp_host = $conf_phpftp_host;
}

if ($phpftp_host=="")
{				
  $phpftp_host = "upload.86it.us";
}

if (!isset($phpftp_port))
{           
  $phpftp_port = $conf_phpftp_port;
}

if ($phpftp_port=="")
{				
  $phpftp_port = "21";
}

if (!isset($phpftp_ssl))
{            
  $phpftp_ssl  = (bool) $conf_phpftp_ssl;
}
else
{                                
  $phpftp_ssl  = (bool) $phpftp_ssl;
}

if (!isset($phpftp_passive))
{        
  $phpftp_passive  = (bool) $conf_phpftp_passive;
}
else
{                                
  $phpftp_passive  = (bool) $phpftp_passive;
}

if (!isset($phpftp_dir))
{			
  $phpftp_dir = "";
}

if ((!isset($conf_centered)) || (!is_bool($conf_centered)) || ($function=="help"))
{
  $phpftp_centered = true;
}
else
{  
  $phpftp_centered = (bool) $conf_centered;
}
// LIST WIDTHS
if (!isset($conf_fileman_width))
{ 
  $conf_fileman_width = "380,500";
}

$conf_fileman_width = explode(",",$conf_fileman_width);
$conf_fileman_folders_width = $conf_fileman_width[0];
$conf_fileman_files_width   = $conf_fileman_width[1];

unset($conf_fileman_width);

// VARIOUS
if (!isset($max_file_size))
{				
  $max_file_size = $conf_max_file_size;
}

if (!is_numeric($max_file_size))
{		
  $max_file_size = 15360000;
}

if (!isset($enable_host_selection))
{ 	
  $enable_host_selection = $conf_enable_host_selection;
}

if (!is_bool($enable_host_selection))
{	
  $enable_host_selection = false;
}

if (!isset($phpftp_tmpdir))         	
{ 
	$phpftp_tmpdir = $conf_phpftp_tmpdir;
	
	// ALTERNATIVE SUCHE NACH GUELTIGEM TEMP DIR (sys_get_temp_dir())
	if (!is_dir($phpftp_tmpdir))
	{	
	  $phpftp_tmpdir = getenv('TMPDIR');
	}
	
	if (!is_dir($phpftp_tmpdir))
	{	
	  $phpftp_tmpdir = getenv('TMP');
	}
	
	if (!is_dir($phpftp_tmpdir))
	{	
	  $phpftp_tmpdir = "/tmp";
	}
	
	if (!is_dir($phpftp_tmpdir))
	{	
	  $phpftp_tmpdir = "/var/tmp";
	}
}

if ((!isset($listlength)) && (is_numeric($conf_listlength)))
{	
  $listlength = $conf_listlength;
}
else
{                                                            
  $listlength = 25;
}

if ((isset($conf_allowed_chmods))&&(is_array($conf_allowed_chmods))) 
{
  $phpftp_chmods = $conf_allowed_chmods;
}
else
{
  $phpftp_chmods = false;
}

if (!isset($endmsg))
{	
  $endmsg = "";
}

if (!isset($site_msg))
{	
  $site_msg = "";
}
?>