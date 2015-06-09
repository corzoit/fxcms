<?php
define ("FX_TEMPLATE","galery_list.php"); 
if(isset($_SESSION['sysuser_id']))
{		
	$fx_syslang = new FX_SysLang();
	$obj_folder = new FX_Folder();
	$obj_media = new FX_Media();	
	$data_media = $obj_media->getAll();
	$all_language = $fx_syslang->getAllLanguage();
	$folder_id = $_GET['type'] == "page" ? 2 : 3 ; // 2 == PAGE ; 3 === Galery;	
	$data_folder = $obj_folder->getById($folder_id); 
	/* */
		$sub_folder = $obj_folder->getFolderByOwnerld($data_folder['fx_folder_id']); // IF is empty; review
	/* */
	$type_call = $_GET['type'];
	$patron = "%\.(gif|jpe?g|png)$%i";
	$folder = "media/".$data_folder['name']."/";
	$fx_folder_id = $data_folder['fx_folder_id'];
		
	if(!empty(is_numeric($_GET['page_id'])))
	{
		$fx_page_id = $_GET['page_id']; // Id Page_id
		$fx_syslang = new FX_SysLang();
		$obj_page = new FX_Page();
		$obj_pagelang = new FX_PageLang();
		
		$all_language = $fx_syslang->getAllLanguage();			
		
		$data_page = $obj_page->getById($fx_page_id);
		$data_page_lang = $obj_pagelang->getPageLangByPageId($fx_page_id);
		if(!$data_page )
		{
			FX_System::redirect(FX_System::url("admin/page/add"), true); 
		}		
	}

		
	if($_POST['action'] == "uploadImage")
	{
		$file_type = $_POST['file_type'];
		$file_name = $_POST['name'];
		$folder_extra = $_POST['folder_extra'];
		$file_type_img = preg_match($patron, $file_name)?true:false;
		if(count($sub_folder))
		{	
			$folder_extra = $_GET['type'] == "page" ? $folder_extra."/" :"";
			if(preg_match($patron, $file_name)) // Si es uno es imagen si no documento
			{
				$file_type_img = true;
				$folder = $folder.$folder_extra.$sub_folder[0]['name'];
				$fx_folder_id = $sub_folder[0]['fx_folder_id'];
			}
			else
			{
				$folder = $folder.$folder_extra.$sub_folder[1]['name'];
				$fx_folder_id = $sub_folder[1]['fx_folder_id'];
			}
		}

		$options = array(
			'fx_table' 		=> 'fx_media',
			'fx_folder_id'  => $fx_folder_id,
			'fx_folder_name'=> $folder,
			'file_type_img' => $file_type_img,
			'type_call'		=> $type_call
		);

		$upload_handler = new FX_UploadHandler($options);
		exit();
	}
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}





















































/*if(isset($_SESSION['sysuser_id']))
{
	$obj_media = new FX_Media();	
	$data_media = $obj_media->getAll();
	$obj_folder = new FX_Folder();			
	$data_folder = $obj_folder->getById(1);
	$exp_1 = "%\.(gif|jpe?g|png)$%i";
	$exp_2 = "%\.(docx?|xlsx?|rar|zip)$%i";
	$file_img = true;
	$sub_folder = $obj_folder->getFolderByOwnerld($data_folder['fx_folder_id']);
	if($_POST['action'] == "uploadImage")
	{			
		$obj_folder = new FX_Folder();			
		$data_folder = $obj_folder->getById(1);
		if($data_folder)
		{
			$file_type = array("xls", "xlsx", "doc", "docx", "pdf", "rar", "zip");			
			$sub_folder = $obj_folder->getFolderByOwnerld($data_folder['fx_folder_id']);
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
				//'fx_file_path'	=> '',
				//'fx_file_prefix'=> 'fx_media'
			);			
		}
		$upload_handler = new FX_UploadHandler($options);	
		exit();		
	}	
}*/