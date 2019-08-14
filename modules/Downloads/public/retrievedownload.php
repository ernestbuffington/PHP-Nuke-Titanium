<?php

	$lid = intval($lid);
	$lidinfo = $db->sql_ufetchrow("SELECT * FROM `". $prefix ."_nsngd_downloads` WHERE `lid`='". $lid ."' AND `active` > '0'");
	$priv = $lidinfo['sid'] - 2;
	
	if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user())  
	                           || ($lidinfo['sid'] == 2 AND is_mod_admin($module_name)) 
							   || ($lidinfo['sid'] > 2 AND of_group($priv))) 
	{
		if (!security_code_check($_POST['gfx_check'], 'force') AND $dl_config['usegfxcheck'] == 1) 
		{
			include_once(NUKE_BASE_DIR."header.php");
			OpenTable();
		  	title(_DL_PASSERR);
			OpenTable4();
		  	echo "<center>"._DL_INVALIDPASS."</center><br />\n";
		  	echo "<center>"._GOBACK."</center>\n";
		  	CloseTable4();
			CloseTable();
		  	include_once(NUKE_BASE_DIR."footer.php");
		}
		else
		{
			if (stristr($lidinfo['url'], "http://") || stristr($lidinfo['url'], "ftp://") || @file_exists($lidinfo['url'])) 
			{
				include_once(NUKE_INCLUDE_DIR.'counter.php');
        		$db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET hits=hits+1 WHERE lid=$lid");
				if (!is_mod_admin($module_name)) 
				{
          			$uinfo = $userinfo;
          			$username = $uinfo['username'];
          			if (empty($username)) 
					{ 
						$username = identify::get_ip(); 
					}
          			$result = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_accesses WHERE username='$username'"));
          			if ($result < 1) 
					{
            			$db->sql_query("INSERT INTO ".$prefix."_downloads_accesses VALUES ('$username', 1, 0)");
          			} 
					else 
					{
            			$db->sql_query("UPDATE ".$prefix."_downloads_accesses SET downloads=downloads+1 WHERE username='$username'");
          			}
        		}
				if($_POST['submit'] == 'Download')
				{
					redirect($lidinfo['url']);
				}
				elseif($_POST['submit'] == 'External Mirror One')
				{
					redirect($lidinfo['external_mirror1']);
				}
				elseif($_POST['submit'] == 'External Mirror Two')
				{
					redirect($lidinfo['external_mirror2']);
				}
			}
		}
	} 
	else 
	{
		restricted($lidinfo['sid']);
	}

?>