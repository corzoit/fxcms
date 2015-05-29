<?php
define ("FX_TEMPLATE","theme.php");

$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";

$obj_section = new FX_Section();
$obj_page = new FX_Page();
$obj_pagelang = new FX_PageLang();
$not_found_page = false;
$show_menu = true;
if(isset($__FX_PARAMS['page_id']) && is_numeric($__FX_PARAMS['page_id']))
{		
	$result_page = $obj_page->getPageByIdF($__FX_PARAMS['page_id'], date("Y-m-d H:i:s"));	
	
	$show_menu = $result_page['page_default'] == 1 ? false:$show_menu;
	
	/**/
		$data_section_ = $obj_section->getSectionById($result_page['fx_section_id']);
	/*--*/
	$child_sections = $obj_section->getSectionByOwnerld($data_section_['owner_id']);	

	if($language == "en")
	{			
		$fx_section_id = $result_page['fx_section_id'];
		$result_page = $obj_pagelang->getPageLangByPageId($__FX_PARAMS['page_id']);
		$result_page['fx_section_id'] = $fx_section_id;
	}

	if(!$result_page)
	{
		$not_found_page = true;
	}
}
else
{
	//FX_System::redirect(FX_System::url($language."/"));
	$not_found_page = true;
}