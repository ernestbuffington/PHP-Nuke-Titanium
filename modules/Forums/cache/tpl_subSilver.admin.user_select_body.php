<?php

// eXtreme Styles mod cache. Generated on Fri, 30 Aug 2019 23:35:56 +0000 (time=1567208156)

?><h1><?php echo isset($this->vars['L_USER_TITLE']) ? $this->vars['L_USER_TITLE'] : $this->lang('L_USER_TITLE'); ?></h1>

<p><?php echo isset($this->vars['L_USER_EXPLAIN']) ? $this->vars['L_USER_EXPLAIN'] : $this->lang('L_USER_EXPLAIN'); ?></p>

<form method="post" name="post" action="<?php echo isset($this->vars['S_USER_ACTION']) ? $this->vars['S_USER_ACTION'] : $this->lang('S_USER_ACTION'); ?>"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
    <tr>
        <th class="thHead" align="center"><?php echo isset($this->vars['L_USER_SELECT']) ? $this->vars['L_USER_SELECT'] : $this->lang('L_USER_SELECT'); ?></th>
    </tr>
    <tr>
        <td class="row1" align="center"><input type="text" class="post" name="username" maxlength="50" size="20" /> <input type="hidden" name="mode" value="edit" /><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?><input type="submit" name="submituser" value="<?php echo isset($this->vars['L_LOOK_UP']) ? $this->vars['L_LOOK_UP'] : $this->lang('L_LOOK_UP'); ?>" class="mainoption" /> <input type="submit" name="usersubmit" value="<?php echo isset($this->vars['L_FIND_USERNAME']) ? $this->vars['L_FIND_USERNAME'] : $this->lang('L_FIND_USERNAME'); ?>" class="liteoption" onClick="window.open('<?php echo isset($this->vars['U_SEARCH_USER']) ? $this->vars['U_SEARCH_USER'] : $this->lang('U_SEARCH_USER'); ?>', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></td>
    </tr>
</table></form>