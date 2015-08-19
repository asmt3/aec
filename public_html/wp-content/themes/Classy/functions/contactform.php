<?php
/* FindWPConfig - searching for a root of wp */
function FindWPConfig($directory){
	global $confroot;
	foreach(glob($directory."/*") as $f){
		if (basename($f) == 'wp-config.php' ){
			$confroot = str_replace("\\", "/", dirname($f));
			return true;
		}
		if (is_dir($f)){
		$newdir = dirname(dirname($f));
		}
	}
	if (isset($newdir) && $newdir != $directory){
		if (FindWPConfig($newdir)){
			return false;
		}	
	}
	return false;
}
if (!isset($table_prefix)){
	global $confroot;
	FindWPConfig(dirname(dirname(__FILE__)));
	include_once $confroot."/wp-load.php";

}

//email start
function ValidateEmail($email)
{
	/*
	(Name) Letters, Numbers, Dots, Hyphens and Underscores
	(@ sign)
	(Domain) (with possible subdomain(s) ).
	Contains only letters, numbers, dots and hyphens (up to 255 characters)
	(. sign)
	(Extension) Letters only (up to 10 (can be increased in the future) characters)
	*/

	$regex = '/([a-z0-9_.-]+)'. # name

	'@'. # at

	'([a-z0-9.-]+){2,255}'. # domain & possibly subdomains

	'.'. # period

	'([a-z]+){2,10}/i'; # domain extension 

	if($email == '') { 
		return false;
	}
	else {
		$eregi = preg_replace($regex, '', $email);
	}

	return empty($eregi) ? true : false;
}

$post = (!empty($_POST)) ? true : false;

$site_name = get_bloginfo('name');

if($post)
{
	$name = stripslashes($_POST['name']);
	$subject = ''. $site_name .' '. __('Contact Form', 'classy') .'';
	$email = trim($_POST['email']);
	$captcha = trim($_POST['captcha']);
	$to = trim($_POST['to_email']);
	$message = stripslashes($_POST['message']);
	$h = 'From: '.$name.' <'.$email.'>';
	$error = '';

	// Check name

	if(!$name)
	{
		$error .= ''. __('Please enter your name', 'classy') .'.<br />';
	}

	// Check email

	if(!$email)
	{
		$error .= ''. __('Please enter an e-mail address', 'classy') .'.<br />';
	}

	if($email && !ValidateEmail($email))
	{
		$error .= ''. __('Please enter a valid e-mail address', 'classy') .'.<br />';
	}

	// Check message (length)

	if(!$message || strlen($message) < 15)
	{
		$error .= ''. __('Please enter your message. It should have at least 15 characters.', 'classy') .'<br />';
	}
	
	// Check message captcha
	
	if($captcha != '4')
	{
		$error .= ''. __('Your math is wrong. Please try again.', 'classy') .'';
	}
	
	if(!$error) // send email
	{
		$mail = wp_mail($to, $subject, $message, $h,
			 'From: '.$name.' <'.$email.'>\r\n'
			.'Reply-To: '.$email.'\r\n'
			.'X-Mailer: PHP/' . phpversion());

		if($mail)
		{
			echo 'OK';
		}

	}
	else
	{
		echo '<div class="notification_error">'.$error.'</div>'; // set up error div for jQuery/Ajax
	}

}

?>