<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0
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
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Patched                         v3.0.0       08/14/2019
 ************************************************************************/
/********************************************************/
/* Titanium Blogs                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/

if (!defined('ADMIN_FILE')) 
die ("Access Denied");

global $prefix, $db, $admdata;

$module_name = basename(dirname(dirname(__FILE__)));

if(is_mod_admin($module_name)) 
{
  include_once(NUKE_INCLUDE_DIR.'nsnne_func.php');
  $ne_config = ne_get_configs();

/*********************************************************/
/* Topics Manager Functions                              */
/*********************************************************/

function topicsmanager() 
{
    global $prefix, $db, $admin_file, $tipath;

    include(NUKE_BASE_DIR."header.php");

    OpenTable();

    echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
	echo "<br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";

    echo "<center><span class=\"option\"><strong>"._CURRENTTOPICS . "</strong></span><br />"._CLICK2EDIT . "</span></center><br />"
        ."<table border=\"0\" width=\"100%\" align=\"center\" cellpadding=\"2\">";
    $count = 0;
    $result = $db->sql_query("SELECT topicid, topicname, topicimage, topictext from " . $prefix . "_topics order by topicname");

    while ($row = $db->sql_fetchrow($result)) 
	{
        $topicid = intval($row['topicid']);
        $topicname = $row['topicname'];
        $topicimage = $row['topicimage'];
        $topictext = $row['topictext'];
    
	    echo "<td align=\"center\" width='17%' valign='top'>"
            ."<a href=\"".$admin_file.".php?op=topicedit&amp;topicid=$topicid\"><img src=\"$tipath$topicimage\" border=\"0\" alt=\"\" /></a><br />"
            ."<span class=\"content\"><strong>$topictext</td>";
    
	    $count++;
    
	    if ($count == 6) 
		{
            echo "</tr><tr>";
            $count = 0;
        }
    }
    echo "</table>";
    CloseTable();
 
    OpenTable();
    echo "<center><span class=\"option\"><strong>"._ADDATOPIC . "</strong></span></center><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<strong>"._TOPICNAME . ":</strong><br /><span class=\"tiny\">"._TOPICNAME1 . "<br />"
        .""._TOPICNAME2 . "</span><br />"
        ."<input type=\"text\" name=\"topicname\" size=\"20\" maxlength=\"20\" value=\"$topicname\"><br /><br />"
        ."<strong>"._TOPICTEXT . ":</strong><br /><span class=\"tiny\">"._TOPICTEXT1 . "<br />"
        .""._TOPICTEXT2 . "</span><br />"
        ."<input type=\"text\" name=\"topictext\" size=\"40\" maxlength=\"40\" value=\"$topictext\"><br /><br />"
        ."<strong>"._TOPICIMAGE . ":</strong><br />"
        ."<select name=\"topicimage\">";
 
    $handle=opendir($tipath);
 
    while ($file = readdir($handle)) 
	{
        if ( (preg_match("~^([_0-9a-zA-Z]+)([.]{1})([_0-9a-zA-Z]{3})$~",$file)) AND $file != "AllTopics.png") {
            $tlist .= "$file ";
        }
    }
    closedir($handle);
    $tlist = explode(" ", $tlist);
    sort($tlist);
    
	for ($i=0; $i < count($tlist); $i++) 
	{
        if(!empty($tlist[$i])) 
		{
            echo "<option name=\"topicimage\" value=\"$tlist[$i]\">$tlist[$i]\n";
        }
    }
    echo "</select><br /><br />"
        ."<input type=\"hidden\" name=\"op\" value=\"topicmake\">"
        ."<input type=\"submit\" value=\""._ADDTOPIC . "\">"
        ."</form>";
    CloseTable();
    
	include(NUKE_BASE_DIR."footer.php");
}

function topicedit($topicid) {
    global $prefix, $db, $admin_file, $tipath;
    include(NUKE_BASE_DIR."header.php");
    OpenTable();
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    OpenTable();
    echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
        $query = $db->sql_query("SELECT topicid, topicname, topicimage, topictext from ".$prefix . "_topics where topicid='$topicid'");
        list($topicid, $topicname, $topicimage, $topictext) = $db->sql_fetchrow($query);
    $topicid = intval($topicid);
    echo "<img src=\"$tipath$topicimage\" align=\"right\" alt=\"$topictext\" />"
        ."<span class=\"option\"><strong>"._EDITTOPIC . ": $topictext</strong></span>"
        ."<br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\"><br />"
        ."<strong>"._TOPICNAME . ":</strong><br /><span class=\"tiny\">"._TOPICNAME1 . "<br />"
        .""._TOPICNAME2 . "</span><br />"
        ."<input type=\"text\" name=\"topicname\" size=\"20\" maxlength=\"20\" value=\"$topicname\"><br /><br />"
        ."<strong>"._TOPICTEXT . ":</strong><br /><span class=\"tiny\">"._TOPICTEXT1 . "<br />"
        .""._TOPICTEXT2 . "</span><br />"
        ."<input type=\"text\" name=\"topictext\" size=\"40\" maxlength=\"40\" value=\"$topictext\"><br /><br />"
        ."<strong>"._TOPICIMAGE . ":</strong><br />"
        ."<select name=\"topicimage\">";
    $handle=opendir($tipath);
    while ($file = readdir($handle)) {
        if ( (preg_match("#^([_0-9a-zA-Z]+)([.]{1})([_0-9a-zA-Z]{3})$#",$file)) AND $file != "AllTopics.png") {
            $tlist .= "$file ";
        }
    }
    closedir($handle);
    $tlist = explode(" ", $tlist);
    sort($tlist);
    for ($i=0; $i < count($tlist); $i++) {
        if(!empty($tlist[$i])) {
            if ($topicimage == $tlist[$i]) {
                $sel = "selected";
            } else {
                $sel = "";
            }
            echo "<option name=\"topicimage\" value=\"$tlist[$i]\" $sel>$tlist[$i]\n";
        }
    }
    echo "</select><br /><br />"
        ."<strong>"._ADDRELATED . ":</strong><br />"
        .""._SITENAME . ": <input type=\"text\" name=\"name\" size=\"30\" maxlength=\"30\"><br />"
        .""._URL . ": <input type=\"text\" name=\"url\" value=\"http://\" size=\"50\" maxlength=\"200\"><br /><br />"
        ."<strong>"._ACTIVERELATEDLINKS . ":</strong><br />"
        ."<table width=\"100%\" border=\"0\">";
    $res = $db->sql_query("SELECT rid, name, url from ".$prefix . "_related where tid='$topicid'");
    $num = $db->sql_numrows($res);
    if ($num == 0) {
        echo "<tr><td><span class=\"tiny\">"._NORELATED . "</span></td></tr>";
    }
        while($row2 = $db->sql_fetchrow($res)) {
            $rid = intval($row2['rid']);
            $name = $row2['name'];
            $url = stripslashes($row2['url']);
        echo "<tr><td align=\"left\"><span class=\"content\"><strong><big>&middot;</big></strong>&nbsp;&nbsp;<a href=\"$url\">$name</a></td>"
                ."<td align=\"center\"><span class=\"content\"><a href=\"$url\">$url</a></td><td align=\"right\"><span class=\"content\">[ <a href=\"".$admin_file.".php?op=relatededit&amp;tid=$topicid&amp;rid=$rid\">"._EDIT . "</a> | <a href=\"".$admin_file.".php?op=relateddelete&amp;tid=$topicid&amp;rid=$rid\">"._DELETE . "</a> ]</td></tr>";
    }
    echo "</table><br /><br />"
        ."<input type=\"hidden\" name=\"topicid\" value=\"$topicid\">"
        ."<input type=\"hidden\" name=\"op\" value=\"topicchange\">"
        ."<INPUT type=\"submit\" value=\""._SAVECHANGES . "\"> <span class=\"content\">[ <a href=\"".$admin_file.".php?op=topicdelete&amp;topicid=$topicid\">"._DELETE . "</a> ]</span>"
        ."</form>";
    CloseTable();
    include(NUKE_BASE_DIR."footer.php");
}

function relatededit($tid, $rid) {
    global $prefix, $db, $admin_file;
    include(NUKE_BASE_DIR."header.php");
    OpenTable();
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    OpenTable();
    echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
    CloseTable();
    echo "<br />";
    $rid = intval($rid);
    $tid = intval($tid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT name, url from ".$prefix . "_related where rid='$rid'"));
        $name = $row['name'];
        $url = $row['url'];
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT topictext, topicimage from ".$prefix . "_topics where topicid='$tid'"));
        $topictext = $row2['topictext'];
        $topicimage = $row2['topicimage'];
    OpenTable();
    echo "<center>"
        ."<img src=\"images/Blog_Topics/$topicimage\" align=\"right\" alt=\"$topictext\" />"
        ."<span class=\"option\"><strong>"._EDITRELATED . "</strong></span><br />"
        ."<strong>"._TOPIC . ":</strong> $topictext</center>"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        .""._SITENAME . ": <input type=\"text\" name=\"name\" value=\"$name\" size=\"30\" maxlength=\"30\"><br /><br />"
        .""._URL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"60\" maxlength=\"200\"><br /><br />"
        ."<input type=\"hidden\" name=\"op\" value=\"relatedsave\">"
        ."<input type=\"hidden\" name=\"tid\" value=\"$tid\">"
        ."<input type=\"hidden\" name=\"rid\" value=\"$rid\">"
        ."<input type=\"submit\" value=\""._SAVECHANGES . "\"> "._GOBACK . ""
        ."</form>";
    CloseTable();
    include(NUKE_BASE_DIR."footer.php");
}

function relatedsave($tid, $rid, $name, $url) {
    global $prefix, $db, $admin_file;
    $rid = intval($rid);
    $db->sql_query("update ".$prefix . "_related set name='$name', url='$url' where rid='$rid'");
    redirect($admin_file.".php?op=topicedit&topicid=$tid");
}

function relateddelete($tid, $rid) {
    global $prefix, $db, $admin_file;
    $rid = intval($rid);
    $db->sql_query("delete from ".$prefix . "_related where rid='$rid'");
    redirect($admin_file.".php?op=topicedit&topicid=$tid");
}

function topicmake($topicname, $topicimage, $topictext) {
    global $prefix, $db, $admin_file;
    $topicname = Fix_Quotes($topicname);
    $topicimage = Fix_Quotes($topicimage);
    $topictext = Fix_Quotes($topictext);
    $db->sql_query("INSERT INTO ".$prefix . "_topics VALUES (NULL,'$topicname','$topicimage','$topictext','0')");
    redirect($admin_file.".php?op=topicsmanager#Add");
}

function topicchange($topicid, $topicname, $topicimage, $topictext, $name, $url) {
    global $prefix, $db, $admin_file;
    $topicname = Fix_Quotes($topicname);
    $topicimage = Fix_Quotes($topicimage);
    $topictext = Fix_Quotes($topictext);
    $name = Fix_Quotes($name);
    $url = Fix_Quotes($url);
    $topicid = intval($topicid);
    $db->sql_query("update ".$prefix . "_topics set topicname='$topicname', topicimage='$topicimage', topictext='$topictext' where topicid='$topicid'");
    if (!$name) {
    } else {
        $db->sql_query("insert into ".$prefix . "_related VALUES (NULL, '$topicid','$name','$url')");
    }
    redirect($admin_file.".php?op=topicedit&topicid=$topicid");
}

function topicdelete($topicid, $ok=0) {
    global $prefix, $db, $ne_config, $admin_file;
    $topicid = intval($topicid);
    if ($ok==1) {
    $row = $db->sql_fetchrow($db->sql_query("SELECT sid from " . $prefix . "_stories where topic='$topicid'"));
        $sid = intval($row['sid']);
        // Copyright (c) 2000-2005 by NukeScripts Network
        if($ne_config['hometopic'] == $topicid) { ne_save_config("hometopic", "0"); }
        // Copyright (c) 2000-2005 by NukeScripts Network
        $db->sql_query("delete from " . $prefix . "_stories where topic='$topicid'");
        $db->sql_query("delete from " . $prefix . "_topics where topicid='$topicid'");
        $db->sql_query("delete from " . $prefix . "_related where tid='$topicid'");
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT sid from " . $prefix . "_comments where sid='$sid'"));
        $sid = intval($row2['sid']);
        $db->sql_query("delete from " . $prefix . "_comments where sid='$sid'");
        redirect($admin_file.".php?op=topicsmanager");
    } else {
        global $topicimage;
        include(NUKE_BASE_DIR."header.php");
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . _TOPICSMANAGER . "</strong></span></center>";
        CloseTable();
        echo "<br />";
    $row3 = $db->sql_fetchrow($db->sql_query("SELECT topicimage, topictext from " . $prefix . "_topics where topicid='$topicid'"));
        $topicimage = $row3['topicimage'];
        $topictext = $row3['topictext'];
        OpenTable();
        echo "<center><img src=\"images/Blog_Topics/$topicimage\" alt=\"$topictext\" /><br /><br />"
            ."<strong>" . _DELETETOPIC . " $topictext</strong><br /><br />"
            ."" . _TOPICDELSURE . " <i>$topictext</i>?<br />"
            ."" . _TOPICDELSURE1 . "<br /><br />"
            ."[ <a href=\"".$admin_file.".php?op=topicsmanager\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=topicdelete&amp;topicid=$topicid&amp;ok=1\">" . _YES . "</a> ]</center><br /><br />";
        CloseTable();
        include(NUKE_BASE_DIR."footer.php");
    }
}

switch ($op) {

    case "topicsmanager":
    topicsmanager();
    break;

    case "topicedit":
    topicedit($topicid);
    break;

    case "topicmake":
    topicmake($topicname, $topicimage, $topictext);
    break;

    case "topicdelete":
    topicdelete($topicid, $ok);
    break;

    case "topicchange":
    topicchange($topicid, $topicname, $topicimage, $topictext, $name, $url);
    break;

    case "relatedsave":
    relatedsave($tid, $rid, $name, $url);
    break;

    case "relatededit":
    relatededit($tid, $rid);
    break;

    case "relateddelete":
    relateddelete($tid, $rid);
    break;

}

} else {
        include(NUKE_BASE_DIR."header.php");
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo "<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"</center>";
        CloseTable();
        include(NUKE_BASE_DIR."footer.php");
}

?>