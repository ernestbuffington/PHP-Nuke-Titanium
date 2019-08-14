<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
  {META}
  <meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
  <link rel="stylesheet" href="{T_HEAD_STYLESHEET}" type="text/css">
  <title>{SITENAME} - {L_PHPBB_ADMIN}</title>
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
<body bgcolor="{T_BODY_BGCOLOR}" text="{T_BODY_TEXT}" link="{T_BODY_LINK}" vlink="{T_BODY_VLINK}">
<a name="top"></a>