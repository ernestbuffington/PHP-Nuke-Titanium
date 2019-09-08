<?php

/* -- -----------------------------------------------------------
 * // Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 * -- -----------------------------------------------------------
 *
 * >> Database
 *
 * @filename    db.php
 * @author      The phpBB Group
 * @version     1.11
 * @date        Nov 24, 2011
 * @notes       n/a
 *
 * -- -----------------------------------------------------------
 * // Legal Stuff
 * -- -----------------------------------------------------------
 *
 * (c) Copyright 2001 The phpBB Group
 * support@phpbb.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 */

if (!defined('NUKE_EVO') || isset($_REQUEST['dbtype'])) {
    die('Quit trying to hack my website!');
}

if (!isset($dbtype)) {
    $dbtype = 'mysql';
}

$dbtype = strtolower($dbtype);

if (file_exists(NUKE_DB_DIR . $dbtype . '.php')) {
    require_once(NUKE_DB_DIR . $dbtype . '.php');
} else {
    die('Invalid Database Type Specified!');
}

if (!isset($db)) {
    $db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);
}

if (!$db->db_connect_id) {
    exit("<br /><br /><div align='center'><img src='images/logo.gif'><br /><br /><strong>There seems to be a problem with the MySQL server, sorry for the inconvenience.<br /><br />We should be back shortly.</strong></div>");
}

if ($dbtype == 'mysql') {
    if (version_compare($db->mysql_version, '4.1.0', '<')) {
        exit("<br /><br /><div align='center'><img src='images/logo.gif'><br /><br /><strong>We are sorry but the the MySQL version you are attempting to use is to old and is not supported by Nuke-Evolution nor by MySQL.com any more.<br /><br />Please ask your host to upgrade or switch hosts.</div>");
    }

    $db->set_charset();
}