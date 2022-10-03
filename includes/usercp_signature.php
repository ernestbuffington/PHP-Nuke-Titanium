<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Advance Signature Divider Control        v1.0.0       07/21/2005
      BBCode Box                               v1.0.0       10/06/2005
 ************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

// get the board & user settings ...
$html_status    = ( $userdata['user_allowhtml'] && $phpbb2_board_config['allow_html'] ) ? $titanium_lang['HTML_is_ON'] : $titanium_lang['HTML_is_OFF'];
$bbcode_status  = ( $userdata['user_allowbbcode'] && $phpbb2_board_config['allow_bbcode']  ) ? $titanium_lang['BBCode_is_ON'] : $titanium_lang['BBCode_is_OFF'];
$smilies_status = ( $userdata['user_allowsmile'] && $phpbb2_board_config['allow_smilies']  ) ? $titanium_lang['Smilies_are_ON'] : $titanium_lang['Smilies_are_OFF'];

$html_on    = ( $userdata['user_allowhtml'] && $phpbb2_board_config['allow_html'] ) ? 1 : 0 ;
$bbcode_on  = ( $userdata['user_allowbbcode'] && $phpbb2_board_config['allow_bbcode']  ) ? 1 : 0 ;
$smilies_on = ( $userdata['user_allowsmile'] && $phpbb2_board_config['allow_smilies']  ) ? 1 : 0 ;

// check and set various parameters
$params = array('submit' => 'save', 'preview' => 'preview', 'mode' => 'mode');
while( list($var, $param) = @each($params) )
{
    if ( !empty($HTTP_POST_VARS[$param]) || !empty($HTTP_GET_VARS[$param]) )
    {
        $$var = ( !empty($HTTP_POST_VARS[$param]) ) ? $HTTP_POST_VARS[$param] : $HTTP_GET_VARS[$param];
    }
    else
    {
        $$var = '';
    }
}

$trim_var_list = array('signature' => 'signature');
while( list($var, $param) = @each($trim_var_list) )
{
    if ( !empty($HTTP_POST_VARS[$param]) )
    {
        $$var = trim($HTTP_POST_VARS[$param]);
    }
}

$signature = str_replace('<br />', "\n", $signature);

// if cancel pressed then redirect to the index page
if ( isset($HTTP_POST_VARS['cancel']) )
{
    $redirect = "index.$phpEx";

// redirect 2.0.4 only
    redirect_titanium(append_titanium_sid($redirect, true));

// redirect 2.0.x
//    $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')) ) ? 'Refresh: 0; URL=' : 'Location: ';
//    redirect_titanium(append_titanium_sid($redirect, true));
//    exit;

}

$phpbb2_page_title = $titanium_lang['Signature'];

include('includes/bbcode.'.$phpEx);
include('includes/functions_post.'.$phpEx);
include('includes/page_header.'.$phpEx);

// save new signature
if ($submit)
{
    $phpbb2_template->assign_block_vars('switch_save_sig', array());

    if ( isset($signature) )
    {

        if ( strlen( $signature ) > $phpbb2_board_config['max_sig_chars'] )
        {
            $save_message = $titanium_lang['Signature_too_long'];
        }

        else
        {
        $bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
        $signature = prepare_message($signature, $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
        $titanium_user_id =  $userdata['user_id'];

        $sql = "UPDATE " . USERS_TABLE . "
        SET user_sig = '" . str_replace("\'", "''", $signature) . "', user_sig_bbcode_uid = '$bbcode_uid'
        WHERE user_id = $titanium_user_id";

            if ( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql);
            }

            else
            {
                $save_message = $titanium_lang['sig_save_message'];
            }
        }
    }

    else
    {
        message_die(GENERAL_MESSAGE, 'An Error occured while submitting Signature');
    }
}

// catch the submitted message and prepare it for a preview
else if ($preview)
{
    $phpbb2_template->assign_block_vars('switch_preview_sig', array());

    if ( isset($signature) )
    {
        $preview_sig = $signature;

        if ( strlen( $preview_sig ) > $phpbb2_board_config['max_sig_chars'] )
        {
            $preview_sig = $titanium_lang['Signature_too_long'];
        }

    else
    {
        $preview_sig = htmlspecialchars(stripslashes($preview_sig));
        $bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
        $preview_sig = stripslashes(prepare_message(addslashes(unprepare_message($preview_sig)), $html_on, $bbcode_on, $smilies_on, $bbcode_uid));

        if( $preview_sig != '' ) 
        { 
            if ( $bbcode_on  == 1 ) { $preview_sig = bbencode_second_pass($preview_sig, $bbcode_uid); }
            if ( $bbcode_on  == 1 ) { $preview_sig = bbencode_first_pass($preview_sig, $bbcode_uid); }
            if ( $bbcode_on  == 1 ) { $preview_sig = make_clickable($preview_sig); }
            if ( $smilies_on == 1 ) { $preview_sig = smilies_pass($preview_sig); }
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
            $preview_sig = $phpbb2_board_config['sig_line'] . '<br />' . $preview_sig;
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
            $preview_sig = nl2br($preview_sig);
          }

        else
            { 
            $preview_sig = $titanium_lang['sig_none']; 
            }
    }
    }

    else
    {
        message_die(GENERAL_MESSAGE, 'An Error occured while submitting Signature');
    }
}

// read current signature and prepare it for a preview 
else if ($mode)
{

    $phpbb2_template->assign_block_vars('switch_current_sig', array());

    $signature_bbcode_uid = $userdata['user_sig_bbcode_uid'];
    $signature = ( $signature_bbcode_uid != '' ) ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid\]/si", ']', $userdata['user_sig']) : $userdata['user_sig'];
    $bbcode_uid = $userdata['user_sig_bbcode_uid'];
    $titanium_user_sig = prepare_message($userdata['user_sig'], $html_on, $bbcode_on, $smilies_on, $bbcode_uid);

    if( $titanium_user_sig != '' ) 
    { 
        if ( $bbcode_on  == 1 ) { $titanium_user_sig = bbencode_second_pass($titanium_user_sig, $bbcode_uid); }
        if ( $bbcode_on  == 1 ) { $titanium_user_sig = bbencode_first_pass($titanium_user_sig, $bbcode_uid); }
        if ( $bbcode_on  == 1 ) { $titanium_user_sig = make_clickable($titanium_user_sig); }
        if ( $smilies_on == 1 ) { $titanium_user_sig = smilies_pass($titanium_user_sig); }
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
        $titanium_user_sig = $phpbb2_board_config['sig_line'] . $titanium_user_sig;
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
        $titanium_user_sig = nl2br($titanium_user_sig); 
    }
    else 
    { 
        $titanium_user_sig = $titanium_lang['sig_none']; 
    }

}

// template
    $phpbb2_template->set_filenames(array(
        'body' => 'profile_signature.tpl'

    ));

    $phpbb2_template->assign_vars(array( 

        // added some pic�s for a better preview ;)
        'PROFIL_IMG' => '<img src="' . $images['icon_profile'] . '" alt="' . $titanium_lang['Read_profile'] . '" title="' . $titanium_lang['Read_profile'] . '" border="0" />',
        'EMAIL_IMG'  => '<img src="' . $images['icon_email'] . '" alt="' . $titanium_lang['Send_email'] . '" title="' . $titanium_lang['Send_email'] . '" border="0" />',
        'PM_IMG'     => '<img src="' . $images['icon_pm'] . '" alt="' . $titanium_lang['Send_private_message'] . '" title="' . $titanium_lang['Send_private_message'] . '" border="0" />',
        'WWW_IMG'    => '<img src="' . $images['icon_www'] . '" alt="' . $titanium_lang['Visit_website'] . '" title="' . $titanium_lang['Visit_website'] . '" border="0" />',
        // 'AIM_IMG'    => '<img src="' . $images['icon_aim'] . '" alt="' . $titanium_lang['AIM'] . '" title="' . $titanium_lang['AIM'] . '" border="0" />',
        // 'YIM_IMG'    => '<img src="' . $images['icon_yim'] . '" alt="' . $titanium_lang['YIM'] . '" title="' . $titanium_lang['YIM'] . '" border="0" />',
        // 'MSN_IMG'    => '<img src="' . $images['icon_msnm'] . '" alt="' . $titanium_lang['MSNM'] . '" title="' . $titanium_lang['MSNM'] . '" border="0" />',
        // 'ICQ_IMG'    => '<img src="' . $images['icon_icq'] . '" alt="' . $titanium_lang['ICQ'] . '" title="' . $titanium_lang['ICQ'] . '" border="0" />',

        'SIG_SAVE' => $titanium_lang['sig_save'],
        'SIG_CANCEL' => $titanium_lang['Cancel'],
        'SIG_PREVIEW' => $titanium_lang['Preview'],
        'SIG_EDIT' => $titanium_lang['sig_edit'],
        'SIG_CURRENT' => $titanium_lang['sig_current'],
        'SIG_LINK' => append_titanium_sid("profile.$phpEx?mode=signature"),

        'L_SIGNATURE' => $titanium_lang['Signature'],
        'L_SIGNATURE_EXPLAIN' => sprintf($titanium_lang['Signature_explain'], $phpbb2_board_config['max_sig_chars']),
        'HTML_STATUS' => $html_status,
        'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_titanium_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 
        'SMILIES_STATUS' => $smilies_status,
 /*****[BEGIN]*****************************************
 [ Mod:     BBCode Box                         v1.0.0 ]
 ******************************************************/
        // 'BB_BOX' => bbcode_table("signature", "preview", 1),
        'BB_BOX'                => Make_TextArea_Ret('signature', $signature, 'preview', '100%', '300px', true),
 /*****[END]*******************************************
 [ Mod:     BBCode Box                         v1.0.0 ]
 ******************************************************/        
        'SIGNATURE' => $signature,
        'CURRENT_PREVIEW' => $titanium_user_sig,
        'PREVIEW' => htmlspecialchars(stripslashes($signature)),
        'REAL_PREVIEW' => $preview_sig,
        'SAVE_MESSAGE' => $save_message,

    ));

    $phpbb2_template->pparse('body');

include('includes/page_tail.'.$phpEx);

?>