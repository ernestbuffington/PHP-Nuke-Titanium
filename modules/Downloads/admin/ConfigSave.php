<?php //donr
if (!defined('IN_NSN_GD')) { echo 'Access Denied'; die(); }
gdsave_config('admperpage', intval($xadmperpage));
gdsave_config('blockunregmodify', intval($xblockunregmodify));
gdsave_config('dateformat', addslashes(gdFilter($xdateformat, 'nohtml')));
gdsave_config('mostpopular', intval($xmostpopular));
gdsave_config('mostpopulartrig', intval($xmostpopulartrig));
gdsave_config('perpage', intval($xperpage));
gdsave_config('popular', intval($xpopular));
gdsave_config('results', intval($xresults));
gdsave_config('show_download', intval($xshow_download));
gdsave_config('show_links_num', intval($xshow_links_num));
gdsave_config('usegfxcheck', intval($xusegfxcheck));
Header('Location: ' . $admin_file . '.php?op=DLConfig');

