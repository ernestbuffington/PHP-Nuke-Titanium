<?php

/**
*****************************************************************************************
** PHP-Nuke Titanium v4.0.4 - Project Start Date 11/04/2022 Friday 4:09 am             **
*****************************************************************************************
** https://www.php-nuke-titanium.86it.us
** https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4
** https://www.php-nuke-titanium.86it.us/index.php (DEMO)
** Apache License, Version 2.0. MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File steps/6.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

require_once(SETUP_INCLUDE_DIR."configdata.php");
require_once(SETUP_UDL_DIR."database.php");
$db = new sql_db($db_host, $db_user, $db_pass, $db_name, $db_persistency);

    $_SESSION['dbhost'] = $db_host;
    $_SESSION['dbuser'] = $db_user;
    $_SESSION['dbpass'] = $db_pass;
    $_SESSION['dbname'] = $db_name;
    $_SESSION['dbtype'] = $db_type;
    $_SESSION['user_prefix'] = $db_prefix;
	$_SESSION['prefix'] = $db_prefix;
	
	global $step, $next_step, $install_lang, $server_check, $db_host, $db_user, $db_pass, $db_name, $db_prefix, $db_persistency;

echo '<form action="" method="post">';
	echo '<div align="center"><div style="color:white;"><strong>'.$nuke_name.' '.$install_lang['installer_heading'].' '.$step.' '.$install_lang['installer_heading2'].' '.$total_steps.'</strong></div></div>';
	echo '<fieldset><legend><div style="color:green;">'.$install_lang['chmod_check'].'</div></legend>';
	echo '<div style="text-align: left;">';
	echo chmod_files();
	echo '</div>';
	echo '</fieldset>';
	echo '<div align="center">'.$continue_button.'</div>';
    echo '</form>';
?>
