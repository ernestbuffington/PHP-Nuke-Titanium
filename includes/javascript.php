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

/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      NukeSentinel                             v2.4.1       08/31/2005
      Theme Management                         v1.0.2       12/14/2005
-=[Mod]=-
      Anti-Spam                                v1.1.0       06/18/2005
      IE PNG Fix                               v1.0.0       06/24/2005
      Password Strength Meter                  v1.0.0       07/12/2005
      ToolManDHTML                             v0.0.2       03/20/2005
      Switch Content Script                    v2.0.0       03/29/2006
      Resize Posted Images                     v2.4.5       06/15/2005
      IE Embed Fix                             v1.0.0       04/24/2006
	  jQuery Lightbox Resize Images            v0.5
 ************************************************************************/


//Note due to all the windows.onload use womAdd('function_name()'); instead

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

include_once(NUKE_INCLUDE_DIR.'styles.php');

##################################################
# Include for some common javascripts functions  #
##################################################

addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'javascript/onload.js','file');

/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                       v2.4.1 ]
 ******************************************************/
global $sentineladmin;
if(!defined('FORUM_ADMIN')) 
{
    addJSToHead('includes/nukesentinel/overlib.js','file');
    addJSToHead('includes/nukesentinel/overlib_hideform.js','file');
    addJSToHead('includes/nukesentinel/nukesentinel3.js','file');
}
/*****[END]********************************************
 [ Base:    NukeSentinel                       v2.4.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     IE Embed Fix                       v1.0.0 ]
 ******************************************************/
echo "<!--[if IE]><script defer=\"defer\" type=\"text/javascript\" src=\"includes/embed_fix.js\"></script>\n<![endif]-->";
/*****[END]********************************************
 [ Mod:     IE Embed Fix                       v1.0.0 ]
 ******************************************************/

if (isset($userpage)) {
    echo "<script type=\"text/javascript\">\n";
    echo "<!--\n";
    echo "function showimage() {\n";
    echo "if (!document.images)\n";
    echo "return\n";
    echo "document.images.avatar.src=\n";
    echo "'$nukeurl/modules/Forums/images/avatars/gallery/' + document.Register.user_avatar.options[document.Register.user_avatar.selectedIndex].value\n";
    echo "}\n";
    echo "//-->\n";
    echo "</script>\n\n";
}

global $name;
if (defined('MODULE_FILE') && !defined("HOME_FILE") AND file_exists("modules/".$name."/copyright.php")) {
    echo "<script type=\"text/javascript\">\n";
    echo "<!--\n";
    echo "function openwindow(){\n";
    echo "    window.open (\"modules/".$name."/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200\");\n";
    echo "}\n";
    echo "//-->\n";
    echo "</script>\n\n";
}

/*****[BEGIN]******************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/
if (!defined('ADMIN_FILE')) 
{
    addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'javascript/anti-spam.js','file', true);
}
/*****[END]********************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
if ( get_evo_option('recap_site_key') && get_evo_option('recap_priv_key') )
    echo "<script src='https://www.google.com/recaptcha/api.js".(!empty(get_evo_option('recap_lang')) ? "?hl=".get_evo_option('recap_lang') : "")."' defer></script>";
 /*****[END]*******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     IE PNG Fix                         v1.0.0 ]
 ******************************************************/
$arcade_on = (isset($_GET['file']) && $_GET['file'] == 'arcade_games') ? true : (isset($_POST['file']) && $_POST['file'] == 'arcade_games') ? true : false;

if (!$arcade_on) {
    $arcade_on = (isset($_GET['do']) && $_GET['do'] == 'newscore') ? true : (isset($_POST['do']) && $_POST['do'] == 'newscore') ? true : false;
}

if (!$arcade_on) {
    echo "<!--[if lt IE 7]><script type=\"text/javascript\" src=\"".NUKE_JQUERY_SCRIPTS_DIR."javascript/pngfix.js\"></script><![endif]-->\n";
}
/*****[END]********************************************
 [ Mod:     IE PNG Fix                         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
 global $admin_file;
 if(isset($name) && ($name == "Your Account" || $name == "Your_Account" || $name == "Profile" || defined('ADMIN_FILE'))) {
     echo '<script type="text/javascript">
        var pwd_strong = "'.PSM_STRONG.'";
        var pwd_stronger = "'.PSM_STRONGER.'";
        var pwd_strongest = "'.PSM_STRONGEST.'";
        var pwd_notrated = "'.PSM_NOTRATED.'";
        var pwd_med = "'.PSM_MED.'";
        var pwd_weak = "'.PSM_WEAK.'";
        var pwd_strength = "'.PSM_CURRENTSTRENGTH.'";
    </script>';
    echo "<script type=\"text/javascript\" src=\"".NUKE_JQUERY_SCRIPTS_DIR."javascript/password_strength.js\" defer></script>\n";
 }
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
if (defined('ADMIN_FILE')) {
    echo "<script type=\"text/javascript\">\n";
    echo "<!--\n";
    echo "function themepreview(theme){\n";
    echo "window.open (\"index.php?tpreview=\" + theme + \"\",\"ThemePreview\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=1000,height=800\");\n";
    echo "}\n";
    echo "//-->\n";
    echo "</script>\n\n";
}
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     ToolManDHTML                       v0.0.2 ]
 ******************************************************/
if (defined('ADMIN_FILE') && defined('USE_DRAG_DROP')) {
    global $element_ids, $Sajax;
    if(isset($Sajax) && is_object($Sajax)) {
        echo "<script type=\"text/javascript\">\n<!--\n";
        echo $Sajax->sajax_show_javascript();
        echo "//-->\n";
        echo "</script>\n";
    }
    $i = 0;
    $script_out = '';
    if(!is_array($element_ids)) $element_ids = array();
    foreach ($element_ids as $id) {
        if(!$i) {
            $script_out .= "var list = document.getElementById(\"".$id."\");\n";
            $i++;
        } else {
            $script_out .= "list = document.getElementById(\"".$id."\");\n";
        }

        global $g2;
        $script_out .= (!$g2) ? "DragDrop.makeListContainer( list, 'g1' );\n" : "DragDrop.makeListContainer( list, 'g2' );\n";
        // $script_out .= "list.onDragOver = function() { this.style[\"background\"] = \"#EEF\"; };\n";
        $script_out .= "list.onDragOut = function() {this.style[\"background\"] = \"none\"; };\n\n\n";
        $script_out .= "list.onDragDrop = function() {onDrop(); };\n";
    }

    //echo "<link rel=\"stylesheet\" href=\"includes/ajax/lists.css\" type=\"text/css\">";
    echo "<script type=\"text/javascript\" src=\"includes/ajax/coordinates.js\" defer></script>\n";
    echo "<script type=\"text/javascript\" src=\"includes/ajax/drag.js\" defer></script>\n";
    echo "<script type=\"text/javascript\" src=\"includes/ajax/dragdrop.js\" defer></script>\n";
    echo "<script type=\"text/javascript\"><!--
    function confirm(z)
    {
      window.status = 'Sajax version updated';
    }

    function create_drag_drop() {";

        echo $script_out;

    echo "};

    if (window.addEventListener)
        window.addEventListener(\"load\", create_drag_drop, false)
    else if (window.attachEvent)
        window.attachEvent(\"onload\", create_drag_drop)
    else if (document.getElementById)
        womAdd('create_drag_drop()');
    //-->
</script>\n";
}
/*****[END]********************************************
 [ Mod:     ToolManDHTML                       v0.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
global $plus_minus_images, $collapse;
if ($collapse) 
{
    $JStoBody  = '<script type="text/javascript">'.PHP_EOL;
    $JStoBody .= '  var enablepersist   = "on";'.PHP_EOL;
    $JStoBody .= '  var memoryduration  = "7";'.PHP_EOL;
    $JStoBody .= '  var contractsymbol  = "'.$plus_minus_images['minus'].'";'.PHP_EOL;
    $JStoBody .= '  var expandsymbol    = "'.$plus_minus_images['plus'].'";'.PHP_EOL;
    $JStoBody .= '</script>'.PHP_EOL;
    addJSToBody($JStoBody,'inline');
    addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'javascript/collapse_blocks.js','file');
}
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     jQuery                             v1.5.0 ]
 ******************************************************/
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.php');
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.reimg.image.resizer.php');
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.messagebox.php');               # v2.2.1 (https://gasparesganga.com)
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.colorpicker.php');

include(NUKE_JQUERY_INCLUDE_DIR.'jquery.fancybox.php');                 # v3.1.20
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.lightbox.php');                 # v2.9.0
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.colorbox.php');                 # v1.6.4
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.lightbox-lite.php');

include(NUKE_JQUERY_INCLUDE_DIR.'jquery.live.feed.php');

include(NUKE_JQUERY_INCLUDE_DIR.'jquery.scroll.to.top.php');            # add in option to change icon per theme
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.private.messages.alert.php');   # v1.0 - https://lonestar-modules.com
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.floating.admin.php');           # v2.0 - floating administration menu
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.username.availability.php');    # Username Avalibility Check
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.tooltipster.php');
/*****[END]********************************************
 [ Mod:     jQuery                             v1.5.0 ]
 ******************************************************/

//addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'Evo.EE.js','file');
//addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'Evo.EE.CMD.js','file');

global  $analytics;
if (!empty($analytics)) {

//updated by Ernest Buffington 05/05/2019 new goole snipped for analytics
echo "
<!-- Google Analytics -->
<script type='text/javascript'>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '".$analytics."', 'auto');  
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->\n\n";
}
//updated by Ernest Buffington 05/05/2019 new goole snipped for analytics


global $more_js;
if (!empty($more_js)) {
    echo $more_js;
}

//DO NOT PUT ANYTHING AFTER THIS LINE
echo "<!--[if IE]><script type=\"text/javascript\">womOn();</script><![endif]-->\n";
?>