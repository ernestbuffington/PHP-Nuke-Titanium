<?php
#########################################################################
# Titanium cPanel Login v2.0                                            #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
#########################################################################
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
        $mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
        $mode = '';
}
//
// Generate page
//
global $module_name;
if(!isset($module_name) || empty($module_name)){
    $module_name = basename(dirname(__FILE__));
}
get_lang($module_name);

global $domain;
$titanium_title = 'cPanel Login';
$pagetitle = 'http://'.$domain.' &raquo; '.$titanium_title;

include(NUKE_BASE_DIR.'header.php');

OpenTable();

echo '<div align="center"><strong>'.$titanium_title.'</strong></div>';
$postlocation = "modules.php?name=cPanel_Login&amp;file=docpanellogin";
print "<form action=\"" . $postlocation . "\" method=\"POST\">";
if (($_GET['failed'] == "1") or ($error == 1))
{
  echo "<font color=#FF0000 face=verdana size=1>Your login attempt failed!</font><br>";
}
global $textcolor1, $textcolor2;
$icon = img('computer.png', 'cPanel_Login'); 
?>
<script type="text/javascript">
<!--
function hov(loc,cls){
   if(loc.className)
      loc.className=cls;}
//--></script>

<font color='<?=$textcolor2?>' size='3'><img src='<?=$icon?>' width='25' align='absbottom' border='0'><b> <?=$domain?></b></font>
<input name="domain" class="input2" type="hidden" value="<?=$domain?>" style="width:110;height:18;font-family:Verdana; font-size:8pt" size="100" /><br />
<font face="Verdana" size="2"><br /><strong>cPanel Username »</strong></font>
<input name="username" class="input2" type="text" value="" style="width:110;height:18;font-family:Verdana; font-size:8pt" size="20" />
<font face="Verdana" size="2"><br /><br /><strong>cPanel Password »</strong> </font>
<input name="pass" class="input2" type="password" value="" style="width:110;height:18;font-family:Verdana; font-size:8pt" size="20" />
<?php
print "<input type=hidden name=\"failurl\" value=\"http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?failed=1\">";
?>
<br /><br /><font face="Verdana" size="2">&nbsp;<strong>Options »</strong> </font>
<select name="login_option" style="font-family: Verdana; font-size: 8pt;width:110;height:18">
<option value="2082">cPanel </option>
<option value="2083">Secure cPanel </option>
<option value="2086">WHM</option>
<option value="2087">Secure WHM</option>
<option value="2095">Webmail</option>
<option value="2096">Secure Webmail</option>
</select>
<input class="button" type="submit" value=" Click to Login " style="width:100;height:20;font-family:Verdana; font-size:8pt" onmouseover="hov(this,'button btnhov')" onmouseout="hov(this,'button')"  />
</form>
<?php 
echo '<br /><br /><br /><br /><br />';
CloseTable();

include(NUKE_BASE_DIR.'footer.php');
?>