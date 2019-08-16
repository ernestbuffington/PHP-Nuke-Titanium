<?php
/*********************************************
  PHP-Nuke Titanium v3.0.0
  ********************************************
  Copyright (c) 2004 - 2005 by CPG-Nuke Dev Team
  http://dragonflycms.org

  Dragonfly is released under the terms and conditions
  of the GNU GPL version 2 or any later version

  $Source: /cvs/html/includes/wysiwyg/wysiwyg.inc,v $
  $Revision: 1.9 $
  $Author: djmaze $
  $Date: 2006/01/13 12:22:48 $

  Modifications made by the Nuke-Evolution Team
**********************************************/

class Wysiwyg
{
	var $editor;
	var $type;
	var $form;
	var $field;
	var $width;
	var $height;
	var $value;
	var $smilies;
	var $bypass;
	var $pass;

	function __construct($form, $field, $width='99.8%', $height='200px', $value='', $smilies=true)
	{
		global $wysiwyg;
		if (!empty($wysiwyg) && $wysiwyg != 'bbcode' && $wysiwyg != 'none') 
		{
			if (file_exists(NUKE_INCLUDE_DIR."wysiwyg/$wysiwyg/$wysiwyg.php")) 
			{
				include_once(NUKE_INCLUDE_DIR."wysiwyg/$wysiwyg/$wysiwyg.php");
				$func = $wysiwyg.'_getInstance';
				if (function_exists($func)) 
				{
					$this->pass = 1;
					$this->editor = $func($field, $width, $height, $value);

				} 
				else 
				{
					$this->pass = 0;
					$this->editor = new $wysiwyg($field, $width, $height, $value);
					echo $wysiwyg;
				}
			}
			else
			{
				$wysiwyg = '';
				echo 'The choosen WYSIWYG editor "'.$wysiwyg.'" is not available';
			}
		}
		$this->type   	= $wysiwyg;
		$this->form   	= $form;
		$this->field  	= $field;
		$this->width  	= $width;
		$this->height 	= $height;
		$this->value  	= $value;
		$this->smilies 	= $smilies;
	}

	function setHeader()
	{
		if (!empty($this->editor) && method_exists($this->editor, 'setHeader')) 
		{
			$this->editor->setHeader();
		}
	}

	function getSelect()
	{
		global $wysiwyg;
		return select_box('xtextarea', $wysiwyg, $this->getEditors());
	}

	function getEditors()
	{
		$editors = array('' => _NONE);
		$editors['bbcode'] = 'BBCode';
		$wysiwygs = dir(NUKE_INCLUDE_DIR.'wysiwyg');
		while ($dir = $wysiwygs->read()) 
		{
			if ($dir[0] != '.' && file_exists(NUKE_INCLUDE_DIR."wysiwyg/$dir/$dir.php")) 
			{
				$editors[$dir] = $dir;
			}
		}
		$wysiwygs->close();
		return $editors;
	}

	function getHTML()
	{
		global $board_config, $name, $lang, $userinfo;

		# FORM CHECKING HAS BEEN MOVED TO HERE, AS THERE IS NOW MORE THAN ONE EDITOR TO USE
		# FORM CHECKING SHOULD BE LEFT HERE, SO THAT IT CAN BE USED FOR BOTH THE BBCODE TABLE AND THE STANDARD TABLE
		// if($this->bypass)
		// {
			
		// }
		// else
		// {
		// 	$JStoBody = '<script type="text/javascript">'.PHP_EOL;
		// 	$JStoBody .= 'nuke_jq(function($)'.PHP_EOL;
		// 	$JStoBody .= '{'.PHP_EOL;
		// 	$JStoBody .= '  $("#preview,#submit,#'.$this->bypass.'").one(function(event)'.PHP_EOL;
		// 	$JStoBody .= '  {';
		// 	$JStoBody .= '    formErrors = false;'.PHP_EOL;
		// 	$JStoBody .= '    if ($("#'.$this->field.'").val().length < 2)'.PHP_EOL;
		// 	$JStoBody .= '    {'.PHP_EOL;
		// 	// $JStoBody .= '      formErrors = "'.$lang['Empty_message'].'";'.PHP_EOL;
		// 	# ADD NEW GLOBAL "EMPTY MESSAGE BOX" ALERT FOR BLOCK, AND MESSAGES ADMIN.
		// 	$JStoBody .= '      formErrors = "Must enter a message";'.PHP_EOL;
		// 	$JStoBody .= '    }'.PHP_EOL;
		// 	$JStoBody .= '    if (formErrors)'.PHP_EOL;
		// 	$JStoBody .= '    {'.PHP_EOL;
		// 	$JStoBody .= '      event.preventDefault();'.PHP_EOL;
		// 	$JStoBody .= '      alert(formErrors);'.PHP_EOL;
		// 	$JStoBody .= '    }'.PHP_EOL;
		// 	$JStoBody .= '  });'.PHP_EOL;
		// 	$JStoBody .= '});'.PHP_EOL;
		// 	$JStoBody .= '</script>'.PHP_EOL;
		// 	addJSToBody($JStoBody,'inline');
		// }

		if (!empty($this->editor)) 
		{
			if ($this->pass) 
			{
				$this->setHeader();
				global $modheader;
				echo $modheader;
				return $this->editor->getHtml($this->field);	
			}
			return $this->editor->getHtml();
		}
		elseif ($this->type == 'bbcode') 
		{
			$allowed = ($name == 'Profile') ? false : true;
			$HTMLtable .= '<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">';

			$setting['bbcode_button_location'] = 'top';

			# top aligned buttons aligned buttons
			if($setting['bbcode_button_location'] == 'top' && ($userdata['user_id'] != ANONYMOUS)):
			
				$HTMLtable .= '  <tr>';
				$HTMLtable .= '    <td class="row1" style="width: 100%;">'.bbcode_table($this->field, $this->form, $allowed).'</td>';
				$HTMLtable .= '  </tr>';
				$HTMLtable .= '  <tr>';
        		$HTMLtable .= '    <td class="row1"><input type="text" name="help'.$field.'" value="Tip: BBCode can be applied quickly to selected text" class="helpline" readonly /></td>';
        		$HTMLtable .= '  </tr>';
			
			endif;
						
			$HTMLtable .= '  <tr>';
			$HTMLtable .= '    <td class="row1" style="width: 100%;"><textarea data-autoresize id="'.$this->field.'" name="'.$this->field.'" style="resize: none; width: '.$this->width.' !important; height: '.$this->height.'; min-height: '.$this->height.';">'.$this->value.'</textarea></td>';
			$HTMLtable .= '  </tr>';

			# bottom aligned buttons
			if($setting['bbcode_button_location'] == 'bottom' && ($userdata['user_id'] != ANONYMOUS))
			{
				$HTMLtable .= '  <tr>';
        		$HTMLtable .= '    <td class="row1"><input type="text" name="help'.$field.'" value="Tip: BBCode can be applied quickly to selected text" class="helpline" readonly /></td>';
        		$HTMLtable .= '  </tr>';
				$HTMLtable .= '  <tr>';
				$HTMLtable .= '    <td class="row1" style="width: 100%;">'.bbcode_table($this->field, $this->form, $allowed).'</td>';
				$HTMLtable .= '  </tr>';
			}

			if($board_config['allow_smilies'] && $this->smilies && ($userdata['user_id'] != ANONYMOUS))
			{
				$HTMLtable .= '  <tr>';
				$HTMLtable .= '    <td class="row1" style="width: 100%;">'.smilies_table('onerow',$this->field, $this->form).'</td>';
				$HTMLtable .= '  </tr>';
			}
			$HTMLtable .= '</table>';
			return $HTMLtable;
		}
		else
		{
			$HTMLtable .= '<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">';
			$HTMLtable .= '  <tr>';
			$HTMLtable .= '    <td class="row1" style="width: 100%;"><textarea data-autoresize id="'.$this->field.'" name="'.$this->field.'" style="resize: vertical; width: '.$this->width.' !important; height: '.$this->height.'; min-height: '.$this->height.';">'.$this->value.'</textarea></td>';
			$HTMLtable .= '  </tr>';
			$HTMLtable .= '</table>';
			return $HTMLtable;
		}
	}

	function Show() 
	{
		echo $this->getHTML(); 
		echo '<br />';
	}
	function Ret() 
	{
		return $this->getHTML(); 
	}
}

?>