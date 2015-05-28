<?php 
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{	
	$file_type_img = true;
	$obj_folder = new FX_Folder();
	$obj_media = new FX_Media();
	$data_folder = $obj_folder->getById(4);
	$sub_folder = $obj_folder->getFolderByOwnerld($data_folder['fx_folder_id']);
	$folder_extra = isset($_POST['folder_extra'])? "/".$_POST['folder_extra'] : "/";
	$folder = $data_folder['name']."/".$sub_folder[0]['name'].$folder_extra;


	if(!empty(is_numeric($_GET['fx_page_id'])))
	{
		$fx_page_id = $_GET['fx_page_id']; // Id Page_id
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
		$fx_folder_id = $sub_folder[0]['fx_folder_id'];
		$options = array(
			'fx_table' 		=> 'fx_media',
			'fx_folder_id'  => $fx_folder_id,
			'fx_folder_name'=> $folder,
			'file_type_img' => $file_type_img,				
		);	
		$upload_handler = new FX_UploadHandler($options);	
		exit();
	}	

	$data_media = $obj_media->getAll();

	if($_POST['action'] == "showImages")
	{

		foreach ($data_media as $key_media => $value_media) 
 		{	 
 			//echo("<p>".FX_System::url("file/".$folder.$_POST['lang']."/".$value_media['file'])."</p>");
 			if(file_exists("file/".$folder.$_POST['lang']."/".$value_media['file']))
			{				
				$img .= "<a><img style='padding:10px' width='185px' height='180px' src='".FX_System::url("file/".$folder.$_POST['lang']."/".$value_media['file'])."'/></a>";
			}
 		}
	 	echo($img);
		exit();

	}

	
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}