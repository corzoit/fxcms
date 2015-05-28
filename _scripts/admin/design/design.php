<?php
define ("FX_TEMPLATE","design.php");

if(isset($_SESSION['sysuser_id']))
{
	if($_POST['action'] == "saveDesign")
	{
		$obj_design = new FX_Design();
		$data = array(
			'name' 			=> $_POST['name'],
			'html_content'  => $_POST['html_content'],
			'status'		=> 1
		);
		try {
			$response = $obj_design->insert($data);	
			$response = is_numeric($response) ? array("success" => true) : array("success" => false);
		} catch (Exception $e) {
			$response = array("success" => false);
		}
				
		echo(json_encode($response));
		exit();
	}	
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}
?>