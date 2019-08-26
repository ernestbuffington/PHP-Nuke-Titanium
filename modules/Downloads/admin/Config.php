<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_DOWNCONFIG;
include_once 'header.php';
OpenTable();
title('<h1>'.$pagetitle.'</h1>');
DLadminmain();
echo '<br />';
OpenTable2();
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMBLOCKUNREGMODIFY . '</td><td><select name="xblockunregmodify">';
echo '<option value="0"';
if ($dl_config['blockunregmodify'] == 0) {
	echo ' selected="selected"';
}
echo '> ' . _YES . ' </option>' . '<option value="1"';
if ($dl_config['blockunregmodify'] == 1) {
	echo ' selected="selected"';
}
echo '> ' . _NO . ' </option>';
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMMOSTPOPULAR . '</td><td><select name="xmostpopular">';
echo '<option value="' . $dl_config['mostpopular'] . '" selected="selected"> ' . $dl_config['mostpopular'] . ' </option>';
for ($i = 1;$i <= 5;$i++) {
	$j = $i*5;
	echo '<option value="' . $j . '"> ' . $j . ' </option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMMOSTPOPULARTRIG . '</td><td><select name="xmostpopulartrig">';
echo '<option value="0"';
if ($dl_config['mostpopulartrig'] == 0) {
	echo ' selected="selected"';
}
echo '> ' . _DL_NUMBER . ' </option>' . '<option value="1"';
if ($dl_config['mostpopulartrig'] == 1) {
	echo ' selected="selected"';
}
echo '> ' . _DL_PERCENT . ' </option>';
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMPERPAGE . '</td><td><select name="xperpage">';
echo '<option value="' . $dl_config['perpage'] . '" selected="selected"> ' . $dl_config['perpage'] . ' </option>';
for ($i = 1;$i <= 5;$i++) {
	$j = $i*10;
	echo '<option value="' . $j . '"> ' . $j . ' </option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMADMPERPAGE . '</td><td><select name="xadmperpage">';
echo '<option value="' . $dl_config['admperpage'] . '" selected="selected"> ' . $dl_config['admperpage'] . ' </option>';
for ($i = 1;$i <= 8;$i++) {
	$j = $i*25;
	echo '<option value="' . $j . '"> ' . $j . ' </option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMRESULTS . '</td><td><select name="xresults">';
echo '<option value="' . $dl_config['results'] . '" selected="selected"> ' . $dl_config['results'] . ' </option>';
for ($i = 1;$i <= 5;$i++) {
	$j = $i*10;
	echo '<option value="' . $j . '"> ' . $j . ' </option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMPOPULAR . '</td><td><select name="xpopular">';
echo '<option value="' . $dl_config['popular'] . '" selected="selected"> ' . $dl_config['popular'] . ' </option>';
for ($i = 1;$i <= 10;$i++) {
	$j = $i*100;
	echo '<option value="' . $j . '"> ' . $j . ' </option>';
}
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMSHOWDOWNLOAD . '</td><td><select name="xshow_download">';
if ($dl_config['show_download'] == '0') {
	$dl_config['show_download_text'] = _DL_NO;
} else {
	$dl_config['show_download_text'] = _DL_YES;
}
echo '<option value="' . $dl_config['show_download'] . '" selected="selected"> ' . $dl_config['show_download_text'] . ' </option>';
echo '<option value="0">' . _DL_NO . '</option><option value="1">' . _DL_YES . '</option>';
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMSHOWNUM . '</td><td><select name="xshow_links_num">';
echo '<option value="0"';
if ($dl_config['show_links_num'] == 0) {
	echo ' selected="selected"';
}
echo '> ' . _NO . ' </option>' . '<option value="1"';
if ($dl_config['show_links_num'] == 1) {
	echo ' selected="selected"';
}
echo '> ' . _YES . ' </option>';
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_ADMUSEGFX . '</td><td><select name="xusegfxcheck">';
echo '<option value="0"';
if ($dl_config['usegfxcheck'] == 0) {
	echo ' selected="selected"';
}
echo '> ' . _NO . ' </option>' . '<option value="1"';
if ($dl_config['usegfxcheck'] == 1) {
	echo ' selected="selected"';
}
echo '> ' . _YES . ' </option>';
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_DATEFORMAT . ':<br />' . _DL_DATEMSG . '</td><td>';
echo '<input size="30" maxlength="60" type="text" name="xdateformat" value="' . $dl_config['dateformat'] . '" /></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_SAVECHANGES . '" /></td></tr>';
echo '</table>';
echo '<input type="hidden" name="op" value="DLConfigSave" />';
echo '</form>';
CloseTable2();
CloseTable();
include_once 'footer.php';

