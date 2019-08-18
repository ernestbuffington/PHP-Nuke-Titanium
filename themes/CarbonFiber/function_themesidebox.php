<?php
#---------------------------------------------------------------------------------------#
# function themesidebox                                                                 #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# CarbinFiber Theme v1.0 (Fixed & Full Width)                                           #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* 
/*--------------------------*/
function themesidebox($title, $content, $bid = 0) 
{
global $theme_name;

echo '<aside>'; //side block class to add flames to bottom and glass curve to top
echo '<table class="sideblock" border="0" width="320px" cellspacing="0" cellpadding="0">';
echo '';
echo '<tr>';
echo '<td align="left" width="38" height="62"><img border="0" src="themes/CarbinFiber/tables/OpenTable/top_left_block.png" /></td>';
echo '<td background="themes/CarbinFiber/tables/OpenTable/top_middle_block.png" ></td>';
echo '<td height="62" background="themes/CarbinFiber/tables/OpenTable/top_middle_block.png" align="center" valign="bottom"></td>';
echo '<td background="themes/CarbinFiber/tables/OpenTable/top_middle_block.png" align="center" ></td>';
echo '<td align="right" width="38"><img border="0" src="themes/CarbinFiber/tables/OpenTable/top_right_block.png" width="38" height="62" /></td>';
echo '</tr>';
echo '';
echo '<tr>';
echo '<td background="themes/CarbinFiber/tables/OpenTable/left_middle_block.png" width="38"></td>';
echo '<td ></td>';
echo '<td >';
echo '';
echo '';

echo '<table border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';
echo '<td><img name="tlc" src="themes/CarbinFiber/tables/OpenTable/tlc.gif" width="20" height="25" border="0" alt=""></td>';
echo '<td width="100%" background="themes/CarbinFiber/tables/OpenTable/tm.gif"><img name="tm" src="themes/CarbinFiber/tables/OpenTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="trc" src="themes/CarbinFiber/tables/OpenTable/trc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td background="themes/CarbinFiber/tables/OpenTable/leftside.gif"><img name="leftside" src="themes/CarbinFiber/tables/OpenTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td id="sidebg" class="sideflames" height"0" valign="top" >';
echo '<div align="center" id="locator" class="title"><strong>'.$title.'</strong></div>';
echo '<div align="left" id="text">';
echo ''.$content.'</div>';

echo '';
echo '</td>';
echo '<td background="themes/CarbinFiber/tables/CloseTable/rightside.gif"><img name="rightside" src="themes/CarbinFiber/tables/CloseTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td><img name="blc" src="themes/CarbinFiber/tables/CloseTable/blc.gif" width="20" height="25" border="0" alt=""></td>';
echo '';
echo '<td background="themes/CarbinFiber/tables/CloseTable/tbm.gif"><img name="tbm" src="themes/CarbinFiber/tables/CloseTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="brc" src="themes/CarbinFiber/tables/CloseTable/brc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr></table>';
echo '';
echo '';
echo '</td>';
echo '<td ></td>';
echo '<td class="turdball" background="themes/CarbinFiber/tables/CloseTable/right_middle_block.png" width="38"></td>';
echo '</tr>';
echo '';
echo '<tr>';
echo '<td align="left" width="38" height="62"><img border="0" src="themes/CarbinFiber/tables/CloseTable/blc.png" /></td>';
echo '';
echo '<td background="themes/CarbinFiber/tables/CloseTable/bottom_middle1.png" ></td>';
echo '<td height="62" background="themes/CarbinFiber/tables/CloseTable/bottom_middle1.png" align="center" valign="top"><h1></h1></td>';
echo '<td height="62" background="themes/CarbinFiber/tables/CloseTable/bottom_middle1.png" align="center" ></td>';
echo '';
echo '<td align="right" width="38"><img border="0" src="themes/CarbinFiber/tables/CloseTable/brc.png" width="38" height="62" /></td>';
echo '</tr>';
echo '</table>';

echo '<table>';
echo '<tr>';
echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" /></td>\n";
echo '</tr>';
echo '</table>';

echo '</aside>';
}
?>
