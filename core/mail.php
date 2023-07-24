<?php
	class mail
	{
		private $email;
		private $password;
		
		public function __construct()
		{
			$this->email = config::get_instance()->get_authentication_email();
			$this->password = config::get_instance()->get_authentication_password();
		}
		
		/*
		** $from: user@example.com
		** $to: user@example.com, user@example.com, anotheruser@example.com, User <user@example.com>, User <user@example.com>, Another User <anotheruser@example.com>
		*/
		public function send_mail($from, $frm_name, $to, $subject, $message)
		{
			//To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			
			// Additional headers
			$headers .= 'From: '.$frm_name.' <'.$from. ">\r\n";
			$headers .= 'Reply-To: '.$from. "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();
			
			return mail($to, $subject, $message, $headers);
		}
		
		public function send_SMTP_mail($to_email, $to_name, $from_email, $from_name, $subject, $message)
		{
			$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
			$mail->IsSMTP();
			$mail->Host = 'localhost';
			$mail->SMTPAuth = true;
			$mail->Username = $this->email;
			$mail->Password = $this->password;
			$mail->SetFrom($from_email, $from_name);
			$mail->AddAddress($to_email, $to_name);
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			return $mail->Send();
		}
	}
?>