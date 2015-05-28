<?php
define ("FX_TEMPLATE","admin.php");
$fx_date = 	new FX_Date();
if(isset($_SESSION['sysuser_id']))
{ 
	$fx_page = new FX_Page();
	//show droplist section
	$fx_menu = new FX_Menu();
	$fx_section = new FX_Section();
	$data = array('deleted' => 0);
	$menu = $fx_menu->getByFilter($data, "", false);
	//start ajax search
	if($_POST['action'] == 'content_manager_keyword')
	{
		$num_page = '';
		if(isset($_POST['num_pag']) and $_POST['num_pag'] != '')
		{
			$num_page = $_POST['num_pag'];
		}
		$data = '';
		if(isset($_POST['data']) and is_numeric($_POST['data']))
		{
			$data = $_POST['data'];
		}
		$search_manager = $_POST['search'];
		$page_search_count = $fx_page->getPageCountBySearch($search_manager);

		$records = 5;
		$page_search_count = $page_search_count['count'];
		$__response = array();
		$pagination = FX_System::getPageNumbering($page_search_count, $num_page, $data, $records); 
		$limit = $pagination['limit'];
		$__response = $fx_page->getPageByKeyword($search_manager, $limit);
		if($__response)
		{
	?>
	<div class="col-sm-12">
			<div class="panel panel-primary" id='exist_content'>
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class=" glyphicon glyphicon-book"></i>
						<?=$_LANG[LANG_SYS]['cnt_mng_tbl_key_lbl_title']?>
					</h3>
				</div>
				<div class="panel-body">					
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col1']?></th>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col2']?></th>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col3']?></th>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col4']?></th>
								</tr>
							</thead>
							<tbody class="tBody">
								<?php
								foreach($__response as $key_content => $value_content)
								{
								?>
									<?php $delete_page_id = 'fxdeletepage_'.$value_content['fx_page_id']; ?>
									<?php $copy_page_id = 'fxcopypage_'.$value_content['fx_page_id']; ?>
									<tr id="<?=$delete_page_id?>" class="view_record">
										<?php $private = $value_content['private'] == 1 ? '<i title="page private" class="glyphicon glyphicon-lock"></i>' : ''?>
										<td class="col-xs-2"><?=$private." ".$value_content['title']?></td>
										<td class="col-xs-4"><?=$value_content['content']?></td>
										<td class="col-xs-3"><?=$fx_date->convertToLocal($value_content['start_dt'], false)?> | <?=$fx_date->convertToLocal($value_content['end_dt'], false)?></td>
										<td class="col-xs-3" align="center">
											<button type="submit" onclick="makeCopy('<?php echo($copy_page_id) ?>', '<?=$_LANG[LANG_SYS]['cnt_mng_msg_adv_make_copy']?>');" class="btn btn-primary"><?=$_LANG[LANG_SYS]['cnt_mng_tbl_btn_copy']?></button>
								        	<a href="<?=FX_System::url("admin/page/edit/".$value_content['fx_page_id'])?>" class="btn btn-default"><?=$_LANG[LANG_SYS]['cnt_mng_tbl_btn_edit']?></a>
											<a href="javascript:void(0)" onclick="deleteRecord('<?php echo($delete_page_id)?>', 'deleted', 'delete_page', '<?=$_LANG[LANG_SYS]['cnt_mng_msg_adv_delete']?>', '', 'content_manager_keyword', '#contentDiv', '')" class="btn btn-danger"><?=$_LANG[LANG_SYS]['cnt_mng_tbl_btn_delete']?></a>
										</td>
									</tr>
								<?php
								}
								?>
								<?
								if(isset($pagination['numbering']) and $pagination['numbering'])
								{
								?>
								<tr align="center"> <td colspan='6'> <?=$pagination['numbering']?></td> </tr>
								<?
								}
								?>
							</tbody>
						</table>
					</div>				
				</div>
			</div>
		</div>
	<?			
		}
		else
		{
	?>		
		<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<?=$_LANG[LANG_SYS]['cnt_mng_msg_error']?>
			</div>
		</div>
	<?php
		}  
		exit();  
	}
	//end ajax search
	//start ajax section
	if($_POST['action'] == 'content_manager_section')
	{
		$num_page = '';
		if(isset($_POST['num_pag']) and $_POST['num_pag'] != '')
		{
			$num_page = $_POST['num_pag'];
		}
		$data = '';
		if(isset($_POST['data']) and is_numeric($_POST['data']))
		{
			$data = $_POST['data'];
		}
		$search_manager = $_POST['search'];

		$page_search_count = $fx_page->getPageCountBySection($search_manager);
		$records = 5;
		$page_search_count = $page_search_count['count'];
		$__response = array();
		$pagination = FX_System::getPageNumbering($page_search_count, $num_page, $data, $records); 
		$limit = $pagination['limit'];
		$__response = $fx_page->getPageBySection($search_manager, $limit);	
		if($__response)
		{
	?>
		<div class="col-sm-12">
			<div class="panel panel-primary" id='exist_content'>
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="glyphicon glyphicon-book"></i>
						<?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_sect_title']?>
					</h3>
				</div>
				<div class="panel-body">					
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col1']?></th>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col2']?></th>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col3']?></th>
									<th><?=$_LANG[LANG_SYS]['cnt_mng_tbl_lbl_col4']?></th>
								</tr>
							</thead>
							<tbody class="tBody">
								<?php
								foreach($__response as $key_content => $value_content)
								{
								?>
									<?php $delete_page_id = 'fxdeletepage_'.$value_content['fx_page_id']; ?>
									<?php $copy_page_id = 'fxcopypage_'.$value_content['fx_page_id']; ?>
									<tr id="<?=$delete_page_id?>" class="view_record">
										<td class="col-xs-2"><?=$value_content['title']?></td>
										<td class="col-xs-4"><?=$value_content['content']?></td>
										<td class="col-xs-3"><?=$fx_date->convertToLocal($value_content['start_dt'], false)?> | <?=$fx_date->convertToLocal($value_content['end_dt'], false)?></td>
										<td class="col-xs-3" align="center">
											<button type="submit" onclick="makeCopy('<?php echo($copy_page_id) ?>', '<?=$_LANG[LANG_SYS]['cnt_mng_msg_adv_make_copy']?>');" class="btn btn-primary"><?=$_LANG[LANG_SYS]['cnt_mng_tbl_btn_copy']?></button>
								        	<a href="<?=FX_System::url("admin/page/edit/".$value_content['fx_page_id'])?>" class="btn btn-default"><?=$_LANG[LANG_SYS]['cnt_mng_tbl_btn_edit']?></a>
											<a href="javascript:void(0)" onclick="deleteRecord('<?php echo($delete_page_id)?>', 'deleted', 'delete_page', '<?=$_LANG[LANG_SYS]['cnt_mng_msg_adv_delete']?>', '', 'content_manager_keyword', '#contentDiv', '')" class="btn btn-danger"><?=$_LANG[LANG_SYS]['cnt_mng_tbl_btn_delete']?></a>
										</td>
									</tr>
								<?php
								}
								if(isset($pagination['numbering']) and $pagination['numbering'])
								{
								?>
								<tr align="center"> <td colspan='6'> <?=$pagination['numbering']?></td> </tr>
								<?
								}
								?>
							</tbody>
						</table>
					</div>				
				</div>
			</div>
		</div>
	<?			
		}
		else
		{
	?>		<div class="col-sm-12">
				<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<?=$_LANG[LANG_SYS]['cnt_mng_msg_error']?>
				</div>
			</div>
	<?php
		}
		exit();    
	}
	//end ajax section

	if($_POST['action'] == "delete_page")
	{
		if(is_numeric($_POST['id']) && strlen($_POST['field']))
		{		
			$data = array($_POST['field']=>'1');
			$fx_page->update($data, $_POST['id']);
			echo $_LANG[LANG_SYS]['cnt_mng_msg_delete_success'];	
		}
		exit();
	}

	if($_POST['action'] == "makeCopy")
	{
		if(is_numeric($_POST['pageId']))
		{	
			$data_page = $fx_page->getById($_POST['pageId']);
			$thumbnail_name = '';
			if(strlen($data_page['thumbnail']) and file_exists("file/img/page/thumbnail/".$data_page['thumbnail']))
			{
				$thumbnail = substr($data_page['thumbnail'], 0, -10).substr($data_page['thumbnail'], -4);
				$thumbnail_name =  CC_FileHandler::generateFilenameRandom($thumbnail, 5, false);
				CC_FileHandler::uploadFile($thumbnail_name, "file/img/page/thumbnail/".$data_page['thumbnail'] , "file/img/page/thumbnail/", "");
			}
			$image_name = '';	
			if($data_page['image'] and file_exists("file/img/page/image/".$data_page['image']))
			{
				$image = substr($data_page['image'], 0, -10).substr($data_page['image'], -4);
				$image_name =  CC_FileHandler::generateFilenameRandom($image, 5, false);
				CC_FileHandler::uploadFile($image_name, "file/img/page/image/".$data_page['image'] , "file/img/page/image/", "");
				
			}
			$data = array('fx_section_id' => $data_page['fx_section_id'],
						  'creation_dt' => date("Y-m-d H:i:s"),
						  'start_dt' => $data_page['start_dt'],
						  'end_dt' => $data_page['end_dt'],
						  'title' => $data_page['title']." (copy)",
						  'content' => $data_page['content'],
						  'thumbnail' => $thumbnail_name,
						  'image' => $image_name,
						  'meta_title' => $data_page['meta_title'],
						  'meta_keywords' => $data_page['meta_keywords'],
						  'meta_description' => $data_page['meta_description'],
						  'private' => $data_page['private']
					     ); 
			$id_inserted = $fx_page->insert($data);
		}  
		$fx_page_lang = new FX_PageLang();
		$filter = array('fx_page_id' => $_POST['pageId']);
		$lang_sec = $fx_page_lang->getByFilter($filter, $order = "", false);

		foreach ($lang_sec as $key => $language)
		{
			$data = array('fx_page_id' => $id_inserted,
						  'lang' => $language['lang'],
						  'title' => $language['title']." (copy)",
						  'content' => $language['content'],
						  'meta_title' => $language['meta_title'],
						  'meta_keywords' => $language['meta_keywords'],
						  'meta_description' => $language['meta_description']
						  
						 );
			$fx_page_lang->insert($data);
		}
		echo $_LANG[LANG_SYS]['cnt_mng_msg_make_copy_success'];
		exit();
	}
}
else
{
	FX_System::redirect(FX_System::url("admin/login"), true); 
}
?>
