<?
define ("FX_TEMPLATE","admin.php"); 
FX_System::validateAdminLogin();


$fx_form = new FX_Form();
$fx_form_page = new FX_FormPage();

if($_POST['action'] == 'search_title')
{
	$num_page = '';
	//var_dump($_POST);
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
	$page_search_count = $fx_form->getPageCountBySearch($search_manager);
	//var_dump($page_search_count);
	
	$records = 5;
	$page_search_count = $page_search_count['count'];
	$__response = array();
	$pagination = FX_System::getPageNumbering($page_search_count, $num_page, $data, $records); 
	$limit = $pagination['limit'];
	$__response = $fx_form->getPageByKeyword($search_manager, $limit);
	/*var_dump($__response);
	exit();*/

	if($__response)
	{
	?>
		<div class="panel panel-primary" id='exist_content'>
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-picture"></i>
					<?=$_LANG[LANG_SYS]['cnt_mng_tbl_key_lbl_title']?>
				</h3>
			</div>
			<div class="panel-body">					
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Pages using form</th>
								<th></th>
							</tr>
						</thead>
						<tbody class="tBody">
							<?php
							foreach($__response as $key_form => $value_form)
							{
							?>
								<tr id="<?=$delete_page_id?>" class="view_record">
									<td><?=$value_form['title']?></td>
									<td>
										<?
											$pages_by_form = $fx_form_page->getAllPageByFormId($value_form["fx_form_id"]);
											//var_dump($data);
											foreach ($pages_by_form as $key => $value) 
											{
												?>
													<p><?=$value['title']?></p>
												<?	
											}
										?>
									</td>
									<td align="center">
										<button type="submit" class="btn btn-primary" onclick="makeCopy('<?=$value_form["fx_form_id"]?>');">Make copy</button>
										<a href = "edit/<?=$value_form["fx_form_id"]?>"><button type="button"  class="btn btn-success">Edit</button></a>
										<button type="button" onclick="deletePage(<?=$value_form["fx_form_id"]?>)"  class="btn btn-danger">Delete</button>
									</td>
								</tr>

							<?php
							}
							?>
							<?
							if(isset($pagination['numbering']) and $pagination['numbering'])
							{
							?>
							<tr> <td colspan='6'> <?=$pagination['numbering']?></td> </tr>
							<?
							}
							?>
						</tbody>
					</table>
				</div>				
			</div>
		</div>
	<?
	}
	exit();
}

if($_POST['action'] == 'makeCopy')
{
	$fx_page_id = $_POST['fx_form_id'];

	$data_form = $fx_form->getById($fx_page_id);
	
	//Data clone form
	$data_form_clone = array(
		'creation_dt' => date("Y-m-d H:i:s"),
		'title' 	=> $data_form['title'],
		'intro' => $data_form['intro'],
		'target_email' => $data_form['target_email'],
		'deleted' => $data_form['deleted'],
	);
	$new_fx_form_id = $fx_form->insert($data_form_clone);
	

	//SEARCH PAGES BY FORM
	$data_page_by_form = $fx_form_page->getAllPageByFormId($fx_page_id);
	foreach ($data_page_by_form as $key_dpbf => $data_page_by_form_value) 
	{
		$data_page_by_form_clone = array(
			'fx_form_id' => $new_fx_form_id,
			'fx_page_id' => $data_page_by_form_value['form_page_id'],
			'title' => $data_page_by_form_value['form_title'],
			'intro' => $data_page_by_form_value['form_intro'],
			'target_email' => $data_page_by_form_value['form_target_email'],
		);	
		$fx_form_page->insert($data_page_by_form_clone);
	}
	
	exit();
}

if($_POST['action'] == 'deleteForm')
{
	//var_dump($_POST);
	$data = array(
		'deleted'=>'1'
	);
	$fx_form->update($data, $_POST['form_id']);
	
	exit();
}