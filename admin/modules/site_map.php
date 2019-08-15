<?php

/************************************************************************/
/* NukeJMap [Site_Map]    4.0 by z3rb                                        */
/* =================================                                    */
/*                                                                      */
/* Copyright (c) 2006 by Techgen                                         */
/* http://www.techg3n.net                                               */
/*                                                                      */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
    die ("Access Denied");
}

if (!is_mod_admin()) {
    die ("Access Denied");
}

global $prefix, $db, $sitename, $currentlang, $admin_file;

if (file_exists(NUKE_MODULES_DIR.'Site_Map/language/lang-'.$currentlang.'.php')) {
    include_once(NUKE_MODULES_DIR.'Site_Map/language/lang-'.$currentlang.'.php');
} else {
    include_once(NUKE_MODULES_DIR.'Site_Map/language/lang-english.php');
}


$result = $db->sql_query("SELECT * FROM ".$prefix."_jmap");
    while ($row=$db->sql_fetchrow($result))
      {
        $nametask = $row["name"];
        $value = $row["value"];
        $conf[$nametask]=$value;
      }
$xml = $conf["xml"];
$ndown = $conf["ndown"];
$nnews = $conf["nnews"];
$nrev = $conf["nrev"];
$ntopics = $conf["ntopics"];
$nuser = $conf["nuser"];

include(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\"><a href=\"$admin_file.php?op=site_map\">" . _SITEMAP_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _SITEMAP_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
echo "<br />";
Opentable();
            echo"<center><strong>"._SITEMAPADMIN."</strong></center>";
Closetable();

Opentable();
            echo'
                <form action="'.$PHP_SELF.'" method="post">
                    <table border="0" id="table6" width="50%" align="center">
                        <tr>
                            <td width="50%" height="30%" align="center">
                    <table border="0" width="588" id="table7" height="296">
                        <tr>
                            <td width="146" height="102">
                                <p align="left">'._XMLCREATE.'</td>
                            <td height="102">';
        if($xml==1) {
            echo'<p align="left">'._YES.'<input name="xml" type="radio" value="1" checked>
                                                '._NO.'<input name="xml" type="radio" value="0" ></p>';
        }
        else {
            echo'<p align="left">'._YES.'<input name="xml" type="radio" value="1" >
                                                '._NO.'<input name="xml" type="radio" value="0" checked></p>';
        }
            echo'            </td>
                            <td height="102">
                                <p align="left">'._NDOWN.'</td>
                            <td height="102">
                                &nbsp;<p align="left"><input name="ndown" size="6" value="'.$ndown.'"></p>
                                <p align="left">&nbsp;</td>
                            </tr>
                            <tr>
                            <td width="146" height="102">
                                <p align="left">'._NNEWS.'</td>
                            <td width="146" height="102">
                                <p align="left">&nbsp; </p>
                                <p align="left"><input name="nnews" size="6" value="'.$nnews.'"></p>
                                &nbsp;</td>
                            <td width="147" height="102">
                                <p align="left">'._NREV.'</td>
                            <td width="147" height="102">&nbsp;<p align="left">
                                <input name="nrev" size="6" value="'.$nrev.'"></p>
                                <p align="left">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="146" height="102">
                                <p align="left">'._NTOPICS.'</td>
                            <td width="146" height="102">
                                <p align="left">&nbsp; </p>
                                <p align="left"><input name="ntopics" size="6" value="'.$ntopics.'"></p>
                            &nbsp;</td>
                            <td width="147" height="102">
                                <p align="left">'._NUSER.'</td>
                            <td width="147" height="102">&nbsp;<p align="left">
                                <input name="nuser" size="6" value="'.$nuser.'"></p>
                                <p align="left">&nbsp;</td>
                        </tr>
                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" height="72">
                <table border="0" width="566" id="table14">
                    <tr>
                        <td width="188">&nbsp;</td>
                        <td width="164">
                            <p align="center"><input type="submit" value="'._OK.'" name="ok"></p>
                            <p align="center">&nbsp;</td>
                        <td width="200">&nbsp;</td>
                       </tr>
                </table></td>
                </tr>
            </table>
            </form>
';

            $xml=htmlspecialchars($_POST['xml']);
            $nnews=htmlspecialchars($_POST['nnews']);
            $ntopics=htmlspecialchars($_POST['ntopics']);
            $ndown=htmlspecialchars($_POST['ndown']);
            $nrev=htmlspecialchars($_POST['nrev']);
            $nuser=htmlspecialchars($_POST['nuser']);

            if( $xml!="" && $nnews!="" && $ntopics!="" && $ndown!="" && $nrev!="" && $nuser!="" )
            {
            //$db->sql_query("UPDATE ".$prefix."_jmap SET xml = ".$xml.", nnews = ".$nnews.", ntopics = ".$ntopics.", ndown = ".$ndown.", nrev = ".$nrev.", nuser = ".$nuser);
            $db->sql_query("UPDATE " . $prefix . "_jmap SET value = '".$xml."' WHERE name = 'xml'");
            $db->sql_query("UPDATE " . $prefix . "_jmap SET value = '".$nnews."' WHERE name = 'nnews'");
            $db->sql_query("UPDATE " . $prefix . "_jmap SET value = '".$ntopics."' WHERE name = 'ntopics'");
            $db->sql_query("UPDATE " . $prefix . "_jmap SET value = '".$ndown."' WHERE name = 'ndown'");
            $db->sql_query("UPDATE " . $prefix . "_jmap SET value = '".$nrev."' WHERE name = 'nrev'");
            $db->sql_query("UPDATE " . $prefix . "_jmap SET value = '".$nuser."' WHERE name = 'nuser'");

            Header("Location: ".$admin_file.".php?op=site_map");
            }


Closetable();
// YOU ARE NOT AUTHORISED TO REMOVE OR EDIT BELOW LINES WITHOUT AUTHORS PERMISSIONS. PLEASE PLAY FAIR.
// NON MOFIFICARE O RIMUOBERE LE LINEE SEGUENTI SENZA IL PERMESSO DELL'AUTORE
echo'
<script type="text/javascript">
 <!--
 function copy() {
   var w = 400;
   var h = 250;
   var l = Math.floor((screen.width-w)/2);
   var t = Math.floor((screen.height-h)/2);
      window.open("modules/Site_Map/copyright.php","","width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
 }
 //-->
</script>
<p align=right>
<a href="javascript:copy()">&copy;NukeJMap</a></p>';

include(NUKE_BASE_DIR.'footer.php');


switch ($op) {

    case "site_map":
                break;
}




?>