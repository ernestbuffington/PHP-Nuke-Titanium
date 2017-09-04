<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/inc/strings.php
 PHP-Nuke Titanium Module              :   Uploads
 PHP-Nuke Titanium File Release Date   :   September 4th, 2017  
 PHP-Nuke Tianium File Author          :   Ernest Allen Buffington

 PHP-Nuke Titanium web address         :   https://titanium.86it.network
 
 PHP-Nuke Titanium is licensed under GNU General Public License v3.0

 PHP-Nuke Titanium is Copyright(c) 2002 to 2017 by Ernest Allen Buffington
 of Sebastian Enterprises. 
 
 ernest.buffington@gmail.com
 Att: Sebastian Enterprises
 1071 Emerald Dr,
 Brandon, Florida 33511
 ========================================================================
 GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
 Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 Everyone is permitted to copy and distribute verbatim copies
 of this license document, but changing it is not allowed.       
 ========================================================================
 
 /*****[CHANGES]**********************************************************
  The Nuke-Evo Base Engine : v2.1.0 RC3 dated May 4th, 2009 is what we
  used to build our new content management system. To find out more
  about the starting core engine before we modified it please refer to 
  the Nuke Evolution website. http://www.nuke-evolution.com
   
  This file was re-written for PHP-Nuke Titanium and all modifications
  were done by Ernest Allen Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is written for Social Networking and uses a centralized 
  database that is chained to The Scorpion Network & The 86it Social Network

  It is not intended for single user platforms and has the requirement of
  remote database access to https://the.scorpion.network and 
  https://www.86it.us which is a new Social Networking System designed by 
  Ernest Buffington that requires a FEDERATED MySQL engine in order to 
  function at all.
  
  The federated database concept was created in the 1980's and has been
  available a very long time. In fact it was a part of MySQL before they
  ever started to document it. There is not much information available
  about using a FEDERATED engine and a lot of the documention is not very
  complete with regard to every detail; it is superficial and partial to
  say thge least. 
  
  The core engine from Nuke Evolution was used to create 
  PHP-Nuke Titanium. Almost all versions of PHP-Nuke were unstable and not 
  very secure. We have made it so that it is enhanced and advanced!
  
  PHP-Nuke Titanium is now a secure custom FORK of the ORIGINAL PHP-Nuke
  that was purchased by Ernest Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is not backward compatible to any of the prior versions of
  PHP-Nuke, Nuke-Evoltion or Nuke-Evo.
  
  The module framework of PHP-Nuke is the only thing that still functions 
  in the same way that Francis Burzi had intended and even that had to be
  safer and more secure to be a reliable form of internet communications.
  
 ************************************************************************
 * PHP-NUKE: Advanced Content Management System                         *
 * ============================================                         *
 * Copyright (c) 2002 by Francisco Burzi                                *
 * http://phpnuke.org                                                   *
 *                                                                      *
 * This program is free software. You can redistribute it and/or modify *
 * it under the terms of the GNU General Public License as published by *
 * the Free Software Foundation; either version 2 of the License.       *
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
// ***************************************
// ** FILE:    STRINGS.PHP              **
// ** PURPOSE: DIV. GENERAL TOOLS       **
// ** DATE:    18.01.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// ************************************************
function instr($haystack,$needle,$ignoreCase=false)
// ************************************************
{
    // BEI ARRAY NEEDLE: KOMMEN WIRKLICH ALLE ELEMENTE IM NEEDLE ARRAY IN HAYSTACK VOR ?
    if (is_array($needle))
    {
        $anz    = count($needle);

        for ($i=0;$i<$anz;$i++)
        {
            if ($ignoreCase) { if (!(instr(strtolower($haystack),strtolower($needle[$i])))) return false; }
            else             { if (!(instr($haystack,$needle[$i]))) return false; }
        }
    }

    // STANDARDVERGLEICH: IST NEEDLE IN HAYSTACK VORHANDEN ?
    else
    {

        if ( (strlen($haystack)>0) and (strlen($needle)>0) )
        {
            if ($ignoreCase)	$pos = stripos($haystack, $needle);
            else				$pos =  strpos($haystack,$needle);

            if ($pos === false)  return false;
        }
        else
        return false;
    }

    return true;
}

/**
 * @return integer
 * @desc Gibt Anzahl numerischer Zeichen im Uebergabestring zurueck.
*/
function anz_numeric($myString)
// **************************
{
    // URSPRUNGSLAENGE ABZUEGLICH LAENGE OHNE NUMERISCHE ZEICHEN IST ANZAHL DIESER
    $len1 = strlen($myString);
    $len2 = strlen(str_replace(array("0","1","2","3","4","5","6","7","8","9"),"",$myString));
    return ($len1-$len2);
}

/**
 * RETURN ONLY NUMERIC VALUES OF A VARIOUS STRING
 *
 * @param  String $myVal
 * @return (numeric) String
 */
function onlyNumeric($myVal)
{
    $retVal   = "";

    $myValLen = strlen($myVal);

    for($i=0;$i<$myValLen;$i++) if (is_numeric($myVal[$i]))  $retVal .= $myVal[$i];

    return $retVal;
}

/**
 * RETURNS ALL ASCII NUMBERS OF ALL CHARS IN AN ARRAY
 * FOR ANALYSIS & TEST ONLY
 *
 * @param string    $myStr
 * @param int       $limit
 * @return          string
 */
function string_char_codes($myStr,$limit=0)
// ***************************************************
{
    $retVal = "";

    if (($limit==0)||($limit>strlen($myStr)))  $limit = strlen($myStr);

    for ($i=0;$i<$limit;$i++)
    {
        $retVal .= "Char[".$i."]=".ord($myStr[$i]).", ";
    }

    if ($retVal!="") return substr($retVal,0,-2);
    else             return false;
}

/*
* STRING FUNCTION - SUBSTITUTE PLACEHOLDERS
* REPLACE MULTIPLE OCCURENCES OF SAME PLACEHOLDER WITH DIFFERENT SUBSTITUTES IN ORDER
*
* @param string  $subject
* @param mixed   $replace
* @param string  $placeholder
* @param int     $limit
* @return unknown

EXAMPLE: echo sts("Der ### ist ### und ###.",array("Baer Bruno","braun","schwer"),"",3);
*/
function sts($subject,$replace="",$placeholder="###",$limit=0)
// ************************************************************************************
{
    $retVal = "";

    if ($placeholder=="") $placeholder = "###";

    if ($subject!="")
    {
        $retVal = $subject;

        if ((!is_array($replace))&&($replace!="")) $replace = array($replace);

        if (is_array($replace))
        {
            $cur_pos = strpos($retVal,$placeholder);
            $i = 0;

            while ((!($cur_pos===false))&&(array_key_exists($i,$replace))&&(($i<$limit)||($limit==0)))
            {
                $retVal = preg_replace("/".$placeholder."/",$replace[$i],$retVal,1);  // IMMER 1 PLACEHOLDER ERSETZEN
                $cur_pos = strpos($retVal,$placeholder);
                $i++;
            }
        }
    }

    return $retVal;
}

/**
* RETURNS FIRST LINK IN A STRING IF EXISTS
*
* @param string $myText
*/
function getURL($myText,$urlPrefix="http",$last=false)
// ************************************************************************************
{
    // WICHTIG FALLS VOR ODER NACH URL EIN STEUERZEICHEN UND KEIN BLENK ALLE MIT BLENK ERSETZEN
    $myText = str_replace(array("\n","\t","\r","\v","\f",chr(9),chr(10),chr(12),chr(13))," ",$myText);

    if (instr($myText,$urlPrefix))
    {
        if (!$last) $pos  =  strpos($myText, $urlPrefix);
        else        $pos  = strrpos($myText, $urlPrefix);

        $pos2 = strpos($myText," ",($pos+strlen($urlPrefix)));

        if ($pos2===false)  return substr($myText,$pos);                // BIS ZUM ENDE
        else                return substr($myText,$pos,($pos2-$pos));   // BIS ZUM ERSTEN BLENK
    }

    return false;
}

/**
  * REPLACE ALL URLS IN A TEXT WITH LINK SHORTCUTS OR ICONS ETC.
  *
  * @param unknown_type $myText
  * @param unknown_type $substitute
  */
function substitueURLs($myText,$substitute="Link...",$urlPrefix="http")
{
    $retVal     = $myText;
    $amEnde     = false;
    $tempMarker = "|+++++|";
    $durchlauf  = 1;

    // echo_pre(string_char_codes($myText));

    while ((!$amEnde)&&($durchlauf<9999))
    {
        // URLS UMSETZEN IN WEB LINK ICONS
        $urlFound = getURL($retVal,$urlPrefix);

        if ($urlFound)
        {
            // IN RUECKGABE DEN LINKSUBSTITUTE EINBAUEN UND SUBSTITUTE UNKENNTLICH MACHEN IN DIESEM TEIL
            // DAMIT DIESER NICHT MEHR REPLACED WIRD, GILT AUCH FÜR SUBSTITUTE DER EIN BILD MIT HTTP TAG SEIN KANN
            $retVal = str_replace($urlFound,"<a href='".
            str_replace($urlPrefix,$tempMarker,$urlFound)."' target=_blank>".
            str_replace($urlPrefix,$tempMarker,$substitute)."</a>",$retVal);
        }
        else
        $amEnde = true;

        $durchlauf++;
    }

    return str_replace($tempMarker,$urlPrefix,$retVal);
}
?>