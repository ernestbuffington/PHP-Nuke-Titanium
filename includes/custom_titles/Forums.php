<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

    global $p, $t, $forum, $f, $sitename, $name, $item_delim;
    
    // Item Delimiters
    $spacer = "└";
    $lft = "-]";
    $rgt = "[-";
    $dash = "-";
    $item_delim = "&raquo;";
	
	$newpagetitle = "$sitename $item_delim $name";
	
    if (isset($p) && is_numeric($p)) 
	{
        $p = (int)$p;

        list($title, $post) = $db->sql_ufetchrow("SELECT `post_subject`, `post_id` FROM `".$prefix."_bbposts_text` WHERE `post_id`='$p'", SQL_NUM);

        $newpagetitle = "$sitename $name $item_delim Post $post $item_delim $title";

        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=$name&file=viewtopic&p=$p\" />\n"; 	 	 

        $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ Post $post $item_delim $title ⌐\" />\n";
    } 
	else 
	if (isset($t) && is_numeric($t)) 
	{
        list($title, $forum) = $db->sql_ufetchrow("SELECT `topic_title`, `forum_id` FROM `".$prefix."_bbtopics` WHERE `topic_id`='$t'", SQL_NUM);

        list($forum) = $db->sql_ufetchrow("SELECT `forum_name` FROM `".$prefix."_bbforums` WHERE `forum_id`='$forum'", SQL_NUM);

        $newpagetitle = "$sitename $item_delim $name $item_delim $forum $item_delim $title";

        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=$name&file=viewtopic&t=$t\" />\n"; 	 	 

        $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $name $item_delim $forum $item_delim $title ⌐\" />\n";
    }
    else 
	if (isset($f) && is_numeric($f)) 
	{
        list($forum) = $db->sql_ufetchrow("SELECT `forum_name` FROM `".$prefix."_bbforums` WHERE `forum_id`='$f'", SQL_NUM);

        $newpagetitle = "$sitename $item_delim $name $item_delim $forum";

        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=$name&file=viewforum&f=$f\" />\n"; 	 	 

        $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $name $item_delim $forum ⌐\" />\n";
    }

    if ((isset($_POST['file']) && !empty($_POST['file'])) && (isset($_GET['file']) && !empty($_GET['file']))) 
    $file = (isset($_GET['file']) && !stristr($_GET['file'],'..') && !stristr($_GET['file'],'://')) ? addslashes(trim($_GET['file'])) : false;
    else 
    $file = (isset($_REQUEST['file']) && !stristr($_REQUEST['file'],'..') && !stristr($_REQUEST['file'],'://')) ? addslashes(trim($_REQUEST['file'])) : false;


    if ($file == staff)
	{
        $newpagetitle = "$sitename $item_delim Network Staff";

        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=Forums&file=staff\" />\n"; 	 	 

        $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $sitename $item_delim Network Staff ⌐\" />\n";
	}

    if ($file == ranks)
	{
        $newpagetitle = "$sitename $item_delim Network Ranks";

        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=Forums&file=ranks\" />\n"; 	 	 

        $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $sitename $item_delim Network Ranks ⌐\" />\n";
	}

    if ($file == arcade)
	{
        $newpagetitle = "$sitename $item_delim Flash Arcade";

        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=Forums&file=arcade\" />\n"; 	 	 

        $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $sitename $item_delim Flash Arcade ⌐\" />\n";
	}

    if ($file == search)
	{
        $newpagetitle = "$sitename $item_delim Forums Search";

        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=$name&file=search\" />\n"; 	 	 

        $facebook_ogdescription = "<meta property=\"og:description\" content=\"¬ $sitename $item_delim $name Search ⌐\" />\n";
	}

?>