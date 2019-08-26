<?php

// eXtreme Styles mod cache. Generated on Fri, 23 Aug 2019 16:44:39 +0000 (time=1566578679)

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="<?php echo isset($this->vars['S_CONTENT_DIRECTION']) ? $this->vars['S_CONTENT_DIRECTION'] : $this->lang('S_CONTENT_DIRECTION'); ?>">
<head>
  <?php echo isset($this->vars['META']) ? $this->vars['META'] : $this->lang('META'); ?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo isset($this->vars['S_CONTENT_ENCODING']) ? $this->vars['S_CONTENT_ENCODING'] : $this->lang('S_CONTENT_ENCODING'); ?>">
  <link rel="stylesheet" href="<?php echo isset($this->vars['T_HEAD_STYLESHEET']) ? $this->vars['T_HEAD_STYLESHEET'] : $this->lang('T_HEAD_STYLESHEET'); ?>" type="text/css">
  <title><?php echo isset($this->vars['SITENAME']) ? $this->vars['SITENAME'] : $this->lang('SITENAME'); ?> - <?php echo isset($this->vars['L_PHPBB_ADMIN']) ? $this->vars['L_PHPBB_ADMIN'] : $this->lang('L_PHPBB_ADMIN'); ?></title>
  <script type="text/javascript"> 
    function ismaxlength(obj)
    { 
      var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : "" 
      if (obj.getAttribute && obj.value.length>mlength) 
        obj.value=obj.value.substring(0,mlength) 
    } 
  </script>
  <script type="text/javascript" src="../../../includes/js/scripts/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
    var nuke_jq = jQuery.noConflict();
  </script>

  <link rel="stylesheet" type="text/css" href="../../../includes/css/images.core.css">
  <link rel="stylesheet" type="text/css" href="../../../includes/css/images.16x16-flags.css">
  <link rel="stylesheet" type="text/css" href="../../../includes/css/jquery.tooltipster.bundle.min.css">
  <link rel="stylesheet" type="text/css" href="../../../includes/css/jquery.tooltipster-sideTip-light.min.css">

  <script type="text/javascript" src="../../../includes/js/scripts/jquery.tooltipster.bundle.min.js"></script>
  <script type="text/javascript">
    nuke_jq(function($)
    {
        $(".tooltip").tooltipster({
			     theme: "tooltipster-light",
			     animation: "grow"
		    });

        $(".tooltip-interact").tooltipster({
			     theme: "tooltipster-light",
			     contentAsHTML: true,
			     animation: "grow",
			     interactive: true
		    });

		    $(".tooltip-html").tooltipster({
			     theme: "tooltipster-light",
			     contentAsHTML: true,
			     animation: "grow"
		    });

        $(".user_from_flag_select").change(function(){
            var selectedCountry = $(this).children("option:selected").val();
            country_class = selectedCountry.replace(/(.*)\.(.*?)$/, "$1");
            $('.countries').removeClass().addClass('countries '+country_class);
        });
	 });
  </script>
</head>
<body bgcolor="<?php echo isset($this->vars['T_BODY_BGCOLOR']) ? $this->vars['T_BODY_BGCOLOR'] : $this->lang('T_BODY_BGCOLOR'); ?>" text="<?php echo isset($this->vars['T_BODY_TEXT']) ? $this->vars['T_BODY_TEXT'] : $this->lang('T_BODY_TEXT'); ?>" link="<?php echo isset($this->vars['T_BODY_LINK']) ? $this->vars['T_BODY_LINK'] : $this->lang('T_BODY_LINK'); ?>" vlink="<?php echo isset($this->vars['T_BODY_VLINK']) ? $this->vars['T_BODY_VLINK'] : $this->lang('T_BODY_VLINK'); ?>">
<a name="top"></a>