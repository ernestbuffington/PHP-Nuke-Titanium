<?php
#---------------------------------------------------------------------------------------#
# HEADER                                                                                #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Blue Skulls Theme v1.0 (Fixed & Full Width)                                           #
#                                                                                       #
# Final Build Date 08/17/2019 Saturday 7:40pm                                           #
#                                                                                       #
# A Very Nice Black Carbin Fiber Styled Design.                                         #
# Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington                              #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 1st August, 2019 (v1.0)                                                   #
#                                                                                       #
# Updated On: 1st August, 2019 (v3.0)                                                   #
# HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)                          #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost                                                                 #
# Web Site: https://theghost.86it.us                                                    #
# Purpose: PHP-Nuke Titanium | Xtreme Evo                                               #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# PHP-Nuke Titanium (c) 2019 : Enhanced PHP-Nuke Web Portal System                      #
#---------------------------------------------------------------------------------------#

#-----------------------------#
# CarbinFiber Header Section  #
#-----------------------------#
# Fixed & Full Width Style    #
#-----------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

global $sitename, $slogan, $name, $banners, $db, $user_prefix, $prefix, $admin_file, $userinfo, $ThemeInfo, $theme_name;

# Check if a Registered User is Logged-In
$username = is_user() ? $userinfo['username'] : _ANONYMOUS;

# Setup the Welcome Information for the User
if ($username === _ANONYMOUS):
   $theuser  = '<div style="float: right; padding-right: 34px;">You are not Logged-In as a User!</div><br />';
   $theuser .= '<div style="float: right; padding-right: 26px;">Please <a href="modules.php?name=Your_Account">Login</a> or <a href="modules.php?name=Your_Account&amp;op=new_user">Register</a>&nbsp;&nbsp;</div>';
else:
    $theuser  = sprintf(_YOUHAVE_X_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
    $theuser .= '<br /><a href="modules.php?name=Profile&amp;mode=editprofile">'._EDIT_PROFILE.'</a> | ';
    $theuser .= '<a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a>';
endif;

#-----------------#
# RD Scripts v1.0 #
#-----------------#
addJSToBody(blue_skulls_js_dir.'menu.min.js');

$ads = ads(0);

echo '<section id="flex-container">';

echo '<div class="container" style="width: '.blue_skulls_width.'">';
echo '<table class="zeroblock" border="0" width="100%" cellspacing="0" cellpadding="0">';
echo '<tr>';
echo '<td>';

echo '<!-- HEADER START -->'; # set background here in themes/CarbonFiber/css/maintable.php CARBBON FIBER
echo '<table class="header" border="0" width="100%" cellspacing="0" cellpadding="0">';
echo '<tr>';

# top left corner
echo '<td align="left" width="38" height="62"><img border="0" src="themes/'.$theme_name.'/header/top_left_corner.png" /></td>';

# top of header table 1
echo '<td background="themes/'.$theme_name.'/header/top_middle.png" ></td>';
echo '<td height="62" background="themes/'.$theme_name.'/header/top_middle.png" align="center" valign="bottom"></td>';
echo '<td background="themes/'.$theme_name.'/header/top_middle.png" align="center" ></td>';

# top right corner table 1
echo '<td align="right" width="38"><img border="0" src="themes/'.$theme_name.'/header/top_right_corner.png" width="38" height="62" /></td>';

echo '</tr>';
echo '<tr>';

# left side table 1
echo '<td background="themes/'.$theme_name.'/header/left_side.png" width="38"></td>';

echo '<td ></td>';
echo '<td >';


echo '<table border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';

# top left corner table 2
echo '<td><img name="tlc" src="themes/'.$theme_name.'/header/tlc.gif" width="20" height="25" border="0" alt=""></td>';

# top middle table 2
echo '<td width="100%" background="themes/'.$theme_name.'/header/tm.gif"><img name="tm" src="themes/'.$theme_name.'/header/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

# top right corner table 2
echo '<td><img name="trc" src="themes/'.$theme_name.'/header/trc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr>';
echo '<tr>';

# left side table 2
echo '<td background="themes/'.$theme_name.'/header/left_side.gif"><img name="leftside" src="themes/'.$theme_name.'/header/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

# flames start FLAMES BACKGROUND
echo '<td id="bg" class="flames" height"0" valign="top" >';

# logo start
echo '<div align="center" id="locator"><img src="themes/'.$theme_name.'/logo/the-86it-developers-network.png"></div>';
# logo end

# start line 2 of the header
echo '<div align="center" id="text"><h1><a class="greatminds" href="../../index.php">XHTML 1.0 | curl 7.65.0 | MariaDB 10.1.40 | PHP 7.3.6</a></h1></div>';
# end line 2 of the header

echo '<pre>'.' '.'</pre>';

# start 3rd line of header
echo '<div align="center" id="text"><img name="tbm" src="themes/'.$theme_name.'/header/invisible_pixel.gif" width="1" height="1" border="0" alt=""><h3>Great Minds Do Not Think Alike</h3></div>';
# end 3rd line of header


echo '<div align="center" id="text"><img name="tbm" src="themes/'.$theme_name.'/header/invisible_pixel.gif" width="1" height="1" border="0" alt=""></div>';

# start 4th line of header
global $screen_res, $screen_width, $screen_height;
echo '<div align="center" id="locator">Monitor Resolution '.$screen_res.'</div>';
# end 4th line of header

echo '<br />';

$fart_toggle = '';
echo $fart_toggle;

# MENU SYSTEM
#################################################################################################################################################
echo '<div class="flex-item" style="width: 100%; height: 29px; background-image: url('.blue_skulls_hdr_images.'HDRnav_Bg_Stretch.png)">';       #
include(blue_skulls_theme_dir.'HDRnavi.php');                                                                                                   #
echo '</div>';                                                                                                                                  #
#################################################################################################################################################
echo '</td>';

# right side table 2
echo '<td background="themes/'.$theme_name.'/header/right_side.gif"><img name="rightside" src="themes/'.$theme_name.'/header/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '</tr>';
echo '<tr>';

# bottom left corner table 2
echo '<td><img name="blc" src="themes/'.$theme_name.'/header/blc.gif" width="20" height="25" border="0" alt=""></td>';

# bottom middle of table 2
echo '<td background="themes/'.$theme_name.'/header/tbm.gif"><img name="tbm" src="themes/'.$theme_name.'/header/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

# bottom right corner of table 2
echo '<td><img name="brc" src="themes/'.$theme_name.'/header/brc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr></table>';

# start bottom of table 1
echo '</td>';
echo '<td ></td>';

# right side of table 1
echo '<td class="turdball" background="themes/'.$theme_name.'/header/right_side.png" width="38"></td>';

echo '</tr>';
echo '<tr>';

# bottom left corner of table 1
echo '<td align="left" width="38" height="62"><img border="0" src="themes/'.$theme_name.'/header/bottom_left_corner.png" /></td>';

# btom middle of table 1
echo '<td background="themes/'.$theme_name.'/header/bottom_middle.png" ></td>'; 
echo '<td height="62" background="themes/'.$theme_name.'/header/bottom_middle.png" align="center" valign="top"><h1></h1></td>';
echo '<td height="62" background="themes/'.$theme_name.'/header/bottom_middle.png" align="center" ></td>';

# bottom right corner of table 1
echo '<td align="right" width="38"><img border="0" src="themes/'.$theme_name.'/header/bottom_right_corner.png" width="38" height="62" /></td>';

echo '</tr>';
echo '</table>';
echo '<!-- HEADER END -->';


echo "<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
echo "<tr valign=\"top\">\n";
echo "<td valign=\"top\"></td>\n";
echo "<td valign=\"top\">\n";

if(blocks_visible('left')) 
{
  blocks('left');
  echo "</td>\n";
  echo "<td style=\"width: 5px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\" /></td>\n";
  echo " <td width=\"100%\">\n";

} 
else  
{
	
  echo "</td>\n";
  echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" /></td>\n";
  echo " <td width=\"100%\">\n";
}
?>
