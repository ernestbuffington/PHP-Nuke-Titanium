<?php
/*======================================================================= 
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

    global $l_op, $cid, $lid, $module_title;

    $name = $module_title;

    $newpagetitle = "$sitename $item_delim $name";

    if($l_op == 'viewlink' && is_numeric($cid)) 
	{
        list($cat, $parent) = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `".$prefix."_links_categories` WHERE `cid`='$cid'", SQL_NUM);
    
	    if ($parent == 0) 
		{
            $newpagetitle = "$sitename $item_delim $name $item_delim $cat";

            $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=Web_Links&l_op=viewlink&cid=$cid\" />\n"; 	 	 

            $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $module_title $item_delim Category $item_delim $cat ⌐\" />\n";
		} 
		else 
		{
            list($parent) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_links_categories` WHERE `cid`='$parent'", SQL_NUM);

            $newpagetitle = "$sitename $item_delim $name $item_delim $parent $item_delim $cat";

            $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=Web_Links&l_op=viewlink&cid=$parent\" />\n"; 	 	 

            $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $module_title $item_delim Category $item_delim $cat ⌐\" />\n";
        }
    }

     $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";
?>