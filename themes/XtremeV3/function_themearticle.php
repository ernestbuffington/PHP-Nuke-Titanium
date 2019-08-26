<?php
/*----------------------------------------------------------------*/
/* THEME INFO                                                     */
/* Titanium Theme v1.0 (Fixed & Full Width)                       */
/*                                                                */
/* A Very Nice Black Carbin Fiber Styled Design.                  */
/* Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington       */
/* e-Mail : ernest.buffington@gmail.com                           */
/*----------------------------------------------------------------*/
/* CREATION INFO                                                  */
/* Created On: 1st August, 2019 (v1.0)                            */
/*                                                                */
/* Updated On: 1st August, 2019 (v3.0)                            */
/* HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)   */
/*                                                                */
/* Read CHANGELOG File for Updates & Upgrades Info                */
/*                                                                */
/* Designed By: TheGhost                                          */
/* Web Site: https://theghost.86it.us                             */
/* Purpose: PHP-Nuke Titanium v3.0.0                              */
/*----------------------------------------------------------------*/
/* CMS INFO                                                       */
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi phpnuke.org     */
/* Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System      */
/*----------------------------------------------------------------*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* WORKING PERFECT 08/04/2019 
/*--------------------------*/
function themearticle($aid, $informant, $datetime, $title, $counter, $thetext, $topic, $topicname, $topicimage, $topictext, $writes = false) 
{
global $admin, $sid, $tipath, $theme_name;

	if (!empty($topicimage)) 
	{
		$t_image = (file_exists(xtremev3_images_dir.'topics/'.$topicimage)) ? xtremev3_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
		$topic_img = '<td width="25%" align="center" class="extra"><a href="modules.php?name=Blog&new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'"></a></td>';
	} 
	else 
	{
		$topic_img = '';
	}
	$notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
	$content = '';
	if ($aid == $informant) 
	{
	    $content = $thetext.$notes;
	} 
	else 
	{
		if ($writes)
		{
			if (!empty($informant)) 
			{
				$content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
			}
			else 
			{
				$content = $anonymous.' ';
			}
			$content .= _WRITES.' '.$thetext.$notes;
		} 
		else 
		{
			$content .= $thetext.$notes;
		}
	}

$posted = _POSTEDON.' '.$datetime.' '._BY.' ';
$posted .= get_author($aid);
$reads = '( <span style="color: yellow;">Reads</span>: <span style="color: red;">'.$counter.'</span> )';

   echo"<table class=\"otthree\"border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
     . "<tr>"
     . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
     . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
     . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
     . "<span class=\"blocktitle\"><div align=\"center\"><strong>$title</strong></div></span>"
     . "</td>"
     . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
     . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
     . "</tr>"
     . "<tr>"
     . "<td width=\"15\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
     . "<td width=\"24\"></td>"
     . "<td width=\"100%\">";
//content
echo '<div align="left" id="text">'.''.$title.'</div><p>';
echo '<div align="left" id="text">';
echo ''.$content.'</div>';	
echo '<div align="right">'.$posted.'<img src="themes/Titanium/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /><br />'.$reads.'<img src="themes/Titanium/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /></div>';
CloseTable();

}
?>