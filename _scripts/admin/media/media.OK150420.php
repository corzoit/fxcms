<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{	
	if($_POST['action'] == "uploadImage")
	{	
		$obj_folder = new FX_Folder();			
		$data_folder = $obj_folder->getById(1);
		if($data_folder)
		{
			$options = array(
				'fx_table' 		=> 'fx_media',
				'fx_folder_id'  => $data_folder['fx_folder_id'],
				'fx_folder_name'=> "repository/".$data_folder['name']."/",
				'fx_file_path'	=> '',
				'fx_file_prefix'=> ''
			);			
		}
		$upload_handler = new FX_UploadHandler($options);	
		exit();
		/*if($_POST['name'] == "img")
		{
			$data_folder = $obj_folder->getById(2);
		}
		elseif($_POST['name'] == "otros")
		{			
			$data_folder = $obj_folder->getById(3);							
		}		
		if($data_folder)
		{
			$options = array(
				'fx_table' 		=> 'fx_media',
				'fx_folder_id'  => $data_folder['fx_folder_id'],
				'fx_folder_name'=> "repository/media/".$data_folder['name'],
				'fx_file_path'	=> '',
				'fx_file_prefix'=> ''
			);			
		}
		el*//*se
		{
			$data_folder = $obj_folder->getById(1);						
			$options = array(
				'fx_table' 		=> 'fx_media',
				'fx_folder_id'  => $data_folder['fx_folder_id'],
				'fx_folder_name'=> "repository/media/",
				'fx_file_path'	=> '',
				'fx_file_prefix'=> ''
			);			
		}
		$upload_handler = new FX_UploadHandler($options);	
		exit();						*/
	}
	/*elseif()
	{
		$obj_media = new FX_Media();	
		$data_media = $obj_media->getAll();
		$path = "files/repository/media/img/";
		$url = FX_System::url("files/repository/media/img/");	
		foreach ($data_media as $key_data_media => $value_data_media) {
			if($value_data_media['file_type'] == "image/jpeg" || $value_data_media['file_type'] == "image/png")
			{							
				if(file_exists($path.$value_data_media['file']))
				{						
					$html_img .= "<img style='padding:10px' class='img' width='185px' height='180px' class='img-responsive' src='".$url.$value_data_media['file']."'>";		
				}			
			}
		}
		echo($html_img);
	}*/
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}

?>