<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_COPPA_SETTINGS']) ? $this->vars['L_COPPA_SETTINGS'] : $this->lang('L_COPPA_SETTINGS'); ?></td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_COPPA_FAX']) ? $this->vars['L_COPPA_FAX'] : $this->lang('L_COPPA_FAX'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="25" maxlength="100" name="coppa_fax" value="<?php echo isset($this->vars['COPPA_FAX']) ? $this->vars['COPPA_FAX'] : $this->lang('COPPA_FAX'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_COPPA_MAIL']) ? $this->vars['L_COPPA_MAIL'] : $this->lang('L_COPPA_MAIL'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_COPPA_MAIL_EXPLAIN']) ? $this->vars['L_COPPA_MAIL_EXPLAIN'] : $this->lang('L_COPPA_MAIL_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><textarea name="coppa_mail" rows="5" cols="30"><?php echo isset($this->vars['COPPA_MAIL']) ? $this->vars['COPPA_MAIL'] : $this->lang('COPPA_MAIL'); ?></textarea></td>
  </tr>
</table>
</span>