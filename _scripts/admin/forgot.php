<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{
	FX_System::redirect(FX_System::url("admin/"), true); 
}
if(isset($_POST['action']) and $_POST['action']=='forgot')
{
	$sysuser = new FX_SysUser();
	$data = array('email' => $_POST['email']);
	$email_user = $sysuser->getByFilter($data, "", 1);
	if($email_user)
	{  	
		$to = $_POST['email'];
		$subject = 'Forgot My Password';
		$encrypt = base64_encode(date("Y-m-d")."|".$_POST['email']."|".$email_user['fxsysuser_id']);
		$url_upd_pass = FX_System::url('admin/password/update/'.$encrypt);
		$message = 'To recover your password, click on the following link: <a href="$url_upd_pass">Change your Password</a>';
		$mail = array('to' => $to,
				  'subject' => $subject,
				  'message' => $message
				 );
		if(CC_FileHandler::send_mail($mail))
		{
			$msg = $_LANG[LANG_SYS]['forgot_msg_success'];
		}
		else
		{
			$error = $_LANG[LANG_SYS]['forgot_msg_failed'];
			$expired = base64_encode(date("2015-12-12")."|".$_POST['email']."|".$email_user['fxsysuser_id']);
			echo '<a href="'.$url_upd_pass.'">prueba</a>.<br>'; 
			$url_upd_pass = FX_System::url('admin/password/update/'.$expired);
			echo '<a href="'.$url_upd_pass.'">prueba expired date</a>.<br>';
		}	
	}
	else
	{   
		$error = $_LANG[LANG_SYS]['forgot_msg_error_email'];
	} 	
}
?>