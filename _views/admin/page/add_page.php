<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/page/manager')?>"><?=$_LANG[LANG_SYS]['add_pag_lbl_cnt_mng']?></a> >
            <a href="<?=FX_System::url("admin/page/add")?>"><?=$_LANG[LANG_SYS]['add_pag_lbl_add_new_page']?></a> 
            
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-picture"></i> <?=$_LANG[LANG_SYS]['add_pag_lbl_subtitle_add_new_page']?>
	        </li>
	    </ol>
	</div>	
</div>
<?php 
	foreach($all_language as $key => $language)
	{
		if($errors[$language]['error_field_required'])
		{
			$error_field_required .= $errors[$language]['error_field_required'].strtoupper($language)."<br>";	
		}
		if($errors[$language]['error_image_invalids'])
		{
			$error_image_invalids .= $errors[$language]['error_image_invalids'].strtoupper($language)."<br>";	
		}
	}
	if($error_field_required || $error_image_invalids)
	{
	?>
		<div class="alert alert-danger">
			<?=$error_field_required.$error_image_invalids?>
		</div>	
	<?php
	}
	if($errors["msg_success"])
	{
	?>
		<div class="alert alert-success"><?=$errors["msg_success"]?></div>
	<?php
	}
?>
<div class="row">
	<div class="col-sm-12">
		<div class = "tabbable tabs-left">
		    <ul class="nav nav-tabs">
		    	<?php
		    	foreach($all_language as $key => $language)
		    	{
		    	?>
		        	<li <?=(LANG_SYS == $language)?'class="active"':''?> ><a data-toggle="tab" href="<?='#'.$language?>"><?=strtoupper($language)?></a></li>	
		        <?php
		    	}
		        ?>
		    </ul>
		</div>
		<form method="POST" enctype="multipart/form-data" class = "form">
			<div class="tab-content">
				<?php
				foreach ($all_language as $key => $language)
				{
				?>
					<div id="<?=$language?>" <?=(LANG_SYS == $language)?'class="tab-pane active"':'class="tab-pane fade"' ?> >
						<div class="panel panel-primary">
							<div class="panel-heading"><h3><?=$_LANG[LANG_SYS]['add_pag_gr1_title']?></h3></div>
							<div class="panel-body">
								<div class="form-horizontal">
									<?php
									if(LANG_SYS == $language)
									{
									?>
										<div class="form-group">
									        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr1_lbl_sect']?>(*):</label>
									        <div class="col-xs-7" id="select_section">
									        	<select class="selectpicker form-control" name="<?=$language?>[section]" data-live-search="true">
												<?php 
												$i = count($menu);
												$cont = 0;
												if($menu)
												{
													foreach ($menu as $key_menu => $value_menu)
													{
														$cont=$cont+1;
													?>
														<optgroup label="<?=$value_menu['key_menu']?>">
														<?php	
														$data = array('fx_menu_id' => $value_menu['fx_menu_id'], 'deleted' => 0);
														$section = $fx_section->getByFilter($data, '', false);	 
														$font = '';
														if($section)
														{

															foreach($section as $key_section => $value_section)
															{	
																$data_sub_section = $fx_section->getSectionByOwnerld($value_section['fx_section_id'], true);
																$selected = '';
																if($_POST[$language]['section'] == $value_section['fx_section_id'])
																{
																	$selected = "selected";
																}
															?>
																<option <?=$selected?> value="<?=$value_section['fx_section_id']?>" data="<?=$value_section['section_type']?>">* <?=$value_section['title']?></option>
																<?php
																foreach ($data_sub_section as $key_data_sub_section => $value_data_sub_section)
																{
																	$selected = '';
																	if($_POST[$language]['section'] == $value_data_sub_section['fx_section_id'])
																	{
																		$selected = "selected";
																	}
																	$space=25;
																		?>
																		<option <?=$selected?> style="margin-left:<?=$space?>px;" value="<?=$value_data_sub_section['fx_section_id']?>" data="<?=$value_data_sub_section['section_type']?>">* <?=$value_data_sub_section['title']?></option>
																		<?
																		if(is_array($value_data_sub_section))
																		{
																			$space= $space + 25;
																			CC_FileHandler::nSubSections($value_data_sub_section, $space, $_POST[$language]['section']);
																		}
																}					
															}
														}
														else
														{
														?>
															<option disabled="disabled">No sections to this menu.</option>
														<?
														}
														?>
														</optgroup>
														<?php if ($cont < $i){ ?>
														<option data-divider="true"></option>	
														<?php } ?>
													<?php
													}
												}
													?>
												</select>
									        </div>
									    </div>
									<?php
								 	}
								 	?>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr1_lbl_tit']?>(*):</label>
								        <div class="col-xs-7">
								            <input type="text" name="<?=$language?>[title_page]" value="<?=$_POST[$language]['title_page']?>" class="form-control">
								        </div>
								    </div>
								    <?php
								    if(LANG_SYS == $language)
								    {
								    ?>
								    <div class="form-group">
							            <label class="control-label col-xs-3">
							            	Establecer como página principal:
							            </label>
							            <?php
								           	$page_default = $_POST[$language]['chk_page_default'] ? "value = 1" : '';
								        ?>
							            <div class="col-xs-7">
							                <input data-toggle="checkbox-x" data-three-state="false" <?=$page_default?> name="<?=$language?>[chk_page_default]">
							        	</div>
								    </div>


								    <div class="form-group">
							            <label class="control-label col-xs-3">
							            	<?=$_LANG[LANG_SYS]['add_pag_gr1_lbl_priv']?>:
							            </label>
							            <?php
								           	$chk = $_POST[$language]['chk_private'] ? "value = 1" : '';
								        ?>
							            <div class="col-xs-7">
							                <input data-toggle="checkbox-x" data-three-state="false" <?=$chk?> name="<?=$language?>[chk_private]">
							            	<!-- <label class="checkbox-inline">
							                	<a href="">This product has {num} orders</a>
							            	</label> -->
							        	</div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr1_lbl_show_content']?>(*):</label>
										<div class='col-xs-2 input-group date'>
										    <input style="margin-left:15px; width:98%" type='text' value="<?=$_POST[$language]['start_dt']?>" name="<?=$language?>[start_dt]" id='datetime_show' class="form-control" />
										</div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr1_lbl_hide_content']?>(*):</label>
										<div class='col-xs-2 input-group date'>
										    <input style="margin-left:15px; width:95%" type='text' value="<?=$_POST[$language]['end_dt']?>" name="<?=$language?>[end_dt]" id='datetime_hide' class="form-control" />
										</div>
								    </div>
								    <?php
								    }
								    ?>
								    <?php 
								    if(LANG_SYS == $language)
								    {
								    ?>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr1_lbl_thumb']?>(*):</label>
								        <div class="col-xs-7">
								            <input type="file" name="<?=$language?>[thumbnail]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr1_lbl_img']?>(*):</label>
								        <div class="col-xs-7">
								        	<input type="file" name="<?=$language?>[image]">
								        </div>
								    </div>			    
								    <?php
								    }
								    ?>

								    <div class="form-group">								    	
										<label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_lbl_lbl_type_comment']?>:</label>
									    <div class="col-xs-7">
									    	<?php 									    	
									    	$checked_default =  $_POST[$language]['comments_type'] == null ? "checked='checked'" : "";  									    	
											$checked_comment = ($checked_default == "") ? ($_POST[$language]['comments_type'] == 'none') ? ("checked='checked'") :("") : ("checked='checked'");									    	
									    	?>
								            <input id="chk_comment_type_none" <?=$checked_comment?> type="radio" value="none" name="<?=$language?>[comments_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_comments_none']?>
								            <input <?=$checked_comment = $_POST[$language]['comments_type'] == 'admin' ? "checked='checked'" : "" ?> type="radio" value="admin" name="<?=$language?>[comments_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_comments_admin']?>
								        </div>
									</div>

								    <div class="form-group">								        								       
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_lbl_lbl_type_page']?>:</label>
								        <div class="col-xs-7">
								        	<?php 									    	
									    	$checked_default =  $_POST[$language]['page_type'] == null ? "checked='checked'" : "";
											$checked_page = ($checked_default == "") ? ($_POST[$language]['page_type'] == 'none') ? ("checked='checked'") :("") : ("checked='checked'");
									    	?>
								            <input id="chk_page_type_none" <?=$checked_page?> type="radio" value="none" name="<?=$language?>[page_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_page_none']?>
								            <input id="chk_page_type_gallery" <?=$checked_page = $_POST[$language]['page_type'] == 'Gallery' ? "checked='checked'" : "" ?> type="radio" value="Gallery" name="<?=$language?>[page_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_page_galery']?>
								        </div>
								        <div id="content_page_gallery" style="display:none" class="col-xs-10 col-xs-offset-1">								            
								            <input type="submit" class="btn btn-primary" value="<?=$_LANG[LANG_SYS]['add_pag_btn_create_galery']?>">
								        </div>
								    </div>
								    <div class="form-group">
								    	<label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_lbl_lbl_cont']?>:</label>
								        <div id="content_page_none" class="col-xs-10 col-xs-offset-1">
								            <textarea class="tinymce_add_page" rows="15" class="form-control" name="<?=$language?>[content]"><?=$_POST[$language]['content']?></textarea>
								        </div>								       
								    </div>
								</div>
							</div>
						</div>
						<?php
						if(LANG_SYS == $language)
						{
						?>
						<div class="panel panel-primary" id="form_product">
							<div class="panel-heading"><h3><?=$_LANG[LANG_SYS]['content_manager_title']?><?=$_LANG[LANG_SYS]['add_pag_gr2_title']?>:</h3></div>
							<div class="panel-body">
								<div class="form-horizontal">
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr2_lbl_stock']?>:</label>
								        <div class="col-xs-3">
								            <input id="stock" type="text" class="form-control" value="<?=$_POST[$language]['stock']?>" type="text" name="<?=$language?>[stock]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr2_lbl_price']?>:</label>
								        <div class="col-xs-3">
								        	<input id="price" type="text" class="form-control" value="<?=$_POST[$language]['price']?>" type="text" name="<?=$language?>[price]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr2_lbl_disc']?>:</label>
								        <div class="col-xs-3">
								            <input id="discount_per" class="form-control" value="<?=$_POST[$language]['discount_per']?>" type="text" value="0" name="<?=$language?>[discount_per]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr2_lbl_disc_val']?>:</label>
								        <div class="col-xs-3">
								            <input id="discount_val" type="text" value="<?=$_POST[$language]['discount_val']?>" class="form-control" type="text" name="<?=$language?>[discount_val]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr2_lbl_hide_stock']?>:</label>
								        <div class="col-xs-3">
								            <?php
								           		$chk = $_POST[$language]['hide_no_stock'] ? "value = 1" : '';
								        	?>
								            <input data-toggle="checkbox-x" data-three-state="false" <?=$chk?> name="<?=$language?>[hide_no_stock]">
								        </div>
								    </div>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						<!--<div class="panel panel-primary">
							<div class="panel-heading"><h3><?=$_LANG[LANG_SYS]['content_manager_title']?><?=$_LANG[LANG_SYS]['add_pag_gr3_title']?>:</h3></div>
							<div class="panel-body">
								<div class="form-horizontal">
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr3_lbl_title']?>:</label>
								        <div class="col-xs-7">
								            <input type="text" class="form-control" value="<?=$_POST[$language]['meta_title']?>" name="<?=$language?>[meta_title]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr3_lbl_key']?>:</label>
								        <div class="col-xs-7">
								            <input type="text" class="form-control" value="<?=$_POST[$language]['meta_keywords']?>" name="<?=$language?>[meta_keywords]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_gr3_lbl_desc']?>:</label>
								        <div class="col-xs-7">
								            <input type="text" class="form-control" value="<?=$_POST[$language]['meta_description']?>" name="<?=$language?>[meta_description]">
								        </div>
								    </div>
								</div>
							</div>
						</div>
						-->							
						<div class="form-group" align="center">
						    <div class="col-xs-12">
						    	<input type="hidden" name="action" value="add_page">
						    	<input type="hidden" id="section_type_hidden" name="section_type">
						        <input type="submit" class="btn btn-primary" value="<?=$_LANG[LANG_SYS]['add_pag_lbl_btn_save']?>">
						        <a href="<?=FX_System::url('admin/page/manager')?>" style="margin-left:30px" type="button" class="btn btn-danger"><?=$_LANG[LANG_SYS]['add_pag_lbl_btn_close']?></a>
						  	</div>
						</div>
					</div>
				<?php 
				}
				?>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	// Js/pages/admin/page/add_page.js		
   createDateFormat('<?=$format_d?>');   
</script>