<?php 
/*========================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 ========================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}

global $flash_background_color, 
                       $chrome, 
					  $myappid, 
					     $user, 
					   $cookie, 
					   $prefix, 
					  $sitekey, 
					       $db, 
						 $name, 
					  $banners, 
				   $theme_name, 
				      $_SERVER, 
			  $HTTP_USER_AGENT, 
			 $HTTP_SERVER_VARS, 
			          $browser, 
			   $file_extension;

/////////////////////////////////////////////////////////////////////////////////
// Network Resolution Mod //start
/////////////////////////////////////////////////////////////////////////////////
if(!isset($_COOKIE["theme_resolution"]))
{
?>
<script language="javascript">
<!--
writeCookie();
      
function writeCookie() 
{
  var today = new Date();
  var the_date = new Date("June 16, 2023");
  var the_cookie_date = the_date.toGMTString();
  var the_cookie = "theme_resolution="+ screen.width +"x"+ screen.height +"x"+ screen.colorDepth;
  var the_cookie = the_cookie + ";expires=" + the_cookie_date;
  document.cookie=the_cookie;
}
//-->
</script>
<?php
} 
else 
{ 
  $theme["theme_res"] = $_COOKIE["theme_resolution"]; 
}

if(!isset($_COOKIE["titanium_resolution"])) 
{
?>
<script language="javascript">
<!--
function writeCookie() 
{

  var today = new Date();
  var the_date = new Date("December 31, 2023");
  var the_cookie_date = the_date.toGMTString();
  var the_cookie = "titanium_resolution="+ screen.width +"x"+ screen.height;
  var the_cookie = the_cookie + ";expires=" + the_cookie_date;
  document.cookie=the_cookie
}
writeCookie();
//-->
</script>
<?
global $screen_res, $screen_width, $screen_height;

$screen_res = $_COOKIE["titanium_resolution"];
$screen_res_tmp = explode("x", $screen_res);
$screen_width = $screen_res_tmp[0];
$screen_height = $screen_res_tmp[1];
$_COOKIE["titanium_resolution_width"] = $screen_width;
$_COOKIE["titanium_resolution_height"] = $screen_height;

$url = $_SERVER['REQUEST_URI'];
echo "<meta http-equiv='refresh' content='0;URL=$url'>";
}
else 
{ 
global $screen_res, $screen_width, $screen_height;

$screen_res = $_COOKIE["titanium_resolution"];
$screen_res_tmp = explode("x", $screen_res);
$screen_width = $screen_res_tmp[0];
$screen_height = $screen_res_tmp[1];
$_COOKIE["titanium_resolution_width"] = $screen_width;
$_COOKIE["titanium_resolution_height"] = $screen_height;
}
/////////////////////////////////////////////////////////
// Network Resolution Mod //end
/////////////////////////////////////////////////////////

global $network_vistors_table, 
       $facebook_plugin_width,
     $admin_icon_image_height, 
   $survey_blocks_table_width, 
      $admin_icon_table_width, 
	             $avatarwidth, 
	 $main_blocks_table_width, 
	            $blocks_width, 
				  $innertitle;

/*=======================================================================
 PHP-Nuke Titanium Network : blocks-Portal_Menu.php
 =======================================================================*/
$survey_blocks_table_width = '';
/*======================================================================*/
$flash_background_color = '#cecece';
$innertitle = "#CC0000";

$admin_icon_image_height="100%";
$admin_icon_table_width="10%";

$avatarwidth = "150";

$main_blocks_table_width = "274";
$blocks_width = "176";
$facebook_plugin_width = "100%";


//320x568 normal

//TESTED ERNIE
if ($screen_width == "1280")
{
  $admin_icon_image_height="50%";
  $admin_icon_table_width="10%";
  $facebook_plugin_width = "640";
  $avatarwidth = "150";
  $main_blocks_table_width = "169";
  $blocks_width = "177";
}

//TESTED
if ($screen_width == "1360")
{
  $admin_icon_image_height="50%";    // image hight of admin icons
  $admin_icon_table_width="10%";     // admin icons table widths
  $facebook_plugin_width = "640";    // standard plugin width is 640 but you can go higher with resoultion of you like
  $avatarwidth = "150";              // avatar width resize
  $main_blocks_table_width = "225";  // width of the side blocks in blogs article & music article
  $blocks_width = "100";             // width of the main blocks on the index
  $network_vistors_table = ""; 
}


// MY CELL PHONE
if ($screen_width == "360")
{
  $facebook_plugin_width = "100%";
  $avatarwidth = "150";
  $main_blocks_table_width = "274";
  $blocks_width = "176";
}

// DADS TV
if ($screen_width == "1421")
{
  $facebook_plugin_width = "640";
  $avatarwidth = "150";
  $main_blocks_table_width = "274";
  $blocks_width = "176";
}


// DADS LAPTOP
if ($screen_width == "1537")
{
  $facebook_plugin_width = "640";
  $avatarwidth = "150";
  $main_blocks_table_width = "274";
  $blocks_width = "176";
}


//TESTED
if ($screen_width == "1680")
{
  $facebook_plugin_width = "640";
  $avatarwidth = "150";
  $main_blocks_table_width = "274";
  $blocks_width = "176";
}

//TESTED LORI
if ($screen_width == "1366")
{
  $facebook_plugin_width = "640";
  $avatarwidth = "150";
  $main_blocks_table_width = "274";
  $blocks_width = "176";
}

//TESTED ERNIE WORKING
if ($screen_width == "1920")
{
  $admin_icon_image_height="100";
  $admin_icon_table_width="10%";
  $facebook_plugin_width = "800";  
  $avatarwidth = "150";
  $main_blocks_table_width = "274";
  $blocks_width = "176";
}
?>