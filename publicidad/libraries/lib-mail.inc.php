<?php // $Revision: 3830 $

/************************************************************************/
/* Openads 2.0                                                          */
/* ===========                                                          */
/*                                                                      */
/* Copyright (c) 2000-2007 by the Openads developers                    */
/* For more information visit: http://www.openads.org                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


// Set define to prevent duplicate include
define ('LIBMAIL_INCLUDED', true);


/*********************************************************/
/* Send an email                                         */
/*********************************************************/

function phpAds_sendMail ($email, $readable, $subject, $contents)
{
	global $phpAds_config, $phpAds_CharSet;
	
	// Encode header texts if needed according to RFC 2047
	$readable		= phpAds_rfc2047encode($readable);
	$admin_fullname	= phpAds_rfc2047encode($phpAds_config['admin_fullname']);
	$subject		= phpAds_rfc2047encode($subject, false);

	// Build To header
	if (!get_cfg_var('SMTP'))
		$param_to = $readable.' <'.$email.'>';
	else
		$param_to = $email;
	
	// Set default charset to iso-8859-1
	$charset = isset($phpAds_CharSet) ? $phpAds_CharSet : 'iso-8859-1';
	
	// Build additional headers
	$param_headers = "MIME-Version: 1.0\r\n";
	$param_headers .= "Content-Type: text/plain; charset=".$charset."\r\n"; 
	$param_headers .= "Content-Transfer-Encoding: 8bit\r\n";
	
	if (get_cfg_var('SMTP'))
		$param_headers .= 'To: '.$readable.' <'.$email.">\r\n";
	
	$param_headers .= 'From: '.$admin_fullname.' <'.$phpAds_config['admin_email'].'>'."\r\n";
	
	if ($phpAds_config['admin_email_headers'] != '')
		$param_headers .= "\r\n".$phpAds_config['admin_email_headers'];
	
	// Use only \n as header separator when qmail is used
	if ($phpAds_config['qmail_patch'])
		$param_headers = str_replace("\r", '', $param_headers);
	
	// Add \r to linebreaks in the contents for MS Exchange compatibility
	if (!$phpAds_config['qmail_patch'])
		$contents = str_replace("\n", "\r\n", $contents);
	
	return (@mail ($param_to, $subject, $contents, $param_headers));
}


/*********************************************************/
/* Encode text accrding to RFC 2047                      */
/*********************************************************/

function phpAds_rfc2047encode($str, $use_quotes = true)
{
	global $phpAds_CharSet;

	// Set default charset to iso-8859-1
	$charset = isset($phpAds_CharSet) && $phpAds_CharSet ? $phpAds_CharSet : 'iso-8859-1';

	// Do not encode, unless needed
	if (!preg_match('/["\177-\377]/', $str))
		return $use_quotes ? '"'.$str.'"' : $str;

	$ret = '';
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++)
	{
		if (preg_match('/^[ =_\177-\377]$/', $str{$i}))
			$ret .= sprintf('=%02X', ord($str{$i}));
		else
			$ret .= $str{$i};
	}
	
	return '=?'.$charset.'?q?'.$ret.'?=';
}

?>