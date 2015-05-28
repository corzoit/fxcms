<?php 
define ("FX_TEMPLATE","theme.php");
$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";

$obj_page = new FX_Page();
$obj_pagelang = new FX_PageLang();

$filter = array('page_default' => 1);
$default_page = $obj_page->getByFilter($filter, '', 1);
if($default_page)
{	
	$result_page = $obj_page->getPageByIdF($default_page['fx_page_id'], date("Y-m-d H:i:s"));
	if($language == "en")
	{

		$result_page = $obj_pagelang->getPageLangByPageId($default_page['fx_page_id']);
	}	

	if(!$result_page)
	{
		$not_found_page = true;
	}
}

