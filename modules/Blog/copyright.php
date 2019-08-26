<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net)      */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

define('CP_INCLUDE_DIR', dirname(dirname(dirname(__FILE__))));
require_once(CP_INCLUDE_DIR.'/includes/showcp.php');

$module_name = basename(dirname(__FILE__));
$mod_name = "Titanium Blogs";
$author_email = "";
$author_homepage = "http://www.nukescripts.net";
$author_name = "<a href=\"$author_homepage\">NukeScripts Network</a>";
$license = "All Modifications - Copyright &copy; 2000-2005 NukeScripts Network";
$download_location = "";
$module_version = "";
$release_date = "";
$module_description = "";
$mod_cost = "";
if (empty($mod_name)) { $mod_name = str_replace("_", " ", $module_name); }

show_copyright($author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description);
?>