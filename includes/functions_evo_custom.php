<?php

/**
 * Send mail, similar to PHP's mail
 *
 * @since 2.0.9e
 *
 * A true return value does not automatically mean that the user received the
 * email successfully. It just only means that the method used was able to
 * process the request without any errors.
 *
 * @global PHPMailer $mail
 *
 * @param string|array $to          Array or comma-separated list of email addresses to send message.
 * @param string       $subject     Email subject
 * @param string       $message     Message contents
 * @param string|array $headers     Optional. Additional headers.
 * @param string|array $attachments Optional. Files to attach.
 * @return bool Whether the email contents were sent successfully.
 */
function evo_phpmailer($to, $subject, $message, $headers = '', $attachments = array())
{
	global $mail, $phpbb2_board_config, $nuke_titanium_config;

	if ( ! ( $mail instanceof PHPMailer ) ) {
		require_once 'includes/classes/class.phpmailer.php';
		require_once 'includes/classes/class.smtp.php';
		$mail = new PHPMailer;
	}

	if ( isset( $to ) ) {
		$to = $to;
	}
 
	if ( !is_array( $to ) ) {
		$to = explode( ',', $to );
	}

	// Headers
	$cc = $bcc = $reply_to = array();

	// $mail->SMTPDebug = 2;

	if ( $phpbb2_board_config['smtp_delivery'] == '1' ):

		$mail->Host = $phpbb2_board_config['smtp_host'];
		$mail->Port = $phpbb2_board_config['smtp_port'];

		$mail->isSMTP();

		$mail->SMTPSecure = $phpbb2_board_config['smtp_encryption'];

		// if ( $phpbb2_board_config['smtp_encryption'] != 'none' ):
		//     $mail->SMTPSecure = $phpbb2_board_config['smtp_encryption'];
		// endif;

		if ( 'none' === $phpbb2_board_config['smtp_encryption'] ):

			$mail->SMTPSecure  = '';
			$mail->SMTPAutoTLS = false;

		endif;

		if ( $phpbb2_board_config['smtp_auth'] == 1 ):

			$mail->SMTPAuth = true;
			$mail->Username = $phpbb2_board_config['smtp_username'];

			if( defined('SMTP_Password') && SMTP_Password ):
				$mail->Password = SMTP_Password;
			else:
				$mail->Password = $phpbb2_board_config['smtp_password'];
			endif;

		else:
			$mail->SMTPAuth = false;
		endif;

	else:
		$mail->IsMail();
	endif;

	/* sort the headers */
	if ( empty( $headers ) ) 
	{
		$headers = array();
	}
	else
	{
		if ( !is_array( $headers ) ) {
			// Explode the headers out, so this function can take both
			// string headers and an array of headers.
			$tempheaders = explode( "\n", str_replace( "\r\n", "\n", $headers ) );
		} 
		else 
		{
			$tempheaders = $headers;
		}

		// If it's actually got contents
		if ( !empty( $tempheaders ) ) {
			// Iterate through the raw headers
			foreach ( (array) $tempheaders as $header ) {
				if ( strpos($header, ':') === false ) {
					if ( false !== stripos( $header, 'boundary=' ) ) {
						$parts = preg_split('/boundary=/i', trim( $header ) );
						$boundary = trim( str_replace( array( "'", '"' ), '', $parts[1] ) );
					}
					continue;
				}
				// Explode them out
				list( $name, $content ) = explode( ':', trim( $header ), 2 );
 
				// Cleanup crew
				$name    = trim( $name    );
				$content = trim( $content );
 
				switch ( strtolower( $name ) ) 
				{
					case 'from':
						$bracket_pos = strpos( $content, '<' );
						if ( $bracket_pos !== false ) {
							// Text before the bracketed email is the "From" name.
							if ( $bracket_pos > 0 ) {
								$from_name = substr( $content, 0, $bracket_pos - 1 );
								$from_name = str_replace( '"', '', $from_name );
								$from_name = trim( $from_name );
							}
 
							$from_email = substr( $content, $bracket_pos + 1 );
							$from_email = str_replace( '>', '', $from_email );
							$from_email = trim( $from_email );
 
						// Avoid setting an empty $from_email.
						} elseif ( '' !== trim( $content ) ) {
							$from_email = trim( $content );
						}
						break;
					case 'content-type':
						if ( strpos( $content, ';' ) !== false ) {
							list( $type, $charset_content ) = explode( ';', $content );
							$content_type = trim( $type );
							if ( false !== stripos( $charset_content, 'charset=' ) ) {
								$charset = trim( str_replace( array( 'charset=', '"' ), '', $charset_content ) );
							} elseif ( false !== stripos( $charset_content, 'boundary=' ) ) {
								$boundary = trim( str_replace( array( 'BOUNDARY=', 'boundary=', '"' ), '', $charset_content ) );
								$charset = '';
							}
 
						// Avoid setting an empty $content_type.
						} elseif ( '' !== trim( $content ) ) {
							$content_type = trim( $content );
						}
						break;
					case 'cc':
						$cc = array_merge( (array) $cc, explode( ',', $content ) );
						break;
					case 'bcc':
						$bcc = array_merge( (array) $bcc, explode( ',', $content ) );
						break;
					case 'reply-to':
						$reply_to = array_merge( (array) $reply_to, explode( ',', $content ) );
						break;
					default:
						// Add it to our grand headers array
						$headers[trim( $name )] = trim( $content );
						break;
				}
			}
		}
	}

	$address_headers = compact( 'to', 'cc', 'bcc', 'reply_to' );
	foreach ( $address_headers as $address_header => $addresses ) 
	{
		if ( empty( $addresses ) ) {
			continue;
		}
 
		foreach ( (array) $addresses as $address ) {
			try {
				// Break $recipient into name and address parts if in the format "Foo <bar@baz.com>"
				$recipient_name = '';
 
				if ( preg_match( '/(.*)<(.+)>/', $address, $matches ) ) {
					if ( count( $matches ) == 3 ) {
						$recipient_name = $matches[1];
						$address        = $matches[2];
					}
				}
 
				switch ( $address_header ) {
					case 'to':
						$mail->addAddress( $address, $recipient_name );
						break;
					case 'cc':
						$mail->addCc( $address, $recipient_name );
						break;
					case 'bcc':
						$mail->addBcc( $address, $recipient_name );
						break;
					case 'reply_to':
						$mail->addReplyTo( $address, $recipient_name );
						break;
				}
			} catch ( phpmailerException $e ) {
				continue;
			}
		}
	}

	if ( !isset( $from_name ) )
		$from_name = $phpbb2_board_config['sitename'];

	if ( !isset( $from_email ) ) 
		$from_email = $nuke_titanium_config['adminmail'];

	$mail->ContentType = ( !isset($content_type) ) ? 'text/plain' : $content_type;
	$mail->CharSet = ( !isset( $charset ) ) ? 'utf-8' : $charset;
	$mail->From = $from_email;
	$mail->FromName = $from_name;

	// Set whether it's plaintext, depending on $content_type
	if ( 'text/html' == $content_type )
		$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body = $message;

	if (!$mail->send()) {
		$mail->ErrorInfo;
		$mail->clearAllRecipients();
		$mail->clearReplyTos();
		OpenTable();
		echo 'Message could not be sent.<br />';
		CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');
		exit;
		// return FALSE;
	} else { 
		$mail->clearAllRecipients();
		$mail->clearReplyTos();      
		return TRUE;
	}
}

/**
 * Gets the variable and runs all the proper sub functions
 *
 * @since 2.0.9e
 *
 * @param string $var the variable to check
 * @param string $loc the location to retrieve the variable
 * @param string $type the type to check against the variable
 * @param string $default the default value to give the variable if there is a failure
 * @param string $minlen the min length to check against variable
 * @param string $maxlen the max length to check against variable
 * @param string $regex the regex to check against the variable
 *
 * @return mixed
 */
function get_query_var($var, $loc, $type='string', $default=null, $minlen='', $maxlen='', $regex='')
{
	global $_GETVAR;
	return $_GETVAR->get($var, $loc, $type, $default, $minlen, $maxlen, $regex);
}

function get_user_IP() 
{
	global $identify;
	return $identify->get_ip();
}

function get_user_agent()
{
	global $identify;
	return $identify->identify_agent();
}

/**
 * Retrieve the "admin.php" file name
 *
 * @global admin_file $admin_file Evolution Xtreme "admin.php" filename.
 */
function get_admin_filename()
{
	global $admin_file;
	return $admin_file;
}

/**
 * Used for grabbing the module name global.
 *
 * @since 2.0.9e
 */
function the_module()
{
	global $titanium_module_name;
	return $titanium_module_name;
}

/**
 * Customize function: Check if request is an AJAX call
 *
 * @since 2.0.9e
 */
function check_is_ajax() 
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Customize function: This function will grab the required image from an image sprite.
 *
 * @since 2.0.9e
 *
 * @param string $class    Add the class of the sprite icon you wish to use.
 * @param string $title    Text to be shown in the title.
 * @param bool   $onclick  An onlclick javascript can be provided.
 * @return string Displays a CSS sprite icon.
 */
function get_evo_icon( $class, $title = '', $onclick = false )
{
	$spriteIcon = '<span'.(($onclick != false) ? ' onclick="'.$onclick.'"' : '').' class="'.$class.'"'.(($title) ? ' title="'.$title.'"' : '').'></span>';
	return $spriteIcon;
}

/**
 * Customize function: This will be the new way to add copyright info to modules, instead of the need to copyright.php in the folder.
 *
 * @since 2.0.9e
 *
 * @param string $file The file you wish to retrieve the comment block header from.
 * @return array Display block comment copyright headers.
 */
function get_copyright_comments( $file ) 
{
	$file_headers = array(
		'Author'            => 'Author',
		'AuthorEmail'       => 'Author Email',
		'AuthorURI'         => 'Author URI',
		'CopyrightHeader'   => 'Copyright Header',
		'Description'       => 'Module Description',
		'DownloadPath'      => 'Module Download Path',
		'License'           => 'Module License',
		'ModuleName'        => 'Module Name',
		'Modifications'     => 'Modifications',
		'Version'           => 'Module Version',
		'ThemeName'         => 'Theme Name',
		'ThemeDesription'   => 'Theme Desription',
		'ThemeCopyright'    => 'Theme Copyright',
		'ThemeVersion'      => 'Theme Version',
		'ThemeLicense'      => 'Theme License',
		'Core'              => 'Core',
		'Engine'            => 'Engine',
		'PoweredBy'         => 'Powered By',
		'MenuName'          => 'Plugin Name',
		'MenuLink'          => 'Plugin URL',
		'MenuIcon'          => 'Plugin Icon',
		'MenuVisible'       => 'Plugin Visible'
	);

	$fp = fopen( $file, 'r' );
	$file_data = fread( $fp, 8192 );
	fclose( $fp );
	$file_data = str_replace( "\r", "\n", $file_data );
	$all_headers = $file_headers;

	foreach ( $all_headers as $field => $regex ) {
		if (preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) 
			&& $match[1])
			 $all_headers[$field] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
		else
			$all_headers[$field] = '';
	}

	return $all_headers;
}

/**
 * Customize function: Trims text to a certain number of words.
 * 
 * @since 2.0.9e
 *
 * @param string $input         Text to trim.
 * @param int    $length        Number of words. Default 55.
 * @param string $ellipses      Optional. What to append if $input needs to be trimmed. Default '&hellip;'.
 * @param bool   $strip_html    Optional. Strip any HTML the $input may have. Default: true.
 * @return string Trimmed text.
 */
function trim_words( $input, $length = 55, $ellipses = '&hellip;', $strip_html = true ) 
{
	//strip tags, if desired
	if ($strip_html):
		$input = strip_tags($input);
	endif;

	//no need to trim, already shorter than trim length
	if (strlen($input) <= $length):
		return $input;
	endif;

	//find last space within length
	$last_space = strrpos(substr($input, 0, $length), ' ');
	if( $last_space !== false ):
		$trimmed_text = substr($input, 0, $last_space);
	else:
		$trimmed_text = substr($input, 0, $length);
	endif;

	if ($ellipses):
		$trimmed_text .= $ellipses;
	endif;

	return $trimmed_text;
}

/**
 * Customize function: Just a more simple way to include the header.php.
 * Will also do a check to see if there is an ajax request, if there is the header will not be included.
 *
 * @since 2.0.9e
 */
function get_header()
{
	if ( !check_is_ajax() ):
		include_once NUKE_BASE_DIR.'header.php';    
	endif;
}

/**
 * Customize function: Just a more simple way to include the footer.php.
 * Will also do a check to see if there is an ajax request, if there is the header will not be included.
 *
 * @since 2.0.9e
 */
function get_footer()
{
	if ( !check_is_ajax() ):
		include_once NUKE_BASE_DIR.'footer.php';    
	endif;
}

/**
 * Customize function: Globalize the image viewing script throughout the site.
 *
 * Lonestar: I plan on adding a more easier way to add new scripts into this function. This will be in the 2.1.0 update.
 *
 * @since 2.0.9e
 *
 * @param string $input  You can provide a unique slideshow gallery name.
 * @param string $length The caption you wish to display.
 * @return string The lightbox data "attr" that jQuery will look for and use the correct lightbox.
 */
function get_image_viewer($slideshow = '',$caption = '')
{
	switch( get_evo_option( 'img_viewer' ) ):

		case 'colorbox':
			/**
			 * jQuery lightbox and modal window plugin.
			 *
			 * @package jquery-colorbox
			 * @author  Jack Moore <hello@jacklmoore.com>
			 * @version 1.6.4
			 * @license GPL-3.0
			 * @link    http://www.jacklmoore.com/colorbox
			 */
			$phpbb2_colorbox  = ' data-colorbox';
			$phpbb2_colorbox .= (($slideshow) ? ' rel="'.$slideshow.'"' : '');
			$phpbb2_colorbox .= (($caption) ? ' title="'.$caption.'"' : '');
			return $phpbb2_colorbox;
			break;

		case 'fancybox':
			/**
			 * Touch enabled, responsive and fully customizable jQuery lightbox script.
			 *
			 * @package @fancyapps/fancybox
			 * @author  fancyApps
			 * @version 3.5.7
			 * @license GPL-3.0
			 * @link    https://fancyapps.com/fancybox/3/
			 */
			$fancybox  = ' data-fancybox';
			$fancybox .= (($slideshow) ? '="'.$slideshow.'"' : '');
			$fancybox .= (($caption) ? ' data-caption="'.$caption.'"' : '');
			return $fancybox;
			break;

		case 'lightbox':
			/**
			 * The original Lightbox script.
			 *
			 * @package Lightbox2
			 * @author  Lokesh Dhakar <lokesh.dhakar@gmail.com>
			 * @version 2.10.0
			 * @license https://raw.githubusercontent.com/lokesh/lightbox2/master/LICENSE  MIT
			 * @link    https://lokeshdhakar.com/projects/lightbox2/
			 *
			 * This lightbox script require a slideshow name to be provided at all times, so i have used gallery as the default, 
			 * Can still be changes via the function call.
			 */
			$lightbox  = ' data-lightbox="'.(($slideshow) ? $slideshow : 'gallery').'"';
			$lightbox .= (($slideshow) ? ' data-title="'.$caption.'"' : '');
			return $lightbox;
			break;

		case 'lightbox-evo':
			/**
			 * jQuery Lightbox Evolution.
			 *
			 * @package Lightbox Evolution
			 * @author  Eduardo Daniel Sada
			 * @version 1.8.1
			 * @license GPL
			 * @link    http://codecanyon.net/item/jquery-lightbox-evolution/115655?ref=aeroalquimia
			 *
			 * This lightbox does not come installed by default, So the required files are not missing.
			 * This script needs to be purchased from the link above.
			 */
			$lightboxevo  = ' data-lightbox-evo';
			$lightboxevo .= (($slideshow) ? ' data-rel="'.$slideshow.'"' : '');
			return $lightboxevo;
			break;

		case 'lightbox-lite':
			/**
			 * Lightweight, accessible and responsive lightbox.
			 *
			 * @package lity
			 * @author  Jan Sorgalla
			 * @version 2.3.1
			 * @license MIT
			 * @link    http://sorgalla.com/lity/
			 */
			$lightboxlite  = ' data-lightbox-lite';
			$lightboxlite .= (($slideshow) ? ' rel="'.$slideshow.'"' : '');
			$lightboxlite .= (($caption) ? ' title="'.$caption.'"' : '');
			return $lightboxlite;
			break;

	endswitch;
}

/**
 * Customize function: Will display a CSS3 or HTML5 progress bar depending on what options you choose.
 *
 * @since 2.0.9e
 *
 * @param string $type          Choose the type of progress bar to show, CSS | HTML5.
 * @param string $class         Provide custom class for the progress bar. Default: "progress-bar blue stripes".
 * @param int    $value         Provide the the lowest set value.
 * @param int    $strip_html    Provide the maximum value.
 * @return string Displays the progress bar.
 */
function display_progress_bar($type='css3',$class='progress-bar blue stripes', $value='0', $max='100')
{
	if ($type == 'css3'):
		$progress_bar  = '<div class="'.$class.'">';
		$progress_bar .= '  <span data-percentage="'.$value.'" style="max-width:100%;"></span>';
		$progress_bar .= '</div>';
	else:
		$progress_bar = '<progress class="'.$class.'" data-percentage="'.$value.'" value="'.$value.'" max="'.$max.'"></progress>';
	endif;
	return $progress_bar;
}

/**
 * Customize function: Add a help icon to explain something.
 * @since 2.0.9e
 */
function display_help_icon( $text, $mode=false )
{
	if ($mode == false):
		return '<span class="tooltip icon-sprite icon-info" title="'.$text.'"></span>';
	elseif ($mode == 'html'):
		return '<span class="tooltip-html icon-sprite icon-info" title="'.$text.'"></span>';
	elseif ($mode == 'interact'):
		return '<span class="tooltip-interact icon-sprite icon-info" title="'.$text.'"></span>';
	endif;
}

/**
 * Customize function: Globally used rating image function.
 *
 * @since 2.0.9e
 *
 * @param string $size      There are two sizes available. large & small.
 * @param int    $rating    There are multiple values for this setting, Settings are as follows "0, 1, 1-5, 2, 2-5, 3, 3-5, 4, 4-5 & 5"
 * @param string $msg       Text to be set as the title.
 * @return string Displays the progress bar.
 */
function the_rating( $size, $rating, $msg = false )
{
	return '<span class="star-rating '.$size.'-stars-'.$rating.'"'.(($msg) ? '  alt="'.$msg.'" title="'.$msg.'"' : '').'></span>';
}



/**
 * Custom function: do a quick check to see if the logged in users has new or unread private messages.
 *
 * @since 2.0.9e
 */
function has_new_or_unread_private_messages()
{
	global $userinfo;
	if ( intval($userinfo['user_new_privmsg']) > 0 ):
		return intval($userinfo['user_new_privmsg']);
	elseif ( intval($userinfo['user_unread_privmsg']) > 0 ):
		return intval($userinfo['user_unread_privmsg']);
	else:
		return 0;
	endif;
}

/**
 * Grab a evolution core setting.
 *
 * @since 2.0.9e
 *
 * @param string  $name      The variable to wish to retrieve.
 * @param mixed   $type      This can be a mixed option, available "string" or "integer".
 * @return mixed  The requested database variable.
 */
function get_evo_option($name, $type='string')
{
	global $titanium_config;
	return ($type == 'string') ? $titanium_config[$name] : intval($titanium_config[$name]);
}

/**
 * Grab a installed theme setting.
 *
 * @since 2.0.9e
 *
 * @param string  $name      The variable to wish to retrieve.
 * @param mixed   $type      This can be a mixed option, available "string" or "integer".
 * @return mixed  The requested theme setting.
 */
function get_theme_option($name, $type='string')
{
	global $ThemeInfo;
	return ($type == 'string') ? $ThemeInfo[$name] : intval($ThemeInfo[$name]);
}

/**
 * This will be used quite alot throughout the site, For such things as CMS, Block, Module & Theme version chekcing. 
 *
 * @since 2.0.9e
 *
 * @param string  $version_check_url     The url to the json file containing the version information.
 * @param string  $local_cache_location  The local json file storage folder
 * @param bool    $force_refresh         Choose whether to force an update, Default: false.
 * @return array  Return a json object with all the version information.
 */
function cache_json_data($version_check_url,$local_cache_location,$force_refresh = false,$headers = '[],$cache_time = 86400') 
{
	$url = $version_check_url;
	$cache = $local_cache_location;

	if(file_exists($cache)):
		if ((time() - filemtime($cache) ) > ($cache_time) || 0 == filesize($cache)):
			$force_refresh = true;
		endif;
	endif;

	if ( $force_refresh || !file_exists( $cache ) ):

		# create a new cURL resource
		$ch = curl_init();

		# set URL and other appropriate options
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_FAILONERROR, true );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 7 );

		if ( !empty( $headers ) || $headers == null ):
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		endif;

		# grab URL and pass it to the browser
		$response = curl_exec( $ch );

		# close cURL resource, and free up system resources
		curl_close( $ch );

		if ( get_file_extension( $version_check_url ) == 'xml' && ini_get('allow_url_fopen') == true ):
			$xml = simplexml_load_file( $version_check_url );
			$jsoncache = json_encode( $xml );
		else:
			$jsoncache  = $response;
		endif;

		# Insert json information into a locally stored file, This will prevent slow page load time from slow hosts.
		$handle = fopen( $cache, 'wb' ) or die( 'no fopen' );   
		fwrite( $handle, $jsoncache );
		fclose( $handle );

	else:
		# Retrieve the json cache from the locally stored file
		$jsoncache = file_get_contents( $cache );
	endif;

	$jsonobject = json_decode( $jsoncache, true );
	return $jsonobject;
}

/**
 * Custom function: Changes a timestamp from a date string to exactly how many "seconds, minutes, hours, days, months or years" the user posted or visited. 
 *
 * @since 2.0.9e
 *
 * @param string $ptime The timestamp you wish to be converted.
 * @return string Return modified timestamp.
 */
function get_timeago( $ptime )
{
	$estimate_time = time() - $ptime;

	if( $estimate_time < 1 )
		return 'secs ago';

	$condition = array( 
				12 * 30 * 24 * 60 * 60  =>  'year',
				30 * 24 * 60 * 60       =>  'month',
				24 * 60 * 60            =>  'day',
				60 * 60                 =>  'hour',
				60                      =>  'min',
				1                       =>  'sec'
	);

	foreach( $condition as $secs => $str )
	{
		$d = $estimate_time / $secs;

		if( $d >= 1 )
		{
			$r = round( $d );
			return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
		}
	}
}

/**
 * Appends a trailing slash.
 *
 * @since 2.0.9e
 *
 * Will remove trailing forward and backslashes if it exists already before adding
 * a trailing forward slash. This prevents double slashing a string or path.
 *
 * The primary use of this is for paths and thus should be used for paths. It is
 * not restricted to paths and offers no specific path support.
 *
 * @param  string $string What to add the trailing slash to.
 * @return string String with trailing slash added.
 */
function trailingslashit( $string ) {
	return untrailingslashit( $string ) . '/';
}

/**
 * Removes trailing forward slashes and backslashes if they exist.
 *
 * @since 2.0.9e
 *
 * The primary use of this is for paths and thus should be used for paths. It is
 * not restricted to paths and offers no specific path support.
 *
 * @param  string $string What to remove the trailing slashes from.
 * @return string String without the trailing slashes.
 */
function untrailingslashit( $string ) {
	return rtrim( $string, '/\\' );
}

/**
 *  Strip those annoying back slashes.
 *
 * @since 2.0.9e
 *
 * @param  string $string What to remove the back slashes from.
 * @return string String without the backslashes.
 */
function stripslashes_deep( $string )
{
	return str_replace('\\', '', $string);
}

/**
 * Escapes data for use in a MySQL query.
 *
 * @since 2.0.9e
 *
 * @global db $titanium_db Evolution Xtreme database abstraction object.
 *
 * @param string|array $data Unescaped data
 * @return string|array Escaped data
 */
function esc_sql( $data ) {
	global $titanium_db;
	return $titanium_db->sql_escapestring( $data );
}

/**
 * Shorten a URL, to be used as link text.
 *
 * @since 2.0.9e
 *
 * @param string $url    URL to shorten.
 * @param int    $length Optional. Maximum length of the shortened URL. Default 35 characters.
 * @return string Shortened URL.
 */
function url_shorten( $url, $length = 35 ) {
	$stripped  = str_replace( array( 'https://', 'http://', 'www.' ), '', $url );
	$short_url = untrailingslashit( $stripped );

	if ( strlen( $short_url ) > $length ) {
		$short_url = substr( $short_url, 0, $length - 3 ) . '&hellip;';
	}
	return $short_url;
}

/**
 * Retrieve the users avatar info from the database.
 *
 * @since 2.0.9e
 *
 * @global db $titanium_db Evolution Xtreme database abstraction object.
 * @global board_config $phpbb2_board_config Forum configuration variable.
 * @global userinfo $userinfo Get the logged in users account information.
 */
function get_user_avatar($titanium_user_id) {
	global $titanium_db, $phpbb2_board_config, $userinfo;
	static $avatarData;

	if(is_array($avatarData[$titanium_user_id]) && !empty($avatarData[$titanium_user_id])) { return $avatarData[$titanium_user_id]; }
	if ( $titanium_user_id == $userinfo['user_id'] ) {
		 $titanium_user_avatar       = $userinfo['user_avatar'];
		 $titanium_user_avatar_type  = $userinfo['user_avatar_type'];
		 $titanium_user_avatar_allow = $userinfo['user_allowavatar'];
		 $titanium_user_avatar_show  = $userinfo['user_showavatars'];
	} else {
		list($titanium_user_avatar, $titanium_user_avatar_type, $titanium_user_avatar_allow, $titanium_user_avatar_show) = $titanium_db->sql_ufetchrow("SELECT user_avatar, user_avatar_type, user_allowavatar, user_showavatars FROM ".USERS_TABLE." WHERE user_id = '" . $titanium_user_id . "' LIMIT 1");
	}
	$phpbb2_poster_avatar = '';
	if ( $titanium_user_avatar_type && $titanium_user_id != ANONYMOUS && $titanium_user_avatar_allow && $titanium_user_avatar_show && !empty($titanium_user_avatar)) {
		switch( $titanium_user_avatar_type ) {
			case USER_AVATAR_UPLOAD:
				$phpbb2_poster_avatar = ( $phpbb2_board_config['allow_avatar_upload'] ) ? avatar_resize($phpbb2_board_config['avatar_path'] . '/' . $titanium_user_avatar) : '';
				break;
			case USER_AVATAR_REMOTE:
				$phpbb2_poster_avatar = avatar_resize($titanium_user_avatar);
				break;
			case USER_AVATAR_GALLERY:
				$phpbb2_poster_avatar = ( $phpbb2_board_config['allow_avatar_local'] ) ? avatar_resize($phpbb2_board_config['avatar_gallery_path'] . '/' . $titanium_user_avatar) : '';
				break;
		}
	}
	$default_member_avatar = evo_image('avatar_member.png', 'Forums');
	$default_guest_avatar  = evo_image('avatar_guest.png', 'Forums');
	if ( empty($phpbb2_poster_avatar) && $titanium_user_id != ANONYMOUS) {
		$phpbb2_poster_avatar = '<img class="rounded-corners-user-info" src="'.  $default_member_avatar .'" alt="" border="0" />';
	}
	if ( $titanium_user_id == ANONYMOUS ) {
		$phpbb2_poster_avatar = '<img class="rounded-corners-user-info" src="'.  $default_guest_avatar .'" alt="" border="0" />';
	}
	$avatarData[$titanium_user_id] = $poser_avatar;
	return ($phpbb2_poster_avatar);
}

// evo_image function by ReOrGaNiSaTiOn
function get_evo_image($imgfile='', $mymodule='') {
	global $currentlang, $ThemeSel, $Default_Theme, $cache;
	$tmp_imgfile = explode('.', $imgfile);
	$cache_imgfile = $tmp_imgfile[0];
	$evoimage = $cache->load($mymodule, 'EvoImage');
	if(!empty($evoimage[$ThemeSel][$currentlang][$cache_imgfile])) {
		return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);
	}

	if (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/$mymodule/lang_".$currentlang."/$imgfile";
	} elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/lang_".$currentlang."/$imgfile";
	} elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/$mymodule/$imgfile";
	} elseif (@file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/$imgfile";
	} elseif (@file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/$mymodule/lang_".$currentlang."/$imgfile";
	} elseif (@file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/lang_' . $currentlang . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/lang_".$currentlang."/$imgfile";
	} elseif (@file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/$mymodule/$imgfile";
	} elseif (@file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/$imgfile";
	} elseif (@file_exists(NUKE_MODULES_DIR . $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "modules/".$mymodule."/images/lang_".$currentlang."/$imgfile";
	} elseif (@file_exists(NUKE_MODULES_DIR . $mymodule . '/images/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] =  "modules/".$mymodule."/images/$imgfile";
	} elseif (@file_exists(NUKE_IMAGES_DIR . $mymodule . '/' . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "images/".$mymodule."/$imgfile";
	} elseif (@file_exists(NUKE_IMAGES_DIR . $imgfile)) {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = "images/$imgfile";
	} else {
		$evoimage[$ThemeSel][$currentlang][$cache_imgfile] = '';
	}
	$cache->save($mymodule, 'EvoImage', $evoimage);
	return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);
}

/**
 * Administration URL.
 *
 * @return string User registration URL.
 */
function get_mod_admin_uri()
{
	$op = get_query_var( 'op', 'get', 'string' );
	return get_admin_filename().'.php?op='.$op;
}

/**
 * Gets the translated string from the language definition.
 *
 * @global $admlang, $customlang
 *
 * @param string    $titanium_lang         Language define you wish to have translated.
 * @param string    $var          Variable name of the language locale.
 * @return string   Translated string.
 */
if( !function_exists('__') ):

	function __( $titanium_lang, $var = 'customlang', $titanium_module_name = '' ) 
	{
		global $$var;
		if ( empty($titanium_module_name) ):
			return $$var[the_module()][$titanium_lang];
		else:
			return $$var[$titanium_module_name][$titanium_lang];
		endif;
	}

endif;

/**
 * echo the translated text
 *
 * @param string $text Text to be translated.
 * @return string
 */
function _e( $titanium_lang, $var = 'customlang', $titanium_module_name = '' )
{
	echo __( $titanium_lang, $var, $titanium_module_name );
}

function sprintf__( $titanium_lang, $var = 'customlang', $titanium_module_name = '', $replacement='' )
{
	$sprintf__ = vsprintf( __( $titanium_lang, $var, $titanium_module_name ), $replacement );
	return $sprintf__;
}

function sprintf_e( $titanium_lang, $var = 'customlang', $titanium_module_name = '', $replacement='' )
{
	$sprintf__ = vsprintf( __( $titanium_lang, $var, $titanium_module_name ), $replacement );
	echo $sprintf__;
}

/**
 * Get the users info from the stored "userinfo" variable.
 *
 * @param string $field The field you want to retrieve.
 * @return mixed The de-slashed content.
 */
function get_userinfo( $field )
{
	global $userinfo;
	return $userinfo[ $field ];
}

/**
 * Filters for content to remove unnecessary slashes.
 *
 * @param string $content The content to modify.
 * @return string The de-slashed content.
 */
if ( !function_exists( 'deslash' ) ):
	
	function deslash( $content ) 
	{ 
		/**
		 * Replace one or more backslashes followed by a single quote with
		 * a single quote.
		 */
		$content = preg_replace( "/\\\+'/", "'", $content );
	 
		/**
		 * Replace one or more backslashes followed by a double quote with
		 * a double quote.
		 */
		$content = preg_replace( '/\\\+"/', '"', $content );
	 
		// Replace one or more backslashes with one backslash.
		$content = preg_replace( '/\\\+/', '\\', $content );
	 
		return $content;
	}

endif;

/**
 * add a Stylesheet into the header.
 *
 * @param mixed $filename
 * @param string $type
 * @param bool $mtime
 * @return void
 */
function add_css_to_head( $filename, $type = 'file', $version = null )
{
	global $headCSS;
	if ( $version != null && $type == 'file' ):
		addCSSToHead( $filename . '?v='.$version, $type );
	else:
		addCSSToHead( $filename, $type );
	endif;
}

/**
 * add a Javscript into the header.
 *
 * @param mixed $filename
 * @param string $type
 * @param bool $mtime
 * @return void
 */
function add_js_to_head( $filename, $type = 'file', $version = null )
{
	if ( $version != null && $type == 'file' ):
		addJSToHead( $filename . '?v='.$version, $type );
	else:
		addJSToHead( $filename, $type );
	endif;
}

/**
 * add a Javscript into the body.
 *
 * @param mixed $filename
 * @param string $type
 * @param bool $mtime
 * @return void
 */	
function add_js_to_body( $filename, $type = 'file', $version = null )
{
	if ( $version != null && $type == 'file' ):
		addJSToBody( $filename . '?v='.$version, $type );
	else:
		addJSToBody( $filename, $type );
	endif;
}

/**
 * Get the file extension.
 *
 * @param mixed $file
 * 
 * @return string[]|string
 */
function get_file_extension( $file )
{
	$extension = pathinfo( $file, PATHINFO_EXTENSION );
	return $extension;
}

/**
 * Get the file basename.
 *
 * @param mixed $file
 * 
 * @return string[]|string
 */
function get_file_basename( $file )
{
	$basename = pathinfo( $file, PATHINFO_FILENAME );
	return $basename;
}

/**
 * Get the file directory name.
 *
 * @param mixed $file
 * 
 * @return string[]|string
 */
function get_file_directory( $file )
{
	$dirname = pathinfo( $file, PATHINFO_DIRNAME );
	return $dirname;
}

/**
 * Get the filename.
 *
 * @param mixed $file
 * 
 * @return string[]|string
 */
function get_file_name( $file )
{
	$filename = pathinfo( $file, PATHINFO_FILENAME );
	return $filename;
}

function get_bootstrap_pagination()
{
    global $phpbb2_board_config;

    $page      = get_query_var('page', 'get', 'int', 1);

    /*
    'url' => append_titanium_sid('privmsg'.$phpEx.'?folder='.$folder), 
    'total' => $pm_total,
    'per-page' => $phpbb2_board_config['topics_per_page']
    */

    $args = func_get_args();
    foreach ($args as &$a):

        $url = $a['url'];
        $total = $a['total'];
        $per_page = $a['per-page'];
        $next_previous = $a['next-previous'];
        $first_last = $a['first-last'];
        $adjacents = $a['adjacents'];
    
    endforeach;

    if($total > $a['per-page']):

        $total_phpbb2_pages = ceil($total / $a['per-page']);

        if($total_phpbb2_pages <= (1+($adjacents * 2))) 
        {
            $phpbb2_start = 1;
            $phpbb2_end   = $total_phpbb2_pages;
        } 
        else 
        {
            if(($page - $adjacents) > 1) 
            {                 
                //Checking if the current page minus adjacent is greateer than one.
                if(($page + $adjacents) < $total_phpbb2_pages) {  //Checking if current page plus adjacents is less than total pages.
                    $phpbb2_start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number  
                    $phpbb2_end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
                } else {                                   //If current page plus adjacents is greater than total pages.
                    $phpbb2_start = ($total_phpbb2_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
                    $phpbb2_end   = $total_phpbb2_pages;                         //and the end will be the last page number that is total pages number.
                }
            } else {                                       //If the current page minus adjacent is less than one.
                $phpbb2_start = 1;                                //then start will be start from page number 1
                $phpbb2_end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
            }
        }

        $pagination  = '<nav class="bootstrap_pagination" aria-label="bootstrap_pagination">';
        // $pagination .= '<ul class="pagination pagination-sm justify-content-center">';
        $pagination .= '<ul class="pagination justify-content-center">';

        if ( $first_last == true ):
            // Link of the first page
            $pagination .= '  <li class="page-item'.(( $page <= 1 ) ? ' disabled' : '').'"><a class="page-link" href="'.$url.'&amp;page=1">&lt;&lt;</a></li>';
        endif;

        if ( $next_previous == true ):
            // Link of the previous page
            $pagination .= '  <li class="page-item'.(( $page <= 1 ) ? ' disabled' : '').'"><a class="page-link" href="'.$url.'&amp;page='.(( $page > 1 ) ? $page-1 : 1).'">&lt;</a></li>';
        endif;

        // Links of the pages with page number
        for($i=$phpbb2_start; $i<=$phpbb2_end; $i++):
            $pagination .= '  <li class="page-item'.(( $page == $i ) ? ' active' : '').'"><a class="page-link" href="'.$url.'&amp;page='.$i.'">'.$i.'</a></li>';
        endfor;

        if ( $next_previous == true ):
            // Link of the next page
            $pagination .= '  <li class="page-item'.(( $page >= $total_phpbb2_pages ) ? ' disabled' : '').'"><a class="page-link" href="'.$url.'&amp;page='.(( $page < $total_phpbb2_pages ) ? $page+1 : $total_phpbb2_pages).'">&gt;</a></li>';
        endif;

        if ( $first_last == true ):
            // Link of the last page
            $pagination .= '  <li class="page-item'.(( $page >= $total_phpbb2_pages ) ? ' disabled' : '').'"><a class="page-link" href="'.$url.'&amp;page='.$total_phpbb2_pages.'">&gt;&gt;</a>';
        endif;

        $pagination .= '</ul>';
        $pagination .= '</nav>';

        return $pagination;

    else:

        return '';

    endif;
}

function bootstrap_pagination() {

    global $phpbb2_board_config;

    $page      = get_query_var('page', 'get', 'int', 1);
    // $adjacents = 2;

    // $calc           = $phpbb2_board_config['topics_per_page'] * $page;
    // $phpbb2_start          = $calc - $phpbb2_board_config['topics_per_page'];

    $args = func_get_args();
    foreach ($args as &$a):

        $table = $a['table'];
        $where = $a['where'];
        $next_previous = $a['next-previous'];
        $first_last = $a['first-last'];
        $adjacents = $a['adjacents'];
    
    endforeach;

    $result = _db()->sql_ufetchrow("SELECT COUNT(*) AS total FROM $table WHERE $where");

    $request_uri = ( strpos($_SERVER['REQUEST_URI'], "&") !== false ) ? strstr($_SERVER['REQUEST_URI'], '&', true) : $_SERVER['REQUEST_URI'];

    if($result['total'] > $phpbb2_board_config['topics_per_page']):

        $total_phpbb2_pages = ceil($result['total'] / $phpbb2_board_config['topics_per_page']);

        if($total_phpbb2_pages <= (1+($adjacents * 2))) 
        {
            $phpbb2_start = 1;
            $phpbb2_end   = $total_phpbb2_pages;
        } 
        else 
        {
            if(($page - $adjacents) > 1) 
            {                 
                //Checking if the current page minus adjacent is greateer than one.
                if(($page + $adjacents) < $total_phpbb2_pages) {  //Checking if current page plus adjacents is less than total pages.
                    $phpbb2_start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number  
                    $phpbb2_end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
                } else {                                   //If current page plus adjacents is greater than total pages.
                    $phpbb2_start = ($total_phpbb2_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
                    $phpbb2_end   = $total_phpbb2_pages;                         //and the end will be the last page number that is total pages number.
                }
            } else {                                       //If the current page minus adjacent is less than one.
                $phpbb2_start = 1;                                //then start will be start from page number 1
                $phpbb2_end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
            }
        }

        $pagination  = '<nav class="bootstrap_pagination" aria-label="bootstrap_pagination">';
        // $pagination .= '<ul class="pagination pagination-sm justify-content-center">';
        $pagination .= '<ul class="pagination justify-content-center">';

        if ( $first_last == true ):
            // Link of the first page
            $pagination .= '  <li class="page-item'.(( $page <= 1 ) ? ' disabled' : '').'"><a class="page-link" href="'.$request_uri.'&amp;page=1">&lt;&lt;</a></li>';
        endif;

        if ( $next_previous == true ):
            // Link of the previous page
            $pagination .= '  <li class="page-item'.(( $page <= 1 ) ? ' disabled' : '').'"><a class="page-link" href="'.$request_uri.'&amp;page='.(( $page > 1 ) ? $page-1 : 1).'">&lt;</a></li>';
        endif;

        // Links of the pages with page number
        for($i=$phpbb2_start; $i<=$phpbb2_end; $i++):
            $pagination .= '  <li class="page-item'.(( $page == $i ) ? ' active' : '').'"><a class="page-link" href="'.$request_uri.'&amp;page='.$i.'">'.$i.'</a></li>';
        endfor;

        if ( $next_previous == true ):
            // Link of the next page
            $pagination .= '  <li class="page-item'.(( $page >= $total_phpbb2_pages ) ? ' disabled' : '').'"><a class="page-link" href="'.$request_uri.'&amp;page='.(( $page < $total_phpbb2_pages ) ? $page+1 : $total_phpbb2_pages).'">&gt;</a></li>';
        endif;

        if ( $first_last == true ):
            // Link of the last page
            $pagination .= '  <li class="page-item'.(( $page >= $total_phpbb2_pages ) ? ' disabled' : '').'"><a class="page-link" href="'.$request_uri.'&amp;page='.$total_phpbb2_pages.'">&gt;&gt;</a>';
        endif;

        $pagination .= '</ul>';
        $pagination .= '</nav>';

        return $pagination;

    else:

        return '';

    endif;

}
?>
