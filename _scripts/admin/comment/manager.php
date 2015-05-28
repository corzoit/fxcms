<?php
define ("FX_TEMPLATE","admin.php"); 

$page = new FX_Page();
$filter = array('comments_type' => 'admin', 'deleted' => 0);
$page_comments = $page->getByFilter($filter, '', false);

//$page_comments = $page->getCountPostByPageId();

 
?>