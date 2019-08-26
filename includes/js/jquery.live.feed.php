<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2017 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	jQuery News Feed
|----------------------------------------------------------------------
*/

if(!defined('NUKE_FILE')) die('Access forbbiden');

if(is_admin() && defined('ADMIN_FILE') && !get_query_var('op', 'get'))
{
    // addJSToHead(NUKE_JQUERY_DIR.'jquery.cookie.js','file');
    addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.live.feed.js','file', true);
}

?>