<?php 
define ("FX_TEMPLATE","theme.php");

//$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";

if(isset($__FX_PARAMS['sec_id']) && is_numeric($__FX_PARAMS['sec_id']))
{
	$obj_section = new FX_Section();
	$obj_page = new FX_Page();
	$obj_sectionlang = new FX_SectionLang();
	$obj_pageLang = new FX_PageLang();

	if($multi_language)
	{	

		$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";
		$languages = array("es","en");
		$url_lang = $language."/";
		in_array($language, $languages) ? true:FX_System::redirect(FX_System::url("es/"), true);		
	}

	$section = $obj_section->getById($__FX_PARAMS['sec_id']);	
		
	$child_sections = $obj_section->getSectionByOwnerld($__FX_PARAMS['sec_id']);


	if($language ==  "en")
	{
		$temp_array = array();
		$i =0;
		foreach ($child_sections as $key_temp => $value_temp) 
		{			
			$fx_section_id = $value_temp['fx_section_id'];
			$response_sec_lang = $obj_sectionlang->getAllSectionLangBySectionId($fx_section_id, $language);	
			array_push($temp_array, $response_sec_lang);		
			$temp_array[$i]['fx_sub_section']	= $value_temp['fx_sub_section'];			
			$i++;
		}		
	}
	
	$sub_id = $__FX_PARAMS['sub_id'];
	
	foreach ($child_sections as $key => $child)
    {
        if(!$sub_id)
        {
            $sub_id = $child['fx_section_id'];
            break;
        }
    }    

    $rpanel_children = $obj_section->getSectionByOwnerld($sub_id);    
	    
    $result_page = $obj_page->getPageBySectionF($sub_id, false, date("Y-m-d H:i:s"));  

    /*if(count($result_page) == 1)
    {
        $value_result_page = $result_page[0];
        header("location: ".FX_System::url($language."/page/".$value_result_page['fx_page_id']));
        exit();
    }*/
}
