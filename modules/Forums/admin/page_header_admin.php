<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                           page_header_admin.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: page_header_admin.php,v 1.12.2.6 2005/03/26 14:15:59 acydburn Exp
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

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Forum Admin Style Selection              v1.0.0       10/01/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

define('HEADER_INC', true);

$template->set_filenames(array(
        'header' => 'admin/page_header.tpl')
);

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];
/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
$Theme = get_theme();
$style = ($board_config['use_theme_style']) ? "./../../../themes/$Theme/style/style.css" : "./../templates/subSilver/subSilver.css";
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
//
// The following assigns all _common_ variables that may be used at any point
// in a template. Note that all URL's should be wrapped in append_sid, as
// should all S_x_ACTIONS for forms.
//
$template->assign_vars(array(
        'SITENAME' => $board_config['sitename'],
        'PAGE_TITLE' => $page_title,

        'L_ADMIN' => $lang['Admin'],
        'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
        'L_FAQ' => $lang['FAQ'],

        'U_INDEX' => append_sid('../index.'.$phpEx),

        'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone),
        'S_LOGIN_ACTION' => append_sid('../login.'.$phpEx),
        'S_JUMPBOX_ACTION' => append_sid('../viewforum.'.$phpEx),
        'S_CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])),
        'S_CONTENT_DIRECTION' => $lang['DIRECTION'],
        'S_CONTENT_ENCODING' => $lang['ENCODING'],
        'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
        'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
        'T_HEAD_STYLESHEET' => $style,
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
        //'T_BODY_BACKGROUND' => $theme['body_background'],
        //'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
        'T_BODY_BGCOLOR' => '#EEEEEE',
        'T_BODY_TEXT' => '#'.$theme['body_text'],
        'T_BODY_LINK' => '#'.$theme['body_link'],
        'T_BODY_VLINK' => '#'.$theme['body_vlink'],
        'T_BODY_ALINK' => '#'.$theme['body_alink'],
        'T_BODY_HLINK' => '#'.$theme['body_hlink'],
        'T_TR_COLOR1' => '#'.$theme['tr_color1'],
        'T_TR_COLOR2' => '#'.$theme['tr_color2'],
        'T_TR_COLOR3' => '#'.$theme['tr_color3'],
        'T_TR_CLASS1' => $theme['tr_class1'],
        'T_TR_CLASS2' => $theme['tr_class2'],
        'T_TR_CLASS3' => $theme['tr_class3'],
        'T_TH_COLOR1' => '#'.$theme['th_color1'],
        'T_TH_COLOR2' => '#'.$theme['th_color2'],
        'T_TH_COLOR3' => '#'.$theme['th_color3'],
        'T_TH_CLASS1' => $theme['th_class1'],
        'T_TH_CLASS2' => $theme['th_class2'],
        'T_TH_CLASS3' => $theme['th_class3'],
        'T_TD_COLOR1' => '#'.$theme['td_color1'],
        'T_TD_COLOR2' => '#'.$theme['td_color2'],
        'T_TD_COLOR3' => '#'.$theme['td_color3'],
        'T_TD_CLASS1' => $theme['td_class1'],
        'T_TD_CLASS2' => $theme['td_class2'],
        'T_TD_CLASS3' => $theme['td_class3'],
        'T_FONTFACE1' => $theme['fontface1'],
        'T_FONTFACE2' => $theme['fontface2'],
        'T_FONTFACE3' => $theme['fontface3'],
        'T_FONTSIZE1' => $theme['fontsize1'],
        'T_FONTSIZE2' => $theme['fontsize2'],
        'T_FONTSIZE3' => $theme['fontsize3'],
        'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
        'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
        'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
        'T_SPAN_CLASS1' => $theme['span_class1'],
        'T_SPAN_CLASS2' => $theme['span_class2'],
        'T_SPAN_CLASS3' => $theme['span_class3'])
);
// Work around for "current" Apache 2 + PHP module which seems to not
// cope with private cache control setting
if (!empty($HTTP_SERVER_VARS['SERVER_SOFTWARE']) && strstr($HTTP_SERVER_VARS['SERVER_SOFTWARE'], 'Apache/2'))
{
	header ('Cache-Control: no-cache, pre-check=0, post-check=0');
}
else
{
	header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
}
header ('Expires: 0');
header ('Pragma: no-cache');
$template->pparse('header');

?>