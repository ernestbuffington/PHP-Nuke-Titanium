<?php

// eXtreme Styles mod cache. Generated on Fri, 30 Aug 2019 23:32:49 +0000 (time=1567207969)

?><h1><?php echo isset($this->vars['L_USER_TITLE']) ? $this->vars['L_USER_TITLE'] : $this->lang('L_USER_TITLE'); ?></h1>

<p><?php echo isset($this->vars['L_USER_EXPLAIN']) ? $this->vars['L_USER_EXPLAIN'] : $this->lang('L_USER_EXPLAIN'); ?></p>

<?php echo isset($this->vars['ERROR_BOX']) ? $this->vars['ERROR_BOX'] : $this->lang('ERROR_BOX'); ?>

<form action="<?php echo isset($this->vars['S_PROFILE_ACTION']) ? $this->vars['S_PROFILE_ACTION'] : $this->lang('S_PROFILE_ACTION'); ?>" <?php echo isset($this->vars['S_FORM_ENCTYPE']) ? $this->vars['S_FORM_ENCTYPE'] : $this->lang('S_FORM_ENCTYPE'); ?> method="post">
  <table width="98%" cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
    <tr>
      <td class="catHead" colspan="2"><?php echo isset($this->vars['L_REGISTRATION_INFO']) ? $this->vars['L_REGISTRATION_INFO'] : $this->lang('L_REGISTRATION_INFO'); ?></th>
    </tr>
    <tr>
      <td class="row2" colspan="2"><?php echo isset($this->vars['L_ITEMS_REQUIRED']) ? $this->vars['L_ITEMS_REQUIRED'] : $this->lang('L_ITEMS_REQUIRED'); ?></td>
    </tr>
    <tr>
      <td class="row1" width="38%">
        <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></span>
        <span class="tooltip evo-sprite about float-right" title="<?php echo isset($this->vars['L_REQUIRED']) ? $this->vars['L_REQUIRED'] : $this->lang('L_REQUIRED'); ?>"></span>
      </td>
      <td class="row2"><input class="post" type="text" name="username" size="35" maxlength="40" value="<?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?>" /></td>
    </tr>
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_EMAIL_ADDRESS']) ? $this->vars['L_EMAIL_ADDRESS'] : $this->lang('L_EMAIL_ADDRESS'); ?></span>
        <span class="tooltip evo-sprite about float-right" title="<?php echo isset($this->vars['L_REQUIRED']) ? $this->vars['L_REQUIRED'] : $this->lang('L_REQUIRED'); ?>"></span>
      </td>
      <td class="row2"><input class="post" type="text" name="email" size="35" maxlength="255" value="<?php echo isset($this->vars['EMAIL']) ? $this->vars['EMAIL'] : $this->lang('EMAIL'); ?>" /></td>
    </tr>
	<?php

$birthday_required_count = ( isset($this->_tpldata['birthday_required.']) ) ?  sizeof($this->_tpldata['birthday_required.']) : 0;
for ($birthday_required_i = 0; $birthday_required_i < $birthday_required_count; $birthday_required_i++)
{
 $birthday_required_item = &$this->_tpldata['birthday_required.'][$birthday_required_i];
 $birthday_required_item['S_ROW_COUNT'] = $birthday_required_i;
 $birthday_required_item['S_NUM_ROWS'] = $birthday_required_count;

?>
	<tr>
      <td class="row1"><?php echo isset($this->vars['L_BIRTHDAY']) ? $this->vars['L_BIRTHDAY'] : $this->lang('L_BIRTHDAY'); ?>: *</td>
      <td class="row2"><?php echo isset($this->vars['BIRTHDAY_INTERFACE']) ? $this->vars['BIRTHDAY_INTERFACE'] : $this->lang('BIRTHDAY_INTERFACE'); ?></td>
	</tr>
	<?php

} // END birthday_required

if(isset($birthday_required_item)) { unset($birthday_required_item); } 

?>
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_NEW_PASSWORD']) ? $this->vars['L_NEW_PASSWORD'] : $this->lang('L_NEW_PASSWORD'); ?></span>
        <span class="tooltip evo-sprite about float-right" title="<?php echo isset($this->vars['L_REQUIRED']) ? $this->vars['L_REQUIRED'] : $this->lang('L_REQUIRED'); ?>"></span>
        <span class="tooltip evo-sprite help float-right" title="<?php echo isset($this->vars['L_PASSWORD_IF_CHANGED']) ? $this->vars['L_PASSWORD_IF_CHANGED'] : $this->lang('L_PASSWORD_IF_CHANGED'); ?>"></span>
      </td>
      <td class="row2"><input class="post" type="password" name="password" size="35" maxlength="32" value="" /></td>
    </tr>
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_CONFIRM_PASSWORD']) ? $this->vars['L_CONFIRM_PASSWORD'] : $this->lang('L_CONFIRM_PASSWORD'); ?></span>
        <span class="tooltip evo-sprite help float-right" title="<?php echo isset($this->vars['L_PASSWORD_CONFIRM_IF_CHANGED']) ? $this->vars['L_PASSWORD_CONFIRM_IF_CHANGED'] : $this->lang('L_PASSWORD_CONFIRM_IF_CHANGED'); ?>"></span>
      </td>
      <td class="row2"><input class="post" type="password" name="password_confirm" size="35" maxlength="32" value="" /></td>
    </tr>
    <tr>
      <td class="catsides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2"><?php echo isset($this->vars['L_PROFILE_INFO']) ? $this->vars['L_PROFILE_INFO'] : $this->lang('L_PROFILE_INFO'); ?></th>
    </tr>
    <tr>
      <td class="row2" colspan="2"><?php echo isset($this->vars['L_PROFILE_INFO_NOTICE']) ? $this->vars['L_PROFILE_INFO_NOTICE'] : $this->lang('L_PROFILE_INFO_NOTICE'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_REPUTATION']) ? $this->vars['L_REPUTATION'] : $this->lang('L_REPUTATION'); ?></td>
      <td class="row2"><input class="post" type="text" name="reputation" size="10" maxlength="15" value="<?php echo isset($this->vars['REPUTATION']) ? $this->vars['REPUTATION'] : $this->lang('REPUTATION'); ?>" /></td>
    </tr>
	<tr>
	  <td class="row1"><?php echo isset($this->vars['L_FACEBOOK']) ? $this->vars['L_FACEBOOK'] : $this->lang('L_FACEBOOK'); ?></td>
	  <td class="row2"><input class="post" type="text" name="facebook" size="35" maxlength="255" value="<?php echo isset($this->vars['FACEBOOK']) ? $this->vars['FACEBOOK'] : $this->lang('FACEBOOK'); ?>" /></td>
	</tr>        
<?php

$xdata_count = ( isset($this->_tpldata['xdata.']) ) ?  sizeof($this->_tpldata['xdata.']) : 0;
for ($xdata_i = 0; $xdata_i < $xdata_count; $xdata_i++)
{
 $xdata_item = &$this->_tpldata['xdata.'][$xdata_i];
 $xdata_item['S_ROW_COUNT'] = $xdata_i;
 $xdata_item['S_NUM_ROWS'] = $xdata_count;

?>
<?php

$switch_is_website_count = ( isset($xdata_item['switch_is_website.']) ) ? sizeof($xdata_item['switch_is_website.']) : 0;
for ($switch_is_website_i = 0; $switch_is_website_i < $switch_is_website_count; $switch_is_website_i++)
{
 $switch_is_website_item = &$xdata_item['switch_is_website.'][$switch_is_website_i];
 $switch_is_website_item['S_ROW_COUNT'] = $switch_is_website_i;
 $switch_is_website_item['S_NUM_ROWS'] = $switch_is_website_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_WEBSITE']) ? $this->vars['L_WEBSITE'] : $this->lang('L_WEBSITE'); ?></td>
      <td class="row2"><input class="post" type="text" name="website" size="35" maxlength="255" value="<?php echo isset($this->vars['WEBSITE']) ? $this->vars['WEBSITE'] : $this->lang('WEBSITE'); ?>" /></td>
    </tr>
<?php

} // END switch_is_website

if(isset($switch_is_website_item)) { unset($switch_is_website_item); } 

?>
<?php

$switch_is_location_count = ( isset($xdata_item['switch_is_location.']) ) ? sizeof($xdata_item['switch_is_location.']) : 0;
for ($switch_is_location_i = 0; $switch_is_location_i < $switch_is_location_count; $switch_is_location_i++)
{
 $switch_is_location_item = &$xdata_item['switch_is_location.'][$switch_is_location_i];
 $switch_is_location_item['S_ROW_COUNT'] = $switch_is_location_i;
 $switch_is_location_item['S_NUM_ROWS'] = $switch_is_location_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_LOCATION']) ? $this->vars['L_LOCATION'] : $this->lang('L_LOCATION'); ?></td>
      <td class="row2"><input class="post" type="text" name="location" size="35" maxlength="100" value="<?php echo isset($this->vars['LOCATION']) ? $this->vars['LOCATION'] : $this->lang('LOCATION'); ?>" /></td>
    </tr>
<!-- FLAGHACK-start -->
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_FLAG']) ? $this->vars['L_FLAG'] : $this->lang('L_FLAG'); ?></td>
      <td class="row2">
        <table cellspacing="0" celpadding="0">
          <tr>
            <td><?php echo isset($this->vars['FLAG_SELECT']) ? $this->vars['FLAG_SELECT'] : $this->lang('FLAG_SELECT'); ?></td>
            <td>
              <!-- <img src="../../../images/flags/<?php echo isset($this->vars['FLAG_START']) ? $this->vars['FLAG_START'] : $this->lang('FLAG_START'); ?>" width="16" height="11" name="user_flag" /> -->
              <span class="countries <?php echo isset($this->vars['FLAG_START']) ? $this->vars['FLAG_START'] : $this->lang('FLAG_START'); ?>"></span>
            </td>
          </tr>
        </table>
      </td>
	</tr>
<!-- FLAGHACK-end -->
<?php

} // END switch_is_location

if(isset($switch_is_location_item)) { unset($switch_is_location_item); } 

?>
<?php

$switch_is_occupation_count = ( isset($xdata_item['switch_is_occupation.']) ) ? sizeof($xdata_item['switch_is_occupation.']) : 0;
for ($switch_is_occupation_i = 0; $switch_is_occupation_i < $switch_is_occupation_count; $switch_is_occupation_i++)
{
 $switch_is_occupation_item = &$xdata_item['switch_is_occupation.'][$switch_is_occupation_i];
 $switch_is_occupation_item['S_ROW_COUNT'] = $switch_is_occupation_i;
 $switch_is_occupation_item['S_NUM_ROWS'] = $switch_is_occupation_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_OCCUPATION']) ? $this->vars['L_OCCUPATION'] : $this->lang('L_OCCUPATION'); ?></td>
      <td class="row2"><input class="post" type="text" name="occupation" size="35" maxlength="100" value="<?php echo isset($this->vars['OCCUPATION']) ? $this->vars['OCCUPATION'] : $this->lang('OCCUPATION'); ?>" /></td>
    </tr>
<?php

} // END switch_is_occupation

if(isset($switch_is_occupation_item)) { unset($switch_is_occupation_item); } 

?>
<?php

$switch_is_interests_count = ( isset($xdata_item['switch_is_interests.']) ) ? sizeof($xdata_item['switch_is_interests.']) : 0;
for ($switch_is_interests_i = 0; $switch_is_interests_i < $switch_is_interests_count; $switch_is_interests_i++)
{
 $switch_is_interests_item = &$xdata_item['switch_is_interests.'][$switch_is_interests_i];
 $switch_is_interests_item['S_ROW_COUNT'] = $switch_is_interests_i;
 $switch_is_interests_item['S_NUM_ROWS'] = $switch_is_interests_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_INTERESTS']) ? $this->vars['L_INTERESTS'] : $this->lang('L_INTERESTS'); ?></td>
      <td class="row2"><input class="post" type="text" name="interests" size="35" maxlength="150" value="<?php echo isset($this->vars['INTERESTS']) ? $this->vars['INTERESTS'] : $this->lang('INTERESTS'); ?>" /></td>
    </tr>
<!-- Start add - Gender MOD -->
    <tr> 
      <td class="row1"><?php echo isset($this->vars['L_GENDER']) ? $this->vars['L_GENDER'] : $this->lang('L_GENDER'); ?></td> 
      <td class="row2"> 
      <input type="radio" name="gender" value="0" <?php echo isset($this->vars['GENDER_NO_SPECIFY_CHECKED']) ? $this->vars['GENDER_NO_SPECIFY_CHECKED'] : $this->lang('GENDER_NO_SPECIFY_CHECKED'); ?>/> <?php echo isset($this->vars['L_GENDER_NOT_SPECIFY']) ? $this->vars['L_GENDER_NOT_SPECIFY'] : $this->lang('L_GENDER_NOT_SPECIFY'); ?>&nbsp;&nbsp; 
      <input type="radio" name="gender" value="1" <?php echo isset($this->vars['GENDER_MALE_CHECKED']) ? $this->vars['GENDER_MALE_CHECKED'] : $this->lang('GENDER_MALE_CHECKED'); ?>/> <?php echo isset($this->vars['L_GENDER_MALE']) ? $this->vars['L_GENDER_MALE'] : $this->lang('L_GENDER_MALE'); ?>&nbsp;&nbsp; 
      <input type="radio" name="gender" value="2" <?php echo isset($this->vars['GENDER_FEMALE_CHECKED']) ? $this->vars['GENDER_FEMALE_CHECKED'] : $this->lang('GENDER_FEMALE_CHECKED'); ?>/> <?php echo isset($this->vars['L_GENDER_FEMALE']) ? $this->vars['L_GENDER_FEMALE'] : $this->lang('L_GENDER_FEMALE'); ?></td> 
    </tr>
<!-- End add - Gender MOD -->
<?php

} // END switch_is_interests

if(isset($switch_is_interests_item)) { unset($switch_is_interests_item); } 

?>
<?php

$switch_is_signature_count = ( isset($xdata_item['switch_is_signature.']) ) ? sizeof($xdata_item['switch_is_signature.']) : 0;
for ($switch_is_signature_i = 0; $switch_is_signature_i < $switch_is_signature_count; $switch_is_signature_i++)
{
 $switch_is_signature_item = &$xdata_item['switch_is_signature.'][$switch_is_signature_i];
 $switch_is_signature_item['S_ROW_COUNT'] = $switch_is_signature_i;
 $switch_is_signature_item['S_NUM_ROWS'] = $switch_is_signature_count;

?>
	<?php

$birthday_optional_count = ( isset($switch_is_signature_item['birthday_optional.']) ) ? sizeof($switch_is_signature_item['birthday_optional.']) : 0;
for ($birthday_optional_i = 0; $birthday_optional_i < $birthday_optional_count; $birthday_optional_i++)
{
 $birthday_optional_item = &$switch_is_signature_item['birthday_optional.'][$birthday_optional_i];
 $birthday_optional_item['S_ROW_COUNT'] = $birthday_optional_i;
 $birthday_optional_item['S_NUM_ROWS'] = $birthday_optional_count;

?>
    <tr>
	  <td class="row1"><?php echo isset($this->vars['L_BIRTHDAY']) ? $this->vars['L_BIRTHDAY'] : $this->lang('L_BIRTHDAY'); ?></td>
	  <td class="row2"><?php echo isset($this->vars['BIRTHDAY_INTERFACE']) ? $this->vars['BIRTHDAY_INTERFACE'] : $this->lang('BIRTHDAY_INTERFACE'); ?></td>
	</tr>
	<?php

} // END birthday_optional

if(isset($birthday_optional_item)) { unset($birthday_optional_item); } 

?>
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_SIGNATURE']) ? $this->vars['L_SIGNATURE'] : $this->lang('L_SIGNATURE'); ?></span>
        <span class="tooltip evo-sprite help float-right" title="<?php echo isset($this->vars['L_SIGNATURE_EXPLAIN']) ? $this->vars['L_SIGNATURE_EXPLAIN'] : $this->lang('L_SIGNATURE_EXPLAIN'); ?>"></span>
      </td>
      <td class="row2"><textarea class="post" name="signature" rows="6" cols="45"><?php echo isset($this->vars['SIGNATURE']) ? $this->vars['SIGNATURE'] : $this->lang('SIGNATURE'); ?></textarea></td>
    </tr>
<?php

} // END switch_is_signature

if(isset($switch_is_signature_item)) { unset($switch_is_signature_item); } 

?>
    <?php

$switch_type_text_count = ( isset($xdata_item['switch_type_text.']) ) ? sizeof($xdata_item['switch_type_text.']) : 0;
for ($switch_type_text_i = 0; $switch_type_text_i < $switch_type_text_count; $switch_type_text_i++)
{
 $switch_type_text_item = &$xdata_item['switch_type_text.'][$switch_type_text_i];
 $switch_type_text_item['S_ROW_COUNT'] = $switch_type_text_i;
 $switch_type_text_item['S_NUM_ROWS'] = $switch_type_text_count;

?>
    <tr>
      <td class="row1"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?><br /><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></td>
      <td class="row2"><input type="text" class="post" style="width: 200px" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" size="35" maxlength="<?php echo isset($xdata_item['MAX_LENGTH']) ? $xdata_item['MAX_LENGTH'] : ''; ?>" value="<?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?>" /></td>
    </tr>
    <?php

} // END switch_type_text

if(isset($switch_type_text_item)) { unset($switch_type_text_item); } 

?>
    <?php

$switch_type_textarea_count = ( isset($xdata_item['switch_type_textarea.']) ) ? sizeof($xdata_item['switch_type_textarea.']) : 0;
for ($switch_type_textarea_i = 0; $switch_type_textarea_i < $switch_type_textarea_count; $switch_type_textarea_i++)
{
 $switch_type_textarea_item = &$xdata_item['switch_type_textarea.'][$switch_type_textarea_i];
 $switch_type_textarea_item['S_ROW_COUNT'] = $switch_type_textarea_i;
 $switch_type_textarea_item['S_NUM_ROWS'] = $switch_type_textarea_count;

?>
    <tr>
      <td class="row1"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?><br /><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></td>
      <td class="row2"><textarea name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" style="width: 300px"  rows="6" cols="30" class="post"><?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?></textarea></td>
    </tr>
    <?php

} // END switch_type_textarea

if(isset($switch_type_textarea_item)) { unset($switch_type_textarea_item); } 

?>
    <?php

$switch_type_checkbox_count = ( isset($xdata_item['switch_type_checkbox.']) ) ? sizeof($xdata_item['switch_type_checkbox.']) : 0;
for ($switch_type_checkbox_i = 0; $switch_type_checkbox_i < $switch_type_checkbox_count; $switch_type_checkbox_i++)
{
 $switch_type_checkbox_item = &$xdata_item['switch_type_checkbox.'][$switch_type_checkbox_i];
 $switch_type_checkbox_item['S_ROW_COUNT'] = $switch_type_checkbox_i;
 $switch_type_checkbox_item['S_NUM_ROWS'] = $switch_type_checkbox_count;

?>
      <td class="row1"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?><br /><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></td>
      <td class="row2"><input type="checkbox" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" <?php echo isset($switch_type_checkbox_item['CHECKED']) ? $switch_type_checkbox_item['CHECKED'] : ''; ?> /></td>
    <?php

} // END switch_type_checkbox

if(isset($switch_type_checkbox_item)) { unset($switch_type_checkbox_item); } 

?>
    <?php

$switch_type_select_count = ( isset($xdata_item['switch_type_select.']) ) ? sizeof($xdata_item['switch_type_select.']) : 0;
for ($switch_type_select_i = 0; $switch_type_select_i < $switch_type_select_count; $switch_type_select_i++)
{
 $switch_type_select_item = &$xdata_item['switch_type_select.'][$switch_type_select_i];
 $switch_type_select_item['S_ROW_COUNT'] = $switch_type_select_i;
 $switch_type_select_item['S_NUM_ROWS'] = $switch_type_select_count;

?>
    <tr>
      <td class="row1"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?><br /><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></td>
      <td class="row2">
         <select name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>">
           <?php

$options_count = ( isset($switch_type_select_item['options.']) ) ? sizeof($switch_type_select_item['options.']) : 0;
for ($options_i = 0; $options_i < $options_count; $options_i++)
{
 $options_item = &$switch_type_select_item['options.'][$options_i];
 $options_item['S_ROW_COUNT'] = $options_i;
 $options_item['S_NUM_ROWS'] = $options_count;

?>
           <option value="<?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?>" <?php echo isset($options_item['SELECTED']) ? $options_item['SELECTED'] : ''; ?>><?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?></option>
           <?php

} // END options

if(isset($options_item)) { unset($options_item); } 

?>
         </select>
      </td>
    </tr>
    <?php

} // END switch_type_select

if(isset($switch_type_select_item)) { unset($switch_type_select_item); } 

?>
    <?php

$switch_type_radio_count = ( isset($xdata_item['switch_type_radio.']) ) ? sizeof($xdata_item['switch_type_radio.']) : 0;
for ($switch_type_radio_i = 0; $switch_type_radio_i < $switch_type_radio_count; $switch_type_radio_i++)
{
 $switch_type_radio_item = &$xdata_item['switch_type_radio.'][$switch_type_radio_i];
 $switch_type_radio_item['S_ROW_COUNT'] = $switch_type_radio_i;
 $switch_type_radio_item['S_NUM_ROWS'] = $switch_type_radio_count;

?>
    <tr>
      <td class="row1"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?><br /><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></td>
      <td class="row2">
         <?php

$options_count = ( isset($switch_type_radio_item['options.']) ) ? sizeof($switch_type_radio_item['options.']) : 0;
for ($options_i = 0; $options_i < $options_count; $options_i++)
{
 $options_item = &$switch_type_radio_item['options.'][$options_i];
 $options_item['S_ROW_COUNT'] = $options_i;
 $options_item['S_NUM_ROWS'] = $options_count;

?>
         <input type="radio" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" value="<?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?>" <?php echo isset($options_item['CHECKED']) ? $options_item['CHECKED'] : ''; ?> /> <?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?><br />
         <?php

} // END options

if(isset($options_item)) { unset($options_item); } 

?>
      </td>
    </tr>
    <?php

} // END switch_type_radio

if(isset($switch_type_radio_item)) { unset($switch_type_radio_item); } 

?>
<?php

} // END xdata

if(isset($xdata_item)) { unset($xdata_item); } 

?>
    <tr>
       <td class="row1"><?php echo isset($this->vars['L_GLANCE_SHOW']) ? $this->vars['L_GLANCE_SHOW'] : $this->lang('L_GLANCE_SHOW'); ?></td>
       <td class="row2"><?php echo isset($this->vars['GLANCE_SHOW']) ? $this->vars['GLANCE_SHOW'] : $this->lang('GLANCE_SHOW'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_HIDE_IMAGES']) ? $this->vars['L_HIDE_IMAGES'] : $this->lang('L_HIDE_IMAGES'); ?></td>
      <td class="row2">
        <input type="radio" name="hide_images" value="1" <?php echo isset($this->vars['HIDE_IMAGES_YES']) ? $this->vars['HIDE_IMAGES_YES'] : $this->lang('HIDE_IMAGES_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="hide_images" value="0" <?php echo isset($this->vars['HIDE_IMAGES_NO']) ? $this->vars['HIDE_IMAGES_NO'] : $this->lang('HIDE_IMAGES_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="catsides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2"><?php echo isset($this->vars['L_PREFERENCES']) ? $this->vars['L_PREFERENCES'] : $this->lang('L_PREFERENCES'); ?></th>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_PUBLIC_VIEW_EMAIL']) ? $this->vars['L_PUBLIC_VIEW_EMAIL'] : $this->lang('L_PUBLIC_VIEW_EMAIL'); ?></td>
      <td class="row2">
        <input type="radio" name="viewemail" value="1" <?php echo isset($this->vars['VIEW_EMAIL_YES']) ? $this->vars['VIEW_EMAIL_YES'] : $this->lang('VIEW_EMAIL_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="viewemail" value="0" <?php echo isset($this->vars['VIEW_EMAIL_NO']) ? $this->vars['VIEW_EMAIL_NO'] : $this->lang('VIEW_EMAIL_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_HIDE_USER']) ? $this->vars['L_HIDE_USER'] : $this->lang('L_HIDE_USER'); ?></td>
      <td class="row2">
        <input type="radio" name="hideonline" value="1" <?php echo isset($this->vars['HIDE_USER_YES']) ? $this->vars['HIDE_USER_YES'] : $this->lang('HIDE_USER_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="hideonline" value="0" <?php echo isset($this->vars['HIDE_USER_NO']) ? $this->vars['HIDE_USER_NO'] : $this->lang('HIDE_USER_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
	<tr>
	  <td class="row1"><?php echo isset($this->vars['L_BIRTHDAY_DISPLAY']) ? $this->vars['L_BIRTHDAY_DISPLAY'] : $this->lang('L_BIRTHDAY_DISPLAY'); ?>
	  <td class="row2">
	    <select name="birthday_display">
	      <option value="<?php echo isset($this->vars['BIRTHDAY_ALL']) ? $this->vars['BIRTHDAY_ALL'] : $this->lang('BIRTHDAY_ALL'); ?>"<?php echo isset($this->vars['BIRTHDAY_ALL_SELECTED']) ? $this->vars['BIRTHDAY_ALL_SELECTED'] : $this->lang('BIRTHDAY_ALL_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_ALL']) ? $this->vars['L_BIRTHDAY_ALL'] : $this->lang('L_BIRTHDAY_ALL'); ?></option>
	      <option value="<?php echo isset($this->vars['BIRTHDAY_DATE']) ? $this->vars['BIRTHDAY_DATE'] : $this->lang('BIRTHDAY_DATE'); ?>"<?php echo isset($this->vars['BIRTHDAY_DATE_SELECTED']) ? $this->vars['BIRTHDAY_DATE_SELECTED'] : $this->lang('BIRTHDAY_DATE_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_YEAR']) ? $this->vars['L_BIRTHDAY_YEAR'] : $this->lang('L_BIRTHDAY_YEAR'); ?></option>
	      <option value="<?php echo isset($this->vars['BIRTHDAY_AGE']) ? $this->vars['BIRTHDAY_AGE'] : $this->lang('BIRTHDAY_AGE'); ?>"<?php echo isset($this->vars['BIRTHDAY_AGE_SELECTED']) ? $this->vars['BIRTHDAY_AGE_SELECTED'] : $this->lang('BIRTHDAY_AGE_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_AGE']) ? $this->vars['L_BIRTHDAY_AGE'] : $this->lang('L_BIRTHDAY_AGE'); ?></option>
	      <option value="<?php echo isset($this->vars['BIRTHDAY_NONE']) ? $this->vars['BIRTHDAY_NONE'] : $this->lang('BIRTHDAY_NONE'); ?>"<?php echo isset($this->vars['BIRTHDAY_NONE_SELECTED']) ? $this->vars['BIRTHDAY_NONE_SELECTED'] : $this->lang('BIRTHDAY_NONE_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_NONE']) ? $this->vars['L_BIRTHDAY_NONE'] : $this->lang('L_BIRTHDAY_NONE'); ?></option>
	    </select>
	  </td>
	</tr>
	<?php

$birthdays_greeting_count = ( isset($this->_tpldata['birthdays_greeting.']) ) ?  sizeof($this->_tpldata['birthdays_greeting.']) : 0;
for ($birthdays_greeting_i = 0; $birthdays_greeting_i < $birthdays_greeting_count; $birthdays_greeting_i++)
{
 $birthdays_greeting_item = &$this->_tpldata['birthdays_greeting.'][$birthdays_greeting_i];
 $birthdays_greeting_item['S_ROW_COUNT'] = $birthdays_greeting_i;
 $birthdays_greeting_item['S_NUM_ROWS'] = $birthdays_greeting_count;

?>
	<tr>
	  <td class="row1"><?php echo isset($this->vars['L_BDAY_SEND_GREETING']) ? $this->vars['L_BDAY_SEND_GREETING'] : $this->lang('L_BDAY_SEND_GREETING'); ?>:<br /><?php echo isset($this->vars['L_BDAY_SEND_GREETING_EXPLAIN']) ? $this->vars['L_BDAY_SEND_GREETING_EXPLAIN'] : $this->lang('L_BDAY_SEND_GREETING_EXPLAIN'); ?></td>
	  <td class="row2">
		  <input type="radio" name="bday_greeting" value="0" <?php echo isset($this->vars['BDAY_NONE_ENABLED']) ? $this->vars['BDAY_NONE_ENABLED'] : $this->lang('BDAY_NONE_ENABLED'); ?> /> <?php echo isset($this->vars['L_NONE']) ? $this->vars['L_NONE'] : $this->lang('L_NONE'); ?>&nbsp;&nbsp;
		  <?php

$birthdays_email_count = ( isset($birthdays_greeting_item['birthdays_email.']) ) ? sizeof($birthdays_greeting_item['birthdays_email.']) : 0;
for ($birthdays_email_i = 0; $birthdays_email_i < $birthdays_email_count; $birthdays_email_i++)
{
 $birthdays_email_item = &$birthdays_greeting_item['birthdays_email.'][$birthdays_email_i];
 $birthdays_email_item['S_ROW_COUNT'] = $birthdays_email_i;
 $birthdays_email_item['S_NUM_ROWS'] = $birthdays_email_count;

?>
		  <input type="radio" name="bday_greeting" value="<?php echo isset($this->vars['BDAY_EMAIL']) ? $this->vars['BDAY_EMAIL'] : $this->lang('BDAY_EMAIL'); ?>" <?php echo isset($this->vars['BDAY_EMAIL_ENABLED']) ? $this->vars['BDAY_EMAIL_ENABLED'] : $this->lang('BDAY_EMAIL_ENABLED'); ?> /> <?php echo isset($this->vars['L_EMAIL']) ? $this->vars['L_EMAIL'] : $this->lang('L_EMAIL'); ?>&nbsp;&nbsp;
		  <?php

} // END birthdays_email

if(isset($birthdays_email_item)) { unset($birthdays_email_item); } 

?>
		  <?php

$birthdays_pm_count = ( isset($birthdays_greeting_item['birthdays_pm.']) ) ? sizeof($birthdays_greeting_item['birthdays_pm.']) : 0;
for ($birthdays_pm_i = 0; $birthdays_pm_i < $birthdays_pm_count; $birthdays_pm_i++)
{
 $birthdays_pm_item = &$birthdays_greeting_item['birthdays_pm.'][$birthdays_pm_i];
 $birthdays_pm_item['S_ROW_COUNT'] = $birthdays_pm_i;
 $birthdays_pm_item['S_NUM_ROWS'] = $birthdays_pm_count;

?>
		  <input type="radio" name="bday_greeting" value="<?php echo isset($this->vars['BDAY_PM']) ? $this->vars['BDAY_PM'] : $this->lang('BDAY_PM'); ?>" <?php echo isset($this->vars['BDAY_PM_ENABLED']) ? $this->vars['BDAY_PM_ENABLED'] : $this->lang('BDAY_PM_ENABLED'); ?> /> <?php echo isset($this->vars['L_PM']) ? $this->vars['L_PM'] : $this->lang('L_PM'); ?>&nbsp;&nbsp;
		  <?php

} // END birthdays_pm

if(isset($birthdays_pm_item)) { unset($birthdays_pm_item); } 

?>
		  <?php

$birthdays_popup_count = ( isset($birthdays_greeting_item['birthdays_popup.']) ) ? sizeof($birthdays_greeting_item['birthdays_popup.']) : 0;
for ($birthdays_popup_i = 0; $birthdays_popup_i < $birthdays_popup_count; $birthdays_popup_i++)
{
 $birthdays_popup_item = &$birthdays_greeting_item['birthdays_popup.'][$birthdays_popup_i];
 $birthdays_popup_item['S_ROW_COUNT'] = $birthdays_popup_i;
 $birthdays_popup_item['S_NUM_ROWS'] = $birthdays_popup_count;

?>
		  <input type="radio" name="bday_greeting" value="<?php echo isset($this->vars['BDAY_POPUP']) ? $this->vars['BDAY_POPUP'] : $this->lang('BDAY_POPUP'); ?>" <?php echo isset($this->vars['BDAY_POPUP_ENABLED']) ? $this->vars['BDAY_POPUP_ENABLED'] : $this->lang('BDAY_POPUP_ENABLED'); ?> /> <?php echo isset($this->vars['L_POPUP']) ? $this->vars['L_POPUP'] : $this->lang('L_POPUP'); ?>&nbsp;&nbsp;
		  <?php

} // END birthdays_popup

if(isset($birthdays_popup_item)) { unset($birthdays_popup_item); } 

?>
	  </td>
	</tr>
	<?php

} // END birthdays_greeting

if(isset($birthdays_greeting_item)) { unset($birthdays_greeting_item); } 

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_NOTIFY_ON_REPLY']) ? $this->vars['L_NOTIFY_ON_REPLY'] : $this->lang('L_NOTIFY_ON_REPLY'); ?></td>
      <td class="row2">
        <input type="radio" name="notifyreply" value="1" <?php echo isset($this->vars['NOTIFY_REPLY_YES']) ? $this->vars['NOTIFY_REPLY_YES'] : $this->lang('NOTIFY_REPLY_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="notifyreply" value="0" <?php echo isset($this->vars['NOTIFY_REPLY_NO']) ? $this->vars['NOTIFY_REPLY_NO'] : $this->lang('NOTIFY_REPLY_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_NOTIFY_ON_PRIVMSG']) ? $this->vars['L_NOTIFY_ON_PRIVMSG'] : $this->lang('L_NOTIFY_ON_PRIVMSG'); ?></td>
      <td class="row2">
        <input type="radio" name="notifypm" value="1" <?php echo isset($this->vars['NOTIFY_PM_YES']) ? $this->vars['NOTIFY_PM_YES'] : $this->lang('NOTIFY_PM_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="notifypm" value="0" <?php echo isset($this->vars['NOTIFY_PM_NO']) ? $this->vars['NOTIFY_PM_NO'] : $this->lang('NOTIFY_PM_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_POPUP_ON_PRIVMSG']) ? $this->vars['L_POPUP_ON_PRIVMSG'] : $this->lang('L_POPUP_ON_PRIVMSG'); ?></td>
      <td class="row2">
        <input type="radio" name="popup_pm" value="1" <?php echo isset($this->vars['POPUP_PM_YES']) ? $this->vars['POPUP_PM_YES'] : $this->lang('POPUP_PM_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="popup_pm" value="0" <?php echo isset($this->vars['POPUP_PM_NO']) ? $this->vars['POPUP_PM_NO'] : $this->lang('POPUP_PM_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_ALWAYS_ADD_SIGNATURE']) ? $this->vars['L_ALWAYS_ADD_SIGNATURE'] : $this->lang('L_ALWAYS_ADD_SIGNATURE'); ?></td>
      <td class="row2">
        <input type="radio" name="attachsig" value="1" <?php echo isset($this->vars['ALWAYS_ADD_SIGNATURE_YES']) ? $this->vars['ALWAYS_ADD_SIGNATURE_YES'] : $this->lang('ALWAYS_ADD_SIGNATURE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="attachsig" value="0" <?php echo isset($this->vars['ALWAYS_ADD_SIGNATURE_NO']) ? $this->vars['ALWAYS_ADD_SIGNATURE_NO'] : $this->lang('ALWAYS_ADD_SIGNATURE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_ALWAYS_ALLOW_BBCODE']) ? $this->vars['L_ALWAYS_ALLOW_BBCODE'] : $this->lang('L_ALWAYS_ALLOW_BBCODE'); ?></td>
      <td class="row2">
        <input type="radio" name="allowbbcode" value="1" <?php echo isset($this->vars['ALWAYS_ALLOW_BBCODE_YES']) ? $this->vars['ALWAYS_ALLOW_BBCODE_YES'] : $this->lang('ALWAYS_ALLOW_BBCODE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="allowbbcode" value="0" <?php echo isset($this->vars['ALWAYS_ALLOW_BBCODE_NO']) ? $this->vars['ALWAYS_ALLOW_BBCODE_NO'] : $this->lang('ALWAYS_ALLOW_BBCODE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_ALWAYS_ALLOW_HTML']) ? $this->vars['L_ALWAYS_ALLOW_HTML'] : $this->lang('L_ALWAYS_ALLOW_HTML'); ?></td>
      <td class="row2">
        <input type="radio" name="allowhtml" value="1" <?php echo isset($this->vars['ALWAYS_ALLOW_HTML_YES']) ? $this->vars['ALWAYS_ALLOW_HTML_YES'] : $this->lang('ALWAYS_ALLOW_HTML_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="allowhtml" value="0" <?php echo isset($this->vars['ALWAYS_ALLOW_HTML_NO']) ? $this->vars['ALWAYS_ALLOW_HTML_NO'] : $this->lang('ALWAYS_ALLOW_HTML_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_ALWAYS_ALLOW_SMILIES']) ? $this->vars['L_ALWAYS_ALLOW_SMILIES'] : $this->lang('L_ALWAYS_ALLOW_SMILIES'); ?></td>
      <td class="row2">
        <input type="radio" name="allowsmilies" value="1" <?php echo isset($this->vars['ALWAYS_ALLOW_SMILIES_YES']) ? $this->vars['ALWAYS_ALLOW_SMILIES_YES'] : $this->lang('ALWAYS_ALLOW_SMILIES_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="allowsmilies" value="0" <?php echo isset($this->vars['ALWAYS_ALLOW_SMILIES_NO']) ? $this->vars['ALWAYS_ALLOW_SMILIES_NO'] : $this->lang('ALWAYS_ALLOW_SMILIES_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_SHOW_AVATARS']) ? $this->vars['L_SHOW_AVATARS'] : $this->lang('L_SHOW_AVATARS'); ?></td>
      <td class="row2">
        <input type="radio" name="showavatars" value="1" <?php echo isset($this->vars['SHOW_AVATARS_YES']) ? $this->vars['SHOW_AVATARS_YES'] : $this->lang('SHOW_AVATARS_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="showavatars" value="0" <?php echo isset($this->vars['SHOW_AVATARS_NO']) ? $this->vars['SHOW_AVATARS_NO'] : $this->lang('SHOW_AVATARS_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><span class="gen"><?php echo isset($this->vars['L_SHOW_SIGNATURES']) ? $this->vars['L_SHOW_SIGNATURES'] : $this->lang('L_SHOW_SIGNATURES'); ?></span></td>
      <td class="row2">
        <input type="radio" name="showsignatures" value="1" <?php echo isset($this->vars['SHOW_SIGNATURES_YES']) ? $this->vars['SHOW_SIGNATURES_YES'] : $this->lang('SHOW_SIGNATURES_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="showsignatures" value="0" <?php echo isset($this->vars['SHOW_SIGNATURES_NO']) ? $this->vars['SHOW_SIGNATURES_NO'] : $this->lang('SHOW_SIGNATURES_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_WORD_WRAP']) ? $this->vars['L_WORD_WRAP'] : $this->lang('L_WORD_WRAP'); ?><br /><?php echo isset($this->vars['L_WORD_WRAP_EXPLAIN']) ? $this->vars['L_WORD_WRAP_EXPLAIN'] : $this->lang('L_WORD_WRAP_EXPLAIN'); ?></td>
      <td class="row2"><input type="text" name="user_wordwrap" value="<?php echo isset($this->vars['WRAP_ROW']) ? $this->vars['WRAP_ROW'] : $this->lang('WRAP_ROW'); ?>" size="2" maxlength="2" class="post" /> <?php echo isset($this->vars['L_WORD_WRAP_EXTRA']) ? $this->vars['L_WORD_WRAP_EXTRA'] : $this->lang('L_WORD_WRAP_EXTRA'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_BOARD_LANGUAGE']) ? $this->vars['L_BOARD_LANGUAGE'] : $this->lang('L_BOARD_LANGUAGE'); ?></td>
      <td class="row2"><?php echo isset($this->vars['LANGUAGE_SELECT']) ? $this->vars['LANGUAGE_SELECT'] : $this->lang('LANGUAGE_SELECT'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_BOARD_STYLE']) ? $this->vars['L_BOARD_STYLE'] : $this->lang('L_BOARD_STYLE'); ?></td>
      <td class="row2"><?php echo isset($this->vars['STYLE_SELECT']) ? $this->vars['STYLE_SELECT'] : $this->lang('STYLE_SELECT'); ?></td>
    </tr>
    <!-- Start replacement - Advanced time management MOD -->
    <tr>
        <td class="row1">
          <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_TIME_MODE']) ? $this->vars['L_TIME_MODE'] : $this->lang('L_TIME_MODE'); ?></span>
          <span class="tooltip-html evo-sprite help float-right" title="<?php echo isset($this->vars['L_TIME_MODE_TEXT']) ? $this->vars['L_TIME_MODE_TEXT'] : $this->lang('L_TIME_MODE_TEXT'); ?>"></span>
        </td>
        <td class="row2" nowrap="nowrap">
            <?php echo isset($this->vars['L_TIME_MODE_AUTO']) ? $this->vars['L_TIME_MODE_AUTO'] : $this->lang('L_TIME_MODE_AUTO'); ?><br /><input type="radio" name="time_mode" value="6" <?php echo isset($this->vars['TIME_MODE_FULL_PC_CHECKED']) ? $this->vars['TIME_MODE_FULL_PC_CHECKED'] : $this->lang('TIME_MODE_FULL_PC_CHECKED'); ?>/>
            <?php echo isset($this->vars['L_TIME_MODE_FULL_PC']) ? $this->vars['L_TIME_MODE_FULL_PC'] : $this->lang('L_TIME_MODE_FULL_PC'); ?><br /><input type="radio" name="time_mode" value="4" <?php echo isset($this->vars['TIME_MODE_SERVER_PC_CHECKED']) ? $this->vars['TIME_MODE_SERVER_PC_CHECKED'] : $this->lang('TIME_MODE_SERVER_PC_CHECKED'); ?>/>
            <?php echo isset($this->vars['L_TIME_MODE_SERVER_PC']) ? $this->vars['L_TIME_MODE_SERVER_PC'] : $this->lang('L_TIME_MODE_SERVER_PC'); ?><br /><input type="radio" name="time_mode" value="3" <?php echo isset($this->vars['TIME_MODE_FULL_SERVER_CHECKED']) ? $this->vars['TIME_MODE_FULL_SERVER_CHECKED'] : $this->lang('TIME_MODE_FULL_SERVER_CHECKED'); ?>/>
            <?php echo isset($this->vars['L_TIME_MODE_FULL_SERVER']) ? $this->vars['L_TIME_MODE_FULL_SERVER'] : $this->lang('L_TIME_MODE_FULL_SERVER'); ?><br /><br />
            <?php echo isset($this->vars['L_TIME_MODE_MANUAL']) ? $this->vars['L_TIME_MODE_MANUAL'] : $this->lang('L_TIME_MODE_MANUAL'); ?><br />
            <?php echo isset($this->vars['L_TIME_MODE_DST']) ? $this->vars['L_TIME_MODE_DST'] : $this->lang('L_TIME_MODE_DST'); ?>
            <input type="radio" name="time_mode" value="1" <?php echo isset($this->vars['TIME_MODE_MANUAL_DST_CHECKED']) ? $this->vars['TIME_MODE_MANUAL_DST_CHECKED'] : $this->lang('TIME_MODE_MANUAL_DST_CHECKED'); ?>/><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?><?php echo isset($this->vars['L_TIME_MODE_DST_ON']) ? $this->vars['L_TIME_MODE_DST_ON'] : $this->lang('L_TIME_MODE_DST_ON'); ?>&nbsp;
            <input type="radio" name="time_mode" value="0" <?php echo isset($this->vars['TIME_MODE_MANUAL_CHECKED']) ? $this->vars['TIME_MODE_MANUAL_CHECKED'] : $this->lang('TIME_MODE_MANUAL_CHECKED'); ?>/><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?><?php echo isset($this->vars['L_TIME_MODE_DST_OFF']) ? $this->vars['L_TIME_MODE_DST_OFF'] : $this->lang('L_TIME_MODE_DST_OFF'); ?>&nbsp;
            <input type="radio" name="time_mode" value="2" <?php echo isset($this->vars['TIME_MODE_SERVER_SWITCH_CHECKED']) ? $this->vars['TIME_MODE_SERVER_SWITCH_CHECKED'] : $this->lang('TIME_MODE_SERVER_SWITCH_CHECKED'); ?>/><?php echo isset($this->vars['L_TIME_MODE_DST_SERVER']) ? $this->vars['L_TIME_MODE_DST_SERVER'] : $this->lang('L_TIME_MODE_DST_SERVER'); ?><br />
            <?php echo isset($this->vars['L_TIME_MODE_DST_TIME_LAG']) ? $this->vars['L_TIME_MODE_DST_TIME_LAG'] : $this->lang('L_TIME_MODE_DST_TIME_LAG'); ?> 
            <input type="text" name="dst_time_lag" value="<?php echo isset($this->vars['DST_TIME_LAG']) ? $this->vars['DST_TIME_LAG'] : $this->lang('DST_TIME_LAG'); ?>" maxlength="3" size="3" class="post" /><?php echo isset($this->vars['L_TIME_MODE_DST_MN']) ? $this->vars['L_TIME_MODE_DST_MN'] : $this->lang('L_TIME_MODE_DST_MN'); ?><br />
            <?php echo isset($this->vars['L_TIME_MODE_TIMEZONE']) ? $this->vars['L_TIME_MODE_TIMEZONE'] : $this->lang('L_TIME_MODE_TIMEZONE'); ?> <?php echo isset($this->vars['TIMEZONE_SELECT']) ? $this->vars['TIMEZONE_SELECT'] : $this->lang('TIMEZONE_SELECT'); ?></td>
    </tr>
        <!-- End replacement - Advanced time management MOD -->
    <tr>
      <td class="row1">
         <span style="display: inline-block; float: left; margin-top: 2px;"><?php echo isset($this->vars['L_DATE_FORMAT']) ? $this->vars['L_DATE_FORMAT'] : $this->lang('L_DATE_FORMAT'); ?></span>
         <span class="tooltip-interact evo-sprite help float-right" title="<?php echo isset($this->vars['L_DATE_FORMAT_EXPLAIN']) ? $this->vars['L_DATE_FORMAT_EXPLAIN'] : $this->lang('L_DATE_FORMAT_EXPLAIN'); ?>"></span>
      </td>
      <td class="row2"><input class="post" type="text" name="dateformat" value="<?php echo isset($this->vars['DATE_FORMAT']) ? $this->vars['DATE_FORMAT'] : $this->lang('DATE_FORMAT'); ?>" maxlength="16" /></td>
    </tr>
    <tr>
      <td class="catSides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="12" valign="middle"><?php echo isset($this->vars['L_QUICK_REPLY_PANEL']) ? $this->vars['L_QUICK_REPLY_PANEL'] : $this->lang('L_QUICK_REPLY_PANEL'); ?></th>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_SHOW_QUICK_REPLY']) ? $this->vars['L_SHOW_QUICK_REPLY'] : $this->lang('L_SHOW_QUICK_REPLY'); ?></td>
      <td class="row2"><?php echo isset($this->vars['QUICK_REPLY_SELECT']) ? $this->vars['QUICK_REPLY_SELECT'] : $this->lang('QUICK_REPLY_SELECT'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_QUICK_REPLY_MODE']) ? $this->vars['L_QUICK_REPLY_MODE'] : $this->lang('L_QUICK_REPLY_MODE'); ?></td>
      <td class="row2">
        <input type="radio" name="quickreply_mode" value="0" <?php echo isset($this->vars['QUICK_REPLY_MODE_BASIC']) ? $this->vars['QUICK_REPLY_MODE_BASIC'] : $this->lang('QUICK_REPLY_MODE_BASIC'); ?> /> <?php echo isset($this->vars['L_QUICK_REPLY_MODE_BASIC']) ? $this->vars['L_QUICK_REPLY_MODE_BASIC'] : $this->lang('L_QUICK_REPLY_MODE_BASIC'); ?>
        <input type="radio" name="quickreply_mode" value="1" <?php echo isset($this->vars['QUICK_REPLY_MODE_ADVANCED']) ? $this->vars['QUICK_REPLY_MODE_ADVANCED'] : $this->lang('QUICK_REPLY_MODE_ADVANCED'); ?> /> <?php echo isset($this->vars['L_QUICK_REPLY_MODE_ADVANCED']) ? $this->vars['L_QUICK_REPLY_MODE_ADVANCED'] : $this->lang('L_QUICK_REPLY_MODE_ADVANCED'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_OPEN_QUICK_REPLY']) ? $this->vars['L_OPEN_QUICK_REPLY'] : $this->lang('L_OPEN_QUICK_REPLY'); ?></td>
      <td class="row2">
        <input type="radio" name="open_quickreply" value="1" <?php echo isset($this->vars['OPEN_QUICK_REPLY_YES']) ? $this->vars['OPEN_QUICK_REPLY_YES'] : $this->lang('OPEN_QUICK_REPLY_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>&nbsp;&nbsp;
        <input type="radio" name="open_quickreply" value="0" <?php echo isset($this->vars['OPEN_QUICK_REPLY_NO']) ? $this->vars['OPEN_QUICK_REPLY_NO'] : $this->lang('OPEN_QUICK_REPLY_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="catSides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="12" valign="middle"><?php echo isset($this->vars['L_AVATAR_PANEL']) ? $this->vars['L_AVATAR_PANEL'] : $this->lang('L_AVATAR_PANEL'); ?></th>
    </tr>
    <tr align="center">
      <td class="row1" colspan="2">
        <table width="70%" cellspacing="2" cellpadding="0" border="0">
          <tr>
            <td width="65%"><?php echo isset($this->vars['L_AVATAR_EXPLAIN']) ? $this->vars['L_AVATAR_EXPLAIN'] : $this->lang('L_AVATAR_EXPLAIN'); ?></td>
            <td align="center"><?php echo isset($this->vars['L_CURRENT_IMAGE']) ? $this->vars['L_CURRENT_IMAGE'] : $this->lang('L_CURRENT_IMAGE'); ?><br /><?php echo isset($this->vars['AVATAR']) ? $this->vars['AVATAR'] : $this->lang('AVATAR'); ?><br /><input type="checkbox" name="avatardel" />&nbsp;<?php echo isset($this->vars['L_DELETE_AVATAR']) ? $this->vars['L_DELETE_AVATAR'] : $this->lang('L_DELETE_AVATAR'); ?></td>
          </tr>
        </table>
      </td>
    </tr>

    <?php

$avatar_local_upload_count = ( isset($this->_tpldata['avatar_local_upload.']) ) ?  sizeof($this->_tpldata['avatar_local_upload.']) : 0;
for ($avatar_local_upload_i = 0; $avatar_local_upload_i < $avatar_local_upload_count; $avatar_local_upload_i++)
{
 $avatar_local_upload_item = &$this->_tpldata['avatar_local_upload.'][$avatar_local_upload_i];
 $avatar_local_upload_item['S_ROW_COUNT'] = $avatar_local_upload_i;
 $avatar_local_upload_item['S_NUM_ROWS'] = $avatar_local_upload_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_UPLOAD_AVATAR_FILE']) ? $this->vars['L_UPLOAD_AVATAR_FILE'] : $this->lang('L_UPLOAD_AVATAR_FILE'); ?></td>
      <td class="row2"><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo isset($this->vars['AVATAR_SIZE']) ? $this->vars['AVATAR_SIZE'] : $this->lang('AVATAR_SIZE'); ?>" /><input type="file" name="avatar" class="post" style="width: 200px" /></td>
    </tr>
    <?php

} // END avatar_local_upload

if(isset($avatar_local_upload_item)) { unset($avatar_local_upload_item); } 

?>
    <?php

$avatar_remote_upload_count = ( isset($this->_tpldata['avatar_remote_upload.']) ) ?  sizeof($this->_tpldata['avatar_remote_upload.']) : 0;
for ($avatar_remote_upload_i = 0; $avatar_remote_upload_i < $avatar_remote_upload_count; $avatar_remote_upload_i++)
{
 $avatar_remote_upload_item = &$this->_tpldata['avatar_remote_upload.'][$avatar_remote_upload_i];
 $avatar_remote_upload_item['S_ROW_COUNT'] = $avatar_remote_upload_i;
 $avatar_remote_upload_item['S_NUM_ROWS'] = $avatar_remote_upload_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_UPLOAD_AVATAR_URL']) ? $this->vars['L_UPLOAD_AVATAR_URL'] : $this->lang('L_UPLOAD_AVATAR_URL'); ?></td>
      <td class="row2"><input class="post" type="text" name="avatarurl" size="40" style="width: 200px" /></td>
    </tr>
    <?php

} // END avatar_remote_upload

if(isset($avatar_remote_upload_item)) { unset($avatar_remote_upload_item); } 

?>
    <?php

$avatar_remote_link_count = ( isset($this->_tpldata['avatar_remote_link.']) ) ?  sizeof($this->_tpldata['avatar_remote_link.']) : 0;
for ($avatar_remote_link_i = 0; $avatar_remote_link_i < $avatar_remote_link_count; $avatar_remote_link_i++)
{
 $avatar_remote_link_item = &$this->_tpldata['avatar_remote_link.'][$avatar_remote_link_i];
 $avatar_remote_link_item['S_ROW_COUNT'] = $avatar_remote_link_i;
 $avatar_remote_link_item['S_NUM_ROWS'] = $avatar_remote_link_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_LINK_REMOTE_AVATAR']) ? $this->vars['L_LINK_REMOTE_AVATAR'] : $this->lang('L_LINK_REMOTE_AVATAR'); ?></td>
      <td class="row2"><input class="post" type="text" name="avatarremoteurl" size="40" style="width: 200px" /></td>
    </tr>
    <?php

} // END avatar_remote_link

if(isset($avatar_remote_link_item)) { unset($avatar_remote_link_item); } 

?>
    <?php

$avatar_local_gallery_count = ( isset($this->_tpldata['avatar_local_gallery.']) ) ?  sizeof($this->_tpldata['avatar_local_gallery.']) : 0;
for ($avatar_local_gallery_i = 0; $avatar_local_gallery_i < $avatar_local_gallery_count; $avatar_local_gallery_i++)
{
 $avatar_local_gallery_item = &$this->_tpldata['avatar_local_gallery.'][$avatar_local_gallery_i];
 $avatar_local_gallery_item['S_ROW_COUNT'] = $avatar_local_gallery_i;
 $avatar_local_gallery_item['S_NUM_ROWS'] = $avatar_local_gallery_count;

?>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_AVATAR_GALLERY']) ? $this->vars['L_AVATAR_GALLERY'] : $this->lang('L_AVATAR_GALLERY'); ?></td>
      <td class="row2"><input type="submit" name="avatargallery" value="<?php echo isset($this->vars['L_SHOW_GALLERY']) ? $this->vars['L_SHOW_GALLERY'] : $this->lang('L_SHOW_GALLERY'); ?>" class="liteoption" /></td>
    </tr>
    <?php

} // END avatar_local_gallery

if(isset($avatar_local_gallery_item)) { unset($avatar_local_gallery_item); } 

?>
    <tr>
      <td class="catSides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2"><?php echo isset($this->vars['L_SPECIAL']) ? $this->vars['L_SPECIAL'] : $this->lang('L_SPECIAL'); ?></th>
    </tr>
    <tr>
      <td class="row1" colspan="2"><<?php echo isset($this->vars['L_SPECIAL_EXPLAIN']) ? $this->vars['L_SPECIAL_EXPLAIN'] : $this->lang('L_SPECIAL_EXPLAIN'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_UPLOAD_QUOTA']) ? $this->vars['L_UPLOAD_QUOTA'] : $this->lang('L_UPLOAD_QUOTA'); ?></td>
      <td class="row2"><?php echo isset($this->vars['S_SELECT_UPLOAD_QUOTA']) ? $this->vars['S_SELECT_UPLOAD_QUOTA'] : $this->lang('S_SELECT_UPLOAD_QUOTA'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_PM_QUOTA']) ? $this->vars['L_PM_QUOTA'] : $this->lang('L_PM_QUOTA'); ?></td>
      <td class="row2"><?php echo isset($this->vars['S_SELECT_PM_QUOTA']) ? $this->vars['S_SELECT_PM_QUOTA'] : $this->lang('S_SELECT_PM_QUOTA'); ?></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_USER_ACTIVE']) ? $this->vars['L_USER_ACTIVE'] : $this->lang('L_USER_ACTIVE'); ?></td>
      <td class="row2">
        <input type="radio" name="user_status" value="1" <?php echo isset($this->vars['USER_ACTIVE_YES']) ? $this->vars['USER_ACTIVE_YES'] : $this->lang('USER_ACTIVE_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="user_status" value="0" <?php echo isset($this->vars['USER_ACTIVE_NO']) ? $this->vars['USER_ACTIVE_NO'] : $this->lang('USER_ACTIVE_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_ALLOW_PM']) ? $this->vars['L_ALLOW_PM'] : $this->lang('L_ALLOW_PM'); ?></td>
      <td class="row2">
        <input type="radio" name="user_allowpm" value="1" <?php echo isset($this->vars['ALLOW_PM_YES']) ? $this->vars['ALLOW_PM_YES'] : $this->lang('ALLOW_PM_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="user_allowpm" value="0" <?php echo isset($this->vars['ALLOW_PM_NO']) ? $this->vars['ALLOW_PM_NO'] : $this->lang('ALLOW_PM_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_ALLOW_AVATAR']) ? $this->vars['L_ALLOW_AVATAR'] : $this->lang('L_ALLOW_AVATAR'); ?></td>
      <td class="row2">
        <input type="radio" name="user_allowavatar" value="1" <?php echo isset($this->vars['ALLOW_AVATAR_YES']) ? $this->vars['ALLOW_AVATAR_YES'] : $this->lang('ALLOW_AVATAR_YES'); ?> /> <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?>
        <input type="radio" name="user_allowavatar" value="0" <?php echo isset($this->vars['ALLOW_AVATAR_NO']) ? $this->vars['ALLOW_AVATAR_NO'] : $this->lang('ALLOW_AVATAR_NO'); ?> /> <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
      </td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_USER_POSTS']) ? $this->vars['L_USER_POSTS'] : $this->lang('L_USER_POSTS'); ?></td>
      <td class="row2"><input type="text" name="user_posts" value="<?php echo isset($this->vars['USER_POSTS']) ? $this->vars['USER_POSTS'] : $this->lang('USER_POSTS'); ?>"></select></td>
    </tr>
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_SELECT_RANK1']) ? $this->vars['L_SELECT_RANK1'] : $this->lang('L_SELECT_RANK1'); ?></td>
      <td class="row2"><select name="user_rank"><?php echo isset($this->vars['RANK1_SELECT_BOX']) ? $this->vars['RANK1_SELECT_BOX'] : $this->lang('RANK1_SELECT_BOX'); ?></select></td>
	</tr>
	<tr>
		<td class="row1"><?php echo isset($this->vars['L_SELECT_RANK2']) ? $this->vars['L_SELECT_RANK2'] : $this->lang('L_SELECT_RANK2'); ?></td>
		<td class="row2"><select name="user_rank2"><?php echo isset($this->vars['RANK2_SELECT_BOX']) ? $this->vars['RANK2_SELECT_BOX'] : $this->lang('RANK2_SELECT_BOX'); ?></select></td>
	</tr>
	<tr>
		<td class="row1"><?php echo isset($this->vars['L_SELECT_RANK3']) ? $this->vars['L_SELECT_RANK3'] : $this->lang('L_SELECT_RANK3'); ?></td>
		<td class="row2"><select name="user_rank3"><?php echo isset($this->vars['RANK3_SELECT_BOX']) ? $this->vars['RANK3_SELECT_BOX'] : $this->lang('RANK3_SELECT_BOX'); ?></select></td>
	</tr>
	<tr>
		<td class="row1"><?php echo isset($this->vars['L_SELECT_RANK4']) ? $this->vars['L_SELECT_RANK4'] : $this->lang('L_SELECT_RANK4'); ?></td>
		<td class="row2"><select name="user_rank4"><?php echo isset($this->vars['RANK4_SELECT_BOX']) ? $this->vars['RANK4_SELECT_BOX'] : $this->lang('RANK4_SELECT_BOX'); ?></select></td>
	</tr>
	<tr>
		<td class="row1"><?php echo isset($this->vars['L_SELECT_RANK5']) ? $this->vars['L_SELECT_RANK5'] : $this->lang('L_SELECT_RANK5'); ?></td>
		<td class="row2"><select name="user_rank5"><?php echo isset($this->vars['RANK5_SELECT_BOX']) ? $this->vars['RANK5_SELECT_BOX'] : $this->lang('RANK5_SELECT_BOX'); ?></select></td>
	</tr>
   <tr>
      <td class="row1"><?php echo isset($this->vars['L_ADMIN_NOTES']) ? $this->vars['L_ADMIN_NOTES'] : $this->lang('L_ADMIN_NOTES'); ?></td>
      <td class="row2"><textarea class="post" name="user_admin_notes" rows="6" cols="45"><?php echo isset($this->vars['ADMIN_NOTES']) ? $this->vars['ADMIN_NOTES'] : $this->lang('ADMIN_NOTES'); ?></textarea></td>
   </tr>    
    <tr>
      <td class="row1"><?php echo isset($this->vars['L_DELETE_USER']) ? $this->vars['L_DELETE_USER'] : $this->lang('L_DELETE_USER'); ?>?</td>
      <td class="row2"><input type="checkbox" name="deleteuser"> <?php echo isset($this->vars['L_DELETE_USER_EXPLAIN']) ? $this->vars['L_DELETE_USER_EXPLAIN'] : $this->lang('L_DELETE_USER_EXPLAIN'); ?></td>
    </tr>
    <tr>
      <td class="catBottom" colspan="2" align="center">
        <?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
        <input type="submit" name="submit" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" class="mainoption" />
        <input type="reset" value="<?php echo isset($this->vars['L_RESET']) ? $this->vars['L_RESET'] : $this->lang('L_RESET'); ?>" class="liteoption" />
      </td>
    </tr>
 </table>
</form>