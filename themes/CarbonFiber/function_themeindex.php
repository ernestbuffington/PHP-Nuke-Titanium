<?php
#---------------------------------------------------------------------------------------#
# function themeindex                                                                   #
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
/* WORKING PERFECT 08/04/2019
/*--------------------------*/
function themeindex($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext, $writes = false) 
{
global $anonymous, $tipath, $theme_name, $sid, $ThemeSel, $nukeurl, $customlang;

    if (!empty($topicimage)):
    
        $t_image = (file_exists(carbinfiber_images_dir.'topics/'.$topicimage)) ? carbinfiber_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
        $topic_img = '<td class="col-3 extra" style="text-align:center;"><a href="modules.php?name=News&new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'"></a></td>';

    else:
        $topic_img = '';
    endif;

    $notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
    $content = '';

    if ($aid == $informant):
        $content = $thetext.$notes;
    else: 

        if ($writes):

            if (!empty($informant)) :
                $content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
            else:
                $content = $anonymous.' ';
            endif;
            $content .= _WRITES.' '.$thetext.$notes;

        else:
            $content .= $thetext.$notes;
        endif;

    endif;

$posted = sprintf($customlang['global']['posted_by'], get_author($aid), $time);
$datetime = substr($morelink, 0, strpos($morelink, '|')-strlen($morelink));
$morelink = substr($morelink, strlen($datetime)+2);
$reads = '( <span style="color: yellow;">'.$customlang['global']['reads'].'</span>: <span style="color: red;">'.$counter.'</span> )';


$blow_it_out_your_ass = 'block_repeat_y_fix.png';  
define('THEME_INDEX_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$blow_it_out_your_ass.'"'); 
define('THEME_INDEX_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                      background-position: CENTER CENTER; 
					                                          width 100%;
					                                         height 100%;
					                                        opacity: 100;
					                                blow-it-out: yourass;
												     visibility: inherit;
					                                         z-index: 20;
					                               background-size: auto;');

?>
<style type="text/css">
/*
 * function_themeindex.php - Center Content - TheGhost 08/04/2019
 *-------------------------------------------------------------------
*/
.themeindexflames
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

table.themeindexblock {
    background: url(<?php echo THEME_INDEX_BACKGROUND; ?>); /* CarbinFiber background - TheGhost add 08/04/2019 */
	<?php echo THEME_INDEX_CONTAIN; ?>
}
</style> 
<?
//top of first table	
echo '<table class="themeindexblock" border="0" width="100%" cellspacing="0" cellpadding="0">';
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

//top of second table	
echo '<table class="" border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';
echo '<td><img name="tlc" src="themes/CarbinFiber/tables/OpenTable/tlc.gif" width="20" height="25" border="0" alt=""></td>';
echo '<td width="100%" background="themes/CarbinFiber/tables/OpenTable/tm.gif"><img name="tm" src="themes/CarbinFiber/tables/OpenTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="trc" src="themes/CarbinFiber/tables/OpenTable/trc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td background="themes/CarbinFiber/tables/OpenTable/leftside.gif"><img name="leftside" src="themes/CarbinFiber/tables/OpenTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

//this is where we add the class name for the innermost cell of the 2 tables - top glass and bottom flame repeat-x
echo '<td id="middlebg" class="themeindexflames" height"0" valign="top" >';
//title
echo '<div align="left" id="locator" class="title"><img src="themes/CarbinFiber/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /><strong>'.$title.'</strong><br /></div>';

//content
echo '<div align="left" id="text">';
echo ''.$content.'</div>';	
echo '<div align="right">'.$posted.'<img src="themes/CarbinFiber/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /><br />'.$datetime.' '.$topictext.' | '.$morelink.' '.$reads.'<img src="themes/CarbinFiber/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /></div>';
echo '';
echo '</td>';
echo '<td background="themes/CarbinFiber/tables/CloseTable/rightside.gif"><img name="rightside" src="themes/CarbinFiber/tables/CloseTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td><img name="blc" src="themes/CarbinFiber/tables/CloseTable/blc.gif" width="20" height="25" border="0" alt=""></td>';
echo '';
echo '<td background="themes/CarbinFiber/tables/CloseTable/tbm.gif"><img name="tbm" src="themes/CarbinFiber/tables/CloseTable/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="brc" src="themes/CarbinFiber/tables/CloseTable/brc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr>';
echo '</table>';

//bottom of second table
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

//invisible spacer for tables instead of <br/>
echo '<table>';
echo '<tr>';
echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/CarbinFiber/images/invisible_pixel.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" /></td>\n";
echo '</tr>';
echo '</table>';
echo '</middle>';
}
?>