<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************************/
/* SN Dynamic Titles Addon                                          */
/* ===========================                                      */
/* Copyright (c) 2003 by Greg Schoper                               */
/* http://nuke.schoper.net                                          */
/*                                                                  */
/* Based on code from PHP-Nuke                                      */
/* Copyright (c) 2002 by Francisco Burzi                            */
/* http://phpnuke.org                                               */
/*                                                                  */
/* This program is free software. You can redistribute it and/or    */
/* modify it under the terms of the GNU General Public License as   */
/* published by the Free Software Foundation; either version 2 of   */
/* the License.                                                     */
/********************************************************************/
/* Credit to unknown author of original forums code in              */
/* includes/dynamic_titles.php.                                     */
/********************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

// Item Delimiter
$item_delim = "&raquo;";
$newpagetitle = '';

global $name, $admin_file, $prefix, $db, $user_prefix, $cookie, $slogan, $pagetitle, $sitename;

// Forums
if ($name == 'Forums') {
    global $p, $t, $forum, $f;
    $newpagetitle = "$item_delim $name";
    if (isset($p) && is_numeric($p)) {
        $p = (int)$p;
        list($title, $post) = $db->sql_ufetchrow("SELECT `post_subject`, `post_id` FROM `".$prefix."_bbposts_text` WHERE `post_id`='$p'", SQL_NUM);
        $newpagetitle = "$name $item_delim Post $post $item_delim $title";
    } else if (isset($t) && is_numeric($t)) {
        list($title, $forum) = $db->sql_ufetchrow("SELECT `topic_title`, `forum_id` FROM `".$prefix."_bbtopics` WHERE `topic_id`='$t'", SQL_NUM);
        list($forum) = $db->sql_ufetchrow("SELECT `forum_name` FROM `".$prefix."_bbforums` WHERE `forum_id`='$forum'", SQL_NUM);
        $newpagetitle = "$item_delim $name $item_delim $forum $item_delim $title";
    }
    else if (isset($f) && is_numeric($f)) {
        list($forum) = $db->sql_ufetchrow("SELECT `forum_name` FROM `".$prefix."_bbforums` WHERE `forum_id`='$f'", SQL_NUM);
        $newpagetitle = "$item_delim $name $item_delim $forum";
    }
} else
// Blog
if ($name == 'Blog') {
    global $file, $sid, $new_topic;
    $newpagetitle= "$item_delim $name";
    if (isset($new_topic) && is_numeric($new_topic)) {
        list($top) = $db->sql_ufetchrow("SELECT `topictext` FROM `".$prefix."_topics` WHERE `topicid`='$new_topic'", SQL_NUM);
        $newpagetitle= "$item_delim $top";
    } else if ($file == 'article' && isset($sid) && is_numeric($sid)){
        list($art, $top) = $db->sql_ufetchrow("SELECT `title`, `topic` FROM `".$prefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
        if ($top) {
            list($top) = $db->sql_ufetchrow("SELECT `topictext` FROM `".$prefix."_topics` WHERE `topicid`='$top'", SQL_NUM);
            $newpagetitle= "$item_delim $top $item_delim $art";
        } else {
            $newpagetitle= "$item_delim $art";
        }
    }
} else
// Topics
if ($name == 'Blog_Topics') {
      $newpagetitle = $item_delim.' '._ACTIVETOPICS;
} else
// Web Links
if ($name == 'Web_Links') {
    global $l_op, $cid, $lid, $module_title;
    $name = $module_title;
    $newpagetitle = "$item_delim $name";
    if($l_op == 'viewlink' && is_numeric($cid)) {
        list($cat, $parent) = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `".$prefix."_links_categories` WHERE `cid`='$cid'", SQL_NUM);
        if ($parent == 0) {
            $newpagetitle = "$item_delim $name $item_delim $cat";
        } else {
            list($parent) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_links_categories` WHERE `cid`='$parent'", SQL_NUM);
            $newpagetitle = "$item_delim $name $item_delim $parent $item_delim $cat";
        }
    }
} else
// Downloads
if ($name == 'Downloads') 
{
 include_once(NUKE_TITLES_DIR.'Downloads.php');
} 
else
// Content
if ($name == 'Content') {
    global $pa, $cid, $pid;
    $newpagetitle = "$item_delim $name";
    if ($pa == 'list_pages_categories' && is_numeric($cid)) {
        list($cat) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_pages_categories` WHERE `cid`='$cid'", SQL_NUM);
        $newpagetitle = "$item_delim $name $item_delim $cat";
    } else if ($pa == 'showpage' && is_numeric($pid)) {
        list($page, $cid) = $db->sql_ufetchrow("SELECT `title`, `cid` FROM `".$prefix."_pages` WHERE `pid`='$pid'", SQL_NUM);
        list($cat) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_pages_categories` WHERE `cid`='$cid'", SQL_NUM);
        $newpagetitle = "$item_delim $name $item_delim $cat $item_delim $page";
    }
} else
// Reviews
if ($name == 'Reviews') {
    global $rop, $id;
    $newpagetitle = "$item_delim $name";
    if ($rop == "showcontent" && is_numeric($id)) {
        list($rev) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_reviews` WHERE `id`='$id'", SQL_NUM);
        $newpagetitle = "$item_delim $name $item_delim $rev";
    }
} else
// Stories Archive
if ($name == 'Blog_Archive') {
    global $sa, $year, $month_l, $module_title;
    $name = $module_title;
    $newpagetitle = "$item_delim $name";
    if($sa == 'show_month') {
        $newpagetitle = "$item_delim $name $item_delim $month_l, $year";
    }
} else
// Profile
if ($name == 'Profile') {
    global $mode, $u, $user_prefix, $userinfo;
    $newpagetitle = "$item_delim $name";
    if ($mode == 'viewprofile'  && is_numeric($u)) {
        list($username) = $db->sql_ufetchrow('SELECT `username` FROM `'.$user_prefix.'_users` WHERE `user_id`='.$u);
        $sec = 'Viewing '.$username.'\'s Profile';
        $newpagetitle = "$item_delim $name $item_delim $sec";
    } else if ($mode == 'editprofile') {
        $sec = 'Editing '.$userinfo['user_name'].'\'s Profile';
        $newpagetitle = "$item_delim $name $item_delim $sec";
    }
}

// Catch all for anything we don't have custom coding for
if (empty($newpagetitle)) {
    global $pagetitle, $module_title;
    if(isset($pagetitle)) {
        $newpagetitle = $pagetitle;
    } else {
        $newpagetitle = "$item_delim $module_title";
    }
}

// Admin Pages
if (defined('ADMIN_FILE')) {
    $newpagetitle = "$item_delim Administration";
}
// If we're on the main page let's use our site slogan
if (defined('HOME_FILE')) {
    $newpagetitle = "$item_delim $slogan";
}

// We're Done! Place the Title on the page
echo "<title>$sitename $newpagetitle</title>\n";

?>