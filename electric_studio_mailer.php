<?php
/*
Plugin Name: Electric Studio Mailer
Plugin URI: http://www.electricstudio.co.uk
Description: Send mail easily
Version: 1.1
Author: James Irving-Swift
Author URI: http://www.irving-swift.com
License: GPL2
*/

include 'lib/install.php';
include 'lib/options.php';

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'esm_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'esm_remove' );

function electric_studio_mailer(){}

function esm_send($from, $to, $content, $subj = "", $fromName = ""){
	$mt = get_option('esm_mail_type');
	$conf = get_option('esm_settings');
	
	if(!is_array($to))
		$to = array($to);
	
	include_once (ABSPATH . WPINC .'/class-phpmailer.php');
	
	if($mt == 'smtp')
		include_once (ABSPATH . WPINC .'/class-smtp.php');
	
	$mail = new PHPMailer();

	// Let PHPMailer use remote SMTP Server to send Email else if not set, use mail()
	if($mt == 'smtp')
		$mail->IsSMTP();
	else
		$mail->IsMail();
	
	// Set the charactor set. The default is 'UTF-8'
	$mail->CharSet = 'UTF-8';

	// Add an recipients.
	foreach($to as $t)
		$mail->AddAddress($t);

	//set mail as HTML
	$mail->IsHTML(true);
	
	// Set the body of the Email.
	$mail->Body = $content;

	// Set "From" segment of header.
	$mail->From = $from;

	// Set addresser's name
	$mail->FromName = $fromName;

	// Set the title
	$mail->Subject = $subj;

	// Set the SMTP server. (if set)
	if($mt == 'smtp'){
		if($conf['host']	!= "")
			$mail->Host			= $conf['host'];
		if($conf['port']	!= "")
			$mail->Port			= $conf['port'];
		if($conf['secure']	!= "" || $conf['secure'] != "none")
			$mail->SMTPSecure	= $conf['secure'];
		if($conf['auth']	!= "")
			$mail->SMTPAuth		= $conf['auth'];
		if($conf['username']!= "")
			$mail->Username		= $conf['username'];
		if($conf['password']!= "")
			$mail->Password		= $conf['password'];
	}
		
	// Send Email.
	$mail->Send();
}
