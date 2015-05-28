<link rel="stylesheet" href="<?=FX_System::url("js/libs/jQuery-File-Upload/css/style.css")?>">
<link rel="stylesheet" href="<?=FX_System::url("js/libs/jQuery-File-Upload/css/jquery.fileupload.css")?>">
<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/vendor/jquery.ui.widget.js")?>"></script>
<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/jquery.iframe-transport.js")?>"></script>
<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/jquery.fileupload.js")?>"></script>
<div class="row">
	<div class="col-sm-8">
		<h3>Galeria de Imagenes</h3>
		<div class="alert alert-danger" style="display:none" id="files">
		</div>				
		<span>
			<b>Cargar Imagen</b>
		</span>
	    <span class="btn btn-success fileinput-button">
	        <i class="glyphicon glyphicon-plus"></i>
	        <span>Select files...</span>
	        <input id="fileupload" type="file" name="files[]" multiple>
	    </span>
	    <br>
	    <br>
	    <div style="display:none" id="progress" class="progress">
	        <div id="div_progress" class="progress-bar progress-bar-success"></div>
	 	</div>					
	</div>
</div>


<script type="text/javascript">

$('#fileupload').fileupload({        
        dataType: 'json',
        formData: [
        	{ name: 'ruta', value: 'file/img/media/PAGE_ID_15/' },
        	{ name: 'entities', value: 'FX_Page' }
        ],// route

        done: function (e, data) { 
        	console.log(e,data);

        }

 });
</script>