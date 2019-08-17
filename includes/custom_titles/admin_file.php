<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

$newpagetitle = "$sitename ¬ PHP-Nuke Titanium :: Administration ⌐";
$facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/admin.php\" />\n";
//added the facebook dexription meta tag, as it was missing. 10/11/2012
$facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ PHP-Nuke Titanium :: Administration ⌐\" />\n"
?>