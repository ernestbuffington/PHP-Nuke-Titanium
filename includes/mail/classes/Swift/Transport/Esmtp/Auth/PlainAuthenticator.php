<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//@require 'Swift/Transport/Esmtp/Authenticator.php';
//@require 'Swift/Transport/SmtpAgent.php';
//@require 'Swift/TransportException.php';

/**
 * Handles PLAIN authentication.
 * @package Swift
 * @subpackage Transport
 * @author Chris Corbyn
 */
class Swift_Transport_Esmtp_Auth_PlainAuthenticator
  implements Swift_Transport_Esmtp_Authenticator
{
  
  /**
   * Get the name of the AUTH mechanism this Authenticator handles.
   * @return string
   */
  public function getAuthKeyword()
  {
    return 'PLAIN';
  }
  
  /**
   * Try to authenticate the user with $titanium_username and $password.
   * @param Swift_Transport_SmtpAgent $phpbb2_agent
   * @param string $titanium_username
   * @param string $password
   * @return boolean
   */
  public function authenticate(Swift_Transport_SmtpAgent $phpbb2_agent,
    $titanium_username, $password)
  {
    try
    {
      $message = base64_encode($titanium_username . chr(0) . $titanium_username . chr(0) . $password);
      $phpbb2_agent->executeCommand(sprintf("AUTH PLAIN %s\r\n", $message), array(235));
      return true;
    }
    catch (Swift_TransportException $e)
    {
      $phpbb2_agent->executeCommand("RSET\r\n", array(250));
      return false;
    }
  }
  
}
