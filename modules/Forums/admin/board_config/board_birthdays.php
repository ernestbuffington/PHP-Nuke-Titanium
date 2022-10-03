<?php

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/




/************************************************************************

   Nuke-Evolution: DHTML Forum Config Admin

   ============================================

   Copyright (c) 2005 by The Nuke-Evolution Team



   Filename      : board_once.php

   Author        : Technocrat (www.nuke-evolution.com)

   Version       : 1.0.0

   Date          : 06.12.2006 (mm.dd.yyyy)



   Description   : Enhanced General Admin Configuration with DHTML menu.

************************************************************************/



/*****[CHANGES]**********************************************************

-=[Mod]=-

       Default avatar                           v1.1.0       06/30/2005

 ************************************************************************/



if (!defined('BOARD_CONFIG')) {

    die('Access Denied');

}



$phpbb2_template->set_filenames(array(

    "birthdays" => "admin/board_config/board_birthdays.tpl")

);

$bday_show_yes = ( $new['bday_show'] ) ? "checked=\"checked\"" : "";
$bday_show_no = ( !$new['bday_show'] ) ? "checked=\"checked\"" : "";
$bday_require_yes = ( $new['bday_require'] ) ? "checked=\"checked\"" : "";
$bday_require_no = ( !$new['bday_require'] ) ? "checked=\"checked\"" : "";
$phpbb2_bday_year_yes = ( $new['bday_year'] ) ? "checked=\"checked\"" : "";
$phpbb2_bday_year_no = ( !$new['bday_year'] ) ? "checked=\"checked\"" : "";
$bday_lock_yes = ( $new['bday_lock'] ) ? "checked=\"checked\"" : "";
$bday_lock_no = ( !$new['bday_lock'] ) ? "checked=\"checked\"" : "";
$bday_hide_yes = ( $new['bday_hide'] ) ? "checked=\"checked\"" : "";
$bday_hide_no = ( !$new['bday_hide'] ) ? "checked=\"checked\"" : "";

$bday_email_enabled = ( $new['bday_greeting'] & 1<<(BIRTHDAY_EMAIL-1) ) ? "checked=\"checked\"" : "";
$bday_pm_enabled = ( $new['bday_greeting'] & 1<<(BIRTHDAY_PM-1) ) ? "checked=\"checked\"" : "disabled=\"disabled\"";
$bday_popup_enabled = ( $new['bday_greeting'] & 1<<(BIRTHDAY_POPUP-1) ) ? "checked=\"checked\"" : "";




//General Template variables

$phpbb2_template->assign_vars(array(

    "DHTML_ID" => "c" . $dhtml_id)

);

    

//Language Template variables

$phpbb2_template->assign_vars(array(

    "L_BIRTHDAYS" => $titanium_lang['Birthdays'],
	"L_BDAY_SHOW" => $titanium_lang['bday_show'],
	"L_UNCONDITIONAL" => $titanium_lang['Unconditional'],
	"L_CONDITIONAL" => $titanium_lang['Conditional'],
	"L_BDAY_SHOW_EXPLAIN" => $titanium_lang['bday_show_explain'],
	"L_BDAY_REQUIRE" => $titanium_lang['bday_require'],
	"L_BDAY_REQUIRE_EXPLAIN" => $titanium_lang['bday_require_explain'],
	"L_BDAY_YEAR" => $titanium_lang['bday_year'],
	"L_BDAY_YEAR_EXPLAIN" => $titanium_lang['bday_year_explain'],
	"L_BDAY_LOCK" => $titanium_lang['bday_lock'],
	"L_BDAY_LOCK_EXPLAIN" => $titanium_lang['bday_lock_explain'],
	"L_BDAY_LOOKAHEAD" => $titanium_lang['bday_lookahead'],
	"L_BDAY_LOOKAHEAD_EXPLAIN" => $titanium_lang['bday_lookahead_explain'],
	"L_BDAY_AGE_RANGE" => $titanium_lang['bday_age_range'],
	"L_TO" => $titanium_lang['To'],
	"L_BDAY_HIDE" => $titanium_lang['bday_hide'],
	"L_BDAY_SEND_GREETING" => $titanium_lang['bday_send_greeting'],
	"L_BDAY_SEND_GREETING_EXPLAIN" => $titanium_lang['bday_send_greeting_admin_explain'],
	"L_EMAIL" => $titanium_lang['Email'],
	"L_PM" => $titanium_lang['PM'],
	"L_POPUP" => $titanium_lang['Popup']

));



//Data Template Variables

$phpbb2_template->assign_vars(array(

    "BDAY_SHOW_YES" => $bday_show_yes,
	"BDAY_SHOW_NO" => $bday_show_no,
	"BDAY_REQUIRE_YES" => $bday_require_yes,
	"BDAY_REQUIRE_NO" => $bday_require_no,
	"BDAY_YEAR_YES" => $phpbb2_bday_year_yes,
	"BDAY_YEAR_NO" => $phpbb2_bday_year_no,
	"BDAY_LOCK_YES" => $bday_lock_yes,
	"BDAY_LOCK_NO" => $bday_lock_no,
	"BDAY_LOOKAHEAD" => $new['bday_lookahead'],
	"BDAY_MIN" => $new['bday_min'],
	"BDAY_MAX" => $new['bday_max'],
	"BDAY_HIDE_YES" => $bday_hide_yes,
	"BDAY_HIDE_NO" => $bday_hide_no,
	"BDAY_EMAIL" => BIRTHDAY_EMAIL,
	"BDAY_PM" => BIRTHDAY_PM,
	"BDAY_POPUP" => BIRTHDAY_POPUP,
	"BDAY_EMAIL_ENABLED" => $bday_email_enabled,
	"BDAY_PM_ENABLED" => $bday_pm_enabled,
	"BDAY_POPUP_ENABLED" => $bday_popup_enabled

 ));

$phpbb2_template->pparse("birthdays");



?>