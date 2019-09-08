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
get_lang($module_name);

switch ($op) {
  case "SPMain":
  case "SPActivate":
  case "SPActive":
  case "SPAdd":
  case "SPAddSave":
  case "SPApprove":
  case "SPApproveSave":
  case "SPConfig":
  case "SPConfigSave":
  case "SPDeactivate":
  case "SPDelete":
  case "SPDeleteConfirm":
  case "SPEdit":
  case "SPEditSave":
  case "SPInactive":
  case "SPPending":
      include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
  break;
}

?>