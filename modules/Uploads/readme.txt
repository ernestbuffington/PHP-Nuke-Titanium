***********************************
* PHFTP (PHP HTTP FTP) readme.txt *
***********************************

PHFTP ( PHP HTTP FTP ) is a simple and fast Web FTP application. 
You can upload, download and administer files on FTP servers 
without a local FTP client, even if you are behind firewalls 
and proxies.

The only thing you need is a Web browser HTTP(S) connection. 
If you can browse the Internet at your workplace, you can now 
also establish a FTP connection to any FTP server your PHFTP 
installation server can connect to.


Incomplete list of features:

    * Local and Remote FTP Connections
    * Upload & Download Files
    * Create & Delete Remote Directories
    * Delete Remote Files
    * Navigate through Remote Directory Structure
    * Formatted File Sizes, Dates and Permissions
    * Focuses on: Speed and Usability
    * Lists with Double Click Support
    * Central Configuration (config/config.php)
    * Multi User Compatible (Provider friendly)
    * Administer file and directory permissions (CHMOD)
    * Anonymous FTP
    * Passive FTP (firewall compatible)
    * FTP over SSL (SFTP)
    * Auto. ASCII or BINARY transfer mode (configurable)
    * Auto. Keep Alive without traffic


______________
Happy FTP'ing!



You can configure PHFTP tailored to your needs. It runs on your PC,
as well as on modern mobile devices.

You don't have to struggle with ftp, proxy and firewall configurations 
at client side. No client installations required.


The PROJECTS HOMEPAGE and where you can get infos and the newest* release:

https://sourceforge.net/projects/phftp/

*See your version in the browsers title bar or in the about box text.


Subscribe to the PHFTP MAILING LIST (1-5 emails per year inform you 
about updates, not more not less).

https://lists.sourceforge.net/lists/listinfo/phftp-users




This free software comes with ABSOLUTELY NO WARRANTY.

PHFTP Copyright(C) by Andreas Mehrrath


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program (gpl.txt).  If not, see <http://www.gnu.org/licenses/>.


*************
PREREQUISITES
*************

PHP Version >= 4.3.x with enabled FTP extension.



*************
INSTALLATION
*************

The installation on your web server is easy. You only need a webserver
with PHP, no database required. Simply copy the extracted archive to a
new directory on your webservers document root and adopt the configuration
as described below respectively as described in the configuration file
(config.php) itself.



II. PH-FTP APPEARANCE

config/config.php                MAIN CONFIGURATION FOR THE APPLICATION
-----------------

Here you can customize the application to your needs and configure it.
A fundamental setting is the path to a writeable temporary directory 
for up- and downloads ($conf_phpftp_tmpdir). Check that first!




***************
SECURITY ISSUES
***************

Don't edit non configuration files and/or remove (author) references.
Use the application on a SSL enabled host whenever possible or protect
the application directory with .htaccess.

http://www.apache-ssl.org/



This free software comes with ABSOLUTELY NO WARRANTY.

PHFTP Copyright(C) by Andreas Mehrrath

