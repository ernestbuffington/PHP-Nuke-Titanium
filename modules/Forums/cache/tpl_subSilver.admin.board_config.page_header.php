<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Aug 2019 09:01:27 +0000 (time=1566810087)

?><h1><?php echo isset($this->vars['L_CONFIGURATION_TITLE']) ? $this->vars['L_CONFIGURATION_TITLE'] : $this->lang('L_CONFIGURATION_TITLE'); ?></h1>

<p><?php echo isset($this->vars['L_CONFIGURATION_EXPLAIN']) ? $this->vars['L_CONFIGURATION_EXPLAIN'] : $this->lang('L_CONFIGURATION_EXPLAIN'); ?></p>

<?php

$use_dhtml_count = ( isset($this->_tpldata['use_dhtml.']) ) ?  sizeof($this->_tpldata['use_dhtml.']) : 0;
for ($use_dhtml_i = 0; $use_dhtml_i < $use_dhtml_count; $use_dhtml_i++)
{
 $use_dhtml_item = &$this->_tpldata['use_dhtml.'][$use_dhtml_i];
 $use_dhtml_item['S_ROW_COUNT'] = $use_dhtml_i;
 $use_dhtml_item['S_NUM_ROWS'] = $use_dhtml_count;

?>
<script language="Javascript" type="text/javascript">
<!--
function show (id) {
    if (id.style.display == "")
        id.style.display = "none"
    else 
        id.style.display = ""
}
-->
</script>
<?php

} // END use_dhtml

if(isset($use_dhtml_item)) { unset($use_dhtml_item); } 

?>

<form action="<?php echo isset($this->vars['S_CONFIG_ACTION']) ? $this->vars['S_CONFIG_ACTION'] : $this->lang('S_CONFIG_ACTION'); ?>" method="post">