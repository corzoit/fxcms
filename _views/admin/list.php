
<div class="container">
    <div class="alert alert-danger" style="display:none" id="files"></div>
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <input id="fileupload" type="file" name="files[]" multiple onclick="saveImageGalery();">
    </span>
    <br>
    <br>
    <div style="display:none" id="progress" class="progress">
        <div id="div_progress" class="progress-bar progress-bar-success"></div>
    </div>
</div>

<?php 
$obj_folder = new FX_Folder();
$obj_media = new FX_Media();

$filter = array('name' => 'media', 'deleted' => 0);
$media = $obj_folder->getByFilter($filter, '', 1);

$filter = array('fx_folder_id' => $media['fx_folder_id']);
$images = $obj_media->getByFilter($filter, 'fx_media_id', false);
if(file_exists("file/img/media/"))
{
?>
<div id="list_images" style="background-color:#8FB2B2; text-align:center; padding: 10px;">
    <?  if($images)
        {
            foreach ($images as $key => $value)
            {  
            ?>
                <img style="padding:10px" class="img" width="185px" height="180px" class="img-responsive" src="<?=FX_System::url('file/img/media/'.$value['file'])?>">
            <?
            }
        }
    ?>
</div>
<?
}
?>
<script type="text/javascript">    
    $('.img').click(function(event){

        var selectedImage   = $(this).attr('src');
        var win                 = tinyMCEPopup.getWindowArg("window");
        var dialogueBoxObject   = win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = selectedImage;
        tinyMCE.activeEditor.windowManager.close();
    });
   
</script>