<?php 
define ("FX_TEMPLATE","theme.php");

$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";

if(isset($__FX_PARAMS['sec_id']) && is_numeric($__FX_PARAMS['sec_id']))
{
	$obj_section = new FX_Section();
	$obj_page = new FX_Page();
	$obj_sectionlang = new FX_SectionLang();

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
		$child_sections = $temp_array;
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

	    if(count($result_page) == 1)
	    {
	        $value_result_page = $result_page[0];
	        header("location: ".FX_System::url("page/".$value_result_page['fx_page_id']));
	        exit();
	    }     

	}

	/*
	Logig ... 
	$data_sub_section = $obj_section->getSectionByOwnerld($section['fx_section_id'], true);	

	if($language ==  "en")
	{
		$temp_array = array();
		$i =0;
		foreach ($data_sub_section as $key_temp => $value_temp) 
		{			
			$fx_section_id = $value_temp['fx_section_id'];
			$response_sec_lang = $obj_sectionlang->getAllSectionLangBySectionId($fx_section_id, $language);	
			array_push($temp_array, $response_sec_lang);		
			$temp_array[$i]['fx_sub_section']	= $value_temp['fx_sub_section'];			
			$i++;
		}
		$data_sub_section = $temp_array;
	}*/
}


/*$child_sections = $obj_section->getSectionByOwnerld($__FX_PARAMS['sec_id']);
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

    if(count($result_page) == 1)
    {
        $value_result_page = $result_page[0];
        header("location: ".FX_System::url("page/".$value_result_page['fx_page_id']));
        exit();
    }     

*/

/*echo("<pre>child_sections");
print_r($child_sections);
echo("</pre>");


echo("<pre>sub_id");
print_r($sub_id);
echo("</pre>");


echo("<pre>rpanel_children");
print_r($rpanel_children);
echo("</pre>");*/