<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   modules/Uploads/inc/mimetype.php
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
/*
Copyright (C) 2010 Andreas Mehrrath

All rights reserved.

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
*/

class mimetype
{

    function buildMimeArray()
    {
        return array(
        "wmlc" => "application/vnd.wap.wmlc",
        "wmlsc" => "application/vnd.wap.wmlscriptc",
        "bcpio" => "application/x-bcpio",
        "vcd" => "application/x-cdlink",
        "pgn" => "application/x-chess-pgn",
        "cpio" => "application/x-cpio",
        "csh" => "application/x-csh",
        "dcr" => "application/x-director",
        "dir" => "application/x-director",
        "dxr" => "application/x-director",
        "dvi" => "application/x-dvi",
        "spl" => "application/x-futuresplash",
        "gtar" => "application/x-gtar",
        "hdf" => "application/x-hdf",
        "js" => "application/x-javascript",
        "msh" => "model/mesh",
        "mesh" => "model/mesh",
        "silo" => "model/mesh",
        "wrl" => "model/vrml",
        "vrml" => "model/vrml",
        "css" => "text/css",
        "html" => "text/html",
        "htm" => "text/html",
        "asc" => "text/plain",
        "txt" => "text/plain",
        "rtx" => "text/richtext",
        "rtf" => "text/rtf",
        "sgml" => "text/sgml",
        "sgm" => "text/sgml",
        "tsv" => "text/tab-seperated-values",
        "wml" => "text/vnd.wap.wml",
        "wmls" => "text/vnd.wap.wmlscript",
        "etx" => "text/x-setext",
        "xml" => "text/xml",
        "xsl" => "text/xml",
        "mpeg" => "video/mpeg",
        "mpg" => "video/mpeg",
        "mpe" => "video/mpeg",
        "qt" => "video/quicktime",
        "mov" => "video/quicktime",
        "mxu" => "video/vnd.mpegurl",
        "skp" => "application/x-koan",
        "skd" => "application/x-koan",
        "skt" => "application/x-koan",
        "skm" => "application/x-koan",
        "latex" => "application/x-latex",
        "nc" => "application/x-netcdf",
        "cdf" => "application/x-netcdf",
        "sh" => "application/x-sh",
        "shar" => "application/x-shar",
        "swf" => "application/x-shockwave-flash",
        "sit" => "application/x-stuffit",
        "sv4cpio" => "application/x-sv4cpio",
        "sv4crc" => "application/x-sv4crc",
        "tar" => "application/x-tar",
        "tcl" => "application/x-tcl",
        "tex" => "application/x-tex",
        "texinfo" => "application/x-texinfo",
        "texi" => "application/x-texinfo",
        "t" => "application/x-troff",
        "tr" => "application/x-troff",
        "roff" => "application/x-troff",
        "man" => "application/x-troff-man",
        "me" => "application/x-troff-me",
        "ms" => "application/x-troff-ms",
        "ustar" => "application/x-ustar",
        "ez" => "application/andrew-inset",
        "hqx" => "application/mac-binhex40",
        "cpt" => "application/mac-compactpro",
        "doc" => "application/msword",
        "bin" => "application/octet-stream",
        "dms" => "application/octet-stream",
        "lha" => "application/octet-stream",
        "lzh" => "application/octet-stream",
        "exe" => "application/octet-stream",
        "class" => "application/octet-stream",
        "so" => "application/octet-stream",
        "dll" => "application/octet-stream",
        "oda" => "application/oda",
        "pdf" => "application/pdf",
        "ai" => "application/postscript",
        "eps" => "application/postscript",
        "ps" => "application/postscript",
        "smi" => "application/smil",
        "smil" => "application/smil",
        "wbxml" => "application/vnd.wap.wbxml",
        "src" => "application/x-wais-source",
        "xhtml" => "application/xhtml+xml",
        "xht" => "application/xhtml+xml",
        "zip" => "application/zip",
        "au" => "audio/basic",
        "snd" => "audio/basic",
        "mid" => "audio/midi",
        "midi" => "audio/midi",
        "kar" => "audio/midi",
        "mpga" => "audio/mpeg",
        "mp2" => "audio/mpeg",
        "mp3" => "audio/mpeg",
        "aif" => "audio/x-aiff",
        "aiff" => "audio/x-aiff",
        "aifc" => "audio/x-aiff",
        "m3u" => "audio/x-mpegurl",
        "ram" => "audio/x-pn-realaudio",
        "rm" => "audio/x-pn-realaudio",
        "rpm" => "audio/x-pn-realaudio-plugin",
        "ra" => "audio/x-realaudio",
        "wav" => "audio/x-wav",
        "pdb" => "chemical/x-pdb",
        "xyz" => "chemical/x-xyz",
        "bmp" => "image/bmp",
        "gif" => "image/gif",
        "ief" => "image/ief",
        "jpeg" => "image/jpeg",
        "jpg" => "image/jpeg",
        "jpe" => "image/jpeg",
        "png" => "image/png",
        "tiff" => "image/tiff",
        "tif" => "image/tif",
        "djvu" => "image/vnd.djvu",
        "djv" => "image/vnd.djvu",
        "wbmp" => "image/vnd.wap.wbmp",
        "ras" => "image/x-cmu-raster",
        "pnm" => "image/x-portable-anymap",
        "pbm" => "image/x-portable-bitmap",
        "pgm" => "image/x-portable-graymap",
        "ppm" => "image/x-portable-pixmap",
        "rgb" => "image/x-rgb",
        "xbm" => "image/x-xbitmap",
        "xpm" => "image/x-xpixmap",
        "xwd" => "image/x-windowdump",
        "igs" => "model/iges",
        "iges" => "model/iges",
        "avi" => "video/x-msvideo",
        "movie" => "video/x-sgi-movie",
        "ice" => "x-conference-xcooltalk"
        );
    }


    function getMimeType($fname)
    {
        $fname = basename($fname);
        $fname = explode('.', $fname);
        $fname = $fname[count($fname)-1];
        return $this->findMimeType($fname);
    }

    function findMimeType($ext)
    {
        $mimetypes = $this->buildMimeArray();

        if (isset($mimetypes[$ext]))
        {
            return $mimetypes[$ext];

        } else
        {
            return 'application/octet-stream';
        }
    }


}
?>