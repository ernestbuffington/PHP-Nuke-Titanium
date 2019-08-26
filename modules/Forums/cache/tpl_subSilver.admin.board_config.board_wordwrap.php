<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_WRAP_TITLE']) ? $this->vars['L_WRAP_TITLE'] : $this->lang('L_WRAP_TITLE'); ?></td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ENABLE_WRAP']) ? $this->vars['L_ENABLE_WRAP'] : $this->lang('L_ENABLE_WRAP'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="wrap_enable" value="1" <?php echo isset($this->vars['WRAP_ENABLE']) ? $this->vars['WRAP_ENABLE'] : $this->lang('WRAP_ENABLE'); ?> /> <?php echo isset($this->vars['L_ENABLED']) ? $this->vars['L_ENABLED'] : $this->lang('L_ENABLED'); ?> <input type="radio" name="wrap_enable" value="0" <?php echo isset($this->vars['WRAP_DISABLE']) ? $this->vars['WRAP_DISABLE'] : $this->lang('WRAP_DISABLE'); ?> /> <?php echo isset($this->vars['L_DISABLED']) ? $this->vars['L_DISABLED'] : $this->lang('L_DISABLED'); ?></td>
   </tr>
   <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_WRAP_MIN']) ? $this->vars['L_WRAP_MIN'] : $this->lang('L_WRAP_MIN'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="3" name="wrap_min" value="<?php echo isset($this->vars['WRAP_MIN']) ? $this->vars['WRAP_MIN'] : $this->lang('WRAP_MIN'); ?>" /> <?php echo isset($this->vars['L_WRAP_UNITS']) ? $this->vars['L_WRAP_UNITS'] : $this->lang('L_WRAP_UNITS'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_WRAP_DEF']) ? $this->vars['L_WRAP_DEF'] : $this->lang('L_WRAP_DEF'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="3" name="wrap_def" value="<?php echo isset($this->vars['WRAP_DEF']) ? $this->vars['WRAP_DEF'] : $this->lang('WRAP_DEF'); ?>" /> <?php echo isset($this->vars['L_WRAP_UNITS']) ? $this->vars['L_WRAP_UNITS'] : $this->lang('L_WRAP_UNITS'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_WRAP_MAX']) ? $this->vars['L_WRAP_MAX'] : $this->lang('L_WRAP_MAX'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="3" name="wrap_max" value="<?php echo isset($this->vars['WRAP_MAX']) ? $this->vars['WRAP_MAX'] : $this->lang('WRAP_MAX'); ?>" /> <?php echo isset($this->vars['L_WRAP_UNITS']) ? $this->vars['L_WRAP_UNITS'] : $this->lang('L_WRAP_UNITS'); ?></td>
  </tr>
</table>
</span>