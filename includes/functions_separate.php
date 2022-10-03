<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            function_separate.php
 *                            -------------------
 *   begin                : Tuesday, Mar 15, 2005
 *   copyright            : (C) 2005 Aiencran
 *   email                : cranportal@katamail.com
 *
 *   $Id: functions_separate.php,v 1.0.0.0 2005/03/15 15:20:00 psotfx Exp $
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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

//
// Select topic to be suggested
//
function get_dividers($phpbb2_topics)
{
    global $titanium_lang;

    $dividers = array();
    $total_phpbb2_topics = count($phpbb2_topics);
    $total_phpbb2_by_type = array (POST_GLOBAL_ANNOUNCE => 0, POST_ANNOUNCE => 0, POST_STICKY => 0, POST_NORMAL => 0);

    for ( $i=0; $i < $total_phpbb2_topics; $i++ )
    {
        $total_phpbb2_by_type[$phpbb2_topics[$i]['topic_type']]++;            
    }

    if ( ( $total_phpbb2_by_type[POST_GLOBAL_ANNOUNCE] + $total_phpbb2_by_type[POST_ANNOUNCE] + $total_phpbb2_by_type[POST_STICKY] ) != 0 )
    {
        $count_topics = 0;
        
        $dividers[$count_topics] = $titanium_lang['Global_Announcements'];
        $count_topics += $total_phpbb2_by_type[POST_GLOBAL_ANNOUNCE];

        $dividers[$count_topics] = $titanium_lang['Announcements'];
        $count_topics += $total_phpbb2_by_type[POST_ANNOUNCE];

        $dividers[$count_topics] = $titanium_lang['Sticky_Topics'];
        $count_topics += $total_phpbb2_by_type[POST_STICKY];

        if ( $count_topics < $total_phpbb2_topics )
        {
            $dividers[$count_topics] = $titanium_lang['Topics'];
        }
    }

    return $dividers;
}

?>