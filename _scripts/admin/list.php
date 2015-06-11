<?php
define ("FX_TEMPLATE","galery_list.php"); 
if(isset($_SESSION['sysuser_id']))
{	
	//var_dump($_REQUEST); is type :: page, tiny or gallery

	$fx_syslang = new FX_SysLang();
	$obj_folder = new FX_Folder();
	$obj_media = new FX_Media();	
	$data_media = $obj_media->getAll();
	$all_language = $fx_syslang->getAllLanguage();
	$folder_id = $_GET['type'] == "page" ? 2 : 3 ; // 2 == PAGE ; 3 === Galery;	
	$data_folder = $obj_folder->getById($folder_id); 
	
	$type_call = $_GET['type'];
	$patron = "%\.(gif|jpe?g|png)$%i";
	$folder = "media/".$data_folder['name']."/";
	$fx_folder_id = $data_folder['fx_folder_id'];

	/* */
		$sub_folder = $obj_folder->getFolderByOwnerld($data_folder['fx_folder_id']); 
	/* END */

	
	/* check If type is page or gallery show display element a and open de windows _blank  */
		$element_a_ini = "";
		$href = "";
		$target = "";
		$element_a_fin = "";
		$type_tiny = true;
		
		if($_GET['type'] == "page" || $_GET['type'] == "media")
		{
			$element_a_ini = "<a ";
			$element_a_ini_= ">";
			$element_a_fin = "</a>";
			$type_tiny = false;
			$target = "target='_blank'";
		}
	/* END */


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
			if(preg_match($patron, $file_name))
			{
				$file_type_img = true;
				$folder = substr($folder,0,-1)."_".$folder_extra."/".$sub_folder[0]['name']."/";
				$fx_folder_id = $sub_folder[0]['fx_folder_id']."/";
			}
			else
			{
				$folder = substr($folder,0,-1)."_".$folder_extra."/".$sub_folder[1]['name']."/";
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

	
	if($_POST['action'] == "showImages")
	{		
		$folder_file = getFolders($_GET['type'], "_".$_POST['lang']);		
		foreach ($data_media as $key_media => $value_media) 
        {            
        	$href = $type_tiny ? "" : " href='".FX_System::url($folder_file.$value_media['file'])."'";
                
            if(file_exists($folder_file.$value_media['file']))
            {
                if(preg_match($patron, $value_media['file']))
                {                      	
                    $img_html .= "<div class='showDivImage'>".
                    $element_a_ini." $target $href ".$element_a_ini_."<img class='img' src='".FX_System::url($folder_file.$value_media['file'])."'>"
                    .$element_a_fin."<p class='text-center'><a href='Eliminar'>Eliminar</a></p></div>";                    
                }
            }                
        } 
        echo($img_html);
		exit();
	}
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}


$folder_file = getFolders($_GET['type'], "_".$fx_page_id."_".LANG_SYS);  

function getFolders($type, $page_lang="")
{
    $obj_folder = new FX_Folder();
    $folder_media = $obj_folder->getFolderById(1);
    if($type=="page")
    {               
        $folder = $obj_folder->getFolderByOwnerld($folder_media['fx_folder_id'], false);
        $sub_folder = $obj_folder->getFolderByOwnerld($folder[0]['fx_folder_id'], false);            
        $response = "file/".$folder_media['name']."/".$folder[0]['name'].$page_lang."/".$sub_folder[0]['name']."/";
    }
    elseif ($type == "tiny") 
    {
        $folder = $obj_folder->getFolderByOwnerld($folder_media['fx_folder_id'], false);
        $response = "file/".$folder_media['name']."/".$folder['1']['name']."/";
    }     
    
    return $response;
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