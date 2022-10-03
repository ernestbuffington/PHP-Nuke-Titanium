<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
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
      Evolution Functions                      v1.5.0       12/20/2005
 ************************************************************************/
if (!defined('ADMIN_FILE')) 
die ('Illegal File Access');

global $titanium_prefix, $titanium_db;

if (is_mod_admin()) 
{
/*********************************************************/
/* Admin/Authors Functions                               */
/*********************************************************/
function displayadmins() 
{
    global $admin, $titanium_prefix, $titanium_db, $titanium_language, $multilingual, $admin_file, $admlang;
    if (is_admin()) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
		
		# Return to Main Administration Button
        echo '<div style="text-align: center; margin-bottom: 20px;"><a class="titaniumbutton" href="'.$admin_file.'.php">'.$admlang['global']['header_return'].'</a> </div>';
        
		echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" colspan="6" style="text-align: center; text-transform: uppercase;">'.$admlang['authors']['header'].'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" colspan="6" style="text-align: center; text-transform: uppercase;">'.$admlang['authors']['god'].'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" style="text-align: center; width: 5%;">#</td>'."\n";
        echo '    <td class="catHead" style="text-transform: uppercase; width: 25%;">'.$admlang['authors']['author'].'</td>'."\n";
        echo '    <td class="catHead" style="text-transform: uppercase; width: 25%;">'.$admlang['global']['email'].'</td>'."\n";
        echo '    <td class="catHead" style="text-align: center; text-transform: uppercase; width: 15%;">'.$admlang['global']['language'].'</td>'."\n";
        echo '    <td class="catHead" style="text-align: center; text-transform: uppercase; width: 15%;">'.$admlang['authors']['option1'].'</td>'."\n";
        echo '    <td class="catHead" style="text-align: center; text-transform: uppercase; width: 15%;">'.$admlang['global']['delete'].'</td>'."\n";
        echo '  </tr>'."\n";
        
		$result = $titanium_db->sql_query("SELECT `aid`, `email`, `name`, `admlanguage`, `url` FROM `".$titanium_prefix."_authors`");
        $countAuthor = 1;
        
		while ($row = $titanium_db->sql_fetchrow($result)) 
        {
            $admlanguage    = $row['admlanguage'];
            $authorID       = substr($row['aid'], 0,25);
            $name           = substr($row['name'], 0,50);
            $email          = $row['email'];
			
		    if (empty($admlanguage)) 
                $admlanguage = $admlang['global']['all'];

            if($email) # Fixed this as it was never going to allow you to send a direct eamil the way it was! 09/30/2022 TheGhost
                $authorURL = '<span style="float:right;"><a href="mailto:'.$email.'"><i style="font-size: 25px;" class="bi bi-envelope"></i</span></a></span>';
            else
                $authorURL = '';

            $row_class = ($countAuthor % 2) ? 'row1' : 'row2';

            echo '  <tr>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;">'.$countAuthor.'</td>'."\n";
            echo '    <td class="'.$row_class.'"><span style="float:left;">'.$authorID.'</span>'.$authorURL.'</td>'."\n";
            echo '    <td class="'.$row_class.'">'.$row['email'].'</td>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;">'.$admlanguage.'</td>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;"><a class="titaniumbutton" href="'.$admin_file.'.php?op=modifyadmin&amp;chng_aid='.$authorID.'">'.$admlang['authors']['modify'].'</a></td>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;">'.(($name == 'God') ? $admlang['authors']['main'] : '<a class="titaniumbutton" href="'.$admin_file.'.php?op=deladmin&amp;del_aid='.$authorID.'">'.$admlang['global']['delete'].'</a>').'</td>'."\n";
            echo '  </tr>'."\n";
            $countAuthor++;
        }

        echo '  <tr>'."\n"; # Removed redundant Return to Adminsitration Button/Link - Added &nbsp; <- a space instead DUH! 09/30/2022 TheGhost
        echo '    <td class="catBottom" colspan="6" style="text-align: center;">&nbsp;</td>'."\n";
        echo '  </tr>'."\n";
        echo '</table>'."\n";

        echo '<br />';

        echo '<form action="'.$admin_file.'.php" method="post" name="newauthor">';
        
		echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" colspan="2" style="text-align: center; text-transform: uppercase;">'.$admlang['authors']['add'].'</td>'."\n";
        echo '  </tr>'."\n";
        
		# Author username
        echo '<tr>'."\n";
        echo '<td align="left" valign="absmiddle" class="row1" style="width: 30%;">';
		echo '<i style="font-size: 18px;" class="glyphicon glyphicon-user"></i><font size="4"> '.$admlang['authors']['author'].'</font>';
		
        echo '<span class="evo-sprite help tooltip-html float-right tooltipstered" title="'.$admlang['authors']['can_not'].'"></span>';
        echo '</td>'."\n";
        echo '<td class="row1" style="width: 50%;"><input type="text" name="add_name" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '</tr>'."\n";
        
		# Author Nickname field
       
        echo '<tr>'."\n";
        echo '<td align="left" valign="absmiddle" class="row1" style="width: 30%;">';
		echo '<i style="font-size: 18px;" class="bi bi-person-badge"></i><font size="4"> '.$admlang['global']['nickname'].'</font>';
        echo '<span class="evo-sprite help tooltip-html float-right tooltipstered" title="'.$admlang['authors']['can'].'"></span>';
         echo '<td class="row1" style="width: 50%;"><input type="text" name="add_aid" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '</tr>'."\n";
		
		# Author Email
        echo '<tr>'."\n";
        echo '<td align="left" valign="absmiddle" class="row1" style="width: 30%;">';
        echo '<span class="evo-sprite help tooltip-html float-right tooltipstered" title="'.$admlang['authors']['email'].'"></span>';
		echo '<i style="font-size: 18px;" class="bi bi-envelope-paper"></i><font size="4"> '.$admlang['global']['email'].'</font>';
        echo '<td class="row1" style="width: 50%;"><input type="text" autocomplete="off" name="add_email" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '</tr>'."\n";

        # Author URL
        echo '<tr>'."\n";
        echo '<td align="left" valign="absmiddle" class="row1" style="width: 30%;">';
       echo '<span class="evo-sprite help tooltip-html float-right tooltipstered" title="'.$admlang['authors']['www'].'"></span>';
		echo '<i style="font-size: 20px;" class="bi bi-link-45deg"></i><font size="4"> '.$admlang['global']['url'].'</font>';
        echo '<td class="row1" style="width: 50%;"><input type="text" name="add_url" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '</tr>'."\n";

        
		# Author Language selection
        if ($multilingual == 1) 
        {
            $titanium_languageslist = lang_list();
            echo '<tr>'."\n";
            echo '<td class="row1" style="width: 30%;">'.$admlang['global']['language'].'</td>'."\n";
            echo '<td class="row1" style="width: 30%;">';
            echo '<select name="add_admlanguage">';
            
			for ($i = 0, $maxi = count($titanium_languageslist); $i < $maxi; $i++) 
            {
                if(!empty($titanium_languageslist[$i])) 
                {
                    echo '<option name="xlanguage" value="'.$titanium_languageslist[$i].'"'
					.(($titanium_languageslist[$i]==$titanium_language) ? ' selected="selected"' : '').'>'.ucwords($titanium_languageslist[$i]).'</option>';     
                }
            }            
            echo '      </select>';
            echo '    </td>'."\n";
            echo '  </tr>'."\n";
        } 
        else 
        {
            echo '<input type="hidden" name="add_admlanguage" value="">';
        }
        
		# Setup the author permissions.
        $result = $titanium_db->sql_query("SELECT `mid`, `title` FROM `".$titanium_prefix."_modules` ORDER BY `title` ASC");
        $a = 0;
        echo '<tr>'."\n";
        
		echo '<td class="row1" style="width: 30%; vertical-align: text-top;">';
        
		echo '<span style="float: left; margin: 2px;">'.$admlang['global']['permissions'].'</span>';
        echo '<span class="evo-sprite help tooltip float-right" title="'.$admlang['authors']['superwarn'].'"></span>';
        
		echo '</td>'."\n";
        
		echo '<td class="row1" style="width: 30%;">';
        
		echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '<tr>';
        
		while ($row = $titanium_db->sql_fetchrow($result)) 
        {
            $title = str_replace("_", " ", $row['title']);
        
		    if (file_exists('modules/'.$row['title'].'/admin/index.php') 
			AND file_exists('modules/'.$row['title'].'/admin/links.php') 
			AND file_exists('modules/'.$row['title'].'/admin/case.php')) 
            {

            echo '<tr>';
                echo '<div class="checkbox">';
				echo '<td width="1%" class="row1"><input id="checkbox" type="checkbox" name="auth_modules[]" value="'.intval($row['mid']).'"></td>';
				echo '<td style="padding-top:13px" class="row1" style="width: 35%;"><font size="3"><strong>'.$title.'</strong></font></td>';
                echo '</div>';
			    
				if ($a == 2) 
                {
                    echo '</tr>';
                    $a = 0;
                } 
				else 
				{
                    $a++;
                }
            }
        }
        
		$titanium_db->sql_freeresult($result);
        echo '        </tr>';
        echo '        <tr>';
        
		echo '<td class="row1" ><input type="checkbox" name="add_radminsuper" value="1"></td>';
        echo '<td style="padding-top:15px" class="row1" ><strong><font color="red" class="blink-one" size="3">'.$admlang['authors']['superadmin'].'</font></strong> (All Privileges)</td>';
        
		echo '        </tr>';
 		echo '      </table>';
        echo '    </td>'."\n";
        echo '  </tr>'."\n";
        
		# Author password
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width: 50%;">'.$admlang['global']['password'].'</td>'."\n";
        echo '    <td class="row1" style="width: 50%;"><input type="titaniumbutton" name="add_pwd" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '  </tr>'."\n";
        
		# Submit the form
        echo '  <tr>'."\n";
        echo '    <td class="catBottom" colspan="2" style="text-align: center;"><input class="titaniumbutton" style="text-transform: uppercase;" type="submit" value="'.$admlang['authors']['submit'].'"></td>'."\n";
        echo '  </tr>'."\n";
        echo '</table>'."\n";
        echo '<input type="hidden" name="op" value="AddAuthor">';
        echo '</form>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}

function modifyadmin($chng_aid) 
{
    global $admin, $titanium_prefix, $titanium_db, $multilingual, $admin_file, $admlang;
    if (is_admin()) 
    {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        $adm_aid = $chng_aid;
        $adm_aid = trim($adm_aid);
        $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT aid, name, url, email, pwd, radminsuper, admlanguage from " . $titanium_prefix . "_authors where aid='$chng_aid'"));
        $chng_aid = $row['aid'];
        $chng_name = $row['name'];
        $chng_url = stripslashes($row['url']);
        $chng_email = stripslashes($row['email']);
        $chng_pwd = $row['pwd'];
        $chng_radminsuper = intval($row['radminsuper']);
        $chng_admlanguage = $row['admlanguage'];
        $chng_aid = substr($chng_aid, 0,25);
        $aid = $chng_aid;

        echo '<div style="text-align: center; margin-bottom: 20px;"><a href="'.$admin_file.'.php?op=mod_authors">'.$admlang['authors']['header'].'</a><br /><br/><a href="'.$admin_file.'.php">'.$admlang['global']['header_return'].'</a></div>';

        echo '<form action="'.$admin_file.'.php" method="post" name="newauthor">';
        # The name of the admin account, can not be changed, so we add it in the form as a hidden field.
        echo '<input type="hidden" name="chng_name" value="'.$chng_name.'">';
        echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" colspan="2" style="text-align: center;">'.$admlang['authors']['modify'].'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['name'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%">'.$chng_name.'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['nickname'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%"><input type="text" name="chng_aid" value="'.$chng_aid.'" style="width: 250px" maxlength="25" required></td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['email'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%"><input type="text" name="chng_email" value="'.$chng_email.'" style="width: 250px" maxlength="25" required></td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['url'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%"><input type="text" name="chng_url" value="'.$chng_url.'" style="width: 250px" maxlength="25" required></td>'."\n";
        echo '  </tr>'."\n";

        if ($multilingual == 1):

            echo '  <tr>';
            echo '    <td class="row1" style="width:50%">'.$admlang['global']['language'].'</td>';
            echo '    <td class="row1" style="width:50%">';
            echo "<select name=\"chng_admlanguage\">";
            $titanium_languageslist = lang_list();
            for ($i=0, $maxi = count($titanium_languageslist); $i < $maxi; $i++) {
                if(!empty($titanium_languageslist[$i])) {
                    echo "<option name='xlanguage' value='".$titanium_languageslist[$i]."' ";
                    if($titanium_languageslist[$i]==$titanium_language) echo "selected";
                    echo ">".ucwords($titanium_languageslist[$i])."\n";
                }
            }
            if (empty($chng_admlanguage)) {
                $allsel = 'selected';
            } else {
                    $allsel = '';
            }
            echo '<option value="" '.$allsel.'>'.$admlang['global']['all'].'</option></select></td></tr>';

        else:

            echo '<input type="hidden" name="chng_admlanguage" value="">';
        endif;

        echo '  <tr>';
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['permissions'].'</td>';
        if ($row['name'] != 'God'):

        	echo '    <td class="row1" style="width: 50%;">';
        	echo '      <table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        	echo '        <tr>';
            $result = $titanium_db->sql_query("SELECT mid, title, admins FROM ".$titanium_prefix."_modules ORDER BY title ASC");
            while ($row = $titanium_db->sql_fetchrow($result)):

                $title = str_replace("_", " ", $row['title']);
                if (file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/index.php') AND file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/links.php') AND file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/case.php')):

                    if(!empty($row['admins'])):

                        $admins = explode(",", $row['admins']);
                        $sel = '';
                        for ($i=0, $maxi=count($admins); $i < $maxi; $i++):

                            if ($chng_name == $admins[$i])
                                $sel = 'checked';
                        
                        endfor;

                    endif;
                    echo '<td class="row1" style="width: 33%;"><input type="checkbox" name="auth_modules[]" value="'.intval($row['mid']).'" '.$sel.'> '.$title.'</td>';
                    $sel = "";
                    if ($a == 2) 
                    {
                        echo '  </tr>';
                        $a = 0;
                    } else {
                        $a++;
                    }
                
                endif;

            endwhile;
            $titanium_db->sql_freeresult($result);
            if ($chng_radminsuper == 1) {
                $sel1 = 'checked';
            }
            echo '        </tr>';
	        echo '        <tr>';
	        echo '          <td class="row1" colspan="3"><input type="checkbox" name="chng_radminsuper" value="1" '.$sel1.'> <strong>'.$admlang['authors']['superadmin'].'</strong></td>';
	        echo '        </tr>';
	        echo '      </table>';
	        echo '    </td>'."\n";
	        echo '  </tr>'."\n";

        else:

            echo '<input type="hidden" name="auth_modules[]" value="">';
            $sel1 = 'checked';
            echo '    <td class="row1" style="width: 50%"><input type="checkbox" name="chng_radminsuper" value="1" '.$sel1.'>'.$admlang['authors']['superadmin'].'</strong></td>';
        	echo '  </tr>';

        endif;        

        echo '  <tr>';
        echo '    <td class="row1" style="width: 50%">'.$admlang['global']['password'].'</td>';
        echo '    <td class="row1" style="width: 50%"><input type="password" name="chng_pwd" style="width: 250px" maxlength="45"></td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td class="row1" style="width: 50%">'.$admlang['global']['password_retype'].'</td>';
        echo '    <td class="row1" style="width: 50%"><input type="password" name="chng_pwd2" style="width: 250px" maxlength="45"></td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td colspan="2" class="catBottom" style="text-align: center"><input type="submit" value="'.$admlang['global']['save_changes'].'"></td>';
        echo '  </tr>';
        echo '</table>';
        echo '<input type="hidden" name="adm_aid" value="'.$adm_aid.'">';
        echo '<input type="hidden" name="op" value="UpdateAuthor">';
        echo '</form>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}

function updateadmin($chng_aid, $chng_name, $chng_email, $chng_url, $chng_radminsuper, $chng_pwd, $chng_pwd2, $chng_admlanguage, $adm_aid, $auth_modules) {
    global $admin, $titanium_prefix, $titanium_db, $admin_file;
    if (is_admin()) {
        Validate($chng_aid, 'username', 'Modify Authors', 0, 1, 0, 2, 'Nickname:', '<br /><center>'. _GOBACK .'</center>');
        Validate($chng_url, 'url', 'Modify Authors', 0, 0, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        Validate($chng_email, 'email', 'Modify Authors', 0, 1, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        if (!empty($chng_pwd2)) {
            Validate($chng_pwd, '', 'Modify Authors', 0, 1, 0, 2, 'password', '<br /><center>'. _GOBACK .'</center>');
            if($chng_pwd != $chng_pwd2) {
                DisplayError(_PASSWDNOMATCH . "<br /><br /><center>" . _GOBACK . "</center>");
            }
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $chng_pwd = md5($chng_pwd);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $chng_aid = substr($chng_aid, 0,25);
            if ($chng_radminsuper == 1) {
                $result = $titanium_db->sql_query("SELECT mid, admins FROM ".$titanium_prefix."_modules");
                while ($row = $titanium_db->sql_fetchrow($result)) {
                    $admins = explode(",", $row['admins']);
                    $adm = '';
                    for ($a=0, $maxi=count($admins); $a < $maxi; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                $titanium_db->sql_query("update " . $titanium_prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='$chng_radminsuper', pwd='$chng_pwd', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                if ($adm_aid == $chng_aid) {
                    redirect_titanium($admin_file.".php?op=logout");
                } else {
                    // redirect_titanium($admin_file.".php?op=mod_authors");
                    redirect_titanium($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
                }
            } else {
                if ($chng_name != 'God') {
                      $titanium_db->sql_query("update " . $titanium_prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='0', pwd='$chng_pwd', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                }
                $result = $titanium_db->sql_query("SELECT mid, admins FROM ".$titanium_prefix."_modules");
                while ($row = $titanium_db->sql_fetchrow($result)) {
                    $admins = explode(",", $row['admins']);
                    $adm = '';
                    for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $titanium_db->sql_query("UPDATE ".$titanium_prefix."_authors SET radminsuper='$chng_radminsuper' WHERE name='$chng_name' AND aid='$adm_aid'");
                    $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                for ($i=0, $maxi=count($auth_modules); $i < $maxi; $i++) {
                    $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT admins FROM ".$titanium_prefix."_modules WHERE mid='".intval($auth_modules[$i])."'"));
                    if(!empty($row['admins'])) {
                        $admins = explode(",", $row['admins']);
                        for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                            if ($admins[$a] == $chng_name) {
                                $dummy = 1;
                            }
                        }
                    }
                    if ($dummy != 1) {
                        $adm = $row['admins'].$chng_name;
                        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm,' WHERE mid='".intval($auth_modules[$i])."'");
                    }
                    $dummy = '';
                }
                // redirect_titanium($admin_file.".php?op=mod_authors");
                redirect_titanium($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
            }
        } else {
            if ($chng_radminsuper == 1) {
                $result = $titanium_db->sql_query("SELECT mid, admins FROM ".$titanium_prefix."_modules");
                while ($row = $titanium_db->sql_fetchrow($result)) {
                    $admins = explode(",", $row['admins']);
                    $adm = '';
                    for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                $titanium_db->sql_query("update " . $titanium_prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='$chng_radminsuper', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                // redirect_titanium($admin_file.".php?op=mod_authors");
                redirect_titanium($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
            } else {
                if ($chng_name != 'God') {
                        $titanium_db->sql_query("update " . $titanium_prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='0', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                }
                $result = $titanium_db->sql_query("SELECT mid, admins FROM ".$titanium_prefix."_modules");
                while ($row = $titanium_db->sql_fetchrow($result)) {
                    $admins = explode(",", $row['admins']);
                    $adm = '';
                    for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $titanium_db->sql_query("UPDATE ".$titanium_prefix."_authors SET radminsuper='$chng_radminsuper' WHERE name='$chng_name' AND aid='$adm_aid'");
                    $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                for ($i=0, $maxi=count($auth_modules); $i < $maxi; $i++) {
                    $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT admins FROM ".$titanium_prefix."_modules WHERE mid='".intval($auth_modules[$i])."'"));
                    if(!empty($row['admins'])) {
                        $admins = explode(",", $row['admins']);
                        for ($a=0, $maxa=count($admins); $a < $maxa; $a++) {
                            if ($admins[$a] == $chng_name) {
                                $dummy = 1;
                            }
                        }
                    }
                    if ($dummy != 1) {
                        $adm = $row['admins'].$chng_name;
                        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm,' WHERE mid='".intval($auth_modules[$i])."'");
                    }
                    $dummy = '';
                }
                redirect_titanium($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
            }
        }
        if ($adm_aid != $chng_aid) {
            $result2 = $titanium_db->sql_query("SELECT sid, aid, informant from " . $titanium_prefix . "_stories where aid='$adm_aid'");
            while ($row2 = $titanium_db->sql_fetchrow($result2)) {
                $sid = intval($row2['sid']);
                $old_aid = $row2['aid'];
                $old_aid = substr($old_aid, 0,25);
                $informant = $row2['informant'];
                $informant = substr($informant, 0,25);
                if ($old_aid == $informant) {
                    $titanium_db->sql_query("update " . $titanium_prefix . "_stories set informant='$chng_aid' where sid='$sid'");
                }
                $titanium_db->sql_query("update " . $titanium_prefix . "_stories set aid='$chng_aid' WHERE sid='$sid'");
            }
        }
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}

function deladmin2($del_aid) {
    global $admin, $titanium_prefix, $titanium_db, $admin_file;
    if (is_admin()) {
        $del_aid = substr($del_aid, 0,25);
        $result = $titanium_db->sql_query("SELECT admins FROM ".$titanium_prefix."_modules WHERE title='News'");
        $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT name FROM ".$titanium_prefix."_authors WHERE aid='$del_aid'"));
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $admins = explode(",", $row['admins']);
            $auth_user = 0;
            for ($i=0, $maxi=count($admins); $i < $maxi; $i++) {
                if ($row2['name'] == $admins[$i]) {
                    $auth_user = 1;
                }
            }
            if ($auth_user == 1) {
                $radminarticle = 1;
            }
        }
        $titanium_db->sql_freeresult($result);
        if ($radminarticle == 1) {
            $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT sid from " . $titanium_prefix . "_stories where aid='$del_aid'"));
            $sid = intval($row2['sid']);
            if (!empty($sid)) {
                include_once(NUKE_BASE_DIR.'header.php');
                OpenTable();
                echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=mod_authors\">" . $admlang['authors']['header'] . "</a></div>\n";
                echo "<br /><br />";
                echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $admlang['authors']['header_return'] . "</a> ]</div>\n";
                CloseTable();
                echo "<br />";
                OpenTable();
                echo "<center><span class=\"title\"><strong>" . _AUTHORSADMIN . "</strong></span></center>";
                CloseTable();
                echo "<br />";
                OpenTable();
                echo "<center><span class=\"option\"><strong>" . _PUBLISHEDSTORIES . "</strong></span><br /><br />"
                    ."" . _SELECTNEWADMIN . ":<br /><br />";
                $result3 = $titanium_db->sql_query("SELECT aid from " . $titanium_prefix . "_authors where aid!='$del_aid'");
                echo "<form action=\"".$admin_file.".php\" method=\"post\"><select name=\"newaid\">";
                while ($row3 = $titanium_db->sql_fetchrow($result3)) {
                    $oaid = $row3['aid'];
                    $oaid = substr($oaid, 0,25);
                    echo "<option name=\"newaid\" value=\"$oaid\">$oaid</option>";
                }
                $titanium_db->sql_freeresult($result3);
                echo "</select><input type=\"hidden\" name=\"del_aid\" value=\"$del_aid\">"
                    ."<input type=\"hidden\" name=\"op\" value=\"assignstories\">"
                    ."<input type=\"submit\" value=\"" . _OK . "\">"
                    ."</form>";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
                return;
            }
        }
        redirect_titanium($admin_file.".php?op=deladminconf&del_aid=$del_aid");
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}

if($add_aid != $_POST['add_aid']) {
    die('Illegal Variable');
}
if($add_name != $_POST['add_name']) {
    die('Illegal Variable');
}

switch ($op) {

    case "mod_authors":
        displayadmins();
    break;

    case "modifyadmin":
        modifyadmin($chng_aid);
    break;

    case "UpdateAuthor":
        echo $chng_aid;
        updateadmin($chng_aid, $chng_name, $chng_email, $chng_url, $chng_radminsuper, $chng_pwd, $chng_pwd2, $chng_admlanguage, $adm_aid, $auth_modules);
    break;

    case "AddAuthor":
        global $admin_file;

        $add_aid = substr($add_aid, 0,25);
        $add_name = substr($add_name, 0,25);
        Validate($add_aid, 'username', 'Add Authors', 0, 1, 0, 2, 'Nickname:', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_name, 'username', 'Add Authors', 0, 1, 0, 2, 'Name:', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_url, 'url', 'Add Authors', 0, 0, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_email, 'email', 'Add Authors', 0, 1, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_pwd, '', 'Add Authors', 0, 1, 0, 2, 'password', '<br /><center>'. _GOBACK .'</center>');
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $add_pwd = md5($add_pwd);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        for ($i=0,$maxi=count($auth_modules); $i < $maxi; $i++) {
            $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT admins FROM ".$titanium_prefix."_modules WHERE mid='".intval($auth_modules[$i])."'"));
            $adm = $row['admins'] . $add_name;
            $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm,' WHERE mid='".intval($auth_modules[$i])."'");
        }
        $result = $titanium_db->sql_query("insert into " . $titanium_prefix . "_authors values ('$add_aid', '$add_name', '$add_url', '$add_email', '$add_pwd', '0', '$add_radminsuper', '$add_admlanguage')");
        if (!$result) {
            redirect_titanium($admin_file.".php");
        }
        $titanium_db->sql_freeresult($result);
        redirect_titanium($admin_file.".php?op=mod_authors");
    break;

    case "deladmin":
        include_once(NUKE_BASE_DIR.'header.php');
        $del_aid = trim($del_aid);
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=mod_authors\">" . $admlang['authors']['header'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $admlang['global']['header_return'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . $admlang['authors']['delete'] . "</strong></span><br /><br />"
            ."" . $admlang['authors']['delete_sure'] . " <i>$del_aid</i>?<br /><br />";
        echo "[ <a href=\"".$admin_file.".php?op=deladmin2&amp;del_aid=$del_aid\">" . $admlang['global']['yes'] . "</a> | <a href=\"".$admin_file.".php?op=mod_authors\">" . $admlang['global']['no'] . "</a> ]";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    break;

    case "deladmin2":
        deladmin2($del_aid);
    break;

    case "assignstories":
        $del_aid = trim($del_aid);
        $result = $titanium_db->sql_query("SELECT sid from " . $titanium_prefix . "_stories where aid='$del_aid'");
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $sid = intval($row['sid']);
            $titanium_db->sql_query("update " . $titanium_prefix . "_stories set aid='$newaid', informant='$newaid' where aid='$del_aid'");
            $titanium_db->sql_query("update " . $titanium_prefix . "_authors set counter=counter+1 where aid='$newaid'");
        }
        $titanium_db->sql_freeresult($result);
        redirect_titanium($admin_file.".php?op=deladminconf&del_aid=$del_aid");
    break;

    case "deladminconf":
        $del_aid = trim($del_aid);
        $titanium_db->sql_query("delete from " . $titanium_prefix . "_authors where aid='$del_aid' AND name!='God'");
        $result = $titanium_db->sql_query("SELECT mid, admins FROM ".$titanium_prefix."_modules");
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $admins = explode(",", $row['admins']);
               $adm = "";
               for ($a=0, $maxa=count($admins); $a < $maxa; $a++) {
                if ($admins[$a] != $del_aid && !empty($admins[$a])) {
                    $adm .= $admins[$a].',';
                   }
               }
            $titanium_db->sql_query("UPDATE ".$titanium_prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
        }
        $titanium_db->sql_freeresult($result);
        redirect_titanium($admin_file.".php?op=mod_authors");
    break;

}

} else {
    echo "Access Denied";
}

?>