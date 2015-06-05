<div class="content-wrapper">
    <?php    
    ?>
    <div class="menu-left">
        <ul>
        <?php  
        if($child_sections)       
        {
            foreach ($child_sections as $key => $child) 
            {            
                $data = FX_System::verificaSec($language,$child['fx_section_id'], true,$url_lang);                
                if(isset($data['html']) && $data['page'] == false)
                {       
                    $html_.= "<li class='dropdown'><a target='_self' href='".FX_System::url($url_lang."section/".$child['fx_section_id'])."'> ".$child['title']."</a>";
              
                    $html_.= "</li>";            
                }
                elseif(isset($data['html']) && $data['page'])
                {
                    $html_.= $data['html'];
                }
            }
        }        
        echo($html_);
        ?>
        </ul>
    </div>
    <div class="article">
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
                echo("<li><a href='".FX_System::url($url_lang."section/".$sub_id."/".$ch_section['fx_section_id'])."'>".$ch_section['title']."</a></li>") ;                
            }
            echo("</ul>");
        }
        else if(count($result_page)>1)
        {           
            echo("<ul>");
            foreach ($result_page as $key_result_page => $value_result_page)
            {
                if($language ==  "en" )
                {
                    $value_result_page =  $obj_pageLang->getPageLangByPageId($value_result_page['fx_page_id']);                               
                }
                echo("<li><a href='".FX_System::url($url_lang."page/".$value_result_page['fx_page_id'])."'>".$value_result_page['title']."</a></li>") ;
            }
            echo("</ul>");
        }
        else if (count($result_page)) 
        {                   
            if($language ==  "en" )
            {
                $value_result_page =  $obj_pageLang->getPageLangByPageId($result_page[0]['fx_page_id']); 
                $result_page[0]['title'] = $value_result_page['title']; 
                $result_page[0]['content'] = $value_result_page['content'];             
            }     
            ?>        
            <div>
            <h1><?=$result_page[0]['title']?> </h1>
            <div>
                <?=$result_page[0]['content']?>
            </div>
            <?php
        }  
        else
        {
        ?>
        <div class="row" style="width:100%; margin:0 auto;">
            <div class="col-xs-12">  
            <?php 
            $msg_not_content = $language == "en" ? 'No content for this section': 'No hay contenido para esta seccion';
            ?>
                <div class="alert alert-danger"><?=$msg_not_content?></div>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>   
</div>

