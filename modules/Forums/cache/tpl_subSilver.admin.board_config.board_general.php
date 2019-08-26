<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr <?php echo isset($this->vars['DHTML_HAND']) ? $this->vars['DHTML_HAND'] : $this->lang('DHTML_HAND'); ?> <?php echo isset($this->vars['DHTML_ONCLICK']) ? $this->vars['DHTML_ONCLICK'] : $this->lang('DHTML_ONCLICK'); ?>"show(<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>)">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_GENERAL_SETTINGS']) ? $this->vars['L_GENERAL_SETTINGS'] : $this->lang('L_GENERAL_SETTINGS'); ?></td>
  </tr>
</table>

<span id="<?php echo isset($this->vars['DHTML_ID']) ? $this->vars['DHTML_ID'] : $this->lang('DHTML_ID'); ?>" <?php echo isset($this->vars['DHTML_DISPLAY']) ? $this->vars['DHTML_DISPLAY'] : $this->lang('DHTML_DISPLAY'); ?>>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SERVER_NAME']) ? $this->vars['L_SERVER_NAME'] : $this->lang('L_SERVER_NAME'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="server_name" style="width: 350px;" value="<?php echo isset($this->vars['SERVER_NAME']) ? $this->vars['SERVER_NAME'] : $this->lang('SERVER_NAME'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_SERVER_PORT']) ? $this->vars['L_SERVER_PORT'] : $this->lang('L_SERVER_PORT'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_SERVER_PORT_EXPLAIN']) ? $this->vars['L_SERVER_PORT_EXPLAIN'] : $this->lang('L_SERVER_PORT_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="5" size="5" name="server_port" value="<?php echo isset($this->vars['SERVER_PORT']) ? $this->vars['SERVER_PORT'] : $this->lang('SERVER_PORT'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_SCRIPT_PATH']) ? $this->vars['L_SCRIPT_PATH'] : $this->lang('L_SCRIPT_PATH'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_SCRIPT_PATH_EXPLAIN']) ? $this->vars['L_SCRIPT_PATH_EXPLAIN'] : $this->lang('L_SCRIPT_PATH_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="script_path" style="width: 350px;" value="<?php echo isset($this->vars['SCRIPT_PATH']) ? $this->vars['SCRIPT_PATH'] : $this->lang('SCRIPT_PATH'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_SITE_NAME']) ? $this->vars['L_SITE_NAME'] : $this->lang('L_SITE_NAME'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_SITE_DESCRIPTION']) ? $this->vars['L_SITE_DESCRIPTION'] : $this->lang('L_SITE_DESCRIPTION'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="100" name="sitename" style="width: 350px;" value="<?php echo isset($this->vars['SITENAME']) ? $this->vars['SITENAME'] : $this->lang('SITENAME'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_SITE_DESCRIPTION']) ? $this->vars['L_SITE_DESCRIPTION'] : $this->lang('L_SITE_DESCRIPTION'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="site_desc" style="width: 350px;" value="<?php echo isset($this->vars['SITE_DESCRIPTION']) ? $this->vars['SITE_DESCRIPTION'] : $this->lang('SITE_DESCRIPTION'); ?>" /></td>
  </tr>
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_GLOBAL_TITLE']) ? $this->vars['L_GLOBAL_TITLE'] : $this->lang('L_GLOBAL_TITLE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_GLOBAL_TITLE_EXPLAIN']) ? $this->vars['L_GLOBAL_TITLE_EXPLAIN'] : $this->lang('L_GLOBAL_TITLE_EXPLAIN'); ?>"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="55" name="global_title" style="width: 350px;" value="<?php echo isset($this->vars['GLOBAL_TITLE']) ? $this->vars['GLOBAL_TITLE'] : $this->lang('GLOBAL_TITLE'); ?>" /></td> 
  </tr> 
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_GLOBAL']) ? $this->vars['L_GLOBAL'] : $this->lang('L_GLOBAL'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_GLOBAL_EXPLAIN']) ? $this->vars['L_GLOBAL_EXPLAIN'] : $this->lang('L_GLOBAL_EXPLAIN'); ?>"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><textarea name="global_announcement" maxlength="255" onkeydown="return ismaxlength(this)" style="height: 100px; width: 350px;"><?php echo isset($this->vars['GLOBAL_ANNOUNCEMENT']) ? $this->vars['GLOBAL_ANNOUNCEMENT'] : $this->lang('GLOBAL_ANNOUNCEMENT'); ?></textarea></td> 
  </tr> 
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_ENABLE_GLOBAL']) ? $this->vars['L_ENABLE_GLOBAL'] : $this->lang('L_ENABLE_GLOBAL'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_ENABLE_GLOBAL_EXPLAIN']) ? $this->vars['L_ENABLE_GLOBAL_EXPLAIN'] : $this->lang('L_ENABLE_GLOBAL_EXPLAIN'); ?>"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="global_enable" value="1" <?php echo isset($this->vars['S_ENABLE_GLOBAL_YES']) ? $this->vars['S_ENABLE_GLOBAL_YES'] : $this->lang('S_ENABLE_GLOBAL_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp;&nbsp;<input type="radio" name="global_enable" value="0" <?php echo isset($this->vars['S_ENABLE_GLOBAL_NO']) ? $this->vars['S_ENABLE_GLOBAL_NO'] : $this->lang('S_ENABLE_GLOBAL_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td> 
  </tr> 
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DISABLE_MARQUEE']) ? $this->vars['L_DISABLE_MARQUEE'] : $this->lang('L_DISABLE_MARQUEE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_DISABLE_MARQUEE_EXPLAIN']) ? $this->vars['L_DISABLE_MARQUEE_EXPLAIN'] : $this->lang('L_DISABLE_MARQUEE_EXPLAIN'); ?>"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="marquee_disable" value="1" <?php echo isset($this->vars['S_DISABLE_MARQUEE_YES']) ? $this->vars['S_DISABLE_MARQUEE_YES'] : $this->lang('S_DISABLE_MARQUEE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp;&nbsp;<input type="radio" name="marquee_disable" value="0" <?php echo isset($this->vars['S_DISABLE_MARQUEE_NO']) ? $this->vars['S_DISABLE_MARQUEE_NO'] : $this->lang('S_DISABLE_MARQUEE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td> 
  </tr> 
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DHTML']) ? $this->vars['L_DHTML'] : $this->lang('L_DHTML'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_DHTML_EXPLAIN']) ? $this->vars['L_DHTML_EXPLAIN'] : $this->lang('L_DHTML_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="use_dhtml" value="1" <?php echo isset($this->vars['DHTML_YES']) ? $this->vars['DHTML_YES'] : $this->lang('DHTML_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="use_dhtml" value="0" <?php echo isset($this->vars['DHTML_NO']) ? $this->vars['DHTML_NO'] : $this->lang('DHTML_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ADMIN_STYLE']) ? $this->vars['L_ADMIN_STYLE'] : $this->lang('L_ADMIN_STYLE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="use_theme_style" value="1" <?php echo isset($this->vars['ADMIN_STYLE_THEME']) ? $this->vars['ADMIN_STYLE_THEME'] : $this->lang('ADMIN_STYLE_THEME'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="use_theme_style" value="0" <?php echo isset($this->vars['ADMIN_STYLE_DEFAULT']) ? $this->vars['ADMIN_STYLE_DEFAULT'] : $this->lang('ADMIN_STYLE_DEFAULT'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DISABLE_BOARD']) ? $this->vars['L_DISABLE_BOARD'] : $this->lang('L_DISABLE_BOARD'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_DISABLE_BOARD_EXPLAIN']) ? $this->vars['L_DISABLE_BOARD_EXPLAIN'] : $this->lang('L_DISABLE_BOARD_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="board_disable" value="1" <?php echo isset($this->vars['S_DISABLE_BOARD_YES']) ? $this->vars['S_DISABLE_BOARD_YES'] : $this->lang('S_DISABLE_BOARD_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="board_disable" value="0" <?php echo isset($this->vars['S_DISABLE_BOARD_NO']) ? $this->vars['S_DISABLE_BOARD_NO'] : $this->lang('S_DISABLE_BOARD_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DISABLE_BOARD_ADMINVIEW']) ? $this->vars['L_DISABLE_BOARD_ADMINVIEW'] : $this->lang('L_DISABLE_BOARD_ADMINVIEW'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_DISABLE_BOARD_ADMINVIEW_EXPLAIN']) ? $this->vars['L_DISABLE_BOARD_ADMINVIEW_EXPLAIN'] : $this->lang('L_DISABLE_BOARD_ADMINVIEW_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="board_disable_adminview" value="1" <?php echo isset($this->vars['S_DISABLE_BOARD_ADMINVIEW_YES']) ? $this->vars['S_DISABLE_BOARD_ADMINVIEW_YES'] : $this->lang('S_DISABLE_BOARD_ADMINVIEW_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>  <input type="radio" name="board_disable_adminview" value="0" <?php echo isset($this->vars['S_DISABLE_BOARD_ADMINVIEW_NO']) ? $this->vars['S_DISABLE_BOARD_ADMINVIEW_NO'] : $this->lang('S_DISABLE_BOARD_ADMINVIEW_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DISABLE_BOARD_MSG']) ? $this->vars['L_DISABLE_BOARD_MSG'] : $this->lang('L_DISABLE_BOARD_MSG'); ?></span>
      <span class="evo-sprite help tooltip-html float-right" title="<?php echo isset($this->vars['L_DISABLE_BOARD_MSG_EXPLAIN']) ? $this->vars['L_DISABLE_BOARD_MSG_EXPLAIN'] : $this->lang('L_DISABLE_BOARD_MSG_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="board_disable_msg" style="width: 350px;" value="<?php echo isset($this->vars['DISABLE_BOARD_MSG']) ? $this->vars['DISABLE_BOARD_MSG'] : $this->lang('DISABLE_BOARD_MSG'); ?>" /></td>
  </tr>
  <input type="hidden" name="require_activation" value="<?php echo isset($this->vars['ACTIVATION_NONE']) ? $this->vars['ACTIVATION_NONE'] : $this->lang('ACTIVATION_NONE'); ?>" />
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_BOARD_EMAIL_FORM']) ? $this->vars['L_BOARD_EMAIL_FORM'] : $this->lang('L_BOARD_EMAIL_FORM'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_BOARD_EMAIL_FORM_EXPLAIN']) ? $this->vars['L_BOARD_EMAIL_FORM_EXPLAIN'] : $this->lang('L_BOARD_EMAIL_FORM_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="board_email_form" value="1" <?php echo isset($this->vars['BOARD_EMAIL_FORM_ENABLE']) ? $this->vars['BOARD_EMAIL_FORM_ENABLE'] : $this->lang('BOARD_EMAIL_FORM_ENABLE'); ?> /> <?php echo isset($this->vars['L_ENABLED']) ? $this->vars['L_ENABLED'] : $this->lang('L_ENABLED'); ?> <input type="radio" name="board_email_form" value="0" <?php echo isset($this->vars['BOARD_EMAIL_FORM_DISABLE']) ? $this->vars['BOARD_EMAIL_FORM_DISABLE'] : $this->lang('BOARD_EMAIL_FORM_DISABLE'); ?> /> <?php echo isset($this->vars['L_DISABLED']) ? $this->vars['L_DISABLED'] : $this->lang('L_DISABLED'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_FLOOD_INTERVAL']) ? $this->vars['L_FLOOD_INTERVAL'] : $this->lang('L_FLOOD_INTERVAL'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_FLOOD_INTERVAL_EXPLAIN']) ? $this->vars['L_FLOOD_INTERVAL_EXPLAIN'] : $this->lang('L_FLOOD_INTERVAL_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="<?php echo isset($this->vars['FLOOD_INTERVAL']) ? $this->vars['FLOOD_INTERVAL'] : $this->lang('FLOOD_INTERVAL'); ?>" /></td>
  </tr>
    <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_SEARCH_FLOOD_INTERVAL']) ? $this->vars['L_SEARCH_FLOOD_INTERVAL'] : $this->lang('L_SEARCH_FLOOD_INTERVAL'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_SEARCH_FLOOD_INTERVAL_EXPLAIN']) ? $this->vars['L_SEARCH_FLOOD_INTERVAL_EXPLAIN'] : $this->lang('L_SEARCH_FLOOD_INTERVAL_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="<?php echo isset($this->vars['SEARCH_FLOOD_INTERVAL']) ? $this->vars['SEARCH_FLOOD_INTERVAL'] : $this->lang('SEARCH_FLOOD_INTERVAL'); ?>" /></td>
    </tr>
   <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_MAX_LOGIN_ATTEMPTS']) ? $this->vars['L_MAX_LOGIN_ATTEMPTS'] : $this->lang('L_MAX_LOGIN_ATTEMPTS'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_MAX_LOGIN_ATTEMPTS_EXPLAIN']) ? $this->vars['L_MAX_LOGIN_ATTEMPTS_EXPLAIN'] : $this->lang('L_MAX_LOGIN_ATTEMPTS_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="max_login_attempts" value="<?php echo isset($this->vars['MAX_LOGIN_ATTEMPTS']) ? $this->vars['MAX_LOGIN_ATTEMPTS'] : $this->lang('MAX_LOGIN_ATTEMPTS'); ?>" /></td>
   </tr>
   <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_LOGIN_RESET_TIME']) ? $this->vars['L_LOGIN_RESET_TIME'] : $this->lang('L_LOGIN_RESET_TIME'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_LOGIN_RESET_TIME_EXPLAIN']) ? $this->vars['L_LOGIN_RESET_TIME_EXPLAIN'] : $this->lang('L_LOGIN_RESET_TIME_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="login_reset_time" value="<?php echo isset($this->vars['LOGIN_RESET_TIME']) ? $this->vars['LOGIN_RESET_TIME'] : $this->lang('LOGIN_RESET_TIME'); ?>" /></td>
   </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_MAX_SMILIES']) ? $this->vars['L_MAX_SMILIES'] : $this->lang('L_MAX_SMILIES'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="max_smilies" size="3" maxlength="4" value="<?php echo isset($this->vars['MAX_SMILIES']) ? $this->vars['MAX_SMILIES'] : $this->lang('MAX_SMILIES'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_TOPICS_PER_PAGE']) ? $this->vars['L_TOPICS_PER_PAGE'] : $this->lang('L_TOPICS_PER_PAGE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="topics_per_page" size="3" maxlength="4" value="<?php echo isset($this->vars['TOPICS_PER_PAGE']) ? $this->vars['TOPICS_PER_PAGE'] : $this->lang('TOPICS_PER_PAGE'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_POSTS_PER_PAGE']) ? $this->vars['L_POSTS_PER_PAGE'] : $this->lang('L_POSTS_PER_PAGE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="posts_per_page" size="3" maxlength="4" value="<?php echo isset($this->vars['POSTS_PER_PAGE']) ? $this->vars['POSTS_PER_PAGE'] : $this->lang('POSTS_PER_PAGE'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_HOT_THRESHOLD']) ? $this->vars['L_HOT_THRESHOLD'] : $this->lang('L_HOT_THRESHOLD'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="hot_threshold" size="3" maxlength="4" value="<?php echo isset($this->vars['HOT_TOPIC']) ? $this->vars['HOT_TOPIC'] : $this->lang('HOT_TOPIC'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_DEFAULT_STYLE']) ? $this->vars['L_DEFAULT_STYLE'] : $this->lang('L_DEFAULT_STYLE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><?php echo isset($this->vars['STYLE_SELECT']) ? $this->vars['STYLE_SELECT'] : $this->lang('STYLE_SELECT'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_OVERRIDE_STYLE']) ? $this->vars['L_OVERRIDE_STYLE'] : $this->lang('L_OVERRIDE_STYLE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_OVERRIDE_STYLE_EXPLAIN']) ? $this->vars['L_OVERRIDE_STYLE_EXPLAIN'] : $this->lang('L_OVERRIDE_STYLE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="override_user_style" value="1" <?php echo isset($this->vars['OVERRIDE_STYLE_YES']) ? $this->vars['OVERRIDE_STYLE_YES'] : $this->lang('OVERRIDE_STYLE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="override_user_style" value="0" <?php echo isset($this->vars['OVERRIDE_STYLE_NO']) ? $this->vars['OVERRIDE_STYLE_NO'] : $this->lang('OVERRIDE_STYLE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <!-- Quick Search -->
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_QUICK_SEARCH_ENABLE']) ? $this->vars['L_QUICK_SEARCH_ENABLE'] : $this->lang('L_QUICK_SEARCH_ENABLE'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_QUICK_SEARCH_ENABLE_EXPLAIN']) ? $this->vars['L_QUICK_SEARCH_ENABLE_EXPLAIN'] : $this->lang('L_QUICK_SEARCH_ENABLE_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="quick_search_enable" value="1" <?php echo isset($this->vars['S_QUICK_SEARCH_ENABLE_YES']) ? $this->vars['S_QUICK_SEARCH_ENABLE_YES'] : $this->lang('S_QUICK_SEARCH_ENABLE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="quick_search_enable" value="0" <?php echo isset($this->vars['S_QUICK_SEARCH_ENABLE_NO']) ? $this->vars['S_QUICK_SEARCH_ENABLE_NO'] : $this->lang('S_QUICK_SEARCH_ENABLE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_DEFAULT_LANGUAGE']) ? $this->vars['L_DEFAULT_LANGUAGE'] : $this->lang('L_DEFAULT_LANGUAGE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><?php echo isset($this->vars['LANG_SELECT']) ? $this->vars['LANG_SELECT'] : $this->lang('LANG_SELECT'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DATE_FORMAT']) ? $this->vars['L_DATE_FORMAT'] : $this->lang('L_DATE_FORMAT'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_DATE_FORMAT_EXPLAIN']) ? $this->vars['L_DATE_FORMAT_EXPLAIN'] : $this->lang('L_DATE_FORMAT_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="default_dateformat" style="width: 350px;" value="<?php echo isset($this->vars['DEFAULT_DATEFORMAT']) ? $this->vars['DEFAULT_DATEFORMAT'] : $this->lang('DEFAULT_DATEFORMAT'); ?>" /></td>
  </tr>
  <!-- Start replacement - Advanced time management MOD -->
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_TIME_MODE']) ? $this->vars['L_TIME_MODE'] : $this->lang('L_TIME_MODE'); ?></span>
      <span class="evo-sprite help tooltip-html float-right" title="<?php echo isset($this->vars['L_TIME_MODE_TEXT']) ? $this->vars['L_TIME_MODE_TEXT'] : $this->lang('L_TIME_MODE_TEXT'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;" nowrap="nowrap">
      <span><?php echo isset($this->vars['L_TIME_MODE_AUTO']) ? $this->vars['L_TIME_MODE_AUTO'] : $this->lang('L_TIME_MODE_AUTO'); ?></span><br /><input type="radio" name="default_time_mode" value="6" <?php echo isset($this->vars['TIME_MODE_FULL_PC_CHECKED']) ? $this->vars['TIME_MODE_FULL_PC_CHECKED'] : $this->lang('TIME_MODE_FULL_PC_CHECKED'); ?>/>
      <span><?php echo isset($this->vars['L_TIME_MODE_FULL_PC']) ? $this->vars['L_TIME_MODE_FULL_PC'] : $this->lang('L_TIME_MODE_FULL_PC'); ?></span> <br /><input type="radio" name="default_time_mode" value="4" <?php echo isset($this->vars['TIME_MODE_SERVER_PC_CHECKED']) ? $this->vars['TIME_MODE_SERVER_PC_CHECKED'] : $this->lang('TIME_MODE_SERVER_PC_CHECKED'); ?>/>
      <span><?php echo isset($this->vars['L_TIME_MODE_SERVER_PC']) ? $this->vars['L_TIME_MODE_SERVER_PC'] : $this->lang('L_TIME_MODE_SERVER_PC'); ?></span><br /><input type="radio" name="default_time_mode" value="3" <?php echo isset($this->vars['TIME_MODE_FULL_SERVER_CHECKED']) ? $this->vars['TIME_MODE_FULL_SERVER_CHECKED'] : $this->lang('TIME_MODE_FULL_SERVER_CHECKED'); ?>/>
      <span><?php echo isset($this->vars['L_TIME_MODE_FULL_SERVER']) ? $this->vars['L_TIME_MODE_FULL_SERVER'] : $this->lang('L_TIME_MODE_FULL_SERVER'); ?></span>
      <br /><br />
      <span><?php echo isset($this->vars['L_TIME_MODE_MANUAL']) ? $this->vars['L_TIME_MODE_MANUAL'] : $this->lang('L_TIME_MODE_MANUAL'); ?></span><br />
      <span> <?php echo isset($this->vars['L_TIME_MODE_DST']) ? $this->vars['L_TIME_MODE_DST'] : $this->lang('L_TIME_MODE_DST'); ?>:</span><input type="radio" name="default_time_mode" value="1" <?php echo isset($this->vars['TIME_MODE_MANUAL_DST_CHECKED']) ? $this->vars['TIME_MODE_MANUAL_DST_CHECKED'] : $this->lang('TIME_MODE_MANUAL_DST_CHECKED'); ?>/><span><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></span>&nbsp;<input type="radio" name="default_time_mode" value="0" <?php echo isset($this->vars['TIME_MODE_MANUAL_CHECKED']) ? $this->vars['TIME_MODE_MANUAL_CHECKED'] : $this->lang('TIME_MODE_MANUAL_CHECKED'); ?>/><span><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></span>&nbsp;<input type="radio" name="default_time_mode" value="2" <?php echo isset($this->vars['TIME_MODE_SERVER_SWITCH_CHECKED']) ? $this->vars['TIME_MODE_SERVER_SWITCH_CHECKED'] : $this->lang('TIME_MODE_SERVER_SWITCH_CHECKED'); ?>/><span><?php echo isset($this->vars['L_TIME_MODE_DST_SERVER']) ? $this->vars['L_TIME_MODE_DST_SERVER'] : $this->lang('L_TIME_MODE_DST_SERVER'); ?></span><br />
      <span> <?php echo isset($this->vars['L_TIME_MODE_DST_TIME_LAG']) ? $this->vars['L_TIME_MODE_DST_TIME_LAG'] : $this->lang('L_TIME_MODE_DST_TIME_LAG'); ?>: </span><input type="text" name="default_dst_time_lag" value="<?php echo isset($this->vars['DST_TIME_LAG']) ? $this->vars['DST_TIME_LAG'] : $this->lang('DST_TIME_LAG'); ?>" maxlength="3" size="3" class="post" /><span><?php echo isset($this->vars['L_TIME_MODE_DST_MN']) ? $this->vars['L_TIME_MODE_DST_MN'] : $this->lang('L_TIME_MODE_DST_MN'); ?></span><br />
      <span> <?php echo isset($this->vars['L_TIME_MODE_TIMEZONE']) ? $this->vars['L_TIME_MODE_TIMEZONE'] : $this->lang('L_TIME_MODE_TIMEZONE'); ?>: </span><span class="gensmall"><?php echo isset($this->vars['TIMEZONE_SELECT']) ? $this->vars['TIMEZONE_SELECT'] : $this->lang('TIMEZONE_SELECT'); ?></span>
    </td>
  </tr>
  <!-- End replacement - Advanced time management MOD -->
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_ONLINE_TIME']) ? $this->vars['L_ONLINE_TIME'] : $this->lang('L_ONLINE_TIME'); ?></span>
      <span class="evo-sprite help tooltip float-right" title="<?php echo isset($this->vars['L_ONLINE_TIME_EXPLAIN']) ? $this->vars['L_ONLINE_TIME_EXPLAIN'] : $this->lang('L_ONLINE_TIME_EXPLAIN'); ?>"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="online_time" value="<?php echo isset($this->vars['ONLINE_TIME']) ? $this->vars['ONLINE_TIME'] : $this->lang('ONLINE_TIME'); ?>" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ENABLE_PRUNE']) ? $this->vars['L_ENABLE_PRUNE'] : $this->lang('L_ENABLE_PRUNE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="prune_enable" value="1" <?php echo isset($this->vars['PRUNE_YES']) ? $this->vars['PRUNE_YES'] : $this->lang('PRUNE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="prune_enable" value="0" <?php echo isset($this->vars['PRUNE_NO']) ? $this->vars['PRUNE_NO'] : $this->lang('PRUNE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_REPORT_EMAIL']) ? $this->vars['L_REPORT_EMAIL'] : $this->lang('L_REPORT_EMAIL'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="report_email" value="1" <?php echo isset($this->vars['REPORT_EMAIL_YES']) ? $this->vars['REPORT_EMAIL_YES'] : $this->lang('REPORT_EMAIL_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="report_email" value="0" <?php echo isset($this->vars['REPORT_EMAIL_NO']) ? $this->vars['REPORT_EMAIL_NO'] : $this->lang('REPORT_EMAIL_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;"><?php echo isset($this->vars['L_ALLOW_NAME_CHANGE']) ? $this->vars['L_ALLOW_NAME_CHANGE'] : $this->lang('L_ALLOW_NAME_CHANGE'); ?></td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_namechange" value="1" <?php echo isset($this->vars['NAMECHANGE_YES']) ? $this->vars['NAMECHANGE_YES'] : $this->lang('NAMECHANGE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?> <input type="radio" name="allow_namechange" value="0" <?php echo isset($this->vars['NAMECHANGE_NO']) ? $this->vars['NAMECHANGE_NO'] : $this->lang('NAMECHANGE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
  </tr>
</table>
</span>
