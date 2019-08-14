<?php
/**
 * Custom function: This will be used quite alot throughout the site, For such things as CMS, Block, Module & Theme version chekcing. 
 * @since v3.0.0b
 */
function get_titanium_version_information($version_check_url, $local_cache_location, $force_refresh=false) 
{
	$url   			= $version_check_url;
	$cache 			= $local_cache_location.'json.cache';
	$refresh		= 24 * 60 * 60; # check for a new version once a day. // 24 * 60 * 60

	if ($force_refresh || ((time() - filectime($cache)) > ($refresh) || 0 == filesize($cache))):

		# create a new cURL resource
		$ch = curl_init();

		# set URL and other appropriate options
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_FAILONERROR, true );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 7 );

		# grab URL and pass it to the browser
		$response = curl_exec( $ch );

		# close cURL resource, and free up system resources
		curl_close( $ch );

		$jsoncache 	= $response;

		# Insert json information into a locally stored file, This will prevent slow page load time from slow hosts.
		$handle 	= fopen( $cache, 'wb' ) or die( 'no fopen' );	
		fwrite( $handle, $jsoncache );
		fclose( $handle );

	else:
		# Retrieve the json cache from the locally stored file
		$jsoncache = file_get_contents( $cache );
	endif;

	$jsonobject = json_decode( $jsoncache, true );
	return $jsonobject;
}

function get_titanium_timeago( $ptime ) 
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
        return 'Secs';

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'Year',
                30 * 24 * 60 * 60       =>  'Month',
                24 * 60 * 60            =>  'Day',
                60 * 60                 =>  'Hour',
                60                      =>  'Min',
                1                       =>  'Sec'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );                                                                             // └════┘
            return '<div align="center"><strong>'.$r.'</strong><br />' . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' <br /> </div>';
        }
    }
}
?>
