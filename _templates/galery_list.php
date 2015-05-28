<!DOCTYPE html>
<html class="no-js" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<title><?=FX_System::getPageTitle()?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery-1.11.0.min.js")?>"></script>		
    	<script src="<?=FX_System::url("js/libs/tinymce/tiny_mce_popup.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/bootstrap.min.js")?>"></script>
        <link rel="stylesheet" type="text/css" href="<?=FX_System::url("js/libs/bootstrap/css/bootstrap.min.css")?>">
        <!-- Upload FIle Jquery -->
		<link rel="stylesheet" href="<?=FX_System::url("js/libs/jQuery-File-Upload/css/style.css")?>">
		<link rel="stylesheet" href="<?=FX_System::url("js/libs/jQuery-File-Upload/css/jquery.fileupload.css")?>">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/vendor/jquery.ui.widget.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/jquery.iframe-transport.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/jquery.fileupload.js")?>"></script>
		<!--- -->
        <!--<script type="text/javascript">
			window.FX_BASE_DOMAIN = "<?=FX_System::url()?>";
		</script>-->
		<script type="text/javascript" src="<?=FX_System::url("js/pages/default.js")?>"></script>
	</head>
	<body>
		<?php include("_views/".VIEW_FILE) ;?>
	</body>
</html>

