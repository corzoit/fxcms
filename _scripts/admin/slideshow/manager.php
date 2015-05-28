<?
define ("FX_TEMPLATE","admin.php"); 
FX_System::validateAdminLogin();

$fx_slideShow = new FX_SlideShow();
$fx_slideShowLang = new FX_SlideShowLang();
$fx_slideShowImage = new FX_SlideShowImage();
$obj_fxSysLang = new FX_SysLang();
$fx_section = new FX_Section();

$get_all_slide_show = $fx_slideShow->getAllData();

if($_POST['action'] == "add-slide-show")
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
	<form method="POST" id = "form-main">	
		<div class="tab-content">
		<?php foreach ($all_language as $key => $language): ?>
			<div id="<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"' ?> >
				<!--Code-->
				<?php if ($language == LANG_SYS): ?>
				<div class="form-group">
					<label><?=$_LANG[LANG_SYS]['lbl_code_ss_create']?>(*)</label>
					<input type="input" class="form-control title-input"  placeholder="<?=$_LANG[LANG_SYS]['lbl_code_ss_create']?>" name="<?=$language?>[code]"></input>
				</div>
				<?php endif ?>

				<!--Title-->
				<div class="form-group">
					<label><?=$_LANG[LANG_SYS]['lbl_title_ss_create']?>(*)</label>
					<input type="input" class="form-control title-input"  placeholder="<?=$_LANG[LANG_SYS]['lbl_title_ss_create']?>" name="<?=$language?>[title]"></input>
				</div>

				<!--Width-->
				<?php if ($language == LANG_SYS):?>
				<div class="form-group">
					<label><?=$_LANG[LANG_SYS]['lbl_width_ss_create']?>(*)</label>
					<input type="input" class="form-control title-input"  placeholder="<?=$_LANG[LANG_SYS]['lbl_width_ss_create']?>" name="<?=$language?>[width]"></input>
				</div>
				<?php endif ?>

				<!--Height-->
				<?php if ($language == LANG_SYS): ?>
				<div class="form-group">
					<label><?=$_LANG[LANG_SYS]['lbl_height_ss_create']?>(*)</label>
					<input type="input" class="form-control title-input"  placeholder="<?=$_LANG[LANG_SYS]['lbl_height_ss_create']?>" name="<?=$language?>[height]"></input>
				</div>
				<?php endif ?>
				<!-- Section -->
				<?php if ($language == LANG_SYS): ?>
				<?php 
				$data_section = $fx_section->getSectionByOwnerld($owner_id = 0,  $all_levels = false);				
				?>
				<div class="form-group">
					<label>
						<?=$_LANG[LANG_SYS]['lbl_section_ss_create']?>					
					 </label>					 
					  <br>	
					 <input type="radio" class="confirm_section" name="<?=$language?>[confirm_section]" value="1" /> Yes
					 <input type="radio" class="confirm_section" name="<?=$language?>[confirm_section]" checked="checked" value="0" /> No

					<select class="form-control select_confirm" name="<?=$language?>[fx_section_id]" style="display:none;">
						<?php foreach ($data_section as $key_data_section => $value_data_section): ?>
							<option value="<?=$value_data_section['fx_section_id']?>"><?=$value_data_section['title']?></option>
						<?php endforeach ?>						
					</select>					
				</div>
				<?php endif ?>

				<!--buttons-->
			</div>
		<?php endforeach ?>	
			<div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<button class="btn btn-primary" type="submit" name = "action" value = "save-slide-show"><?=$_LANG[LANG_SYS]['btn_save_ss_create']?></button>
				<button class="btn btn-danger" type="button" onclick="closeFancy()" ><?=$_LANG[LANG_SYS]['btn_close_ss_create']?></button>
			</div>
		</div>
	</form>
	<script>
		$(".confirm_section").on("change", function(){							
			$(this).val()==1? $(".select_confirm").show() : $(".select_confirm").hide();
		});
		$('#form-main').ajaxForm({
			dataType:'json', 
	    	success: function(data) { 
            	//console.log(error.success );
            	console.log(data);
            	if(data.success)
            	{
            		alert(data.success);
            		location.reload();
            	}
            	else{
            		html = "<div class = 'alert alert-danger'>";
            		html += data.error_language === undefined ? "":data.error_language;
	            	for (var i = 0; i < data.length; i++) {
	            		//console.log(error[i].error_language);
	            		html += data[i].error_language;
	            		html += "</br>"; 
	            	}
	            	html += "</div>";
	            	$(".content-error").html(html);
            	}
        	} 
		});
	</script>
	<?
	exit();
}

if($_POST['action'] == "save-slide-show")
{
	unset($_POST['action']);

	//var_dump($_POST);
	foreach ($_POST as $language => $data) 
	{
		if($language == LANG_SYS)
		{
			//Field required for slideshow
			if($_POST[$language]['code'] == null ||
			  $_POST[$language]['title'] == null || 
			  $_POST[$language]['width'] == null || 
			  $_POST[$language]['height'] == null)
			{
				$response[] = array(
					'error_language' => $_LANG[LANG_SYS]['field_add_msg_error_required'].$language);
			}
		}
		else
		{
			//Field required for slideshowLang
			if($_POST[$language]['title'] == null )
			{
				$response[] = array(
					'error_language' => $_LANG[LANG_SYS]['field_add_msg_error_required'].$language);
			}
		}	
	}
	if(!empty($response))
	{
		echo(json_encode($response));
	}
	else
	{		
		foreach ($_POST as $language => $data) 
		{
			$code = strtoupper($_POST[$language]['code']);
			$title = $_POST[$language]['title'];
			$width = $_POST[$language]['width'];
			$heigth = $_POST[$language]['height'];
			$fx_section_id = $_POST[$language]['fx_section_id'];
			$confirm_section = $_POST[$language]['confirm_section'];
			
			$fx_slide_show = new FX_SlideShow();
			$data_slide_show = $fx_slide_show->getSlideShowByCode($code);
			
			if($data_slide_show)
			{
				$reponse = array(
					'error_language' => $_LANG[LANG_SYS]['field_add_msg_error_code']);
				echo(json_encode($reponse));
				exit();		
			}

			if(LANG_SYS == $language)
			{
				//Insert slideShow
				$data_slide_show = array(
					'code' => $code, 
					'title' => $title, 
					'width' => $width, 
					'height' => $heigth
				);

				if($confirm_section == 1)
				{
					$data_slide_show['fx_section_id'] = $fx_section_id;
				}

				$fx_slideshow_id = $fx_slideShow->insert($data_slide_show, true);
			}
			else
			{
				$data_slide_show_lang = array(
					'fx_slideshow_id' => $fx_slideshow_id,
					'lang' 			  => $language,
					'title' 		  => $title 
				);			
				//Insert slideShowLang
				$fx_slideShowLang->insert($data_slide_show_lang);	
			}
		}
		$reponse = array(
			'success' => $_LANG[LANG_SYS]['add_pag_msg_success']);
		echo(json_encode($reponse));
	}
	exit();
}

if($_POST['action'] == "preview-slideshow")
{
	//var_dump($_POST);
	$sli_by_slId = $fx_slideShowImage->getSlideShowImageBySlideShowId($_POST['fx_slideshow_id']);
	//var_dump($sli_by_slId);
	if(empty($sli_by_slId))
	{
		?>
		<div class="alert alert-danger"><?=$_LANG[LANG_SYS]['no-data-ss']?></div>
		<?
		exit();
	}
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

if($_POST['action'] == "delete-slide")
{
	//var_dump($_POST);
	$fx_slideshow_id = $_POST['fx_slideshow_id'];
	
	$data_delete = array(
		'deleted' => 1, 
	);
	$fx_slideShow->update($data_delete, $fx_slideshow_id);
	exit();
}