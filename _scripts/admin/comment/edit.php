<?php
define ("FX_TEMPLATE","admin.php"); 

$page = new FX_Page();
$post = new FX_Post();


$content_page = $page->getById($__FX_PARAMS['id']);

$filter = array('fx_page_id' => $__FX_PARAMS['id'], 'deleted' => 0);
$comments = $post->getByFilter($filter, '', false); 


if(isset($_POST['action']) and $_POST['action'] == 'permission_comment')
{	
	$approve = 1;
	if($_POST['value'] == 'approve')
	{
		$approve = 0;
	}	
	$data = array('approve' => $approve);
	$post->update($data, $_POST['id']);
	print_r($data);
	exit();
}