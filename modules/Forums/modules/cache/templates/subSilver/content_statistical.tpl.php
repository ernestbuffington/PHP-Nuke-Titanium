<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

if ($this->security()) {
echo '<!-- view:statistical -->';echo '

<table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%"> 
<tr> 
    <td class="catHead" align="center" colspan="' . ((isset($this->_tpldata['.'][0]['NUM_COLUMNS'])) ? $this->_tpldata['.'][0]['NUM_COLUMNS'] : '') . '"> 
        <span class="cattitle">' . ((isset($this->_tpldata['.'][0]['MODULE_NAME'])) ? $this->_tpldata['.'][0]['MODULE_NAME'] : '') . '</span> 
    </td> 
</tr> 
<tr>    
';// BEGIN column
$_column_count = (isset($this->_tpldata['column.'])) ?  count($this->_tpldata['column.']) : 0;
if ($_column_count) {
for ($_column_i = 0; $_column_i < $_column_count; $_column_i++)
{
echo '
    <th colspan="1" class=';// IF column.FIRST_COLUMN
if ($this->_tpldata['column.'][$_column_i]['FIRST_COLUMN']) { 
echo '"thCornerL"';// ELSEIF column.LAST_COLUMN
} elseif ($this->_tpldata['column.'][$_column_i]['LAST_COLUMN']) { 
echo '"thCornerR"';// ELSE
} else {
echo '"thTop"';// ENDIF
}
echo ' align="center" ';// IF not column.FIRST_COLUMN and not column.LAST_COLUMN
if (! $this->_tpldata['column.'][$_column_i]['FIRST_COLUMN'] && ! $this->_tpldata['column.'][$_column_i]['LAST_COLUMN']) { 
echo 'width="10%"';// ENDIF
}
echo '><strong>' . ((isset($this->_tpldata['column.'][$_column_i]['VALUE'])) ? $this->_tpldata['column.'][$_column_i]['VALUE'] : '') . '</strong></th>
';}}
// END column
echo '
</tr> 

';// BEGIN row
$_row_count = (isset($this->_tpldata['row.'])) ?  count($this->_tpldata['row.']) : 0;
if ($_row_count) {
for ($_row_i = 0; $_row_i < $_row_count; $_row_i++)
{
echo '
  <tr> 
';// BEGIN row_column
$_row_column_count = (isset($this->_tpldata['row.'][$_row_i]['row_column.'])) ? count($this->_tpldata['row.'][$_row_i]['row_column.']) : 0;
if ($_row_column_count) {
for ($_row_column_i = 0; $_row_column_i < $_row_column_count; $_row_column_i++)
{
// IF row.row_column.RANK_COLUMN
if ($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['RANK_COLUMN']) { 
echo '
        <td class=';// IF row.row_column.ROW is even
if (!($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['ROW'] % 2)) { 
echo '"row1"';// ELSE
} else {
echo '"row2"';// ENDIF
}
echo ' align="' . ((isset($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['ALIGNMENT'])) ? $this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['ALIGNMENT'] : '') . '" width="10%"><span class="gen">' . ((isset($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['VALUE'])) ? $this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['VALUE'] : '') . '</span></td> 
    ';// ELSE
} else {
echo '
        <td class=';// IF row.row_column.ROW is even
if (!($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['ROW'] % 2)) { 
echo '"row1"';// ELSE
} else {
echo '"row2"';// ENDIF
}
echo ' align="' . ((isset($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['ALIGNMENT'])) ? $this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['ALIGNMENT'] : '') . '" ' . ((isset($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['WIDTH'])) ? $this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['WIDTH'] : '') . '>
        ';// IF row.row_column.AUTH_REPLACEMENT and row.row_column.AUTH_LANG_ENTRY
if ($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['AUTH_REPLACEMENT'] && $this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['AUTH_LANG_ENTRY']) { 
echo '
        <span class="gen" style="color:red">' . ((isset($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['VALUE'])) ? $this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['VALUE'] : '') . '</span>
        ';// ELSE
} else {
echo '
        <span class="gen">' . ((isset($this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['VALUE'])) ? $this->_tpldata['row.'][$_row_i]['row_column.'][$_row_column_i]['VALUE'] : '') . '</span>
        ';// ENDIF
}
echo '
        </td>
    ';// ENDIF
}
}}
// END row_column
echo '
  </tr> 
';}}
// END row
echo '

</table>';
}
?>