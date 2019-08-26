<?php

// eXtreme Styles mod cache. Generated on Fri, 23 Aug 2019 16:44:39 +0000 (time=1566578679)

?><h1><?php echo isset($this->vars['L_TITLE']) ? $this->vars['L_TITLE'] : $this->lang('L_TITLE'); ?></h1>

<p><?php echo isset($this->vars['L_EXPLAIN']) ? $this->vars['L_EXPLAIN'] : $this->lang('L_EXPLAIN'); ?></p>

<table width="100%" cellpadding="6" cellspacing="1" border="0" class="forumline">
<tr>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap" colspan="2"><?php echo isset($this->vars['L_DESCRIPTION']) ? $this->vars['L_DESCRIPTION'] : $this->lang('L_DESCRIPTION'); ?></th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['L_ACTION']) ? $this->vars['L_ACTION'] : $this->lang('L_ACTION'); ?></th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['L_DELETE']) ? $this->vars['L_DELETE'] : $this->lang('L_DELETE'); ?></th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['L_DEPLACE']) ? $this->vars['L_DEPLACE'] : $this->lang('L_DEPLACE'); ?></th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['L_SYNCHRO']) ? $this->vars['L_SYNCHRO'] : $this->lang('L_SYNCHRO'); ?></th>
</tr>
<?php

$arcade_catrow_count = ( isset($this->_tpldata['arcade_catrow.']) ) ?  sizeof($this->_tpldata['arcade_catrow.']) : 0;
for ($arcade_catrow_i = 0; $arcade_catrow_i < $arcade_catrow_count; $arcade_catrow_i++)
{
 $arcade_catrow_item = &$this->_tpldata['arcade_catrow.'][$arcade_catrow_i];
 $arcade_catrow_item['S_ROW_COUNT'] = $arcade_catrow_i;
 $arcade_catrow_item['S_NUM_ROWS'] = $arcade_catrow_count;

?>
<tr>
 <td class="row1" ><?php echo isset($arcade_catrow_item['ARCADE_CATTITLE']) ? $arcade_catrow_item['ARCADE_CATTITLE'] : ''; ?></td>
 <td class="row2" width="20" align="center"><?php echo isset($arcade_catrow_item['ARCADE_CAT_NBELMT']) ? $arcade_catrow_item['ARCADE_CAT_NBELMT'] : ''; ?></td>
 <td class="row1" align="center">
 <a href="<?php echo isset($arcade_catrow_item['U_EDIT']) ? $arcade_catrow_item['U_EDIT'] : ''; ?>"><?php echo isset($this->vars['L_EDIT']) ? $this->vars['L_EDIT'] : $this->lang('L_EDIT'); ?></a><br />
  <a href="<?php echo isset($arcade_catrow_item['U_MANAGE']) ? $arcade_catrow_item['U_MANAGE'] : ''; ?>"><?php echo isset($this->vars['L_MANAGE']) ? $this->vars['L_MANAGE'] : $this->lang('L_MANAGE'); ?></a>
 </td>
 <td class="row2" align="center"><a href="<?php echo isset($arcade_catrow_item['U_DELETE']) ? $arcade_catrow_item['U_DELETE'] : ''; ?>"><?php echo isset($this->vars['L_DELETE']) ? $this->vars['L_DELETE'] : $this->lang('L_DELETE'); ?></a></td>
 <td class="row1" align="center">
 <a href="<?php echo isset($arcade_catrow_item['U_UP']) ? $arcade_catrow_item['U_UP'] : ''; ?>"><?php echo isset($arcade_catrow_item['L_UP']) ? $arcade_catrow_item['L_UP'] : ''; ?></a>
 <a href="<?php echo isset($arcade_catrow_item['U_DOWN']) ? $arcade_catrow_item['U_DOWN'] : ''; ?>"><?php echo isset($arcade_catrow_item['L_DOWN']) ? $arcade_catrow_item['L_DOWN'] : ''; ?></a>
 </td>
 <td class="row2" align="center"><a href="<?php echo isset($arcade_catrow_item['U_SYNCHRO']) ? $arcade_catrow_item['U_SYNCHRO'] : ''; ?>"><?php echo isset($this->vars['L_SYNCHRO']) ? $this->vars['L_SYNCHRO'] : $this->lang('L_SYNCHRO'); ?></a></td>
</tr>
<?php

} // END arcade_catrow

if(isset($arcade_catrow_item)) { unset($arcade_catrow_item); } 

?>
<form action="<?php echo isset($this->vars['S_ACTION']) ? $this->vars['S_ACTION'] : $this->lang('S_ACTION'); ?>" method="post"><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?> 
    <tr>
        <td class="cat" height="28" align="center" valign="middle" colspan="7">
        <input type="submit" name="<?php echo isset($this->vars['S_SUBMIT']) ? $this->vars['S_SUBMIT'] : $this->lang('S_SUBMIT'); ?>" value="<?php echo isset($this->vars['L_NEWCAT']) ? $this->vars['L_NEWCAT'] : $this->lang('L_NEWCAT'); ?>" class="mainoption" />
        </td>
    </tr>
</form>
</table>
<br />