<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die ('Access Denied');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(is_mod_admin($module_name)) {

    //$pagetitle = ": "._USERADMIN." - "._ACCTDENY;
    //include_once(NUKE_BASE_DIR.'header.php');
	//OpenTable();
	//echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    //echo "<br /><br />";
	//echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	//CloseTable();
	//echo "<br />";
    //amain();
    //echo "<br />\n";        echo "tes44te";
    //OpenTable();
    $db->sql_query("DELETE FROM ".$user_prefix."_cnbya_field WHERE fid='$fid'");
    $db->sql_query("DELETE FROM ".$user_prefix."_cnbya_value WHERE fid='$fid'");
    $db->sql_query("DELETE FROM ".$user_prefix."_cnbya_value_temp WHERE fid='$fid'");
    //CloseTable();
    //include_once(NUKE_BASE_DIR.'footer.php');
    header("Location:modules.php?name=$module_name&file=admin&op=addField");

}

?>