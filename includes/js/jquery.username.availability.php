<?php
/*
|-----------------------------------------------------------------------
[ Mod:            Username Availability Check                   v1.0.0 ]
[ Created by:     coRpSE                                               ]
[ Website:        www.headshotdomain.net                               ]
|-----------------------------------------------------------------------
*/

if(!defined('NUKE_FILE')) 
    die('Access forbbiden');

// global $name;
// if(isset($name) && ($name == "Your Account" || $name == "Your_Account" || $name == "Profile")) 
// {
// 	$JStoHead  = '<script type="text/javascript">'.PHP_EOL;
// 	$JStoHead .= 'nuke_jq(document).ready(function($)'.PHP_EOL;
// 	$JStoHead .= '{'.PHP_EOL;	
// 	$JStoHead .= '	$("#username_input").focusout(function()'.PHP_EOL;
// 	$JStoHead .= '	{'.PHP_EOL;
// 	$JStoHead .= '		var username_input = $("#username_input").val();'.PHP_EOL;	
// 	$JStoHead .= '		$.post("includes/check.php", { username: username_input }, function(data)'.PHP_EOL;
// 	$JStoHead .= '		{'.PHP_EOL;
//   	$JStoHead .= '			$("#username_check_result").html(data);';
// 	$JStoHead .= '		});'.PHP_EOL;
// 	$JStoHead .= '	});'.PHP_EOL;
// 	$JStoHead .= '});'.PHP_EOL;
// 	$JStoHead .= '</script>'.PHP_EOL;
// 	addJSToHead($JStoHead,'inline');
// }

if (isset($name) && preg_match('/^Your[ _]Account|Profile$/', $name)) 
{
	$JStoHead  = '<script type="text/javascript">';
	$JStoHead .= '	nuke_jq(function($)';
	$JStoHead .= '	{';
	$JStoHead .= '		$("#username_input").focusout(function()';
	$JStoHead .= '		{';
	$JStoHead .= '			var $this = $(this);';
	$JStoHead .= '			if ($this.data("last") === this.value) {';
	$JStoHead .= ' 				return;';
	$JStoHead .= '			}';
	$JStoHead .= '			$.post("modules.php?name=Your_Account&op=username_check", {username: this.value}, function(data)';
	$JStoHead .= '			{';
	$JStoHead .= '				$("#username_check_result").html(data);';
	$JStoHead .= '			});';
	$JStoHead .= '			$this.data("last", this.value);';
	$JStoHead .= '		});';
	$JStoHead .= '	});';
	$JStoHead .= '</script>';
	addJSToBody($JStoHead,'inline');
}

?>