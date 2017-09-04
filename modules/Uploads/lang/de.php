<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/lang/de.php
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

// ********************************
// PHFTP - GERMAN LANGUAGE STRINGS
// ********************************
// CHECK ONLY THE SECOND VALUE IN EACH LINE, THE FIRST REPRESENTS THE TERM ID
// PLACEHOLDER FOR ALL SYSTEM VARIABLES IS ###
// KEEP TERMS SHORT AND CONCISE, MASK SPECIAL CHARACTERS WITH HTML ENTITIES
// http://www.w3schools.com/tags/ref_entities.asp


$al = array(
"anonymous"=>"Anonymes FTP",
"chmod"=>"CHMOD Datei/Verzeichnis",
"chmodfail"=>"CHMOD nicht erfolgreich.",
"chmodsuccess"=>"CHMOD ### auf ### erfolgreich.",
"clientinfo"=>"Client Info",
"confirmdeldir"=>"L&ouml;schen von folgenden Verzeichnissen:",
"confirmdelfile"=>"L&ouml;schen von folgenden Dateien:",
"connect"=>"verbinden",
"connection"=>"Verbindung",
"credir"=>"Verzeichn. erstellen",
"deldir"=>"Verzeichn. l&ouml;schen",
"delfile"=>"Datei l&ouml;schen",
"dirchanged"=>"Verzeichnis gewechselt.",
"dircreated"=>"Verzeichnis erstellt.",
"dircreatedfail"=>"Verzeichnis erstellen fehlgeschlagen.",
"directory"=>"Verzeichnis",
"dirdropped"=>"Verzeichnis entfernt.",
"dirdroppedfail"=>"Verzeichnis entfernen fehlgeschlagen.",
"error"=>"Fehler: ",
"error1"=>"Verbindung zu ### erfolgreich aber Benutzer/Passwort falsch.",
"error2"=>"Verbindung zu ### auf Port ### nicht m&ouml;glich.",
"error3"=>"Keine Dateien in diesem Verzeichnis, oder unzureichende Berechtigungen ...",
"error4"=>"Bitte geben Sie einen g&uuml;ltigen Verzeichnisnamen an!",
"error5"=>"Download fehlgeschlagen!",
"error6"=>"Upload oder Download Problem, evtl. beim Erstellen der tempor&auml;ren upload Datei!<br>\nBen&ouml;tige Schreibrecht in <strong>###</strong>, korrigiere temp. Verzeichnis in <strong>config/config.php</strong>",
"error7"=>"CHMOD/SITE Operationen nicht verf&uuml;gbar auf diesem FTP Server!",
"error8"=>"CHMOD ### auf ### war nicht erfolgreich (php ftp_site ok)!",
"error9"=>"Datei- oder Rechteangabe fehlt.",
"error10"=>"Kann Datei ### nicht l&ouml;schen!",
"error11"=>"Keine Datei ausgew&auml;hlt.",
"error12"=>"Verzeichnis ### kann nicht gel&ouml;scht werden (muss leer sein)!",
"error13"=>"Kein Verzeichnis gew&auml;hlt.",
"error14"=>"Die hochzuladende Datei &uuml;berschreitet die konfigurierte Maximalgr&ouml;&szlig;e von ### bytes!",
"error15"=>"Kann nicht in das Verzeichnis ### wechseln!",
"error16"=>"Kann dieses Verzeichnis nicht &ouml;ffnen!",
"error17"=>"Bitte w&auml;hlen Sie ein Verzeichnis oder eine Datei.",
"exit"=>"Beenden",
"filedropped"=>"Datei entfernt.",
"filedroppedfail"=>"Datei entfernen fehlgeschlagen.",
"fileputted"=>"Datei hochgeladen.",
"fileputtedfail"=>"Datei hochladen fehlgeschlagen.",
"files"=>"Dateien",
"folders"=>"Verzeichnisse",
"goup"=>"(nach oben)",
"host"=>"Host",
"port"=>"Port",
"help"=>"Hilfe",
"login"=>"Login",
"passive"=>"passives FTP",
"password"=>"Passwort",
"rawftp"=>"Raw FTP",
"refresh"=>"Aktualisieren",
"refreshed"=>"Ansicht aktualisiert...",
"retry"=>"Bitte wiederholen Sie die Aktion hier ...",
"securessl"=>"sicheres FTP",
"ssl"=>"SSL",
"to"=>"auf",
"upload"=>"Upload",
"limit"=>"Limit",
"--"=>"------------------------------------------------",
"help_text"=>"
### ist ein benutzerfreundliches und schnelles FTP Programm, welches 
&uuml;ber Firewalls und Proxies hinweg benutzt werden kann.

Um in Verzeichnisse zu wechseln, oder Dateien herunterzuladen reicht 
ein einfacher <b>Doppelklick</b> auf diese Elemente in den Listen. 
Um eine Verzeichnisebene h&ouml;her zu gehen klicken Sie doppelt auf 
den ersten Eintrag in der Verzeichnisliste (..), oder benutzen Sie 
die Verzeichnisauswahl dar&uuml;ber.

Datei-Gr&ouml;&szlig;enlimits f&uuml;r das hoch- und runterladen von Dateien 
m&uuml;ssen unter Umst&auml;nden nicht nur im Konfigurationsfile (config.php), 
sondern auch auf Ihrem Webserver, der Firewall oder am Proxy gesetzt werden. 
Fragen Sie Ihren Web Dienstleister, oder Netzwerkadministrator bei Problemen, 
nicht uns bitte.

Konfigurieren Sie ### in config/config.php & lesen Sie das <a href='readme.txt'>readme.txt</a> genau.


<b>### Project Homebase</b>

<a href=\"http://sourceforge.net/projects/###/\" target=\"_new\">http://sourceforge.net/projects/###/</a>

Hier erhalten Sie die neueste Version. Sie sind herzlich dazu eingeladen einen  
Beitrag zu leisten, oder <a href=\"http://sourceforge.net/donate/index.php?group_id=308254\" target=\"_new\">### zu spenden</a>, danke vielmals. 
Wenn Sie eine f&uuml;r Sie angepasste Version dieses Programms, oder eine 
andere Softwarel&ouml;sung ben&ouml;tigen z&ouml;gern Sie bitte nicht 
uns unverbindlich auf <a href=\"###\" target=\"_tab\">###</a> anzuschreiben.

____________
Happy FTP'ing.
"
);
?>