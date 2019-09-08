<script language="JavaScript" type="text/javascript">
<!--
function toggle_check_all()
{
    for (var i=0; i < document.delete_ids.elements.length; i++)
    {
        var checkbox_element = document.delete_ids.elements[i];
        if ((checkbox_element.name != 'check_all_box') && (checkbox_element.type == 'checkbox'))
        {
            checkbox_element.checked = document.delete_ids.check_all_box.checked;
        }
    }
}
-->
</script>

<!-- BEGIN statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="1" align="center">
    <tr> 
      <td align="center"><span class="gen">{L_STATUS}<br /></span>
      <span class="genmed"><strong>{I_STATUS_MESSAGE}</strong></span><br /></td>
    </tr>
  </table>
<!-- END statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
      <td align="left"><span class="maintitle">{L_PAGE_NAME}</span>
          <br /><span class="gensmall"><strong>{L_VERSION} {VERSION}
          <br />{NIVISEC_CHECKER_VERSION}</strong></span><br /><br />
      <span class="genmed">{L_PAGE_DESC}<br /><br />{VERSION_CHECK_DATA}</span></td>
    </tr>
  </table>

<form method="post" action="{S_MODE_ACTION}" name="sort_and_mode">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
      <td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
        <input type="submit" name="submit" value="{L_SORT}" class="liteoption" />
        </span></td>
    </tr>
  </table>
</form>
<form method="post" action="{S_MODE_ACTION}" name="delete_ids">
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
    <tr> 
      <th height="25" class="thCornerL" align="right" width="3%"><input type="checkbox" name="check_all_box" onClick="toggle_check_all()"></th>
      <th class="thTop" align="left" width="45%">{L_TITLE}</th>
      <th class="thTop">{L_POSTER}</th>
      <th class="thTop">{L_TIME}</th>
      <th class="thTop">{L_MOVED_FROM}</th>
      <th class="thCornerR">{L_MOVED_TO}</th>
    </tr>
    <!-- BEGIN topicrow -->
    <tr> 
      <td class="{topicrow.ROW_CLASS}" align="right"><input type="checkbox" name="delete_id_{topicrow.TOPIC_ID}"></td>
      <td class="{topicrow.ROW_CLASS}"  align="left"><span class="gen">{topicrow.TITLE}</span></td>
      <td class="{topicrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{topicrow.POSTER}</span></td>
      <td class="{topicrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{topicrow.TIME}</span></td>
      <td class="{topicrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{topicrow.MOVED_FROM}</span></td>
      <td class="{topicrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{topicrow.MOVED_TO}</span></td>
    </tr>
    <!-- END topicrow -->
    <!-- BEGIN emptyrow -->
    <tr>
        <td class="row1" align="center" colspan="6"><span class="gen">{L_NO_TOPICS_FOUND}</span></td>
    </tr>
    <!-- END emptyrow -->
    <tr> 
      <td class="catbottom" colspan="6" height="28" align="center"><input type="submit" class="mainoption" value="{L_DELETE}">&nbsp;&nbsp;<input type="reset" class="liteoption" value="{L_CLEAR}"></td>
    </tr>
  </table>
</form>
  
<form method="post" action="{S_MODE_ACTION}" name="delete_all_before">
  <table cellpadding="3" cellspacing="1" border="0" class="forumline" align="center">
      <tr>
          <td class="catHead" colspan="3"><span class='catTitle'>{L_DELETE_FROM_EXPLAN}</span></td>
      </tr>
    <tr>
        <th height="25" class="thCornerL">{L_MONTH}<br />1 - 12</td>
        <th class="thTop">{L_DAY}<br />1 - 31</td>
        <th class="thCornerR">{L_YEAR}<br />1970 - 2038</td>
    </tr>
    <tr>
        <td class="row1" align="center"><input class="post" type="text" name="del_month" value="{S_MONTH}" size="2" maxlength="2"></td>
        <td class="row2" align="center"><input class="post" type="text" name="del_day" value="{S_DAY}" size="2" maxlength="2"></td>
        <td class="row1" align="center"><input class="post" type="text" name="del_year" value="{S_YEAR}" size="4" maxlength="4"></td>
    </tr>
    <tr> 
      <td class="catbottom" colspan="3" height="28" align="center">
          <input type="hidden" name="delete_all_before_date" value="1">
          <input type="hidden" name="mode" value="{S_MODE}">
          <input type="hidden" name="order" value="{S_ORDER}">
          <input type="submit" value="{L_DELETE_BEFORE}" class="mainoption">
      </td>
    </tr>
  </table>
 </form>