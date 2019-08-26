<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
//&raquo;
// Item Delimiter
$spacer = "└";
$lft = "-]";
$rgt = "[-";
$dash = "-";
$newpagetitle = '';

    global
 	$admin_file, 
	    $cookie, 
		$slogan, 
	 $pagetitle, 
	  $sitename, 
        $prefix, 
		  $file, 
		    $db, 
   $user_prefix, 
           $sid, 
	 $new_topic, 
	       $lft, 
		   $rgt, 
		  $dash, 
		$domain, 
		  $name, 
		   $lft, 
		   $rgt, 
 		  $dash;
	
	    $imageid = "<meta property=\"og:image\" content=\"".HTTPS."$domain/images/logo.png\">\n";
          $urlid = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=Blog\">\n"; 	
 $urldescription = "<meta property=\"og:description\" content=\"$spacer $sitename ¬ $name ⌐\">\n"; 	 
    $newpagetitle= "$spacer $sitename ¬ $name Updates ⌐";

	if (isset($new_topic) && is_numeric($new_topic)) 
	{
        list($top) = $db->sql_ufetchrow("SELECT `topictext` FROM `".$prefix."_topics` WHERE `topicid`='$new_topic'", SQL_NUM);
        $newpagetitle= "¬ $top ⌐";
    } 

	if ($file == 'article' && isset($sid) && is_numeric($sid))
	{
		//good to go
        if (file_exists("upload/upu/files/$name$sid.png")) 
        {
          $imageid = "<meta property=\"og:image\" content=\"".HTTPS."$domain/upload/upu/files/$name$sid.png\">\n";
        }
        else
        {
          $imageid = "<meta property=\"og:image\" content=\"".HTTPS."$domain/images/logo.png\">\n";
        }
		//good to go
		 

        //good to go
        list($art, $top) = $db->sql_ufetchrow("SELECT `title`, `topic` FROM `".$prefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
        //good to go
		    
	    if ($top)  
		{
            //////////////////////////////////////////////////////////
            //Keep start (never delete or move) 
	        //////////////////////////////////////////////////////////
            list($top) = $db->sql_ufetchrow("SELECT `topictext` FROM `".$prefix."_topics` WHERE `topicid`='$top'", SQL_NUM);
            $newpagetitle= "$spacer $top ¬ News Update : $art ⌐"; //send button // this is being put in the description field on send
			
			//good to go
			list($cateid) = $db->sql_ufetchrow("SELECT `catid` FROM `".$prefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
			$thiscateid = $cateid;
			list($author) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_stories_cat` WHERE `catid`='$thiscateid'", SQL_NUM);
			$songauthor = $author;
            //good to go
			
			//good to go
			$urldescription = "<meta property=\"og:description\" content=\"$spacer News Update From ¬ $sitename ⌐\">\n";
			
			$newpagetitle= "$spacer News Update &raquo; $top &raquo; $songauthor ¬"; 	 
           //////////////////////////////////////////////////////////
           //Keep end (never delete or move)
	       //////////////////////////////////////////////////////////
        }
		  
        $urlid = "<meta property=\"og:url\" content=\"".HTTPS."$domain/modules.php?name=$name&file=article&sid=$sid&mode=0&thold=-1\">\n"; 	
	}

     $metapagetitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";
     $urltype = "<meta property=\"og:type\" content=\"website\">\n";
	 
	 $regulartitle = "<title>$newpagetitle</title>\n";
	 
//////////////////////////////////////////////////////////
//Keep start (never delete or move)
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
//Keep start (never delete or move)
//////////////////////////////////////////////////////////
echo $urldescription;
echo $urltype;
echo $urlid;
echo $imageid;
echo $metapagetitle;
echo $regulartitle;
//////////////////////////////////////////////////////////
//Keep end (never delete or move)
//////////////////////////////////////////////////////////
?>