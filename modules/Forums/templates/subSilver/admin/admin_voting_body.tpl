<html>
 <head>
<title>{TOPIC}</title> 
<script language="JavaScript" type="text/javascript"> 
<!-- 
    function __off(n) 
    { 
        if(n && n.style) 
        { 
            if('none' != n.style.display) 
            { 
                n.style.display = 'none'; 
            } 
        } 
    } 

    function __on(n) 
    { 
        if(n && n.style) 
        { 
            if('none' == n.style.display) 
            { 
                n.style.display = ''; 
            } 
        } 
    } 

    function __toggle(n) 
    { 
        if(n && n.style) 
        { 
            if('none' == n.style.display) 
            { 
                n.style.display = ''; 
            } 
            else 
            { 
                n.style.display = 'none'; 
            } 
        } 
    } 

//&#149; 

    function onoff(objName,bObjState) 
    { 
        var sVar = ''+objName; 
        var sOn = ''+objName+'_on'; 
        var sOff = ''+objName+'_off'; 
        var sOnStyle = bObjState ? ' style="display:none;" ':''; 
        var sOffStyle = !bObjState ? ' style="display:none;" ':''; 
        var sSymStyle = ' style="text-align: center;width: 13;height: 13;font-family: Arial,Verdana;font-size: 7pt;border-style: solid;border-width: 1;cursor: hand;color: #003344;background-color: #CACACA;" '; 

        if( (navigator.userAgent.indexOf("MSIE") >= 0) && document && document.body && document.body.style) 
            { 
                document.write( '<span '+sOnStyle+'onclick="__on('+sVar+');__off('+sOn+');__on('+sOff+');" id="'+sOn+'" title="Click here to show details"'+sSymStyle+'>+<\/span>' + 
                    '<span '+sOffStyle+'onclick="__off('+sVar+');__off('+sOff+');__on('+sOn+');" id="'+sOff+'" title="Click here to hide details"'+sSymStyle+'>-<\/span>' ); 
            } 
        else 
            { 
                document.write('<span id="' + objName + '_on" onclick="__on(document.getElementById(\'' + objName + '\'));__off(document.getElementById(\'' + objName + '_on\'));__on(document.getElementById(\'' + objName + '_off\'));" title="Click here to show details" style="text-align: center;width: 13;height: 13;font-family: monospace;font-size: 7pt;border-style: solid;border-width: 1;cursor: pointer;color: #003344;background-color: #CACACA;' + (bObjState ? ' display:none;' : '') + '">&nbsp;+&nbsp;</span>'); 
                document.write('<span id="' + objName + '_off" onclick="__off(document.getElementById(\'' + objName + '\'));__on(document.getElementById(\'' + objName + '_on\'));__off(document.getElementById(\'' + objName + '_off\'));" title="Click here to show details" style="text-align: center;width: 13;height: 13;font-family: monospace;font-size: 7pt;border-style: solid;border-width: 1;cursor: pointer;color: #003344;background-color: #CACACA;' + (!bObjState ? ' display:none;' : '') + '">&nbsp;&minus;&nbsp;</span>'); 
            }
      } 
// --> 
</script>
</head>
<h1>{ADMIN_VOTING_ICON}{L_ADMIN_VOTE_TITLE}</h1>
<p>{L_ADMIN_VOTE_EXPLAIN}</p>
<form method="post" name="vote_list" action="{S_MODE_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
      <td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_FIELD}:&nbsp;{S_FIELD_SELECT}&nbsp;&nbsp;{L_SORT_ORDER}:&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
        <input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
        </span>
      </td>
    </tr>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline"> 
    <tr> 
        <th class="thCornerL" height="20" valign="middle" nowrap="nowrap">{L_VOTE_ID}</th> 
        <th class="thTop" height="20" valign="middle" nowrap="nowrap">{L_POLL_TOPIC}</th> 
        <th class="thTop" height="20" valign="middle" nowrap="nowrap">{L_VOTE_USERNAME}</th> 
        <th class="thCornerR" height="20" valign="middle" nowrap="nowrap">{L_VOTE_END_DATE}</th> 
    </tr> 
<!-- BEGIN votes --> 
    <tr>
        <td class="{votes.COLOR}" border="1" align="center"><span class="gensmall">{votes.VOTE_ID}</span></td> 
        <td class="{votes.COLOR}" border="1"><span class="genmed">
            <script language="JavaScript" type="text/javascript"> 
            <!-- 
                onoff('vote{votes.VOTE_ID}_switch',false); 
            //--> 
            </script>
            <a href="{votes.LINK}">{votes.DESCRIPTION}</a></span><br />
        </td> 
        <td class="{votes.COLOR}" border="1"><span class="gensmall">{votes.USER}</span></td> 
        <td class="{votes.COLOR}" border="1" align="center" width="120"><span class="gensmall">{votes.VOTE_DURATION}</span></td> 
    </tr> 
    <tr id="vote{votes.VOTE_ID}_switch" style="display:none;"> 
        <td class="row2" border="1" colspan="4"> 
<table cellpadding="5" cellspacing="1" border="0"> 
<!-- BEGIN detail --> 
    <tr> 
        <td class="row1">{votes.detail.OPTION} ({votes.detail.RESULT})</td> 
        <td class="row3"><span class="gensmall">{votes.detail.USER}</span></td> 
    </tr> 
<!-- END detail --> 
</table> 
    </td> 
    </tr> 
<!-- END votes --> 
    <tr>
        <td class="catBottom" height="18" align="center" valign="middle" colspan="4"></td>
    </tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
    <td><span class="nav">{PAGE_NUMBER}</span></td>
    <td align="right"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>
<br />
<div align="center"><span class="copyright">Admin Voting  v1.1.8  &copy 2002  <a href="mailto:ErDrRon@aol.com">ErDrRon</a></span></div>
</body> 
</html>