<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_BIRTHDAYS']) ? $this->vars['L_BIRTHDAYS'] : $this->lang('L_BIRTHDAYS'); ?></td>
  </tr>
</table>


<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table style="width: 99%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_BDAY_REQUIRE']) ? $this->vars['L_BDAY_REQUIRE'] : $this->lang('L_BDAY_REQUIRE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_BDAY_REQUIRE_EXPLAIN']) ? $this->vars['L_BDAY_REQUIRE_EXPLAIN'] : $this->lang('L_BDAY_REQUIRE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_require" value="1" <?php echo isset($this->vars['BDAY_REQUIRE_YES']) ? $this->vars['BDAY_REQUIRE_YES'] : $this->lang('BDAY_REQUIRE_YES'); ?> /><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp; &nbsp;<input type="radio" name="bday_require" value="0" <?php echo isset($this->vars['BDAY_REQUIRE_NO']) ? $this->vars['BDAY_REQUIRE_NO'] : $this->lang('BDAY_REQUIRE_NO'); ?> /><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_BDAY_YEAR']) ? $this->vars['L_BDAY_YEAR'] : $this->lang('L_BDAY_YEAR'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_BDAY_YEAR_EXPLAIN']) ? $this->vars['L_BDAY_YEAR_EXPLAIN'] : $this->lang('L_BDAY_YEAR_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_year" value="1" <?php echo isset($this->vars['BDAY_YEAR_YES']) ? $this->vars['BDAY_YEAR_YES'] : $this->lang('BDAY_YEAR_YES'); ?> /><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp; &nbsp;<input type="radio" name="bday_year" value="0" <?php echo isset($this->vars['BDAY_YEAR_NO']) ? $this->vars['BDAY_YEAR_NO'] : $this->lang('BDAY_YEAR_NO'); ?> /><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_BDAY_LOCK']) ? $this->vars['L_BDAY_LOCK'] : $this->lang('L_BDAY_LOCK'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_BDAY_LOCK_EXPLAIN']) ? $this->vars['L_BDAY_LOCK_EXPLAIN'] : $this->lang('L_BDAY_LOCK_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_lock" value="1" <?php echo isset($this->vars['BDAY_LOCK_YES']) ? $this->vars['BDAY_LOCK_YES'] : $this->lang('BDAY_LOCK_YES'); ?> /><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp; &nbsp;<input type="radio" name="bday_lock" value="0" <?php echo isset($this->vars['BDAY_LOCK_NO']) ? $this->vars['BDAY_LOCK_NO'] : $this->lang('BDAY_LOCK_NO'); ?> /><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_BDAY_LOOKAHEAD']) ? $this->vars['L_BDAY_LOOKAHEAD'] : $this->lang('L_BDAY_LOOKAHEAD'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_BDAY_LOOKAHEAD_EXPLAIN']) ? $this->vars['L_BDAY_LOOKAHEAD_EXPLAIN'] : $this->lang('L_BDAY_LOOKAHEAD_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="2" maxlength="2" name="bday_lookahead" value="<?php echo isset($this->vars['BDAY_LOOKAHEAD']) ? $this->vars['BDAY_LOOKAHEAD'] : $this->lang('BDAY_LOOKAHEAD'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_BDAY_AGE_RANGE']) ? $this->vars['L_BDAY_AGE_RANGE'] : $this->lang('L_BDAY_AGE_RANGE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="2" maxlength="2" name="bday_min" value="<?php echo isset($this->vars['BDAY_MIN']) ? $this->vars['BDAY_MIN'] : $this->lang('BDAY_MIN'); ?>" /> <?php echo isset($this->vars['L_TO']) ? $this->vars['L_TO'] : $this->lang('L_TO'); ?> <input class="post" type="text" size="3" maxlength="3" name="bday_max" value="<?php echo isset($this->vars['BDAY_MAX']) ? $this->vars['BDAY_MAX'] : $this->lang('BDAY_MAX'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_BDAY_HIDE']) ? $this->vars['L_BDAY_HIDE'] : $this->lang('L_BDAY_HIDE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_hide" value="1" <?php echo isset($this->vars['BDAY_HIDE_YES']) ? $this->vars['BDAY_HIDE_YES'] : $this->lang('BDAY_HIDE_YES'); ?> /><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp; &nbsp;<input type="radio" name="bday_hide" value="0" <?php echo isset($this->vars['BDAY_HIDE_NO']) ? $this->vars['BDAY_HIDE_NO'] : $this->lang('BDAY_HIDE_NO'); ?> /><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <!-- <?php echo isset($this->vars['L_BDAY_SHOW']) ? $this->vars['L_BDAY_SHOW'] : $this->lang('L_BDAY_SHOW'); ?><br /><span class="gensmall"><?php echo isset($this->vars['L_BDAY_SHOW_EXPLAIN']) ? $this->vars['L_BDAY_SHOW_EXPLAIN'] : $this->lang('L_BDAY_SHOW_EXPLAIN'); ?></span> -->
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_BDAY_SHOW']) ? $this->vars['L_BDAY_SHOW'] : $this->lang('L_BDAY_SHOW'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_BDAY_SHOW_EXPLAIN']) ? $this->vars['L_BDAY_SHOW_EXPLAIN'] : $this->lang('L_BDAY_SHOW_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_show" value="1" <?php echo isset($this->vars['BDAY_SHOW_YES']) ? $this->vars['BDAY_SHOW_YES'] : $this->lang('BDAY_SHOW_YES'); ?> /><?php echo isset($this->vars['L_UNCONDITIONAL']) ? $this->vars['L_UNCONDITIONAL'] : $this->lang('L_UNCONDITIONAL'); ?>&nbsp; &nbsp;<input type="radio" name="bday_show" value="0" <?php echo isset($this->vars['BDAY_SHOW_NO']) ? $this->vars['BDAY_SHOW_NO'] : $this->lang('BDAY_SHOW_NO'); ?> /><?php echo isset($this->vars['L_CONDITIONAL']) ? $this->vars['L_CONDITIONAL'] : $this->lang('L_CONDITIONAL'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <!-- <?php echo isset($this->vars['L_BDAY_SEND_GREETING']) ? $this->vars['L_BDAY_SEND_GREETING'] : $this->lang('L_BDAY_SEND_GREETING'); ?><br /><span class="gensmall"><?php echo isset($this->vars['L_BDAY_SEND_GREETING_EXPLAIN']) ? $this->vars['L_BDAY_SEND_GREETING_EXPLAIN'] : $this->lang('L_BDAY_SEND_GREETING_EXPLAIN'); ?></span> -->
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_BDAY_SEND_GREETING']) ? $this->vars['L_BDAY_SEND_GREETING'] : $this->lang('L_BDAY_SEND_GREETING'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_BDAY_SEND_GREETING_EXPLAIN']) ? $this->vars['L_BDAY_SEND_GREETING_EXPLAIN'] : $this->lang('L_BDAY_SEND_GREETING_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;">
      <input type="checkbox" name="bday_email_mask" value="<?php echo isset($this->vars['BDAY_EMAIL']) ? $this->vars['BDAY_EMAIL'] : $this->lang('BDAY_EMAIL'); ?>" <?php echo isset($this->vars['BDAY_EMAIL_ENABLED']) ? $this->vars['BDAY_EMAIL_ENABLED'] : $this->lang('BDAY_EMAIL_ENABLED'); ?> /> <?php echo isset($this->vars['L_EMAIL']) ? $this->vars['L_EMAIL'] : $this->lang('L_EMAIL'); ?>&nbsp;&nbsp;
      <input type="checkbox" name="bday_pm_mask" value="<?php echo isset($this->vars['BDAY_PM']) ? $this->vars['BDAY_PM'] : $this->lang('BDAY_PM'); ?>" <?php echo isset($this->vars['BDAY_PM_ENABLED']) ? $this->vars['BDAY_PM_ENABLED'] : $this->lang('BDAY_PM_ENABLED'); ?> /> <?php echo isset($this->vars['L_PM']) ? $this->vars['L_PM'] : $this->lang('L_PM'); ?>&nbsp;&nbsp;
      <input type="checkbox" name="bday_popup_mask" value="<?php echo isset($this->vars['BDAY_POPUP']) ? $this->vars['BDAY_POPUP'] : $this->lang('BDAY_POPUP'); ?>" <?php echo isset($this->vars['BDAY_POPUP_ENABLED']) ? $this->vars['BDAY_POPUP_ENABLED'] : $this->lang('BDAY_POPUP_ENABLED'); ?> /> <?php echo isset($this->vars['L_POPUP']) ? $this->vars['L_POPUP'] : $this->lang('L_POPUP'); ?>&nbsp;&nbsp;
    </td>
  </tr>
</table>
</span>