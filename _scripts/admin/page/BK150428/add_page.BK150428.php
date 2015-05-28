<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{
	//daniel
	$fx_sys = new FX_Sys();
	//daniel

	$fx_menu = new FX_Menu();
	$fx_section = new FX_Section();
	$fx_page = new FX_Page();
	$fx_page_lang = new FX_PageLang();
	$fx_syslang = new FX_SysLang();
	$fx_product = new FX_Product();
	$fx_date = new Fx_Date();
	$all_language = $fx_syslang->getAllLanguage();	

	$data = array('deleted' => 0);
	$menu = $fx_menu->getByFilter($data, "", false);
	
	//daniel
	$fxsys_data = $fx_sys->getById(1); 
	//daniel
	
	if(isset($_POST['action']) and $_POST['action']=='add_page')
	{	
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// exit();
		// date_default_timezone_set('UTC');
		// $datestring = '2014-03-09 09:10:00';
		// echo "datetime america/lima: ".$datestring."<br>";
		// $date = date('Y-m-d H:i:s',strtotime($datestring . ' America/Argentina/Buenos_Aires'));
		// echo "datetime local (america/lima) to utc SAVE db: ".$date."<br>";
		// echo "<hr>";
		// $fx_date = new Fx_Date();
		// echo "datetime local (america/lima): ". $fx_date->convertToLocal($date, false);
		// exit();

		$error = 0;
		$count_error_image = 0;
		$count_error_fields_required = 0;
		$errors = array();
		
		foreach ($_POST as $key => $value)
		{							
			$section = strlen(is_numeric(trim($_POST[$key]['section']))) ? true : false;
		    $title_page =  strlen(trim($_POST[$key]['title_page'])) ? true : false;	
			if(LANG_SYS == $key)
		    {
		    	
			    $thumbnail = '';
			    if(strlen(trim($_FILES[$key]['name']['thumbnail'])))
			    {
			    	$thumbnail = CC_FileHandler::checkFilenameExt($_FILES[$key]['name']['thumbnail'], array('jpg', 'png')) ? $_FILES[$key]['name']['thumbnail'] : 'false';
			    }
			    $image = '';
			    if(strlen(trim($_FILES[$key]['name']['image'])))
			    {
				    $image = CC_FileHandler::checkFilenameExt($_FILES[$key]['name']['image'], array('jpg', 'png')) ? $_FILES[$key]['name']['image'] : 'false';
			    }
			    if($thumbnail == 'false' || $image == 'false')
			    {
			    	$count_error_image = $count_error_image + 1;
			    	$error_image = $_LANG[LANG_SYS]['add_pag_msg_error_img_inval'];
			    	$errors[$key]['error_image_invalids'] = $error_image;
			    }
			}
			if(LANG_SYS == $key and ($section == false or $title_page == false))
		    {

		    	$error = $_LANG[LANG_SYS]['add_pag_msg_error_required'];
		    	$count_error_fields_required = $count_error_fields_required + 1;
		    	$errors[$key]['error_field_required'] = $error; 
		    }  	
		    else if(LANG_SYS != $key and $title_page == false)
		    {
		    	$error = $_LANG[LANG_SYS]['add_pag_msg_error_required'];
		    	$count_error_fields_required = $count_error_fields_required + 1;
		    	$errors[$key]['error_field_required'] = $error;
		    } 
		} 
		if($count_error_image == 0 and $count_error_fields_required == 0)
		{
			/*echo("<pre>");
			print_r($_POST);
			echo("</pre>");*/
			$d[LANG_SYS] = $_POST[LANG_SYS];
			$_POST = $d + $_POST; 
			unset($_POST['action']);

			foreach ($_POST as $key => $value)
			{
				if(is_array($value))
				{
					$chk_private = trim($_POST[$key]['chk_private']);
					$chk_page_default = trim($_POST[$key]['chk_page_default']);
					$content = $_POST[$key]['content'];
					//echo("<br>STAR_DT:::::::".$_POST[$key]['start_dt']);
					$start_dt = $fx_date->convertTzToUTC($_POST[$key]['start_dt']);
					$end_dt = $fx_date->convertTzToUTC($_POST[$key]['end_dt']);

				    if($_POST['section_type'] == 'Product')
				    {
					    $stock = trim($_POST[$key]['stock']);
					    $price = trim($_POST[$key]['price']);
					    $discount_per = trim($_POST[$key]['discount_per']);
					    $discount_val = trim($_POST[$key]['discount_val']);
					    $hide_no_stock = trim($_POST[$key]['hide_no_stock']);
					}

				    $meta_title = FX_System::saveStrDb(trim($_POST[$key]['meta_title']));
				    $meta_keywords = FX_System::saveStrDb(trim($_POST[$key]['meta_keywords']));
				    $meta_description = FX_System::saveStrDb(trim($_POST[$key]['meta_description']));
				    $comments_type = trim($_POST[$key]['comments_type']);
				    $page_type = trim($_POST[$key]['page_type']);
				    //print_r($_POST); exit();
					$attch_form = trim($_POST[$key]['attch_form']);
					//echo "<br>key: ".$key."<br>";
					if(LANG_SYS == $key)
			    	{
				    	$image_name = $image; 
					    if(strlen($image) and $image != 'false')
				    	{
				    		$name_valid_image = CC_FileHandler::formatFilename($image);
				    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
				    		CC_FileHandler::uploadFile($image_name, $_FILES[$key]['tmp_name']['image'], "file/img/page/image/", "");
				    	}

				    	$thumbnail_name = $thumbnail;
				    	if(strlen($thumbnail) and $thumbnail != 'false')
				    	{
				    		$name_valid_thumbnail = CC_FileHandler::formatFilename($thumbnail);
				    		$thumbnail_name = CC_FileHandler::generateFilenameRandom($name_valid_thumbnail, 5, false);
				    		CC_FileHandler::uploadFile($thumbnail_name, $_FILES[$key]['tmp_name']['thumbnail'], "file/img/page/thumbnail/", "");
				    	}

				    	if($chk_page_default)
				    	{
				    		$filter = array('page_default'=> 1);
				    		$page_last_default = $fx_page->getByFilter($filter, '', 1);
				    		$data = array('page_default' => 0);
				    		$fx_page->update($data, $page_last_default['fx_page_id']);	
				    	}		    	
				    	
				    	$data_page = array('fx_section_id' => $_POST[$key]['section'],
					    				   'fx_author_id' => '',
					    				   'creation_dt' => date("Y-m-d H:i:s"),
					    				   'start_dt' => $start_dt,
					    				   'end_dt' => $end_dt,
					    				   'title' => FX_System::saveStrDb($_POST[$key]['title_page']),
					    				   'title_key' => '',
					    				   'content' => $content,
					    				   'thumbnail' => $thumbnail_name,
					    				   'image' => $image_name,  
					    				   'meta_title' => $meta_title,
					    				   'meta_keywords' => $meta_keywords,
					    				   'meta_description' => $meta_description,
					    				   'comments_type' => $comments_type,
					    				   'page_type' => $page_type,
					    				   'private' => $chk_private,
					    				   'page_default' => $chk_page_default
				    				 	  );
				    	$new_id = $fx_page->insert($data_page);

				    	if($_POST['section_type'] == 'Product')
				    	{
					    	$data_product = array('fx_page_id' => $new_id,
					    						  'price' => $price,
					    						  'discount_val' => $discount_val,
					    						  'discount_per' => $discount_per,
					    						  'stock' => $stock,
					    						  'hide_no_stock' => $hide_no_stock 
					    						 );			    	
					    	$fx_product->insert($data_product);
					    }				    	
			    	}
			    	else
			    	{
			    		$data_page_lang = array('fx_page_id' => $new_id,
						    				    'lang' => $key,
						    				    'title' => FX_System::saveStrDb($_POST[$key]['title_page']),
						    				    'title_key' => '',
						    				    'content' => $content,
						    				    'meta_keywords' => $meta_keywords,
						    				    'meta_description' => $meta_description
				    				 		   );			    	
				    	$fx_page_lang->insert($data_page_lang);
				    	

			    	}
			    }
			}
			if($_POST['editInsertGalery'] == 1)
	    	{	    
	    		$data = array("test" =>$new_id );
	    		echo(json_encode($data));
	    		exit();	    		
	    	}
			unset($_POST);
			$message = $_LANG[LANG_SYS]['add_pag_msg_success']; 
			$errors['msg_success'] = $message;	
		}
		else
		{			
			return $errors;
		}		
	}
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}