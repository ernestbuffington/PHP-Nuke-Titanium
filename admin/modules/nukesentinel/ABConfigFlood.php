<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_FLOODBLOCKER);
mastermenu();
CarryMenu();
configmenu();
CloseMenu();
CloseTable();
echo "<br />\n";
OpenTable();
echo "<form action='".$admin_file.".php' method='post'>";
echo "<input type='hidden' name='xblocker_row[block_name]' value='flood' />\n";
echo "<input type='hidden' name='xop' value='$op' />\n";
echo "<input type='hidden' name='op' value='ABConfigSave' />\n";
echo "<table summary='' align='center' border='0' cellpadding='2' cellspacing='2'>";
$blocker_row = abget_blocker("flood");
$blocker_row['duration'] = $blocker_row['duration'] / 86400;
echo '<tr><td align="center" bgcolor="'.$bgcolor2.'" colspan="2"><strong>'._AB_FLOODBLOCKER.'</strong></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" width="25%">'.help_img(_AB_HELP_011).' '._AB_ACTIVATE.':</td><td width="75%">'."\n";
if(!empty($ab_config['ftaccess_path']) AND is_writable($ab_config['ftaccess_path'])) {
  $sel0 = $sel1 = $sel2 = $sel3 = $sel4 = $sel5 = $sel6 = $sel7 = $sel8 = $sel9 = "";
  if($blocker_row['activate']==1) { $sel1 = ' selected="selected"'; }
  elseif($blocker_row['activate']==2) { $sel2 = ' selected="selected"'; }
  elseif($blocker_row['activate']==3) { $sel3 = ' selected="selected"'; }
  elseif($blocker_row['activate']==4) { $sel4 = ' selected="selected"'; }
  elseif($blocker_row['activate']==5) { $sel5 = ' selected="selected"'; }
  elseif($blocker_row['activate']==6) { $sel6 = ' selected="selected"'; }
  elseif($blocker_row['activate']==7) { $sel7 = ' selected="selected"'; }
  elseif($blocker_row['activate']==8) { $sel8 = ' selected="selected"'; }
  elseif($blocker_row['activate']==9) { $sel9 = ' selected="selected"'; }
  else { $sel0 = ' selected="selected"'; }
  echo '<select name="xblocker_row[activate]">'."\n";
  echo '<option value="0"'.$sel0.'>'._AB_OFF.'</option>'."\n";
  echo '<option value="1"'.$sel1.'>'._AB_EMAILONLY.'</option>'."\n";
  echo '<option value="6"'.$sel6.'>'._AB_FORWARDONLY.'</option>'."\n";
  echo '<option value="7"'.$sel7.'>'._AB_TEMPLATEONLY.'</option>'."\n";
  echo '<option value="2"'.$sel2.'>'._AB_EMAILFORWARD.'</option>'."\n";
  echo '<option value="3"'.$sel3.'>'._AB_EMAILTEMPLATE.'</option>'."\n";
  echo '<option value="8"'.$sel8.'>'._AB_BLOCKFORWARD.'</option>'."\n";
  echo '<option value="9"'.$sel9.'>'._AB_BLOCKTEMPLATE.'</option>'."\n";
  echo '<option value="4"'.$sel4.'>'._AB_EMAILBLOCKFORWARD.'</option>'."\n";
  echo '<option value="5"'.$sel5.'>'._AB_EMAILBLOCKTEMPLATE.'</option>'."\n";
  echo '</select>'."\n";
} else {
  echo "<strong>"._AB_FTACCESSFAILED."</strong><input type='hidden' name='xblocker_row[activate]' value='0' />";
}
echo '</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_012).' '._AB_HTWRITE.':</td>'."\n".'<td>';
if(stristr($_SERVER['SERVER_SOFTWARE'], "Apache") AND $ab_config['htaccess_path'] > "") {
  echo '<select name="xblocker_row[htaccess]">'."\n";
  $sel1 = $sel2 = "";
  if($blocker_row['htaccess']==0) { $sel1 = ' selected="selected"'; } else { $sel2 = ' selected="selected"'; }
  echo '<option value="0"'.$sel1.'>'._AB_NO.'</option>'."\n";
  echo '<option value="1"'.$sel2.'>'._AB_YES.'</option>'."\n";
  echo '</select>'."\n";
} else {
  echo '<strong>'._AB_HTACCESSFAILED.'</strong><input type="hidden" name="xblocker_row[htaccess]" value="0" />';
}
echo '</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_013).' '._AB_FORWARD.':</td><td><input type="text" name="xblocker_row[forward]" size="50" value="'.$blocker_row['forward'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_014).' '._AB_BLOCKTYPE.':</td><td><select name="xblocker_row[block_type]">'."\n";
$sel1 = $sel2 = $sel3 = $sel4 = "";
if($blocker_row['block_type']==0) { $sel1 = ' selected="selected"'; }
elseif($blocker_row['block_type']==1) { $sel2 = ' selected="selected"'; }
elseif($blocker_row['block_type']==2) { $sel3 = ' selected="selected"'; }
else { $sel4 = ' selected="selected"'; }
echo '<option value="0"'.$sel1.'>'._AB_0OCTECT.'</option>'."\n";
echo '<option value="1"'.$sel2.'>'._AB_1OCTECT.'</option>'."\n";
echo '<option value="2"'.$sel3.'>'._AB_2OCTECT.'</option>'."\n";
echo '<option value="3"'.$sel4.'>'._AB_3OCTECT.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_015).' '._AB_TEMPLATE.':</td><td><select name="xblocker_row[template]">'."\n";
$phpbb2_templatedir = dir(NUKE_INCLUDE_DIR.'nukesentinel/abuse');
$phpbb2_templatelist = '';
while($func=$phpbb2_templatedir->read()) {
  if(substr($func, 0, 6) == 'abuse_') { $phpbb2_templatelist .= $func.' '; }
}
closedir($phpbb2_templatedir->handle);
$phpbb2_templatelist = explode(" ", $phpbb2_templatelist);
sort($phpbb2_templatelist);
for($i=0; $i < sizeof($phpbb2_templatelist); $i++) {
  if($phpbb2_templatelist[$i]!="") {
    $bl = str_replace("abuse_", "", $phpbb2_templatelist[$i]);
    $bl = str_replace(".tpl", "", $bl);
    $bl = str_replace("_", " ", $bl);
    echo '<option';
    if($phpbb2_templatelist[$i]==$blocker_row['template']) { echo ' selected="selected"'; }
    echo ' value="'.$phpbb2_templatelist[$i].'">'.ucfirst($bl).'</option>'."\n";
  }
}
echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_016).' '._AB_EMAILLOOKUP.':</td>'."\n";
$mailtest = @mail();
if(!$mailtest AND !stristr($_SERVER['SERVER_SOFTWARE'], "PHP-CGI")) {
  $sel0 = $sel1 = $sel2 = $sel3 = "";
  if($blocker_row['email_lookup']==1) { $sel1 = ' selected="selected"'; }
  elseif($blocker_row['email_lookup']==2) { $sel2 = ' selected="selected"'; }
  elseif($blocker_row['email_lookup']==3) { $sel3 = ' selected="selected"'; }
  else { $sel0 = ' selected="selected"'; }
  echo '<td><select name="xblocker_row[email_lookup]">'."\n";
  echo '<option value="0"'.$sel0.'>'._AB_OFF.'</option>'."\n";
  echo '<option value="1"'.$sel1.'>'._AB_SEL1.'</option>'."\n";
  echo '<option value="1"'.$sel2.'>'._AB_SEL2.'</option>'."\n";
  echo '<option value="1"'.$sel3.'>'._AB_SEL3.'</option>'."\n";
  echo '</select></td>'."\n";
} else {
  echo '<td><strong>'._AB_NOTAVAILABLE.'</strong><input type="hidden" name="xblocker_row[email_lookup]" value="0" /><td>'."\n";
}
echo '</tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_017).' '._AB_REASON.':</td><td><input type="text" name="xblocker_row[reason]" size="20" maxlength="20" value="'.$blocker_row['reason'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_018).' '._AB_DURATION.':</td><td><select name="xblocker_row[duration]">'."\n";
echo '<option value="0"';
if($blocker_row['duration']==0) { echo ' selected="selected"'; }
echo '>'._AB_PERMENANT.'</option>'."\n";
$i=1;
while($i<=365) {
  echo '<option value="'.$i.'"';
  if($blocker_row['duration']==$i) { echo ' selected="selected"'; }
  $expiredate = date("Y-m-d", time() + ($i * 86400));
  echo '>'.$i.' ('.$expiredate.')</option>'."\n";
  $i++;
}
echo '</select></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>