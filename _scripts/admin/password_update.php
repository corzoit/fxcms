<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{
	FX_System::redirect(FX_System::url("admin/"), true); 
}
list($date,$email,$id_user) = explode("|",base64_decode($__FX_PARAMS['id']));
if(strlen($__FX_PARAMS['id']))
{
	if($date <= date("Y-m-d"))
	{
		if(isset($_POST['action']) and $_POST['action']=='changePassword')
		{
			$sysuser = new FX_SysUser();
			$password = $_POST['password'];
			$repeat_password = $_POST['repeat_password'];
			if(!strlen($password) and !strlen($password))
			{
				$error = $_LANG[LANG_SYS]['pass_upd_msg_error_pass_null'];
			}
			elseif($password == $repeat_password)
			{
				$data = array("password" => md5(trim($password.FX_SALT)));
				$udpate_password = $sysuser->update($data, $id_user);
				if($udpate_password)
				{  	
					$msg = $_LANG[LANG_SYS]['pass_upd_msg_success'];
				?>
					<script type="text/javascript">
						setTimeout(function() { window.location.href = "<?=FX_System::url('admin/login')?>"; }, 5000 );
					</script>
				<?php
				}
			}
			else
			{
				$error =  $_LANG[LANG_SYS]['pass_upd_msg_error_pass_distint'];
			}
		}
	}
	else
	{
		$expired =  $_LANG[LANG_SYS]['pass_upd_msg_error_expired'];
	}
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true);
}
?>