<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Forums/attach_mod/includes/constants.php
 PHP-Nuke Titanium File Release Date   :   September 9th, 2017  
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
 ************************************************************************//**
* @package attachment_mod
* @version $Id: constants.php,v 1.2 2005/11/21 17:31:55 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/
if (!defined('IN_PHPBB')){ die('Hacking attempt'); }

// Attachment Debug Mode
define('ATTACH_DEBUG', 0);         // Attachment Mod Debugging off
//define('ATTACH_DEBUG', 1);       // Attachment Mod Debugging on
//define('ATTACH_QUERY_DEBUG', 1); // Attachment Mod Debugging on

// Auth
define('AUTH_DOWNLOAD', 20);

// Download Modes
define('INLINE_LINK', 1);
define('PHYSICAL_LINK', 2);

// Categories
define('NONE_CAT', 0);
define('IMAGE_CAT', 1);
define('STREAM_CAT', 2);
define('SWF_CAT', 3);

// Tables
define('ATTACH_CONFIG_TABLE',$prefix.'_bbattachments_config');
define('EXTENSION_GROUPS_TABLE',$prefix.'_bbextension_groups');
define('EXTENSIONS_TABLE',$prefix.'_bbextensions');
define('FORBIDDEN_EXTENSIONS_TABLE',$prefix.'_bbforbidden_extensions');
define('ATTACHMENTS_DESC_TABLE',$prefix.'_bbattachments_desc');
define('ATTACHMENTS_TABLE',$prefix.'_bbattachments');
define('QUOTA_TABLE',$prefix.'_bbattach_quota');
define('QUOTA_LIMITS_TABLE',$prefix.'_bbquota_limits');

// Pages
define('PAGE_UACP', -1210);
define('PAGE_RULES', -1214);

// Misc
define('MEGABYTE', 1024);
define('ADMIN_MAX_ATTACHMENTS', 50); // Maximum Attachments in Posts or PM's for Admin Users
define('THUMB_DIR', 'thumbs');
define('MODE_THUMBNAIL', 1);

// Forum Extension Group Permissions
define('GPERM_ALL',0); // ALL FORUMS

// Quota Types
define('QUOTA_UPLOAD_LIMIT',1);
define('QUOTA_PM_LIMIT',2);
define('ATTACH_VERSION','2.4.5');
?>