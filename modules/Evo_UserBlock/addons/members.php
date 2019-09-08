<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : members.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Members Module
************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

global $evouserinfo_addons, $evouserinfo_members;

function evouserinfo_members () 
{
    global $userinfo, $db, $prefix, $user_prefix, $evouserinfo_members, $lang_evo_userblock;
    
    $evouserinfo_members = '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['MEMBERS']['MEMBERS'].'</div>';

    $in_group = array();
    
	# Select all groups where the user is a member
    if (isset($userinfo['groups'])) 
	{
	   foreach ($userinfo['groups'] as $id => $name) 
	   {
          $in_group[] = $id;
    
	      if (!empty($name))
		  {
		    $group_name = GroupColor($name);
			$evouserinfo_members .= '<div style="padding-left: 10px;">';
		    $evouserinfo_members .= '<img title="'.$id.'" src="images/titanium_user_info/orange.png" align="bottom" alt="'.$id.'">';
            $evouserinfo_members .= ' <a title="'.$name.'" href="modules.php?name=Groups&amp;g='.$id . '"><strong>' . $group_name . '</strong></a><br />';
			$evouserinfo_members .= '</div>';
        
		  }
       }
    }


    # Select all groups where the user has a pending membership.
    if(is_user()) 
	{
	   $result = $db->sql_query('SELECT g.group_id, 
	                                  g.group_name, 
								      g.group_type
            
			               FROM '.$prefix.'_bbgroups g, 
			               '.$prefix.'_bbuser_group ug
            
			               WHERE ug.user_id = '.$userinfo['user_id'].'
				           AND ug.group_id = g.group_id
				           AND ug.user_pending = 1
				           AND g.group_single_user = 0
			               ORDER BY g.group_name, ug.user_id'); 
    
	   if ($db->sql_numrows($result)) 
	   {

	      $evouserinfo_members .= '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['MEMBERS']['PENDING'].'</div>';
       
	      while( $row = $db->sql_fetchrow($result) ) 
		  {
            $in_group[] = $row['group_id'];

		    $group_name = GroupColor($row['group_name']);
		    $evouserinfo_members .= '<div style="padding-left: 10px;">';
			$evouserinfo_members .= '<img title="'.$row['group_id'].'" src="images/titanium_user_info/blue.png" align="bottom" alt="'.$row['group_id'].'">';
		    $evouserinfo_members .= ' <a title="'.$row['group_name'].'" href="modules.php?name=Groups&amp;g='.$row['group_id'] . '"><strong>' . $group_name . '</strong></a><br />';
			$evouserinfo_members .= '</div>';
          }
        
       }
	    
		$db->sql_freeresult($result);
   }
}

if (is_user()):
    evouserinfo_members();
else:
    $evouserinfo_members = '';
endif;
?>
