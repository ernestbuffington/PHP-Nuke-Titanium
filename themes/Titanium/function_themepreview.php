<?php
/*----------------------------------------------------------------*/
/* THEME INFO                                                     */
/* Titanium Theme v1.0 (Fixed & Full Width)                       */
/*                                                                */
/* A Very Nice Black Carbin Fiber Styled Design.                  */
/* Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington       */
/* e-Mail : ernest.buffington@gmail.com                           */
/*----------------------------------------------------------------*/
/* CREATION INFO                                                  */
/* Created On: 1st August, 2019 (v1.0)                            */
/*                                                                */
/* Updated On: 1st August, 2019 (v3.0)                            */
/* HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)   */
/*                                                                */
/* Read CHANGELOG File for Updates & Upgrades Info                */
/*                                                                */
/* Designed By: TheGhost                                          */
/* Web Site: https://theghost.86it.us                             */
/* Purpose: PHP-Nuke Titanium v3.0.0                              */
/*----------------------------------------------------------------*/
/* CMS INFO                                                       */
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi phpnuke.org     */
/* Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System      */
/*----------------------------------------------------------------*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
/*--------------------------*/
/* 
/*--------------------------*/
function themepreview($title, $hometext, $bodytext='', $notes='') 
{
echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
echo (!empty($bodytext)) ? '<br /><br />'.$bodytext : '';
echo (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>' : '';
}
?>