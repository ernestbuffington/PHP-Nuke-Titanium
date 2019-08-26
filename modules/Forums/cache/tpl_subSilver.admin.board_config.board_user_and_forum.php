<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_ABILITIES_SETTINGS']) ? $this->vars['L_ABILITIES_SETTINGS'] : $this->lang('L_ABILITIES_SETTINGS'); ?></td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_MAX_POLL_OPTIONS']) ? $this->vars['L_MAX_POLL_OPTIONS'] : $this->lang('L_MAX_POLL_OPTIONS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="max_poll_options" size="4" maxlength="4" value="<?php echo isset($this->vars['MAX_POLL_OPTIONS']) ? $this->vars['MAX_POLL_OPTIONS'] : $this->lang('MAX_POLL_OPTIONS'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ALLOW_HTML']) ? $this->vars['L_ALLOW_HTML'] : $this->lang('L_ALLOW_HTML'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_html" value="1" <?php echo isset($this->vars['HTML_YES']) ? $this->vars['HTML_YES'] : $this->lang('HTML_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="allow_html" value="0" <?php echo isset($this->vars['HTML_NO']) ? $this->vars['HTML_NO'] : $this->lang('HTML_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_ALLOWED_TAGS']) ? $this->vars['L_ALLOWED_TAGS'] : $this->lang('L_ALLOWED_TAGS'); ?></span>
      <span class="tooltip icon-sprite icon-info" title="<?php echo isset($this->vars['L_ALLOWED_TAGS_EXPLAIN']) ? $this->vars['L_ALLOWED_TAGS_EXPLAIN'] : $this->lang('L_ALLOWED_TAGS_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="30" maxlength="255" name="allow_html_tags" value="<?php echo isset($this->vars['HTML_TAGS']) ? $this->vars['HTML_TAGS'] : $this->lang('HTML_TAGS'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ALLOW_BBCODE']) ? $this->vars['L_ALLOW_BBCODE'] : $this->lang('L_ALLOW_BBCODE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_bbcode" value="1" <?php echo isset($this->vars['BBCODE_YES']) ? $this->vars['BBCODE_YES'] : $this->lang('BBCODE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="allow_bbcode" value="0" <?php echo isset($this->vars['BBCODE_NO']) ? $this->vars['BBCODE_NO'] : $this->lang('BBCODE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ALLOW_SMILIES']) ? $this->vars['L_ALLOW_SMILIES'] : $this->lang('L_ALLOW_SMILIES'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_smilies" value="1" <?php echo isset($this->vars['SMILE_YES']) ? $this->vars['SMILE_YES'] : $this->lang('SMILE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="allow_smilies" value="0" <?php echo isset($this->vars['SMILE_NO']) ? $this->vars['SMILE_NO'] : $this->lang('SMILE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SMILIES_IN_TITLES']) ? $this->vars['L_SMILIES_IN_TITLES'] : $this->lang('L_SMILIES_IN_TITLES'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="smilies_in_titles" value="1" <?php echo isset($this->vars['SMILES_IN_TITLES_YES']) ? $this->vars['SMILES_IN_TITLES_YES'] : $this->lang('SMILES_IN_TITLES_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="smilies_in_titles" value="0" <?php echo isset($this->vars['SMILES_IN_TITLES_NO']) ? $this->vars['SMILES_IN_TITLES_NO'] : $this->lang('SMILES_IN_TITLES_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_LAST_POSTER_AVATAR']) ? $this->vars['L_LAST_POSTER_AVATAR'] : $this->lang('L_LAST_POSTER_AVATAR'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="last_post_avatar" value="1" <?php echo isset($this->vars['AVATAR_ON_INDEX_YES']) ? $this->vars['AVATAR_ON_INDEX_YES'] : $this->lang('AVATAR_ON_INDEX_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="last_post_avatar" value="0" <?php echo isset($this->vars['AVATAR_ON_INDEX_NO']) ? $this->vars['AVATAR_ON_INDEX_NO'] : $this->lang('AVATAR_ON_INDEX_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_HIDE_LINKS']) ? $this->vars['L_HIDE_LINKS'] : $this->lang('L_HIDE_LINKS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="hide_links" value="1" <?php echo isset($this->vars['HIDE_LINKS_YES']) ? $this->vars['HIDE_LINKS_YES'] : $this->lang('HIDE_LINKS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="hide_links" value="0" <?php echo isset($this->vars['HIDE_LINKS_NO']) ? $this->vars['HIDE_LINKS_NO'] : $this->lang('HIDE_LINKS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_HIDE_IMAGES']) ? $this->vars['L_HIDE_IMAGES'] : $this->lang('L_HIDE_IMAGES'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="hide_images" value="1" <?php echo isset($this->vars['HIDE_IMAGES_YES']) ? $this->vars['HIDE_IMAGES_YES'] : $this->lang('HIDE_IMAGES_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="hide_images" value="0" <?php echo isset($this->vars['HIDE_IMAGES_NO']) ? $this->vars['HIDE_IMAGES_NO'] : $this->lang('HIDE_IMAGES_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_HIDE_EMAILS']) ? $this->vars['L_HIDE_EMAILS'] : $this->lang('L_HIDE_EMAILS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="hide_emails" value="1" <?php echo isset($this->vars['HIDE_EMAILS_YES']) ? $this->vars['HIDE_EMAILS_YES'] : $this->lang('HIDE_EMAILS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="hide_emails" value="0" <?php echo isset($this->vars['HIDE_EMAILS_NO']) ? $this->vars['HIDE_EMAILS_NO'] : $this->lang('HIDE_EMAILS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SHOW_EDITED_LOGS']) ? $this->vars['L_SHOW_EDITED_LOGS'] : $this->lang('L_SHOW_EDITED_LOGS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_edited_logs" value="1" <?php echo isset($this->vars['SHOW_EDITED_LOGS_YES']) ? $this->vars['SHOW_EDITED_LOGS_YES'] : $this->lang('SHOW_EDITED_LOGS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="show_edited_logs" value="0" <?php echo isset($this->vars['SHOW_EDITED_LOGS_NO']) ? $this->vars['SHOW_EDITED_LOGS_NO'] : $this->lang('SHOW_EDITED_LOGS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SHOW_LOCKED_LOGS']) ? $this->vars['L_SHOW_LOCKED_LOGS'] : $this->lang('L_SHOW_LOCKED_LOGS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_locked_logs" value="1" <?php echo isset($this->vars['SHOW_LOCKED_LOGS_YES']) ? $this->vars['SHOW_LOCKED_LOGS_YES'] : $this->lang('SHOW_LOCKED_LOGS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="show_locked_logs" value="0" <?php echo isset($this->vars['SHOW_LOCKED_LOGS_NO']) ? $this->vars['SHOW_LOCKED_LOGS_NO'] : $this->lang('SHOW_LOCKED_LOGS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SHOW_UNLOCKED_LOGS']) ? $this->vars['L_SHOW_UNLOCKED_LOGS'] : $this->lang('L_SHOW_UNLOCKED_LOGS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_unlocked_logs" value="1" <?php echo isset($this->vars['SHOW_UNLOCKED_LOGS_YES']) ? $this->vars['SHOW_UNLOCKED_LOGS_YES'] : $this->lang('SHOW_UNLOCKED_LOGS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="show_unlocked_logs" value="0" <?php echo isset($this->vars['SHOW_UNLOCKED_LOGS_NO']) ? $this->vars['SHOW_UNLOCKED_LOGS_NO'] : $this->lang('SHOW_UNLOCKED_LOGS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SHOW_MOVED_LOGS']) ? $this->vars['L_SHOW_MOVED_LOGS'] : $this->lang('L_SHOW_MOVED_LOGS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_moved_logs" value="1" <?php echo isset($this->vars['SHOW_MOVED_LOGS_YES']) ? $this->vars['SHOW_MOVED_LOGS_YES'] : $this->lang('SHOW_MOVED_LOGS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="show_moved_logs" value="0" <?php echo isset($this->vars['SHOW_MOVED_LOGS_NO']) ? $this->vars['SHOW_MOVED_LOGS_NO'] : $this->lang('SHOW_MOVED_LOGS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SHOW_SPLITTED_LOGS']) ? $this->vars['L_SHOW_SPLITTED_LOGS'] : $this->lang('L_SHOW_SPLITTED_LOGS'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_splitted_logs" value="1" <?php echo isset($this->vars['SHOW_SPLITTED_LOGS_YES']) ? $this->vars['SHOW_SPLITTED_LOGS_YES'] : $this->lang('SHOW_SPLITTED_LOGS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="show_splitted_logs" value="0" <?php echo isset($this->vars['SHOW_SPLITTED_LOGS_NO']) ? $this->vars['SHOW_SPLITTED_LOGS_NO'] : $this->lang('SHOW_SPLITTED_LOGS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ALLOW_VIEW']) ? $this->vars['L_ALLOW_VIEW'] : $this->lang('L_ALLOW_VIEW'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><?php echo isset($this->vars['ALLOW_VIEW_SELECT']) ? $this->vars['ALLOW_VIEW_SELECT'] : $this->lang('ALLOW_VIEW_SELECT'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_SMILIES_PATH']) ? $this->vars['L_SMILIES_PATH'] : $this->lang('L_SMILIES_PATH'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_SMILIES_PATH_EXPLAIN']) ? $this->vars['L_SMILIES_PATH_EXPLAIN'] : $this->lang('L_SMILIES_PATH_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="smilies_path" style="width: 400px;" value="<?php echo isset($this->vars['SMILIES_PATH']) ? $this->vars['SMILIES_PATH'] : $this->lang('SMILIES_PATH'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_ALLOW_AUTOLOGIN']) ? $this->vars['L_ALLOW_AUTOLOGIN'] : $this->lang('L_ALLOW_AUTOLOGIN'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_ALLOW_AUTOLOGIN_EXPLAIN']) ? $this->vars['L_ALLOW_AUTOLOGIN_EXPLAIN'] : $this->lang('L_ALLOW_AUTOLOGIN_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_autologin" value="1" <?php echo isset($this->vars['ALLOW_AUTOLOGIN_YES']) ? $this->vars['ALLOW_AUTOLOGIN_YES'] : $this->lang('ALLOW_AUTOLOGIN_YES'); ?> /><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp; &nbsp;<input type="radio" name="allow_autologin" value="0" <?php echo isset($this->vars['ALLOW_AUTOLOGIN_NO']) ? $this->vars['ALLOW_AUTOLOGIN_NO'] : $this->lang('ALLOW_AUTOLOGIN_NO'); ?> /><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_LOGIN_PAGE']) ? $this->vars['L_LOGIN_PAGE'] : $this->lang('L_LOGIN_PAGE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_LOGIN_PAGE_EXPLAIN']) ? $this->vars['L_LOGIN_PAGE_EXPLAIN'] : $this->lang('L_LOGIN_PAGE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="loginpage" value="1" <?php echo isset($this->vars['LOGINPAGE_YES']) ? $this->vars['LOGINPAGE_YES'] : $this->lang('LOGINPAGE_YES'); ?> /><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp; &nbsp;<input type="radio" name="loginpage" value="0" <?php echo isset($this->vars['LOGINPAGE_NO']) ? $this->vars['LOGINPAGE_NO'] : $this->lang('LOGINPAGE_NO'); ?> /><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_AUTOLOGIN_TIME']) ? $this->vars['L_AUTOLOGIN_TIME'] : $this->lang('L_AUTOLOGIN_TIME'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_AUTOLOGIN_TIME_EXPLAIN']) ? $this->vars['L_AUTOLOGIN_TIME_EXPLAIN'] : $this->lang('L_AUTOLOGIN_TIME_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="<?php echo isset($this->vars['AUTOLOGIN_TIME']) ? $this->vars['AUTOLOGIN_TIME'] : $this->lang('AUTOLOGIN_TIME'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_IMAGE_RESIZE_WIDTH']) ? $this->vars['L_IMAGE_RESIZE_WIDTH'] : $this->lang('L_IMAGE_RESIZE_WIDTH'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="5" maxlength="4" name="image_resize_width" value="<?php echo isset($this->vars['IMAGE_RESIZE_WIDTH']) ? $this->vars['IMAGE_RESIZE_WIDTH'] : $this->lang('IMAGE_RESIZE_WIDTH'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_IMAGE_RESIZE_HEIGHT']) ? $this->vars['L_IMAGE_RESIZE_HEIGHT'] : $this->lang('L_IMAGE_RESIZE_HEIGHT'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="5" maxlength="4" name="image_resize_height" value="<?php echo isset($this->vars['IMAGE_RESIZE_HEIGHT']) ? $this->vars['IMAGE_RESIZE_HEIGHT'] : $this->lang('IMAGE_RESIZE_HEIGHT'); ?>" /></td>
  </tr>
</table>
</span>