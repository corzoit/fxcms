<?php 
/*$fx_date = 	new FX_Date();
if(isset($_SESSION['expire_session'])  and $fx_date->convertToLocal(date('Y-m-d H:i:s'), false) >= $fx_date->convertToLocal($_SESSION['expire_session'], false))
{
	session_destroy();
	FX_System::redirect(FX_System::url("admin/login"), true); 
}*/

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
    	<meta property="og:description" content="<?=htmlentities(FX_WEBSITENAME, ENT_QUOTES, 'UTF-8')?>" />
    	<meta property="og:image" content="<?=FX_System::url('themes/images/logo.png')?>" />		

        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

		<!-- Use for the "quote" -->
		<!--<link href='http://fonts.googleapis.com/css?family=Vollkorn:400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,700' rel='stylesheet' type='text/css'>

		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>	
		-->
		<link rel="shortcut icon" href="<?=FX_System::url("themes/images/favicon-v2.png")?>"/>		
		
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery-1.11.0.min.js")?>"></script>		
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/plugins/dreamerslab-jquery.preload/jquery.preload.min.js")?>"></script>
		<script type='text/javascript' src="<?=FX_System::url("js/libs/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/libs/trunk/trunk8.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("js/pages/client/default.js")?>"></script>
		<!--Placeholder IE8 and IE 9-->

		<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery.flexslider.js")?>"></script>
						
		<!--script defer src="../jquery.flexslider.js"></script-->
		
		<!-- Modernizr -->
  		<script src="<?=FX_System::url("js/libs/modernizr-latest.js")?>"></script>
		
		<!-- STYLE THEME -->
		<link rel="stylesheet" type="text/css" href="<?=FX_System::url("_templates/common/style.css")?>" />
		
		<!--FancyBox-->    	
    	<script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/fancyapps-fancyBox-18d1712/source/jquery.fancybox.pack.js?v=2.1.5")?>">
    	</script>
    	
    	<link rel="stylesheet" type="text/css" href="<?=FX_System::url("js/libs/jquery/fancyapps-fancyBox-18d1712/source/jquery.fancybox.css?v=2.1.5")?>" media="screen" />

    	<!-- Boostrap -->
            <script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/bootstrap.js")?>"></script>
            <link rel="stylesheet" type="text/css" href="<?=FX_System::url("js/libs/bootstrap/css/bootstrap.css")?>">
        <!-- End Boostrap -->

        <!-- blueimp gallery-->
			<link rel="stylesheet" href="<?=FX_System::url("js/libs/bootstrap/css/blueimp-gallery.css")?>">
			<link rel="stylesheet" href="<?=FX_System::url("js/libs/bootstrap/css/blueimp-gallery-indicator.css")?>">
			<link rel="stylesheet" href="<?=FX_System::url("js/libs/bootstrap/css/blueimp-gallery-video.css")?>">


		<script type="text/javascript">
			window.FX_BASE_DOMAIN = "<?=FX_System::url()?>";
		</script>
		<!--[if IE 8]>			
			<style type="text/css">
				.sidebar{
					clear: both;
				    float: left;
				    display: block;
				}
			</style>
		<![endif]-->					
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
	<body>			
		<div id="fx-container">
			<?php include("_blocks/client/header.php");?>
			<div class="container">			  		        
        		<div class="wrapper">
        			<?php include("_views/".VIEW_FILE);?>
        		</div>
        		<?php include("_blocks/client/footer.php");?>
			</div>			
	    </div>	    		
	</body>
</html>