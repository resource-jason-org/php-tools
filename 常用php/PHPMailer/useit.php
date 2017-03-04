<?php
function mailer($subject = '', $mailBody = '', $to = '') {
	import ( "ORG.Mail.phpmailer" );
	try {
		$mail = new PHPMailer ( true ); //New instance, with exceptions enabled
		$body = $mailBody;
		$body = preg_replace ( '/\\\\/', '', $mailBody ); //Strip backslashes
		switch (C ( 'MAIL_TYPE' )) {
			case 'IsSMTP' :
				$mail->IsSMTP ( true );
				break;
			case 'IsMail' :
				$mail->IsMail ( true );
				break;
			case 'IsSendmail' :
				$mail->IsSendmail ( true );
				break;
			case 'IsQmail' :
				$mail->IsQmail ( true );
				break;
			default :
				$mail->IsSMTP ( true );
		}
		$mail->SMTPAuth = C ( 'MAIL_AUTH' ); // enable SMTP authentication
		$mail->Port = C ( 'MAIL_PORT' ); // set the SMTP server port
		$mail->Host = C ( 'MAIL_SMTP' ); // SMTP server
		$mail->Username = C ( 'MAIL_USERNAME' ); // SMTP server username
		$mail->Password = C ( 'MAIL_PASSWORD' ); // SMTP server password
		$mail->AddReplyTo ( "name@domain.com", "First Last" );
		$mail->From = C ( 'MAIL_SENDER' );
		$mail->FromName = C ( 'MAIL_FROM' );
		$mail->CharSet = "utf-8"; // 这里指定字符集！
		$to = empty ( $to ) ? C ( 'MAIL_ADMIN' ) : $to;
		$mail->AddAddress ( $to );
		$mail->Subject = $subject;
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
		$mail->WordWrap = 80; // set word wrap
		$mail->MsgHTML ( $body );
		$mail->IsHTML ( true ); // send as HTML
		$mail->Send ();
		return 'success';
	} catch ( phpmailerException $e ) {
		return $e->errorMessage ();
	}
}
?>