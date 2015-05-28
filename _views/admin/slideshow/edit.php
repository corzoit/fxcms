<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/slideshow/manager')?>"><?=$_LANG[LANG_SYS]['manager_ss_lbl_cnt_mng']?></a> >
            <a href="<?=FX_System::url("admin/slideshow/edit/".$fx_slideshow_id)?>"><?=$_LANG[LANG_SYS]['edit_ss_lbl_cnt_mng']?></a> 
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-facetime-video"></i> <?=$_LANG[LANG_SYS]['edit_ss_lbl_subtitle_edit_ss']?>
	        </li>
	    </ol>
	</div>	
</div>
<div class = "tabbable tabs-left">
    <?$all_language = $obj_fxSysLang->getAllLanguage();?>
    <ul class="nav nav-tabs">
    	<?php foreach ($all_language as $key => $language): ?>
        	<li <?=($key == 0)?'class="active"':''?> ><a data-toggle="tab" href="<?='#'.$language?>"><?=$language?></a></li>	
        <?php endforeach ?>
    </ul>
</div> 
<form class="form-horizontal" style = "margin-top: 20px" role="form" method="POST">
	<div class="tab-content">
		<?php foreach ($all_language as $key => $language): ?>
		<?php 
		if(LANG_SYS == $language)
		{
			$dataSlideShow = $fx_slideShow->getById($fx_slideshow_id);
			/*var_dump($dataSlideShow);
			exit(); */
		}
		else
		{
			$dataSlideShow = $fx_slideShowLang->getSsLangBySsIdAndLang($fx_slideshow_id, $language);
			/*var_dump($dataSlideShow);
			exit();*/
		}	
		?>
		<div id="<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"' ?> >			
			<?php if (LANG_SYS == $language)
			{?>
				<input class="form-control" type="hidden" name = "<?=$language?>[id]" value = "<?=$dataSlideShow['fx_slideshow_id']?>">	
			<?php 
			}
			else
			{
			?>
				<input class="form-control" type="hidden" name = "<?=$language?>[id]" value = "<?=$dataSlideShow['fx_slideshow_lang_id']?>">			
			<?php }?>

			<?php if (LANG_SYS == $language): ?>
			<div class="form-group">
				<label class="col-sm-1 control-label"><p class = "text-left">
					<?=$_LANG[LANG_SYS]['lbl_code_ss_create']?>:</p>
				</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" placeholder="<?=$_LANG[LANG_SYS]['lbl_code_ss_create']?>" name = "<?=$language?>[code]" value = "<?=$dataSlideShow['code']?>">
				</div>
			</div>
			<?php endif ?>

			<div class="form-group">
				<label class="col-sm-1 control-label"><p class = "text-left">
				<?=$_LANG[LANG_SYS]['lbl_title_ss_create']?></p></label>
				<div class="col-sm-10">
					<input class="form-control" type="text" placeholder="<?=$_LANG[LANG_SYS]['lbl_title_ss_create']?>" name = "<?=$language?>[title]" value = "<?=$dataSlideShow['title']?>">
				</div>
			</div>

			<?php if (LANG_SYS == $language): ?>
			<div class="form-group">
				<label class="col-sm-1 control-label">
				<p class = "text-left"><?=$_LANG[LANG_SYS]['lbl_width_ss_create']?></p></label>
				<div class="col-sm-10">
					<input class="form-control" type = "text" placeholder="<?=$_LANG[LANG_SYS]['lbl_width_ss_create']?>" name = "<?=$language?>[width]"  value = "<?=$dataSlideShow['width']?>">
				</div>
			</div>
			<?php endif ?>			

			<?php if (LANG_SYS == $language): ?>
			<div class="form-group">
				<label class="col-sm-1 control-label">
				<p class = "text-left"><?=$_LANG[LANG_SYS]['lbl_height_ss_create']?></p></label>
				<div class="col-sm-10">
					<input class="form-control" type = "text" placeholder="<?=$_LANG[LANG_SYS]['lbl_height_ss_create']?>" name = "<?=$language?>[height]" value = "<?=$dataSlideShow['height']?>">
				</div>
			</div>
			<?php endif ?>
			<?php if ($language == LANG_SYS): ?>
				<?php 				
				$data_sec = $fx_section->getSectionById($dataSlideShow['fx_section_id']);
				$data_section = $fx_section->getSectionByOwnerld($owner_id = 0,  $all_levels = false);					
				?>
				<div class="form-group">					
					<label class="col-sm-4">
						<?=$_LANG[LANG_SYS]['lbl_section_ss_create']?>					
					 </label>					 
					  <label class="col-sm-10 control-label">
					  </label>		 
					 <div class="col-sm-4">
					 	<?php 
					 	$display = $dataSlideShow['fx_section_id'] == 0 ? "display:none;" : "display:block;";
					 	$checked = $display;
					 	?>
					 	<input type="radio" class="confirm_section" name="<?=$language?>[confirm_section]" <?=$checked=="display:block;"?"checked='checked'": ""?>  value="1" /> Yes
					 	<input type="radio" class="confirm_section" name="<?=$language?>[confirm_section]" <?=$checked=="display:none;"?"checked='checked'":''?> value="0" /> No
						<select class="form-control select_confirm" name="<?=$language?>[fx_section_id]" style="<?=$display?>">
							<?php foreach ($data_section as $key_data_section => $value_data_section): ?>
								<?php   $selected = $dataSlideShow['fx_section_id'] == $value_data_section['fx_section_id']? "selected" : ""; ?>
								<option value="<?=$value_data_section['fx_section_id']?>" <?=$selected?>><?=$value_data_section['title']?></option>
							<?php endforeach ?>						
						</select>					
					</div>
				</div>
			<?php endif ?>
		</div>
		<?php endforeach ?>
	</div>
	<div class="form-group form-group-lg" style = "margin-top: 30px">
		<label class="col-sm-1 control-label" for="formGroupInputLarge"></label>
		<div class="col-sm-10">
			<button type = "submit" class="btn btn-primary" name = "btn-save" 
			value = "save-edit-slide-show">
			<?=$_LANG[LANG_SYS]['btn_save_ss_edit']?>
			</button>
		</div>
	</div>
</form>

<div class = "row" style = "padding: 17px">
	<div class = "panel-link-ss-image" style = " float: left;  margin-left : 10px; color : #428bca ; display: block"><a href="<?=FX_System::url('admin/slideshow/edit')?>" data = "<?=$fx_slideshow_id?>" id = "add-new-image"><?=$_LANG[LANG_SYS]['link-add-image-ss']?></a></div>
	<div class = "panel-link-ss-image" style = "float: left;  margin-left : 10px; color : #428bca; display: block"><a href="<?=FX_System::url('admin/slideshow/edit')?>" data = "<?=$fx_slideshow_id?>" id = "preview-slideshow"><?=$_LANG[LANG_SYS]['link-Preview-ss']?></a></div>
</div>

<div class = 'content-error'></div>

<!--Details slideshow image-->
<div class="row" id="contentDiv">
		<div class="panel-body">					
			<div class = "menu">
				<div class="list-group">
					<a class="list-group-item active" style = "overflow:auto;">
						<i class="glyphicon glyphicon-facetime-video"></i>
						<?=$_LANG[LANG_SYS]['edit_title_slideshowImage']?>
						<div class = "col-xs-2" style = "float: right">
							<button href="<?=FX_System::url('admin/slideshow/edit')?>" class="btn btn-lg btn-success button-section-menu pull-right save-position" success = "<?=$_LANG[LANG_SYS]["msg_success-save-pos_ss"]?>" data = "<?echo $value['fx_menu_id']?>" type="button" name = "add-section" value = "add-section">Save position</button>
						</div>
					</a>

					<div class="dd">
						<ol class="dd-list">
							<?php foreach ($sli_by_slId as $key => $data_slide_show_image) {
							?>
								<li class="dd-item" data-id= "<?=$data_slide_show_image['fx_slideshow_image_id']?>" >
									<div class="dd-handle .col-lg-12" >
										<div class= "col-xs-2" ><?=$data_slide_show_image['caption']?></div>
										<div class= "col-xs-8 text-center"><?=$data_slide_show_image['link']?></div>
										<div class = "col-xs-2">
											<button class="btn btn-lg btn-danger pull-right button-ss-image dd-nodrag delete-slide-show-image" success = "<?=$_LANG[LANG_SYS]['msg_success_ss']?>" warning = "<?=$_LANG[LANG_SYS]['msg_delete_ss']?>" data = "<?=$data_slide_show_image['fx_slideshow_image_id']?>" type="button"><?=$_LANG[LANG_SYS]['btn_delete_ss_create']?></button>
											<button href="<?=FX_System::url('admin/slideshow/edit')?>" class="btn btn-lg pull-right btn-primary button-ss-image dd-nodrag edit-slide-show-image" data = "<?=$data_slide_show_image['fx_slideshow_image_id']?>" type="button"><?=$_LANG[LANG_SYS]['btn-edit-ss']?></button>
										</div>
									</div>
								</li>
							<?}?>	
						</ol>														
					</div>
				</div>							
			</div>				
		</div>
	<!-- </div> -->
</div>
<script type="text/javascript">
$(".confirm_section").on("change", function(){							
			$(this).val()==1? $(".select_confirm").show() : $(".select_confirm").hide();
		});
</script>