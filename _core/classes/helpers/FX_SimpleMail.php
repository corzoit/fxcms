<?php
	
	class FX_SimpleMail
	{
	    public static function getEmailHeaders($from = "", $cc = "", $bcc = "", $from_name = "")
	    {
			$headers = "From: ".$from."\n"; // Who the email was sent from
			if($cc)
			{
				$headers .= "Cc: ".$cc."\n";
			}
			if($bcc)
			{
				$headers .= "Cc: ".$bcc."\n";
			}
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=windows-1252\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
			$headers .= "Reply-To: ".$from."\n"; // Reply to address
			$headers .= "X-Priority: 1\n"; // The priority of the mail
			return $headers;
		}

	    public static function send($email, $subject, $message, $headers = "", $from = "")
	    {
	    	$headers = $headers ? $headers:self::getEmailHeaders();
	    	if($from)
	    	{
	    		mail($email, $subject, $message, $headers, "-f ".$from)	;
	    	}
	    	else
	    	{
	    		mail($email, $subject, $message, $headers);
	    	}
		}		
	}