<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{		
	$obj_media = new FX_Media();		
	$obj_folder = new FX_Folder();			
	$data_folder = $obj_folder->getById(1);
	$sub_folder = $obj_folder->getFolderByOwnerld($data_folder['fx_folder_id']);

	if($_POST['action'] == "uploadImage")
	{			
		$obj_folder = new FX_Folder();				
		if($data_folder)
		{
			$file_type = array("xls", "xlsx", "doc", "docx", "pdf", "rar", "zip");						
			$folder = $data_folder['name']."/".$sub_folder[0]['name'];
			$fx_folder_id = $sub_folder[0]['fx_folder_id'];
			$file_type_img = true;
			if(in_array($_POST['file_type'],$file_type))
			{				
				$folder = $data_folder['name']."/".$sub_folder[1]['name'];
				$fx_folder_id = $sub_folder[1]['fx_folder_id'];
				$file_type_img = false;
			}
			$options = array(
				'fx_table' 		=> 'fx_media',
				'fx_folder_id'  => $fx_folder_id,
				'fx_folder_name'=> "repository/".$folder,
				'file_type_img' => $file_type_img,				
			);			
		}
		$upload_handler = new FX_UploadHandler($options);	
		exit();		
	}

	$data_media = $obj_media->getAll();
	$exp_1 = "%\.(gif|jpe?g|png)$%i";
	$exp_2 = "%\.(docx?|xlsx?|rar|zip)$%i";
	$file_img = true;
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}

?>