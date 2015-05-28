<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{
	$fx_section = new FX_Section();
	$fx_page = new FX_Page();
	$fx_page_lang = new FX_PageLang();
	$fx_menu = new FX_Menu();
	$fx_syslang = new FX_SysLang();
	$fx_product = new FX_Product();

	$data = array('deleted' => 0);
	$menu = $fx_menu->getByFilter($data, "", false);
	$all_language = $fx_syslang->getAllLanguage();
	
	if(isset($__FX_PARAMS['id']) and is_numeric($__FX_PARAMS['id']))
	{
		$data = array('fx_page_id' => $__FX_PARAMS['id'], 'deleted' => 0);
		$data_page = $fx_page->getByFilter($data, '', 1);
		$data = array('fx_section_id' => $data_page['fx_section_id'] , 'deleted' => 0);
		$data_section = $fx_section->getByFilter($data, '', 1);

		$data = array('fx_page_id' => $__FX_PARAMS['id']);
		$data_product = $fx_product->getByFilter($data, '', 1);

		if($data_page and $data_section)
		{
			$page_id = $__FX_PARAMS['id'];
			if(isset($_POST['action']) and $_POST['action']=='edit_page')
			{	
				$fx_syslang = new FX_SysLang();
				$all_language = $fx_syslang->getAllLanguage();	
				$error = 0;
				$count_error_image = 0;
				$count_error_fields_required = 0;
				$errors = array();
				foreach ($_POST as $key => $value) 
				{
					$section_id = is_numeric(strlen(trim($_POST[$key]['section_id']))) ? true : false; 
					$section_id = is_numeric(strlen(trim($_POST[$key]['section_id']))) ? true : false;
				    $title_page = strlen(trim($_POST[$key]['title_page'])) ? true : false;
				    
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
					    	$error_image = $_LANG[LANG_SYS]['edit_pag_msg_error_img_inval'];
					    	$errors[$key]['error_image_invalids'] = $error_image;
					    }
					}    
				    if(LANG_SYS == $key and ($section_id == false or $title_page == false))
				    {
				    	$error = $_LANG[LANG_SYS]['edit_pag_msg_error_required']; 
				    	$count_error_fields_required = $count_error_fields_required + 1;
				    	$errors[$key]['error_field_required'] = $error;
				    }  	
				    else if(LANG_SYS != $key and $title_page == false)
				    {
				    	$error = $_LANG[LANG_SYS]['edit_pag_msg_error_required']; 
				    	$count_error_fields_required = $count_error_fields_required + 1;
				    	$errors[$key]['error_field_required'] = $error;
				    }
				}

				if($count_error_image == 0 and $count_error_fields_required == 0)
				{
					$d[LANG_SYS] = $_POST[LANG_SYS];
					$_POST = $d + $_POST; 
					unset($_POST['action']);

					foreach ($_POST as $key => $value)
					{
						$chk_private = trim($_POST[$key]['chk_private']);
						$chk_page_default = trim($_POST[$key]['chk_page_default']);
						$content = $_POST[$key]['content'];
						$start_dt = $_POST[$key]['start_dt'];
						$end_dt = $_POST[$key]['end_dt'];
					    $stock = trim($_POST[$key]['stock']);
					    $price = trim($_POST[$key]['price']);
					    $discount_per = trim($_POST[$key]['discount_per']);
					    $discount_val = trim($_POST[$key]['discount_val']);
					    $hide_no_stock = trim($_POST[$key]['hide_no_stock']);
					    $meta_title = FX_System::saveStrDb(trim($_POST[$key]['meta_title']));
					    $meta_keywords = FX_System::saveStrDb(trim($_POST[$key]['meta_keywords']));
					    $meta_description = FX_System::saveStrDb(trim($_POST[$key]['meta_description']));
					    $comments_type = trim($_POST[$key]['comments_type']);
					    $attch_form = trim($_POST[$key]['attch_form']);
					    
					    if(LANG_SYS == $key)
		    			{
		    				$filter = array('fx_page_id' => $page_id);
					    	$data = $fx_page->getByFilter($filter , "", 1);

		    				$image_name = $image; 
						    if(strlen($image) and $image != 'false')
					    	{
					    		if($data['image'] and file_exists("file/img/page/image/".$data['image']))	
					    		{
					    			unlink('file/img/page/image/'.$data['image']);	
					    		}
					    		$name_valid_image = CC_FileHandler::formatFilename($image);
					    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
					    		CC_FileHandler::uploadFile($image_name, $_FILES[$key]['tmp_name']['image'], "file/img/page/image/", "");
					    	}

					    	$thumbnail_name = $thumbnail;
					    	if(strlen($thumbnail) and $thumbnail != 'false')
					    	{
					    		if($data['thumbnail'] and file_exists("file/img/page/thumbnail/".$data['thumbnail']))	
					    		{
					    			unlink('file/img/page/thumbnail/'.$data['thumbnail']);
					    		}
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


					    	$data_page = array('fx_section_id' => $_POST[$key]['section_id'], 
							    			   'fx_author_id' => '',
						    				   'last_update_dt' => date("Y-m-d H:i:s"),
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
						    				   'private' => $chk_private,
						    				   'page_default' => $chk_page_default
					    				 	  );
					    	if($thumbnail_name == '')
					    	{
					    		unset($data_page['thumbnail']);
					    	}
					    	if($image_name == '')
					    	{
					    		unset($data_page['image']);
					    	}

					    	$update_page = $fx_page->update($data_page, $page_id);

					    	$data_product = array('price' => $price,
					    						  'discount_val' => $discount_val,
					    						  'discount_per' => $discount_per,
					    						  'stock' => $stock,
					    						  'hide_no_stock' => $hide_no_stock 
			    						 		 );
					    	$data = array('fx_page_id' => $page_id);
			    			$fx_product->updateByFilfer($data_product, $data);
		    			}
		    			else
				    	{
				    		if($_POST[$key]['page_lang_id'] == '')
				    		{
				    			$data_page_lang = array('fx_page_id' => $page_id,
				    								'lang' => $key,
				    							    'title' => FX_System::saveStrDb($_POST[$key]['title_page']),
							    				    'title_key' => '',
							    				    'content' => $content,
							    				    'meta_title' => $meta_title,
							    				    'meta_keywords' => $meta_keywords,
							    				    'meta_description' => $meta_description
					    				 		   );
								$fx_page_lang->insert($data_page_lang);
				    		}
				    		else
				    		{
				    			$data_page_lang = array('title' => FX_System::saveStrDb($_POST[$key]['title_page']),
							    				    'title_key' => '',
							    				    'content' => $content,
							    				    'meta_title' => $meta_title,
							    				    'meta_keywords' => $meta_keywords,
							    				    'meta_description' => $meta_description
					    				 		   );
								$filter = array('fx_page_lang_id' => $_POST[$key]['page_lang_id'], 'fx_page_id' => $page_id);
								$fx_page_lang->updateByFilfer($data_page_lang, $filter);
				    		}	
				    	}
					}
					$message = $_LANG[LANG_SYS]['edit_pag_msg_success'];
		    		$data = array('fx_page_id' => $page_id, 'deleted' => 0);
					$data_page = $fx_page->getByFilter($data, '', 1);
					$errors['msg_success'] = $message;	
				}
				else
				{
					foreach ($_POST as $key => $value)
					{
						$data_page_fill[$key] = array('fx_section_id' => $_POST[$key]['section_id'], 
													  'fx_page_id' => $_POST[$key]['page_id'],
												      'title' => $_POST[$key]['title_page'],
						    				          'content' => trim($_POST[$key]['content']),
					    				   	   	      'thumbnail' => $data_page['thumbnail'],
					    				   	   	      'image' => $data_page['image'],
						    				   	      'meta_title' => trim($_POST[$key]['meta_title']),
						    				   	      'meta_keywords' => trim($_POST[$key]['meta_keywords']),
						    				   	      'meta_description' => trim($_POST[$key]['meta_description']),
						    				   	      'private' => $_POST[$key]['chk_private'],
						    				   	      'page_default' => $_POST[$key]['chk_page_default'],
						    				   	      'fx_page_lang_id' => $_POST[$key]['page_lang_id']
					    				   			 );
						if(LANG_SYS == $key)
						{
							unset($data_page_fill[$key]['fx_page_lang_id']);
						}
						if(LANG_SYS != $key)
						{
							unset($data_page_fill[$key]['section_id']);	
							unset($data_page_fill[$key]['fx_page_id']);
							unset($data_page_fill[$key]['thumbnail']);
							unset($data_page_fill[$key]['image']);
						}

						$data_product_fill = array('price' => trim($_POST[LANG_SYS]['price']),
				    						       'discount_val' => trim($_POST[LANG_SYS]['discount_val']),
				    						       'discount_per' => trim($_POST[LANG_SYS]['discount_per']),
				    						       'stock' => trim($_POST[LANG_SYS]['stock']),
				    						       'hide_no_stock' => trim($_POST[LANG_SYS]['hide_no_stock'])
	    						 		      	  );	
					}
				    return $errors;
				}			
			}
		}
		else
		{
			FX_System::redirect(FX_System::url("admin/manager/page"), true); 
		}
	}
	else
	{
		FX_System::redirect(FX_System::url("admin/manager/page"), true); 
	}

	if($_POST['action'] == "deleteimage")
	{	
		if(is_numeric($_POST['page_id']) && strlen($_POST['field']))
		{	
			$upd_fields = array($_POST['field'] => '');
			$filter = array('fx_page_id' => $_POST['page_id']);	
			$data_page = $fx_page->getByFilter($filter , "", 1);
			$fx_page->updateByFilfer($upd_fields, $filter);
			unlink('file/img/page/'.$_POST['field'].'/'.$data_page[$_POST['field']]);
		}
	}
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}