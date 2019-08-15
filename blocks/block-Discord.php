<?php
/************************************************************************/
/* Discord Block				                                        */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2003 - 2018 coRpSE	                                    */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
}
if (!defined('PHP_EOL')) define ('PHP_EOL', strtoupper(substr(PHP_OS,0,3) == 'WIN') ? "\r\n" : "\n");
$dis_center = ($side == 'c' || $side == 'd') ? "0" : "1";
$blockstyle = ($dis_center == 1) ? 'width:165px; height:515px;' : 'width:810px; height:455px;';
	
$content = '<div style="text-align:center;">' . PHP_EOL
		 . '<iframe src="./includes/blocks/block-discord.php?'.$dis_center .'" style="'.$blockstyle.' border: 0px; overflow:hidden; padding-top:15px;"></iframe>' . PHP_EOL
		 . '</div>' . PHP_EOL;

?>