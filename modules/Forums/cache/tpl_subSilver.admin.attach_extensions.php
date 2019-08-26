<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 17:00:36 +0000 (time=1566838836)

?>
<h1><?php echo isset($this->vars['L_EXTENSIONS_TITLE']) ? $this->vars['L_EXTENSIONS_TITLE'] : $this->lang('L_EXTENSIONS_TITLE'); ?></h1>

<p><?php echo isset($this->vars['L_EXTENSIONS_EXPLAIN']) ? $this->vars['L_EXTENSIONS_EXPLAIN'] : $this->lang('L_EXTENSIONS_EXPLAIN'); ?></p>

<?php echo isset($this->vars['ERROR_BOX']) ? $this->vars['ERROR_BOX'] : $this->lang('ERROR_BOX'); ?>

<form method="post" action="<?php echo isset($this->vars['S_ATTACH_ACTION']) ? $this->vars['S_ATTACH_ACTION'] : $this->lang('S_ATTACH_ACTION'); ?>">
  <table width="100%" align="center" cellpadding="4" cellspacing="1" border="0" class="forumline">
    <tr> 
      <td class="catHead" colspan="5" align="center" height="28"><span class="cattitle"><?php echo isset($this->vars['L_EXTENSIONS_TITLE']) ? $this->vars['L_EXTENSIONS_TITLE'] : $this->lang('L_EXTENSIONS_TITLE'); ?></span> 
      </td>
    </tr>
    <tr> 
      <th class="thLeft">&nbsp;<?php echo isset($this->vars['L_EXPLANATION']) ? $this->vars['L_EXPLANATION'] : $this->lang('L_EXPLANATION'); ?>&nbsp;</th>
      <th>&nbsp;<?php echo isset($this->vars['L_EXTENSION']) ? $this->vars['L_EXTENSION'] : $this->lang('L_EXTENSION'); ?>&nbsp;</th>
      <th>&nbsp;<?php echo isset($this->vars['L_EXTENSION_GROUP']) ? $this->vars['L_EXTENSION_GROUP'] : $this->lang('L_EXTENSION_GROUP'); ?>&nbsp;</th>
      <th class="thRight">&nbsp;<?php echo isset($this->vars['L_ADD_NEW']) ? $this->vars['L_ADD_NEW'] : $this->lang('L_ADD_NEW'); ?>&nbsp;</th>
    </tr>
    <tr>
      <td class="row1" align="center" valign="middle"><input type="text" size="30" maxlength="100" name="add_extension_explain" class="post" value="<?php echo isset($this->vars['ADD_EXTENSION_EXPLAIN']) ? $this->vars['ADD_EXTENSION_EXPLAIN'] : $this->lang('ADD_EXTENSION_EXPLAIN'); ?>" /></td>
      <td class="row2" align="center" valign="middle"><input type="text" size="20" maxlength="100" name="add_extension" class="post" value="<?php echo isset($this->vars['ADD_EXTENSION']) ? $this->vars['ADD_EXTENSION'] : $this->lang('ADD_EXTENSION'); ?>" /></td>
      <td class="row1" align="center" valign="middle"><?php echo isset($this->vars['S_ADD_GROUP_SELECT']) ? $this->vars['S_ADD_GROUP_SELECT'] : $this->lang('S_ADD_GROUP_SELECT'); ?></td>
      <td class="row2" align="center" valign="middle"><input type="checkbox" name="add_extension_check" /></td>
    </tr>
    <tr align="right"> 
      <td class="catBottom" colspan="5" height="29"> <?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?> <input type="submit" name="submit" class="liteoption" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" /></td>
    </tr>
    <tr> 
      <th class="thLeft">&nbsp;<?php echo isset($this->vars['L_EXPLANATION']) ? $this->vars['L_EXPLANATION'] : $this->lang('L_EXPLANATION'); ?>&nbsp;</th>
      <th>&nbsp;<?php echo isset($this->vars['L_EXTENSION']) ? $this->vars['L_EXTENSION'] : $this->lang('L_EXTENSION'); ?>&nbsp;</th>
      <th>&nbsp;<?php echo isset($this->vars['L_EXTENSION_GROUP']) ? $this->vars['L_EXTENSION_GROUP'] : $this->lang('L_EXTENSION_GROUP'); ?>&nbsp;</th>
      <th class="thRight">&nbsp;<?php echo isset($this->vars['L_DELETE']) ? $this->vars['L_DELETE'] : $this->lang('L_DELETE'); ?>&nbsp;</th>
    </tr>
<?php

$extension_row_count = ( isset($this->_tpldata['extension_row.']) ) ?  sizeof($this->_tpldata['extension_row.']) : 0;
for ($extension_row_i = 0; $extension_row_i < $extension_row_count; $extension_row_i++)
{
 $extension_row_item = &$this->_tpldata['extension_row.'][$extension_row_i];
 $extension_row_item['S_ROW_COUNT'] = $extension_row_i;
 $extension_row_item['S_NUM_ROWS'] = $extension_row_count;

?>
    <tr> 
      <input type="hidden" name="extension_change_list[]" value="<?php echo isset($extension_row_item['EXT_ID']) ? $extension_row_item['EXT_ID'] : ''; ?>" />
      <td class="row1" align="center" valign="middle"><input type="text" size="30" maxlength="100" name="extension_explain_list[]" class="post" value="<?php echo isset($extension_row_item['EXTENSION_EXPLAIN']) ? $extension_row_item['EXTENSION_EXPLAIN'] : ''; ?>" /></td>
      <td class="row2" align="center" valign="middle"><strong><span class="gen"><?php echo isset($extension_row_item['EXTENSION']) ? $extension_row_item['EXTENSION'] : ''; ?></span></strong></td>
      <td class="row1" align="center" valign="middle"><?php echo isset($extension_row_item['S_GROUP_SELECT']) ? $extension_row_item['S_GROUP_SELECT'] : ''; ?></td>
      <td class="row2" align="center" valign="middle"><input type="checkbox" name="extension_id_list[]" value="<?php echo isset($extension_row_item['EXT_ID']) ? $extension_row_item['EXT_ID'] : ''; ?>" /></td>
    </tr>
<?php

} // END extension_row

if(isset($extension_row_item)) { unset($extension_row_item); } 

?>
    <tr align="right"> 
      <td class="catBottom" colspan="5" height="29"> 
      <input type="submit" name="<?php echo isset($this->vars['L_CANCEL']) ? $this->vars['L_CANCEL'] : $this->lang('L_CANCEL'); ?>" class="liteoption" value="<?php echo isset($this->vars['L_CANCEL']) ? $this->vars['L_CANCEL'] : $this->lang('L_CANCEL'); ?>" onClick="self.location.href='<?php echo isset($this->vars['S_CANCEL_ACTION']) ? $this->vars['S_CANCEL_ACTION'] : $this->lang('S_CANCEL_ACTION'); ?>'" />
      <input type="submit" name="submit" class="liteoption" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" /></td>
    </tr>
</table>

</form>

<br />
<div align="center"><span class="copyright"><?php echo isset($this->vars['ATTACH_VERSION']) ? $this->vars['ATTACH_VERSION'] : $this->lang('ATTACH_VERSION'); ?></span></div>

<br clear="all" />
