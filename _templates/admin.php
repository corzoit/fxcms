<?php 
$fx_date = 	new FX_Date();
if(isset($_SESSION['expire_session'])  and date('Y-m-d H:i:s') >= $_SESSION['expire_session'])
{
	session_destroy();
	FX_System::redirect(FX_System::url("admin/login"), true); 
}

?><!DOCTYPE html>
<!--[if IE 6]>
<html class="no-js" id="ie6" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html class="no-js" id="ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="no-js" id="ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->

<!--
xmlns:og="http://ogp.me/ns#"
xmlns:fb="http://www.facebook.com/2008/fbml"
-->

<html class="no-js" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		
		<title><?=FX_System::getPageTitle()?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="image_src" href="<?=FX_System::url('themes/default/common/logo-flexit.png')?>" />

		<meta name="description" content="<?=htmlentities('Proaserta', ENT_QUOTES, 'UTF-8')?>">
		<meta name="keywords" content="<?=htmlentities('Proaserta', ENT_QUOTES, 'UTF-8')?>">
		<meta name="author" content="Proaserta">
    	
    	<meta property="og:title" content="Proaserta" />
    	<meta property="og:description" content="<?=htmlentities('Proaserta', ENT_QUOTES, 'UTF-8')?>" />
    	<meta property="og:image" content="<?=FX_System::url('themes/images/logo.png')?>" />		

		<!-- Use for the "quote" -->
		<link href='http://fonts.googleapis.com/css?family=Vollkorn:400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,700' rel='stylesheet' type='text/css'>

		<link rel="shortcut icon" href="<?=FX_System::url("themes/images/favicon-v2.png")?>"/>

		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>	
		
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery-1.11.0.min.js")?>"></script>		
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/plugins/dreamerslab-jquery.preload/jquery.preload.min.js")?>"></script>
		<script type='text/javascript' src="<?=FX_System::url("js/libs/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/trunk/trunk8.js")?>"></script>
		<!--Placeholder IE8 and IE 9-->

		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery.nestable.js")?>"></script>
		
		<!-- Modernizr -->
  		<script src="<?=FX_System::url("js/libs/modernizr-latest.js")?>"></script>

		<link rel="stylesheet" type="text/css" href="<?=FX_System::url("themes/common/default/style.css")?>?<?=date('Ymd')?>" />			    	
		
		<!--FancyBox-->    	
    	<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/fancyapps-fancyBox-18d1712/source/jquery.fancybox.pack.js?v=2.1.5")?>"></script>
    	
    	<link rel="stylesheet" type="text/css" href="<?=FX_System::url("js/libs/jquery/fancyapps-fancyBox-18d1712/source/jquery.fancybox.css?v=2.1.5")?>" media="screen" />

    	<!--Autocomplete-->
    	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    	<!-- Boostrap -->
            <script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/bootstrap.min.js")?>"></script>
            <link rel="stylesheet" type="text/css" href="<?=FX_System::url("js/libs/bootstrap/css/bootstrap.min.css")?>">
		    <!-- Custom CSS -->
		    <link href="<?=FX_System::url("js/libs/bootstrap/css/sb-admin.css")?>" rel="stylesheet">

		    <!-- Morris Charts CSS -->
		    <link href="<?=FX_System::url("js/libs/bootstrap/css/plugins/morris.css")?>" rel="stylesheet">

		    <!-- Custom Fonts -->
		    <link href="<?=FX_System::url("js/libs/bootstrap/font-awesome-4.1.0/css/font-awesome.min.css")?>" rel="stylesheet" type="text/css">
    	<!-- end Boostrap -->

    	<!-- Bootstrap Select -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap-select/js/bootstrap-select.min.js")?>"></script>
    		<!-- Custom CSS -->
    		<link href="<?=FX_System::url("js/libs/bootstrap-select/css/bootstrap-select.min.css")?>" rel="stylesheet">
    	<!-- end Boostrap -->

    	<!-- Bootstrap filestyle -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap-filestyle/bootstrap-filestyle.min.js")?>"></script>
    	<!-- end Boostrap -->

    	<!-- Bootstrap bootbox -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootbox/bootbox.min.js")?>"></script>
    	<!-- end bootbox -->

    	<!-- DATETIMPICKER -->
    	
    	<!-- Bootstrap moment -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/moment-develop/moment.js")?>"></script>
    	<!-- end moment -->
    	
    	<!-- Bootstrap collapse -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/collapse.js")?>"></script>
    	<!-- end collapse -->
    	
    	<!-- Bootstrap transition -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/transition.js")?>"></script>
    	<!-- end transition -->
    	
    	<!-- Bootstrap bootstrpap-datetimepicker -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/bootstrap-datetimepicker.js")?>"></script>
    	<!-- end datetimepicker -->
    	
    	<!-- Bootstrap bootstrpap-datetimepicker CSS -->
			<link href="<?=FX_System::url("js/libs/bootstrap/css/bootstrap-datetimepicker.css")?>" rel="stylesheet">
    	<!-- end datetimepicker -->
		
		<!-- END DATETIMPICKER -->
		<!-- CHECKBOX-->
			<link href="<?=FX_System::url("js/libs/bootstrap/css/checkbox-x.min.css")?>" rel="stylesheet">
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/checkbox-x.min.js")?>"></script>
		<!-- END CHECKBOX-->
		<!-- TOUCHSPIN-->
			<link href="<?=FX_System::url("js/libs/bootstrap/css/jquery.bootstrap-touchspin.css")?>" rel="stylesheet">
			<script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/jquery.bootstrap-touchspin.js")?>"></script>
		<!-- END TOUCHSPIN-->

		<!-- jquery numeric -->
			<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery.numeric.js")?>"></script>
    	<!-- end jquery numeric -->

    	<!--jquery.form-->
    	<script src="http://malsup.github.com/jquery.form.js"></script> 

    	<!-- TINYMCE -->
    	<script src="<?=FX_System::url("js/libs/tinymce/tinymce.min.js")?>"></script>
    	<script src="<?=FX_System::url("js/libs/tinymce/tiny_mce_popup.js")?>"></script>

		<script type="text/javascript">
			window.FX_BASE_DOMAIN = "<?=FX_System::url()?>";
		</script>	
		<script type="text/javascript" src="<?=FX_System::url("js/pages/default.js")?>"></script>

		<!--flexslider-->
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery.flexslider.js")?>"></script>
		<!---->
		<!-- Upload FIle Jquery -->
		<link rel="stylesheet" href="<?=FX_System::url("js/libs/jQuery-File-Upload/css/style.css")?>">
		<link rel="stylesheet" href="<?=FX_System::url("js/libs/jQuery-File-Upload/css/jquery.fileupload.css")?>">
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/vendor/jquery.ui.widget.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/jquery.iframe-transport.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-File-Upload/js/jquery.fileupload.js")?>"></script>
		<!--- -->
		




		<script type="text/javascript" src="<?=FX_System::url("js/pages/admin/contact/contact.js")?>"></script>		
		<script type="text/javascript" src="<?=FX_System::url("js/pages/admin/post.js")?>"></script>	
		<script type="text/javascript" src="<?=FX_System::url("js/pages/admin/contact_message.js")?>"></script>		
		<?php
			
			$js_file = strpos(VIEW_FILE, ".") !== FALSE ?
			substr(VIEW_FILE, 0, strrpos(VIEW_FILE, ".")).".js":FALSE;		
			/*echo '$js_file'.$js_file;
			exit();*/	
			if(strlen(trim($__LANG)))
			{
				$nav_items = FX_System::getNavItems();	

				foreach($nav_items as $ni_key => $ni_data)
				{
					$item_data = $ni_data['default'];

					if(array_key_exists($__LANG,$ni_data))
					{
						$item_data = $ni_data[$__LANG];
					}

					if($item_data['page'] == "/".$__FILE)
					{
						$js_file = substr($ni_data['default']['page'],1).".js";
						break;
					}
				}
			}
			if($js_file !== FALSE && file_exists('js/pages/'.$js_file))
			{
				echo('<script type="text/javascript" src="'.FX_System::url("js/pages/".$js_file).'"></script>');
			}
		?>
	</head>
	<?
		$replace = array('developers/','.php');
		$class_background = str_replace($replace,'',VIEW_FILE);
		$class_background1 = explode("/",VIEW_FILE);
		if($class_background1[0] == 'developers')
		{
			$class_background = $class_background1[0]; 
		}
	?>	
	<body>
		<?php if($_SESSION['sysuser_id']): ?>		
		<div id="wrapper">
	        <?php include("_blocks/admin/nav.php");?>
	        <div id="page-wrapper">
	            <div class="container-fluid">
	                <!-- Page Heading -->
	              	<?php 
	              	$user_agent = FX_System::getBrowser();
					include("_views/".VIEW_FILE);			
					?>
	            </div>
	            <!-- /.container-fluid -->
	        </div>
	        <!-- /#page-wrapper -->
	    </div>
	    <!-- /#wrapper -->
		<?php else: ?>
			<div class="fi-container">
			<?php include("_views/".VIEW_FILE) ;?>
			</div>
		<?php endif ?>			
	</body>
</html>

