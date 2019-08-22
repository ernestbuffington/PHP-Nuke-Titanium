<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Debugger                                 v1.0.0       11/14/2005
      Auto Optimize                            v1.0.0       11/19/2005
      Module Simplifications                   v1.0.0       11/19/2005
-=[Other]=-
      DB Connector                             v1.0.0       06/07/2005
      Queries Count                            v2.0.1       08/21/2005
-=[Mod]=-
      Admin Icon/Link Pos                      v1.0.0       06/07/2005
	  NSN Center Blocks                        v2.2.1       05/26/2009
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

if(!defined('HEADER')) 
return;

define('NUKE_FOOTER', true);

function footmsg() 
{
    global $foot1, $foot2, $foot3, $copyright, $total_time, $start_time, $footmsg, $db, $queries_count, $use_cache, $usrclearcache, $debugger, $debug, $cache, $use_cache, $start_mem;

    static $has_echoed;

    if(isset($has_echoed) && $has_echoed == 1) 
	return; 

        $footmsg = "<span class=\"footmsg\"><br />\n";

        if (!empty($foot1))
        $footmsg .= $foot1."<br />\n";
        
        if (!empty($foot2))
        $footmsg .= $foot2."<br />\n";
        
        if (!empty($foot3)) 
        $footmsg .= $foot3."<br />\n";
        

        # DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE. YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS.
        # IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK:
        # http://phpnuke.org/modules.php?name=Commercial_License
        # PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
        $nuke_copyrights = '<strong>PHP-Nuke Copyright © 2006 by Francisco Burzi.<br />
             PHP-Nuke Titanium © 2017 by The 86it Developers Network.</strong>';
		
		$footmsg .= ''.$nuke_copyrights.'<br />';
 
        if($use_cache && $usrclearcache) 
		{
            $footmsg .= "<form method='post' name='clear_cache' action='".$_SERVER['REQUEST_URI']."'>";
            $footmsg .= "<input type='hidden' name='clear_cache' value='1'><span style='font-size: 11px'>";
            $footmsg .= "</span> This site is cached <a href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
            $footmsg .= "</form>";
        }
        
		$total_time = (get_microtime() - $start_time);
        $total_time = '<span class="copyright">[ '._PAGEGENERATION." ".substr($total_time,0,4)." "._SECONDS;
        
		if ($start_mem > 0) 
		{
            $total_mem = memory_get_usage()-$start_mem;
            $total_time .= ' | Memory Usage: '.(($total_mem >= 1048576) ? round((round($total_mem / 1048576 * 100) / 100), 2).' MB' : (($total_mem >= 1024) ? round((round($total_mem / 1024 * 100) / 100), 2).' KB' : $total_mem.' Bytes'));
        }
/*****[BEGIN]******************************************
 [ Other:   Queries Count                      v2.0.1 ]
 ******************************************************/
        if($queries_count)
        $total_time .= ' | DB Queries: ' . $db->num_queries;
        
/*****[END]********************************************
 [ Other:   Queries Count                      v2.0.1 ]
 ******************************************************/
        $total_time .= ' ]';
        $total_time .= '</span><br />';
/*****[BEGIN]******************************************
 [ Base:    Auto Optimize                      v1.0.0 ]
 ******************************************************/
        if(is_admin()) 
		{
            $first_time = false;
        
		    if (($last_optimize = $cache->load('last_optimize', 'config')) === false) 
			{
                $last_optimize = time();
                $first_time = true;
            }
            
			# For information on how to change the auto-optimize intervals
            # Please see www.php.net/strtotime
            # Default: -1 day
            $interval = strtotime('-1 day');
            
			if (($last_optimize <= $interval) || ($first_time && $cache->valid && $use_cache))
            {
                if ($db->sql_optimize()) 
				{
                    $cache->save('last_optimize', 'config', time());
                    $total_time .= "<br />Database Optimized";
                }
            }
/*****[BEGIN]******************************************
 [ Base:    Module Simplifications             v1.0.0 ]
 ******************************************************/
            update_modules();
/*****[END]********************************************
 [ Base:    Module Simplifications             v1.0.0 ]
 ******************************************************/
        }
/*****[END]********************************************
 [ Base:    Auto Optimize                      v1.0.0 ]
 ******************************************************/
            $footmsg .= $total_time."<br />\n</span>\n";
/*****[BEGIN]******************************************
 [ Base:    Debugger                           v1.0.0 ]
 ******************************************************/
        if(is_admin() && $debugger->debug && count($debugger->errors) > 0) 
		{
            $footmsg .= "<br /><center><strong>Debugging:</strong></center>";
            $footmsg .= "<table border='0' width='80%' align='center'><tr><td>";
            $footmsg .= $debugger->return_errors();
            $footmsg .= "</td></tr></table>";
        }
        
		if (is_admin()) 
        echo $db->print_debug();
/*****[END]********************************************
 [ Base:    Debugger                           v1.0.0 ]
 ******************************************************/
	$debug_sql = false;

	if(is_admin() && !is_bool($debug) && $debug == 'full') 
	{
		$strstart = strlen(NUKE_BASE_DIR);
		$debug_sql = '<span class="genmed" style="font-weight: bold;">SQL Debug:</span><br /><br />';
	
			foreach($db->querylist as $file => $queries) 
			{
				$file = substr($file, $strstart);
			
				if(empty($file)) 
				$file = 'unknown file';
			
				$debug_sql .= '<span style="font-weight: bold;">'.$file.'</span><ul>';
				foreach($queries as $query) { $debug_sql .= "<li>$query</li>"; }
				$debug_sql .= '</ul>';
			}
			
			$debug_sql .= '<span style="color: #0000FF; font-weight: bold;">*</span> - Result freed<br /><br />';
	}
	echo $debug_sql;
	unset($debug_sql);
	
	global $browser;
	if($browser == 'Bot' || $browser == 'Other') 
    $footmsg .= '<span style="display:none;"><a href="includes/trap.php">Do Not Click</a></span>'.PHP_EOL;
	
	echo $footmsg;
    $has_echoed = 1;
}
/*****[BEGIN]******************************************
 [ Base:    Admin Icon/Link Pos                v1.0.0 ]
 ******************************************************/
if(defined('ADMIN_FILE') && defined('ADMIN_POS') && is_admin())
{
    global $admin;
    $admin1 = base64_decode($admin);
    $admin1 = addslashes($admin1);
    $admin1 = explode(':', $admin1);
    $aid = $admin1[0];
    unset($admin1);
    echo "<br />";
    GraphicAdmin(0);
}
/*****[END]********************************************
 [ Base:    Admin Icon/Link Pos                v1.0.0 ]
 ******************************************************/
global $prefix, $user_prefix, $db, $index, $user, $cookie, $storynum, $user, $cookie, $Default_Theme, $foot1, $foot2, $foot3, $foot4, $home, $name, $admin, $persistency, $do_gzip_compress, $cache;

/*****[BEGIN]******************************************
 [ Mod:    NSN Center Blocks                   v2.2.1 ]
 ******************************************************/
if(defined('HOME_FILE')) 
{
    blocks('Down');
	
	# If you want either of the following on all pages simply
	# move the include to before if (defined('HOME_FILE'))
	#
	# Visit hub.86it.us for support if your stuck
	include(NUKE_INCLUDE_DIR.'cblocks3.php');
	include(NUKE_INCLUDE_DIR.'cblocks4.php');
}
/*****[END]********************************************
 [ Mod:    NSN Center Blocks                   v2.2.1 ]
 ******************************************************/

if(!defined('HOME_FILE') AND defined('MODULE_FILE') AND file_exists(NUKE_MODULES_DIR.$name.'/copyright.php')) 
{
    $cpname = str_replace("_", " ", $name);
    echo "<div align=\"right\"><a href=\"javascript:openwindow()\">$cpname &copy;</a></div>";
}

if(!defined('HOME_FILE') AND defined('MODULE_FILE') AND (file_exists(NUKE_MODULES_DIR.$name.'/admin/panel.php') && is_admin())) 
{
    echo "<br />";
    OpenTable();
    include_once(NUKE_MODULES_DIR . $name . '/admin/panel.php');
    CloseTable();
}
themefooter();
# if (!defined('IN_PHPBB')) {
#     echo "<div style=\"display:none\" id=\"resizemod\"></div>";
# }
if (file_exists(NUKE_INCLUDE_DIR . 'custom_files/custom_footer.php')) {
    include_once(NUKE_INCLUDE_DIR . 'custom_files/custom_footer.php');
}

writeBODYJS();
echo '  </body>';
echo '</html>';
$cache->resync();
/*****[BEGIN]******************************************
 [ Other:   DB Connector                       v1.0.0 ]
 [ Other:   Persistent DB Connection           v1.0.0 ]
 ******************************************************/
$db->sql_close();
/*****[END]********************************************
 [ Other:   Persistent DB Connection           v1.0.0 ]
 [ Other:   DB Connector                       v1.0.0 ]
 ******************************************************/
// $s = 'PHP-Nuke Copyright &copy; 2006 by Francisco Burzi.<br />All logos, trademarks and posts in this site are property of their respective owners, all the rest &copy; 2006 by the site owner.<br />Powered by <a href="http://www.nuke-evolution.com" target="_blank">Nuke-Evolution</a>';

if(GZIPSUPPORT && $do_gzip_compress) 
{
    $gzip_contents = ob_get_contents();
    ob_end_clean();
    $gzip_size = strlen($gzip_contents);
    $gzip_crc = crc32($gzip_contents);
    $gzip_contents = gzcompress($gzip_contents, 9);
    $gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
    echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
    echo $gzip_contents;
    echo pack('V', $gzip_crc);
    echo pack('V', $gzip_size);
}
ob_end_flush();
exit;
?>
