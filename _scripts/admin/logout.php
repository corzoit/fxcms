<?php

if(isset($_SESSION['sysuser_id']))
{

	$sysuserLog = new FX_SysUserLog();

	$data = array('logout_dt' => date('Y-m-d H:i:s'));
	
	$filter = array('fxsysuser_log_id' => $_SESSION['user_log_id'], 'fxsysuser_id' => $_SESSION['sysuser_id']);
	
	$sysuserLog->updateByFilfer($data, $filter);
	//$sysuserLog->updateUserLog($_SESSION['user_log_id'], $_SESSION['sysuser_id'], $data);

	session_regenerate_id();

	session_destroy();

	FX_System::redirect(FX_System::url("admin/login"), true); 
}

FX_System::redirect(FX_System::url("admin/login"), true); 

