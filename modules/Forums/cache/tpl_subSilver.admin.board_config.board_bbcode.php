<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">BBCode Options</td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_YOUTUBE_DIMENSIONS']) ? $this->vars['L_YOUTUBE_DIMENSIONS'] : $this->lang('L_YOUTUBE_DIMENSIONS'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;">Width <input class="post" type="text" size="5" maxlength="4" name="youtube_width" value="<?php echo isset($this->vars['YOUTUBE_WIDTH']) ? $this->vars['YOUTUBE_WIDTH'] : $this->lang('YOUTUBE_WIDTH'); ?>" /> height <input class="post" type="text" size="5" maxlength="4" name="youtube_height" value="<?php echo isset($this->vars['YOUTUBE_HEIGHT']) ? $this->vars['YOUTUBE_HEIGHT'] : $this->lang('YOUTUBE_HEIGHT'); ?>" /></td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_TWITCH_DIMENSIONS']) ? $this->vars['L_TWITCH_DIMENSIONS'] : $this->lang('L_TWITCH_DIMENSIONS'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;">Width <input class="post" type="text" size="5" maxlength="4" name="twitch_width" value="<?php echo isset($this->vars['TWITCH_WIDTH']) ? $this->vars['TWITCH_WIDTH'] : $this->lang('TWITCH_WIDTH'); ?>" /> height <input class="post" type="text" size="5" maxlength="4" name="twitch_height" value="<?php echo isset($this->vars['TWITCH_HEIGHT']) ? $this->vars['TWITCH_HEIGHT'] : $this->lang('TWITCH_HEIGHT'); ?>" /></td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_FACEBOOK_DIMENSIONS']) ? $this->vars['L_FACEBOOK_DIMENSIONS'] : $this->lang('L_FACEBOOK_DIMENSIONS'); ?></td>
    <td class="row1" style="height: 35px; width: 50%;">Width <input class="post" type="text" size="5" maxlength="4" name="facebook_width" value="<?php echo isset($this->vars['FACEBOOK_WIDTH']) ? $this->vars['FACEBOOK_WIDTH'] : $this->lang('FACEBOOK_WIDTH'); ?>" /> height <input class="post" type="text" size="5" maxlength="4" name="facebook_height" value="<?php echo isset($this->vars['FACEBOOK_HEIGHT']) ? $this->vars['FACEBOOK_HEIGHT'] : $this->lang('FACEBOOK_HEIGHT'); ?>" /></td>
  </tr>
</table>
</span>