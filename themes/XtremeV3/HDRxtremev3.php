<?php

/*--------------------------*/
/* XtremeV3 Header Section  */
/*--------------------------*/
/* Fixed & Full Width Style */
/*--------------------------*/

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
addJSToBody(xtremev3_js_dir.'menu.min.js');

$ads = ads(0);

echo '<div class="container" style="width: '.xtremev3_width.'">'

    .'<header>'

    .'<section id="flex-container">'
    .'  <div class="flex-item"><img src="'.xtremev3_hdr_images.'HDR_01.png" style="width: 37px; height: 150px;"></div>'
    .'  <div class="flex-item" style="width: 100%; height: 150px; background-image: url('.xtremev3_hdr_images.'HDR_BgRepeat.png)"><div class="wrapLogo">&nbsp;</div><div id="hdr-banner-ads">'.$ads.'</div></div>'
    .'  <div class="flex-item"><img src="'.xtremev3_hdr_images.'HDR_03.png" style="width: 37px; height: 150px;"></div>'
    .'</section>'

    .'<section id="flex-container">'
    .'  <div class="flex-item"><img src="'.xtremev3_hdr_images.'HDRbartop_01.png" style="width: 114px; height: 9px;"></div>'
    .'  <div class="flex-item" style="width: 100%; height: 9px; background-image: url('.xtremev3_hdr_images.'HDRbartop_Bg_Stretch.png)"></div>'
    .'  <div class="flex-item"><img src="'.xtremev3_hdr_images.'HDRbartop_03.png" style="width: 114px; height: 9px;"></div>'
    .'</section>'

    .'<section id="flex-container">'
    .'  <div class="flex-item"><img src="'.xtremev3_hdr_images.'HDRnav_01.png" style="width: 98px; height: 29px;"></div>' #  style="width: 98px; height: 29px;"
    .'  <div class="flex-item" style="width: 100%; height: 29px; background-image: url('.xtremev3_hdr_images.'HDRnav_Bg_Stretch.png)">';
include(xtremev3_theme_dir.'HDRnavi.php');
echo '  </div>'
    .'  <div class="flex-item"><img src="'.xtremev3_hdr_images.'HDRnav_03.png" style="width: 98px; height: 29px;"></div>'
    .'</section>'

    .'<section id="flex-container">'
    .'  <div class="welcomebg"><div style="padding-top: 23px;">'.$username.'</div></div>'
    .'  <div style="width: 100%; height: 60px; background-image: url('.xtremev3_hdr_images.'Usernav_Bg_Stretch.png)">'
    .'    <div class="bviewed center">Best Viewed w/Minimum Screen Resolution of 1368px or Higher!</div>'
    .'  </div>'
    .'  <div class="userlinksbg">'
    .'    <div style="padding-top:5px; padding-left:98px;">'.$theuser.'</div>'
    .'  </div>'
    .'</section>'

    .'  </header>'

    .'<section id="flex-container">'
    .'  <div style="background-image: url('.xtremev3_images_dir.'sideleft.png); vertical-align: top"><img src="'.xtremev3_images_dir.'spacer.gif" style="width: 40px; height: 5px" alt=""></div>';

if(blocks_visible('left')):

    echo'  <div class="body-background" style="vertical-align: top;">';
    blocks('left');
    echo '  </div>'
        .'  <div class="body-background" style="vertical-align: top;"><img src="'.xtremev3_images_dir.'spacer.gif" style="width: 5px; height: 1px" border="0" alt=""></div>'
        .'  <div class="body-background" style="width: 100%">';

else:

    echo '  <div class="body-background2" style="vertical-align: top;"></div>'
        .'  <div class="body-background" style="width: 100%">';
    
endif;

?>