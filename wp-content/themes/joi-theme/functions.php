<?php 

	function print_template_uri($short_uri) {
	    echo get_template_directory_uri() . '/' . $short_uri;
	}


	function send_email($from, $to, $name, $subject, $message, $copy) {
		$multiple_recipients = array($to);
		//if $copy add from to multiple_recipients
		$headers = 'From: '.$name.' <'.$from.'>'."\r\n";
		wp_mail( $to, $subject, $message, $headers );
	}	

?>