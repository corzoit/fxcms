<?php

$language = "";
$url_lang = "";
$style_navigation = "";

if($multi_language)
{	

	$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";
	$languages = array("es","en");
	$url_lang = $language."/";
	in_array($language, $languages) ? true:FX_System::redirect(FX_System::url("es/"), true);
	$style_navigation = "style='top: 50px;'";
	$style_header = "style='height: 120px;'";
}

$data_section_ = FX_System::getSectionByLang($multi_language, $language);

foreach ($data_section_ as $key_section => $value_section) 
{			
	$data = FX_System::verificaSec($language,$value_section['fx_section_id'], true, $url_lang);

	if(isset($data['html']) && $data['page'] == false)
	{		
		$html.= "<li class='dropdown'><a target='_self' href='".FX_System::url($url_lang."section/".$value_section['fx_section_id'])."'> ".$value_section['title']."</a>";
		$html .= "<ul class='dropdown-menu'>";
		$html .= $data['html'];
		$html .= "</ul>";
		$html.= "</li>";			
	}
	elseif(isset($data['html']) && $data['page'])
	{
		$html.=$data['html'];		
	}
}
?>

<div class="header" <?=$style_header?>>
	<!--<div class="logo">
		<a href="<?=FX_System::url($language)?>"><img src="<?=FX_System::url('themes/common/images/faku-trans-v2.jpg')?>" border="0" /></a>
	</div>-->
	<?php if($multi_language){ ?>
		<div class="languages">
			<ul>					
				<li><a href="<?=FX_System::url('es/')?>"><img src="<?=FX_System::url('themes/common/images/es.png')?>" border="0" /></a></li>
				<li><a href="<?=FX_System::url('en/')?>"><img src="<?=FX_System::url('themes/common/images/en.png')?>" border="0" /></a></li>
			</ul>
		</div>
	<?php } ?>

	<nav class="navbar navbar-default navbar-fixed-top navbar-absolute navigation" <?=$style_navigation?> role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
			        data-target=".navbar-ex1-collapse">
			  	<span class="sr-only">Desplegar navegación</span>
			  	<span class="icon-bar"></span>
			  	<span class="icon-bar"></span>
			  	<span class="icon-bar"></span>
			</button>		
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
				<?=$html?>						
			</ul>
		</div>
	</nav>	
</div>
<!-- BANNER -->
	<?php 
	$fx_slideShowImage = new FX_SlideShowImage();							
	$fx_slide_show = new FX_SlideShow();
	// Default SlideShow
	//$data_slide = $fx_slide_show->getSlideShowBySectionId($__FX_PARAMS['id']);
	$data_slide = $fx_slide_show->getSlideShowDefault();	
	if($data_slide)
	{
		include('banner.php');
	}	
	?>
<!-- END -->		

