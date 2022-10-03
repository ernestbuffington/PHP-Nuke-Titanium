<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 (c) 2007 - 2018 by Lonestar Modules - https://lonestar-modules.com
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
-=[fieldset Mod]=- Tables were a very bad design idea to use 
                   when listing the people who link back to us.
-=[Proper Table Mod]=- default image display on index was changed.				   
 ************************************************************************/

if (!defined('MODULE_FILE')) 
die ('You can\'t access this file directly...');


$titanium_module_name = basename(dirname(__FILE__));
global $titanium_db, $currentlang, $_GETVAR, $admin_file;

$titanium_lang_path = NUKE_MODULES_DIR . $titanium_module_name . '/language/';

if (@file_exists($titanium_lang_path . 'lang-' . $currentlang . '.php'))
    @include_once($titanium_lang_path . 'lang-' . $currentlang . '.php');
elseif (@file_exists($titanium_lang_path . 'lang-' . $phpbb2_board_config['default_lang'] . '.php'))
    @include_once($titanium_lang_path . 'lang-' . $phpbb2_board_config['default_lang'] . '.php');
else
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $titanium_module_name);

$pagetitle = "- ".$titanium_module_name."";

include(NUKE_BASE_DIR.'header.php');
include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/inc/functions.php');

$config = $titanium_db->sql_ufetchrow('SELECT * FROM `'.$titanium_prefix.'_link_us_config` LIMIT 0,1');

$op = $_GETVAR->get('op', '_REQUEST', 'string');

switch($op):
  	case 'visit':        
	include_once(NUKE_MODULES_DIR.$titanium_module_name.'/public/visit.php'); 
	break;  
  	case 'submitbutton': 
	include_once(NUKE_MODULES_DIR.$titanium_module_name.'/public/submit.php'); 
	break;
	case 'submit_save':  
	include_once(NUKE_MODULES_DIR.$titanium_module_name.'/public/submitsave.php'); 
	break;
	default: include_once(NUKE_MODULES_DIR.$titanium_module_name.'/public/index.php'); 
	break;
endswitch;

include(NUKE_BASE_DIR.'footer.php');
?>
