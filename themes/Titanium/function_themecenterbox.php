<?php
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