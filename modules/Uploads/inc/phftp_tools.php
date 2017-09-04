<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/inc/phftp_tools.php
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
// ***************************************
// ** FILE:    PHFTP_TOOLS.PHP          **
// ** PURPOSE: PHFTP                    **
// ** DATE:    12.02.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// PHFTP SPECIFIC TOOLS
include_once(NUKE_MODULES_DIR.'Uploads/inc/tools.php');
//include_once("tools.php");


// ***************************************
function enc_pwd($myPwd,$mySalt=_ENC_SALT)
// ***************************************
{
    $arrTemp = array();

	for ($i=0;$i<strlen($myPwd);$i++) $arrTemp[] = substr($myPwd,$i,1);

    return "AES.".mt_rand(1000,9999).base64_encode(implode($mySalt,array_reverse($arrTemp)));
}



// ***************************************
function dec_pwd($myPwd,$mySalt=_ENC_SALT)
// ***************************************
{
    return implode("",array_reverse(explode($mySalt,base64_decode(substr($myPwd,8)))));
}




// *********************************************************
function draw_form($function,$formAdditionals="",$submit="")
// *********************************************************
{
	global $phpftp_user, $phpftp_passwd, $phpftp_host, $phpftp_port, $phpftp_ssl, $phpftp_passive;

	echo "\n<form id=\"frm_".$function."\" action=\""._SYSTEM."\" method=\"post\" ".$formAdditionals.">\n";
	echo "<input type=\"hidden\" name=\"function\"       value=\"".$function."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_user\"    value=\"".$phpftp_user."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_passwd\"  value=\"".$phpftp_passwd."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_host\"    value=\"".$phpftp_host."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_port\"    value=\"".$phpftp_port."\">\n";

	if ($phpftp_ssl) 	echo "<input type=\"hidden\" name=\"phpftp_ssl\"     value=\"1\">\n";
	else 				echo "<input type=\"hidden\" name=\"phpftp_ssl\"     value=\"0\">\n";

	if ($phpftp_passive)echo "<input type=\"hidden\" name=\"phpftp_passive\"     value=\"1\">\n";
	else 				echo "<input type=\"hidden\" name=\"phpftp_passive\"     value=\"0\">\n";

	if ($submit!="")
	echo "<input type=\"submit\" value=\"".$submit."\" class=\"ibutton\">\n";
}



// ********************************************************************************************
function decode_ftp_filedate($fdate)
// ********************************************************************************************
{
 $fdate = trim(strtolower($fdate));

 $arrMonIn  =array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
 $arrMonOut =array('01.','02.','03.','04.','05.','06.','07.','08.','09.','10.','11.','12.');

 return str_replace(array(". ",".\t","\t.\t","\t."),".",str_replace($arrMonIn,$arrMonOut,$fdate));
}



// **************
function helpme()
// **************
{
    global $al;

    //return "<a href=\"#\" onClick=\"popup_win('help','ftp.php?function=help',600,640);\"> //changed by Ernest Allen Buffington 9/3/2017 Sunday
    return "<a href=\"#\" onClick=\"window.open('modules.php?name=Uploads&function=help');\">
	<img src=\"modules/Uploads/img/help.gif\" align=\"top\" width=\"19\" height=\"19\" border=\"0\"> ".$al['help']."</a>";
}

?>