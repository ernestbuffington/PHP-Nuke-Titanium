<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
global $titanium_db2;
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$request_id = intval($request_id);
$request = pjrequest_info($request_id);
$titanium_db2->sql_query("DELETE FROM `".$network_prefix."_requests` WHERE `request_id`='$request_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_requests`");
$titanium_db2->sql_query("DELETE FROM `".$network_prefix."_requests_comments` WHERE `request_id`='$request_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_requests_comments`");
$titanium_db2->sql_query("DELETE FROM `".$network_prefix."_requests_members` WHERE `request_id`='$request_id'");
$titanium_db2->sql_query("OPTIMIZE TABLE `".$network_prefix."_requests_members`");
header("Location: modules.php?name=$titanium_module_name&op=Project&project_id=".$request['project_id']);

?>