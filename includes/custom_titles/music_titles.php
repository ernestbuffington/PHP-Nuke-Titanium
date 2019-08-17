<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

if ((isset($_POST['topic']) && !empty($_POST['topic'])) && (isset($_GET['topic']) && !empty($_GET['topic']))) 
{
    $topicidnumber = (isset($_GET['topic']) && !stristr($_GET['topic'],'..') && !stristr($_GET['topic'],'://')) ? addslashes(trim($_GET['topic'])) : false;
} 
else 
{
    $topicidnumber = (isset($_REQUEST['topic']) && !stristr($_REQUEST['topic'],'..') && !stristr($_REQUEST['topic'],'://')) ? addslashes(trim($_REQUEST['topic'])) : false;
}

if ((isset($_POST['file']) && !empty($_POST['file'])) && (isset($_GET['file']) && !empty($_GET['file']))) 
{
    $requestfile = (isset($_GET['file']) && !stristr($_GET['file'],'..') && !stristr($_GET['file'],'://')) ? addslashes(trim($_GET['file'])) : false;
} 
else 
{
    $requestfile = (isset($_REQUEST['file']) && !stristr($_REQUEST['file'],'..') && !stristr($_REQUEST['file'],'://')) ? addslashes(trim($_REQUEST['file'])) : false;
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
   $musicprefix, 
        $prefix, 
		  $file, 
		    $db3, 
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
	
	    $imageid = "<meta property=\"og:image\" content=\"".HTTPS."music.86it.us/images/titanium/Music.png\">\n";
          $urlid = "<meta property=\"og:url\" content=\"".HTTPS."music.86it.us/modules.php?name=Music\">\n"; 	
 $urldescription = "<meta property=\"og:description\" content=\"$spacer The 86it Social Network ¬ Titanium Tunes ⌐\">\n"; 	 
    $newpagetitle= "$spacer $sitename ¬ Titanium Tunes ⌐";
    
	if (isset($new_topic) && is_numeric($new_topic)) 
	{
        list($top) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$new_topic'", SQL_NUM);
        
		$newpagetitle= "¬ $top ⌐";
    } 

	if ($file == 'article' && isset($sid) && is_numeric($sid))
	{
		//good to go
        if (file_exists("upload/upu/files/$name$sid.png")) 
        {
          $facebook_ogimage = "<meta property=\"og:image\" content=\"".HTTPS."music.86it.us/upload/upu/files/$name$sid.png\">\n";
        }
        else
        {
          $facebook_ogimage = "<meta property=\"og:image\" content=\"".HTTPS."music.86it.us/images/titanium/Music002.png\">\n";
        }
		//good to go
		 

        //good to go
        list($art, $top) = $db3->sql_ufetchrow("SELECT `title`, `topic` FROM `".$musicprefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
        //good to go
		    
	    if ($top)  
		{
            //////////////////////////////////////////////////////////
            //Keep start (never delete or move)
	        //////////////////////////////////////////////////////////
            list($top) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$top'", SQL_NUM);
            $newpagetitle= "$spacer $top ¬ Song : $art ⌐";
			
			//good to go
			list($cateid) = $db3->sql_ufetchrow("SELECT `catid` FROM `".$musicprefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
			$thiscateid = $cateid;
			
			list($author) = $db3->sql_ufetchrow("SELECT `title` FROM `".$musicprefix."_stories_cat` WHERE `catid`='$thiscateid'", SQL_NUM);
			$songauthor = $author;
            //good to go
			
			//good to go
			$facebook_ogdescription = "<meta property=\"og:description\" content=\"$spacer Titanium Tunes ¬ Song By $songauthor ⌐\">\n"; 	 
           //////////////////////////////////////////////////////////
           //Keep end (never delete or move)
	       //////////////////////////////////////////////////////////
        }
		  
        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."music.86it.us/modules.php?name=Music&file=article&sid=$sid&mode=0&thold=-1\">\n"; 	
	}

     $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";
     $facebook_ogtype = "<meta property=\"og:type\" content=\"website\">\n";
	 
	 $regulartitle = "<title>$newpagetitle</title>\n";
?>