<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 17:48:56 +0000 (time=1566841736)

?><h1><?php echo isset($this->vars['L_FORUM_TITLE']) ? $this->vars['L_FORUM_TITLE'] : $this->lang('L_FORUM_TITLE'); ?></h1>

<p><?php echo isset($this->vars['L_FORUM_EXPLAIN']) ? $this->vars['L_FORUM_EXPLAIN'] : $this->lang('L_FORUM_EXPLAIN'); ?></p>

<form method="post" action="<?php echo isset($this->vars['S_FORUM_ACTION']) ? $this->vars['S_FORUM_ACTION'] : $this->lang('S_FORUM_ACTION'); ?>"><table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr>
        <th class="thHead" colspan="8"><?php echo isset($this->vars['L_FORUM_TITLE']) ? $this->vars['L_FORUM_TITLE'] : $this->lang('L_FORUM_TITLE'); ?></th>
    </tr>
    <?php

$catrow_count = ( isset($this->_tpldata['catrow.']) ) ?  sizeof($this->_tpldata['catrow.']) : 0;
for ($catrow_i = 0; $catrow_i < $catrow_count; $catrow_i++)
{
 $catrow_item = &$this->_tpldata['catrow.'][$catrow_i];
 $catrow_item['S_ROW_COUNT'] = $catrow_i;
 $catrow_item['S_NUM_ROWS'] = $catrow_count;

?>
    <tr>
        <td class="catLeft" colspan="4"><strong><a href="<?php echo isset($catrow_item['U_VIEWCAT']) ? $catrow_item['U_VIEWCAT'] : ''; ?>"><?php echo isset($catrow_item['CAT_DESC']) ? $catrow_item['CAT_DESC'] : ''; ?></a></strong></td>
        <td class="cat" align="center" valign="middle"><a href="<?php echo isset($catrow_item['U_CAT_EDIT']) ? $catrow_item['U_CAT_EDIT'] : ''; ?>"><?php echo isset($this->vars['L_EDIT']) ? $this->vars['L_EDIT'] : $this->lang('L_EDIT'); ?></a></td>
        <td class="cat" align="center" valign="middle"><a href="<?php echo isset($catrow_item['U_CAT_DELETE']) ? $catrow_item['U_CAT_DELETE'] : ''; ?>"><?php echo isset($this->vars['L_DELETE']) ? $this->vars['L_DELETE'] : $this->lang('L_DELETE'); ?></a></td>
        <td class="cat" align="center" valign="middle" nowrap="nowrap"><a href="<?php echo isset($catrow_item['U_CAT_MOVE_UP']) ? $catrow_item['U_CAT_MOVE_UP'] : ''; ?>"><?php echo isset($this->vars['L_MOVE_UP']) ? $this->vars['L_MOVE_UP'] : $this->lang('L_MOVE_UP'); ?></a> <a href="<?php echo isset($catrow_item['U_CAT_MOVE_DOWN']) ? $catrow_item['U_CAT_MOVE_DOWN'] : ''; ?>"><?php echo isset($this->vars['L_MOVE_DOWN']) ? $this->vars['L_MOVE_DOWN'] : $this->lang('L_MOVE_DOWN'); ?></a></td>
        <td class="catRight" align="center" valign="middle">&nbsp;</td>
    </tr>
    <?php

$forumrow_count = ( isset($catrow_item['forumrow.']) ) ? sizeof($catrow_item['forumrow.']) : 0;
for ($forumrow_i = 0; $forumrow_i < $forumrow_count; $forumrow_i++)
{
 $forumrow_item = &$catrow_item['forumrow.'][$forumrow_i];
 $forumrow_item['S_ROW_COUNT'] = $forumrow_i;
 $forumrow_item['S_NUM_ROWS'] = $forumrow_count;

?>
    <tr> 
		<td class="row1" align="center" valign="middle"><?php echo isset($forumrow_item['FORUM_ICON_IMG']) ? $forumrow_item['FORUM_ICON_IMG'] : ''; ?></td>
		<td class="row2">
		<span <?php echo isset($forumrow_item['STYLE']) ? $forumrow_item['STYLE'] : ''; ?>>
			<a href="<?php echo isset($forumrow_item['U_VIEWFORUM']) ? $forumrow_item['U_VIEWFORUM'] : ''; ?>" target="_new" <?php echo isset($forumrow_item['FORUM_COLOR']) ? $forumrow_item['FORUM_COLOR'] : ''; ?>><?php echo isset($forumrow_item['FORUM_NAME']) ? $forumrow_item['FORUM_NAME'] : ''; ?></a>
		</span>
		<br />
		<span <?php echo isset($forumrow_item['STYLE']) ? $forumrow_item['STYLE'] : ''; ?>><?php echo isset($forumrow_item['FORUM_DESC']) ? $forumrow_item['FORUM_DESC'] : ''; ?></span>
		</td>
        <td class="row1" align="center" valign="middle"><?php echo isset($forumrow_item['NUM_TOPICS']) ? $forumrow_item['NUM_TOPICS'] : ''; ?></td>
        <td class="row2" align="center" valign="middle"><?php echo isset($forumrow_item['NUM_POSTS']) ? $forumrow_item['NUM_POSTS'] : ''; ?></td>
        <td class="row1" align="center" valign="middle"><a href="<?php echo isset($forumrow_item['U_FORUM_EDIT']) ? $forumrow_item['U_FORUM_EDIT'] : ''; ?>"><?php echo isset($this->vars['L_EDIT']) ? $this->vars['L_EDIT'] : $this->lang('L_EDIT'); ?></a></td>
        <td class="row2" align="center" valign="middle"><a href="<?php echo isset($forumrow_item['U_FORUM_DELETE']) ? $forumrow_item['U_FORUM_DELETE'] : ''; ?>"><?php echo isset($this->vars['L_DELETE']) ? $this->vars['L_DELETE'] : $this->lang('L_DELETE'); ?></a></td>
        <td class="row1" align="center" valign="middle"><a href="<?php echo isset($forumrow_item['U_FORUM_MOVE_UP']) ? $forumrow_item['U_FORUM_MOVE_UP'] : ''; ?>"><?php echo isset($this->vars['L_MOVE_UP']) ? $this->vars['L_MOVE_UP'] : $this->lang('L_MOVE_UP'); ?></a> <br /> <a href="<?php echo isset($forumrow_item['U_FORUM_MOVE_DOWN']) ? $forumrow_item['U_FORUM_MOVE_DOWN'] : ''; ?>"><?php echo isset($this->vars['L_MOVE_DOWN']) ? $this->vars['L_MOVE_DOWN'] : $this->lang('L_MOVE_DOWN'); ?></a></span></td>
        <td class="row2" align="center" valign="middle"><a href="<?php echo isset($forumrow_item['U_FORUM_RESYNC']) ? $forumrow_item['U_FORUM_RESYNC'] : ''; ?>"><?php echo isset($this->vars['L_RESYNC']) ? $this->vars['L_RESYNC'] : $this->lang('L_RESYNC'); ?></a></td>
    </tr>
    <?php

} // END forumrow

if(isset($forumrow_item)) { unset($forumrow_item); } 

?>
    <tr>
        <td colspan="8" class="row2"><input type="text" name="<?php echo isset($catrow_item['S_ADD_FORUM_NAME']) ? $catrow_item['S_ADD_FORUM_NAME'] : ''; ?>" /> <input type="submit" class="liteoption"  name="<?php echo isset($catrow_item['S_ADD_FORUM_SUBMIT']) ? $catrow_item['S_ADD_FORUM_SUBMIT'] : ''; ?>" value="<?php echo isset($this->vars['L_CREATE_FORUM']) ? $this->vars['L_CREATE_FORUM'] : $this->lang('L_CREATE_FORUM'); ?>" /></td>
    </tr>
    <tr>
        <td colspan="8" height="1" class="spaceRow"><img src="../templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
    <?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>
    <tr>
        <td colspan="8" class="catBottom"><input type="text" name="categoryname" /> <input type="submit" class="liteoption"  name="addcategory" value="<?php echo isset($this->vars['L_CREATE_CATEGORY']) ? $this->vars['L_CREATE_CATEGORY'] : $this->lang('L_CREATE_CATEGORY'); ?>" /></td>
    </tr>
</table></form>