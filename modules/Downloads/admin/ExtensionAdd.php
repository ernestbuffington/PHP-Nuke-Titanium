<?php //done
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
$pagetitle = _DL_EXTENSIONSADMIN . ': ' . _DL_ADDEXTENSION;
include_once 'header.php';

OpenTable();
title('<h1>'._DL_EXTENSIONSADMIN.'</h1>');
DLadminmain();
echo '<br />';
OpenTable4();
echo '<form action="' . $admin_file . '.php" method="post">';
echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
echo '<tr><td align="center" colspan="2"><strong>' . _DL_ADDEXTENSION . '</strong></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_EXTENSION . ':</td><td><input type="text" name="xext" size="10" maxlength="6" /></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_FILETYPE . ':</td><td><select name="xfile">';
echo '<option value="0" selected="selected">' . _DL_NO . '</option>';
echo '<option value="1">' . _DL_YES . '</option>';
echo '</select></td></tr>';
echo '<tr><td bgcolor="' . $bgcolor2 . '">' . _DL_IMAGETYPE . ':</td><td><select name="ximage">';
echo '<option value="0" selected="selected">' . _DL_NO . '</option>';
echo '<option value="1">' . _DL_YES . '</option>';
echo '</select></td></tr>';
echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _DL_ADDEXTENSION . '" /></td></tr>';
echo '</table>';
echo '<input type="hidden" name="op" value="ExtensionAddSave" /></form>';
CloseTable4();
CloseTable();
include_once 'footer.php';

