<?php
#---------------------------------------------------------------------------------------#
# HEADER NAVIGATION SYSTEM                                                              #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Blue Skulls Theme v1.0 (Fixed & Full Width)                                           #
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

#------------------------------------#
# CSS Drop-Down Navigation System v3 #
#------------------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){ exit('Access Denied');}

global $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $user_prefix, $userinfo, $admin, $admin_file, $ThemeInfo;

########################
# DO NOT EDIT THIS LINE
#####################################################################################################################
echo '<div id="cssmenu" class="align-center">';
echo '<ul>';
#####################################################################################################################

//echo '<li class="active"><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>';
echo '<li class="has-sub"><a href="index.php"><i class="fa fa-fw fa-home"></i> HOME</a>';
echo '<ul>';
echo '<li><a href="modules.php?name=Web_Links"> Web Links</a></li>';
echo '<li><a href="modules.php?name=Surveys"> Surveys</a></li>';
echo '<li><a href="modules.php?name=ECalendar"> ECalendar</a></li>';
echo '<li><a href="modules.php?name=Members_List"> Member List</a></li>';
echo '<li><a href="modules.php?name=Feedback"> Feedback</a></li>';
echo '<li><a href="modules.php?name=Link_Us"> Link Us</a></li>';
echo '<li><a href="modules.php?name=Content"> Content</a></li>';
echo '<li><a href="modules.php?name=Docs"> Docs</a></li>';
echo '<li><a href="modules.php?name=Donations"> Donations</a></li>';
echo '<li><a href="modules.php?name=FAQ"> FAQ</a></li>';
echo '<li><a href="modules.php?name=Supporters"> Supporters</a></li>';
echo '<li><a href="modules.php?name=NukeSentinel"> Sentinel</a></li>';
echo '<li><a href="modules.php?name=FAQ"> FAQ</a></li>';

echo '</ul>';
echo '</li>';
######################################################################################################################
echo '<li class="has-sub"><a href="modules.php?name=News"><i class="fa fa-fw fa-object-group"></i> BLOGS</a>';
echo '<ul>';
echo '<li><a href="modules.php?name=Topics">Blog Topics</a></li>';
echo '<li><a href="modules.php?name=Stories_Archive">Blog Archives</a></li>';
echo '<li><a href="modules.php?name=Top">Top 10 Blogs</a></li>';
echo '<li><a href="modules.php?name=Submit_News">SUBMIT BLOG</a></li>';
echo '</ul>';
echo '</li>';
#######################################################################################################################
echo '<li class="has-sub"><a href="modules.php?name=Forums"><i class="fa fa-fw fa-object-group"></i> FORUMS</a>';
echo '<ul>';
echo '<li><a href="modules.php?name=Forums&amp;file=search">Forum Search</a></li>';
echo '<li><a href="modules.php?name=Forums&amp;file=search&amp;search_id=newposts">New Posts</a></li>';
echo '<li><a href="modules.php?name=Forums&amp;file=search&amp;search_id=unanswered">Unanswered Posts</a></li>';
echo '<li><a href="modules.php?name=Forums&amp;file=search&amp;search_id=egosearch">View My Posts</a></li>';
echo '</ul>';
echo '</li>';
#######################################################################################################################
if (!is_user()) 
{
 //   evouserinfo_login();
} 
else 
{

   echo '<li class="has-sub"><a href="modules.php?name=File_Repository"><i class="fa fa-fw fa-file"></i> DOWNLOADS</a>';
   echo '<ul>';

   echo '<li><a href="modules.php?name=File_Repository">Main Downloads</a></li>';
   echo '<li><a href="modules.php?name=File_Repository&action=newdownloads">New Downloads</a></li>';
   echo '<li><a href="modules.php?name=File_Repository&action=submitdownload">Upload Files</a></li>';
   echo '<li><a href="modules.php?name=File_Repository&action=mostpopular">HOT Downloads</a></li>';
   echo '</ul>';
   echo '</li>';

#################################################################################################################
//echo '<li><a href="modules.php?name=Image_Repository"><i class="fa fa-fw fa-image"></i> IMAGE HOST</a></li>';
}

#################################################################################################################
if (is_user()) 
{
echo '<li class="has-sub"><a href="#"><i class="fa fa-fw fa-bars"></i> MY LINKS</a>';
echo '<ul>';
echo '<li><a href="modules.php?name=Private_Messages"><i class="fa fa-fw fa-object-group"></i> My Inbox</a></li>';
echo '<li><a href="modules.php?name=Groups"><i class="fa fa-fw fa-object-group"></i> My Groups</a></li>';
echo '<li><a href="modules.php?name=Image_Repository"><i class="fa fa-fw fa-image"></i> My Image Files</a></li>';
echo '<li><a href="modules.php?name=Network_Bookmarks"><i class="fa fa-fw fa-object-group"></i> My Bookmarks</a></li>';
echo '<li><a href="modules.php?name=Profile&mode=editprofile"><i class="fa fa-fw fa-object-group"></i> Edit My Profile</a></li>';
echo '<li><a href="modules.php?name=Your_Account&op=chgtheme"><i class="fa fa-fw fa-object-group"></i> Change My Theme</a></li>';
echo '<li><a href="modules.php?name=Advertising"><i class="fa fa-fw fa-object-group"></i> Advertise on 86it</a></li>';


echo '</ul>';
echo '</li>';
}

if (is_mod_admin('super'))
{
echo '<li class="has-sub"><a href="admin.php#"><i class="fa fa-fw fa-bars"></i> ADMIN LINKS</a>';
echo '<ul>';
echo '<li><a href="admin.php?op=adminStory"><i class="fa fa-fw fa-object-group"></i> New Blog</a></li>';
echo '<li><a href="admin.php?op=topicsmanager"><i class="fa fa-fw fa-object-group"></i> New Blog Topic</a></li>';
echo '<li><a href="admin.php?op=AddCategory"><i class="fa fa-fw fa-object-group"></i> New Blog Cat</a></li>';
echo '<li><a href="admin.php?op=modules"><i class="fa fa-fw fa-object-group"></i> Edit Modules</a></li>';
echo '<li><a href="admin.php?op=newsletter"><i class="fa fa-fw fa-object-group"></i> Write News Letter</a></li>';


echo '<li><a href="modules.php?name=Arcade_Tweaks"><i class="fa fa-fw fa-object-group"></i> Arcade Admin</a></li>';


echo '<li><a href="modules.php?name=cPanel_Login"><i class="fa fa-fw fa-object-group"></i> cPanel Login</a></li>';

echo '<li><a href="admin.php?op=ABDBOptimize"><i class="fa fa-fw fa-object-group"></i> Optimize Database</a></li>';
echo '</ul>';
echo '</li>';
}

echo '<li>'.(( !is_user() ) ? '<a href="modules.php?name=Your_Account&op=new_user"><i class="fa fa-fw fa-registered"></i> REGISTER NEW ACCOUNT</a>' : '<a href="modules.php?name=Your_Account"><i class="fa fa-fw fa-registered"></i> MY ACCOUNT</a>').'</li>';
echo '</ul>';
echo '</div>';
?>
