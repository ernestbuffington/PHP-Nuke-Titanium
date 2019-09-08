<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2003 by NukeScripts Network              */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       07/14/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

$module_name = basename(dirname(dirname(__FILE__)));
define('NUKE_BASE_MODULES', preg_replace('/modules/i', '', dirname(dirname(dirname(__FILE__)))));
require_once(NUKE_BASE_MODULES.'mainfile.php');
get_lang($module_name);

//define('INDEX_FILE', false);

$textrowcol = "rows='10' cols='50'";
if($Version_Num > "7.6") { $textrowcol = "rows='10' cols='75'"; }

global $prefix, $db, $admdata;
if(is_mod_admin($module_name)) {

  include_once(NUKE_INCLUDE_DIR.'/nsnsp_func.php');
  $sp_config = spget_configs();
  $supporter_config = spget_configs();
  switch ($op) {
    case "SPMain":include(NUKE_MODULES_DIR.$module_name.'/admin/SPConfig.php');break;
    case "SPActivate":include(NUKE_MODULES_DIR.$module_name.'/admin/SPActivate.php');break;
    case "SPActive":include(NUKE_MODULES_DIR.$module_name.'/admin/SPActive.php');break;
    case "SPAdd":include(NUKE_MODULES_DIR.$module_name.'/admin/SPAdd.php');break;
    case "SPAddSave":include(NUKE_MODULES_DIR.$module_name.'/admin/SPAddSave.php');break;
    case "SPApprove":include(NUKE_MODULES_DIR.$module_name.'/admin/SPApprove.php');break;
    case "SPApproveSave":include(NUKE_MODULES_DIR.$module_name.'/admin/SPApproveSave.php');break;
    case "SPConfig":include(NUKE_MODULES_DIR.$module_name.'/admin/SPConfig.php');break;
    case "SPConfigSave":include(NUKE_MODULES_DIR.$module_name.'/admin/SPConfigSave.php');break;
    case "SPDeactivate":include(NUKE_MODULES_DIR.$module_name.'/admin/SPDeactivate.php');break;
    case "SPDelete":include(NUKE_MODULES_DIR.$module_name.'/admin/SPDelete.php');break;
    case "SPDeleteConfirm":include(NUKE_MODULES_DIR.$module_name.'/admin/SPDeleteConfirm.php');break;
    case "SPEdit":include(NUKE_MODULES_DIR.$module_name.'/admin/SPEdit.php');break;
    case "SPEditSave":include(NUKE_MODULES_DIR.$module_name.'/admin/SPEditSave.php');break;
    case "SPInactive":include(NUKE_MODULES_DIR.$module_name.'/admin/SPInactive.php');break;
    case "SPPending":include(NUKE_MODULES_DIR.$module_name.'/admin/SPPending.php');break;
  }
} else {
    DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"");
}

?>