<?php
if(count($all_language)>1)
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
<div class="row">
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
	    <input type="hidden" name="language" class="language" value="<?=LANG_SYS?>">
	    <br>
	    <br>
	    <div style="display:none" class="progress">
	        <div id="div_progress" class="progress-bar progress-bar-success"></div>
	 	</div>					
	 	<div class="list_images">
	 		<?php 	 		
	 		/**/
	 		?>
	 	</div>
	</div>
</div>