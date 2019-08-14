<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Content BBCodes                          v1.0.1       07/16/2005
      Custom Text Area                         v1.0.0       11/23/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ('Access Denied');
}

global $prefix, $db, $admdata;
$module_name = basename(dirname(dirname(__FILE__)));
$aid = substr($aid, 0,25);
if(is_mod_admin($module_name)) {

/*********************************************************/
/* Sections Manager Functions                            */
/*********************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
    function contentpreview($subtitle, $page_header, $text, $page_footer='') {
        echo "<strong>Sneak Preview:</strong><br /><br /><strong>$subtitle</strong><br /><br />$page_header<br /><br />$text<br /><br />$page_footer<br />";
    }
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/

    function content() {
        global $prefix, $db, $language, $multilingual, $bgcolor2, $admin_file;

        include(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=content\">" . _CONTENT_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _CONTENT_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        title(_CONTENTMANAGER);
        OpenTable();
        echo "<table border=\"0\" width=\"100%\"><tr>"
            ."<td><strong>" . _TITLE . "</strong></td><td align=\"center\"><strong>" . _CURRENTSTATUS . "</strong></td><td align=\"center\"><strong>" . _CATEGORY . "</strong></td><td align=\"center\"><strong>" . _FUNCTIONS . "</strong></td></tr>";
        $result = $db->sql_query("SELECT * from " . $prefix . "_pages order by pid");
        while ($mypages = $db->sql_fetchrow($result)) {
            $mycid = intval($mypages['cid']);
            $myactive = intval($mypages['active']);
            $mypid = intval($mypages['pid']);
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            $mytitle = decode_bbcode(set_smilies(stripslashes(check_html($mypages['title'], "nohtml"))), 1);
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            if ($mycid == '0' || empty($mycid)) {
                $cat_title = _NONE;
            } else {
                $row_res = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_pages_categories where cid='$mycid'"));
                $cat_title = $row_res['title'];
            }
            if ($myactive == 1) {
                $status = _ACTIVE;
                $status_chng = _DEACTIVATE;
                $active = 1;
            } else {
                $status = "<i>" . _INACTIVE . "</i>";
                $status_chng = _ACTIVATE;
                $active = 0;
            }
            echo "<tr><td><a href=\"modules.php?name=Content&amp;pa=showpage&amp;pid=$mypid\">$mytitle</a></td><td align=\"center\">$status</td><td align=\"center\">$cat_title</td><td align=\"center\">[ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$mypid\">" . _EDIT . "</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$mypid&amp;active=$active\">$status_chng</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$mypid\">" . _DELETE . "</a> ]</td></tr>";
        }
        $db->sql_freeresult($result);
        echo "</table>";
        CloseTable();
        echo "<br />";

        OpenTable();
        echo "<center><strong>" . _ADDCATEGORY . "</strong></center><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<strong>" . _TITLE . ":</strong><br /><input type=\"text\" name=\"cat_title\" size=\"50\"><br /><br />"
            ."<strong>" . _DESCRIPTION . ":</strong><br /><textarea name=\"description\" rows=\"10\" cols=\"50\"></textarea><br /><br />"
            ."<input type=\"hidden\" name=\"op\" value=\"add_category\">"
            ."<input type=\"submit\" value=\"" . _ADD . "\">"
            ."</form>";
        CloseTable();
        $rescat = $db->sql_query("SELECT cid, title from " . $prefix . "_pages_categories order by title");
        $numrows = $db->sql_numrows($rescat);
        if ($numrows > 0) {
            echo "<br />";
            OpenTable();
            echo "<center><strong>" . _EDITCATEGORY . "</strong></center><br /><br />"
                ."<form action=\"".$admin_file.".php\" method=\"post\">"
                ."<strong>" . _CATEGORY . ":</strong> "
                ."<select name=\"cid\">";
            while ($row_cat = $db->sql_fetchrow($rescat)) {
                $cid = intval($row_cat['cid']);
                $cat_title = $row_cat['title'];
                echo "<option value=\"$cid\">$cat_title</option>";
            }
            echo "</select>&nbsp;&nbsp;"
                ."<input type=\"hidden\" name=\"op\" value=\"edit_category\">"
                ."<input type=\"submit\" value=\"" . _EDIT . "\">"
                ."</form>";
            CloseTable();
        }
        $db->sql_freeresult($rescat);

        echo "<br />";
        OpenTable();
        $res2 = $db->sql_query("SELECT cid, title from " . $prefix . "_pages_categories order by title");
        $numrows2 = $db->sql_numrows($res2);
        echo "<center><strong>" . _ADDANEWPAGE . "</strong></center><br /><br />"
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            ."<form action=\"".$admin_file.".php\" name=\"postcontent\" method=\"post\">"
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            ."<strong>" . _TITLE . ":</strong><br />"
            ."<input type=\"text\" name=\"title\" size=\"50\"><br /><br />";
        if ($numrows2 > 0) {
            echo "<strong>" . _CATEGORY . ":</strong>&nbsp;&nbsp;"
                ."<select name=\"cid\">"
                ."<option value=\"0\" selected>" . _NONE . "</option>";
            while ($row_res2 = $db->sql_fetchrow($res2)) {
                $cid = intval($row_res2['cid']);
                $cat_title = $row_res2['title'];
                echo "<option value=\"$cid\">$cat_title</option>";
            }
            echo "</select><br /><br />";
        } else {
            echo "<input type=\"hidden\" name=\"cid\" value=\"0\">";
        }
        $db->sql_freeresult($res2);
        echo "<strong>" . _CSUBTITLE . ":</strong><br />"
            ."<input type=\"text\" name=\"subtitle\" size=\"50\"><br /><br />"
            ."<strong>" . _HEADERTEXT . ":</strong><br />";
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
            global $wysiwyg_buffer;
            $wysiwyg_buffer = 'page_header,text,page_footer,signature';
            Make_TextArea('page_header', '', 'postcontent');
            echo "<strong>" . _PAGETEXT . ":</strong><br />"
            ."<span class=\"tiny\">" . _PAGEBREAK . "</span><br />";
            Make_TextArea('text', '', 'postcontent');
            echo "<strong>"._FOOTERTEXT.":</strong><br />";
            Make_TextArea('page_footer', '', 'postcontent');
            echo "<strong>" . _SIGNATURE . ":</strong><br />";
            Make_TextArea('signature', '', 'postcontent');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
        if ($multilingual == 1) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"clanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($language == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($language == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select><br /><br />';
        } else {
            echo "<input type=\"hidden\" name=\"clanguage\" value=\"$language\">";
        }
        echo "<strong>"._ACTIVATEPAGE."</strong><br />"
            ."<input type=\"radio\" name=\"active\" value=\"1\" checked>&nbsp;" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\">&nbsp;" . _NO . "<br /><br />"
            ."<input type=\"hidden\" name=\"op\" value=\"content_save\">"
            ."<input type=\"submit\" value=\"" . _SEND . "\">"
            ."</form>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }

    function add_category($cat_title, $description) {
        global $prefix, $db, $admin_file;

        $db->sql_query("insert into " . $prefix . "_pages_categories values (NULL, '$cat_title', '$description')");
        redirect($admin_file.'.php?op=content');
    }

    function edit_category($cid) {
        global $prefix, $db, $admin_file;

        include(NUKE_BASE_DIR.'header.php');
         OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=content\">" . _CONTENT_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _CONTENT_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        title(_CONTENTMANAGER);
        OpenTable();
        $cid = intval($cid);
        $row = $db->sql_fetchrow($db->sql_query("SELECT title, description from " . $prefix . "_pages_categories where cid='$cid'"));
        $title = $row['title'];
        $description = $row['description'];
        echo "<center><strong>" . _EDITCATEGORY . "</strong></center><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<strong>" . _TITLE . "</strong><br />"
            ."<input type=\"text\" name=\"cat_title\" value='$title' size=\"50\"><br /><br />"
            ."<strong>" . _DESCRIPTION . "</strong>:<br />"
            ."<textarea cols=\"50\" rows=\"10\" name=\"description\">$description</textarea><br /><br />"
            ."<input type=\"hidden\" name=\"cid\" value=\"$cid\">"
            ."<input type=\"hidden\" name=\"op\" value=\"save_category\">"
            ."<input type=\"submit\" value=\"" . _SAVECHANGES . "\">&nbsp;&nbsp;"
            ."[ <a href=\"".$admin_file.".php?op=del_content_cat&amp;cid=$cid\">" . _DELETE . "</a> ]"
            ."</form>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }

    function save_category($cid, $cat_title, $description) {
        global $prefix, $db, $admin_file;

        $cid = intval($cid);
        $db->sql_query("update " . $prefix . "_pages_categories set title='$cat_title', description='$description' where cid='$cid'");
        redirect($admin_file.'.php?op=content');
    }

    function del_content_cat($cid, $ok=0) {
        global $prefix, $db, $admin_file;

        if ($ok==1) {
            $cid = intval($cid);
            $db->sql_query("delete from " . $prefix . "_pages_categories where cid='$cid'");
            $result = $db->sql_query("SELECT pid from " . $prefix . "_pages where cid='$cid'");
            while ($row = $db->sql_fetchrow($result)) {
                $pid = intval($row['pid']);
                $db->sql_query("update " . $prefix . "_pages set cid='0' where pid='$pid'");
            }
            $db->sql_freeresult($result);
            redirect($admin_file.'.php?op=content');
        } else {
            include(NUKE_BASE_DIR.'header.php');
             OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=content\">" . _CONTENT_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _CONTENT_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            title(_CONTENTMANAGER);
            $cid = intval($cid);
            $row2 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_pages_categories where cid='$cid'"));
            $title = $row2['title'];
            OpenTable();
            echo "<center><strong>" . _DELCATEGORY . ": $title</strong><br /><br />"
                .""._DELCONTENTCAT."<br /><br />"
                ."[ <a href=\"".$admin_file.".php?op=content\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=del_content_cat&amp;cid=$cid&amp;ok=1\">" . _YES . "</a> ]</center>";
            CloseTable();
            include(NUKE_BASE_DIR.'footer.php');
        }
    }

    function content_edit($pid) {
        global $prefix, $db, $language, $multilingual, $bgcolor2, $admin_file;

        include(NUKE_BASE_DIR.'header.php');
         OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=content\">" . _CONTENT_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _CONTENT_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        title(_CONTENTMANAGER);
        $pid = intval($pid);
        $mypages = $db->sql_fetchrow($db->sql_query("SELECT * from " . $prefix . "_pages WHERE pid='$pid'"));
        $mycid = intval($mypages['cid']);
        $myactive = intval($mypages['active']);
        $mytitle = $mypages['title'];
        $mysubtitle = $mypages['subtitle'];
        $mypage_header = $mypages['page_header'];
        $mytext = $mypages['text'];
        $mypage_footer = $mypages['page_footer'];
        $mysignature = $mypages['signature'];
        $myclanguage = $mypages['clanguage'];
        if ($myactive == 1) {
            $sel1 = 'checked';
            $sel2 = '';
        } else {
            $sel1 = '';
            $sel2 = 'checked';
        }
        OpenTable();
        echo "<center><strong>" . _EDITPAGECONTENT . "</strong></center><br /><br />"
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            ."<form action=\"".$admin_file.".php\" name=\"postcontent\" method=\"post\">"
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            ."<strong>" . _TITLE . ":</strong><br />"
            ."<input type=\"text\" name=\"title\" size=\"50\" value=\"$mytitle\"><br /><br />";
        $res = $db->sql_query("SELECT cid, title from " . $prefix . "_pages_categories");
        $numrows = $db->sql_numrows($res);
        if ($numrows > 0) {
            echo "<strong>" . _CATEGORY . ":</strong>&nbsp;&nbsp;"
                ."<select name=\"cid\">";
            if ($mycid == 0) {
                $sel = "selected";
            } else {
              $sel = "";
            }
            echo "<option value=\"0\" $sel>" . _NONE . "</option>";
            while ($row_res = $db->sql_fetchrow($res)) {
                $cid = intval($row_res['cid']);
                $cat_title = $row_res['title'];
                if ($mycid == $cid) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                echo "<option value=\"$cid\" $sel>$cat_title</option>";
            }
            echo "</select><br /><br />";
        } else {
            echo "<input type=\"hidden\" name=\"cid\" value=\"0\">";
        }
        echo "<strong>" . _CSUBTITLE . ":</strong><br />"
            ."<input type=\"text\" name=\"subtitle\" size=\"50\" value=\"$mysubtitle\"><br /><br />"
            ."<strong>" . _HEADERTEXT . ":</strong><br />";
/*****[BEGIN]******************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
            global $wysiwyg_buffer;
            $wysiwyg_buffer = 'page_header,text,page_footer,signature';
            Make_TextArea('page_header', $mypage_header, 'postcontent');
            echo "<strong>" . _PAGETEXT . ":</strong><br />"
            ."<span class=\"tiny\">" . _PAGEBREAK . "</span><br />";
            Make_TextArea('text', $mytext, 'postcontent');
            echo "<strong>" . _FOOTERTEXT . ":</strong><br />";
            Make_TextArea('page_footer', $mypage_footer, 'postcontent');
            echo "<strong>" . _SIGNATURE . ":</strong><br />";
            Make_TextArea('signature', $mysignature, 'postcontent');
/*****[END]********************************************
 [ Mod:     Content BBCodes                    v1.0.1 ]
 ******************************************************/
        if ($multilingual == 1) {
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"clanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($myclanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($myclanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select><br /><br />';
        } else {
            echo "<input type=\"hidden\" name=\"clanguage\" value=\"$myclanguage\">";
        }
    /*****[BEGIN]******************************************
     [ Mod:     Content BBCodes                    v1.0.1 ]
     ******************************************************/
        $mysubtitle_bb = decode_bbcode(set_smilies(stripslashes(check_html($mysubtitle, "nohtml"))), 1);
        $mypage_header_bb = decode_bbcode(set_smilies(stripslashes($mypage_header)), 1, true);
        $mypage_header_bb = evo_img_tag_to_resize($mypage_header_bb);
        $mytext_bb = decode_bbcode(set_smilies(stripslashes($mytext)), 1, true);
        $mytext_bb = evo_img_tag_to_resize($mytext_bb);
        $mypage_footer_bb = decode_bbcode(set_smilies(stripslashes($mypage_footer)), 1, true);
        $mypage_footer_bb = evo_img_tag_to_resize($mypage_footer_bb);
        contentpreview($mysubtitle_bb, $mypage_header_bb, $mytext_bb, $mypage_footer_bb);
        echo "<strong><br />" . _ACTIVATEPAGE . "</strong><br />"
    /*****[END]********************************************
     [ Mod:     Content BBCodes                    v1.0.1 ]
     ******************************************************/
            ."<input type=\"radio\" name=\"active\" value=\"1\" $sel1>&nbsp;" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\" $sel2>&nbsp;" . _NO . "<br /><br />"
            ."<input type=\"hidden\" name=\"pid\" value=\"$pid\">"
            ."<input type=\"hidden\" name=\"op\" value=\"content_save_edit\">"
            ."<input type=\"submit\" value=\"" . _SAVECHANGES . "\">"
            ."</form>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }

    function content_save($title, $subtitle, $page_header, $text, $page_footer, $signature, $clanguage, $active, $cid) {
        global $prefix, $db, $admin_file;

        $text = Fix_Quotes($text);
        $title = Fix_Quotes($title);
        $subtitle = Fix_Quotes($subtitle);
        $db->sql_query("insert into " . $prefix . "_pages values (NULL, '$cid', '$title', '$subtitle', '$active', '$page_header', '$text', '$page_footer', '$signature', now(), '0', '$clanguage')");
        redirect($admin_file.'.php?op=content');
    }

    function content_save_edit($pid, $title, $subtitle, $page_header, $text, $page_footer, $signature, $clanguage, $active, $cid) {
        global $prefix, $db, $admin_file;

        $text = Fix_Quotes($text);
        $title = Fix_Quotes($title);
        $subtitle = Fix_Quotes($subtitle);
        $pid = intval($pid);
        $db->sql_query("update " . $prefix . "_pages set cid='$cid', title='$title', subtitle='$subtitle', active='$active', page_header='$page_header', text='$text', page_footer='$page_footer', signature='$signature', clanguage='$clanguage' where pid='$pid'");
        redirect($admin_file.'.php?op=content');
    }

    function content_change_status($pid, $active) {
        global $prefix, $db, $admin_file;

        if ($active == 1) {
            $new_active = 0;
        } elseif ($active == 0) {
            $new_active = 1;
        }
        $pid = intval($pid);
        $db->sql_query("update " . $prefix . "_pages set active='$new_active' WHERE pid='$pid'");
        redirect($admin_file.'.php?op=content');
    }

    function content_delete($pid, $ok=0) {
        global $prefix, $db, $admin_file;

        $pid = intval($pid);
        if ($ok==1) {
            $db->sql_query("delete from " . $prefix . "_pages where pid='$pid'");
            redirect($admin_file.'.php?op=content');
        } else {
            include(NUKE_BASE_DIR.'header.php');
             OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=content\">" . _CONTENT_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _CONTENT_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            title("" . _CONTENTMANAGER . "");
            $row = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_pages where pid='$pid'"));
            $title = $row['title'];
            OpenTable();
            echo "<center><strong>" . _DELCONTENT . ": $title</strong><br /><br />"
                .""._DELCONTWARNING." $title?<br /><br />"
                ."[ <a href=\"".$admin_file.".php?op=content\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid&amp;ok=1\">" . _YES . "</a> ]</center>";
            CloseTable();
            include(NUKE_BASE_DIR.'footer.php');
        }
    }

    switch ($op) {

        case "content":
            content();
        break;

        case "content_edit":
            content_edit($pid);
        break;

        case "content_delete":
            content_delete($pid, $ok);
        break;

        case "content_review":
            content_review($title, $subtitle, $page_header, $text, $page_footer, $signature, $clanguage, $active);
        break;

        case "content_save":
            content_save($title, $subtitle, $page_header, $text, $page_footer, $signature, $clanguage, $active, $cid);
        break;

        case "content_save_edit":
            content_save_edit($pid, $title, $subtitle, $page_header, $text, $page_footer, $signature, $clanguage, $active, $cid);
        break;

        case "content_change_status":
            content_change_status($pid, $active);
        break;

        case "add_category":
            add_category($cat_title, $description);
        break;

        case "edit_category":
            edit_category($cid);
        break;

        case "save_category":
            save_category($cid, $cat_title, $description);
        break;

        case "del_content_cat":
            del_content_cat($cid, $ok);
        break;
    }

} else {
    include(NUKE_BASE_DIR.'header.php');
    GraphicAdmin();
    OpenTable();
    echo "<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"</center>";
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

?>