<?php
/*======================================================================= 
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $op, $l_op, $cid, $lid, $module_title;

$name = $module_title;

$newpagetitle = "$item_delim $name";

if(isset($cid) && is_numeric($cid)) 
{
        list($cat, $parent) = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `".$prefix."_nsngd_categories` WHERE `cid`='$cid'", SQL_NUM);

        if (!isset($parent)) 
		{
			if (!isset($cat)) 
            $newpagetitle = "$item_delim $name";
			else
			$newpagetitle = "$item_delim $name $item_delim $cat";
        } 
		else 
		{
            list($parent) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_nsngd_categories` WHERE `cid`='$parent'", SQL_NUM);
            
			if (!isset($cat)) 
		    $newpagetitle = "$item_delim $name $item_delim $parent";
			else
			$newpagetitle = "$item_delim $name $item_delim $parent $item_delim $cat";


        }
}
else
if(isset($op)) 
{
  if($op == 'NewDownloads')
  $newpagetitle = "$item_delim $name $item_delim New Downloads";
  else
  if($op == 'MostPopular')
  $newpagetitle = "$item_delim $name $item_delim Most Popular";
  else
  $newpagetitle = "$item_delim $name $item_delim Downloads";

}

   $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";
?>