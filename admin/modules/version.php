<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.version.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.0.0
   Date          : 06/16/2005 (dd-mm-yyyy)

   Notes         : Verifies if latest Nuke-Evolution Basic Release is
                   installed and a recent changelog.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Version Checker                v1.0.0       06/16/2005
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')){
   die ("Illegal File Access");
}

define(CUR_EVO, strtolower(EVO_EDITION));

// Set the data to send to the server
// Trying to access the version tracker without using the
// $_POST method will return an "Access Denied" error
$postdata = 'v='.NUKE_EVO;

// Make a new connection to the version tracker
// We can either connect using cURL or fsockopen
if (function_exists('curl_init')){
	$version_info = evo_get_version_curl($postdata);
} else {
	$version_info = evo_get_version_fsock($postdata);
}

/*****[BEGIN]******************************************
 [ Mod:    Evolution Version Checker           v1.1.0 ]
 ******************************************************/
function version_check(){
	global $db, $prefix, $cache, $json, $evoconfig, $version_info;
	
	if (is_array($version_info)){
		// Display a message based on the array
		if ($version_info['mTypeSmall'] == 'error'){
			echo '<h2>'.$version_info['mType'].'</h2><p><font color="red">'.$version_info['message'].'</font></p>';
		} elseif ($version_info['mTypeSmall'] == 'success'){
			echo '<p style="color:green">'.$version_info['message'].'</p>';
		} elseif ($version_info['mTypeSmall'] == 'out_of_date' && $version_info['dType'] == 'enabled'){
			echo '<h2>'.$version_info['mType'].'</h2><p><font color="red">'.$version_info['message'].'</font><br /><br /><a href="'.$version_info['download_link'].'" target="_blank">'.$version_info['download_link'].'</a></p>';
		}
		
		// Get the last version check time
		$Version_Check = intval($evoconfig['ver_check']);
		
		if (!$Version_Check || ($Version_Check-time()) > 86400){
			$ret_ver = $version_info['current_version'];
			$db->sql_query("UPDATE ".$prefix."_evolution SET evo_value='".time()."' WHERE evo_field='ver_check'");
			$db->sql_query("UPDATE ".$prefix."_evolution SET evo_value='".$ret_ver."' WHERE evo_field='ver_previous'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
			$cache->delete('evoconfig');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
		} else {
			echo '<p style="color:blue">'._ADMIN_LOG_CHECKED.' '.date('Y-m-d', $Version_Check).' @'.date('H:i', $Version_Check).'</p>';
		}
	} else {
		echo $version_info;
	}
	
	unset($version_info);
}
/*****[END]********************************************
 [ Mod:    Evolution Version Checker           v1.1.0 ]
 ******************************************************/

function evo_check_version(){
	global $version_info;
	
    $ver = $version_info['current_version'];
    return (NUKE_EVO == $ver) ? 0 : 1;
}

function evo_get_version_curl($postdata){
	global $json;
	
	$ch = curl_init('www.evolution-xtreme.com/versioning/version.php');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	$version_info = curl_exec($ch);
	curl_close($ch);
	
	if (!empty($version_info) && strtolower($version_info) != null){
		return $json->decode($version_info);
	} else {
		return $version_info;
	}
}

function evo_get_version_fsock($postdata){
	global $json;
	
	// Set the error status for the tracker
	$error = false;
	
	if ($fsock = fsockopen('www.evolution-xtreme.com', 80, $errno, $errstr, 10)){
		// Send some information to the server
		fputs($fsock, "POST /versioning/version.php HTTP/1.0\r\n");
		fputs($fsock, "HOST: www.evolution-xtreme.com\r\n");
		fputs($fsock, "Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fsock, "Content-length: ".strlen($postdata)."\r\n\r\n");
		fputs($fsock, $postdata."\r\n\r\n");
		
		// Get the array with version information and more
		while(!feof($fsock)){
			$version_info = fgets($fsock, 10000);
		}
		
		// Close the connection
		fclose($fsock);
	} else {
		if ($errstr){
			$version_info = '<p style="color:red">'.sprintf(_VERSIONSOCKETERROR, $errstr).'</p>';
			$error = true;
		} else {
			$version_info = '<p>'._VERSIONFUNCTIONSDISABLED.'</p>';
			$error = true;
		}
	}
	
	if (!$error){
		return $json->decode($version_info);
	} else {
		return $version_info;
	}
}

function evo_compare(){
    global $db, $prefix, $cache;

    $check = evo_check_version();
    if ($check == 0){
        $sql_ver = "UPDATE ".$prefix."_evolution SET evo_value = '0' WHERE evo_field='ver_previous'";
        $db->sql_query($sql_ver);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('evoconfig');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        return "<strong><span style='color:green'>"._ADMIN_VER_CUR."</span></strong>";
    }
    $current = NUKE_EVO;
    $s = strpos($log_raw,$current);
    if (!$s){
        return -1;
    }
    return $log_evo;
}

function evo_changelog() {
    $data = @file('http://evolution-xtreme.com/changelog_'.CUR_EVO.'.txt');
    $log_evo = "<table width='100%'>";
    $names = array(
                "TECHNOCRAT" => "Technocrat",
                "JEFFB68CAM" => "JeFFb68CAM",
                "REVOLUTION" => "Revolution",
                "QUAKE" => "Quake",
                "KREAGON" => "Kreagon",
                "DANUK" => "DanUK",
                "LTABDIEL" => "Ltabdiel",
                "JELLE" => "Jelle",
                "RODMAR" => "Rodmar",
                "PLATINUMTHEMES" => "PlatinumThemes",
                "DIEDIEDIE" => "Diediedie",
                "TULISAN" => "Tulisan",
                "REORGANISATION" => "ReOrGaNiSaTiOn",
				"LONESTAR" => "LonesStar",
                "KILLIGAN" => "Killigan",
				"SGTLEGEND" => "SgtLegend",
				"TRAVO" => "Travo",
				"WOLFSTAR" => "Wolfstar",
				"VICTOMEYEZR" => "VicToMeyeZR"
            );
    for($i=0, $maxi=count($data); $i<$maxi; $i++){
        $line = $data[$i];
        if (stristr($line, " - [")){
            $log_evo .= "<tr><td style='text-indent: 15pt;'>";
            $log_evo .= htmlspecialchars($line);
            $log_evo .= "</td></tr>";
        } else {
            $line = trim($line);
            $line = isset($names[strtoupper($line)]) ? "<strong><u>" . $names[strtoupper($line)] . "</u></strong>" : $line;
            $log_evo .= "<tr><td>";
            $log_evo .= $line;
            $log_evo .= "</td></tr>";
        }
    }
    $log_evo .= "</table>";
    return $log_evo;
}

function evo_get_download(){
    $contents = @file_get_contents('http://evolution-xtreme.com/download_'.CUR_EVO.'.txt');

    if (substr($contents,strlen($contents)-1) == "\r\n"){
        $contents = substr($contents,0,strlen($contents)-1);
    }

    return $contents;
}

function evo_version(){
    global $db, $prefix, $admin_file, $version_info;

    echo "<center>";
    echo "<strong><span class=\"title\">"._VER_TITLE."</span></strong><br /><br />";
	
	version_check();

    $ret_ver = $version_info['current_version'];
	
    if (!$ret_ver){
        echo "<strong><span style='color:red'>"._VER_ERR_CON."</span></strong>";
    } else {
        //echo "<strong><span style='color:blue'>"._VER_VER."</span></strong> ".$ret_ver." ".EVO_EDITION."<br /><strong><span style='color:blue'>"._VER_YOURVER."</span></strong> ".EVO_VERSION."<br /></center>";
		echo '</center>';
        $log_evo = evo_changelog();
        if ($download = evo_get_download()){
            $log_evo  = "<strong><a href='".$download."'>Download v".$ret_ver."</a></strong><br /><br />".$log_evo;
            $log_evo .= "<br /><br /><strong><a href='".$download."'>Download v".$ret_ver."</a></strong>";
        }
        echo $log_evo;
        echo "<center>";
    }
    echo "<br /><br /><strong><a href='".$admin_file.".php'>"._TRACKER_BACK."</a></strong>";
    echo "</center>";
}

if (is_admin()){
    include_once(NUKE_BASE_DIR.'header.php');
	
    OpenTable();
    switch($op){
        case 'version': evo_version(); break;
    }
    CloseTable();
	
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    echo 'Access Denied';
}

?>