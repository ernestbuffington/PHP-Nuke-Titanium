<?php

/************************************************************************/
/* NukeJMap [Site_Map]	4.0 by z3rb			                			*/
/* =================================                                    */
/*                                                                      */
/* Copyright (c) 2006 by Techgen			                			*/
/* http://www.techg3n.net                                               */
/*                                                                      */
/************************************************************************/

$module_name = basename(dirname(__FILE__));
$mod_name = "NukeJMap [Site_Map]";
$author_name = "z3rb techg3n.net";
$author_email = "";
$author_homepage = "http://www.techg3n.net";
$license = "GNU/GPL";
$download_location = "http://www.techg3n.net";
$module_version = "4.0";
$release_date = "May 2006";
$module_description = "Module Sitemap [Evo & Nuke 7.6]";
$mod_cost = "";

function show_copyright() {
    global $mod_cost, $forum, $mod_name, $module_name, $release_date, $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($mod_name == "") { $mod_name = str_replace("_", " ", $module_name); }
    echo "<html>\n";
    echo "<head><title>$mod_name: Copyright Information</title></head>\n";
    echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
    echo "<center><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>\n";
    echo "<td width=\"290\" align=\"center\"><font size=\"2\" face=\"Arial, Helvetica\"><strong>Informazioni Copyright &copy; Modulo</strong><br />";
    echo "Modulo $mod_name per <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a><br />[<a href=\"javascript:void(0)\" onClick=javascript:self.close()>Chiudi Finestra</a>]</font></td>\n";
    echo "</tr>\n</table>\n</center><hr />\n";
    echo "<font size=\"2\" face=\"Arial, Helvetica\">";
    echo "&#8226;&nbsp;<strong>Nome Modulo:</strong> $mod_name<br />\n";
    if ($module_version != "") { echo "&#8226;&nbsp;<strong>Versione Modulo:</strong> $module_version<br />\n"; }
    if ($release_date != "") { echo "&#8226;&nbsp;<strong>Data Rilascio:</strong> $release_date<br />\n"; }
    if ($mod_cost != "") { echo "&#8226;&nbsp;<strong>Costo Modulo:</strong> $mod_cost<br />\n"; }
    if ($license != "") { echo "&#8226;&nbsp;<strong>Licensa:</strong> $license<br />\n"; }
    if ($author_name != "") { echo "&#8226;&nbsp;<strong>Nome Autore:</strong> $author_name<br/ >\n"; }
    if ($author_email != "") { echo "&#8226;&nbsp;<strong>Email Autore:</strong> $author_email<br />\n"; }
    if ($module_description != "") { echo "&#8226;&nbsp;<strong>Descrizione Modulo:</strong> $module_description<br />\n"; }
    if ($download_location != "") { echo "&#8226;&nbsp;<strong>Download:</strong> <a href=\"$download_location\" target=\"new\">techg3n.net</a>\n"; }
	echo "<hr />\n";
    echo "</font>\n";
    echo "</body>\n";
    echo "</html>";
}

show_copyright();


?>