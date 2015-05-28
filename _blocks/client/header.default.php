<?php
$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";
$languages = array("es", "en");
$fx_section = new FX_Section();
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
			array_push($data_section, $response);
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
		<div class="logo">
			<a href="<?=FX_System::url($language)?>"><img src="<?=FX_System::url('themes/common/images/faku-trans-v2.jpg')?>" border="0" /></a>
		</div>	
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

<?php	
}
else
{
	FX_System::redirect(FX_System::url("es/"), true); 
}

?>