<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}
// do not use echo in this file
// use $output .=
global $ThemeSel;
echo "<script type=\"text/javascript\" language=\"javascript\" src=\"".HTTPS."themes/".$ThemeSel."/js/liveclock.js\"></script>\n";
?>