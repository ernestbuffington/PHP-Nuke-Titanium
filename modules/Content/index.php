<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Content BBCodes                          v1.0.1       07/16/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = '- '.$module_name;

function showpage($pid, $page=0) {
    global $prefix, $db, $sitename, $admin, $module_name;
    include(NUKE_BASE_DIR.'header.php');
    OpenTable();
    $pid = intval($pid);
    $mypage = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_pages WHERE pid='$pid'"));
    $myactive = intval($mypage['active']);
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
    $mytitle = decode_bbcode(set_smilies(stripslashes(check_html($mypage['title'], "nohtml"))), 1);
    $mysubtitle = decode_bbcode(set_smilies(stripslashes(check_html($mypage['subtitle'], "nohtml"))), 1);
    $mypage_header = decode_bbcode(set_smilies(stripslashes($mypage['page_header'])), 1, true);
    $mypage_header = evo_img_tag_to_resize($mypage_header);
    $mytext = decode_bbcode(set_smilies(stripslashes($mypage['text'])), 1, true);
    $mytext = evo_img_tag_to_resize($mytext);
    $mypage_footer = decode_bbcode(set_smilies(stripslashes($mypage['page_footer'])), 1, true);
    $mypage_footer = evo_img_tag_to_resize($mypage_footer);
    $mysignature = decode_bbcode(set_smilies(stripslashes($mypage['signature'])), 1, true);
    $mysignature = evo_img_tag_to_resize($mysignature);
    $mydate = $mypage['date'];
    $mycounter = intval($mypage['counter']);
    if (($myactive == 0) AND (!is_mod_admin($module_name))) {
        echo 'Sorry... This page doesn\'t exist.';
    } else {
        $db->sql_query("UPDATE ".$prefix."_pages SET counter=counter+1 WHERE pid='$pid'");
        $date = explode(" ", $mydate);
        echo "<span class=\"title\">$mytitle</span><br />"
            ."<span class=\"content\">$mysubtitle</span><br /><br /><br /><br />";
       // $mypage['text'] = decode_bbcode(set_smilies(stripslashes($mypage['text'])),1);
    /*****[END]********************************************
     [ Mod:     Content BBCodes                    v1.0.1 ]
     ******************************************************/
        $contentpages = explode( "<!--pagebreak-->", $mytext );
        $pageno = count($contentpages);
        if ( empty($page) || $page < 1 )
            $page = 1;
        if ( $page > $pageno )
            $page = $pageno;
        $arrayelement = (int)$page;
        $arrayelement --;
        if ($pageno > 1) {
            echo ""._PAGE.": $page/$pageno<br />";
        }
        if ($page == 1) {
            echo "<p align=\"justify\">".nl2br($mypage_header)."</p><br />";
        }
        echo "<p align=\"justify\">$contentpages[$arrayelement]</p>";
        if($page >= $pageno) {
            $next_page = "";
        } else {
            $next_pagenumber = $page + 1;
            if ($page != 1) {
                $next_page .= '- ';
            }
            $next_page .= "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$next_pagenumber\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$next_pagenumber\"><img src=\"images/right.gif\" border=\"0\" alt=\""._NEXT."\" title=\""._NEXT."\"></a>";
        }
        if ($page == $pageno) {
            echo "<br /><p align=\"justify\">".nl2br($mypage_footer)."</p><br /><br />";
        }
        if($page <= 1) {
            $previous_page = '';
        } else {
            $previous_pagenumber = $page - 1;
            $previous_page = "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$previous_pagenumber\"><img src=\"images/left.gif\" border=\"0\" alt=\""._PREVIOUS."\" title=\""._PREVIOUS."\"></a> <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$previous_pagenumber\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
        }
        echo "<br /><br /><br /><center>$previous_page $next_page</center><br /><br />";
        if ($page == $pageno) {
            echo "<p align=\"right\">".nl2br($mysignature)."</p>"
            ."<p align=\"right\">"._COPYRIGHT." $sitename "._COPYRIGHT2."</p>"
            ."<p align=\"right\"><span class=\"tiny\">"._PUBLISHEDON.": $date[0] ($mycounter "._READS.")</span></p>"
            ."<center>"._GOBACK."</center>";
        }
    }
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

function list_pages() {
    global $prefix, $db, $sitename, $admin, $multilingual, $module_name, $admin_file;
    include(NUKE_BASE_DIR.'header.php');
    title($sitename.': '._PAGESLIST);
    OpenTable();
    echo "<center><span class=\"content\">"._LISTOFCONTENT." $sitename:</span></center><br /><br />";
    $result = $db->sql_query("SELECT * FROM ".$prefix."_pages_categories");
    $numrows = $db->sql_numrows($result);
    $numrows2 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pages WHERE cid!='0' AND active='1'"));
    if ($numrows > 0 AND $numrows2 > 0) {
        echo "<center>"._CONTENTCATEGORIES."</center><br /><br />"
            ."<table border=\"1\" align=\"center\" width=\"95%\">";
        while ($row = $db->sql_fetchrow($result)) {
            $cid = intval($row['cid']);
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            $title = decode_bbcode(set_smilies(stripslashes(check_html($row['title'], "nohtml"))), 1);
            $description = decode_bbcode(set_smilies(stripslashes($row['description'])), 1, true);
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            $numrows3 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pages WHERE cid='$cid'"));
            if ($numrows3 > 0) {
                echo "<tr><td valign=\"top\">&nbsp;<a href=\"modules.php?name=$module_name&amp;pa=list_pages_categories&amp;cid=$cid\">" . decode_bbcode(set_smilies($title)) . "</a>&nbsp;</td><td align=\"left\">$description</td></tr>";
            }
        }
        $db->sql_freeresult($result);
        echo "</table><br /><br />"
            ."<center>"._NONCLASSCONT."</center><br /><br />";
    }
    $result4 = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='1' AND cid='0' ORDER BY date");
    echo "<blockquote>";
    while ($row4 = $db->sql_fetchrow($result4)) {
        $pid = intval($row4['pid']);
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
        $title = decode_bbcode(set_smilies(stripslashes(check_html($row4['title'], "nohtml"))), 1);
        $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row4['subtitle'], "nohtml"))), 1);
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
        $clanguage = $row4['clanguage'];
        if ($multilingual == 1) {
            $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
        } else {
            $the_lang = "";
        }
        if (!empty($subtitle)) {
            $subtitle = " ($subtitle)";
        } else {
              $subtitle = "";
        }
        if (is_mod_admin($module_name)) {
            echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a> " . decode_bbcode(set_smilies($subtitle)) . " [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\">"._DEACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br />";
        } else {
            echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a> " . decode_bbcode(set_smilies($subtitle)) . "<br />";
        }
    }
    $db->sql_freeresult($result4);
    echo "</blockquote>";
    if (is_mod_admin($module_name)) {
        $result5 = $db->sql_query("SELECT pid, cid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='0' ORDER BY date");
        echo "<br /><br /><center><strong>"._YOURADMINLIST."</strong></center><br /><br />";
        echo "<blockquote>";
        while ($row5 = $db->sql_fetchrow($result5)) {
            $pid = intval($row5['pid']);
            $cid = intval($row5['cid']);
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            $title = decode_bbcode(set_smilies(stripslashes(check_html($row5['title'], "nohtml"))), 1);
            $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row5['subtitle'], "nohtml"))), 1);
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            $clanguage = $row5['clanguage'];
            if ($multilingual == 1) {
                $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
            } else {
                $the_lang = "";
            }
            if (!empty($subtitle)) {
                $subtitle = " ($subtitle) ";
            } else {
                $subtitle = " ";
            }
            echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a> " . decode_bbcode(set_smilies($subtitle)) . " [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=0\">"._ACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br />";
        }
        $db->sql_freeresult($result5);
        echo "</blockquote>";
    }
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

function list_pages_categories($cid) {
    global $prefix, $db, $sitename, $admin, $multilingual, $module_name, $admin_file;
    include(NUKE_BASE_DIR.'header.php');
    title($sitename.': '._PAGESLIST);
    OpenTable();
    echo "<center>"._LISTOFCONTENT." $sitename:</center><br /><br />";
    $cid = intval($cid);
    $result = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='1' AND cid='$cid' ORDER BY date");
    echo "<blockquote>";
    while ($row = $db->sql_fetchrow($result)) {
        $pid = intval($row['pid']);
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
        $title = decode_bbcode(set_smilies(stripslashes(check_html($row['title'], "nohtml"))), 1);
        $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row['subtitle'], "nohtml"))), 1);
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
        $clanguage = $row['clanguage'];
        if ($multilingual == 1) {
            $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
        } else {
            $the_lang = "";
        }
        if (!empty($subtitle)) {
            $subtitle = " ($subtitle)";
        } else {
                $subtitle = "";
        }
        if (is_mod_admin($module_name)) {
            echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a> " . decode_bbcode(set_smilies($subtitle)) . " [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\">"._DEACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br />";
        } else {
            echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a> " . decode_bbcode(set_smilies($subtitle)) . "<br />";
        }
    }
    $db->sql_freeresult($result);
    echo "</blockquote>";
    if (is_mod_admin($module_name)) {
        $result2 = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='0' AND cid='$cid' ORDER BY date");
        echo "<br /><br /><center><strong>"._YOURADMINLIST."</strong></center><br /><br />";
        echo "<blockquote>";
        while ($row2 = $db->sql_fetchrow($result2)) {
            $pid = intval($row2['pid']);
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            $title = decode_bbcode(set_smilies(stripslashes(check_html($row2['title'], "nohtml"))), 1);
            $subtitle = decode_bbcode(set_smilies(stripslashes(check_html($row2['subtitle'], "nohtml"))), 1);
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            $clanguage = $row2['clanguage'];
            if ($multilingual == 1) {
                $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
            } else {
                $the_lang = "";
            }
              if (!empty($subtitle)) {
                $subtitle = " ($subtitle) ";
            } else {
                    $subtitle = " ";
            }
            echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">" . decode_bbcode(set_smilies($title)) . "</a> " . decode_bbcode(set_smilies($subtitle)) . " [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=0\">"._ACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br />";
        }
        $db->sql_freeresult($result2);
        echo "</blockquote>";
    }
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

if (!isset($page)) { $page = ''; }
if (!isset($pa)) { $pa = ''; }

switch($pa) {

    case "showpage":
        showpage($pid, $page);
    break;

    case "list_pages_categories":
        list_pages_categories($cid);
    break;

    default:
        list_pages();
    break;

}

?>