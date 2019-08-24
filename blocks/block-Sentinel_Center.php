<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKE_EVO')) exit;

global $db, $prefix, $ab_config, $currentlang;

$content = '';
$result = $db->sql_query('SELECT `reason` FROM `'.$prefix.'_nsnst_blocked_ips`');
$total_ips = $db->sql_numrows($result);
$db->sql_freeresult($result);
if(!$total_ips) { $total_ips = 0; }
$content .= '<div align="center"><br /><img src="modules/NukeSentinel/images/nukesentinel_large.png" height="60" width="468" alt="'._AB_WARNED.'" title="'._AB_WARNED.'" /><br />'._AB_HAVECAUGHT.' <strong>'.intval($total_ips).'</strong> '._AB_SHAMEFULHACKERS.'</div>'."\n";
$content .= '<br /><hr /><div align="center"><a href="http://nukescripts.86it.us" target="_blank">Copyright (c) 2000-2019 by NukeScripts(tm)</a></div><br />'."\n";

$content .= '<strong>Installed On:</strong> September 4th, 2017<br/>';
$content .= '<strong>Last upDate:</strong> August 19th, 2019<br/><br/>';
$content .= '';
$content .= '<strong>How injections are prevented by NukeSentinel add-on for PHP-Nuke Titanium v3.0.0</strong><br/><br/>';

$content .= "About <strong>17</strong> years ago, full-featured <strong>« website/portals »</strong> as we called them, were all the craze. <strong>PHP-Nuke</strong> 

was something easy to install on the 

many free Web Hosting accounts that were available. When it was released, It was the first CMS ever created and/or available and also came with lots of awesome 

features. 

But it had a price: unprofessional code, unstable, unmaintainable, insecure. If you want to know why security issues happened so widely, have a look at 

the old sources of <strong>PHP-Nuke</strong>, you'll know why you needed to separate html, styles, sql, php code and javascript.

At that time <strong>SQL injection</strong> and a few other security risks were a big problem : Search Engine, Contact Form, Forged Cookies, you name it. 

It was almost impossible to maintain so some 

folks got togethor and added a security layer, covering every security case you could imagine. Thus the birth of <strong>NukeSentinel</strong>...<br/><br/>

<strong>CURRENT FEATURES:</strong><br />
<strong>1.</strong>    Improved Scripting Attack filters.<br />
<strong>2.</strong>    Repaired a couple of missing </form> tags in admin pages.<br />
<strong>3.</strong>    Updated Blocks for titles and compliance.<br />
<strong>4.</strong>    Moved \"Country List\" link to main menu.<br />
<strong>5.</strong>    100% W3C XHTML 1.0 Transitional Compliant.<br />
<strong>6.</strong>    The administrator can define the ability to have blocked users either: a) be forwarded to a page (or) b) be forwarded to an admin defined URL.<br />
<strong>7.</strong>    Enhanced Administration Functions.<br />
<strong>8.</strong>    Writes information to Apache's .htaccess file (for increased security on blocking).<br />
<strong>9.</strong>    Cleaned up coding and variables.<br />
<strong>10.</strong> Can now remove blocked ip's from Apache's .htaccess file while removing them from the db.<br />
<strong>11.</strong> Can alter blocked ip's in Apache's .htaccess file while altering them in the db.<br />
<strong>12.</strong> Improved paging system in the Administration area.<br />
<strong>13.</strong> Added Remote IP and User Agent to the \"blocked\" page display.<br /> 
<strong>14.</strong> Added CLIKE protection with an on/off switch.<br />
<strong>15.</strong> Added UNION protection with an on/off switch.<br />
<strong>16.</strong> Added Harvester protection with an on/off switch.<br />
<strong>17.</strong> Added AUTHORS table protection with on/off switch.<br />
<strong>18.</strong> Improved speed relating to blocked ip checking.<br />
<strong>19.</strong> Added Page Sorting options for blocked ip pages.<br />
<strong>20.</strong> Added PC Killer option.<br />
<strong>21.</strong> Repaired PC Killer loop problem.<br />
<strong>22.</strong> Added \"Last 10 Blocked IPs\" block.<br />
<strong>23.</strong> Reconfigured the nsnst_config table.<br />
<strong>24.</strong> Repaired language file loading.<br />
<strong>25.</strong> Updated the lang-english.php file.<br />
<strong>26.</strong> Updated blockers to allow email only, block and email, and off.<br />
<strong>27.</strong> Repaired \"Edit Blocked IP\" routine.<br />
<strong>28.</strong> Repaired NukeSentinel(tm) Configuration.<br />
<strong>29.</strong> Now clears user sessions from both Nuke as well as Forums tables.<br />
<strong>30.</strong> Added a new block that shows ip lookups to the public as well as to admins.<br />
<strong>31.</strong> Added \"blocker type\" specific responses.<br />
<strong>32.</strong> Added the ability for block settings to now show ip lookup link and reason.<br />
<strong>33.</strong> Enabled Multiple email addresses for notifications. (may need work).<br />
<strong>34.</strong> Will match db stored IP addresses of xxx.*.*.* as global blocks.<br />
<strong>35.</strong> When blocking IP's it will use .* as the global range.<br />
<strong>36.</strong> Enabled Blocker specific information to be written to Apache's .htaccess file(if your server supports it).<br />
<strong>37.</strong> Enabled Blocker specific forwarding.<br />
<strong>38.</strong> Enabled \"Protected Admins\" functions (Can only be setup by the \"God\" level Administrator)<br />
<strong>39.</strong> Enabled \"HTTP Auth\" function (If your server has PHP compiled as an Apache Module, but not if your server has PHP compiled in CGI Mode).<br />
<strong>40.</strong> Enabled \"Proxy Blocker\" capabilities with on/off switch.<br />
<strong>41.</strong> Enabled DOS (Denial Of Service) Attack Protection.<br />
<strong>42.</strong> Enabled Mouse-over & Mouse-clicks Options in Help System.<br />
<strong>43.</strong> Enabled Mouse-clicks for Info System.<br />
<strong>44.</strong> Corrected problem with sites pulling your backend.php news feed.<br />
<strong>45.</strong> Reordered blockers for better trapping of attacks.<br />
<strong>46.</strong> Corrected a bad case for IP2C Searching.<br />
<strong>47.</strong> Corrected the is_god function. Around line 801 you can allow super users in but as default it requires GOD status.<br />
<strong>48.</strong> Corrected the blockers error of an empty set.<br />
<strong>49.</strong> Corrected a missing HELP define.<br />
<strong>50.</strong> Added Santy Worm protection (Thanks to NSN France)<br />
<strong>51.</strong> Added check box so you can return to the Add IP/Range screens faster<br />
<strong>52.</strong> Recoded includes/nukesentinel.php to load and run faster.<br />
<strong>53.</strong> Rebuilt the Search function to search all ip areas at once and display the results.<br />
<strong>54.</strong> Added test switch for HTTPAuth and register_globals. Helps prevent admins being locked out of admin.php.<br />
<strong>55.</strong> Added switch for Santy Worm protection.<br />
<strong>56.</strong> NEW import system for adding IP 2 Country data and importing Blocked Ranges.<br />
<strong>57.</strong> Created master globals in includes/nukesentinel.php for easier and faster processing.<br />
<strong>58.</strong> You can use the new master global by adding $nsnst_const to your global lines throughout PHP-Nuke.<br />
<strong>59.</strong> Adapted for 7.7 WYSIWYG editor. (Thanks to WD-40)<br />
<strong>60.</strong> Enclosed table and field names with ` marks on SQL queries.<br />
<strong>61.</strong> Improved the Add IP 2 Country Range failure report page.<br />
<strong>62.</strong> includes/nukesentinel.php checks for the $admin_file var and sets it if it isn't set.<br />
<strong>63.</strong> Added Country Listing page in IP 2 Country management. Now you can easily find the c2c codes.<br />
<strong>64.</strong> Changed the IP Tracking from a max number of lines to a max number of days.<br />
<strong>65.</strong> Added the gfx=gfx_little clause to prevent from being tracked and wasting db space.<br />
<strong>66.</strong> Removed unused code and language defines.<br />
<strong>67.</strong> Corrected a Search Results error.<br />
<strong>68.</strong> Re-ordered the lang file to prevent Undefined error.<br />
<strong>69.</strong> ChatServ updates to replace $x == \"\" to empty($x) in many locations.<br />
<strong>70.</strong> Updated Edit Instructions (Includes updates by ChatServ for Patched 3.1).<br />
<strong>71.</strong> Moved import directory out of the admin directory structure so it can be deleted after importing data easier.<br />
<strong>72.</strong> Added routines to check range database table for overlaps.<br />
<strong>73.</strong> Updated import data (ip2country data from the NukeScripts site).<br />
<strong>74.</strong> NEW Flood Protection on GET and POST requests. (Thanks to Manuel)<br />";
$content .= '<strong>75.</strong> Added global for SERVER_ADDR as $nsnst_const[\'server_ip\']. Can be useful in<br />';
$content .= "       other scripts to check if the request comes from your server or from a client.<br />";
  
$content .= '<br /><br /><br /><br /><br />';
?>