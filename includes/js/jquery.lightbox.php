<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2007, 2015
|	AUTHOR 				:	Lokesh Dhakar	
|	COPYRIGHTS 			:	http://lokeshdhakar.com/projects/lightbox2
|	PROJECT 			:	jQuery lightbox
|	VERSION 			:	2.9.0
|----------------------------------------------------------------------
*/

if(!defined('NUKE_FILE')) 
	die('Access forbbiden');

/*	
	USEAGE - SINGLE IMAGE 					: <a data-lightbox href="images/fullsize/mypicture.jpg">View my Picture</a>
	USEAGE - SINGLE IMAGE WITH TITLE 		: <a data-lightbox data-title="title/caption will go here" href="images/fullsize/mypicture.jpg">View my Picture</a>

	USEAGE - MULTIPLE IMAGES 				: <a data-lightbox="group" href="images/fullsize/mypicture.jpg">View my Picture</a>
	USEAGE - MULTIPLE IMAGES WITH TITLE 	: <a data-lightbox="group" data-title="title/caption will go here" href="images/fullsize/mypicture.jpg">View my Picture</a>
*/

# Because of the way the image viewers and been coded, Only the image viewer that you specify in the plugin area of the ACP,
# will be active, But not to worry you can force the load of this image viewer by adding the following to your mod.
# define('_force_lightbox_load',true);
# Then use the examples added above to use this image viewer.

# this is just to stop any errors from occuring, DO NOT EDIT THE DEFINE BELOW
if(!defined('_force_lightbox_load')):
	define('_force_lightbox_load',false);
endif;

if ( _force_lightbox_load || get_evo_option('img_viewer') == 'lightbox' ):
	addCSSToHead(NUKE_CSS_DIR.'jquery.lightbox.min.css','file');
	addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.lightbox.min.js','file');
endif;

?>