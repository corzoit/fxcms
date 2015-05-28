<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery-1.11.0.min.js")?>"></script>		
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/plugins/dreamerslab-jquery.preload/jquery.preload.min.js")?>"></script>
		<script type='text/javascript' src="<?=FX_System::url("js/libs/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/trunk/trunk8.js")?>"></script>
		<!--Placeholder IE8 and IE 9-->

<?php
	//define ("FX_TEMPLATE","admin.php"); 
	FX_System::validateAdminLogin();
	
	$options = null;
	
	if($_REQUEST && $_REQUEST['ruta'])
	{						
		$ruta = $_REQUEST['ruta'];
		if(!file_exists($ruta))
		{			
			mkdir($ruta, 0777, true);
			
		}
		$options = array("upload_dir" => $ruta, "upload_url" => $ruta, 'entities' => 'FX_Page');
	}	

	$upload_handler = new FX_UploadHandler($options);

	
	

	




