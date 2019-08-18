<?php
#---------------------------------------------------------------------------------------#
# function OpenTable                                                                    #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

/*--------------------------*/
/* function OpenTable() 
/*--------------------------*/
function OpenTable() 
{
global $theme_name;

   $filename1 = 'block_repeat_y_fix.png';  
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('E_MIDDLEHEADER_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"'); 
   define('E_MIDDLEHEADER_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                      background-position: CENTER CENTER; 
					  width 100%;
					  height 100%;
					  opacity: 100;
					  visibility: inherit;
					  z-index: 20;
					  background-size: auto;');

?>
<style type="text/css">
/*
 * function_OpenTable.php - Center Content - TheGhost 08/04/2019
 *--------------------------------------------------
*/
.emiddleflames
{
background-color: black;	
background-image: 
    url(themes/<?=$theme_name?>/images/backgrounds/topright.png), /* top black glass - TheGhost add 08/04/2019 */
    url(themes/<?=$theme_name?>/images/backgrounds/sidebox_bottom.png); /* bottom flames - TheGhost add 08/04/2019 */
  background-position:
    top right, 
    bottom left; 
  background-repeat: 
    repeat-x; /* this makes the top glass block and the bottom flame block repaete from left to right and vice vs - TheGhost add 08/04/2019 */ 
	
}

table.emiddleblock {
    background: url(<?php echo E_MIDDLEHEADER_BACKGROUND; ?>); /* CarbinFiber background - TheGhost add 08/04/2019 */
	<?php echo E_MIDDLEHEADER_CONTAIN; ?>
}
</style> 
<?

echo '<middle>';
echo '<table class="emiddleblock" border="0" width="100%" cellspacing="0" cellpadding="0">';
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



echo '<table class="" border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';
echo '<td><img name="tlc" src="themes/CarbinFiber/tables/OpenTable/tlc.gif" width="20" height="25" border="0" alt=""></td>';
echo '<td width="100%" background="themes/CarbinFiber/tables/OpenTable/tm.gif"><img name="tm" src="themes/CarbinFiber/tables/OpenTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="trc" src="themes/CarbinFiber/tables/OpenTable/trc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td background="themes/CarbinFiber/tables/OpenTable/leftside.gif"><img name="leftside" src="themes/CarbinFiber/tables/OpenTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '<td id="middlebg" class="emiddleflames" height"0" valign="top" >';

echo '<div align="center" id="locator" class="title"><strong>'.$title2.'</strong></div>';
echo '<div align="left" id="text">';
echo ''.$content2.'</div>';	
}
?>
