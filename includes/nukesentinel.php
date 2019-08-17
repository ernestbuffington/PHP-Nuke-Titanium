<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2006 by NukeScripts Network         */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/26/2005
      Caching System                           v1.0.0       10/30/2005
      Evolution Functions                      v1.5.0       12/14/2005
      Advanced Security Extension              v1.0.0       12/21/2005
 ************************************************************************/

if(defined('NO_SECURITY')) return;

define_once("NUKESENTINEL_IS_LOADED", true);
unset($nsnst_const);

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

define('REGEX_UNION','#\w?\s?union\s\w*?\s?(select|all|distinct|insert|update|drop|delete)#is');

@require_once(NUKE_BASE_DIR.'config.php');
@require_once(NUKE_DB_DIR.'db.php');

# Load required configs
global $remote, $nsnst_const, $admin_file, $userinfo, $currentlang, $cache, $nukeurl, $name;

$identify = new identify();

/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
$nuke_config = load_nukeconfig();
foreach($nuke_config as $var => $value) {
    if (isset($$var)) unset($$var);
    $$var = $value;
}
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
$ab_config = abget_configs();
$nsnst_const['server_ip'] = get_server_ip();
$nsnst_const['client_ip'] = get_client_ip();
$nsnst_const['forward_ip'] = get_x_forwarded();
$nsnst_const['remote_addr'] = get_remote_addr();
/*****[BEGIN]******************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
$nsnst_const['remote_ip'] = $identify->get_ip();
/*****[END]********************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
$nsnst_const['remote_long'] = sprintf("%u", ip2long($nsnst_const['remote_ip']));
$nsnst_const['remote_port'] = get_remote_port();
$nsnst_const['request_method'] = get_request_method();
$nsnst_const['query_string'] = st_clean_string(get_query_string());
$nsnst_const['script_name'] = get_script_name();
$nsnst_const['http_host'] = get_http_host();
/*****[BEGIN]******************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
$nsnst_const['request_string'] = st_clean_string(get_request_string('request'));
$nsnst_const['get_string'] = st_clean_string(get_request_string('post'));
$nsnst_const['post_string'] = st_clean_string(get_request_string('get'));
/*****[END]********************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
$nsnst_const['query_string_base64'] = st_clean_string(base64_decode($nsnst_const['query_string']));
$nsnst_const['user_agent'] = get_user_agent();
$nsnst_const['referer'] = get_referer();
$nsnst_const['ban_time'] = time();
$nsnst_const['ban_ip'] = "";
/*****[BEGIN]******************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
$nsnst_const['request_string_base64'] = st_clean_string(base64_decode($nsnst_const['request_string']));
/*****[END]********************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/

function nsnst_valid_ip ($ip) {
    return (preg_match('/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $ip));
}

if (!nsnst_valid_ip($nsnst_const['client_ip'])) {$nsnst_const['client_ip'] = "none"; }
if (!nsnst_valid_ip($nsnst_const['forward_ip'])) {$nsnst_const['forward_ip'] = "none"; }
if (!nsnst_valid_ip($nsnst_const['remote_ip'])) {$nsnst_const['remote_ip'] = "none"; }
if (!nsnst_valid_ip($nsnst_const['remote_addr'])) {$nsnst_const['remote_addr'] = "none"; }

if(isset($user) && is_array($user)) {
  $user = implode(":", $user);
  $user = base64_encode($user);
}
$uinfo = (isset($userinfo)) ? $userinfo : null;
if ((isset($uinfo) && isset($uinfo['user_id']) && isset($uinfo['username'])) && $uinfo['user_id'] > 1 && !empty($uinfo['username'])) {
  $nsnst_const['ban_user_id'] = $uinfo['user_id'];
  $nsnst_const['ban_username'] = $uinfo['username'];
} else {
  $nsnst_const['ban_user_id'] = 1;
  $nsnst_const['ban_username'] = $nuke_config['anonymous'];
}

# Load required lang file
if (file_exists(NUKE_MODULES_DIR.'NukeSentinel/language/lang-'.$currentlang.'.php')) {
   include_once(NUKE_MODULES_DIR.'NukeSentinel/language/lang-'.$currentlang.'.php');
} else {
   include_once(NUKE_MODULES_DIR.'NukeSentinel/language/lang-english.php');
}

# Load Blocker Arrays
if(($blocker_array = $cache->load('blockers', 'sentinel')) === false) {
    $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` ORDER BY `blocker`");
    $num_rows = $db->sql_numrows($result);
    for ($i = 0; $i < $num_rows; $i++) {
        $row = $db->sql_fetchrow($result);
        $blockernametemp = $row['block_name'];
        $blocker_array[$blockernametemp] = $row;
    }
    $db->sql_freeresult($result);
    $cache->save('blockers', 'sentinel', $blocker_array);
}

function string_bypass ($str) {
    global $nsnst_const;
    return substr($nsnst_const['query_string'],0,strlen($str)) != $str;
}

# Invalid admin check
if(isset($aid) AND (!isset($admin) OR empty($admin)) AND $op!='login' AND string_bypass('name=Calendar')) { die(_AB_FALSEADMIN); }

# Stop Santy Worm
# If you have problems with forums remove ,highlight from the string below
if($ab_config['santy_protection'] == 1) {
  $bad_uri_content=array("rush","highlight=%","perl","chr(","pillar","visualcoder","sess_");
  
  # FIX for PHP 7.3.6 by Ernest Allen Buffington on 08/13/2019
  # while(list($stid,$uri_content)=each($bad_uri_content)) 
  foreach ($bad_uri_content as $name => $uri_content) 
  { 
    if(stristr($_SERVER['REQUEST_URI'], $uri_content)) 
  { 
  
  die(_AB_SANTY); } }
}

# Invalid ip check
if($ab_config['test_switch'] != 1) {
  if($nsnst_const['remote_ip']=="none") {
  echo abget_template("abuse_invalid.tpl");
  die();
  }
}

# Invalid user agent
if($nsnst_const['user_agent']=="none" AND !stristr($_SERVER['PHP_SELF'], "backend.php") AND ($nsnst_const['remote_ip'] != $nsnst_const['server_ip'])) {
  echo abget_template("abuse_invalid2.tpl");
  die();
}

# Invalid request method check
if(strtolower($nsnst_const['request_method'])!="get" AND strtolower($nsnst_const['request_method'])!="head" AND strtolower($nsnst_const['request_method'])!="post" AND strtolower($nsnst_const['request_method'])!="put") { die(_AB_INVALIDMETHOD); }

# DOS Attack Blocker
if($ab_config['prevent_dos'] == 1 AND !stristr($_SERVER['PHP_SELF'], "backend.php") AND !stristr($nukeurl, $_SERVER['SERVER_NAME'])) {
  if (empty($nsnst_const['user_agent']) || $nsnst_const['user_agent'] == "-" || !isset($nsnst_const['user_agent'])) { die(_AB_GETOUT); }
}


# Site Switch Check
if($ab_config['site_switch'] == 1 AND !stristr($_SERVER['PHP_SELF'], $admin_file.".php") AND !is_admin() && !defined('NO_DISABLE')) {
  $display_page = abget_template($ab_config['site_reason']);
  $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL."</div>\n</body>", $display_page);
  die($display_page);
}

# Clearing of expired blocks
# CAUTION: This function can slow your sites load time
$clearedtime = strtotime(date("Y-m-d 23:59:59", $nsnst_const['ban_time']));
$cleartime = strtotime(date("Y-m-d 23:59:59", $nsnst_const['ban_time'])) - 86400;
if($ab_config['self_expire'] == 1 AND $ab_config['blocked_clear'] < $cleartime) {
  $clearresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE (`expires`<'$clearedtime' AND `expires`!='0')");
  while($clearblock = $db->sql_fetchrow($clearresult)) {
    if(!empty($ab_config['htaccess_path'])) {
      $ipfile = file($ab_config['htaccess_path']);
      $ipfile = implode("", $ipfile);
      $i = 1;
      while ($i <= 3) {
        $tip = substr($clearblock['ip_addr'], -2);
        if ($tip == ".*") { $clearblock['ip_addr'] = substr($clearblock['ip_addr'], 0, -2); }
        $i++;
      }
      $testip = "deny from ".$clearblock['ip_addr']."\n";
      $ipfile = str_replace($testip, "", $ipfile);
      $doit = @fopen($ab_config['htaccess_path'], "w");
      @fwrite($doit, $ipfile);
      @fclose($doit);
    }
    $db->sql_query("DELETE FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='".$clearblock['ip_addr']."'");
    $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_blocked_ips`");
  }
  $db->sql_freeresult($clearblock);
  $clearresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE (`expires`<'$clearedtime' AND `expires`!='0')");
  while($clearblock = $db->sql_fetchrow($clearresult)) {
    $old_masscidr = ABGetCIDRs($clearblock['ip_lo'], $clearblock['ip_hi']);
    if (!empty($ab_config['htaccess_path'])) {
      $old_masscidr = explode("||", $old_masscidr);
      for ($i=0; $i < count($old_masscidr); $i++) {
        if (!empty($old_masscidr[$i])) {
          $old_masscidr[$i] = "deny from ".$old_masscidr[$i]."\n";
        }
      }
      $ipfile = file($ab_config['htaccess_path']);
      $ipfile = implode("", $ipfile);
      $ipfile = str_replace($old_masscidr, "", $ipfile);
      $ipfile = $ipfile;
      $doit = @fopen($ab_config['htaccess_path'], "w");
      @fwrite($doit, $ipfile);
      @fclose($doit);
    }
    $db->sql_query("DELETE FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`='".$clearblock['ip_lo']."' AND `ip_hi`='".$clearblock['ip_hi']."'");
    $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_blocked_ranges`");
  }
  $db->sql_freeresult($clearblock);
  $db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='$clearedtime' WHERE `config_name`='blocked_clear'");
}

# Proxy Blocker
if($ab_config['proxy_switch'] == 1) {
  $proxy0 = $nsnst_const['remote_ip'];
  $proxy1 = $nsnst_const['client_ip'];
  $proxy2 = $nsnst_const['forward_ip'];
  $proxy_host = @getHostByAddr($proxy0);
  #Lite:
  if($ab_config['proxy_switch'] == 1 AND ($proxy1 != "none" OR $proxy2 != "none")) {
    $display_page = abget_template($ab_config['proxy_reason']);
    $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL." ".$ab_config['version_number']." "._AB_BYNSN."</div>\n</body>", $display_page);
    die($display_page);
  }
  #Mild:
  if($ab_config['proxy_switch'] == 2 AND ($proxy1 != "none" OR $proxy2 != "none" OR stristr($proxy_host,"proxy"))) {
    $display_page = abget_template($ab_config['proxy_reason']);
    $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL." ".$ab_config['version_number']." "._AB_BYNSN."</div>\n</body>", $display_page);
    die($display_page);
  }
  #Strong:
  if($ab_config['proxy_switch'] == 3 AND ($proxy1 != "none" OR $proxy2 != "none" OR stristr($proxy_host,"proxy") OR $proxy0 == $proxy_host)) {
    $display_page = abget_template($ab_config['proxy_reason']);
    $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL." ".$ab_config['version_number']." "._AB_BYNSN."</div>\n</body>", $display_page);
    die($display_page);
  }
}

# Check if ip is blocked
$blocked_row = abget_blocked($nsnst_const['remote_ip']);
if($blocked_row) { blocked($blocked_row); }

# Check if range is blocked
$blockedrange_row = abget_blockedrange($nsnst_const['remote_ip']);
if($blockedrange_row) { blockedrange($blockedrange_row); }

# AUTHOR Protection
$blocker_row = $blocker_array['author'];
if($blocker_row['activate'] > 0) {
  if(isset($op)) {
      if(($op=="mod_authors" OR $op=="modifyadmin" OR $op=="UpdateAuthor" OR $op=="AddAuthor" OR $op=="deladmin2" OR $op=="deladmin" OR $op=="assignstories" OR $op=="deladminconf") AND !is_god($admin)) {
        block_ip($blocker_row);
      }
  }
}

# ADMIN protection
$blocker_row = $blocker_array['admin'];
if($blocker_row['activate'] > 0) {
  if(stristr($_SERVER['PHP_SELF'],$admin_file.".php") AND ($op!="logout" AND $op!="login" AND $op!="adminMain" AND $op!="gfx" AND isset($op)) AND !is_admin()) {
    block_ip($blocker_row);
  }
}

# Check for UNION attack
# Copyright 2004(c) Raven PHP Scripts
/*****[BEGIN]******************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
function union_check($item) {
    global $blocker_array;
    $blocker_row = $blocker_array['union'];
    if($blocker_row['activate'] > 0) {
      #if (stristr($item,'+union+') OR stristr($item,'%20union%20') OR stristr($item,'*/union/*') OR stristr($item,' union ') OR stristr($item,'/union/') OR stristr($item,'=union%20') OR stristr($item,'=union ')) {
      if (preg_match(REGEX_UNION, $item)) {
        block_ip($blocker_row);
      }
    }
}
union_check($nsnst_const['request_string'].$nsnst_const['request_string_base64']);
/*****[END]********************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/

# Check for CLIKE attack
# Copyright 2004(c) Raven PHP Scripts
$blocker_row = $blocker_array['clike'];
if($blocker_row['activate'] > 0) {
  if(stristr($nsnst_const['query_string'],'/*')
     OR stristr($nsnst_const['query_string_base64'],'/*')
     OR stristr($nsnst_const['query_string'],'*/')
     OR stristr($nsnst_const['query_string_base64'],'*/')) {
    block_ip($blocker_row);
  }
}

# Check Filters
$blocker_row = $blocker_array['filter'];
if($blocker_row['activate'] > 0) {
  # Check for Forum attack
  # Copyright 2004(c) GanjaUK & ChatServ
  if (!stristr($nsnst_const['query_string'],'&file=nickpage') AND  stristr($nsnst_const['query_string'],'&user=') AND
  ($name=="Private_Messages" || $name=="Forums" || $name=="Members_List")) {
    block_ip($blocker_row);
  }
  # Check for News attack
  # Copyright 2004(c) ChatServ
  if (stristr($nsnst_const['query_string'],'%25') AND ($name=="News" || $name=="Reviews")) {
    block_ip($blocker_row);
  }
  if (string_bypass('feed=news') && string_bypass('name=gallery2')) {
      # Check for XSS attack
      if ( ((stristr($nsnst_const['query_string'], "http://") || stristr($nsnst_const['query_string'], "https://")) && substr($_SERVER['REQUEST_URI'],0,strlen("/index.php?url=")) != '/index.php?url=') OR
      (stristr($nsnst_const['query_string'], "cmd=") AND !stristr($nsnst_const['query_string'], "&cmd")) OR
      (stristr($nsnst_const['query_string'], "exec") AND !stristr($nsnst_const['query_string'], "execu")) OR
      stristr($nsnst_const['query_string'],"concat") AND
      !stristr($nsnst_const['query_string'], "../")) {
        block_ip($blocker_row);
      }
  }
}

/*if(!is_admin() && string_bypass('feed=news') && string_bypass('name=gallery2')) {
  # Check for SCRIPTING attack
  # Copyright 2004(c) ChatServ
  $blocker_row = $blocker_array['script'];
  if($blocker_row['activate'] > 0) {
    foreach($_GET as $sec_key => $secvalue) {
      if((eregi("<[^>]script*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]*object*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]*iframe*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]*applet*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]*meta*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]style*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]*form*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]*img*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]*onmouseover*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]body*\"?[^>]*>", $secvalue) && !eregi("<[^>]tbody*\"?[^>]*>", $secvalue)) ||
      (eregi("\([^>]*\"?[^)]*\)", $secvalue)) ||
      (eregi("\"", $secvalue)) ||
      (eregi("forum_admin", $sec_key)) ||
      (eregi("inside_mod", $sec_key))) {
        block_ip($blocker_row);
      }
    }
    foreach($_POST as $secvalue) {
      if ((eregi("<[^>]*iframe*\"?[^>]*", $secvalue)) ||
      (eregi("<[^>]*object*\"?[^>]*", $secvalue)) ||
      (eregi("<[^>]*applet*\"?[^>]*", $secvalue)) ||
      (eregi("<[^>]*meta*\"?[^>]*", $secvalue)) ||
      (eregi("<[^>]*onmouseover*\"?[^>]*", $secvalue)) ||
      (eregi("<[^>]script*\"?[^>]*", $secvalue)) ||
      (eregi("<[^>]body*\"?[^>]*>", $secvalue) && !eregi("<[^>]tbody*\"?[^>]*>", $secvalue)) ||
      (eregi("<[^>]style*\"?[^>]*", $secvalue))) {
        block_ip($blocker_row);
      }
    }
  }
}*/

# Check for Referer
$blocker_row = $blocker_array['referer'];
if($blocker_row['activate'] > 0) {
  $referer_request = '/'.$_SERVER['REQUEST_METHOD'].$_SERVER['REQUEST_URI'];
  if($blocker_row['list'] > "") {
    $RefererList = explode("\r\n",$blocker_row['list']);
    for ($i=0; $i < count($RefererList); $i++) {
      $refered = $RefererList[$i];
      if (stristr($nsnst_const['referer'], $refered) AND !empty($refered)) {
        block_ip($blocker_row, $refered);
      }
    }
  }
}

# Check for Harvester
$blocker_row = $blocker_array['harvester'];
if($blocker_row['activate'] > 0) {
  if($blocker_row['list'] > "") {
    $HarvestList = explode("\r\n",$blocker_row['list']);
    for ($i=0; $i < count($HarvestList); $i++) {
      $harvest = $HarvestList[$i];
      if (stristr($nsnst_const['user_agent'], $harvest) AND !empty($harvest)) {
        block_ip($blocker_row, $harvest);
      }
    }
  }
}

# Check for Strings
$blocker_row = $blocker_array['string'];
if($blocker_row['activate'] > 0) {
  if($ab_config['list_string'] > "") {
    $StringList = explode("\r\n", $ab_config['list_string']);
    for ($i=0; $i < count($StringList); $i++) {
      $stringl = $StringList[$i];
      if (stristr($nsnst_const['query_string'], $stringl) OR stristr($nsnst_const['request_string'], $stringl) AND !empty($stringl)) {
		block_ip($blocker_row, $stringl);
      }
    }
  }
}

# Check for Request
$blocker_row = $blocker_array['request'];
if($blocker_row['activate'] > 0) {
  if($blocker_row['list'] > "") {
    $RequestList = explode("\r\n",$blocker_row['list']);
    for ($i=0; $i < count($RequestList); $i++) {
      $request = $RequestList[$i];
      if (stristr($nsnst_const['request_method'], $request) AND !empty($request)) {
        block_ip($blocker_row, $request);
      }
    }
  }
}

# Force to NUKEURL
if($ab_config['force_nukeurl'] == 1 AND !defined('RSS_FEED')) {
  $servtemp1 = strtolower(str_replace("http://", "", $nukeurl));
  if(substr($servtemp1, -1) == "/") { $servtemp1 = substr($servtemp1, 0, strlen($servtemp1)-1); }
  $servrqst1 = strtolower($_SERVER['HTTP_HOST']);
  if($pos = strpos($servtemp1, '/')){ $servtemp1 = substr($servtemp1,0,$pos); }
  if ($servrqst1 != $servtemp1 AND (!defined('FORUM_ADMIN') AND !stristr($_SERVER['REQUEST_URI'], "abuse/"))) {
    $rphp1 = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $rphp2 = str_replace($servrqst1, $servtemp1, $rphp1);
    $rphp2 = "http://".$rphp2;
    redirect("$rphp2");
  }
}

# IP Tracking
# CAUTION: This function can slow your sites load time
if($ab_config['track_active'] == 1 AND !is_excluded($nsnst_const['remote_ip'])) {
  if(!empty($nsnst_const['post_string'])) {
    $pg = $nsnst_const['script_name']."?".$nsnst_const['post_string'];
  } elseif(!empty($nsnst_const['get_string'])) {
    $pg = $nsnst_const['script_name']."?".$nsnst_const['get_string'];
  } elseif(!empty($nsnst_const['query_string'])) {
    $pg = $nsnst_const['script_name']."?".$nsnst_const['query_string'];
  } else {
    $pg = $nsnst_const['script_name'];
  }
  $pg = preg_replace('/&(password|user_password|upassword|pass|upass|user_pass|vpass|pwd|new_pass|name)2?(confirm)?(_confirm)?=\w*/i','',$pg);

  if($pg != "/rss.php" AND $pg != '/modules.php' AND !stristr($pg, "op=gfx")) {
    $result = $db->sql_query("SELECT ip_lo FROM `".$prefix."_nsnst_ip2country` LIMIT 0,1");
    $checkrow = $db->sql_numrows($result);
    $db->sql_freeresult($result);
    if($checkrow > 0) {
       $tresult = $db->sql_query("SELECT `c2c` FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`<='".$nsnst_const['remote_long']."' AND `ip_hi`>='".$nsnst_const['remote_long']."'");
       $checkrow = $db->sql_numrows($tresult);
       if($checkrow > 0) {
          list($c2c) = $db->sql_fetchrow($tresult);
       }
       $db->sql_freeresult($tresult);
    }
    if(!isset($c2c)) { $c2c = "00"; }
    if($nsnst_const['ban_user_id']==1) { $nsnst_const['ban_username2'] = ""; } else { $nsnst_const['ban_username2'] = $nsnst_const['ban_username']; }
	$refered_from = htmlentities ($nsnst_const['referer'], ENT_QUOTES);
      if (!get_magic_quotes_runtime()) {
        $ban_username2 = addslashes($nsnst_const['ban_username2']);
        $user_agent = addslashes($nsnst_const['user_agent']);
        $pg = addslashes($pg);
		$refered_from = addslashes($refered_from);
      }
    $db->sql_query("INSERT INTO `".$prefix."_nsnst_tracked_ips` (`user_id`, `username`, `date`, `ip_addr`, `ip_long`, `page`, `user_agent`, `refered_from`, `x_forward_for`, `client_ip`, `remote_addr`, `remote_port`, `request_method`, `c2c`) VALUES ('".addslashes($nsnst_const['ban_user_id'])."', '$ban_username2', '".addslashes($nsnst_const['ban_time'])."', '".addslashes($nsnst_const['remote_ip'])."', '".addslashes($nsnst_const['remote_long'])."', '$pg', '$user_agent', '$refered_from', '".addslashes($nsnst_const['forward_ip'])."', '".addslashes($nsnst_const['client_ip'])."', '".addslashes($nsnst_const['remote_addr'])."', '".addslashes($nsnst_const['remote_port'])."', '".addslashes($nsnst_const['request_method'])."', '$c2c')");
	$db->sql_freeresult($result);
    $clearedtime = strtotime(date("Y-m-d", $nsnst_const['ban_time']));
    $cleartime = strtotime(date("Y-m-d", $nsnst_const['ban_time']));
    if($ab_config['track_max'] > 0 AND $ab_config['track_clear'] < $cleartime) {
      $ab_config['track_del'] = $cleartime - $ab_config['track_max'];
      $db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `date` < ".$ab_config['track_del']);
      $result = $db->sql_query("UPDATE `".$prefix."_nsnst_config` SET `config_value`='$clearedtime' WHERE `config_name`='track_clear'");
      $db->sql_freeresult($result);
      #$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
    }
  }
}

/*******************************/
/* BEGIN FUNCTIONS             */
/*******************************/

function get_env($st_var) {
  global $HTTP_SERVER_VARS;

  if(isset($_SERVER[$st_var])) {
    return $_SERVER[$st_var];
  } elseif(isset($_ENV[$st_var])) {
    return $_ENV[$st_var];
  } elseif(isset($HTTP_SERVER_VARS[$st_var])) {
    return $HTTP_SERVER_VARS[$st_var];
  } elseif(getenv($st_var)) {
    return getenv($st_var);
  } elseif(function_exists('apache_getenv') && apache_getenv($st_var, true)) {
    return apache_getenv($st_var, true);
  }
  return "";
}

function get_remote_port() {
  if(get_env("REMOTE_PORT")) {
    return get_env("REMOTE_PORT");
  }
  return "none";
}

function get_request_method() {
  if(get_env("REQUEST_METHOD")) {
    return get_env("REQUEST_METHOD");
  }
  return "none";
}

function get_script_name() {
  if(get_env("SCRIPT_NAME")) {
    return get_env("SCRIPT_NAME");
  }
  return "none";
}

function get_http_host() {
  if(get_env("HTTP_HOST")) {
    return get_env("HTTP_HOST");
  }
  return "none";
}

function get_query_string() {
  if(get_env("QUERY_STRING")) {
    return str_replace("%09", "%20", get_env("QUERY_STRING"));
  }
  return "none";
}

function st_clean_string($cleanstring) {
  $st_fr1 = array("%00", "%01", "%02", "%03", "%04", "%05", "%06", "%07", "%08", "%09", "%10", "%11", "%12", "%13", "%14", "%15", "%16", "%17", "%18", "%19", "%20", "%21", "%22", "%23", "%24", "%25", "%26", "%27", "%28", "%29", "%30", "%31", "%32", "%33", "%34", "%35", "%36", "%37", "%38", "%39", "%40", "%41", "%42", "%43", "%44", "%45", "%46", "%47", "%48", "%49", "%50", "%51", "%52", "%53", "%54", "%55", "%56", "%57", "%58", "%59", "%60", "%61", "%62", "%63", "%64", "%65", "%66", "%67", "%68", "%69", "%70", "%71", "%72", "%73", "%74", "%75", "%76", "%77", "%78", "%79");
  $st_to1 = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", " ", "!", "\"", "#", "$", "%", "&", "'", "(", ")", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "@", "A", "B", "C", "D", "E", "F", "G", "H", "I", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "`", "a", "b", "c", "d", "e", "f", "g", "h", "i", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y");
  $st_fr2 = array("%0A", "%0B", "%0C", "%0D", "%0E", "%0F", "%1A", "%1B", "%1C", "%1D", "%1E", "%1F", "%2A", "%2B", "%2C", "%2D", "%2E", "%2F", "%3A", "%3B", "%3C", "%3D", "%3E", "%3F", "%4A", "%4B", "%4C", "%4D", "%4E", "%4F", "%5A", "%5B", "%5C", "%5D", "%5E", "%5F", "%6A", "%6B", "%6C", "%6D", "%6E", "%6F", "%7A", "%7B", "%7C", "%7D", "%7E", "%7F", "%0a", "%0b", "%0c", "%0d", "%0e", "%0f", "%1a", "%1b", "%1c", "%1d", "%1e", "%1f", "%2a", "%2b", "%2c", "%2d", "%2e", "%2f", "%3a", "%3b", "%3c", "%3d", "%3e", "%3f", "%4a", "%4b", "%4c", "%4d", "%4e", "%4f", "%5a", "%5b", "%5c", "%5d", "%5e", "%5f", "%6a", "%6b", "%6c", "%6d", "%6e", "%6f", "%7a", "%7b", "%7c", "%7d", "%7e", "%7f");
  $st_to2 = array("", "", "", "", "", "", "", "", "", "", "", "", "*", "+", ",", "-", ".", "/", ":", ";", "<", "=", ">", "?", "J", "K", "L", "M", "N", "O", "Z", "[", "\\", "]", "^", "_", "j", "k", "l", "m", "n", "o", "z", "{", "|", "}", "~", "", "", "", "", "", "", "", "", "", "", "", "", "", "*", "+", ",", "-", ".", "/", ":", ";", "<", "=", ">", "?", "J", "K", "L", "M", "N", "O", "Z", "[", "\\", "]", "^", "_", "j", "k", "l", "m", "n", "o", "z", "{", "|", "}", "~", "");
  $cleanstring = str_replace($st_fr1, $st_to1, $cleanstring);
  $cleanstring = str_replace($st_fr2, $st_to2, $cleanstring);
  return $cleanstring;
}

/*****[BEGIN]******************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
function get_request_string($mode='request') {
  $ST_POST = ($mode == 'request') ? $_REQUEST : ( ($mode == 'post') ? $_POST : $_GET );
  $ignore = array('message', 'subject', 'bodytext', 'hometext', 'add_title', 'add_content', 'title', 'content', 'notes');
  $poststring = "";
  foreach ($ST_POST as $postkey => $postvalue) {
    if(!in_array(strtolower($postkey),$ignore)) {
	 $poststring .= (!empty($poststring) ? "&" : "") .$postkey."=".$postvalue;
    }
  }
  return str_replace("%09", "%20", $poststring);
}
/*****[END]********************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/

function get_user_agent() {
  if(get_env("HTTP_USER_AGENT")) {
    return get_env("HTTP_USER_AGENT");
  }
  return "none";
}

function get_referer() {
  global $nuke_config;
  if(get_env("HTTP_REFERER")) {
    if(stristr(get_env("HTTP_REFERER"), $nuke_config['nukeurl'])) {
      return "on site";
    } elseif(stristr(get_env("HTTP_REFERER"), "http://localhost") || stristr(get_env("HTTP_REFERER"), "http://127.0.") || stristr(get_env("HTTP_REFERER"), "http://192.168.") || stristr(get_env("HTTP_REFERER"), "http://10.") || stristr(get_env("HTTP_REFERER"), "file://")) {
      return "local link";
    }
    return get_env("HTTP_REFERER");
  }
  return "none";
}

function get_server_ip () {
  if(get_env("SERVER_ADDR")) {
    return get_env("SERVER_ADDR");
  }
  return "none";
}

function get_client_ip () {
  if(get_env("HTTP_CLIENT_IP")) {
    return get_env("HTTP_CLIENT_IP");
  } elseif(get_env("HTTP_VIA")) {
    return get_env("HTTP_VIA");
  } elseif(get_env("HTTP_X_COMING_FROM")) {
    return get_env("HTTP_X_COMING_FROM");
  } elseif(get_env("HTTP_COMING_FROM")) {
    return get_env("HTTP_COMING_FROM");
  }
  return "none";
}

function get_x_forwarded () {
  if(get_env("HTTP_X_FORWARDED_FOR")) {
    return get_env("HTTP_X_FORWARDED_FOR");
  } elseif(get_env("HTTP_X_FORWARDED")) {
    return get_env("HTTP_X_FORWARDED");
  } elseif(get_env("HTTP_FORWARDED_FOR")) {
    return get_env("HTTP_FORWARDED_FOR");
  } elseif(get_env("HTTP_FORWARDED")) {
    return get_env("HTTP_FORWARDED");
  }
  return "none";
}

function get_remote_addr () {
  if(get_env("REMOTE_ADDR")) {
    return get_env("REMOTE_ADDR");
  }
  return "none";
}

function clear_session(){
  global $prefix, $db, $nsnst_const;
  # Clear nuke_session location
  $x_forwarded = $nsnst_const['forward_ip'];
  $client_ip = $nsnst_const['client_ip'];
  $remote_addr = $nsnst_const['remote_addr'];
  $db->sql_query("DELETE FROM `".$prefix."_session` WHERE `host_addr`='$x_forwarded' OR `host_addr`='$client_ip' OR `host_addr`='$remote_addr'");
  # Clear nuke_bbsessions location
  $x_f = explode(".", $x_forwarded);
  $x_forwarded = str_pad(dechex($x_f[0]), 2, "0", STR_PAD_LEFT).str_pad(dechex($x_f[1]), 2, "0", STR_PAD_LEFT).str_pad(dechex($x_f[2]), 2, "0", STR_PAD_LEFT).str_pad(dechex($x_f[3]), 2, "0", STR_PAD_LEFT);
  $c_p = explode(".", $client_ip);
  $client_ip = str_pad(dechex($c_p[0]), 2, "0", STR_PAD_LEFT).str_pad(dechex($c_p[1]), 2, "0", STR_PAD_LEFT).str_pad(dechex($c_p[2]), 2, "0", STR_PAD_LEFT).str_pad(dechex($c_p[3]), 2, "0", STR_PAD_LEFT);
  $r_a = explode(".", $remote_addr);
  $remote_addr = str_pad(dechex($r_a[0]), 2, "0", STR_PAD_LEFT).str_pad(dechex($r_a[1]), 2, "0", STR_PAD_LEFT).str_pad(dechex($r_a[2]), 2, "0", STR_PAD_LEFT).str_pad(dechex($r_a[3]), 2, "0", STR_PAD_LEFT);
  $db->sql_query("DELETE FROM `".$prefix."_bbsessions` WHERE `session_ip`='$x_forwarded' OR `session_ip`='$client_ip' OR `session_ip`='$remote_addr'");
}

function is_excluded($rangeip){
  global $prefix, $db;
  $longip = sprintf("%u", ip2long($rangeip));
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_excluded_ranges` WHERE `ip_lo`<='$longip' AND `ip_hi`>='$longip'");
  $excludenum = $db->sql_fetchrow($result);
  $db->sql_freeresult($result);
  if($excludenum > 0) { return 1; } else { return 0; }
  return 0;
}

function is_protected($rangeip){
  global $prefix, $db;
  $longip = sprintf("%u", ip2long($rangeip));
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` WHERE `ip_lo`<='$longip' AND `ip_hi`>='$longip'");
  $protectnum = $db->sql_fetchrow($result);
  $db->sql_freeresult($result);
  if($protectnum > 0) { return 1; } else { return 0; }
  return 0;
}

function is_reserved($rangeip) {
  global $db, $prefix;
  $rangelong = sprintf("%u", ip2long($rangeip));
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE (`ip_lo`<='$rangelong' AND `ip_hi`>='$rangelong') AND `c2c`='01'");
  $rangenum = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  if($rangenum > 0) { return 1; } else { return 0; }
  return 0;
}

function abget_blocked($remoteip){
  global $prefix, $db;
  static $blocked_row;
  if(isset($blocked_row)) { return $blocked_row; }
  $ip = explode(".", $remoteip);
  $ip[0] = (isset($ip[0])) ? intval($ip[0]) : '';
  $ip[1] = (isset($ip[1])) ? intval($ip[1]) : '';
  $ip[2] = (isset($ip[2])) ? intval($ip[2]) : '';
  $ip[3] = (isset($ip[3])) ? intval($ip[3]) : '';
  $testip1 = "$ip[0].*.*.*";
  $testip2 = "$ip[0].$ip[1].*.*";
  $testip3 = "$ip[0].$ip[1].$ip[2].*";
  $testip4 = "$ip[0].$ip[1].$ip[2].$ip[3]";
  $blocked_result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr` = '$testip1' OR `ip_addr` = '$testip2' OR `ip_addr` = '$testip3' OR `ip_addr` = '$testip4'");
  $blocked_row = $db->sql_fetchrow($blocked_result);
  $db->sql_freeresult($blocked_result);
  return $blocked_row;
}

function abget_blockedrange($remoteip){
  global $prefix, $db;
  static $blockedrange_row;
  if (isset($blockedrange_row)) { return $blockedrange_row; }
  $longip = sprintf("%u", ip2long($remoteip));
  $blockedrange_result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`<='$longip' AND `ip_hi`>='$longip'");
  $blockedrange_row = $db->sql_fetchrow($blockedrange_result);
  $db->sql_freeresult($blockedrange_result);
  return $blockedrange_row;
}

function abget_blocker($blocker_name){
    global $prefix, $db, $cache;
    if(($blocker_array = $cache->load('blockers', 'sentinel')) === false) {
        $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` ORDER BY `blocker`");
        $num_rows = $db->sql_numrows($result);
        for ($i = 0; $i < $num_rows; $i++) {
            $row = $db->sql_fetchrow($result);
            $blockernametemp = $row['block_name'];
            $blocker_array[$blockernametemp] = $row;
        }
        $db->sql_freeresult($result);
        $cache->save('blockers', 'sentinel', $blocker_array);
    }
    return $blocker_array[$blocker_name];
}

function abget_blockerrow($reason){
  global $prefix, $db, $cache;
  if(($blocker_row = $cache->load($reason, 'sentinel')) === false) {
      $blockerresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='$reason'");
      $blocker_row = $db->sql_fetchrow($blockerresult);
      $cache->save($reason, 'sentinel', $blocker_row);
      $db->sql_freeresult($blockerresult);
  }
  return $blocker_row;
}

function abget_admin($author){
  global $prefix, $db;
  if (preg_match(REGEX_UNION, $author)) { block_ip($blocker_array[1]); }
  if (preg_match(REGEX_UNION, base64_decode($author))) { block_ip($blocker_array[1]); }
  $author = $db->sql_escapestring($author);
  $adminresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` WHERE `aid`='$author'");
  $admin_row = $db->sql_fetchrow($adminresult);
  $db->sql_freeresult($adminresult);
  return $admin_row;
}

function abget_config($config_name){
  global $prefix, $db;
  static $abget_config;
  if (isset($abget_config)) { return $abget_config; }
  $configresult = $db->sql_query("SELECT `config_value` FROM `".$prefix."_nsnst_config` WHERE `config_name`='$config_name'");
  list($abget_config) = $db->sql_fetchrow($configresult);
  $db->sql_freeresult($configresult);
  return $abget_config;
}

function abget_configs(){
  global $prefix, $db, $cache;
  static $sentinel;
  if(isset($sentinel)) return $sentinel;
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
  if(($sentinel = $cache->load('sentinel', 'config')) === false) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
      $configresult = $db->sql_query("SELECT `config_name`, `config_value` FROM `".$prefix."_nsnst_config`");
      while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
        $sentinel[$config_name] = $config_value;
      }
      $db->sql_freeresult($configresult);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
      $cache->save('sentinel', 'config', $sentinel);
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
  }
  return $sentinel;
}

function abget_reason($reason_id){
  global $prefix, $db;
  $reasonresult = $db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='$reason_id'");
  list($reason) = $db->sql_fetchrow($reasonresult);
  $db->sql_freeresult($reasonresult);
  return $reason;
}

function write_ban($banip, $htip, $blocker_row) {
  global $ab_config, $db, $prefix, $admin, $nsnst_const;
  if(isset($admin) && !empty($admin)) {
      $abadmin = st_clean_string(base64_decode($admin));
      if (preg_match(REGEX_UNION, $abadmin)) { block_ip($blocker_array[1]); }
      if (preg_match(REGEX_UNION, base64_decode($abadmin))) { block_ip($blocker_array[1]); }
    if(!is_array($admin)) {
      $abadmin = explode(":", $abadmin);
      $a_aid = addslashes($abadmin[0]);
    } else {
      $a_aid = addslashes($admin[0]);
    }
  }
  $admin_row = abget_admin($a_aid);
  if((!isset($admin) || empty($admin)) || $admin_row['protected'] < 1) {
    if(($blocker_row['activate'] > 3 AND $blocker_row['activate'] < 6) OR $blocker_row['activate'] > 7) {
      if($blocker_row['duration'] > 0) {
        $abexpires = $blocker_row['duration'] + $nsnst_const['ban_time'];
      } else {
        $abexpires = 0;
      }
      if(!empty($nsnst_const['query_string']) && $nsnst_const['query_string'] > "") {
        $query_url = $nsnst_const['query_string'];
      } else {
        $query_url = _AB_NOTAVAILABLE;
      }
      if(!empty($nsnst_const['get_string']) && $nsnst_const['get_string'] > "") {
        $get_url = $nsnst_const['get_string'];
      } else {
        $get_url = _AB_NOTAVAILABLE;
      }
      if(!empty($nsnst_const['post_string']) && $nsnst_const['post_string'] > "") {
        $post_url = $nsnst_const['post_string'];
      } else {
        $post_url = _AB_NOTAVAILABLE;
      }
      $addby = _AB_ADDBY." "._AB_NUKESENTINEL;
      $querystring = base64_encode($query_url);
      $getstring = base64_encode($get_url);
      $poststring = base64_encode($post_url);
      $checkrow = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country`"));
      if($checkrow > 0) {
         list($c2c) = $db->sql_fetchrow($db->sql_query("SELECT `c2c` FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`<='".$nsnst_const['remote_long']."' AND `ip_hi`>='".$nsnst_const['remote_long']."'"));
      }
      if(!$c2c) { $c2c = "00"; }
      if (!get_magic_quotes_runtime()) {
        $addby = addslashes($addby);
        $ban_username = addslashes($nsnst_const['ban_username']);
        $user_agent = addslashes($nsnst_const['user_agent']);
      }
      $bantemp = str_replace("*", "0", $banip);
      $banlong = sprintf("%u", ip2long($bantemp));
      $db->sql_query("INSERT INTO `".$prefix."_nsnst_blocked_ips` VALUES ('$banip', '$banlong', '".addslashes($nsnst_const['ban_user_id'])."', '$ban_username', '$user_agent', '".addslashes($nsnst_const['ban_time'])."', '$addby', '".addslashes($blocker_row['blocker'])."', '$querystring', '$getstring', '$poststring', '".addslashes($nsnst_const['forward_ip'])."', '".addslashes($nsnst_const['client_ip'])."', '".addslashes($nsnst_const['remote_addr'])."', '".addslashes($nsnst_const['remote_port'])."', '".addslashes($nsnst_const['request_method'])."', '$abexpires', '$c2c')");
      if (!empty($ab_config['htaccess_path']) AND $blocker_row['htaccess'] > 0 AND file_exists($ab_config['htaccess_path'])) {
        $ipfile = file($ab_config['htaccess_path']);
        $ipfile = implode("", $ipfile);
        if(!stristr($ipfile, $htip)) {
          $doit = @fopen($ab_config['htaccess_path'], "a");
          @fwrite($doit, $htip);
          @fclose($doit);
        }
      }
    }
  }
}

function write_mail($banip, $blocker_row, $abmatch="") {
  global $ab_config, $nuke_config, $db, $prefix, $user_prefix, $nsnst_const;
  if($blocker_row['activate'] > 0 AND $blocker_row['activate'] < 6) {
    $admincontact = explode("\r\n", $ab_config['admin_contact']);
    if(!empty($nsnst_const['query_string']) && $nsnst_const['query_string'] > "") {
      $query_url = $nsnst_const['query_string'];
    } else {
      $query_url = _AB_NOTAVAILABLE;
    }
    if(!empty($nsnst_const['get_string']) && $nsnst_const['get_string'] > "") {
      $get_url = $nsnst_const['get_string'];
    } else {
      $get_url = _AB_NOTAVAILABLE;
    }
    if(!empty($nsnst_const['post_string']) && $nsnst_const['post_string'] > "") {
      $post_url = $nsnst_const['post_string'];
    } else {
      $post_url = _AB_NOTAVAILABLE;
    }
    $subject = _AB_BLOCKEDFROM." ".$banip;
    $message  = _AB_CREATEDBY.": "._AB_NUKESENTINEL." ".$ab_config['version_number']."\n";
    $message .= _AB_DATETIME.": ".date("Y-m-d H:i:s T \G\M\T O",$nsnst_const['ban_time'])."\n";
    $message .= _AB_IPBLOCKED.": ".$banip."\n";
    $message .= _AB_USERID.": ".$nsnst_const['ban_username']." (".$nsnst_const['ban_user_id'].")\n";
    $message .= _AB_REASON.": ".$blocker_row['reason']."\n";
    if($abmatch != "") { $message .= _AB_MATCH.": ".$abmatch."\n"; }
    $message .= "--------------------\n";
    $message .= _AB_REFERER.": ".$nsnst_const['referer']."\n";
    $message .= _AB_USERAGENT.": ".$nsnst_const['user_agent']."\n";
    $message .= _AB_HTTPHOST.": ".$nsnst_const['http_host']."\n";
    $message .= _AB_SCRIPTNAME.": ".$nsnst_const['script_name']."\n";
    $message .= _AB_QUERY.": ".$query_url."\n";
    $message .= _AB_GET.": ".$get_url."\n";
    $message .= _AB_POST.": ".$post_url."\n";
    $message .= _AB_X_FORWARDED.": ".$nsnst_const['forward_ip']."\n";
    $message .= _AB_CLIENT_IP.": ".$nsnst_const['client_ip']."\n";
    $message .= _AB_REMOTE_ADDR.": ".$nsnst_const['remote_addr']."\n";
    $message .= _AB_REMOTE_PORT.": ".$nsnst_const['remote_port']."\n";
    $message .= _AB_REQUEST_METHOD.": ".$nsnst_const['request_method']."\n";
    if ($blocker_row['email_lookup'] == 1) {
      $message .= "--------------------\n"._AB_WHOISFOR."\n";
      # Copyright 2004(c) Raven PHP Scripts
      if(!@file_get_contents("http://ws.arin.net/cgi-bin/whois.pl?queryinput=".$nsnst_const['remote_ip'])) {
        $msg = ('Unable to query WhoIs information for '.$nsnst_const['remote_ip'].'.');
      } else {
        $data = @file_get_contents("http://ws.arin.net/cgi-bin/whois.pl?queryinput=".$nsnst_const['remote_ip']);
        $data = explode('Search results for: ',$data);
        $data = explode('#',$data[1]);
        $data = explode('(NET-',strip_tags($data[0]));
        if (empty($data[1])) $msg .= $data[0];
        else {
          $data = explode(')',$data[1]);
          if(!@file_get_contents("http://ws.arin.net/cgi-bin/whois.pl?queryinput="."!%20NET-".strip_tags($data[0]))) {
            $data = 'Unable to query WhoIs information for '.strip_tags($data[0]).'.';
          } else {
            $data = @file_get_contents("http://ws.arin.net/cgi-bin/whois.pl?queryinput="."!%20NET-".strip_tags($data[0]));
            $data = explode('Search results for: ',$data);
            $data = explode('Name',$data[1],2);
            $data = explode('# ARIN WHOIS ',$data[1]);
          }
          $msg .= 'OrgName'.nl2br($data[0]);
        }
      }
      $message .= strip_tags($msg);
    } elseif ($blocker_row['email_lookup'] == 2) {
      $message .= "--------------------\n";
      # Copyright 2004(c) NukeScripts
      /*if(!@file_get_contents("http://dnsstuff.com/tools/whois.ch?ip=".$nsnst_const['remote_ip'])) {
        $data = 'Unable to query WhoIs information for '.$nsnst_const['remote_ip'].'.';
      } else {
        $data = @file_get_contents("http://dnsstuff.com/tools/whois.ch?email=on&ip=".$nsnst_const['remote_ip']);
        $data = str_replace("</H1><H5>", "\n", $data);
        $data = str_replace("status = \"Getting WHOIS results...\";", "\n", $data);
        $data = str_replace("status = \"Done!\";", "\n", $data);
      }
      $message .= strip_tags($data);*/
    }
    for($i=0, $maxi=count($admincontact); $i < $maxi; $i++) {
      $adminmail = $nuke_config['adminmail'];
      @evo_mail($admincontact[$i], $subject, $message,"From: $admincontact[$i]\r\nX-Mailer: "._AB_NUKESENTINEL);
    }
  }
}

function block_ip($blocker_row, $abmatch="") {
  global $ab_config, $nuke_config, $db, $prefix, $user_prefix, $nsnst_const;
  if(!is_protected($nsnst_const['remote_ip'])) {
    $ip = explode(".", $nsnst_const['remote_ip']);
    clear_session();
    $nsnst_const['ban_ip'] = "$ip[0].$ip[1].$ip[2].$ip[3]";
    $testip1 = "$ip[0].*.*.*";
    $testip1p = "deny from $ip[0]\n";
    $resultag1 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$testip1'");
    $numag1 = $db->sql_numrows($resultag1);
    if ($numag1 == 0 AND $blocker_row['block_type'] == 3) {
      write_mail($testip1, $blocker_row, $abmatch);
      write_ban($testip1, $testip1p, $blocker_row);
      $nsnst_const['ban_ip'] = $testip1;
    } elseif ($numag1 == 0 AND $blocker_row['block_type'] < 3) {
      $testip2 = "$ip[0].$ip[1].*.*";
      $testip2p = "deny from $ip[0].$ip[1]\n";
      $resultag2 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$testip2'");
      $numag2 = $db->sql_numrows($resultag2);
      if ($numag2 == 0 AND $blocker_row['block_type'] == 2) {
        write_mail($testip2, $blocker_row, $abmatch);
        write_ban($testip2, $testip2p, $blocker_row);
        $nsnst_const['ban_ip'] = $testip2;
      } elseif ($numag2 == 0 AND $blocker_row['block_type'] < 2) {
        $testip3 = "$ip[0].$ip[1].$ip[2].*";
        $testip3p = "deny from $ip[0].$ip[1].$ip[2]\n";
        $resultag3 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$testip3'");
        $numag3 = $db->sql_numrows($resultag3);
        if ($numag3 == 0 AND $blocker_row['block_type'] == 1) {
          write_mail($testip3, $blocker_row, $abmatch);
          write_ban($testip3, $testip3p, $blocker_row);
          $nsnst_const['ban_ip'] = $testip3;
        } elseif ($numag3 == 0 AND $blocker_row['block_type'] < 1) {
          $testip4 = "$ip[0].$ip[1].$ip[2].$ip[3]";
          $testip4p = "deny from $ip[0].$ip[1].$ip[2].$ip[3]\n";
          $resultag4 = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$testip4'");
          $numag4 = $db->sql_numrows($resultag4);
          if ($numag4 == 0 AND $blocker_row['block_type'] == 0) {
            write_mail($testip4, $blocker_row, $abmatch);
            write_ban($testip4, $testip4p, $blocker_row);
            $nsnst_const['ban_ip'] = $testip4;
          }
        }
      }
    }
    $blocked_row = abget_blocked($nsnst_const['ban_ip']);
    blocked($blocked_row, $blocker_row);
    die();
  } else {
    return;
  }
}

function is_god($admin) {
  global $db, $prefix, $aname;
  static $GodSave;
  if(isset($GodSave)) return $GodSave;
  $tmpadm = st_clean_string(base64_decode($admin));
  if (preg_match(REGEX_UNION, $tmpadm)) { block_ip($blocker_array[1]); }
  if (preg_match(REGEX_UNION, base64_decode($tmpadm))) { block_ip($blocker_array[1]); }
  if(!is_array($admin)) {
    $tmpadm = base64_decode($admin);
    $tmpadm = explode(":", $tmpadm);
    $aname = $tmpadm[0];
    $apwd = $tmpadm[1];
  } else {
    $aname = $admin[0];
    $apwd = $admin[1];
  }
  if (!empty($aname) AND !empty($apwd)) {
    $aname = trim($aname);
    $apwd = trim($apwd);
    $aname = Fix_Quotes($aname);
    $admrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_authors` WHERE `aid`='$aname'"));
    #if((strtolower($admrow['name']) == "god" OR $admrow['radminsuper'] == 1) AND $admrow['pwd']==$apwd) { return $GodSave = 1; }
    if(strtolower($admrow['name']) == "god" AND $admrow['pwd']==$apwd) { return $GodSave = 1; }
  }
  return $GodSave = 0;
}

function abget_template($template="") {
  global $sitename, $adminmail, $ab_config, $nsnst_const, $db, $prefix, $ip, $abmatch;
  if (!empty($template) && preg_match('/\.php/', $template)) $template = '';
  if(empty($template)) { $template = "abuse_default.tpl"; }
  #$sitename = $nuke_config['sitename'];
  #$adminmail = $nuke_config['adminmail'];
  $adminmail = str_replace("@", "(at)", $adminmail);
  $adminmail = str_replace(".", "(dot)", $adminmail);
  $adminmail2 = urlencode($adminmail);
  $querystring = get_query_string();
  $filename = NUKE_INCLUDE_DIR."nukesentinel/abuse/".$template;
  if(!file_exists($filename)) { $filename = NUKE_INCLUDE_DIR."nukesentinel/abuse/abuse_default.tpl"; }
  $handle = @fopen($filename, "r");
  $display_page = fread($handle, filesize($filename));
  @fclose($handle);

  $display_page = str_replace("__MATCH__", $abmatch, $display_page);
  $display_page = str_replace("__SITENAME__", $sitename, $display_page);
  $display_page = str_replace("__ADMINMAIL1__", $adminmail, $display_page);
  $display_page = str_replace("__ADMINMAIL2__", $adminmail2, $display_page);
  $display_page = str_replace("__REMOTEPORT__", htmlentities($nsnst_const['remote_port']), $display_page);
  $display_page = str_replace("__REQUESTMETHOD__", htmlentities($nsnst_const['request_method']), $display_page);
  $display_page = str_replace("__SCRIPTNAME__", htmlentities($nsnst_const['script_name']), $display_page);
  $display_page = str_replace("__HTTPHOST__", htmlentities($nsnst_const['http_host']), $display_page);
  $display_page = str_replace("__USERAGENT__", htmlentities($nsnst_const['user_agent']), $display_page);
  $display_page = str_replace("__CLIENTIP__", htmlentities($nsnst_const['client_ip']), $display_page);
  $display_page = str_replace("__FORWARDEDFOR__", htmlentities($nsnst_const['forward_ip']), $display_page);
  $display_page = str_replace("__REMOTEADDR__", htmlentities($nsnst_const['remote_addr']), $display_page);
  # New fields for use in display pages
  $display_page = str_replace("__QUERYSTRING__", htmlentities($nsnst_const['query_string']), $display_page);
  $display_page = str_replace("__GETSTRING__", htmlentities($nsnst_const['get_string']), $display_page);
  $display_page = str_replace("__POSTSTRING__", htmlentities($nsnst_const['post_string']), $display_page);
  $display_page = str_replace("__REFERER__", htmlentities($nsnst_const['referer']), $display_page);
  $display_page = str_replace("__BANTIME__", htmlentities($nsnst_const['ban_time']), $display_page);
  $display_page = str_replace("__BANUSERID__", htmlentities($nsnst_const['ban_user_id']), $display_page);
  $display_page = str_replace("__BANUSERNAME__", htmlentities($nsnst_const['ban_username']), $display_page);
  $display_page = str_replace("__REMOTEIP__", htmlentities($nsnst_const['remote_ip']), $display_page);
  $display_page = str_replace("__REMOTELONG__", htmlentities($nsnst_const['remote_long']), $display_page);

  return $display_page;
}

function blocked($blocked_row="", $blocker_row="") {
  global $nuke_config, $ab_config, $nsnst_const, $db, $prefix;
  $ip = explode(".", $nsnst_const['remote_ip']);
  if(!$nsnst_const['ban_time'] OR empty($nsnst_const['ban_time'])) { $nsnst_const['ban_time'] = time(); }
  if(empty($blocked_row)) { $blocked_row = abget_blocked($ip); }
  if(empty($blocked_row)) { $blocked_row['reason'] = 0; $blocked_row['date'] = time(); }
  if(empty($blocker_row)) { $blocker_row = abget_blockerrow($blocked_row['reason']); }
  if(($blocker_row['activate'] == 2 OR $blocker_row['activate'] == 4 OR $blocker_row['activate'] == 6 OR $blocker_row['activate'] == 8) AND !empty($blocker_row['forward'])) {
    header("Location: ".$blocker_row['forward']);
    die();
  } elseif($blocker_row['activate'] == 3 OR $blocker_row['activate'] == 5 OR $blocker_row['activate'] == 7 OR $blocker_row['activate'] == 9) {
    $display_page = abget_template($blocker_row['template']);
    $display_page = str_replace("__TIMEDATE__", date("Y-m-d \@ H:i:s T \G\M\T O", $blocked_row['date']), $display_page);
    if($blocked_row['expires']>0) {
      $display_page = str_replace("__DATEEXPIRES__", date("Y-m-d \@ H:i:s T \G\M\T O", $blocked_row['expires']), $display_page);
    } elseif(isset($blocked_row['expires'])) {
      $display_page = str_replace("__DATEEXPIRES__", _AB_PERMENANT, $display_page);
    } else {
      $display_page = str_replace("__DATEEXPIRES__", _AB_UNKNOWN, $display_page);
    }
    $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL." ".$ab_config['version_number']." "._AB_BYNSN."</div>\n</body>", $display_page);
    die($display_page);
  } else {
    $display_page = abget_template();
    $display_page = str_replace("__TIMEDATE__", date("Y-m-d \@ H:i:s T \G\M\T O", time()), $display_page);
    if($blocked_row['expires']>0) {
      $display_page = str_replace("__DATEEXPIRES__", date("Y-m-d \@ H:i:s T \G\M\T O", $blocked_row['expires']), $display_page);
    } else {
      $display_page = str_replace("__DATEEXPIRES__", _AB_PERMENANT, $display_page);
    }
    $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL." ".$ab_config['version_number']." "._AB_BYNSN."</div>\n</body>", $display_page);
    die($display_page);
  }
}

function blockedrange($blockedrange_row="") {
  global $nuke_config, $ab_config, $nsnst_const, $db, $prefix;
  $ip = explode(".", $nsnst_const['remote_ip']);
  if(!$nsnst_const['ban_time'] OR empty($nsnst_const['ban_time'])) { $nsnst_const['ban_time'] = time(); }
  if(empty($blockedrange_row)) { $blockedrange_row = abget_blockedrange($nsnst_const['remote_ip']); }
  if(empty($blockedrange_row)) { $blockedrange_row['reason'] = 0; $blockedrange_row['date'] = time(); }
  if(empty($blocker_row)) { $blocker_row = abget_blockerrow($blockedrange_row['reason']); }
  if(($blocker_row['activate'] == 2 OR $blocker_row['activate'] == 4 OR $blocker_row['activate'] == 6) AND !empty($blocker_row['forward'])) {
    header("Location: ".$blocker_row['forward']);
    die();
  } elseif($blocker_row['activate'] == 3 OR $blocker_row['activate'] == 5 OR $blocker_row['activate'] == 7) {
    $display_page = abget_template($blocker_row['template']);
    $display_page = str_replace("__TIMEDATE__", date("Y-m-d \@ H:i:s T \G\M\T O", $blockedrange_row['date']), $display_page);
    if($blockedrange_row['expires']>0) {
      $display_page = str_replace("__DATEEXPIRES__", date("Y-m-d \@ H:i:s T \G\M\T O", $blockedrange_row['expires']), $display_page);
    } elseif(isset($blockedrange_row['expires'])) {
      $display_page = str_replace("__DATEEXPIRES__", _AB_PERMENANT, $display_page);
    } else {
      $display_page = str_replace("__DATEEXPIRES__", _AB_UNKNOWN, $display_page);
    }
    $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL." ".$ab_config['version_number']." "._AB_BYNSN."</div>\n</body>", $display_page);
    die($display_page);
  } else {
    $display_page = abget_template();
    $display_page = str_replace("__TIMEDATE__", date("Y-m-d \@ H:i:s T \G\M\T O", time()), $display_page);
    if($blockedrange_row['expires']>0) {
      $display_page = str_replace("__DATEEXPIRES__", date("Y-m-d \@ H:i:s T \G\M\T O", $blockedrange_row['expires']), $display_page);
    } else {
      $display_page = str_replace("__DATEEXPIRES__", _AB_PERMENANT, $display_page);
    }
    $display_page = preg_replace("/<\/body>/i", "<hr noshade='noshade' />\n<div align='right'>"._AB_NUKESENTINEL." ".$ab_config['version_number']." "._AB_BYNSN."</div>\n</body>", $display_page);
    die($display_page);
  }
}

function ABGetCIDRs($long_lo, $long_hi) {
  global $masscidr, $prefix, $db;
  $chosts = ($long_hi - $long_lo) + 1;
  $testrst = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_cidrs` ORDER BY `hosts` DESC");
  $cidrs = $hosts = $masks = "";
  while($test = $db->sql_fetchrow($testrst)) {
    if($chosts >= $test['hosts']) {
      $cidrs = $test['cidr']."||".$cidrs;
      $hosts = $test['hosts']."||".$hosts;
      $masks = $test['mask']."||".$masks;
      $chosts = $chosts - $test['hosts'];
    }
  }
  $cidrs = rtrim($cidrs, "||");
  $hosts = rtrim($hosts, "||");
  $masks = rtrim($masks, "||");
  $cidrsary = explode("||", $cidrs);
  $hostsary = explode("||", $hosts);
  $masksary = explode("||", $masks);
  $masscidr = "";
  $nextcidr = $long_lo;
  for($i=0, $maxi=count($cidrsary); $i<$maxi; $i++) {
    $tempcidr = long2ip($nextcidr)."/".$cidrsary[$i];
    $masscidr = $masscidr.$tempcidr."||";
    $nextcidr = $nextcidr + $hostsary[$i];
  }
  $masscidr = rtrim($masscidr, "||");
  return $masscidr;
}

function ab_flood($blocker_row) {
  global $ab_config, $nsnst_const;
  $_sessid = session_id();
  $_sessnm = session_name();
  $currtime = time();
  $floodarray = file($ab_config['ftaccess_path']);
  $floodcount = count($floodarray);
  $floodopen = fopen($ab_config['ftaccess_path'], "w");
  foreach($floodarray as $floodwrite){
    if ($floodcount-10>=0) if(!strstr($floodwrite, $floodarray[$floodcount-10]))
    fputs($floodopen, $floodwrite);
  }
  $p1 = explode(' || ', $floodarray[$floodcount-1]);
  $p2 = explode(' || ', $floodarray[$floodcount-3]);
  if($p1["2"] - $p2["2"] <= $ab_config['flood_delay']) {
    if($p1["1"] != $p2["1"]) {
      if($p1["0"] == $p2["0"]) {
        if($nsnst_const['remote_ip'] == $p1["0"] && $p2["0"]) {
          block_ip($blocker_row);
        }
      }
    }
  }
  if($_SESSION["NSNST_Flood"] > time() - $ab_config['flood_delay']){
    $floodappend = fopen($ab_config['ftaccess_path'], "a");
    fwrite($floodappend, $nsnst_const['remote_ip']." || $_sessid || $currtime || $_sessnm\n");
  }
  fclose($floodopen);
}

/** From phpMyAdmin v2.6
 * Gets advanced authentication settings
 *
 * @global  string    the username if register_globals is on
 * @global  string    the password if register_globals is on
 * @global  array     the array of server variables if register_globals is
 *                    off
 * @global  array     the array of environment variables if register_globals
 *                    is off
 * @global  string    the username for the ? server
 * @global  string    the password for the ? server
 * @global  string    the username for the WebSite Professional server
 * @global  string    the password for the WebSite Professional server
 * @global  string    the username of the user who logs out
 *
 * @return  boolean   whether we get authentication settings or not
 *
 * @access  public
 */
function PMA_auth_check() {
  global $PHP_AUTH_USER, $PHP_AUTH_PW;
  global $REMOTE_USER, $AUTH_USER, $REMOTE_PASSWORD, $AUTH_PASSWORD;
  global $HTTP_AUTHORIZATION;

  # Grabs the $PHP_AUTH_USER variable whatever are the values of the
  # 'register_globals' and the 'variables_order' directives
  # loic1 - 2001/25/11: use the new globals arrays defined with php 4.1+
  if (empty($PHP_AUTH_USER)) {
    if (!empty($_SERVER) && isset($_SERVER['PHP_AUTH_USER'])) {
      $PHP_AUTH_USER = $_SERVER['PHP_AUTH_USER'];
    } else if (isset($REMOTE_USER)) {
      $PHP_AUTH_USER = $REMOTE_USER;
    } else if (!empty($_ENV) && isset($_ENV['REMOTE_USER'])) {
      $PHP_AUTH_USER = $_ENV['REMOTE_USER'];
    } else if (@getenv('REMOTE_USER')) {
      $PHP_AUTH_USER = getenv('REMOTE_USER');
    # Fix from Matthias Fichtner for WebSite Professional - Part 1
    } else if (isset($AUTH_USER)) {
      $PHP_AUTH_USER = $AUTH_USER;
    } else if (!empty($_ENV) && isset($_ENV['AUTH_USER'])) {
      $PHP_AUTH_USER = $_ENV['AUTH_USER'];
    } else if (@getenv('AUTH_USER')) {
      $PHP_AUTH_USER = getenv('AUTH_USER');
    }
  }
  # Grabs the $PHP_AUTH_PW variable whatever are the values of the
  # 'register_globals' and the 'variables_order' directives
  # loic1 - 2001/25/11: use the new globals arrays defined with php 4.1+
  if (empty($PHP_AUTH_PW)) {
    if (!empty($_SERVER) && isset($_SERVER['PHP_AUTH_PW'])) {
      $PHP_AUTH_PW = $_SERVER['PHP_AUTH_PW'];
    } else if (isset($REMOTE_PASSWORD)) {
      $PHP_AUTH_PW = $REMOTE_PASSWORD;
    } else if (!empty($_ENV) && isset($_ENV['REMOTE_PASSWORD'])) {
      $PHP_AUTH_PW = $_ENV['REMOTE_PASSWORD'];
    } else if (@getenv('REMOTE_PASSWORD')) {
      $PHP_AUTH_PW = getenv('REMOTE_PASSWORD');
    # Fix from Matthias Fichtner for WebSite Professional - Part 2
    } else if (isset($AUTH_PASSWORD)) {
      $PHP_AUTH_PW = $AUTH_PASSWORD;
    } else if (!empty($_ENV) && isset($_ENV['AUTH_PASSWORD'])) {
      $PHP_AUTH_PW = $_ENV['AUTH_PASSWORD'];
    } else if (@getenv('AUTH_PASSWORD')) {
      $PHP_AUTH_PW = getenv('AUTH_PASSWORD');
    }
  }
  # Gets authenticated user settings with IIS
  if (empty($PHP_AUTH_USER) && empty($PHP_AUTH_PW)
    && function_exists('base64_decode')) {
    if (!empty($HTTP_AUTHORIZATION)
      && substr($HTTP_AUTHORIZATION, 0, 6) == 'Basic ') {
      list($PHP_AUTH_USER, $PHP_AUTH_PW) = explode(':', base64_decode(substr($HTTP_AUTHORIZATION, 6)));
    } else if (!empty($_ENV)
      && isset($_ENV['HTTP_AUTHORIZATION'])
      && substr($_ENV['HTTP_AUTHORIZATION'], 0, 6) == 'Basic ') {
      list($PHP_AUTH_USER, $PHP_AUTH_PW) = explode(':', base64_decode(substr($_ENV['HTTP_AUTHORIZATION'], 6)));
    } else if (@getenv('HTTP_AUTHORIZATION')
      && substr(getenv('HTTP_AUTHORIZATION'), 0, 6) == 'Basic ') {
      list($PHP_AUTH_USER, $PHP_AUTH_PW) = explode(':', base64_decode(substr(getenv('HTTP_AUTHORIZATION'), 6)));
    }
  } # end IIS

  # Returns whether we get authentication settings or not
  if (empty($PHP_AUTH_USER)) {
    return FALSE;
  } else {
    if (get_magic_quotes_runtime()) {
      $PHP_AUTH_USER = stripslashes($PHP_AUTH_USER);
      $PHP_AUTH_PW = stripslashes($PHP_AUTH_PW);
    }
    return TRUE;
  }
} # end of the 'PMA_auth_check()' function

/*********************************************************************************************/
/* HTTP Auth code for ".$admin_file.".php protection.  Tried to make it a function call      */
/* but there are too many variables that would have to be globalized.                        */
/* Copyright 2004(c) Raven                                                                   */
/*********************************************************************************************/
if(ini_get("register_globals")) {
  $sapi_name = strtolower(php_sapi_name());
  $apass = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` WHERE `password_md5`=''"));
  if($apass > 0 AND $ab_config['http_auth'] == 1) {
    require_once(NUKE_ADMIN_MODULE_DIR."nukesentinel/functions.php");
    absave_config("http_auth",'0');
	$db->sql_freeresult($apass);
  }

  if($ab_config['http_auth'] == 1 AND strpos($sapi_name,"cgi")===FALSE) {
    if (basename($_SERVER['PHP_SELF'], '.php')==$admin_file) {
      $allowPassageToAdmin = FALSE;
      $authresult = $db->sql_query("SELECT `login`, `password_md5` FROM `".$prefix."_nsnst_admins`");
      while ($getauth = $db->sql_fetchrow($authresult)) {
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        if ($PHP_AUTH_USER==$getauth['login'] AND md5($PHP_AUTH_PW)==trim($getauth['password_md5'])) {
          $allowPassageToAdmin = TRUE;
          break;
        }
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
      }
      if (!$allowPassageToAdmin) {
        header("WWW-Authenticate: Basic realm=Protected by NukeSentinel(tm)");
        header("HTTP/1.0 401 Unauthorized");
        die(_AB_GETOUT);
      }
    }
  }
}

?>