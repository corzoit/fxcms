<?php 
if($_GET['type'] == 'page' && count($all_language)>1)
{
?>
<a href="#selectFolder" id="btnSelectFolder" style="display:none;">Seleccione Folder</a>
    <div id="selectFolder" style="display:none;">
        <h2>Seleccione Folder</h2>
        <div class="imgLang">
            <img class="folderId" src="<?=FX_System::url('themes/common/images/folder-icon.png')?>" data-id="<?=$data_page['fx_page_id']?>_es" width="80px" heigth="80px">
            <p><?=$data_page['title']?></p>
        </div>
        <div class="imgLang">
            <img class="folderId" src="<?=FX_System::url('themes/common/images/folder-icon.png')?>" data-id="<?=$data_page['fx_page_id']?>_en" width="80px" heigth="80px">
            <p><?=$data_page_lang['title']?></p>
        </div>
        <p><button class="btn btn-danger btnCloseDefault" data-id="<?=$data_page['fx_page_id']?>_es">Cerrar</button></p>        
    </div>
<?php
}
?>

<div style="border:1px solid red;">
    <div class="col-sm-8">
        <h3>Galeria</h3>    
        <div class="alert alert-danger" style="display:none" class="files">
        </div>              
        <span>
            <b>Cargar</b>
        </span>
        <span class="btn btn-success fileinput-button">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Select files...</span>
            <input class="fileupload" type="file" name="files[]" multiple>
        </span>
        <br>
        <br>
        <div style="display:none" class="progress">
            <div id="div_progress" class="progress-bar progress-bar-success"></div>
        </div>
        <div class="list_images">
            <?php

            ?>
        </div>
        <div class="callType">
            <input id="idCallType" name="call_type" value="<?=$_GET['type']?>">
            <input id="language" name="language" value="<?=$_GET['type'] == 'page' ?$fx_page_id.'_'.LANG_SYS : ''?>">
        </div>
    </div>
</div>


















































<!--<div class="container">
    <div class="alert alert-danger" style="display:none" class="files"></div>
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <input class="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <div style="display:none" id="progress" class="progress">
        <div id="div_progress" class="progress-bar progress-bar-success"></div>
    </div>
</div>

<div class="list_images">
    <?php    
    foreach ($data_media as $key_dt_media => $value_dt_media) 
    {
        if(preg_match($exp_1 ,$value_dt_media['file']))
        {
            $fx_folder_id = $sub_folder[0]['fx_folder_id'];
            $folder = "file/repository/".$data_folder['name']."/".$sub_folder[0]['name']."/";           
            $file_img = true;
        }
        elseif(preg_match($exp_2 ,$value_dt_media['file']))
        {           
            $fx_folder_id = $sub_folder[1]['fx_folder_id'];
            $folder = "file/repository/".$data_folder['name']."/".$sub_folder[1]['name']."/";               
            $file_img = false;
        }
        
        if(file_exists($folder.$value_dt_media['file']))
        {           
            $path_file = FX_System::url($folder);
            if($file_img )
            {
                $html_img .= "<img style='padding:10px' class='img' width='185px' height='180px' class='img-responsive' src='".$path_file.$value_dt_media['file']."'/>";                 
            }                    
        }               
    }
    echo($html_img);

    ?>
</div>-->

<!--<a href="#selectFolder" id="btnSelectFolder" style="display:none;">Seleccione Folder</a>
    <div id="selectFolder" style="display:none;">
        <h2>Seleccione Folder</h2>
        <div class="imgLang">
            <img class="folderId" src="<?=FX_System::url('themes/common/images/folder-icon.png')?>" data-id="<?=$data_page['fx_page_id']?>_es" width="80px" heigth="80px">
            <p><?=$data_page['title']?></p>
        </div>
        <div class="imgLang">
            <img class="folderId" src="<?=FX_System::url('themes/common/images/folder-icon.png')?>" data-id="<?=$data_page['fx_page_id']?>_en" width="80px" heigth="80px">
            <p><?=$data_page_lang['title']?></p>
        </div>
        <p><button class="btn btn-danger btnCloseDefault" data-id="<?=$data_page['fx_page_id']?>_es">Cerrar</button></p>        
    </div>





-->




