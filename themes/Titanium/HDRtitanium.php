<?php
/*----------------------------------------------------------------*/
/* THEME INFO                                                     */
/* Titanium Theme v1.0 (Fixed & Full Width)                       */
/*                                                                */
/* A Very Nice Titanium Theme                                     */
/* Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington       */
/* e-Mail : ernest.buffington@gmail.com                           */
/*----------------------------------------------------------------*/
/* CREATION INFO                                                  */
/* Created On: 1st August, 2019 (v1.0)                            */
/*                                                                */
/* Updated On: 1st August, 2019 (v3.0)                            */
/* HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)   */
/*                                                                */
/* Read CHANGELOG File for Updates & Upgrades Info                */
/*                                                                */
/* Designed By: TheGhost / The Mortal                             */
/* Web Site: https://hub.86it.us                                  */
/* Purpose: PHP-Nuke Titanium                                     */
/*----------------------------------------------------------------*/
/* CMS INFO                                                       */
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi phpnuke.org     */
/* PHP-Nuke Titanium (c) 2008                                     */
/*----------------------------------------------------------------*/

/*-----------------------------*/
/* Titanium Header Section     */
/*-----------------------------*/
/* Fixed & Full Width Style    */
/*-----------------------------*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

global $sitename, $slogan, $name, $banners, $db, $user_prefix, $prefix, $admin_file, $userinfo, $ThemeInfo, $theme_name;

// Check if a Registered User is Logged-In
$username = is_user() ? $userinfo['username'] : _ANONYMOUS;

// Setup the Welcome Information for the User
if ($username === _ANONYMOUS):
   $theuser  = '<div style="float: right; padding-right: 34px;">You are not Logged-In as a User!</div><br />';
   $theuser .= '<div style="float: right; padding-right: 26px;">Please <a href="modules.php?name=Your_Account">Login</a> or <a href="modules.php?name=Your_Account&amp;op=new_user">Register</a>&nbsp;&nbsp;</div>';
else:
    $theuser  = sprintf(_YOUHAVE_X_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
    $theuser .= '<br /><a href="modules.php?name=Profile&amp;mode=editprofile">'._EDIT_PROFILE.'</a> | ';
    $theuser .= '<a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a>';
endif;

/*-----------------*/
/* RD Scripts v1.0 */
/*-----------------*/
addJSToBody(titanium_js_dir.'menu.min.js');

$ads = ads(0);

global $choose, $filename1;
global $ThemeSel, $domain, $screen_res, $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $file_extension, $op;
global $theme_name;

?>
<style type="text/css">
.bookmark
{
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	

}

.boxtitle
{
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	

}

.boxlist
{
    background: url(<?php echo BOOKMARKS_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 	
}

.flames
{
    background: url(<?php echo LOGO_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 
}

table.newblock {
    background: url(<?php echo HEADER_BACKGROUND; ?>);
	<?php echo HEADER_CONTAIN; ?>
}
</style> 
<?
echo '<!-- HEADER START -->';
echo '<style type="text/css">';

echo 'greatminds {';
echo 'font-size:14px;';
echo 'font-weight:bold;';
echo 'font-size-adjust:!important;';   
echo '}';

echo '</style>';

############################################################################
if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript.php'))    #      Added by Ernest Buffington
{                                                                          ###### Load SWF class - used for automaticly displaying *.swf 
  include(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript.php');           #      Jan 1st 2012 
}                                                                          #
############################################################################	

############################################################################
if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/classes/class.swfheader.php'))#      Added by Ernest Buffington
{                                                                          ###### Load SWF class - used for automaticly displaying *.swf 
  include(NUKE_THEMES_DIR.$ThemeSel.'/classes/class.swfheader.php');       #      Jan 1st 2012 
}                                                                          #
############################################################################

global $browser;
$titanium_browser = new Browser();

echo "\n\n<!-- START Header ".$domain.". -->\n\n"; 
    echo '<div class="container" style="width: '.titanium_width.'">';
	echo "\n\n<!-- START Header ".$domain.". -->\n\n";
    echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
    echo "<tr>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"20\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"231\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"19\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"16\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"179\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"43\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"24\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"145\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"73\" height=\"0\"></td>\n";
    echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" width=\"20\" height=\"0\"></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td rowspan=\"5\"><img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_01.png\" width=\"100%\" height=\"198\"></td>\n";
    
	# left logo
	echo "<td valign=\"top\" align=\"center\" width=\"198\" background=\"".HTTPS."themes/".$ThemeSel."/header/smooth_skull.png\" rowspan=\"5\">\n";
	
	echo "</td>\n";

    # this is where you will embed your logo design
	echo "<td valign=\"top\" align=\"center\" rowspan=\"5\" background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_full.png\" width=\"100%\" height=\"198\">";

	//if ($_COOKIE["titanium_resolution_width"] == '1920')
    // if($titanium_browser->getBrowser() == Browser::BROWSER_FIREFOX)
	//if (isset($cookie[1]))

   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/center_top_logo2.png\" border=\"0\" align=\"top\" title=\"The Ghost\"  >";
   echo "</td>";
   echo "<td background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_full.png\" align=\"right\" colspan=6>\n";
   
   if( $titanium_browser->getBrowser() == Browser::BROWSER_IPHONE)
   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/menu_replacement.png\" border=\"0\" align=\"adbsmiddle\" title='' width=\"480\" >";
   else
   if( $titanium_browser->getBrowser() == Browser::BROWSER_IPAD)
   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/menu_replacement.png\" border=\"0\" align=\"adbsmiddle\" title='' width=\"480\" >";
   else
   if( $titanium_browser->getBrowser() == Browser::BROWSER_IPOD)
   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/menu_replacement.png\" border=\"0\" align=\"adbsmiddle\" title='' width=\"480\" >";
   else
   if( $titanium_browser->getBrowser() == Browser::BROWSER_ANDROID)
   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/menu_replacement.png\" border=\"0\" align=\"adbsmiddle\" title='' width=\"480\" >";
   
   if($titanium_browser->getPlatform()== "Windows")
   {                                                        
      if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/swf/menu.swf'))
      {
        ?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,42,34"
        id="menu.swf" width="480" height="50">
        <param name="movie" value="<?=HTTPS?>themes/<?=$ThemeSel?>/swf/menu.swf">
        <param name="bgcolor" value="#CECECE">
        <param name="quality" value="best">
        <param name="wmode" value="direct">
        <param name="allowscriptaccess" value="samedomain">
        <embed type="application/x-shockwave-flash" 
        pluginspage="https://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" 
        name="<?=HTTPS?>themes/<?=$ThemeSel?>/swf/menu.swf" 
        width="480" height="50" 
        src="<?=HTTPS?>themes/<?=$ThemeSel?>/swf/menu.swf" 
        quality="best" 
        wmode="transparent" 
        allowscriptaccess="samedomain">
       </object>     	   
       <?
      }
  
   }
  
   echo "</td>\n";

   echo "<td rowspan=5>\n";
   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_05.png\" width=\"20\" height=\"198\"></td>\n";
   echo "</tr>\n";
   
   # add a top menu bar here if you like or you could broaden the theme design!
   echo "<tr>\n";  
   echo "<td colspan=\"6\" align=\"center\" bgcolor=\"CECECE\" valign=\"middle\" width=\"580\" height=\"75\">";

   # This is where we load the advertising banner in the top right
   # hand corner of the header
   $ads = ads(0); //472x74 banner is all that will fit
   
   if(empty($ads)) 
   {
      echo "<a href=\"index.php\" target=\"_self\">\n";
      echo "<img src=\"".HTTPS."themes/".$ThemeSel."/banners/hacking.png\" border=\"0\" width=\"472\" height=\"74\"></a>";
   }
   else
   echo $ads;

   echo "</td></tr>\n";
   echo "<tr>\n";
   echo "<td colspan=\"6\"><img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_07.png\" width=\"100%\" height=\"9\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td rowspan=\"2\"><img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_08_fix5.png\" width=\"16\" height=\"64\"></td>\n";

   echo "<td background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_search_fix2.png\" width=\"179\" height=\"31\">";
   echo "<div class=\"monitor\" align=\"left\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"2\" height=\"2\" border=\"0\" /><strong><font size=\"1\"class=\"small\" color=\"white\">Monitor Resolution: ".$_COOKIE["theme_resolution"]."</strong><font></div>";
   echo "</td>";
   echo "<td background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_s2_fix2.png\" width=\"43\" height=\"31\">";
   echo "</td>";
   echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_11_fix.png\" width=\"24\" height=\"31\"></td>";
   echo "<td colspan=2 background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_time.png\" width=\"218\" height=\"31\">\n";
   
   
   # START load the clock that is on the top right hand side of the header!
   echo "<a href=\"javascript:clear_cache.submit()\">\n";
   echo "<script language=\"javascript\">\n";
   echo "<!--\n";
   echo "new LiveClock('Tahoma','1','#FFFFFF','#','<b>Time : ','</b>','174','1','1','0','2','null');\n"; 
   echo "//-->\n";
   echo "</script>\n";
   echo "</a>\n";
   # END load the clock that is on the top right hand side of the header!
   
   echo "</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td valign=middle colspan=\"4\" background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_user.png\" width=\"391\" height=\"33\">";
   
   echo "</td><td><img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_u2.png\" width=\"73\" height=\"33\"></td>\n";
   echo "</tr>\n";
   echo "</table>\n"; 

#################################################################################################################################################
#  style="width: 98px; height: 29px;"';                                                                                                         #
//echo '<div class="flex-item"><img src="'.titanium_hdr_images.'HDRnav_01.png" style="width: 98px; height: 29px;"></div>';                     # Left End Piece
//echo '<div class="flex-item" style="width: 100%; height: 29px; background-image: url('.titanium_hdr_images.'HDRnav_Bg_Stretch.png)">';       #
//include(titanium_theme_dir.'HDRnavi.php');                                                                                                   #
//echo '</div>';                                                                                                                                  #
//echo '<div class="flex-item"><img src="'.titanium_hdr_images.'HDRnav_03.png" style="width: 98px; height: 29px;"></div>';                     # Right End Piece
echo '</section>';                                                                                                                              #
#################################################################################################################################################
echo '</header>';

# START this is the fucking left page border
echo "<table style=\"background: #cecece;\" cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" height=\"5\">\n";
   echo "<img height=\"5\" src=\"".HTTPS."themes/".$ThemeSel."/header/ltbg.png\" width=\"20\"></td>\n";
   echo "<td width=\"20\" height=\"5\">\n";
   echo "<img height=\"5\" src=\"".HTTPS."themes/".$ThemeSel."/header/rtbg.png\" width=\"20\"></td>\n";
   echo "</tr>\n";
   echo "</table>\n";

   echo "<table style=\"background: #cecece;\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
   echo "<tr valign=\"top\">\n";
   echo "<td width=\"20\" valign=\"top\" background=\"".HTTPS."themes/".$ThemeSel."/sides/leftbg.png\">\n";
   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/sides/leftbg.png\" width=\"20\" height=\"15\" border=\"0\">";
   echo "</td>\n";
   echo "<td width=\"20\">\n";
# END this is the fucking left page border


if(blocks_visible('left')) 
{
		global $op, $file;

	    if (($op =="info") or ($op =="newsletter") or ($op =="messages"))
		{
            
		}
		else
		{
            echo "\n\n<!-- START Left Blocks ".$domain.". -->\n\n";  
			blocks('left'); 
            echo "\n\n<!-- END Left Blocks ".$domain.". -->\n\n"; 
		}
    } 
	else 
	{

    }
	
   # this controls the gap between the left block and the left side of the center table!!!
    echo "</td>\n"
    	."<td><img src=\"".HTTPS."themes/".$ThemeSel."/images/spacer.png\" width=\"7\" height=\"0\" border=\"0\" ></td>\n"
    	."<td width=\"100%\">\n";

	echo "<meta name=\"header-end\">";
    echo "\n\n<!-- END Header ".$domain.". -->\n\n"; 	
?>