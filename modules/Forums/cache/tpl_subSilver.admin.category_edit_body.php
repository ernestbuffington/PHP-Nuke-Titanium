<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 17:48:58 +0000 (time=1566841738)

?><h1><?php echo isset($this->vars['L_EDIT_CATEGORY']) ? $this->vars['L_EDIT_CATEGORY'] : $this->lang('L_EDIT_CATEGORY'); ?></h1>

<p><?php echo isset($this->vars['L_EDIT_CATEGORY_EXPLAIN']) ? $this->vars['L_EDIT_CATEGORY_EXPLAIN'] : $this->lang('L_EDIT_CATEGORY_EXPLAIN'); ?></p>

<form action="<?php echo isset($this->vars['S_FORUM_ACTION']) ? $this->vars['S_FORUM_ACTION'] : $this->lang('S_FORUM_ACTION'); ?>" method="post">
  <table cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr> 
      <th class="thHead" colspan="2"><?php echo isset($this->vars['L_EDIT_CATEGORY']) ? $this->vars['L_EDIT_CATEGORY'] : $this->lang('L_EDIT_CATEGORY'); ?></th>
    </tr>
    <tr> 
      <td class="row1"><?php echo isset($this->vars['L_CATEGORY']) ? $this->vars['L_CATEGORY'] : $this->lang('L_CATEGORY'); ?></td>
      <td class="row2"><input type="text" size="25" name="cat_title" value="<?php echo isset($this->vars['CAT_TITLE']) ? $this->vars['CAT_TITLE'] : $this->lang('CAT_TITLE'); ?>" /></td>
    </tr>
    <tr> 
      <td class="catBottom" colspan="2" align="center"><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?><input type="submit" name="submit" value="<?php echo isset($this->vars['S_SUBMIT_VALUE']) ? $this->vars['S_SUBMIT_VALUE'] : $this->lang('S_SUBMIT_VALUE'); ?>" class="mainoption" /></td>
    </tr>
  </table>
</form>
        
<br clear="all" />