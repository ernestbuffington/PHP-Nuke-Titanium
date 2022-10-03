<?php 
/*===================================================================== */
/* PHP-Nuke Titanium | Nuke-Evolution Xtreme : A PHP-Nuke Fork          */
/* ==================================================================== */
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');
global $fb, $appID, $api_version, $appSecret, $my_url, $page_id;

# Your facebook page id goes here!
$page_id = 'yourpageid';
# Your domain name i.e yoursite.com!
$my_url = 'www.php-nuke-titanium.86it.us';
# your facebook app secret goes here!
$appSecret = 'yourappsecret';
# your facebook app ID goes here!
$appID = 'yourappid';
# The api version you have selected on your facebook app!
$api_version = 'v15.0';

$fb = new Facebook\Facebook([
  'app_id' => $appID,
  'app_secret' => $appSecret,
  'default_graph_version' => $api_version, 
  ]);