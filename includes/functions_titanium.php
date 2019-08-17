<?php
/*=======================================================================
PHP-Nuke Titnaium v3.0.0 : Enhanced PHP-Nuke Web Portal System
=======================================================================*/

/************************************************************************
PHP-Nuke Titnaium : Evolution Functions
============================================
Copyright (c) 2005 by The PHP-Nuke Titanium Team

Filename      : functions_titnaium.php
Author        : The PHP-Nuke Titanium Team
Version       : 1.0.0
Date          : 08.16.2019 (mm.dd.yyyy)

Notes         : Miscellaneous functions
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function img_tag_to_resize($text) {
    global $img_resize;
    if(!$img_resize) return $text;
    if(empty($text)) return $text;
    if(preg_match('/<NO RESIZE>/',$text)) {
        $text = str_replace('<NO RESIZE>', '', $text);
        return $text;
    }
    $text = preg_replace('/<\s*?img/',"<div class=\"reimg-loading\"></div><img class=\"reimg\" onload=\"reimg(this);\" onerror=\"reimg(this);\" ",$text);
    return $text;
}

function titanium_site_up($url) {
    //Set the address
    $address = parse_url($url);
    $host = $address['host'];
    if (!($ip = @gethostbyname($host))) return false;
    if (@fsockopen($host, 80, $errno, $errdesc, 10) === false) return false;
    return true;
}
?>
