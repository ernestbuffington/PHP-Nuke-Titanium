<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_EXTENSIONSADMIN;
include_once 'header.php';

OpenTable();
title('<h1>'.$pagetitle.'</h1>');
DLadminmain();
echo '<br />';
OpenTable2();
$perpage = $dl_config['admperpage'];
$min = isset($min) ? intval($min) : 0;
$max = isset($max) ? intval($max) : $min + $perpage;
$totalselected = $db->sql_numrows($db->sql_query('SELECT `eid` FROM `' . $prefix . '_nsngd_extensions`'));
if ($min > $totalselected) $min = 0; // Protect against malformed requests
pagenums_admin($op, $totalselected, $perpage, $max);
echo '<table style="color:'. $textcolor1 . ';" align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr bgcolor="' . $bgcolor2 . '"><td align="center"><strong>' . _DL_ID . '</strong></td><td><strong>' . _DL_EXTENSION
	. '</strong></td>';
echo '<td><strong>' . _DL_FILETYPE . '</strong></td>';
echo '<td><strong>' . _DL_IMAGETYPE . '</strong></td>';
echo '<td align="center"><strong>' . _DL_FUNCTIONS . '</strong></td>' . '</tr>';
$x = 0;
$result = $db->sql_query('SELECT * FROM `' . $prefix . '_nsngd_extensions` ORDER BY `ext` LIMIT ' . $min . ',' . $perpage);
while ($eidinfo = $db->sql_fetchrow($result)) {
	echo '<tr bgcolor="' . $bgcolor1 . '">';
	echo '<td align="center">' . $eidinfo['eid'] . '</td>';
	echo '<td>' . $eidinfo['ext'] . '</td>';
	if ($eidinfo['file'] == 1) {
		$ftype = '<strong>' . _YES . '</strong>';
	} else {
		$ftype = _NO;
	}
	echo '<td align="center">' . $ftype . '</td>';
	if ($eidinfo['image'] == 1) {
		$itype = '<strong>' . _YES . '</strong>';
	} else {
		$itype = _NO;
	}
	echo '<td align="center">' . $itype . '</td><td align="center">';
	echo '<form method="post" action="' . $admin_file . '.php">';
	echo '<select name="op"><option value="ExtensionModify" selected="selected">' . _DL_MODIFY . '</option>';
	echo '<option value="ExtensionDelete">' . _DL_DELETE . '</option></select> ';
	echo '<input type="hidden" name="min" value="' . $min . '" />';
	echo '<input type="hidden" name="eid" value="' . $eidinfo['eid'] . '" />';
	echo '<input type="submit" value="' . _DL_OK . '" />';
	echo '</form></td></tr>';
	$x++;
}
echo '</table>';
pagenums_admin($op, $totalselected, $perpage, $max);
CloseTable2();
CloseTable();
include_once 'footer.php';

