<?php
$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";
$languages = array("es", "en");
$fx_section = new FX_Section();


/*$fx_sys = new FX_Sys();
$data_fx_sys = $fx_sys->getSysAllByStatus();
var_dump($FX_ROUTES);
if(count($data_fx_sys) == 1)
{
	echo("un Idioma");
}else
{
	echo("Multi Idioma");
}*/

$data_section = $fx_section->getSectionByKeyMenu("top");	

if(in_array($language, $languages))
{
	if($language == "en")
	{		
		$obj_section_lang = new FX_SectionLang();
		$data_section_ = $fx_section->getSectionByKeyMenu("top");		
		$data_section = array();
		
		foreach ($data_section_ as $key_section => $value_section) {			
			$response = $obj_section_lang->getAllSectionLangBySectionId($value_section["fx_section_id"],$language);
			if($response)
			{
				array_push($data_section, $response);
			}
			else
			{
				FX_System::redirect(FX_System::url("es/"), true);
			}			
		}				
	}	

	foreach ($data_section as $key_section => $value_section) 
	{			
		$data = FX_System::verificaSec($language,$value_section['fx_section_id'], true);

		if(isset($data['html']) && $data['page'] == false)
		{		
			$html.= "<li class='dropdown'><a target='_self' href='".FX_System::url($language."/section/".$value_section['fx_section_id'])."'> ".$value_section['title']."</a>";
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
<div class="header">
	<div class="content">
		<div class="languages">
			<ul>					
				<li><a href="<?=FX_System::url('es/')?>"><img src="<?=FX_System::url('themes/common/images/es.png')?>" border="0" /></a></li>
				<li><a href="<?=FX_System::url('en/')?>"><img src="<?=FX_System::url('themes/common/images/en.png')?>" border="0" /></a></li>
			</ul>
		</div>
		<div class="navigation">
			<nav class="navbar navbar-default" style="width:64.5%;margin:auto;" role="navigation">
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
	</div>		
</div>
<div id="banner" style = "clear:both;overflow: hidden" >	
	<div class="row row-content-carousel">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<?php
			    $fx_slideShowImage = new FX_SlideShowImage();							
				$fx_slide_show = new FX_SlideShow();
				// Default SlideShow
				//$data_slide = $fx_slide_show->getSlideShowBySectionId($__FX_PARAMS['id']);
				$data_slide = $fx_slide_show->getSlideShowDefault();				
				if($data_slide)
				{					
					$sli_by_slId = $fx_slideShowImage->getSlideShowImageBySlideShowId($data_slide['fx_slideshow_id']);					
					if(count($sli_by_slId)==0)
					{
						$sli_by_slId = $fx_slideShowImage->getByCode("DEFAULT");
					}						
				}		    
				else{
					$sli_by_slId = $fx_slideShowImage->getByCode("DEFAULT");
				}
		
		    ?>
			<ol class="carousel-indicators">
			<?php foreach ($sli_by_slId as $key => $value) 
			{	
			?>
				<li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" class="<?=($key == 0)? "active" : ""?>"></li>
			<?php 
			}?>
			</ol> 
			<div class="carousel-inner">
			    <?php
			    foreach ($sli_by_slId as $key_image => $value_sli) 
			    {	
			    ?>
			    <div style = "max-height : <?=$value_sli['height']?>px"  <?= ($key_image == 0) ? "class='item active'" : "class='item'" ?>>
			      	<img width = "100%" src="<?=FX_System::url("file/img/slideshow/").$value_sli['image']?>">
			      	<div class="carousel-caption">
			          	<h3><?= $value_sli['caption']?></h3>
			      	</div>
			    </div>
			    <?
			    }
			    ?>
			</div>
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">&lsaquo;</a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">&rsaquo;</a>
		</div>
	</div>
</div>	
<?php	
}
else
{		
	FX_System::redirect(FX_System::url("es/"), true); 	
}

?>