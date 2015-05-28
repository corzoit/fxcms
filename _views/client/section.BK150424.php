<div class="menu-left" style="border:1px solid orange;">
	<ul>
	<?php 		
	/*foreach ($child_sections as $key => $child)
    {
        $selected_css = (!$__FX_PARAMS['sub_id'] && $key == 0) 
                            || $__FX_PARAMS['sub_id'] == $child['fx_section_id'] ? ' class="menu-left-selected" ':'';
        $child['fx_section_id'];

        echo("<li".$selected_css."><a target='_self' href='".FX_System::url($language."/section/".$__FX_PARAMS['sec_id']."/".$child['fx_section_id'])."'> ".$child['title']."</a>");
    }*/
    foreach ($child_sections as $key => $child) 
    {
        $data = FX_System::verificaSec($language,$child['fx_section_id'], true);    
        //var_dump($data);
        if(isset($data['html']) && $data['page'] == false)
        {       
            $html_.= "<li class='dropdown'><a target='_self' href='".FX_System::url($language."/section/".$child['fx_section_id'])."'> ".$child['title']."</a>";
      
            $html_.= "</li>";            
        }
        elseif(isset($data['html']) && $data['page'])
        {
            $html_.= $data['html'];
        }
    }
    echo($html_);
    ?>
	</ul>
</div>
<div class="content" style="border:1px solid blue;">
	 <?php

    
	if(count($rpanel_children))
    {
        echo("<ul>");
        foreach ($rpanel_children as $key_ch_section => $ch_section)
        {
        	if($language == "en")
	        {
	        	$response_sec_lang = $obj_sectionlang->getAllSectionLangBySectionId($ch_section['fx_section_id'], $language);		        	
	        	$ch_section['fx_section_id'] = $response_sec_lang['fx_section_id'];
	        	$ch_section['title'] = $response_sec_lang['title'];

	        }
            echo("<li><a href='".FX_System::url($language."/section/".$sub_id."/".$ch_section['fx_section_id'])."'>".$ch_section['title']."</a></li>") ;                
        }
        echo("</ul>");
    }
    /*else if(count($result_page) == 1)
    {
        $value_result_page = $result_page[0];
        echo("<script>
            window.location.href = '".FX_System::url("page/".$value_result_page['fx_page_id'])."';
            </script>
        ");
    }*/ 
    else if(count($result_page))
    {
        echo("<ul>");
        foreach ($result_page as $key_result_page => $value_result_page)
        {
            echo("<li><a href='".FX_System::url("page/".$value_result_page['fx_page_id'])."'>".$value_result_page['title']."</a></li>") ;
        }
        echo("</ul>");
    }  
    else
    {
    ?>
    <div class="row" style="width:100%; margin:0 auto;">
        <div class="col-xs-12">                         
            <div class="alert alert-danger">No hay contenido para esta secci&oacute;n.</div>
        </div>
    </div>
    <?php
    }
	?>
</div>