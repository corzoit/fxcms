<?php
define ("FX_TEMPLATE","design.php");

if(isset($_SESSION['sysuser_id']))
{
	$fx_design = new FX_Design();

	if(is_numeric($__FX_PARAMS['design_id']))
	{
		$data_design = $fx_design->getById($__FX_PARAMS['design_id']);
	}

	if($_POST['action'] == "saveDesign")
	{
		$obj_design = new FX_Design();
		$design_id = $_POST['design_id'];
		$data = array(
			'name' 			=> $_POST['name'],
			'html_content'  => $_POST['html_content'],
			'status'		=> 1
		);
		try {
			$obj_design->update($data, $design_id);
			$response = array("success" => true);
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