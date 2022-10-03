<?php
if(defined('NUKE_EVO')) return;
define('NO_DISABLE', true);

define('ROOT', dirname(dirname(__FILE__)) . '/');
require_once(ROOT.'mainfile.php');
//error_reporting(0);
require_once(NUKE_CLASSES_DIR.'class.php-captcha.php');
define('FONTS', NUKE_INCLUDE_DIR.'fonts/');

if ($handle = opendir(FONTS)) {
    while (FALSE !== ($file = readdir($handle))) {
        if ($file !== "." && $file != "..") {
            $aFonts[] = FONTS.$file;
        }
    }
}

$size = (isset($_GET['size'])) ? $_GET['size'] : 'normal';

switch ($size) {
    case 'normal':
        $width = 140;
        $height = 60;
        $length = 5;
    break;
    case 'large':
        $width = 200;
        $height = 60;
        $length = 6;
    break;
    case 'small':
        $width = 100;
        $height = 30;
        $length = 4;
    break;
}

$file = (isset($_GET['file'])) ? $_GET['file'] : '';
//Look for invalid crap
if (preg_match("/[^\w_\-]/i",$file)) {
    die();
}

if (!is_array($aFonts)) {
    die('Fonts Not Found');
}
global $nukeurl, $capfile;
$oVisualCaptcha = new PhpCaptcha($aFonts, $width, $height);
$oVisualCaptcha->SetNumChars($length);
if ($size != 'small') {
    $oVisualCaptcha->SetOwnerText(str_replace('http://', '', $nukeurl));
}
if (!empty($file) && $file != 'default') {
    if (file_exists(dirname(__FILE__).'/captcha/'.$file.'.jpg')) {
        $oVisualCaptcha->SetBackgroundImages('captcha/'.$file.'.jpg');
    }
} else if (!empty($capfile) && $file != 'default') {
    if (file_exists(dirname(__FILE__).'/captcha/'.$capfile.'.jpg')) {
        $oVisualCaptcha->SetBackgroundImages('captcha/'.$capfile.'.jpg');
    }
}

$oVisualCaptcha->Create();

?>