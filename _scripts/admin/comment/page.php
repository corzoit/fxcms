<?php
define ("FX_TEMPLATE","admin.php"); 
$page = new FX_Page();
$post = new FX_Post();


$content_page = $page->getById($__FX_PARAMS['id']);

$filter = array('fx_page_id' => $__FX_PARAMS['id'], 'approve' => 1, 'deleted' => 0);
$comments = $post->getByFilter($filter, '', false); 

if(isset($_POST['action']) and $_POST['action'] == 'delete_comment')
{	
	if(is_numeric($_POST['id']))
	{
		$data = array('deleted' => 1);
		$post->update($data, $_POST['id']);
	}
	echo 'El comentario ha sido eliminado correctamente.';
	exit();
}