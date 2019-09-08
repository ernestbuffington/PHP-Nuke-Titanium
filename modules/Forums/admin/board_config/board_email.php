<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_email.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "email" => "admin/board_config/board_email.tpl")
);

$smtp_yes = ( $new['smtp_delivery'] ) ? "checked=\"checked\"" : "";
$smtp_no = ( !$new['smtp_delivery'] ) ? "checked=\"checked\"" : "";

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
    "L_EMAIL_SETTINGS" => $lang['Email_settings'],
    "L_ADMIN_EMAIL" => $lang['Admin_email'],
    "L_EMAIL_SIG" => $lang['Email_sig'],
    "L_EMAIL_SIG_EXPLAIN" => $lang['Email_sig_explain'],
    "L_USE_SMTP" => $lang['Use_SMTP'],
    "L_USE_SMTP_EXPLAIN" => $lang['Use_SMTP_explain'],
    "L_SMTP_SERVER" => $lang['SMTP_server'],
    "L_SMTP_USERNAME" => $lang['SMTP_username'],
    "L_SMTP_USERNAME_EXPLAIN" => $lang['SMTP_username_explain'],
    "L_SMTP_PASSWORD" => $lang['SMTP_password'],
    "L_SMTP_PASSWORD_EXPLAIN" => $lang['SMTP_password_explain'],
    
    
));

//Data Template Variables
$template->assign_vars(array(
    "EMAIL_FROM" => $new['board_email'],
    "EMAIL_SIG" => $new['board_email_sig'],
    "SMTP_YES" => $smtp_yes,
    "SMTP_NO" => $smtp_no,
    "SMTP_HOST" => $new['smtp_host'],
    "SMTP_USERNAME" => $new['smtp_username'],
    "SMTP_PASSWORD" => $new['smtp_password'],
 ));
$template->pparse("email");

?>