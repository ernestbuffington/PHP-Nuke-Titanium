<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 - PHP-Nuke Titanium
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
      NukeSentinel                             v2.5.00      07/11/2006
      Nuke Patched                             v3.1.0       06/26/2005
      Advanced Security Extension              v1.0.0       12/22/2005
-=[Other]=-
      Dynamic Titles                           v1.0.0       06/11/2005
-=[Mod]=-
      Collapsing Blocks                        v1.0.0       08/16/2005
	  NSN Center Blocks                        v2.2.1       05/26/2009
 ************************************************************************/

if(!defined('HEADER')){ define('HEADER', true); }else{ return; }
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){ exit('Access Denied'); }

require_once(dirname(__FILE__).'/mainfile.php');

function head() 
{
    global $define_theme_xtreme_209e, $myappid, $ab_config, $modheader, $name, $cache, $userinfo, $cookie, $sitekey, $db, $name, $banners, $sitename, $ads, $browser, $ThemeSel;

	include_once(TITANIUM_THEMES_DIR.$ThemeSel.'/theme.php');

    if (@file_exists(TITANIUM_INCLUDE_DIR . 'mimetype.php') && ($define_theme_xtreme_209e != true)) 
	{
        include(TITANIUM_INCLUDE_DIR.'mimetype.php');
    } 
	else 
	{
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
        echo '<head>'."\n";
		
	  # function to grab the page title.
      the_pagetitle();
    }

    include_once(NUKE_INCLUDE_DIR.'meta.php');
	if ($define_theme_xtreme_209e != true)
	include_once(TITANIUM_INCLUDE_DIR.'dynamic_titles.php');
	
    ############################################################################ 
    if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/a-links.php'))       ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/a-links.php');         ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##                             Theme Design On The Fly
    if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/async-hide.php'))    ############################## Stop Deleteing Cache To see
	{                                                                         ##                             your changes! 08/13/2019
	  echo "<style type=\"text/css\">\n";                                     ##                             By Ernest Allen Buffington
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/async-hide.php');      ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
    if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/block.php'))         ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/block.php');           ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/body.php'))          ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/body.php');            ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/categories.php'))    ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/categories.php');      ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/maintable.php'))     ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/maintable.php');       ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/menunowrap.php'))    ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/menunowrap.php');      ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/modules.php'))       ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/modules.php');         ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/myButton.php'))      ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/myButton.php');        ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/storycat.php'))      ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/storycat.php');        ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(TITANIUM_THEMES_DIR.$ThemeSel.'/css/style.php'))         ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(TITANIUM_THEMES_DIR.$ThemeSel.'/css/style.php');           ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
    ###########################################################################
    
	    echo "\n\n<!-- START uploadcare -->\n\n";
		echo "<script type=\"text/javascript\">\n";
		echo "UPLOADCARE_PUBLIC_KEY = 'df691884c0a749427aa1';\n";
		echo "UPLOADCARE_TABS = 'file camera url facebook gdrive gphotos dropbox instagram evernote flickr onedrive box vk huddle';\n";
		echo "UPLOADCARE_EFFECTS = 'crop,rotate,mirror,flip,enhance,sharp,blur,grayscale,invert';\n";
		echo "UPLOADCARE_PREVIEW_STEP = true;\n";
		echo "UPLOADCARE_CLEARABLE = true;\n";
		echo "</script>\n";

        echo "<script src=\"https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js\"></script>\n";
		echo "<script src=\"https://ucarecdn.com/libs/widget-tab-effects/1.x/uploadcare.tab-effects.js\"></script>\n";
        
		echo "<script type=\"text/javascript\">\n";
        echo "uploadcare.registerTab('preview', uploadcareTabEffects)\n";
		echo "</script>\n";
		echo "\n\n<!-- END uploadcare -->\n\n";

	
	
	
	include_once(NUKE_INCLUDE_DIR.'javascript.php');                          ######## Load local javascript File
    ###########################################################################
	if (@file_exists(TITANIUM_CLASSES_DIR . 'class.browsers.php')) #      Added by Ernest Buffington
	    include(TITANIUM_CLASSES_DIR . 'class.browsers.php');      ###### Load Browser class - used for checking your browser types
                                                                   #      Start date Jan 1st 2012 till Present - It is a work in progress!
    ################################################################
	if (@file_exists(TITANIUM_INCLUDE_DIR . 'cookies.php')) #            Added by Ernest Buffington
	{                                                       ############ Load the custom cookies file if it exist COOKIE CONTROL
        include(TITANIUM_INCLUDE_DIR . 'cookies.php');      #            Jan 1st 2012 
    }                                                       #
    #########################################################

    if ((($favicon = $cache->load('favicon', 'config')) === false) || empty($favicon)) 
	{
        if (file_exists(NUKE_BASE_DIR.'favicon.ico')) $favicon = "favicon.ico";
		else 
		if (file_exists(NUKE_IMAGES_DIR.'favicon.ico')) $favicon = "images/favicon.ico";
		else 
		if (file_exists(NUKE_THEMES_DIR.$ThemeSel.'/images/favicon.ico')) $favicon = "themes/$ThemeSel/images/favicon.ico";
		else 
        $favicon = 'none';

        if ($favicon != 'none') 
        echo "<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\" />\n";
        
		$cache->save('favicon', 'config', $favicon);
    } 
	else 
	{
        if ($favicon != 'none')
        echo "<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\" />\n";
    }

    // If you use ForumNews Advance, you may want to replace the RSS News with the RSS ForumNews. Just remove the comments below and comment out the RSS News.
    //echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS $sitename &raquo; ForumNews\" href=\"rss.php?feed=forumnews\">\n";
    echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS $sitename &raquo; News\" href=\"rss.php?feed=news\">\n";
    echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS $sitename &raquo; Forums\" href=\"rss.php?feed=forums\">\n";
    echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS $sitename &raquo; Downloads\" href=\"rss.php?feed=downloads\">\n";
    echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS $sitename &raquo; Web Links\" href=\"rss.php?feed=weblinks\">\n";

    global $browser;
    
	if(isset($modheader)) {
        echo $modheader;
    }

    writeHEAD();
    
    if ((($custom_head = $cache->load('custom_head', 'config')) === false) || empty($custom_head)) 
	{
        $custom_head = array();
    
	    if (file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_head.php')) 
		{
            $custom_head[] = 'custom_head';
        }
        
		if (file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_header.php')) 
		{
            $custom_head[] = 'custom_header';
        }
        
		if (!empty($custom_head)) 
		{
            foreach ($custom_head as $file) 
			{
                include_once(NUKE_INCLUDE_DIR.'custom_files/'.$file.'.php');
            }
        }
        
		$cache->save('custom_head', 'config', $custom_head);
    } 
	else 
	{
        if (!empty($custom_head)) 
		{
            foreach ($custom_head as $file) 
			{
                include_once(NUKE_INCLUDE_DIR.'custom_files/'.$file.'.php');
            }
        }
    }
    
	/* ----- as you can probably tell this is used for IE compatibility ----- */
    echo '<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->'."\n";
    echo "</head>\n";
    themeheader();

/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
    if($ab_config['site_switch'] == 1) {
        echo '<center><img src="modules/NukeSentinel/images/disabled.png" alt="'._AB_SITEDISABLED.'" title="'._AB_SITEDISABLED.'" border="0" /></center><br />';
    }
/*****[END]********************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
}

function online() 
{
    global $prefix, $db, $name, $board_config, $userinfo, $identify;
    $ip = $identify->get_ip();
    $url = (defined('ADMIN_FILE')) ? 'index.php' : Fix_Quotes($_SERVER['REQUEST_URI']);
    $uname = $ip;
    $guest = 1;
    $user_agent = $identify->identify_agent();
    if (is_user()):

        $uname = $userinfo['username'];
        $guest = 0;

/*****[BEGIN]******************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
    elseif($user_agent['engine'] == 'bot'):

        $uname = $user_agent['bot'];
        $guest = 3;

/*****[END]********************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
    endif;

    $custom_title = $name;
    $url = str_replace("&amp;", "&", $url);
	$url = addslashes($url);
    $past = time() - $board_config['online_time'];
    $db->sql_query('DELETE FROM '.$prefix.'_session WHERE time < "'.$past.'"');
    $ctime = time();

    /**
     * A replace into sql command was added, to prevent the duplication of users, This also saves on several lines of code.
     *
     * @since 2.0.9E
     */
    $db->sql_query("replace into `".$prefix."_session` (uname, time, starttime, host_addr, guest, module, url) values ('".$uname."', '".$ctime."', '".$ctime."', '".$ip."', '".$guest."', '".$custom_title."', '".$url."');");

    /**
     * This sql replace command is to track who has been to the site and records their last visit.
     *
     * @since 2.0.9E
     */
    if($guest == 0)
    $db->sql_query("replace into `".$prefix."_users_who_been` (`user_ID`, `username`, `last_visit`) values ('".$userinfo['user_id']."', '".$userinfo['username']."', ".time().");");
}

online();
head();

/*****[BEGIN]******************************************
 [ Mod:    NSN Center Blocks                   v2.2.1 ]
 ******************************************************/
if (!defined('ADMIN_FILE')):

	include_once(NUKE_INCLUDE_DIR.'counter.php');

	if (defined('HOME_FILE')):

		include_once(NUKE_INCLUDE_DIR.'messagebox.php');
		blocks('Center');
		// If you want either of the following on all pages simply, move the include to before if (defined('HOME_FILE'))
		include(NUKE_INCLUDE_DIR.'cblocks1.php');
		include(NUKE_INCLUDE_DIR.'cblocks2.php');
	
    endif;

endif;
/*****[END]********************************************
 [ Mod:    NSN Center Blocks                   v2.2.1 ]
 ******************************************************/
?>