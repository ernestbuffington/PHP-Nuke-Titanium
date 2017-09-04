<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/inc/frm_interface.php
 PHP-Nuke Titanium Module              :   Uploads
 PHP-Nuke Titanium File Release Date   :   September 4th, 2017  
 PHP-Nuke Tianium File Author          :   Ernest Allen Buffington

 PHP-Nuke Titanium web address         :   https://titanium.86it.network
 
 PHP-Nuke Titanium is licensed under GNU General Public License v3.0

 PHP-Nuke Titanium is Copyright(c) 2002 to 2017 by Ernest Allen Buffington
 of Sebastian Enterprises. 
 
 ernest.buffington@gmail.com
 Att: Sebastian Enterprises
 1071 Emerald Dr,
 Brandon, Florida 33511
 ========================================================================
 GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
 Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 Everyone is permitted to copy and distribute verbatim copies
 of this license document, but changing it is not allowed.       
 ========================================================================
 
 /*****[CHANGES]**********************************************************
  The Nuke-Evo Base Engine : v2.1.0 RC3 dated May 4th, 2009 is what we
  used to build our new content management system. To find out more
  about the starting core engine before we modified it please refer to 
  the Nuke Evolution website. http://www.nuke-evolution.com
   
  This file was re-written for PHP-Nuke Titanium and all modifications
  were done by Ernest Allen Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is written for Social Networking and uses a centralized 
  database that is chained to The Scorpion Network & The 86it Social Network

  It is not intended for single user platforms and has the requirement of
  remote database access to https://the.scorpion.network and 
  https://www.86it.us which is a new Social Networking System designed by 
  Ernest Buffington that requires a FEDERATED MySQL engine in order to 
  function at all.
  
  The federated database concept was created in the 1980's and has been
  available a very long time. In fact it was a part of MySQL before they
  ever started to document it. There is not much information available
  about using a FEDERATED engine and a lot of the documention is not very
  complete with regard to every detail; it is superficial and partial to
  say thge least. 
  
  The core engine from Nuke Evolution was used to create 
  PHP-Nuke Titanium. Almost all versions of PHP-Nuke were unstable and not 
  very secure. We have made it so that it is enhanced and advanced!
  
  PHP-Nuke Titanium is now a secure custom FORK of the ORIGINAL PHP-Nuke
  that was purchased by Ernest Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is not backward compatible to any of the prior versions of
  PHP-Nuke, Nuke-Evoltion or Nuke-Evo.
  
  The module framework of PHP-Nuke is the only thing that still functions 
  in the same way that Francis Burzi had intended and even that had to be
  safer and more secure to be a reliable form of internet communications.
  
 ************************************************************************
 * PHP-NUKE: Advanced Content Management System                         *
 * ============================================                         *
 * Copyright (c) 2002 by Francisco Burzi                                *
 * http://phpnuke.org                                                   *
 *                                                                      *
 * This program is free software. You can redistribute it and/or modify *
 * it under the terms of the GNU General Public License as published by *
 * the Free Software Foundation; either version 2 of the License.       *
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
// ***************************************
// ** FILE:    FRM_INTERFACE.PHP        **
// ** PURPOSE: PHFTP                    **
// ** DATE:    18.03.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// MAIN FTP FORM (EXPLORER VIEW)
// **********************************************************
function phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir)
// **********************************************************
{
    global $phpftp_host,$listlength,$phpftp_ssl,$phpftp_passive,$max_file_size,$conf_phpftp_lang,$conf_fileman_folders_width,$conf_fileman_files_width,$phpftp_chmods,$al;

    ?>

    <table border='0' id='filemanager' width='<?php

    echo ($conf_fileman_folders_width+$conf_fileman_files_width);

    ?>'><tr><td colspan=4 nowrap>

    <?php

    $ftp = @phpftp_connect($phpftp_user,$phpftp_passwd);
    
    if ($ftp)
    {
        if (!$phpftp_dir) {
            $phpftp_dir=ftp_pwd($ftp);
        }
        if (!@ftp_chdir($ftp,$phpftp_dir))
        {
            show_error($al['error16']);
            $phpftp_dir=ftp_pwd($ftp);
        }

        // INFO ZEILE
        echo "<font style=\"font-weight: bold; color: blue;\">"._APP_NAME.
        "</font>&nbsp;&nbsp;".$al['host'].": <strong>".$phpftp_host.
        "</strong>&nbsp;|&nbsp;".$al['connection'].": <strong>";

        if ($phpftp_ssl) echo $al['securessl'];
        else             echo $al['rawftp'];

        if ($phpftp_passive) echo "/PASV";

        echo  "</strong>&nbsp;|&nbsp;".$al['clientinfo'].": <strong>";

        //include_once("common_client_info.php");
		include_once(NUKE_MODULES_DIR.'Uploads/inc/common_client_info.php');


        echo _REMOTE_ADDR;

        if (_REMOTE_PROXY!="") echo " ("._REMOTE_PROXY.")</strong>";

        // SITE MSG FIELD & HELP LINK
        abs_r(); 
        echo "<input type=\"text\" id=\"site_msg\" class=\"sitemsg\" readonly=\"readonly\" value=\"\">&nbsp;&nbsp;";
        echo helpme(); 
        abs_e();

        if ($phpftp_dir == "/") {
            $phpftp_dir="";
        }

        $nlist_dirs     = array();
        $nlist_dirright = array();
        $nlist_dirdate  = array();
        $nlist_files    = array();
        $nlist_filedate = array();
        $nlist_filesize = array();
        $nlist_fileright= array();
        $nlist_links    = array();
        $nlist_linkright= array();
        $nlist_rights   = array();
        
        $contents = ftp_rawlist($ftp,"");

        if ($contents)
        {
            $d_i=0;
            $f_i=0;
            $l_i=0;
            $i=0;
            while ((array_key_exists($i,$contents))&&($contents[$i]))
            {
                $item[] = @split("[ ]+",$contents[$i],9);
                $item_type = substr($item[$i][0],0,1);
                $item_right= substr($item[$i][0],1,9);

                if ($item_type == "d") {
                    /* it's a directory */
                    $nlist_dirs[$d_i]=$item[$i][8];
                    $nlist_dirdate[$d_i]=$item[$i][5]." ".$item[$i][6]." ".$item[$i][7];
                    $nlist_dirright[$d_i]=$item_right;
                    $d_i++;
                } elseif ($item_type == "l") {
                    /* it's a symlink */
                    $nlist_links[$l_i]=$item[$i][8];
                    $nlist_linkright[$l_i]=$item_right;
                    $l_i++;
                } elseif ($item_type == "-") {
                    /* it's a file */
                    $nlist_files[$f_i]=$item[$i][8];
                    $nlist_filesize[$f_i]=$item[$i][4];
                    $nlist_filedate[$f_i]=$item[$i][5]." ".$item[$i][6]." ".$item[$i][7];
                    $nlist_fileright[$f_i]=$item_right;
                    $f_i++;
                } elseif ($item_type == "+") {
                    /* it's something on an anonftp server */
                    $eplf=split(",",implode(" ",$item[$i]),5);
                    if ($eplf[2] == "r") {
                        /* it's a file */
                        $nlist_files[$f_i]=trim($eplf[4]);
                        $nlist_filesize[$f_i]=substr($eplf[3],1);
                        $f_i++;
                    } elseif ($eplf[2] == "/") {
                        /* it's a directory */
                        $nlist_dirs[$d_i]=trim($eplf[3]);
                        $d_i++;
                    }
                } /* ignore all others */
                $i++;
            }
        }

        $nDirs  = count($nlist_dirs);
        $nFiles = count($nlist_files);
?>

</td></tr><tr><td align=left valign=top colspan=2 class='header'><span class=clipper>
<img src="modules/Uploads/img/fldr.gif" width="16" height="14" align="top" border="0">&nbsp;<?php
 
        // JS DIRECTORY SWITCHER
        echo $nDirs." ".$al['folders']."&nbsp;&nbsp;";
        
        // PFADAUFBEREITUNG, LETZTER SLASH BEHANDLUNG ETC.
        $phpftp_dir = trim(str_replace("//","/",$phpftp_dir));

        if ((strlen($phpftp_dir)>1) && (substr($phpftp_dir,strlen($phpftp_dir)-1,1)=="/"))
        $phpftp_dir = substr($phpftp_dir,0,strlen($phpftp_dir)-1);

        if (instr($phpftp_dir,"/"))
        {
	        $arrDirs = explode("/",$phpftp_dir);
	
	        if ((is_array($arrDirs))&&(count($arrDirs)>0))
	        {
		        echo "<select class=\"dir_sel\" name=\"switcher\" onChange=\"switch_dir(this.value);\">\n";
			
		        for ($i=count($arrDirs);$i>=0;$i--) {
		            $curVal = implode("/",array_slice($arrDirs,0,$i));
		            if ($curVal!="") 
		            echo "<option value=\"".$curVal."\">".$curVal."</option>\n";
		        }
		        echo "</select>";
	        }
	        unset($arrDirs);
        }
        else echo "/";
?>
</span></td>
<td align=left valign=top colspan=2 class='header'>
<img src="modules/Uploads/img/file.gif" width="14" height="14" align="top" border="0">&nbsp;<?php echo $nFiles." ".$al['files']; ?></td></tr>

<tr><td align=left valign=top colspan=2 width=<?php echo $conf_fileman_folders_width; ?>>

<?php
// *****
draw_form("cd"," name=\"directory_select\" ",""); ?>
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
<select name="select_directory" onClick="javascript: if(this.selectedIndex!=-1) { lastKlicked_Val=this.options[this.selectedIndex].value; }" <?php

if ($phpftp_chmods)
echo " onChange=\"show_right_number(this.options[this.selectedIndex].text,document.forms.frm_chmod.cur_chmode);\" ";

?> ondblclick="javascript: if(this.selectedIndex!=-1) { enter_dir(this.options[this.selectedIndex].value); }" class="selector" style="width: <?php echo $conf_fileman_folders_width; ?>px;" size="<?php echo $listlength; ?>">

<?php

$max_name_len = round($conf_fileman_folders_width/17);

echo "<option value=\"..\">..".lz($max_name_len-1,false).$al['goup']."</option>\n";

if ($nDirs>0)
{
    for ($i=0; $i < $nDirs; $i++)
    {
        // NAME
        $dname = $nlist_dirs[$i].lz($max_name_len-strlen($nlist_dirs[$i]),false);
        if (strlen($nlist_dirs[$i])>$max_name_len) $dname=substr($dname,0,$max_name_len-3)."...";

        // FILEDATE
        $ddate = decode_ftp_filedate($nlist_dirdate[$i]);

        // RIGHT
        $nlist_dirright[$i] .= lz(9-strlen($nlist_dirright[$i]),false);

        echo "<option value=\"".$nlist_dirs[$i]."\">".$dname." |".$nlist_dirright[$i]."| ".$ddate."</option>\n";
    }
} ?>

</select>
</form>
</td><td align=left valign=top colspan=2>

<?php

// FILELIST UND DOWNLOAD
if ($nFiles>0)
{
    // *****
draw_form("get"," name=\"file_select\" ",""); ?>

<form action="ftp.php" method=post >
<input type="hidden" name="function" value="get">
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
<select name="select_file" onClick="javascript: if(this.selectedIndex!=-1) { lastKlicked_Val=this.options[this.selectedIndex].value; }" <?php

if ($phpftp_chmods)
echo " onChange=\"show_right_number(this.options[this.selectedIndex].text,document.forms.frm_chmod.cur_chmode);\" ";

?> ondblclick="javascript: if(this.selectedIndex!=-1) { download_file(this.options[this.selectedIndex].value); }" class="selector" style="width: <?php echo $conf_fileman_files_width; ?>px;" size="<?php echo $listlength; ?>">
<?php

// VERHAELTNIS FILENAME MAX WIDTH ZU $CONF_FILEMAN_FILES_WIDTH RECHNEN
$max_name_len = round($conf_fileman_files_width/17);
$max_size_len = 11; // inkl. einheit, da: 0.000,00 KB oder 0.000 Bytes = 11 zeichen

for ($i=0; $i < $nFiles; $i++)
{
    // FILENAME
    $fname = substr($nlist_files[$i],0,$max_name_len).lz($max_name_len-strlen($nlist_files[$i]),false);
    if (strlen($nlist_files[$i])>$max_name_len) $fname=substr($fname,0,$max_name_len-3)."...";

    // FILESIZE
    $fsize = $nlist_filesize[$i];
    // 10000000 Bytes --> 9,53 MB
    if (strlen($fsize)>7)       $fsize = number_format(round(($fsize/1024/1024),2),2,",",".")." MB";
    // 10000 Bytes ---> 9,77 KB
    else if (strlen($fsize)>4)  $fsize = number_format(round(($fsize/1024),2),2,",",".")." KB";
    else                        $fsize = number_format($fsize,0,",",".")." Bytes";

    if (strlen($fsize)<$max_size_len) $fsize .= lz($max_size_len-strlen($fsize),false);

    // FILEDATE
    $fdate = decode_ftp_filedate($nlist_filedate[$i]);

    // RIGHT
    $nlist_fileright[$i] .= lz(9-strlen($nlist_fileright[$i]),false);

    echo "<option value=\"" . $nlist_files[$i] . "\">".
    $fname ." |".$nlist_fileright[$i]."| ".$fsize." | ".$fdate ."</option>\n";
}

?>

</select>
</form>

<?php
}
else    
show_error($al['error3'],false,$conf_fileman_files_width);

?>

</td></tr><tr><td>

<?php

// ***** HIDDEN FORM FOR DIRECTORY UP FUNCTION USED BY JS ONLY (NECESSARY)

$cdup=dirname($phpftp_dir);
if ($cdup == "") {
    $cdup="/";
}

draw_form("dir"," name=\"directory_up\" ");

?>
<input type="hidden" name="phpftp_dir" value="<?php echo $cdup; ?>">
</form>

<?php

// ***** Refresh
draw_form("dir","",$al['refresh']); ?>
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
</form>


</td><td>

<?php

if ($nDirs>0)
{
// *****
draw_form("dropdir"," onSubmit=\"javascript: return finish_form(document.forms.directory_select.select_directory.value,this.select_directory,'".$al['error17']."','".$al['confirmdeldir']."');\" ",$al['deldir']); ?>
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
<input type="hidden" name="select_directory" value="">
</form>

<?php } ?>

</td><td colspan=2 nowrap>

<?php

// ***** FILE UPLOAD
draw_form("put","onSubmit=\"javascript: return check_file(this.userfile.value);\" enctype=\"multipart/form-data\" ",$al['upload']); ?>
<input type="hidden" name="max_file_size" value="<?php echo $max_file_size ?>">
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
<input name="userfile" type="file" size="20">

<?php

$kb_limit = round($max_file_size/1024,0);
$mb_limit = round($max_file_size/1024/1024,0);
$gb_limit = round($max_file_size/1024/1024/1024,0);

if      ($kb_limit<1000)	echo $kb_limit."KB ";
else if ($mb_limit<1000)	echo $mb_limit."MB ";
else 						echo $gb_limit."GB ";

echo $al['limit'];

?>

</form>
</td></tr><tr><td colspan=2>

<?php

// ***** 
draw_form("mkdir","onSubmit=\"javascript: if (this.new_dir.value=='') { ".js_alert($al['error4'],2)." return false; } else { return true; }\"",$al['credir']); ?>
<form action="ftp.php" method=post>
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
<input name="new_dir" type="text" maxlength="100" style="width: 190px;">
</form>

</td><td>

<?php

// *****

if ($phpftp_chmods)
{
draw_form("chmod"," onSubmit=\"javascript: return finish_form(lastKlicked_Val,this.select_file);\" ",$al['chmod']); ?>
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
<input type="hidden" name="select_file" value="">
<input type="text"   name="cur_chmode" readonly value="---" size=3> <?php echo $al['to']; ?>  
<select name="chmode" id="chmode">
<?php

for ($i=0;$i<count($phpftp_chmods);$i++) 
echo "<option value=\"".$phpftp_chmods[$i]."\">".$phpftp_chmods[$i]."</option>\n";

?>
</select>
&nbsp;

<a href="#" onClick="popup_win('chmodhelp','./lang/chmod_<?php echo $conf_phpftp_lang; ?>.html',640,640);">
<img src="modules/Uploads/img/help.gif" align="top" width="19" height="19" border="0"></a>

</form>

<?php
}

// *****
if ($nFiles>0) {
draw_form("drop"," onSubmit=\"javascript: return finish_form(document.forms.file_select.select_file.value,this.select_file,'".$al['error17']."','".$al['confirmdelfile']."');\" ",$al['delfile']); ?>
<input type="hidden" name="phpftp_dir" value="<?php echo $phpftp_dir; ?>">
<input type="hidden" name="select_file" value="">
</form>

<?php } ?>

</td><td align=right>

<?php

// *****
draw_form("exit"," onSubmit=\"document.location.href='"._SYSTEM."'; return false;\" ",$al['exit']."\" style=\"width:100px; height: 40px;"); ?>
</form>

<?php

@ftp_close($ftp);

    }
    ?>

    </td></tr></table>

    <?php
}
?>