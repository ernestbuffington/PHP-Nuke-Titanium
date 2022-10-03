<?php
/***************************************************************************
 *                            functions_mg_ranks.php
 *                            ---------------------
 *   begin                : 2005/08/31
 *   copyright            : Mighty Gorgon (Luca Libralato)
 *   website              : http://www.mightygorgon.com
 *   email                : mightygorgon@mightygorgon.com
 *   version              : 1.1.0
  ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
function query_ranks()
{
	global $titanium_db;

	$sql = "SELECT ban_userid FROM ".BANLIST_TABLE." ORDER BY ban_userid ASC";
	if(!($result = $titanium_db->sql_query($sql)))
	message_die(GENERAL_ERROR, "Could not obtain banned users information.", '', __LINE__, __FILE__, $sql);
	
	$ranks_sql = array();
	$ranks_sql['bannedrow'][] = $titanium_db->sql_fetchrowset($result);
	$titanium_db->sql_freeresult($result);

	$sql = "SELECT * FROM ".RANKS_TABLE." ORDER BY rank_special ASC, rank_min ASC";

	if(!($result = $titanium_db->sql_query($sql)))
	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);

	while($row = $titanium_db->sql_fetchrow($result)):
	$ranks_sql['ranksrow'][] = $row;
	endwhile;
	$titanium_db->sql_freeresult($result);

	return $ranks_sql;
}


function generate_ranks($titanium_user_row, $ranks_sql)
{
	$titanium_user_fields_array = array(
		'user_rank',
		'user_rank2',
		'user_rank3',
		'user_rank4',
		'user_rank5'
	);
	$titanium_user_ranks_array = array(
		'rank_01', 'rank_01_img',
		'rank_02', 'rank_02_img',
		'rank_03', 'rank_03_img',
		'rank_04', 'rank_04_img',
		'rank_05', 'rank_05_img',
	);
	$titanium_user_ranks = array();
	
	$is_banned = false;
	$is_guest = false;
	$rank_sw = false;

	for($j = 0; $j < count($titanium_user_ranks_array); $j++):
		$titanium_user_ranks[$titanium_user_ranks_array[$j]] = '';
	endfor;

	if($titanium_user_row['user_id'] == '-1')
	$is_guest = true;

	if($is_guest == false):
		for($j = 0; $j < count($ranks_sql['bannedrow']); $j++):
			if($ranks_sql['bannedrow'][$j]['ban_userid'] == $titanium_user_row['user_id'] )
		    $is_banned = true;
		endfor;
	endif;

	for($j = 0; $j < count($ranks_sql['ranksrow']); $j++):
	
		$rank_tmp = $ranks_sql['ranksrow'][$j]['rank_title'];
		$rank_img_tmp = ( $ranks_sql['ranksrow'][$j]['rank_image'] ) ? '<img class="forum-ranks" src="modules/Forums/' 
		. $ranks_sql['ranksrow'][$j]['rank_image'] . '" alt="' . $rank_tmp . '" title="' . $rank_tmp . '" border="0" />' : '';
		
		if($is_guest == true):
			if ($ranks_sql['ranksrow'][$j]['rank_special'] == '2'):
				$titanium_user_ranks['rank_01'] = $rank_tmp;
				$titanium_user_ranks['rank_01_img'] = $rank_img_tmp;
			endif;
		elseif($is_banned == true):
			if($ranks_sql['ranksrow'][$j]['rank_special'] == '3'):
				$titanium_user_ranks['rank_01'] = $rank_tmp;
				$titanium_user_ranks['rank_01_img'] = $rank_img_tmp;
			endif;
		else:
		
			$day_diff = intval( (time() - (int) $titanium_user_row['user_regdate']) / 86400 );

			for($k = 0; $k < count($titanium_user_fields_array); $k++):
			
				switch($ranks_sql['ranksrow'][$j]['rank_special']):
					case '1':
						if($titanium_user_row[$titanium_user_fields_array[$k]] == $ranks_sql['ranksrow'][$j]['rank_id'])
						$rank_sw = true;
						break;
					case '0':
						if(($titanium_user_row[$titanium_user_fields_array[$k]] == '0') && ($titanium_user_row['user_posts'] >= $ranks_sql['ranksrow'][$j]['rank_min']))
						$rank_sw = true;
						break;
					case '-1':
						if(($titanium_user_row[$titanium_user_fields_array[$k]] == '-1') && ($day_diff >= $ranks_sql['ranksrow'][$j]['rank_min']))
						$rank_sw = true;
						break;
					default:
						break;
				endswitch;

				if ($rank_sw == true):
					$titanium_user_ranks[$titanium_user_ranks_array[(($k + 1) * 2) - 2]] = $rank_tmp;
					$titanium_user_ranks[$titanium_user_ranks_array[(($k + 1) * 2) - 1]] = $rank_img_tmp;
					$rank_sw = false;
				endif;
			endfor;

		endif;
	endfor;

	return $titanium_user_ranks;
}
?>
