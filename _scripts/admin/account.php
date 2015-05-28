<?php
define ("FX_TEMPLATE","admin.php"); 
$sysuser = new FX_SysUser();
$sysuser_log = new FX_SysUserLog();
$fx_date = new FX_Date();
$fx_sys = new FX_Sys();
if(isset($_SESSION['sysuser_id']))
{
	//$data_sys = $fx_sys->getAll();
	$data_sys = $fx_sys->getSysAllByStatus();
	$data_user = $sysuser->getById($_SESSION['sysuser_id']);
	if(isset($_POST['action']) and $_POST['action']=='change_account')
	{
		parse_str($_POST['data']);
		$firstname = strlen(trim($firstname)) ? trim($firstname) : '';
		$lastname = strlen(trim($lastname)) ? trim($lastname) : '';
		$email = strlen(trim($email)) ? trim($email) : '';
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) and strlen(trim($email)))
		{
			$error_email_invalid = $_LANG[LANG_SYS]['acc_msg_error_email_invalid'];			
		}
		else
		{
			$email = $email;
		}
		if($change_pass)
		{
			$password = strlen(trim($password)) ? md5(trim($password.FX_SALT)) : '';	
		} 
		else
		{
			$password = $data_user['password'];
		}
		$data = array('email' => $email);
		$check_email = $sysuser->getByFilter($data, "", 1);
		if((($check_email and $email == $data_user['email']) and $password != '' and $firstname != '' and $lastname != '') or (!$check_email and $email != "" and $firstname != '' and $lastname != '' and $password != ""))
		{	
			$data = array('first_name' => FX_System::saveStrDb($firstname),
					      'last_name' => FX_System::saveStrDb($lastname),
					      'email' => $email,
					      'password' => $password
					     );	
			$update_user = $sysuser->update($data, $_SESSION['sysuser_id']); 
			if($update_user)
			{  		
				$_SESSION['username'] = $firstname." ".$lastname;

				$data_user = $sysuser->getById($_SESSION['sysuser_id']);

				$msg_success = $_LANG[LANG_SYS]['acc_msg_success'];

				$data_msg_username = $firstname." ".$lastname;
			}
		}
		else
		{
			if($firstname == "" or $lastname == "" or $password =="" or $email == "")
			{
				$error_field_null = $_LANG[LANG_SYS]['acc_msg_error_fields_null'];
			}
			if($check_email and $email != $data_user['email'])
			{
				$error_email_duplicated = $_LANG[LANG_SYS]['acc_msg_error_email_dupli'];
			}
		}
		$error = '';
		$success = '';
		if($error_field_null or $error_email_duplicated or $error_email_invalid)
		{
			$error = $error_field_null."++".$error_email_duplicated."++".$error_email_invalid;	
			$error = preg_split("/[++]+/", $error);	
			$msg = '';
			$data = false;
			foreach ($error as $value) 
			{
				if($data == true)
				{
					if($value != '')
					{
						$msg .= '<br>';
					}
				}
				if($value != '')
				{
					$data = true;
					$msg .= $value;
				}
			}
			$error = $msg;
		}
		else
		{
			$success = $msg_success;
		?>
		
		<?
		}
		$data = array('error' => $error, 'success' => $success, 'username' => $data_msg_username ? $data_msg_username : '');
		$array = array("a","b","c","d");
		header('Content-type: application/json');
		echo json_encode($data);	
		exit();
	}
	//ajax pagination.
	if($_POST['action'] == 'user_log')
	{
		$num_page = '';
		if(isset($_POST['num_pag']) and $_POST['num_pag'] != '')
		{
			$num_page = $_POST['num_pag'];
		}
		$data = '';
		if(isset($_POST['data']) and is_numeric($_POST['data']))
		{
			$data = $_POST['data'];
		}
		$records = 5;
		$search_contact = $_POST['search'];
		$user_log_count = $sysuser_log->getUserLogCount();
		$user_log_count = $user_log_count['count'];
		$__response = array();
		$pagination = FX_System::getPageNumbering($user_log_count, $num_page, $data, $records); 
		$limit = $pagination['limit'];
		$__response = $sysuser_log->getUserLogAllbyPage($limit);
		$response ='';
		if($__response)
		{
		?>
		<div class="col-sm-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="glyphicon glyphicon-user"></i>
						<?=$_LANG[LANG_SYS]['acc_tbl_log_lbl_title']?>
					</h3>
				</div>
				<div class="panel-body">					
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><?=$_LANG[LANG_SYS]['acc_tbl_lbl_col1']?></th>
						            <th><?=$_LANG[LANG_SYS]['acc_tbl_lbl_col2']?></th>
						            <th><?=$_LANG[LANG_SYS]['acc_tbl_lbl_col3']?></th>
								</tr>
							</thead>
							<tbody class="tBody">
								<?php
								foreach($__response as $key_contact => $value_contact)
								{
								?>
									<tr>
										<td><?=$fx_date->convertToLocal($value_contact['login_dt'], false)?></td>
										<td><?=$fx_date->convertToLocal($value_contact['logout_dt'], false)?></td>
										<td><?=$fx_date->convertToLocal($value_contact['expires_dt'], false)?></td>
									</tr>
								<?php
								}
								?>
								<tr><td align="center" colspan='3'><?=$pagination['numbering']?></td></tr>
							</tbody>
						</table>
					</div>				
				</div>
			</div>
		</div>
		<?			
		}
		else
		{
		?>		
			<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php $_LANG[LANG_SYS]['acc_tbl_msg_error']  ?>
			</div>;
		<?php
		} 
		exit();   
	}
	//End ajax pagination.
	if($_POST['action'] == "changeLanguage")
	{
		$_SESSION['fx_sys_id'] = $_POST['fx_sys_id'];
		var_dump($_SESSION);
		exit();
	}
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}
?>
