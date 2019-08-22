<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.version.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.0.0
   Date          : 06/16/2005 (dd-mm-yyyy)

   Notes         : Verifies if latest Nuke-Evolution Basic Release is
                   installed and a recent changelog.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Version Checker                v1.0.0       06/16/2005
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')){
   die ("Illegal File Access");
}


if (is_admin()){
    include_once(NUKE_BASE_DIR.'header.php');
	
    OpenTable();
    switch($op){
        //case 'version': titanium_version(); break;
    }
    CloseTable();
	
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    echo 'Access Denied';
}
?>