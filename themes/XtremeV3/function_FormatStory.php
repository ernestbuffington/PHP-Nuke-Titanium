<?php
#---------------------------------------------------------------------------------------#
# function FormatStory                                                                  #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# CarbinFiber Theme v1.0 (Fixed & Full Width)                                           #
#                                                                                       #
# Final Build Date 08/17/2019 Saturday 7:40pm                                           #
#                                                                                       #
# A Very Nice Black Carbin Fiber Styled Design.                                         #
# Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington                              #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 1st August, 2019 (v1.0)                                                   #
#                                                                                       #
# Updated On: 1st August, 2019 (v3.0)                                                   #
# HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)                          #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost                                                                 #
# Web Site: https://theghost.86it.us                                                    #
# Purpose: PHP-Nuke Titanium | Xtreme Evo                                               #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# PHP-Nuke Titanium (c) 2019 : Enhanced PHP-Nuke Web Portal System                      #
#---------------------------------------------------------------------------------------#

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');
	
/*--------------------------*/
/* function FormatStory
/*--------------------------*/
function FormatStory($thetext, $notes, $aid, $informant) 
{
global $anonymous;

$notes = !empty($notes) ? '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>' : '';	
if ($aid == $informant) 
{
   echo '<span class="content" color="#505050">'.$thetext.$notes.'</span>';
} 
else 
{
   if (defined('WRITES')) 
   {
      if (!empty($informant)) 
      {
         if ( is_array($informant) ):
            $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a>';
         else:
            $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>';
         endif;
} 
else 
{
            $boxstuff = $anonymous.' ';
      }
            $boxstuff .= _WRITES.' <em>'.$thetext.'</em>'.$notes;
} 
else 
{
            $boxstuff .= $thetext . $notes;
      }
      echo '<span class="content" color="#505050">' . $boxstuff . '</span>';
   }
}
?>
