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
if (!defined('ADMIN_FILE')) {
    die ('Access Denied!');
}
switch($op) 
{
    case 'discord':
	case 'discordinstall':
	case 'discordinstall2':
    case "discordsave":
	case "discordreset":
    include('admin/modules/discord.php');
    break;
}

?>
