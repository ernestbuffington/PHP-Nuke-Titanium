<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                          functions_validate.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: functions_validate.php,v 1.6.2.13 2005/07/19 20:01:15 acydburn Exp
 *
 ***************************************************************************/

/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
***************************************************************************/

/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Custom mass PM                           v1.4.7       07/04/2005
 ************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

//
// Check to see if the username has been taken, or if it is disallowed.
// Also checks if it includes the " character, which we don't allow in usernames.
// Used for registering, changing names, and posting anonymously with a username
//
function validate_username($titanium_username)
{
        global $titanium_db, $titanium_lang, $userdata;

        // Remove doubled up spaces
        $titanium_username = preg_replace('#\s+#', ' ', trim($titanium_username));
        $titanium_username = phpbb_clean_username($titanium_username);

    $sql = "SELECT username
        FROM " . USERS_TABLE . "
                WHERE LOWER(username) = '" . strtolower($titanium_username) . "'";
        if ($result = $titanium_db->sql_query($sql))
        {
                while ($row = $titanium_db->sql_fetchrow($result))
                {
                        if (($userdata['session_logged_in'] && $row['username'] != $userdata['username']) || !$userdata['session_logged_in'])
                        {
                                $titanium_db->sql_freeresult($result);
                                return array('error' => true, 'error_msg' => $titanium_lang['Username_taken']);
                        }
                }
        }
        $titanium_db->sql_freeresult($result);

        $sql = "SELECT group_name
                FROM " . GROUPS_TABLE . "
                WHERE LOWER(group_name) = '" . strtolower($titanium_username) . "'";
        if ($result = $titanium_db->sql_query($sql))
        {
                if ($row = $titanium_db->sql_fetchrow($result))
                {
                        $titanium_db->sql_freeresult($result);
                        return array('error' => true, 'error_msg' => $titanium_lang['Username_taken']);
                }
        }
        $titanium_db->sql_freeresult($result);

        global $titanium_prefix;
        $sql = "SELECT config_value FROM `".$titanium_prefix."_cnbya_config` WHERE config_name='bad_nick'";
        $result = $titanium_db->sql_query($sql);
        $row = $titanium_db->sql_fetchrowset($result);
        $BadNickList = explode("\r\n",trim($row[0]["config_value"]));
        $titanium_db->sql_freeresult($result);
        for ($i=0; $i < count($BadNickList); $i++) {
            if(!empty($BadNickList[$i])) {
                if (preg_match("#\b(" . str_replace("\*", ".*?", preg_quote($BadNickList[$i], '#')) . ")\b#i", $titanium_username))
                {
                        return array('error' => true, 'error_msg' => $titanium_lang['Username_disallowed']);
                }
            }
        }

        $sql = "SELECT disallow_username
                FROM " . DISALLOW_TABLE;
        if ($result = $titanium_db->sql_query($sql))
        {
                if ($row = $titanium_db->sql_fetchrow($result))
                {
                        do
                        {
                                if (preg_match("#\b(" . str_replace("\*", ".*?", preg_quote($row['disallow_username'], '#')) . ")\b#i", $titanium_username))
                                {
                                        $titanium_db->sql_freeresult($result);
                                        return array('error' => true, 'error_msg' => $titanium_lang['Username_disallowed']);
                                }
                        }
                        while($row = $titanium_db->sql_fetchrow($result));
                }
        }
        $titanium_db->sql_freeresult($result);

        $sql = "SELECT word
                FROM  " . WORDS_TABLE;
        if ($result = $titanium_db->sql_query($sql))
        {
                if ($row = $titanium_db->sql_fetchrow($result))
                {
                        do
                        {
                                if (preg_match("#\b(" . str_replace("\*", ".*?", preg_quote($row['word'], '#')) . ")\b#i", $titanium_username))
                                {
                                        $titanium_db->sql_freeresult($result);
                                        return array('error' => true, 'error_msg' => $titanium_lang['Username_disallowed']);
                                }
                        }
                        while ($row = $titanium_db->sql_fetchrow($result));
                }
        }
        $titanium_db->sql_freeresult($result);

        // Don't allow " and ALT-255 in username.
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        if (strstr($titanium_username, '"') || strstr($titanium_username, '&quot;') || strstr($titanium_username, chr(160)) || strstr($titanium_username, ';') || strstr($titanium_username, chr(173)))
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        {
                return array('error' => true, 'error_msg' => $titanium_lang['Username_invalid']);
        }

        return array('error' => false, 'error_msg' => '');
}

//
// Check to see if email address is banned
// or already present in the DB
//
function validate_email($email)
{
        global $titanium_db, $titanium_lang;

        if (!empty($email))
        {
                if (preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $email))
                {
                        $sql = "SELECT ban_email
                                FROM " . BANLIST_TABLE;
                        if ($result = $titanium_db->sql_query($sql))
                        {
                                if ($row = $titanium_db->sql_fetchrow($result))
                                {
                                        do
                                        {
                                                $match_email = str_replace('*', '.*?', $row['ban_email']);
                                                if (preg_match('/^' . $match_email . '$/is', $email))
                                                {
                                                        $titanium_db->sql_freeresult($result);
                                                        return array('error' => true, 'error_msg' => $titanium_lang['Email_banned']);
                                                }
                                        }
                                        while($row = $titanium_db->sql_fetchrow($result));
                                }
                        }
                        $titanium_db->sql_freeresult($result);

                        $sql = "SELECT user_email
                                FROM " . USERS_TABLE . "
                                WHERE user_email = '" . str_replace("\'", "''", $email) . "'";
                        if (!($result = $titanium_db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, "Couldn't obtain user email information.", "", __LINE__, __FILE__, $sql);
                        }

                        if ($row = $titanium_db->sql_fetchrow($result))
                        {
                                return array('error' => true, 'error_msg' => $titanium_lang['Email_taken']);
                        }
                        $titanium_db->sql_freeresult($result);

                        return array('error' => false, 'error_msg' => '');
                }
        }

        return array('error' => true, 'error_msg' => $titanium_lang['Email_invalid']);
}

//
// Does supplementary validation of optional profile fields. This expects common stuff like trim() and strip_tags()
// to have already been run. Params are passed by-ref, so we can set them to the empty string if they fail.
//
function validate_optional_fields(&$website, &$location, &$occupation, &$interests, &$sig, &$facebook)
{
        $check_var_length = array('location', 'occupation', 'interests', 'sig', 'facebook');

        for($i = 0; $i < count($check_var_length); $i++)
        {
                if (strlen($$check_var_length[$i]) < 2)
                {
                        $$check_var_length[$i] = '';
                }
        }

        // website has to start with http://, followed by something with length at least 3 that
        // contains at least one dot.
        if ($website != "")
        {
                if (!preg_match('#^http[s]?:\/\/#i', $website))
                {
                        $website = 'http://' . $website;
                }

                if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $website))
                {
                        $website = '';
                }
        }

        return;
}

?>