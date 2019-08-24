<?php
#########################################################################
# Titanium facebook SandBox v2.0                                        #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               ####################### <start>
#########################################################################
#                                                                       #
#########################################################################
if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); }

require_once("facebook.php");

$config = array();
$config['appId'] = $facebookappid;
$config['secret'] = $facebookappsecret;
$config['fileUpload'] = false; // optional

$facebook = new Facebook($config);
?> 
