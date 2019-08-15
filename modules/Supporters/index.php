<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

global $admin_file;

$module_name = basename(dirname(__FILE__));

include_once(NUKE_INCLUDE_DIR.'nsnsp_func.php');
$sp_config = spget_configs();
get_lang($module_name);
if(!isset($op)) { $op = "SPIndex"; }
$textrowcol = "rows='10' cols='75'";
switch ($op) {
  case "SPGo":include(NUKE_MODULES_DIR.$module_name.'/public/SPGo.php');break;
  case "SPIndex":include(NUKE_MODULES_DIR.$module_name.'/public/SPIndex.php');break;
  case "SPSubmit":include(NUKE_MODULES_DIR.$module_name.'/public/SPSubmit.php');break;
  case "SPSubmitSave":include(NUKE_MODULES_DIR.$module_name.'/public/SPSubmitSave.php');break;
}

?>