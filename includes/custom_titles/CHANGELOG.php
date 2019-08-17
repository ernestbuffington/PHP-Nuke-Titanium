<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

$newpagetitle = $sitename." ".$item_delim." PHP-Nuke Titanium ".$item_delim." CHANGELOG";

$facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=$name\" />\n"; 	 	 

$facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ PHP-Nuke Titanium Change Log ⌐\" />\n";
?>