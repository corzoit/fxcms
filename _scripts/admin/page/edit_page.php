<?php
define ("FX_TEMPLATE","admin.php"); 
if(isset($_SESSION['sysuser_id']))
{
	//daniel
	$fx_sys = new FX_Sys();
	$fx_date = new FX_Date();
	//daniel

	$fx_section = new FX_Section();
	$fx_page = new FX_Page();
	$fx_page_lang = new FX_PageLang();
	$fx_menu = new FX_Menu();
	$fx_syslang = new FX_SysLang();
	$fx_product = new FX_Product();

	$data = array('deleted' => 0);
	$menu = $fx_menu->getByFilter($data, "", false);
	$all_language = $fx_syslang->getAllLanguage();

	$fxsys_data = $fx_sys->getById(1); 

	$format_date = $fxsys_data['dt_format'];

	if($format_date == 'd/m/y h:i a')
	{
		$format_d = 'DD/MM/YY hh:mm a';
	}
	
	if(isset($__FX_PARAMS['id']) && is_numeric($__FX_PARAMS['id']))
	{
		$data = array('fx_page_id' => $__FX_PARAMS['id'], 'deleted' => 0);
		$data_page = $fx_page->getByFilter($data, '', 1);
		$data = array('fx_section_id' => $data_page['fx_section_id'] , 'deleted' => 0);
		$data_section = $fx_section->getByFilter($data, '', 1);

		$data = array('fx_page_id' => $__FX_PARAMS['id']);
		$data_product = $fx_product->getByFilter($data, '', 1);

		if($data_page && $data_section)
		{
			$page_id = $__FX_PARAMS['id'];
			if(isset($_POST['action']) && $_POST['action']=='edit_page')
			{	
				$fx_syslang = new FX_SysLang();
				$all_language = $fx_syslang->getAllLanguage();	
				$error = 0;
				$count_error_image = 0;
				$count_error_fields_required = 0;
				$errors = array();
				foreach ($_POST as $key => $value) 
				{
					if(is_array($value))
					{											   
					    if(LANG_SYS == $key)
					    {					
					    	$section_id = strlen(is_numeric(trim($_POST[$key]['section_id']))) ? true : false; 					
						    $title_page = strlen(trim($_POST[$key]['title_page'])) ? true : false;
						    $start_dt =  strlen(trim($_POST[$key]['start_dt'])) ? true : false;
					    	$end_dt =  strlen(trim($_POST[$key]['end_dt'])) ? true : false;
						    $thumbnail = '';
						    $image = '';
						    /*  Check::::
							    if(strlen(trim($_FILES[$key]['name']['thumbnail'])))
							    {
							    	$thumbnail = CC_FileHandler::checkFilenameExt($_FILES[$key]['name']['thumbnail'], array('jpg', 'png')) ? $_FILES[$key]['name']['thumbnail'] : false;
							    }
							    
							    if(strlen(trim($_FILES[$key]['name']['image'])))
							    {
								    $image = CC_FileHandler::checkFilenameExt($_FILES[$key]['name']['image'], array('jpg', 'png')) ? $_FILES[$key]['name']['image'] : false;
							    }

							    if($thumbnail == false || $image == false)
							    {
							    	$count_error_image = $count_error_image + 1;
							    	$error_image = $_LANG[LANG_SYS]['edit_pag_msg_error_img_inval'];
							    	$errors[$key]['error_image_invalids'] = $error_image;
							    }
							*/
						}    
					    
					    if(LANG_SYS == $key && ($section_id == false || $title_page == false || $start_dt == false || $end_dt == false))
					    {
					    	echo("<p>LANG_SYS ==". $key."<p>");
					    	echo("<p>section_id ==". $section_id."<p>");
					    	echo("<p>title_page ==". $title_page."<p>");
					    	echo("<p>start_dt ==". $start_dt."<p>");
					    	echo("<p>end_dt ==". $end_dt."<p>");

					    	$error = $_LANG[LANG_SYS]['edit_pag_msg_error_required']; 
					    	$count_error_fields_required = $count_error_fields_required + 1;
					    	$errors[$key]['error_field_required'] = $error;

					    }  	
					    else if(LANG_SYS != $key && $title_page == false)
					    {
					    	$error = $_LANG[LANG_SYS]['edit_pag_msg_error_required']; 
					    	$count_error_fields_required = $count_error_fields_required + 1;
					    	$errors[$key]['error_field_required'] = $error;
					    }
					}					
				}

				if($count_error_image == 0 && $count_error_fields_required == 0)
				{
					$d[LANG_SYS] = $_POST[LANG_SYS];
					$_POST = $d + $_POST; 
					unset($_POST['action']);

					foreach ($_POST as $key => $value)
					{
						//sprint_r($_POST);
						
						if(is_array($value))
						{
							$chk_private = trim($_POST[$key]['chk_private']);
							$chk_page_default = trim($_POST[$key]['chk_page_default']);
							$content = $_POST[$key]['content'];
							//daniel
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
						    //daniel
						    $meta_title = FX_System::saveStrDb(trim($_POST[$key]['meta_title']));
						    $meta_keywords = FX_System::saveStrDb(trim($_POST[$key]['meta_keywords']));
						    $meta_description = FX_System::saveStrDb(trim($_POST[$key]['meta_description']));
						    $comments_type = trim($_POST[$key]['comments_type']);
						    $page_type = trim($_POST[$key]['page_type']);
						    //echo $comments_type;
						    //exit();
						    $attch_form = trim($_POST[$key]['attch_form']);
						    
						    if(LANG_SYS == $key)
			    			{
			    				$filter = array('fx_page_id' => $page_id);
						    	$data = $fx_page->getByFilter($filter , "", 1);

			    				$image_name = $image; 
							    if(strlen($image) && $image != 'false')
						    	{
						    		if($data['image'] && file_exists("file/img/page/image/".$data['image']))	
						    		{
						    			unlink('file/img/page/image/'.$data['image']);	
						    		}
						    		$name_valid_image = CC_FileHandler::formatFilename($image);
						    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
						    		CC_FileHandler::uploadFile($image_name, $_FILES[$key]['tmp_name']['image'], "file/img/page/image/", "");
						    	}

						    	$thumbnail_name = $thumbnail;
						    	if(strlen($thumbnail) && $thumbnail != 'false')
						    	{
						    		if($data['thumbnail'] && file_exists("file/img/page/thumbnail/".$data['thumbnail']))	
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

						    	//echo "dddddd: ".$comments_type;
						    	//exit();
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
							    				   'page_type' => $page_type,
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

						    	if($_POST['section_type'] == 'Product')
				    			{
							    	$data_product = array('price' => $price,
							    						  'discount_val' => $discount_val,
							    						  'discount_per' => $discount_per,
							    						  'stock' => $stock,
							    						  'hide_no_stock' => $hide_no_stock 
					    						 		 );
							    	$data = array('fx_page_id' => $page_id);
					    			$fx_product->updateByFilfer($data_product, $data);
			    				}
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
					}
					if($_POST[LANG_SYS]['page_type'] == "Gallery")
					{					
						FX_System::redirect(FX_System::url("admin/page/galery/?fx_page_id=".$page_id),true);
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
						if(is_array($value))
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
							    				   	      'comments_type' => $_POST[$key]['comments_type'],
							    				   	      'page_type' => $_POST[$key]['page_type'],
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