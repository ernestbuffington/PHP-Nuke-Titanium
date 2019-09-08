<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net)      */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

define('CP_INCLUDE_DIR', dirname(dirname(dirname(__FILE__))));
require_once(CP_INCLUDE_DIR.'/includes/showcp.php');

$author_name = "<a href=\"$author_homepage\">NukeScripts Network</a>";
$author_email = "";
$author_homepage = "http://www.nukescripts.net";
$license = "Copyright &copy; 2000-2005 NukeScripts Network";
$download_location = "";
$module_version = "";
$module_description = "";

show_copyright($author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description);

?>