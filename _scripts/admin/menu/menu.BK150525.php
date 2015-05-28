<?php
define("FX_TEMPLATE","admin.php");	
FX_System::validateAdminLogin();
$obj_fx_menu = new FX_Menu();
$obj_menu_lang = new FX_MenuLang();
$obj_fx_section = new FX_Section();
$obj_fxSysLang = new FX_SysLang();
$obj_fxSys = new FX_Sys();
$obj_fxSectionLang = new FX_SectionLang();
$obj_fxPage = new FX_Page();

$all_menu =  $obj_fx_menu->getAllMenu();
//exit();

/*ADD MENU*/
	if($_POST['action'] == "form-menu" || $_POST['add-menu'])
	{
		if($_POST['add-menu'])
		{
			$creation_dt = date("Y-m-d H:i:s");
			$key_menu = $_POST['pos_menu'];
			$description = 'Menu';
			$private = $_POST['private'];
			$position = 1;
			$deleted = 0;
			$position_menu = $obj_fx_menu->getPositionMenu($key_menu);
			$position = $position_menu['position'] + 1; 
			//data menu
			$data_menu = array(
				'creation_dt' => $creation_dt,
				'key_menu' => $key_menu,
				'description' => $description,
				'private' => $private,
				'position' => $position,
				'deleted' => $deleted,
			);
			$value = $obj_fx_menu->insert($data_menu);
			header('Location: manager');
		}
	?>
		<div class="form-edit-menu .col-lg-12">
			<form role="form" method="POST">		
			    <div class="form-group">
				    <label><?=$_LANG[LANG_SYS]['menu_mng_add_menu_lbl_pos_menu']?></label>
				    <select class="form-control" name = "pos_menu">
				        <option value = "top"><?=$_LANG[LANG_SYS]['menu_mng_add_menu_sel_pos_menu_top']?></option>
				        <option value = "right"><?=$_LANG[LANG_SYS]['menu_mng_add_menu_sel_pos_menu_right']?></option>
				        <option value = "left"><?=$_LANG[LANG_SYS]['menu_mng_add_menu_sel_pos_menu_left']?></option>
				        <option value = "bootom"><?=$_LANG[LANG_SYS]['menu_mng_add_menu_sel_pos_menu_bootom']?></option>
				    </select>
				</div>

				<div class="form-group">
				    <label><?=$_LANG[LANG_SYS]['menu_mng_add_menu_lbl_private']?></label>
				    <select class="form-control" name = "private">
				        <option value = "1"><?=$_LANG[LANG_SYS]['menu_mng_add_menu_sel_yes']?></option>
				        <option value = "0"><?=$_LANG[LANG_SYS]['menu_mng_add_menu_sel_no']?></option>
				    </select>
				</div>
				<button class="btn btn-danger" type = "button" style = "float: right;" onclick="closeFancy()" ><?=$_LANG[LANG_SYS]['menu_mng_add_menu_btn_close']?></button>
				<button type="submit" class="btn btn-primary" name = "add-menu" value = "add-menu"><?=$_LANG[LANG_SYS]['menu_mng_add_menu_btn_save']?></button>
			</form>
		</div>	
	<?php    
	    exit();
	}
/* END ADD MENU  */

/* DELETE MENU */
	if($_POST['action'] == "delete-menu")
	{
		$fx_menu_id = $_POST['menu_id'];
		
		$data = array(
			'deleted' => 1
		);
		$obj_fx_menu->update($data, $fx_menu_id);
		exit();	
	}
/* DELETE MENU */

/* SAVE SECTION BY MENU */
	if($_POST['action'] == "section-save")
	{	
		/*echo("**************");
		var_dump($_FILES);
		echo('***'.$_FILES['section_icon']['name']['es']);
		exit();*/
		$is_insert_section = false;
		$all_language = $obj_fxSysLang->getAllLanguage();
		$success = 0;
		$error = 0;

		$response = array();

		foreach ($all_language as $key => $language) 
		{
			if($_POST['title'][$language] == null)
			{
				$response[] = array(
					'error' => $_LANG[LANG_SYS]['field_add_msg_error_required'].$language);
			}

			//validation image 
		    if(count($_FILES))
		    {
			    if(strlen(trim($_FILES['section_icon']['name'][$language])))
			    {
				    $is_valid_image = CC_FileHandler::checkFilenameExt($_FILES['section_icon']['name'][$language], array('jpg', 'png')) ? $_FILES['section_icon']['name'][$language] : false;
			    }
			    if(!$is_valid_image)
			    {
			    	$error_image = $_LANG[LANG_SYS]['add_ss_msg_error_img_inval'];
			    	
			    	$response[] = array(
						'error' => $error_image);
			    }
		    }	
		}
		//exit error
		if(!empty($response))
		{
			echo(json_encode($response));
			exit();	
		}
		else
		{

			foreach ($all_language as $key => $language) 
			{
				$fileUpload = $_FILES['section_icon']['name'][$language];
				$menu_id = 	$_POST['menu_id'][$language];
				$owner_id = '';
				$creation_dt = date("Y-m-d H:i:s");
				$title = $_POST['title'][$language];
				$intro = $_POST['section_intro'][$language];
				$section_type = $_POST['section_type'][$language];
				$display_type = $_POST['section_display'][$language];
				$icon = ($fileUpload == null) ? '' : $fileUpload;
				$opt_link = (isset($_POST['opt_link'][$language])) ? 1 : 0;
				$link = $_POST['link'][$language];//link
				$link_target = $_POST['link_target'][$language];//_self or _blank 
				$link_external = $_POST['external_link'][$language];// 1 or 0
				$private = (isset($_POST['private'][$language])) ? 1 : 0;
				$deleted = 0;

				if(!$is_insert_section)
				{				
					$image_name = $icon; 
				    if(strlen($icon))
			    	{
			    		$name_valid_image = CC_FileHandler::formatFilename($icon);
			    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
			    		CC_FileHandler::uploadFile($image_name, $_FILES['section_icon']['tmp_name'][$language], "file/img/menu/", "");
			    	}

					//Get position	
					$all_section_by_menu = $obj_fx_section->getNumSectionByMenuId($menu_id);				
					$position = is_array($all_section_by_menu)? $all_section_by_menu['num_section'] + 1 : $all_section_by_menu + 1;
					$data_section = array(
						'fx_menu_id' => $menu_id,
						'owner_id' => $owner_id,
						'creation_dt' => $creation_dt,
						'title' => $title,
						'intro' => $intro,
						'section_type' => $section_type,
						'display_type' => $display_type,
						'icon' => $image_name,
						'opt_link' => $opt_link,
						'link' => $link,
						'link_target' => $link_target,
						'link_external' => $link_external,
						'private' => $private,
						'position' => $position,
						'deleted' => $deleted,
					);
					$section_id = $obj_fx_section->insert($data_section);	
					$is_insert_section = true;
				}
				else
				{					
					$image_name = $icon; 
				    if(strlen($icon))
			    	{
			    		$name_valid_image = CC_FileHandler::formatFilename($icon);
			    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
			    		CC_FileHandler::uploadFile($image_name, $_FILES['section_icon']['tmp_name'][$language], "file/img/menu/", "");
			    	}
					//insert section_lang
					$data_section_lang = array(
						'fx_section_id' => $section_id,
						'lang' => $language,
						'intro' => $intro,
						'title' => $title,
						'icon' => $icon,
						'link' => $link,
						'link_external' => $link_external,
					);
					
					$obj_fxSectionLang->insert($data_section_lang);
					$success++;
				}
			}
			
			$response = array(
				'success' => $_LANG[LANG_SYS]['add_pag_msg_success']);

			echo(json_encode($response));
			exit(); 
		}
	}
/* END SAVE SECTION BY MENU */

/* SHOW FORM SECTION BY MENU */
	if ($_POST['action'] == "add-section-menu")
	{
		$all_language = $obj_fxSysLang->getAllLanguage();
	?>
		<div class="content-error"></div>
		<div class = "tabbable tabs-left">
		    <ul class="nav nav-tabs">
		    	<?php foreach ($all_language as $key => $language): ?>
		    	<?php if ($key == 0 || true): ?>
		        	<li <?=($key == 0)?'class="active"':''?> ><a class = "eyelash-<?=$language?>" data-toggle="tab" href="<?='#'.$language?>"><?=$language?></a></li>	
		        <?php endif ?>
		        <?php endforeach ?>
		    </ul>
		</div> 
		
		<form role="form" method="POST" class = "form" id = "form-main"  enctype="multipart/form-data">	
			<div class="tab-content">
				<?php foreach ($all_language as $key => $language): ?>
				<?php if ($key == 0 || true): ?>
			    <div id="<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"' ?> >
			    	<div class="form-edit-section .col-lg-12" style = "border: 0px !important">
						<input type = "hidden" class = "menu-id" value = "<?echo $_POST['menu_id']?>" name = "menu_id[<?=$language?>]" >	  
		        		
		        		<!--Title-->
		        		<div class="form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_title']?></label>
							<input type="input" class="form-control title-input"  placeholder="<?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_title']?>" name="title[<?=$language?>]"></input>
						</div>

						<!--type -->
						<div class = "section-type form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_type']?></label>
							<div class="form-group">	
								<label class="radio-inline">
								  	<input type="radio" checked="checked" name="section_type[<?=$language?>]" id="inlineRadio1" value="Standard" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_type_standar']?>
								</label>
								<label class="radio-inline">
								  	<input type="radio" name="section_type[<?=$language?>]" id="inlineRadio2" value="Blog" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_type_blog']?>
								</label>
								<label class="radio-inline">
								  	<input type="radio" name="section_type[<?=$language?>]" id="inlineRadio3" value="Product" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_type_product']?>
								</label>
							</div>
						</div>

						<!--Display type -->
						<div class = "section-display form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_display_type']?></label>
							<div class="form-group">	
								<label class="radio-inline">
								  	<input type="radio" checked="checked" name="section_display[<?=$language?>]" id="inlineRadio1" value="List" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_display_type_list']?>
								</label>
								<label class="radio-inline">
								  	<input type="radio" name="section_display[<?=$language?>]" id="inlineRadio2" value="Grid" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_display_type_grid']?>
								</label>
							</div>
						</div>

						<!--Icon, checkbox -->
						<div class="section-icon form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_icon']?></label>
							<input type="file" onchange="readURL(this);" name = "section_icon[<?=$language?>]">
							<div>
								<img id="view-image"  width = "50px" height = "50px"/></input>
							</div>

							<label class="checkbox-inline" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							  	<input type="checkbox" name = "opt_link[<?=$language?>]" id="inlineCheckbox1"> <?=$_LANG[LANG_SYS]['menu_mng_add_sect_chk_link_only']?>
							</label>
							<label class="checkbox-inline" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							  	<input type="checkbox" name = "private[<?=$language?>]" id="inlineCheckbox2"> <?=$_LANG[LANG_SYS]['menu_mng_add_sect_chk_make_priv']?>
							</label>
						</div>

						<!--Radio external link -->
						<div class = "section-external-link form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_ext_link']?></label>
							<div class="form-group" >	
								<label class="radio-inline">
								  	<input  checked="checked" class = "no_external_link" type="radio" name="external_link[<?=$language?>]" value="0" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_ext_link_no']?>
								</label>
								<label class="radio-inline">
								  	<input class = "is_external_link" type="radio" name="external_link[<?=$language?>]" value="1" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_ext_link_yes']?>
								</label>
							</div>
						</div>
				
						<!--Link text, radio buttons same windows, new windows -->
						<div class="section-link-<?=$language?> form-group" style = "display: none">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_link']?></label>
							<input class = "link-externa-text-<?=$language?>" type="input" placeholder="<?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_link']?>" name = "link[<?=$language?>]" ></input>
							
							<label <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_open_in']?></label>
							<div class="form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>	
								<label class="radio-inline"> 
									<input class = "link-external-radio-<?=$language?>" type="radio" checked="checked" name="link_target[<?=$language?>]" id="same-windows" value="_self"> <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_open_in_same_wind']?> 
								</label>
								<label class="radio-inline">
									<input class = "link-external-radio-<?=$language?>" type="radio" name="link_target[<?=$language?>]" id="external-windows" value="_blank"> <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_open_in_new_wind']?>
								</label>
							</div>
						</div>

						<!--Intro-->
						<div class="section-area form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_write_intro_section']?></label>
							<textarea class="form-control" rows="3" name = "section_intro[<?=$language?>]"></textarea>
						</div>
						<input type = "hidden" name = "section_save[<?=$language?>]" value = "section-save">
			        </div>	
			    </div>
			    <?php endif ?>
			    <?php endforeach ?>
			</div>

			<!--Button Edit and Close-->
			<div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<button class="btn btn-primary save-section" type="submit" name = "action" value="section-save"><?=$_LANG[LANG_SYS]['menu_mng_add_sect_btn_save']?></button>
				<button class="btn btn-danger" type="button" onclick="closeFancy()" ><?=$_LANG[LANG_SYS]['menu_mng_add_sect_btn_close']?></button>
			</div>
		</form>
		
		<script>
			$(".no_external_link").click(function()
			{
				var language = $(this).parents('.tab-pane').attr("id");
				
				$('.section-link-'+language).fadeOut('fast');

				$(".link-external-radio-"+language).each(function(i) 
				{
			    	this.checked = false;
				});

				$(".link-externa-text-"+language).val("");//clear link text 
			});

			$(".is_external_link").click(function(){
				var language = $(this).parents('.tab-pane').attr("id");

				$('.section-link-'+language).fadeIn('fast');
				$("#same-windows").prop('checked', true);//set default 
			});

			$(".save-section").click(function(){
				$(".title-input").each(function() 
				{
					valTitle = $(this).val();
			    	if(valTitle == ""){
			    		$(this).parent().addClass("has-error");
			    		language = $(this).parents('.tab-pane').attr("id");
			    		$(".eyelash-"+language).css({"background-color" : "#f2dede", "color" : "#a94442"});
			    	}
			    	else{
			    		$(this).parent().removeClass("has-error");	
			    		language = $(this).parents('.tab-pane').attr("id");
			    		$(".eyelash-"+language).css({"background-color" : "white", "color" : "#428bca"});
			    	}
				});
			});

			//send form
			$(document).ready(function() { 
				$('#form-main').ajaxForm({ 
			    	dataType:'json', 
			    	success: function(data) { 
		            	//console.log(error.success );
		            	if(data.success)
		            	{
		            		alert(data.success);
		            		location.reload();
		            	}
		            	else{
		            		html = "<div class = 'alert alert-danger'>";
			            	for (var i = 0; i < data.length; i++) {
			            		//console.log(error[i].error_language);
			            		html += data[i].error;
			            		html += "</br>"; 
			            	}
			            	html += "</div>";
			            	$(".content-error").html(html);
		            	}
		        	} 
			    }); 
		    }); 

		    function readURL(input) 
		    {
		    	//alert(input);
		        if (input.files && input.files[0]) {
		            var reader = new FileReader();
		            reader.onload = function (e) {
		                $('#view-image')
		                    .attr('src', e.target.result)
		                    .width(50)
		                    .height(50);
		            };
		            reader.readAsDataURL(input.files[0]);
		        }
		    }
		</script>
	<?php   
	    exit();
	}
/* END FORM SECTION BY MENU */

/*ADD SECTION BY SECTION SAVE *///
if($_POST['section-of-section'])
{
	/*var_dump($_FILES);
	echo("-----".$_FILES['section_icon']['name']['es']);
	exit();*/
	$all_language = $obj_fxSysLang->getAllLanguage();
	$is_insert_section = false;
	$success = 0;
	$error = 0;
	
	$response = array();
	foreach ($all_language as $key => $language) 
	{
		if($_POST['title'][$language] == null)
		{
			$response[] = array(
				'error' => $_LANG[LANG_SYS]['field_add_msg_error_required'].$language);
		}	

		//validation image 
	    if(count($_FILES))
	    {
		    if(strlen(trim($_FILES['section_icon']['name'][$language])))
		    {
			    $is_valid_image = CC_FileHandler::checkFilenameExt($_FILES['section_icon']['name'][$language], array('jpg', 'png')) ? $_FILES['section_icon']['name'][$language] : false;
		    }

		    if(!$is_valid_image)
		    {
		    	$error_image = $_LANG[LANG_SYS]['add_ss_msg_error_img_inval'];
		    	
		    	$response[] = array(
					'error' => $error_image);
		    }
	    }	
	}
	//exit error
	if(!empty($response))
	{
		echo(json_encode($response));
		exit();	
	}
	else
	{
		foreach ($all_language as $key_language => $language) 
		{
			$fileUpload = $_FILES['section_icon']['name'][$language];

			$fx_menu_id = '0';
			$owner_id = $_POST['owner_id'][$language];
			$creation_dt = date("Y-m-d H:i:s");
			$title = $_POST['title'][$language];
			$intro = $_POST['section-intro'][$language];
			$section_type = $_POST['section-type'][$language];
			$display_type = $_POST['section-display'][$language];
			$icon = ($fileUpload == null) ? '' : $fileUpload;
			$opt_link = (isset($_POST['opt_link'][$language])) ? 1 : 0;
			$link = $_POST['link'][$language];//link
			$link_target = $_POST['link-target'][$language];//_self or _blank 
			$link_external = $_POST['external-link'][$language];//1 or 0
			$private = (isset($_POST['private'][$language])) ? 1 : 0;
			$deleted = 0;

			if(!$is_insert_section)
			{
				$num_section_by_section = $obj_fx_section->getNumSectionBySectionId($_POST['owner_id'][$language]);
				//$position = is_array($all_section_by_menu)? $all_section_by_menu['num_section'] + 1 : $all_section_by_menu + 1;
				$position = is_array($num_section_by_section) ? $num_section_by_section['num_section'] + 1 : $num_section_by_section + 1;

				//upload image
				$image_name = $icon; 
			    if(strlen($icon))
		    	{
		    		$name_valid_image = CC_FileHandler::formatFilename($icon);
		    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
		    		CC_FileHandler::uploadFile($image_name, $_FILES['section_icon']['tmp_name'][$language], "file/img/menu/", "");
		    	}

				$data_section = array(
					'fx_menu_id' => $fx_menu_id,
					'owner_id' => $owner_id,
					'creation_dt' => $creation_dt,
					'title' => $title,
					'intro' => $intro,
					'section_type' => $section_type,
					'display_type' => $display_type,
					'icon' => $image_name,
					'opt_link' => $opt_link,
					'link' => $link,
					'link_target' => $link_target,
					'link_external' => $link_external,
					'private' => $private,
					'position' => $position,
					'deleted' => $deleted,
				);

				$section_id = $obj_fx_section->insert($data_section);
				$is_insert_section = true;
			}
			else
			{
				//upload image
				$image_name = $icon; 
			    if(strlen($icon))
		    	{
		    		$name_valid_image = CC_FileHandler::formatFilename($icon);
		    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
		    		CC_FileHandler::uploadFile($image_name, $_FILES['section_icon']['tmp_name'][$language], "file/img/menu/", "");
		    	}

				//insert section_lang
				$data_section_lang = array(
					'fx_section_id' => $section_id,
					'lang' => $language,
					'intro' => $intro,
					'title' => $title,
					'icon' => $icon,
					'link' => $link,
					'link_external' => $link_external,
				);
				
				$obj_fxSectionLang->insert($data_section_lang);
				$success++;
			} 
		}

		$response = array(
			'success' => $_LANG[LANG_SYS]['add_pag_msg_success']);

		echo(json_encode($response));
		exit(); 
	}
}

/* ADD SECTION BY SECTION FORM */
	if ($_POST['action'] == "section-add")
	{
		/*var_dump($_POST);
		exit();*/
		$all_language = $obj_fxSysLang->getAllLanguage();
	?>
		<div class="content-error"></div>

		<div class="form-edit-section .col-lg-12" style = "border: 0px !important">
			<div class = "tabbable tabs-left">
			    <ul class="nav nav-tabs">
			    	<?php foreach ($all_language as $key => $language): ?>
			    	<?php if ($key == 0 || true): ?>
			        	<li <?=($key == 0)?'class="active"':''?> ><a class = "eyelash-<?=$language?>" data-toggle="tab" href="<?='#'.$language?>"><?=$language?></a></li>	
			        <?php endif ?>
			        <?php endforeach ?>
			    </ul>
			</div>

			<form id = "form-main"  role="form" method="POST" enctype="multipart/form-data">		
				<div class="tab-content">
					<?php foreach ($all_language as $key => $language): ?>
					<?php if ($key == 0|| true): ?>
				    <div id="<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"' ?>>
						<input type = "hidden" value = "<?echo $_POST['section_id']?>" name = "owner_id[<?=$language?>]">
						
						<!--Title-->
						<div class="form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_title']?></label>
							<input type="input" class="form-control title-input"  placeholder="<?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_title']?>" name = "title[<?=$language?>]"></input>
						</div>

						<!--type -->
						<div class = "section-type form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_type']?></label>
							<div class="form-group">	
								<label class="radio-inline">
								  <input checked= "checked" type="radio" name="section-type[<?=$language?>]" id="inlineRadio1" value="Standard" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_type_standar']?>
								</label>
								<label class="radio-inline">
								  <input type="radio" name="section-type[<?=$language?>]" id="inlineRadio2" value="Blog" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_type_blog']?>
								</label>
								<label class="radio-inline">
								  <input type="radio" name="section-type[<?=$language?>]" id="inlineRadio3" value="Product" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_type_product']?>
								</label>
							</div>
						</div>

						<!--Display type -->
						<div class = "section-display form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_display_type']?></label>
							<div class="form-group" >	
								<label class="radio-inline">
								  <input checked= "checked" type="radio" name="section-display[<?=$language?>]" id="inlineRadio1" value="List" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_display_type_list']?>
								</label>
								<label class="radio-inline">
								  <input type="radio" name="section-display[<?=$language?>]" id="inlineRadio2" value="Grid" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_display_type_grid']?>
								</label>
							</div>
						</div>

						<!--icon -->
						<div class="section-icon form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_icon']?></label>
							<input type="file" onchange="readURL(this);" name = "section_icon[<?=$language?>]">
							<div>
								<img id="view-image"  width = "50px" height = "50px"/></input>
							</div>
							<label class="checkbox-inline" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							  <input type="checkbox" name = "opt_link[<?=$language?>]" id="inlineCheckbox1" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_chk_link_only']?>
							</label>
							<label class="checkbox-inline" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
							  <input type="checkbox" name = "private[<?=$language?>]" id="inlineCheckbox2" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_chk_make_priv']?>
							</label>
						</div>

						<!--External Link -->
						<div class = "section-external-link form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_ext_link']?></label>
							<div class="form-group" >	
								<label class="radio-inline">
								  <input checked= "checked" class = "no_external_link" type="radio" name="external-link[<?=$language?>]" value="0" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_ext_link_no']?>
								</label>
								<label class="radio-inline">
								  <input class = "is_external_link" type="radio" name="external-link[<?=$language?>]" value="1" > <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_ext_link_yes']?>
								</label>
							</div>
						</div>

						<!--Link text, radio buttons same windows, new windows -->
						<div class="section-link-<?=$language?> form-group" style = "display: none">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_link']?></label>
							<input class = "link-externa-text-<?=$language?>" type="input" placeholder="<?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_link']?>" name = "link[<?=$language?>]"></input>
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_open_in']?></label>
							<div class="form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>	
								<label class="radio-inline">
									<input class = "link-external-radio-<?=$language?>" type="radio"  name="link-target[<?=$language?>]" checked = "checked" id="same-windows" value="_self"> <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_open_in_same_wind']?> 
								</label>
								<label class="radio-inline">
								  	<input class = "link-external-radio-<?=$language?>" type="radio" name="link-target[<?=$language?>]" id="inlineRadio2" value="_blank"> <?=$_LANG[LANG_SYS]['menu_mng_add_sect_rdo_open_in_new_wind']?>
								</label>
							</div>
						</div>

						<!--Intro-->
						<div class="section-area form-group">
							<label><?=$_LANG[LANG_SYS]['menu_mng_add_sect_lbl_write_intro_section']?></label>
							<textarea class="form-control" rows="3" name = "section-intro[<?=$language?>]"></textarea>
						</div>
					</div>
					<?php endif ?>
			    	<?php endforeach ?>	
			    </div>
			    <!--Button Edit and Close-->
		    	<div class="form-group contact-edit-div contact-edit-div">
					<label class="col-sm-3 control-label"></label>
					<button type="submit" class="btn btn-primary save-section" name = "section-of-section" value = "section-of-section"><?=$_LANG[LANG_SYS]['menu_mng_add_sect_btn_save']?></button>
					<button class="btn btn-danger" type = "button" onclick="closeFancy()" ><?=$_LANG[LANG_SYS]['menu_mng_add_sect_btn_close']?></button>
				</div>
			</form>		
		</div>		

		<script>
			$(".no_external_link").click(function()
			{
				var language = $(this).parents('.tab-pane').attr("id");
				$('.section-link-'+language).fadeOut('fast');
				//clear radio external link 
				$(".link-external-radio-"+language).each(function(i) 
				{
			    	this.checked = false;
				});

				//clear link text 
				$(".link-externa-text-"+language).val("");
			});

			$(".is_external_link").click(function(){
				var language = $(this).parents('.tab-pane').attr("id");
				$('.section-link-'+language).fadeIn('fast');
				//set default 
				$("#same-windows").prop('checked', true);
			});

			$(".save-section").click(function(){
				$(".title-input").each(function() 
				{
					valTitle = $(this).val();
			    	if(valTitle == ""){
			    		$(this).parent().addClass("has-error");
			    		language = $(this).parents('.tab-pane').attr("id");
			    		$(".eyelash-"+language).css({"background-color" : "#f2dede", "color" : "#a94442"});
			    	}
			    	else{
			    		$(this).parent().removeClass("has-error");	
			    		language = $(this).parents('.tab-pane').attr("id");
			    		$(".eyelash-"+language).css({"background-color" : "white", "color" : "#428bca"});
			    	}
				});
			});

			//send form
			$(document).ready(function() { 
				$('#form-main').ajaxForm({ 
			    	dataType:'json', 
			    	success: function(data) { 
		            	//console.log(error.success );
		            	if(data.success)
		            	{
		            		alert(data.success);
		            		location.reload();
		            	}
		            	else{
		            		html = "<div class = 'alert alert-danger'>";
			            	for (var i = 0; i < data.length; i++) {
			            		//console.log(error[i].error_language);
			            		html += data[i].error;
			            		html += "</br>"; 
			            	}
			            	html += "</div>";
			            	$(".content-error").html(html);
		            	}
		        	} 
			    }); 
		    }); 


			function readURL(input) 
			{
				//alert(input);
			    if (input.files && input.files[0]) {
			        var reader = new FileReader();
			        reader.onload = function (e) {
			            $('#view-image')
			                .attr('src', e.target.result)
			                .width(50)
			                .height(50);
			        };
			        reader.readAsDataURL(input.files[0]);
			    }
			}
		</script>
	<?php    
	    exit();
	}
/* END */

/* EDIT SECTION SAVE */
	if($_POST['section-update'])
	{
		/*var_dump($_POST);
		exit();*/
		$all_language = $obj_fxSysLang->getAllLanguage();
		$success = 0;
		$error = 0;

		$response = array();
		foreach ($all_language as $key => $language) 
		{
			if($_POST['title'][$language] == null)
			{
				$response[] = array(
					'error' => $_LANG[LANG_SYS]['field_add_msg_error_required'].$language);
			}

			//if content FILES(IMG), validation data
			if(!empty($_FILES))
		    {
			    if(strlen(trim($_FILES['section_icon']['name'][$language])))
			    {
				    $is_valid_image = CC_FileHandler::checkFilenameExt($_FILES['section_icon']['name'][$language], array('jpg', 'png')) ? $_FILES['section_icon']['name'][$language] : false;
			    }
			    if(!$is_valid_image)
			    {
			    	$error_image = $_LANG[LANG_SYS]['add_ss_msg_error_img_inval'];
			    	
			    	$response[] = array(
						'error' => $error_image);
			    }
		    }		
		}
		//exit error
		if(!empty($response))
		{
			echo(json_encode($response));
			exit();	
		}
		else
		{
			foreach ($all_language as $key => $language) 
			{
				$fileUpload = $_FILES['section_icon']['name'][$language];

				$section_id = $_POST['section-id'][$language];
				$creation_dt = date("Y-m-d H:i:s");
				$title = $_POST['title'][$language];
				$intro = $_POST['section-intro'][$language];
				$section_type = $_POST['section-type'][$language];
				$display_type = $_POST['section-display'][$language];
				//$icon = $_FILES['section_icon']['name'][$language];
				$icon = ($fileUpload == null) ? '' : $fileUpload;
				$opt_link = (isset($_POST['opt_link'][$language])) ? 1 : 0;
				$link = $_POST['link'][$language];//link
				$link_target = $_POST['link-target'][$language];//_self or _blank 
				$link_external = $_POST['external-link'][$language];// 1 or 0
				$private = (isset($_POST['private'][$language])) ? 1 : 0;
				$deleted = 0;
				
				if(LANG_SYS == $language)
				{
					//select image old and delete
					//select image old
					$select_image_delete = $obj_fx_section->getPathImageBySectionId($section_id);
					$path_image_delete = "file/img/menu/".$select_image_delete;


					//upload image
					$image_name = $icon; 
				    if(strlen($icon))
			    	{
			    		unlink($path_image_delete);

			    		$name_valid_image = CC_FileHandler::formatFilename($icon);
			    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
			    		CC_FileHandler::uploadFile($image_name, $_FILES['section_icon']['tmp_name'][$language], "file/img/menu/", "");
			    	}

					$data_section = array(
						'creation_dt' => $creation_dt,
						'title' => $title,
						'intro' => $intro,
						'section_type' => $section_type,
						'display_type' => $display_type,
						'icon' => $image_name,
						'opt_link' => $opt_link,
						'link' => $link,
						'link_target' => $link_target,
						'link_external' => $link_external,
						'private' => $private,
						'deleted' => $deleted,
					);

					//if no change image keep image
					if(empty($icon))
					{
						unset($data_section['icon']);
					}

					$value = $obj_fx_section->update($data_section, $section_id);
				}
				else
				{
					//if no exit data, insert new register
					if(empty($section_id))
					{
						$data_section_lang = array(
							'fx_section_id' => $_POST['section-id'][LANG_SYS],
							'lang' => $language,
							'intro' => $intro,
							'title' => $title,
							'icon' => $icon,
							'link' => $link,
							'link_external' => $link_external,
						);
						$value = $obj_fxSectionLang->insert($data_section_lang);
					}
					else
					{
						$data_section_lang = array(
							'fx_section_id' => $section_id,
							'lang' => $language,
							'intro' => $intro,
							'title' => $title,
							'icon' => $icon,
							'link' => $link,
							'link_external' => $link_external,
						);
						//update section_lang
						$obj_fxSectionLang->updateSectionBySectionId($data_section_lang, $section_id);
					}
				}
			}

			$response = array(
				'success' => $_LANG[LANG_SYS]['add_pag_msg_success']);

			echo(json_encode($response));
			exit(); 
		}
	}
/* END EDIT SECTION */

//EDIT SECTION FORM
if ($_POST['action'] == "edit-section")
{
	$all_language = $obj_fxSysLang->getAllLanguage();
	$data_section = $obj_fx_section->getSectionById($_POST['section_id']);	
	/*var_dump($data_section);
	exit();*/
?>
<div class="content-error"></div>
<div class="form-edit-section .col-lg-12" style = "border: 0px !important">
	<div class = "tabbable tabs-left">
	    <ul class="nav nav-tabs">
	    	<?php foreach ($all_language as $key => $language): ?>
	        	<li <?=($key == 0)?'class="active"':''?> ><a class = "eyelash-<?=$language?>" data-toggle="tab" href="<?='#'.$language?>"><?=$language?></a></li>	
	        <?php endforeach ?>
	    </ul>
	</div>

	<form id = "form-main" role="form" method="POST" enctype="multipart/form-data">
		<div class="tab-content">	
		<?php foreach ($all_language as $key => $language): ?>
			<?	
			if(LANG_SYS == $language)
			{
				$data_section = $obj_fx_section->getSectionById($_POST['section_id']);	
			}
			else
			{
				$data_section = $obj_fxSectionLang->getAllSectionLangBySectionId($_POST['section_id'], $language);		
			}
			?>			
			<div id="<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"' ?> >
				<input type = "hidden" name = "menu-id[<?=$language?>]" value = "<?echo $data_section['fx_menu_id']?>">
				<input type = "hidden" name = "section-id[<?=$language?>]" value = "<?echo $data_section['fx_section_id']?>">
				
				<!--Title-->
				<div class="form-group">
					<label><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_title']?></label>
					<input type="input" class="form-control title-input"  placeholder="<?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_title']?>" name = "title[<?=$language?>]" value = "<?=$data_section['title']?>"></input>
				</div>

				<!--type -->
				<div class = "section-type form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
					<label><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_type']?></label>
					<div class="form-group">	
						<label class="radio-inline">
						  <input type="radio" name="section-type[<?=$language?>]" id="inlineRadio1" value="Standard" <?php echo ($data_section['section_type'] == "Standard") ? "checked='true'": ''; ?>  > <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_type_standar']?>
						</label>
						<label class="radio-inline">
						  <input type="radio" name="section-type[<?=$language?>]" id="inlineRadio2" value="Blog" <?php echo ($data_section['section_type'] == "Blog") ? "checked='true'": '';?> > <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_type_blog']?>
						</label>
						<label class="radio-inline">
						  <input type="radio" name="section-type[<?=$language?>]" id="inlineRadio3" value="Product" <?php echo ($data_section['section_type'] == "Product")? "checked='true'": '';?> > <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_type_product']?>
						</label>
					</div>
				</div>

				<!--Display type -->
				<div class = "section-display form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
					<label><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_display_type']?></label>
					<div class="form-group">	
						<label class="radio-inline">
						  <input type="radio" name="section-display[<?=$language?>]" id="inlineRadio1" value="List" <?php echo ($data_section['display_type'] == "List")? "checked='true'": '';?> > <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_display_type_list']?>
						</label>
						<label class="radio-inline">
						  <input type="radio" name="section-display[<?=$language?>]" id="inlineRadio2" value="Grid" <?php echo ($data_section['display_type'] == "Grid")? "checked='true'": '';?> > <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_display_type_grid']?>
						</label>
					</div>
				</div>

				<!--Icon, checkbox -->
				<div class="section-icon form-group">
					<label><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_icon']?></label>
					<input onchange="readURL(this);" type="file" name = "section_icon[<?=$language?>]" enctype='rrrr'  >
					<div>
						<img id="view-image" src="<?=FX_System::url('file/img/menu/').$data_section["icon"]?>" width = "50px" height = "50px"/></input>
					</div>
					<label class="checkbox-inline" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
					  <input type="checkbox" name = "opt_link[<?=$language?>]" id="inlineCheckbox1" <?php echo ($data_section['opt_link'] == 1)? "checked='true'": '';?>> <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_chk_link_only']?>
					</label>
					<label class="checkbox-inline" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>
					  <input type="checkbox" name = "private[<?=$language?>]" id="inlineCheckbox2" <?php echo ($data_section['private'] == 1)? "checked='true'": '';?>> <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_chk_make_priv']?>
					</label>
				</div>

				<!--Radio external link -->
				<div class = "section-external-link form-group">
					<label><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_ext_link']?></label>
					<div class="form-group">	
						<label class="radio-inline">
						  	<input class = "no_external_link" type="radio" name="external-link[<?=$language?>]" value="0" <?php echo ($data_section['link_external'] == 0)? "checked='checked'": '';?> > <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_ext_link_no']?>
						</label>
						<label class="radio-inline">
						  	<input class = "is_external_link" type="radio" name="external-link[<?=$language?>]" value="1" <?php echo ($data_section['link_external'] == 1)? "checked='checked'": '';?> > <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_ext_link_yes']?>
						</label>
					</div>
				</div>

				<!--Link text, radio buttons same windows, new windows -->
				<div class="section-link-<?=$language?> form-group" <?echo ($data_section['link_external'] == 0) ? 'style = "display: none"': ''?> >
					<label><?=htmlentities(utf8_encode($_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_link']), ENT_QUOTES, "UTF-8")?></label>
					<input class = "link-externa-text-<?=$language?>" type="input" placeholder="<?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_link']?>" name = "link[<?=$language?>]" value = "<?php echo ($data_section['link']);?>" ></input>
					<label <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_open_in']?></label>
					<div class="form-group" <?=(LANG_SYS == $language) ? '' : 'style = "display: none"';?>>	
						<label class="radio-inline">
						  <input class = "link-external-radio-<?=$language?>" type="radio"  name="link-target[<?=$language?>]" id="inlineRadio1" value="_self" <?php echo ($data_section['link_target'] == "_self")? "checked='true'": '';?> <?=(LANG_SYS == $language) ? '' : '';?>> <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_open_in_same_wind']?> 
						</label>
						<label class="radio-inline">
						  <input class = "link-external-radio-<?=$language?>" type="radio" name="link-target[<?=$language?>]" id="inlineRadio2" value="_blank" <?php echo ($data_section['link_target'] == "_blank")? "checked='true'": '';?>  <?=(LANG_SYS == $language) ? '' : '';?>> <?=$_LANG[LANG_SYS]['menu_mng_edit_sect_rdo_open_in_new_wind']?>
						</label>
					</div>
				</div>

				<!--Intro-->
				<div class="section-area form-group">
					<label><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_lbl_write_intro_section']?></label>
					<textarea class="form-control" rows="3" name = "section-intro[<?=$language?>]" ><?=$data_section['intro']?></textarea>
				</div>
			</div>
			<?php endforeach ?>
		</div>

		<!--Button Edit and Close-->
		<div class="form-group contact-edit-div contact-edit-div">
			<label class="col-sm-3 control-label"></label>
			<button type="submit" class="btn btn-primary save-section" name = "section-update" value = "section-save" ><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_btn_edit']?></button>
			<button class="btn btn-danger" type = "button" onclick="closeFancy()" ><?=$_LANG[LANG_SYS]['menu_mng_edit_sect_btn_close']?></button>
		</div>

	</form>
</div>
<script>
$(".no_external_link").click(function()
{
	var language = $(this).parents('.tab-pane').attr("id");
	$('.section-link-'+language).fadeOut('fast');

	//clear radio external link 
	$(".link-external-radio-"+language).each(function(i) 
	{
    	this.checked = false;
	});

	//clear link text 
	$(".link-externa-text-"+language).val("");
});

$(".is_external_link").click(function(){
	
	var language = $(this).parents('.tab-pane').attr("id");
	$('.section-link-'+language).fadeIn('fast');
	//set default 
	$("#same-windows").prop('checked', true);
});


$(".save-section").click(function(){
	$(".title-input").each(function() 
	{
		valTitle = $(this).val();
    	if(valTitle == ""){
    		$(this).parent().addClass("has-error");
    		language = $(this).parents('.tab-pane').attr("id");
    		$(".eyelash-"+language).css({"background-color" : "#f2dede", "color" : "#a94442"});
    	}
    	else{
    		$(this).parent().removeClass("has-error");	
    		language = $(this).parents('.tab-pane').attr("id");
    		$(".eyelash-"+language).css({"background-color" : "white", "color" : "#428bca"});
    	}
	});
});

	//send form
$(document).ready(function() { 
	$('#form-main').ajaxForm({ 
    	dataType:'json', 
    	success: function(data) { 
        	//console.log(error.success );
        	if(data.success)
        	{
        		alert(data.success);
        		location.reload();
        	}
        	else{
        		html = "<div class = 'alert alert-danger'>";
            	for (var i = 0; i < data.length; i++) {
            		//console.log(error[i].error_language);
            		html += data[i].error;
            		html += "</br>"; 
            	}
            	html += "</div>";
            	$(".content-error").html(html);
        	}
    	} 
    }); 
});  

function readURL(input) 
{
	//alert(input);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#view-image')
                .attr('src', e.target.result)
                .width(50)
                .height(50);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

</script>
<?php    
    exit();
}

/*DELETE SECTION*/
if($_POST['action'] == 'delete_section')
{	
	$section_data = array('deleted' => '1');
	$obj_fx_section->update($section_data, $_POST['section_id']);

	//delete page
	$all_page_by_section = $obj_fxPage->deleteAllPageBySectionId($_POST['section_id']); 
	
	$children_section = $obj_fx_section->getSectionByOwnerld($_POST['section_id'], true);

	foreach ($children_section as $key => $value) 
	{
		$section_id = $value['fx_section_id'];
		$data_section = array(
			'deleted' => 1,
		);
		$obj_fx_section->update($data_section, $section_id);
		
		//If exits children
		if(count($value['fx_sub_section']) > 0)
		{
			FX_System::iteractiveDeleteChildren($value['fx_sub_section']);
		}
	}
	//exit();
}


/*SAVE ORDER SECTION--- */
if($_POST['action'] == 'save-order-menu')
{
	foreach ($_POST['serialize'] as $key_serialize => $value) 
	{
		/*echo('menu='.$_POST['menu_id']);
		exit();*/
		/*echo "</br>";*/
		$father_id = $value['id'];
		$section_id = $value['id'];
		$position = $key_serialize + 1;
		$data_section = array(
			'fx_menu_id' => $_POST['menu_id'],
			'owner_id' => 0,
			'position' => $position,
		);
		$obj_fx_section->update($data_section, $section_id);

		if(is_array($value['children'])) 
		{
			FX_System::iteractive($value['children'], $father_id);
		}
	}
	exit();
}