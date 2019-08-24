<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: SQL Control System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
  
   Filename      : backup.php
   Author(s)     : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 12.03.2005 (mm.dd.yyyy)
                                                                        
   Notes         : Database Backup Manager
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $prefix, $db, $admdata, $dbname, $cache;
if (is_mod_admin()) {
  
$crlf = "\n";
$filename = $dbname.'_'.date('d-m-Y').'.sql';
$tablelist = (isset($_POST['tablelist'])) ? $_POST['tablelist'] : $db->sql_fetchtables($dbname);
@set_time_limit(0);

switch ($op) {

    case 'BackupDB':
        if (empty($tablelist)) { echo('No tables found'); }
        require_once(NUKE_CLASSES_DIR.'class.database.php');
        DB::backup($dbname, $tablelist, $filename, isset($_POST['dbstruct']), isset($_POST['dbdata']), isset($_POST['drop']), isset($_POST['gzip']));
        break;

    case 'OptimizeDB':
    case 'optimize':
    case 'CheckDB':
    case 'AnalyzeDB':
    case 'RepairDB':
    case 'StatusDB':
        if($op == 'optimize') $op = 'OptimizeDB';
        $type = strtoupper(substr($op,0,-2));
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        if (count($tablelist)) {
            if ($type == 'STATUS') {
                $query = 'SHOW TABLE STATUS FROM '.$dbname;
            } else {
                $query = "$type TABLE $dbname.".implode(", $dbname.", $tablelist);
            }
            $result = $db->sql_query($query);
            $numfields = $db->sql_numfields($result);
            echo '<span><strong>'._DATABASE.':</strong> '.$dbname.'</span><br /><br />'._ACTIONRESULTS.' '.strtolower($type).'<br /><br />
            <table border="0" cellpadding="2"><tr bgcolor="'.$bgcolor2.'">';
            for ($j=0; $j<$numfields; $j++) {
                echo '<td><strong>'.$db->sql_fieldname($j, $result).'</strong></td>';
            }
            echo '</tr>';
            $bgcolor = $bgcolor3;
            while ($row = $db->sql_fetchrow($result)) {
                $bgcolor = ($bgcolor == '') ? ' bgcolor="'.$bgcolor3.'"' : '';
                echo '<tr'.$bgcolor.'>';
                for($j=0; $j<$numfields; $j++) {
                    echo '<td>'.$row[$j].'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        break;

    case 'RestoreDB':
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        require_once(NUKE_CLASSES_DIR.'class.database.php');
        if (!DB::query_file($_FILES['sqlfile'], $error)) { echo($error); }
        $cache->clear();
        OpenTable();
        echo '<span><strong>'._DATABASE.': '.$dbname.'</strong></span><br /><br />'.sprintf(_IMPORTSUCCESS, $_FILES['sqlfile']['name']);
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        break;

    case 'backup':
    case 'database':
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=database\">" . _DATABASE_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _DATABASE_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo '<form method="post" name="backup" action="'.$admin_file.'.php" enctype="multipart/form-data">';
        echo "<script language=\"JavaScript\" type=\"text/javascript\">
        <!--
        function setSelectOptions(the_form, the_select, do_check)
        {
        var selectObject = document.forms[the_form].elements[the_select];
        var selectCount  = selectObject.length;

        for (var i = 0; i < selectCount; i++) {
        selectObject.options[i].selected = do_check;
        } // end for

        return true;
        } // end of the 'setSelectOptions()' function
        //  End -->
        </script>";
        echo '<table><tr><td>
        <select name="tablelist[]" size="20" multiple="multiple">';
        if (is_array($tablelist)) {
            foreach($tablelist as $table) {
                echo '<option value="'.$table.'">'.$table.'</option>';
            }
        }
        echo '</select><br /><br /><center>';
        echo "<a href=\"javascript:void(0);\" onclick=\"setSelectOptions('backup', 'tablelist[]', true); return false;\">";
        echo "<strong>"._CHECKALL."</strong></a>&nbsp;|&nbsp;";
        echo "<a href=\"javascript:void(0);\" onclick=\"setSelectOptions('backup', 'tablelist[]', false); return false;\"><strong>"._UNCHECKALL."</strong></a></center></td>";
        echo '<td valign="middle">
        <label for="op"><span><strong>'._DBACTION.'</strong></span></label><br /><select name="op" id="op"
        onchange="dbback=document.getElementById(\'backuptasks\');dbback.style.display=(this.options[this.selectedIndex].value==\'BackupDB\') ? \'\' : \'none\';">
        <option value="AnalyzeDB">'._ANALYZEDATABASE.'</option>
        <option value="BackupDB" selected="selected">'._SAVEDATABASE.'</option>
        <option value="CheckDB">'._CHECKDATABASE.'</option>
        <option value="OptimizeDB">'._OPTIMIZEDATABASE.'</option>
        <option value="RepairDB">'._REPAIRDATABASE.'</option>
        <option value="StatusDB">'._STATUSDATABASE.'</option>
        </select>&nbsp;<input type="submit" value="'.$admlang['global']['go'].'" /><br /><br /><div id="backuptasks" style="float: center;">'._BACKUPTASKS.':<br />
        <input type="checkbox" value="1" name="dbdata" checked="checked" style="margin-left: 10px;" />'._SAVEDATA.'<br />
        <input type="checkbox" value="1" name="dbstruct" checked="checked" style="margin-left: 10px;" />'.sprintf(_INCLUDESTATEMENT, 'CREATE').'<br />
        <input type="checkbox" value="1" name="drop" checked="checked" style="margin-left: 10px;" />'.sprintf(_INCLUDESTATEMENT, 'DROP').'<br />';
        if (GZIPSUPPORT) {
            echo '<input type="checkbox" value="1" name="gzip" checked="checked" style="margin-left: 10px;" />'._GZIPCOMPRESS;
        }
        echo '</div></td><td valign="top" width="50%">';

        OpenTable();
        echo '<div align="center">'._OPTIMIZETEXT;
        CloseTable();
        echo '</td></tr></table></form><br /><br />
        <span><strong>'._IMPORTFILE.'</strong></span><br /><br />
        <form method="post" action="'.$admin_file.'.php" name="restore" enctype="multipart/form-data">
        <input type="file" name="sqlfile" size="100" /> <input type="hidden" name="op" value="RestoreDB" /><input type="submit" value="'._IMPORTSQL.'" />
        </form>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        break;
}

} else {
    echo "Access Denied";
}
?>
