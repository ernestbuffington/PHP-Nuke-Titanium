<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/inc/common_client_info.php
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
/* DEFINES THE FOLLOWING (IF POSSIBLE):

_REMOTE_ADDR
_REMOTE_PROXY
_REMOTE_USER
_REMOTE_DOMAIN

*/

$tmparr = array();
$remoteProxy = "";

     // 1. PROOF INSECURE EXISTENCE OF USABLE HTTP_CLIENT_IP VAR AT FIRST
if ( (isset($_SERVER["HTTP_CLIENT_IP"])) and (is_numeric(substr($_SERVER["HTTP_CLIENT_IP"],0,1))) )
{
    $tmparr[] = $_SERVER['HTTP_CLIENT_IP'];
}
else // 2. HTTP_CLIENT_IP NICHT GESETZT
if ( (isset($_SERVER['REMOTE_ADDR']))   and (is_numeric(substr($_SERVER['REMOTE_ADDR'],0,1))) )
{
    $tmparr[] = $_SERVER['REMOTE_ADDR'];
}

     // 1. PROXY USES PROXIES - THEREFORE $_SERVER['HTTP_X_FORWARDED_FOR'] IS AN ARRAY STARTING WITH CLIENT IP
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strpos($_SERVER['HTTP_X_FORWARDED_FOR'],','))
{
    $tmparr +=  explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
}
else // 2. SINGLE PROXY
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $tmparr[] = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

// IF PROXY EXISTS $_SERVER['REMOTE_ADDR'] IS 1ST PROXY if ( (count($tmparr)>0) and ($client_ip != $_SERVER['REMOTE_ADDR']) )
if ( (count($tmparr)>0) and (isset($_SERVER["HTTP_CLIENT_IP"])) and (isset($_SERVER["REMOTE_ADDR"])) and ($_SERVER["HTTP_CLIENT_IP"] != $_SERVER['REMOTE_ADDR']) )
{
    // $remoteProxy = $_SERVER['REMOTE_ADDR'];
    $tmparr[1] = $_SERVER['REMOTE_ADDR'];
}

if (array_key_exists(1,$tmparr))
{ 
   $remoteProxy = $tmparr[1];
}

// $tmparr[] = $_SERVER['REMOTE_ADDR'];

if (array_key_exists(0,$tmparr))
{    
  define("_REMOTE_ADDR",$tmparr[0]);  // IST SOWIESO IMMER AN ERSTER STELLE DA
}
else
{                                
  define("_REMOTE_ADDR","");
}

define("_REMOTE_PROXY", trim($remoteProxy));	// ENTWEDER ERSTE FORWARDED VAR ODER LETZTE (REMOTE_ADDR)

unset ($remoteProxy); 
unset ($tmparr);

$remote_user   = "";
$remote_domain = "";

if (array_key_exists("REMOTE_USER",$_SERVER))
{
    $remote_user = $_SERVER["REMOTE_USER"];

    if (!(strpos($remote_user,"@")===false))            // DOMAIN SUFFIX ENTHALTEN
    {
        $remote_domain = trim(substr($remote_user,strpos($remote_user,"@")+1));
        $remote_user   = trim(substr($remote_user,0,strpos($remote_user,"@")));
    }
}

define("_REMOTE_USER",     $remote_user);
define("_REMOTE_DOMAIN",   $remote_domain);

unset ($remote_user); 
unset ($remote_domain);
?>