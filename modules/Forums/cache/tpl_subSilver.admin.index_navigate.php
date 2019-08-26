<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 08:54:50 +0000 (time=1566809690)

?><script language="javascript" type="text/javascript">
<!--

var menuVersion = "Slide Menu v1.0.0";

/*************************************************************
 *    DHTML Slide Menu for ACP MOD
 *
 *    Copyright (C) 2004, Markus (phpMiX)
 *    This script is released under GPL License.
 *    Feel free to use this script (or part of it) wherever you need
 *    it ...but please, give credit to original author. Thank you. :-)
 *    We will also appreciate any links you could give us.
 *
 *    Enjoy! ;-)
 *************************************************************/

menuVersion += ' &copy; 2004<br />by <a href="http://www.phpmix.com/" target="_blank" class="copyright">phpMiX</a>';

function getCookie(name)
{
    var cookies = document.cookie;
    var start = cookies.indexOf(name + '=');
    if( start < 0 ) return null;
    var len = start + name.length + 1;
    var end = cookies.indexOf(';', len);
    if( end < 0 ) end = cookies.length;
    return unescape(cookies.substring(len, end));
}
function setCookie(name, value, expires, path, domain, secure)
{
    document.cookie = name + '=' + escape (value) +
        ((expires) ? '; expires=' + ( (expires == 'never') ? 'Thu, 31-Dec-2099 23:59:59 GMT' : expires.toGMTString() ) : '') +
        ((path)    ? '; path='    + path    : '') +
        ((domain)  ? '; domain='  + domain  : '') +
        ((secure)  ? '; secure' : '');
}
function delCookie(name, path, domain)
{
    if( getCookie(name) )
    {
        document.cookie = name + '=;expires=Thu, 01-Jan-1970 00:00:01 GMT' +
            ((path)    ? '; path='    + path    : '') +
            ((domain)  ? '; domain='  + domain  : '');
    }
}

function menuCat(id, rows)
{
    this.cat_id = id;
    this.cat_rows = rows;
    this.status = 'block';
}
var menuCats = new Array();
<?php

$catrow_count = ( isset($this->_tpldata['catrow.']) ) ?  sizeof($this->_tpldata['catrow.']) : 0;
for ($catrow_i = 0; $catrow_i < $catrow_count; $catrow_i++)
{
 $catrow_item = &$this->_tpldata['catrow.'][$catrow_i];
 $catrow_item['S_ROW_COUNT'] = $catrow_i;
 $catrow_item['S_NUM_ROWS'] = $catrow_count;

?>
menuCats['menuCat_<?php echo isset($catrow_item['MENU_CAT_ID']) ? $catrow_item['MENU_CAT_ID'] : ''; ?>'] = new menuCat('<?php echo isset($catrow_item['MENU_CAT_ID']) ? $catrow_item['MENU_CAT_ID'] : ''; ?>', <?php echo isset($catrow_item['MENU_CAT_ROWS']) ? $catrow_item['MENU_CAT_ROWS'] : ''; ?>);
<?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>

function getObj(obj)
{
    return ( document.getElementById ? document.getElementById(obj) : ( document.all ? document.all[obj] : null ) );
}
function displayObj(obj, status)
{
    var x = getObj(obj);
    if( x && x.style ) x.style.display = status;
}

var queueInterval = 20;        // milliseconds between queued steps.
var execInterval = 0;
var queuedSteps;
var currentStep;

function queueStep(o, s)
{
    this.obj = o;
    this.status = s;
}
function execQueue()
{
    if( currentStep < queuedSteps.length )
    {
        var obj = queuedSteps[currentStep].obj;
        var status = queuedSteps[currentStep].status;
        displayObj(obj, status);
        if( menuCats[obj] ) menuCats[obj].status = status;
        currentStep++;
        setTimeout("execQueue();", execInterval);
    }
    else
    {
        execInterval = queueInterval;
    }
}
function onMenuCatClick(cat_id)
{
    var currentCat, currentStatus;

    currentCat = 'menuCat_'+cat_id;
    currentStatus = menuCats[currentCat].status;

    queuedSteps = new Array();
    currentStep = 0;

    for( var catName in menuCats )
    {
        if( menuCats[catName].status == 'none' ) continue;

        for( var i=(menuCats[catName].cat_rows-1); i >= 0; i-- )
        {
            queuedSteps[currentStep++] = new queueStep(catName+'_'+i, 'none');
        }
        queuedSteps[currentStep++] = new queueStep(catName, 'none');
    }

    if( currentStatus == 'none' )
    {
        queuedSteps[currentStep++] = new queueStep(currentCat, 'block');
        for( var i=0; i < menuCats[currentCat].cat_rows; i++ )
        {
            queuedSteps[currentStep++] = new queueStep(currentCat+'_'+i, 'block');
        }
        var    expdate = new Date();        // 72 Hours from now
        expdate.setTime(expdate.getTime() + (72 * 60 * 60 * 1000));
        setCookie('<?php echo isset($this->vars['COOKIE_NAME']) ? $this->vars['COOKIE_NAME'] : $this->lang('COOKIE_NAME'); ?>_menu_cat_id', cat_id, expdate,
                ('<?php echo isset($this->vars['COOKIE_PATH']) ? $this->vars['COOKIE_PATH'] : $this->lang('COOKIE_PATH'); ?>'   == '') ? null : '<?php echo isset($this->vars['COOKIE_PATH']) ? $this->vars['COOKIE_PATH'] : $this->lang('COOKIE_PATH'); ?>',
                ('<?php echo isset($this->vars['COOKIE_DOMAIN']) ? $this->vars['COOKIE_DOMAIN'] : $this->lang('COOKIE_DOMAIN'); ?>' == '') ? null : '<?php echo isset($this->vars['COOKIE_DOMAIN']) ? $this->vars['COOKIE_DOMAIN'] : $this->lang('COOKIE_DOMAIN'); ?>',
                ('<?php echo isset($this->vars['COOKIE_SECURE']) ? $this->vars['COOKIE_SECURE'] : $this->lang('COOKIE_SECURE'); ?>' == '0') ? false : true);
    }
    else
    {
        delCookie('<?php echo isset($this->vars['COOKIE_NAME']) ? $this->vars['COOKIE_NAME'] : $this->lang('COOKIE_NAME'); ?>_menu_cat_id',
                ('<?php echo isset($this->vars['COOKIE_PATH']) ? $this->vars['COOKIE_PATH'] : $this->lang('COOKIE_PATH'); ?>'   == '') ? null : '<?php echo isset($this->vars['COOKIE_PATH']) ? $this->vars['COOKIE_PATH'] : $this->lang('COOKIE_PATH'); ?>',
                ('<?php echo isset($this->vars['COOKIE_DOMAIN']) ? $this->vars['COOKIE_DOMAIN'] : $this->lang('COOKIE_DOMAIN'); ?>' == '') ? null : '<?php echo isset($this->vars['COOKIE_DOMAIN']) ? $this->vars['COOKIE_DOMAIN'] : $this->lang('COOKIE_DOMAIN'); ?>');
    }

    currentStep = 0;
    setTimeout("execQueue();", execInterval);
}

function doOnLoadMenuACP()
{
    var cat_id;

    if( getObj('menuCat_0') )
    {
        cat_id = getCookie('<?php echo isset($this->vars['COOKIE_NAME']) ? $this->vars['COOKIE_NAME'] : $this->lang('COOKIE_NAME'); ?>_menu_cat_id');
        if( !menuCats['menuCat_'+cat_id] )
        {
            cat_id = 0;
        }
        else
        {
            menuCats['menuCat_'+cat_id].status = 'none';
        }
        onMenuCatClick(cat_id);
    }
    if( oldOnLoadMenuACP )
    {
        oldOnLoadMenuACP();
    }
}
var    oldOnLoadMenuACP = window.onload;
window.onload = doOnLoadMenuACP;

// -->
</script>
<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center">
  <tr>
    <td align="center" ><a href="../../../<?php echo isset($this->vars['U_FORUM_INDEX']) ? $this->vars['U_FORUM_INDEX'] : $this->lang('U_FORUM_INDEX'); ?>" target="_parent"><img src="../templates/subSilver/images/logo_phpBB_med.gif" alt="phpBB" border="0" /></a></td>
  </tr>
  <tr>
    <td align="center" >
      <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
        <tr>
          <td class="catHead" style="text-align: center"><?php echo isset($this->vars['L_ADMIN']) ? $this->vars['L_ADMIN'] : $this->lang('L_ADMIN'); ?></td>
        </tr>
        <tr><td class="row1"><a href="<?php echo isset($this->vars['U_HOME_NUKE']) ? $this->vars['U_HOME_NUKE'] : $this->lang('U_HOME_NUKE'); ?>" target="_parent"><?php echo isset($this->vars['L_HOME_NUKE']) ? $this->vars['L_HOME_NUKE'] : $this->lang('L_HOME_NUKE'); ?></a></td></tr>
        <tr><td class="row1"><a href="<?php echo isset($this->vars['U_ADMIN_NUKE']) ? $this->vars['U_ADMIN_NUKE'] : $this->lang('U_ADMIN_NUKE'); ?>" target="_parent"><?php echo isset($this->vars['L_ADMIN_NUKE']) ? $this->vars['L_ADMIN_NUKE'] : $this->lang('L_ADMIN_NUKE'); ?></a></td></tr>
        <tr><td class="row1"><a href="<?php echo isset($this->vars['U_ADMIN_INDEX']) ? $this->vars['U_ADMIN_INDEX'] : $this->lang('U_ADMIN_INDEX'); ?>" target="main"><?php echo isset($this->vars['L_ADMIN_INDEX']) ? $this->vars['L_ADMIN_INDEX'] : $this->lang('L_ADMIN_INDEX'); ?></a></td></tr>
        <tr><td class="row1"><a href="../../../<?php echo isset($this->vars['U_FORUM_INDEX']) ? $this->vars['U_FORUM_INDEX'] : $this->lang('U_FORUM_INDEX'); ?>" target="_parent"><?php echo isset($this->vars['L_FORUM_INDEX']) ? $this->vars['L_FORUM_INDEX'] : $this->lang('L_FORUM_INDEX'); ?></a></td></tr>
        <tr><td class="row1"><a href="../../../<?php echo isset($this->vars['U_FORUM_PREINDEX']) ? $this->vars['U_FORUM_PREINDEX'] : $this->lang('U_FORUM_PREINDEX'); ?>" target="main"><?php echo isset($this->vars['L_PREVIEW_FORUM']) ? $this->vars['L_PREVIEW_FORUM'] : $this->lang('L_PREVIEW_FORUM'); ?></a></td></tr>
        <?php

$catrow_count = ( isset($this->_tpldata['catrow.']) ) ?  sizeof($this->_tpldata['catrow.']) : 0;
for ($catrow_i = 0; $catrow_i < $catrow_count; $catrow_i++)
{
 $catrow_item = &$this->_tpldata['catrow.'][$catrow_i];
 $catrow_item['S_ROW_COUNT'] = $catrow_i;
 $catrow_item['S_NUM_ROWS'] = $catrow_count;

?>
        <tr>
          <td height="28" class="catSides" style="cursor:pointer;" onclick="onMenuCatClick('<?php echo isset($catrow_item['MENU_CAT_ID']) ? $catrow_item['MENU_CAT_ID'] : ''; ?>');"><?php echo isset($catrow_item['ADMIN_CATEGORY']) ? $catrow_item['ADMIN_CATEGORY'] : ''; ?></td>
        </tr>
        <tr> 
            <td class="row1">
                <div id="menuCat_<?php echo isset($catrow_item['MENU_CAT_ID']) ? $catrow_item['MENU_CAT_ID'] : ''; ?>" style="display:block;">
                    <table width="100%" cellpadding="4" cellspacing="1" border="0" class="bodyline">
        <?php

$modulerow_count = ( isset($catrow_item['modulerow.']) ) ? sizeof($catrow_item['modulerow.']) : 0;
for ($modulerow_i = 0; $modulerow_i < $modulerow_count; $modulerow_i++)
{
 $modulerow_item = &$catrow_item['modulerow.'][$modulerow_i];
 $modulerow_item['S_ROW_COUNT'] = $modulerow_i;
 $modulerow_item['S_NUM_ROWS'] = $modulerow_count;

?>
        <tr>
          <td class="row1"><div id="menuCat_<?php echo isset($catrow_item['MENU_CAT_ID']) ? $catrow_item['MENU_CAT_ID'] : ''; ?>_<?php echo isset($modulerow_item['ROW_COUNT']) ? $modulerow_item['ROW_COUNT'] : ''; ?>" style="display:block;"><a href="<?php echo isset($modulerow_item['U_ADMIN_MODULE']) ? $modulerow_item['U_ADMIN_MODULE'] : ''; ?>"  target="main"><?php echo isset($modulerow_item['ADMIN_MODULE']) ? $modulerow_item['ADMIN_MODULE'] : ''; ?></a></div>
          </td>
        </tr>
        <?php

} // END modulerow

if(isset($modulerow_item)) { unset($modulerow_item); } 

?>
                    </table>
                </div>
            </td>
        </tr>
        <?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>
      </table>
    </td>
  </tr>
</table>

<br />