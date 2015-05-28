<div class="row">
	<div class="col-sm-12">
		<h3 class="page-header">
            <a href="<?=FX_System::url('admin/menu/manager')?>"><?=$_LANG[LANG_SYS]['menu_mng_lbl_title']?></a>
        </h3>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-tasks"></i> <?=$_LANG[LANG_SYS]['menu_mng_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<!--Report error-->
			<div class = 'content-error-main'></div>
		<!-- End Error -->

		<!--Add menu-->
			<div class="form-group">
				<button class="btn btn-success pull-right save-position button-section-menu-top" success = "<?=$_LANG[LANG_SYS]["msg_success-save-pos_ss"]?>" type = "button"><?=$_LANG[LANG_SYS]['menu_mng_btn_save_pos']?></button>
				<button class="btn btn-success pull-right add-menu button-section-menu-top" href="<?=FX_System::url('admin/menu/manager')?>" name = "add-menu" value = "add-menu"><?=$_LANG[LANG_SYS]['menu_mng_btn_add_menu']?></button>
			</div>
		<!-- End Menu -->
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<p></p>
		<?php 
		foreach ($all_menu as $key => $value)
		{ 
			$data_section_by_menu = $obj_fx_section->getAllSectionByMenuId($value['fx_menu_id']);		
		?>
			<div class = "menu" style = "border: 1px solid #ccc; margin-bottom: 20px">
				<div class="list-group">
					<a class="list-group-item active" style = "overflow:auto; padding: 10px 9px; !important">
						<i class="glyphicon glyphicon-tasks"></i>
						<?=$_LANG[LANG_SYS]['menu_mng_lbl_main_title']." (".$value['key_menu']." ".$value['position'].")" ?>
						<? if($value['private'] == 1) { echo('<i class="glyphicon glyphicon-lock"></i>'); }	?>						
						<button href="<?=FX_System::url('admin/menu/manager')?>" class="btn btn-danger button-section-menu pull-right delete-menu" data = "<?echo $value['fx_menu_id']?>" type="button" name = "add-section" value = "add-section"><?=$_LANG[LANG_SYS]['menu_mng_delete_sect']?></button>
						<button href="<?=FX_System::url('admin/menu/manager')?>" class="btn btn-success button-section-menu pull-right add-section-menu" data = "<?echo $value['fx_menu_id']?>" type="button" name = "add-section" value = "add-section"><?=$_LANG[LANG_SYS]['menu_mng_btn_add_section']?></button>
					</a>
					<div class="dd menu<?=$key?>" menu-id = "<?=$value['fx_menu_id']?>">						
					    <ol class="dd-list">
					        <?php foreach ($data_section_by_menu as $key_section_menu => $value_section){ ?>
					        <li class="dd-item" data-id="<?=$value_section['fx_section_id']?>" position = "<?=$value_section['position']?>">
					            <div class="dd-handle">
									<?php echo $value_section['title']?>
									<?if($value_section['private'] == 1){?>
									<i class="glyphicon glyphicon-lock"></i>
									<?}?>
					            	<button class="btn btn-lg btn-danger pull-right button-section delete-section dd-nodrag" data = "<?echo $value_section['fx_section_id']?>"  type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_delete_section']?></button>
									<button href="<?=FX_System::url('admin/menu/manager')?>"  class="btn btn-lg  btn-primary pull-right button-section edit-section dd-nodrag" data = "<?echo $value_section['fx_section_id']?>" type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_edit_section']?></button>
									<button href="<?=FX_System::url('admin/menu/manager')?>" class="btn btn-lg btn-success pull-right button-section section-add dd-nodrag" data = "<?echo $value_section['fx_section_id']?>" type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_add_section']?></button>				
					            </div>
								<ol class="dd-list">
						            <?php $children_section = $obj_fx_section->getSectionByOwnerld($value_section['fx_section_id'], true);?>	
									<?php foreach ($children_section as $key_section_by_section => $value_section_by_section): 
									?>
									<li class="dd-item" data-id="<?=$value_section_by_section['fx_section_id']?>" position = "<?=$value_section_by_section['position']?>">
							            <div class="dd-handle">
											<?php echo $value_section_by_section['title']?>	
											<?if($value_section['private'] == 1){?>
											<i class="glyphicon glyphicon-lock"></i>
											<?}?>
							            	<button class="btn btn-lg btn-danger pull-right button-section delete-section dd-nodrag" data = "<?echo $value_section_by_section['fx_section_id']?>"  type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_delete_section']?></button>
											<button href="<?=FX_System::url('admin/menu/manager')?>"  class="btn btn-lg  btn-primary pull-right button-section edit-section dd-nodrag" data = "<?echo $value_section_by_section['fx_section_id']?>" type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_edit_section']?></button>
											<button href="<?=FX_System::url('admin/menu/manager')?>" class="btn btn-lg btn-success pull-right button-section section-add dd-nodrag" data = "<?echo $value_section_by_section['fx_section_id']?>" type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_add_section']?></button>				
							            </div>
							        	<?(count($value_section_by_section['fx_sub_section']) > 0) ?  CC_FileHandler::recursive1($value_section_by_section['fx_sub_section']): ""; ?>
							        </li>
									<?php endforeach ?>	
							    </ol>
					        </li>	
					        <?php } ?>		
					    </ol>
					</div>
				</div>
			</div>
		<?php 
		} 
		?>
	</div>	
</div>



















<style type="text/css">
a:hover{
text-decoration: none;
}
</style>
