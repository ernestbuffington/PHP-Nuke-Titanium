<?php

/*
|-----------------------------------------------------------------------
|	AUTHOR 				:	jQuery
|	VERSION 			:	3.3.1
|----------------------------------------------------------------------
*/

if(!defined('NUKE_FILE')) 
	die('Access forbbiden');

global $wysiwyg;
# https://use.fontawesome.com/releases/v5.6.3/css/all.css
addCSSToHead('//use.fontawesome.com/releases/v5.6.3/css/all.css','file');
addCSSToHead(NUKE_CSS_DIR.'jquery.ui.css','file');

// HTML5 Shiv
addJSToHead('//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js','file');

addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'jquery-3.3.1.min.js','file');
addJSToHead('//code.jquery.com/ui/1.12.0/jquery-ui.min.js','file');
addJSToHead('//code.jquery.com/jquery-migrate-1.4.1.min.js','file');

$JStoHead  = '<script type="text/javascript">'.PHP_EOL;
$JStoHead .= '  var nuke_jq 	= jQuery.noConflict();'.PHP_EOL;
if(is_admin())
	$JStoHead .= '  var admin_file 	= "'.$admin_file.'";'.PHP_EOL;
$JStoHead .= '</script>'.PHP_EOL;
addJSToHead($JStoHead,'inline');

// addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'jquery.letter.avatar.js','file');
addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'jquery.easing.min.js','file');
addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'jquery.fn.extend.js','file');
addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'jquery.core.js','file');


addCSSToHead(NUKE_CSS_DIR.'cookieconsent.min.css','file');
addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'cookieconsent.min.js','file');
$cookieconsent_inline  = '<script>';
$cookieconsent_inline .= 'window.addEventListener("load", function(){';
$cookieconsent_inline .= 'window.cookieconsent.initialise({';
$cookieconsent_inline .= '  "palette": {';
$cookieconsent_inline .= '    "popup": {';
$cookieconsent_inline .= '      "background": "#000",';
$cookieconsent_inline .= '      "text": "#0f0"';
$cookieconsent_inline .= '    },';
$cookieconsent_inline .= '    "button": {';
$cookieconsent_inline .= '      "background": "#0f0"';
$cookieconsent_inline .= '    }';
$cookieconsent_inline .= '  },';
$cookieconsent_inline .= '  "theme": "classic"';
$cookieconsent_inline .= '})});';
$cookieconsent_inline .= '</script>';
addJSToHead($cookieconsent_inline,'inline');


$progress_bar_loading  = '<script type="text/javascript">'.PHP_EOL; // data-percentage
$progress_bar_loading .= 'nuke_jq(function($)';
$progress_bar_loading .= '{';
$progress_bar_loading .= '	$(".progress-bar > span").each(function() {$(this).width(0).animate({width: $(this).data("percentage")+"%"}, 1200);});';
$progress_bar_loading .= '});';
$progress_bar_loading .= '</script>'.PHP_EOL;
addJSToBody($progress_bar_loading,'inline');

addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'jquery.marquee.js','file');
$jquery_marquee  = '<script type="text/javascript">'.PHP_EOL;
$jquery_marquee .= 'nuke_jq("[data-marquee]").marquee({
    direction: "up",
});';
$jquery_marquee .= '</script>'.PHP_EOL;
addJSToBody($jquery_marquee,'inline');

?>