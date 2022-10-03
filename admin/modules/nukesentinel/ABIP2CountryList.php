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
OpenMenu(_AB_IP2CLISTING);
mastermenu();
CarryMenu();
ip2cmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
$perpage = $ab_config['block_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($showcountry)) $showcountry="All_Countries";
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
if(!isset($column) or !$column or $column=="") $column = "ip_lo";
if(!isset($direction) or !$direction or $direction=="") $direction = "asc";
if(preg_match("#All(.*)Countries#", $showcountry) || !$showcountry) {
  $modfilter="";
} else {
  $modfilter="WHERE `c2c` = '$showcountry'";
}
$totalselected = $titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_ip2country` $modfilter"));
if($totalselected > 0) {
  $selcolumn1 = $selcolumn2 = $selcolumn3 = $seldirection1 = $seldirection2 = "";
  if($column == "c2c") { $selcolumn2 = ' selected="selected"'; }
  elseif($column == "date") { $selcolumn3 = ' selected="selected"'; }
  else { $selcolumn1 = ' selected="selected"'; }
  if($direction == "desc") { $seldirection2 = ' selected="selected"'; }
  else { $seldirection1 = ' selected="selected"'; }
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" width="100%">'."\n";
  echo '<tr>'."\n";
  // START Modules
  echo '<td width="60%" nowrap="nowrap"><form action="'.$admin_file.'.php?op=ABIP2CountryList" method="post">'."\n";
  echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
  echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
  echo '<strong>'._AB_COUNTRY.':</strong> <select name="showcountry">'."\n";
  echo '<option value="&nbsp;All&nbsp;Countries" ';
  if($showcountry=="&nbsp;All&nbsp;Countries") { echo ' selected="selected"'; }
  echo '>All Countries</option>'."\n";
  $countries = $titanium_db->sql_query("SELECT `c2c`, `country` FROM `".$titanium_prefix."_nsnst_countries` ORDER BY `c2c`");;
  while(list($xc2c, $xcountry) = $titanium_db->sql_fetchrow($countries)) {
    echo '<option value="'.$xc2c.'" ';
    if($showcountry == $xc2c) { echo ' selected="selected"'; }
    echo '>'.strtoupper($xc2c).' - '.$xcountry.'</option>'."\n";
  }
  echo '</select> <input type="submit" value="'._AB_GO.'" /></form></td>'."\n";
  // END Modules
  // Page Sorting
  echo '<td align="right" width="40%" nowrap="nowrap"><form method="post" action="'.$admin_file.'.php?op=ABIP2CountryList">'."\n";
  echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
  echo '<input type="hidden" name="showcountry" value="'.$showcountry.'" />'."\n";
  echo '<strong>'._AB_SORT.':</strong> <select name="column">'."\n";
  echo '<option value="ip_lo"'.$selcolumn1.'>'._AB_IP2CRANGE.'</option>'."\n";
  echo '<option value="c2c"'.$selcolumn2.'>'._AB_C2CODE.'</option>'."\n";
  echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
  echo '</select> <select name="direction">'."\n";
  echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
  echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
  echo '</select> <input type="submit" value="'._AB_SORT.'" />'."\n";
  echo '</form></td>'."\n";
  // Page Sorting
  echo '</tr>'."\n";
  echo '</table>'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="100%">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td width="20%"><strong>'._AB_IPLO.'</strong></td>'."\n";
  echo '<td width="20%"><strong>'._AB_IPHI.'</strong></td>'."\n";
  echo '<td align="center" width="2%"><strong>&nbsp;</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="25%"><strong>'._AB_CIDRS.'</strong></td>'."\n";
  echo '<td align="center" width="10%"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_nsnst_ip2country` $modfilter ORDER BY $column $direction LIMIT $min,$perpage");
  while($getIPs = $titanium_db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $getIPs1 = abget_countrytitle($getIPs['c2c']);
    $getIPs['country'] = $getIPs1['country'];
    $masscidr = ABGetCIDRs($getIPs['ip_lo'], $getIPs['ip_hi']);
    $masscidr = str_replace("||", ",<br />", $masscidr);
    if(stristr($masscidr, "<br />")) { $valign = ' valign="top"'; } else { $valign = ''; }
    $getIPs['c2c'] = strtoupper($getIPs['c2c']);
    $getIPs['flag_img'] = flag_img($getIPs['c2c']);
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_lo_ip'].'" target="_blank">'.$getIPs['ip_lo_ip'].'</a></td>'."\n";
    echo '<td'.$valign.'><a href="'.$ab_config['lookup_link'].$getIPs['ip_hi_ip'].'" target="_blank">'.$getIPs['ip_hi_ip'].'</a></td>'."\n";
    echo '<td align="center"'.$valign.'>'.$getIPs['flag_img'].'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.date("Y-m-d",$getIPs['date']).'</td>'."\n";
    echo '<td align="center"'.$valign.'>'.$masscidr.'</td>'."\n";
    echo '<td align="center"'.$valign.' nowrap="nowrap"><a href="'.$admin_file.'.php?op=ABBlockedRangeAdd&amp;ip_lo='.$getIPs['ip_lo_ip'].'&amp;ip_hi='.$getIPs['ip_hi_ip'].'&amp;tc2c='.strtolower($getIPs['c2c']).'" target="_blank"><img src="images/nukesentinel/block.png" border="0" alt="'._AB_BLOCK.'" title="'._AB_BLOCK.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABIP2CountryEdit&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'&amp;showcountry='.$showcountry.'"><img src="images/nukesentinel/edit.png" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" height="16" width="16" /></a>'."\n";
    echo '<a href="'.$admin_file.'.php?op=ABIP2CountryDelete&amp;ip_lo='.$getIPs['ip_lo'].'&amp;ip_hi='.$getIPs['ip_hi'].'&amp;min='.$min.'&amp;column='.$column.'&amp;direction='.$direction.'&amp;xop='.$op.'&amp;showcountry='.$showcountry.'"><img src="images/nukesentinel/delete.png" border="0" alt="'._AB_DELETE.'" title="'._AB_DELETE.'" height="16" width="16" /></a></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction, $showcountry);
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>