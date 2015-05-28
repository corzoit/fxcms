<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{
	FX_System::redirect(FX_System::url("admin/"), true); 
}
if(isset($_POST['action']) and $_POST['action']=='login')
{
 	$username = $_POST['username'];
 	$password = md5(trim($_POST['password'].FX_SALT));
 	$sysuser = new FX_SysUser();
	$sysuserLog = new FX_SysUserLog();
	$data = array('email' => $username, 'password' => $password);
	$data_user = $sysuser->getByFilter($data, "", 1);
	if($data_user)
	{  		
		$_SESSION['sysuser_id'] =  $data_user['fxsysuser_id'];
		$_SESSION['username'] = $data_user['first_name']." ".$data_user['last_name'];

		$fecha= new DateTime(date("Y-m-d H:i:s"));
		//$fecha->add(new DateInterval('PT10H2M30S'));
		$fecha->add(new DateInterval('PT5H'));
		//echo date("Y-m-d H:i:s")."<br>";
		//echo "fecha: ".$fecha->format('Y-m-d H:i:s');
		$session_id = session_id();
		$_SESSION['expire_session']	= $fecha->format('Y-m-d H:i:s');
		$data = array("fxsysuser_id" => $data_user['fxsysuser_id'],
					  "session_id" => $session_id,
					  "login_dt" => date("Y-m-d H:i:s"),
					  "expires_dt" => $_SESSION['expire_session']
					 );
		$user_log_id = $sysuserLog->insert($data);
		$_SESSION['user_log_id'] = $user_log_id;
		FX_System::redirect(FX_System::url("admin/"), true); 
	}
	else
	{    
		$error = $_LANG[LANG_SYS]['login_msg_error'];
	} 
}
?>