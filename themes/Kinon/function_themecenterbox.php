<?php
/*================================================================================================
 FILE: theme.php 8/17/2017
 PHP-Nuke Titanium: v1.0.1z with Zend in mind~! 
 You are using a Enhanced PHP-Nuke Web Portal System (WCM) 
 
 This is a base core theme to help users/network members design their own themes: 
 86it Titanium Theme 8/17/2017 
 designed in full by Ernest Allen Buffington: ernest.buffington@gmail.com 813-732-3360
 
 This is the 86it-Titanium theme written and designed entirely by Ernest Allen Buffington
 All PHP, Java amd MySQL code as well as 100% of the graphics design was done by yours truly!
 
 I hope you enjoy the network and the themes as they have taken 13 years so far to design 
 and get everything working right. We needed one theme to base all the future designed themes 
 on. People needed a well designed base/core theme design to help convert and layout their own 
 custom design themes in the mere future.

 Nuke Patched                             v3.1.0       09/29/2005
 Theme Management                         v1.0.2       12/14/2005       
 Page Loading Animation                   v1.0.0       10/09/2009       
=================================================================================================*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));

function themecenterbox($title, $content) 
{
    global $sitename, $theme_name, $textcolor2, $textcolor1;
	
   echo"<table class=\"otthree\"border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
     . "<tr>"
     . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
     . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
     . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
     . "<div align=\"center\"><strong><font color =\"$textcolor1\">$sitename » $title</font></strong></div>"
     . "</td>"
     . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
     . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
     . "</tr>"
     . "<tr>"
     . "<td width=\"15\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
     . "<td width=\"24\"></td>"
     . "<td width=\"100%\">";
    
  echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
  
  CloseTable();
  global $ThemeSel;  
  echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" height=0><br>\n";
}
?>