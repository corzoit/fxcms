<!DOCTYPE html>
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

<html class="no-js" lang="en-US" xmlns="http://www.w3.org/1999/xhtml"
xmlns:og="http://ogp.me/ns#"
xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<meta name="viewport" content="width=device-width" />
		
		<title><?=FX_System::getPageTitle()?></title>
		<meta http-equiv="content-type" content="text/html;" charset="iso-8859-1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="image_src" href="<?=FX_System::url('/themes/default/common/logo-flexit.png')?>" />

		<meta name="description" content="<?=htmlentities('Proaserta', ENT_QUOTES, 'UTF-8')?>">
		<meta name="keywords" content="<?=htmlentities('Proaserta', ENT_QUOTES, 'UTF-8')?>">
		<meta name="author" content="Proaserta">
    	
    	<meta property="og:title" content="Proaserta" />
    	<meta property="og:description" content="<?=htmlentities('Proaserta', ENT_QUOTES, 'UTF-8')?>" />
    	<meta property="og:image" content="<?=FX_System::url('/themes/images/logo.png')?>" />

		<link href='<?=FX_System::url('/themes/Letter Gothic Std.ttf')?>' rel='stylesheet' type='text/css'>

		<!-- Use for the "quote" -->
		<link href='http://fonts.googleapis.com/css?family=Vollkorn:400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,700' rel='stylesheet' type='text/css'>

		<link rel="shortcut icon" href="<?=FX_System::url("/themes/images/favicon-v2.png")?>"/>

		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>	
		
		<script type="text/javascript" src="<?=FX_System::url("/js/jquery/jquery-1.11.0.min.js")?>"></script>		
		<script type="text/javascript" src="<?=FX_System::url("/js/jquery/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("/js/jquery/plugins/dreamerslab-jquery.preload/jquery.preload.min.js")?>"></script>
		<script type='text/javascript' src="<?=FX_System::url("/js/jquery.easing.1.3.js")?>"></script>
		<script type="text/javascript" src="<?=FX_System::url("/js/libs/trunk/trunk8.js")?>"></script>
		<!--Placeholder IE8 and IE 9-->

		<script type="text/javascript" src="<?=FX_System::url("/js/libs/jquery.flexslider.js")?>"></script>
		
		<!--Slider image-->
		
		<!--Slider video-->
		<!--script defer src="../jquery.flexslider.js"></script-->
		
		<!-- Modernizr -->
  		<script src="<?=FX_System::url("/js/libs/modernizr-latest.js")?>"></script>

		<link rel="stylesheet" type="text/css" href="<?=FX_System::url("/themes/default/style.css")?>?<?=date('Ymd')?>" />	
		<!--sliderVideo-->
		<link rel="stylesheet" type="text/css" href="<?=FX_System::url("/themes/default/sliderVideo.css")?>?<?=date('Ymd')?>" />		    	
		
		<!--FancyBox-->    	
    	<script type="text/javascript" src="<?=FX_System::url("/js/jquery/fancyapps-fancyBox-18d1712/source/jquery.fancybox.pack.js?v=2.1.5")?>"></script>
    	
    	<link rel="stylesheet" type="text/css" href="<?=FX_System::url("/js/jquery/fancyapps-fancyBox-18d1712/source/jquery.fancybox.css?v=2.1.5")?>" media="screen" />

		<script type="text/javascript">
			window.FX_BASE_DOMAIN = "<?=FX_System::url()?>";
		</script>	
		<script type="text/javascript" src="<?=FX_System::url("js/default.js")?>"></script>		
		<?php
			$js_file = strpos(VIEW_FILE, ".") !== FALSE ?
			substr(VIEW_FILE, 0, strrpos(VIEW_FILE, ".")).".js":FALSE;
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
	<!--<body class = '<?=$class_background?>'>-->
	<body>	
		<div class="fi-container">
			<?php
				//include("_blocks/top.php");		
				//include("_blocks/nav.php");
				//include("_blocks/banners.php");
				echo('<div id="bodyContainer">');
					$user_agent = FX_System::getBrowser();
					include("_views/".VIEW_FILE);
				echo('</div>');
				//include("_blocks/bottom.php");
				//include("_blocks/navigator.php");
			?>
		</div>
	</body>
</html>