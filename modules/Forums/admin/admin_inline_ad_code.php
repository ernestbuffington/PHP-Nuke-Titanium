<?php
/***************************************************************************
*                          admin_firstpost_ad.php
*                            -------------------
*   begin                : (Saturday, Oct 16, 2004)
*   copyright            : (C) (2004) (geocator)
*   email                : (geocator@gmail.com)
*
*
***************************************************************************/

/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
***************************************************************************/

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
  $filename = basename(__FILE__);
  $titanium_module['ad_managment']['ad_code'] = $filename;

  return;
}

//
// Load default header
//
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
if ( isset($HTTP_POST_VARS['submit']))
{
  if  ($HTTP_POST_VARS['action'] == 'edit')
  {
    $sql = "UPDATE " . ADS_TABLE . " SET
        ad_name = '" . str_replace("\'", "''", htmlspecialchars($HTTP_POST_VARS['ad_name'])) . "',
        ad_code = '" . str_replace("\'", "''", $HTTP_POST_VARS['ad_code']) . "'
        WHERE ad_id = " . intval($HTTP_POST_VARS['ad_id']);
    if( !$titanium_db->sql_query($sql) )
    {
      message_die(GENERAL_ERROR, "Failed to update first post ad settings", "", __LINE__, __FILE__, $sql);
    }
  }
  else
  {
    $sql = "INSERT INTO " . ADS_TABLE . "
        (ad_name, ad_code)
        VALUES ('" . str_replace("\'", "''", $HTTP_POST_VARS['ad_name']) . "','" . str_replace("\'", "''", $HTTP_POST_VARS['ad_code']) . "')";
    if( !$titanium_db->sql_query($sql) )
    {
      message_die(GENERAL_ERROR, "Failed to update first post ad settings", "", __LINE__, __FILE__, $sql);
    }
  }
  $message = $titanium_lang['Config_updated'] . "<br /><br />" . sprintf($titanium_lang['Click_return_inline_code'], "<a href=\"" . append_titanium_sid("admin_inline_ad_code.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

    message_die(GENERAL_MESSAGE, $message);
}
if ($HTTP_GET_VARS['action'] == "edit")
{
  $sql = "SELECT *
      FROM " . ADS_TABLE . " a
      WHERE a.ad_id = " . intval($HTTP_GET_VARS['id']);
  if ( !($result = $titanium_db->sql_query($sql)) )
  {
    message_die(GENERAL_ERROR, 'Could not query ad information', '', __LINE__, __FILE__, $sql);
  }
  $adRow = array();
  while( $row = $titanium_db->sql_fetchrow($result) )
  {
    $adRow = $row;
  }
  $titanium_db->sql_freeresult($result);
  $phpbb2_template->set_filenames(array(
  "body" => "admin/inline_ad_code_edit.tpl")
  );
  $phpbb2_template->assign_vars(array(
  "L_CONFIGURATION_TITLE" => $titanium_lang['ad_managment'],
  "L_SUBMIT" => $titanium_lang['Submit'],
  "L_RESET" => $titanium_lang['Reset'],
  "L_NAME" => $titanium_lang['ad_name'],
  "L_CODE" => $titanium_lang['ad_code'],
  "AD_CODE" => $adRow['ad_code'],
  "AD_NAME" => $adRow['ad_name'],
  "S_HIDDEN_FIELDS" => '<input type="hidden" name="action" value="edit" /><input type="hidden" name="ad_id" value="' . $adRow['ad_id'] . '" />',
  "S_ACTION" => append_titanium_sid("admin_inline_ad_code.$phpEx"))
  );
  $phpbb2_template->pparse("body");
}
elseif ($HTTP_GET_VARS['action'] == "delete")
{
  $sql = "DELETE
      FROM " . ADS_TABLE . "
      WHERE ad_id = " . intval($HTTP_GET_VARS['id']);
  if ( !($result = $titanium_db->sql_query($sql)) )
  {
    message_die(GENERAL_ERROR, 'Could not query ad information', '', __LINE__, __FILE__, $sql);
  }
  $message = $titanium_lang['Config_updated'] . "<br /><br />" . sprintf($titanium_lang['Click_return_inline_code'], "<a href=\"" . append_titanium_sid("admin_inline_ad_code.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

    message_die(GENERAL_MESSAGE, $message);
}
elseif ($HTTP_GET_VARS['action'] == "add")
{
  $phpbb2_template->set_filenames(array(
  "body" => "admin/inline_ad_code_edit.tpl")
  );
  $phpbb2_template->assign_vars(array(
  "L_CONFIGURATION_TITLE" => $titanium_lang['ad_managment'],
  "L_SUBMIT" => $titanium_lang['Submit'],
  "L_RESET" => $titanium_lang['Reset'],
  "L_NAME" => $titanium_lang['ad_name'],
  "L_CODE" => $titanium_lang['ad_code'],
  "AD_CODE" => '',
  "AD_NAME" => '',
  "S_HIDDEN_FIELDS" => '',
  "S_ACTION" => append_titanium_sid("admin_inline_ad_code.$phpEx"))
  );
  $phpbb2_template->pparse("body");
}
else
{
  $sql = "SELECT a.ad_name, a.ad_id
      FROM " . ADS_TABLE . " a";
  if ( !($result = $titanium_db->sql_query($sql)) )
  {
    message_die(GENERAL_ERROR, 'Could not query ad information', '', __LINE__, __FILE__, $sql);
  }
  $adRow = array();
  while( $row = $titanium_db->sql_fetchrow($result) )
  {
    $adRow[] = $row;
  }
  $ad_count = $titanium_db->sql_numrows($result);
  $titanium_db->sql_freeresult($result);

  $phpbb2_template->set_filenames(array(
  "body" => "admin/inline_ad_code_body.tpl")
  );
  $phpbb2_template->assign_vars(array(
  "L_CONFIGURATION_TITLE" => $titanium_lang['inline_ads'],
  "L_CONFIGURATION_EXPLAIN" => $titanium_lang['ad_code_about'],
  "L_EDIT" => $titanium_lang['Edit'],
  "L_DELETE" => $titanium_lang['Delete'],
  "L_ADD" => $titanium_lang['ad_add'],
  "S_ADD_ACTION" => append_titanium_sid("admin_inline_ad_code.$phpEx?action=add"))
  );

  //$inline_ad_code = $adRow[$adindex]['ad_code'];
  for($i = 0; $i < $ad_count; $i++)
  {
    $ad_id = $adRow[$i]['ad_id'];
    $phpbb2_template->assign_block_vars('ad_row',array( 'AD_NAME' => $adRow[$i]['ad_name'],
    'S_AD_EDIT' => append_titanium_sid("admin_inline_ad_code.$phpEx?action=edit&id=$ad_id"),
    'S_AD_DELETE' => append_titanium_sid("admin_inline_ad_code.$phpEx?action=delete&id=$ad_id")
    )
    );
  }
  $phpbb2_template->pparse("body");
}
include('./page_footer_admin.'.$phpEx);

?>