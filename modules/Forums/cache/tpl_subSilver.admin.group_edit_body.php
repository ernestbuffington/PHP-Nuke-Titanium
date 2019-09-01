<?php

// eXtreme Styles mod cache. Generated on Fri, 30 Aug 2019 21:31:15 +0000 (time=1567200675)

?><h1><?php echo isset($this->vars['L_GROUP_TITLE']) ? $this->vars['L_GROUP_TITLE'] : $this->lang('L_GROUP_TITLE'); ?></h1>

<form action="<?php echo isset($this->vars['S_GROUP_ACTION']) ? $this->vars['S_GROUP_ACTION'] : $this->lang('S_GROUP_ACTION'); ?>" method="post" name="post"><table border="0" cellpadding="3" cellspacing="1" class="forumline" align="center">
    <tr> 
      <th class="thHead" colspan="2"><?php echo isset($this->vars['L_GROUP_EDIT_DELETE']) ? $this->vars['L_GROUP_EDIT_DELETE'] : $this->lang('L_GROUP_EDIT_DELETE'); ?></th>
    </tr>
    <tr>
      <td class="row1" colspan="2"><span class="gensmall"><?php echo isset($this->vars['L_ITEMS_REQUIRED']) ? $this->vars['L_ITEMS_REQUIRED'] : $this->lang('L_ITEMS_REQUIRED'); ?></span></td>
    </tr>
    <tr> 
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_NAME']) ? $this->vars['L_GROUP_NAME'] : $this->lang('L_GROUP_NAME'); ?>:</span></td>
      <td class="row2" width="62%"> 
        <input type="text" name="group_name" size="35" maxlength="40" value="<?php echo isset($this->vars['GROUP_NAME']) ? $this->vars['GROUP_NAME'] : $this->lang('GROUP_NAME'); ?>" />
      </td>
    </tr>
    <tr> 
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_DESCRIPTION']) ? $this->vars['L_GROUP_DESCRIPTION'] : $this->lang('L_GROUP_DESCRIPTION'); ?>:</span></td>
      <td class="row2" width="62%"> 
        <textarea name="group_description" rows=5 cols=51><?php echo isset($this->vars['GROUP_DESCRIPTION']) ? $this->vars['GROUP_DESCRIPTION'] : $this->lang('GROUP_DESCRIPTION'); ?></textarea>
      </td>
    </tr>
    <tr> 
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_MODERATOR']) ? $this->vars['L_GROUP_MODERATOR'] : $this->lang('L_GROUP_MODERATOR'); ?>:</span></td>
      <td class="row2" width="62%"><input type="text" class="post" name="username" maxlength="50" size="20" value="<?php echo isset($this->vars['GROUP_MODERATOR']) ? $this->vars['GROUP_MODERATOR'] : $this->lang('GROUP_MODERATOR'); ?>" />   <input type="submit" name="usersubmit" value="<?php echo isset($this->vars['L_FIND_USERNAME']) ? $this->vars['L_FIND_USERNAME'] : $this->lang('L_FIND_USERNAME'); ?>" class="liteoption" onclick="window.open('<?php echo isset($this->vars['U_SEARCH_USER']) ? $this->vars['U_SEARCH_USER'] : $this->lang('U_SEARCH_USER'); ?>', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></td>
    </tr>

    <tr> 
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_STATUS']) ? $this->vars['L_GROUP_STATUS'] : $this->lang('L_GROUP_STATUS'); ?>:</span></td>
      <td class="row2" width="62%"> 
        <input type="radio" name="group_type" value="<?php echo isset($this->vars['S_GROUP_OPEN_TYPE']) ? $this->vars['S_GROUP_OPEN_TYPE'] : $this->lang('S_GROUP_OPEN_TYPE'); ?>" <?php echo isset($this->vars['S_GROUP_OPEN_CHECKED']) ? $this->vars['S_GROUP_OPEN_CHECKED'] : $this->lang('S_GROUP_OPEN_CHECKED'); ?> /> <?php echo isset($this->vars['L_GROUP_OPEN']) ? $this->vars['L_GROUP_OPEN'] : $this->lang('L_GROUP_OPEN'); ?>   <input type="radio" name="group_type" value="<?php echo isset($this->vars['S_GROUP_CLOSED_TYPE']) ? $this->vars['S_GROUP_CLOSED_TYPE'] : $this->lang('S_GROUP_CLOSED_TYPE'); ?>" <?php echo isset($this->vars['S_GROUP_CLOSED_CHECKED']) ? $this->vars['S_GROUP_CLOSED_CHECKED'] : $this->lang('S_GROUP_CLOSED_CHECKED'); ?> />    <?php echo isset($this->vars['L_GROUP_CLOSED']) ? $this->vars['L_GROUP_CLOSED'] : $this->lang('L_GROUP_CLOSED'); ?>   <input type="radio" name="group_type" value="<?php echo isset($this->vars['S_GROUP_HIDDEN_TYPE']) ? $this->vars['S_GROUP_HIDDEN_TYPE'] : $this->lang('S_GROUP_HIDDEN_TYPE'); ?>" <?php echo isset($this->vars['S_GROUP_HIDDEN_CHECKED']) ? $this->vars['S_GROUP_HIDDEN_CHECKED'] : $this->lang('S_GROUP_HIDDEN_CHECKED'); ?> />    <?php echo isset($this->vars['L_GROUP_HIDDEN']) ? $this->vars['L_GROUP_HIDDEN'] : $this->lang('L_GROUP_HIDDEN'); ?></td> 
    </tr>
<tr> 
  <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_COUNT']) ? $this->vars['L_GROUP_COUNT'] : $this->lang('L_GROUP_COUNT'); ?>:<br/><?php echo isset($this->vars['L_GROUP_COUNT_MAX']) ? $this->vars['L_GROUP_COUNT_MAX'] : $this->lang('L_GROUP_COUNT_MAX'); ?>:</span><br/>
  <span class="gensmall"><?php echo isset($this->vars['L_GROUP_COUNT_EXPLAIN']) ? $this->vars['L_GROUP_COUNT_EXPLAIN'] : $this->lang('L_GROUP_COUNT_EXPLAIN'); ?></span></td>
  <td class="row2" width="62%"><input type="text" class="post" name="group_count" maxlength="12" size="12" value="<?php echo isset($this->vars['GROUP_COUNT']) ? $this->vars['GROUP_COUNT'] : $this->lang('GROUP_COUNT'); ?>" /><br/><input type="text" class="post" name="group_count_max" maxlength="12" size="12" value="<?php echo isset($this->vars['GROUP_COUNT_MAX']) ? $this->vars['GROUP_COUNT_MAX'] : $this->lang('GROUP_COUNT_MAX'); ?>" />
	<br/>&nbsp;&nbsp; <span class="gen"></span><input type="checkbox" name="group_count_enable" <?php echo isset($this->vars['GROUP_COUNT_ENABLE_CHECKED']) ? $this->vars['GROUP_COUNT_ENABLE_CHECKED'] : $this->lang('GROUP_COUNT_ENABLE_CHECKED'); ?> >&nbsp;<?php echo isset($this->vars['L_GROUP_COUNT_ENABLE']) ? $this->vars['L_GROUP_COUNT_ENABLE'] : $this->lang('L_GROUP_COUNT_ENABLE'); ?>
	<br/>&nbsp;&nbsp; <input type="checkbox" name="group_count_update" value="0"/>&nbsp;<?php echo isset($this->vars['L_GROUP_COUNT_UPDATE']) ? $this->vars['L_GROUP_COUNT_UPDATE'] : $this->lang('L_GROUP_COUNT_UPDATE'); ?>
	<br/>&nbsp;&nbsp; <input type="checkbox" name="group_count_delete" value="0"/>&nbsp;<?php echo isset($this->vars['L_GROUP_COUNT_DELETE']) ? $this->vars['L_GROUP_COUNT_DELETE'] : $this->lang('L_GROUP_COUNT_DELETE'); ?></span>
  </td>
</tr>
    <!-- Start add - Initial Usergroup Mod -->
    <tr>
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_INITIAL']) ? $this->vars['L_GROUP_INITIAL'] : $this->lang('L_GROUP_INITIAL'); ?>:</span>
          <br />
          <span class="gensmall"><?php echo isset($this->vars['L_GROUP_INITIAL_EXPLAIN']) ? $this->vars['L_GROUP_INITIAL_EXPLAIN'] : $this->lang('L_GROUP_INITIAL_EXPLAIN'); ?></span></td>
      <td class="row2" width="62%">
        <input type="radio" name="initial_group" value="<?php echo isset($this->vars['S_GROUP_INITIAL_YES_TYPE']) ? $this->vars['S_GROUP_INITIAL_YES_TYPE'] : $this->lang('S_GROUP_INITIAL_YES_TYPE'); ?>" <?php echo isset($this->vars['S_GROUP_INITIAL_YES_CHECKED']) ? $this->vars['S_GROUP_INITIAL_YES_CHECKED'] : $this->lang('S_GROUP_INITIAL_YES_CHECKED'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> &nbsp;&nbsp;<input type="radio" name="initial_group" value="<?php echo isset($this->vars['S_GROUP_INITIAL_NO_TYPE']) ? $this->vars['S_GROUP_INITIAL_NO_TYPE'] : $this->lang('S_GROUP_INITIAL_NO_TYPE'); ?>" <?php echo isset($this->vars['S_GROUP_INITIAL_NO_CHECKED']) ? $this->vars['S_GROUP_INITIAL_NO_CHECKED'] : $this->lang('S_GROUP_INITIAL_NO_CHECKED'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
    </tr>
    <!-- End add - Initial Usergroup Mod -->
    <!-- Start add - Custom mass PM MOD -->
    <tr> 
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_ALLOW_PM']) ? $this->vars['L_GROUP_ALLOW_PM'] : $this->lang('L_GROUP_ALLOW_PM'); ?>:</span><br />
      <span class="gensmall"><?php echo isset($this->vars['L_GROUP_ALLOW_PM_EXPLAIN']) ? $this->vars['L_GROUP_ALLOW_PM_EXPLAIN'] : $this->lang('L_GROUP_ALLOW_PM_EXPLAIN'); ?></span></td>
      <td class="row2" width="62%">
        <input type="radio" name="group_allow_pm" value="<?php echo isset($this->vars['S_GROUP_ALL_ALLOW_PM']) ? $this->vars['S_GROUP_ALL_ALLOW_PM'] : $this->lang('S_GROUP_ALL_ALLOW_PM'); ?>" <?php echo isset($this->vars['S_GROUP_ALL_ALLOW_PM_CHECKED']) ? $this->vars['S_GROUP_ALL_ALLOW_PM_CHECKED'] : $this->lang('S_GROUP_ALL_ALLOW_PM_CHECKED'); ?> /> <?php echo isset($this->vars['L_GROUP_ALL_ALLOW_PM']) ? $this->vars['L_GROUP_ALL_ALLOW_PM'] : $this->lang('L_GROUP_ALL_ALLOW_PM'); ?>   
        <input type="radio" name="group_allow_pm" value="<?php echo isset($this->vars['S_GROUP_REG_ALLOW_PM']) ? $this->vars['S_GROUP_REG_ALLOW_PM'] : $this->lang('S_GROUP_REG_ALLOW_PM'); ?>" <?php echo isset($this->vars['S_GROUP_REG_ALLOW_PM_CHECKED']) ? $this->vars['S_GROUP_REG_ALLOW_PM_CHECKED'] : $this->lang('S_GROUP_REG_ALLOW_PM_CHECKED'); ?> /> <?php echo isset($this->vars['L_GROUP_REG_ALLOW_PM']) ? $this->vars['L_GROUP_REG_ALLOW_PM'] : $this->lang('L_GROUP_REG_ALLOW_PM'); ?>   
        <input type="radio" name="group_allow_pm" value="<?php echo isset($this->vars['S_GROUP_PRIVATE_ALLOW_PM']) ? $this->vars['S_GROUP_PRIVATE_ALLOW_PM'] : $this->lang('S_GROUP_PRIVATE_ALLOW_PM'); ?>" <?php echo isset($this->vars['S_GROUP_PRIVATE_ALLOW_PM_CHECKED']) ? $this->vars['S_GROUP_PRIVATE_ALLOW_PM_CHECKED'] : $this->lang('S_GROUP_PRIVATE_ALLOW_PM_CHECKED'); ?> /> <?php echo isset($this->vars['L_GROUP_PRIVATE_ALLOW_PM']) ? $this->vars['L_GROUP_PRIVATE_ALLOW_PM'] : $this->lang('L_GROUP_PRIVATE_ALLOW_PM'); ?>   
        <input type="radio" name="group_allow_pm" value="<?php echo isset($this->vars['S_GROUP_MOD_ALLOW_PM']) ? $this->vars['S_GROUP_MOD_ALLOW_PM'] : $this->lang('S_GROUP_MOD_ALLOW_PM'); ?>" <?php echo isset($this->vars['S_GROUP_MOD_ALLOW_PM_CHECKED']) ? $this->vars['S_GROUP_MOD_ALLOW_PM_CHECKED'] : $this->lang('S_GROUP_MOD_ALLOW_PM_CHECKED'); ?> /> <?php echo isset($this->vars['L_GROUP_MOD_ALLOW_PM']) ? $this->vars['L_GROUP_MOD_ALLOW_PM'] : $this->lang('L_GROUP_MOD_ALLOW_PM'); ?>   
        <input type="radio" name="group_allow_pm" value="<?php echo isset($this->vars['S_GROUP_ADMIN_ALLOW_PM']) ? $this->vars['S_GROUP_ADMIN_ALLOW_PM'] : $this->lang('S_GROUP_ADMIN_ALLOW_PM'); ?>" <?php echo isset($this->vars['S_GROUP_ADMIN_ALLOW_PM_CHECKED']) ? $this->vars['S_GROUP_ADMIN_ALLOW_PM_CHECKED'] : $this->lang('S_GROUP_ADMIN_ALLOW_PM_CHECKED'); ?> /> <?php echo isset($this->vars['L_GROUP_ADMIN_ALLOW_PM']) ? $this->vars['L_GROUP_ADMIN_ALLOW_PM'] : $this->lang('L_GROUP_ADMIN_ALLOW_PM'); ?> 
      </td> 
    </tr>

    <!-- End add - Custom mass PM MOD -->
    <tr> 
      <td class="row1" width="38%"><?php echo isset($this->vars['L_GROUP_COLOR']) ? $this->vars['L_GROUP_COLOR'] : $this->lang('L_GROUP_COLOR'); ?></td>
      <td class="row2" width="62%"><?php echo isset($this->vars['GROUP_COLOR']) ? $this->vars['GROUP_COLOR'] : $this->lang('GROUP_COLOR'); ?></td>
    </tr>
    <tr> 
      <td class="row1" width="38%"><?php echo isset($this->vars['L_GROUP_RANK']) ? $this->vars['L_GROUP_RANK'] : $this->lang('L_GROUP_RANK'); ?></td>
      <td class="row2" width="62%"><?php echo isset($this->vars['GROUP_RANK']) ? $this->vars['GROUP_RANK'] : $this->lang('GROUP_RANK'); ?></td>
    </tr>

	<!-- Start add - Enhanced BBGroups MOD -->
        <tr>
           <td class="row1" width="38%"><?php echo isset($this->vars['L_MAX_INBOX']) ? $this->vars['L_MAX_INBOX'] : $this->lang('L_MAX_INBOX'); ?></td>
           <td class="row2" width="62%"><input type="text" class="post" name="max_inbox" maxlength="10" size="10" value="<?php echo isset($this->vars['MAX_INBOX']) ? $this->vars['MAX_INBOX'] : $this->lang('MAX_INBOX'); ?>" /><input type="checkbox" name="override_max_inbox" value="<?php echo isset($this->vars['OVERRIDE_MAX_INBOX']) ? $this->vars['OVERRIDE_MAX_INBOX'] : $this->lang('OVERRIDE_MAX_INBOX'); ?>"><?php echo isset($this->vars['L_OVERRIDE_MAX']) ? $this->vars['L_OVERRIDE_MAX'] : $this->lang('L_OVERRIDE_MAX'); ?></td>
        </tr>
        <tr>
           <td class="row1" width="38%"><?php echo isset($this->vars['L_MAX_SENTBOX']) ? $this->vars['L_MAX_SENTBOX'] : $this->lang('L_MAX_SENTBOX'); ?></td>
           <td class="row2" width="62%"><input type="text" class="post" name="max_sentbox" maxlength="10" size="10" value="<?php echo isset($this->vars['MAX_SENTBOX']) ? $this->vars['MAX_SENTBOX'] : $this->lang('MAX_SENTBOX'); ?>" /><input type="checkbox" name="override_max_sentbox" value="<?php echo isset($this->vars['OVERRIDE_MAX_SENTBOX']) ? $this->vars['OVERRIDE_MAX_SENTBOX'] : $this->lang('OVERRIDE_MAX_SENTBOX'); ?>"><?php echo isset($this->vars['L_OVERRIDE_MAX']) ? $this->vars['L_OVERRIDE_MAX'] : $this->lang('L_OVERRIDE_MAX'); ?></td>
        </tr>
        <tr>
           <td class="row1" width="38%"><?php echo isset($this->vars['L_MAX_SAVEBOX']) ? $this->vars['L_MAX_SAVEBOX'] : $this->lang('L_MAX_SAVEBOX'); ?></td>
           <td class="row2" width="62%"><input type="text" class="post" name="max_savebox" maxlength="10" size="10" value="<?php echo isset($this->vars['MAX_SAVEBOX']) ? $this->vars['MAX_SAVEBOX'] : $this->lang('MAX_SAVEBOX'); ?>" /><input type="checkbox" name="override_max_savebox" value="<?php echo isset($this->vars['OVERRIDE_MAX_SAVEBOX']) ? $this->vars['OVERRIDE_MAX_SAVEBOX'] : $this->lang('OVERRIDE_MAX_SAVEBOX'); ?>"><?php echo isset($this->vars['L_OVERRIDE_MAX']) ? $this->vars['L_OVERRIDE_MAX'] : $this->lang('L_OVERRIDE_MAX'); ?></td>
        </tr>
	<!-- End add - Enhanced BBGroups MOD -->

    <?php

$group_edit_count = ( isset($this->_tpldata['group_edit.']) ) ?  sizeof($this->_tpldata['group_edit.']) : 0;
for ($group_edit_i = 0; $group_edit_i < $group_edit_count; $group_edit_i++)
{
 $group_edit_item = &$this->_tpldata['group_edit.'][$group_edit_i];
 $group_edit_item['S_ROW_COUNT'] = $group_edit_i;
 $group_edit_item['S_NUM_ROWS'] = $group_edit_count;

?>

    <tr> 
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_DELETE_MODERATOR']) ? $this->vars['L_DELETE_MODERATOR'] : $this->lang('L_DELETE_MODERATOR'); ?></span>
      <br />
      <span class="gensmall"><?php echo isset($this->vars['L_DELETE_MODERATOR_EXPLAIN']) ? $this->vars['L_DELETE_MODERATOR_EXPLAIN'] : $this->lang('L_DELETE_MODERATOR_EXPLAIN'); ?></span></td>
      <td class="row2" width="62%"> 
        <input type="checkbox" name="delete_old_moderator" value="1">
        <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></td>
    </tr>
    <tr> 
      <td class="row1" width="38%"><span class="gen"><?php echo isset($this->vars['L_GROUP_DELETE']) ? $this->vars['L_GROUP_DELETE'] : $this->lang('L_GROUP_DELETE'); ?>:</span></td>
      <td class="row2" width="62%"> 
        <input type="checkbox" name="group_delete" value="1">
        <?php echo isset($this->vars['L_GROUP_DELETE_CHECK']) ? $this->vars['L_GROUP_DELETE_CHECK'] : $this->lang('L_GROUP_DELETE_CHECK'); ?></td>
    </tr>
    <tr> 
      <td class="row1"><span class="gen"><?php echo isset($this->vars['L_UPLOAD_QUOTA']) ? $this->vars['L_UPLOAD_QUOTA'] : $this->lang('L_UPLOAD_QUOTA'); ?></span></td>
      <td class="row2"><?php echo isset($this->vars['S_SELECT_UPLOAD_QUOTA']) ? $this->vars['S_SELECT_UPLOAD_QUOTA'] : $this->lang('S_SELECT_UPLOAD_QUOTA'); ?></td>
    </tr>
    <tr> 
      <td class="row1"><span class="gen"><?php echo isset($this->vars['L_PM_QUOTA']) ? $this->vars['L_PM_QUOTA'] : $this->lang('L_PM_QUOTA'); ?></span></td>
      <td class="row2"><?php echo isset($this->vars['S_SELECT_PM_QUOTA']) ? $this->vars['S_SELECT_PM_QUOTA'] : $this->lang('S_SELECT_PM_QUOTA'); ?></td>
    </tr>
    <?php

} // END group_edit

if(isset($group_edit_item)) { unset($group_edit_item); } 

?>
    <tr> 
      <td class="catBottom" colspan="2" align="center"><span class="cattitle"> 
        <input type="submit" name="group_update" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" class="mainoption" />
           
        <input type="reset" value="<?php echo isset($this->vars['L_RESET']) ? $this->vars['L_RESET'] : $this->lang('L_RESET'); ?>" name="reset" class="liteoption" />
        </span></td>
    </tr>
</table><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?></form>