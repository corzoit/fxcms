<div class="content-wrapper">
	<?php 
	if($show_menu)
	{
	?>
	<div class="menu-left" style="border:1px solid orange;">
		<ul>
		<?php 		
		if(is_array($child_sections))
		{
		    foreach ($child_sections as $key => $child) 
		    {
		        $data = FX_System::verificaSec($language,$child['fx_section_id'], true, $url_lang);    
		        
		        if(isset($data['html']) && $data['page'] == false)
		        {       
		            $html_.= "<li class='dropdown'><a target='_self' href='".FX_System::url($url_lang."section/".$child['fx_section_id'])."'> ".$child['title']."</a>";
		      
		            $html_.= "</li>";            
		        }
		        elseif(isset($data['html']) && $data['page'])
		        {
		            $html_.= $data['html'];
		        }
		    }
		    echo($html_); 
		}
		else
		{
			//		FX_System::redirect(FX_System::url($language."/");
			FX_System::redirect(FX_System::url($language."/"));
		}
	    ?>
		</ul>
	</div>

	<div class="article">
		<?php 
		if(!$not_found_page)
		{	
		?>
		<div>
			<h1><?=$result_page['title']?></h1>
			<div>

				<?=$result_page['content']?>
			</div>
		</div>
		<?php 
		}
		else
		{
		?>
		<div class="row" style="width:100%; margin:0 auto;">
			<div class="col-xs-12">							
				<?php 
					$msg_not_content = $language == "en" ? 'No content for this section': 'No hay contenido para esta seccion';
				?>
				<div class="alert alert-danger"><?=$msg_not_content?>.</div>
			</div>
		</div>
		<?php	
		}
		?>
	</div>
	<?php 
	}
	else
	{
	?>
		<div>
			<h1>PAGE <?=$language?></h1>
			<div>
				<?=$result_page['content']?>
			</div>
		</div>
	<?php	
	}
	?>
</div>