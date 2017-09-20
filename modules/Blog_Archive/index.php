<?php
#########################################################################
# Titanium Blog Archive v1.0                                            #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
#########################################################################
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); }

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

function select_month() 
{
    global $copyright, $prefix, $user_prefix, $db, $module_name;
    include_once(NUKE_BASE_DIR.'header.php');

    #########################################################################
    # Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
    if(!function_exists('OpenTableModule'))
	{ 
      title(_STORIESARCHIVE);
      OpenTable();
      echo "<center><span class=\"content\">"._SELECTMONTH2VIEW."</span><br /><br /></center><br /><br />";
	}
    else
	{
      global $pagetitle, $sitename, $textcolor1;
	  $pagetitle = $sitename." » Blog Archives";
	  OpenTableModule();
	  echo "<fieldset><legend><strong><font color=\"$textcolor1\">Select A Blog Archive</font></strong></legend>";
	}
    #######################################################################
    # Table Header Module     Fix End - by TheGhost   v1.0.0     01/30/2012
    #######################################################################
    $result = $db->sql_query("SELECT time FROM ".$prefix."_blogs ORDER BY time DESC");
    
	echo "<ul>";
    
	$thismonth = '';
	$thisyear ='';
    
	while(list($time) = $db->sql_fetchrow($result)) 
	{
        //preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $getdate);
        preg_match('#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $time, $getdate);
		
		if ($getdate[2] == "01") 
		{ 
		 $month = _JANUARY; 
		} 
		else
		if($getdate[2] == "02") 
		{ 
		 $month = _FEBRUARY; 
		} 
		else
		if($getdate[2] == "03") 
		{ 
		 $month = _MARCH; 
		} 
		else
		if($getdate[2] == "04") 
		{ 
		 $month = _APRIL; 
		} 
		else
		if($getdate[2] == "05") 
		{ 
		 $month = _MAY; 
		} 
		else
		if($getdate[2] == "06") 
		{ 
		 $month = _JUNE; 
		} 
		else
		if($getdate[2] == "07") 
		{ 
		 $month = _JULY; 
		} 
		else
		if($getdate[2] == "08") 
		{ 
		 $month = _AUGUST; 
		} 
		else
		if($getdate[2] == "09") 
		{ 
		 $month = _SEPTEMBER; 
		} 
		else
		if($getdate[2] == "10") 
		{ 
		 $month = _OCTOBER; 
		} 
		else
		if($getdate[2] == "11") 
		{ 
		 $month = _NOVEMBER; 
		} 
		else
		if($getdate[2] == "12") 
		{ 
		 $month = _DECEMBER; 
		}
        
		
		
		//if ($month != $thismonth) 
		//{
            $year = $getdate[1];
			
			if (($thismonth == $month) && ($thisyear == $year))
			{
			//echo "<li>REMOVED";	
			}
			else
            echo "<li><a href=\"modules.php?name=$module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a>";

            $thismonth = $month;
			$thisyear = $year;
			
        //}
    }
    
	$db->sql_freeresult($result);
    echo "</ul>"
    ."<br /><br /><br /><center>"
    ."<form action=\"modules.php?name=Blog_Search\" method=\"post\">"
    ."<input type=\"text\" class=\"select\" name=\"query\" size=\"30\">&nbsp;"
    ."<input type=\"submit\" class=\"liteoption\" value=\""._SEARCH."\">"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name&amp;sa=show_all\">"._SHOWALLSTORIES."</a> ]</center>";
	
    #########################################################################
    # Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
	if(function_exists('OpenTableModule'))
	echo "</fieldset>";
    #######################################################################
    # Table Header Module     Fix End - by TheGhost   v1.0.0     01/30/2012
    #######################################################################
    
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function show_month($year, $month, $month_l) 
{
    global $userinfo, $prefix, $user_prefix, $db, $bgcolor1, $bgcolor2, $user, $cookie, $sitename, $multilingual, $language, $module_name, $articlecomm;

    $year = intval($year);

    $month = htmlentities($month);

    $month_l = htmlentities($month_l);

    include_once(NUKE_BASE_DIR.'header.php');
    #########################################################################
    # Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
    if(!function_exists('OpenTableModule'))
	{ 
      title(_STORIESARCHIVE);
      title("$sitename: $month_l $year");
      OpenTable();
	}
    else
	{
      global $pagetitle, $sitename, $textcolor1;
	  $pagetitle = $sitename." » Blog Archives";
	  OpenTableModule();
	  //echo "<b>$sitename: $month_l $year</b>";
	  echo "<fieldset><legend><strong><font color=\"$textcolor1\">Blog Archive : $month_l $year</font></strong></legend>";

	}
    #######################################################################
    # Table Header Module     Fix End - by TheGhost   v1.0.0     01/30/2012
    #######################################################################
    $r_options = '';
    
	if(is_user()) {
      if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
      if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
      if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
    }
    
    echo "<table border=\"0\" width=\"100%\"><tr>"
        ."<td bgcolor=\"$bgcolor2\" align=\"left\"><strong>"._ARTICLES."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._COMMENTS."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._READS."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._USCORE."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._DATE."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ACTIONS."</strong></td></tr>";
    $result = $db->sql_query("SELECT sid, 
	                               catid, 
								   title, 
								    time, 
								comments, 
								 counter, 
								   topic, 
							   alanguage, 
							       score, 
								 ratings FROM ".$prefix."_blogs 
								 
								 WHERE time >= '$year-$month-01 00:00:00' AND time <= '$year-$month-31 23:59:59' ORDER BY sid DESC");
								 
    while ($row = $db->sql_fetchrow($result)) {
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = stripslashes(check_html($row['title'], "nohtml"));
        $time = $row['time'];
        $comments = stripslashes($row['comments']);
        $counter = intval($row['counter']);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $time = explode(" ", $time);
        $actions = "<a target=\"_tab\" href=\"modules.php?name=Blogs&amp;file=print&amp;sid=$sid\"><img src=\"images/print.gif\" border=0 alt=\""._PRINTER."\" title=\""._PRINTER."\" width=\"16\" height=\"11\"></a>&nbsp;<a  target=\"_tab\" href=\"modules.php?name=Blogs&amp;file=friend&amp;op=FriendBlogSend&amp;sid=$sid\"><img src=\"images/friend.gif\" border=0 alt=\""._FRIEND."\" title=\""._FRIEND."\" width=\"16\" height=\"11\"></a>";
        if ($score != 0) {
            $rated = substr($score / $ratings, 0, 4);
        } else {
            $rated = 0;
        }
        if ($catid == 0) {
            $title = "<a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        } elseif ($catid != 0) {
            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_blogs_cat WHERE catid='$catid'"));
            $cat_title = $row_res['title'];
            $title = "<a href=\"modules.php?name=Blogs&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><i>$cat_title</i></a>: <a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        }
        if ($multilingual == 1) {
            if (empty($alanguage)) {
            $alanguage = $language;
            }
            $alt_language = ucfirst($alanguage);
            $lang_img = "<img src=\"images/language/flag-$alanguage.png\" border=\"0\" hspace=\"2\" alt=\"$alt_language\" title=\"$alt_language\">";
        } else {
            $lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        if ($articlecomm == 0) {
            $comments = 0;
        }
        echo "<tr>"
            ."<td bgcolor=\"$bgcolor1\" align=\"left\">$lang_img $title</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$comments</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$counter</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$rated</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$time[0]</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$actions</td></tr>";
    }
    $db->sql_freeresult($result);
    echo "</table>"
    ."<br /><br /><br /><hr size=\"1\" noshade>"
    ."<span class=\"content\">"._SELECTMONTH2VIEW."</span><br />";
    $result2 = $db->sql_query("SELECT time FROM ".$prefix."_blogs ORDER BY time DESC");
    echo "<ul>";
    $thismonth = '';
    while($row2 = $db->sql_fetchrow($result2)) {
        $time = $row2['time'];
        //preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $getdate);
        preg_match('#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $time, $getdate);
		if ($getdate[2] == "01") { $month = _JANUARY; } elseif ($getdate[2] == "02") { $month = _FEBRUARY; } elseif ($getdate[2] == "03") { $month = _MARCH; } elseif ($getdate[2] == "04") { $month = _APRIL; } elseif ($getdate[2] == "05") { $month = _MAY; } elseif ($getdate[2] == "06") { $month = _JUNE; } elseif ($getdate[2] == "07") { $month = _JULY; } elseif ($getdate[2] == "08") { $month = _AUGUST; } elseif ($getdate[2] == "09") { $month = _SEPTEMBER; } elseif ($getdate[2] == "10") { $month = _OCTOBER; } elseif ($getdate[2] == "11") { $month = _NOVEMBER; } elseif ($getdate[2] == "12") { $month = _DECEMBER; }
        if ($month != $thismonth) {
            $year = $getdate[1];
            echo "<li><a href=\"modules.php?name=$module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a>";
            $thismonth = $month;
        }
    }
    $db->sql_freeresult($result2);
    echo "</ul><br /><br /><center>"
    ."<form action=\"modules.php?name=Blog_Search\" method=\"post\">"
    ."<input type=\"text\" class=\"select\" name=\"query\" size=\"30\">&nbsp;"
    ."<input type=\"submit\" class=\"liteoption\" value=\""._SEARCH."\">"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name\">"._ARCHIVESINDEX."</a> | <a href=\"modules.php?name=$module_name&amp;sa=show_all\">"._SHOWALLSTORIES."</a> ]</center>";

    #########################################################################
    # Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
    if(function_exists('OpenTableModule'))
	echo "</fieldset>";
    #######################################################################
    # Table Header Module     Fix End - by TheGhost   v1.0.0     01/30/2012
    #######################################################################

	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function show_all($min) {
    global $prefix, $user_prefix, $db, $bgcolor1, $bgcolor2, $user, $cookie, $sitename, $multilingual, $language, $module_name, $userinfo;
    if (!isset($min) || (!is_numeric($min) || ((int)$min) != $min)) {
        $min = 0;
    }
    else $min = (int)($min);
    $max = 250;
    include_once(NUKE_BASE_DIR.'header.php');
	
    #########################################################################
    # Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
    if(!function_exists('OpenTableModule'))
	{ 
      title(_STORIESARCHIVE);
      title($sitename.': '._ALLSTORIESARCH);
      OpenTable();
	}
    else
	{
      global $pagetitle, $sitename, $textcolor1;
	  $pagetitle = $sitename." » Blog Archives";
	  OpenTableModule();
	  //echo '<b>'.$sitename.': '._ALLSTORIESARCH.'</b>';
	  echo "<fieldset><legend><strong><font color=\"$textcolor1\"><b>Archive Index : "._ALLSTORIESARCH."</b></font></strong></legend>";
	}
    #######################################################################
    # Table Header Module     Fix End - by TheGhost   v1.0.0     01/30/2012
    #######################################################################
	$r_options = '';
    if(is_user()) {
      if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
      if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
      if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
    }

    echo "<table border=\"0\" width=\"100%\"><tr>"
    ."<td bgcolor=\"$bgcolor2\" align=\"left\"><strong>"._ARTICLES."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._COMMENTS."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._READS."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._USCORE."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._DATE."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ACTIONS."</strong></td></tr>";
    $result = $db->sql_query("SELECT sid, catid, title, time, comments, counter, topic, alanguage, score, ratings FROM ".$prefix."_blogs ORDER BY sid DESC LIMIT $min,$max");
    $numrows = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_blogs"));
    while($row = $db->sql_fetchrow($result)) {
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = stripslashes(check_html($row['title'], "nohtml"));
        $time = $row['time'];
        $comments = stripslashes($row['comments']);
        $counter = intval($row['counter']);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $time = explode(" ", $time);
        $actions = "<a  target=\"_tab\" href=\"modules.php?name=Blogs&amp;file=print&amp;sid=$sid\"><img src=\"images/print.gif\" border=0 alt=\""._PRINTER."\" title=\""._PRINTER."\" width=\"15\" height=\"11\"></a>&nbsp;<a target=\"_tab\" href=\"modules.php?name=Blogs&amp;file=friend&amp;op=FriendBlogSend&amp;sid=$sid\"><img src=\"images/friend.gif\" border=0 alt=\""._FRIEND."\" title=\""._FRIEND."\" width=\"15\" height=\"11\"></a>";
        if ($score != 0) {
            $rated = substr($score / $ratings, 0, 4);
        } else {
            $rated = 0;
        }
        if ($catid == 0) {
            $title = "<a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        } elseif ($catid != 0) {
            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_blogs_cat WHERE catid='$catid'"));
            $cat_title = stripslashes($row_res['title']);
            $title = "<a href=\"modules.php?name=Blogs&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><i>$cat_title</i></a>: <a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        }
        if ($multilingual == 1) {
            if (empty($alanguage)) {
                $alanguage = $language;
            }
            $alt_language = ucfirst($alanguage);
            $lang_img = "<img src=\"images/language/flag-$alanguage.png\" border=\"0\" hspace=\"2\" alt=\"$alt_language\" title=\"$alt_language\">";
        } else {
            $lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        echo "<tr>"
        ."<td bgcolor=\"$bgcolor1\" align=\"left\">$lang_img $title</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$comments</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$counter</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$rated</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$time[0]</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$actions</td></tr>";
    }
    $db->sql_freeresult($result);
    echo "</table>"
    ."<br /><br /><br />";
    $a = 0;
    if (($numrows > 250) && ($min == 0)) {
        $min = $min+250;
        $a++;
        echo "<center>[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</center><br />";
    }
    if (($numrows > 250) && ($min >= 250) && ($a != 1)) {
        $pmin = $min-250;
        $min = $min+250;
        $a++;
        echo "<center>[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> | <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</center><br />";
    }
    if (($numrows <= 250) && ($a != 1) && ($min != 0)) {
        $pmin = $min-250;
        echo "<center>[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> ]</center><br />";
    }
    echo "<hr size=\"1\" noshade>"
    ."<span class=\"content\">"._SELECTMONTH2VIEW."</span><br />";
    $result2 = $db->sql_query("SELECT time FROM ".$prefix."_blogs ORDER BY time DESC");
    echo "<ul>";
    $thismonth = "";
    while(list($time) = $db->sql_fetchrow($result)) {
        ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $getdate);
        if ($getdate[2] == "01") { $month = _JANUARY; } elseif ($getdate[2] == "02") { $month = _FEBRUARY; } elseif ($getdate[2] == "03") { $month = _MARCH; } elseif ($getdate[2] == "04") { $month = _APRIL; } elseif ($getdate[2] == "05") { $month = _MAY; } elseif ($getdate[2] == "06") { $month = _JUNE; } elseif ($getdate[2] == "07") { $month = _JULY; } elseif ($getdate[2] == "08") { $month = _AUGUST; } elseif ($getdate[2] == "09") { $month = _SEPTEMBER; } elseif ($getdate[2] == "10") { $month = _OCTOBER; } elseif ($getdate[2] == "11") { $month = _NOVEMBER; } elseif ($getdate[2] == "12") { $month = _DECEMBER; }
        if ($month != $thismonth) {
            $year = $getdate[1];
            echo "<li><a href=\"modules.php?name=$module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a>";
            $thismonth = $month;
        }
    }
    $db->sql_freeresult($result2);
    echo "</ul><br /><br /><center>"
    ."<form action=\"modules.php?name=Blog_Search\" method=\"post\">"
    ."<input type=\"text\" class=\"select\" name=\"query\" size=\"30\">&nbsp;"
    ."<input type=\"submit\" class=\"liteoption\" value=\""._SEARCH."\">"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name\">"._ARCHIVESINDEX."</a> ]</center>";

    #########################################################################
    # Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
    if(function_exists('OpenTableModule'))
	echo "</fieldset>";
    #######################################################################
    # Table Header Module     Fix End - by TheGhost   v1.0.0     01/30/2012
    #######################################################################

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php'); 
}

$sa = isset($sa) ? $sa : '';
$min = isset($min) ? intval($min) : 0;
$year = isset($year) ? intval($year) : 0;
$month = isset($month) ? intval($month) : 0;
$month_l = isset($month_l)? Fix_Quotes($month_l) : "";

switch($sa) {

    case "show_all":
        show_all($min);
    break;
    case "show_month":
        show_month($year, $month, $month_l);
    break;
    default:
        select_month();
    break;

}
?>