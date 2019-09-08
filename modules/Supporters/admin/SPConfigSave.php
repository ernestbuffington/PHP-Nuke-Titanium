<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

spsave_config("require_user",$require_user);
spsave_config("image_type",$image_type);
spsave_config("max_width",$max_width);
spsave_config("max_height",$max_height);
redirect($admin_file.".php?op=SPConfig");

?>