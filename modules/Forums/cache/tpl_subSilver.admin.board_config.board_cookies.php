<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_COOKIE_SETTINGS']) ? $this->vars['L_COOKIE_SETTINGS'] : $this->lang('L_COOKIE_SETTINGS'); ?></td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row2" colspan="2" style="height: 35px; font-size: 13px; text-align: center; width: 50%;"><?php echo isset($this->vars['L_COOKIE_SETTINGS_EXPLAIN']) ? $this->vars['L_COOKIE_SETTINGS_EXPLAIN'] : $this->lang('L_COOKIE_SETTINGS_EXPLAIN'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_COOKIE_DOMAIN']) ? $this->vars['L_COOKIE_DOMAIN'] : $this->lang('L_COOKIE_DOMAIN'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="cookie_domain" value="<?php echo isset($this->vars['COOKIE_DOMAIN']) ? $this->vars['COOKIE_DOMAIN'] : $this->lang('COOKIE_DOMAIN'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_COOKIE_NAME']) ? $this->vars['L_COOKIE_NAME'] : $this->lang('L_COOKIE_NAME'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="cookie_name" value="<?php echo isset($this->vars['COOKIE_NAME']) ? $this->vars['COOKIE_NAME'] : $this->lang('COOKIE_NAME'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_COOKIE_PATH']) ? $this->vars['L_COOKIE_PATH'] : $this->lang('L_COOKIE_PATH'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="cookie_path" value="<?php echo isset($this->vars['COOKIE_PATH']) ? $this->vars['COOKIE_PATH'] : $this->lang('COOKIE_PATH'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_COOKIE_SECURE']) ? $this->vars['L_COOKIE_SECURE'] : $this->lang('L_COOKIE_SECURE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_COOKIE_SECURE_EXPLAIN']) ? $this->vars['L_COOKIE_SECURE_EXPLAIN'] : $this->lang('L_COOKIE_SECURE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="cookie_secure" value="0" <?php echo isset($this->vars['S_COOKIE_SECURE_DISABLED']) ? $this->vars['S_COOKIE_SECURE_DISABLED'] : $this->lang('S_COOKIE_SECURE_DISABLED'); ?> /><?php echo isset($this->vars['L_DISABLED']) ? $this->vars['L_DISABLED'] : $this->lang('L_DISABLED'); ?>  <input type="radio" name="cookie_secure" value="1" <?php echo isset($this->vars['S_COOKIE_SECURE_ENABLED']) ? $this->vars['S_COOKIE_SECURE_ENABLED'] : $this->lang('S_COOKIE_SECURE_ENABLED'); ?> /><?php echo isset($this->vars['L_ENABLED']) ? $this->vars['L_ENABLED'] : $this->lang('L_ENABLED'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SESSION_LENGTH']) ? $this->vars['L_SESSION_LENGTH'] : $this->lang('L_SESSION_LENGTH'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="5" size="5" name="session_length" value="<?php echo isset($this->vars['SESSION_LENGTH']) ? $this->vars['SESSION_LENGTH'] : $this->lang('SESSION_LENGTH'); ?>" /></td>
  </tr>
</table>
</span>