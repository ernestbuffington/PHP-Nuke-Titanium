<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|	VERSION 			:	1.0.0
|----------------------------------------------------------------------
*/

if (!defined('IN_FILE_REPOSITORY'))
	die('Access Denied');

function _file_repository_extensions ()
{
	global $titanium_db, $admin_file, $titanium_lang_new, $titanium_module_name, $settings;
	_admin_navigation_menu ();
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sh(),5).'>'._suh($titanium_lang_new[$titanium_module_name]['EXTENSION_HEADER']).'</td>'."\n";
	echo '  </tr>'."\n";

	echo '  <tr'._bgColor(1).'>';
	echo '    <td'._tdcss('5%','center',_sh()).'>#</td>';
	echo '    <td'._tdcss('35%','center',_sh()).'>'._suh($titanium_lang_new[$titanium_module_name]['EXTENSION']).'</td>';
	echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($titanium_lang_new[$titanium_module_name]['FILE']).'</td>';
	echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($titanium_lang_new[$titanium_module_name]['IMAGE']).'</td>';
	echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($titanium_lang_new[$titanium_module_name]['FILE_OPTIONS']).'</td>';
	echo '  </tr>';

	$sql = "SELECT `eid`, `extension`, `file`, `image` FROM `"._FILE_REPOSITORY_EXTENSIONS."` ORDER BY `eid` ASC";
	$result = $titanium_db->sql_query($sql);
	$count = 1;
	while( $row = $titanium_db->sql_fetchrow($result) ):

		echo '  <tr'._bgColor(1).'>';
		echo '    <td'._tdcss(FALSE,'center',_sc()).'>'.$count.'</td>';
		echo '    <td'._tdcss(FALSE,'center',_sc()).'>'.$row['extension'].'</td>';
		echo '    <td'._tdcss(FALSE,'center',_sc()).'>'.(($row['file'] == 1) ? _colorization($titanium_lang_new[$titanium_module_name]['Y'],'green',true) : _colorization($titanium_lang_new[$titanium_module_name]['N'],'red',false)) .'</td>';
		echo '    <td'._tdcss(FALSE,'center',_sc()).'>'.(($row['image'] == 1) ? _colorization($titanium_lang_new[$titanium_module_name]['Y'],'green',true) : _colorization($titanium_lang_new[$titanium_module_name]['N'],'red',false)).'</td>';
		echo '    <td'._tdcss(FALSE,'center',_sc()).'><a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=delete_extension&did='.$row['eid'].'"><span class="dm-sprite delete-button"></span></a></td>';
		echo '  </tr>';
		$count++;

	endwhile;
	$titanium_db->sql_freeresult($result);

	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sf(),5).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
}

function _file_repository_delete_extension ()
{

}

switch($_GET['action']):

	case 'delete_extension':
		_file_repository_delete_extension ();
		break;

	default:
		_file_repository_extensions ();
		break;

endswitch;

?>