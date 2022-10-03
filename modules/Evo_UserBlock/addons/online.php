<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : online.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Who Is Online Module
************************************************************************/
// ONLINE STATS

if(!defined('NUKE_EVO')) 
exit ("Illegal File Access");

global $evouserinfo_addons, $evouserinfo_online;

function evouserinfo_get_members_online() 
{
    global $titanium_prefix, $titanium_db, $titanium_lang_evo_userblock, $evouserinfo_addons, $titanium_user_prefix, $userinfo, $phpbb2_board_config, $Default_Theme;

    $sql = "SELECT w.uname, 
	              w.module, 
				     w.url, 
			   w.host_addr, 
			   u.user_from, 
			   u.user_rank, 
			     u.user_id, 
			  u.user_level, 
   u.user_allow_viewonline, 
          u.user_from_flag, 
		     u.user_avatar, 
		u.user_avatar_type, 
		u.user_allowavatar, 
		      u.user_email, 
		  u.user_viewemail, 
		    u.user_regdate, 
			  u.user_posts, 
			       u.theme FROM ".$titanium_prefix."_session 
				   
				   AS w LEFT JOIN ".$titanium_user_prefix."_users AS u 
				   ON u.username = w.uname 
				   WHERE w.guest = '0' 
				   OR w.guest = '2' 
				   
				   ORDER BY u.user_level 
				   
				   DESC, u.user_rank DESC, u.username";
    
	$result = $titanium_db->sql_query($sql);
    $i = 1;
    $hidden = 0;
    $out = array();
    $out['text'] = '';
    
	while ($session = $titanium_db->sql_fetchrow($result)) 
    {                                   # spacer
        $num 			= ($i < 10) ? ''.'0'.$i : $i;
		$uname 			= $session['uname'];
        $uname_color 	= UsernameColor($session['uname']);
        $level 			= $session['user_level'];
        $titanium_module 		= $session['module'];
        $url 			= $session['url'];
        $url 			= str_replace("&", "&amp;", $url);
        $where 			= '&nbsp;&nbsp;<a href="'.$url.'" alt="'.$titanium_module.'" title="'.$titanium_module.'">'.$num.'</a>.&nbsp;';
        $where 			= (is_admin()) ? $where : $num.'.&nbsp;';
        $titanium_user_from 		= $session['user_from'];
        $titanium_user_flag 		= str_replace('.png','',$session['user_from_flag']);
        
		if ($evouserinfo_addons['online_country_flag'] == 'yes'):
        $titanium_user_flag = (($session['user_from_flag']) ? '<span class="countries '.$titanium_user_flag.'" title="'.$titanium_user_from.'"></span>&nbsp;' : '');
        else:
        $titanium_user_flag = '';
        endif;

        switch( $session['user_avatar_type'] ):
        
            case USER_AVATAR_UPLOAD:
            $phpbb2_poster_avatar = ( $phpbb2_board_config['allow_avatar_upload'] ) 
			? '<img src="'.$phpbb2_board_config['avatar_path'].'/'.$session['user_avatar'].'" alt="" border="0" />' : '';
            break;
            case USER_AVATAR_REMOTE:
            $phpbb2_poster_avatar = '<img src="'.$session['user_avatar'].'" style="width: '.$phpbb2_board_config['avatar_max_width'].'; height: '.$phpbb2_board_config['avatar_max_height'].';" alt="" border="0" />';
            break;
            case USER_AVATAR_GALLERY:
            $phpbb2_poster_avatar = ( $phpbb2_board_config['allow_avatar_local'] ) 
			? '<img src="'.$phpbb2_board_config['avatar_gallery_path'].'/'.$session['user_avatar'].'" alt="" border="0" />' : '';
            break;
        
        endswitch;

        /**
		 * Mod: Tooltip to display user information.
		 * @since 2.0.9e
		 */
        if ($evouserinfo_addons['online_tooltip'] == 'yes'):

	        $tooltip_userinfo_overlay  = '<div style="width: 300px;">';
	        
			# user name in tool tip
			$tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['LOGIN']['USERNAME'].'<span>'.$uname_color.'</span></div>';
	        
	         # admins can always see what someones email address is
			 if (is_admin()):
			$tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['EMAIL'].'<span>'.(($session['user_viewemail'] == 0) 
			? '<a href="mailto:'.$session['user_email'].'">'.$session['user_email'].'</a>' : $titanium_lang_evo_userblock['BLOCK']['ONLINE']['HIDDEN']).'</span></div>';
             else: 
			$tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['EMAIL'].'<span>'.(($session['user_viewemail'] == 1) 
			? '<a href="mailto:'.$session['user_email'].'">'.$session['user_email'].'</a>' : $titanium_lang_evo_userblock['BLOCK']['ONLINE']['HIDDEN']).'</span></div>';
	         endif;
	        
			# member since in tool tip view
			$tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['SINCE'].'<span>'.$session['user_regdate'].'</span></div>';
	        
			# post count in tooltip view
			$tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['POST_COUNT'].'<span>
			<a href="modules.php?name=Forums&amp;file=search&amp;search_author='.$uname.'">'.$session['user_posts'].'</a></span></div>';
	        
			# current users theme in tooltip view
			$tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['THEME'].'<span>'.(($session['theme']) 
			? $session['theme'] : $Default_Theme).'</span></div>';
	        
			# what the person in the online list are viewing at the moment - should only be available for admins
			if (is_admin()):
			$tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['VIEWING'].'<span>'.(($session['module']) 
			? '<a href="'.$session['url'].'">'.str_replace('_',' ',$session['module']).'</a>' : 
			'<a href="'.$session['url'].'">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['HOME'].'</a>').'</span></div>';
	         endif;
			 
			 # ip address in tooltips for the person visting the website
			 if (is_admin()):
	         $tooltip_userinfo_overlay .= '  <div class="user_tooltip">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['IP'].'<span>'.$session['host_addr'].'</span></div>';
	         endif;
	        $tooltip_userinfo_overlay .= '</div>';

	        # add the overlay
			$tooltip_userinfo = ' class="tooltip-html-side-interact" title="'.str_replace('"','\'',$tooltip_userinfo_overlay).'"';

	    else:
	    	$tooltip_userinfo = ' title="'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['VIEW'].'&nbsp;'.$uname.'\'s '.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['PROFILE'].'"';
	    endif;

        if ($session['user_allow_viewonline']):
        
            if ($level == 2):
            $admin_user_level_image = 
			( $evouserinfo_addons['online_user_level_image'] == 'yes' ) 
			? '&nbsp;<img style="width: 32px; height: 8px" src="images/evo_userinfo/admin.gif" alt="">' : '';
            $out['text'] .= $where.$titanium_user_flag.'<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u=
			'.$session['user_id'].'"'.$tooltip_userinfo.'>'.$uname_color.'</a>'.$admin_user_level_image.'<br />';
            elseif ($level == 3):
            $staff_user_level_image = 
			( $evouserinfo_addons['online_user_level_image'] == 'yes' ) 
			? '&nbsp;<img style="width: 32px; height: 8px" src="images/evo_userinfo/staff.gif" alt="">' : '';
            $out['text'] .= $where.$titanium_user_flag.'<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u=
			'.$session['user_id'].'"'.$tooltip_userinfo.'>'.$uname_color.'</a>'.$staff_user_level_image.'<br />';
            else:
            $out['text'] .= $where.$titanium_user_flag.'<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$session['user_id'].'"'.$tooltip_userinfo.'>'.$uname_color.'</a><br />';
            endif;
        
            elseif (is_admin() || $userinfo['user_id'] == $session['user_id']):
        
            if ($level == 2):
            $admin_user_level_image = 
			( $evouserinfo_addons['online_user_level_image'] == 'yes' ) 
			? '&nbsp;<img style="width: 32px; height: 8px" src="images/evo_userinfo/admin.gif" alt="">' : '';
            $out['text'] .= $where.$titanium_user_flag.'<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u=
			'.$session['user_id'].'"'.$tooltip_userinfo.'><i>'.$uname_color.'</i></a>'.$admin_user_level_image.'<br />';
            elseif ($level == 3):
            $staff_user_level_image = 
			( $evouserinfo_addons['online_user_level_image'] == 'yes' ) 
			? '&nbsp;<img style="width: 32px; height: 8px" src="images/evo_userinfo/staff.gif" alt="">' : '';
            $out['text'] .= $where.$titanium_user_flag.'<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u=
			'.$session['user_id'].'"'.$tooltip_userinfo.'><i>'.$uname_color.'</i></a>'.$staff_user_level_image.'<br />';
            else:
            $out['text'] .= $where.$titanium_user_flag.'<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$session['user_id'].'"'.$tooltip_userinfo.'><i>'.$uname_color.'</i></a><br />';
            endif;
            $hidden++;

        else:
            $hidden++;
        endif;
        $i++;
    }
    $i--;
    $out['hidden'] = $hidden;
    $out['total'] = $i;
    $out['visible'] = $i-$hidden;
    $titanium_db->sql_freeresult($result);
    return $out;
}

function evouserinfo_get_guests_online($phpbb2_start) 
{
    global $titanium_prefix, $titanium_db, $titanium_lang_evo_userblock, $identify;
    $result = $titanium_db->sql_query("SELECT uname, url, module, host_addr FROM ".$titanium_prefix."_session WHERE guest='1' OR guest='3'");
    $out['total'] = $titanium_db->sql_numrows($result);
    $out['text'] = '';
    $i = $phpbb2_start;
    while ($session = $titanium_db->sql_fetchrow($result)):

        $num = ($i < 10) ? '0'.$i : $i;
        
        $titanium_module = $session['module'];
        $url = $session['url'];
        $url = str_replace("&", "&amp;", $url);
           //$where = '<a data-user-country="'.$session['host_addr'].'" href="'.$url.'" alt="'.$titanium_module.'" title="'.$titanium_module.'">'.$num.'</a>.&nbsp;';
           //$where = (is_admin()) ? $where : $num.'.&nbsp;';
        
		$where 			= '&nbsp;&nbsp;<a class="tooltip-html-side-interact tooltipstered" href="'.$url.'" alt="'.$titanium_module.'" title="'.$url.'">'.$num.'.&nbsp;';
        $where 			= (is_admin()) ? $where : '&nbsp;&nbsp;'.$num.'.&nbsp;';
        
		if(!is_admin()):
            $out['text'] .= $where.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['GUEST']."</a><br />\n";
        else:
        
            $titanium_user_agent = $identify->identify_agent();
            if($titanium_user_agent['engine'] == 'bot'):
                $out['text'] .= $where.$titanium_user_agent['ua']."</a><br />\n";
            else:
                // $out['text'] .= "<br />".$where.$session['uname']."\n";
                $out['text'] .= $where.$session['uname']."</a><br />\n";
            endif;
        
        endif;
        $i++;
    
    endwhile;
    $titanium_db->sql_freeresult($result);
    return $out;
}

function evouserinfo_online_display($members, $guests) 
{
    global $titanium_lang_evo_userblock, $evouserinfo_addons, $userinfo;
    $out = '';
    if($evouserinfo_addons['online_show_members'] == 'yes'):
    
        $out .= '<div style="font-weight: bold">'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['STATS'].'</div>';

        $out .= '<div style="padding-left: 10px;">';
        $out .= '<font color="gold"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].'<span style="float:right">'.$members['total'].'&nbsp;&nbsp;</span>';
        $out .= '</div>'; 

        if($evouserinfo_addons['online_show_hv'] == 'yes'):

            $out .= '<div style="padding-left: 10px;">';
            $out .= '<font color="#FF3300"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['VISIBLE'].'<span style="float:right">'.$members['visible'].'&nbsp;&nbsp;</span>';
            $out .= '</div>';

            $out .= '<div style="padding-left: 10px;">';
            $out .= '<font color="gold"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['HIDDEN'].'<span style="float:right">'.$members['hidden'].'&nbsp;&nbsp;</span>';
            $out .= '</div>';

        endif;

        $out .= '<div style="padding-left: 10px;">';
        $out .= '<font color="#FF3300"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].'<span style="float:right">'.$guests['total'].'&nbsp;&nbsp;</span>';
        $out .= '</div>';

        $out .= '<div style="padding-left: 10px;">';
        $out .= '<font color="pink"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['TOTAL'].'<span style="float:right">'.($guests['total']+$members['total']).'&nbsp;&nbsp;</span><hr />';
        $out .= '</div>';
    
    endif;

    $out .= '<div style="font-weight: bold">Member(s) Online</div>';

    if($evouserinfo_addons['online_scroll'] == 'yes'):
    
        $out .= '<div style="overflow:auto; max-height:150px; width:100%">';
        $out .= $titanium_lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].$titanium_lang_evo_userblock['BLOCK']['BREAK'].'<br />'.$members['text'].'<br />'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].$titanium_lang_evo_userblock['BLOCK']['BREAK'].'<br />'.$guests['text'];
        $out .= '</div>';
     
    else:
    
        if ($members['total'] > 0):

            //$out .= '<div style="font-weight: bold">&nbsp;&nbsp;Portal '.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].'</div>';
            $out .= '<div>'.$members['text'].'</div>';

        endif;

        if ($guests['total'] > 0):

            $out .= '<br/><div style="font-weight: bold">&nbsp;&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].'</div>';
            $out .= '<div>'.$guests['text'].'</div>';

        endif;
    
    endif;
    return $out;
}

$evouserinfo_online_members = evouserinfo_get_members_online();
$evouserinfo_online_guests = evouserinfo_get_guests_online($evouserinfo_online_members['total']+1);
$evouserinfo_online = evouserinfo_online_display($evouserinfo_online_members, $evouserinfo_online_guests);
?>
