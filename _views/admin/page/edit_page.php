<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/page/manager')?>"><?=$_LANG[LANG_SYS]['edit_pag_lbl_cnt_mng']?></a> >
            <a href="<?=FX_System::url("admin/page/edit/".$__FX_PARAMS['id'])?>"><?=$_LANG[LANG_SYS]['edit_pag_lbl_edit_page']?></a> 
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-picture"></i> <?=$_LANG[LANG_SYS]['edit_pag_lbl_subtitle_edit_page']?>
	        </li>
	    </ol>
	</div>	
</div>
<?php foreach($all_language as $key => $language)
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
	if($error_field_required or $error_image_invalids)
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
		<form method="POST" enctype="multipart/form-data">
			<div class="tab-content">
				<?php
				foreach ($all_language as $key => $language)
				{ 
					if(isset($data_page_fill) and count($data_page_fill))
					{
						$data_page = $data_page_fill[$language];    
					}
					if(isset($data_product_fill) and count($data_product_fill))
					{
						$data_product = $data_product_fill;    
					}

					else
					{
						if(LANG_SYS == $language)
						{
							$data_page = $data_page;
							$data_product = $data_product;
						}
						else
						{
							$filter = array('fx_page_id' => $data_page['fx_page_id'], 'lang' => $language);
							$data_page = $fx_page_lang->getByFilter($filter, '', 1);
						}				
					}
				?>		
					<div id="<?=$language?>" <?=(LANG_SYS == $language)?'class="tab-pane active"':'class="tab-pane fade"' ?> >
						<div class="panel panel-primary">
							<div class="panel-heading"><h3><?=$_LANG[LANG_SYS]['edit_pag_gr1_title']?></h3></div>
							<div class="panel-body">
								<div class="form-horizontal">
									<?php
									if(LANG_SYS == $language)
									{
									?>
										<div class="form-group">
									        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_sect']?>:</label>
									        <div class="col-xs-7">
									        	<?php
									        	if(LANG_SYS == $language)
									        	{
									        	?>
									        	<input type="hidden" name="<?=$language?>[section_id]" value="<?=$data_section['fx_section_id']?>">
									        	<input type="hidden" name="<?=$language?>[page_id]" value="<?=$data_page['fx_page_id']?>">
								        		<select class="selectpicker form-control" name="<?=$language?>[section_id]" data-live-search="true">
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
																if($data_page['fx_section_id'] == $value_section['fx_section_id'])
																{
																	$selected = "selected";
																}
															?>
																<option <?=$selected?> value="<?=$value_section['fx_section_id']?>" data="<?=$value_section['section_type']?>">* <?=$value_section['title']?></option>
																<?php
																foreach ($data_sub_section as $key_data_sub_section => $value_data_sub_section)
																{
																	$selected = '';
																	if($data_page['fx_section_id'] == $value_data_sub_section['fx_section_id'])
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
																			CC_FileHandler::nSubSections($value_data_sub_section, $space, $data_page['fx_section_id']);
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
														<?php if ($cont < $i): ?>
														<option data-divider="true"></option>	
														<?php endif ?>
													<?php
													}
												}
													?>
												</select>
									        	<?php
									        	}
									        	?>
									        </div>
									    </div>
								    <?php
								    }
								    ?>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_tit']?>(*):</label>
								        <div class="col-xs-7">
								            <!--<input type="text" name="title_page" value="<?=$data_page['title']?>" class="form-control">-->
								            <input type="text" name="<?=$language?>[title_page]" value="<?=$data_page['title']?>" class="form-control">
								        </div>
								    </div>
								    <?php
								    if(LANG_SYS == $language)
								    {
								    ?>

								    <div class="form-group">
							            <label class="control-label col-xs-3">
							            	Establecer como página principal::
							            </label>
							            <?php
							            	$page_default = $data_page['page_default'] ? "value = 1" : '';
								        ?>
							            <div class="col-xs-7">
							                <input data-toggle="checkbox-x" <?=$page_default?> data-three-state="false" name="<?=$language?>[chk_page_default]">
							            	<!-- <label class="checkbox-inline">
							                	<a href="">This product has {num} orders</a>
							            	</label> -->
							        	</div>
								    </div>


								    <div class="form-group">
							            <label class="control-label col-xs-3">
							            	<?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_priv']?>:
							            </label>
							            <?php
								           	$chk = $data_page['private'] ? "value = 1" : '';
								        ?>
							            <div class="col-xs-7">
							                <input data-toggle="checkbox-x" <?=$chk?> data-three-state="false" name="<?=$language?>[chk_private]">
							            	<!-- <label class="checkbox-inline">
							                	<a href="">This product has {num} orders</a>
							            	</label> -->
							        	</div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_show_content']?>:</label>
										<div class='col-xs-2 input-group date'>
										    <input style="margin-left:15px; width:95%" type='text' value="<?=$fx_date->convertToLocal($data_page['start_dt'], false)?>" name="<?=$language?>[start_dt]" id='datetime_show' class="form-control" />
										</div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_hide_content']?>:</label>
										<div class='col-xs-2 input-group date'>
										    <input style="margin-left:15px; width:95%" type='text' value="<?=$fx_date->convertToLocal($data_page['end_dt'], false)?>" name="<?=$language?>[end_dt]" id='datetime_hide' class="form-control" />
										</div>
								    </div>
								    <div class="form-group">
									    <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_thumb']?>:</label>
									    <div class="col-xs-7">
								            <input type="file" name="<?=$language?>[thumbnail]">
								        </div>
											<?php
											if($data_page['thumbnail'] && file_exists("file/img/page/thumbnail/".$data_page['thumbnail']))
											{
												$dom_keyid = 'fxthumbnail_'.$__FX_PARAMS['id'];	
											?>
											<div class="form-group">
										        <div class="col-xs-offset-3 col-xs-9">
										        	<span id="<?php echo($dom_keyid)?>" class="ncbBoxFile">
											            <label class="checkbox-inline">
											            	<a class="images" href="<?=FX_System::url("file/img/page/thumbnail/".$data_page['thumbnail'])?>"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_view_img']?></a>
											            </label>
											            <label class="checkbox-inline">
											                <a href="javascript:void(0)" onclick="deleteImage('<?php echo($dom_keyid)?>' ,'thumbnail')"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_del_img']?></a>							                
											            </label>
										        	</span>
										        </div>
										    </div>
											<?
											}							
											?>
									</div>
									<div class="form-group">
									    <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_img']?>:</label>
									    <div class="col-xs-7">
								            <input type="file" name="<?=$language?>[image]">
								        </div>
											<?php
											if($data_page['image'] && file_exists("file/img/page/image/".$data_page['image']))
											{
												$dom_keyid = 'fximage_'.$__FX_PARAMS['id'];	
											?>
											<div class="form-group">
										        <div class="col-xs-offset-3 col-xs-9">
										        	<span id="<?php echo($dom_keyid)?>" class="ncbBoxFile">
											            <label class="checkbox-inline">
											                <a class="images" href="<?=FX_System::url("file/img/page/image/".$data_page['image'])?>"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_view_img']?>:</a> 
											            </label>
											            <label class="checkbox-inline">
											                <a href="javascript:void(0)" onclick="deleteImage('<?php echo($dom_keyid)?>' ,'image')"><?=$_LANG[LANG_SYS]['edit_pag_gr1_lbl_del_img']?></a>							                
											            </label>
										        	</span>
										        </div>
										    </div>
											<?
											}							
											?>
									</div>
									
									<div class="form-group">								    	
										<label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_lbl_lbl_type_comment']?>:</label>
									    <div class="col-xs-7">
									    	<?php 									    	
									    	$checked_default =  $data_page['comments_type'] == null ? "checked='checked'" : "";  									    	
											$checked_comment = ($checked_default == "") ? ($data_page['comments_type'] == 'none') ? ("checked='checked'") :("") : ("checked='checked'");									    	
									    	?>
								            <input id="chk_comment_type_none" <?=$checked_comment?> type="radio" value="none" name="<?=$language?>[comments_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_comments_none']?>
								            <input <?=$checked_comment = $data_page['comments_type'] == 'admin' ? "checked='checked'" : "" ?> type="radio" value="admin" name="<?=$language?>[comments_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_comments_admin']?>
								        </div>
									</div>
									<?php
									}
									?>
									<div class="form-group">								        								       
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['add_pag_lbl_lbl_type_page']?>:</label>
								        <div class="col-xs-7">
								        	<?php 									    	
									    	$checked_default =  $data_page['page_type'] == null ? "checked='checked'" : "";
											$checked_page = ($checked_default == "") ? ($data_page['page_type'] == 'none') ? ("checked='checked'") :("") : ("checked='checked'");
									    	?>
								            <input id="chk_page_type_none" <?=$checked_page?> type="radio" value="none" name="<?=$language?>[page_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_page_none']?>
								            <input id="chk_page_type_gallery" <?=$checked_page = $data_page['page_type'] == 'Gallery' ? "checked='checked'" : "" ?> type="radio" value="Gallery" name="<?=$language?>[page_type]"><?=$_LANG[LANG_SYS]['add_pag_check_type_page_galery']?>
								        </div>
								        <!--<div id="content_page_gallery" style="<?=$data_page['page_type'] == 'Gallery'? 'display:block':'display:none'?>" class="col-xs-10 col-xs-offset-1">								            
								            <input type="submit" class="btn btn-primary" value="<?=$_LANG[LANG_SYS]['add_pag_btn_edit_galery']?>">
								        </div>-->
								    </div>								    
								     <div class="form-group">
								    	<div class="col-xs-3"></div>								    	
								    	<div id="content_page_gallery" style="<?=$data_page['page_type'] == 'Gallery' ? 'display:block;': 'display:none;'?>" class="col-xs-7">
								            <!--<input type="submit" class="btn btn-primary" value="<?=$_LANG[LANG_SYS]['add_pag_btn_create_galery']?>">-->
								            <a href="<?=FX_System::url('admin/list/?page_id='.$data_page['fx_page_id']).'&type=page'?>" class="fancybox" id="daniel">UPLOAD FILE FOR GALLERY</a>								            
								        </div>
								    </div>								    
								    <div class="form-group">
								    	<label  class="control-label col-xs-3 content_page_none"><?=$_LANG[LANG_SYS]['add_pag_lbl_lbl_cont']?>:</label>
								        <div class="col-xs-10 col-xs-offset-1 content_page_none">
								            <textarea class="tinymce_add_page" rows="15" class="form-control" name="<?=$language?>[content]"><?=$data_page['content']?></textarea>
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
							<div class="panel-heading"><h3><?=$_LANG[LANG_SYS]['content_manager_title']?><?=$_LANG[LANG_SYS]['edit_pag_gr2_title']?>:</h3></div>
							<div class="panel-body">
								<div class="form-horizontal">
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr2_lbl_stock']?>:</label>
								        <div class="col-xs-3">
								            <input id="stock" type="text" class="form-control" value="<?=$data_product['stock']?>" type="text" name="<?=$language?>[stock]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr2_lbl_price']?>:</label>
								        <div class="col-xs-3">
								        	<input id="price" type="text" class="form-control" value="<?=$data_product['price']?>" type="text" name="<?=$language?>[price]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr2_lbl_disc']?>:</label>
								        <div class="col-xs-3">
								            <input id="discount_per" class="form-control" value="<?=$data_product['discount_per']?>" type="text" value="0" name="<?=$language?>[discount_per]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr2_lbl_disc_val']?>:</label>
								        <div class="col-xs-3">
								            <input id="discount_val" type="text" value="<?=$data_product['discount_val']?>" class="form-control" type="text" name="<?=$language?>[discount_val]">
								        </div>
								    </div>
								    <div class="form-group">
								        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr2_lbl_hide_stock']?>:</label>
								        <div class="col-xs-3">
								            <?php
								           		$chk = $data_product['hide_no_stock'] ? "value = 1" : '';
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
						<!-- SEO 
							<div class="panel panel-primary">
								<div class="panel-heading"><h3><?=$_LANG[LANG_SYS]['edit_pag_gr3_title']?>:</h3></div>
								<div class="panel-body">
									<div class="form-horizontal">
									    <div class="form-group">
									        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr3_lbl_title']?>:</label>
									        <div class="col-xs-7">
									            <input type="text" class="form-control" value="<?=$data_page['meta_title']?>" name="<?=$language?>[meta_title]">
									        </div>
									    </div>
									    <div class="form-group">
									        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr3_lbl_key']?>:</label>
									        <div class="col-xs-7">
									            <input type="text" class="form-control" value="<?=$data_page['meta_keywords']?>" name="<?=$language?>[meta_keywords]">
									        </div>
									    </div>
									    <div class="form-group">
									        <label class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['edit_pag_gr3_lbl_desc']?>:</label>
									        <div class="col-xs-7">
									            <input type="text" class="form-control" value="<?=$data_page['meta_description']?>" name="<?=$language?>[meta_description]">
									        </div>
									    </div>
									</div>
								</div>
							</div>
						-->
						
						<div class="form-group" align="center">
						    <div class="col-xs-12">
						    	<input type="hidden" name="action" value="edit_page">
						    	<?php
						    	if(LANG_SYS != $language)
						    	{
						    	?>
						    		<input type="hidden" name="<?=$language?>[page_lang_id]" value="<?=$data_page['fx_page_lang_id']?>">
						        <?php
						        }
						        ?>
						        <input type="submit" class="btn btn-primary" value="<?=$_LANG[LANG_SYS]['edit_pag_lbl_btn_editar']?>">
						        <a href="<?=FX_System::url('admin/page/manager')?>" style="margin-left:30px" type="button" class="btn btn-danger"><?=$_LANG[LANG_SYS]['edit_pag_lbl_btn_close']?></a>
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
