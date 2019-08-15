<?php
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 coRpSE			                                */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('BLOCK_FILE') )
	header("Location: ../index.php");

global $db, $prefix, $admin_file, $blockslang;

list($total_bots) = $db->sql_ufetchrow("SELECT COUNT(id) FROM `".$prefix."_honeypot`");

$content .= '<div class="acenter">';

if ( $side == 'c' || $side == 'd' ):
	$content .= '  <img src="images/honeypot/hp_banner.png" style="height: 110px; width: 369px" alt="'.$blockslang['honeypot']['bots_in_pot'].'" title="'.$blockslang['honeypot']['bots_in_pot'].'" />';
else:
	$content .= '  <img src="images/honeypot/hp_banner2.png" style="height: 109px; width: 120px" alt="'.$blockslang['honeypot']['bots_in_pot'].'" title="'.$blockslang['honeypot']['bots_in_pot'].'" />';
endif;

$total_bots = (is_admin()) ? '<a href="'.$admin_file.'.php?op=honeypot">'.$total_bots.'</a>' : $total_bots;

$content .= '  <hr noshade="noshade" /><div class="acenter">'.sprintf($blockslang['honeypot']['bots_stopped'],'<span class="textbold">',$total_bots,'</span>').'</div>';
$content .= '  <hr noshade="noshade" /><div class="acenter"><a href="https://www.headshotdomain.net" target="_blank">HeadShotDomain</a></div>';
$content .= '</div>';

?>