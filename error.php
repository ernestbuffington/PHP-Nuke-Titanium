<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   error.php
 PHP-Nuke Titanium File Release Date   :   September 16th, 2017   
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
/*****[CHANGES]**********************************************************
-=[Base]=-
  Fixed actual Time                     9/16/2017 Ernest Allen Buffington
  Created missing Tables                9/16/2017 Ernest Allen Buffington
  Created Index using total errors      9/16/2017 Ernest Allen Buffington
-=[Mod]=-
  Original Mod came from Nuke Evoltuion 210 Rev 2028
 ************************************************************************/
require_once(dirname(__FILE__) . '/mainfile.php');

global $prefix, $currentlang, $db, $nsnst_const, $_GETVAR; 

$module_name = 'error';

if(@file_exists(NUKE_LANGUAGE_DIR.$module_name.'/lang-'.$currentlang.'.php')) 
include(NUKE_LANGUAGE_DIR.$module_name.'/lang-'.$currentlang.'.php');
else 
include(NUKE_LANGUAGE_DIR.$module_name.'/lang-english.php');

$error = $_GETVAR->get('error', '_GET', 'int');

// Error-Log also defined in network_constants
define('_ERROR_TABLE', $prefix.'_errors');
define('_ERROR_CONFIG_TABLE', $prefix.'_errors_config');

$result = $db->sql_query("SELECT log_errors, show_image, modulblocks, show_info_saved, totalerrors FROM "._ERROR_CONFIG_TABLE);
list($log_errors, $show_image, $modulblocks, $show_info_saved, $totalerrors) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

$showblocks = $modulblocks;

if ($log_errors == 1) {
	    
		date_default_timezone_set("America/New_York");
        
		// get the time
		$time           = date("h:i:sa");
		
		// get the referer
        $referer        = ($nsnst_const['referer'] != 'none') ? $nsnst_const['referer'] : $nsnst_const['user_agent'];
        
		// ghet user ip
		$ip_address     = ($nsnst_const['client_ip'] != 'none') ? $nsnst_const['client_ip'] : $nsnst_const['remote_ip'] ;
        
		// Build the current URL
        $servername     = $nsnst_const['http_host'];
        $serverport     = $nsnst_const['remote_port'];
        $current_url    = $_GETVAR->get('REQUEST_URI', '_SERVER', 'string', '');
        // Build the current URL
		
		// create the full error url
		$error_url      = "https://".$servername.":".$serverport."".$current_url;

		//add 1 to the counter of total errors
        $totalerrors = $totalerrors + 1;
		
		// add the error data to the database
		$db->sql_uquery("INSERT INTO "._ERROR_TABLE." values ('$time', '$referer', '$ip_address', '$servername', '$serverport', '$current_url','$error_url','$totalerrors')");
        
		// +1 to the total errors listed in the error config table
		$db->sql_uquery("UPDATE "._ERROR_CONFIG_TABLE." SET totalerrors='$totalerrors'");
}
// lets build the error page switch statement!
switch ($error) {
    case (203): 
	$pagetitle = $lang_new[$module_name]['EM203']; 
	$type = 1; 
	$type = 0; 
	break;
    case (204): 
	$pagetitle = $lang_new[$module_name]['EM204']; 
	$type = 1; 
	break;
    case (205): 
	$pagetitle = $lang_new[$module_name]['EM205']; 
	$type = 1; 
	break;
    case (300): 
	$pagetitle = $lang_new[$module_name]['EM300']; 
	$type = 1; 
	break;
    case (301): 
	$pagetitle = $lang_new[$module_name]['EM301']; 
	$type = 1; 
	break;
    case (302): 
	$pagetitle = $lang_new[$module_name]['EM302']; 
	$type = 1; 
	break;
    case (303): 
	$pagetitle = $lang_new[$module_name]['EM303']; 
	$type = 1; 
	break;
    case (304): 
	$pagetitle = $lang_new[$module_name]['EM304']; 
	$type = 3; 
	break;
    case (400): 
	$pagetitle = $lang_new[$module_name]['EM400']; 
	$type = 2; 
	break;
    case (401): 
	$pagetitle = $lang_new[$module_name]['EM401']; 
	$type = 3; 
	break;
    case (402): 
	$pagetitle = $lang_new[$module_name]['EM402']; 
	$type = 3; 
	break;
    case (403): 
	$pagetitle = $lang_new[$module_name]['EM403']; 
	$type = 3; 
	break;
    case (404): 
	$pagetitle = $lang_new[$module_name]['EM404']; 
	$type = 2; 
	break;
    case (405): 
	$pagetitle = $lang_new[$module_name]['EM405']; 
	$type = 0; 
	break;
    case (406): 
	$pagetitle = $lang_new[$module_name]['EM406']; 
	$type = 1; 
	break;
    case (407): 
	$pagetitle = $lang_new[$module_name]['EM407']; 
	$type = 1; 
	break;
    case (408): 
	$pagetitle = $lang_new[$module_name]['EM408']; 
	$type = 2; 
	break;
    case (409): 
	$pagetitle = $lang_new[$module_name]['EM409']; 
	$type = 2; 
	break;
    case (410): 
	$pagetitle = $lang_new[$module_name]['EM410']; 
	$type = 1; 
	break;
    case (411): 
	$pagetitle = $lang_new[$module_name]['EM411']; 
	$type = 0; 
	break;
    case (412): 
	$pagetitle = $lang_new[$module_name]['EM412']; 
	$type = 1; 
	break;
    case (413): 
	$pagetitle = $lang_new[$module_name]['EM413']; 
	$type = 1; 
	break;
    case (414): 
	$pagetitle = $lang_new[$module_name]['EM414']; 
	$type = 3; 
	break;
    case (415): 
	$pagetitle = $lang_new[$module_name]['EM415']; 
	$type = 2; 
	break;
    case (500): 
	$pagetitle = $lang_new[$module_name]['EM500']; 
	$type = 1; 
	break;
    case (502): 
	$pagetitle = $lang_new[$module_name]['EM502']; 
	$type = 1; 
	break;
    case (503): 
	$pagetitle = $lang_new[$module_name]['EM503']; 
	$type = 1; 
	break;
    case (504): 
	$pagetitle = $lang_new[$module_name]['EM504']; 
	$type = 1; 
	break;
    case (505): 
	$pagetitle = $lang_new[$module_name]['EM505']; 
	$type = 3; 
	break;
    default: 
	$pagetitle = $lang_new[$module_name]['EMUNKNOWN']; 
	$type = 4; 
	break;
}

// lets switch the image to be associated with the error!
switch ($type) {
    case(0): $img_error = 'stop.png'; break;
    case(1): $img_error = 'attention.png'; break;
    case(2): $img_error = 'question.png'; break;
    case(3): $img_error = 'forbidden.png'; break;
    case(4): $img_error = 'unknown.png'; break;
    default: $img_error = 'unknown.png'; break;
}    

$to_echo = '<center><strong>'.$pagetitle.'</strong></center>';

$pagetitle = '- '.$pagetitle;

include_once(NUKE_BASE_DIR.'header.php');

OpenTable();

echo $to_echo . "<br />";

// if show_image in the error config is set to 1 do the following
if ($show_image == 1) 
echo '<div align="center"><img src="'.img($img_error, 'error').'" alt="" title="" />';

echo '<br />[<a href="'.TITANIUM_SERVER_URL.'/index.php">'.$lang_new[$module_name]['EMHOME'].'</a>]<br /><br />';
echo $lang_new[$module_name]['EMSORRY'].'&nbsp;'. TITANIUM_SERVER_SITENAME .'&nbsp;!</div><br />';

if ($log_errors == 1) 
{
    if ($show_info_saved == 1) 
	{
        echo '<div align="center">'.$lang_new[$module_name]['EMRECDATA'].'</div><br />';
        echo "<dl class=\"twocolumn\"><dt class=\"twocolumn\">".$lang_new[$module_name]['EMDATETIME']." : </dt><dd class=\"twocolumn\">$time</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMSORT']." : </dt><dd class=\"twocolumn\">$error</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMIP']." : </dt><dd class=\"twocolumn\">$ip_address</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMREF']." : </dt><dd class=\"twocolumn\">$referer</dd>";
        echo "<dt class=\"twocolumn\">".$lang_new[$module_name]['EMURL']." : </dt><dd class=\"twocolumn\">$error_url</dd></dl><div class=\"clear-left\"></div>";
    }
}
CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');
die();
?>