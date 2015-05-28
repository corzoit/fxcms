<?
define ("FX_TEMPLATE","admin.php"); 
FX_System::validateAdminLogin();

$fx_slideShow = new FX_SlideShow();
$fx_slideShowImage = new FX_SlideShowImage();
$fx_slideShowImage_lang = new FX_SlideShowImageLang();
/*var_dump($fx_slideShowImage);
exit();*/
$fx_slideShowLang = new FX_SlideShowLang();
$obj_fxSysLang = new FX_SysLang();

$fx_slideshow_id = $__FX_PARAMS['id'];

$sli_by_slId = $fx_slideShowImage->getSlideShowImageBySlideShowId($fx_slideshow_id);
/*var_dump($sli_by_slId);
exit();*/
if($_POST['btn-save'] == "save-edit-slide-show")
{
	unset($_POST['btn-save']);
	/*var_dump($_POST);	
	exit();*/
	foreach ($_POST as $language => $value) 
	{
		$code   		 = $value['code'];
		$title  		 = $value['title'];
		$width  		 = $value['width'];
		$height 		 = $value['height'];
		
		//Update fx_slide_show		
		if($language == LANG_SYS)
		{
			$fx_slideshow_id = $value['id'];
			$data_edit_ss = array(
				'code' => $code,
				'title' => $title,
				'width' => $width ,
				'height' => $height
			);
			$fx_slideShow->update($data_edit_ss, $fx_slideshow_id);
		}
		else
		{
			// if exist register
			if(!empty($value['id']))
			{
				$fx_slideshow_lang_id  = $value['id'];
				$data_edit_ssl = array(
					'title' 	=> $title
				);
				$fx_slideShowLang->update($data_edit_ssl, $fx_slideshow_lang_id);
			}
			else
			{
				//insert new register
				$data_edit_ssl = array(
					'fx_slideshow_id'	=> $fx_slideshow_id,
					'lang' 				=> $language,
					'title' 			=> $title
				);
				$fx_slideShowLang->insert($data_edit_ssl);	
			}
		}
	}
}

if($_POST['action'] == "new-image")
{
	?>
	<div class="content-error"></div>
	<div class = "tabbable tabs-left">
	    <?$all_language = $obj_fxSysLang->getAllLanguage();?>
	    <ul class="nav nav-tabs">
	    	<?php foreach ($all_language as $key => $language): ?>
	        	<li <?=($key == 0)?'class="active"':''?> ><a data-toggle="tab" href="<?='#image-'.$language?>"><?=$language?></a></li>	
	        <?php endforeach ?>
	    </ul>
	</div>
	<form role="form" method="POST" class = "form" id = "form-main"  enctype="multipart/form-data">	
		<div class="tab-content">
			<?php foreach ($all_language as $key => $language): ?>
		    <div id="image-<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"' ?> >
		    	<div class="form-slideshow .col-lg-12" style = "border: 0px !important; padding-top: 20px">
	        		<input  type = "hidden" name = "<?=$language?>[slide_show_id]" value = "<?=$_POST['fx_slideshow_id']?>"> </input>
	        		<!--caption-->
	        		<div class="row">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-caption-ss']?></label>
						<div class="col-xs-8">	
							<input class = "form-control" type="input" placeholder="<?=$_LANG[LANG_SYS]['lbl-caption-ss']?>" name="<?=$language?>[caption]"></input>
						</div>
					</div>

					<!--upload image-->
					<?php if (LANG_SYS == $language){?>
	        		<div class="row">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-image-ss']?>(*)</label>
						<div class = "col-xs-8">
							<input class="file" onchange="readURL(this);" type="file" name = "<?=$language?>[image]" required>
							<img id="view-image" width = "50px" height = "50px"/></input>
						</div>
					</div>
					<?php }?>

					<!--link image-->
					<?php if (LANG_SYS == $language){?>
					<div class="row">
						<label class="col-xs-3"></label>
						<div class="col-xs-8">
							<input type="checkbox" name = "<?=$language?>[opt_link]">
							<label style = "font-weight : normal "><?=$_LANG[LANG_SYS]['check-link-image-ss']?></label>
						</div>
					</div>
					<?php }?>

					<!--External Link-->
					<?php if (LANG_SYS == $language){?>
	        		<div class="row">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-external-link-ss']?></label>
						<div class="col-xs-8">	
							<label class="radio-inline">
							  	<input  checked="checked" class = "no_external_link" type="radio" name="<?=$language?>[link_external]" value="0" > <?=$_LANG[LANG_SYS]['radio-no-ss']?>
							</label>
							<label class="radio-inline">
							  	<input class = "is_external_link" type="radio" name="<?=$language?>[link_external]" value="1" > <?=$_LANG[LANG_SYS]['radio-yes-ss']?>
							</label>
						</div>
					</div>
					<?php }?>

					<?php if (LANG_SYS == $language){?>
					<!--Link-->
	        		<div class="row container-link" style = "display: none">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-link-ss']?></label>
						<div class="col-xs-8">	
							<input class = "form-control" type="input" placeholder="<?=$_LANG[LANG_SYS]['lbl-link-ss']?>" name="<?=$language?>[link]"></input>
						</div>
					</div>
					<?php }?>

					<?php if (LANG_SYS == $language){?>
					<!--Open in-->
	        		<div class="row container-open-in" style = "display: none">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-open-in-ss']?></label>
						<div class="col-xs-8">	
							<label class="radio-inline">
							  	<input class = "open-in" checked="checked" type="radio" name="<?=$language?>[link_target]" value = "_self"> <?=$_LANG[LANG_SYS]['radio-same-windows-ss']?>
							</label>
							<label class="radio-inline">
							  	<input class = "open-in" type="radio" name="<?=$language?>[link_target]" value = "_blank"> <?=$_LANG[LANG_SYS]['radio-new-windows-ss']?>
							</label>
						</div>
					</div>
					<?php }?>
		        </div>	
		    </div>
		    <?php endforeach ?>
		</div>

		<!--Button Edit and Close-->
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<button class="btn btn-primary" id = "save-new-image" name = "new-image" value = "new-image" type="submit"><?=$_LANG[LANG_SYS]['btn-save-ss']?></button>
			<button class="btn btn-danger" type="button" onclick="closeFancy()" ><?=$_LANG[LANG_SYS]['btn-close-ss']?></button>
		</div>
	</form>

	<style type="text/css">
	.row
	{
		padding-bottom: 10px;
	}
	</style>
	<script>
	$('.no_external_link').click(function(){
		//hide
		$(".container-link").css("display", "none");
		$(".container-open-in").css("display", "none");
	});

	$('.is_external_link').click(function(){
		//show
		$(".container-link").css("display", "block");
		$(".container-open-in").css("display", "block");
	});

	$(document).ready(function() { 
		$('#form-main').ajaxForm({ 
	    	dataType:'json', 
	    	success: function(data) { 
	        	//console.log(data);
				//alert();
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
	<?
	exit();
}

if($_POST['new-image'])
{
	/*var_dump($_POST);
	var_dump($_FILES);
	exit();*/	
	$is_insert_slideShow = false;
	
	//valiodation error
	$response = array();
	foreach ($_POST as $language => $value) 
	{
		if($value['caption'] == null)
		{
			$response[] = array(
				'error' => $_LANG[LANG_SYS]['field_add_msg_error_required'].$language);
		}

		//validation image in slide_show_image
	    if($language == LANG_SYS && count($_FILES))
	    {
		    if(strlen(trim($_FILES[$language]['name']['image'])))
		    {
			    $is_valid_image = CC_FileHandler::checkFilenameExt($_FILES[$language]['name']['image'], array('jpg', 'png')) ? $_FILES[$language]['name']['image'] : false;
		    }
		    if(!$is_valid_image)
		    {
		    	$error_image = $_LANG[LANG_SYS]['add_ss_msg_error_img_inval'];
		    	
		    	$response[] = array(
					'error' => $error_image);
		    }
	    }
	}
	if(!empty($response))
	{
		echo(json_encode($response));
		exit();
	}
	else
	{
		foreach ($_POST as $language => $value) 
		{
			//echo('$language'.$language);
			$fx_slideshow_id = $_POST[$language]['slide_show_id'];
			$caption = $_POST[$language]['caption'];
			$image =  $_FILES[$language]['name']['image'];
			$opt_link = (!empty($_POST[$language]['opt_link'])) ? 1 : 0;
			$link_external = $_POST[$language]['link_external']; 
			$link = $_POST[$language]['link'];
			//if choose no external link, link_target is self	
			if($link_external == 0)
			{
				$link_target = '_self';	
			}
			else
			{
				$link_target = $_POST[$language]['link_target'];		
			}

			$position = 0;

			if(!$is_insert_slideShow)
			{
		    	//echo("1111111111111111");
		    	$image_name = $image; 
			    if(strlen($image))
		    	{
		    		$name_valid_image = CC_FileHandler::formatFilename($image);
		    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
		    		CC_FileHandler::uploadFile($image_name, $_FILES[$language]['tmp_name']['image'], "file/img/slideshow/", "");
		    	}

		    	$position = $fx_slideShowImage->getPositionBySsId($fx_slideshow_id);

		    	$data_slide_show_image = array(
					'fx_slideshow_id' => $fx_slideshow_id, 
					'image' => FX_System::saveStrDb($image_name), 
					'caption' => FX_System::saveStrDb($caption),  
					'opt_link' => $opt_link,  
					'link' => FX_System::saveStrDb($link),  
					'link_target' => FX_System::saveStrDb($link_target),  
					'link_external' => $link_external,  
					'position' => $position + 1, 
					'deleted' => 0, 
				);
				$fx_slideShowImage_id = $fx_slideShowImage->insert($data_slide_show_image, true);
				
				$is_insert_slideShow = true;
			}
			else
			{
				//echo("2222222222222222");
				$data_slide_show_image_lang = array(
						'fx_slideshow_image_id' => $fx_slideShowImage_id,
						'lang' => FX_System::saveStrDb($language),
						'caption' => FX_System::saveStrDb($caption) 
					);
				/*var_dump($data_slide_show_image_lang);
				exit();*/
				$fx_slideShowImage_lang->insert($data_slide_show_image_lang);
			}
		}
		$response = array(
			'success' => $_LANG[LANG_SYS]['add_pag_msg_success']);
	}
	echo(json_encode($response));
	exit();
}

if($_POST['action'] == "delete-slide-image")
{
	$data_slide_show_image = array(
		'deleted' => 1, 
	);
	$fx_slideShowImage->update($data_slide_show_image ,$_POST['fx_slideshow_image_id']); 
	exit();
}

/*Edit image*/
if($_POST['action'] == "edit-slide-show-image")
{
	$fx_slideshow_image_id = $_POST['fx_slideshow_image_id'] 
	?>
	<div class="content-error"></div>
	<div class = "tabbable tabs-left">
	    <?$all_language = $obj_fxSysLang->getAllLanguage();?>
	    <ul class="nav nav-tabs">
	    	<?php foreach ($all_language as $key => $language): ?>
	        	<li <?=($key == 0)?'class="active"':''?> ><a data-toggle="tab" href="<?='#image-'.$language?>"><?=$language?></a></li>	
	        <?php endforeach ?>
	    </ul>
	</div>
	<form role="form" method="POST" class = "form" id = "form-main"  enctype="multipart/form-data">	
		<div class="tab-content">
			<?php foreach ($all_language as $key => $language): ?>
		    <?php
		    	if($language == LANG_SYS)
		    	{
		    		$data_edit_image = $fx_slideShowImage->getSlideShowImageBySlideShowImageId($fx_slideshow_image_id);	
		    	}
		    	else
		    	{
		    		$data_edit_image = $fx_slideShowImage_lang->getSlideShowImageLangBySlideShowImageId($fx_slideshow_image_id, $language);
		    	}				
			?>
		    <div id="image-<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"'?>>
		    	<div class="form-slideshow .col-lg-12" style = "border: 0px !important; padding-top: 20px">
	        		<?php 
	        		if ($language == LANG_SYS)
	        		{
	        			?>
	        			<input  type = "hidden" name = "<?=$language?>[id]" value = "<?=$data_edit_image['fx_slideshow_image_id']?>"></input>
	        			<?php 
	        		}
	        		else
	        		{
	        		?>
	        			<input  type = "hidden" name = "<?=$language?>[id]" value = "<?=$data_edit_image['fx_slideshow_image_lang_id']?>"> </input>
	        		<?php
	        		}
	        		?>

	        		<!--caption-->
	        		<div class="row">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-caption-ss']?></label>
						<div class="col-xs-8">	
							<input class = "form-control" type="input" placeholder="<?=$_LANG[LANG_SYS]['lbl-caption-ss']?>" name="<?=$language?>[caption]" value = "<?=$data_edit_image['caption']?>"></input>
						</div>
					</div>

					<!--upload image-->
					<?php if (LANG_SYS == $language){?>
	        		<div class="row">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-image-ss']?>(*)</label>
						<div class = "col-xs-8">
							<input class="file" onchange="readURL(this);" type="file" name = "<?=$language?>[image]" <?= (empty($data_edit_image["image"])) ? "required" : ""?>>
							<img id="view-image" src="<?=FX_System::url('file/img/slideshow/').$data_edit_image["image"]?>" <?= (count($data_edit_image["image"])) ? "name = 'exist'": "" ?> width = "50px" height = "50px"/></input>
						</div>
					</div>
					<?php }?>

					<!--link image-->
					<?php if (LANG_SYS == $language){?>
					<div class="row">
						<label class="col-xs-3"></label>
						<div class="col-xs-8" >
							<input type="checkbox" name = "<?=$language?>[opt_link]" <?= ($data_edit_image['opt_link']) == "1" ? "checked='checked'" : ''?>>
							<label style = "font-weight : normal "><?=$_LANG[LANG_SYS]['check-link-image-ss']?></label>
						</div>
					</div>
					<?php }?>

					<!--External Link-->
					<?php if (LANG_SYS == $language){?>
	        		<div class="row">
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-external-link-ss']?></label>
						<div class="col-xs-8">	
							<label class="radio-inline">
							  	<input class = "no_external_link" type="radio" name="<?=$language?>[link_external]" value="0" <?=($data_edit_image['link_external']) == "0" ? "checked='checked'" : ''?> > <?=$_LANG[LANG_SYS]['radio-no-ss']?>
							</label>
							<label class="radio-inline">
							  	<input class = "is_external_link" type="radio" name="<?=$language?>[link_external]" value="1" <?=($data_edit_image['link_external']) == "1" ? "checked='checked'" : ''?> > <?=$_LANG[LANG_SYS]['radio-yes-ss']?>
							</label>
						</div>
					</div>
					<?php }?>

					<?php if (LANG_SYS == $language){?>
					<!--Link-->
	        		<div class="row container-link" <?=($data_edit_image['link_external']) == "0" ? "style = 'display: none'" : ''?>>
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-link-ss']?></label>
						<div class="col-xs-8">	
							<input class = "form-control" type="input" placeholder="<?=$_LANG[LANG_SYS]['lbl-link-ss']?>" name="<?=$language?>[link]" value = "<?=$data_edit_image['link']?>" ></input>
						</div>
					</div>
					<?php }?>

					<?php if (LANG_SYS == $language){?>
					<!--Open in-->
	        		<div class="row container-open-in" <?=($data_edit_image['link_external']) == "0" ? "style = 'display: none'" : ''?>>
						<label class="col-xs-3"><?=$_LANG[LANG_SYS]['lbl-open-in-ss']?></label>
						<div class="col-xs-8">	
							<label class="radio-inline">
							  	<input class = "open-in" checked="checked" type="radio" name="<?=$language?>[link_target]" value = "_self"> <?=$_LANG[LANG_SYS]['radio-same-windows-ss']?>
							</label>
							<label class="radio-inline">
							  	<input class = "open-in" type="radio" name="<?=$language?>[link_target]" value = "_blank"> <?=$_LANG[LANG_SYS]['radio-new-windows-ss']?>
							</label>
						</div>
					</div>
					<?php }?>
		        </div>	
		    </div>
		    <?php endforeach ?>
		</div>

		<!--Button Edit and Close-->
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<button class="btn btn-primary" id = "save-new-image" name = "save-edit-slideshow-image" value = "save-edit-slideshow-image" data = "<?=$fx_slideshow_image_id?>" type="submit"><?=$_LANG[LANG_SYS]['btn-save-ss']?></button>
			<button class="btn btn-danger" type="button" onclick="closeFancy()" ><?=$_LANG[LANG_SYS]['btn-close-ss']?></button>
		</div>
	</form>
	<style type="text/css">
	.row
	{
		padding-bottom: 10px;
	}
	</style>
	<script>
	$('.no_external_link').click(function(){
		//hide
		$(".container-link").css("display", "none");
		$(".container-open-in").css("display", "none");
	});

	$('.is_external_link').click(function(){
		//show
		$(".container-link").css("display", "block");
		$(".container-open-in").css("display", "block");
	});

	$(document).ready(function() { 
	$('#form-main').ajaxForm({ 
    	dataType:'json', 
    	success: function(data) { 
        	//console.log(data);
			//alert();
        	if(data.success)
        	{
        		alert(data.success);
        		location.reload();
        	}
        	else{
        		html = "<div class = 'alert alert-danger'>";
            	for (var i = 0; i < data.length; i++) 
            	{
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
	<?
	exit();
}

if($_POST['save-edit-slideshow-image'] == "save-edit-slideshow-image")
{
	$is_update_slideShow = false;
	/*var_dump($_POST);
	exit();*/
	/*var_dump($_FILES);
	exit();*/
	//valiodation error
	$response = array();
	foreach ($_POST as $language => $value) 
	{
		if($value['caption'] == null)
		{
			$response[] = array(
				'error' => $_LANG[LANG_SYS]['field_add_msg_error_required'].$language);
		}

		if($language == LANG_SYS && !empty($_FILES))
	    {
		    if(strlen(trim($_FILES[$language]['name']['image'])))
		    {
			    $is_image_valid = CC_FileHandler::checkFilenameExt($_FILES[$language]['name']['image'], array('jpg', 'png')) ? $_FILES[$language]['name']['image'] : false;
		    }
		    if(!$is_image_valid)
		    {
		    	$error_image = $_LANG[LANG_SYS]['add_ss_msg_error_img_inval'];
		    	
		    	$response[] = array(
					'error' => $error_image);
		    }
	    }
	}
	if(!empty($response))
	{
		echo(json_encode($response));
		exit();
	}
	else
	{
		foreach ($_POST as $language => $value) 
		{
			$caption = $_POST[$language]['caption'];
			$image =  $_FILES[$language]['name']['image'];
			$opt_link = (!empty($_POST[$language]['opt_link'])) ? 1 : 0;
			$link_external = $_POST[$language]['link_external']; 
			$link = $_POST[$language]['link'];
			//if choose no external link, link_target is self	
			if($link_external == 0)
			{
				$link_target = '_self';	
			}
			else
			{
				$link_target = $_POST[$language]['link_target'];		
			}

			$position = 0;

			if(!$is_update_slideShow)
			{
				$fx_slideshow_image_id = $value['id'];
				
				//select image old
				$select_image_delete = $fx_slideShowImage->getPathImageBySlideShowImageId($fx_slideshow_image_id);
				$path_image_delete = "file/img/slideshow/".$select_image_delete;
				
				$image_name = $image; 
				
				//if change image delete old image and create other image
			    if(strlen($image))
		    	{
		    		//delete image old
		    		unlink($path_image_delete);
		    		
		    		$name_valid_image = CC_FileHandler::formatFilename($image);
		    		$image_name =  CC_FileHandler::generateFilenameRandom($name_valid_image, 5, false);
		    		CC_FileHandler::uploadFile($image_name, $_FILES[$language]['tmp_name']['image'], "file/img/slideshow/", "");
		    	}
				
				$data_slide_show_image = array(
					'image' => FX_System::saveStrDb($image_name), 
					'caption' => FX_System::saveStrDb($caption),  
					'opt_link' => $opt_link,  
					'link' => FX_System::saveStrDb($link),  
					'link_target' => FX_System::saveStrDb($link_target),  
					'link_external' => $link_external,  
					'position' => $position, 
					'deleted' => 0, 
				);

				//if no change image keep image
				if(empty($image))
				{
					unset($data_slide_show_image['image']);
				}

				$fx_slideShowImage->update($data_slide_show_image, $fx_slideshow_image_id);
				$is_update_slideShow = true;
			}
			else
			{
				$fx_slideshow_image_lang_id = $value['id'];
				
				//if exits register update, if not insert
				if(!empty($fx_slideshow_image_lang_id))
				{
					$data_slide_show_image_lang = array(
						'caption' => FX_System::saveStrDb($caption) 
					);
					
					$fx_slideShowImage_lang->update($data_slide_show_image_lang, $fx_slideshow_image_lang_id);
				}
				else
				{
					$data_slide_show_image_lang = array(
						'fx_slideshow_image_id' => $fx_slideshow_image_id,
						'lang' => FX_System::saveStrDb($language),
						'caption' => FX_System::saveStrDb($caption) 
					);

					$fx_slideShowImage_lang->insert($data_slide_show_image_lang);
				}	
			}
		}
		$response = array(
			'success' => $_LANG[LANG_SYS]['add_pag_msg_success']);
	}
	echo(json_encode($response));
	exit();
}

if($_POST["action"] == "preview-slideshow")
{
	$sli_by_slId = $fx_slideShowImage->getSlideShowImageBySlideShowId($_POST['fx_slideshow_id']);
	//var_dump($sli_by_slId);
	?>
	<div class="row row-content-carousel">
		<div id="welcome-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
			<div class="carousel-inner">
				<?php
				foreach ($sli_by_slId as $key_sli => $sli_data) 
				{
					?>
					<div <?=($key_sli == 0)? "class='item active'" : "class='item'"?> >
					  	<img style = "width: <?=$sli_data['width']?>px; height : <?=$sli_data['height']?>px !important" src="<?=FX_System::url('file/img/slideshow/').$sli_data["image"]?>?>"  width = "<?=$sli_data['width']?>" height = "<?=$sli_data['height']?>">
					</div>
					<?	
				}
				?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	
    $('#welcome-carousel').carousel({
	      interval  : 2500,
	      pause 	: false,
	    });
	
	</script>
	<?
	exit();
}

if($_POST["action"] == "save-position")
{
	foreach ($_POST['serialize'] as $position => $value) 
	{
		$fx_slideshow_image_id = $value['id'];
		$data_ssi = array(
			'position' => $position + 1,
		);
		$fx_slideShowImage->update($data_ssi, $fx_slideshow_image_id);
	}
	exit();
}
