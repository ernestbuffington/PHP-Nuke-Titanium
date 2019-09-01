<?php
/*---------------------------------------------------------------------------------------*/
/* THEME INFO                                                                            */
/* Kinon Theme v1.0 (Fixed & Full Width)                                           */
/*                                                                                       */
/* A Very Nice Black Carbin Fiber Styled Design.                                         */
/* Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington                              */
/* e-Mail : ernest.buffington@gmail.com                                                  */
/*---------------------------------------------------------------------------------------*/
/* CREATION INFO                                                                         */
/* Created On: 1st August, 2019 (v1.0)                                                   */
/*                                                                                       */
/* Updated On: 1st August, 2019 (v3.0)                                                   */
/* HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)                          */
/*                                                                                       */
/* Read CHANGELOG File for Updates & Upgrades Info                                       */
/*                                                                                       */
/* Designed By: TheGhost                                                                 */
/* Web Site: https://theghost.86it.us                                                    */
/* Purpose: PHP-Nuke Evolution | Kinon Edition                                        */
/*---------------------------------------------------------------------------------------*/
/* CMS INFO                                                                              */
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi phpnuke.org                            */
/* Nuke-Evolution | Xtremem | Ttianium Editon : Enhanced PHP-Nuke Web Portal System      */
/*---------------------------------------------------------------------------------------*/

/*-----------------------------*/
/* Kinon Header Section        */
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
addJSToBody(kinon_js_dir.'menu.min.js');

$ads = ads(0);

//echo '<div class="container" style="width: '.kinon_width.'">'
//
//    .'<header>'
//
//    .'<section id="flex-container">'
//    .'  <div class="flex-item"><img src="'.kinon_hdr_images.'HDR_01.png" style="width: 37px; height: 150px;"></div>'
//    .'  <div class="flex-item" style="width: 100%; height: 150px; background-image: url('.kinon_hdr_images.'HDR_BgRepeat.png)"><div class="wrapLogo">&nbsp;</div><div id="hdr-banner-ads">'.$ads.'</div></div>'
//    .'  <div class="flex-item"><img src="'.kinon_hdr_images.'HDR_03.png" style="width: 37px; height: 150px;"></div>'
//    .'</section>'
//
//    .'<section id="flex-container">'
//    .'  <div class="flex-item"><img src="'.kinon_hdr_images.'HDRbartop_01.png" style="width: 114px; height: 9px;"></div>'
//    .'  <div class="flex-item" style="width: 100%; height: 9px; background-image: url('.kinon_hdr_images.'HDRbartop_Bg_Stretch.png)"></div>'
//    .'  <div class="flex-item"><img src="'.kinon_hdr_images.'HDRbartop_03.png" style="width: 114px; height: 9px;"></div>'
//    .'</section>'
//
//    .'<section id="flex-container">'
//    .'  <div class="flex-item"><img src="'.kinon_hdr_images.'HDRnav_01.png" style="width: 98px; height: 29px;"></div>' #  style="width: 98px; height: 29px;"
//    .'  <div class="flex-item" style="width: 100%; height: 29px; background-image: url('.kinon_hdr_images.'HDRnav_Bg_Stretch.png)">';
//include(kinon_theme_dir.'HDRnavi.php');
//echo '  </div>'
//    .'  <div class="flex-item"><img src="'.kinon_hdr_images.'HDRnav_03.png" style="width: 98px; height: 29px;"></div>'
//    .'</section>'

//    .'<section id="flex-container">'
//    .'  <div class="welcomebg"><div style="padding-top: 23px;">'.$username.'</div></div>'
//    .'  <div style="width: 100%; height: 60px; background-image: url('.kinon_hdr_images.'Usernav_Bg_Stretch.png)">'
//    .'    <div class="bviewed center">Best Viewed w/Minimum Screen Resolution of 1368px or Higher!</div>'
//    .'  </div>'
//    .'  <div class="userlinksbg">'
//    .'    <div style="padding-top:5px; padding-left:98px;">'.$theuser.'</div>'
//    .'  </div>'
//    .'</section>'

//    .'  </header>'
//
//    .'<section id="flex-container">'
//    .'  <div style="background-image: url('.kinon_images_dir.'sideleft.png); vertical-align: top"><img src="'.kinon_images_dir.'spacer.gif" style="width: 40px; height: 5px" alt=""></div>';
   global $choose, $filename1;
   global $ThemeSel, $domain, $screen_res, $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $file_extension, $op;
   
   //carbon fiber background
   //$filename1 = 'header_background2.png';
   
   //another carbon fiber background
   // $filename1 = 'header_2028.png';

   //cool flickerin green background with lights
   //$filename1 = 'light_long_hallway.gif';    
   
   //cool light with grey background flikering on and off
   //$filename1 = 'blink182.gif';
   
   //anotheranimated green shakey walking background
   //$filename1 = 'shakey.gif';
   
   //lotsa purple and orange fire like 
   //$filename1 = 'tubefire.png';
   
   $choose = '23';
   
   switch ($choose)
   {
   case 1:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center bottom'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 2:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center bottom'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 3:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center bottom'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 4:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 5:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 6:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 7:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 8:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 9:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 10:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 11:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 12:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 13:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 14:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 15:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 16:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 17:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 18:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 19:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 20:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 21:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 22:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 23:
   //$filename1 = 'flaming-sky.png';
   //$filename1 = 'exact_match_dark_red.png';
   
   $filename1 = 'black_glass_flames.png'; 
   //$filename1 = 'red_glass.png';
   //$filename1 = 'aluminum5.png';
   
   
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"'); 
   define('CONTAIN', 'background-repeat: no-repeat;
                      background-position: CENTER CENTER; 
					  width 100%;
					  height 115px;
					  opacity: 100;
					  visibility: inherit;
					  z-index: 20;
					  background-size: cover;');
   break;
   case 0:
   //How to position a background-image to be centered at top:
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CONTAIN', 'background-repeat: no-repeat;
                      background-attachment: fixed; 
	                  background-position: center top;');
   break;
   default:
   //make background-image responsive after resize windows with specific width: 
   define('LOGO_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/'.$filename1.'"');
   define('CONTAIN', 'background-repeat: no-repeat;
                      background-position: center center;
					  background-size: cover;');
   break;

}

   define('HEADER_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/1680x1050b.png"');
   define('HEADER_CONTAIN', 'background-repeat: no-repeat;
                      background-position: CENTER CENTER; 
					  width 100%;
					  height 115px;
					  opacity: 100;
					  visibility: inherit;
					  z-index: 20;
					  background-size: cover;');
					  
					  
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('BOOKMARKS_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/blackbar.png"'); 
   define('BOOKMARKS_CONTAIN', 'background-repeat: no-repeat;
                      background-position: CENTER CENTER; 
					  width 100%;
					  height 115px;
					  opacity: 100;
					  visibility: inherit;
					  z-index: 20;
					  background-size: cover;');
					  

   define('BOOKMARKS_TITLE_BACKGROUND', '"themes/'.$theme_name.'/images/backgrounds/newredbar.png"'); 
   define('BOOKMARKS_TITLE_CONTAIN', 'background-repeat: no-repeat;
                      background-position: CENTER CENTER; 
					  width 100%;
					  height 115px;
					  opacity: 100;
					  visibility: inherit;
					  z-index: 20;
					  background-size: cover;');

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
###############################################################################################################################################################################
//echo '<section id="flex-container">';
###############################################################################################################################################################################
//echo '<div class="container" style="width: '.kinon_width.'">';
//echo '<header>';
###############################################################################################################################################################################
//echo '<table class="zeroblock" border="0" width="100%" cellspacing="0" cellpadding="0">';
###############################################################################################################################################################################
//echo '<tr>';
//echo '<td>';
###############################################################################################################################################################################
    echo '<div class="container" style="width: '.kinon_width.'">';
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
    
	//left logo
	echo "<td valign=\"top\" align=\"center\" width=\"198\" background=\"".HTTPS."themes/".$ThemeSel."/header/smooth_skull.png\" rowspan=\"5\">\n";
	
	echo "</td>\n";

    // this is where you will embed your logo design
	echo "<td valign=\"top\" align=\"center\" rowspan=\"5\" background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_full.png\" width=\"100%\" height=\"198\">";

	//if ($_COOKIE["kinon_resolution_width"] == '1920')
      // if($titanium_browser->getBrowser() == Browser::BROWSER_FIREFOX)
	//if (isset($cookie[1]))

	//if (!isset($cookie[1]))
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
   
   // add a top menu bar here if you like or you could broaden the theme design!
   echo "<tr>\n";  
   echo "<td colspan=\"6\" align=\"center\" bgcolor=\"CECECE\" valign=\"middle\" width=\"580\" height=\"75\">";

   // This is where we load the advertising banner in the top right
   // hand corner of the header
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

   #############################################################################################################################################
   #  //Blog Search enabled // Blog search - uncomment the one you would like to use
   #############################################################################################################################################   
   //Blog Search enabled
   echo "<td background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_search_fix2.png\" width=\"179\" height=\"31\">";
   echo "<div class=\"monitor\" align=\"left\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"2\" height=\"2\" border=\"0\" /><strong><font size=\"1\"class=\"small\" color=\"white\">Monitor Resolution: ".$_COOKIE["theme_resolution"]."</strong><font></div>";
   //echo "<form action=\"".HTTPS."modules.php?op=modload&amp;name=Blog_Search&amp;file=index\" method=\"post\">";
   //echo "<input class=\"select\" type=\"text\" name=\"query\" value style=\"width:140;height:18;FONT-SIZE:10px;color:#000000;\" size=\"38\">";
   echo "</td>";
   echo "<td background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_s2_fix2.png\" width=\"43\" height=\"31\">";
   //echo "<input class=\"button\" type=\"submit\" value=\"GO\" border=\"0\" width=\"19\" height=\"15\">";
   echo "</td>";
   //echo "</form>";
   echo "<td><img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_11_fix.png\" width=\"24\" height=\"31\"></td>";
   echo "<td colspan=2 background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_time.png\" width=\"218\" height=\"31\">\n";
   
   
   //load the clock that is on the top right hand side of the header!
   echo "<a href=\"javascript:clear_cache.submit()\">\n";
   echo "<script language=\"javascript\">\n";
   echo "<!--\n";
   echo "new LiveClock('Tahoma','1','#FFFFFF','#','<b>Time : ','</b>','174','1','1','0','2','null');\n"; 
   echo "//-->\n";
   echo "</script>\n";
   echo "</a>\n";
   //load the clock that is on the top right hand side of the header!
   
   echo "</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td valign=middle colspan=\"4\" background=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_user.png\" width=\"391\" height=\"33\">";
   
   echo "</td><td><img src=\"".HTTPS."themes/".$ThemeSel."/header/nukestyle-hd_u2.png\" width=\"73\" height=\"33\"></td>\n";
   echo "</tr>\n";
   echo "</table>\n"; 

#################################################################################################################################################
#  style="width: 98px; height: 29px;"';                                                                                                         #
//echo '<div class="flex-item"><img src="'.kinon_hdr_images.'HDRnav_01.png" style="width: 98px; height: 29px;"></div>';                     # Left End Piece
//echo '<div class="flex-item" style="width: 100%; height: 29px; background-image: url('.kinon_hdr_images.'HDRnav_Bg_Stretch.png)">';       #
//include(kinon_theme_dir.'HDRnavi.php');                                                                                                   #
//echo '</div>';                                                                                                                                  #
//echo '<div class="flex-item"><img src="'.kinon_hdr_images.'HDRnav_03.png" style="width: 98px; height: 29px;"></div>';                     # Right End Piece
echo '</section>';                                                                                                                              #
#################################################################################################################################################
echo '</header>';

//this is the fucking left page border
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
//this is the fucking left page border


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
	
   //this controls the gap between the left block and the left side of the center table!!!
    echo "</td>\n"
    	."<td><img src=\"".HTTPS."themes/".$ThemeSel."/images/spacer.png\" width=\"7\" height=\"0\" border=\"0\" ></td>\n"
    	."<td width=\"100%\">\n";

	echo "<meta name=\"header-end\">";
    echo "\n\n<!-- END Header ".$domain.". -->\n\n"; 	
?>