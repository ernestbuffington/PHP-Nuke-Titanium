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
OpenMenu(_AB_EDITPROTECTED);
mastermenu();
CarryMenu();
protectedmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
$getIPs = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_protected_ranges` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1"));
$ip_lo = explode(".", long2ip($getIPs['ip_lo']));
$ip_hi = explode(".", long2ip($getIPs['ip_hi']));
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="old_ip_lo" value="'.$getIPs['ip_lo'].'" />'."\n";
echo '<input type="hidden" name="old_ip_hi" value="'.$getIPs['ip_hi'].'" />'."\n";
echo '<input type="hidden" name="op" value="ABProtectedEditSave" />'."\n";
echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
echo '<input type="hidden" name="sip" value="'.$sip.'" />'."\n";
echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" colspan="2">'._AB_EDITPROTECTEDS.'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPLO.':</strong></td>'."\n";
echo '<td><input type="text" name="xip_lo[0]" size="4" maxlength="3" value="'.$ip_lo[0].'" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[1]" size="4" maxlength="3" value="'.$ip_lo[1].'" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[2]" size="4" maxlength="3" value="'.$ip_lo[2].'" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[3]" size="4" maxlength="3" value="'.$ip_lo[3].'" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPHI.':</strong></td>'."\n";
echo '<td><input type="text" name="xip_hi[0]" size="4" maxlength="3" value="'.$ip_hi[0].'" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[1]" size="4" maxlength="3" value="'.$ip_hi[1].'" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[2]" size="4" maxlength="3" value="'.$ip_hi[2].'" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[3]" size="4" maxlength="3" value="'.$ip_hi[3].'" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td><textarea name="xnotes" rows="10" cols="60">'.$getIPs['notes'].'</textarea></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_COUNTRY.':</strong></td>'."\n";
echo '<td><select name="xc2c">'."\n";
$result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_countries` ORDER BY `c2c`");
while($countryrow = $titanium_db->sql_fetchrow($result)) {
  echo '<option value="'.$countryrow['c2c'].'"';
  if($countryrow['c2c'] == $getIPs['c2c']) { echo ' selected="selected"'; }
  echo '>'.strtoupper($countryrow['c2c']).' - '.$countryrow['country'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>