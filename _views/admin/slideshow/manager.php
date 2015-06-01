<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
			<a href="<?=FX_System::url('admin/slideshow/manager')?>"><?=$_LANG[LANG_SYS]['menu_slides_manager']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-facetime-video"></i> <?=$_LANG[LANG_SYS]['menu_slides_manager']?>
	        </li>
	    </ol>
	</div>	
</div>

<div style ="text-align: right; padding-bottom: 10px; color: #428bca"; ><a class = "add-new-slideShow" href = "manager"><?=$_LANG[LANG_SYS]['txt_create_slideshow']?></a></div>
<div class="row" id="contentDiv">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="glyphicon glyphicon-facetime-video"></i>
				<?=$_LANG[LANG_SYS]['field_title_slideshow']?>
			</h3>
		</div>
		<div class="panel-body">					
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th style="text-align: center"><?=$_LANG[LANG_SYS]['row_title_slideshow']?></th>
							<th style="text-align: center"><?=$_LANG[LANG_SYS]['row_code_slideshow']?></th>
							<th style="text-align: center"><?=$_LANG[LANG_SYS]['row_dimentions_slideshow']?></th>
							<th style="text-align: center">Actions</th>
						</tr>
					</thead>
					<tbody class="tBody">													
						<?php foreach ($get_all_slide_show as $key => $data_slide_show) {						
						?>
						<tr class="view_record">
							<td style="text-align: center"><?=$data_slide_show['title']?></td>
							<td style="word-wrap: break-word; text-align: center; "><?=$data_slide_show['code']?></td>
							<td style="text-align: center"><?=$data_slide_show['width']?>; <?=$data_slide_show['height']?></td>
							<td width="250" align="right">
								<button href="<?=FX_System::url('admin/slideshow/manager')?>" class="btn btn-default preview-slideshow" data = "<?=$data_slide_show['fx_slideshow_id']?>" type="submit"><?=$_LANG[LANG_SYS]['btn_preview_ss_create']?></button>
								<a href="edit/<?=$data_slide_show["fx_slideshow_id"]?>"><button class="btn btn-primary" type="button"><?=$_LANG[LANG_SYS]['btn_edit_ss_create']?></button></a>										
								<button class="btn btn-danger delete-slide-show" type="button" msg = "<?=$_LANG[LANG_SYS]['msg_delete_ss']?>" data = "<?=$data_slide_show['fx_slideshow_id']?>"><?=$_LANG[LANG_SYS]['btn_delete_ss_create']?></button>
							</td>
						</tr>
						<?}?>															
					</tbody>
				</table>
			</div>				
		</div>
	</div>
</div>