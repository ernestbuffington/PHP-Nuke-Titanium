<?php
/*
 * New module owner copyrights
 */
$new_mod_name = '86it&trade; Downloads';
$new_author_email = 'montego@86it.us';
$new_author_homepage = 'http://montegoscripts.86it.us';
$new_author_name = '<a href="' . $new_author_homepage . '" target="new">Montego 86it Scripts</a>';
$new_license = 'Copyright &copy; 2006-2019 Montego 86it Scripts';
/*
 * Original module copyrights from NSN
 */
$mod_name = 'NSN GR Downloads';
$author_email = '';
$author_homepage = 'http://www.nukescripts.net';
$author_name = '<a href="' . $author_homepage . '" target="new">NukeScripts Network</a>';
$license = 'Copyright &copy; 2000-2005 NukeScripts Network';
/*
 * Display copyrights
 */
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"' . "\n";
echo '  "http://www.w3.org/TR/html4/loose.dtd">' . "\n";
echo '<html>';
echo '<head>';
echo '<title>' . $mod_name . ': Copyright Information</title>';
echo '<style type="text/css">';
echo '<!--';
echo 'body{';
echo 'FONT-FAMILY:Verdana,Helvetica; FONT-SIZE:11px;';
echo 'SCROLLBAR-3DLIGHT-COLOR:#000000;';
echo 'SCROLLBAR-ARROW-COLOR:#e7e7e7;';
echo 'SCROLLBAR-FACE-COLOR:#414141;';
echo 'SCROLLBAR-DARKSHADOW-COLOR:#000000;';
echo 'SCROLLBAR-HIGHLIGHT-COLOR:#9d9d9d;';
echo 'SCROLLBAR-SHADOW-COLOR:#9d9d9d;';
echo 'SCROLLBAR-TRACK-COLOR:#e7e7e7;';
echo '}';
echo '-->';
echo '</style>';
echo '</head>';
echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">';
/*
 * New module owner copyright
 */
echo '<div style="text-align:center; font-weight:bold;">Module Copyright &copy; Information</div><hr />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' . $new_mod_name . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License:</span> ' . $new_license . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' . $new_author_name . '<br />';
echo '<hr />';
/*
 * Original owner copyright
 */
echo '<div style="text-align:center; font-weight:bold;">Original Module Copyright &copy; Information</div>';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Module\'s Name:</span> ' . $mod_name . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">License:</span> ' . $license . '<br />';
echo '<img src="images/arrow.png" border="0" alt="" />&nbsp;<span style="font-weight:bold;">Author\'s Name:</span> ' . $author_name . '<br />';
echo '<hr />';
echo '<div style="text-align:center;">';
echo '[<a href="#" onclick="javascript:self.close()">Close Window</a>]</div>';
echo '</body>';
echo '</html>';

