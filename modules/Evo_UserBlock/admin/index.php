<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : index.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Administration
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

define('USE_DRAG_DROP', true);

define('NUKE_EVO_USERBLOCK', dirname(dirname(__FILE__)) . '/');
define('NUKE_EVO_USERBLOCK_ADDONS', NUKE_EVO_USERBLOCK . '/addons/');
define('NUKE_EVO_USERBLOCK_ADMIN', dirname(__FILE__) . '/');
define('NUKE_EVO_USERBLOCK_ADMIN_INCLUDES', NUKE_EVO_USERBLOCK_ADMIN . 'includes/');
define('NUKE_EVO_USERBLOCK_ADMIN_ADDONS', NUKE_EVO_USERBLOCK_ADMIN . 'addons/');

global $titanium_prefix, $titanium_db, $admin_file, $admdata, $titanium_lang_evo_userblock;
$titanium_module_name = basename(dirname(dirname(__FILE__)));

if (!is_mod_admin($titanium_module_name)) {
    echo "Access Denied";
    die();
}

include_once(NUKE_EVO_USERBLOCK_ADMIN_INCLUDES . 'functions.php');
include_once(NUKE_EVO_USERBLOCK_ADDONS.'core.php');

require_once(NUKE_INCLUDE_DIR.'ajax/Sajax.php');
global $Sajax;
$Sajax = new Sajax();
evouserinfo_addscripts();
$Sajax->sajax_export("sajax_update");
$Sajax->sajax_handle_client_request();

function evouserinfo_drawlists () {
    global $titanium_lang_evo_userblock, $admin_file, $Default_Theme, $titanium_module_name, $phpbb2_board_config, $userinfo, $evouserinfo_ec, $admlang;

    $active = evouserinfo_getactive();
    $inactive = evouserinfo_getinactive();
    
    $blocks = NUKE_THEMES_DIR.$Default_Theme."/blocks.html";
    
    
    OpenTable();
    
    //Config
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<form action=\"".$admin_file.".php?op=evo-userinfo\" method=\"post\">\n";
    echo "<table border=\"0\" align=\"center\" cellspacing=\"1\" cellpadding=\"4\">\n";
    echo "<tr><td align=\"right\">\n";
    echo $titanium_lang_evo_userblock['ADMIN']['COLLAPSE'];
    echo "</td><td align=\"left\">\n";
    echo yesno_option('evouserinfo_ec', $evouserinfo_ec);
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br />";
    echo "<input type=\"submit\" value=\"".$admlang['global']['submit']."\" />";
    echo "</form>\n";
    echo "</div>\n";
    CloseTable();
	echo "<br />";
    echo "<div align=\"center\">";
    echo "<table width=\"360\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\ align=\"center\">\n";
    //Inactive
    echo "<tr><td>\n";
    echo "<ul id=\"left_col\" class=\"sortable boxy\">\n";
    if(is_array($inactive)) {
        global $phpbb2_board_config;
        foreach ($inactive as $element) {
            if(!empty($element['image'])) {
                echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><center><img src=\"images/".$element['image']."\"></center></li>\n";
            } else {
                $addon = evouserinfo_load_addon($element['filename']);
                if(!empty($addon)) {
                    echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$addon."</li>\n";
                } else {
                    echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$element['name']."</li>\n";
                }
            }
        }
    }
    //Breaks
    $phpbb2_end = count($active);
    for ($i = 0; $i < 5; $i++) {
        echo "<li id=\"".$titanium_lang_evo_userblock['ADMIN']['BREAK'].$i."\"><hr /></li>\n";
    }
    echo "</ul>\n";
    
    echo "</td>\n";
    echo "<td>\n";
    
    //Active
    $title = "Output";
    $content = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\ align=\"center\">\n";
    $content .= "<tr><td>\n";
    $content .= "<ul id=\"center\" class=\"sortable boxy\">\n";
    if(is_array($active)) {
        foreach ($active as $element) {
            if(!empty($element['image'])) {
                $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><center><img src=\"".$phpbb2_board_config['avatar_gallery_path']."/".$userinfo['user_avatar']."\"></center></li>\n";
            } else {
                if($element['filename'] != 'Break') {
                    $addon = evouserinfo_load_addon($element['filename']);
                    if(!empty($addon)) {
                        $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$addon."</li>\n";
                    } else {
                        $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$element['name']."</li>\n";
                    }
                } else {
                    $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><hr /></li>\n";
                }
            }
        }
    }
    $content .= "</ul>\n";
    $content .= "</td></tr>\n";
    $content .= "</table>";
    if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks.html")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks.html";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockR.html")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockR.html";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockr.html")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockr.html";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockL.html")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockL.html";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockl.html")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockl.html";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/block.html")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/block.html";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks.htm")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks.htm";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocksR.htm")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocksR.htm";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocksL.htm")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocksL.htm";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks-right.htm")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks-right.htm";
    } else if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks-left.htm")) {
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks-left.htm";
    }
    if(file_exists($tmpl_file)) {
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    $thefile = str_replace('168', '230', $thefile);
    eval($thefile);
    echo $r_file;
	} else {
	echo $content;
	}
    
    echo "</td></tr>";
    
    echo "<tr>\n";
    echo "<td colspan=\"2\" align=\"center\">";
    echo "<form action=\"\" method=\"post\">
              <br />
              <input type=\"hidden\" name=\"order\" id=\"order\" value=\"\" />
              <input type=\"submit\" onclick=\"getSort()\" value=\"".$titanium_lang_evo_userblock['ADMIN']['SAVE']."\" />
          </form>";
    echo "</td></tr>\n";
    echo "</table>\n";
    echo "</div>";
    CloseTable();
}

function evouserinfo_write ($data){
    global $titanium_prefix, $titanium_db, $titanium_lang_evo_userblock, $cache;
    
    //Clear All Previous Breaks
    $titanium_db->sql_query('DELETE FROM `'.$titanium_prefix.'_evo_userinfo` WHERE `name`="Break"');
    //Write Data
    if(is_array($data)) {
        foreach ($data as $type => $sub) {
            if ($type == 'left_col') {
                $i = 1;
                foreach ($sub as $element) {
                    if (!preg_match('#'.$titanium_lang_evo_userblock['ADMIN']['BREAK'].'#',$element)) {
                        $sql = 'UPDATE `'.$titanium_prefix.'_evo_userinfo` SET `position`='.$i.', `active`=0 WHERE `filename`="'.$element.'";';
                        $titanium_db->sql_query($sql);
                        $i++;
                    } else {
                        $i++;
                    }
                }
            } else {
                $i = 1;
                foreach ($sub as $element) {
                    if (!preg_match('#'.$titanium_lang_evo_userblock['ADMIN']['BREAK'].'#',$element)) {
                        $sql = 'UPDATE `'.$titanium_prefix.'_evo_userinfo` SET `position`='.$i.', `active`=1 WHERE `filename`="'.$element.'"';
                        $titanium_db->sql_query($sql);
                        $i++;
                    } else {
                        $sql = 'INSERT INTO `'.$titanium_prefix.'_evo_userinfo` values ("Break", "Break", 1, '.$i.', "")';
                        $titanium_db->sql_query($sql);
                        $i++;
                    }
                }
            }
        }
        $cache->delete('inactive', 'evouserinfo');
        $cache->delete('active', 'evouserinfo');
        $cache->resync();
    }
}

function evouserinfo_addscripts() {
    global $Sajax;
    $script .= "    function onDrop() {
                var data = DragDrop.serData('g2'); 
                x_sajax_update(data, confirm);
            }\n";
    $script .= "function getSort()
            {
              order = document.getElementById(\"order\");
              order.value = DragDrop.serData('g1', null);
            }\n";
    $script .= "function showValue()
                {
                  order = document.getElementById(\"order\");
                  alert(order.value);
                }\n";
    $Sajax->sajax_add_script($script);
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/


if (!empty($file)){
    //Look for . / \ and kick it out
    if (preg_match('/[^\w_]/i',$file)) {
        global $titanium_lang_evo_userblock;
        DisplayError($titanium_lang_evo_userblock['ACCESS_DENIED']);
    }
}

if (isset($_POST['order']))
{
  $data = evouserinfo_parse_data($_POST['order']);
  evouserinfo_write($data);
  // redirect so refresh doesnt reset order to last save
  redirect_titanium($admin_file.".php?op=evo-userinfo");
}
if (isset($_POST['evouserinfo_ec']) && is_int(intval($_POST['evouserinfo_ec']))) {
    global $titanium_db, $titanium_prefix, $cache, $evouserinfo_ec;
    $titanium_db->sql_query("UPDATE ".$titanium_prefix."_evolution SET evo_value='".$_POST['evouserinfo_ec']."' WHERE evo_field='evouserinfo_ec'");
    $cache->delete('titanium_config', 'config');
    $cache->resync();
    $evouserinfo_ec = intval($_POST['evouserinfo_ec']);
}

if (!empty($file)){
    if(file_exists(NUKE_EVO_USERBLOCK_ADMIN_ADDONS . $file . '.php')) {
        include_once(NUKE_EVO_USERBLOCK_ADMIN_ADDONS . $file . '.php');
    } else {
        redirect_titanium($admin_file.".php?op=evo-userinfo");
    }
} else {
    global $element_ids;
    $element_ids[] = 'left_col';
    $element_ids[] = 'center';
    $element_ids[] = 'right_col';
    include_once(NUKE_BASE_DIR.'header.php');
	    OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$titanium_lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$titanium_lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        title(_EVO_USERINFO);
        OpenTable();
        echo "<div align=\"center\">\n";
        echo "<span style=\"font-size: large; font-weight: bold;\">".$titanium_lang_evo_userblock['ADMIN']['HELP']."</span>\n<br /><br />\n";
        echo $titanium_lang_evo_userblock['ADMIN']['ADMIN_HELP'];
        echo "</div>";
        CloseTable();
        echo "<br />\n";
        evouserinfo_drawlists();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>