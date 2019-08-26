<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_ROPM_QUICK_REPLY']) ? $this->vars['L_ROPM_QUICK_REPLY'] : $this->lang('L_ROPM_QUICK_REPLY'); ?></th>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ENABLE_ROPM_QUICK_REPLY']) ? $this->vars['L_ENABLE_ROPM_QUICK_REPLY'] : $this->lang('L_ENABLE_ROPM_QUICK_REPLY'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="ropm_quick_reply" value="1" <?php echo isset($this->vars['ROPM_QUICK_REPLY_YES']) ? $this->vars['ROPM_QUICK_REPLY_YES'] : $this->lang('ROPM_QUICK_REPLY_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="ropm_quick_reply" value="0" <?php echo isset($this->vars['ROPM_QUICK_REPLY_NO']) ? $this->vars['ROPM_QUICK_REPLY_NO'] : $this->lang('ROPM_QUICK_REPLY_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ROPM_QUICK_REPLY_BBC']) ? $this->vars['L_ROPM_QUICK_REPLY_BBC'] : $this->lang('L_ROPM_QUICK_REPLY_BBC'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="ropm_quick_reply_bbc" value="1" <?php echo isset($this->vars['ROPM_QUICK_REPLY_BBC_YES']) ? $this->vars['ROPM_QUICK_REPLY_BBC_YES'] : $this->lang('ROPM_QUICK_REPLY_BBC_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="ropm_quick_reply_bbc" value="0" <?php echo isset($this->vars['ROPM_QUICK_REPLY_BBC_NO']) ? $this->vars['ROPM_QUICK_REPLY_BBC_NO'] : $this->lang('ROPM_QUICK_REPLY_BBC_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_ROPM_QUICK_REPLY_SMILIES']) ? $this->vars['L_ROPM_QUICK_REPLY_SMILIES'] : $this->lang('L_ROPM_QUICK_REPLY_SMILIES'); ?></span>
      <span class="evo-sprite help tooltip-html float-right" title="<?php echo isset($this->vars['L_ROPM_QUICK_REPLY_SMILIES_INFO']) ? $this->vars['L_ROPM_QUICK_REPLY_SMILIES_INFO'] : $this->lang('L_ROPM_QUICK_REPLY_SMILIES_INFO'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="ropm_quick_reply_smilies" size="4" maxlength="4" value="<?php echo isset($this->vars['ROPM_QUICK_REPLY_SMILIES']) ? $this->vars['ROPM_QUICK_REPLY_SMILIES'] : $this->lang('ROPM_QUICK_REPLY_SMILIES'); ?>" /></td>
  </tr>
</table>
</span>