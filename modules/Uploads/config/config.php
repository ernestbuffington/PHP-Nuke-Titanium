<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/config/config.php
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

/* CUSTOMIZE PHFTP WITH THE PARAMETERS BELOW.
   DON'T CHANGE OTHER FILES THAN THIS. 
   SAVE A COPY OF IT! 
*/


/* DEFAULT FTP HOST */
$conf_phpftp_host = "upload.86it.us";

/* DEFAULT FTP PORT */
$conf_phpftp_port = "21";

/* USE FTP OVER SSL AT DEFAULT?
   DEFAULT: false */
$conf_phpftp_ssl = false;

/* YOUR OWN ENCRYPTION SALT
   ADDITIONALLY SECURES YOUR PASSWORD ENCRYPTION STRING */
$conf_enc_salt = "Gd71ec9472ALi171ecL61eC3872L";

/* PASSIVE FTP AT DEFAULT?
   DEFAULT: true */
$conf_phpftp_passive = true;

/* IMPORTANT!
   The temporary directory for file operations. Needs to be writable
   for your web server process user (e.g. apache, httpd, daemon,...)
   Example preparation:   mkdir /var/tmp/ftpfiles && chmod 1777 /var/tmp/ftpfiles
                          [SITE] CHMOD 1777 /data/tmp/ftpfiles
*/
$conf_phpftp_tmpdir="/tmp";


/* MAXIMUM SIZE IN BYTES(!) OF FILES YOU WANT TO ACCEPT. YOU MAY ALSO NEED
   TO EDIT YOUR PHP.INI FILE AND CHANGE UPLOAD_MAX_FILESIZE ETC. APPROPRIATELY
   DEFAULT: 15360000 (BYTES, =15MB) */
$conf_max_file_size="100360000";


/* GENERAL TIMEOUT TO FTP SERVER CONNECT ATTEMPTS IN SECONDS
   DEFAULT: 30 */
$conf_timeout=30;


/* ALLOWED RIGHTS FOR CHMOD OPERATION
   DEFAULT:            array("600","650","655","700","750","755","770","777");

   TO DISABLE CHMOD SUPPORT SIMPLY COMMENT IT OUT. */

$conf_allowed_chmods = array("600","650","655","700","750","755","770","777");


/* LANGUAGES SUPPORTED: EN,DE, ... (CHECK YOUR ./lang/ DIRECTORY FOR SUPPORTED LANGUAGES)
   DEFAULT: en                     (YOU ARE WELCOME TO CREATE AND SEND US NEW TRANSLATIONS) */
$conf_phpftp_lang = "en";


/* FILES WITH THE FOLLOWING EXTENSIONS WILL BE TRANSFERED IN ASCII MODE
   INSTEAD BINARY MODE (CONCERNS UP- AND DOWNLOADS). */
$conf_phpftp_ascii_files = array(
".am",".asp",".bat",".c",".cfm",".cgi",".conf",".cnf",
".cpp",".css",".dhtml",".diz",".forward",
".h",".hpp",".htaccess",".htm",".html",
".in",".inc",".ini",".js",".m4",".mak",".nfo",".nsi",
".pas",".patch",".php",".php3",".php4",".php5",".phtml",".pl",".po",
".procmailrc",
".py",".qmail",".sh",".shtml",".sql",".ssi",".tcl",".tpl",".txt",
".vbs",".wsdl",".xml",".xrc",".xslt"
);


/* APPEARANCE: STYLE TEMPLATE TO USE, CSS STYLESHEET FILENAME
 * DEFAULT: default.css (ALTERNATIVES: candy.css, your.css) */
$conf_css = "default.css";


/* GLOBALLY CENTER THE TOOLS INTERFACE IN THE PAGES
   DEFAULT: true */
$conf_centered = true;


/* WIDTH IN PIXEL OF BOTH FILEMANAGER SIDES (FOLDERS,FILES)
   DEFAULT: 380,500  (COMMA SEPARATED) */
$conf_fileman_width = "380,500";


/* ALLOW THE USER TO DEFINE THE FTP HOST, PORT AND SSL
   DEFAULT: true */
$conf_enable_host_selection = true;


/* FILE AND DIRECTORY VERTICAL LIST LENGTH
   (NUMBER OF FILES AND FOLDERS WITHOUT SCROLLING)
   DEFAULT: 25 */
$conf_listlength = 25;
?>