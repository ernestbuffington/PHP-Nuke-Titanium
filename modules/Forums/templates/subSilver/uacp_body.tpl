<strong><center>{L_UACP} :: {USERNAME}</center></strong>

<script language="Javascript" type="text/javascript">
    //
    // Should really check the browser to stop this whining ...
    //
    function select_switch(status)
    {
        for (i = 0; i < document.attach_list.length; i++)
        {
            document.attach_list.elements[i].checked = status;
        }
    }
</script>

<form method="post" name="attach_list" action="{S_MODE_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
      <td align="left" nowrap="nowrap">
      <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td class="nav" align="left"><a class="nav" href="{U_INDEX}">{L_INDEX}</a></td>
    </tr>
</table>
        </td>
      <td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
        <input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
        </span>
      </td>
    </tr>
  </table>
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
    <tr> 
      <th height="25" class="thCornerL">#</th>
      <th class="thTop">{L_FILENAME}</th>
      <th class="thTop">{L_FILECOMMENT}</th>
      <th class="thTop">{L_EXTENSION}</th>
      <th class="thTop">{L_SIZE}</th>
      <th class="thTop">{L_DOWNLOADS}</th>
      <th class="thTop">{L_POST_TIME}</th>
      <th class="thTop">{L_POSTED_IN_TOPIC}</th>
      <th class="thCornerR">{L_DELETE}</th>
    </tr>
    <!-- BEGIN attachrow -->
    <tr> 
      <td class="{attachrow.ROW_CLASS}" align="center"><span class="gen">&nbsp;{attachrow.ROW_NUMBER}&nbsp;</span></td>
      <td class="{attachrow.ROW_CLASS}" align="center"><span class="gen"><a href="{attachrow.U_VIEW_ATTACHMENT}" class="gen" target="_blank">{attachrow.FILENAME}</a></span></td>
      <td class="{attachrow.ROW_CLASS}" align="center"><span class="gen">{attachrow.COMMENT}</span></td>
      <td class="{attachrow.ROW_CLASS}" align="center"><span class="gen">{attachrow.EXTENSION}</span></td>
      <td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gen"><strong>{attachrow.SIZE}</strong></span></td>
      <td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gen"><strong>{attachrow.DOWNLOAD_COUNT}</strong></span></td>
      <td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{attachrow.POST_TIME}</span></td>
      <td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{attachrow.POST_TITLE}</span></td>
      <td class="{attachrow.ROW_CLASS}" align="center">{attachrow.S_DELETE_BOX}</td>
      {attachrow.S_HIDDEN}
    </tr>
    <!-- END attachrow -->
    <tr> 
      <td class="catBottom" colspan="9" height="28" align="right"> 
        <input type="submit" name="delete" value="{L_DELETE_MARKED}" class="liteoption" />
      </td>
    </tr>
  </table>

  {S_USER_HIDDEN}

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
      <td align="right" valign="top" nowrap="nowrap"><strong><span class="gensmall"><a href="javascript:select_switch(true);" class="gensmall">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);" class="gensmall">{L_UNMARK_ALL}</a></span></strong></td>
    </tr>
  </table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
    <td><span class="nav">{PAGE_NUMBER}</span></td>
    <td align="right"><span class="nav">{PAGINATION}&nbsp;</span></td>
  </tr>
</table></form>
