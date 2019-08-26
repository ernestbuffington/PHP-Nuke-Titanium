<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_AVATAR_SETTINGS']) ? $this->vars['L_AVATAR_SETTINGS'] : $this->lang('L_AVATAR_SETTINGS'); ?></td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DEFAULT_AVATAR']) ? $this->vars['L_DEFAULT_AVATAR'] : $this->lang('L_DEFAULT_AVATAR'); ?></span>
      <span class="evo-sprite help tooltip-html float-right" title="<?php echo isset($this->vars['L_DEFAULT_AVATAR_EXPLAIN']) ? $this->vars['L_DEFAULT_AVATAR_EXPLAIN'] : $this->lang('L_DEFAULT_AVATAR_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;">
        <table width="100%" cellpadding="0" cellspacing="1" border="0">
          <tr>
            <td><input type="radio" name="default_avatar_set" value="0" <?php echo isset($this->vars['DEFAULT_AVATAR_GUESTS']) ? $this->vars['DEFAULT_AVATAR_GUESTS'] : $this->lang('DEFAULT_AVATAR_GUESTS'); ?> /> <?php echo isset($this->vars['L_DEFAULT_AVATAR_GUESTS']) ? $this->vars['L_DEFAULT_AVATAR_GUESTS'] : $this->lang('L_DEFAULT_AVATAR_GUESTS'); ?></td>
            <td><input class="post" type="text" name="default_avatar_guests_url" style="width: 350px;" maxlength="255" value="<?php echo isset($this->vars['DEFAULT_AVATAR_GUESTS_URL']) ? $this->vars['DEFAULT_AVATAR_GUESTS_URL'] : $this->lang('DEFAULT_AVATAR_GUESTS_URL'); ?>" /></td>
          </tr>
          <tr>
            <td><input type="radio" name="default_avatar_set" value="1" <?php echo isset($this->vars['DEFAULT_AVATAR_USERS']) ? $this->vars['DEFAULT_AVATAR_USERS'] : $this->lang('DEFAULT_AVATAR_USERS'); ?> /> <?php echo isset($this->vars['L_DEFAULT_AVATAR_USERS']) ? $this->vars['L_DEFAULT_AVATAR_USERS'] : $this->lang('L_DEFAULT_AVATAR_USERS'); ?></td>
            <td><input class="post" type="text" name="default_avatar_users_url" style="width: 350px;" maxlength="255" value="<?php echo isset($this->vars['DEFAULT_AVATAR_USERS_URL']) ? $this->vars['DEFAULT_AVATAR_USERS_URL'] : $this->lang('DEFAULT_AVATAR_USERS_URL'); ?>" /></td>
          </tr>
          <tr>
            <td colspan="2"><input type="radio" name="default_avatar_set" value="2" <?php echo isset($this->vars['DEFAULT_AVATAR_BOTH']) ? $this->vars['DEFAULT_AVATAR_BOTH'] : $this->lang('DEFAULT_AVATAR_BOTH'); ?> /> <?php echo isset($this->vars['L_DEFAULT_AVATAR_BOTH']) ? $this->vars['L_DEFAULT_AVATAR_BOTH'] : $this->lang('L_DEFAULT_AVATAR_BOTH'); ?></td>
          </tr>
          <tr>
            <td colspan="2"><input type="radio" name="default_avatar_set" value="3" <?php echo isset($this->vars['DEFAULT_AVATAR_NONE']) ? $this->vars['DEFAULT_AVATAR_NONE'] : $this->lang('DEFAULT_AVATAR_NONE'); ?> /> <?php echo isset($this->vars['L_DEFAULT_AVATAR_NONE']) ? $this->vars['L_DEFAULT_AVATAR_NONE'] : $this->lang('L_DEFAULT_AVATAR_NONE'); ?></td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ALLOW_LOCAL']) ? $this->vars['L_ALLOW_LOCAL'] : $this->lang('L_ALLOW_LOCAL'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_avatar_local" value="1" <?php echo isset($this->vars['AVATARS_LOCAL_YES']) ? $this->vars['AVATARS_LOCAL_YES'] : $this->lang('AVATARS_LOCAL_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="allow_avatar_local" value="0" <?php echo isset($this->vars['AVATARS_LOCAL_NO']) ? $this->vars['AVATARS_LOCAL_NO'] : $this->lang('AVATARS_LOCAL_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_ALLOW_REMOTE']) ? $this->vars['L_ALLOW_REMOTE'] : $this->lang('L_ALLOW_REMOTE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_ALLOW_REMOTE_EXPLAIN']) ? $this->vars['L_ALLOW_REMOTE_EXPLAIN'] : $this->lang('L_ALLOW_REMOTE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_avatar_remote" value="1" <?php echo isset($this->vars['AVATARS_REMOTE_YES']) ? $this->vars['AVATARS_REMOTE_YES'] : $this->lang('AVATARS_REMOTE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="allow_avatar_remote" value="0" <?php echo isset($this->vars['AVATARS_REMOTE_NO']) ? $this->vars['AVATARS_REMOTE_NO'] : $this->lang('AVATARS_REMOTE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ALLOW_UPLOAD']) ? $this->vars['L_ALLOW_UPLOAD'] : $this->lang('L_ALLOW_UPLOAD'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_avatar_upload" value="1" <?php echo isset($this->vars['AVATARS_UPLOAD_YES']) ? $this->vars['AVATARS_UPLOAD_YES'] : $this->lang('AVATARS_UPLOAD_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="allow_avatar_upload" value="0" <?php echo isset($this->vars['AVATARS_UPLOAD_NO']) ? $this->vars['AVATARS_UPLOAD_NO'] : $this->lang('AVATARS_UPLOAD_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <!-- <?php echo isset($this->vars['L_MAX_FILESIZE']) ? $this->vars['L_MAX_FILESIZE'] : $this->lang('L_MAX_FILESIZE'); ?><br /><span class="gensmall"><?php echo isset($this->vars['L_MAX_FILESIZE_EXPLAIN']) ? $this->vars['L_MAX_FILESIZE_EXPLAIN'] : $this->lang('L_MAX_FILESIZE_EXPLAIN'); ?></span> -->
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_MAX_FILESIZE']) ? $this->vars['L_MAX_FILESIZE'] : $this->lang('L_MAX_FILESIZE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_MAX_FILESIZE_EXPLAIN']) ? $this->vars['L_MAX_FILESIZE_EXPLAIN'] : $this->lang('L_MAX_FILESIZE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="4" maxlength="10" name="avatar_filesize" value="<?php echo isset($this->vars['AVATAR_FILESIZE']) ? $this->vars['AVATAR_FILESIZE'] : $this->lang('AVATAR_FILESIZE'); ?>" /> Bytes</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_MAX_AVATAR_SIZE']) ? $this->vars['L_MAX_AVATAR_SIZE'] : $this->lang('L_MAX_AVATAR_SIZE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_MAX_AVATAR_SIZE_EXPLAIN']) ? $this->vars['L_MAX_AVATAR_SIZE_EXPLAIN'] : $this->lang('L_MAX_AVATAR_SIZE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="avatar_max_height" value="<?php echo isset($this->vars['AVATAR_MAX_HEIGHT']) ? $this->vars['AVATAR_MAX_HEIGHT'] : $this->lang('AVATAR_MAX_HEIGHT'); ?>" /> x <input class="post" type="text" size="3" maxlength="4" name="avatar_max_width" value="<?php echo isset($this->vars['AVATAR_MAX_WIDTH']) ? $this->vars['AVATAR_MAX_WIDTH'] : $this->lang('AVATAR_MAX_WIDTH'); ?>"></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_AVATAR_STORAGE_PATH']) ? $this->vars['L_AVATAR_STORAGE_PATH'] : $this->lang('L_AVATAR_STORAGE_PATH'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_AVATAR_STORAGE_PATH_EXPLAIN']) ? $this->vars['L_AVATAR_STORAGE_PATH_EXPLAIN'] : $this->lang('L_AVATAR_STORAGE_PATH_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" style="width: 350px;" maxlength="255" name="avatar_path" value="<?php echo isset($this->vars['AVATAR_PATH']) ? $this->vars['AVATAR_PATH'] : $this->lang('AVATAR_PATH'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_AVATAR_GALLERY_PATH']) ? $this->vars['L_AVATAR_GALLERY_PATH'] : $this->lang('L_AVATAR_GALLERY_PATH'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_AVATAR_GALLERY_PATH_EXPLAIN']) ? $this->vars['L_AVATAR_GALLERY_PATH_EXPLAIN'] : $this->lang('L_AVATAR_GALLERY_PATH_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" style="width: 350px;" maxlength="255" name="avatar_gallery_path" value="<?php echo isset($this->vars['AVATAR_GALLERY_PATH']) ? $this->vars['AVATAR_GALLERY_PATH'] : $this->lang('AVATAR_GALLERY_PATH'); ?>" /></td>
  </tr>
</table>
</span>