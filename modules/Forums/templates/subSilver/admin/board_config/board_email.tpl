<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_EMAIL_SETTINGS}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ADMIN_EMAIL}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_EMAIL_SIG}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_EMAIL_SIG_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><textarea name="board_email_sig" rows="5" cols="30">{EMAIL_SIG}</textarea></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_USE_SMTP}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_USE_SMTP_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="smtp_delivery" value="1" {SMTP_YES} /> {L_YES} <input type="radio" name="smtp_delivery" value="0" {SMTP_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SMTP_SERVER}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SMTP_USERNAME}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SMTP_USERNAME_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SMTP_PASSWORD}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SMTP_PASSWORD_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" /></td>
  </tr>
</table>
</span>