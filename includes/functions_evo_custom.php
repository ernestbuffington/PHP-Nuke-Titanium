<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

function evo_phpmailer( $to, $subject, $message, $headers = '', $attachments = array() )
{
	global $board_config;
	require("includes/classes/class.phpmailer.php");
    require("includes/classes/class.smtp.php");
    $phpmailer = new PHPMailer( true );

	if ( isset( $to ) ) {
        $to = $to;
    }
 
    if ( !is_array( $to ) ) {
        $to = explode( ',', $to );
    }

    if ( isset( $subject ) ) {
        $subject = $subject;
    }
 
    if ( isset( $message ) ) {
        $message = $message;
    }
 
    if ( isset( $headers ) ) {
        $headers = $headers;
    }
 
    if ( isset( $attachments ) ) {
        $attachments = $attachments;
    }
 
    if ( ! is_array( $attachments ) ) {
        $attachments = explode( "\n", str_replace( "\r\n", "\n", $attachments ) );
    }

    // Headers
    $cc = $bcc = $reply_to = array();

    if ( empty( $headers ) ) {
        $headers = array();
    } else {
        if ( !is_array( $headers ) ) {
            // Explode the headers out, so this function can take both
            // string headers and an array of headers.
            $tempheaders = explode( "\n", str_replace( "\r\n", "\n", $headers ) );
        } else {
            $tempheaders = $headers;
        }
        // $headers = array();
 
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
 
                switch ( strtolower( $name ) ) {
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
                        // die($from_email);
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

	// Empty out the values that may be set
    $phpmailer->clearAllRecipients();
    $phpmailer->clearAttachments();
    $phpmailer->clearCustomHeaders();
    $phpmailer->clearReplyTos();

    // From email and name
    // If we don't have a name from the input headers
    if ( !isset( $from_name ) )
        $from_name = $board_config['sitename'];

    /* If we don't have an email from the input headers default to wordpress@$sitename
     * Some hosts will block outgoing mail from this address if it doesn't exist but
     * there's no easy alternative. Defaulting to admin_email might appear to be another
     * option but some hosts may refuse to relay mail from an unknown domain.
     */
    if ( !isset( $from_email ) ) 
        $from_email = $nukeconfig['adminmail'];

    try {
        $phpmailer->setFrom( $from_email, $from_name, false );
    } catch ( phpmailerException $e ) {
        $mail_error_data = compact( 'to', 'subject', 'message', 'headers', 'attachments' );
        $mail_error_data['phpmailer_exception_code'] = $e->getCode();
        die( $e->getMessage().' : '.$mail_error_data ); 
    }

    $phpmailer->Subject = $subject;
    $phpmailer->Body    = $message;

    $address_headers = compact( 'to', 'cc', 'bcc', 'reply_to' );

    foreach ( $address_headers as $address_header => $addresses ) {
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
                        $phpmailer->addAddress( $address, $recipient_name );
                    	// die($address.','.$recipient_name);
                        break;
                    case 'cc':
                        $phpmailer->addCc( $address, $recipient_name );
                        break;
                    case 'bcc':
                        $phpmailer->addBcc( $address, $recipient_name );
                        break;
                    case 'reply_to':
                        $phpmailer->addReplyTo( $address, $recipient_name );
                        break;
                }
            } catch ( phpmailerException $e ) {
                continue;
            }
        }
    }

	if ( $board_config['smtp_delivery'] == '1' ):

		$settings = explode(':', $board_config['smtp_host']);

		if (is_array($settings) && strlen($settings[1]) > 0){
			$phpmailer->Host = $settings[0];
			$phpmailer->Port = $settings[1];
		} else {
			$phpmailer->Host = $settings[0];
			$phpmailer->Port = 25;
		}

		// $phpmailer->SMTPDebug = 2;

		$phpmailer->isSMTP();
		$phpmailer->SMTPAuth = true;
		$phpmailer->SMTPSecure = 'tls';
		$phpmailer->Username = $board_config['smtp_username'];
		$phpmailer->Password = $board_config['smtp_password'];

	else:
    	$phpmailer->IsMail();
    endif;

    // Set Content-Type and charset
    // If we don't have a content-type from the input headers
    if ( !isset( $content_type ) )
        $content_type = 'text/plain';

    $phpmailer->ContentType = $content_type;

    // Set whether it's plaintext, depending on $content_type
    if ( 'text/html' == $content_type )
        $phpmailer->isHTML( true );

    // If we don't have a charset from the input headers
    if ( !isset( $charset ) )
        $charset = "UTF-8";

	$phpmailer->CharSet = $charset;

	// Set custom headers
    if ( !empty( $headers ) ) {
        foreach ( (array) $headers as $name => $content ) {
            $phpmailer->addCustomHeader( sprintf( '%1$s: %2$s', $name, $content ) );
        }
 
        if ( false !== stripos( $content_type, 'multipart' ) && ! empty($boundary) )
            $phpmailer->addCustomHeader( sprintf( "Content-Type: %s;\n\t boundary=\"%s\"", $content_type, $boundary ) );
    }

    if ( !empty( $attachments ) ) {
        foreach ( $attachments as $attachment ) {
            try {
                $phpmailer->addAttachment($attachment);
            } catch ( phpmailerException $e ) {
                continue;
            }
        }
    }

    // Send!
    try {
        return $phpmailer->send();
    } catch ( phpmailerException $e ) { 
        $mail_error_data = compact( 'to', 'subject', 'message', 'headers', 'attachments' );
        $mail_error_data['phpmailer_exception_code'] = $e->getCode(); 
        return false;
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
	$_getvar = new Evo_Variables();
	$_getvar->variables();
	return $_getvar->get($var, $loc, $type, $default, $minlen, $maxlen, $regex);
}

/**
 * Check if request is an AJAX call
 */
function check_is_ajax() 
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Customize function: This function will grab the required image from an image sprite.
 * @since 2.0.9e
 */
function get_evo_icon($class, $title='', $onclick=false)
{
	$spriteIcon = '<span'.(($onclick != false) ? ' onclick="'.$onclick.'"' : '').' class="'.$class.'"'.(($title) ? ' title="'.$title.'"' : '').'></span>';
	return $spriteIcon;
}

/**
 * Customize function: This will be the new way to add copyright info to modules, instead of the need to copyright.php in the folder.
 * @since 2.0.9e
 */
function get_copyright_comments($file) 
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

function limit_string($input, $length, $ellipses = true, $strip_html = true) 
{
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    if($last_space !== false) {
        $trimmed_text = substr($input, 0, $last_space);
    } else {
        $trimmed_text = substr($input, 0, $length);
    }
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}

/**
 * Customize function: Just a more simple way to include the header.php.
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
 * @since 2.0.9e
 */
function get_image_viewer( $slideshow=false, $caption=false )
{
	switch(get_evo_option('img_viewer')):

		case 'colorbox':
			$colorbox  = ' data-colorbox';
			$colorbox .= (($slideshow) ? ' rel="'.$slideshow.'"' : '');
			$colorbox .= (($caption) ? ' title="'.$caption.'"' : '');
			return $colorbox;
			break;

		case 'fancybox':
			$fancybox  = ' data-fancybox';
			$fancybox .= (($slideshow) ? '="'.$slideshow.'"' : '');
			$fancybox .= (($caption) ? ' data-caption="'.$caption.'"' : '');
			return $fancybox;
			break;

		case 'lightbox':
			$lightbox  = ' data-lightbox';
			$lightbox .= (($slideshow) ? '="'.$slideshow.'"' : '');
			$lightbox .= (($slideshow) ? ' data-title="'.$caption.'"' : '');
			return $lightbox;
			break;

		case 'lightbox-evo':
			$lightboxevo  = ' data-lightbox-evo';
			$lightboxevo .= (($slideshow) ? ' data-rel="'.$slideshow.'"' : '');
			return $lightboxevo;
			break;

		case 'lightbox-lite':
			$lightboxlite  = ' data-lightbox-lite';
			$lightboxlite .= (($slideshow) ? ' rel="'.$slideshow.'"' : '');
			$lightboxlite .= (($caption) ? ' title="'.$caption.'"' : '');
			return $lightboxlite;
			break;

	endswitch;
}

/**
 * Customize function: Will display a CSS3 or HTML5 progress bar depending on what options you choose.
 * @since 2.0.9e
 */
function display_progress_bar($type='css3',$class='progress-bar blue stripes', $value='0', $max='100')
{
	if ($type == 'css3'):
		$progress_bar  = '<div class="'.$class.'">';
	    $progress_bar .= '	<span data-percentage="'.$value.'" style="max-width:100%;"></span>';
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
 * Customize function: Used for grabbing the module name global.
 * @since 2.0.9e
 */
function the_module()
{
	global $module_name;
	return $module_name;
}

/**
 * Customize function: Globally used rating image function.
 * @since 2.0.9e
 */
function the_rating( $size,$rating,$msg=false )
{
	return '<span class="star-rating '.$size.'-stars-'.$rating.'"'.(($msg) ? '  alt="'.$msg.'" title="'.$msg.'"' : '').'></span>';
}

/**
 * Customize function: Used for dynamic page titles, This replaces the old Dynamic Titles mod, which required multiple database queries.
 * @since 2.0.9e
 */
function the_pagetitle()
{
    global $sitename;
    $item_delim         = "&raquo;";
    $module_name        = $_GET['name'];
    $module_name_str    = str_replace(array('-','_'),' ',$module_name);

    # if the user is in the administration panel, simply change the page title to administration.
    if (defined('ADMIN_FILE')):
        $newpagetitle = $item_delim.' Administration';

    # if the user is visiting a module, change the page title to the module name.
    else:
        $newpagetitle = ($module_name) ? $item_delim .' '.$module_name_str : '';
    endif;    
    echo '<title>'.$sitename.' '.$newpagetitle.'</title>';
}

/**
 * Customize function: This is an all in one function for creating input fields.
 * @since 2.0.9e
 */
function __inputfield($parameters = array()) 
{
    $ID       		= !empty( $parameters['ID'] ) ? $parameters['ID'] : null;
    $name      		= !empty( $parameters['name'] ) ? $parameters['name'] : null;
    $maxlength 		= !empty( $parameters['maxlength'] ) ? $parameters['maxlength'] : null;
    $class 			= !empty( $parameters['class'] ) ? $parameters['class'] : null;
    $placeholder 	= !empty( $parameters['placeholder'] ) ? $parameters['placeholder'] : null;
    $required 		= !empty( $parameters['required'] ) ? $parameters['required'] : false;
    $custom_style	= !empty( $parameters['custom_style'] ) ? $parameters['custom_style'] : null;
    $accept			= !empty( $parameters['accept'] ) ? $parameters['accept'] : null;
    $disabled		= !empty( $parameters['disabled'] ) ? $parameters['disabled'] : false;
    $readonly		= !empty( $parameters['readonly'] ) ? $parameters['readonly'] : false;
    $value			= !empty( $parameters['value'] ) ? $parameters['value'] : 0;
    $label			= !empty( $parameters['label'] ) ? $parameters['label'] : null;
    $result			= !empty( $parameters['result'] ) ? $parameters['result'] : null;
    $breakline		= !empty( $parameters['breakline'] ) ? $parameters['breakline'] : false;
    $autocomplete	= !empty( $parameters['autocomplete'] ) ? $parameters['autocomplete'] : false;
    $autofocus		= !empty( $parameters['autofocus'] ) ? $parameters['autofocus'] : false;
    $src			= !empty( $parameters['src'] ) ? $parameters['src'] : null;
    $width			= !empty( $parameters['width'] ) ? $parameters['width'] : null;
    $height			= !empty( $parameters['height'] ) ? $parameters['height'] : null;
    $alt			= !empty( $parameters['alt'] ) ? $parameters['alt'] : null;
    $list			= !empty( $parameters['list'] ) ? $parameters['list'] : null;
    $datalist		= !empty( $parameters['datalist'] ) ? $parameters['datalist'] : null;
    $min			= !empty( $parameters['min'] ) ? $parameters['min'] : null;
    $max			= !empty( $parameters['max'] ) ? $parameters['max'] : null;
    $wrapdiv		= !empty( $parameters['wrapdiv'] ) ? $parameters['wrapdiv'] : null;
    $type			= !empty( $parameters['type'] ) ? $parameters['type'] : null;

    if (empty($parameters)):
    	$input  = __('no-parameters-set');
    	return $input;
    endif;

    if ($wrapdiv !== null):
    	$input .= '<div style="text-align: center;">';
    endif;

    if ($type == 'checkbox' && $label !== null):
    	$input .= '<label for="'.str_replace('[]', '', $name).'">';
    endif;

	// $input  .= '<input type="'.$type.'"';
	$input  .= '<input';

	if ($type !== null):
		$input .= ' type="'.$type.'"';
	elseif ($type == null):
		$input  = __('no-type-parameter-set');
    	return $input;
	endif;

	if ($list == true):
		$input .= ' list="'.$name.'"';
	endif;

	if ($type == 'image' && $src !== null):
		$input .= ' src="'.$src.'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'"';
	endif;

	if ($accept !== null):
		$input .= ' accept="'.$accept.'"';
	endif;

	if ($name !== null):
		$input .= ' name="'.$name.'"';
	endif;

	if ($min !== null):
		$input .= ' min="'.$min.'"';
	endif;

	if ($max !== null):
		$input .= ' max="'.$max.'"';
	endif;

	if ($ID !== null):
		$input .= ' id="'.$ID.'"';
	endif;

	if ($maxlength !== null):
		$input .= ' maxlength="'.$maxlength.'"';
	endif;

	if ($class !== null):
		$input .= ' class="'.$class.'"';
	endif;

	if ($placeholder !== null):
		$input .= ' placeholder="'.$placeholder.'"';
	endif;

	if ($custom_style !== null):

		$input .= ' style="';
		if ( is_array($custom_style) ):

			foreach($custom_style as $style):
				$input .= $style.' ';
			endforeach;

		else:
			$input .= $custom_style;
		endif;
		$input .= '"';

	endif;

	if ($placeholder !== null):
		$input .= ' placeholder="'.$placeholder.'"';
	endif;

	if ($autocomplete == 'off'): //  autocomplete="off"
		$input .= ' autocomplete="'.$autocomplete.'"';
	endif;

	if ($value !== null):
		$input .= ' value="'.$value.'"';
	endif;

	if ($disabled == true):
		$input .= ' disabled';
	endif;

	if ($readonly == true):
		$input .= ' readonly';
	endif;

	if ($required == true):
		$input .= ' required';
	endif;

	if ($autofocus == true):
		$input .= ' autofocus';
	endif;

	// if ($type == 'checkbox' && $result !== null):
	if ($type == 'checkbox'):

		// if (is_numeric($result) || $result === null):
		// 	$input .= ($value == $result && $result != 0) ? ' checked' : '';
		// else:
		// 	$input .= (in_array($value,explode(',', $result))) ? ' checked' : '';
		// endif;
		// $result = ($result !== null) ? 0 : $result;
		$input .= (in_array($value,explode(',', $result))) ? ' checked' : '';
		
	endif;

	$input .= '/>';

	if ($list == true):
		$input .= '<datalist id="'.$name.'">';
		foreach($datalist as $_value):
			$input .= '<option value="'.$_value.'">'.$_value.'</option>';
		endforeach;

		$input .= '</datalist>';
	endif;

	if ($type == 'checkbox' && $label !== null):
    	$input .= $label.'</label>';
    endif;

    if ($wrapdiv !== null):
    	$input .= '</div>';
    endif;

    if($breakline == true):
    	$input .= '<br />';
    endif;

	return $input;
	// $input2 .= ($result === null) ? '0' : $result;
	// return $input2;
}

/**
 * Custom function: do a quick check to see if the logged in users has new or unread private messages.
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
    // return intval($userinfo['user_new_privmsg']);
}

function get_evo_option($name, $type='string')
{
	$evoconfig = load_evoconfig();
	return ($type == 'string') ? $evoconfig[$name] : intval($evoconfig[$name]);
}

/**
 * Custom function: This will be used quite alot throughout the site, For such things as CMS, Block, Module & Theme version checking. 
 * @since 2.0.9e
 */
function get_version_information($version_check_url, $local_cache_location, $force_refresh=false) 
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
?>
