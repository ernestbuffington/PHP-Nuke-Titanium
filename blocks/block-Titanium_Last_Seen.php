<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
 
/************************************************************************
   PHP-Nuke Titanium v3.0.0
   ======================================================================
   Copyright (c) 2019 by The PHP-Nuke Titanium Team
  
   Filename      : block-Titanium_Last_Seen.php
   Author        : Ernest Buffington / lonestar 
   Websites      : (hub.86it,us)     / (lonestar-modules.com)
   Version       : 3.0.0
   Date          : 08.13.2019 (mm.dd.yyyy)
                                                                        
   Notes         : Simple block to allow people to see who was last seen 
                 : on the website.
************************************************************************/
defined('NUKE_TITANIUM') or die('Just go away, Shit Head!');

global $db, $prefix, $userinfo;

$result = $db->sql_query("SELECT * FROM `".$prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 10");

$content  = '<table border="0" cellpadding="0" cellspacing="1" class="col-12">';
while($whosbeen = $db->sql_fetchrow($result)):

	if ( $whosbeen['user_from_flag'] ):
	$whosbeen['user_from_flag'] = str_replace('.png','',$whosbeen['user_from_flag']);
	else:
	$whosbeen['user_from_flag'] = 'unknown';
	endif;

	$content .= '  <tr>';
	$content .= '    <td><span class="countries '.$whosbeen['user_from_flag'].'"></span>&nbsp;<a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.UsernameColor($whosbeen['username']).'</a></td>';
	$content .= '  </tr>';
	$content .= '  <tr>';
	$content .= '    <td><div style="padding-left:15px;"><i class="fas fa-long-arrow-alt-right"></i>&nbsp;'.get_timeago($whosbeen['last_visit']).'</div></td>';
	$content .= '  </tr>';

endwhile;
$content .= '</table>';
?>
