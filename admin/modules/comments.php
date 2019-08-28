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
/************************************************************************/
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://hub.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
 if (!defined('ADMIN_FILE')) die ("Illegal File Access");

global $prefix, $db;

if (is_mod_admin()) 
{
/*********************************************************/
/* Comments Delete Function                              */
/*********************************************************/
/* Thanks to Oleg [Dark Pastor] Martos from http://www.rolemancer.ru */
/* to code the comments childs deletion function!                    */
 function removeSubComments($tid) 
 {
    global $prefix, $db;

    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid from " . $prefix . "_comments where pid='$tid'");
    $numrows = $db->sql_numrows($result);

    if($numrows>0) 
	{
      while ($row = $db->sql_fetchrow($result)) 
	  {
         $stid = intval($row['tid']);
      
	     removeSubComments($stid);
      
	     $stid = intval($stid);
         $db->sql_query("delete from " . $prefix . "_comments where tid='$stid'");
      }
    }
    
	$db->sql_query("delete from " . $prefix . "_comments where tid='$tid'");
 }

 function removeComment ($tid, $sid, $ok=0) 
 {
    global $ultramode, $prefix, $db, $admin_file;

    if($ok) 
	{
        $tid = intval($tid);
        $result = $db->sql_query("SELECT date from " . $prefix . "_comments where pid='$tid'");
        $numresults = $db->sql_numrows($result);
        $sid = intval($sid);
    
	    $db->sql_query("update " . $prefix . "_stories set comments=comments-1-'$numresults' where sid='$sid'");
    
	    removeSubComments($tid);
    
	    if ($ultramode) 
        ultramode();
        
		redirect("modules.php?name=Blog&file=article&sid=$sid");
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');
    
	    get_lang('Blog');          
    
	    OpenTable();
    
	    echo "<div align=\"center\">" . _SURETODELCOMMENTS;
        echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid&amp;ok=1\">" . _YES . "</a> ]</div>";
    
	    CloseTable();
    
	    include(NUKE_BASE_DIR.'footer.php');
    }
 }

 function removePollSubComments($tid) 
 {
    global $prefix, $db;

    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid from " . $prefix . "_pollcomments where pid='$tid'");
    $numrows = $db->sql_numrows($result);

    if($numrows>0) 
	{
        while ($row = $db->sql_fetchrow($result)) 
		{
            $stid = intval($row['tid']);
        
		    removePollSubComments($stid);
        
		    $db->sql_query("delete from " . $prefix . "_pollcomments where tid='$stid'");
        }
    }
    
	$db->sql_query("delete from " . $prefix . "_pollcomments where tid='$tid'");
 }

 function RemovePollComment ($tid, $pollID, $ok=0) 
 {
    global $admin_file;

      if($ok) 
	  {
        removePollSubComments($tid);
        redirect("modules.php?name=Surveys&op=results&pollID=$pollID");
      } 
	  else 
	  {
        include(NUKE_BASE_DIR.'header.php');
	
		get_lang('Blog');
    
	    OpenTable();
    
	    echo "<div align=\"center\">" . _SURETODELCOMMENTS . "";
        echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=RemovePollComment&amp;tid=$tid&amp;pollID=$pollID&amp;ok=1\">" . _YES . "</a> ]</div>";
    
	    CloseTable();
    
	    include(NUKE_BASE_DIR.'footer.php');
      }
 }

 switch ($op) 
 {
    case "RemoveComment":
    removeComment ($tid, $sid, $ok);
    break;

    case "removeSubComments":
    removeSubComments($tid);
    break;

    case "removePollSubComments":
    removePollSubComments($tid);
    break;

    case "RemovePollComment":
    RemovePollComment($tid, $pollID, $ok);
    break;
 } 
} 
else 
echo "Access Denied";
?>
