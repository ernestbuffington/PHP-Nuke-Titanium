<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Submissions Block
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : block-Submissions.php
   Author        : Quake
   Version       : 2.0.0
   Date          : 09/02/2006 (dd-mm-yyyy)

   Notes         : Overview about submissions and other useful information
                   about your website.
************************************************************************/

if(!defined('NUKE_EVO')) exit;

$content = '';

if (is_admin()) {

      global $currentlang;
      
	  if (file_exists(NUKE_LANGUAGE_DIR.'custom/lang-'.$currentlang.'.php')) 
          include_once(NUKE_LANGUAGE_DIR.'custom/lang-'.$currentlang.'.php');
	  else 
          include_once(NUKE_LANGUAGE_DIR.'custom/lang-english.php');

      $handle = opendir(NUKE_MODULES_DIR);

      while(false !== ($module = readdir($handle))) 
	  {
          if (is_active($module) && file_exists("modules/$module/admin/wait.php")) 
              $submissions[$module] = "modules/$module/admin/wait.php";
      }
      closedir($handle);

      if(is_array($submissions)) 
	  {
          ksort($submissions);
      
	      foreach($submissions as $module => $file) 
		  {
              require_once($file);
          }
      }

} 
else 
{
      $content .="<center><strong>"._ADMIN_BLOCK_DENIED."</strong></center>";
}

?>