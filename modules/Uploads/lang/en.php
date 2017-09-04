<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/lang/en.php
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

// ********************************
// PHFTP - ENGLISH LANGUAGE STRINGS
// ********************************
// CHECK ONLY THE SECOND VALUE IN EACH LINE, THE FIRST REPRESENTS THE TERM ID
// PLACEHOLDER FOR ALL SYSTEM VARIABLES IS ###
// KEEP TERMS SHORT AND CONCISE, MASK SPECIAL CHARACTERS WITH HTML ENTITIES
// http://www.w3schools.com/tags/ref_entities.asp


$al = array(
"anonymous"=>"Anonymous FTP",
"chmod"=>"CHMOD File/Directory",
"chmodfail"=>"CHMOD command failed.",
"chmodsuccess"=>"CHMOD ### on ### successful.",
"clientinfo"=>"Client Info",
"confirmdeldir"=>"Permanently delete the following directories:",
"confirmdelfile"=>"Permanently delete the following file(s):",
"connect"=>"Connect",
"connection"=>"Connection",
"credir"=>"Create Subdirectory",
"deldir"=>"Delete Directory",
"delfile"=>"Delete File",
"dirchanged"=>"Directory changed.",
"dircreated"=>"Directory Created.",
"dircreatedfail"=>"Directory create failed.",
"directory"=>"Directory",
"dirdropped"=>"Directory removed.",
"dirdroppedfail"=>"Remove Directory failed.",
"error"=>"Error: ",
"error1"=>"Connect to ### possible but user/password fails.",
"error2"=>"Cannot connect to ### at port ###.",
"error3"=>"No files in this directory or insufficient rights ...",
"error4"=>"Please enter a valid directory name!",
"error5"=>"Download failed!",
"error6"=>"Upload or Download problem, maybe cannot create temporary upload file!<br>\nNeed write right in <strong>###</strong>, respectively correct temp. directory in <strong>config/config.php</strong>",
"error7"=>"CHMOD/SITE commands are not available on this ftp server!",
"error8"=>"CHMOD ### on ### was not successful (php ftp_site ok)!",
"error9"=>"File or desired rights not selected.",
"error10"=>"Cannot delete file ###!",
"error11"=>"No file selected.",
"error12"=>"Cannot delete ### (directory must be empty)!",
"error13"=>"No directory selected.",
"error14"=>"The uploaded file exceeds the configured limit of ### bytes!",
"error15"=>"Cannot change directory to ###!",
"error16"=>"Cannot enter that directory!",
"error17"=>"Please select a valid folder or file.",
"exit"=>"Exit",
"filedropped"=>"File removed.",
"filedroppedfail"=>"File remove failed.",
"fileputted"=>"File uploaded.",
"fileputtedfail"=>"File upload failed.",
"files"=>"Files",
"folders"=>"Folders",
"goup"=>"(go up)",
"host"=>"Host",
"port"=>"Port",
"help"=>"Help",
"login"=>"Login",
"passive"=>"passive FTP",
"password"=>"Password",
"rawftp"=>"Raw FTP",
"refresh"=>"Refresh",
"refreshed"=>"View refreshed...",
"retry"=>"Please retry this action here ...",
"securessl"=>"secure FTP",
"ssl"=>"SSL",
"to"=>"to",
"upload"=>"Upload",
"limit"=>"Limit",
"--"=>"------------------------------------------------",
"help_text"=>"


### is a simple and fast desktop FTP client replacement which even works
if you are behind firewalls and proxies.

To enter folders or download files simply <b>-double click-</b> these folders and
files in the lists. To go up in the directory structure click on the first entry
with the two dots (..) or use the directory selection list above.

Upload and download file size limits may not only be set in the configuration 
file (config.php), probably they have to be set accordingly on your webserver, 
firewall or proxy infrastructure too. Ask your provider or network adminstrator 
if you have problems here, not us please.

Configure ### in config/config.php and read the <a href='readme.txt'>readme.txt</a> carefully.


<b>### Project Homebase</b>

<a href=\"http://sourceforge.net/projects/###/\" target=\"_new\">http://sourceforge.net/projects/###/</a>

Here you can get the latest version. You are also welcome to
participate or donate :) <a href=\"https://sourceforge.net/donate/index.php?group_id=308254\" target=\"_tab\">DONATE ###</a>, thanks very much. If you 
need a customized version or another web tool don't hesitate 
to ask us at <a href=\"###\" target=\"_tab\">###</a>.

____________
Happy FTP'ing.
"
);
?>