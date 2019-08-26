<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_PRIVATE_MESSAGING']) ? $this->vars['L_PRIVATE_MESSAGING'] : $this->lang('L_PRIVATE_MESSAGING'); ?></td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_DISABLE_PRIVATE_MESSAGING']) ? $this->vars['L_DISABLE_PRIVATE_MESSAGING'] : $this->lang('L_DISABLE_PRIVATE_MESSAGING'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;"><input type="radio" name="privmsg_disable" value="0" <?php echo isset($this->vars['S_PRIVMSG_ENABLED']) ? $this->vars['S_PRIVMSG_ENABLED'] : $this->lang('S_PRIVMSG_ENABLED'); ?> /><?php echo isset($this->vars['L_ENABLED']) ? $this->vars['L_ENABLED'] : $this->lang('L_ENABLED'); ?> <input type="radio" name="privmsg_disable" value="1" <?php echo isset($this->vars['S_PRIVMSG_DISABLED']) ? $this->vars['S_PRIVMSG_DISABLED'] : $this->lang('S_PRIVMSG_DISABLED'); ?> /><?php echo isset($this->vars['L_DISABLED']) ? $this->vars['L_DISABLED'] : $this->lang('L_DISABLED'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_WELCOME_PM']) ? $this->vars['L_WELCOME_PM'] : $this->lang('L_WELCOME_PM'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;"><input type="radio" name="welcome_pm" value="1" <?php echo isset($this->vars['S_WELCOME_PM_ENABLED']) ? $this->vars['S_WELCOME_PM_ENABLED'] : $this->lang('S_WELCOME_PM_ENABLED'); ?> /><?php echo isset($this->vars['L_ENABLED']) ? $this->vars['L_ENABLED'] : $this->lang('L_ENABLED'); ?> <input type="radio" name="welcome_pm" value="0" <?php echo isset($this->vars['S_WELCOME_PM_DISABLED']) ? $this->vars['S_WELCOME_PM_DISABLED'] : $this->lang('S_WELCOME_PM_DISABLED'); ?> /><?php echo isset($this->vars['L_DISABLED']) ? $this->vars['L_DISABLED'] : $this->lang('L_DISABLED'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">Welcome PM Sender Name</td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" style="width: 350px;" name="welcome_pm_username" value="<?php echo isset($this->vars['WELCOME_USERNAME']) ? $this->vars['WELCOME_USERNAME'] : $this->lang('WELCOME_USERNAME'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_PM_ALLOW_THRESHOLD']) ? $this->vars['L_PM_ALLOW_THRESHOLD'] : $this->lang('L_PM_ALLOW_THRESHOLD'); ?></span>
      <span class="evo-sprite help tooltip-html float-right" title="<?php echo isset($this->vars['L_PM_ALLOW_TRHESHOLD_EXPLAIN']) ? $this->vars['L_PM_ALLOW_TRHESHOLD_EXPLAIN'] : $this->lang('L_PM_ALLOW_TRHESHOLD_EXPLAIN'); ?>"></span>
    </td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="pm_allow_threshold" value="<?php echo isset($this->vars['PM_ALLOW_THRESHOLD']) ? $this->vars['PM_ALLOW_THRESHOLD'] : $this->lang('PM_ALLOW_THRESHOLD'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_INBOX_LIMIT']) ? $this->vars['L_INBOX_LIMIT'] : $this->lang('L_INBOX_LIMIT'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="<?php echo isset($this->vars['INBOX_LIMIT']) ? $this->vars['INBOX_LIMIT'] : $this->lang('INBOX_LIMIT'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SENTBOX_LIMIT']) ? $this->vars['L_SENTBOX_LIMIT'] : $this->lang('L_SENTBOX_LIMIT'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="<?php echo isset($this->vars['SENTBOX_LIMIT']) ? $this->vars['SENTBOX_LIMIT'] : $this->lang('SENTBOX_LIMIT'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SAVEBOX_LIMIT']) ? $this->vars['L_SAVEBOX_LIMIT'] : $this->lang('L_SAVEBOX_LIMIT'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="<?php echo isset($this->vars['SAVEBOX_LIMIT']) ? $this->vars['SAVEBOX_LIMIT'] : $this->lang('SAVEBOX_LIMIT'); ?>" /></td>
  </tr>
</table>
</span>