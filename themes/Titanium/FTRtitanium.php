<?php
/*---------------------------------------------------------------------------------------*/
/* THEME INFO                                                                            */
/* Titanium Theme v3.0 (Fixed & Full Width)                                              */
/*                                                                                       */
/* A Very Nice Titanium Styled Design.                                                   */
/* Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington                              */
/* e-Mail : ernest.buffington@gmail.com                                                  */
/*---------------------------------------------------------------------------------------*/
/* CREATION INFO                                                                         */
/* Created On: 1st August, 2019 (v1.0)                                                   */
/*                                                                                       */
/* Updated On: 1st August, 2019 (v3.0)                                                   */
/* HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)                          */
/*                                                                                       */
/* Read CHANGELOG File for Updates & Upgrades Info                                       */
/*                                                                                       */
/* Updated On: 12th August, 2019 (v3.0)                                                  */
/* Theme Design By TheGhost                                                              */
/*                                                                                       */
/* Designed By: TheGhost                                                                 */
/* Web Site: https://theghost.86it.us                                                    */
/* Purpose: PHP-Nuke Titanium                                                            */
/*---------------------------------------------------------------------------------------*/
/* CMS INFO                                                                              */
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi phpnuke.org                            */
/* Nuke-Evolution | Xtremem | Ttianium Editon : Enhanced PHP-Nuke Web Portal System      */
/*---------------------------------------------------------------------------------------*/

/*-----------------------------*/
/* Titanium Footer    Section  */
/*-----------------------------*/
/* Fixed & Full Width Style    */
/*-----------------------------*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');

global $customlang, $ThemeInfo, $banners, $theme_name, $ThemeSel, $banners, $op;

	//this is where i control the gap between the left side of the right block and the right side of the center block!              
    if(blocks_visible('right')) 
    {
		  //with right blocks this sets the space between the center block and the right block of the right side of the page        
	      echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/images/spacer.png\" width=\"7\" height=\"15\" border=\"0\" alt=\"\"></td><td>\n";
		  blocks('right');
    }
	
    echo "</td>\n"
	
        ."<td width=\"21\" valign=\"top\" background=\"".HTTPS."themes/".$ThemeSel."/sides/rightbg.png\">\n" 
		."<img src=\"".HTTPS."themes/".$ThemeSel."/sides/rightbg.png\" width=\"21\" height=\"15\" border=\"0\">\n" 
		."</td>\n"
	
	    ."</tr>\n"
	    ."</table>\n\n\n";

    echo"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" width=\"100%\">";
    echo"<tr>";
    echo"<td width=\"100%\" background=\"".HTTPS."themes/".$ThemeSel."/footer/nukestyle-ft_lt.png\">";
    echo"<img src=\"".HTTPS."themes/".$ThemeSel."/footer/nukestyle-ft_01.png\" width=20 height=173>";
    echo"</td>";
    echo"<td width=\"100%\">";
    echo"<img src=\"".HTTPS."themes/".$ThemeSel."/footer/nukestyle-ft_05.png\" width=20 height=173></td>";
    echo"</tr>";
    echo"</table>";
	echo '</div>'; //width control div added by TheGhost
?>