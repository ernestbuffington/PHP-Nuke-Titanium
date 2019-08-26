<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_SIG_TITLE']) ? $this->vars['L_SIG_TITLE'] : $this->lang('L_SIG_TITLE'); ?></th>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <!-- Advanced Signature Divider Control -->
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <!-- <?php echo isset($this->vars['L_SIG_INPUT']) ? $this->vars['L_SIG_INPUT'] : $this->lang('L_SIG_INPUT'); ?><br /><span class="gensmall"><?php echo isset($this->vars['L_SIG_EXPLAIN']) ? $this->vars['L_SIG_EXPLAIN'] : $this->lang('L_SIG_EXPLAIN'); ?></span> -->
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_SIG_INPUT']) ? $this->vars['L_SIG_INPUT'] : $this->lang('L_SIG_INPUT'); ?></span>
      <span class="evo-sprite help tooltip-html float-right" title="<?php echo isset($this->vars['L_SIG_EXPLAIN']) ? $this->vars['L_SIG_EXPLAIN'] : $this->lang('L_SIG_EXPLAIN'); ?>"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><input type="text" maxlength="255" name="sig_line" style="width: 350px;" value="<?php echo isset($this->vars['SIG_DIVIDERS']) ? $this->vars['SIG_DIVIDERS'] : $this->lang('SIG_DIVIDERS'); ?>" /></td> 
  </tr> 
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <!-- <?php echo isset($this->vars['L_MAX_SIG_LENGTH']) ? $this->vars['L_MAX_SIG_LENGTH'] : $this->lang('L_MAX_SIG_LENGTH'); ?><br /><span class="gensmall"><?php echo isset($this->vars['L_MAX_SIG_LENGTH_EXPLAIN']) ? $this->vars['L_MAX_SIG_LENGTH_EXPLAIN'] : $this->lang('L_MAX_SIG_LENGTH_EXPLAIN'); ?></span> -->
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_MAX_SIG_LENGTH']) ? $this->vars['L_MAX_SIG_LENGTH'] : $this->lang('L_MAX_SIG_LENGTH'); ?></span>
      <span class="evo-sprite help tooltip-html float-right" title="<?php echo isset($this->vars['L_MAX_SIG_LENGTH_EXPLAIN']) ? $this->vars['L_MAX_SIG_LENGTH_EXPLAIN'] : $this->lang('L_MAX_SIG_LENGTH_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="5" maxlength="4" name="max_sig_chars" value="<?php echo isset($this->vars['SIG_SIZE']) ? $this->vars['SIG_SIZE'] : $this->lang('SIG_SIZE'); ?>" /></td>
  </tr>
  <!-- Advanced Signature Divider Control -->
</table>
</span>